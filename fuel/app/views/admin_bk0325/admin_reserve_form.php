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
						<tr><td><?php echo Asset::img('img2/user_icon.gif'); ?>	</td>
							<td>
							店舗：<?php echo Session::get('branch');?><br><hr><i>役割：<?php echo Session::get('role');?></i>
							</td>
							<td>
							</td>
						</tr>	
					</table> 
				</div>	 <!-- ************************************************** end fix ****************************************************-->
				
				<div class="coldivider_center" style="margin-top:80px;">

		          <center>
			<form id="form1" method="post" action="reserveconfirm" name="form1"><!-- start of form -->
				<table width="100%" border="0"  class="columntitle">
					<tr><td>予約手続き</td></tr>

	
				</table>
				<table width="100%" border="0">
				<?php	$resnumber = Session::get('checkresnunber');
						$checkname = Session::get('checkname');
						$checkstaff = Session::get('checkstaff');
						$checkservice1 = Session::get('checkservice1');
						$checkservice2 = Session::get('checkservice2');
						$checkoption = Session::get('checkoption'); ?>
							
					<?php		if($resnumber != ''){ ?>
					<!---- display id by name---->
						<tr>
							<td class="ptablespacer"><h3><p><span class="attention">＊</span>顧客名 </p></h3></td>
						<td class="ptablespacer">
							<?php echo $checkname; ?>
							</td>
						</tr>
					<!-- end of get id by name---->
					<tr>				
					<?php if (isset($error)): ?>
					<div class="alert"><font color="red"><?php echo $error ?></font></div>
					<?php endif ?>

						<td class="ptablespacer"><h3><p><span class="attention">＊</span>スタッフを選択</p></h3></td>
						<td class="ptablespacer">
						
						<h3>
						<?php

						echo Form::input('resdate', Input::post('resdate', $resdate),array('type'=>'hidden'));
						echo Form::input('restime', Input::post('restime', $restime),array('type'=>'hidden'));
						?>						
						<!--select name=staff id=staff onchange=setMenuItem(this.selectedIndex); style="width: 150px;"-->	
						<select name=staff id=staff style="width: 150px;">	
						<!--option value=''></option-->
						<option value='指名なし'>指名なし</option>
						<?php foreach($staff as $row):?>
						<option value="<?php echo $row['staff_name']?>"><?php echo $row['staff_name']."<br>";?></option>
						<?php endforeach;?>					
						</select>

						<a href="staff" class="btn">
							  <?php //echo Asset::img('staff_pagebtn.gif');?>		
					  
						</a>
						</h3>
						</td>
						
					</tr>
					<tr>
						<td class="ptablespacer"><h3><p><span class="attention"></span>コースを選択</p></h3></td>
						<td class="ptablespacer"><h3>
							<!-- 1--><p>

							<?php //echo Form::select('course', Input::post('svc_no', ''), $select_course, array('class' => 'selectinput')); ?>
							<select name=course1 id=course1 style="width: 150px;">
							<?php if($checkservice1!='なし'){?>							
							<option value="<?php echo $checkservice1?>"><?php echo $checkservice1."<br>";?></option>
							<?php } ?>	
							<?php foreach($course1 as $row):?>
							<option value="<?php echo $row['svc_name']?>"><?php echo $row['svc_name']."<br>";?></option>							
							<?php endforeach;?>							
							</select>						
							<a href="course" class="btn">
							<?php //echo Asset::img('coursebtn.gif');?>	
							</a>
							</p>
							  
							 <!-- 2--><p>
							 <?php //echo Form::select('course', Input::post('svc_no', ''), $select_course, array('class' => 'selectinput')); ?>
							<select name=course2 id=course2 style="width: 150px;">
							<!--option value=''></option-->
							<?php if($checkservice2!='なし'){?>
							<option value="<?php echo $checkservice2?>"><?php echo $checkservice2."<br>";?></option>
							<?php } ?>
							<?php foreach($course2 as $row):?>
							<option value="<?php echo $row['svc_name']?>"><?php echo $row['svc_name']."<br>";?></option>
							<?php endforeach;?>
							</select>	
							  
							  </p>
							 <!-- 3--><p> 	
							<!--
							<select name=course3 id=course3>
							<option value=''></option>
							<?php	//foreach($course3 as $row):?>
							<option value="<?php //echo $row['svc_name']?>"><?php //echo $row['svc_name']."<br>";?></option>
							<?php //endforeach;?>
							</select>								  
							 --> 
							  
							  </p>
							 <!-- 
							 <p><span style="font-size:10px;" class="attention">※コースは３つまで選べます</span></p>
							 -->
							</h3>
						</td>
					</tr>
					<tr>
						<td class="ptablespacer"><h3><p>オプション</p></h3></td>
						<td>
						
							<select name=option id=option style="width: 150px;">
							<?php if($checkoption!='なし'){?>
							<option value="<?php echo $checkoption?>"><?php echo $checkoption."<br>";?></option>
							<?php } ?>
							<?php foreach($option as $row):?>
							<option value="<?php echo $row['opt_name']?>"><?php echo $row['opt_name']."<br>";?></option>
							<?php endforeach;?>
							</select>
							<!--
							<?php //$i=1; ?>
							<?php	//foreach($option as $row):?>	
								<?php  //if(($i % 2)==1){
									//print"<br>";
								//}
								
								?>
									<input type="checkbox" name="option[]" value="<?php //echo $row['opt_name']?>" 
									style="font-size:14px; margin-left:20px; margin-top:10px; margin-bottom:10px; width=50;"/>
									<?php //echo //$row['opt_name'];?>						
								<?php //$i=$i+1;?>
							<?php //endforeach;?>
							-->
						</td>
					</tr>
					
					<?php }else{ ?>
					
					<!---- get id by name---->
						<tr>
							<td class="ptablespacer"><h3><p><span class="attention">＊</span>顧客ID </p></h3></td>
						<td class="ptablespacer">
								<?php echo Form::input('search',Input::post('search'), array('required' => 'required' ,'size'=>'20', 'class' => 'textinput'))//, $name ?>
							</td>
						</tr>
					<!-- end of get id by name---->
					<tr>				
					<?php if (isset($error)): ?>
					<div class="alert"><font color="red"><?php echo $error ?></font></div>
						<?php endif ?>

						<td class="ptablespacer"><h3><p><span class="attention">＊</span>スタッフを選択</p></h3></td>
						<td class="ptablespacer">
						
						<h3>
						<?php

						echo Form::input('resdate', Input::post('resdate', $resdate),array('type'=>'hidden'));
						echo Form::input('restime', Input::post('restime', $restime),array('type'=>'hidden'));
						?>						
						<!--select name=staff id=staff onchange=setMenuItem(this.selectedIndex); style="width: 150px;"-->	
						<select name=staff id=staff style="width: 150px;">	
						<!--option value=''></option-->
						<option value='指名なし'>指名なし</option>
						<?php foreach($staff as $row):?>
						<option value="<?php echo $row['staff_name']?>"><?php echo $row['staff_name']."<br>";?></option>
						<?php endforeach;?>					
						</select>

						<a href="staff" class="btn">
							  <?php //echo Asset::img('staff_pagebtn.gif');?>		
					  
						</a>
						</h3>
						</td>
						
					</tr>
					<tr>
						<td class="ptablespacer"><h3><p><span class="attention"></span>コースを選択</p></h3></td>
						<td class="ptablespacer"><h3>
							<!-- 1--><p>

							<?php //echo Form::select('course', Input::post('svc_no', ''), $select_course, array('class' => 'selectinput')); ?>
							<select name=course1 id=course1 style="width: 150px;">
							
							<?php foreach($course1 as $row):?>
							<option value="<?php echo $row['svc_name']?>"><?php echo $row['svc_name']."<br>";?></option>							
							<?php endforeach;?>							
							</select>						
							<a href="course" class="btn">
							<?php //echo Asset::img('coursebtn.gif');?>	
							</a>
							</p>
							  
							 <!-- 2--><p>
							 <?php //echo Form::select('course', Input::post('svc_no', ''), $select_course, array('class' => 'selectinput')); ?>
							<select name=course2 id=course2 style="width: 150px;">
							<!--option value=''></option-->
							<?php foreach($course2 as $row):?>
							<option value="<?php echo $row['svc_name']?>"><?php echo $row['svc_name']."<br>";?></option>
							<?php endforeach;?>
							</select>	
							  
							  </p>
							 <!-- 3--><p> 	
							<!--
							<select name=course3 id=course3>
							<option value=''></option>
							<?php	//foreach($course3 as $row):?>
							<option value="<?php //echo $row['svc_name']?>"><?php //echo $row['svc_name']."<br>";?></option>
							<?php //endforeach;?>
							</select>								  
							 --> 
							  
							  </p>
							 <!-- 
							 <p><span style="font-size:10px;" class="attention">※コースは３つまで選べます</span></p>
							 -->
							</h3>
						</td>
					</tr>
					<tr>
						<td class="ptablespacer"><h3><p>オプション</p></h3></td>
						<td>
						
							<select name=option id=option style="width: 150px;">
							<?php foreach($option as $row):?>
							<option value="<?php echo $row['opt_name']?>"><?php echo $row['opt_name']."<br>";?></option>
							<?php endforeach;?>
							</select>
							<!--
							<?php //$i=1; ?>
							<?php	//foreach($option as $row):?>	
								<?php  //if(($i % 2)==1){
									//print"<br>";
								//}
								
								?>
									<input type="checkbox" name="option[]" value="<?php //echo $row['opt_name']?>" 
									style="font-size:14px; margin-left:20px; margin-top:10px; margin-bottom:10px; width=50;"/>
									<?php //echo //$row['opt_name'];?>						
								<?php //$i=$i+1;?>
							<?php //endforeach;?>
							-->
						</td>
					</tr>
				<?php } ?> <!-- 追加-->
					<tr>
						<td colspan="2" class="ptablespacer">
						<h2><p><center>
						<input action="action" type="button" value="前の画面にもどる" onclick="history.go(-1);" />
						<input type="submit" value="予約を確認する">
						</center></p>
						</h2></td>
					</tr>

					</tr>
					

				</table>
	          
	  
		</center><p>&nbsp;</p>
					
				</div>
				
				
	    </div> <!-- end of content -->
	    
	   <div id="bluegarden_footer">
	      
	   	  Copyright &copy; 2013 Blue Garden All Rights Reserved.
	   </div> 
	    <!-- end of footer -->

	</div> <!-- end of container -->

</body>
</html>