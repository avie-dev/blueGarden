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
			<div class="topaddin">

			</div>	
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
					<p><span class="attention"><?php echo Auth::get_profile_fields('name'); ?> 様</span></p><br /> <!-- ここも弄る？-->
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
					</div>
				
				</div>
			</div>
			
			<div class="left_col_section">	
			
				<table  width="100%"><tr class="columntitle_button"><td align="center"><a href="logout">ログアウト</a></td></tr></table>
			</div>

			<div class="left_col_section">				
				<a href="reserve">
				<?php
					echo Asset::img('reservebtn.gif',array('width' => '245'));
					//<img src="images/reservebtn.gif" width="245" >
				?>
				</a>
			</div>
		
	
	
       		
    	 </div>


        <!-- end of left -->
    	<p>&nbsp;</p>
    	
  
        <div id="bluegarden_right">
        
	
        	<div class="right_col_section">
		          <center>
				<table width="100%" border="0"  class="columntitle">
					<tr><td>ご予約内容詳細確認</td></tr><!--Column Title Table -->
				</table>
				<font color="red"><b>※予約のキャンセルは２日前までになります。</b></font><br>
				<!-- ご予約内容確認 Table-->
				<table width="90%" style="margin-top:20px;margin-bottom:20px;">
					<tr><td class="ptablespacer" colspan="2"><h3><p>ご予約内容確認</p></h3></td></tr>
					<?php foreach($rows as $row): ?>
					<tr>
						<td class="ptablespacer" width="30%"><h3><p>予約番号</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $res; ?></h3>
						</td>
						
					</tr>
					<tr>
						<td class="ptablespacer" width="30%"><h3><p>店舗名</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $row['branch_name']; ?></h3>
						</td>
						
					</tr>
					<tr>
						<td class="ptablespacer" width="30%"><h3><p>スタッフ</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $row['staff_name']; ?></h3>
						</td>
						
					</tr>
					<tr>
						<td class="ptablespacer"><h3><p>コース（メニュー）</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $row['svc_name_1']; ?><br>
						<h3><?php echo $row['svc_name_2']; ?><br>
						</td>
					</tr>
					<tr>
						<td class="ptablespacer"><h3><p>オプション</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $row['opt_name']; ?></h3></td>
					</tr>
					<tr>
						<td class="ptablespacer" ><h3><p>ご予約日</p></h3></td>
						<?php $showweekday = \Model\Calendar::display_dayofweek($row['res_date']);?>
						<td class="ptablespacer" ><h3><?php echo date('m/d',strtotime($row['res_date'])); ?><?php echo " (".$showweekday.")"; ?></h3></td>
						<?php Session::set('checkday',$row['res_date']);?>
					</tr>
					<tr>
						<td class="ptablespacer" ><h3><p>時間</p></h3></td>
						<td class="ptablespacer" ><h3><?php echo date('H:i',strtotime($row['res_time'])); ?>~</h3></td>
					</tr>
					<tr></tr>
					<tr>
						<td class="ptablespacer" ><h3><p>合計金額</p></h3></td>
						<td class="ptablespacer" ><h3><?php echo number_format($row['res_tot_amt']); ?> 円 (税込)</h3></td>
					</tr>
					<tr></tr>
					<?php endforeach; ?>
				</table>
				<!-- End of ご予約内容確認 Table-->
				
			
				<!-- フリーメッセージ Table-->
				<table width="90%" style="margin-top:20px;margin-bottom:20px;">
			
						<!--td class="ptablespacer"-->
							<center>
								
									<p align="right"><a href="mypage">My Pageトップへ</a></p>
									
									<p><input action="action" type="button" value="戻る" onclick="history.go(-1);" /></p>	
									
									
									<?php
									$day = Session::get('checkday');			//予約日付
									$today = date('Y-m-d');				//今日（ログイン日付）
									
									$cancelday = date('Y-m-d',strtotime("-2 day" ,strtotime($day)));		//予約日付の２日前
									?>
									
									<?php if($today >= $cancelday ){	?>
										<p><input type="button" name="cancel" value="キャンセル" onclick="alert('こちらの予約の編集とキャンセルは電話で承ります。')"></p>
										
									
									<?php }else{ ?>
											
											<form id="reserve_cancel" method="post" action="reservationcancel">
											<?php echo Form::hidden('res',Input::post('res',$res),array('type'=>'hidden','size'=>'20')); ?>
											<p><input type="submit" name="cancel" value="キャンセル" class=""></p>
											</form>

									<?php } ?>
									
									<table border="0">
									<?php $nothing = Session::get('cancelnot'); ?>
									<tr><td><?php echo $nothing; ?></td></tr>
									</table>
								<!--/form-->
							</center>
						<!--/td-->
					
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