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
	    <li><a href="http://aromasalon-bluegarden.jp/" >Blue Gardenのホームページ</a></li>
           
                     
       </ul> 
    </div> <!-- end of menu -->

    <!-- left column -->
    <div id="bluegarden_content">
    	
<div id = "bluegarden_left">
		
 			<div class="left_col_section">	
				<p class="columntitle" style="text-align:center;">My Page</p>
				<div class="left_inside">

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
				
				</div>
			</div>
			<div class="left_col_section">
					<a href="reserve"><?php echo Asset::img('reservebtn.gif',array('width' => '245'));?></a>
			</div>

	
	
       		
    	</div>


        <!-- end of left -->
    	<p>&nbsp;</p>
    	
  
        <div id="bluegarden_right">
        
	
        	<div class="right_col_section">
		          <center>
				<table width="100%" border="0"  class="columntitle">
					<tr><td>最終内容確認</td></tr><!--Column Title Table -->
				</table>
				<p ><h3 style="text-align:left">ご予約内容に間違いがなければ［予約を確定］ボタンを押してください。</h3></p>
				
				<!-- ご予約内容確認 Table-->
				<table width="90%" style="margin-top:20px;margin-bottom:20px;">
					<tr><td class="ptablespacer" colspan="2"><h3><p>ご予約内容確認</p></h3></td></tr>
					<tr>
						<td class="ptablespacer" width="30%"><h3><p>店舗名</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $getbranch_name; Session::set('getbranch_name',$getbranch_name); ?>
						<?php $getbranch_id; Session::set('getbranch_id',$getbranch_id); ?></h3>
						</td>
						
					</tr>
					<?php if($getbranch_id=="1"){ ?>
					<tr>
						<td class="ptablespacer" width="30%"><h3><p>スタッフ</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $staff; Session::set('staff',$staff); ?></h3>
						</td>
						
					</tr>
					<?php } else { Session::set('staff',$staff); } ?>
					<?php if(($course1=="なし") && ($course2=="なし")){?>
					<tr>
						<td class="ptablespacer"><h3><p>コース（メニュー）</p></h3></td>
						<td class="ptablespacer">
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
						<td class="ptablespacer"><h3><p>コース（メニュー）</p></h3></td>
						<td class="ptablespacer">
						<h3>
						<?php if(($course1=="なし") && ($course2!="なし")){
							echo $course2; Session::set('course2',$course2); Session::set('course1',"なし"); $course2_minsel; Session::set('course1_minsel',0); Session::set('course2_minsel',$course2_minsel);
						}elseif(($course2=="なし") && ($course1!="なし")){
							echo $course1; Session::set('course1',$course1); Session::set('course2',"なし");$course1_minsel; Session::set('course1_minsel',$course1_minsel); Session::set('course2_minsel',0);
						}else{
							echo $course1; Session::set('course1',$course1); $course1_minsel; Session::set('course1_minsel',$course1_minsel);
							print "<br>&nbsp;&nbsp;&nbsp;&nbsp;";
							echo $course2; Session::set('course2',$course2); $course2_minsel; Session::set('course2_minsel',$course2_minsel);
						}?>					
						</h3></td>
					</tr>					
					<?php } ?>
					<?php if($option!=""){?>
					<tr>
						<td class="ptablespacer"><h3><p>オプション</p></h3></td>
						<td class="ptablespacer"><h3>
						<?php echo $option; Session::set('option',$option); ?>
						</h3></td>
					</tr>
					<?php } else{?>
					<?php Session::set('option',"");}?>
					<tr>
						<td class="ptablespacer" ><h3><p>ご予約日</p></h3></td>
						<td class="ptablespacer" ><h3><?php echo $resdate; echo " (".$weekday.")"; Session::set('resdate',$resdate); ?></h3></td>
					</tr>
					<tr>
						<td class="ptablespacer" ><h3><p>時間</p></h3></td>
						<td class="ptablespacer" ><h3><?php echo $restime; Session::set('restime',$restime); ?> ～</h3></td>
					</tr>
					<tr>
						<td class="ptablespacer" ><h3><p>合計金額</p></h3></td>
						<td class="ptablespacer" ><h3><?php echo number_format($totalamount); Session::set('totalamount',$totalamount); ?> 円 (税込)</h3></td>
					</tr>
										<tr>
						<td class="ptablespacer" ><h3><p>予約番号</p></h3></td>
						<td class="ptablespacer" ><h3><?php echo $resno; Session::set('resno',$resno); ?></h3></td>					
					</tr>
					<tr></tr>

				</table>
				<!-- End of ご予約内容確認 Table-->
				
				<!-- フリーメッセージ Table-->
				<table width="90%" style="margin-top:20px;margin-bottom:20px;">
					<tr><td class="ptablespacer" colspan="2"><h3><p>予約についてのご要望などメッセージがございましたらご記入ください</p></h3></td></tr>
					<tr>
						<td class="ptablespacer">
							<form action="reservefinished" method="post">
								<textarea rows="10" cols="70" name="freemessage" maxlength="300"></textarea>
							<p></p>	
							<tr>
								<td class="ptablespacer">
									<center>
										<input action="action" type="button" value="前の画面にもどる" onclick="history.go(-1);" />
										<input type="submit" value="予約を確定する">							
									</center>
								</td>
							</tr>							
							</form>						
						</td>
					</tr>
				</table>
	          
	  	</div>
		</center><p>&nbsp;</p>
          <div class="cleaner"><p>&nbsp;</p></div> 
                    
        
        </div> <!-- end of right -->
    </div> <!-- end of content -->
    
   <div id="bluegarden_footer">
           <a href="index" class="current">トップ</a>|
           <a href="mypage" >Myページ</a>|
           <a href="privacy">プライバシー規約</a>|
	   <a href="http://aromasalon-bluegarden.jp/" >Blue Gardenのホームページ</a>
          
           <br />
   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
   </div> 
    <!-- end of footer -->

</div> <!-- end of container -->



</body>
</html>