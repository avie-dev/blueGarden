<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="http://666522dacac20340.lolipop.jp/bluegarden/blueGarden/assets/img/candle.ico">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8;IE=EmulateIE9" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blue Garden -アロマサロン予約システム</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="blue garden" />
<meta name="description" content="Blue Garden アロマサロン" />

<?php echo Asset::css('bluegarden_style.css');?>
<?php echo Asset::js('jquery.min.js');?>
<?php echo Asset::js('menu_jquery.js');?>

</head>

<body class="MyGradientClass">
<div id="bluegarden_container">
		<div id="bluegarden_header">

		</div> <!-- end of header -->
    <div id="bluegarden_menu">
        <ul>
            <li><a href="index" class="current">トップ</a></li>
	　　<li><a href="mypage" >Myページ</a></li>
            <li><a href="privacy">プライバシープロトコル</a></li>
	    <li><a href="http://localhost:1337/blueGarden/index.html" >Blue Gardenのホームページ</a></li>
           
                     
       </ul> 
    </div> <!-- end of menu -->

    <!-- left column -->
    <div id="bluegarden_content">
    	
	          <div id = "bluegarden_left">
		
 			<div class="left_col_section">	
				<p class="columntitle" style="text-align:center;">My Page</p>
				<div class="left_inside">
					<p>&nbsp;</p>
					<?php $username = Session::get('username'); ?>
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
				?>

				</a>
			</div>
		
	
	
       		
    	 </div>


        <!-- end of left -->
    	<p>&nbsp;</p>
    	
  
        <div id="bluegarden_right">
        
          <div class="right_col_section">
	          <center>
		<table width="100%" border="0"  class="columntitle">
			<tr><td>予約編集完了</td></tr>
		</table>
		<table width="100%" border="0">
			
			<tr><p>&nbsp;</p><p　align="center">予約をキャンセルいたしました。またのご利用をお待ちしております。</p></td></tr>
		

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
           <a href="privacy">プライバシープロトコル</a>|
	   <a href="http://localhost:1337/blueGarden/index.html" >Blue Gardenのホームページ</a>
          
           <br />
   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
   </div> 
    <!-- end of footer -->

</div> <!-- end of container -->



</body>
</html>