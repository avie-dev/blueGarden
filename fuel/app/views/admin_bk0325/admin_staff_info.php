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
						<tr><td><?php echo Asset::img('img2/user_icon.gif'); ?>	</td>
							<td>
								店舗：<?php echo Session::get('branch');?><br><hr>役割：<?php echo Session::get('role');?><i></i>
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
								<strong>従業員情報管理ページ</strong><hr />
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
							<li><a href="#fragment-3"><span>アカウント設定</span></a></li>
							<li><pre>                    　　　　　　　　　　　　　　</pre></li>
							<li><a href="#fragment-4"><span>新規登録</span></a></li>
						</ul>
						
						<div id="fragment-1"><p>※従業員情報の編集または削除を行いたい場合は、<span style="color:red;">従業員名</span>をクリックしてください。</p>
							<div id="schedDiv">
							
								<div id="schedGrid">
									
									<table id="schedTable">
									
										<colgroup><col id="schedTableCol1"></colgroup>
										<thead>
											<tr>
												<th><span id="schedHdr0">スタッフ番号</span></th>
												<th><span id="schedHdr1">スタッフ名</span></th>
												<th><span id="schedHdr2">性別</span></th>
												<!--<th><span id="schedHdr4">年齢</span></th>	-->
												<th><span id="schedHdr3">誕生日</span></th>
												<th><span id="schedHdr4">登録日付</span></th>
												<th><span id="schedHdr5">時給</span></th>
											</tr>
										</thead>
										
										<tbody>
											<?php $i = 1; ?>
											<?php foreach((array)$rows as $row): ?>
											<tr>
											
											
											<?php $row['created_at']; 
											Session::set('created_at',array($i=>$row['created_at'])); 
											$create = Session::get('created_at');
											$screate = Arr::get($create,$i,'null'); ?>
											
											<?php $row['staff_no'];
													Session::set('staff_no',array($i =>$row['staff_no']));
													$sn = Session::get('staff_no');
													$number = Arr::get($sn,$i,'null'); ?>
												<td class="txt">
												<?php 
												$branch = Session::get('admin_branch');
												if($branch ==='1'){
													echo 'BGK';
												}else if ($branch ==='2'){
													echo 'BGI';
												}
											?><?php echo $number; ?></td>
												
											<?php $row['staff_name'];
												 Session::set('staff_name',array($i =>$row['staff_name'])); 
												$name = Session::get('staff_name');
												$sname = Arr::get($name,$i,'null'); ?>	

											<form name="staffinfo "method="post" action="staffprofile">
												<td><input type="submit" name="staff" value="<?php echo $sname; ?>" class="box"></td>
											</form>	
											
											<?php $row['sex']; 
												Session::set('sex',array($i =>$row['sex'])); 
												$sex = Session::get('sex');
												$ssex = Arr::get($sex,$i,'null');?>
											<td class="txt"><?php echo $ssex; ?></td>
											<?php Session::set('ssex',$ssex)?>
											
											
											<?php /*$row['age'];
												Session::set('age',array($i =>$row['age'])); 
												$age = Session::get('age');
												$sage = Arr::get($age,$i,'null'); */?>
											<!--<td class="txt"><?//php echo $sage; ?></td>
											-->
											
											<?php $row['birthy'];
												Session::set('birthy',array($i =>$row['birthy'])); 
												$birthy = Session::get('birthy');
												$sbirthy = Arr::get($birthy,$i,'null'); ?>
												
											<?php $row['birthm'];
												Session::set('birthm',array($i=>$row['birthm']));
												$birthm = Session::get('birthm');
												$sbirthm = Arr::get($birthm,$i,'null'); ?>
												
											<?php $row['birthd'];
												Session::set('birthd',array($i=>$row['birthd']));
												$birthd = Session::get('birthd');
												$sbirthd = Arr::get($birthd,$i,'null');?>
												
											<td class="txt">
											<?php echo $sbirthy; ?>年
											<?php echo $sbirthm; ?>月
											<?php echo $sbirthd; ?>日
											</td>
											
											<td class="txt"><?php echo $screate; ?> </td>
											<td class="txt"><?php echo $row['hour_rate'].'円'; ?> </td>
											
											
											</tr>
											<?php Session::set('staffid',$row['staff_no']) ?>
											<?php $i = $i + 1; ?>
											<?php endforeach; ?>
											
										</tbody>
								   
									</table>
									
								</div>
							</div>

						</div><!--end of the first tab-->
						
						<div id="fragment-2">
							<form name="search_staffinfo" action="search_staffinfo" method="post">
							<script>
								
							</script>
								<select id="staff" name="staff">
									<option value="スタッフ番号">スタッフ番号</option>
									<option value="スタッフ名">スタッフ名</option>
								</select>
								
							
								<INPUT type="text" name="***" style="ime-mode:inactive">
								<input type="submit" name="search" value="絞り込む">
								<p style= "color:red">※スタッフ番号の入力の場合、最初の「
								<?php 
												$branch = Session::get('admin_branch');
												if($branch ==='1'){
													echo 'BGK';
												}else if ($branch ==='2'){
													echo 'BGI';
												}
									?>」抜けで入力してください。
								</p>
								<?php Session::get('staff'); ?>
							</form>
							<p>&nbsp;</p>
							
							
						</div><!--end of the 2nd tab-->
						<!--2nd tab-->
						<div id="fragment-3">
							<form action="changepassword" method = "post">
								<input type="submit" name="search" value="管理者パスワードの変更">
							</form>
							
							<p>&nbsp;</p>
							
							
						</div><!--end of the 3rd tab-->
						
						<div id="fragment-4"> <!--新規登録タッブ -->
							<table width="100%">
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2" style="font-size: 18px;"　>
										<strong>従業員新規会員登録</strong><hr />
									</td>
									
								</tr>	
								
								<tr><td>&nbsp;</td></tr>
								
							</table> 
							
								<div class="box-type1 ns">
								<form action="addnewstaff_confirm" name="addnewstaff_confirm" method="post"　>	
									  <table width="100%" border="0" class="type1">
										<th width="150">スタッフ番号</th>
										  <td>
											<?php 
												$branch = Session::get('admin_branch');
												if($branch ==='1'){
													echo 'BGK';
												}else if ($branch ==='2'){
													echo 'BGI';
												}
											?>
											
											<input type="text" id="bt_form_staff_no" name="staff_no"  size="5" maxlength="20" value="" style="ime-mode:active">
												
											<p class="attention"></p>
										  </td>
										</tr>

										  <th width="150">スタッフ名</th>
										  <td>
											<input type="text" id="bt_form_staff_name" name="staff_name"  size="50" maxlength="20" value="" style="ime-mode:active">
												
											<p class="attention"></p>
										  </td>
										</tr>
										<tr>
										  <th width="150">性別</th>
										  <td>
											<input id="bt_form_staff_sex1" type="radio" value="1" name="staff_sex" ><label for="bt_form_staff_sex1">男性</label>
											<input id="bt_form_staff_sex2" type="radio" value="2" name="staff_sex" ><label for="bt_form_staff_sex2">女性</label><br>
									
													<p class="caption"></p>
											<p class="attention"></p>
										  </td>
										</tr>
										
										<tr>
										  <th width="150">生年月日</th>
										  <td>
											<select id="bt_form_staff_birthy" name="staff_birthy"><option value=""></option><option value="2014" >2014</option><option value="2013" >2013</option><option value="2012" >2012</option><option value="2011" >2011</option><option value="2010" >2010</option><option value="2009" >2009</option><option value="2008" >2008</option><option value="2007" >2007</option><option value="2006" >2006</option><option value="2005" >2005</option><option value="2004" >2004</option><option value="2003" >2003</option><option value="2002" >2002</option><option value="2001" >2001</option><option value="2000" >2000</option><option value="1999" >1999</option><option value="1998" >1998</option><option value="1997" >1997</option><option value="1996" >1996</option><option value="1995" >1995</option><option value="1994" >1994</option><option value="1993" >1993</option><option value="1992" >1992</option><option value="1991" >1991</option><option value="1990" >1990</option><option value="1989" >1989</option><option value="1988" >1988</option><option value="1987" >1987</option><option value="1986" >1986</option><option value="1985" >1985</option><option value="1984" >1984</option><option value="1983" >1983</option><option value="1982" >1982</option><option value="1981" >1981</option><option value="1980" >1980</option><option value="1979" >1979</option><option value="1978" >1978</option><option value="1977" >1977</option><option value="1976" >1976</option><option value="1975" >1975</option><option value="1974" >1974</option><option value="1973" >1973</option><option value="1972" >1972</option><option value="1971" >1971</option><option value="1970" >1970</option><option value="1969" >1969</option><option value="1968" >1968</option><option value="1967" >1967</option><option value="1966" >1966</option><option value="1965" >1965</option><option value="1964" >1964</option><option value="1963" >1963</option><option value="1962" >1962</option><option value="1961" >1961</option><option value="1960" >1960</option><option value="1959" >1959</option><option value="1958" >1958</option><option value="1957" >1957</option><option value="1956" >1956</option><option value="1955" >1955</option><option value="1954" >1954</option><option value="1953" >1953</option><option value="1952" >1952</option><option value="1951" >1951</option><option value="1950" >1950</option><option value="1949" >1949</option><option value="1948" >1948</option><option value="1947" >1947</option><option value="1946" >1946</option><option value="1945" >1945</option><option value="1944" >1944</option><option value="1943" >1943</option><option value="1942" >1942</option><option value="1941" >1941</option><option value="1940" >1940</option><option value="1939" >1939</option><option value="1938" >1938</option><option value="1937" >1937</option><option value="1936" >1936</option><option value="1935" >1935</option><option value="1934" >1934</option><option value="1933" >1933</option><option value="1932" >1932</option><option value="1931" >1931</option><option value="1930" >1930</option><option value="1929" >1929</option><option value="1928" >1928</option><option value="1927" >1927</option><option value="1926" >1926</option><option value="1925" >1925</option><option value="1924" >1924</option><option value="1923" >1923</option><option value="1922" >1922</option><option value="1921" >1921</option><option value="1920" >1920</option><option value="1919" >1919</option><option value="1918" >1918</option><option value="1917" >1917</option><option value="1916" >1916</option><option value="1915" >1915</option><option value="1914" >1914</option><option value="1913" >1913</option><option value="1912" >1912</option><option value="1911" >1911</option><option value="1910" >1910</option><option value="1909" >1909</option><option value="1908" >1908</option><option value="1907" >1907</option><option value="1906" >1906</option><option value="1905" >1905</option><option value="1904" >1904</option><option value="1903" >1903</option><option value="1902" >1902</option><option value="1901" >1901</option></select>年 <select id="bt_form_staff_birthm" name="staff_birthm"><option value=""></option><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option><option value="11" >11</option><option value="12" >12</option></select>月 <select id="bt_form_staff_birthd" name="staff_birthd"><option value=""></option><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option><option value="11" >11</option><option value="12" >12</option><option value="13" >13</option><option value="14" >14</option><option value="15" >15</option><option value="16" >16</option><option value="17" >17</option><option value="18" >18</option><option value="19" >19</option><option value="20" >20</option><option value="21" >21</option><option value="22" >22</option><option value="23" >23</option><option value="24" >24</option><option value="25" >25</option><option value="26" >26</option><option value="27" >27</option><option value="28" >28</option><option value="29" >29</option><option value="30" >30</option><option value="31" >31</option></select>日 
													
											<p class="attention"></p>
										  </td>
										 </tr>
										 <tr>
										  <th width="150">自己紹介</th>
										  <td>
											<input type="text" id="bt_form_staff_intro" name="staff_intro"  size="50" maxlength="20" value="" style="ime-mode:active">
												
										  </td>
										</tr>
										<tr>
										  <th width="150">時給</th>
										  <td>
											<input type="text" id="bt_form_staff_rate" name="staff_rate"  size="10" maxlength="20" value="" style="ime-mode:active">
												円
										  </td>
										</tr>
											
										<tr>	
											<td align="center" colspan="2">
											
												<input name="submit" type="submit" value="確認" >
												
						<input action="action" type="button" value="戻る" onclick="history.go(-1);" />
											
											</td>
										</tr>
									  </table>
								</form>
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