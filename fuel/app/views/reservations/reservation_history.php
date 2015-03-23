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
					<?php $username = Session::get('username'); ?>
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
						         <li><a href='reservationhistory'><span>予約の履歴</span></a></li>
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
					

		<table width="100%" border="1"  class="columntitle">
			<tr><td>お客様のご予約履歴</td></tr>
		</table>
		<p>&nbsp;</p>
		<table width="97%" border="1" style="padding-left:-15px;font-size:10px;">
			
				<font color="black">
				<th style="background-color:6CA6CD;"><h3><p><font color="black"><p><center>日時</center></font></p></h3></td>
				<th style="background-color:6CA6CD;"><h3><p><font color="black"><center>店舗名</center></font></p></h3></td>
				<th style="background-color:6CA6CD;"><h3><p><font color="black"><center>スタッフ名</center></font></p></h3></td>
				<th style="background-color:6CA6CD;"><h3><p><font color="black"><center>コース<center></font></p></h3></td>
				<th style="background-color:6CA6CD;"><h3><p><font color="black"><center>オプション<center></font></p></h3></td>
				</font>
				
			<?php $i = 1;?>
			<tr>
			
			<?php 
			$result = DB::select()->from('tblreserve')->where_open()
				->where('email', Auth::get_email())
				->and_where('del_flag', 0)
				->where_close()
				->execute(); 

			?>

			
			<?php foreach($result as $hrow): ?>
				
				
				
				
				<?php	$hrow['res_date'];  
					Session::set('date',array($i => $hrow['res_date'])); 
					$resdate = Session::get('date') ;
					$res_date = Arr::get($resdate,$i,'null'); 
				?>
				<?php	$hrow['res_time'];  
					Session::set('time',array($i => $hrow['res_time'])); 
					$restime = Session::get('time') ;
					$res_time = Arr::get($restime,$i,'null'); 
				?>
				<td class=""><br><p style="margin-left:-10px;font-size:14px">
				<?php $showweekday = \Model\Calendar::display_dayofweek($res_date);?>
				<?php print date('m/d',strtotime($res_date)); ?><?php echo " (".$showweekday.")"; ?></p>
				<p style="margin-left:-10px;font-size:16px">&nbsp;&nbsp;<?php print date('H:i',strtotime($res_time)); ?>~</p></td>
				<?php	$hrow['branch_name'];  
					Session::set('branch_name',array($i => $hrow['branch_name'])); 
					$branch_name = Session::get('branch_name') ;
					$branch_name = Arr::get($branch_name,$i,'null'); 
				?>
				<td class=""><p style="margin-left:-10px;font-size:16px">
				<?php print $branch_name; ?><br></p></td>
				<?php	$hrow['staff_name'];  
					Session::set('name',array($i => $hrow['staff_name'])); 
					$staffname = Session::get('name') ;
					$staff_name = Arr::get($staffname,$i,'null'); 
				?>
				<td class=""><p style="margin-left:-10px;font-size:16px"><?php print $staff_name; ?></p></td>
				<?php	$hrow['svc_name_1'];  
					Session::set('svcname1',array($i => $hrow['svc_name_1'])); 
					$svcname_1 = Session::get('svcname1') ;
					$svc_name_1 = Arr::get($svcname_1,$i,'null'); 
					
					$hrow['svc_name_2'];  
					Session::set('svcname2',array($i => $hrow['svc_name_2'])); 
					$svcname_2 = Session::get('svcname2') ;
					$svc_name_2 = Arr::get($svcname_2,$i,'null');

				?>
				<td class=""><p style="margin-left:-10px;font-size:16px;margin-top:16px;"><?php print $svc_name_1; ?><br>&nbsp;&nbsp;&nbsp;
				<?php print $svc_name_2; ?><br></p></td>
				<?php	$hrow['opt_name'];  
					Session::set('optname',array($i => $hrow['opt_name'])); 
					$optname = Session::get('optname') ;
					$opt_name = Arr::get($optname,$i,'null'); 
				?>
				<td class=""><p style="margin-left:-10px;font-size:16px"><?php print $opt_name; ?></p></td>
				
				
			
			
			</tr>
			
		<?php endforeach; ?> 
		
		</table> 
			<p>&nbsp;</p>
		
		<center>
			<table border="0">
			<?php $nothing = Session::get('nothing'); ?>
			<tr><td><?php echo $nothing; ?></td></tr>
			</table>
		</center>
		
		 <p>&nbsp;</p>
	  </div>
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