<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="http://666522dacac20340.lolipop.jp/bluegarden/blueGarden/assets/img/candle.ico">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8;IE=EmulateIE9" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blue Garden -アロマサロン予約システム</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="keywords" content="blue garden" />
<meta name="description" content="Blue Garden アロマサロン" />

<?php echo Asset::css('bluegarden_style.css');?>
<?php echo Asset::js('jquery.min.js');?>
<?php echo Asset::js('menu_jquery.js');?>
<?php echo Asset::js('check.js');?>

</head>
<body>
<body class="MyGradientClass" onLoad="document.form2.cus_mail.focus()">
	<div id="bluegarden_container">
		<div id="bluegarden_header">
	    		<div class="topaddin"> </div>

	 	</div> <!-- end of header -->
	<div id="bluegarden_menu">
		<ul>
			<li><a href="index" class="current">トップ</a></li>
			<li><a href="mypage" >Myページ</a></li>
			<li><a href="privacy">プライバシー規約</a></li>
			<li><a href="http://localhost:1337/blueGarden/index.html" >Blue Gardenのホームページ</a></li>
		</ul>  
	</div> <!-- end of menu -->

	<div id="bluegarden_content">
	    <!-- left column -->

		<div id = "bluegarden_left">
		
 			<div class="left_col_section">	
				<p class="columntitle" style="text-align:center;">My Page</p>
				<div class="left_inside">

					<?php if(Auth::get_profile_fields('name')!=""){?>
					<p>&nbsp;</p>
					<p><span class="attention"><?php echo Auth::get_profile_fields('name'); ?> 様</span></p><br />
					<p>いつもご利用ありがとうございます。</p>
					<p>&nbsp;</p>
					<div id='cssmenu'>
						<ul>
						   <li class='has-sub'><a href='#'><span>会員情報</span></a>
						      <ul>
						         <li><a href='member_profile_change'><span>登録情報の変更</span></a></li>
								 <li><a href='changepassword'><span>パスワードの変更</span></a></li>
						         <li class='last'><a href='quitmembershipnot'><span>退会申請</span></a></li>
						      </ul>
						   </li>
						   <li class='has-sub last'><a href='#'><span>予約状況</span></a>
						      <ul>
						         <li><a href='checkreservation'><span>予約の確認</span></a></li>
						         <li class='last'><a href='reservationhistory'><span>予約の履歴</span></a></li>
						      </ul>
						   </li>
						</ul>
						<br>
						<ul>
						         <li><a href='staff'><span>スタッフ一覧</span></a></li>
						</ul>
						<ul>
						         <li><a href='course'><span>メニュー/コース一覧</span></a></li>
						</ul>
					</div>
					<?php }else{?>
					<p>&nbsp;</p>
					<p><span class="attention">ゲスト 様</span></p><br />
					<p>こんにちは！</p>
					<p>&nbsp;</p>
					<div id='cssmenu'>
						<ul>
						         <li><a href='staff'><span>スタッフ一覧</span></a></li>
						</ul>
						<ul>
						         <li><a href='course'><span>メニュー/コース一覧</span></a></li>
						</ul>
					</div>
					<?php } ?>
				
				</div>
			</div>
			<?php if(Auth::get_profile_fields('name')!=""){?>
			<div class="left_col_section">	
				<table  width="100%"><tr class="columntitle_button"><td align="center"><a href="logout">ログアウト</a></td></tr></table>
			</div>			
			<?php }else{?>	
			<div class="left_col_section">
					<a href="reserve"><?php echo Asset::img('reservebtn.gif',array('width' => '245'));?></a>
			</div>
			<?php }?>
	
	
       		
    	</div>	

	        <!-- end of left -->
	    	<p>&nbsp;</p>
	    	
	  
	        <div id="bluegarden_right">
	        
	          <div class="right_col_section">
	           	<table  width="100%"><tr class="columntitle"><td>新規登録</td></tr></table>
			<p>&nbsp;</p>

			
<?php $err = Session::get('err'); 
if ($err == true){?>
<div class="alert"> <?php echo "メールアドレスは既に登録されています"; ?></div>
<?php	}	?>


