function showHideLoader(show)
{
	var tl = document.getElementById("tl");
	var ldr = document.getElementById("ldr");

	ldr.style.left = Math.round(tl.offsetWidth/2 - 75) + "px";
	ldr.style.top = "310px";
			
	if(show){
		ldr.style.display = "block";
	}else{
		ldr.style.display = "none";
	}
}

var currentlyVisible = "Technical";
function showPart(name)
{
	var  d = new Date();
	d.setDate(d.getDate() + 61);
	document.cookie = "pref=" + escape(name) + ";expires=" + d.toGMTString();
	currentlyVisible = name;
	getAjaxPageSection(name);
	showHideLoader(true);
} 