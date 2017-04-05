<?php
	include "connect_to_db.php";
	$query= 'select distinct name from team';
	$result = mysqli_query($con , $query);  
	while($team = mysqli_fetch_array($result , MYSQLI_ASSOC))
	{
	    $team_name=$team['name'];
	    echo"<div class='box'><a href='team_info.php?t_name=$team_name' class='btn btn-default btn-lg' style='margin: 5px; width: 98%;'>".$team_name."</a> </div>";
	}
?>