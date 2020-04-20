function handleClick(action, id, id2, value)
{
	var inpAction = document.getElementById("inpAction");
	inpAction.value = action;
	
	var inpId = document.getElementById("inpId");
	inpId.value = id;
	
	if(id2 != null)
	{
		var inpId2 = document.getElementById("inpId2");
		inpId2.value = id2;
	}

	var inpValue = document.getElementById("inpValue");
	inpValue.value = value;
			
}