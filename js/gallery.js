function setInitialPosition(rowId, count)
{
	var div = document.getElementById(rowId);
	
		firstElement[rowId] = 1; 
		lastElement[rowId] = 3;
		elementCount[rowId] = count;
}

var firstElement = new Array(); 
var lastElement = new Array();
var elementCount = new Array();

function slideRow(rowId)
{			
	if(firstElement[rowId] == 1)
	{
		return;
	}

	if(AnimationInProgress == false)
	{
	AnimationInProgress = true;

	var div = document.getElementById(rowId);
	
	var counter = 0;
	var steps = new Array(30,30,30,30,20,5,2,2,1);
	id = window.setInterval(
	function()
	{
			if(typeof steps[counter] == "undefined"){
				window.clearInterval(id);
				AnimationInProgress = false;
				}
			else{
				div.style.left = Number(div.style.left.replace("px","")) + steps[counter] + "px";
				counter++;
			}
	}
	,5
	);
				firstElement[rowId]--; 
				lastElement[rowId]--;
	}
}

function slideBackRow(rowId)
{			
	if(elementCount[rowId] <= lastElement[rowId])
	{
		return;
	}

	if(AnimationInProgress == false)
	{
		AnimationInProgress = true;
		var div = document.getElementById(rowId);
		var counter = 0;
		var steps = new Array(30,30,30,30,20,5,2,2,1);
		id = window.setInterval(
			function()
			{
				if(typeof steps[counter] == "undefined")
				{
					window.clearInterval(id);
					AnimationInProgress = false;
				}
				else
				{
					div.style.left = Number(div.style.left.replace("px","")) - steps[counter] + "px";
					counter++;
				}
			},5);
		
		firstElement[rowId]++; 
		lastElement[rowId]++;
	}
}

function enlarge(id)
{
	var div = document.getElementById(id);
	div.style.height = "110px";	
	div.style.width = "150px";	
	div.style.marginTop = "0px";
	div.style.marginBottom = "0px";
	div.style.marginLeft = "0px";
	div.style.marginRight = "0px";	
}

function small_down(id)
{
	var div = document.getElementById(id);
	div.style.height = "100px";
	div.style.width = "140px";	
	div.style.marginTop = "5px";
	div.style.marginBottom = "5px";
	div.style.marginLeft = "5px";
	div.style.marginRight = "5px";	
}

var visibleImgId = new Array();
AnimationInProgress2 = false;

function showImg(rowId, img_id)
{
	if(AnimationInProgress2 == true)
	{
		return;
	}
	
	AnimationInProgress2 = true;

	var imgOld = document.getElementById(visibleImgId[rowId]);
	var divOld = document.getElementById("div" + visibleImgId[rowId]);
	
	var img = document.getElementById(img_id);	
	var div = document.getElementById("div" + img_id);
	
	if(img_id == visibleImgId[rowId])
	{
		AnimationInProgress2 = false;
		return;
	}
	
	div.style.display = 'block';	
	divOld.style.zIndex = 1;
	div.style.zIndex = 2;
	
	var counter = 0;
	var op = 0;
	var op2 = 0;

	img.style.filter = "alpha(opacity=" + op + ")";
	img.style.opacity = op2;

	if(browser == "ie")
	{
		time = 10;
		count = 10;
		inc1 = 10;
		inc2 = 0.1;
	}
	else
	{
		time = 10;
		count = 20;
		inc1 = 5;
		inc2 = 0.05;
	}
	
	timer = window.setInterval(
		function()
		{
			if(counter < count)
			{
				op += inc1;
				op2 += inc2;
				img.style.filter = "alpha(opacity=" + op + ")";
				img.style.opacity = op2;
				counter++;
			}
			else
			{
				imgOld.style.opacity = null;
				img.style.opacity = null;
				img.style.filter = null;
				imgOld.style.filter = null;
				window.clearInterval(timer);
				divOld.style.display = 'none';
				AnimationInProgress2 = false;
			}
		},time);
		
	visibleImgId[rowId] = img_id;
}