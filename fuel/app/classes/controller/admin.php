<?php	

class SessionDeleter{	//セッションを削除するクラス。以下「SessionDeleter::resSession_delete()」呼ばれます。
	public static function resSession_delete()
	{
		Session::delete('checkresnumber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
		
	}
	public static function delUserSes_delete()
	{
		Session::delete('id');
		Session::delete('name');
		Session::delete('email');
		Session::delete('kana');
		Session::delete('tel');
		Session::delete('postno');
		Session::delete('pref');
		Session::delete('addr1');
		Session::delete('addr2');
		Session::delete('sex');
		Session::delete('birthy');
		Session::delete('birthm');
		Session::delete('birthd');
	}
	public static function menuSession_delete()
	{
		Session::delete('category');
		Session::delete('servicename');
		Session::delete('servicecontent');
		Session::delete('serviceprice');
		Session::delete('servicetime');
		Session::delete('servicepricemem');
		Session::delete('servicepricecont');
	}

}
	//コントローラーコード開始
class Controller_admin extends Controller
{
	public function action_index()
    {
		
         $view = View::forge('admin/admin_login');
         return $view;
    }

	public function action_login()
	{
	
	 $auth = Auth::instance();
			 $error = null;
			if (Input::post())
			{
					if ($auth->login(Input::post('username'), Input::post('password')))
					{
						if ((Auth::member(100))or(Auth::member(50))) //管理者チェック  *！開発者ノート：　tblusersの「group」フィルードにadminを設定する（どれかのリコードに100を入れ、それを使ってログインすること）
							{
								$ad_br = Auth::get('branch_id');
								
								$adname=auth::get_screen_name();
								Session::create();
								
								Session::set('admin_name', $adname);	
								Session::set('admin_branch', $ad_br);
								Response::redirect('admin/top');
								
								
							}
							else //管理者かスタッフではない場合
							{
								
								Response::redirect_back('admin/admin_login', 'refresh');
							}
					}			
					else
					{
							
						 
							Response::redirect_back('admin/admin_login');
					}
			  }

	
	}
/********** TOPページ *********************************************/

	public function action_top()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
				SessionDeleter::resSession_delete();//予約管理ページのセッションを削除する
				

									//今日の日付をY-m-d表記(X年Y月Z日)にフォーマットして取り出す
									$today_date = date("Y-m-d");
									$branch_id = Session::get('admin_branch');
									$branch_name = Session::get("admin_name");
									
									//今日の予約でキャンセルされていないものを取ってくる
									$result = DB::select()->from('tblreserve')->where_open()
									->where('res_date','=', $today_date)
									->and_where('branch_id','=', $branch_id)
									->and_where('del_flag','=', 0)
									
									->where_close()
									->order_by('updated_at')
									->execute();
									
									//削除された日付をY-m-d表記(X年Y月Z日)にフォーマットして取り出す
									$deleted_at = date("Y-m-d");
									//削除された日付が今日でキャンセルされているものを取ってくる
									$kekka = DB::select()->from('tblreserve')->where_open()
									->where('deleted_at','like', $today_date.'%')
									->and_where('branch_id','=', $branch_id)
									->and_where('del_flag','=',1)
									->where_close()
									->execute();
									
									if ($branch_id ==="1"){
										$branch = '上永谷店';
									}else{
										$branch = '伊勢佐木長者町';
									}
									
									if(Auth::member(100)){
										$role = '管理者';
									}else{
										$role = 'スタッフ';
									}
									
									Session::set('branch',$branch);
									Session::set('role',$role);
								$view = View::forge('admin/admin_top');
								$view->set_global('rows',$result->as_array());
								$view->set_global('kekka',$kekka->as_array());
								$view->set('branch',$branch);
								$view->set('role',$role);
								return $view;

		}  
	}
		
	public function action_reserve_done()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$res_no = Session::get('res_number');
			$check = Input::post('rsnumber');
			$updated_at = date("Y-m-d H:i:s");
			$branch_id = Session::get('admin_branch');
			
			//【済】ボタンクリックされた時の処理
			$query = DB::update('tblreserve');
			$query->set(array('valid_res' => '0','updated_at'=>$updated_at))
			->where_open()
			->where('branch_id','=', $branch_id)
			->and_where('res_no',$check)
			->where_close()
			->execute();


				
			Response::redirect_back('admin/admin_login', 'refresh');
		}
	}
	public function action_reserve_del()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$branch_id = Session::get('admin_branch');
			$res_no = Session::get('res_number');
			$query = DB::delete('tblreserve')
			->where_open()
			->where('branch_id','=', $branch_id)
			->and_where('res_no',$res_no)
			->where_close()
			->execute();
			
			//エラーキャチャーとしてTOPのコード挿入
			$today_date = date("Y-m-d");
			$branch_id = Session::get('admin_branch');
			$branch_name = Session::get("admin_name");
			
			//今日の予約でキャンセルされていないものを取ってくる
			$result = DB::select()->from('tblreserve')->where_open()
			->where('res_date','=', $today_date)
			->and_where('branch_id','=', $branch_id)
			->and_where('del_flag','=', 0)
			
			->where_close()
			->order_by('updated_at')
			->execute();
			
			//削除された日付をY-m-d表記(X年Y月Z日)にフォーマットして取り出す
			$deleted_at = date("Y-m-d");
			//削除された日付が今日でキャンセルされているものを取ってくる
			$kekka = DB::select()->from('tblreserve')->where_open()
			->where('deleted_at','like', $today_date.'%')
			->and_where('branch_id','=', $branch_id)
			->and_where('del_flag','=',1)
			->where_close()
			->execute();

			
			
			$view = View::forge('admin/admin_top');
			$view->set_global('rows',$result->as_array());
			$view->set_global('kekka',$kekka->as_array());
			return $view;
		}
	}


	public function action_ranking()
	{
		$branch_id = Session::get('admin_branch');
		$rank_cat = Input::post('course');
		Session::set('ranking',$rank_cat);
		
		$month = date("m");
		if ($rank_cat==="img")
		{
			
		 
		 return View::forge('admin/upload');
	 }
		
		if ($rank_cat === 'グラフ')
		{
			$view = View::forge('admin/graph');
			return $view;
			
		}else{
		if ($rank_cat === 'コース')
		{
			
			
		
			
			$result = DB::select()->from('tblservice')
			->where_open()
			->where('svc_name','!=','なし')
			->and_where('branch_id','=',$branch_id)
			->where_close()
			->order_by('count','desc')
			->execute();
		
		}
		if ($rank_cat === 'フェイシャル')
		{
			
			$result = DB::select()->from('tblservicefacial')
			->where_open()
			->where('svc_name','!=','なし')
			->and_where('branch_id','=',$branch_id)
			->where_close()
			->order_by('count','desc')
			->execute();
		}
		if ($rank_cat === 'オプション')
		{
			
			$result = DB::select()->from('tbloption')
			->where_open()
			->where('opt_name','!=','なし')
			->and_where('branch_id','=',$branch_id)
			->where_close()
			->order_by('count','desc')
			->execute();
		}
		
		$view = View::forge('admin/admin_top_shuukei');//,$ranking);
		$view->set_global('rows',$result->as_array());
	
		return $view;
		}
	}
	public function action_canceler()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//
			$branch_id = Session::get('admin_branch');
			$qs = DB::select()->from('tblreserve')->execute();
			foreach($qs as $qss){
				$select_qss = $qss['res_date'];	
				$res_date = date('Y-m-d',strtotime($select_qss));
				
				
				if($res_date < date('Y-m-d')){
					
					$invalidate=array(
						
						'del_flag' => 1,						
					);
				$query = DB::update('tblreserve')
				->where_open()
				->where('res_date',$res_date)
				->and_where('branch_id','=',$branch_id)
				->where_close()
				->set($invalidate)
				->execute();
				}
			}
			$view = View::forge('admin/admin_canceler');
			return $view;
		}
	}
