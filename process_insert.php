<?php
session_start();
$DBHOST = "localhost";
$DBNAME = "web_development";
$DBUSER = $_SESSION["name"];
$DBPASSWD = $_SESSION["pass"];
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD, $DBNAME);
if(mysqli_connect_errno()) {
	die(mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_SESSION["table"]=="Authors"){
		$table = $_SESSION["table"];
		$id = $_POST["id"];
		$name = $_POST["name"];
		$surname = $_POST["surname"];
		$nationality = $_POST["natio"];
		$date = $_POST["date"];		
		$sql = "INSERT INTO $table (ID, Name, Surname, Nationality, DateOfBirth) VALUES ($id, '$name', '$surname', '$nationality', '$date')";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} 	
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		echo "<h1>Insert</h1>";
		
		echo "<h3>1 author inserted into database.</h3> <br><br>";
		
		echo "<a href='http://127.0.0.1/select_action.php/'>
			  <input type='button' value='New Action' />
			  </a>";
		echo "<a href='http://127.0.0.1/login.html' >
			  <input type='button' value='Logout' />
			  </a>";
	}
	elseif ($_SESSION["table"]=="Books"){
		$table = $_SESSION["table"];
		$isbn = $_POST["isbn"];
		$title = $_POST["title"];
		$id = $_POST["authorid"];
		$copy = $_POST["copyyear"];
		$publisher = $_POST["publisher"];		
		$sql = "INSERT INTO $table (ISBN, Title, AuthorID, CopyrightYear, Publisher) VALUES ($isbn, '$title', $id, '$copy', '$publisher')";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} 	
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		echo "<h1>Insert</h1>";		
		echo "<h3>1 book inserted into database.</h3> <br><br>";		
		echo "<a href='http://127.0.0.1/select_action.php/'>
			  <input type='button' value='New Action' />
			  </a>";
		echo "<a href='http://127.0.0.1/login.html' >
			  <input type='button' value='Logout' />
			  </a>";
	}
}
?>