<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
//データベース接続
//変更箇所　ここ


		 
		 $query = DB::select()->from('tblmail');
		 $result = $query->execute();
		 $tblmail = $result;
		 foreach($result as $tblmail);

		 $query = DB::select()->from('tblmailtype');
		 $result = $query->execute();
		 $tblmailtype = $result;
		 foreach($result as $tblmailtype);
		 
//変更箇所　まで
// カレントの言語を日本語に設定する
	mb_language("ja");
	
// 内部文字エンコードを設定する
	mb_internal_encoding("utf8");
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blue Garden Admin Page</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="keywords" content="blue garden" />
<meta name="description" content="Blue Garden 上永谷のアロマサロン " />

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
						<tr><td ><?php echo Asset::img('img2/user_icon.gif'); ?>	</td>
							<td>
								店舗：<?php echo Session::get('branch');?><br><hr><i>役割：<?php echo Session::get('role');?></i>
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
								<strong>メール設定</strong><hr />
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
							<li><a href="#fragment-1"><span>基本設定</span></a></li>
							<li><a href="#fragment-2"><span>自動配信メール（メールテンプレート編集）</span></a></li>
							
						</ul>
						
						<div id="fragment-1">
							<form name="mail_basic_setting" action="mailbasic_confirm" method="post">
							<table>
								<tr><td>&nbsp;</td></tr>
								<tr><td><strong>メール送信先</strong></td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									  <th width="150"><span class="attention">＊</span>お問い合わせメール</th>
									  <td>
										<input type="text" id="mail" name="mail"  size="80" maxlength="128" value="<?php print (htmlspecialchars($tblmail['mail_add'],ENT_QUOTES)); ?>" style="ime-mode:disabled">
												<p class="caption"></p>
										<p class="attention"></p>
									  </td>
								</tr>
								
							</table>

							<table>
								<tr><td>&nbsp;</td></tr>
								<tr><td><strong>メール挿入用署名</strong></td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									  <th width="150">署名</th>
									  <td>
									  
										<td class="ptablespacer">
											<textarea rows="8" cols="70" name="signature" maxlength="300" value=""><?php echo (htmlspecialchars($tblmail['signature'],ENT_QUOTES)); ?></textarea>
										</td>
								</tr>
								<tr><td><input type="submit" name="basicmail_reg" value="登録する"></td></tr>
							</table>
							</form>
							<tr><td colspan="2" align="center">
							
							<hr />
							<div style="text-align: left;"> 
							<span style="color:red;font-size:13px" >※</span><span style="font-size:13ｓpx">変更の際は登録するをクリックしてください。</span>
							<br>
							<span style="font-size:13px">　・署名はフッタのあとに記入されます。</span>

							
							</div></td></tr>
							<!--変更箇所　-->
						</div><!--end of the first tab-->
						
						<div id="fragment-2">
							<table width="100%">
								<tr>
								<!--------------------1---------------------->
									<td><center>
											<table width="90%">							
																	
												<th width="150" align="left"><span class="attention"></span>
													種類 
												</th>
												<th width="300" align="left"><span class="attention"></span>
													説明
												</th>
												
												<form action="mailsetting_edit" method="post">
													<tr>	
														<?php				
														foreach ($result as $tblmailtype) {
														
														?><p><tr style="height:35px">
														
														<td><input type="submit" value="<?php print($tblmailtype['type'])?>" name="submit" id="submit" onclick="" style="width:120px;"></td>
														
														
														<td>
														<?php print($tblmailtype['explanation']); ?>
														</td>

														
														</tr></p>
														<?php
														}
														?>
													</tr>	
													</form>
													<tr><td colspan="2" align="center">
													
													<hr />
													<div style="text-align: left;"> <!--変更箇所　ここ -->
													<span style="color:red;font-size:13px" >※</span><span style="font-size:13ｓpx">変更の際は種類のボタンをクリックしてください。</span>
													<br>
													<span style="font-size:13px"> ・全てのメールのヘッダの前に登録者のお名前が自動的に記入されます。</span>
													<br>
													<span style="font-size:13px"> ・予約及び予約キャンセルにはお名前の後に挨拶と店舗名が自動的に記入され、</span>
													<br>
													<span style="font-size:13px">　ヘッダとメール内容の間に予約内容が自動的に記入されます。</span>
													<br>
													<span style="font-size:13px"> ・パスワード確認メールには名前の後に登録者のパスワードが記入されます。</span>
													
													</div></td></tr><!--変更箇所　まで -->
												</table>
									
									
									</td>
								<!-------------------1 end-------------------------->
								</tr>
								
							</table></center>
							
							
						</div><!--end of the 2nd tab-->
						
						
						
						
						
					</div><!--end of tab-->
					
				</div><!--end of the coldivider_center-->
				
	    </div> <!-- end of