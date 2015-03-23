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
								店舗：<?php echo Session::get('branch');?><br><hr>役割：<?php echo Session::get('role');?><i></i>
							</td>
							<td >
							</td>
						</tr>	
					</table> 
				</div>	 <!-- ************************************************** end fix ****************************************************-->
				
				<div class="coldivider_center" style="margin-top:80px;">

				<table width="100%" border="0"  class="columntitle">
					<tr><td>ご予約日、時間を選択</td></tr>
				</table>
				<p></p>
				<center>				
				
		<!--	追加		-->
				<!--check2reservation　から　予約番号,予約日付,予約時間を取ってきてる。-->
				<?php $day = Session::get('checkday');?>
				<?php $rescheck = Session::get('rescheck');?>
				<?php $reschecktime = Session::get('reschecktime');?>
				<!--check2reservation　の予約番号があれば　表示される-->
				<?php if($day != ''){ ?>
					<font color="red"><b> ※変更前　予約　&nbsp;&nbsp;
					<?php echo date('m/d',strtotime($rescheck));?>&nbsp;
					<?php echo date('H:i',strtotime($reschecktime));?>～</b></font><br>
					<?//php Session::delete('checkday');?>
			<?php }?>
		<!--	追加		-->
		
			<table width="98%" id="datetable"><!-- Calendar Table-->
			<tr>
			<p>◎ の日時から施術を開始することが出来ます。ご希望の来店日時の ◎ を選択してください。</p>
			</tr>
				<tr>
				<th style="padding-right:5px; border-color:blue;font-size:12px;"><center>
				<?php echo Html::anchor('admin/weekthree', '前の週    '); ?>
				</center></th>
				<?php					
					// Start date
					$date = date('Y-m-d', strtotime(' +21 day'));
					// End date
					$end_date = date('Y-m-d', strtotime(' +27 day'));
				 
					while (strtotime($date) <= strtotime($end_date)) {?>
					<th style="width:50px; border-color:blue;color:blue;text-align:center;"><h6><p><center>
						<span style="padding-left:-5px">
						<?php $datelist = "$date\n";
						//echo date("m/d", strtotime($datelist))."&nbsp;&nbsp;&nbsp;&nbsp;"."<br>";?>
						<?php $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
						echo date("m/d", strtotime($date))."&nbsp;&nbsp;&nbsp;&nbsp;"."<br>";
						?></span>
						<?php $showweekday = \Model\Calendar::display_dayofweek($date);?>
						<p><?php echo "(".$showweekday.")"; ?></p>
					</center></p></h6></th>
					<?php } ?>
						<th style="border-color:blue;font-size:12px;"><center>
						<?php echo '次の週    '; ?>
						<?php //echo Html::anchor('reservations/weekthree', '次の週    '); ?>
						</center></th>
				</tr>				

				
				<?php
				$cordate = $datelist;//date('Y-m-d', strtotime(' +8 day'));
				//echo $cordate;
				//$cordate = $datelist;
				for($timecounter=1;$timecounter<13;$timecounter=$timecounter+0.5)
				{
				?>
				<tr><td>
				<?php 
				$date = new DateTime('9:00');
				$result = $date->format('H:i');
				$converted=(int)$result;
				if ($result) {
				  //echo $converted; $result is the valid time
				  $converted=$converted+$timecounter;
				  if(floor($converted) != $converted){
				    $converted2 = $converted - 0.5;
					echo $converted2; print ":30";
				  }else{
				    echo $converted; print ":00";
				  }?>
						<?php
						for($counter=1;$counter<8;$counter++)
						{
						?>
						<td class="reservebtn_small">
						<?php
							if($counter==1){
								$unformatted=strtotime(date('Y-m-d', strtotime($datelist)) . ' -5 days');
								$cordate = date('Y-m-d', $unformatted);
								if($timecounter==1){
									$cortime=date('H:i',strtotime("10:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	


										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

										?>
									</form>
									<?php
								}elseif($timecounter==1.5){
									$cortime=date('H:i',strtotime("10:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==2){
									$cortime=date('H:i',strtotime("11:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==2.5){
									$cortime=date('H:i',strtotime("11:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==3){
									$cortime=date('H:i',strtotime("12:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
										
									?>
									</form>
									<?php	
								}elseif($timecounter==3.5){
									$cortime=date('H:i',strtotime("12:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
										
									?>
									</form>
									<?php										
								}elseif($timecounter==4){
									$cortime=date('H:i',strtotime("13:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php	
									}elseif($timecounter==4.5){
									$cortime=date('H:i',strtotime("13:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php									
								}elseif($timecounter==5){
									$cortime=date('H:i',strtotime("14:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php	
								}elseif($timecounter==5.5){
									$cortime=date('H:i',strtotime("14:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php										
								}elseif($timecounter==6){
									$cortime=date('H:i',strtotime("15:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==6.5){
									$cortime=date('H:i',strtotime("15:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php									
								}elseif($timecounter==7){
									$cortime=date('H:i',strtotime("16:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==7.5){
									$cortime=date('H:i',strtotime("16:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==8){
									$cortime=date('H:i',strtotime("17:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==8.5){
									$cortime=date('H:i',strtotime("17:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==9){
									$cortime=date('H:i',strtotime("18:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==9.5){
									$cortime=date('H:i',strtotime("18:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==10){
									$cortime=date('H:i',strtotime("19:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==10.5){
									$cortime=date('H:i',strtotime("19:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php									
								}elseif($timecounter==11){
									$cortime=date('H:i',strtotime("20:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==11.5){
									$cortime=date('H:i',strtotime("20:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==12){
									$cortime=date('H:i',strtotime("21:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==12.5){
									$cortime=date('H:i',strtotime("21:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==13){
									$cortime=date('H:i',strtotime("22:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==13.5){
									$cortime=date('H:i',strtotime("22:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}				
								
							}elseif($counter==2){
								$unformatted=strtotime(date('Y-m-d', strtotime($datelist)) . ' -4 days');
								$cordate = date('Y-m-d', $unformatted);
								if($timecounter==1){
									$cortime=date('H:i',strtotime("10:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==1.5){
									$cortime=date('H:i',strtotime("10:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php									
								}elseif($timecounter==2){
									$cortime=date('H:i',strtotime("11:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==2.5){
									$cortime=date('H:i',strtotime("11:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php							
								}elseif($timecounter==3){
									$cortime=date('H:i',strtotime("12:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==3.5){
									$cortime=date('H:i',strtotime("12:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
										
									?>
									</form>
									<?php										
								}elseif($timecounter==4){
									$cortime=date('H:i',strtotime("13:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
									}elseif($timecounter==4.5){
									$cortime=date('H:i',strtotime("13:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php										
								}elseif($timecounter==5){
									$cortime=date('H:i',strtotime("14:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==5.5){
									$cortime=date('H:i',strtotime("14:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php											
								}elseif($timecounter==6){
									$cortime=date('H:i',strtotime("15:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==6.5){
									$cortime=date('H:i',strtotime("15:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==7){
									$cortime=date('H:i',strtotime("16:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==7.5){
									$cortime=date('H:i',strtotime("16:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==8){
									$cortime=date('H:i',strtotime("17:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==8.5){
									$cortime=date('H:i',strtotime("17:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==9){
									$cortime=date('H:i',strtotime("18:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==9.5){
									$cortime=date('H:i',strtotime("18:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==10){
									$cortime=date('H:i',strtotime("19:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==10.5){
									$cortime=date('H:i',strtotime("19:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==11){
									$cortime=date('H:i',strtotime("20:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==11.5){
									$cortime=date('H:i',strtotime("20:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==12){
									$cortime=date('H:i',strtotime("21:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==12.5){
									$cortime=date('H:i',strtotime("21:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==13){
									$cortime=date('H:i',strtotime("22:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==13.5){
									$cortime=date('H:i',strtotime("22:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}	
								
							}elseif($counter==3){
								$unformatted=strtotime(date('Y-m-d', strtotime($datelist)) . ' -3 days');
								$cordate = date('Y-m-d', $unformatted);
								if($timecounter==1){
									$cortime=date('H:i',strtotime("10:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==1.5){
									$cortime=date('H:i',strtotime("10:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==2){
									$cortime=date('H:i',strtotime("11:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==2.5){
									$cortime=date('H:i',strtotime("11:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php							
								}elseif($timecounter==3){
									$cortime=date('H:i',strtotime("12:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==3.5){
									$cortime=date('H:i',strtotime("12:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
										
									?>
									</form>
									<?php										
								}elseif($timecounter==4){
									$cortime=date('H:i',strtotime("13:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
									}elseif($timecounter==4.5){
									$cortime=date('H:i',strtotime("13:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php										
								}elseif($timecounter==5){
									$cortime=date('H:i',strtotime("14:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==5.5){
									$cortime=date('H:i',strtotime("14:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php											
								}elseif($timecounter==6){
									$cortime=date('H:i',strtotime("15:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==6.5){
									$cortime=date('H:i',strtotime("15:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==7){
									$cortime=date('H:i',strtotime("16:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==7.5){
									$cortime=date('H:i',strtotime("16:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==8){
									$cortime=date('H:i',strtotime("17:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==8.5){
									$cortime=date('H:i',strtotime("17:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==9){
									$cortime=date('H:i',strtotime("18:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==9.5){
									$cortime=date('H:i',strtotime("18:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==10){
									$cortime=date('H:i',strtotime("19:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==10.5){
									$cortime=date('H:i',strtotime("19:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==11){
									$cortime=date('H:i',strtotime("20:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==11.5){
									$cortime=date('H:i',strtotime("20:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==12){
									$cortime=date('H:i',strtotime("21:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==12.5){
									$cortime=date('H:i',strtotime("21:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==13){
									$cortime=date('H:i',strtotime("22:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==13.5){
									$cortime=date('H:i',strtotime("22:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}								
							}elseif($counter==4){
								$unformatted=strtotime(date('Y-m-d', strtotime($datelist)) . ' -2 days');
								$cordate = date('Y-m-d', $unformatted);
								if($timecounter==1){
									$cortime=date('H:i',strtotime("10:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==1.5){
									$cortime=date('H:i',strtotime("10:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==2){
									$cortime=date('H:i',strtotime("11:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==2.5){
									$cortime=date('H:i',strtotime("11:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php							
								}elseif($timecounter==3){
									$cortime=date('H:i',strtotime("12:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==3.5){
									$cortime=date('H:i',strtotime("12:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
										
									?>
									</form>
									<?php										
								}elseif($timecounter==4){
									$cortime=date('H:i',strtotime("13:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
									}elseif($timecounter==4.5){
									$cortime=date('H:i',strtotime("13:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php										
								}elseif($timecounter==5){
									$cortime=date('H:i',strtotime("14:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==5.5){
									$cortime=date('H:i',strtotime("14:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php											
								}elseif($timecounter==6){
									$cortime=date('H:i',strtotime("15:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==6.5){
									$cortime=date('H:i',strtotime("15:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==7){
									$cortime=date('H:i',strtotime("16:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==7.5){
									$cortime=date('H:i',strtotime("16:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==8){
									$cortime=date('H:i',strtotime("17:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==8.5){
									$cortime=date('H:i',strtotime("17:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==9){
									$cortime=date('H:i',strtotime("18:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==9.5){
									$cortime=date('H:i',strtotime("18:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==10){
									$cortime=date('H:i',strtotime("19:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==10.5){
									$cortime=date('H:i',strtotime("19:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==11){
									$cortime=date('H:i',strtotime("20:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==11.5){
									$cortime=date('H:i',strtotime("20:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==12){
									$cortime=date('H:i',strtotime("21:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==12.5){
									$cortime=date('H:i',strtotime("21:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==13){
									$cortime=date('H:i',strtotime("22:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==13.5){
									$cortime=date('H:i',strtotime("22:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}								
							}elseif($counter==5){
								$unformatted=strtotime(date('Y-m-d', strtotime($datelist)) . ' -1 days');
								$cordate = date('Y-m-d', $unformatted);
								if($timecounter==1){
									$cortime=date('H:i',strtotime("10:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==1.5){
									$cortime=date('H:i',strtotime("10:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==2){
									$cortime=date('H:i',strtotime("11:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==2.5){
									$cortime=date('H:i',strtotime("11:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php							
								}elseif($timecounter==3){
									$cortime=date('H:i',strtotime("12:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==3.5){
									$cortime=date('H:i',strtotime("12:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
										
									?>
									</form>
									<?php										
								}elseif($timecounter==4){
									$cortime=date('H:i',strtotime("13:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
									}elseif($timecounter==4.5){
									$cortime=date('H:i',strtotime("13:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php										
								}elseif($timecounter==5){
									$cortime=date('H:i',strtotime("14:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==5.5){
									$cortime=date('H:i',strtotime("14:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php											
								}elseif($timecounter==6){
									$cortime=date('H:i',strtotime("15:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==6.5){
									$cortime=date('H:i',strtotime("15:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==7){
									$cortime=date('H:i',strtotime("16:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==7.5){
									$cortime=date('H:i',strtotime("16:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==8){
									$cortime=date('H:i',strtotime("17:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==8.5){
									$cortime=date('H:i',strtotime("17:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==9){
									$cortime=date('H:i',strtotime("18:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==9.5){
									$cortime=date('H:i',strtotime("18:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==10){
									$cortime=date('H:i',strtotime("19:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==10.5){
									$cortime=date('H:i',strtotime("19:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==11){
									$cortime=date('H:i',strtotime("20:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==11.5){
									$cortime=date('H:i',strtotime("20:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==12){
									$cortime=date('H:i',strtotime("21:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==12.5){
									$cortime=date('H:i',strtotime("21:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==13){
									$cortime=date('H:i',strtotime("22:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==13.5){
									$cortime=date('H:i',strtotime("22:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}								
							}elseif($counter==6){
								$unformatted=strtotime(date('Y-m-d', strtotime($datelist)));
								$cordate = date('Y-m-d', $unformatted);
								if($timecounter==1){
									$cortime=date('H:i',strtotime("10:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==1.5){
									$cortime=date('H:i',strtotime("10:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==2){
									$cortime=date('H:i',strtotime("11:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==2.5){
									$cortime=date('H:i',strtotime("11:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php							
								}elseif($timecounter==3){
									$cortime=date('H:i',strtotime("12:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==3.5){
									$cortime=date('H:i',strtotime("12:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
										
									?>
									</form>
									<?php										
								}elseif($timecounter==4){
									$cortime=date('H:i',strtotime("13:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
									}elseif($timecounter==4.5){
									$cortime=date('H:i',strtotime("13:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php										
								}elseif($timecounter==5){
									$cortime=date('H:i',strtotime("14:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==5.5){
									$cortime=date('H:i',strtotime("14:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php											
								}elseif($timecounter==6){
									$cortime=date('H:i',strtotime("15:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==6.5){
									$cortime=date('H:i',strtotime("15:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==7){
									$cortime=date('H:i',strtotime("16:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==7.5){
									$cortime=date('H:i',strtotime("16:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==8){
									$cortime=date('H:i',strtotime("17:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==8.5){
									$cortime=date('H:i',strtotime("17:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==9){
									$cortime=date('H:i',strtotime("18:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==9.5){
									$cortime=date('H:i',strtotime("18:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==10){
									$cortime=date('H:i',strtotime("19:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==10.5){
									$cortime=date('H:i',strtotime("19:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==11){
									$cortime=date('H:i',strtotime("20:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==11.5){
									$cortime=date('H:i',strtotime("20:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==12){
									$cortime=date('H:i',strtotime("21:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==12.5){
									$cortime=date('H:i',strtotime("21:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==13){
									$cortime=date('H:i',strtotime("22:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==13.5){
									$cortime=date('H:i',strtotime("22:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}								
							}elseif($counter==7){
								$unformatted=strtotime(date('Y-m-d', strtotime($datelist)) . ' +1 days');
								$cordate = date('Y-m-d', $unformatted);
								if($timecounter==1){
									$cortime=date('H:i',strtotime("10:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==1.5){
									$cortime=date('H:i',strtotime("10:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==2){
									$cortime=date('H:i',strtotime("11:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==2.5){
									$cortime=date('H:i',strtotime("11:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php							
								}elseif($timecounter==3){
									$cortime=date('H:i',strtotime("12:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
								}elseif($timecounter==3.5){
									$cortime=date('H:i',strtotime("12:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
										
									?>
									</form>
									<?php										
								}elseif($timecounter==4){
									$cortime=date('H:i',strtotime("13:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php	
									}elseif($timecounter==4.5){
									$cortime=date('H:i',strtotime("13:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php										
								}elseif($timecounter==5){
									$cortime=date('H:i',strtotime("14:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==5.5){
									$cortime=date('H:i',strtotime("14:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}
									?>
									</form>
									<?php											
								}elseif($timecounter==6){
									$cortime=date('H:i',strtotime("15:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==6.5){
									$cortime=date('H:i',strtotime("15:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==7){
									$cortime=date('H:i',strtotime("16:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php

								}elseif($timecounter==7.5){
									$cortime=date('H:i',strtotime("16:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==8){
									$cortime=date('H:i',strtotime("17:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==8.5){
									$cortime=date('H:i',strtotime("17:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==9){
									$cortime=date('H:i',strtotime("18:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==9.5){
									$cortime=date('H:i',strtotime("18:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==10){
									$cortime=date('H:i',strtotime("19:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==10.5){
									$cortime=date('H:i',strtotime("19:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==11){
									$cortime=date('H:i',strtotime("20:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==11.5){
									$cortime=date('H:i',strtotime("20:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==12){
									$cortime=date('H:i',strtotime("21:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==12.5){
									$cortime=date('H:i',strtotime("21:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}elseif($timecounter==13){
									$cortime=date('H:i',strtotime("22:00"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php
								}elseif($timecounter==13.5){
									$cortime=date('H:i',strtotime("22:30"));?>
									<form method="post" action="reserveform">
									<?php
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->order_by('staff_no', 'asc')->execute();								
										foreach($skedchek as $skedcheks){
											$select_staff = $skedcheks['staff_name'];
										}										
										if(count($skedchek)>0){ //スタッフがあれば
											echo Form::button('submit', ' ', array('class' => 'submitcal'));										
										}else{ //スタッフがいなければ
											print "X";
										}

									?>
									</form>
									<?php										
								}								
							}	
						?>
						</td>
						<?php
						}
						?>
					 <?php
					} else { // format failed
					  echo "Unknown Time";
					}
					?>
					</td>
					<td>
					<?php 
					if(floor($converted) != $converted){
				     $converted2 = $converted - 0.5;
					 echo $converted2; print ":30";
				    }else{
				     echo $converted; print ":00";
				    }
					?>
					</td></tr>
					<?php
				}

				?>
			
			</table><!-- End of Calendar Table-->		
				
			          
			<p>&nbsp;</p>
			<table style="border:none">
				<tr><td style="border:none;">&nbsp; </td></tr>
				<tr>
							<td  style="border:none;float:right"><?php echo Asset::img('yoyaku_ok.gif');?></td>
							<td colspan="2" style="border:none;">受付中 </td>
							<td colspan="2" style="border:none;">&nbsp;&nbsp;</td>
							<td style="border:none;float:right">X<?php //echo Asset::img('wazuka.gif');?></td>
							<td colspan="2"style="border:none">空きなし </td>
				</tr>
				<tr><td style="border:none;">&nbsp; </td></tr>			
			</table>
			
				<p>&nbsp;</p>
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