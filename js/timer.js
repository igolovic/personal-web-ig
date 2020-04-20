var revolve_timer;

function stopRevolve()
{
	window.clearInterval(revolve_timer);
	delete revolve_timer;
}

function typing()
{
	var countWaiting = 50;
	message = messages.shift();	
	messages.push(message);
	var divLetters = document.getElementById('divLetters2');
	var letterCounter = 0;
	var countBlinkingWaiting = 0;
	var write = true;
	var fade = false;

window.setInterval(
function()
{
	if(fade)
	{
		if(divLetters.style.top == "-34px")
		{
			fade = false;
			divLetters.innerHTML = "";
			divLetters.style.top = "0px";
		}else
		{
			divLetters.style.top = divLetters.style.top.replace("px","") - 1 + "px";
		}
		return;
	}
	if(countWaiting < 100)
	{ 
		countWaiting +=50; 
		return;
	}
				
	if(message.charAt(letterCounter) == ' ')
	{
		divLetters.innerHTML = divLetters.innerHTML.substring(0,divLetters.innerHTML.indexOf('_'));	
		divLetters.innerHTML = divLetters.innerHTML + message.charAt(letterCounter) + '_';
		letterCounter++;
		countWaiting = -50;
		return;
	}
	if(write)
	{
		divLetters.innerHTML = divLetters.innerHTML.substring(0,divLetters.innerHTML.indexOf('_'));	
		divLetters.innerHTML = divLetters.innerHTML + message.charAt(letterCounter) + '_';
		letterCounter++;
		countWaiting = 50;				
	}
	// end of message reached, do blinking
	if((letterCounter - 1) == message.length)
	{
		// do blinking
		if(countBlinkingWaiting < 9)
		{
			if(divLetters.innerHTML.charAt(divLetters.innerHTML.length - 1) == '_')
			{						
				divLetters.innerHTML = divLetters.innerHTML.slice(0, divLetters.innerHTML.length - 1);
				divLetters.innerHTML = divLetters.innerHTML + ' ';							
			}	
			else
			{
				divLetters.innerHTML = divLetters.innerHTML.slice(0, divLetters.innerHTML.length - 1);
				divLetters.innerHTML = divLetters.innerHTML + '_';
			}
			countWaiting = -50;
			countBlinkingWaiting++;
			write = false;
		}
		else	// finish blinking
		{
			countBlinkingWaiting = 0;
			countWaiting = 50;				
			write = true;
			letterCounter = 0;
			message = messages.shift();	
			messages.push(message);
			fade = true;
		}
	}
},40);
}

function revolve(){var b=document.getElementById("divN");var c=document.getElementById("divC");var a=parseInt(c.style.top);revolve_timer=window.setInterval(function(){if(a==(b.clientHeight!=0?-b.clientHeight:-340)){a=1;}a-=1;c.style.top=a+"px";},30);}