/********** End of TOPページ *********************************************/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/********** お客様情報管理ページ *********************************************/

	public function action_cusinfo()
	{
	if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			
			SessionDeleter::resSession_delete();//予約管理ページのセッションを削除する
			$branch_id = Session::get('admin_branch');	
			
			$auth = Auth::instance();
		
			$result = DB::select()->from('tblusers')->where_open()
				->where('group','=', 1)
				->and_where('del_flag','=', 0)
				->where_close()
				->execute();
			
		
			$authdata=array();
			
			$cus_name = Auth::get_profile_fields('name');
			$cus_kana = Auth::get_profile_fields('kana');
			$cus_email = Auth::get_email();
			$cus_tel = Auth::get_profile_fields('tel');
			$cus_postno =  Auth::get_profile_fields('post_no');
			$cus_pref= Auth::get_profile_fields('pref');
			$cus_addr1 = Auth::get_profile_fields('addr1');
			$cus_addr2 = Auth::get_profile_fields('addr2');
			$cus_sex = Auth::get_profile_fields('sex');
			$cus_birthy = Auth::get_profile_fields('birthy');
			$cus_birthm = Auth::get_profile_fields('birthm');
			$cus_birthd = Auth::get_profile_fields('birthd');
			$cus_reg_date = Auth::get('created_at');
									
					
			$view = View::forge('admin/admin_cus_info');
			$view->set_global('rows',$result->as_array());
			
			$view->set('name',$cus_name);
			$view->set('kana',$cus_kana);
			$view->set('email',$cus_email);
			$view->set('tel',$cus_tel);
			$view->set('postno',$cus_postno);
			$view->set('pref',$cus_pref);
			$view->set('addr1',$cus_addr1);
			$view->set('addr2',$cus_addr2);
			$view->set('sex',$cus_sex);
			$view->set('birthy',$cus_birthy);
			$view->set('birthm',$cus_birthm);
			$view->set('birthd',$cus_birthd);
			$view->set('reg_date',$cus_reg_date);

			 return $view;
		} 
	}
		
	
	public function action_member_status()//ここ変更
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$id = Input::post('memstat');

			
		
			 if($_POST['member_status']){
			 
				$query = DB::update('tblusers');
				$query->value('member_status','1');
				$query->where('id','=',$id);
				$result = $query->execute();
			}
			Response::redirect_back('admin/admin_login', 'refresh');
			return;
		}
	
	}

	public function action_staffprofile() //プロフィール
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			//新規定義
			$profile = Input::post('staff');
			Session::set('stafflist',$profile);
			$created_at = date("Y-m-d");
			
			$date = array();
			$date['rows'] = Model_Staff::find_by('staff_name',$profile);
			
			$sched = DB::select()->from('tblstaffsched')
			->where('staff_name',$profile)
			->and_where('sched_date','>=',$created_at)
			->order_by('sched_date')
			->execute();
			
			$view = View::forge('admin/admin_staff_profile',$date);
			$view ->set('profile',$profile);
			$view->set_global('sched',$sched->as_array());
			return $view;
		}
	}

	public function action_addnewmem_confirm()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$username_input = Input::post('cus_mail');
			$email_input = Input::post('cus_mail');
			$name_input = Input::post('cus_name');						
			$kana_input = Input::post('cus_kana');
			$tel_input = Input::post('cus_tel');
			$postno_input = Input::post('cus_zip');
			$pref_input = Input::post('cus_pref');
			$addr1_input = Input::post('cus_addr1');
			$addr2_input = Input::post('cus_addr2');
			$sex_input = Input::post('cus_sex');
			$birthy_input =Input::post('cus_birthy');
			$birthm_input = Input::post('cus_birthm');
			$birthd_input = Input::post('cus_birthd');
			$password_input = Input::post('loginpw');
			$cpassword_input = Input::post('loginpw_check');

			Session::set('cus_username', $email_input);
			Session::set('cus_mail', $email_input);
			Session::set('cus_name', $name_input);
			Session::set('cus_kana', $kana_input);
			Session::set('cus_tel', $tel_input);
			Session::set('cus_zip', $postno_input);
			Session::set('cus_pref', $pref_input);
			Session::set('cus_addr1', $addr1_input);
			Session::set('cus_addr2', $addr2_input);
			Session::set('cus_sex', $sex_input);
			Session::set('cus_birthy', $birthy_input);
			Session::set('cus_birthm', $birthm_input);
			Session::set('cus_birthd', $birthd_input);
			Session::set('cus_password', $password_input);
					
					
		
			$view = View::forge('admin/admin_addnewmem_confirm');
			
			$view->set('username',$email_input);
			$view->set('email',$email_input);
			$view->set('name',$name_input);
			$view->set('kana',$kana_input);
			$view->set('tel',$tel_input);
			$view->set('postno',$postno_input);
			$view->set('pref',$pref_input);
			$view->set('addr1',$addr1_input);
			$view->set('addr2',$addr2_input);
			$view->set('sex',$sex_input);
			$view->set('birthy',$birthy_input);
			$view->set('birthm',$birthm_input);
			$view->set('birthd',$birthd_input);
			
			 return $view;
		}
    }
	public function action_addnewmem_finished()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
		
			//$password=Session::get('cus_password');
			$username=Session::get('cus_mail');
			
			$email=Session::get('cus_mail');
			$name=Session::get('cus_name');
			$kana=Session::get('cus_kana');
			$tel=Session::get('cus_tel');
			$postno=Session::get('cus_zip');
			$pref=Session::get('cus_pref');
			$addr1=Session::get('cus_addr1');
			$addr2=Session::get('cus_addr2');
			$sex=Session::get('cus_sex');
			$birthy=Session::get('cus_birthy');
			$birthm=Session::get('cus_birthm');
			$birthd=Session::get('cus_birthd');
		
			 $length = 8;
			 $str =substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
			 $shuffled = str_shuffle($str);
			 $password = $shuffled;
		
			 $auth = Auth::instance();
			 try
				{
					$auth->create_user(
						$username,
						$password,
						$email,
						1,
						array(
							'name' => $name,
							'kana' => $kana,
							'tel' => $tel,
							'post_no' => $postno,
							'pref' => $pref,
							'addr1' => $addr1,
							'addr2' => $addr2,
							'sex' => $sex,
							'birthy' => $birthy,
							'birthm' => $birthm,
							'birthd' => $birthd,
							'user_point' => '0',
						)
					);
				}
				catch (Exception $e)
				{
					$error = $e->getMessage();

					
				}

			 $email=htmlspecialchars($email);
			 //データベース接続 メール送信 新規登録
			 $query = DB::select()->from('tblmail');
			 $result = $query->execute();

			 $tblmail = $result;
			 foreach($result as $tblmail);
			 $query = DB::select()->from('tblmailtype')
			 ->where('type','=','新規登録');
			$result = $query-> execute();
			$tblmailtype = $result;
			foreach($result as $tblmailtype);

			 mb_language("ja");

			 mb_internal_encoding("utf8");

			 $mailto = $email;
			 $subject = $tblmailtype['title'];
			 $mailbody = $name." 様"."\n"."\n".$tblmailtype['header']."\n"."\n".
			 "仮パスワードは".$password."になります。"."\n"."\n".
			 $tblmailtype['body']."\n"."\n".$tblmailtype['footer']."\n"."\n".$tblmail['signature'];
			 
			 
			 $mailfrom="From:" .$tblmail['mail_add'];
			 mb_send_mail($mailto,$subject,$mailbody,$mailfrom);
			
			
			
			 $view = View::forge('admin/admin_addnewmem_finished');
			 return $view;
		}
	}
	public function action_memprofile()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合	
			
			$id = Input::post('id');
			Session::set('id',$id);
				
									
			Auth::get_by_id($id);
			$authrec = \Session::get('authrec_id');
			
			$name = \Arr::get($authrec, "name", "");
			$kana= \Arr::get($authrec, "kana", "");
			$tel = \Arr::get($authrec, "tel", "");
			$post_no = \Arr::get($authrec, "post_no", "");
			$pref = \Arr::get($authrec, "pref", "");
			$addr1 = \Arr::get($authrec, "addr1", "");
			$addr2 = \Arr::get($authrec, "addr2", "");
			$sex = \Arr::get($authrec, "sex", "");
			$birthy = \Arr::get($authrec, "birthy", "");
			$birthm = \Arr::get($authrec, "birthm", "");
			$birthd = \Arr::get($authrec, "birthd", "");
			
			Session::set('name',$name);
			Session::set('kana',$kana);
			Session::set('tel',$tel);
			Session::set('postno',$post_no);
			Session::set('pref',$pref);
			Session::set('addr1',$addr1);
			Session::set('addr2',$addr2);
			Session::set('sex',$sex);
			Session::set('birthy',$birthy);
			Session::set('birthm',$birthm);
			Session::set('birthd',$birthd);
			
			$data = array();
			$data['rows']= Model_User::find_by('id',$id);
		
			$view = View::forge('admin/admin_members_profile',$data);

			 $view->set('birthy',$birthy);
			 $view->set('birthm',$birthm);
			 $view->set('birthd',$birthd);
			 $view->set('kana',$kana);
			 $view->set('name',$name);
			 $view->set('tel',$tel);
			 $view->set('post_no',$post_no);
			 $view->set('pref',$pref);
			 $view->set('addr1',$addr1);
			 $view->set('addr2',$addr2);
			  $view->set('sex',$sex);
			 return $view;
		}
	}
	public function action_memberedit()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$id = Session::get('id');
			$data = array();	
			$data['rows']= Model_User::find_by('id',$id);
					
			$view = View::forge('admin/admin_editmem',$data);

			
			 return $view;
		}
	}
	
	public function action_memberedit_confirm()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合	
				$user=Model_User::forge();
				
				$user_form=Fieldset::forge('user_form');
				$user_form->add_model($user)->populate($user);
				$user_form=Fieldset::instance('user_form');
				$user_form->add('cus_sex','性別',array('type'=>'radio','options'=>array('男'=>'男','女'=>'女')));
				$user_form->add('getval','getval',array('type'=>'hidden'));
				$user_form->field('cus_sex');
				$this->user_form=$user_form;
				$user_form->set_config('required_mark','※');
				//$view->set('form',$user_form->build('reservations/member_profile_changeC'));
				
				
				
				
				// バリデーション
					$val = Validation::forge();

					$val->add('cus_email', 'メールアドレス')
						->add_rule('valid_email')
						->add_rule('required');									
						
					$val->add('cus_name', 'お名前')
						->add_rule('required')
						->add_rule('min_length', '2');
					$val->add('cus_kana', 'フリガナ');
						
					$val->add('cus_tel', '電話番号');
					$val->add('cus_zip', '郵便番号');
						//->add_rule('required')
						//->add_rule('max_length', '7');
					
					$val->add('cus_pref', '都道府県');
						//->add_rule('required');
					$val->add('cus_addr1', '市区町村・番地');
						//->add_rule('required');
					$val->add('cus_addr2', '住所');
					
					$val->add('cus_birthy', '生年月日');
						//->add_rule('required');
					$val->add('cus_birthm', '生年月日');
						//->add_rule('required');
					$val->add('cus_birthd', '生年月日');
						//->add_rule('required');
					

					$email_input = Input::post('cus_mail');
					$name_input = Input::post('cus_name');						
					$kana_input = Input::post('cus_kana');
					$tel_input = Input::post('cus_tel');
					$postno_input = Input::post('cus_zip');
					$pref_input = Input::post('cus_pref');
					$addr1_input = Input::post('cus_addr1');
					$addr2_input = Input::post('cus_addr2');
					$sex_input = Input::post('cus_sex');
					$birthy_input =Input::post('cus_birthy');
					$birthm_input = Input::post('cus_birthm');
					$birthd_input = Input::post('cus_birthd');

				
		
					Session::create();
					
					print $name_input.$kana_input;
					
					Session::set('cus_mail', $email_input);
					Session::set('cus_name', $name_input);
					Session::set('cus_kana', $kana_input);
					Session::set('cus_tel', $tel_input);
					Session::set('cus_post_no', $postno_input);
					Session::set('cus_pref', $pref_input);
					Session::set('cus_addr1', $addr1_input);
					Session::set('cus_addr2', $addr2_input);
					Session::set('cus_sex', $sex_input);
					Session::set('cus_birthy', $birthy_input);
					Session::set('cus_birthm', $birthm_input);
					Session::set('cus_birthd', $birthd_input);
			
			 $view = View::forge('admin/admin_editmem_confirm');
			 return $view;
		}
    }
	
	public function action_memberedit_finished()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$id = Session::get('id');
			$email = Session::get('cus_mail');
			$name = Session::get('cus_name');
			$kana = Session::get('cus_kana');
			$tel = Session::get('cus_tel');
			$post_no = Session::get('cus_post_no');
			$pref = Session::get('cus_pref');
			$addr1 = Session::get('cus_addr1');
			$addr2 = Session::get('cus_addr2');
			$sex = Session::get('cus_sex');
			$birthy = Session::get('cus_birthy');
			$birthm = Session::get('cus_birthm');
			$birthd = Session::get('cus_birthd');
			
			Auth::update_memrec($id,$email,$name,$kana,$tel,$post_no,$pref,$addr1,$addr2,$sex,$birthy,$birthm,$birthd);
			

			 //データベース接続 メール送信 会員情報変更
			 $query = DB::select()->from('tblmail');
			 $result = $query->execute();
			 $tblmail = $result;
			 foreach($result as $tblmail);
			 
			 $query = DB::select()->from('tblmailtype')
			 ->where('type','=','会員情報変更');
			 $result = $query->execute();
			 $tblmailtype = $result;
			 foreach($result as $tblmailtype);


			 mb_language("ja");

			 mb_internal_encoding("utf8");

			 $mailto = $email;
			 $subject = $tblmailtype['title'];
			 $mailbody = $name ." 様"."\n"."\n".$tblmailtype['header']."\n"."\n".$tblmailtype['body']."\n"."\n".$tblmailtype['footer']."\n"."\n".$tblmail['signature'];


			 $mailfrom="From:" .$tblmail['mail_add'];
			 mb_send_mail($mailto,$subject,$mailbody,$mailfrom);	
			
			 
			 
			 //======================================================================================//
			
			
			
			 $view = View::forge('admin/admin_editmem_finished');
			 SessionDeleter::delUserSes_delete();
			 return $view;
		}
    }
	public function action_memberdelete()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$id = Session::get('id');
			Auth::get_by_id($id);
			$authrec = \Session::get('authrec_id');
			
			$name = \Arr::get($authrec, "name", "");
			
			 $view = View::forge('admin/admin_deletemem');
			 $view->set('name',$name);
			 return $view;
		}
    }
	public function action_memberdelete_finished()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$id = Session::get('id');
			
			$delete_mem = array();
			$delete_mem = Model_User::find_by('id',$id);
			$query = DB::update('tblusers');
			$query->set(array('del_flag' => '1'));
			$query->where('id',$id);
			$query->execute();
		 
			
			$view = View::forge('admin/admin_deletemem_finished');
			SessionDeleter::delUserSes_delete();
			 return $view;
		}
	}
	public function action_search_cusinfo()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$search_field = Input::post('search_field');
			Session::set('field',$search_field);
			$search_val =  Input::post('search');
			
			
			/*   Search by お客様ID */
			if ($search_field==='顧客ID'){
				Auth::get_by_id($search_val);
			
				$mem['rows'] = Model_User::find_by('id',$search_val);
				
				if ($mem!=null){
					$view = View::forge('admin/admin_cus_info_search',$mem);
					
					$view ->set('field',$search_field);
				
					return $view;
				}else{
					$view = View::forge('admin/admin_norec');
					return $view;
				}
			}
			
			/*   Search by 顧客名 */
			if ($search_field==='顧客名'){
				Auth::get_by_name($search_val);
				
				$search_val = Session::get('authid');
				Auth::get_by_id($search_val);
			
				$mem['rows'] = Model_User::find_by('id',$search_val);
				//print_r($mem);
				if ($mem!=null){
					$view = View::forge('admin/admin_cus_info_search',$mem);
					$view ->set('field',$search_field);
					return $view;
				}else{
					$view = View::forge('admin/admin_norec');
					return $view;
				}
			}
			
		}
    }
/********** End of お客様情報管理ページ *********************************************/

/********** 予約管理ページ *********************************************/
	public function action_reserveinfo()
    {	
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			SessionDeleter::resSession_delete(); //予約管理ページのセッションを削除する
			$branch_id = Session::get('admin_branch');
			$result = DB::select()->from('tblreserve')
				->where_open()
				->where('del_flag','!=','1')
				->and_where('branch_id',$branch_id)
				->where_close()
				->execute();
			//$reserve['rows']= Model_Reserve::find_by('del_flag','!=',1);
			
				
			
			 $view = View::forge('admin/admin_reserve_info');
			 $view->set_global('rows',$result->as_array());
			 return $view;
		} 
	}
	
