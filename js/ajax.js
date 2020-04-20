function sendAjaxComment()
{
	var xmlhttp;
	if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		alert("whooops... vaš preglednik ne podržava AJAX :(");
	}
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4)
		{
			document.getElementById("displayComments").innerHTML = xmlhttp.responseText;
			document.getElementById("inpAuthor").value = "";
			document.getElementById("inpComment").value = "";
			document.getElementById("divCount").innerHTML = "700 znakova na raspolaganju";
		}
	}
	
	var params = "author=" + encodeURIComponent(document.getElementById("inpAuthor").value) + "&comment=" + encodeURIComponent(document.getElementById("inpComment").value)  + "&lang=" + encodeURIComponent(lang);
	
	xmlhttp.open("POST","get_comments.php",true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(params);
}

function sendAjaxPoll(grade)
{
	var xmlhttp;
	if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		alert("whooops... vaš preglednik ne podržava AJAX :(");
	}
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4)
		{
			var data = xmlhttp.responseText.split("|");
			document.getElementById("realResults").innerHTML = xmlhttp.responseText;
			document.getElementById("lbVotesCount").innerHTML = data[1];
			document.getElementById("lbGrade").innerHTML = data[2];
			document.getElementById("lbPollMsg").innerHTML = (lang == "cro" ? "Hvala na vašem glasu!<br />" : "Thank you for voting!<br />");
			notify(alString, (lang == "cro" ? "Vaš glas je upisan, hvala!" : "Your vote has been registered, thank you!"));
		}
	}
	
	var params = "grade=" + encodeURIComponent(grade);
	
	xmlhttp.open("POST","site_poll.php",true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(params);
}

function sendAjaxCalendar(month)
{
	var xmlhttp;
	if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		alert("whooops... vaš preglednik ne podržava AJAX :(");
	}
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4)
		{
			document.getElementById("tdCal").innerHTML = xmlhttp.responseText;
		}
	}
	
	if(month == "-")
	{
		calendarMonth -= 1; 
	}
	else
	{
		calendarMonth += 1;
	}
	
	var params = "month=" + encodeURIComponent(calendarMonth) + "&lang=" + lang;
	
	xmlhttp.open("POST","calendar.php",true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(params);
}

function sendAjaxPassCheck()
{
	var xmlhttp;
	if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		alert("whooops... vaš preglednik ne podržava AJAX :(");
	}
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4)
		{		
			if(xmlhttp.responseText == "1")
			{			
				window.open("admin/front.php","_self"); 					
			}
			else
			{
				notify(alString, badLogin);
			}
		}
	}
	
	var params = "user=" + encodeURIComponent(document.getElementById("inpUser").value) + "&pass=" + encodeURIComponent(document.getElementById("inpPass").value) ;
	
	xmlhttp.open("POST","check_pass.php",true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(params);

}

function getAjaxPageSection(id)
{
	var xmlhttp;
	if(window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
	}
	
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4)
		{			
			var data = xmlhttp.responseText.split("&&");
			document.getElementById("divMainContent").innerHTML = data[0];
			if(typeof data[1] != "undefined")
			{
				eval(data[1]);			
			}
			var tdTitle = document.getElementById("tdTitle");
			switch(currentlyVisible)
			{
				case "Homepage":
					tdTitle.innerHTML = frontpage;
					document.getElementById("pageTop").style.display = "block";	
				break;
				
				case "Technical":
					tdTitle.innerHTML = technicalDetails;
					document.getElementById("pageTop").style.display = "block";	
				break;
				case "MyData":
					tdTitle.innerHTML = cv;
					document.getElementById("pageTop").style.display = "block";	
				break;
				case "Leisure":
					tdTitle.innerHTML = leisure;
					document.getElementById("pageTop").style.display = "block";	
				break;
				case "FavProgram":
					tdTitle.innerHTML = favprogs;
					document.getElementById("pageTop").style.display = "block";	
				break;
				case "FavLinks":
					tdTitle.innerHTML = favlinks;
					document.getElementById("pageTop").style.display = "block";	
				break;
				case "Guestbook":
					tdTitle.innerHTML = guestbook;
					document.getElementById("pageTop").style.display = "block";	
				break;
				case "Cf":
					document.getElementById("pageTop").style.display = "none";	
					tdTitle.innerHTML = contactForm;
				break;
			}

			showHideLoader(false);
		}
	}
	
	xmlhttp.open("GET","menu_command_handler.php?command="+id+(lang == "eng" ? "&lang=eng" : ""),true);
	xmlhttp.send(null);
}

function sendAjaxContactForm()
{
	var xmlhttp;
	if(window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
	}

	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4)
		{				
			var el = document.getElementById("cfNotify");
			el.style.display = "block";			
			el.innerHTML = xmlhttp.responseText;
			showHideLoader(false);
		}
	}
	
	var params = "author=" + encodeURIComponent(document.getElementById("inpAuthor").value) + 
				 "&comment=" + encodeURIComponent(document.getElementById("inpComment").value) + 
				 "&mail=" + encodeURIComponent(document.getElementById("inpMail").value) +
				 "&lang=" + encodeURIComponent(cfSent);
	
	xmlhttp.open("POST","send_contact_form.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	xmlhttp.send(params);
}

function sendAjaxSearch()
{
	var xmlhttp;
	if(window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
	}
	
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4)
		{
			document.getElementById("alText2").innerHTML = xmlhttp.responseText;
			showHideLoader(false);
		}
	}
	
	var params = "words=" + encodeURIComponent(document.getElementById("inpSearch").value);
	xmlhttp.open("POST", "search.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	xmlhttp.send(params);
}