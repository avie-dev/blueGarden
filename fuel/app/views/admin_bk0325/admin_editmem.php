<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
								<strong>お客様登録情報変更</strong><hr />
							</td>
							
						</tr>	
						
						<tr><td>&nbsp;</td></tr>
						
					</table> <form name="memberedit_confirm" action = "memberedit_confirm" method="post">
						<div class="box-type1 ns">
						<?php foreach((array)$rows as $row): ?>
						 <table width="100%" border="0" class="type1">
			  
						<tr>
						  <th width="150"><span class="attention">＊</span>メールアドレス</th>
						  
						  <td><br > 
							
						  <br> <!-- Get value from the database-->
						  
							&nbsp;&nbsp;&nbsp;&nbsp;
							<?php echo Form::input('cus_mail',Input::post('cus_mail',$row['email']),  array('required' => 'required' ,'size'=>'50', 'class' => 'textinput'),array('min_length' => '128')) 
							
								
							?>
						   
					
							<p></p>
						  </td>

						</tr>
						
						<tr>
						  <th width="150"><span class="attention">＊</span>お名前</th>
						  <td><br />
							&nbsp;&nbsp;&nbsp;&nbsp
							<?php 
									$name = Session::get('name');
									$kana = Session::get('kana');
									$tel = Session::get('tel');
									$postno = Session::get('postno');
									$pref = Session::get('pref');
									$addr1 = Session::get('addr1');
									$addr2 = Session::get('addr2');
									$sex = Session::get('sex');
									$birthy = Session::get('birthy');
									$birthm = Session::get('birthm');
									$birthd = Session::get('birthd');
									$reg_date = Session::get('reg_date');

							?>
							<?php echo Form::input('cus_name',Input::post('name',$name), array('required' => 'required' ,'size'=>'50', 'class' => 'textinput'))//, $name ?>
						
							<p class="attention"></p>
						  </td>
						</tr>
						<tr>
						  <th width="150">フリガナ</th>
						  <td><br />

							&nbsp;&nbsp;&nbsp;&nbsp
							<?php echo Form::input('cus_kana',Input::post('kana', $kana), array('size'=>'50', 'class' => 'textinput'),array('min_length' => '128')) ?>
						 
							<p class="attention"></p>
						  </td>
						</tr>

						<tr>
						  <th width="150">電話番号</th>
						  <td><br />
							&nbsp;&nbsp;&nbsp;&nbsp
							<?php echo Form::input('cus_tel', Input::post('tel', $tel), array('size'=>'38', 'class' => 'textinput') )?>
						 
							<p class="caption">※- （ハイフン）なしで記入　11桁以内</p>
							<p class="attention"></p>
						  </td>
						</tr>
						<tr>
						  <th width="150">郵便番号</th>
						  <td><br />
							&nbsp;&nbsp;&nbsp;&nbsp
							<?php echo Form::input('cus_zip',Input::post('postno', $postno), array('size'=>'18', 'class' => 'textinput'),array('maxlength' => '7')) ?>
						 
						
									<p class="caption">※- （ハイフン）なしで記入　7桁</p>
							<p class="attention"></p>
						  </td>
						</tr>
						<tr>
						  <th width="150">住所</th>
						  <td><p class="caption"></p>
							&nbsp;&nbsp;&nbsp;<select name="cus_pref" id="bt_form_cus_pref"><option><?php echo $pref?></option><optgroup label="---北海道---"><option value="北海道" >北海道</option></optgroup><optgroup label="---東北地区---"><option value="青森県" >青森県</option><option value="岩手県" >岩手県</option><option value="宮城県" >宮城県</option><option value="秋田県" >秋田県</option><option value="山形県" >山形県</option><option value="福島県" >福島県</option></optgroup><optgroup label="---関東信越地区---"><option value="茨城県" >茨城県</option><option value="栃木県" >栃木県</option><option value="群馬県" >群馬県</option><option value="埼玉県" >埼玉県</option><option value="千葉県" >千葉県</option><option value="東京都" >東京都</option><option value="神奈川県" >神奈川県</option><option value="山梨県" >山梨県</option><option value="長野県" >長野県</option><option value="新潟県" >新潟県</option></optgroup><optgroup label="---中部地区---"><option value="静岡県" >静岡県</option><option value="愛知県" >愛知県</option><option value="岐阜県" >岐阜県</option><option value="三重県" >三重県</option></optgroup><optgroup label="---北陸地区---"><option value="富山県" >富山県</option><option value="石川県" >石川県</option><option value="福井県" >福井県</option></optgroup><optgroup label="---近畿地区---"><option value="滋賀県" >滋賀県</option><option value="京都府" >京都府</option><option value="大阪府" >大阪府</option><option value="兵庫県" >兵庫県</option><option value="奈良県" >奈良県</option><option value="和歌山県" >和歌山県</option></optgroup><optgroup label="---中国地区---"><option value="鳥取県" >鳥取県</option><option value="島根県" >島根県</option><option value="岡山県" >岡山県</option><option value="広島県" >広島県</option><option value="山口県" >山口県</option></optgroup><optgroup label="---四国地区---"><option value="徳島県" >徳島県</option><option value="香川県" >香川県</option><option value="愛媛県" >愛媛県</option><option value="高知県" >高知県</option></optgroup><optgroup label="---九州地区---"><option value="福岡県" >福岡県</option><option value="佐賀県" >佐賀県</option><option value="長崎県" >長崎県</option><option value="熊本県" >熊本県</option><option value="大分県" >大分県</option><option value="宮崎県" >宮崎県</option><option value="鹿児島県" >鹿児島県</option></optgroup><optgroup label="---沖縄---"><option value="沖縄県" >沖縄県</option></optgroup><optgroup label="---その他---"><option value="海外" >海外</option></optgroup></select> 
							<span class="attention">▼都道府県を選択</span><p></p>
							&nbsp;&nbsp;&nbsp;<?php echo Form::input('cus_addr1',Input::post('addr1', $addr1),array('size'=>'50', 'class' => 'textinput') ) ?><span class="attention">※市区町村・番地</span>
							<p class="attention"></p>
							&nbsp;&nbsp;&nbsp;<?php echo Form::input('cus_addr2',Input::post('addr1', $addr2),array('size'=>'50', 'class' => 'textinput') ) ?><span class="attention">※建物名など</span>
						   
					
							  <p class="attention"></p>
						  </td>
						</tr>
						<tr>
						  <th width="150">性別</th>
						  <td><br />
							&nbsp;&nbsp;&nbsp;&nbsp;
							<?php 
							
								if($sex==='女')
								{
									echo Form::label('男性','gender_male');
									echo Form::radio('cus_sex', '男', array( 'id'=>'form_gender_male'));
									echo Form::label('女性','gender_female');
									echo Form::radio('cus_sex','女', array('checked'=>'checked','id'=>'form_gender_female'));
								}
								if($sex==='男')
								{
									echo Form::label('男性','gender_male');
									echo Form::radio('cus_sex', '男', array( 'checked'=>'checked','id'=>'form_gender_male'));
									echo Form::label('女性','gender_female');
									echo Form::radio('cus_sex','女', array('id'=>'form_gender_female'));
								}
								if($sex===null)
								{
									echo Form::label('男性','gender_male');
									echo Form::radio('cus_sex', '男', array( 'id'=>'form_gender_male'));
									echo Form::label('女性','gender_female');
									echo Form::radio('cus_sex','女', array('id'=>'form_gender_female'));
								}
							
								
							?>
							
							<p class="caption"></p>
							<p class="attention"></p>
						  </td>
						</tr>
						<tr>
						  <th width="150">生年月日</th>
						  <td><br />
							&nbsp;&nbsp;&nbsp;&nbsp
							<select id="bt_form_cus_birthy" name="cus_birthy"><option><?php echo $birthy?></option><option value="2014" >2014</option><option value="2013" >2013</option><option value="2012" >2012</option><option value="2011" >2011</option><option value="2010" >2010</option><option value="2009" >2009</option><option value="2008" >2008</option><option value="2007" >2007</option><option value="2006" >2006</option><option value="2005" >2005</option><option value="2004" >2004</option><option value="2003" >2003</option><option value="2002" >2002</option><option value="2001" >2001</option><option value="2000" >2000</option><option value="1999" >1999</option><option value="1998" >1998</option><option value="1997" >1997</option><option value="1996" >1996</option><option value="1995" >1995</option><option value="1994" >1994</option><option value="1993" >1993</option><option value="1992" >1992</option><option value="1991" >1991</option><option value="1990" >1990</option><option value="1989" >1989</option><option value="1988" >1988</option><option value="1987" >1987</option><option value="1986" >1986</option><option value="1985" >1985</option><option value="1984" >1984</option><option value="1983" >1983</option><option value="1982" >1982</option><option value="1981" >1981</option><option value="1980" >1980</option><option value="1979" >1979</option><option value="1978" >1978</option><option value="1977" >1977</option><option value="1976" >1976</option><option value="1975" >1975</option><option value="1974" >1974</option><option value="1973" >1973</option><option value="1972" >1972</option><option value="1971" >1971</option><option value="1970" >1970</option><option value="1969" >1969</option><option value="1968" >1968</option><option value="1967" >1967</option><option value="1966" >1966</option><option value="1965" >1965</option><option value="1964" >1964</option><option value="1963" >1963</option><option value="1962" >1962</option><option value="1961" >1961</option><option value="1960" >1960</option><option value="1959" >1959</option><option value="1958" >1958</option><option value="1957" >1957</option><option value="1956" >1956</option><option value="1955" >1955</option><option value="1954" >1954</option><option value="1953" >1953</option><option value="1952" >1952</option><option value="1951" >1951</option><option value="1950" >1950</option><option value="1949" >1949</option><option value="1948" >1948</option><option value="1947" >1947</option><option value="1946" >1946</option><option value="1945" >1945</option><option value="1944" >1944</option><option value="1943" >1943</option><option value="1942" >1942</option><option value="1941" >1941</option><option value="1940" >1940</option><option value="1939" >1939</option><option value="1938" >1938</option><option value="1937" >1937</option><option value="1936" >1936</option><option value="1935" >1935</option><option value="1934" >1934</option><option value="1933" >1933</option><option value="1932" >1932</option><option value="1931" >1931</option><option value="1930" >1930</option><option value="1929" >1929</option><option value="1928" >1928</option><option value="1927" >1927</option><option value="1926" >1926</option><option value="1925" >1925</option><option value="1924" >1924</option><option value="1923" >1923</option><option value="1922" >1922</option><option value="1921" >1921</option><option value="1920" >1920</option><option value="1919" >1919</option><option value="1918" >1918</option><option value="1917" >1917</option><option value="1916" >1916</option><option value="1915" >1915</option><option value="1914" >1914</option><option value="1913" >1913</option><option value="1912" >1912</option><option value="1911" >1911</option><option value="1910" >1910</option><option value="1909" >1909</option><option value="1908" >1908</option><option value="1907" >1907</option><option value="1906" >1906</option><option value="1905" >1905</option><option value="1904" >1904</option><option value="1903" >1903</option><option value="1902" >1902</option><option value="1901" >1901</option></select>年 
							<select id="bt_form_cus_birthm" name="cus_birthm"><option><?php echo $birthm?></option><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option><option value="11" >11</option><option value="12" >12</option></select>月 
							<select id="bt_form_cus_birthd" name="cus_birthd"><option><?php echo $birthd?></option><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option><option value="11" >11</option><option value="12" >12</option><option value="13" >13</option><option value="14" >14</option><option value="15" >15</option><option value="16" >16</option><option value="17" >17</option><option value="18" >18</option><option value="19" >19</option><option value="20" >20</option><option value="21" >21</option><option value="22" >22</option><option value="23" >23</option><option value="24" >24</option><option value="25" >25</option><option value="26" >26</option><option value="27" >27</option><option value="28" >28</option><option value="29" >29</option><option value="30" >30</option><option value="31" >31</option></select>日 
									<p class="caption"></p>
							<p class="attention"></p>
						  </td>
						</tr>
						
						<tr>	
							<td align="center" colspan="2" style="padding-top:15px;padding-bottom:15px;">
								
									<input name="submit" type="submit" value="確認" >
									<input action="action" type="button" value="戻る" onclick="history.go(-1);" />
								</form>
							</td>
						</tr>
						<?php //echo Form::close();?>
						<?php endforeach; ?>
						
					  </table>
						</div>
					
				</div>
				
				
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	      
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer