<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8;IE=EmulateIE9" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blue Garden -アロマサロン予約システム</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="keywords" content="blue garden" />
<meta name="description" content="Blue Garden アロマサロン" />
<?php echo Asset::css('bluegarden_style.css');?>
<?php echo Asset::js('jquery.min.js');?>
<?php echo Asset::js('menu_jquery.js');?>

 <?php echo Asset::js('jquery-1.2.6.js');?>
<?php echo Asset::css('ui.tabs.css');?>
<?php echo Asset::js('ui.core.js');?>
<?php echo Asset::js('ui.tabs.js');?> 
</head>

<body class="MyGradientClass">
<div id="bluegarden_container">
		<div id="bluegarden_header">
			<div class="topaddin">

			</div>	
		</div> 
    <div id="bluegarden_menu">
        <ul>
            <li><a href="index" class="current">トップ</a></li>
	  <li><a href="mypage" >Myページ</a></li>
            <li><a href="privacy">プライバシー規約</a></li>
	    <li><a href="http://aromasalon-bluegarden.jp/" >Blue Gardenのホームページ</a></li>
           
                     
       </ul> 
    </div> 
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
			<?php } ?>
			<div class="left_col_section">				
				<a href="reserve">
				<?php
					echo Asset::img('reservebtn.gif',array('width' => '245'));
				?>
				</a>
			</div>
		
	
	
       		
    	 </div>


    	<p>&nbsp;</p>
    	
	        <div id="bluegarden_right">
		         
			<div class="right_col_section">
	<!--追加　start-->
			<center>
				<table  width="100%"><tr class="columntitle"><td>スタッフの紹介</td></tr></table>
				<p>&nbsp;</p>


				<script type="text/javascript">
							$(function() {
								$('#ui-tab > ul').tabs();
							});
						</script>
				<div id="ui-tab">
						<ul>
							<li><a href="#fragment-1"><span>上永谷店</span></a></li>
							<li><a href="#fragment-2"><span>伊勢佐木長者町</span></a></li>
							<li>
						</ul>
				<div id="fragment-1">
						<p><span style="color:red;">※こちらは、上永谷店のスタッフ情報になります。</span></p>
				<?php foreach($store1 as $row): ?>
				<table style="width:550px;margin-top:10px;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:15px;border:1px;-moz-border-radius: 2px;	border-radius: 1px;	-moz-box-shadow: 0 1 1px 1px #888;	-webkit-box-shadow: 0 0 2px 2px#888;box-shadow: 0 0 1px 1px #888;">
					
					<tr>
					

					<td style="margin-top:10px;padding-top:10px;padding-bottom:10px;" width="25%">スタッフ名：</td><td><?php echo $row['staff_name']; ?></td></tr>
					<tr><td colspan>性別：</td><td><?php echo $row['sex']; ?></td></tr>
					<tr width="150"><td>自己紹介：</td><td><?php echo $row['introduce']; ?></td></tr>
			
				</table>
				<p>&nbsp;</p>
				<?php endforeach; ?>	
				<p>&nbsp;</p>
				<p align="right"><a href="mypage">My Pageトップへ</a></p>
				</div>

				<div id="fragment-2">
						<p><span style="color:red;">※こちらは、伊勢佐木長者町のスタッフ情報になります。</span></p>
				<?php foreach($store2 as $row): ?>
				<table style="width:550px;margin-top:10px;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:15px;border:1px;-moz-border-radius: 2px;	border-radius: 1px;	-moz-box-shadow: 0 1 1px 1px #888;	-webkit-box-shadow: 0 0 2px 2px#888;box-shadow: 0 0 1px 1px #888;">
					
					<tr>
					

					<td style="margin-top:10px;padding-top:10px;padding-bottom:10px;" width="25%">スタッフ名：</td><td><?php echo $row['staff_name']; ?></td></tr>
					<tr><td colspan>性別：</td><td><?php echo $row['sex']; ?></td></tr>
					<tr width="150"><td>自己紹介：</td><td><?php echo $row['introduce']; ?></td></tr>
			
				</table>
				<p>&nbsp;</p>
				<?php endforeach; ?>	
				<p>&nbsp;</p>
				<p align="right"><a href="mypage">My Pageトップへ</a></p>
				</div>
			</div>
				
			</center>
	<!--追加　end-->
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