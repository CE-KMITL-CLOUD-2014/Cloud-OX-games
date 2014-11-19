<?php 
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php"); 
    require_once ("Includes/connectDB.php");
    include ("Includes/header.php");
	$table_no = $_GET['table_req'];

    if (isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
		$blind = $_GET['playable'];

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
?>
<div id="main">
    <h2>Play</h2>
        <table>
		<?
		$sql = "SELECT * FROM lobby WHERE id = '".$table_no."'";
		$result = $databaseConnection->query($sql);
		$row = $result->fetch_assoc();
		for($H=0;$H<3;$H++){
			echo "<tr>";
			for($W=0;$W<3;$W++){
				echo "<td>";
				if($row["d".(($H*3)+$W)]==0){
					if($blind == 1) echo "<a href=table.php?table_req=".$table_no.">";
					echo "<img src='bg.png'".(($H*3)+$W).">";
					if($blind == 1) echo "</a>";}
				else if($row["d".(($H*3)+$W)]==1){
					echo "<img src='bg_cir.png'>";}
				else if($row["d".(($H*3)+$W)]==2){
					echo "<img src='bg_cross.png'>";}
				echo "</td>";
			}
			echo "</tr>";
		}?>
		</table>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); ?>