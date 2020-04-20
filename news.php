<div id="divC" style="height:340px;width:160px;position:absolute;top:0px;"><div id="divN" style="padding:0px; margin:0px;">
<?php
		$newsResult->data_seek(0);
		$count = $newsResult->num_rows;
		
		for($i = 0; $i < $count; $i++)
		{
			$row = $newsResult->fetch_array();
			echo '<div class="rd"><br />';
			echo '<span style="font-weight:bold">'.$row["title"].'</span><br /><br />';
			echo $row["description"];
			echo '<br /><br /><a target="_blank" class="rl" href="'.$row["link"].'">'.$row["linktext"].'</a></div>';
		}		
?>
</div><div id="divN2" style="padding:0px; margin:0px;">
<?php
		$newsResult->data_seek(0);
		$count = $newsResult->num_rows;
		
		for($i = 0; $i < $count; $i++)
		{
			$row = $newsResult->fetch_array();
			echo '<div class="rd"><br />';
			echo '<span style="font-weight:bold">'.$row["title"].'</span><br /><br />';
			echo $row["description"];
			echo '<br /><br /><a target="_blank" class="rl" href="'.$row["link"].'">'.$row["linktext"].'</a></div>';
		}		
?>			
</div></div>
