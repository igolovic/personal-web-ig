function isEnter(e)
{
	var num = 0;
	if(window.event){ num = e.keyCode; }
	else if(e.which){ num = e.which; }
	
	if(num == 13)
	{ 
		if(document.getElementById("inpSearch").value == "")
		{
			notify(alString, badSearch);
		}			
		else
		{
			_search(); 
		}
		return false;
	}
	return true;
}

function _search()
{
	if(searchModified)
	{
		showHideLoader(true);
		sendAjaxSearch();	
		notify2(searchResults, "");
	}
	else
	{
		notify(alString, badSearch);
	}
}

var searchModified = false;

function mFocusSearch()
{
	var el = document.getElementById("inpSearch");
	if(!searchModified)
	{
		el.value = "";
		el.style.fontStyle = "normal";
		searchModified = true;
	}
}

function mBlurSearch()
{
	var el = document.getElementById("inpSearch");
	if(el.value == "")
	{
		el.value = lang == "cro" ? "Pretraga sajta" : "Site search";
		el.style.fontStyle = "italic";
		searchModified = false;
	}
}

_left2 = 0;
_top2 = 0;
var isDraggingEnabled2 = false;

function mDownHandler2(evt)
{   
    var e = new Object();

    e.clientX = (typeof evt != "undefined") ? evt.clientX : event.x;
    e.clientY = (typeof evt != "undefined") ? evt.clientY : event.y;
        
    var el = document.getElementById("al2");
    if(el != null)
    {
        _left2 = e.clientX - parseInt(el.style.left);
        _top2 = e.clientY - parseInt(el.style.top);
    }
    isDraggingEnabled2 = true;
}

function mUpHandler2(evt)
{
    isDraggingEnabled2 = false;
}

function notify2(title, text)
{
	var al = document.getElementById("al2");	
	var tl = document.getElementById("tl");
	
	if(browser == "ie"){ 
		var scrollTop = document.documentElement.scrollTop;
		al.style.left = Math.round(tl.offsetWidth/2 - 300) + "px";
	}
	else if(browser == "mf"){ 
		var scrollTop = document.documentElement.scrollTop;
		al.style.left = Math.round(tl.offsetWidth/2 - 300) + "px";
	}
	else if(browser == "gc"){ 
		var scrollTop = document.body.scrollTop;
		al.style.left = Math.round(tl.offsetWidth/2 - 300 + 17 + 8) + "px";
	}	

	al.style.top = scrollTop + 80 + "px";
	al.style.display = "block";
	
	document.getElementById("alTitle2").innerHTML = title;
	document.getElementById("alText2").innerHTML = text;
	document.getElementById("btnOk2").focus();
}

function unNotify2()
{
	document.getElementById("al2").style.display = "none";
	document.getElementById("inpSearch").focus();
}

_left = 0;
_top = 0;
var isDraggingEnabled = false;

function mDownHandler(evt)
{   
    var e = new Object();

    e.clientX = (typeof evt != "undefined") ? evt.clientX : event.x;
    e.clientY = (typeof evt != "undefined") ? evt.clientY : event.y;
        
    var el = document.getElementById("al");
    if(el != null)
    {
        _left = e.clientX - parseInt(el.style.left);
        _top = e.clientY - parseInt(el.style.top);
    }
    isDraggingEnabled = true;
}

function mMove(evt)
{
    if(isDraggingEnabled)
    {
        var e = new Object();
        e.clientX = (typeof evt != "undefined") ? evt.clientX : event.x;
        e.clientY = (typeof evt != "undefined") ? evt.clientY : event.y;
        var el = document.getElementById("al");
        if(el != null)
        {
            el.style.left = e.clientX - _left + "px";
            el.style.top = e.clientY - _top + "px";
        }          
    }
    if(isDraggingEnabled2)
    {
        var e = new Object();
        e.clientX = (typeof evt != "undefined") ? evt.clientX : event.x;
        e.clientY = (typeof evt != "undefined") ? evt.clientY : event.y;
        var el = document.getElementById("al2");
        if(el != null)
        {
            el.style.left = e.clientX - _left2 + "px";
            el.style.top = e.clientY - _top2 + "px";
        }          
    }
}

function mUpHandler(evt)
{
    isDraggingEnabled = false;
}

