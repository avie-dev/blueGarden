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
								<strong>お客様情報管理ページ</strong><hr />
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
						
						<div id="fragment-1">
						<p>※お客様情報の編集または削除を行いたい場合は、お客様の<span style="color:red;">ID</span>をクリックしてください。</p>
							<div id="schedDiv">
							
								<div id="schedGrid">
									
									<table id="schedTable">
									
										<colgroup><col id="schedTableCol1"></colgroup>
										<thead>
											<tr>
												<th><span id="schedHdr0"><center>ID</center></span></th>
												<th><span id="schedHdr0">会員</span></th>　<!--変更箇所-->
												<th><span id="schedHdr0">お名前</span></th>
												<th><span id="schedHdr1">フリガナ</span></th>
												<th><span id="schedHdr1">メールアドレス</span></th>
												<th><span id="schedHdr2">生年月日</span></th>
												<th><span id="schedHdr3">性別</span></th>
												<th><span id="schedHdr4">住所</span></th>
												<th><span id="schedHdr5">電話番号</span></th>
												<th><span id="schedHdr6">登録日</span></th>
												
											</tr>
										</thead>
										
										<tbody><?php $i = 0;
													 $j = 0;
											?>
											<?php foreach((array)$rows as $row): ?>
											<tr>
												<?php 
												Auth::get_all($i);
												$authrec = \Session::get('authrec');
											
												$name = \Arr::get($authrec, "name", "");
												$kana= \Arr::get($authrec, "kana", "");
												$tel = \Arr::get($authrec, "tel", "");
												$post_no = \Arr::get($authrec, "post_no", "");
												$pref = \Arr::get($authrec, "pref", "");
												$addr1 = \Arr::get($authrec, "addr1", "");
												$addr2 = \Arr::get($authrec, "addr2", "");
												$sex = \Arr::get($authrec, "sex", "");
												$birthy = \Arr::get($authrec, "birthy", "");
												$birthm = \Arr::get($authrec, "birthm", "");
												$birthd = \Arr::get($authrec, "birthd", "");
												
													
												$i=$i+1;
												?>
												<!--変更箇所　ここから-->
												<form name="memprofile" method="post" action="memprofile">	
													<td><input type="submit" name="id" value="<?php echo $row['id'];?>" class="box"></td>
													
												</form>	
												
												
												<form name="member_status" method="post" action="member_status">	
												<td>
													<?php $d = 0;
													Auth::get_all($d);
												
													Auth::get_by_id($row['id']);
													Session::set('id', $row['id']);
													$authstatus = \Session::get('authmember_status');

												
							
													if($authstatus === '0'){
													
													?><input type="submit" name="member_status" value="登録">
													<input type="hidden" name ="memstat" value="<?php echo $row['id'];?>">
													
												
													<?php }else{?>
													<span>会員</span>
														
													<?php }
													
													?>
													<?php $d = $d+1; ?>
												</td>
												</form>

												<td class="txt"><?php echo $name;?></td>
	
												
												<td class="txt"><?php echo $kana ?></td>
												
												<td class="txt"><?php echo $row['email']?></td>
											
												<td class="txt"><?php echo $birthy ?>年<?php echo $birthm ?>月<?php echo $birthd ?>日</td>
													
												
												<td class="txt"><?php echo $sex ?></td>
													

												<td class="txt">〒<?php echo $post_no ?><br><?php echo $pref ?><?php echo $addr1 ?><br><?php echo $addr2 ?></td>
													
												
												<td class="txt"><?php echo $tel ?></td>
													
												
													
												<?php
													$reg_date = $row['created_at'];
													$reg_date = Date::forge($reg_date)->format("%Y年%m月%d日 %H:%M");
													
														Session::set('reg_date',array($j => $reg_date)); 
														$reg_date = Session::get('reg_date') ;
														$reg_date = Arr::get($reg_date,$j,'null');
												?>
												<td class="txt"><?php echo  $reg_date; Session::set('regdate',$reg_date)?></td>
														
											
											
												
											</tr>
											<?php endforeach ?>
										</tbody>
								   
									</table>
								</div>
							</div>

						</div><!--end of the first tab-->
						
						<div id="fragment-2">
							<form action="search_cusinfo" name="search_cusinfo" method="post">
								<select id="search_field" name="search_field">
									<option>顧客名</option>
									<option>顧客ID</option>
									<!--<option>登録日</option>
									<option>予約あり</option>-->
								</select>
							
								<?php echo Form::input('search',Input::post('search'), array('required' => 'required' ,'size'=>'20', 'class' => 'textinput'))//, $name ?>
								<input type="submit" name="btnsearch" value="絞り込む">
							</form>
							<p>&nbsp;</p>
							
						
						</div><!--end of the 2nd tab-->
						
						
						<div id="fragment-4"> <!--新規登録タッブ -->
							<table width="100%">
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="2" style="font-size: 18px;"　>
										<strong>お客様新規会員登録</strong><hr />
									</td>
									
								</tr>	
								
								<tr><td>&nbsp;</td></tr>
								
							</table> 
								<form name="admin_add" action="addnewmem_confirm" method="post">
								<div class="box-type1 ns">
								  <table width="100%" border="0" class="type1">		  
			    <tr>
			      <th width="150"><span class="attention">＊</span>メールアドレス</th>
			      <td><br />
			        &nbsp;&nbsp;&nbsp;&nbsp
					<?php echo Form::input('cus_mail', Input::post('cus_mail'), array('required' => 'required','size'=>'50','placeholder'=>'（例）bluegarden2014@aroma.jp', 'class' => 'textinput'),array('min_length' => array(3))) ?>
			                <p class="caption"></p>
			        <p class="attention"></p>
			      </td>
			    </tr>
				
			    <tr>
			      <th width="150"><span class="attention">＊</span>お名前</th>
			      <td><br />
			        &nbsp;&nbsp;&nbsp;&nbsp
					<?php echo Form::input('cus_name', Input::post('cus_name'), array('required' => 'required','placeholder'=>'（例）あろま太郎','size'=>'50', 'class' => 'textinput')) ?>
							<p class="caption"></p>
			        <p class="attention"></p>
			      </td>
			    </tr>
			    <tr>
			      <th width="150">フリガナ</th>
			      <td><br />
			        &nbsp;&nbsp;&nbsp;&nbsp
					<?php echo Form::input('cus_kana', Input::post('cus_kana'), array('size'=>'50','placeholder'=>'（例）アロマタロウ', 'class' => 'textinput'),array('min_length' => '128')) ?>
			                <p class="caption"></p>
			        <p class="attention"></p>
			      </td>
			    </tr>

			    <tr>
			      <th width="150">電話番号</th>
			      <td><br />
			        &nbsp;&nbsp;&nbsp;&nbsp
					<?php echo Form::input('cus_tel', Input::post('cus_tel'), array('size'=>'20','placeholder'=>'（例）0453678849', 'class' => 'textinput') ) ?>
			                <span class="attention" style="font-size:12px"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;※- （ハイフン）なしで記入 11桁以内</span>
			        <p class="attention"></p>
			      </td>
			    </tr>
			    <tr>
			      <th width="150">郵便番号</th>
			      <td><br />
			        &nbsp;&nbsp;&nbsp;&nbsp
					<?php echo Form::input('cus_zip', Input::post('cus_zip'), array('size'=>'20','placeholder'=>'（例）2330013', 'class' => 'textinput'),array('min_length' => '7')) ?>
			                <span class="attention" style="font-size:12px"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;※- （ハイフン）なしで記入 7桁</span>
			        <p class="attention"></p>
			      </td>
			    </tr>
			    <tr>
			      <th width="150">住所</th>
			      <td><p class="caption"></p>&nbsp;&nbsp;&nbsp;
			        <select name="cus_pref" id="bt_form_cus_pref"><option value="">▼都道府県を選択</option><optgroup label="---北海道---"><option value="北海道" >北海道</option></optgroup><optgroup label="---東北地区---"><option value="青森県" >青森県</option><option value="岩手県" >岩手県</option><option value="宮城県" >宮城県</option><option value="秋田県" >秋田県</option><option value="山形県" >山形県</option><option value="福島県" >福島県</option></optgroup><optgroup label="---関東信越地区---"><option value="茨城県" >茨城県</option><option value="栃木県" >栃木県</option><option value="群馬県" >群馬県</option><option value="埼玉県" >埼玉県</option><option value="千葉県" >千葉県</option><option value="東京都" >東京都</option><option value="神奈川県" >神奈川県</option><option value="山梨県" >山梨県</option><option value="長野県" >長野県</option><option value="新潟県" >新潟県</option></optgroup><optgroup label="---中部地区---"><option value="静岡県" >静岡県</option><option value="愛知県" >愛知県</option><option value="岐阜県" >岐阜県</option><option value="三重県" >三重県</option></optgroup><optgroup label="---北陸地区---"><option value="富山県" >富山県</option><option value="石川県" >石川県</option><option value="福井県" >福井県</option></optgroup><optgroup label="---近畿地区---"><option value="滋賀県" >滋賀県</option><option value="京都府" >京都府</option><option value="大阪府" >大阪府</option><option value="兵庫県" >兵庫県</option><option value="奈良県" >奈良県</option><option value="和歌山県" >和歌山県</option></optgroup><optgroup label="---中国地区---"><option value="鳥取県" >鳥取県</option><option value="島根県" >島根県</option><option value="岡山県" >岡山県</option><option value="広島県" >広島県</option><option value="山口県" >山口県</option></optgroup><optgroup label="---四国地区---"><option value="徳島県" >徳島県</option><option value="香川県" >香川県</option><option value="愛媛県" >愛媛県</option><option value="高知県" >高知県</option></optgroup><optgroup label="---九州地区---"><option value="福岡県" >福岡県</option><option value="佐賀県" >佐賀県</option><option value="長崎県" >長崎県</option><option value="熊本県" >熊本県</option><option value="大分県" >大分県</option><option value="宮崎県" >宮崎県</option><option value="鹿児島県" >鹿児島県</option></optgroup><optgroup label="---沖縄---"><option value="沖縄県" >沖縄県</option></optgroup><optgroup label="---その他---"><option value="海外" >海外</option></optgroup></select>
				<span class="attention" style="font-size:12px">▼都道府県を選択</span><p></p>
			        &nbsp;&nbsp;&nbsp;
					<?php echo Form::input('cus_addr1', Input::post('cus_addr1'),array('size'=>'50','placeholder'=>'（例）横浜市港南区丸山台１－２－１', 'class' => 'textinput')) ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="attention" style="font-size:12px">※市区町村・番地</span>
					<p class="attention"></p>
			
			        &nbsp;&nbsp;&nbsp;
					<?php echo Form::input('cus_addr2', Input::post('cus_addr2'),array('size'=>'50', 'placeholder'=>'（例）京急シティ上永谷Ｌウィング','class' => 'textinput')) ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="attention" style="font-size:12px">※建物名など</span>
					<p class="attention"></p>
			      </td>
			    </tr>
			    <tr>
									  <th width="150">性別</th>
									  <td>
										<input id="bt_form_cus_sex1" type="radio" value="男" name="cus_sex" ><label for="bt_form_cus_sex1">男性</label>
										<input id="bt_form_cus_sex2" type="radio" value="女" name="cus_sex" ><label for="bt_form_cus_sex2">女性</label><br>
								
												<p class="caption"></p>
										<p class="attention"></p>
									  </td>
									</tr>
			    <tr>
			      <th width="150"><span class="attention">＊</span>生年月日</th>
			      <td><br />
			        &nbsp;&nbsp;&nbsp;&nbsp
			        
					
