<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");
    $success = $usernameErr = $nameErr = $passErr = "";
    if (isset($_POST['submit'])){
        if(empty($_POST["name"]) || empty($_POST["username"]) || empty($_POST["password"])){
            echo"<script>alert(\"Some required field is missing.\");</script>";
        }else if(strlen($_POST["password"]) < 8){
            $passErr = "password must have at least 8 character.";
        }
        else{
            $isError = 0;
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT name FROM users WHERE name = '".$name."'";
            $objResult = $databaseConnection->query($query);
            if($objResult->num_rows > 0){
                $nameErr = "This display name is already in used.";
                $isError = 1;
            }
            $query = "SELECT username FROM users WHERE username = '".$username."'";
            $objResult = $databaseConnection->query($query);

            if($objResult->num_rows > 0){
                $usernameErr = "This username is already in used.";
                $isError = 1;
            }
            if($isError != 1){
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
                    $success = "Registration success!";
                }
                else
                {
                    echo "Failed registration";
                }
            }
        }
    }
?>
<div id="main">
    <h2>Register an account</h2>
    <p><?php echo $success;?></p>
        <form action="register.php" method="post">
            <fieldset>
                <legend>Register an account</legend>
                <ol>
                    <li>
                        <label for="name">Display name: *</label>
                        <input type="text" name="name" value="" id="name" />
                        <label class="error"><?php echo $nameErr;?></label>
                    </li>
                    <li>
                        <label for="username">Username: *</label>
                        <input type="text" name="username" value="" id="username" />
                        <label class="error"><?php echo $usernameErr;?></label>
                    </li>
                    <li>
                        <label for="password">Password: * (not less than 8 character)</label>
                        <input type="password" name="password" value="" id="password" />
                        <label class="error"><?php echo $passErr;?></label>
                    </li>
                </ol>
                <input type="submit" name="submit" value="Submit" />
                <p>
                    <a href="index.php">Cancel</a>
                </p>
            </fieldset>
        </form>
     </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>