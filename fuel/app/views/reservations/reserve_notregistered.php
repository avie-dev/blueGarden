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
<body onload="setFocus()"  class="MyGradientClass">
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

    <div id="bluegarden_content">
    <!-- left column -->
    
    	
		<div id = "bluegarden_left">
				<div class="left_col_section">	
					<p class="columntitle" style="text-align:center;">ログイン</p>

					
					 <form id="form1" method="post" action="login">
						<table width="100%" style="border:none" class="loginspacer">
							<tr style="border:none">
								<td style="border:none">ユーザー名</td><td style="border:none"><input style="width:150px" type="text" name="username" id="username" /></td>
							</tr>
							<tr>
								<td style="border:none">パスワード </td><td style="border:none"><input style="width:150px" type="password" name="password" id="password" /></td>
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
								<td colspan="2" align="center" style="border:none">
									<p>&nbsp;</p>	
									<input type="submit" name="login" id="login" value="ログイン" />
									<input type="reset" name="cancel" id="cancel" value="キャンセル" />
									<p>&nbsp;</p>
								</td>
							</tr>
						</table>

					</form>
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
				<table  width="100%"><tr class="columntitle"><td>予約者情報</td></tr></table>
				 <p>&nbsp;</p>
			          <p><center>予約をするには、ログインが必要です。<br />ログインをするか、新規登録を行ってください。</center></p>
						<p><center>登録していただくと、次回からの予約が簡単にご利用いただけます。 </center></p>
						<p>&nbsp;</p>
						<center>
							<table  width="40%"><tr class="columntitle_button"><td align="center" height="70"><a href="signup">新規登録</a></td></tr></table>
						</center>
			          <p>&nbsp;</p>
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

</div> <!-- end of container --></body>
</html>