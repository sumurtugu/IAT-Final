<?php    
    session_start();  
    $DBHOST = "localhost";
    $DBNAME = "web_development_login";
    $DBUSER = "root";
    $DBPASSWD = "";
    $connect = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD, $DBNAME);	
    if(mysqli_connect_errno()) {
        die(mysqli_connect_error());
    }
	$sql = "SELECT username, password FROM logintable";
	$stmt = $connect->prepare($sql);
	$stmt->execute();
	$result=$stmt->get_result();
	$rowcount = mysqli_num_rows($result);
	$i = 0;
	$flag=0;
	$flagN=0;	
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $attempts = 3;
		$_SESSION["name"]=$_GET['user'];
		$_SESSION["pass"]=$_GET['password'];        
        if (!isset($_SESSION['attempts'])) {
            $_SESSION['attempts'] = $attempts;
        }
        if (!isset($_GET['login'])) {
            while ($row = $result->fetch_assoc())  {
				if ($_SESSION["name"] == $row["username"] && $_SESSION["pass"] == $row["password"]) {
					$flag = 1;
				}
				elseif ($_SESSION["name"] == $row["username"]){
					$flagN = 1;
				}
			}
			if ($flag == 0) {
				if ($flagN == 0){
					echo "<h1>Process login</h1>";
					echo "<h2>User does not exist.</h2>";
					echo "<h2>User is not authenticated. Go back and try again.</h2>";
				} 
				elseif ($_SESSION['attempts']>1) {
					$_SESSION['attempts']-=1;
					echo "<h1>Process login</h1>";
					echo "<h2>Wrong password. Updating wrong login attempts to ", 3-$_SESSION['attempts'],". </h2>";
					echo "<h2>User is not authenticated. Go back and try again.</h2>";
				}
				elseif ($_SESSION['attempts']==1) {					
                    if (!isset($_SESSION['start'])) {
						$_SESSION['start'] = time();
					}
					if (time() - $_SESSION['start'] >= 30) {
						unset($_SESSION['start']);
						unset($_SESSION["attempts"]);
						header('Location: login.html');
					}
					elseif (time() - $_SESSION['start'] < 30) {
						echo "<h1>Process login</h1>";
						echo "<h2>User login is blocked for: ", 30-(time()-$_SESSION['start']), " seconds.</h2>";
						echo "<h2>User is not authenticated. Go back and try again.</h2>";
					}
				}
			}
            if($flag == 1 ) {	
                echo "<form method='get' action='select_action.php'>";             
                echo "<h1>Process login</h1>";
                echo "<h2>User ", $_SESSION["name"], " authenticated </h2>";
                echo "<input type='submit' value='Next'/>";
                echo "</form>";
            }
        }
    }

?>
