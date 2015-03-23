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
<!-- 新規追加 -->
<?php echo Asset::js('jquery-1.2.6.js');?>
<!-- ui tabs.js -->
<?php echo Asset::css('ui.tabs.css');?>
<?php echo Asset::js('ui.core.js');?>
<?php echo Asset::js('ui.tabs.js');?>
<style>
*{
font-family:'メイリオ';
}
</style>
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
				<div class="coldivider_right">
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
						<tr><td style="font-size: 12px;"><?php echo Asset::img('img2/user_icon.gif'); ?>	</td>
							<td>
								店舗：<?php echo Session::get('branch');?><br><hr>役割：<?php echo Session::get('role');?><i></i>
							</td>
							<td>
							</td>
						</tr>	
					</table> 
				</div>	
				<div class="coldivider_center" style="margin-top:80px;">
			
					<table width="100%">
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td colspan="2" style="font-size: 18px;"　>
								<strong>今日の予約リスト</strong>
							</td>
							
						</tr>	
						
						<tr>
							<td>
					
					<script type="text/javascript">
							$(function() {
								$('#ui-tab > ul').tabs();
							});
					</script>
					<div id="ui-tab">
					<ul>
						<li><a href="#schedDiv"><span>予約一覧</span></a></li>
						<li><a href="#schedDiv2"><span>キャンセルされた予約</span></a></li>
						
					</ul>
					</div>
						<div id="schedDiv">
							<div id="schedGrid">
								<table id="schedTable">
			
									<colgroup><col id="schedTableCol1"></colgroup>
									<thead>
										<tr><th><span id="schedHdr0">済確認</span></th>
											<th><span id="schedHdr1">予約番号</span></th>
											<th><span id="schedHdr2">顧客名</span></th>
											<th><span id="schedHdr3">予約日付け</span></th>
											<th><span id="schedHdr4">予約時間</span></th>
											<th><span id="schedHdr5">指名</span></th>
											<th><span id="schedHdr6">コース</span></th>
											<th><span id="schedHdr7">オプション</span></th>
											
										</tr>
									</thead>
									<?php $i = 1; ?>
									<tbody><?php foreach((array)$rows as $row): ?>
										
											<?php	////res_noの取得
													$row['res_no'];
													Session::set('number',array($i => $row['res_no']));
													$number = Session::get('number');
													$rsnumber = Arr::get($number,$i,'null');
													////res_noの取得
													echo Form::hidden('rsnumber',Input::post('rsnumber',$rsnumber),array('type' => 'hidden','size' => '20'));?>
										
										
										<tr><form name="done" action="reserve_done" method="post">
										<?php 	////res_noの取得
												echo Form::hidden('rsnumber',Input::post('rsnumber',$rsnumber),array('type' => 'hidden','size' => '20')); 
												////【済】ボタン　チェック
												if( $row['valid_res'] === '1'){
										?>
											<td><input type="submit" width="20" value="済"></td>
											<?php }else{?>
													<td><span>完了</span></td>
											<?php } ?>
											</form>

											<td >
													<form action="deletereserve" method="post">
														<?php echo Form::submit('resno', Input::post('resno', $row['res_no']), array('size'=>'38', 'class' => 'box1') )?>
													</form>
													<?php Session::set('res_number',$row['res_no']);?>
													
												</td>
											<td class="txt"><?php echo $row['name']?></td>
											<td class="txt"><?php 
																$resdate = date("Y年m月d日",strtotime($row['res_date']));
																echo $resdate ?></td>
											<td class="txt"><?php echo $row['res_time']?></td>
											<td class="txt"><?php echo $row['staff_name']?></td>
											<td class="txt"><?php echo $row['svc_name_1']?>
															<?php if($row['svc_name_2']!=null) echo ', '; 
																echo $row['svc_name_2']?>
															</td>
											<td class="txt"><?php echo $row['opt_name']?></td>
											
											<!--tr><td alt="bottom" width="150" height="100"><p><?php //print "ばーか";?></p></td></tr-->
										</tr>
										<?php endforeach?>
										
									</tbody>
								
								</table>
								
						</div>
					</div>
						
					<!--first tab ends-->
						<div id="schedDiv2">
							<div id="schedGrid">
								<table id="schedTable">
								
									<colgroup><col id="schedTableCol1"></colgroup>
									<thead>
										<tr>
											<th><span id="schedHdr0"><center>削除</center></span></th>
											<th><span id="schedHdr1"><center>予約番号</center></span></th>
											<th><span id="schedHdr2"><center>顧客名</center></span></th>
											<th><span id="schedHdr3"><center>予約日付</center></span></th>
											<th><span id="schedHdr4"><center>予約時間</center></span></th>
											<th><span id="schedHdr5"><center>指名</center></span></th>
											<th><span id="schedHdr6"><center>コース</center></span></th>
											<th><span id="schedHdr7"><center>オプション</center></span></th>
											<th><span id="schedHdr8"><center>キャンセル理由</center></span></th>
											
										</tr>
									</thead>
									
									<tbody><?php foreach((array)$kekka as $row): ?>
										
										<tr>
											<form name="del" action="reserve_del" method="post">
											<td><input type="submit" width="20" value="削除"></td>
											</form>
											<?php Session::set('res_number',$row['res_no']);?>
											<td class="txt"><?php echo $row['res_no']?></td>
											<td class="txt"><?php echo $row['name']?></td>
											<td class="txt"><?php 
																$resdate = date("Y年m月d日",strtotime($row['res_date']));
																echo $resdate ?></td>
											<td class="txt"><?php echo $row['res_time']?></td>
											<td class="txt"><?php echo $row['staff_name']?></td>
											<td class="txt"><?php echo $row['svc_name_1']?>
															<?php if($row['svc_name_2']!=null) echo ', '; 
																echo $row['svc_name_2']?>
															</td>
											<td class="txt"><?php echo $row['opt_name']?></td>
											<td class="txt"><?php echo $row['cancel_reason']?></td>
											
											
										
										</tr>
										<?php endforeach?>
									</tbody>
							   
								</table>
						</div>
					</div>					
						
						
						
							</td>
						</tr>
						<form action="canceler" method="post">
						<tr><td><input type="submit" value="期限切れの予約を一括キャンセル">
						</form>
						
						<!-- 追加 -->
						<form action="staffsched" method="post">
						<tr><td><input type="submit" name="selectday" value="スタッフシフト一覧"></td></tr>
						</form>
						<!-- 追加 -->
					</table>
						
						</td></tr>
						
					</table> 
					
				</div>
				<div class="coldivider_center">
				
				<table width="80%">
					
						<tr>
							<td colspan="2" style="font-size: 18px;"　>
								<strong>ランキング ―（集計）―</strong>
								
								<?php $month=date("m"); 
									if($month==='01') echo '***1月***';
									if($month==='02') echo '***2月***';
									if($month==='03') echo '***3月***';
									if($month==='04') echo '***4月***';
									if($month==='05') echo '***5月***';
									if($month==='06') echo '***6月***';
									if($month==='07') echo '***7月***';
									if($month==='08') echo '***8月***';
									if($month==='09') echo '***9月***';
									if($month==='10') echo '***10月***';
									if($month==='11') echo '***11月***';
									if($month==='12') echo '***12月***';
								?>
							</td>
							
						</tr>	
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td style="font-size: 15px;">
								
							</td>
						</tr>
						
						
						
						<!--<tr>
							<td style="font-size: 15px;">
							
									年<select id="year" name="year"><option></option><option value="2020">2020</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016" >2016</option><option value="2015" >2015<option value="2014" >2014</option></select>
									
									
									月<select id="month" name="month"><option></option><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option><option value="11" >11</option><option value="12" >12</option></select> 
									</select>
								<hr />
							</td>
							<td style="font-size: 15px;">条件：
									<select name="course" id="course">
									<option>コース</option>
									<option>フェイシャル</option>
									<option>オプション</option>
									
								  </select>
								<hr />
							</td>
						</tr>-->
					</table> <center>
					
					<table width="70%">
						<tr>
							<form action="ranking" method = "post" target="frame_ranking">
							
							<td style="font-size: 15px;">
							
								<input type="submit" name="course" value="コース" class="shuukei">
								
							</td>
							<td>
								<input type="submit" name="course" value="フェイシャル" class="shuukei">
							
							</td>
							<td>
							<input type="submit" name="course" value="オプション" class="shuukei">
								
							</td>
							<!--<td>
							<input type="submit" name="course" value="指名" class="shuukei">
								
							</td>-->
						</tr>
						
						<tr>
						
						</tr>
						<tr></tr>
						</form>
					</table>
					<table>
						<tr>
							<td colspan="3"><center><iframe frameborder="0" name="frame_ranking" width="650px" height="350px"></iframe></center></td>
							
						</tr>
					</table></center>
					
			</div> 
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	      
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer -->

	</div> <!-- end of con