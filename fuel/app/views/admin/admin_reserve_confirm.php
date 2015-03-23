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
							<tr>
								
								<td><?php echo Asset::img('pword_icon.png'); ?>	</td>
								<td class="navi_btn"><a href="staffinfo">従業員情報管理</a></td>
								
							</tr>
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
								<strong>お客様新規予約　ー確認ー</strong><hr />
							</td>
							
						</tr>	
						
						<tr><td>&nbsp;</td></tr>
						
					</table> 
						<center>
						<table width="100%" border="0"  class="columntitle">
							<tr><td>ご予約内容に間違いがなければ［予約を確定］ボタンを押してください。</td></tr>
						</table>
						
						<!-- ご予約内容確認 Table-->
				<table width="90%">
					<tr><td colspan="2"><h3><p>ご予約内容確認</p></h3></td></tr>
					<tr>
						<td width="30%"><h3>スタッフ</h3></td>
						<td  ><h3><?php echo $staff; Session::set('staff',$staff); ?></h3>
						</td>
						
					</tr>
					<?php if(($course1=="なし") && ($course2=="なし")){?>
					<tr>
						<td  ><h3>コース（メニュー</h3></td>
						<td  >
						<h3>
							<?php
							Session::set('course1',"なし");
							Session::set('course2',"なし");
							Session::set('course1_minsel',0); 
							Session::set('course2_minsel',0);
							?>
							なし
						</h3></td>
					</tr>	
					<?php } else {?>
					<tr>
						<td  ><h3>コース（メニュー）</h3></td>
						<td  >
						<h3>
						<?php if(($course1=="なし") && ($course2!="なし")){
							echo $course2; Session::set('course2',$course2); Session::set('course1',"なし"); $course2_minsel; Session::set('course1_minsel',0); Session::set('course2_minsel',$course2_minsel);
							//print "&nbsp;&nbsp;&nbsp;";
						}elseif(($course2=="なし") && ($course1!="なし")){
							echo $course1; Session::set('course1',$course1); Session::set('course2',"なし");$course1_minsel; Session::set('course1_minsel',$course1_minsel); Session::set('course2_minsel',0);
							//print "<br>&nbsp;&nbsp;&nbsp;";
						}else{
							echo $course1; Session::set('course1',$course1); $course1_minsel; Session::set('course1_minsel',$course1_minsel);
							print "<br>";
							echo $course2; Session::set('course2',$course2); $course2_minsel; Session::set('course2_minsel',$course2_minsel);
						}?>
						
						<?php //echo $course3; Session::set('course3',$course3); $course3_minsel; Session::set('course3_minsel',$course3_minsel);?>
						</h3></td>
					</tr>					
					<?php } ?>
					<?php if($option!=""){?>
					<tr>
						<td  ><h3>オプション</h3></td>
						<td  ><h3>
						<?php echo $option; Session::set('option',$option); ?>
						</h3></td>
					</tr>
					<?php } else{?>
					<?php Session::set('option',"");}?>
					<tr>
						<td  　><h3>ご予約日</h3></td>
						<td  　><h3><?php echo $resdate; echo " (".$weekday.")"; Session::set('resdate',$resdate); ?></h3></td>
					</tr>
					<tr>
						<td  　><h3>時間</h3></td>
						<td  　><h3><?php echo $restime; Session::set('restime',$restime); ?> ～</h3></td>
					</tr>
					<tr>
						<td  　><h3>合計金額</h3></td>
						<td  　><h3><?php echo number_format($totalamount); Session::set('totalamount',$totalamount); ?> 円 (税込)</h3></td>
					</tr>
					<tr></tr>

				</table>
				<!-- End of ご予約内容確認 Table-->
						
						<!-- お客様情報 Table-->
						<table width="90%" style="margin-top:20px;margin-bottom:20px;">
							<tr><td colspan="2"><h3><p>お客様情報</p></h3></td></tr>
							<tr>
								<td width="30%"><h3>メールアドレス</h3></td>
								<td  ><h3><?php echo $email ?></h3>
								</td>
								
							</tr>
							<tr>
								<td  ><h3>お名前</h3></td>
								<td  ><h3><?php echo $name ?></h3>
								</td>
							</tr>
							<tr>
								<td  ><h3>フリカナ</h3></td>
								<td  ><h3><?php echo $kana ?></h3></td>
							</tr>
							<tr>
								<td  　><h3>電話番号</h3></td>
								<td  　><h3><?php echo $tel ?></h3></td>
							</tr>
							<tr>
								<td  　><h3>郵便番号</h3></td>
								<td  　><h3><?php echo $postno ?></h3></td>
							</tr>
							<tr>
								<td  　><h3>住所</h3></td>
								<td  　><h3><?php echo $pref ?><?php echo $addr1 ?><?php echo $addr2 ?></h3></td>
							</tr>
							<tr>
								<td  　><h3>性別</h3></td>
								<td  　><h3><?php echo $sex ?></h3></td>
							</tr>
							<tr>
								<td  　><h3>生年月日</h3></td>
								<td  　><h3><?php echo $birthy ?>年<?php echo $birthm ?>月<?php echo $birthd ?>日</h3></td>
							</tr>
				<!--	追加		-->
						<?php 		$resnumber = Session::get('checkresnunber');
							if($resnumber != ''){ ?>
							<tr>
								<td  　><h3>予約番号</h3></td>
								<td  　><h3><?php echo $resnumber; Session::set('resno',$resnumber); ?></h3></td>					
							</tr>
						<?php }else{ ?>
							<tr>
								<td  　><h3>予約番号</h3></td>
								<td  　><h3><?php echo $resno; Session::set('resno',$resno); ?></h3></td>					
							</tr>
						<?php } ?>
				<!--	追加		-->							
							<tr></tr>

						</table>
						<!-- お客様情報 Table-->
						<!-- フリーメッセージ Table-->
						<table width="90%" style="margin-top:20px;margin-bottom:20px;">
							<tr><td colspan="2"><h3><p>予約についてのご要望などメッセージがございましたらご記入ください</p></h3></td></tr>
							<tr>
								<td  >
									<form action="reservefinished" method="post">
										<textarea rows="10" cols="70" name="freemessage" maxlength="300"></textarea>
										<p></p>
										<tr>
										<td  >
											<center>											
													<input action="action" type="button" value="戻る" onclick="history.go(-1);" />
													<input type="submit" value="予約を確認する">
											</center>
										</td>
										</tr>
									</form>
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