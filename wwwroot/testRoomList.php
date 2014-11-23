<?php
	include ("Includes/header.php");
	$sql = "SELECT * FROM lobby";
	$result = $databaseConnection->query($sql);
	if ($result->num_rows > 0) {
		echo "<table><tr><td>Room's name</td><td>Creator</td><td>Player</td></tr>";
		while($row = $result->fetch_assoc()) {
			if($row["join_id"] == NULL)
				$np = 1;
			else 
				$np = 2;
			echo "<ol class='round'><li><h5>Room's name : ". $row["name"] ."</h5> ";
			if($np==1) 
				echo "<a href='table.php?table_req=". $row["id"] ."&playable=2'>";
			echo "join (".$np."/2)";
			if($np==1) 
				echo "</a>";
			echo "<br><a href='table.php?table_req=". $row["id"] ."&playable=0'>view/resume</a>";
			echo "<br>Creator : ". $row["cre_name"];
			echo "</li></ol>";
		}
	} else {
		echo "NO room now. Let's create room";	
	}
	?>
	</div>
</div> <!-- End of outer-wrapper which opens in header.php -->