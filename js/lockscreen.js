$.idleTimer(300000);
$(document).bind("idle.idleTimer", function(){
	lockthescreen();
	document.getElementById('unlock_screen_btn').style.visibility='hidden';
});
$(document).bind("active.idleTimer", function(){
	document.getElementById('lockscreen').style.visibility='hidden';
});

$("#action_veille").click(function(e) { //unlock_screen_btn
	document.getElementById('unlock_screen_btn').style.visibility='visible';
	lockthescreen();
});

$("#unlock_screen_btn").click(function(e) { //unlock_screen_btn
	document.getElementById('unlock_screen_btn').style.visibility='hidden';
	document.getElementById('lockscreen').style.visibility='hidden';
});


function lockthescreen(){
	startTime();
	document.getElementById('lockscreen').style.visibility='visible';
}

function startTime()
{
	var today=new Date();
	var h=today.getHours();
	var m=today.getMinutes();
	var s=today.getSeconds();
	// add a zero in front of numbers<10
	m=checkTime(m);
	s=checkTime(s);
	document.getElementById('time').innerHTML=h+":"+m+":"+s;
	t=setTimeout(function(){startTime()},500);
}

function checkTime(i)
{
	if (i<10)
	{
		i="0" + i;
	}
	return i;
}

