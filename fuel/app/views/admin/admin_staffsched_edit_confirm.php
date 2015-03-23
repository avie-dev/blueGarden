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
					<?php 
					//POST代入
						/* $no = $_POST['staffno'];
						$name = $_POST['staff_name'];
						$service = $_POST['service_spec'];
						$sex = $_POST['cus_sex'];
						$addno = $_POST['cus_zip'];
						$add1 = $_POST['cus_addr1'];
						$add2 = $_POST['cus_addr2'];
						$byear = $_POST['cus_birth[y]'];
						$bmonth = $_POST['cus_birth[m]'];
						$bday = $_POST['cus_birth[d]']; */
					?>
				<div class="coldivider_center" style="margin-top:80px;">
			
					<table width="100%">
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td colspan="2" style="font-size: 18px;"　>
								<strong>従業員シフト　ー確認ー</strong><hr />
							</td>
							
						</tr>	
						
						<tr><td>&nbsp;</td></tr>
					
					</table> 
						<div class="box-type1 ns">
						   <table width="100%" border="0" class="type1">
								<tr>
								  <th width="150" align="right">スタッフ名：</th>
								  <td></p></td><td><?php echo $name; ?><?php Session::set('stafflist',$name);?></td>
								</tr>
								<tr>
								  <th width="150" align="right">日にち：</th>
								  <td></p></td><td><?php echo $day; ?><?php Session::set('day',$day);?></td>
								</tr>
							</table>
							<p>&nbsp;</p>
							<table width="100%">
								<tr>
									
									<th><span id="schedHdr0">10時</span></th>
									<th><span id="schedHdr0">11時</span></th>
									<th><span id="schedHdr1">12時</span></th>
									<th><span id="schedHdr1">13時</span></th>
									<th><span id="schedHdr2">14時</span></th>
									<th><span id="schedHdr3">15時</span></th>
									<th><span id="schedHdr4">16時</span></th>
									<th><span id="schedHdr5">17時</span></th>
									<th><span id="schedHdr6">18時</span></th>
									<th><span id="schedHdr4">19時</span></th>
									<th><span id="schedHdr5">20時</span></th>
									<th><span id="schedHdr6">21時</span></th>
								</tr>
								<tr>				
									<td>
										<?php if($time_10 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_10 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_10 = 0;
										}?>
										<?php Session::set('time_10',$time_10);?>
									</td>
									<td>
										<?php if($time_11 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_11 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_11 = 0;
										}?>
										<?php //echo Form::input('time_11', Input::post('time_11', $time_11),array('type'=>'hidden'));?>
										<?php Session::set('time_11',$time_11);?>
									</td>
									<td>
										<?php if($time_12 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_12 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_12 = 0;
										}?>
										<?php Session::set('time_12',$time_12);?>
									</td>
									<td>
										<?php if($time_13 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_13 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_13 = 0;
										}?>
										<?php Session::set('time_13',$time_13);?>
									</td>
									<td>
										<?php if($time_14 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_14 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_14 = 0;
										}?>
										<?php Session::set('time_14',$time_14);?>
									</td>
									<td>
										<?php if($time_15 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_15 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_15 = 0;
										}?>
										<?php Session::set('time_15',$time_15);?>
									</td>
									<td>
										<?php if($time_16 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_16 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_16 = 0;
										}?>
										<?php Session::set('time_16',$time_16);?>
									</td>
									<td>
										<?php if($time_17 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_17 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_17 = 0;
										}?>
										<?php Session::set('time_17',$time_17);?>
									</td>
									<td>
										<?php if($time_18 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_18 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_18 = 0;
										}?>
										<?php Session::set('time_18',$time_18);?>
									</td>
									<td>
										<?php if($time_19 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_19 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_19 = 0;
										}?>
										<?php Session::set('time_19',$time_19);?>
									</td>
									<td>
										<?php if($time_20 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_20 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_20 = 0;
										}?>
										<?php Session::set('time_20',$time_20);?>
									</td>
									<td>
										<?php if($time_21 != ""){
											echo "&nbsp;&nbsp;〇";
											$time_21 = 1;
										}else{
											echo "&nbsp;&nbsp;✕";
											$time_21 = 0;
										}?>
										<?php Session::set('time_21',$time_21);?>
									</td>									
								</tr>
								<tr><td></td></tr>
							</table>
							<br><br><br>
							<table width="100%" border="0" class="type1">

								<tr>	
									<td align="center" colspan="2">
									<form action="staffsched_edit_finished" name="staffsched_edit_finished" method="post"　>
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