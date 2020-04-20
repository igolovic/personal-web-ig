var lock = false; 

function psVote(e)
{
try{
	if(typeof e.srcElement != "undefined" && e.fromElement != "undefined" && e.fromElement.tagName == "TD")
	{	
		document.getElementById("realResults").style.display = 'none';
		document.getElementById("hoverEffect").style.display = 'block';
	}
	if(typeof e.target != "undefined" && e.relatedTarget != "undefined" && e.relatedTarget.tagName == "TD")
	{
		document.getElementById("realResults").style.display = 'none';
		document.getElementById("hoverEffect").style.display = 'block';
	}
}catch(exc){}
}

function psResults(e)
{
try{
	if(typeof e.srcElement != "undefined" &&  e.toElement != "undefined" && e.toElement.tagName == "TD")
	{	
			document.getElementById("realResults").style.display = 'block';
			document.getElementById("hoverEffect").style.display = 'none';
	}
	if(typeof e.target != "undefined" &&  e.relatedTarget != "undefined" &&  e.relatedTarget.tagName == "TD")
	{
			document.getElementById("realResults").style.display = 'block';
			document.getElementById("hoverEffect").style.display = 'none';
	}
}catch(exc){}
}

function checkVoted()
{
	if(lock)
	{
		document.getElementById("lbPollMsg").innerHTML = (lang == "cro" ? "Već ste glasovali<br/>" : "You already voted<br/>");
		return false;
	}
	lock = true;
	return true;
}

function psHover(number)
{
	for(var i=1; i<=number; i++)
	{
		document.getElementById("imgStar" + i).src = 'res/star2.png';
	}
	for(var j=i; j<=5; j++)
	{
		document.getElementById("imgStar" + j).src = 'res/star0.png';
	}
}