function notify(title, text)
{
	var al = document.getElementById("al");
	var tl = document.getElementById("tl");
	var shade = document.getElementById("divShade");	
	
	if(browser == "ie"){ 
		var scrollTop = document.documentElement.scrollTop;
		al.style.left = Math.round(tl.offsetWidth/2 - 175) + "px";
	}
	else if(browser == "mf"){ 
		var scrollTop = document.documentElement.scrollTop;
		al.style.left = Math.round(tl.offsetWidth/2 - 175) + "px";
	}
	else if(browser == "gc"){ 
		var scrollTop = document.body.scrollTop;
		al.style.left = Math.round(tl.offsetWidth/2 - 175 + 17 + 8) + "px";
	}
	
	shade.style.height = tl.offsetHeight + "px";
	shade.style.display = "block";	

	al.style.top = scrollTop + 350 + "px";
	al.style.display = "block";
	
	document.getElementById("alTitle").innerHTML = title;
	document.getElementById("alText").innerHTML = text;
	document.getElementById("btnOk").focus();
}

function unNotify()
{
	document.getElementById("al").style.display = "none";
	document.getElementById("divShade").style.display = "none";
}

var browser = "";
var version = "";
function _browser()
{
	var warning = false;
	if(navigator.userAgent.match("MSIE")){ 
		try{
			browser = "ie"; 
			var start = navigator.userAgent.indexOf("MSIE ") + 5;
			var _stop = start + 1;
			version = navigator.userAgent.substring(start,_stop);
			if(version < 7)
			{ 	
				warning = true; 
			}
		}catch(e){}
	}
	else if(navigator.userAgent.match("Firefox")){ 
		try{
			browser = "mf"; 
			var start = navigator.userAgent.indexOf("Firefox/") + 8;
			var _stop = start + 3;
			version = navigator.userAgent.substring(start,_stop);
			if(Number(version) < 3.5)
			{ 	
				warning = true; 
			}
		}catch(e){}	
	}
	else if(navigator.userAgent.match("Chrome")){ 
		try{
			browser = "gc"; 
			var start = navigator.userAgent.indexOf("Chrome/") + 7;
			var _stop = start + 3;
			version = navigator.userAgent.substring(start,_stop);
			if(Number(version) < 3.0)
			{ 	
				warning = true; 
			}
		}catch(e){}	
	}
	else if(navigator.userAgent.match("Opera")){ 
		try{
			browser = "mf";
			var start = navigator.userAgent.indexOf("Opera/") + 6;
			var _stop = start + 3;
			version = navigator.userAgent.substring(start,_stop);
			if(Number(version) < 9.8)
			{ 	
				warning = true; 
			}
		}catch(e){}	
	}
	
	if(browser == "" || warning)
	{
		browser = "mf";

		var txt = "Neodgovarajući preglednik ili verzija preglednika. Ovaj sajt podržava IE 8 (prilagodba za IE 7 biti će ugrađena uskoro), Firefox 3.5.3, Chrome 3.0.195.21, Opera 10.01 ili višu verziju. Stranice bi se mogle krivo prikazivati :(<br /><br />Incompatible browser or browser version. This page should be viewed using IE 8 (support for IE 7 will be implemented soon), Firefox 3.5.3, Chrome 3.0.195.21, Opera 10.01 or higher. Page might be displayed incorrectly :(";
		
		notify('Obavijest / Notification', txt);
	}
}

function initialPos()
{
	this.news = document.getElementById("divNews");
	this.letters = document.getElementById("divLetters");	
	this.lm = document.getElementById("leftMenu");
	this.tl = document.getElementById("tl");
	this.flags = document.getElementById("divParent");
	
	if(browser == "gc")
	{
		document.getElementById("conL").style.paddingLeft = "8px";
		document.getElementById("conR").style.paddingRight = "8px";
	}
	
	this.calc = function()
	{
		if(browser == "ie"){ 
			this.lm.style.left = Math.round(this.tl.offsetWidth/2 - 465) + "px";
			this.news.style.left = Math.round(this.tl.offsetWidth/2 + 294) + "px";
			this.news.style.top = "229px";
		}
		else if(browser == "mf"){ 
			this.lm.style.left = Math.round(this.tl.offsetWidth/2 - 465) + "px";
			this.news.style.left = Math.round(this.tl.offsetWidth/2 + 295) + "px";
			this.news.style.top = "227px";
		}
		else if(browser == "gc"){ 
			this.lm.style.left = Math.round(this.tl.offsetWidth/2 - 486 + 20) + "px";
			this.news.style.left = Math.round(this.tl.offsetWidth/2 + 294) + "px";
			this.news.style.top = "229px";
		}
		
		this.letters.style.left = Math.round(this.tl.offsetWidth/2 - 382) + "px";
		this.flags.style.left = Math.round(this.tl.offsetWidth/2 + 305) + "px";
	}
}

