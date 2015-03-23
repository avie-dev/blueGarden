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
					<a href="reserve"><?php echo Asset::img('reservebtn.gif',array('width' => '245'));?></a>
			</div>
			<?php }?>
	
	
       		
    	</div>


        <!-- end of left -->
    	<p>&nbsp;</p>
    	
  
        <div id="bluegarden_right">
        
	
        	<div class="right_col_section">
		
		          <center>
			<form id="form1" method="post" action="reserveconfirm" name="form1"><!-- start of form -->
				<table width="100%" border="0"  class="columntitle">
					<tr><td>予約手続き</td></tr>

	
				</table>
				<table width="100%" border="0">
					<?php if (isset($error)): ?>
						<div class="alert"><font color="red"><?php echo $error ?></font></div>
					<?php endif ?>
					<?php if($getbranch_id=="1"){ ?>
					<tr>									
						<td class="ptablespacer"><h3><p><span class="attention">＊</span>スタッフを選択</p></h3></td>
						<td class="ptablespacer">
						
						<h3>
						<?php
						echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
						echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
						echo Form::input('resdate', Input::post('resdate', $resdate),array('type'=>'hidden'));
						echo Form::input('restime', Input::post('restime', $restime),array('type'=>'hidden'));?>					
						<select name=staff id=staff onchange=setMenuItem(this.selectedIndex); style="width: 150px;">
						<option value='指名なし'>指名なし</option>
						<?php foreach($staff1 as $row):?>
						<option value="<?php echo $row['staff_name']?>"><?php echo $row['staff_name']."<br>";?></option>
						<?php endforeach;?>

						</select>
						<span class="attention" style="font-size:12px"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;※指名料は540円（税込み）になります。</span>						
						<script language="JavaScript">
						 
						function getPrice(n) { 
						var $course1=document.getElementById("course1").value;
						alert($course1);
						//document.write($course1);
						form1.course1pr.value = $course1;
						var $course1prr=document.getElementById("course1pr").value;

						<?php
						$course1prd = DB::select('svc_price_member')->from('tblservice')->where('svc_name','=','$course1prr')->execute();
							foreach($course1prd as $row){
								$row_select= $row['svc_price_member'];
							}
						?>
						var $prlist = <?php $row_select; ?>
						form1.course1prlist.value = $prlist;

						} 
						</script>
						<a href="staff" class="btn"><?php //echo Asset::img('staff_pagebtn.gif');?></a>
						</h3>
						</td>
					</tr>
					<?php }else{ ?>
						
						<h3>
						<?php
						echo Form::input('getbranch_name', Input::post('getbranch_name', $getbranch_name),array('type'=>'hidden'));
						echo Form::input('getbranch_id', Input::post('getbranch_id', $getbranch_id),array('type'=>'hidden'));
						echo Form::input('resdate', Input::post('resdate', $resdate),array('type'=>'hidden'));
						echo Form::input('restime', Input::post('restime', $restime),array('type'=>'hidden'));?>					
						<?php foreach($staff2 as $row):
						echo Form::input('staff', Input::post('staff', $row['staff_name']),array('type'=>'hidden'));
						endforeach;?>				
						
						</h3>
					</tr>
					<?php }?>
					<tr>
						<td class="ptablespacer"><h3><p><span class="attention"></span>コースを選択</p></h3></td>
						<td class="ptablespacer"><h3>
								<!-- 1--><p>
								<!--select name=course1 id=course1 onchange=getPrice(this.selectedIndex); style="width: 150px;"-->						
									<select name=course1 id=course1 style="width: 150px;">						
									<?php foreach($course1 as $row):?>
									<option value="<?php echo $row['svc_name']?>"><?php echo $row['svc_name']."<br>";?></option>														
									<?php endforeach;?>							
									</select>					
								</p>							  
								 <!-- 2--><p>
								<select name=course2 id=course2 style="width: 150px;">
								<?php foreach($course2 as $row):?>
								<option value="<?php echo $row['svc_name']?>"><?php echo $row['svc_name']."<br>";?></option>
								<?php endforeach;?>
								</select>	
							  </p>
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
						</td>
					</tr>

					<tr>
						<td colspan="2" class="ptablespacer">
						<h2><p><center>
						<input action="action" type="button" value="前の画面にもどる" onclick="history.go(-1);" />
						<input type="submit" value="予約を確認する">
						</center></p>
						</h2></td>
					</tr>
					

				</table>
	          
	  
		</center><p>&nbsp;</p>
          <div class="cleaner"><p>&nbsp;</p></div> 
                    
        
        </div> <!-- end of right -->
		</form> <!-- end of form -->
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