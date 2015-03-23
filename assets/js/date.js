
kyou = new Date();
function get_date(){

		
		
		yy = kyou.getUTCFullYear();
		mm = kyou.getUTCMonth() + 1;
		dd = kyou.getUTCDate();
		
		 
		document.write(yy + "年" + mm + "月" +
		dd + "日");
}
function get_day(){
		
		ar1=new Array("日","月","火","水","木","金","土");
		da = ar1[kyou.getUTCDay()];
		 
		document.write(da + "曜日" );
}
function get_time(){
		var currentTime = new Date()
		var hours = currentTime.getHours()
		var minutes = currentTime.getMinutes()
		if (minutes < 10){
		minutes = "0" + minutes
		}
		document.write(hours + ":" + minutes + " ")
	
}

