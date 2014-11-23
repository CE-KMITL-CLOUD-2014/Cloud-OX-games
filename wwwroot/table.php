<?php 
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php"); 
    require_once ("Includes/connectDB.php");
    include ("Includes/header.php");
	$table_no = $_GET['table_req'];
	$blind = $_GET['playable'];
	$win = 0;
	
	if($_GET['sym'] == 2 OR $_GET['sym'] == 1){
		$query = "UPDATE lobby SET d".$_GET['pos']." = '".$_GET['sym']."' , turn ='".($_GET['turn']+1)."' WHERE id ='".$table_no."'";
        $statement = $databaseConnection->query($query);
	}
	
	//echo $query;
	if($blind == 2){
		$query = "UPDATE lobby SET join_id = ".$_SESSION['userid'].", join_name ='".$_SESSION['name']."' WHERE id ='".$table_no."'";
        $statement = $databaseConnection->query($query);
		echo "joined";
	}
	
	$sql = "SELECT * FROM lobby WHERE id = ".$table_no;
	$result = $databaseConnection->query($sql);
	$row = $result->fetch_assoc();
	//echo $row["id"];
	//echo $row["cre_name"];
	//echo $row["join_name"];
	
	
	
	if($row["cre_id"] == $_SESSION["userid"]){
		$sym = 1;
		if($row["turn"]%2==0){
			$blind = 1;
			echo "your turn";
		}
		else{
			echo "please wait for other player";
		}
	}
	if($row["join_id"] == $_SESSION["userid"]){
		$sym = 2;
		if($row["turn"]%2==1){
		$blind = 1;
		echo "your turn";
		}
		else{
			echo "please wait for other player";
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
		
		if($win == 1 AND $sym == 1) echo"<tr><td><h1>You Win</h1> <a href='http://e12bg.azurewebsites.net/play.php'>back to home</a></td></tr>";
		else if($win == 1 AND $sym == 2) echo"<tr><td><h1>You Lose</h1> <a href='http://e12bg.azurewebsites.net/play.php'>back to home</a></td></tr>";
		else if($win == 2 AND $sym == 1) echo"<tr><td><h1>You Lose</h1> <a href='http://e12bg.azurewebsites.net/play.php'>back to home</a></td></tr>";
		else if($win == 2 AND $sym == 2) echo"<tr><td><h1>You Win</h1> <a href='http://e12bg.azurewebsites.net/play.php'>back to home</a></td></tr>";
		else if($row["turn"]>=9) echo"<tr><td><h1>DRAW</h1> <a href='http://e12bg.azurewebsites.net/play.php'>back to home</a></td></tr>";
		else{
		for($H=0;$H<3;$H++){
			echo "<tr>";
			for($W=1;$W<=3;$W++){
				echo "<td>";
				if($row["d".(($H*3)+$W)]==0){
					if($blind == 1) echo "<a href=table.php?table_req=".$table_no."&sym=".$sym."&pos=".(($H*3)+$W)."&turn=".$row["turn"].">";
					echo "<img src='bg.png'".(($H*3)+$W).">";
					if($blind == 1) echo "</a>";
					}
				else if($row["d".(($H*3)+$W)]==1){
					echo "<img src='bg_cir.png'>";}
				else if($row["d".(($H*3)+$W)]==2){
					echo "<img src='bg_cross.png'>";}
				echo "</td>";
			}
			echo "</tr>";
		}}?>
		</table>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); 
header("Refresh: 2;url='http://e12bg.azurewebsites.net/table.php?table_req=".$table_no."'");?>