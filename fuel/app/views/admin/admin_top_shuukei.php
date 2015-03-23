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

<body style="background-color:transparent;">

				<br><br><br>
				
					<center>
					 <div id="schedDiv" style="width:500px">
						<div id="schedGrid" style="width:450px">
							<table id="schedTable" style="width:400px">
			
								<colgroup><col id="schedTableCol1"></colgroup>
								<thead>
								
									<tr>
										<th><span id="schedHdr0">順位</span></th>
										<th><span id="schedHdr1">サービス名</span></th>
			
										<th><span id="schedHdr2">ご利用された回</span></th>
									
										
									</tr>
								</thead>
								
								<tbody>
								<?php
										$i = 1;
									  $ranking = Session::get('ranking');
									  $opcount = 0;
									  $mencount = 0;
									  $name ='';
									  $count = 0;
								?>
							
								<?php foreach((array)$rows as $row1): ?>
									<tr><td><?php print $i;?></td>
										<?php if ($ranking==="オプション"){?>
										<td class="txt"><?php echo $row1['opt_name']?></td>
										
										<td class="txt"><?php echo $row1['count']?></td>
										<?php 	 
														Session::set('options',array($name => $row1['opt_name']));
														Session::set('opcount',array($count => $row1['count'])); 
														
														?>
										
										
										<?php $opcount = $opcount +1;
											}else{
										
										 ?>
										<td class="txt"><?php echo $row1['svc_name']?></td>
										<td class="txt"><?php echo $row1['count']?></td>
										<?php }?>
									</tr>
									<?php $i = $i + 1;?>
								<?php endforeach ?>
								</tbody>
						   
							</table>
						</div>
					</div>
				</div> </center>
			


      


</body>
</html>