<!-- WORKING HERE-->
					<select class="year" name="cus_birthy">
					</select>年
					<select class="month" name="cus_birthm">
						<option value="1" selected>1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>月
					<select class="day" name="cus_birthd">
						<option value="1" selected>1</option>
						<option value="2">2</option>
					</select>日

					<script language="javascript">
					for (var i = 1900; i < 2012; i++) {
						$('<option>').attr('value', i).text(i).appendTo('.year');
					}

					function monthChanged() {
						var days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
						var month = $('.month').val() - 1,
							year = +$('.year').val();

						// Check for leap year if Feb
						if (month == 1 && new Date(year, month, 29).getMonth() == 1) days[1]++;

						// Add/Remove options
						if ($('.day option').length > days[month] + 1) {
							// Remove
							$('.day option').slice(days[month] + 1).remove();
						} else if ($('.day option').length < days[month] + 1) {
							// Add
							for (var i = $('.day option').length; i <= days[month]; i++) {
								$('<option>').attr('value', i).text(i).appendTo('.day');
							}
						}
					}

					$(function () {
						monthChanged(); // On document ready
						$('.month').change(monthChanged); // On month change
						$('.year').change(monthChanged); // On year change (for leap years)
					});
					</script>

					<!--select id=cus_birthm name=cus_birthm onchange=sample(this);><option value=""></option><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option><option value="11" >11</option><option value="12" >12</option></select>月 -->
					<!--select id="bt_form_cus_birthd" name="cus_birthd"><option value=""></option><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option><option value="11" >11</option><option value="12" >12</option><option value="13" >13</option><option value="14" >14</option><option value="15" >15</option><option value="16" >16</option><option value="17" >17</option><option value="18" >18</option><option value="19" >19</option><option value="20" >20</option><option value="21" >21</option><option value="22" >22</option><option value="23" >23</option><option value="24" >24</option><option value="25" >25</option><option value="26" >26</option><option value="27" >27</option><option value="28" >28</option><option value="29" >29</option><option value="30" >30</option><option value="31" >31</option></select>日--> 
			                <p class="caption"></p>
			        <p class="attention"></p>
			      </td>
			    </tr>
				
			
			
				<tr>	
					<td align="center" colspan="2">
					<input name="submit" type="submit" value="確認" onClick="return AllCheck();">
					<input name="reset" type="reset" value="リセット" ></td>
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