/* 	public function action_reservedetails()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			 $view = View::forge('admin/admin_reserve_details');
			 return $view;
		}
    } */
	public function action_search_reserveinfo()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$category = Input::post('category');
			$value = Input::post('search');
			$branch_id = Session::get('admin_branch');	

			$search = array();

				if($category === '予約番号'){
					
					
						
					$search = DB::select()->from('tblreserve')
						->where_open()
						->where('res_no',$value)
						->and_where('branch_id',$branch_id)
						->where_close()
						->execute();
				
				}else if($category === '顧客名'){
				
					$search = DB::select()->from('tblreserve')
						->where_open()
						->where('name',$value)
						->and_where('branch_id',$branch_id)
						->where_close()
						->execute();
					
				}else if($category === '予約日付'){
				
					$search = DB::select()->from('tblreserve')
						->where_open()
						->where('res_date',$value)
						->and_where('branch_id',$branch_id)
						->where_close()
						->execute();
					
				}else{//staff
					
						$search = DB::select()->from('tblreserve')
						->where_open()
						->where('staff_name',$value)
						->and_where('branch_id',$branch_id)
						->where_close()
						->execute();
				}
		
			 $view = View::forge('admin/admin_reserve_info_search',$search);
			 $view->set_global('rows',$search->as_array());
			 return $view;
		}
	}
	
	public function action_reservecalendar()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			SessionDeleter::resSession_delete(); //予約管理ページのセッションを削除する
			
			$auth = Auth::instance();
			$name = Auth::get_profile_fields('name');
			$data = array();
			$data['rows']= Model_User::find_by('email',Auth::get_email());
			$view = View::forge('admin/admin_reserve_calendar', $data);
			
			return $view;
		}
	}
	
	public function action_weekone()
    {
	
		$cal_form = Fieldset::forge('cal_form');
		$cal_form -> add('lastdate','lastdate',array('type'=>'hidden'));
		$cal_form -> field('lastdate');
		$this->cal_form=$cal_form;
		$lastdate = Input::post('lastdate');
		$view = View::forge('admin/admin_reserve_calendar');	
        return $view;
    }	
	
	public function action_weektwo()
    {
		
		$cal_form = Fieldset::forge('cal_form');
		$cal_form -> add('lastdate','lastdate',array('type'=>'hidden'));
		$cal_form -> field('lastdate');
		$this->cal_form=$cal_form;
		$lastdate = Input::post('lastdate');
		$data = array();
		$data['rows']= Model_User::find_by('email',Auth::get_email());
		$view = View::forge('admin/admin_reserve_weektwo', $data);	
		
        return $view;
    }
	
	public function action_weekthree()
    {
		$cal_form = Fieldset::forge('cal_form');
		$cal_form -> add('lastdate','lastdate',array('type'=>'hidden'));
		$cal_form -> field('lastdate');
		$this->cal_form=$cal_form;
		$lastdate = Input::post('lastdate');
		$data = array();
		$data['rows']= Model_User::find_by('email',Auth::get_email());
		$view = View::forge('admin/admin_reserve_weekthree', $data);	
        return $view;
    }

	public function action_weekfour()
    {
		$cal_form = Fieldset::forge('cal_form');
		$cal_form -> add('lastdate','lastdate',array('type'=>'hidden'));
		$cal_form -> field('lastdate');
		$this->cal_form=$cal_form;
		$lastdate = Input::post('lastdate');
		$data = array();
		$data['rows']= Model_User::find_by('email',Auth::get_email());
		$view = View::forge('admin/admin_reserve_weekfour', $data);		
        return $view;
    }	
	
	public function action_reserveedit()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合	
			$view = View::forge('admin/admin_reserve_calendar');
			return $view;
		}
	}
	//////// RESERVE FORM //////////
	public function action_reserveform()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$auth = Auth::instance();
			$name = Auth::get_profile_fields('name');
			$data = array();
			$data['rows']= Model_User::find_by('email',Auth::get_email());
			$view = View::forge('admin/admin_reserve_form');		
			$view->set('name',$name);
			$resdate=date("m/d",strtotime(Input::post('resdate')));
			$restime=Input::post('restime');
			$weekday = \Model\Calendar::display_dayofweek($resdate);	
		////*	予約編集のデータ	*//////
			
			$resnumber = Session::get('checkresnumber');
			$checker = array();
			$checkdate = DB::select()->from('tblreserve')->where('res_no','=',$resnumber)->execute();
			foreach($checkdate as $check):
			$checkname = ($check['name']);
			$checkstaff = ($check['staff_name']);
			$checkservice1 = ($check['svc_name_1']);
			$checkservice2 = ($check['svc_name_2']);
			$checkoption = ($check['opt_name']);
			
			Session::set('checkname',$checkname);
			Session::set('checkstaff',$checkstaff);
			Session::set('checkservice1',$checkservice1);
			Session::set('checkservice2',$checkservice2);
			Session::set('checkoption',$checkoption);
			endforeach;
			
		////*	予約編集のデータ	*//////		
			$searchdate=date("Y-m-d",strtotime($resdate));
			if($restime=="10:00"){
			
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_10', '=', 1)
					->and_where('time_10_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="10:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1030', '=', 1)
					->and_where('time_1030_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="11:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_11', '=', 1)
					->and_where('time_11_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="11:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1130', '=', 1)
					->and_where('time_1130_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="12:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_12', '=', 1)
					->and_where('time_12_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="12:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1230', '=', 1)
					->and_where('time_1230_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="13:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_13', '=', 1)
					->and_where('time_13_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="13:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1330', '=', 1)
					->and_where('time_1330_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="14:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_14', '=', 1)
					->and_where('time_14_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="14:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1430', '=', 1)
					->and_where('time_1430_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="15:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_15', '=', 1)
					->and_where('time_15_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="15:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1530', '=', 1)
					->and_where('time_1530_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="16:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_16', '=', 1)
					->and_where('time_16_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="16:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1630', '=', 1)
					->and_where('time_1630_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="17:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_17', '=', 1)
					->and_where('time_17_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="17:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1730', '=', 1)
					->and_where('time_1730_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="18:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_18', '=', 1)
					->and_where('time_18_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="18:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1830', '=', 1)
					->and_where('time_1830_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="19:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_19', '=', 1)
					->and_where('time_19_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="19:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1930', '=', 1)
					->and_where('time_1930_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="20:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_20', '=', 1)
					->and_where('time_20_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="20:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_2030', '=', 1)
					->and_where('time_2030_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="21:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_21', '=', 1)
					->and_where('time_21_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="21:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_2130', '=', 1)
					->and_where('time_2130_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}elseif($restime=="22:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_22', '=', 1)
					->and_where('time_22_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="22:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_2230', '=', 1)
					->and_where('time_2230_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();				
			}
			
			$course1 = DB::select()->from('tblservice')->where('svc_no', '!=', 0)->order_by('svc_no', 'asc')->execute();
			$course2 = DB::select()->from('tblservicefacial')->where('svc_no', '!=', 0)->order_by('svc_no', 'asc')->execute();		
			$option = DB::select()->from('tbloption')->where('opt_no', '!=', 0)->order_by('opt_no', 'asc')->execute();
			
			$view->set_global('staff',$avstaff->as_array());
			$view->set_global('course1',$course1->as_array());
			$view->set_global('course2',$course2->as_array());
			$view->set_global('option',$option->as_array());
			$view->set('resdate',$resdate);	
			$view->set('restime',$restime);	
			$view->set('weekday',$weekday);
			
			
			return $view;
		}
	}
	//////// RESERVE CONFIRM ////////
	public function action_reserveconfirm()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$resnumber = Session::get('checkresnumber');
			if ($resnumber!=''){ //existing record
				//print Session::get('checkname');
				$resname = Session::get('checkname');
				Auth::get_by_name($resname);
				$search_val = Session::get('authid');
				Auth::get_by_id($search_val);
				$authrec = \Session::get('authrec_id');
				$cus_id = $search_val;
				$email = \Session::get('authemail');
				$created_at = \Session::get('authregdate');
				$name = \Arr::get($authrec, "name", "");
				$kana= \Arr::get($authrec, "kana", "");
				$tel = \Arr::get($authrec, "tel", "");
				$postno = \Arr::get($authrec, "post_no", "");
				$pref = \Arr::get($authrec, "pref", "");
				$addr1 = \Arr::get($authrec, "addr1", "");
				$addr2 = \Arr::get($authrec, "addr2", "");
				$sex = \Arr::get($authrec, "sex", "");
				$birthy = \Arr::get($authrec, "birthy", "");
				$birthm = \Arr::get($authrec, "birthm", "");
				$birthd = \Arr::get($authrec, "birthd", "");
			}else{
				$search_val =  Input::post('search');
				Auth::get_by_id($search_val);
				$authrec = \Session::get('authrec_id');
				$cus_id = $search_val;
				$email = \Session::get('authemail');
				$created_at = \Session::get('authregdate');
				$name = \Arr::get($authrec, "name", "");
				$kana= \Arr::get($authrec, "kana", "");
				$tel = \Arr::get($authrec, "tel", "");
				$postno = \Arr::get($authrec, "post_no", "");
				$pref = \Arr::get($authrec, "pref", "");
				$addr1 = \Arr::get($authrec, "addr1", "");
				$addr2 = \Arr::get($authrec, "addr2", "");
				$sex = \Arr::get($authrec, "sex", "");
				$birthy = \Arr::get($authrec, "birthy", "");
				$birthm = \Arr::get($authrec, "birthm", "");
				$birthd = \Arr::get($authrec, "birthd", "");
			}
			
			 $err = false;
			Session::set('err', $err);
			
			$data = array();
			$data['rows']= Model_User::find_by('email',Auth::get_email());	
			$view = View::forge('admin/admin_reserve_form', $data);	

			$resdate=date("m/d",strtotime(Input::post('resdate')));
			$restime=Input::post('restime');
			$weekday = \Model\Calendar::display_dayofweek($resdate);		
			//print $restime."<br>";
			//print $resdate."<br>";
			
			//print $weekday."<br>";	
	//My work now -- getting the staffs name for a specified DATE -- 作業		
			$searchdate=date("Y-m-d",strtotime($resdate));
			//print $searchdate;
			//$select_avstaff = "";
			
			if($restime=="10:00"){
			//print "ten<br>";
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_10', '=', 1)
					->and_where('time_10_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="10:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1030', '=', 1)
					->and_where('time_1030_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="11:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_11', '=', 1)
					->and_where('time_11_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="11:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1130', '=', 1)
					->and_where('time_1130_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();		
			}elseif($restime=="12:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_12', '=', 1)
					->and_where('time_12_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="12:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1230', '=', 1)
					->and_where('time_1230_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="13:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_13', '=', 1)
					->and_where('time_13_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="13:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1330', '=', 1)
					->and_where('time_1330_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="14:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_14', '=', 1)
					->and_where('time_14_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="14:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1430', '=', 1)
					->and_where('time_1430_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="15:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_15', '=', 1)
					->and_where('time_15_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="15:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1530', '=', 1)
					->and_where('time_1530_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="16:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_16', '=', 1)
					->and_where('time_16_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="16:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1630', '=', 1)
					->and_where('time_1630_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="17:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_17', '=', 1)
					->and_where('time_17_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="17:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1730', '=', 1)
					->and_where('time_1730_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="18:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_18', '=', 1)
					->and_where('time_18_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="18:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1830', '=', 1)
					->and_where('time_1830_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="19:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_19', '=', 1)
					->and_where('time_19_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="19:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_1930', '=', 1)
					->and_where('time_1930_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="20:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_20', '=', 1)
					->and_where('time_20_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="20:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_2030', '=', 1)
					->and_where('time_2030_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="21:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_21', '=', 1)
					->and_where('time_21_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="21:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_2130', '=', 1)
					->and_where('time_2130_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="22:00"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_22', '=', 1)
					->and_where('time_22_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}elseif($restime=="21:30"){
				$avstaff = DB::select('staff_name')->from('tblstaffsched')
					->where('sched_date', '=', $searchdate)
					->and_where('time_2130', '=', 1)
					->and_where('time_2130_open', '=', 0)
					->order_by('staff_no', 'asc')->execute();
			}
			//$staff = DB::select()->from('tblstaff')->where('staff_no', '!=', 0)->order_by('staff_no', 'asc')->execute();
			$course1 = DB::select()->from('tblservice')->where('svc_no', '!=', 0)->order_by('svc_no', 'asc')->execute();
			$course2 = DB::select()->from('tblservicefacial')->where('svc_no', '!=', 0)->order_by('svc_no', 'asc')->execute();
			//$course3 = DB::select()->from('tblservice')->where('svc_no', '!=', 0)->order_by('svc_no', 'asc')->execute();
			$option = DB::select()->from('tbloption')->where('opt_no', '!=', 0)->order_by('opt_no', 'asc')->execute();		
			
			if (Input::method() == 'POST'){
			
				$checkList = array(
				'staff' => trim(Input::post('staff')),
				'course1' => trim(Input::post('course1')),
				'course2' => trim(Input::post('course2')),
				//'course3' => trim(Input::post('course3')),
				//'option[]' => trim(Input::post('option[]')),
				'option' => trim(Input::post('option')),
				);
				//$val = Fieldset::forge();
					$val = Validation::forge();
					$val->add_field('staff', 'スタッフ','required');
					
					//$val->add_field('course1', 'コース','required');
					
					if ($val->run($checkList))
					{
					$auth = Auth::instance();

						$staff=Input::post('staff');
						
						$course1=Input::post('course1');
						if($course1!="なし"){			//checking minutes
						$course1_min = DB::select('svc_time')->from('tblservice')->where('svc_name','=',$course1)->execute();
						if(count($course1_min)>0){
							foreach($course1_min as $course1_mins){
								$course1_minsel= $course1_mins['svc_time']; 
							}
							//print $course1_minsel;
						}
						}else{
							$course1_minsel=0;
						}
						
						$course2=Input::post('course2');
						if($course2!="なし"){			//checking minutes
						$course2_min = DB::select('svc_time')->from('tblservicefacial')->where('svc_name','=',$course2)->execute();
						if(count($course2_min)>0){
							foreach($course2_min as $course2_mins){
								$course2_minsel= $course2_mins['svc_time']; 
							}
							//print $course2_minsel;
						}
						}else{
							$course2_minsel=0;
						}
						/*$course3=Input::post('course3');
						$course3_min = DB::select('svc_time')->from('tblservice')->where('svc_name','=',$course3)->execute();
						if(count($course3_min)>0){
							foreach($course3_min as $course3_mins){
								$course3_minsel= $course3_mins['svc_time']; 
							}
							print $course3_minsel;
						}*/	
						$option=Input::post('option');
						
						$resdate=date("m/d",strtotime(Input::post('resdate')));
						$restime=Input::post('restime');
						
						
	//RESERVATION NUMBER start		
						$lastres = DB::select('res_no')->from('tblreserve')->where('id','!=',0)->order_by('id', 'desc')->limit(1)->execute();
						//get last reservation number

						if(count($lastres)<=0){
							$lastresno=(string)date("YmdHi")."000";
						}else{
							foreach($lastres as $lastress){
								$lastresno= $lastress['res_no']; //string
							}
						}		

							$getlasresmo = (int)substr($lastresno,8,2); //last reservations time
							//print "last res no is ".$lastresno."<br>";
							//print "getlasresmo is ".$getlasresmo."<br>";
							
							//get current hour
							$hournow = date("H");
							$hournowStr = (int)$hournow."<br>";
							//print "<br> hour now is ".$hournowStr; //string current hour
							
							if($getlasresmo != $hournowStr){
								//print "different time <br>";
								$num = 1;
								$num_padded = sprintf("%03s", $num);
								//print $num_padded."<br>";						
							}else{
								//print "same time <br>";
								$lastresnum = (int)substr($lastresno,12,3);
								//print $lastresnum;
								$num = $lastresnum + 1;
								$num_padded = sprintf("%03s", $num);
														
							}

							$resno = (string)date("YmdHi").$num_padded;
							

						$membercheck = DB::select('member_status')->from('tblusers')
						->where('email','=', $email)
						->execute();
						$totalamount = 0;
						foreach($membercheck as $row):
								if ($row['member_status'] === "1"){
								
									$course1_cost = DB::select('svc_price_member')->from('tblservice')->where('svc_name','=',$course1)->execute();
										foreach($course1_cost as $course1_costs){
											$totalamount = $totalamount + $course1_costs['svc_price_member'];
										}

									$course2_cost = DB::select('svc_price_member')->from('tblservicefacial')->where('svc_name','=',$course2)->execute();
										foreach($course2_cost as $course2_costs){
											$totalamount = $totalamount + $course2_costs['svc_price_member'];									
										}

									
									$option_cost = DB::select('opt_price_member')->from('tbloption')->where('opt_name','=',$option)->execute();
										foreach($option_cost as $option_costs){
											$totalamount = $totalamount + $option_costs['opt_price_member'];
										}								
		
								}else{
								
									$course1_cost = DB::select('svc_price_regular')->from('tblservice')->where('svc_name','=',$course1)->execute();
										foreach($course1_cost as $course1_costs){
											$totalamount = $totalamount + $course1_costs['svc_price_regular'];
										}
								
									$course2_cost = DB::select('svc_price_regular')->from('tblservicefacial')->where('svc_name','=',$course2)->execute();
										foreach($course2_cost as $course2_costs){
											$totalamount = $totalamount + $course2_costs['svc_price_regular'];
										}


									$option_cost = DB::select('opt_price_regular')->from('tbloption')->where('opt_name','=',$option)->execute();
										foreach($option_cost as $option_costs){
											$totalamount = $totalamount + $option_costs['opt_price_regular'];
										}								
								
								}
						endforeach;			
						
						$data = array();
						$data['rows']= Model_User::find_by('email',Auth::get_email());
						$view = View::forge('admin/admin_reserve_confirm', $data);	
						$view->set('staff',$staff);		
						$view->set('course1',$course1);	
						$view->set('course2',$course2);	
						//$view->set('course3',$course3);	
						$view->set('course1_minsel',$course1_minsel);	
						$view->set('course2_minsel',$course2_minsel);	
						//$view->set('course3_minsel',$course3_minsel);						
						$view->set('option',$option);	
						$view->set('resdate',$resdate);	
						$view->set('restime',$restime);	
						$view->set('weekday',$weekday);
						$view->set('totalamount',$totalamount);					
						$view->set('name',$name);
						$view->set('email',$email);
						$view->set('kana',$kana);
						$view->set('tel',$tel);
						$view->set('postno',$postno);
						$view->set('pref',$pref);
						$view->set('addr1',$addr1);
						$view->set('addr2',$addr2);	
						$view->set('sex',$sex);
						$view->set('birthy',$birthy);
						$view->set('birthm',$birthm);
						$view->set('birthd',$birthd);	
						$view->set('resno',$resno);						
						return $view;
					}else{
							$error = '*必須項目を入力してください';
							$view->set('error', $error);
					}
				}	
			//$view->set_global('staff',$staff->as_array());
			$view->set_global('staff',$avstaff->as_array());
			$view->set_global('course1',$course1->as_array());
			$view->set_global('course2',$course2->as_array());
			//$view->set_global('course3',$course3->as_array());
			$view->set_global('option',$option->as_array());			
			$view->content=View::forge('admin/admin_reserve_form');
			$view->set('resdate',$resdate);	
			$view->set('restime',$restime);	
			$view->set('weekday',$weekday);
			return $view;
		}
	}
	
	/////// RESERVE FINISHED ///////
	public function action_reservefinished()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$auth = Auth::instance();
			$authrec = \Session::get('authrec_id');
			$email = \Session::get('authemail');
			$created_at = \Session::get('authregdate');
			$name = \Arr::get($authrec, "name", "");
			$branch_id = Session::get('admin_branch');
			$data['rows']= Model_User::find_by('email',$email);	
			$view = View::forge('admin/admin_reserve_finished');
			$view->set('name',$name);
			
			$resnumber = Session::get('checkresnumber'); //編集したい予約の予約番号
				$checkstaff = Session::get('checkstaff');
				$checkservice1 = Session::get('checkservice1');
				$checkservice2 = Session::get('checkservice2');
				$checkoption = Session::get('checkoption');
				$day = Session::get('rescheck');
				$reschecktime = Session::get('reschecktime');
				$reschecktime = date('H:i',strtotime($reschecktime));

				
				if($checkservice1!="なし"){			//checking minutes 編集用
				$course1_minsel_editold=0;
				$course1_min = DB::select('svc_time')->from('tblservice')->where('svc_name','=',$checkservice1)->execute();
				if(count($course1_min)>0){
					foreach($course1_min as $course1_mins){
						$course1_minsel_editold= $course1_mins['svc_time']; 
					}
				}
				}else{
					$course1_minsel_editold=0;
				}			
				if($checkservice2!="なし"){			//checking minutes
				$course2_min = DB::select('svc_time')->from('tblservicefacial')->where('svc_name','=',$checkservice2)->execute();
				$course2_minsel_editold=0;
				if(count($course2_min)>0){
					foreach($course2_min as $course2_mins){
						$course2_minsel_editold= $course2_mins['svc_time']; 
					}
				}
				}else{
					$course2_minsel_editold=0;
				}
			if (Input::method() == 'POST'){
					
				if ($resnumber!=''){			
					$res_no = $resnumber;
					$total_course_timeold = $course1_minsel_editold+$course2_minsel_editold+30;//30minutes added allowance //+$course3_minsel;	
				}else{
					$res_no = Session::get('resno');
				}
				$staff_name=Session::get('staff');
				$svc_name_1=Session::get('course1');
				$svc_name_2=Session::get('course2');
				$course1_minsel=Session::get('course1_minsel');
				$course2_minsel=Session::get('course2_minsel');
				$total_course_time = $course1_minsel+$course2_minsel+30;//30minutes added allowance //+$course3_minsel;		
				$opt_name=Session::get('option');
				$res_date=Session::get('resdate');
				$res_date=date("Y-m-d",strtotime($res_date));
				$res_time=Session::get('restime');
				$res_tot_amt=Session::get('totalamount');
				$res_request=Input::post('freemessage');
				$created_at=date("Y-m-d H:i:s");

				$data=array(
					'email'=>$email,
					'name'=>$name,
					'res_no'=>$res_no,
					'staff_name'=>$staff_name,
					'svc_name_1'=>$svc_name_1,
					'svc_name_2'=>$svc_name_2,
					//'svc_name_3'=>$svc_name_3,
					'opt_name'=>$opt_name,
					'res_date'=>$res_date,
					'res_time'=>$res_time,
					'res_tot_amt'=>$res_tot_amt,
					'res_request'=>$res_request,
					'created_at'=>$created_at,
					'branch_id'=>$branch_id,
					
				);
				if ($resnumber!=''){			
					$query = DB::update('tblreserve')->set($data)->where('res_no', '=', $res_no)->execute(); //予約編集
				}else{
					$query = DB::insert('tblreserve')->set($data)->execute(); //新規予約
				}
			
			
			
			if ($resnumber!=''){ //前のサービスカウントをマイナス1になる・集計のためのカウント
			////////////////////MINUS SERVICE COUNT/////////////////////
			$sel_getcount=0;
				if($checkservice1 != "なし"){ //COUNT FOR MAIN
					$getcount = DB::select()->from('tblservice')->where('svc_name', $checkservice1)->execute();
					foreach($getcount as $getcounts){
						$sel_getcount= $getcounts['count']; 
					}
					$datenow = date('d');
					if($datenow === "1"){
						$putcount=array(
							'count'=>1,
						);
						$query = DB::update('tblservice')
							->where('svc_name', '=', $checkservice1)
							->set($putcount)
							->execute(); // saving to db
					}else{
						$sel_getcount = $sel_getcount - 1;
						$putcount=array(
							'count'=>$sel_getcount,
						);
						$query = DB::update('tblservice')
							->where('svc_name', '=', $checkservice1)
							->set($putcount)
							->execute(); // saving to db
					}

				}			
				if($checkservice2 != "なし"){ //COUNT FOR FACIAL
					$getcount = DB::select()->from('tblservicefacial')->where('svc_name', $checkservice2)->execute();
					foreach($getcount as $getcounts){
						$sel_getcount= $getcounts['count']; 
					}
					$datenow = date('d');
					if($datenow === "1"){
						$putcount=array(
							'count'=>1,
						);
						$query = DB::update('tblservicefacial')
							->where('svc_name', '=', $checkservice2)
							->set($putcount)
							->execute(); // saving to db
					}else{
						$sel_getcount = $sel_getcount - 1;
						$putcount=array(
							'count'=>$sel_getcount,
						);
						$query = DB::update('tblservicefacial')
							->where('svc_name', '=', $checkservice2)
							->set($putcount)
							->execute(); // saving to db
					}

				}						
				if($checkoption != "なし"){ //COUNT FOR OPTION
					$getcount = DB::select()->from('tbloption')->where('opt_name', $checkoption)->execute();
					foreach($getcount as $getcounts){
						$sel_getcount= $getcounts['count']; 
					}
					$datenow = date('d');
					if($datenow === "1"){
						$putcount=array(
							'count'=>1,
						);
						$query = DB::update('tbloption')
							->where('opt_name', '=', $checkoption)
							->set($putcount)
							->execute(); // saving to db
					}else{
						$sel_getcount = $sel_getcount - 1;
						$putcount=array(
							'count'=>$sel_getcount,
						);
						$query = DB::update('tbloption')
							->where('opt_name', '=', $checkoption)
							->set($putcount)
							->execute(); // saving to db
					}

				}
				

			///////////////////////UPDATE 予約編集 START/////////////////////////
				if($checkstaff=="指名なし"){ //START CHECK IF FREE STAFF
					
				}else{		
					if($reschecktime=="10:00"){	
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_10_open' => 0,
								'time_1030_open' => 0,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_10_open' => 0,
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeoldold<=180){
							
							$putsched=array(
								'time_10_open' => 0,
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,	
								'time_1230_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeoldold<=240){
							
							$putsched=array(
								'time_10_open' => 0,
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,	
								'time_1330_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_10_open' => 0,
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($reschecktime=="10:30"){//////10:30
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_1030_open' => 0,
								'time_11_open' => 0,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,	
								'time_13_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,	
								'time_14_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($reschecktime=="11:00"){//////11:00
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_11_open' => 0,
								'time_1130_open' => 0,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,	
								'time_1230_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,	
								'time_1330_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($reschecktime=="11:30"){//////11:30
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_1130_open' => 0,
								'time_12_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_1130_open' => 0,
								'time_12_open' => 0,	
								'time_1230_open' => 0,
								'time_13_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(							
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,	
								'time_1330_open' => 0,
								'time_14_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(							
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
								'time_15_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($reschecktime=="12:00"){//////12:00
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_12_open' => 0,
								'time_1230_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,	
								'time_1330_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($reschecktime=="12:30"){//////12:30
						if($total_course_timeold<=60){
							
							$putsched=array(							
								'time_1230_open' => 0,
								'time_13_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(							
								'time_1230_open' => 0,
								'time_13_open' => 0,	
								'time_1330_open' => 0,
								'time_14_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(							
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
								'time_15_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(							
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,
								'time_16_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($reschecktime=="13:00"){//////13:00
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_13_open' => 0,
								'time_1330_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}

					}elseif($reschecktime=="13:30"){//////13:30
						if($total_course_timeold<=60){
							
							$putsched=array(							
								'time_1330_open' => 0,
								'time_14_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(							
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
								'time_15_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(							
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,
								'time_16_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(							
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
								'time_17_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(							
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}
					
					}elseif($reschecktime=="14:00"){//////14:00
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_14_open' => 0,
								'time_1430_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,	
								'time_1730_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="14:30"){//////14:30
						if($total_course_timeold<=60){
							
							$putsched=array(							
								'time_1430_open' => 0,
								'time_15_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(							
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,
								'time_16_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(							
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
								'time_17_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(							
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,	
								'time_1730_open' => 0,
								'time_18_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(							
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="15:00"){//////15:00
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_15_open' => 0,
								'time_1530_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($reschecktime=="15:30"){//////15:30
						if($total_course_timeold<=60){
							
							$putsched=array(							
								'time_1530_open' => 0,
								'time_16_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(							
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
								'time_17_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(							
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(							
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
								'time_19_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(							
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($reschecktime=="16:00"){//////16:00
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_16_open' => 0,
								'time_1630_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,	
								'time_1730_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="16:30"){//////16:30
						if($total_course_timeold<=60){
							
							$putsched=array(							
								'time_1630_open' => 0,
								'time_17_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(							
								'time_1630_open' => 0,
								'time_17_open' => 0,	
								'time_1730_open' => 0,
								'time_18_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(							
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
								'time_19_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(							
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
								'time_20_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(							
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="17:00"){//////17:00
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_17_open' => 0,
								'time_1730_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,	
								'time_2030_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="17:30"){//////17:30
						if($total_course_timeold<=60){
							
							$putsched=array(							
								'time_1730_open' => 0,
								'time_18_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(							
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
								'time_19_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(							
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
								'time_20_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(							
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,	
								'time_2030_open' => 0,
								'time_21_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(							
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="18:00"){//////18:00
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_18_open' => 0,
								'time_1830_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,							
								'time_2030_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
								'time_22_open' => 0,
								'time_2230_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="18:30"){//////18:30
						if($total_course_timeold<=60){
							
							$putsched=array(							
								'time_1830_open' => 0,
								'time_19_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(							
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
								'time_20_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(							
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,							
								'time_2030_open' => 0,
								'time_21_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(							
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="19:00"){//////19:00
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="19:30"){//////19:30
						if($total_course_timeold<=60){
							
							$putsched=array(							
								'time_1930_open' => 0,
								'time_20_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(							
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="20:00"){//////20:00
						if($total_course_timeold<=60){
							
							$putsched=array(
								'time_20_open' => 0,
								'time_2030_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,							
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="20:30"){//////20:30
						if($total_course_timeold<=60){
							
							$putsched=array(							
								'time_2030_open' => 0,
								'time_21_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=120){
							
							$putsched=array(							
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
						}elseif($total_course_timeold<=180){
							
							$putsched=array(
								'time_2030_open' => 0,
								'time_21_open' => 0,							
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=240){
							
							$putsched=array(
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_timeold<=300){
							
							$putsched=array(
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($reschecktime=="21:00"){//////21:00
						$putsched=array(
							'time_21_open' => 0,
							'time_2130_open' => 0,
						);
						$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
					}elseif($reschecktime=="21:30"){//////21:30
						$putsched=array(
							'time_2130_open' => 0,
						);
						$query = DB::update('tblstaffsched')->where('staff_name', '=', $checkstaff)->and_where('sched_date', '=', $day)->set($putsched)->execute(); // saving to db
					}
				} //CHECK FREE STAFF FINISH
			///////////////////////UPDATE 予約編集 END/////////////////////////	
				
				
			}
			
			////////////////////ADD SERVICE COUNT/////////////////////
				if($svc_name_1 != "なし"){ //COUNT FOR MAIN
					$getcount = DB::select()->from('tblservice')->where('svc_name', $svc_name_1)->execute();
					foreach($getcount as $getcounts){
						$sel_getcount= $getcounts['count']; 
					}
					$datenow = date('d');
					if($datenow === "1"){
						$putcount=array(
							'count'=>1,
						);
						$query = DB::update('tblservice')
							->where('svc_name', '=', $svc_name_1)
							->set($putcount)
							->execute(); // saving to db
					}else{
						$sel_getcount = $sel_getcount + 1;
						$putcount=array(
							'count'=>$sel_getcount,
						);
						$query = DB::update('tblservice')
							->where('svc_name', '=', $svc_name_1)
							->set($putcount)
							->execute(); // saving to db
					}

				}			
				if($svc_name_2 != "なし"){ //COUNT FOR FACIAL
					$getcount = DB::select()->from('tblservicefacial')->where('svc_name', $svc_name_2)->execute();
					foreach($getcount as $getcounts){
						$sel_getcount= $getcounts['count']; 
					}
					$datenow = date('d');
					if($datenow === "1"){
						$putcount=array(
							'count'=>1,
						);
						$query = DB::update('tblservicefacial')
							->where('svc_name', '=', $svc_name_2)
							->set($putcount)
							->execute(); // saving to db
					}else{
						$sel_getcount = $sel_getcount + 1;
						$putcount=array(
							'count'=>$sel_getcount,
						);
						$query = DB::update('tblservicefacial')
							->where('svc_name', '=', $svc_name_2)
							->set($putcount)
							->execute(); // saving to db
					}

				}						
				if($opt_name != "なし"){ //COUNT FOR OPTION
					$getcount = DB::select()->from('tbloption')->where('opt_name', $opt_name)->execute();
					foreach($getcount as $getcounts){
						$sel_getcount= $getcounts['count']; 
					}
					$datenow = date('d');
					if($datenow === "1"){
						$putcount=array(
							'count'=>1,
						);
						$query = DB::update('tbloption')
							->where('opt_name', '=', $opt_name)
							->set($putcount)
							->execute(); // saving to db
					}else{
						$sel_getcount = $sel_getcount + 1;
						$putcount=array(
							'count'=>$sel_getcount,
						);
						$query = DB::update('tbloption')
							->where('opt_name', '=', $opt_name)
							->set($putcount)
							->execute(); // saving to db
					}

				}
				
		///////////////////////UPDATE STAFF SCHEDULE START////////////////////////
				if($staff_name=="指名なし"){ //START CHECK IF FREE STAFF
				
				}else{
					if($res_time=="10:00"){	
						if($total_course_time<=60){
							
							$putsched=array(
								'time_10_open' => 1,
								'time_1030_open' => 1,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_10_open' => 1,
								'time_1030_open' => 1,
								'time_11_open' => 1,
								'time_1130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_10_open' => 1,
								'time_1030_open' => 1,
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,	
								'time_1230_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_10_open' => 1,
								'time_1030_open' => 1,
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,	
								'time_1330_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_10_open' => 1,
								'time_1030_open' => 1,
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($res_time=="10:30"){//////10:30
						if($total_course_time<=60){
							
							$putsched=array(
								'time_1030_open' => 1,
								'time_11_open' => 1,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_1030_open' => 1,
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_1030_open' => 1,
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,	
								'time_13_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_1030_open' => 1,
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,	
								'time_14_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_1030_open' => 1,
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($res_time=="11:00"){//////11:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_11_open' => 1,
								'time_1130_open' => 1,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,	
								'time_1230_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,	
								'time_1330_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,	
								'time_1430_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_11_open' => 1,
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($res_time=="11:30"){//////11:30
						if($total_course_time<=60){
							
							$putsched=array(
								'time_1130_open' => 1,
								'time_12_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_1130_open' => 1,
								'time_12_open' => 1,	
								'time_1230_open' => 1,
								'time_13_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,	
								'time_1330_open' => 1,
								'time_14_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,	
								'time_1430_open' => 1,
								'time_15_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_1130_open' => 1,
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($res_time=="12:00"){//////12:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_12_open' => 1,
								'time_1230_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,	
								'time_1330_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,	
								'time_1430_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,	
								'time_1530_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_12_open' => 1,
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($res_time=="12:30"){//////12:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1230_open' => 1,
								'time_13_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1230_open' => 1,
								'time_13_open' => 1,	
								'time_1330_open' => 1,
								'time_14_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,	
								'time_1430_open' => 1,
								'time_15_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,	
								'time_1530_open' => 1,
								'time_16_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_1230_open' => 1,
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($res_time=="13:00"){//////13:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_13_open' => 1,
								'time_1330_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,	
								'time_1430_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,	
								'time_1530_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,	
								'time_1630_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_13_open' => 1,
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}

					}elseif($res_time=="13:30"){//////13:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1330_open' => 1,
								'time_14_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1330_open' => 1,
								'time_14_open' => 1,	
								'time_1430_open' => 1,
								'time_15_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,	
								'time_1530_open' => 1,
								'time_16_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,	
								'time_1630_open' => 1,
								'time_17_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(							
								'time_1330_open' => 1,
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}
					
					}elseif($res_time=="14:00"){//////14:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_14_open' => 1,
								'time_1430_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,	
								'time_1530_open' => 1,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,	
								'time_1630_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,	
								'time_1730_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_14_open' => 1,
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="14:30"){//////14:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1430_open' => 1,
								'time_15_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1430_open' => 1,
								'time_15_open' => 1,	
								'time_1530_open' => 1,
								'time_16_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,	
								'time_1630_open' => 1,
								'time_17_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,	
								'time_1730_open' => 1,
								'time_18_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(							
								'time_1430_open' => 1,
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="15:00"){//////15:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_15_open' => 1,
								'time_1530_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,	
								'time_1630_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,	
								'time_1830_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_15_open' => 1,
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($res_time=="15:30"){//////15:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1530_open' => 1,
								'time_16_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1530_open' => 1,
								'time_16_open' => 1,	
								'time_1630_open' => 1,
								'time_17_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,	
								'time_1830_open' => 1,
								'time_19_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(							
								'time_1530_open' => 1,
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($res_time=="16:00"){//////16:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_16_open' => 1,
								'time_1630_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,	
								'time_1730_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,	
								'time_1830_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,	
								'time_1930_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_16_open' => 1,
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="16:30"){//////16:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1630_open' => 1,
								'time_17_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1630_open' => 1,
								'time_17_open' => 1,	
								'time_1730_open' => 1,
								'time_18_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,	
								'time_1830_open' => 1,
								'time_19_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,	
								'time_1930_open' => 1,
								'time_20_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(							
								'time_1630_open' => 1,
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="17:00"){//////17:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_17_open' => 1,
								'time_1730_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,	
								'time_1830_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,	
								'time_1930_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,	
								'time_2030_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_17_open' => 1,
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="17:30"){//////17:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1730_open' => 1,
								'time_18_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1730_open' => 1,
								'time_18_open' => 1,	
								'time_1830_open' => 1,
								'time_19_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,	
								'time_1930_open' => 1,
								'time_20_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,	
								'time_2030_open' => 1,
								'time_21_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(							
								'time_1730_open' => 1,
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="18:00"){//////18:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_18_open' => 1,
								'time_1830_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,	
								'time_1930_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,							
								'time_2030_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,	
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_18_open' => 1,
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,
								'time_2130_open' => 1,
								'time_22_open' => 1,
								'time_2230_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="18:30"){//////18:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1830_open' => 1,
								'time_19_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1830_open' => 1,
								'time_19_open' => 1,	
								'time_1930_open' => 1,
								'time_20_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,							
								'time_2030_open' => 1,
								'time_21_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,	
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_1830_open' => 1,
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="19:00"){//////19:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_19_open' => 1,
								'time_1930_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,	
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,	
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="19:30"){//////19:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1930_open' => 1,
								'time_20_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,	
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,	
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_19_open' => 1,
								'time_1930_open' => 1,
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="20:00"){//////20:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_20_open' => 1,
								'time_2030_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,							
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,	
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_20_open' => 1,
								'time_2030_open' => 1,
								'time_21_open' => 1,
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="20:30"){//////20:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_2030_open' => 1,
								'time_21_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_2030_open' => 1,
								'time_21_open' => 1,
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_2030_open' => 1,
								'time_21_open' => 1,							
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_2030_open' => 1,
								'time_21_open' => 1,	
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_2030_open' => 1,
								'time_21_open' => 1,
								'time_2130_open' => 1,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="21:00"){//////21:00
						$putsched=array(
							'time_21_open' => 1,
							'time_2130_open' => 1,
						);
						$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
					}elseif($res_time=="21:30"){//////21:30
						$putsched=array(
							'time_2130_open' => 1,
						);
						$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
					}
				} //CHECK FREE STAFF FINISH
			///////////////////////UPDATE STAFF SCHEDULE END/////////////////////////
				
			}
			
			//データベース接続 メール送信 予約
			 $query = DB::select()->from('tblmail');
			 $result = $query->execute();
			 $tblmail = $result;
			 foreach($result as $tblmail);
			 
	 
			 $query = DB::select()->from('tblmailtype')
			 ->where('type','=','予約');
			 $result = $query->execute();
			 $tblmailtype = $result;
			 foreach($result as $tblmailtype);
			 
			 mb_language("ja");

			 mb_internal_encoding("utf8");

			 $mailto = $email;
			 $subject = $tblmailtype['title'];
			 $mailbody = 
			 $name ." 様"."\n"."\n".
			 $tblmailtype['header']."\n"."\n".
			 "次回のご予約の件ですが"."\n"."\n".
			 $res_date=date("Y-m-d",strtotime($res_date))." ".
			 $res_time=Session::get('restime')."～"."\n"."\n".
			 "でご予約いただいております"."\n"."\n".
			 $tblmailtype['body']."\n"."\n".$tblmailtype['footer']."\n"."\n".$tblmail['signature'];

			 $mailfrom="From:" .$tblmail['mail_add'];
			 mb_send_mail($mailto,$subject,$mailbody,$mailfrom);
					
			
			$view->content=View::forge('admin/admin_reserve_finished');
			$view->set('resno',$res_no);
			$view->set('name',$name);	
			return $view;
		}
	}
	//////////////////////////////////////////////////////////////////////

	public function action_deletereserve()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$resno = Input::post('resno');
			Session::set('resno',$resno);
				
				////	予約編集のデータ	//////
				$rescheck = array();
				$reserveday = DB::select()->from('tblreserve')->where('res_no','=',$resno)->execute();
				foreach($reserveday as $reday):
					$checkresnumber = ($reday['res_no']);
					$rescheck = ($reday['res_date']);
					$reschecktime = ($reday['res_time']);
					Session::set('checkresnumber',$checkresnumber);
					Session::set('rescheck',$rescheck);
					Session::set('reschecktime',$reschecktime);
				endforeach;
				////	予約編集のデータ	//////
				
			 $view = View::forge('admin/admin_deletereserve');
			 $view->set('resno',$resno);
			 return $view;
		}
	}
	
	public function action_deletereserve_finished()
    {
	if ( ! Auth::check())//ログインされなかったら
	{
		Response::redirect_back('admin/admin_login', 'refresh');
	}else{//ログインされている場合
			$resno = Session::get('resno');
			
			 $auth = Auth::instance();
			 $p_post = Input::post('freemessage');
			// $created_at = date("Y-m-d H:i:s");
			 $resno = Session::get('resno');
			 
			 $staffname = Session::get('staff');//スタッフ名
			 $course1 = Session::get('course1');
			 $course2 = Session::get('course2');
			 $option = Session::get('option');
			
			////////////////////SUBTRACT SERVICE COUNT/////////////////////
			
				if($course1 != "なし"){ //COUNT FOR MAIN
					$getcount = DB::select()->from('tblservice')->where('svc_name', $course1)->execute();
					foreach($getcount as $getcounts){
						$sel_getcount= $getcounts['count']; 
						if($sel_getcount != "0"){
						$sel_getcount = $sel_getcount - 1;
						$putcount=array(
							'count'=>$sel_getcount,
						);
						$query = DB::update('tblservice')
							->where('svc_name', '=', $course1)
							->set($putcount)
							->execute(); // saving to db
					}
					}
					//$datenow = date('d');
					

				}
				
				if($course2 != "なし"){ //COUNT FOR MAIN
					$getcount = DB::select()->from('tblservicefacial')->where('svc_name', $course2)->execute();
					foreach($getcount as $getcounts){
						$sel_getcount= $getcounts['count']; 
						if($sel_getcount != "0"){
						$sel_getcount = $sel_getcount - 1;
						$putcount=array(
							'count'=>$sel_getcount,
						);
						$query = DB::update('tblservicefacial')
							->where('svc_name', '=', $course2)
							->set($putcount)
							->execute(); // saving to db
					}
					}
					//$datenow = date('d');
					

				}

				if($option != "なし"){ //COUNT FOR MAIN
					$getcount = DB::select()->from('tbloption')->where('opt_name', $option)->execute();
					foreach($getcount as $getcounts){
						$sel_getcount= $getcounts['count']; 
						if($sel_getcount != "0"){
						$sel_getcount = $sel_getcount - 1;
						$putcount=array(
							'count'=>$sel_getcount,
						);
						$query = DB::update('tbloption')
							->where('opt_name', '=', $option)
							->set($putcount)
							->execute(); // saving to db
					}
					}
					//$datenow = date('d');
					

				}			
			
			///////////////////////////////////////////////////////////////
			
			///////////////////////コース時間計算/////////////////////////////////
			$svc1 = 0;
			$svc2 = 0;
			if($course1 === ""){
				$svc1 = 0;
			}else{
			 $cou1 = DB::select('svc_time')->from('tblservice')
				->where('svc_name',$course1)
				->execute();
			foreach($cou1 as $co1):
				Session::set('time1',$co1['svc_time']);
				$svc1 = Session::get('time1');		//コース１の時間
			endforeach;
			}
			
			if($course2 === ""){
				$svc2 = 0;
			}else{
			 $cou2 = DB::select('svc_time')->from('tblservicefacial')
				->where('svc_name',$course2)
				->execute();
			foreach($cou2 as $co2):
				Session::set('time2',$co2['svc_time']);
				$svc2 = Session::get('time2');		//コース２の時間
			endforeach;
			}
			

			$totaltime = $svc1 + $svc2 + 30 ;		//コース１とコース２を足した（予約時間）
			/////////////////////////コース時間計算/////////////////////////////////
			
			//////////////////////////スタッフキャンセル///////////////////////////////////
			$resdata = DB::select()->from('tblreserve')
				->where('res_no',$resno)
				->execute();
			foreach($resdata as $data):
				$staff = $data['staff_name'];
				$date = $data['res_date'];
				$time = date('H',strtotime($data['res_time']));
			 endforeach;
			$res_time = date('H:i',strtotime($data['res_time']));
			$staff_name = $staff;
			$total_course_time = $totaltime;
			$res_date = $date;
			
		///////////////////////UPDATE STAFF CANCEL START/////////////////////////
				if($staff_name=="指名なし"){ //START CHECK IF FREE STAFF
					
				}else{
					if($res_time=="10:00"){	
						if($total_course_time<=60){
							
							$putsched=array(
								'time_10_open' => 0,
								'time_1030_open' => 0,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_10_open' => 0,
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_10_open' => 0,
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,	
								'time_1230_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_10_open' => 0,
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,	
								'time_1330_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_10_open' => 0,
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($res_time=="10:30"){//////10:30
						if($total_course_time<=60){
							
							$putsched=array(
								'time_1030_open' => 0,
								'time_11_open' => 0,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,	
								'time_13_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,	
								'time_14_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_1030_open' => 0,
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($res_time=="11:00"){//////11:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_11_open' => 0,
								'time_1130_open' => 0,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,	
								'time_1230_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,	
								'time_1330_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_11_open' => 0,
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($res_time=="11:30"){//////11:30
						if($total_course_time<=60){
							
							$putsched=array(
								'time_1130_open' => 0,
								'time_12_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_1130_open' => 0,
								'time_12_open' => 0,	
								'time_1230_open' => 0,
								'time_13_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,	
								'time_1330_open' => 0,
								'time_14_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
								'time_15_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_1130_open' => 0,
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($res_time=="12:00"){//////12:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_12_open' => 0,
								'time_1230_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,	
								'time_1330_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_12_open' => 0,
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($res_time=="12:30"){//////12:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1230_open' => 0,
								'time_13_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1230_open' => 0,
								'time_13_open' => 0,	
								'time_1330_open' => 0,
								'time_14_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
								'time_15_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,
								'time_16_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_1230_open' => 0,
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}
						
					}elseif($res_time=="13:00"){//////13:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_13_open' => 0,
								'time_1330_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_13_open' => 0,
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}

					}elseif($res_time=="13:30"){//////13:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1330_open' => 0,
								'time_14_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1330_open' => 0,
								'time_14_open' => 0,	
								'time_1430_open' => 0,
								'time_15_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,
								'time_16_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
								'time_17_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(							
								'time_1330_open' => 0,
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}
					
					}elseif($res_time=="14:00"){//////14:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_14_open' => 0,
								'time_1430_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,							
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,	
								'time_1730_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_14_open' => 0,
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="14:30"){//////14:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1430_open' => 0,
								'time_15_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1430_open' => 0,
								'time_15_open' => 0,	
								'time_1530_open' => 0,
								'time_16_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
								'time_17_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,	
								'time_1730_open' => 0,
								'time_18_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(							
								'time_1430_open' => 0,
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="15:00"){//////15:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_15_open' => 0,
								'time_1530_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_15_open' => 0,
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($res_time=="15:30"){//////15:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1530_open' => 0,
								'time_16_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1530_open' => 0,
								'time_16_open' => 0,	
								'time_1630_open' => 0,
								'time_17_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
								'time_19_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(							
								'time_1530_open' => 0,
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}				
					
					}elseif($res_time=="16:00"){//////16:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_16_open' => 0,
								'time_1630_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,	
								'time_1730_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_16_open' => 0,
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="16:30"){//////16:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1630_open' => 0,
								'time_17_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1630_open' => 0,
								'time_17_open' => 0,	
								'time_1730_open' => 0,
								'time_18_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
								'time_19_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
								'time_20_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(							
								'time_1630_open' => 0,
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="17:00"){//////17:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_17_open' => 0,
								'time_1730_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,	
								'time_2030_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_17_open' => 0,
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="17:30"){//////17:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1730_open' => 0,
								'time_18_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1730_open' => 0,
								'time_18_open' => 0,	
								'time_1830_open' => 0,
								'time_19_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
								'time_20_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,	
								'time_2030_open' => 0,
								'time_21_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(							
								'time_1730_open' => 0,
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="18:00"){//////18:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_18_open' => 0,
								'time_1830_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,							
								'time_2030_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_18_open' => 0,
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
								'time_22_open' => 0,
								'time_2230_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="18:30"){//////18:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1830_open' => 0,
								'time_19_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_1830_open' => 0,
								'time_19_open' => 0,	
								'time_1930_open' => 0,
								'time_20_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,							
								'time_2030_open' => 0,
								'time_21_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(							
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_1830_open' => 0,
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="19:00"){//////19:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="19:30"){//////19:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_1930_open' => 0,
								'time_20_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(							
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_19_open' => 0,
								'time_1930_open' => 0,
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="20:00"){//////20:00
						if($total_course_time<=60){
							
							$putsched=array(
								'time_20_open' => 0,
								'time_2030_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,							
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_20_open' => 0,
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="20:30"){//////20:30
						if($total_course_time<=60){
							
							$putsched=array(							
								'time_2030_open' => 0,
								'time_21_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=120){
							
							$putsched=array(							
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
						}elseif($total_course_time<=180){
							
							$putsched=array(
								'time_2030_open' => 0,
								'time_21_open' => 0,							
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=240){
							
							$putsched=array(
								'time_2030_open' => 0,
								'time_21_open' => 0,	
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}elseif($total_course_time<=300){
							
							$putsched=array(
								'time_2030_open' => 0,
								'time_21_open' => 0,
								'time_2130_open' => 0,
							);
							$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db						
						}					
					
					}elseif($res_time=="21:00"){//////21:00
						$putsched=array(
							'time_21_open' => 0,
							'time_2130_open' => 0,
						);
						$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
					}elseif($res_time=="21:30"){//////21:30
						$putsched=array(
							'time_2130_open' => 0,
						);
						$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
					}
				} //CHECK FREE STAFF FINISH
		///////////////////////UPDATE STAFF SCHEDULE END/////////////////////////
		
		//////////////////////////スタッフキャンセル//////////////////////////////////
			
			
			$query = DB::update('tblreserve');
			$query->set(array('del_flag' => '1'));
			$query->where('res_no',$resno);
			$query->execute();
			
			
			
			
			
			/****end of from rie**/

			 
			 //======================================================================================//
			
			
			
			
			 $view = View::forge('admin/admin_deletereserve_finished');
			 
			 return $view;
		}
	}
/********** End of　予約管理ページ *********************************************/

/********** 従業員情報管理ページ *********************************************/
	public function action_staffinfo() //スタッフ情報一覧
	{
		if ( ! Auth::check() or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			
			SessionDeleter::resSession_delete(); //予約管理ページのセッションを削除する
			$branch =Session::get('admin_branch');
			$staffs = array();
			//$staffs['rows']= Model_Staff::find_by();
			$txt = Input::post('txtcusvalue');
			
			
			 $result = DB::select()->from('tblstaff')
				->where_open()
				->where('staff_name','!=','指名なし')
				->and_where('del_flag','=','0')
				->and_where('branch_id',$branch)
				->where_close()
				->execute();
		
		
			$view = View::forge('admin/admin_staff_info',$staffs);
			$view->set_global('rows',$result->as_array());
			return $view;
			
		}
	}
	
	public function action_staffsched()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$button = Input::post('selectday');
			Session::set('button',$button);
			$name = Input::post('staffname');
			Session::set('name',$name);	
			$schedday = Input::post('datepicker');
			Session::set('schedday',$schedday);
			
			if($button === 'スタッフシフト一覧')
			{
				$today = date('Y-m-d');
				$code = "スタッフ名";
				Session::set('code',$code);
				$staffsched = DB::select()
					->from('tblstaffsched')
					->where('sched_date',$today)
					->execute();
				$year = date('Y',strtotime($today));
				Session::set('year',$year);
				$month = date('m',strtotime($today));
				Session::set('month',$month);
				$day = date('d',strtotime($today));
				Session::set('day',$day);
			}
			if($button === '日づけ検索')
			{
				$code = "日づけ";
				Session::set('code',$code);
				$staffsched = DB::select()
					->from('tblstaffsched')
					->where('sched_date',$schedday)
					->execute();
				$year = date('Y',strtotime($schedday));
				Session::set('year',$year);
				$month = date('m',strtotime($schedday));
				Session::set('month',$month);
				$day = date('d',strtotime($schedday));
				Session::set('day',$day);
			}
			if($button === '名前検索')
			{
				$code = "スタッフ名";
				Session::set('code',$code);
				$staffsched = DB::select()->from('tblstaffsched')->where('staff_name',$name)->order_by('sched_date')->execute();
			} 
			
			$view = View::forge('admin/admin_staffsched');
			$view->set_global('rows',$staffsched->as_array());
			$view->set('code',$code);
			return $view;
		}
	}
	
	public function action_staffsched_edit()//スタッフのシフトの編集
	{
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$name = Session::get('stafflist');
			$view = View::forge('admin/admin_staffsched_edit');
			$view->set('name',$name);
			return $view;
		}
	}
	
	public function action_staffsched_edit_confirm()
	{
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったらまたはアドミンではなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$name = Session::get('stafflist');
			$day = Input::post('datepicker');
			//$created_at = date("Y-m-d");
			$time_10 = Input::post('time_10');//Session::get('time_10');
			$time_11 = Input::post('time_11');//Session::get('time_11');
			$time_12 = Input::post('time_12');//Session::get('time_12');
			$time_13 = Input::post('time_13');//Session::get('time_13');
			$time_14 = Input::post('time_14');//Session::get('time_14');
			$time_15 = Input::post('time_15');//Session::get('time_15');
			$time_16 = Input::post('time_16');//Session::get('time_16');
			$time_17 = Input::post('time_17');//Session::get('time_17');
			$time_18 = Input::post('time_18');//Session::get('time_18');
			$time_19 = Input::post('time_19');//Session::get('time_19');
			$time_20 = Input::post('time_20');//Session::get('time_20');
			$time_21 = Input::post('time_21');//Session::get('time_21');

			$sched = DB::select()->from('tblstaffsched')->where('staff_name',$name)->execute()->as_array();

			
			$view = View::forge('admin/admin_staffsched_edit_confirm');
			$view->set('name',$name);
			$view->set('day',$day);
			$view->set('time_10',$time_10);
			$view->set('time_11',$time_11);
			$view->set('time_12',$time_12);
			$view->set('time_13',$time_13);
			$view->set('time_14',$time_14);
			$view->set('time_15',$time_15);
			$view->set('time_16',$time_16);
			$view->set('time_17',$time_17);
			$view->set('time_18',$time_18);
			$view->set('time_19',$time_19);
			$view->set('time_20',$time_20);
			$view->set('time_21',$time_21);
			return $view;
		}
	}
	
	public function action_staffsched_edit_finished()
	{
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$name = Session::get('stafflist');
			$day = Session::get('day');
			$created_at = date("Y-m-d");
			$time_10 = Session::get('time_10');
			$time_11 = Session::get('time_11');
			
			$time_12 = Session::get('time_12');
			$time_13 = Session::get('time_13');
			$time_14 = Session::get('time_14');
			$time_15 = Session::get('time_15');
			$time_16 = Session::get('time_16');
			$time_17 = Session::get('time_17');
			$time_18 = Session::get('time_18');
			$time_19 = Session::get('time_19');
			$time_20 = Session::get('time_20');
			$time_21 = Session::get('time_21');
			

				$branch = Session::get('admin_branch');
				$sonzai=DB::select()->from('tblstaffsched')
					->where_open()
					->where('staff_name',$name)
					->and_where('sched_date',$day)
					->and_where('branch_id', $branch)
					->where_close()
					->execute();
					
					if(count($sonzai)>0){
											
						$putsched=array(
							'time_10'=>$time_10,
							'time_1030'=>$time_10,
							'time_11'=>$time_11,
							'time_1130'=>$time_11,
							'time_12'=>$time_12,
							'time_1230'=>$time_12,
							'time_13'=>$time_13,
							'time_1330'=>$time_13,
							'time_14'=>$time_14,
							'time_1430'=>$time_14,
							'time_15'=>$time_15,
							'time_1530'=>$time_15,
							'time_16'=>$time_16,
							'time_1630'=>$time_16,
							'time_17'=>$time_17,
							'time_1730'=>$time_17,
							'time_18'=>$time_18,
							'time_1830'=>$time_18,
							'time_19'=>$time_19,
							'time_1930'=>$time_19,
							'time_20'=>$time_20,
							'time_2030'=>$time_20,
							'time_21'=>$time_21,
							'time_2130'=>$time_21,
							'branch_id'=>$branch,
						);
						$query = DB::update('tblstaffsched')
							->where('staff_name', $name)
							->and_where('sched_date',$day)
							->and_where('branch_id',$branch)
							->set($putsched)
							->execute(); // saving to db					
					}else{
						
						$putsched=array(
							'staff_name'=>$name,
							'sched_date'=>$day,
							'time_10'=>$time_10,
							'time_1030'=>$time_10,
							'time_11'=>$time_11,
							'time_1130'=>$time_11,
							'time_12'=>$time_12,
							'time_1230'=>$time_12,
							'time_13'=>$time_13,
							'time_1330'=>$time_13,
							'time_14'=>$time_14,
							'time_1430'=>$time_14,
							'time_15'=>$time_15,
							'time_1530'=>$time_15,
							'time_16'=>$time_16,
							'time_1630'=>$time_16,
							'time_17'=>$time_17,
							'time_1730'=>$time_17,
							'time_18'=>$time_18,
							'time_1830'=>$time_18,
							'time_19'=>$time_19,
							'time_1930'=>$time_19,
							'time_20'=>$time_20,
							'time_2030'=>$time_20,
							'time_21'=>$time_21,
							'time_2130'=>$time_21,
							'branch_id'=>$branch,
						);
						$query = DB::insert('tblstaffsched')
							->set($putsched)
							->execute(); // saving to db						
						
					}
			
			
			$view = View::forge('admin/admin_staffsched_edit_finished');
			return $view;
		}
	}
	
	/* change pass Admin */
	
	public function action_changepassword()
    {
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			if ( ! Auth::check())
			{
				$view = View::forge('admin/admin_top');			
			}else{	
			$auth = Auth::instance();
			$name = Auth::get_profile_fields('name');
			$data = array();
			$data['rows']= Model_User::find_by('email',Auth::get_email());
					
			
			$user=Model_User::forge();
			
			$user_form=Fieldset::forge('user_form');
			$user_form->add_model($user)->populate($user);
			$user_form=Fieldset::instance('user_form');
			$user_form->add('oldloginpw','oldloginpw',array('type'=>'password'));
			$user_form->field('oldloginpw');
			$user_form->add('loginpw','loginpw',array('type'=>'password'));
			$user_form->field('loginpw');
			$user_form->add('loginpw_chk','loginpw_chk',array('type'=>'password'));
			$user_form->field('loginpw_chk');
			$this->user_form=$user_form;
			
			
			
			
			$val = Validation::forge();
			$val->add('oldloginpw', '現在のパスワード',array('type'=>'password'))
				->add_rule('required')
				->add_rule('min_length', '4')
				->add_rule('max_length', '20');
				
			$val->add('loginpw', '新しいパスワード',array('type'=>'password'))
				->add_rule('required')
				->add_rule('min_length', '4')
				->add_rule('max_length', '20');
			$val->add('loginpw_chk', '新しいパスワード再入力', array('type' => 'password'))
				->add_rule('required')
				->add_rule('match_value', Input::post('loginpw'));		
			

			$oldpassword_input = Input::post('oldloginpw');
			$newpass_input = Input::post('loginpw');
			
			//Session::create();
			Session::set('oldloginpw', $oldpassword_input);
			Session::set('loginpw', $newpass_input);	
		

				 $view = View::forge('admin/admin_changepassword');
				 $view->set('name',$name);
				 }
		return $view;
			
		}
	}	
	
	public function action_passwordchange_finished($values=null)
	{

		if ( ! Auth::check()or (Auth::member(50)))
		{
			$view = View::forge('admin/admin_top');			
		}else{
		$auth = Auth::instance();
		
				//Validate password
			if (Input::post()) {
				$username = Session::get('username');
				
				$name = Auth::get_profile_fields('name');
			

				   if ($auth->validate_user($username,  Input::post('oldloginpw')))//if password is correct
				   {
						if(input::post('loginpw_chk')!=input::post('loginpw')){
							Session::set_flash('mismatch','入力されたパスワードが一致しません。');
							Response::redirect_back('admin/admin_staff_info', 'refresh');
							
						}else{
							$user=Auth::change_password(Input::post('oldloginpw'),Input::post('loginpw'));

							Session::set_flash('invalid_password','　');
							Session::set_flash('mismatch','　');

							
							$view = View::forge('admin/admin_changepassword_finished');
							$view->set('name',$name);
							return $view;
						}
					
					}else{
						Session::set_flash('invalid_password','パスワードが違います。');
						Response::redirect_back('admin/admin_staff_info', 'refresh');
						
					}

					
			}
		}
	}
			 
	public function action_search_staffinfo() //スタッフ情報検索結果
	{
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$txt = Input::post('txtstaffvalue');
			$staff = Input::post('staff');
			$branch= Session::get('admin_branch');
			
			
			 $search = array();
			  
		
			if($staff === 'スタッフ番号'){
				//$search['rows']= Model_Staff::find_by('staff_no',$txt);
			
				$result = DB::select()->from('tblstaff')
				->where_open()
				->where('staff_no','=',$txt)
				->and_where('branch_id',$branch)
				->and_where('del_flag','=',0)
				->where_close()
				->execute();
		

			}else if($staff === 'スタッフ名'){
				//$search['rows']= Model_Staff::find_by('staff_name','%'.$txt.'%','like');
				
				$result = DB::select()->from('tblstaff')
					->where_open()
					->where('staff_name','=',$txt)
					->and_where('del_flag','=',0)
					->and_where('branch_id',$branch)
					->where_close()
					->execute();
				
			}
		
			$view = View::forge('admin/admin_staff_info_search',$search);
			$view->set_global('rows',$result->as_array());
			$view->set('staff',$staff);
			return $view;
			
		}
	}
	public function action_addnewstaff_confirm()
    {
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			Session::create();
			$staffno = Input::post('staff_no');
			$staffname = Input::post('staff_name');
			$sex = Input::post('staff_sex');
			$birthy = Input::post('staff_birthy');
			$birthm = Input::post('staff_birthm');
			$birthd = Input::post('staff_birthd');
			$selfintro = Input::post('staff_intro');
			$rate = Input::post('staff_rate');
			
			if($sex === '1'){
				$sex = '男';
			}else if($sex === '2'){
				$sex = '女';
			}else{
				$sex = null;
			}
	 
			
			Session::set('staffno',$staffno);
			Session::set('staff',$staffname);
			Session::set('sex',$sex);
			Session::set('birthy',$birthy);
			Session::set('birthm',$birthm);
			Session::set('birthd',$birthd);
			Session::set('selfintro',$selfintro);
			Session::set('rate',$rate);

			$view = View::forge('admin/admin_addnewstaff_confirm');
			$view ->set('staff_no',$staffno);
			$view ->set('name',$staffname);
			$view ->set('sex',$sex);
			$view ->set('birthy',$birthy);
			$view ->set('birthm',$birthm);
			$view ->set('birthd',$birthd);
			$view ->set('selfintro',$selfintro);
			$view ->set('rate',$rate);
			
			 
			 return $view;
		} 
	}
	
	public function action_addstaffpic()
	{
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$view = View::forge('admin/admin_staffpic');
			 return $view;
		}
	}
	public function action_addnewstaff_finished()
    {
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
				//新規登録機能用	
			$branch = Session::get('admin_branch');

			$staffadd = array();
			$staffadd = Model_Staff::forge();
			$staffno = Session::get('staffno');
			$name = Session::get('staff');
			$sex = Session::get('sex');
			$birthy = Session::get('birthy');
			$birthm = Session::get('birthm');
			$birthd = Session::get('birthd');
			$selfintro = Session::get('selfintro');
			$rate = Session::get('rate');
			
			
			$data = array(
			'staff_no' =>$staffno,
			'staff_name' => $name,
			'sex' => $sex,
			'birthy' => $birthy,
			'birthm' => $birthm,
			'birthd' => $birthd,
			'introduce' =>$selfintro,
			'hour_rate' =>$rate,
			'branch_id' =>$branch,

			);
			$staffadd -> set($data);
			
			if(!$staffadd -> save()){
				
			}else{
				
			}  
			 $view = View::forge('admin/admin_addnewstaff_finished');
			 return $view;
		}
	}
	public function action_editstaff() //スタッフ情報編集
	{
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$staffno = Session::get('staffno');
			$name = Session::get('staff_name');
			$age = Session::get('age');
			$birthy = Session::get('birthy');
			$birthm = Session::get('birthm');
			$birthd = Session::get('birthd'); 
			$sex = Session::get('sex');
			
			$data = array();
			$sg = Session::get('stafflist');
			$data['rows']= Model_Staff::find_by('staff_name',$sg);
			$view = View::forge('admin/admin_editstaff',$data);
			$view->set('sex',$sex);
			return $view;
		}
	}
	public function action_editstaff_confirm() //スタッフ情報編集確認画面
	{
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
		
			$staff_name = Input::post('staff_name');
			$staff_sex = Input::post('sex');
		
			$branch = Session::get('admin_branch');
			if($branch ==='1'){
				$code = 'BGK';
			}else if ($branch ==='2'){
				$code = 'BGI';
			}
			$staffno = Input::post('staff_no');
			
			Session::set('staffno',$staffno);
			Session::set('staff_name',$staff_name);
			Session::set('sex',$staff_sex);
			Session::set('birthy',Input::post('staff_birthy'));
			Session::set('birthm',Input::post('staff_birthm'));
			Session::set('birthd',Input::post('staff_birthd'));
			Session::set('selfintro',Input::post('staff_intro'));
			Session::set('rate',Input::post('rate'));
			
			$birthy = Session::get('birthy');
			$birthm = Session::get('birthm');
			$birthd = Session::get('birthd');
			$selfintro = Session::get('selfintro');
			$rate = Session::get('rate');
			
			$view = View::forge('admin/admin_editstaff_confirm');
			$view ->set('staff_no',$code.$staffno);
			$view ->set('staff_name',$staff_name);
			$view ->set('sex',$staff_sex);
			$view ->set('birthy',$birthy);
			$view ->set('birthm',$birthm);
			$view ->set('birthd',$birthd);
			$view ->set('selfintro',$selfintro);
			$view ->set('rate',$rate);
			return $view;
		}
	}
	public function action_editstaff_finished() //スタッフ編集完了画面
	{
	
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			
			 $staffs = Session::get('stafflist');
		
	
			 $staffno = Session::get('staffno');
			 $staffname =Session::get('staff_name');
			 $sex = Session::get('sex');
			 $birthy = Session::get('birthy');
			 $birthm = Session::get('birthm');
			 $birthd = Session::get('birthd');
			 $intro = Session::get('selfintro');
			 $rate = Session::get('rate');
			 
			 
			 $query = DB::update('tblstaff');
			 $query->set(array('staff_no' => $staffno,'staff_name' => $staffname,'sex' => $sex,'birthy' => $birthy,'birthm' => $birthm,'birthd' => $birthd,'introduce' =>$intro, 'hour_rate' =>$rate));
			 $query->where('staff_name',$staffs);
			 $query->execute();
			$view = View::forge('admin/admin_editstaff_finished');
			return $view;
		}
	}
	
	public function action_deletestaff() //スタッフ削除
	{
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$staffs = Session::get('stafflist');
			
			$view = View::forge('admin/admin_deletestaff');
			$view->set('name',$staffs);
			return $view;
		}
	}
	public function action_deletestaff_finished() //スタッフ削除完了ページ
	{
		if ( ! Auth::check()or (Auth::member(50)))//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$branch = Session::get('admin_branch');
			$name = Session::get('stafflist');
			$query = DB::update('tblstaff');
			$query ->value('del_flag','1');
			$query ->where('staff_name', '=', $name);
			
			$result = $query->execute();

			$view = View::forge('admin/admin_deletestaff_finished');
			return $view;
		}
	}
/********** End of　従業員情報管理ページ *********************************************/

/********** メニュー管理ページ *********************************************/
	public function action_menu_facialinfo()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$branch = Session::get('admin_branch');
			$facial = Input::post('menu');
		
			$result = DB::select()->from('tblservicefacial')
				->where_open()
				->where('svc_name','=',$facial)
				->and_where('branch_id', $branch)
				->where_close()
				->execute();
			$view = View::forge('admin/admin_menudetails');
			$view->set_global('menu',$result->as_array());
			$view->set('svc_name',$facial);
			$view->set('category','facial');
			
			return $view;
		}
	}
	
	public function action_menu_optioninfo()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$option = Input::post('menu');
			$branch = Session::get('admin_branch');
			
			$result = DB::select()->from('tbloption')
				->where_open()
				->where('opt_name','=',$option)
				->and_where('branch_id', $branch)
				->where_close()
				->execute();
				
				
			$view = View::forge('admin/admin_menudetails');
			$view->set_global('menu',$result->as_array());
			
			$view->set('category','option');
			$view->set('svc_name',$option);
			
			return $view;
		}
	}
	
	public function action_menuinfo()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合	
			SessionDeleter::resSession_delete(); //予約管理ページのセッションを削除する
			$branch = Session::get('admin_branch');
			
			$result = DB::select()->from('tblservice')
				->where_open()
				->where('svc_name','!=','なし')
				->and_where('branch_id', $branch)
				->where_close()
				->execute();
		
			$facial = DB::select()->from('tblservicefacial')
				->where_open()
				->where('svc_name','!=','なし')
				->and_where('branch_id', $branch)
				->where_close()
				->execute();
			
			$option = DB::select()->from('tbloption')
				->where_open()
				->where('opt_name','!=','なし')
				->and_where('branch_id', $branch)
				->where_close()
				->execute();
			$p_post = Input::post('txtcusvalue');

			$view = View::forge('admin/admin_menu_info');
			$view->set_global('rows',$result->as_array());
			$view->set_global('facialrows',$facial->as_array());
			$view->set_global('optionrows',$option->as_array());
			return $view;
			
		}
	}
	
	public function action_search_menu()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$p_post = Input::post('txtcusvalue');
			$menu = Input::post('bt_form_menuinfo');
			$branch = Session::get('admin_branch');
			
			$search = array();
		
				if($menu === 'サービス名(コース)'){
				
				$search = DB::select()->from('tblservice')
					->where_open()
					->where('svc_name',$p_post)
					->and_where('branch_id', $branch)
					->where_close()
					->execute();
					
					$cat = 'course';
				}
				if($menu === 'サービス名(フェイシャル)'){
					
					$search = DB::select()->from('tblservicefacial')
					->where_open()
					->where('svc_name',$p_post)
					->and_where('branch_id', $branch)
					->where_close()
					->execute();
					$cat = 'facial';
				}
				if($menu === 'サービス名(オプション)'){
					
					$search = DB::select()->from('tbloption')
					->where_open()
					->where('opt_name',$p_post)
					->and_where('branch_id', $branch)
					->where_close()
					->execute();
					
					$cat = 'option';
				}
				
				if($menu === '基本価格(コース)'){
					$search = DB::select()->from('tblservice')
					->where_open()
					->where('svc_price_regular',$p_post)
					->and_where('branch_id', $branch)
					->where_close()
					->execute();
					$cat = 'course';
				}
				if($menu === '基本価格(フェイシャル)'){
					$search = DB::select()->from('tblservicefacial')
						->where_open()
						->where('svc_price_regular',$p_post)
						->and_where('branch_id', $branch)
						->where_close()
						->execute();
					$cat = 'facial';
				}
				if($menu === '基本価格(オプション)'){
					$search = DB::select()->from('tbloption')
					->where_open()
					->where('opt_price_regular',$p_post)
					->and_where('branch_id', $branch)
					->where_close()
					->execute();
					$cat = 'option';
				}
				
			
			$view = View::forge('admin/admin_menu_info_search');
			$view->set_global('rows',$search->as_array());
			$view ->set('category',$cat);
			return $view;
			

		}	
	}
	public function action_addnewmenu_confirm()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			Session::create();
			
			$category = Input::post('menu');
			
			$servicename = Input::post('servicename');
			$servicecontent = Input::post('service_content');
			$servicetime = Input::post('service_timespan');
			$serviceprice = Input::post('service_price');
			$servicepricemem = Input::post('service_price_mem');
			$servicepricecont = Input::post('service_price_cont');
			
			Session::set('category',$category);
			Session::set('servicename',$servicename);
			Session::set('servicecontent',$servicecontent);
			Session::set('serviceprice',$serviceprice);
			Session::set('servicetime',$servicetime);
			Session::set('servicepricemem',$servicepricemem);
			Session::set('servicepricecont',$servicepricecont);
			
			$view = View::forge('admin/admin_addnewmenu_confirm');
			
			$view->set('servicename',$servicename);
			$view->set('servicecontent',$servicecontent);
			$view->set('serviceprice',$serviceprice);
			$view->set('servicetime',$servicetime);
			$view->set('servicepricemem',$servicepricemem);
			$view->set('servicepricecont',$servicepricecont);
			
			return $view;
		}
	}
	public function action_addnewmenu_finished()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$cat = Session::get('category');
			
			$serviceadd = array();
			$serviceadd = Model_Service::forge();
			
			$servicename = Session::get('servicename');
			$servicecontent = Session::get('servicecontent');
			$servicetime = Session::get('servicetime');
			$serviceprice = Session::get('serviceprice');
			$servicepricemem = Session::get('servicepricemem');
			$servicepricecont = Session::get('servicepricecont');
			
			$branch = Session::get('admin_branch');
			
			if ($cat === 'コース')
			{
				
				$serviceadd = array();
				$serviceadd = Model_Service::forge();
				
					$data = array(
					'svc_name' => $servicename ,
					'svc_contents' => $servicecontent ,
					'svc_time' => $servicetime,
					'svc_price_regular' => $serviceprice ,
					'svc_price_member' => $servicepricemem ,
					'svc_price_cont' => $servicepricecont ,
					'branch_id' => $branch,
					);
					
				$serviceadd -> set($data);
				$serviceadd -> save();
				
			
			}
			if ($cat === 'フェイシャル')
			{
				$serviceadd = array();
				$serviceadd = Model_Facial::forge();
				
					$data = array(
					'svc_name' => $servicename ,
					'svc_contents' => $servicecontent ,
					'svc_time' => $servicetime,
					'svc_price_regular' => $serviceprice ,
					'svc_price_member' => $servicepricemem ,
					'svc_price_cont' => $servicepricecont ,
					'branch_id' => $branch,
					);
					
				$serviceadd -> set($data);
				$serviceadd -> save();
			
			}
			if ($cat === 'オプション')
			{
				$serviceadd = array();
				$serviceadd = Model_Option::forge();
				
					$data = array(
					'opt_name' => $servicename ,
					'opt_contents' => $servicecontent ,
					'opt_price_regular' => $serviceprice ,
					'opt_price_member' => $servicepricemem ,
					'opt_price_cont' => $servicepricecont ,
					'branch_id' => $branch,
					);
					
				$serviceadd -> set($data);
				$serviceadd -> save();
			}
			
			
			
			$view = View::forge('admin/admin_addnewmenu_finished');
			SessionDeleter::menuSession_delete();//メニューで使ったセッションを削除する
			return $view;
		}
	}

	public function action_editmenu()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$menuname = Session::get('service_name');
			$cat = Session::get('category');
			$branch = Session::get('admin_branch');
			
			$data = array();
			
			if ($cat==="course"){
				$result = DB::select()->from('tblservice')
				->where_open()
				->where('svc_name','=',$menuname)
				->and_where('branch_id', $branch)
				->where_close()
				->execute();
			
			}
			if ($cat==="facial"){
				$result = DB::select()->from('tblservicefacial')
				->where_open()
				->where('svc_name','=',$menuname)
				->and_where('branch_id', $branch)
				->where_close()
				->execute();
			}
			if ($cat==="option"){
				$result = DB::select()->from('tbloption')
				->where_open()
				->where('opt_name','=',$menuname)
				->and_where('branch_id', $branch)
				->where_close()
				->execute();
			}
			
			$view = View::forge('admin/admin_editmenu',$data);	
			$view->set_global('menuedit',$result->as_array());
			$view->set('category',$cat);
			$view->set('branch_id', $branch);
			return $view;
		}
	}
	public function action_editmenu_confirm()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			
			$svc_no = Input::post('serviceno');
			
			$svc_name = Input::post('servicename');
			$svc_content = Input::post('service_content');
			$svc_price = Input::post('service_price');
			$svc_price_mem = Input::post('service_price_mem');
			$svc_price_cont = Input::post('service_price_cont');
			
		
			
			$view = View::forge('admin/admin_editmenu_confirm');
			
			$view->set('svc_no',$svc_no);
			
			$view->set('svc_name',$svc_name);
			$view->set('svc_content',$svc_content);
			$view->set('svc_price',$svc_price);
			$view->set('svc_price_mem',$svc_price_mem);
			$view->set('svc_price_cont',$svc_price_cont);
			
			return $view;
		}
	}
	public function action_editmenu_finished()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
		
			$svcname = Session::get('servicename');
			$svccontent = Session::get('servicecontent');
			$svc_price = Session::get('serviceprice');
			$svc_price_mem = Session::get('servicepricemem');
			$svc_price_cont = Session::get('servicepricecont');
			
			$cat = Session::get('category');
			$branch = Session::get('admin_branch');
			
			if ($cat==="course"){
				$query = DB::update('tblservice');
				$query->set(array(
							'svc_name' => $svcname,
							'svc_contents'=>$svccontent,
							'svc_price_regular' =>$svc_price,
							'svc_price_member' =>$svc_price_mem,
							'svc_price_cont' =>$svc_price_cont,
							));
				$query->where('svc_name',$svcname);
				$query->and_where('branch_id',$branch);
				$query->execute();
			
			}
			if ($cat==="facial"){
				
				$query = DB::update('tblservicefacial');
				$query->set(array(
							'svc_name' => $svcname,
							'svc_contents'=>$svccontent,
							'svc_price_regular' =>$svc_price,
							'svc_price_member' =>$svc_price_mem,
							'svc_price_cont' =>$svc_price_cont,
							));
				$query->where('svc_name',$svcname);
				$query->execute();
			}
			if ($cat==="option"){
				
				$query = DB::update('tbloption');
				$query->set(array(
							'opt_name' => $svcname,
							'opt_contents'=>$svccontent,
							'opt_price_regular' =>$svc_price,
							'opt_price_member' =>$svc_price_mem,
							'opt_price_cont' =>$svc_price_cont,
							));
				$query->where('opt_name',$svcname);
				$query->execute();
				
			}
			
			
			
			$view = View::forge('admin/admin_editmenu_finished');
			SessionDeleter::menuSession_delete();//メニューで使ったセッションを削除する
			return $view;
		}
	}
	
	public function action_menudetails()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$menu_name = Input::post('menu');
			$svcname = Session::get('menu_name');
			//Session::set('menu_name',$menu_name);
			$branch = Session::get('admin_branch');
			
			$data = array();
			$data['menu']= Model_Service::find_by('svc_name',$menu_name);
		
			$data = DB::select()->from('tblservice')
				->where_open()
				->where('svc_name',$menu_name)
				->and_where('branch_id', $branch)
				->where_close()
				->execute();
		
			$view = View::forge('admin/admin_menudetails',$data);
			$view->set('svc_name',$menu_name);
			$view->set('category','course');
			$view->set_global('menu',$data->as_array());
			return $view;
		}
	}
	
	public function action_deletemenu()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			
			$svcname = Session::get('svc_name');
			
			 $view = View::forge('admin/admin_deletemenu');
			 $view->set('name',$svcname);
			 return $view;
		}
	}
	public function action_menudelete_finished()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合	
			$cat = Session::get('category');
			$svcname = Session::get('svc_name');
			$branch = Session::get('admin_branch');
			if ($cat==="course"){
				$entry = Model_Service::find_by('svc_name',$svcname);
				//$entry->delete();
				
				$query = DB::delete('tblservice');
				
				$query -> where('svc_name',$svcname);
				$query -> and_where('branch_id', $branch);
				$query->execute();
			
			}
			if ($cat==="facial"){
				
				$entry = Model_Facial::find_by('svc_name',$svcname);
				//$entry->delete();
				
				
				$query = DB::delete('tblservicefacial');
				
				$query->where('svc_name',$svcname);
				
				$query->and_where('branch_id', $branch);
				$query->execute();
			}
			if ($cat==="option"){
			
				$entry = Model_Option::find_by('opt_name',$svcname);
			

				$query = DB::delete('tbloption');
		
				$query->where('opt_name',$svcname);
				
				$query->and_where('branch_id', $branch);
				$query->execute();
				
			}
			 
			 $view = View::forge('admin/admin_deletemenu_finished');
			 return $view;
		}
	}

/********** End of メニュー管理ページ *********************************************/

/********** メール管理ページ *********************************************/
	
	public function action_mail()
    {
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			SessionDeleter::resSession_delete(); //予約管理ページのセッションを削除する
			
			 $view = View::forge('admin/admin_mailsetting');
			 return $view;
		}
	}
	
	public function action_clickYoyaku()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$type = '予約';
			Session::set('type','予約');
			
			$view = View::forge('admin/admin_mailsettingbasic_edit',$type);
			$view->set('type',$type);
			return $view;
		}
	}
	public function action_maillink()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			
			$_POST['bt_form']=Input::post('bt_form');
			$view->set('mail', $_POST['bt_form']);
			
		}
	}
	public function action_mailbasic_confirm()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
		
			$view = View::forge('admin/admin_mailsettingbasic_confirm');
			return $view;
		}
	}
	
	public function action_mailsetting_edit()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$type = Input::post('submit');
		
			Session::create();
			Session::set('type',$type);
			$data = array();
			$data['rows'] = Model_Mail::find_by('type',$type);
			
			$view = View::forge('admin/admin_mailsetting_edit',$data);
			$view ->set('type',$type);

			return $view;
		}
	}
	
	public function action_editmailsettingbasic_finished()
	{
			if ( ! Auth::check())//ログインされなかったら
			{
				Response::redirect_back('admin/admin_login', 'refresh');
			}else{//ログインされている場合
			
				$view = View::forge('admin/admin_editmailsettingbasic_finished');
				
				$gettype = Session::get('type');
				
				if (Input::method() == 'POST'){	
							$_POST['mail'] = Input::post('mail');

							$_POST['signature'] = Input::post('signature');

				 $query = DB::update('tblmail');
				 $query->set(array('mail_add'=>$_POST['mail'],'signature'=>$_POST['signature']));
				 $result = $query->execute();
				 
				}
				
			}
			return $view;
	}
	public function action_mailheadfoot_confirm()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$gettype = Session::get('type');
			
			$view = View::forge('admin/admin_mailsettingheadfoot_confirm');
			$view ->set('gettype',$gettype);
			return $view;
		}
	}
	public function action_editmailsettingheadfoot_finished()
	{
		if ( ! Auth::check())//ログインされなかったら
		{
			Response::redirect_back('admin/admin_login', 'refresh');
		}else{//ログインされている場合
			$gettype = Session::get('type');
			
			$view = View::forge('admin/admin_editmailsettingheadfoot_finished');
			
			if (Input::method() == 'POST'){	
							$_POST['mhf_title'] = Input::post('mhf_title');
							$_POST['header'] = Input::post('header');
							$_POST['body'] = Input::post('body');
							$_POST['footer'] = Input::post('footer');
			
			 $query = DB::update('tblmailtype');
			 $query->set(array('title'=>$_POST['mhf_title'],'header'=>$_POST['header'] ,'body'=>$_POST['body'],'footer'=>$_POST['footer']));
			 $query->where('type','=',$gettype );
			 $result = $query->execute();
						
			}
		
			return $view;
		}
	}
/********** End of メール管理ページ *********************************************/
/********** Logout *********************************************/
	public function action_logout() /* ログアウト */
	{
		SessionDeleter::resSession_delete(); //予約管理ページのセッションを削除する
		Session::delete('admin_name');	
		Session::delete('admin_branch');
		Auth::logout();
		Response::redirect('admin/');
		$view = View::forge('admin/admin_login');
		return $view;
	}
/********** End of Logout *********************************************/
}