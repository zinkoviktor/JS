window.onload=function (){

var cal = new Date();
var day = cal.getDate();
var year = cal.getFullYear();
var month = cal.getMonth();
var month2 = cal.getMonth()+1;
var nday = cal.getDay();
var ul_cal=new Date(cal-13*1000*60*60*24);
var ul_month = ul_cal.getMonth();
var ul_day = ul_cal.getDate();

months=['Січень','Лютий','Березеня','Квітень','Травень','Червень','Липень','Серпень','Вересень','Жовтень','Листопад','Грудень'];
ndays=["неділя","понеділок","вівторок","середа","четвер","п'ятниця","субота"];
document.getElementById("c_mo").innerHTML=months[month]+", "+year;
document.getElementById("c_date").innerHTML=day;
document.getElementById("c_day").innerHTML=ndays[nday];
document.getElementById("c_oldDate").innerHTML="("+months[ul_month]+", "+ul_day+" за старим стилем)";
if (nday==0){
document.getElementById("red").style.color="red";
document.getElementById("red").style.fontWeight="bold";
};
var x=document.getElementById("c_events").innerHTML;
if (x="undefined"){document.getElementById("c_events").innerHTML=''};
	
jQuery(document).ready(function(){
	var lines = new Array();
	var words = new Array();
	
    jQuery.get('calendar/2016.txt', function(data){
            lines = data.split('\n');
				for (var i = 0; i < lines.length; i++) {
					if ((parseInt(lines[i].slice(0,2)) == month2) && (parseInt(lines[i].slice(3,5)) == day)) {
						words = lines[i].split('|');
					};	
					if (parseInt(lines[i].slice(4,6))== "#"){
					document.getElementById("red").style.color="red";
					document.getElementById("red").style.fontWeight="bold";					
					};
					
				};
	document.getElementById("c_events").innerHTML=words[6];
	
	});
});


}
