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
<!-- jQuery -->

<?php echo Asset::js('jquery-1.2.6.js');?>


<!-- ui tabs.js -->
	<?php echo Asset::css('ui.tabs.css');?>
	<?php echo Asset::js('ui.core.js');?>
	<?php echo Asset::js('ui.tabs.js');?>
	
<!-- datepicker-->
	<?php echo Asset::css('jquery-ui.css');?>
	<?php echo Asset::js('jquery-1.9.1.js');?>
	<?php echo Asset::js('jquery-ui.js');?>

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
						<?php }	?>
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
						<tr><td ><?php echo Asset::img('img2/user_icon.gif'); ?>	</td>
							<td>
								店舗：<?php echo Session::get('branch');?><br><hr>役割：<?php echo Session::get('role');?><i></i>
							</td>
							<td >
							</td>
						</tr>	
					</table> 
				</div>	 <!-- ************************************************** end fix ****************************************************-->
				
				<div class="coldivider_center" style="margin-top:80px;">
			
					<table width="100%">
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td colspan="2" style="font-size: 18px;"　>
								<strong>従業員情報管理ページ>>シフト管理</strong><hr />
							</td>
							
						</tr>	
						<tr>
							<td colspan="2" style="font-size: 15px;color:red;"　>
								<strong>※日付が存在していたらそのまま上書きされますのでご注意ください。</strong><hr />
							</td>
						</tr>
						
						
						
					</table> 
					
				</div>
				<div class="coldivider_center">
					<form name="staffsched_edit_confirm" action="staffsched_edit_confirm" method="post"　>
					<table width="80%">
						<tr><td width="20%"><p>スタッフ名：</p></td><td><?php echo $name; ?><?php Session::set('stafflist',$name);?></td></tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td> <p>日付:</p></td>
							<td>
							<script>
							  $(function() {
								$( "#datepicker" ).datepicker();
							  });
							</script>
							 <input type="text" id="datepicker" name="datepicker"> 
							
							</td><tr>
							<tr><td>&nbsp;</td><tr>
						<tr><td colspan="2"></td><tr>
						
					</table><center>
					<table width="80%"><!-- -->
								<tr><td><?php 
											echo Form::checkbox('time_10', '10');	echo Form::label('10時', 'time_10');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ; 
											echo Form::checkbox('time_11', '11');	echo Form::label('11時', 'time_11');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
											echo Form::checkbox('time_12', '12');	echo Form::label('12時', 'time_12');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
											echo Form::checkbox('time_13', '13');	echo Form::label('13時', 'time_13');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
											echo Form::checkbox('time_14', '14');	echo Form::label('14時', 'time_14');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
											echo Form::checkbox('time_15', '15');	echo Form::label('15時', 'time_15');	echo "<br>";
											echo Form::checkbox('time_16', '16');	echo Form::label('16時', 'time_16');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
											echo Form::checkbox('time_17', '17');	echo Form::label('17時', 'time_17');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
											echo Form::checkbox('time_18', '18');	echo Form::label('18時', 'time_18');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
											echo Form::checkbox('time_19', '19');	echo Form::label('19時', 'time_19');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
											echo Form::checkbox('time_20', '20');	echo Form::label('20時', 'time_20');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
											echo Form::checkbox('time_21', '21');	echo Form::label('21時', 'time_21');	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
											
										?>
											</td></tr>
					</table></center><!-- -->
					<p align="right"><input name="submit" type="submit" value="確認" ></p><!-- 更新機能：　日にちが存在していれば前のレコードを消してから登録する。
																								存在していなかったらそのまま登録する-->
					</form>
					
					<hr>
					<p align="right"><input action="action" type="button" value="戻る" onclick="history.go(-1);" /></p>
					
				</div><!--end of the coldivider_center-->
				
	    </div> <!-- end of content -->
	    </div>
	   <div id="bluegarden_footer">
	      
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer -->

	</div> <!-- end of container -->

</body>
</html>