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
			<!-- form id="form1" method="post" action="reserveform" name="cal_form" --><!-- start of form -->
				<table width="100%" border="0"  class="columntitle">
					<tr><td>ご予約日、時間を選択</td></tr>
				</table>
				<p></p>
				<center>				
				
		<!--	追加		-->
				<!--check2reservation から 予約番号,予約日付,予約時間を取ってきてる。-->
				<?php /* $resnumber = Session::get('checkresnunber');?>
				<?php $day = Session::get('rescheck');?>
				<?php $reschecktime = Session::get('reschecktime');?>
				<!--check2reservation の予約番号があれば 表示される-->
				<?php if($day != ''){ ?>
					<font color="red"><b> ※変更前 予約 &nbsp;&nbsp;
					<?php echo date('m/d',strtotime($day));?>&nbsp;
					<?php echo date('H:i',strtotime($reschecktime));?>～</b></font><br>
					<?//php Session::delete('rescheck');?>
			<?php } */?>
		<!--	追加		-->
		
			<table width="98%" id="datetable"><!-- Calendar Table-->
			<tr>
			<span class="attention">ご希望の来店日時の <font size="3px">○</font> を選択してください。</span>
			</tr>
				<tr>
				<th style="padding-right:5px; border-color:blue;font-size:12px;"><center>
				<form method="post" action="weektwo">
				<?php
				echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
				echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
				echo Form::button('submit', '<<', array('class' => 'next')); ?>
				</form>						
				</center></th>
				<?php					
					// Start date
					$date = date('Y-m-d', strtotime(' +14 day'));
					// End date
					$end_date = date('Y-m-d', strtotime(' +20 day'));
				 
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
						<form method="post" action="weekfour">
						<?php
						echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
						echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
						//echo Form::button('submit', '次の週');
						echo Form::button('submit', '>>', array('class' => 'next')); ?>
						</form>							
						</center></th>
				</tr>				

				
				<?php
				$cordate = $datelist;//date('Y-m-d', strtotime(' +8 day'));
				//echo $cordate;
				//$cordate = $datelist;
				for($timecounter=1;$timecounter<10.5;$timecounter=$timecounter+0.5)
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	


										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
									$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_10', '=', 1)
											->and_where('time_10_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1030', '=', 1)
											->and_where('time_1030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_11', '=', 1)
											->and_where('time_11_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1130', '=', 1)
											->and_where('time_1130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_12', '=', 1)
											->and_where('time_12_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1230', '=', 1)
											->and_where('time_1230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_13', '=', 1)
											->and_where('time_13_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1330', '=', 1)
											->and_where('time_1330_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_14', '=', 1)
											->and_where('time_14_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1430', '=', 1)
											->and_where('time_1430_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_15', '=', 1)
											->and_where('time_15_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1530', '=', 1)
											->and_where('time_1530_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_16', '=', 1)
											->and_where('time_16_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1630', '=', 1)
											->and_where('time_1630_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_17', '=', 1)
											->and_where('time_17_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1730', '=', 1)
											->and_where('time_1730_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_18', '=', 1)
											->and_where('time_18_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1830', '=', 1)
											->and_where('time_1830_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_19', '=', 1)
											->and_where('time_19_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_1930', '=', 1)
											->and_where('time_1930_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_20', '=', 1)
											->and_where('time_20_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2030', '=', 1)
											->and_where('time_2030_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_21', '=', 1)
											->and_where('time_21_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2130', '=', 1)
											->and_where('time_2130_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_22', '=', 1)
											->and_where('time_22_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
									echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
									echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
									echo Form::input('resdate', Input::post('resdate', $cordate),array('type'=>'hidden'));
									echo Form::input('restime', Input::post('restime', $cortime),array('type'=>'hidden'));	

										if($getbranch_id=="1"){
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 1)
											->order_by('staff_no', 'asc')->execute();
										}else{
										$skedchek = DB::select('staff_name')->from('tblstaffsched') //スタッフがいるかどうか確認
											->where('sched_date', '=', $cordate)
											->and_where('time_2230', '=', 1)
											->and_where('time_2230_open', '=', 0)
											->and_where('branch_id', '=', 2)
											->order_by('staff_no', 'asc')->execute();
										}							
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
				<tr><td style="border:none;">&nbsp; </td></tr>
				<tr><td style="border:none;">
				<p style="border:none;"><span class="attention">※19：30以降のご予約はお電話でお願い致します。</span></p>				
				<p style="border:none;"><span class="attention">☆☆上永谷店: </span>ＴＥＬ045-367-8849</span></p>

				<p style="border:none;"><span class="attention">☆☆伊勢佐木長者町店: </span>ＴＥＬ070-6668-0282</span></p>
				</td></tr>
				<tr><td style="border:none;">&nbsp; </td></tr>			
			</table>
			
				<p>&nbsp;</p>
				</center>
			<!-- /form --> <!-- end of form -->
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