var oldScroll;
function openImage(html, width, height)
{
	var shade = document.getElementById("divShade");

	if(browser == "ie")
	{
		var clientHeight = document.documentElement.clientHeight;
		var clientWidth = document.documentElement.clientWidth;
		var scrollTop = document.documentElement.scrollTop;
	}
	else 
	if (browser == "mf")
	{
		var clientHeight = document.documentElement.clientHeight;
		var clientWidth = document.documentElement.clientWidth;
		var scrollTop = document.documentElement.scrollTop;
	}
	else
	if(browser == "gc")
	{
		var clientHeight = document.documentElement.clientHeight;
		var clientWidth = document.body.clientWidth;
		var scrollTop = document.body.scrollTop;
	}
	
	shade.style.height = document.getElementById("tl").offsetHeight + "px";
	shade.style.display = "block";
	
	var image = document.getElementById("divImage");
	image.style.display = "block";
	
	image.style.top = (scrollTop + (clientHeight/2) - 20 - height/2) + "px";
	image.style.left = (clientWidth/2 - width/2) + "px";

	if(html == "myLocation")
	{
		mapDiv = document.getElementById("map");
		mapDiv.style.display = "block";
		mapDiv.style.top = image.style.top;
		mapDiv.style.left = image.style.left;
		
		var map = new GMap(mapDiv);    
		map.addControl(new GLargeMapControl());	   
		map.centerAndZoom(new GPoint(16.3500,46.3000), 7);
		map.addOverlay(new GMarker(new GLatLng(46.3000,16.3500)));
		
		var divCloseLoc = document.getElementById("divCloseLoc");
		divCloseLoc.style.display = "block";
		divCloseLoc.style.top = (scrollTop + (clientHeight/2) - 20 + height/2 + 65) + "px";
		divCloseLoc.style.left = (clientWidth/2 - 85) + "px";	
	}
	else
	{
		image.innerHTML = html;
		var notice = document.getElementById("divNotice");
		notice.style.display = "block";
		notice.style.top = (scrollTop + (clientHeight/2) - 20 + height/2 + 30) + "px";
		notice.style.left = (clientWidth/2 - 85) + "px";	
	}	
}

function closeImage(html)
{
	document.getElementById("divShade").style.display = "none";
	document.getElementById("divImage").style.display = "none";
	document.getElementById("divNotice").style.display = "none";
	document.getElementById("divImage").innerHTML = "";	
	document.getElementById("divCloseLoc").style.display = "none";
	document.getElementById("map").style.display = "none";
}

function insert_emoticon(id, em) 
{
	var ctrl = document.getElementById(id);

	if (typeof document.selection != "undefined") 
	{
		ctrl.focus ();
		document.selection.createRange().text = em;
		ctrl.caretPos = document.selection.createRange().duplicate();
		ctrl.focus ();
	}
	
	if(typeof ctrl.selectionStart != "undefined")
	{
		var CaretPos = ctrl.selectionStart;
		
		text = ctrl.value;
		ctrl.value = text.substring(0,CaretPos) + em + text.substring(CaretPos);
		ctrl.focus ();		
	}

	if(browser == "gc")
	{
			ctrl.selectionStart = ctrl.selectionEnd + em.length;
	}

	var count = document.getElementById("divCount");
	var txt = document.getElementById("inpComment");
	count.innerHTML = 700 - (txt.value.length) + availableCharMsg;
}

var d = new Date();
var calendarMonth = d.getMonth() + 1;

function countChars(evt)
{
	var keycode;
	var keychar;

	if(window.event)
	{
		keycode = evt.keyCode;		
		
	} else if(evt.which)
	{
		keycode = evt.which;
	}

	var count = document.getElementById("divCount");
	var txt = document.getElementById("inpComment");
	
	if(700 - (txt.value.length) > 0)
	{
		count.innerHTML = 700 - (txt.value.length) + availableCharMsg;
	}
	else
	{
		count.innerHTML = "0" + availableCharMsg;
	}
}

