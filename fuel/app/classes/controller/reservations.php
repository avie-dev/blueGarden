<?php
	
class Controller_Reservations extends Controller
{
    public function action_index()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
		
		// if not logged-in
		if ( ! Auth::check())
		{
			$view = View::forge('reservations/reserve_top');			
		}else{
			$auth = Auth::instance();
			$name = Auth::get_profile_fields('name');
			$data = array();
			$data['rows']= Model_User::find_by('email',Auth::get_email());
			Session::delete('checkresnunber');
			Session::delete('rescheck');
			Session::delete('reschecktime');
			Session::delete('checkstaff');
			Session::delete('checkservice1');
			Session::delete('checkservice2');
			Session::delete('checkoption');
			Session::delete('checkresnunber');
			$view = View::forge('reservations/reserve_top_login', $data);
			$view->set('name',$name);		
		}
         return $view;

    }
	
	public function action_privacy()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
		Session::delete('checkresnunber');
		// if not logged-in
		if ( ! Auth::check())
		{
			$view = View::forge('reservations/privacy2');			
		}else{
			$auth = Auth::instance();
			$name = Auth::get_profile_fields('name');
			$data = array();
			$data['rows']= Model_User::find_by('email',Auth::get_email());	
			$view = View::forge('reservations/privacy', $data);
			$view->set('name',$name);
			//$view = View::forge('reservations/privacy');
		}
         return $view;

    }
	
	
	public function action_login()
    {	
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
        $view = View::forge('reservations/reserve_top');
        $auth = Auth::instance();
		$error = null;		
        if (Input::post())
        {
			$validcheck = DB::select('email')->from('tblusers')
				->where('username', '=', Input::post('username'))
				->and_where('del_flag', '=', 0)
				->and_where('group', '!=', 100)
				->execute();

				if(count($validcheck)>0){
					if ($auth->login(Input::post('username'), Input::post('password')))
					{
							Session::set_flash('success', 'ログイン出来ました！ ');
							Response::redirect('reservations/');
					}			
					else
					{
							Session::set_flash('error', 'ユーザー名またはパスワードが違います');
					}
				}else{
						Session::set_flash('error', 'ユーザー名またはパスワードが違います');
				}
          } 
         return $view;
    }

	public function action_guestlogin()
    {	
        $view = View::forge('reservations/guest');
        $auth = Auth::instance();
		$error = null;		
        if (Input::post())
        {
			$validcheck = DB::select('email')->from('tblusers')
				->where('username', '=', Input::post('username'))
				->and_where('del_flag', '=', 0)
				->and_where('group', '!=', 100)
				->execute();

				if(count($validcheck)>0){
					if ($auth->login(Input::post('username'), Input::post('password')))
					{
							Session::set_flash('success', 'ログイン出来ました！ ');
							//Response::redirect('reservations/reserveconfirm');
							
							$getbranch_name = Session::get('getbranch_name');
							$getbranch_id = Session::get('getbranch_id');
							$staff = Session::get('staff');
							$course1 = Session::get('course1');
							$course2 = Session::get('course2');
							$course1_minsel=Session::get('course1_minsel');
							$course2_minsel=Session::get('course2_minsel');	
							$option = Session::get('option');
							$totalamount = Session::get('totalamount');
							$resdate= Session::get('resdate');
							$restime=Session::get('restime');
							$weekday = Session::get('weekday');
							$resno=Session::get('resno');
								
							$name = Auth::get_profile_fields('name');
							$email = Auth::get_email();
							$kana = Auth::get_profile_fields('kana');
							$tel = Auth::get_profile_fields('tel');
							$postno =  Auth::get_profile_fields('post_no');
							$pref= Auth::get_profile_fields('pref');
							$addr1 = Auth::get_profile_fields('addr1');
							$addr2 = Auth::get_profile_fields('addr2');
							$sex = Auth::get_profile_fields('sex');
							$birthy = Auth::get_profile_fields('birthy');
							$birthm = Auth::get_profile_fields('birthm');
							$birthd = Auth::get_profile_fields('birthd');
							$data = array();
							$data['rows']= Model_User::find_by('email',Auth::get_email());
							
							$view = View::forge('reservations/02reserve_confirm', $data);
							$view->set('getbranch_name',$getbranch_name);	
							$view->set('getbranch_id',$getbranch_id);	
							$view->set('staff',$staff);		
							$view->set('course1',$course1);	
							$view->set('course2',$course2);	
							$view->set('course1_minsel',$course1_minsel);	
							$view->set('course2_minsel',$course2_minsel);				
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
							
					}			
					else
					{
							Session::set_flash('error', 'ユーザー名またはパスワードが違います');
					}
				}else{
						Session::set_flash('error', 'ユーザー名またはパスワードが違います');
				}
          }
		$getbranch_name = Session::get('getbranch_name');
		$getbranch_id = Session::get('getbranch_id');
		$staff = Session::get('staff');
		$course1 = Session::get('course1');
		$course2 = Session::get('course2');
		$course1_minsel=Session::get('course1_minsel');
		$course2_minsel=Session::get('course2_minsel');	
		$option = Session::get('option');
		$totalamount = Session::get('totalamount');
		$resdate= Session::get('resdate');
		$restime=Session::get('restime');
		$weekday = Session::get('weekday');
		$resno=Session::get('resno');
		
		$view->set('getbranch_name',$getbranch_name);	
		$view->set('getbranch_id',$getbranch_id);	
		$view->set('staff',$staff);		
		$view->set('course1',$course1);	
		$view->set('course2',$course2);	
		$view->set('course1_minsel',$course1_minsel);	
		$view->set('course2_minsel',$course2_minsel);				
		$view->set('option',$option);	
		$view->set('resdate',$resdate);	
		$view->set('restime',$restime);	
		$view->set('weekday',$weekday);
		$view->set('totalamount',$totalamount);
		$view->set('resno',$resno);	
         return $view;
    }	
	
 	public function action_signuplogin()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
        $view = View::forge('reservations/signup');
        $auth = Auth::instance();
		$error = null;
        if (Input::post())
        {
			$validcheck = DB::select('email')->from('tblusers')
				->where('username', '=', Input::post('username'))
				->and_where('del_flag', '=', 0)
				->and_where('group', '!=', 100)
				->execute();

				if(count($validcheck)>0){
					if ($auth->login(Input::post('username'), Input::post('password')))
					{
							Session::set_flash('success', 'ログイン出来ました！ ');
							Response::redirect('reservations/');
					}			
					else
					{
							Session::set_flash('error', 'ユーザー名またはパスワードが違います');
					}
				}else{
						Session::set_flash('error', 'ユーザー名またはパスワードが違います');
				}
          }
 
         return $view;
    } 
	
	public function action_logout()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
		$auth = Auth::instance();
		$view = View::forge('reservations/reserve_top');
		$auth->logout();

		Session::set_flash('logout', 'ログアウトしました！ ');
		return $view;
		//Response::redirect('reservations/');
    }

/////////////////////////////Code:Takahashi Start////////////////////////////////
	public function action_mypage()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
		
		// if not logged-in 
		if ( ! Auth::check())
		{
			$view = View::forge('reservations/mypage_notregistered');			
		}else{
		
	
		$auth = Auth::instance();

				$name = Auth::get_profile_fields('name');
				$kana = Auth::get_profile_fields('kana');
				$tel = Auth::get_profile_fields('tel');
				$postno =  Auth::get_profile_fields('post_no');
				$pref= Auth::get_profile_fields('pref');
				$addr1 = Auth::get_profile_fields('addr1');
				$addr2 = Auth::get_profile_fields('addr2');
				$sex = Auth::get_profile_fields('sex');
				$birthy = Auth::get_profile_fields('birthy');
				$birthm = Auth::get_profile_fields('birthm');
				$birthd = Auth::get_profile_fields('birthd');
								
				
				
				$data = array();
				$data['rows']= Model_User::find_by('email',Auth::get_email());	
			
				$view = View::forge('reservations/mypage', $data);
				
			
				$view->set('name',$name);
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
				 
		}	 
		 return $view;
	}
	
	public function action_mypage_reserveinfo_shita()
    {
		$auth = Auth::instance();
		$count = array();
		$result =array();
        $reserve = array();
		$reserve['rows']= Model_Reserve::find_by('email',Auth::get_email());
		
		$result = DB::select()->from('tblreserve')->where_open()
		->where('email', Auth::get_email())
		->and_where('valid_res', 1)
		->where_close()
		->or_where_open()
		->where('email', Auth::get_email())
		->and_where('del_flag', 0)
		->where_close()
		->execute();
		
		$count = count($result);
		
	  	 if(($count === 0) or ($reserve['rows'] === null)){
			$nothing='現在、予約がありません。';
			
		}else{
			
			$nothing = ''; 
		
		}
        Session::create();
		Session::set('not',$nothing);
		
		$view = View::forge('reservations/mypage_reserveinfo_shita',$reserve,$result);
		return $view;
    }
	
	public function action_checkreservation()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
		if ( ! Auth::check())
		{
			$view = View::forge('reservations/reserve_top');			
		}else{	
		$auth = Auth::instance();
		$count = array();
		$result =array();
        $reserve = array();
		$reserve['rows']= Model_Delete::find_by('email',Auth::get_email());	
		
		
		$result = DB::select()->from('tblreserve')->where_open()
		->where('email', Auth::get_email())
		->and_where('valid_res', 1)
		->and_where('del_flag', 0)
		->where_close()
		->execute();
		
		$count = count($result);
		
	  	 if(($count === 0) or ($reserve['rows'] === null)){
			$nothing='現在、予約がありません。';
			
		}else{
			
			$nothing = ''; 
		
		}
        Session::create();
		Session::set('not',$nothing);
		 
		$view = View::forge('reservations/check_reservation',$reserve);
		$view->set_global('result',$result->as_array());
		}
    return $view;
    }
	
	public function action_reservationhistory()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
		$auth = Auth::instance();
		$count = array();
		$result =array();
        $reserve = array();
		$reserve['rows']= Model_Reserve::find_by('email',Auth::get_email());	
		
		
		$result = DB::select()->from('tblreserve')->where_open()
		->where('email', Auth::get_email())
		->and_where('del_flag', 0)
		->where_close()
		->execute();
		
		$count = count($result);
		
	  	 if(($count === 0) or ($reserve['rows'] === null)){
			$nothing='現在、予約がありません。';
			
		}else{
			
			$nothing = ''; 
		
		}
		Session::create();
		Session::set('nothing',$nothing);
		$view = View::forge('reservations/reservation_history',$reserve,$result);
		return $view;
    }
/////////////////////////////Code:Takahashi End////////////////////////////////


