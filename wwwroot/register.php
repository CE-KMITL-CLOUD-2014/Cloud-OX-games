<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php"); 

    if (isset($_POST['submit'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "INSERT INTO users (name,username, password) VALUES (?,?,?)";

        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('sss',$name,$username, $password);
        $statement->execute();
        $statement->store_result();
		
		$sql = "SELECT * FROM users WHERE username = '".$username."'";
        $result = $databaseConnection->query($sql);
        if ($result->num_rows > 0)
        {
			$row = $result->fetch_assoc();
            $_SESSION['userid'] = $row["id"];
            $_SESSION['name'] = $name;
        }
        else
        {
            echo "Failed registration";
        }
    }
?>
<div id="main">
    <h2>Register an account</h2>
        <form action="register.php" method="post">
            <fieldset>
                <legend>Register an account</legend>
                <ol>
                    <li>
                        <label for="name">Display name:</label> 
                        <input type="text" name="name" value="" id="name" />
                    </li>
                    <li>
                        <label for="username">Username:</label> 
                        <input type="text" name="username" value="" id="username" />
                    </li>
                    <li>
                        <label for="password">Password:</label>
                        <input type="password" name="password" value="" id="password" />
                    </li>
                </ol>
                <input type="submit" name="submit" value="Submit" />
                <p>
                    <a href="index.php">Cancel</a>
                </p>
            </fieldset>
        </form>
     </div>
     <div id ="show"><?
     $sql = "SELECT * FROM users";
     $result = $databaseConnection->query($sql);
       if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
     echo "name: " . $row["name"]. " - username: " . $row["username"]. "<br>";
     }
     } else {
     echo "0 results";
     }?>
     </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>