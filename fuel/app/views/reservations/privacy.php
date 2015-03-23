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
    	
	          <div id= "bluegarden_left">
		
 			<div class="left_col_section">	
				<p class="columntitle" style="text-align:center;">My Page</p>
				<div class="left_inside">
				
					<?php foreach($rows as $row) : ?>
					<p>&nbsp;</p>
					<p><span class="attention"><?php echo $name; ?> 様</span></p><br> <!-- ここも弄る？-->
					<p>いつもご利用ありがとうございます。</p>
						<p>&nbsp;</p>
					<?php endforeach; ?>
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
					//<img src="images/reservebtn.gif" width="245" >
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
				<tr><td>プライバシー規約</td></tr>
			</table>
			<table width="100%" border="0" class="type1">
				<tr><td class="privacy">当社は、個人情報保護に対する社会的要請を深く認識し、個人情報の適切な取扱いを行います。個人情報の保護は、営業活動の基本であり、社会的責務であると考えております。以下の通り、個人情報保護の取組方針を定め、その徹底を図ります。</td></tr>
				<tr><td class="ptablespacer">法令等の遵守</td></tr>
				<tr><td class="privacy">当社は、個人情報の取扱いに関して、個人情報保護に関する法令およびその他の適切でかつ合理的な社会規範を遵守します。</td></tr>
				<tr><td class="ptablespacer">個人情報の収集・利用および提供</td></tr>
				<tr><td class="privacy">当社は、個人情報を収集する場合には、本人の同意のもと、適法かつ厚生な手段により行います。その際には利用目的を明らかにして、提供範囲を明確にします。また、法令に基づく命令等による場合を除き、収集時に承諾を得た範囲外の利用、提供を行いません。</td></tr>
				<tr><td class="ptablespacer">個人情報の開示および提供</td></tr>
				<tr><td class="privacy">当社は、正当な理由のある場合を除いては、取得した個人情報を第三者に開示または提供することは一切ありません。また、個人情報を扱う業務を他の会社に委託する場合には、業務を遂行するために必要最小限の範囲の情報提供とし、委託先と必要な契約を締結してその指導、管理を行います。</td></tr>
				<tr><td class="ptablespacer">安全対策の実施</td></tr>
				<tr><td class="privacy">当社は、個人情報保護を適正な管理の下、行います。また、個人情報への不正なアクセス、個人情報の紛失、破壊、改ざんおよび漏洩などのリスクに対し、適切な予防措置および是正対策を行います。</td></tr>
				<tr><td class="ptablespacer">情報主体の権利尊重</td></tr>
				<tr><td class="privacy">当社は、ご提供いただいた個人情報の開示、訂正、提供範囲の変更や削除を本人より依頼された場合には、個人情報保護法等に準拠して、速やかに対応します。</td></tr>
				<tr><td class="ptablespacer">継続的な改善</td></tr>
				<tr><td class="privacy">当社は、個人情報が社外に流失し、もしくは不当に改ざんされる等のトラブルが起きないように、個人情報保護に関する管理体制と仕組みを常に見直し、継続的に改善します。</td></tr>

			</table>
	          
	  	</div>	
	
		</center><p>&nbsp;</p>
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