//////////////////////////////Start Chihiro////////////////////////////////////
public function action_quitmembership()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
	 	if ( ! Auth::check())
		{
			$view = View::forge('reservations/reserve_top');			
		}else{
	
		 $auth = Auth::instance();
		 $name = Auth::get_profile_fields('name');
		 $view = View::forge('reservations/quit_membership');
		 $view->set('name',$name);
		 $error = null;
		 
		 if (Input::post()) {
		 $username = Session::get('username');
		 $password = Input::post('password');

                if ($auth->validate_user($username,  $password))
                {
					$deleted_at=date("Y-m-d H:i:s");
					$query = DB::update('tblusers');
					$query->value('del_flag','1');
					$query->where('username','=',$username);
					$result = $query->execute();
		 $email = Auth::get_email();
		 
		 $email=htmlspecialchars($email);
		 
//データベース接続
		 $query = DB::select()->from('tblmail');
		 $result = $query->execute();
		 $tblmail = $result;
		 foreach($result as $tblmail);
		 

		 $query = DB::select()->from('tblmailtype')
		 ->where('type','=','退会');
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

		// newmessage@ark..ocn.ne.jp"
		 $mailto = "Sample_test00@yahoo.co.jp";
		 $subject = "お客様が退会しました";
		 $mailbody = $name ."様が退会しました"."\n"."\n"."メールアドレスは ".$email."です。";
		 
		 
		 $mailfrom="From:" .$tblmail['mail_add'];
		 mb_send_mail($mailto,$subject,$mailbody,$mailfrom);				
					$auth->logout();
                    Response::redirect('reservations/quitfinished');
                }					
					$error = 'パスワードが違います';
		}
		$view->set('error', $error);
		} 
    return $view;
    }

	public function action_quitmembershipnot()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
	
		$auth = Auth::instance();
		$name = Auth::get_profile_fields('name');
		$count = array();
		$result = array();
		
        $reserve = array();
		$reserve['rows']= Model_Delete::find_by('email',Auth::get_email());

		$result = DB::select()->from('tblreserve')
			->where_open()
			->where('email', Auth::get_email())
			->and_where('valid_res', 1)
			->and_where('del_flag', 0)
			->where_close()
			->execute();
			
		$count = count($result);
		
		 if(($count === 0) or ($reserve['rows'] === null)){
			$view = View::forge('reservations/quit_membership');
			$view->set('name',$name);
			
		}else{
			
			$view = View::forge('reservations/quit_membership_not');
			$view->set('name',$name);
		
		}
	
         $view->set_global('result',$result->as_array());
         return $view;
    }	
	
	public function action_quitfinished()
    {	 
         $view = View::forge('reservations/quit_finished');
         return $view;
    }

	public function action_check2reservation()
    {

		 $res = Input::post('resno');
		 $data = array();
		 $data['rows']= Model_Delete::find_by('res_no',$res);

			////	予約編集のデータ	//////
			$rescheck = array();
			$reserveday = DB::select()->from('tblreserve')->where('res_no','=',$res)->execute();
			foreach($reserveday as $reday):
			$checkresnunber = ($reday['res_no']);
			$rescheck = ($reday['res_date']);
			$reschecktime = ($reday['res_time']);
			Session::set('checkresnunber',$checkresnunber);
			Session::set('rescheck',$rescheck);
			Session::set('reschecktime',$reschecktime);
			endforeach;
			////	予約編集のデータ	//////
		 
         $view = View::forge('reservations/check2_reservation',$data);
		 $view ->set('res',$res);
         return $view;
    }
	
	public function action_reservationcancel()
    {
	if ( ! Auth::check())
		{
			$view = View::forge('reservations/reserve_top');			
		}else{
		 $res = Input::post('res');
		 $data = array();
		 $data['rows']= Model_Delete::find_by('res_no',$res);
         $view = View::forge('reservations/reservation_cancel',$data);
		 $view ->set('res',$res);
		}
     return $view;
    }
	
	public function action_cancelfinished()
    { 

		 $auth = Auth::instance();
		 $cancel = Input::post('cancel');
		 $p_post = Input::post('freemessage');
		 $created_at = date("Y-m-d H:i:s");
		 $resno = Session::get('resno');
		 $branch_id = Session::get('branch_id');
		 $staffname = Session::get('staff');//スタッフ名
		 $course1 = Session::get('course1');
		 $course2 = Session::get('course2');
		 //$option = Session::get('option');
		 $option = Input::post('option');
 		////////////////////SUBTRACT SERVICE COUNT/////////////////////	
		print $branch_id;
			if($course1 != "なし"){ //COUNT FOR MAIN
				$getcount = DB::select()->from('tblservice')->where('svc_name', $course1)->where('branch_id', $branch_id)->execute();
				foreach($getcount as $getcounts){
					$sel_getcount= $getcounts['count']; 
					if($sel_getcount != "0"){
					$sel_getcount = $sel_getcount - 1;
					$putcount=array(
						'count'=>$sel_getcount,
					);
					$query = DB::update('tblservice')
						->where('svc_name', '=', $course1)
						->where('branch_id', $branch_id)
						->set($putcount)
						->execute(); // saving to db
						//print $sel_getcount;
					}
				}
				
				//$datenow = date('d');
				

			}
			
			if($course2 != "なし"){ //COUNT FOR MAIN
				$getcount = DB::select()->from('tblservicefacial')->where('svc_name', $course2)->where('branch_id', $branch_id)->execute();
				foreach($getcount as $getcounts){
					$sel_getcount= $getcounts['count']; 
					if($sel_getcount != "0"){
					$sel_getcount = $sel_getcount - 1;
					$putcount=array(
						'count'=>$sel_getcount,
					);
					$query = DB::update('tblservicefacial')
						->where('svc_name', '=', $course2)
						->where('branch_id', $branch_id)
						->set($putcount)
						->execute(); // saving to db
					}
				}
				//$datenow = date('d');
				

			} 

			if($option != "なし"){ //COUNT FOR MAIN
				$getcount = DB::select()->from('tbloption')->where('opt_name', $option)->where('branch_id', $branch_id)->execute();
				foreach($getcount as $getcounts){
					$sel_getcount= $getcounts['count']; 
					if($sel_getcount != "0"){
					$sel_getcount = $sel_getcount - 1;
					$putcount=array(
						'count'=>$sel_getcount,
					);
					$query = DB::update('tbloption')
						->where('opt_name', '=', $option)
						->where('branch_id', $branch_id)
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
			->where('branch_id', $branch_id)
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
			->where('branch_id', $branch_id)
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
				//print "FREE STAFF";
			}else{
				if($res_time=="10:00"){	
					if($total_course_time<=60){
						
						$putsched=array(
							'time_10_open' => 0,
							'time_1030_open' => 0,							
						);
						$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_10_open' => 0,
							'time_1030_open' => 0,
							'time_11_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_10_open' => 0,
							'time_1030_open' => 0,
							'time_11_open' => 0,
							'time_1130_open' => 0,
							'time_12_open' => 0,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_10_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_1030_open' => 0,
							'time_11_open' => 0,
							'time_1130_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_1030_open' => 0,
							'time_11_open' => 0,
							'time_1130_open' => 0,
							'time_12_open' => 0,
							'time_1230_open' => 0,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_1030_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_11_open' => 0,
							'time_1130_open' => 0,
							'time_12_open' => 0,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_11_open' => 0,
							'time_1130_open' => 0,
							'time_12_open' => 0,
							'time_1230_open' => 0,
							'time_13_open' => 0,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_11_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_1130_open' => 0,
							'time_12_open' => 0,	
							'time_1230_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1130_open' => 0,
							'time_12_open' => 0,
							'time_1230_open' => 0,
							'time_13_open' => 0,	
							'time_1330_open' => 0,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1130_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_12_open' => 0,
							'time_1230_open' => 0,
							'time_13_open' => 0,	
							'time_1330_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_12_open' => 0,
							'time_1230_open' => 0,
							'time_13_open' => 0,
							'time_1330_open' => 0,
							'time_14_open' => 0,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_12_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1230_open' => 0,
							'time_13_open' => 0,	
							'time_1330_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1230_open' => 0,
							'time_13_open' => 0,
							'time_1330_open' => 0,
							'time_14_open' => 0,	
							'time_1430_open' => 0,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1230_open' => 0,
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
					}elseif($total_course_time<=270){
						
						$putsched=array(							
							'time_1230_open' => 0,
							'time_13_open' => 0,
							'time_1330_open' => 0,
							'time_14_open' => 0,
							'time_1430_open' => 0,
							'time_15_open' => 0,	
							'time_1530_open' => 0,
							'time_1630_open' => 0,
							'time_17_open' => 0,
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_13_open' => 0,
							'time_1330_open' => 0,
							'time_14_open' => 0,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_13_open' => 0,
							'time_1330_open' => 0,
							'time_14_open' => 0,
							'time_1430_open' => 0,
							'time_15_open' => 0,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_13_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1330_open' => 0,
							'time_14_open' => 0,	
							'time_1430_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1330_open' => 0,
							'time_14_open' => 0,
							'time_1430_open' => 0,
							'time_15_open' => 0,	
							'time_1530_open' => 0,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1330_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_14_open' => 0,
							'time_1430_open' => 0,
							'time_15_open' => 0,							
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_14_open' => 0,
							'time_1430_open' => 0,
							'time_15_open' => 0,
							'time_1530_open' => 0,
							'time_16_open' => 0,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_14_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1430_open' => 0,
							'time_15_open' => 0,	
							'time_1530_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1430_open' => 0,
							'time_15_open' => 0,
							'time_1530_open' => 0,
							'time_16_open' => 0,	
							'time_1630_open' => 0,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1430_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_15_open' => 0,
							'time_1530_open' => 0,
							'time_16_open' => 0,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_15_open' => 0,
							'time_1530_open' => 0,
							'time_16_open' => 0,
							'time_1630_open' => 0,
							'time_17_open' => 0,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_15_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1530_open' => 0,
							'time_16_open' => 0,	
							'time_1630_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1530_open' => 0,
							'time_16_open' => 0,
							'time_1630_open' => 0,
							'time_17_open' => 0,
							'time_1730_open' => 0,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1530_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_16_open' => 0,
							'time_1630_open' => 0,
							'time_17_open' => 0,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_16_open' => 0,
							'time_1630_open' => 0,
							'time_17_open' => 0,
							'time_1730_open' => 0,
							'time_18_open' => 0,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_16_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1630_open' => 0,
							'time_17_open' => 0,	
							'time_1730_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1630_open' => 0,
							'time_17_open' => 0,
							'time_1730_open' => 0,
							'time_18_open' => 0,	
							'time_1830_open' => 0,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1630_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_17_open' => 0,
							'time_1730_open' => 0,
							'time_18_open' => 0,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_17_open' => 0,
							'time_1730_open' => 0,
							'time_18_open' => 0,
							'time_1830_open' => 0,
							'time_19_open' => 0,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_17_open' => 0,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1730_open' => 0,
							'time_18_open' => 0,	
							'time_1830_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1730_open' => 0,
							'time_18_open' => 0,
							'time_1830_open' => 0,
							'time_19_open' => 0,	
							'time_1930_open' => 0,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1730_open' => 0,
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_18_open' => 0,
							'time_1830_open' => 0,
							'time_19_open' => 0,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_18_open' => 0,
							'time_1830_open' => 0,
							'time_19_open' => 0,
							'time_1930_open' => 0,
							'time_20_open' => 0,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
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
				
				}elseif($res_time=="18:30"){//////18:30
					if($total_course_time<=60){
						
						$putsched=array(							
							'time_1830_open' => 0,
							'time_19_open' => 0,
						);
						$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1830_open' => 0,
							'time_19_open' => 0,	
							'time_1930_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1830_open' => 0,
							'time_19_open' => 0,
							'time_1930_open' => 0,
							'time_20_open' => 0,							
							'time_2030_open' => 0,
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_19_open' => 0,
							'time_1930_open' => 0,
							'time_20_open' => 0,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_19_open' => 0,
							'time_1930_open' => 0,
							'time_20_open' => 0,
							'time_2030_open' => 0,
							'time_21_open' => 0,	
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_1930_open' => 0,
							'time_20_open' => 0,
							'time_2030_open' => 0,
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_20_open' => 0,
							'time_2030_open' => 0,
							'time_21_open' => 0,
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
		
		/////////////////////////予約キャンセル//////////////////////////////////////////////
		 $query = DB::update('tblreserve');
		 $query->set(array('cancel_reason'=>$cancel,'del_flag'=>'1','deleted_at'=>$created_at));
		 $query->where('email', Auth::get_email());
		 $query->and_where('res_no',$resno);
		 $result = $query->execute();
		//////////////////////////予約キャンセル////////////////////////////////////////////

		
		//////CANCEL RESERVATION MAIL

		$email = Auth::get_email();
		 
		 $email=htmlspecialchars($email);
		 
//データベース接続
		 $query = DB::select()->from('tblmail');
		 $result = $query->execute();

		 $tblmail = $result;
		 foreach($result as $tblmail);
		 	 
		 $query = DB::select()->from('tblmailtype')
		 ->where('type','=','予約キャンセル');
		 
		 $result = $query->execute();
		 $tblmailtype = $result;
		 foreach($result as $tblmailtype);
		 


	
		 
         $view = View::forge('reservations/reservation_cancel_finished');
         return $view;
    }
	
	public function action_staff()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
		
	//追加　start	
 		
		$kaminagaya = DB::select()->from('tblstaff')->where_open()
			->where('staff_name','!=','指名なし')
			->and_where('del_flag','!=',1)
			->and_where('branch_id','=',1)
			->where_close()
			->execute();

		$isezaki = DB::select()->from('tblstaff')->where_open()
			->where('staff_name','!=','指名なし')
			->and_where('del_flag','!=',1)
			->and_where('branch_id','=',2)
			->where_close()
			->execute();
		
	
 
         $view = View::forge('reservations/staff');
		 $view->set_global('store1',$kaminagaya->as_array());
		 $view->set_global('store2',$isezaki->as_array());
	//追加　end
         return $view;		
    }
	
	public function action_course()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');

		 $store1_rows = DB::select()->from('tblservice')->where('svc_name', '!=', 'なし')->and_where('del_flag','!=',1)->and_where('branch_id','=',1)->execute();
		 $store1_svc = DB::select()->from('tblservicefacial')->where('svc_name', '!=', 'なし')->and_where('del_flag','!=',1)->and_where('branch_id','=',1)->execute();
		 $store1_opt = DB::select()->from('tbloption')->where('opt_name', '!=', 'なし')->and_where('del_flag','!=',1)->and_where('branch_id','=',1)->execute();		 $rows = DB::select()->from('tblservice')->where('svc_name', '!=', 'なし')->and_where('branch_id','=',1)->execute();

		 $store2_rows = DB::select()->from('tblservice')->where('svc_name', '!=', 'なし')->and_where('del_flag','!=',1)->and_where('branch_id','=',2)->execute();
		 $store2_svc = DB::select()->from('tblservicefacial')->where('svc_name', '!=', 'なし')->and_where('del_flag','!=',1)->and_where('branch_id','=',2)->execute();
		 $store2_opt = DB::select()->from('tbloption')->where('opt_name', '!=', 'なし')->and_where('del_flag','!=',1)->and_where('branch_id','=',2)->execute();
		 
         $view = View::forge('reservations/course');
		 $view->set_global('kaminagaya_rows',$store1_rows->as_array());
		 $view->set_global('kaminagaya_svcface',$store1_svc->as_array());
		 $view->set_global('kaminagaya_option',$store1_opt->as_array());
		 
		 $view->set_global('isezaki_rows',$store2_rows->as_array());
		 $view->set_global('isezaki_svcface',$store2_svc->as_array());
		 $view->set_global('isezaki_option',$store2_opt->as_array());
         return $view;
    }
	
//////////////////////////////End Chihiro////////////////////////////////////
	

///////////////////////////SIGN UP FORM//////////////////////////////////	
	public function action_signup()
    {
		$auth = Auth::instance();
		$view = View::forge('reservations/signup');
		$err = false;
	 	Session::set('err', $err);
		
		// バリデーション
			$val = Validation::forge();
			$val->add_callable(new MyValidation());
			/*$val->add('cus_username', 'ユーザー名')
				->add_rule('required')
				->add_rule('alphanum');				*/
			$val->add('cus_mail', 'メールアドレス')
				->add_rule('valid_email')
				->add_rule('required');									
			$val->add('cus_name', 'お名前')
				->add_rule('required')
				->add_rule('min_length', '2');
			$val->add('cus_kana', 'フリガナ')
				->add_rule('kana');	
			$val->add('cus_tel', '電話番号')
				->add_rule('valid_numeric')
				->add_rule('min_length', '7')
				->add_rule('max_length', '11');
			$val->add('cus_zip', '郵便番号')
				->add_rule('valid_numeric')
				->add_rule('exact_length', '7');
			$val->add('cus_pref', '都道府県');
			$val->add('cus_addr1', '市区町村・番地');
			$val->add('cus_addr2', '住所');
			$radio_list = array(
                          1 => '男性',
                          2 => '女性'
                      );
			$view->set('radio_list', $radio_list);
			$val->add('cus_sex', '性別')
                ->add_rule('required')
                ->add_rule('array_key_exists', $radio_list);	
			$val->add('cus_birthy', '生年月日')
				->add_rule('required');
			$val->add('cus_birthm', '生年月日')
				->add_rule('required');
			$val->add('cus_birthd', '生年月日')
				->add_rule('required');			
			$val->add('loginpw', 'パスワード',array('type'=>'password'))
				->add_rule('required')
				->add_rule('match_value', Input::post('loginpw_chk'))
				->add_rule('min_length', '4')
				->add_rule('max_length', '20');
			$val->add('loginpw_chk', 'パスワード再入力', array('type' => 'password'))
				->add_rule('required');
 				
		if (Input::method() == 'POST'){							
				if ($val->run() && Security::check_token()){
				//バリデーションOK時の処理
					$username = Input::post('cus_mail');
					$password = Input::post('loginpw');
					$email = Input::post('cus_mail');
					$name = Input::post('cus_name');						
					$kana = Input::post('cus_kana');
					$tel = Input::post('cus_tel');
					$postno = Input::post('cus_zip');
					$pref = Input::post('cus_pref');
					$addr1 = Input::post('cus_addr1');
					$addr2 = Input::post('cus_addr2');
					$getsex = Input::post('cus_sex');
					if($getsex==='1'){
						$sex = '男';
					}else{
						$sex = '女';
					}
					$birthy =Input::post('cus_birthy');
					$birthm = Input::post('cus_birthm');
					$birthd = Input::post('cus_birthd');


					
					$sql = DB::select()->from('tblusers')->where('email', '=', $email)->execute();
					$num_rows = count($sql);
					//echo $num_rows;
					
					if ($num_rows>0) {
						// session = true
						$err = true;
						Session::set('err', $err);
						//echo "email address already existing";
					}else{
						$err = false;
						Session::set('err', $err);
						$view = View::forge('reservations/signup_confirm');
						$view->set('email',$email);
						$view->set('name',$name);
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
						$view->set('password',$password);
						return $view;
					}
				}else{
					$view->set('errors', $val->error());
				}
		}
		return $view;
    }

	public function action_guestsignup()
    {
		$auth = Auth::instance();
		$view = View::forge('reservations/signup_guest');
		$err = false;
	 	Session::set('err', $err);
		
		$getbranch_name = Session::get('getbranch_name');
		$getbranch_id = Session::get('getbranch_id');
		$staff = Session::get('staff');
		$course1 = Session::get('course1');
		$course2 = Session::get('course2');
		$course1_minsel=Session::get('course1_minsel');
		$course2_minsel=Session::get('course2_minsel');	
		$option = Session::get('option');
		$totalamount = Session::get('totalamount');
		$resdate= Session::get('resdate');
		$restime=Session::get('restime');
		$weekday = Session::get('weekday');
		$resno=Session::get('resno');

		//print $getbranch_name;
		$view->set('getbranch_name',$getbranch_name);	
		$view->set('getbranch_id',$getbranch_id);	
		$view->set('staff',$staff);		
		$view->set('course1',$course1);	
		$view->set('course2',$course2);	
		$view->set('course1_minsel',$course1_minsel);	
		$view->set('course2_minsel',$course2_minsel);				
		$view->set('option',$option);	
		$view->set('resdate',$resdate);	
		$view->set('restime',$restime);	
		$view->set('weekday',$weekday);
		$view->set('totalamount',$totalamount);		
		$view->set('resno',$resno);	
		
		// バリデーション
			$val = Validation::forge();
			$val->add_callable(new MyValidation());
			/*$val->add('cus_username', 'ユーザー名')
				->add_rule('required')
				->add_rule('alphanum');				*/
			$val->add('cus_mail', 'メールアドレス')
				->add_rule('valid_email')
				->add_rule('required');									
			$val->add('cus_name', 'お名前')
				->add_rule('required')
				->add_rule('min_length', '2');
			$val->add('cus_kana', 'フリガナ')
				->add_rule('kana');	
			$val->add('cus_tel', '電話番号')
				->add_rule('valid_numeric')
				->add_rule('min_length', '7')
				->add_rule('max_length', '11');
			$val->add('cus_zip', '郵便番号')
				->add_rule('valid_numeric')
				->add_rule('exact_length', '7');
			$val->add('cus_pref', '都道府県');
			$val->add('cus_addr1', '市区町村・番地');
			$val->add('cus_addr2', '住所');
			$radio_list = array(
                          1 => '男性',
                          2 => '女性'
                      );
			$view->set('radio_list', $radio_list);
			$val->add('cus_sex', '性別')
                ->add_rule('required')
                ->add_rule('array_key_exists', $radio_list);	
			$val->add('cus_birthy', '生年月日')
				->add_rule('required');
			$val->add('cus_birthm', '生年月日')
				->add_rule('required');
			$val->add('cus_birthd', '生年月日')
				->add_rule('required');			
			$val->add('loginpw', 'パスワード',array('type'=>'password'))
				->add_rule('required')
				->add_rule('match_value', Input::post('loginpw_chk'))
				->add_rule('min_length', '4')
				->add_rule('max_length', '20');
			$val->add('loginpw_chk', 'パスワード再入力', array('type' => 'password'))
				->add_rule('required');
 				
		if (Input::method() == 'POST'){							
				if ($val->run() && Security::check_token()){
				//バリデーションOK時の処理
					$username = Input::post('cus_mail');
					$password = Input::post('loginpw');
					$email = Input::post('cus_mail');
					$name = Input::post('cus_name');						
					$kana = Input::post('cus_kana');
					$tel = Input::post('cus_tel');
					$postno = Input::post('cus_zip');
					$pref = Input::post('cus_pref');
					$addr1 = Input::post('cus_addr1');
					$addr2 = Input::post('cus_addr2');
					$getsex = Input::post('cus_sex');
					if($getsex==='1'){
						$sex = '男';
					}else{
						$sex = '女';
					}
					$birthy =Input::post('cus_birthy');
					$birthm = Input::post('cus_birthm');
					$birthd = Input::post('cus_birthd');
					
					$sql = DB::select()->from('tblusers')->where('email', '=', $email)->execute();
					$num_rows = count($sql);
					//echo $num_rows;
					
					if ($num_rows>0) {
						// session = true
						$err = true;
						Session::set('err', $err);
						//echo "email address already existing";
					}else{
						$err = false;
						Session::set('err', $err);
						$view = View::forge('reservations/signup_confirm_guest');
						//$view->set('username',$username);
						$view->set('email',$email);
						$view->set('name',$name);
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
						$view->set('password',$password);
						
						
						$getbranch_name = Session::get('getbranch_name');
						$getbranch_id = Session::get('getbranch_id');
						$staff = Session::get('staff');
						$course1 = Session::get('course1');
						$course2 = Session::get('course2');
						$course1_minsel=Session::get('course1_minsel');
						$course2_minsel=Session::get('course2_minsel');	
						$option = Session::get('option');
						$totalamount = Session::get('totalamount');
						$resdate= Session::get('resdate');
						$restime=Session::get('restime');
						$weekday = Session::get('weekday');
						$resno=Session::get('resno');
						
						$view->set('getbranch_name',$getbranch_name);	
						$view->set('getbranch_id',$getbranch_id);	
						$view->set('staff',$staff);		
						$view->set('course1',$course1);	
						$view->set('course2',$course2);	
						$view->set('course1_minsel',$course1_minsel);	
						$view->set('course2_minsel',$course2_minsel);				
						$view->set('option',$option);	
						$view->set('resdate',$resdate);	
						$view->set('restime',$restime);	
						$view->set('weekday',$weekday);
						$view->set('totalamount',$totalamount);		
						$view->set('resno',$resno);						
						return $view;
					}
				}else{
					$view->set('errors', $val->error());
				}
		}
		return $view;
    }	

	public function action_signupconfirm()
    {
         $view = View::forge('reservations/signup_confirm');
         return $view;
    }
	
	public function action_signupfinish()
    {
		$auth = Auth::instance();
		if (Input::method() == 'POST'){							
			//$username = Input::post('email'); 
			$username = Session::get('email');
			$password = Session::get('password');
			$email = Session::get('email');
			$name = Session::get('name');						
			$kana = Session::get('kana');
			$tel = Session::get('tel');
			$postno = Session::get('postno');
			$pref = Session::get('pref');
			$addr1 = Session::get('addr1');
			$addr2 = Session::get('addr2');
			$sex = Session::get('sex');
			$birthy = Session::get('birthy');
			$birthm = Session::get('birthm');
			$birthd = Session::get('birthd');
						
			//連想配列にデータをセット    
			try
			{
				$user = $auth->create_user(
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
			if (isset($user))
			{
				$err = false;
				Session::set('err', $err);
				$auth->login($username, $password);
			}
			else
			{
				$err = true;
				Session::set('err', $err);
			}

			}	

		//SIGNUP MAIL
		//$email = Session::get('email');
		 
		 $email=htmlspecialchars($email);
		 
		 $query = DB::select()->from('tblmail');
		 $result = $query->execute();

		 $tblmail = $result;
		 foreach($result as $tblmail);
		 
 
		 $query = DB::select()->from('tblmailtype')
		 ->where('type','=','新規登録');
		 $result = $query->execute();

		 $tblmailtype = $result;
		 foreach($result as $tblmailtype);


		 mb_language("ja");

		 mb_internal_encoding("utf8");

		 $mailto = $email;
		 $subject = $tblmailtype['title'];
		 $mailbody = $name." 様"."\n"."\n".$tblmailtype['header']."\n"."\n".
		 $tblmailtype['body']."\n"."\n".$tblmailtype['footer']."\n"."\n".$tblmail['signature'];
		 
		 
		 $mailfrom="From:" .$tblmail['mail_add'];
		 mb_send_mail($mailto,$subject,$mailbody,$mailfrom);
		 
		$view = View::forge('reservations/signup_finished');
		return $view;
    }
	
	public function action_guestsignupfinish()
    {
		$getbranch_name = Session::get('getbranch_name');
		//print $getbranch_name;
		
		$auth = Auth::instance();
		if (Input::method() == 'POST'){							
			//$username = Input::post('email'); 
			$username = Session::get('email');
			$password = Session::get('password');
			$email = Session::get('email');
			$name = Session::get('name');						
			$kana = Session::get('kana');
			$tel = Session::get('tel');
			$postno = Session::get('postno');
			$pref = Session::get('pref');
			$addr1 = Session::get('addr1');
			$addr2 = Session::get('addr2');
			$sex = Session::get('sex');
			$birthy = Session::get('birthy');
			$birthm = Session::get('birthm');
			$birthd = Session::get('birthd');
						
			//連想配列にデータをセット    
			try
			{
				$user = $auth->create_user(
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
			if (isset($user))
			{
				$err = false;
				Session::set('err', $err);
				$auth->login($username, $password);
			}
			else
			{
				$err = true;
				Session::set('err', $err);
			}

			}

		//SIGNUP MAIL
		//$email = Session::get('email');
		 
		 $email=htmlspecialchars($email);
		 
		 $query = DB::select()->from('tblmail');
		 $result = $query->execute();

		 $tblmail = $result;
		 foreach($result as $tblmail);
		 
 
		 $query = DB::select()->from('tblmailtype')
		 ->where('type','=','新規登録');
		 $result = $query->execute();

		 $tblmailtype = $result;
		 foreach($result as $tblmailtype);


		 mb_language("ja");

		 mb_internal_encoding("utf8");

		 $mailto = $email;
		 $subject = $tblmailtype['title'];
		 $mailbody = $name." 様"."\n"."\n".$tblmailtype['header']."\n"."\n".
		 "ログインの際にはこちらのメールアドレスをお使いください"."\n"."\n".
		 $tblmailtype['body']."\n"."\n".$tblmailtype['footer']."\n"."\n".$tblmail['signature'];
		 
		 
		 $mailfrom="From:" .$tblmail['mail_add'];
		 mb_send_mail($mailto,$subject,$mailbody,$mailfrom);
		
		$getbranch_name = Session::get('getbranch_name');
							$getbranch_id = Session::get('getbranch_id');
							$staff = Session::get('staff');
							$course1 = Session::get('course1');
							$course2 = Session::get('course2');
							$course1_minsel=Session::get('course1_minsel');
							$course2_minsel=Session::get('course2_minsel');	
							$option = Session::get('option');
							$totalamount = Session::get('totalamount');
							$resdate= Session::get('resdate');
							$restime=Session::get('restime');
							$weekday = Session::get('weekday');
							$resno=Session::get('resno');
								
							$name = Auth::get_profile_fields('name');
							$email = Auth::get_email();
							$kana = Auth::get_profile_fields('kana');
							$tel = Auth::get_profile_fields('tel');
							$postno =  Auth::get_profile_fields('post_no');
							$pref= Auth::get_profile_fields('pref');
							$addr1 = Auth::get_profile_fields('addr1');
							$addr2 = Auth::get_profile_fields('addr2');
							$sex = Auth::get_profile_fields('sex');
							$birthy = Auth::get_profile_fields('birthy');
							$birthm = Auth::get_profile_fields('birthm');
							$birthd = Auth::get_profile_fields('birthd');
							$data = array();
							$data['rows']= Model_User::find_by('email',Auth::get_email());
							
							$view = View::forge('reservations/02reserve_confirm', $data);
							$view->set('getbranch_name',$getbranch_name);	
							$view->set('getbranch_id',$getbranch_id);	
							$view->set('staff',$staff);		
							$view->set('course1',$course1);	
							$view->set('course2',$course2);	
							$view->set('course1_minsel',$course1_minsel);	
							$view->set('course2_minsel',$course2_minsel);				
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
    }
	
////////////////////////////////SIGN UP END///////////////////////////////////

/////////////////////////////////RESERVE START////////////////////////////////
	

	public function action_reserve()
    {	
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
		
		$view = View::forge('reservations/00reserve_agreement');
        return $view;
    }
	
	public function action_reserveedit()
    {		
		// if not logged-in
		if ( ! Auth::check())
		{
			$view = View::forge('reservations/reserve_notregistered');
		}else{
			//$view = View::forge('reservations/00reserve_calendar');
			$view = View::forge('reservations/00reserve_agreement');
		}
         return $view;
    }
	
	public function action_notregistered()
    {
         $view = View::forge('reservations/reserve_notregistered');
         return $view;
    }
	
	public function action_checkagreement()
    {
	if ( ! Auth::check()) //ゲスト用
		{
			//$view = View::forge('reservations/reserve_top');
			$auth = Auth::instance();
			$view = View::forge('reservations/00reserve_agreement_guest'); //同意されない場合
			$error = null;
			
			$agree = Input::post('agree');
			if ($agree==='1'){				
				$view = View::forge('reservations/00reserve_map'); //同意された場合
				$map1 = DB::select('*')->from('tblbranch')->where('id',1)->execute();
				$map2 = DB::select('*')->from('tblbranch')->where('id',2)->execute();
				$view->set_global('map1',$map1->as_array());
				$view->set_global('map2',$map2->as_array());
				return $view;
			}elseif ($agree!='1'){
				$error = '※ご利用規約に同意してから予約の手続きを行ってください。';				
			}
		$view->set('error', $error);
		return $view;			
		}else{//ログインされたお客
			$auth = Auth::instance();
			$view = View::forge('reservations/00reserve_agreement'); //同意されない場合
			$error = null;
			
			$agree = Input::post('agree');
			if ($agree==='1'){				
				$view = View::forge('reservations/00reserve_map'); //同意された場合
				$map1 = DB::select('*')->from('tblbranch')->where('id',1)->execute();
				$map2 = DB::select('*')->from('tblbranch')->where('id',2)->execute();
				$view->set_global('map1',$map1->as_array());
				$view->set_global('map2',$map2->as_array());
				return $view;
			}elseif ($agree!='1'){
				$error = '※ご利用規約に同意してから予約の手続きを行ってください。';				
			}
		$view->set('error', $error);
		return $view;		
		}	
	return $view;
    }
	
	public function action_reservemap()
    {
        $view = View::forge('reservations/00reserve_map');
		$map = DB::select('*')->from('tblbranch')->execute();
		$view->set_global('map',$map->as_array());
        return $view;
    }
	
///////////////////////////////////RESERVE FORM/////////////////////////////
	public function action_reserveform()
    {	
	//if ( ! Auth::check())
		//{
		//	$view = View::forge('reservations/reserve_top');
		//}else{
		$auth = Auth::instance();
		$name = Auth::get_profile_fields('name');
		
		$getbranch_name = Input::post('getbranch_name');
		$getbranch_id = Input::post('getbranch_id');	
		$data = array();
		$data['rows']= Model_User::find_by('email',Auth::get_email());	
		$view = View::forge('reservations/01reserve_form', $data);
		$view->set('name',$name);
		$view->set('getbranch_name',$getbranch_name);	
		$view->set('getbranch_id',$getbranch_id);
		
		$resdate=date("m/d",strtotime(Input::post('resdate')));
		$restime=Input::post('restime');
		$weekday = \Model\Calendar::display_dayofweek($resdate);		
		//print $restime."<br>";
		//print $resdate."<br>";
		//print $weekday;
		
	////*	予約編集のデータ	*//////
		
/* 		$resnumber = Session::get('checkresnunber');
		$checker = array();
		$checkdate = DB::select()->from('tblreserve')->where('res_no','=',$resnumber)->execute();
		foreach($checkdate as $check):
		$checkstaff = ($check['staff_name']);
		$checkservice1 = ($check['svc_name_1']);
		$checkservice2 = ($check['svc_name_2']);
		$checkoption = ($check['opt_name']);
		
		Session::set('checkstaff',$checkstaff);
		Session::set('checkservice1',$checkservice1);
		Session::set('checkservice2',$checkservice2);
		Session::set('checkoption',$checkoption);
		endforeach; */
		
	////*	予約編集のデータ	*//////
	
//My work now -- getting the staffs name for a specified DATE -- 作業		
		$searchdate=date("Y-m-d",strtotime($resdate));
		//print $searchdate;
		//$select_avstaff1 = "";
		
		if($restime=="10:00"){
		//print "ten<br>";
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_10', '=', 1)
				->and_where('time_10_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_10', '=', 1)
				->and_where('time_10_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="10:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1030', '=', 1)
				->and_where('time_1030_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1030', '=', 1)
				->and_where('time_1030_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="11:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_11', '=', 1)
				->and_where('time_11_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_11', '=', 1)
				->and_where('time_11_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="11:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1130', '=', 1)
				->and_where('time_1130_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1130', '=', 1)
				->and_where('time_1130_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();	
		}elseif($restime=="12:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_12', '=', 1)
				->and_where('time_12_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_12', '=', 1)
				->and_where('time_12_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="12:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1230', '=', 1)
				->and_where('time_1230_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1230', '=', 1)
				->and_where('time_1230_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="13:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_13', '=', 1)
				->and_where('time_13_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_13', '=', 1)
				->and_where('time_13_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="13:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1330', '=', 1)
				->and_where('time_1330_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();	
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1330', '=', 1)
				->and_where('time_1330_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="14:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_14', '=', 1)
				->and_where('time_14_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_14', '=', 1)
				->and_where('time_14_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="14:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1430', '=', 1)
				->and_where('time_1430_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();	
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1430', '=', 1)
				->and_where('time_1430_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="15:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_15', '=', 1)
				->and_where('time_15_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_15', '=', 1)
				->and_where('time_15_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="15:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1530', '=', 1)
				->and_where('time_1530_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1530', '=', 1)
				->and_where('time_1530_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="16:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_16', '=', 1)
				->and_where('time_16_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_16', '=', 1)
				->and_where('time_16_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="16:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1630', '=', 1)
				->and_where('time_1630_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();	
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1630', '=', 1)
				->and_where('time_1630_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="17:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_17', '=', 1)
				->and_where('time_17_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_17', '=', 1)
				->and_where('time_17_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="17:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1730', '=', 1)
				->and_where('time_1730_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();	
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1730', '=', 1)
				->and_where('time_1730_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="18:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_18', '=', 1)
				->and_where('time_18_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_18', '=', 1)
				->and_where('time_18_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="18:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1830', '=', 1)
				->and_where('time_1830_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();		
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1830', '=', 1)
				->and_where('time_1830_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();	
		}elseif($restime=="19:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_19', '=', 1)
				->and_where('time_19_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_19', '=', 1)
				->and_where('time_19_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="19:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1930', '=', 1)
				->and_where('time_1930_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();	
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1930', '=', 1)
				->and_where('time_1930_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="20:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_20', '=', 1)
				->and_where('time_20_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_20', '=', 1)
				->and_where('time_20_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="20:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2030', '=', 1)
				->and_where('time_2030_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();	
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2030', '=', 1)
				->and_where('time_2030_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();	
		}elseif($restime=="21:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_21', '=', 1)
				->and_where('time_21_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_21', '=', 1)
				->and_where('time_21_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="21:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2130', '=', 1)
				->and_where('time_2130_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();	
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2130', '=', 1)
				->and_where('time_2130_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="22:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_22', '=', 1)
				->and_where('time_22_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_22', '=', 1)
				->and_where('time_22_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="22:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2230', '=', 1)
				->and_where('time_2230_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2230', '=', 1)
				->and_where('time_2230_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();	
		}



		if($getbranch_id=="1"){
			$option = DB::select()->from('tbloption')->where('opt_no', '!=', 0)->and_where('branch_id', '=', 1)->order_by('opt_no', 'asc')->execute();
			$course1 = DB::select()->from('tblservice')->where('svc_no', '!=', 0)->and_where('branch_id', '=', 1)->order_by('svc_no', 'asc')->execute();
			$course2 = DB::select()->from('tblservicefacial')->where('svc_no', '!=', 0)->and_where('branch_id', '=', 1)->order_by('svc_no', 'asc')->execute();
		}else{
			$option = DB::select()->from('tbloption')->where('opt_no', '!=', 0)->and_where('branch_id', '=', 2)->order_by('opt_no', 'asc')->execute();
			$course1 = DB::select()->from('tblservice')->where('svc_no', '!=', 0)->and_where('branch_id', '=', 2)->order_by('svc_no', 'asc')->execute();		
			$course2 = DB::select()->from('tblservicefacial')->where('svc_no', '!=', 0)->and_where('branch_id', '=', 2)->order_by('svc_no', 'asc')->execute();
		}
		
		$view->set_global('staff1',$avstaff1->as_array());
		$view->set_global('staff2',$avstaff2->as_array());

		$view->set_global('course1',$course1->as_array());
		$view->set_global('course2',$course2->as_array());
		$view->set_global('option',$option->as_array());
		$view->set('resdate',$resdate);	
		$view->set('restime',$restime);	
		$view->set('weekday',$weekday);
		$view->set('getbranch_name',$getbranch_name);	
		$view->set('getbranch_id',$getbranch_id);
		//}
    return $view;
	}
////////////////////////////////RESERVE CONFIRM//////////////////////////////////////

	public function action_reserveconfirm()
    {
		if ( ! Auth::check()) //reserve confirm GUEST
		{
			//$view = View::forge('reservations/reserve_top');
		$err = false;
	 	Session::set('err', $err);
		
		$data = array();
		$data['rows']= Model_User::find_by('email',Auth::get_email());	
		$view = View::forge('reservations/01reserve_form', $data);	

		$resdate=date("m/d",strtotime(Input::post('resdate')));
		$restime=Input::post('restime');
		$weekday = \Model\Calendar::display_dayofweek($resdate);	
		$getbranch_name = Input::post('getbranch_name');
		$getbranch_id = Input::post('getbranch_id');		
	
//My work now -- getting the staffs name for a specified DATE -- 作業		
		$searchdate=date("Y-m-d",strtotime($resdate));
		
		if($restime=="10:00"){
		//print "ten<br>";
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_10', '=', 1)
				->and_where('time_10_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_10', '=', 1)
				->and_where('time_10_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="10:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1030', '=', 1)
				->and_where('time_1030_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1030', '=', 1)
				->and_where('time_1030_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="11:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_11', '=', 1)
				->and_where('time_11_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_11', '=', 1)
				->and_where('time_11_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="11:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1130', '=', 1)
				->and_where('time_1130_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1130', '=', 1)
				->and_where('time_1130_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();	
		}elseif($restime=="12:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_12', '=', 1)
				->and_where('time_12_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_12', '=', 1)
				->and_where('time_12_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="12:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1230', '=', 1)
				->and_where('time_1230_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1230', '=', 1)
				->and_where('time_1230_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="13:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_13', '=', 1)
				->and_where('time_13_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_13', '=', 1)
				->and_where('time_13_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="13:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1330', '=', 1)
				->and_where('time_1330_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1330', '=', 1)
				->and_where('time_1330_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="14:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_14', '=', 1)
				->and_where('time_14_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_14', '=', 1)
				->and_where('time_14_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="14:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1430', '=', 1)
				->and_where('time_1430_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1430', '=', 1)
				->and_where('time_1430_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="15:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_15', '=', 1)
				->and_where('time_15_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_15', '=', 1)
				->and_where('time_15_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="15:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1530', '=', 1)
				->and_where('time_1530_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1530', '=', 1)
				->and_where('time_1530_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="16:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_16', '=', 1)
				->and_where('time_16_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_16', '=', 1)
				->and_where('time_16_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="16:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1630', '=', 1)
				->and_where('time_1630_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1630', '=', 1)
				->and_where('time_1630_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="17:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_17', '=', 1)
				->and_where('time_17_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_17', '=', 1)
				->and_where('time_17_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="17:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1730', '=', 1)
				->and_where('time_1730_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1730', '=', 1)
				->and_where('time_1730_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="18:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_18', '=', 1)
				->and_where('time_18_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_18', '=', 1)
				->and_where('time_18_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="18:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1830', '=', 1)
				->and_where('time_1830_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1830', '=', 1)
				->and_where('time_1830_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="19:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_19', '=', 1)
				->and_where('time_19_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_19', '=', 1)
				->and_where('time_19_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="19:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1930', '=', 1)
				->and_where('time_1930_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1930', '=', 1)
				->and_where('time_1930_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="20:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_20', '=', 1)
				->and_where('time_20_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_20', '=', 1)
				->and_where('time_20_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="20:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2030', '=', 1)
				->and_where('time_2030_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2030', '=', 1)
				->and_where('time_2030_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="21:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_21', '=', 1)
				->and_where('time_21_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_21', '=', 1)
				->and_where('time_21_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="21:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2130', '=', 1)
				->and_where('time_2130_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2130', '=', 1)
				->and_where('time_2130_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="22:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_22', '=', 1)
				->and_where('time_22_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_22', '=', 1)
				->and_where('time_22_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="21:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2130', '=', 1)
				->and_where('time_2130_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2130', '=', 1)
				->and_where('time_2130_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}
		$course1 = DB::select()->from('tblservice')->where('svc_no', '!=', 0)->where('branch_id', $getbranch_id)->order_by('svc_no', 'asc')->execute();
		$course2 = DB::select()->from('tblservicefacial')->where('svc_no', '!=', 0)->where('branch_id', $getbranch_id)->order_by('svc_no', 'asc')->execute();
		$option = DB::select()->from('tbloption')->where('opt_no', '!=', 0)->where('branch_id', $getbranch_id)->order_by('opt_no', 'asc')->execute();		
		
		if (Input::method() == 'POST'){
		
			$checkList = array(
			'staff' => trim(Input::post('staff')),
			'course1' => trim(Input::post('course1')),
			'course2' => trim(Input::post('course2')),
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
					if($course1!=""){			//checking minutes
					$course1_min = DB::select('svc_time')->from('tblservice')->where('svc_name','=',$course1)->where('branch_id', $getbranch_id)->execute();
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
					if($course2!=""){			//checking minutes
					$course2_min = DB::select('svc_time')->from('tblservicefacial')->where('svc_name','=',$course2)->where('branch_id', $getbranch_id)->execute();
					if(count($course2_min)>0){
						foreach($course2_min as $course2_mins){
							$course2_minsel= $course2_mins['svc_time']; 
						}
						//print $course2_minsel;
					}
					}else{
						$course2_minsel=0;
					}
					
					$option=Input::post('option');
					
					$resdate=date("m/d",strtotime(Input::post('resdate')));
					$restime=Input::post('restime');
					$getbranch_name = Input::post('getbranch_name'); 
					$getbranch_id = Input::post('getbranch_id');
/* 					$name = Auth::get_profile_fields('name');
					$email = Auth::get_email();
					$kana = Auth::get_profile_fields('kana');
					$tel = Auth::get_profile_fields('tel');
					$postno =  Auth::get_profile_fields('post_no');
					$pref= Auth::get_profile_fields('pref');
					$addr1 = Auth::get_profile_fields('addr1');
					$addr2 = Auth::get_profile_fields('addr2');
					$sex = Auth::get_profile_fields('sex');
					$birthy = Auth::get_profile_fields('birthy');
					$birthm = Auth::get_profile_fields('birthm');
					$birthd = Auth::get_profile_fields('birthd'); */
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

							$num = 1;
							$num_padded = sprintf("%03s", $num);
							//print $num_padded."<br>";						
						}else{
							//print "same time <br>";
							$lastresnum = (int)substr($lastresno,12,3);
							//print $lastresnum;
							$num = $lastresnum + 1;
							$num_padded = sprintf("%03s", $num);
							//print $num_padded."<br>";							
						}

						$resno = (string)date("YmdHi").$num_padded;
						//print "final res no is ".$resno."<br>";
//RESERVATION NUMBER end

					//$membercheck = DB::select('member_status')->from('tblusers')
					//->where('email','=', Auth::get_email())
					//->execute();
					$totalamount = 0;
					//foreach($membercheck as $row):
					//print $staff;
					if($staff!="指名なし"){ //指名料を含む
							//print "not member 指名含む";
								$course1_cost = DB::select('svc_price_regular')->from('tblservice')->where('svc_name','=',$course1)->where('branch_id', $getbranch_id)->execute();
									foreach($course1_cost as $course1_costs){
										$totalamount = $totalamount + $course1_costs['svc_price_regular'];
									}
							
								$course2_cost = DB::select('svc_price_regular')->from('tblservicefacial')->where('svc_name','=',$course2)->where('branch_id', $getbranch_id)->execute();
									foreach($course2_cost as $course2_costs){
										$totalamount = $totalamount + $course2_costs['svc_price_regular'];
									}

								$option_cost = DB::select('opt_price_regular')->from('tbloption')->where('opt_name','=',$option)->where('branch_id', $getbranch_id)->execute();
									foreach($option_cost as $option_costs){
										$totalamount = $totalamount + $option_costs['opt_price_regular'];
									}							
								$totalamount = $totalamount + 540;
					}else{//指名料なし
							//print "not member 指名料なし";
								$course1_cost = DB::select('svc_price_regular')->from('tblservice')->where('svc_name','=',$course1)->where('branch_id', $getbranch_id)->execute();
									foreach($course1_cost as $course1_costs){
										$totalamount = $totalamount + $course1_costs['svc_price_regular'];
									}
							
								$course2_cost = DB::select('svc_price_regular')->from('tblservicefacial')->where('svc_name','=',$course2)->where('branch_id', $getbranch_id)->execute();
									foreach($course2_cost as $course2_costs){
										$totalamount = $totalamount + $course2_costs['svc_price_regular'];
									}

								$option_cost = DB::select('opt_price_regular')->from('tbloption')->where('opt_name','=',$option)->where('branch_id', $getbranch_id)->execute();
									foreach($option_cost as $option_costs){
										$totalamount = $totalamount + $option_costs['opt_price_regular'];
									}								
					}
					//endforeach;			
					
					$data = array();
					$data['rows']= Model_User::find_by('email',Auth::get_email());
					$view = View::forge('reservations/02reserve_confirm_guest', $data);	
					$view->set('staff',$staff);		
					$view->set('course1',$course1);	
					$view->set('course2',$course2);	
					$view->set('course1_minsel',$course1_minsel);	
					$view->set('course2_minsel',$course2_minsel);				
					$view->set('option',$option);	
					$view->set('resdate',$resdate);	
					$view->set('restime',$restime);	
					$view->set('weekday',$weekday);
					$view->set('totalamount',$totalamount);					
					/* $view->set('name',$name);
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
					$view->set('birthd',$birthd); */	
					$view->set('resno',$resno);	
					$view->set('getbranch_name',$getbranch_name);	
					$view->set('getbranch_id',$getbranch_id);					
					return $view;
				}else{
						$error = '*必須項目を入力してください';
						$view->set('error', $error);
				}
			}	
		$view->set_global('staff1',$avstaff1->as_array());
		$view->set_global('staff2',$avstaff2->as_array());
		$view->set_global('course1',$course1->as_array());
		$view->set_global('course2',$course2->as_array());
		$view->set_global('option',$option->as_array());			
		$view->content=View::forge('reservations/01reserve_form');
		$view->set('resdate',$resdate);	
		$view->set('restime',$restime);	
		$view->set('weekday',$weekday);
		$view->set('getbranch_name',$getbranch_name);	
		$view->set('getbranch_id',$getbranch_id);	
		
	}else{	//reserve confirm ログインされている/////////////////////////////////////
		
		$err = false;
	 	Session::set('err', $err);
		
		$data = array();
		$data['rows']= Model_User::find_by('email',Auth::get_email());	
		$view = View::forge('reservations/01reserve_form', $data);	

		$resdate=date("m/d",strtotime(Input::post('resdate')));
		$restime=Input::post('restime');
		$weekday = \Model\Calendar::display_dayofweek($resdate);	
		$getbranch_name = Input::post('getbranch_name');
		$getbranch_id = Input::post('getbranch_id');		
	
//My work now -- getting the staffs name for a specified DATE -- 作業		
		$searchdate=date("Y-m-d",strtotime($resdate));
		
		if($restime=="10:00"){
		//print "ten<br>";
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_10', '=', 1)
				->and_where('time_10_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_10', '=', 1)
				->and_where('time_10_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="10:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1030', '=', 1)
				->and_where('time_1030_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1030', '=', 1)
				->and_where('time_1030_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="11:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_11', '=', 1)
				->and_where('time_11_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_11', '=', 1)
				->and_where('time_11_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="11:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1130', '=', 1)
				->and_where('time_1130_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1130', '=', 1)
				->and_where('time_1130_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();	
		}elseif($restime=="12:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_12', '=', 1)
				->and_where('time_12_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_12', '=', 1)
				->and_where('time_12_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="12:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1230', '=', 1)
				->and_where('time_1230_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1230', '=', 1)
				->and_where('time_1230_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="13:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_13', '=', 1)
				->and_where('time_13_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_13', '=', 1)
				->and_where('time_13_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="13:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1330', '=', 1)
				->and_where('time_1330_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1330', '=', 1)
				->and_where('time_1330_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="14:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_14', '=', 1)
				->and_where('time_14_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_14', '=', 1)
				->and_where('time_14_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="14:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1430', '=', 1)
				->and_where('time_1430_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1430', '=', 1)
				->and_where('time_1430_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="15:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_15', '=', 1)
				->and_where('time_15_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_15', '=', 1)
				->and_where('time_15_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="15:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1530', '=', 1)
				->and_where('time_1530_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1530', '=', 1)
				->and_where('time_1530_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="16:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_16', '=', 1)
				->and_where('time_16_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_16', '=', 1)
				->and_where('time_16_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="16:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1630', '=', 1)
				->and_where('time_1630_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1630', '=', 1)
				->and_where('time_1630_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="17:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_17', '=', 1)
				->and_where('time_17_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_17', '=', 1)
				->and_where('time_17_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="17:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1730', '=', 1)
				->and_where('time_1730_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1730', '=', 1)
				->and_where('time_1730_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="18:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_18', '=', 1)
				->and_where('time_18_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_18', '=', 1)
				->and_where('time_18_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="18:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1830', '=', 1)
				->and_where('time_1830_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1830', '=', 1)
				->and_where('time_1830_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="19:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_19', '=', 1)
				->and_where('time_19_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_19', '=', 1)
				->and_where('time_19_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="19:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1930', '=', 1)
				->and_where('time_1930_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_1930', '=', 1)
				->and_where('time_1930_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="20:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_20', '=', 1)
				->and_where('time_20_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_20', '=', 1)
				->and_where('time_20_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="20:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2030', '=', 1)
				->and_where('time_2030_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2030', '=', 1)
				->and_where('time_2030_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="21:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_21', '=', 1)
				->and_where('time_21_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_21', '=', 1)
				->and_where('time_21_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="21:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2130', '=', 1)
				->and_where('time_2130_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2130', '=', 1)
				->and_where('time_2130_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="22:00"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_22', '=', 1)
				->and_where('time_22_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_22', '=', 1)
				->and_where('time_22_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}elseif($restime=="21:30"){
			$avstaff1 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2130', '=', 1)
				->and_where('time_2130_open', '=', 0)
				->and_where('branch_id', '=', 1)
				->order_by('staff_no', 'asc')->execute();
			$avstaff2 = DB::select('staff_name')->from('tblstaffsched')
				->where('sched_date', '=', $searchdate)
				->and_where('time_2130', '=', 1)
				->and_where('time_2130_open', '=', 0)
				->and_where('branch_id', '=', 2)
				->order_by('staff_no', 'asc')->execute();
		}
		$course1 = DB::select()->from('tblservice')->where('svc_no', '!=', 0)->where('branch_id', $getbranch_id)->order_by('svc_no', 'asc')->execute();
		$course2 = DB::select()->from('tblservicefacial')->where('svc_no', '!=', 0)->where('branch_id', $getbranch_id)->order_by('svc_no', 'asc')->execute();
		$option = DB::select()->from('tbloption')->where('opt_no', '!=', 0)->where('branch_id', $getbranch_id)->order_by('opt_no', 'asc')->execute();		
		
		if (Input::method() == 'POST'){
		
			$checkList = array(
			'staff' => trim(Input::post('staff')),
			'course1' => trim(Input::post('course1')),
			'course2' => trim(Input::post('course2')),
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
					if($course1!=""){			//checking minutes
					$course1_min = DB::select('svc_time')->from('tblservice')->where('svc_name','=',$course1)->where('branch_id', $getbranch_id)->execute();
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
					if($course2!=""){			//checking minutes
					$course2_min = DB::select('svc_time')->from('tblservicefacial')->where('svc_name','=',$course2)->where('branch_id', $getbranch_id)->execute();
					if(count($course2_min)>0){
						foreach($course2_min as $course2_mins){
							$course2_minsel= $course2_mins['svc_time']; 
						}
						//print $course2_minsel;
					}
					}else{
						$course2_minsel=0;
					}
					
					$option=Input::post('option');
					
					$resdate=date("m/d",strtotime(Input::post('resdate')));
					$restime=Input::post('restime');
					$getbranch_name = Input::post('getbranch_name'); 
					$getbranch_id = Input::post('getbranch_id');
					$name = Auth::get_profile_fields('name');
					$email = Auth::get_email();
					$kana = Auth::get_profile_fields('kana');
					$tel = Auth::get_profile_fields('tel');
					$postno =  Auth::get_profile_fields('post_no');
					$pref= Auth::get_profile_fields('pref');
					$addr1 = Auth::get_profile_fields('addr1');
					$addr2 = Auth::get_profile_fields('addr2');
					$sex = Auth::get_profile_fields('sex');
					$birthy = Auth::get_profile_fields('birthy');
					$birthm = Auth::get_profile_fields('birthm');
					$birthd = Auth::get_profile_fields('birthd');
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

							$num = 1;
							$num_padded = sprintf("%03s", $num);
							//print $num_padded."<br>";						
						}else{
							//print "same time <br>";
							$lastresnum = (int)substr($lastresno,12,3);
							//print $lastresnum;
							$num = $lastresnum + 1;
							$num_padded = sprintf("%03s", $num);
							//print $num_padded."<br>";							
						}

						$resno = (string)date("YmdHi").$num_padded;
						//print "final res no is ".$resno."<br>";
//RESERVATION NUMBER end

					$membercheck = DB::select('member_status')->from('tblusers')
					->where('email','=', Auth::get_email())
					->execute();
					$totalamount = 0;
					foreach($membercheck as $row):
					//print $staff;
					if($staff!="指名なし"){ //指名料を含む
							if ($row['member_status'] === "1"){
							//print "member";
								$course1_cost = DB::select('svc_price_member')->from('tblservice')->where('svc_name','=',$course1)->where('branch_id', $getbranch_id)->execute();
									foreach($course1_cost as $course1_costs){
										$totalamount = $totalamount + $course1_costs['svc_price_member'];
									}

								$course2_cost = DB::select('svc_price_member')->from('tblservicefacial')->where('svc_name','=',$course2)->where('branch_id', $getbranch_id)->execute();
									foreach($course2_cost as $course2_costs){
										$totalamount = $totalamount + $course2_costs['svc_price_member'];									
									}

								$option_cost = DB::select('opt_price_member')->from('tbloption')->where('opt_name','=',$option)->where('branch_id', $getbranch_id)->execute();
									foreach($option_cost as $option_costs){
										$totalamount = $totalamount + $option_costs['opt_price_member'];
									}								
								$totalamount = $totalamount + 540;
							}else{
							//print "not member";
								$course1_cost = DB::select('svc_price_regular')->from('tblservice')->where('svc_name','=',$course1)->where('branch_id', $getbranch_id)->execute();
									foreach($course1_cost as $course1_costs){
										$totalamount = $totalamount + $course1_costs['svc_price_regular'];
									}
							
								$course2_cost = DB::select('svc_price_regular')->from('tblservicefacial')->where('svc_name','=',$course2)->where('branch_id', $getbranch_id)->execute();
									foreach($course2_cost as $course2_costs){
										$totalamount = $totalamount + $course2_costs['svc_price_regular'];
									}

								$option_cost = DB::select('opt_price_regular')->from('tbloption')->where('opt_name','=',$option)->where('branch_id', $getbranch_id)->execute();
									foreach($option_cost as $option_costs){
										$totalamount = $totalamount + $option_costs['opt_price_regular'];
									}								
								$totalamount = $totalamount + 540;
							}
					}else{//指名料なし
					if ($row['member_status'] === "1"){
							//print "member";
								$course1_cost = DB::select('svc_price_member')->from('tblservice')->where('svc_name','=',$course1)->where('branch_id', $getbranch_id)->execute();
									foreach($course1_cost as $course1_costs){
										$totalamount = $totalamount + $course1_costs['svc_price_member'];
									}

								$course2_cost = DB::select('svc_price_member')->from('tblservicefacial')->where('svc_name','=',$course2)->where('branch_id', $getbranch_id)->execute();
									foreach($course2_cost as $course2_costs){
										$totalamount = $totalamount + $course2_costs['svc_price_member'];									
									}

								$option_cost = DB::select('opt_price_member')->from('tbloption')->where('opt_name','=',$option)->where('branch_id', $getbranch_id)->execute();
									foreach($option_cost as $option_costs){
										$totalamount = $totalamount + $option_costs['opt_price_member'];
									}								
	
							}else{
							//print "not member";
								$course1_cost = DB::select('svc_price_regular')->from('tblservice')->where('svc_name','=',$course1)->where('branch_id', $getbranch_id)->execute();
									foreach($course1_cost as $course1_costs){
										$totalamount = $totalamount + $course1_costs['svc_price_regular'];
									}
							
								$course2_cost = DB::select('svc_price_regular')->from('tblservicefacial')->where('svc_name','=',$course2)->where('branch_id', $getbranch_id)->execute();
									foreach($course2_cost as $course2_costs){
										$totalamount = $totalamount + $course2_costs['svc_price_regular'];
									}

								$option_cost = DB::select('opt_price_regular')->from('tbloption')->where('opt_name','=',$option)->where('branch_id', $getbranch_id)->execute();
									foreach($option_cost as $option_costs){
										$totalamount = $totalamount + $option_costs['opt_price_regular'];
									}								
							
							}
					}
					endforeach;			
					
					$data = array();
					$data['rows']= Model_User::find_by('email',Auth::get_email());
					$view = View::forge('reservations/02reserve_confirm', $data);	
					$view->set('staff',$staff);		
					$view->set('course1',$course1);	
					$view->set('course2',$course2);	
					$view->set('course1_minsel',$course1_minsel);	
					$view->set('course2_minsel',$course2_minsel);				
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
					$view->set('getbranch_name',$getbranch_name);	
					$view->set('getbranch_id',$getbranch_id);					
					return $view;
				}else{
						$error = '*必須項目を入力してください';
						$view->set('error', $error);
				}
			}	
		$view->set_global('staff1',$avstaff1->as_array());
		$view->set_global('staff2',$avstaff2->as_array());
		$view->set_global('course1',$course1->as_array());
		$view->set_global('course2',$course2->as_array());
		$view->set_global('option',$option->as_array());			
		$view->content=View::forge('reservations/01reserve_form');
		$view->set('resdate',$resdate);	
		$view->set('restime',$restime);	
		$view->set('weekday',$weekday);
		$view->set('getbranch_name',$getbranch_name);	
		$view->set('getbranch_id',$getbranch_id);
		}
    return $view;
    }

////////////////////////////////RESERVE FINISH//////////////////////////////////////
	
	public function action_reservefinished()
    {
		if ( ! Auth::check())
		{
			$getbranch_name = Session::get('getbranch_name');
			$getbranch_id = Session::get('getbranch_id');
			$staff = Session::get('staff');
			$course1 = Session::get('course1');
			$course2 = Session::get('course2');
			$course1_minsel=Session::get('course1_minsel');
			$course2_minsel=Session::get('course2_minsel');	
			$option = Session::get('option');
			$totalamount = Session::get('totalamount');
			$resdate=date("m/d",strtotime(Session::get('resdate')));
			$restime=Session::get('restime');
			$weekday = \Model\Calendar::display_dayofweek($resdate);	
			$resno=Session::get('resno');
			/* print $getbranch_name."<br>";
			print $getbranch_id."<br>";
			print $staff."<br>";
			print $course1."<br>";
			print $course2."<br>";
			print $option."<br>";
			print $totalamount."<br>";
			print $resdate."<br>";
			print $restime."<br>";
			print $weekday."<br>";
			print $resno."<br>";  */
			
			
			$view = View::forge('reservations/guest');
			$view->set('staff',$staff);		
			$view->set('course1',$course1);	
			$view->set('course2',$course2);	
			$view->set('course1_minsel',$course1_minsel);	
			$view->set('course2_minsel',$course2_minsel);				
			$view->set('option',$option);	
			$view->set('resdate',$resdate);	
			$view->set('restime',$restime);	
			$view->set('weekday',$weekday);
			$view->set('totalamount',$totalamount);	
			$view->set('resno',$resno);	
			$view->set('getbranch_name',$getbranch_name);	
			$view->set('getbranch_id',$getbranch_id);
			return $view;	
		}else{	
			$auth = Auth::instance();
			$name = Auth::get_profile_fields('name');
			$data = array();
			$data['rows']= Model_User::find_by('email',Auth::get_email());	
			$view = View::forge('reservations/03reserve_finished', $data);
			$view->set('name',$name);
			
			$resnumber = Session::get('checkresnunber'); //編集したい予約の予約番号
			$checkstaff = Session::get('checkstaff');
			$checkservice1 = Session::get('checkservice1');
			$checkservice2 = Session::get('checkservice2');
			$checkoption = Session::get('checkoption');
			$day = Session::get('rescheck');
			$reschecktime = Session::get('reschecktime');
			$reschecktime = date('H:i',strtotime($reschecktime));
			$getbranch_id = Session::get('getbranch_id');
			$getbranch_name = Session::get('getbranch_name');
			if (Input::method() == 'POST'){
			$email = Auth::get_email();	
			$res_no = Session::get('resno');
			$staff_name=Session::get('staff');
			$svc_name_1=Session::get('course1');
			$svc_name_2=Session::get('course2');
			$opt_name=Session::get('option');		
			$res_date=Session::get('resdate');
			$res_time=Session::get('restime');			
			$res_date=date("Y-m-d",strtotime($res_date));
			$course1_minsel=Session::get('course1_minsel');
			$course2_minsel=Session::get('course2_minsel');	
			$total_course_time = $course1_minsel+$course2_minsel+30;//30minutes added allowance //+$course3_minsel;	
//			print $total_course_time;
			$res_tot_amt=Session::get('totalamount');
			$res_request=Input::post('freemessage');
			$created_at=date("Y-m-d H:i:s");

			$data=array(
				'email'=>$email,
				'name'=>$name,
				'res_no'=>$res_no,
				'branch_id'=>$getbranch_id,
				'branch_name'=>$getbranch_name,
				'staff_name'=>$staff_name,
				'svc_name_1'=>$svc_name_1,
				'svc_name_2'=>$svc_name_2,
				'opt_name'=>$opt_name,
				'res_date'=>$res_date,
				'res_time'=>$res_time,
				'res_tot_amt'=>$res_tot_amt,
				'res_request'=>$res_request,
				'created_at'=>$created_at,
				
			);
			$query = DB::insert('tblreserve')->set($data)->execute(); //新規予約
			
		////////////////////ADD SERVICE COUNT/////////////////////
			if($svc_name_1 != "なし"){ //COUNT FOR MAIN
				$getcount = DB::select()->from('tblservice')->where('svc_name', $svc_name_1)->where('branch_id', $getbranch_id)->execute();
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
						->where('branch_id', $getbranch_id)
						->set($putcount)
						->execute(); // saving to db
				}else{
					$sel_getcount = $sel_getcount + 1;
					$putcount=array(
						'count'=>$sel_getcount,
					);
					$query = DB::update('tblservice')
						->where('svc_name', '=', $svc_name_1)
						->where('branch_id', $getbranch_id)
						->set($putcount)
						->execute(); // saving to db
				}

			}			
			if($svc_name_2 != "なし"){ //COUNT FOR FACIAL
				$getcount = DB::select()->from('tblservicefacial')->where('svc_name', $svc_name_2)->where('branch_id', $getbranch_id)->execute();
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
						->where('branch_id', $getbranch_id)
						->set($putcount)
						->execute(); // saving to db
				}else{
					$sel_getcount = $sel_getcount + 1;
					$putcount=array(
						'count'=>$sel_getcount,
					);
					$query = DB::update('tblservicefacial')
						->where('svc_name', '=', $svc_name_2)
						->where('branch_id', $getbranch_id)
						->set($putcount)
						->execute(); // saving to db
				}

			}						
			if($opt_name != "なし"){ //COUNT FOR OPTION
				$getcount = DB::select()->from('tbloption')->where('opt_name', $opt_name)->where('branch_id', $getbranch_id)->execute();
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
						->where('branch_id', $getbranch_id)
						->set($putcount)
						->execute(); // saving to db
				}else{
					$sel_getcount = $sel_getcount + 1;
					$putcount=array(
						'count'=>$sel_getcount,
					);
					$query = DB::update('tbloption')
						->where('opt_name', '=', $opt_name)
						->where('branch_id', $getbranch_id)
						->set($putcount)
						->execute(); // saving to db
				}

			}

			///////////////////////UPDATE STAFF SCHEDULE START/////////////////////////
			if($staff_name=="指名なし"){ //START CHECK IF FREE STAFF
				//print "FREE STAFF";
			}else{
				if($res_time=="10:00"){	
					if($total_course_time<=60){
						
						$putsched=array(
							'time_10_open' => 1,
							'time_1030_open' => 1,							
						);
						$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_10_open' => 1,
							'time_1030_open' => 1,
							'time_11_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_10_open' => 1,
							'time_1030_open' => 1,
							'time_11_open' => 1,
							'time_1130_open' => 1,
							'time_12_open' => 1,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_10_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_1030_open' => 1,
							'time_11_open' => 1,
							'time_1130_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_1030_open' => 1,
							'time_11_open' => 1,
							'time_1130_open' => 1,
							'time_12_open' => 1,
							'time_1230_open' => 1,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_1030_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_11_open' => 1,
							'time_1130_open' => 1,
							'time_12_open' => 1,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_11_open' => 1,
							'time_1130_open' => 1,
							'time_12_open' => 1,
							'time_1230_open' => 1,
							'time_13_open' => 1,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_11_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_1130_open' => 1,
							'time_12_open' => 1,	
							'time_1230_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1130_open' => 1,
							'time_12_open' => 1,
							'time_1230_open' => 1,
							'time_13_open' => 1,	
							'time_1330_open' => 1,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1130_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_12_open' => 1,
							'time_1230_open' => 1,
							'time_13_open' => 1,	
							'time_1330_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_12_open' => 1,
							'time_1230_open' => 1,
							'time_13_open' => 1,
							'time_1330_open' => 1,
							'time_14_open' => 1,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_12_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1230_open' => 1,
							'time_13_open' => 1,	
							'time_1330_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1230_open' => 1,
							'time_13_open' => 1,
							'time_1330_open' => 1,
							'time_14_open' => 1,	
							'time_1430_open' => 1,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1230_open' => 1,
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
					}elseif($total_course_time<=270){
						
						$putsched=array(							
							'time_1230_open' => 1,
							'time_13_open' => 1,
							'time_1330_open' => 1,
							'time_14_open' => 1,
							'time_1430_open' => 1,
							'time_15_open' => 1,	
							'time_1530_open' => 1,
							'time_1630_open' => 1,
							'time_17_open' => 1,
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_13_open' => 1,
							'time_1330_open' => 1,
							'time_14_open' => 1,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_13_open' => 1,
							'time_1330_open' => 1,
							'time_14_open' => 1,
							'time_1430_open' => 1,
							'time_15_open' => 1,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_13_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1330_open' => 1,
							'time_14_open' => 1,	
							'time_1430_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1330_open' => 1,
							'time_14_open' => 1,
							'time_1430_open' => 1,
							'time_15_open' => 1,	
							'time_1530_open' => 1,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1330_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_14_open' => 1,
							'time_1430_open' => 1,
							'time_15_open' => 1,							
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_14_open' => 1,
							'time_1430_open' => 1,
							'time_15_open' => 1,
							'time_1530_open' => 1,
							'time_16_open' => 1,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_14_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1430_open' => 1,
							'time_15_open' => 1,	
							'time_1530_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1430_open' => 1,
							'time_15_open' => 1,
							'time_1530_open' => 1,
							'time_16_open' => 1,	
							'time_1630_open' => 1,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1430_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_15_open' => 1,
							'time_1530_open' => 1,
							'time_16_open' => 1,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_15_open' => 1,
							'time_1530_open' => 1,
							'time_16_open' => 1,
							'time_1630_open' => 1,
							'time_17_open' => 1,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_15_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1530_open' => 1,
							'time_16_open' => 1,	
							'time_1630_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1530_open' => 1,
							'time_16_open' => 1,
							'time_1630_open' => 1,
							'time_17_open' => 1,
							'time_1730_open' => 1,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1530_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_16_open' => 1,
							'time_1630_open' => 1,
							'time_17_open' => 1,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_16_open' => 1,
							'time_1630_open' => 1,
							'time_17_open' => 1,
							'time_1730_open' => 1,
							'time_18_open' => 1,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_16_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1630_open' => 1,
							'time_17_open' => 1,	
							'time_1730_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1630_open' => 1,
							'time_17_open' => 1,
							'time_1730_open' => 1,
							'time_18_open' => 1,	
							'time_1830_open' => 1,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1630_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_17_open' => 1,
							'time_1730_open' => 1,
							'time_18_open' => 1,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_17_open' => 1,
							'time_1730_open' => 1,
							'time_18_open' => 1,
							'time_1830_open' => 1,
							'time_19_open' => 1,	
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
							'time_17_open' => 1,
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
					}elseif($total_course_time<=270){
						
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
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1730_open' => 1,
							'time_18_open' => 1,	
							'time_1830_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1730_open' => 1,
							'time_18_open' => 1,
							'time_1830_open' => 1,
							'time_19_open' => 1,	
							'time_1930_open' => 1,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(							
							'time_1730_open' => 1,
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_18_open' => 1,
							'time_1830_open' => 1,
							'time_19_open' => 1,	
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_18_open' => 1,
							'time_1830_open' => 1,
							'time_19_open' => 1,
							'time_1930_open' => 1,
							'time_20_open' => 1,
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
					}elseif($total_course_time<=210){
						
						$putsched=array(
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
				
				}elseif($res_time=="18:30"){//////18:30
					if($total_course_time<=60){
						
						$putsched=array(							
							'time_1830_open' => 1,
							'time_19_open' => 1,
						);
						$query = DB::update('tblstaffsched')->where('staff_name', '=', $staff_name)->and_where('sched_date', '=', $res_date)->set($putsched)->execute(); // saving to db
					}elseif($total_course_time<=90){
						
						$putsched=array(							
							'time_1830_open' => 1,
							'time_19_open' => 1,	
							'time_1930_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(							
							'time_1830_open' => 1,
							'time_19_open' => 1,
							'time_1930_open' => 1,
							'time_20_open' => 1,							
							'time_2030_open' => 1,
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_19_open' => 1,
							'time_1930_open' => 1,
							'time_20_open' => 1,
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
					}elseif($total_course_time<=150){
						
						$putsched=array(
							'time_19_open' => 1,
							'time_1930_open' => 1,
							'time_20_open' => 1,
							'time_2030_open' => 1,
							'time_21_open' => 1,	
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_1930_open' => 1,
							'time_20_open' => 1,
							'time_2030_open' => 1,
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
					}elseif($total_course_time<=90){
						
						$putsched=array(
							'time_20_open' => 1,
							'time_2030_open' => 1,
							'time_21_open' => 1,
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
		$view->content=View::forge('reservations/03reserve_finished');
		$view->set('resno',$res_no);//新規予約
		$view->set('name',$name);
		//}
		
 		//RESERVE MAIL
		 $email = Auth::get_email();

		 $email = htmlspecialchars($email);
		 
//データベース接続
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
		 $getbranch_name.
		 $res_date=date("Y-m-d",strtotime($res_date))." ".
		 $res_time=Session::get('restime')."～"."\n"."\n".
		 "でご予約いただいております"."\n"."\n".
		 $tblmailtype['body']."\n"."\n".$tblmailtype['footer']."\n"."\n".$tblmail['signature'];
		 
		 $mailfrom="From:" .$tblmail['mail_add'];
		 mb_send_mail($mailto,$subject,$mailbody,$mailfrom); 
		 return $view;
		}
    return $view;
    }
	
//////////////////////////////////////////////////////////////////////

	public function action_weekone()
    {
		//$data = array();
		//$data['rows']= Model_User::find_by('email',Auth::get_email());	
		
		$cal_form = Fieldset::forge('cal_form');
		$cal_form -> add('lastdate','lastdate',array('type'=>'hidden'));
		$cal_form -> field('lastdate');
		$this->cal_form=$cal_form;
		$lastdate = Input::post('lastdate');

		$getbranch_name = Input::post('br_name');
		$getbranch_id = Input::post('br_id');		
		
		$view = View::forge('reservations/00reserve_calendar');	
		$view->set('getbranch_name',$getbranch_name);	
		$view->set('getbranch_id',$getbranch_id);	
        return $view;
    }
	
	public function action_weektwo()
    {
		
		$cal_form = Fieldset::forge('cal_form');
		$cal_form -> add('lastdate','lastdate',array('type'=>'hidden'));
		$cal_form -> field('lastdate');
		$this->cal_form=$cal_form;
		$lastdate = Input::post('lastdate');
		
		$getbranch_name = Input::post('br_name');
		$getbranch_id = Input::post('br_id');		
		
		$data = array();
		$data['rows']= Model_User::find_by('email',Auth::get_email());
		$view = View::forge('reservations/00reserve_weektwo', $data);	
		$view->set('getbranch_name',$getbranch_name);	
		$view->set('getbranch_id',$getbranch_id);	
        return $view;
    }
	
	public function action_weekthree()
    {

		$cal_form = Fieldset::forge('cal_form');
		$cal_form -> add('lastdate','lastdate',array('type'=>'hidden'));
		$cal_form -> field('lastdate');
		$this->cal_form=$cal_form;
		$lastdate = Input::post('lastdate');
		
		$getbranch_name = Input::post('br_name');
		$getbranch_id = Input::post('br_id');		
	
		$data = array();
		$data['rows']= Model_User::find_by('email',Auth::get_email());
		$view = View::forge('reservations/00reserve_weekthree', $data);	
		$view->set('getbranch_name',$getbranch_name);	
		$view->set('getbranch_id',$getbranch_id);	
		
        return $view;
    }

	public function action_weekfour()
    {
		$cal_form = Fieldset::forge('cal_form');
		$cal_form -> add('lastdate','lastdate',array('type'=>'hidden'));
		$cal_form -> field('lastdate');
		$this->cal_form=$cal_form;
		$lastdate = Input::post('lastdate');
		
		$getbranch_name = Input::post('br_name');
		$getbranch_id = Input::post('br_id');		

		$data = array();
		$data['rows']= Model_User::find_by('email',Auth::get_email());
		$view = View::forge('reservations/00reserve_weekfour', $data);		
		$view->set('getbranch_name',$getbranch_name);	
		$view->set('getbranch_id',$getbranch_id);	
        return $view;
    }	
	

	/****************:Avie code:************************/
	public function action_member_profile_change()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
	if ( ! Auth::check())
		{
			$view = View::forge('reservations/reserve_top');			
		}else{
		$auth = Auth::instance();

		
		///////////////////////////////
		$user = new Model_User();
		////////////////////////////////

		$name = Auth::get_profile_fields('name');
		$kana = Auth::get_profile_fields('kana');
		$tel = Auth::get_profile_fields('tel');
		$postno =  Auth::get_profile_fields('post_no');
		$pref= Auth::get_profile_fields('pref');
		$addr1 = Auth::get_profile_fields('addr1');
		$addr2 = Auth::get_profile_fields('addr2');
		$sex = Auth::get_profile_fields('sex');
		$birthy = Auth::get_profile_fields('birthy');
		$birthm = Auth::get_profile_fields('birthm');
		$birthd = Auth::get_profile_fields('birthd');
				
			
		
		$data = array();
		$data['rows']= Model_User::find_by('email',Auth::get_email());	
		
		
		if($data['rows'] === null)
		{
			// not found
			print('Null');
		}
		else
		{
			// found
			
			$view = View::forge('reservations/member_profile_change', $data);
		
			
		}
		//$users = Model_User::find(array('select' => 'password'));
	
		$view->set('name',$name);
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

			
		}
    return $view;
    }
	
	/*********************************************************Profile Change Confirmation Page******************************************************************************/
	public function action_member_profile_changeC()
    {	
		if ( ! Auth::check())
		{
			$view = View::forge('reservations/reserve_top');			
		}else{	
		 $data = array();
		 $data['rows']= Model_User::find_by('email',Auth::get_email());	
		if($data['rows'] === null)
		{
			// not found
			//print('Null');
		}
		else
		{
			// found
			
		
	
			$err = false;
	 	Session::set('err', $err);
		
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
			$val->add_callable(new MyValidation());
			$val->add('email', 'メールアドレス')
				->add_rule('valid_email')
				->add_rule('required');													
			$val->add('cus_name', 'お名前')
				->add_rule('required')
				->add_rule('min_length', '2');
			$val->add('cus_kana', 'フリガナ')
				->add_rule('kana');	
			$val->add('cus_tel', '電話番号')
				->add_rule('valid_numeric')
				->add_rule('min_length', '7')
				->add_rule('max_length', '11');
			$val->add('cus_zip', '郵便番号')
				->add_rule('valid_numeric')
				->add_rule('exact_length', '7');			
			$val->add('cus_pref', '都道府県');
			$val->add('cus_addr1', '市区町村・番地');
			$val->add('cus_addr2', '住所');	
			$val->add('cus_sex', '性別')
                ->add_rule('required');
			$val->add('cus_birthy', '生年月日')
				->add_rule('required');
			$val->add('cus_birthm', '生年月日')
				->add_rule('required');
			$val->add('cus_birthd', '生年月日')
				->add_rule('required');
			
			
								
				
						
				}		
						
		
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
		
			$name = Auth::get_profile_fields('name');
			$view = View::forge('reservations/member_profile_changeC', $data);

		 
		 //======================================================================================//
			
			
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
			
			
			

		}	
			
         return $view;
		
		 
    }
	
	/*==========================================================================================================================================*/

	
	public function action_member_profile_changeF()
    {
	if ( ! Auth::check())
		{
			$view = View::forge('reservations/reserve_top');			
		}else{
		$auth = Auth::instance();
		
		$password='';
		$username=Session::get('cus_mail');
		$email=Session::get('cus_mail');
		$name=Session::get('cus_name');
		$kana=Session::get('cus_kana');
		$tel=Session::get('cus_tel');
		$zip=Session::get('cus_zip');
		$pref=Session::get('cus_pref');
		$addr1=Session::get('cus_addr1');
		$addr2=Session::get('cus_addr2');
		$sex=Session::get('cus_sex');
		$birthy=Session::get('cus_birthy');
		$birthm=Session::get('cus_birthm');
		$birthd=Session::get('cus_birthd');
		
		$userdata = array();
		$userdata['rows']= Model_User::find_by('email',Auth::get_email());	
		
	
		$user = $auth->update_user(array(
			$username,
			$password,
			'email'=>$email,
			1,
			
				'name' => $name,
				'kana' => $kana,
				'tel' => $tel,
				'post_no' => $zip,
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
	
		// CHANGE PROFILE MAIL
		 $email = Auth::get_email();
		 
		 $email=htmlspecialchars($email);
		 
//データベース接続
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

         $view = View::forge('reservations/member_profile_changeF');
		 $view->set('name',$name);
		 
		 
		} 
    return $view;
    }
	
	public function action_changepassword()
    {
		Session::delete('checkresnunber');
		Session::delete('rescheck');
		Session::delete('reschecktime');
		Session::delete('checkstaff');
		Session::delete('checkservice1');
		Session::delete('checkservice2');
		Session::delete('checkoption');
		if ( ! Auth::check())
		{
			$view = View::forge('reservations/reserve_top');			
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
	

			 $view = View::forge('reservations/member_profile_changepassword');
			 $view->set('name',$name);
			 }
	return $view;
		
	}
	
	public function action_passwordchange_finished($values=null){
	if ( ! Auth::check())
	{
		$view = View::forge('reservations/reserve_top');			
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
						Response::redirect_back('reservations/member_profile_changepassword', 'refresh');
						
					}else{
						$user=Auth::change_password(Input::post('oldloginpw'),Input::post('loginpw'));

						Session::set_flash('invalid_password',' ');
						Session::set_flash('mismatch',' ');
						
						$email = Auth::get_email();
						 
						 $email=htmlspecialchars($email);
						 
				//データベース接続
						 $query = DB::select()->from('tblmail');
						 $result = $query->execute();

						 $tblmail = $result;
						 foreach($result as $tblmail);
						  
						 $query = DB::select()->from('tblmailtype')
						 ->where('type','=','パスワード変更');
						 
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
						
						$view = View::forge('reservations/member_profile_changepassword_finished');
						$view->set('name',$name);
						return $view;
					}
				
				}else{
					Session::set_flash('invalid_password','パスワードが違います。');
					Response::redirect_back('reservations/member_profile_changepassword', 'refresh');
					
				}

				
		}
	}
			 
	}

	


/*==========================================================================================================================================*/
	
}

?>