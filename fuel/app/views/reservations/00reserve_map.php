<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="http://666522dacac20340.lolipop.jp/bluegarden/blueGarden/assets/img/candle.ico">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8;IE=EmulateIE9" />
<!--meta http-equiv="X-UA-Compatible" content="IE=edge"-->
<!--
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
-->
<title>Blue Garden -アロマサロン予約システム</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="keywords" content="blue garden" />
<meta name="description" content="Blue Garden アロマサロン" />

<?php echo Asset::css('bluegarden_style.css');?>
<?php echo Asset::js('jquery.min.js');?>
<?php echo Asset::js('menu_jquery.js');?>
	
</head>

<body class="MyGradientClass">
<div id="bluegarden_container">
		<div id="bluegarden_header">

		</div> <!-- end of header -->
    <div id="bluegarden_menu">
        <ul>
            <li><a href="index" class="current">トップ</a></li>
	  <li><a href="mypage" >Myページ</a></li>
            <li><a href="privacy">プライバシー規約</a></li>
	    <li><a href="http://localhost:1337/blueGarden/index.html" >Blue Gardenのホームページ</a></li>
           
                     
       </ul> 
    </div> <!-- end of menu -->

    <!-- left column -->
    <div id="bluegarden_content">
    	
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
				<a href="signup"><table  width="100%"><tr class="columntitle_button"><td align="center">新規登録</td></tr></table></a>
			</div>			
			<div class="left_col_section">
					<a href="reserve"><?php echo Asset::img('reservebtn.gif',array('width' => '245'));?></a>
			</div>
			<?php }?>
	
	
       		
    	</div>


        <!-- end of left -->
    	<p>&nbsp;</p>
    	
  
    <div id="bluegarden_right">
        <div class="right_col_section">
			
				<table width="100%" border="0"  class="columntitle">
					<tr><td>店舗選択</td></tr>
				</table>
				<center>	

		
						
						
			<table width="100%" border="0" class="type1">
				<tr><td class="ptablespacer">※現在、BlueGardenアロマサロンは2つの店舗がございます。<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;お好みの店舗を選択して、予約を行ってください。</td></tr>
				<tr><td class="ptablespacer">
				<ul>
				<form id="form1" method="post" action="weekone" name="agreement_form" --><!-- start of form -->
					<?php foreach ($map1 as $maps1): ?>
						<div class="test"><ol>
						<input type="submit" class="fsSubmitButton" value="<?php echo $maps1['branch_name']; ?>"><br><br>
						<?php
						 echo Form::input('br_id', Input::post('br_id', $maps1['id']),array('type'=>'hidden'));
						 echo Form::input('br_name', Input::post('br_name', $maps1['branch_name']),array('type'=>'hidden'));
						 //Session::set('br_name',$maps1['branch_name']); ?>
						<iframe width="500px" height="300" src="<?php echo $maps1['map']; ?>"></iframe>
						</ol><br></div>
					<?php endforeach; ?>
				</form> <!-- end of form -->
				</ul>
				<ul>
				<form id="form2" method="post" action="weekone" name="agreement_form" --><!-- start of form -->
					<?php foreach ($map2 as $maps2): ?>
						<div class="test"><ol>
						<input type="submit" class="fsSubmitButton" value="<?php echo $maps2['branch_name']; ?>"><br><br>
						<?php
						 echo Form::input('br_id', Input::post('br_id', $maps2['id']),array('type'=>'hidden'));
						 echo Form::input('br_name', Input::post('br_name', $maps2['branch_name']),array('type'=>'hidden'));
						 //Session::set('br_name',$maps2['branch_name']); ?>
						<iframe width="500px" height="300" src="<?php echo $maps2['map']; ?>"></iframe>
						</ol><br></div>
					<?php endforeach; ?>
				</form> <!-- end of form -->
				</ul>				
				</td></tr>
				<tr>
					<td colspan="2" class="ptablespacer"><br><br>
					<p><center>
					<h2><p><center>					
					<input action="action" type="button" value="前の画面にもどる" onclick="history.go(-1);" />
					</center></p>
					</h2></td>
				</tr>
				</table>
				</center>
			
          <div class="cleaner"><p>&nbsp;</p></div> 
        </div> <!-- end of right -->''
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