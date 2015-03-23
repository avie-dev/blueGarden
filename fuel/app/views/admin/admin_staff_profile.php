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
								<strong>従業員情報詳細</strong><hr />
							</td>
							
						</tr>	
						
						<tr><td>&nbsp;</td></tr>
						
					</table> 
						<div class="box-type1 ns">
						  <?php foreach($rows as $row): ?>
						  <table width="100%" border="0" class="type1">
							
							 <th width="150">スタッフ番号</th>
								<td style="border: 1px solid #99bbff;">
								
									<?php 
										$branch = Session::get('admin_branch');
										if($branch ==='1'){
											echo 'BGH';
										}else if ($branch ==='2'){
											echo 'BGI';
										}
									?>
								
								<?php echo $row['staff_no']; ?></td>
								
								<?php Session::set('number',$row['staff_no']); ?>
							</tr>

							<tr>
							  <th width="150"><span class="attention">＊</span>お名前</th>
							 <td style="border: 1px solid #99bbff;"><?php echo $profile; ?></td>
							</tr>
				
							  <th width="150">性別</th>
							  <td style="border: 1px solid #99bbff;"><?php echo $row['sex']; ?></td>
							</tr>
							<tr>
							  <th width="150">生年月日</th>
							  <td style="border: 1px solid #99bbff;">
							  <?php echo $row['birthy']; 
							  
								if ($row['birthy']!="") print '年';?>
							  <?php echo $row['birthm']; 
							  if ($row['birthy']!="") print '月';?>
							  
							  <?php echo $row['birthd']; 
							  if ($row['birthy']!="") print '日';?></td>
							</tr>
						
							
							<tr>
							  <th width="150">登録日</th>
							  <td style="border: 1px solid #99bbff;">
							  
							  <?php 
							  
							  echo $row['created_at']; ?></td>
							</tr>
							<tr>
							  <th width="150">自己紹介</th>
							  <td style="border: 1px solid #99bbff;">
							  
							  <?php 
							  
							  echo $row['introduce']; ?></td>
							</tr>
							<tr>
							  <th width="150">時給</th>
							  <td style="border: 1px solid #99bbff;">
							  
							  <?php 
							  
							  echo $row['hour_rate'].'円'; ?></td>
							</tr>
						
						
							<tr>	
								<td align="right" colspan="2">
								<form action="editstaff" name="editstaff" method="post"　>
									<input name="submit" type="submit" value="編集" >
								</form>
								
								</td>
								<td><form action="deletestaff" name="deletestaff" method="post"　>
										<input name="submit" type="submit" value="削除" >
									</form>
								</td>
								
							</tr>	
						  
						  </table>
						 <?php endforeach; ?>
						</div>
					<table width="100%">
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td colspan="2" style="font-size: 18px;"　>
								<strong>従業員シフト表</strong><hr />
							
							</td>
							
						</tr>	
						
						<tr><td>&nbsp;</td></tr>
						
					</table> 
					
					
					
					
					<div id="schedDiv">
							
								<div id="schedGrid">
									
									<table id="schedTable">
									
										<colgroup><col id="schedTableCol1"></colgroup>
										<thead>
											<tr>
												<th><span id="schedHdr0">日にち</span></th>
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
										</thead>
										
										<tbody>
											<!--サンプル-->
											<?php $i = 1; ?>
											<?//php $created_at = date("Y-m-d");?>
											<?//php echo $created_at;?>
											<?php foreach($sched as $row): ?>
											<tr>
												<?php 
												/////////////日にち////////////////
												$row['sched_date'];
												Session::set('date',array($i =>$row['sched_date'])); 
												$scheddate = Session::get('date');
												$sdate = Arr::get($scheddate,$i,'null');
												
												$year = date('Y',strtotime($sdate));
												$month = date('m',strtotime($sdate));
												$day = date('d',strtotime($sdate));
												/////////////日にち///////////////
												?>
												
													<td><?php echo $year; ?>年<?php echo $month; ?>月<?php echo $day; ?>日</td>
													<?php if($row['time_10'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													
													<td><?php echo $ok;?></td>
													<?php if($row['time_11'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
													<?php if($row['time_12'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
													<?php if($row['time_13'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
													<?php if($row['time_14'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
													<?php if($row['time_15'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
													<?php if($row['time_16'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
													<?php if($row['time_17'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
													<?php if($row['time_18'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
													<?php if($row['time_19'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
													<?php if($row['time_20'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
													<?php if($row['time_21'] === '1'){
																$ok = "〇";
													 }else{ 
																$ok = "✕";
													 } ?>
													<td><?php echo $ok;?></td>
												
											</tr>
											<?php $i = $i + 1; ?>
											<?php endforeach; ?>
										</tbody>
								   
									</table>
								</div>
								
							</div>
							<table width="90%">
								<tr>	
								<td align="right" colspan="2">
								<form action="staffsched_edit" name="editstaff" method="post"　>
								<!--form action="staffsched_edit" name="editstaff" method="post"　-->
								<input name="submit" type="submit" value="シフトの編集" >
								</form>
								</td>
								
							</tr>
							</table>
							<hr>
							<p align="right"><input action="action" type="button" value="戻る" onclick="history.go(-1);" /></p>
				</div>
				
				
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	      
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer -->

	</div> <!-- end of container -->

</body>
</html>