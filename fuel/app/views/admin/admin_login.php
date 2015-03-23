<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blue Garden Admin Page</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="keywords" content="blue garden" />
<meta name="description" content="Blue Garden 上永谷のアロマサロン " />

<?php echo Asset::css('admin_style.css');?>

</head>

<body class="MyGradientClass">
	<div id="bluegarden_container">
		<div id="bluegarden_header">
			<p class="header_title">
			<?php echo Asset::img('img2/title_admin.gif',array('height' => '120')); ?></p></title>
		</div> <!-- end of header -->
	   	

	    <!-- login -->
	   	<div id="bluegarden_content">
				<div id="bluegarden_center">
				<p class="columntitle" style="text-align:center;">Admin ログイン</p>

					
					  <form id="form1" method="post" action="login">
					
						<table width="90%" style="border:none" class="loginspacer">
						
							<tr style="border:none">
								<td style="border:none">ユーザー名</td>
								<td style="border:none"><?php echo Asset::img('email_icon.png'); ?>	</td>
								<td style="border:none"><input type="text" name="username" id="username" class="input_box"/></td>
							</tr>
							<tr>
								<td style="border:none">パスワード </td>
								<td style="border:none"><?php echo Asset::img('pword_icon.png'); ?>	</td>
								<td style="border:none"><input type="password" name="password" id="password" class="input_box"/></td>
							</tr style="border:none">
							<tr>
								<td colspan="3" align="center" style="border:none">
									<p>&nbsp;</p>	
									<input type="submit" name="login" id="login" value="ログイン" />
									<input type="reset" name="cancel" id="cancel" value="キャンセル" />
									<p>&nbsp;</p>
								</td>
							</tr>
						</table>

					</form>
				</div>
	          	
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	      
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer -->

	</div> <!-- end of container -->

</body>
</html>