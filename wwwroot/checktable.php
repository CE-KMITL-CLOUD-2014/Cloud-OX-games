<?php 
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php"); 
    require_once ("Includes/connectDB.php");
	
	$databaseConnection2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($databaseConnection2->connect_error)
    {
        die("Database selection failed: " . $databaseConnection2->connect_error);
    }
	
	$sql = "DELETE FROM lobby WHERE turn >= 9";
	$result = $databaseConnection->query($sql);
    if ($result === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}
	$win = 0;
	$sql = "SELECT * FROM lobby WHERE id = '".$table_no."'";
	$result = $databaseConnection->query($sql);
	while($row = $result->fetch_assoc()){
		if($row["d1"]==1&&$row["d2"]==1&&$row["d3"]==1) $win = 1;
		if($row["d4"]==1&&$row["d5"]==1&&$row["d6"]==1) $win = 1;
		if($row["d7"]==1&&$row["d8"]==1&&$row["d9"]==1) $win = 1;
		if($row["d1"]==1&&$row["d4"]==1&&$row["d7"]==1) $win = 1;
		if($row["d2"]==1&&$row["d5"]==1&&$row["d8"]==1) $win = 1;
		if($row["d3"]==1&&$row["d6"]==1&&$row["d9"]==1) $win = 1;
		if($row["d1"]==1&&$row["d5"]==1&&$row["d9"]==1) $win = 1;
		if($row["d3"]==1&&$row["d5"]==1&&$row["d7"]==1) $win = 1;
		
		if($row["d1"]==2&&$row["d2"]==2&&$row["d3"]==2) $win = 2;
		if($row["d4"]==2&&$row["d5"]==2&&$row["d6"]==2) $win = 2;
		if($row["d7"]==2&&$row["d8"]==2&&$row["d9"]==2) $win = 2;
		if($row["d1"]==2&&$row["d4"]==2&&$row["d7"]==2) $win = 2;
		if($row["d2"]==2&&$row["d5"]==2&&$row["d8"]==2) $win = 2;
		if($row["d3"]==2&&$row["d6"]==2&&$row["d9"]==2) $win = 2;
		if($row["d1"]==2&&$row["d5"]==2&&$row["d9"]==2) $win = 2;
		if($row["d3"]==2&&$row["d5"]==2&&$row["d7"]==2) $win = 2;
			
		if($win == 1 OR $win == 2){
			$sql = "DELETE FROM lobby WHERE id =".$row["id"];
			$result = $databaseConnection2->query($sql);
			if ($result === TRUE) {
				echo "Record deleted successfully";
			} else {
				echo "Error deleting record: " . $conn->error;
			}
		}
	}
	?>