function checkComment()
{
	document.getElementById("errorName").innerHTML = document.getElementById("errorComment").innerHTML = '<img alt="" src="res/pixel.gif" height="1" width="12">';

	if(document.getElementById("inpAuthor").value.length == 0)
	{
		document.getElementById("errorName").innerHTML = "*";
		return false;
	}
	
	if(document.getElementById("inpComment").value.length == 0)
	{
		document.getElementById("errorComment").innerHTML = "*";
		return false;
	}
	return true;
}

function checkContactForm()
{
	document.getElementById("errorMail").innerHTML = '<img alt="" src="res/pixel.gif" height="1" width="12">';
	if(checkComment())
	{
		if(document.getElementById("inpMail").value.length == 0)
		{
			document.getElementById("errorMail").innerHTML = "*";
			return false;
		}
	}
	else
	{
		return false;
	}
	return true;
}

function showHideFixedHeightDiv(id)
{
	if(AnimationInProgress == false)
	{
	AnimationInProgress = true;
	
	var div = document.getElementById("div" + id);
	var img = document.getElementById("img" + id);

	if(div.style.height == "0px")
	{
		img.src = "res/min.gif";
		
		id = window.setInterval(
			function()
			{
					if(	Number(div.style.height.replace("px","")) + 30 >= 360){
						div.style.height = "360px";
						window.clearInterval(id);
						AnimationInProgress = false;
						}
					else{
						div.style.height = Number(div.style.height.replace("px","")) + 30 + "px";
					}
			},5);
	}
	else
	{
	img.src = "res/plu.gif";		
	
	id = window.setInterval(
	function()
		{
				if(	Number(div.style.height.replace("px","")) - 30 <= 0)
				{
					div.style.height = "0px";
					window.clearInterval(id);
					AnimationInProgress = false;
				}
				else
				{
					div.style.height = Number(div.style.height.replace("px","")) - 30 + "px";
				}
		},5);
	}	
	}
}

function openPart(id)
{
	document.getElementById("div" + SelectedDivId).style.height = '0px';
	setMenu(id);
	showPart(id);
}

function setMenu(id)
{
	switch(id)
	{
		case "Homepage":
		case "Technical":
				document.getElementById('divhome').style.height = '100px';
				SelectedDivId = "home";
		break;
		case "MyData":
		case "Leisure":
				document.getElementById('divaboutme').style.height = '100px';
				SelectedDivId = "aboutme";
		break;
		case "FavProgram":
		case "FavLinks":
				document.getElementById('divfavs').style.height = '100px';
				SelectedDivId = "favs";
		break;
		case "Guestbook":
		case "Cf":		
				document.getElementById('divcontact').style.height = '100px';
				SelectedDivId = "contact";
		break;
	}
}

var AnimationInProgress = false;
var names = Array();

function showHideDiv(id)
{
	if(AnimationInProgress == false)
	{
	AnimationInProgress = true;
	
	var div = document.getElementById("div" + id);
	var img = document.getElementById("img" + id);
	
	if(div.style.display == "none")
	{
	div.style.display = "block";
	img.src = "res/min.gif";
	var h = names[id];
	var offset = 20;
	
	if(h > 250 || browser == "ie"){ offset = 30; }
	
	div.style.display = "block";	    
	
	id = window.setInterval(
		function()
		{
			if(	Number(div.style.height.replace("px","")) + offset >= h)
			{
				div.style.height =h+ "px";
				window.clearInterval(id);
				AnimationInProgress = false;
			}
			else
			{
				div.style.height = Number(div.style.height.replace("px","")) + offset + "px";
			}
		},5);
	}
	else
	{
	img.src = "res/plu.gif";		
	div.style.height = div.offsetHeight + "px";	
	names[id] = div.offsetHeight;
	var offset = 20;
	
	if(names[id] > 250 || browser == "ie"){ offset = 30; }

	id = window.setInterval(
		function()
		{
				if(	Number(div.style.height.replace("px","")) - offset <= 0)
				{
					div.style.display = "none";	    
					window.clearInterval(id);
					AnimationInProgress = false;
				}
				else
				{
					div.style.height = Number(div.style.height.replace("px","")) - offset + "px";
				}
		},5);
	}	
	}
}

function showHideDiv2(id)
{	
	var div = document.getElementById("div" + id);
	var img = document.getElementById("img" + id);

	if(div.style.display == "none")
	{
		div.style.display = "block";
		img.src = "res/min.gif";
	}
	else
	{
		div.style.display = "none";
		img.src = "res/plu.gif";
	}
}