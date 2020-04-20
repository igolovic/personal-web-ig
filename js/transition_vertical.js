var SelectedDivId = "aboutme";
var AnimationCount = 0;

function show(id)
{
	if(SelectedDivId == id)
	{
		return;
	}
	
	if(AnimationCount == 0)
	{
		AnimationCount++;
	
		var oldSelectedDivId = SelectedDivId;			
		SelectedDivId = id;
					
		var animatedClosingDiv = document.getElementById('div' + oldSelectedDivId);
		var closingHeight = parseInt(animatedClosingDiv.style.height);
		var animatedDiv = document.getElementById('div' + id);			
		var height = parseInt(animatedDiv.style.height);

		if(browser != "ie")
		{
			var a = Array(15,15,15,15,15,5,4,4,2,2,2,2,2,2,1,1);
			var t = 30;
		}
		else
		{
			var a = Array(16,16,16,15,15,7,5,4,3,2,1);
			var t = 25;
		}
		
		var counter=0;				
		var intId = window.setInterval(
			function()
			{				
				if(height < 100)
				{   
					height = height + a[counter];
					animatedDiv.style.height = height + 'px';
					closingHeight = closingHeight - a[counter];
					animatedClosingDiv.style.height = closingHeight + 'px';
				}
				else
				{			
					AnimationCount--;								        								
					window.clearInterval(intId);	
				}
				counter++;				
			},t);
	}
}