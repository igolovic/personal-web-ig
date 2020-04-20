var _timer = "no";

function returnSlideDiv(e, id)
{
try{
	if(typeof e != "undefined" && typeof e.toElement != "undefined" && e.toElement.tagName != "undefined")
	{	
		if(e.toElement.id  == "w4"||e.toElement.id  != "w2"||e.toElement.id  != "w3"||e.toElement.id  != "w4")
		{
			if(lang == "cro")
			{
				slideLeft(id);
			}
			if(lang == "eng")
			{
				slideRight(id);
			}
		}
	}
	
	if(typeof e != "undefined" && typeof e.relatedTarget!= "undefined" && e.relatedTarget.tagName != "undefined")
	{
		if(e.relatedTarget.id  == "w4"||e.relatedTarget.id  != "w2"||e.relatedTarget.id  != "w3"||e.relatedTarget.id  != "w4")
		{
			if(lang == "cro")
			{
				slideLeft(id);
			}
			if(lang == "eng")
			{
				slideRight(id);
			}
		}
	}
}catch(err){}
}

function slideRight(id)
{
	if(id != "no")
	{
		window.clearInterval(id);	
	}
	
	var offset = browser == "ie" ?  10 : 5;
	
	var bckg = document.getElementById('bckg');				
	var timer = window.setInterval(
		function()
		{				
			if(bckg.style.left != "70px")
			{   
				bckg.style.left = (Number(bckg.style.left.replace("px","")) + offset) + 'px';
			}
			else
			{			
				window.clearInterval(timer);	
				timer = "no";
			}
		},10);

	return timer;
}

function slideLeft(id)
{
	if(id != "no")
	{
		window.clearInterval(id);	
	}
	
	var offset = browser == "ie" ?  10 : 5;
	
	var bckg = document.getElementById('bckg');				
	var timer = window.setInterval(
		function()
		{				
			if(bckg.style.left != "0px")
			{   
				bckg.style.left = (Number(bckg.style.left.replace("px","")) - offset) + 'px';
			}
			else
			{			
				window.clearInterval(timer);
				timer = "no";
			}
		},10);
	
	return timer;
}