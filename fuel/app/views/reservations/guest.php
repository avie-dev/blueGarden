<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="http://666522dacac20340.lolipop.jp/bluegarden/blueGarden/assets/img/candle.ico">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8;IE=EmulateIE9" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blue Garden -アロマサロン予約システム</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="keywords" content="blue garden" />
<meta name="description" content="Blue Garden アロマサロン" />

<?php echo Asset::css('bluegarden_style.css');?>
<?php echo Asset::js('jquery.min.js');?>
<?php echo Asset::js('menu_jquery.js');?>
	
</head>
<body onload="setFocus()" class="MyGradientClass">
	<div id="bluegarden_container">
		<div id="bluegarden_header"></div> <!-- end of header -->
	    <div id="bluegarden_menu">
	        <ul>
	            <li><a href="index" class="current">トップ</a></li>
		  <li><a href="mypage" >Myページ</a></li>
	            <li><a href="privacy">プライバシー規約</a></li>
		    <li><a href="http://aromasalon-bluegarden.jp/" >Blue Gardenのホームページ</a></li>
	           
	                     
	       </ul>  
	    </div> <!-- end of menu -->

	    <div id="bluegarden_content">
<!-- left column -->
    <div id="bluegarden_content">
    	
		<div id = "bluegarden_left">
		
 			<div class="left_col_section">	
				<p class="columntitle" style="text-align:center;">My Page</p>
				<div class="left_inside">

					<?php if(Auth::get_profile_fields('name')!=""){?>
					<p>&nbsp;</p>
					<p><span class="attention"><?php echo Auth::get_profile_fields('name'); ?> 様</span></p><br />
					<p>いつもご利用ありがとうございます。</p>
					<p>&nbsp;</p>
					<div id='cssmenu'>
						<ul>
						   <li class='has-sub'><a href='#'><span>会員情報</span></a>
						      <ul>
						         <li><a href='member_profile_change'><span>登録情報の変更</span></a></li>
								 <li><a href='changepassword'><span>パスワードの変更</span></a></li>
						         <li class='last'><a href='quitmembershipnot'><span>退会申請</span></a></li>
						      </ul>
						   </li>
						   <li class='has-sub last'><a href='#'><span>予約状況</span></a>
						      <ul>
						         <li><a href='checkreservation'><span>予約の確認</span></a></li>
						         <li class='last'><a href='reservationhistory'><span>予約の履歴</span></a></li>
						      </ul>
						   </li>
						</ul>
						<br>
						<ul>
						         <li><a href='staff'><span>スタッフ一覧</span></a></li>
						</ul>
						<ul>
						         <li><a href='course'><span>メニュー/コース一覧</span></a></li>
						</ul>
					</div>
					<?php }else{?>
					<p>&nbsp;</p>
					<p><span class="attention">ゲスト 様</span></p><br />
					<p>こんにちは！</p>
					<p>&nbsp;</p>
					<div id='cssmenu'>
						<ul>
						         <li><a href='staff'><span>スタッフ一覧</span></a></li>
						</ul>
						<ul>
						         <li><a href='course'><span>メニュー/コース一覧</span></a></li>
						</ul>
					</div>
					<?php } ?>
				
				</div>
			</div>
			<?php if(Auth::get_profile_fields('name')!=""){?>
			<div class="left_col_section">	
				<table  width="100%"><tr class="columntitle_button"><td align="center"><a href="logout">ログアウト</a></td></tr></table>
			</div>			
			<?php }else{?>	
			<div class="left_col_section">
					<a href="reserve"><?php echo Asset::img('reservebtn.gif',array('width' => '245'));?></a>
			</div>
			<?php }?>
	
	
       		
    	</div>		


        <!-- end of left -->  	
			<p>&nbsp;</p>
	    	
	  
	        <div id="bluegarden_right">
		<!--	追加		--> 
			<?php Session::delete('checkday');?>
		<!--	追加		--> 
			<div class="right_col_section">
				<table  width="100%"><tr class="columntitle"><td>ゲスト予約</td></tr></table>
				<p><center>マイページを表示するには、ログインをするか、新規登録を行ってください。</center></p>
				<p><center>登録していただくと、次回からの予約が簡単にご利用いただけます。 </center></p>
				<p>&nbsp;</p>
				
				<div class="left_col_section">	
					
						<table width="100%" style="border:none;">
							<tr>
								<td height="250">
									<p class="columntitle" >登録済みの方</p>
									<form id="form1" method="post" action="guestlogin">
									<center>
										<table width="90%" style="border:none" class="loginspacer">
										<p>ログインIDとパスワードを入力してください。</p>
											<tr style="border:none">
												<td style="border:none">ユーザー名<input style="width:150px;margin-left:10px;" type="text" name="username" id="username" /></td>
											</tr>
											<tr>
												<td style="border:none">パスワード<input style="width:150px;margin-left:10px;" type="password" name="password" id="password" /></td>
											</tr>
											<tr>
											<?php if (Session::get_flash('error')): ?>
														<div class="alert alert-error">
															<p>
															<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
															</p>
														</div>
											<?php endif; ?>
											</tr>
											<tr>
												<td colspan="2" align="center" style="border:none;padding-bottom:10px;">
													<p>&nbsp;</p>	
													<input type="submit" name="login" id="login" value="ログイン" />
													<input type="reset" name="cancel" id="cancel" value="キャンセル" />

												</td>
											</tr>
										</table>
										<?php
										echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
										echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
										echo Form::input('staff', Input::post('staff', $staff),array('type'=>'hidden'));
										echo Form::input('course1', Input::post('course1', $course1),array('type'=>'hidden'));
										echo Form::input('course2', Input::post('course2', $course2),array('type'=>'hidden'));
										echo Form::input('course1_minsel', Input::post('course1_minsel', $course1_minsel),array('type'=>'hidden'));
										echo Form::input('course2_minsel', Input::post('course2_minsel', $course2_minsel),array('type'=>'hidden'));
										echo Form::input('option', Input::post('option', $option),array('type'=>'hidden'));
										echo Form::input('totalamount', Input::post('totalamount', $totalamount),array('type'=>'hidden'));
										echo Form::input('resdate', Input::post('resdate', $resdate),array('type'=>'hidden'));
										echo Form::input('restime', Input::post('restime', $restime),array('type'=>'hidden'));
										echo Form::input('weekday', Input::post('weekday', $weekday),array('type'=>'hidden'));
										echo Form::input('resno', Input::post('resno', $resno),array('type'=>'hidden'));
										
										$getbranch_name = Session::set('getbranch_name',$getbranch_name);
										$getbranch_id = Session::set('getbranch_id',$getbranch_id);
										$staff = Session::set('staff',$staff);
										$course1 = Session::set('course1',$course1);
										$course2 = Session::set('course2',$course2);
										$course1_minsel = Session::set('course1_minsel',$course1_minsel);
										$course2_minsel = Session::set('course2_minsel',$course2_minsel);
										$option = Session::set('option',$option);
										$totalamount = Session::set('totalamount',$totalamount);
										$resdate= Session::set('resdate',$resdate);
										$restime=Session::set('restime',$restime);
										$weekday = Session::set('weekday',$weekday );
										$resno=Session::set('resno',$resno);							
										
										?>										
									</form>

								</td>
								<td height="250">&nbsp;<br>&nbsp;
									<p class="columntitle" >はじめての方</p>
									<p>会員登録すると次回からはログインID<br>&nbsp;&nbsp;&nbsp;とパスワードの入力だけで予約できます。</p>
									<center>
									<table  width="60%" style="border:none;padding-bottom:10px;" height="140" >
										<tr>
											<?php if (Session::get_flash('error')): ?>
											
														<p>&nbsp;</p>
														<p>&nbsp;</p>

											<?php endif; ?>
										</tr>
										<tr class="columntitle_button" style="height:50px; border:none; width:100px;" rowspan="2">
											<td align="center" width="100%"><a href="guestsignup">登録して予約</a></td>
										</tr>
										<tr><td style="border:none">&nbsp;</td></tr>
									</table></center>

								</td>								
							</tr>						
						</table>
						
						
						
					  
					
				</div>
				

				
			</div>
		        <div class="cleaner"><p>&nbsp;</p></div> 
		        
	        </div> <!-- end of right -->
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	           <a href="index" class="current">トップ</a>|
	           <a href="mypage" >Myページ</a>|
	           <a href="privacy">プライバシー規約</a>|
		   <a href="http://aromasalon-bluegarden.jp/" >Blue Gardenのホームページ</a>
	          
	           <br />
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div>
	    <!-- end of footer -->

	</div> <!-- end of container -->
</body>
</html>