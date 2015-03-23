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

<body class="MyGradientClass" onLoad="document.form1.username.focus()">
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
	    	
	       <div id = "bluegarden_left">
		
 			<div class="left_col_section">	
				<p class="columntitle" style="text-align:center;">My Page</p>
				<div class="left_inside">

				
				<?php if (Session::get_flash('success')): ?>
				<div class="alert alert-success">
					
					<p>
					<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
					</p>			
					
				</div>
				<?php elseif (Session::get_flash('logout')): ?>
				<div class="alert alert-success">
					
					<p>
					<?php echo implode('</p><p>', e((array) Session::get_flash('logout'))); ?>
					</p>			
					
				</div>				
				<?php endif; ?>
				<p>&nbsp;</p>
				<p><span class="attention"><?php echo $name; ?> 様</span></p><br>
				<p>いつもご利用ありがとうございます。<br /></p><p>&nbsp;</p>
				<center><table  width="90%"><tr ><td align="center" class="mp"><a href="mypage">マイページ</a></td></tr></table></center>
				<p>&nbsp;</p>
				
				
				
					
				

				
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
				<table  width="100%"><tr class="columntitle"><td>Blue Garden カレンダー</td></tr></table>
			           <p>&nbsp;</p><center>
					<iframe src="https://www.google.com/calendar/embed?src=ip24.sotsuken%40gmail.com&ctz=Asia/Tokyo" style="border: 0" width="500" height="500" frameborder="0" scrolling="no"></iframe>
			          </center><p>&nbsp;</p>
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
