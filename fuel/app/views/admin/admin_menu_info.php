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
						<tr><td style="font-size: 12px;"><?php echo Asset::img('img2/user_icon.gif'); ?>	</td>
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
								<strong>サービス・メニュー管理ページ</strong><hr />
							</td>
							
						</tr>	
						
						
						
					</table> 
					
				</div>
				<div class="coldivider_center">
						<script type="text/javascript">
							$(function() {
								$('#ui-tab > ul').tabs();
							});
						</script>
					<div id="ui-tab">
						<ul>
							<li><a href="#fragment-1"><span>一覧</span></a></li>
							<li><a href="#fragment-2"><span>絞り込む</span></a></li>
							<li><pre>                    　　　　　　　　　　　　　　　　　　　　　　　　　</pre></li>
							<li><a href="#fragment-4"><span>新規登録</span></a></li>
						</ul>
						<p>※サービス・メニューの編集または削除を行いたい場合は、<span style="color:red;">サービス・メニュー名</span>をクリックしてください。</p>
						<div id="fragment-1">
							<div id="schedDiv">
							
								<div id="schedGrid">
									
									<table id="schedTable">
									
										<colgroup><col id="schedTableCol1"></colgroup>
										<thead>
											<tr>
												<th><span id="schedHdr0">サービス番号</span></th>
												<th><span id="schedHdr1">サービス名</span></th>
												<th><span id="schedHdr2">内容</span></th>
												<th><span id="schedHdr4">基本価格（税込）</span></th>
												<th><span id="schedHdr4">会員価格（税込）</span></th>
												<th><span id="schedHdr5">価格（税込）</span></th>
												
											</tr>
										</thead>
										
										<tbody> 
										<?php $i = 1;//$menu = array;?>
										
										<?php foreach((array)$rows as $row): ?>
											<tr>
											
												<?php	$row['svc_no'];  
														Session::set('no',array($i => $row['svc_no'])); 
														$no = Session::get('no') ;
														$menu_no = Arr::get($no,$i,'null'); ?>
												<td class="txt"><?php print $i;?></td>
												
												
												<?php  $row['svc_name']; 
														Session::set('name',array($i => $row['svc_name'])); 
														$svc_na = Session::get('name');
														$menu_name = Arr::get($svc_na,$i,'null');?>
												
											<form name="menuinfo" method="post" action="menudetails">	
												<td><input type="submit" name="menu" value="<?php print $menu_name;?>" class="box"></td>
											</form>	
											
												<?php 	$row['svc_contents']; 
														Session::set('contents',array($i => $row['svc_contents'])); 
														$contents = Session::get('contents'); 
														$menu_contents = Arr::get($contents,$i,'null');?>
												<td class="txt"><?php print $menu_contents;?></td>
												<?php Session::set('menucontents',$menu_contents); ?>
												
												<?php 	$row['svc_price_regular']; 
														Session::set('price',array($i => $row['svc_price_regular'])); 
														$price = Session::get('price'); 
														$menu_price = Arr::get($price,$i,'null'); ?>
												
												<td class="txt"><?php print  "￥".$menu_price;?></td>
												<?php Session::set('menuprice',$menu_price); ?>
												<td style="text-align:left;"><?php print "￥".$row['svc_price_member']?></td>
												<td style="text-align:left;"><?php print "￥".$row['svc_price_cont']?></td>
												
											<?php $i = $i+1; ?>
											
											</tr>
										<?php endforeach; ?> 
										<tr><td>&nbsp;</td></tr>
										
										<?php foreach((array)$facialrows as $facial): ?>
										<tr  align="left">
											<td align="left" style="text-align:left;" ><?php print $i; ?></td>
											<?php Session::set('facial_name',$facial['svc_name']);?>
											<form name="menu_facialinfo" method="post" action="menu_facialinfo">	
												<td><input type="submit" name="menu" value="<?php print $facial['svc_name']; ?>" class="box"></td>
												
											</form>	
										
											
											<td align="left" style="text-align:left;"><?php print $facial['svc_contents']; ?></td>
											<td align="left" style="text-align:left;"><?php print "￥".$facial['svc_price_regular']; ?></td>
											<td align="left" style="text-align:left;"><?php print "￥".$facial['svc_price_member']; ?></td>
											<td align="left" style="text-align:left;"><?php print "￥".$facial['svc_price_cont']?></td>
											</tr>
											<?php $i = $i+1; ?>
										<?php endforeach;?>
										
										<tr><td>&nbsp;</td></tr>
										
										<?php foreach((array)$optionrows as $option): ?>
										<tr  align="left">
											<td align="left" style="text-align:left;" ><?php print $i; ?></td>
											<form name="menu_optioninfo" method="post" action="menu_optioninfo">	
												<td><input type="submit" name="menu" value="<?php print $option['opt_name']; ?>" class="box"></td>
											</form>	
										
											
											<td align="left" style="text-align:left;"><?php print $option['opt_contents']; ?></td>
											<td align="left" style="text-align:left;"><?php print "￥".$option['opt_price_regular']; ?></td>
											<td align="left" style="text-align:left;"><?php print "￥".$option['opt_price_member']; ?></td>
											<td align="left" style="text-align:left;"><?php print "￥".$option['opt_price_cont'];?></td>
											</tr>
											<?php $i = $i+1; ?>
										<?php endforeach;?>
										
										</tbody>
								   
									</table>
								</div>
							</div>

						</div><!--end of the first tab-->
						
						<div id="fragment-2">
							<form name="search_menuinfo" method="post" action="search_menu">
								
								<select id="bt_form_menuinfo" name="bt_form_menuinfo">
									
									<option value="サービス名(コース)">サービス名(コース)</option>
									<option value="サービス名(フェイシャル)">サービス名(フェイシャル)</option>
									<option value="サービス名(オプション)">サービス名(オプション)</option>
									<option value="基本価格(コース)">基本価格（税込）(コース)</option>
									<option value="基本価格(フェイシャル)">基本価格（税込）(フェイシャル)</option>
									<option value="基本価格(オプション)">基本価格（税込）(オプション)</option>
								</select>
								<input type="text" name="txtcusvalue" id="txtcusvalue">
								<input type="submit" name="search" value="絞り込む">
								<td class="txt"><span style="color:red"><?php //echo Session::get_flash('alert'); ?> </span></td>
							</form>
							<p>&nbsp;</p>
							
						</div><!--end of the 2nd tab-->
						
						
						<div id="fragment-4"> <!--新規登録タッブ -->
							<table width="100%">
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2" style="font-size: 18px;"　>
										<strong>サービス・メニュー管理ページ新規登録</strong><hr />
									</td>
									
								</tr>	
								
								<tr><td>&nbsp;</td></tr>
								
							</table> 
							<form action="addnewmenu_confirm" name="addnewmenu_confirm" method="post"　>
								<div class="box-type1 ns">
								  <table width="100%" border="0" class="type1">
								  
									<tr>
										<th width="150">メニュー</th>
										<td>
											<select id="bt_form_menuinfo" name="menu">
												<option>コース</option>
												<option>フェイシャル</option>
												<option>オプション</option>
											</select>
										</td>
									</tr>
								
									<tr>
									  <th width="150">サービス名</th>
									  <td>
										<input type="text" id="bt_form_servicename" name="servicename"  size="50" maxlength="20" style="ime-mode:active">
											
										<p class="attention"></p>
									  </td>
									</tr>
									<tr>
									  <th width="150">内容</th>
									  <td>
										<input type="text" id="bt_form_service_content" name="service_content"  size="50" maxlength="400" style="ime-mode:active">
										
									  </td>
									</tr>
									<tr>
									  <th width="150">所要時間</th>
									  <td>
										<input type="text" id="bt_form_service_timespan" name="service_timespan"  size="50" maxlength="40" style="ime-mode:inactive">
										
									  </td>
									</tr>
									<tr>
									  <th width="150">基本価格（税込）</th>
									  <td>
										<input type="text" id="bt_form_service_price" name="service_price"  size="50" maxlength="40" style="ime-mode:inactive">
										
									  </td>
									</tr>
									<tr>
									  <th width="150">会員価格（税込）</th>
									  <td>
										<input type="text" id="bt_form_service_price_mem" name="service_price_mem"  size="50" maxlength="40" style="ime-mode:inactive">
										
									  </td>
									</tr><tr>
									  <th width="150">継続価格（税込）</th>
									  <td>
										<input type="text" id="bt_form_service_price_cont" name="service_price_cont"  size="50" maxlength="40" style="ime-mode:inactive">
										
									  </td>
									</tr>
													
									<tr>	
										<td align="center" colspan="2">
										
											<input name="submit" type="submit" value="確認" >
											<input name="reset" type="reset" value="リセット" >
										</form>
										</td>
									</tr>
								  </table>
							</div>
						</div>
						
						
						
						
					</div><!--end of tab-->
					
				</div><!--end of the coldivider_center-->
				
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	      
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer -->

	</div> <!-- end of container -->

</body>
</html>