<?php 
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php"); 
    require_once ("Includes/connectDB.php");
    include ("Includes/header.php");
	$table_no = $_GET['table_req'];
	$blind = $_GET['playable'];
	
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
	
	
	
	if($row["cre_id"] == $_SESSION["userid"] AND $row["turn"]%2==0){
		$sym = 1;
		$blind = 1;
		echo "your turn";
	}
	if($row["join_id"] == $_SESSION["userid"] AND $row["turn"]%2==1){
		$sym = 2;
		$blind = 1;
		echo "your turn";
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
			for($W=1;$W<=3;$W++){
				echo "<td>";
				if($row["d".(($H*3)+$W)]==0){
					if($blind == 1) echo "<a href=table.php?table_req=".$table_no."&sym=".$sym."&pos=".(($H*3)+$W)."&turn=".($row["turn"]+1).">";
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
		}?>
		</table>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); ?>