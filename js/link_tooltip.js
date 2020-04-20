var followerDiv = "";
var followerDiv2 = "";

function gotMouse(id)
{
	followerDiv = document.getElementById("div" + id);
	followerDiv.style.display = "block";
}

function lostMouse(id)
{
	followerDiv.style.display = "none";
}


function moveFollower(evt) {
try{
	var e = new Object();

	e.clientX = (typeof evt != "undefined") ? evt.clientX : event.x;
	e.clientY = (typeof evt != "undefined") ? evt.clientY : event.y;

	if(browser == "ie")
	{
		var scrollLeft = document.documentElement.scrollLeft;
		var scrollTop = document.documentElement.scrollTop;
	}
	else 
	if (browser == "mf")
	{
		var scrollLeft = document.documentElement.scrollLeft;
		var scrollTop = document.documentElement.scrollTop;
	}
	else
	if(browser == "gc")
	{
		var scrollLeft = document.body.scrollLeft;
		var scrollTop = document.body.scrollTop;
	}
	if(typeof followerDiv.style != "undefined"){
		
		followerDiv.style.left = e.clientX + scrollLeft + 10 + "px";
		followerDiv.style.top = e.clientY + scrollTop + 5 + "px";
	}
}catch(err){}
}

function moveFollower2(evt) {
try{
	var e = new Object();

	e.clientX = (typeof evt != "undefined") ? evt.clientX : event.x;
	e.clientY = (typeof evt != "undefined") ? evt.clientY : event.y;

	if(browser == "ie")
	{
		var scrollLeft = document.documentElement.scrollLeft;
		var scrollTop = document.documentElement.scrollTop;
	}
	else 
	if (browser == "mf")
	{
		var scrollLeft = document.documentElement.scrollLeft;
		var scrollTop = document.documentElement.scrollTop;
	}
	else
	if(browser == "gc")
	{
		var scrollLeft = document.body.scrollLeft;
		var scrollTop = document.body.scrollTop;
	}

	var clientWidth = document.documentElement.clientWidth;
	var clientHeight = document.documentElement.clientHeight;
	if(typeof followerDiv2.style != "undefined"){
		
		followerDiv2.style.left = e.clientX + scrollLeft + 10 + ((e.clientX + 293) > clientWidth ? -293 : 0) + "px";
		followerDiv2.style.top = e.clientY + scrollTop + 5 + ((e.clientY + 60) > clientHeight ? - 70 : 0) + "px";
	}
}catch(err){}
}

function gotMouse2(id)
{
	followerDiv2 = document.getElementById("div" + id);
	followerDiv2.style.display = "block";
}

function lostMouse2(id)
{
	followerDiv2 = document.getElementById("div" + id);
	followerDiv2.style.display = "none";
}
