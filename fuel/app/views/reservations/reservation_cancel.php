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

    <!-- left column -->    <div id="bluegarden_content">
    	
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
				  <form name="reservecancel_form" action="cancelfinished" method="post">	
				<table width="100%" border="0"  class="columntitle">
					<tr><td>キャンセル確認</td></tr><!--Column Title Table -->
				</table>
				<p ><h3 style="text-align:left">ご予約内容をご確認の上［キャンセルを確定する］ボタンを押してください。</h3></p>
				<?php $i = 1;?>
				<!-- ご予約内容確認 Table-->
				<table width="90%" style="margin-top:20px;margin-bottom:20px;">
					<tr><td class="ptablespacer" colspan="2"><h3><p>ご予約内容確認</p></h3></td></tr>
					<?php foreach($rows as $row): ?>
					<tr>
						<td class="ptablespacer" width="30%"><h3><p>予約番号</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $res; ?></h3>
						</td>
						<?php Session::set('resno',$res);?>
					</tr>
					<tr>
						<td class="ptablespacer" width="30%"><h3><p>店舗名</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $row['branch_name']; ?></h3>
						</td>
						</td>
						<?php Session::set('branch_id',$row['branch_id']);?>
					</tr>
					<tr>
						<td class="ptablespacer" width="30%"><h3><p>スタッフ</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $row['staff_name']; ?></h3>
						</td>
						
					</tr>
					<tr>
						<td class="ptablespacer"><h3><p>コース（メニュー）</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $row['svc_name_1']; Session::set('$course1',$row['svc_name_1']); ?><br>
						<h3><?php echo $row['svc_name_2']; Session::set('$course2',$row['svc_name_2']);?></h3>
						</td>
					</tr>
					<tr>
						<td class="ptablespacer"><h3><p>オプション</p></h3></td>
						<td class="ptablespacer"><h3><?php echo $row['opt_name']; 
						//Session::set('$option',$row['opt_name']); 
						echo Form::input('option', Input::post('option', $row['opt_name']),array('type'=>'hidden'));
						?></h3></td>
					</tr>
					<tr>
						<td class="ptablespacer" ><h3><p>ご予約日</p></h3></td>
						<?php $showweekday = \Model\Calendar::display_dayofweek($row['res_date']);?>
						<td class="ptablespacer" ><h3><?php echo date('m/d',strtotime($row['res_date'])); ?><?php echo " (".$showweekday.")"; ?></h3></td>
					</tr>
					<tr>
						<td class="ptablespacer" ><h3><p>時間</p></h3></td>
						<td class="ptablespacer" ><h3><?php echo date('H:i',strtotime($row['res_time'])); ?></h3></td>
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
					<tr><td class="ptablespacer" colspan="2"><h3><p>キャンセル理由</p></h3></td></tr>
					<tr>
						<td class="ptablespacer">
							
							<?php echo Form::radio('cancel', '体調不良', Input::post('cancel') === '体調不良' ? array('checked' => 'checked', 'id' => 'form_cancel_1') : array('id' => 'form_cancel_1'));	echo Form::label('体調不良', 'cancel_1'); ?>
							<?php echo Form::radio('cancel', '都合が悪くなった', Input::post('cancel') === '都合が悪くなった' ? array('checked' => 'checked', 'id' => 'form_cancel_2') : array('id' => 'form_cancel_2'));	echo Form::label('都合が悪くなった', 'cancel_2'); ?>
							<?php echo Form::radio('cancel', 'その他', Input::post('cancel') === 'その他' ? array('checked' => 'checked', 'id' => 'form_cancel_3') : array('id' => 'form_cancel_3'));	echo Form::label('その他', 'cancel_3'); ?>
							<!--form name="reservecancel_form" action="cancelfinished" method="post"-->	
							<!--textarea rows="10" cols="70" name="freemessage" maxlength="300"></textarea-->
							
						
						</td>
					</tr>
					<tr>
						<td class="ptablespacer">
							<center>
								
									<input action="action" type="button" value="戻る" onclick="history.go(-1);" />
									<input type="submit" value="キャンセルを確定する">
								</form>
							</center>
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