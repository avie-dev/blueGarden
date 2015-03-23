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

<body class="MyGradientClass">
<?php //foreach($rows as $row): ?>
<div id="bluegarden_container">
	<div id="bluegarden_header">
	    		<div class="topaddin"> </div>

	 </div> <!-- end of header -->
    <div id="bluegarden_menu">
		<ul>
			<li><a href="index" class="current">トップ</a></li>
			<li><a href="mypage" >Myページ</a></li>
			<li><a href="privacy">プライバシー規約</a></li>
			<li><a href="http://aromasalon-bluegarden.jp/" >Blue Gardenのホームページ</a></li>
		</ul>   
    </div> <!-- end of menu -->

    <!-- left column -->
    <div id="bluegarden_content">
    	
	          <div id = "bluegarden_left">
		
 			<div class="left_col_section">	
				<p class="columntitle" style="text-align:center;">My Page</p>
				<div class="left_inside">
					<p>&nbsp;</p>
					<p><span class="attention"><?php echo $name; ?> 様</span></p><br>
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
					</div>
				
				</div>
			</div>
			<div class="left_col_section">	
			
				<table  width="100%"><tr class="columntitle_button"><td align="center"><a href="logout">ログアウト</a></td></tr></table>
			</div>

			<div class="left_col_section">
				<a href="reserve">
				<?php
					echo Asset::img('reservebtn.gif',array('width' => '245'));
					
				?></a>
			</div>
		
	
	
       		
    	 </div>
		

        <!-- end of left -->
    	<p>&nbsp;</p>
	    	
	  
	        <div id="bluegarden_right">
	        
	          <div class="right_col_section">
	           	<table  width="100%"><tr class="columntitle"><td>パスワードの変更</td></tr></table>
				<p>&nbsp;</p>
	  
	   
			<div class="box-type1 ns">
			
			<p><span class="attention" ><?php echo Session::get_flash('mismatch')?></span></p>
			<form action="passwordchange_finished" method="post" name="user_form">
			  <table width="100%" border="0" class="type1">
			  
				
				<tr>
		          <th>現在のパスワード</th>
		            <td><p class="attention"></p>
					&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Form::input('oldloginpw', Input::post('oldloginpw'), array('type'=>'password','required' => 'required', 'class' => 'password')) ?>
		           
		              <p class="caption"><span class="attention" ><?php echo Session::get_flash('invalid_password')?></span></p>
		              <p class="attention"></p>&nbsp;&nbsp;&nbsp;
		             
		            </td>
		        </tr>

				<tr>
		          <th>新しいパスワード</th>
		            <td><p class="attention"></p>
					&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Form::input('loginpw', Input::post('loginpw'), array('type'=>'password','required' => 'required', 'class' => 'password')) ?>
		           
		              <span class="attention"><br>&nbsp;&nbsp;&nbsp;※半角英数字記号 4～20文字で入力してください</span>
		              <p class="attention"></p>&nbsp;&nbsp;&nbsp;
		             
		            </td>
		        </tr>
				<tr>
		          <th>新しいパスワード再入力</th>
		            <td><p class="attention"></p>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo Form::input('loginpw_chk', Input::post('loginpw_chk'), array('type'=>'password','required' => 'required', 'class' => 'password'), array( 'match_field', 'loginpw' ) ) ?>
		           
		              <span class="attention"><br>&nbsp;&nbsp;&nbsp;※確認のためにもう一度パスワードを入力してください</span>
		              
		            </td>
		        </tr>
			
				<tr>	
					<td align="center" colspan="2" style="padding-top:15px;padding-bottom:15px;">
						
							
							<input name="submit" type="submit" value="パスワードを変更する" >
						
					</td>
				</tr>
				<?php //echo Form::close();?>
				
				</form>
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