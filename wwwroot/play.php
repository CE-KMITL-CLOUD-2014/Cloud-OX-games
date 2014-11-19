<?php 
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php"); 
    require_once ("Includes/connectDB.php");
    include ("Includes/header.php");

	
	if (isset($_POST['Create']))
    {
        $r_name = $_POST['r_name'];
		$cre_name = $_SESSION['name'];
		$cre_id = $_SESSION['userid'];
		
		$query = "INSERT INTO lobby (cre_id,cre_name,name) VALUES (?,?,?)";

        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('sss',$cre_id,$cre_name, $r_name);
        $statement->execute();
        $statement->store_result();
		
		$sql = "SELECT * FROM lobby where cre_id =".$_SESSION['userid']."  order by id DESC";
		$result = $databaseConnection->query($sql);
		$row = $result->fetch_assoc();
		header("Location: http://e12bg.azurewebsites.net/table.php?table_req=".$row['id']);

    }
	
    if (!isset($_SESSION['userid'])){
		echo "You must register and Login";
	}
	else{
        echo "<div id ='main'><h2>List of room</h2>";
		$sql = "SELECT * FROM lobby";
		$result = $databaseConnection->query($sql);
		if ($result->num_rows > 0) {
		// output data of each row
		//	echo "<table><tr><td>Room's name</td><td>Creator</td><td>Player</td></tr>";
			while($row = $result->fetch_assoc()) {
				if($row["join_id"] == NULL) $np = 1;
				else $np = 2;
				echo "<ol class='round'><li><h5>Room's name : ". $row["name"] ."</h5> ";
				if($np==1) echo "<a href='table.php?table_req=". $row["id"] ."&playable=2'>";
				echo "join (".$np."/2)";
				if($np==1) echo "</a>";
				echo "<br><a href='table.php?table_req=". $row["id"] ."&playable=0'>view/resume</a>";
				echo "<br>Creator : ". $row["cre_name"];
				echo "</li></ol>";
				//echo "<tr><td>" . $row["name"]. "</td><td>" .$row["cre_id"]. "</td><td>".$row["join_id"]."</td></tr>";
			}
		} else {
			echo "NO room now. Let's create room";
		}
	}
?>
<?
if(isset($_SESSION['userid'])){
	echo "
	<h2>Create room</h2>
        <form action='play.php' method='post'>
            <fieldset>
            <legend>Log on</legend>
            <ol>
                <li>
                    <label for='name'>Room name:</label>
                    <input type='input' name='r_name' value='' id='r_name' />
                </li>
            </ol>
            <input type='Submit' name='Create' value='Create' />
        </fieldset>
    </form>";
}
?>
	</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); ?>