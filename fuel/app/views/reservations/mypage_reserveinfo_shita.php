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

<body>
<div class="right_col_section">
		    <center>
			
			
			<table width="100%" border="1"  class="columntitle">
				<tr><td>お客様のご予約情報</td></tr>
			</table>
			<table width="100%" border="1">
			<tr>
			<center>		
					<td style="background-color:6CA6CD;"class=""><h3><p style="margin-left:15px;font-size:15px;margin-top:15px;">予約番号</p></h3></td>
					<td style="background-color:6CA6CD;"class=""><h3><p style="margin-left:15px;font-size:15px;margin-top:15px;">日付</p></h3></td>
					<td style="background-color:6CA6CD;"class=""><h3><p style="margin-left:15px;font-size:15px;margin-top:15px;">時間</p></h3></td>
					<td style="background-color:6CA6CD;"class=""><h3><p style="margin-left:15px;font-size:15px;margin-top:15px;">スタッフ名</p></h3></td>
					<td style="background-color:6CA6CD;"class=""><h3><p style="margin-left:15px;font-size:15px;margin-top:15px;">コース</p></h3></td>
					<td style="background-color:6CA6CD;"class=""><h3><p style="margin-left:15px;font-size:15px;margin-top:15px;">オプション</p></h3></td>
			</center>
				<?php $i = 1;?>
			</tr>
			<tr>
				<?php
				$result = DB::select()->from('tblreserve')->where_open()
				->where('email', Auth::get_email())
				->and_where('valid_res', 1)
				->and_where('del_flag', 0)
				->where_close()
				->execute(); 
				?>
				<?php foreach($result as $row):?>
					
						<?php	$row['res_no'];  
					Session::set('no',array($i => $row['res_no'])); 
					$resno = Session::get('no') ;
					$res_no = Arr::get($resno,$i,'null'); 
					
					echo Form::hidden('res',Input::post('res',$res_no),array('type'=>'hidden','size'=>'20'));
					
				?>
				
			
				<td class=""><p style="margin-left:15px;font-size:15px"><?php print $res_no; ?></p></td>
			
				
				
				<?php	$row['res_date'];  
					Session::set('date',array($i => $row['res_date'])); 
					$resdate = Session::get('date') ;
					$res_date = Arr::get($resdate,$i,'null'); 
				?>
				<?php $showweekday = \Model\Calendar::display_dayofweek($res_date);?>
				<td class=""><p style="margin-left:15px;font-size:15px">
				<?php print date('m/d',strtotime($res_date)); ?><?php echo " (".$showweekday.")"; ?></p></td>
				
				<?php	$row['res_time'];  
					Session::set('time',array($i => $row['res_time'])); 
					$restime = Session::get('time') ;
					$res_date = Arr::get($restime,$i,'null'); 
				?>
				<td class=""><p style="margin-left:15px;font-size:15px">
				<?php print date('H:i',strtotime($res_date)); ?>~</p></td>
				
				<?php	$row['staff_name'];  
					Session::set('name',array($i => $row['staff_name'])); 
					$staffname = Session::get('name') ;
					$staff_name = Arr::get($staffname,$i,'null'); 
				?>
				<td class=""><p style="margin-left:15px;font-size:15px">
				<?php print $staff_name; ?></p></td>
				
				<?php	$row['svc_name_1'];  
					Session::set('svcname1',array($i => $row['svc_name_1'])); 
					$svcname_1 = Session::get('svcname1') ;
					$svc_name_1 = Arr::get($svcname_1,$i,'null'); 
					
					$row['svc_name_2'];  
					Session::set('svcname2',array($i => $row['svc_name_2'])); 
					$svcname_2 = Session::get('svcname2') ;
					$svc_name_2 = Arr::get($svcname_2,$i,'null');

					?>
				<td class=""><p style="margin-left:15px;font-size:15px">
				<?php print $svc_name_1; ?><br/><?php print $svc_name_2; ?></p></td>
				
				<?php	$row['opt_name'];  
					Session::set('optname',array($i => $row['opt_name'])); 
					$optname = Session::get('optname') ;
					$opt_name = Arr::get($optname,$i,'null'); 
				?>
				<td class=""><p style="margin-left:15px;font-size:15px">
				<?php print $opt_name; ?></p></td>	
					

					
					
				</tr>
				<?php endforeach; ?>
			</table>
					<p>&nbsp;</p>
		<center>
			<table border="0">
			<?php $nothing = Session::get('not'); ?>
			<tr><td><?php echo $nothing; ?></td></tr>
			</table>
		</center>
	          
	  	


	</div>

</body>
</html>