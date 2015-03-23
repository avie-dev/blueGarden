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
								<strong>予約管理ページ</strong><hr />
							</td>
							
						</tr>	
						
						<tr><td>&nbsp;</td></tr>
						
					</table> 
					
							
							<table width="100%" border="0"  class="columntitle">
								<tr><td>予約変更</td></tr>
							</table>
							<table width="100%" border="0">
								<tr>
									<td class="ptablespacer"><h3><p><span class="attention">＊</span>スタッフを選択</p></h3></td>
									<td class="ptablespacer"><h3>
										<select name="staff" id="staff">
											
											<option>フリースタッフ選択</option>
											<option>安里</option>
											<option>高橋</option>
											<option>セリョ</option>
											<option>土橋</option>
											<option>リョナ</option>
										  </select><a href="staff.html" class="btn"></a>
										</h3>
									</td>
									
								</tr>
								<tr>
									<td class="ptablespacer"><h3><p><span class="attention">＊</span>コースを選択</p></h3></td>
									<td class="ptablespacer"><h3>
										<!-- 1--><p>
										<select name="course" id="course">
											<option>&nbsp;</option>
											<option>アロマボディー</option>
											<option>フットリフレ</option>
											<option>フェイシャル</option>
											
										  </select><a href="course.html" class="btn"></a>

										  <select name="time1" id="time1">
											<option>&nbsp;</option>
											<option>30分</option>
											<option>60分</option>
											<option>90分</option>
										 </select></p>
										  
										 <!-- 2--><p>
										<select name="course" id="course">
											<option>&nbsp;</option>
											<option>アロマボディー</option>
											<option>フットリフレ</option>
											<option>フェイシャル</option>
											
										  </select>
										  <select name="time2" id="time2">
											<option>&nbsp;</option>
											<option>30分</option>
											<option>60分</option>
											<option>90分</option>
										 </select></p>
										 <!-- 3--><p> 
										<select name="course" id="course">
											<option>&nbsp;</option>
											<option>アロマボディー</option>
											<option>フットリフレ</option>
											<option>フェイシャル</option>
											
										  </select>
										  <select name="time3" id="time3">
											<option>&nbsp;</option>
											<option>30分</option>
											<option>60分</option>
											<option>90分</option>
										 </select></p>
										 <p><span style="font-size:10px;" class="attention">※コースは３つまで選べます</span></p>
										</h3>
									</td>
								</tr>
								<tr>
									<td class="ptablespacer"><h3><p>オプション</p></h3></td>
									<td class="ptablespacer"><h3>
										<select name="option" id="option">
											<option>&nbsp;</option>

											<option>ゴッドスカルプ</option>
											<option>その他</option>
										</select>
										
										<p> 
								
										<select name="course" id="course">
											<option>&nbsp;</option>
											<option>ゴッドスカルプ</option>
											<option>その他1</option>
											<option>その他2</option>
										</select>
										</p>
										<p> 
								
										<select name="course" id="course">
											<option>&nbsp;</option>
											<option>ゴッドスカルプ</option>
											<option>その他1</option>
											<option>その他2</option>
										</select>
										</p>
										</h3>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="ptablespacer"　><h3><p><span class="attention">＊</span>ご予約日、時間を選択</p></h3></td>
								</tr>
								<tr>
									<td colspan="2" class="ptablespacer"　><h3>
										<p>
											<table width="100%"><!-- Calendar Table-->
												<tr>						
													<td><h3><p>&nbsp;</p></h3></td>
													<td><h3><p>12/2(月)</p></h3></td>
													<td><h3><p>12/3(火)</p></h3></td>
													<td><h3><p>12/4(水)</p></h3></td>
													<td><h3><p>12/5(木)</p></h3></td>
													<td><h3><p>12/6(金)</p></h3></td>
													<td><h3><p>12/7(土)</p></h3></td>
													<td><h3><p>12/8(日)</p></h3></td>
												</tr>
												<tr>						
													<td class="reservebtn_small"><p>10:00〜</p></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/wazuka.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
												</tr>
												<tr>						
													<td class="reservebtn_small"><p>11:00〜</p></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/wazuka.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
												</tr>
												<tr>						
													<td class="reservebtn_small"><p>12:00〜</p></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
												</tr>
												<tr>						
													<td class="reservebtn_small"> <p>13:00〜</p></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
												</tr>
												<tr>						
													<td class="reservebtn_small"> <p>13:00〜</p></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
													<td class="reservebtn_small"><a href="editreserveconfirm"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?>		</a></td>
												</tr>
											
												<tr><td style="border:none;">&nbsp; </td></tr>
												<tr>
															<td  style="border:none;float:right"><?php echo Asset::img('img2/yoyaku_ok.gif'); ?></td>
															<td colspan="2" style="border:none;">受付中 </td>
															<td style="border:none;float:right"><?php echo Asset::img('img2/wazuka.gif'); ?>		</td>
															<td colspan="2"style="border:none">後わずか </td>
												</tr>
												<tr><td style="border:none;">&nbsp; </td></tr>
												
											</table><!-- End of Calendar Table-->
										
										</p></h3>
									</td> 
									
								</tr>
								

							</table>
							
						
				</div>
				
				
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	      
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer -->

	</div> <!-- end of container -->

</body>
</html>