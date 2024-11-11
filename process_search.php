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
	echo "<h1>Search Results</h1>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$term = $_POST["term"];
	$search = $_POST["input"];
	if ($_SESSION["table"]=="Authors"){
		$sql = "SELECT ID, Name, Surname, Nationality, DateOfBirth FROM authors WHERE $term = '$search'";
		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$result=$stmt->get_result();
		$i=1;
		$rowcount = mysqli_num_rows($result);
		echo "<h2>Number of authors found:", $rowcount,"</h2>";		
		while ($row = $result->fetch_assoc())  {
			echo "<br>";
			echo "<strong>",$i,". Author ID: ",$row["ID"],"</strong><br>" ;
			echo "Name: ",$row["Name"],"<br>";
			echo "Surname: ",$row["Surname"],"<br>";
			echo "Nationality: ",$row["Nationality"],"<br>";
			echo "Date Of Birth: ",$row["DateOfBirth"],"<br><br>";
			$i++;
		}
	}
	elseif ($_SESSION["table"]=="Books"){
		$sql = "SELECT ISBN, Title, AuthorID, CopyrightYear, Publisher FROM books WHERE $term = '$search'";
		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$result=$stmt->get_result();
		$i=1;
		$rowcount = mysqli_num_rows($result);
		echo "<h2>Number of books found:", $rowcount,"</h2>";		
		while ($row = $result->fetch_assoc())  {
			echo "<br>";
			echo "<strong>",$i,". ISBN: ",$row["ISBN"],"</strong><br>" ;
			echo "Title: ",$row["Title"],"<br>";
			echo "AuthorID: ",$row["AuthorID"],"<br>";
			echo "CopyrightYear: ",$row["CopyrightYear"],"<br>";
			echo "Publisher: ",$row["Publisher"],"<br><br>";
			$i++;
		}
	}
	echo "<a href='http://127.0.0.1/select_action.php/'>
			  <input type='button' value='New Action' />
			  </a>";
	echo "<a href='http://127.0.0.1/login.html' >
			<input type='button' value='Logout' />
			</a>";		
}

?>