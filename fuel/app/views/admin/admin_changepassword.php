<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blue Garden Admin Page</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="keywords" content="blue garden" />
<meta name="description" content="Blue Garden 上永谷のアロマサロン " />
  <link rel="shortcut icon" href="http://666522dacac20340.lolipop.jp/bluegarden/blueGarden/assets/img/candle.ico">
<?php echo Asset::css('admin_style.css');?>
<?php echo Asset::css('rankingviewtable.css');?>
<?php echo Asset::js('date.js');?>
</head>

<body class="MyGradientClass">
	<div id="bluegarden_container">
		<div id="bluegarden_header">
			<p class="header_title">
			<?php echo Asset::img('img2/title_admin.gif',array('height' => '120')); ?></p></title>
		</div> <!-- end of header -->
	   	

	    <!-- login -->
	   	<div id="bluegarden_content">
				<div id="bluegarden_left">
				

						<table width="90%" class="loginspacer">
							<tr >
								
								<td><?php echo Asset::img('img2/home_pic.png'); ?>	</td>
								<td class="columntitle">Myページ</td>
								
							</tr>
							<tr>
								
								<td><?php echo Asset::img('pword_icon.png'); ?>	</td>
								<td class="navi_btn"><a href="top">Myページトップ</a></td>
								
							</tr>
							<tr >
								
								<td><?php echo Asset::img('pword_icon.png'); ?>	</td>
								<td class="navi_btn">
									<a href="cusinfo">お客様情報管理</a>
								</td>
									
							</tr>
							<tr >
								
								<td><?php echo Asset::img('pword_icon.png'); ?>	</td>
								<td class="navi_btn"><a href="reserveinfo">予約管理</a></td>
								
							</tr>
						<?php  $auth = Auth::instance();
								if (Auth::member(100)){

							?>
							<tr>
								
								<td><?php echo Asset::img('pword_icon.png'); ?>	</td>
								<td class="navi_btn"><a href="staffinfo">従業員情報管理</a></td>
								
							</tr>
						<?php 								
							}?>
							<tr>
								
								<td><?php echo Asset::img('pword_icon.png'); ?>	</td>
								<td class="navi_btn"><a href="menuinfo">メニュー</a></td>
								
							</tr>
							<tr>
								
								<td><?php echo Asset::img('pword_icon.png'); ?>	</td>
								<td class="navi_btn"><a href="mail">メール設定</a></td>
								
							</tr>
							<tr>
								
								<td><?php echo Asset::img('pword_icon.png'); ?>	</td>
								<td class="navi_btn"><a href="logout">ログアウト</a></td>
								
							</tr>
							
						</table>

				</div>
	          	<div id="bluegarden_right">
				<div class="coldivider_right"><!--fix -->
				<table width="100%">
					<tr><td style="font-size: 50px;" rowspan="2">
				
							<?php echo 
									'<script type="text/javascript">'
								   , 'get_time();'
								   , '</script>';
							?>
						</td>
					
						</td>
						<td class="font_sizer"><strong>
									<?php echo 
										'<script type="text/javascript">'
									   , 'get_day();'
									   , '</script>';
									?> 
									</strong>
						</td>
					</tr>
					<tr>
						
						<td style="font-size: 15px;">
							<?php echo 
									'<script type="text/javascript">'
								   , 'get_date();'
								   , '</script>';
							?>
						</td>
					</tr>
					
					
				</table>
			
				</div> 
				
				<div class="coldivider_left">
					<table width="80%">
						<tr><td><?php echo Asset::img('img2/user_icon.gif'); ?>	</td>
							<td>
								店舗：<?php echo Session::get('branch');?><br><hr><i>役割：<?php echo Session::get('role');?></i>
							</td>
							<td>
							</td>
						</tr>	
					</table> 
				</div>	 <!-- ************************************************** end fix ****************************************************-->
				
				<div class="coldivider_center" style="margin-top:80px;">
			
					<table  width="100%">
								<tr class="columntitle"><td>管理者パスワードの変更</td></tr>
							</table>
							
							 <table width="100%" border="0" class="type1">
							  
								<form action="passwordchange_finished" method = "post">
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
								   
									  <p class="caption">※半角英数字 4～20文字で入力してください</p>
									  <p class="attention"></p>&nbsp;&nbsp;&nbsp;
									 
									</td>
								</tr>
								<tr>
								  <th>新しいパスワード再入力</th>
									<td><p class="attention"></p>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<?php echo Form::input('loginpw_chk', Input::post('loginpw_chk'), array('type'=>'password','required' => 'required', 'class' => 'password'), array( 'match_field', 'loginpw' ) ) ?>
								   
									  <p class="caption">※確認のためにもう一度パスワードを入力してください</p>
									  
									</td>
								</tr>
							
							
								
								
							  </table>
							<tr>	
								<td>
									<input name="submit" type="submit" value="パスワードを変更する" >
									</form>
								</td>
								<td>
									<form action="staffinfo" name="addnewstaff_ok" method="post"　>
										<input name="submit" type="submit" value="従業員情報管理ページトップへ" >
									
									</form>
								</td>
							</tr>
						  </table>
						</div>
					
				</div>
				
				
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	      
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer -->

	</div> <!-- end of container -->

</body>
</html>