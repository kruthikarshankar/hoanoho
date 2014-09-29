
var prevDay = 0;
var navEaster = Easter(new Date().getFullYear());

function padout(number) { return (number < 10) ? '0' + number : number; }

function Easter(Y) {
    var C = Math.floor(Y/100);
    var N = Y - 19*Math.floor(Y/19);
    var K = Math.floor((C - 17)/25);
    var I = C - Math.floor(C/4) - Math.floor((C - K)/3) + 19*N + 15;
    I = I - 30*Math.floor((I/30));
    I = I - Math.floor(I/28)*(1 - Math.floor(I/28)*Math.floor(29/(I + 1))*Math.floor((21 - N)/11));
    var J = Y + Math.floor(Y/4) + I + 2 - C + Math.floor(C/4);
    J = J - 7*Math.floor(J/7);
    var L = I - J;
    var M = 3 + Math.floor((L + 40)/44);
    var D = L + 28 - 31*Math.floor(M/4);
 
    return ("0" + D).slice(-2) + "." + ("0" + M).slice(-2) + "." + Y;
}

// 
setInterval(function(){
	var el_navDate = document.getElementById("date");
	var el_navClock = document.getElementById("time");

	var navWochentag = new Array("So.", "Mo.", "Di.", "Mi.", "Do.", "Fr.", "Sa.");
	var navNow = new Date();
	var navNowDay = ("0" + navNow.getDate()).slice(-2);
	var navNowMonth = ("0" + eval(navNow.getMonth()+1)).slice(-2);
	var navNowHour = ("0" + navNow.getHours()).slice(-2);
	var navNowMinute = ("0" + navNow.getMinutes()).slice(-2);
	var navNowSecond = ("0" + navNow.getSeconds()).slice(-2);
	
	if(el_navClock)
	{
		el_navDate.innerHTML = navWochentag[navNow.getDay()] + " " + navNowDay + "." + navNowMonth + "." + navNow.getFullYear();
    	el_navClock.innerHTML = navNowHour + ":" + navNowMinute + " Uhr";
    	prevDay = navNowDay;
    }
}, 1000);
