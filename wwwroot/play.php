<?php 
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php"); 
    require_once ("Includes/connectDB.php");
    include ("Includes/header.php");

	
	if (isset($_POST['Create']))
    {
        $name = $_POST['name'];

        $query = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ss', $username, $password);

        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows == 1)
        {
            //$statement->bind_result($_SESSION['userid'], $_SESSION['username']);
            //$statement->fetch();
			$sql = "SELECT * FROM users WHERE username = '".$username."'";
			$result = $databaseConnection->query($sql);
			$row = $result->fetch_assoc();
            $_SESSION['userid'] = $row["id"];
			$_SESSION['name'] = $row["name"];
			header ("Location: index.php");
        }
        else
        {
            echo "Username/password combination is incorrect.";
        }
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
				//echo "<tr><td>" . $row["name"]. "</td><td>" .$row["cre_id"]. "</td><td>".$row["join_id"]."</td></tr>";
			}
		//	echo "</table>"
		} else {
			echo "NO room now. Let's create room";
		}
	}
?>
    <ol class="round">
        <li >
            <h5>Room's name : </h5>
           The site admin username and password are stored in the config file in the Includes directory. 
        </li>
    </ol>
	
	<h2>Create room</h2>
        <form action="play.php" method="post">
            <fieldset>
            <legend>Log on</legend>
            <ol>
                <li>
                    <label for="name">Room name:</label>
                    <input type="password" name="password" value="" id="password" />
                </li>
            </ol>
            <input type="Submit" name="Create" value="Create" />
        </fieldset>
    </form>
	</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); ?>