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
			
					<table width="100%">
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td colspan="2" style="font-size: 18px;"　>
								<strong>従業員新規登録　ー確認ー</strong><hr />
							</td>
							
						</tr>	
						
						<tr><td>&nbsp;</td></tr>
					
					</table> 
						<div class="box-type1 ns">
						  <table width="100%" border="0" class="type1">
							<tr>
							</tr>
							<tr>
							  <th width="150"><span class="attention">＊</span>スタッフ番号</th>
							 <td style="border: 1px solid #99bbff;">
								<?php 
									$branch = Session::get('admin_branch');
									if($branch ==='1'){
										echo 'BGH';
									}else if ($branch ==='2'){
										echo 'BGI';
									}
								?>
							 
								<?php echo $staff_no ?>&nbsp;
							</td>
							</tr>
							<tr>
							  <th width="150"><span class="attention">＊</span>スタッフ名</th>
							 <td style="border: 1px solid #99bbff;"><?php echo $name ?>&nbsp;</td>
							</tr>
							<tr>
							<tr>
							  <th width="150">性別</th>
							   <td style="border: 1px solid #99bbff;"><?php echo $sex ?>&nbsp;</td>
							</tr>
							<tr>
											
							<tr>
							  <th width="150">生年月日</th>
							   <td style="border: 1px solid #99bbff;"><?php echo $birthy; ?>年<?php echo $birthm; ?>月<?php echo$birthd; ?>日&nbsp;</td>
							</tr>
							<tr>
							  <th width="150">自己紹介</th>
							   <td style="border: 1px solid #99bbff;"><?php echo $selfintro; ?>&nbsp;</td>
							</tr>
							<tr>
							  <th width="150">時給</th>
							   <td style="border: 1px solid #99bbff;"><?php echo $rate; ?>円&nbsp;</td>
							</tr>
							<tr>	
								<td align="center" colspan="2">
								<form action="addnewstaff_finished" name="addnewstaff_finished" method="post"　>
									<input name="submit" type="submit" value="確定する" >
									<input action="action" type="button" value="修正する" onclick="history.go(-1);" />
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