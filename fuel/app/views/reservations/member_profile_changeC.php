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
<div id="bluegarden_container">
	<div id="bluegarden_header">
	    		<div class="topaddin"> </div>

	 </div><!-- end of header -->
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
					<p><span class="attention"><?php echo  Auth::get_profile_fields('name'); ?> 様</span></p><br />
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
	         <table width="100%" border="0"  class="columntitle">
			<tr><td>会員情報変更の確認</td></tr>
		</table>
		<table width="100%" border="0">
			 <table width="100%" border="0" class="type1">
		    <tr>
		      <th width="150">メールアドレス</th>
		      <td><?php echo $email ?></td>
		    </tr>
		    <tr>
		      <th width="150">お名前</th>
		      <td><?php echo $name ?></td>
		    </tr>
		    <tr>
		      <th width="150">フリガナ</th>
		      <td><?php echo $kana?></td>
		    </tr>
		    <tr>
		      <th width="150">電話番号</th>
		      <td><?php echo $tel ?></td>
		    </tr>
		    <tr>
		      <th width="150">郵便番号</th>
		      <td><?php echo $postno ?>
		      </td>
		    </tr>
		    <tr>
		      <th width="150">住所</th>
		      <td><?php echo $pref ?><?php echo $addr1 ?><?php echo $addr2?>
		      </td>
		    </tr>
		    <tr>
		      <th width="150">性別</th>
		      <td><?php echo $sex ?></td>
		    </tr>
		    <tr>
		      <th width="150">生年月日</th>
		      <td><?php echo $birthy ?>年 <?php echo $birthm ?>月 <?php echo $birthd ?>日</td>
		    </tr>
		
			<tr>	
				<td align="center" colspan="2" style="padding-top:15px;padding-bottom:15px;">
				<form action="member_profile_changeF" method="post" name="profile_change_finished">
					<input name="submit" type="submit" value="登録する" >
					<input action="action" type="button" value="修正" onclick="history.go(-1);" />
				</form>
				</td>
			</tr>
		  </table>

		</table>
	          </center><p>&nbsp;</p>
		<p align="right"><a href="mypage">My Pageトップへ</a></p>
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