<?php if (isset($errors)): ?>
<ul>
<?php foreach ($errors as $error): ?>
<li><?php echo $error ?></li>
<?php endforeach ?>
</ul>
<?php endif ?>
<?php echo Form::open() ?>
<?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()) ?>



			
	    		<p><span class="attention">「＊」は入力必須項目です</span></p>
	  
	  <!-- ?php echo $reg; ? -->

	  		<form action="signup" method="post" name="form2">
	    
	       		 <h4></h4>

	   			 <div class="box-type1 ns">
	     			 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="type1">
	       
	            <p class="attention"></p>
	                  </td>
	        
	      </table>
	    </div>    
		
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
			      <th width="150"><span class="attention">＊</span>性別</th>
			      <td><br />
			    &nbsp;&nbsp;&nbsp;
				<?php foreach ($radio_list as $key => $val): ?>
				<?php echo Form::radio('cus_sex', $key, Input::post('cus_sex') == $key) ?>
				<?php echo Form::label($val, 'cus_sex', array('class' => 'labelradio')) ?>
				<?php endforeach ?>
				<br>
			
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
		          <th><span class="attention">＊</span>パスワード</th>
		            <td>
					<?php echo Form::input('loginpw', Input::post('loginpw'), array('type'=>'password','required' => 'required', 'class' => 'password')) ?>
		              <!--<input type="password" id="bt_form_loginpw" name="loginpw"  size="50" value="" style="ime-mode:disabled">
							-->
		              <span class="attention" style="font-size:12px"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;※半角英数字 4～20文字で入力してください</span>
		              <p class="attention"></p>&nbsp;&nbsp;&nbsp;
		             
		            </td>
		        </tr>
				<tr>
		          <th>パスワード再入力</th>
		            <td>
					<?php echo Form::input('loginpw_chk', Input::post('loginpw_chk'), array('type'=>'password','required' => 'required', 'class' => 'password')) ?>
		              <!--<input type="password" id="bt_form_loginpw_chk" name="loginpw_chk"  size="50" value="" style="ime-mode:disabled">
						-->
		              <span class="attention" style="font-size:12px"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;※確認のためにもう一度パスワードを入力してください</span>
		              <p class="attention"></p>
		            </td>
		        </tr>
			
			
				<tr>	
					<td align="center" colspan="2">
					<input name="submit" type="submit" value="確認" onClick="return AllCheck();">
					<input name="reset" type="reset" value="リセット" ></td>
				</tr>
			  </table>
			  
			  <?php
				echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
				echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
				echo Form::input('staff', Input::post('staff', $staff),array('type'=>'hidden'));
				echo Form::input('course1', Input::post('course1', $course1),array('type'=>'hidden'));
				echo Form::input('course2', Input::post('course2', $course2),array('type'=>'hidden'));
				echo Form::input('course1_minsel', Input::post('course1_minsel', $course1_minsel),array('type'=>'hidden'));
				echo Form::input('course2_minsel', Input::post('course2_minsel', $course2_minsel),array('type'=>'hidden'));
				echo Form::input('option', Input::post('option', $option),array('type'=>'hidden'));
				echo Form::input('totalamount', Input::post('totalamount', $totalamount),array('type'=>'hidden'));
				echo Form::input('resdate', Input::post('resdate', $resdate),array('type'=>'hidden'));
				echo Form::input('restime', Input::post('restime', $restime),array('type'=>'hidden'));
				echo Form::input('weekday', Input::post('weekday', $weekday),array('type'=>'hidden'));
				echo Form::input('resno', Input::post('resno', $resno),array('type'=>'hidden'));
								
				$getbranch_name = Session::set('getbranch_name',$getbranch_name);
				$getbranch_id = Session::set('getbranch_id',$getbranch_id);
				$staff = Session::set('staff',$staff);
				$course1 = Session::set('course1',$course1);
				$course2 = Session::set('course2',$course2);
				$course1_minsel = Session::set('course1_minsel',$course1_minsel);
				$course2_minsel = Session::set('course2_minsel',$course2_minsel);
				$option = Session::set('option',$option);
				$totalamount = Session::set('totalamount',$totalamount);
				$resdate= Session::set('resdate',$resdate);
				$restime=Session::set('restime',$restime);
				$weekday = Session::set('weekday',$weekday );
				$resno=Session::set('resno',$resno);	 					
								
			  ?>
			</div>
			</form>
	                     <div class="cleaner"><p>&nbsp;</p></div> 
	                    
	        
	        </div> <!-- end of right -->
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	           <a href="index" class="current">トップ</a>|
	           <a href="mypage" >Myページ</a>|
	           <a href="privacy">プライバシー規約</a>|
		   <a href="http://localhost:1337/blueGarden/index.html" >Blue Gardenのホームページ</a>
	          
	           <br />
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer -->

	</div> <!-- end of container -->
</body>
</html>