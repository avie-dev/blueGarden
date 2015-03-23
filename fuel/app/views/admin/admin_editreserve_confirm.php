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
								<strong>予約変更　ー確認ー</strong><hr />
							</td>
							
						</tr>	
						
						<tr><td>&nbsp;</td></tr>
						
					</table> 
						<center>
						<table width="100%" border="0"  class="columntitle">
							<tr><td>最終内容確認</td></tr><!--Column Title Table -->
						</table>
						<p ><h3 style="text-align:left">ご予約内容に間違いがなければ［予約を確定］ボタンを押してください。</h3></p>
						
						<!-- ご予約内容確認 Table-->
						<table width="90%" style="margin-top:20px;margin-bottom:20px;">
							<tr><td class="ptablespacer" colspan="2"><h3><p>ご予約内容確認</p></h3></td></tr>
							<tr>
								<td class="ptablespacer" width="30%"><h3><p>スタッフ</p></h3></td>
								<td class="ptablespacer"><h3>フリースタッフ選択</h3>
								</td>
								
							</tr>
							<tr>
								<td class="ptablespacer"><h3><p>コース（メニュー）</p></h3></td>
								<td class="ptablespacer"><h3>アロマボディー30分</h3>
								</td>
							</tr>
							<tr>
								<td class="ptablespacer"><h3><p>オプション</p></h3></td>
								<td class="ptablespacer"><h3>ゴッドスカルプ</h3></td>
							</tr>
							<tr>
								<td class="ptablespacer"　><h3><p>ご予約日</p></h3></td>
								<td class="ptablespacer"　><h3>12/8(日)</h3></td>
							</tr>
							<tr>
								<td class="ptablespacer"　><h3><p>時間</p></h3></td>
								<td class="ptablespacer"　><h3>11時～</h3></td>
							</tr>
							<tr></tr>

						</table>
						<!-- End of ご予約内容確認 Table-->
						
						<!-- お客様情報 Table-->
						<table width="90%" style="margin-top:20px;margin-bottom:20px;">
							<tr><td class="ptablespacer" colspan="2"><h3><p>お客様情報</p></h3></td></tr>
							<tr>
								<td class="ptablespacer" width="30%"><h3><p>メールアドレス</p></h3></td>
								<td class="ptablespacer"><h3>arts_college@kccollege.ac.jp</h3>
								</td>
								
							</tr>
							<tr>
								<td class="ptablespacer"><h3><p>お名前</p></h3></td>
								<td class="ptablespacer"><h3>Arts　College</h3>
								</td>
							</tr>
							<tr>
								<td class="ptablespacer"><h3><p>フリカナ</p></h3></td>
								<td class="ptablespacer"><h3>アーツ　カレッジ</h3></td>
							</tr>
							<tr>
								<td class="ptablespacer"　><h3><p>電話番号</p></h3></td>
								<td class="ptablespacer"　><h3>12345678910</h3></td>
							</tr>
							<tr>
								<td class="ptablespacer"　><h3><p>郵便番号</p></h3></td>
								<td class="ptablespacer"　><h3>1234567</h3></td>
							</tr>
							<tr>
								<td class="ptablespacer"　><h3><p>住所</p></h3></td>
								<td class="ptablespacer"　><h3>神奈川県横浜市ど何処出区0-0-0-1号</h3></td>
							</tr>
							<tr>
								<td class="ptablespacer"　><h3><p>性別</p></h3></td>
								<td class="ptablespacer"　><h3>女</h3></td>
							</tr>
							<tr>
								<td class="ptablespacer"　><h3><p>生年月日</p></h3></td>
								<td class="ptablespacer"　><h3>1991年1月1日</h3></td>
							</tr>
							<tr></tr>

						</table>
						<!-- お客様情報 Table-->
						<!-- フリーメッセージ Table-->
						<table width="90%" style="margin-top:20px;margin-bottom:20px;">
							<tr><td class="ptablespacer" colspan="2"><h3><p>メモ</p></h3></td></tr>
							<tr>
								<td class="ptablespacer">
									<form>
									<textarea rows="10" cols="70" name="freemessage" maxlength="300"></textarea>
									</form>
								
								</td>
							</tr>
							<tr>
								<td class="ptablespacer">
									<center>
										<form action="editreservefinished">	
											<input action="action" type="button" value="戻る" onclick="history.go(-1);" />
											<input type="submit" value="予約を確定する">
										</form>
									</center>
								</td>
							</tr>
						</table>
					  
				</div>
				</center>
					
				</div>
				
				
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	      
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer -->

	</div> <!-- end of container -->

</body>
</html>