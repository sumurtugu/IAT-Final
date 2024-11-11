<?php
	session_start();	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$selection = $_POST["sel"];
		$_SESSION["table"] = $_POST["table"];
		if($selection == "Search") {
			$DBHOST = "localhost";
			$DBNAME = "web_development";
			$DBUSER = $_SESSION["name"];
			$DBPASSWD = $_SESSION["pass"];
			$connect = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD, $DBNAME);
			if(mysqli_connect_errno()) {
				die(mysqli_connect_error());
			}
			if ($_SESSION["table"]=="Authors"){
			echo "<h1>Catalog search for table ", $_SESSION["table"]," </h1> <br>";
			echo "<form method='post' action='http://127.0.0.1/process_search.php'>";
			echo "<label>Choose search type: <br>";
			echo "<select name='term'>
					<option value='ID'>ID</option>
					<option value='Name'>Name</option>
					<option value='Surname'>Surname</option>
					<option value='Nationality'>Nationality</option>
					<option value='DateOfBirth'>Date Of Birth</option>
				  </select> <br><br>";
			echo "Enter search term: <br>";			
			echo "<input type='text' name='input'/> <br><br>";
			echo "<input type='submit' name='search' value='Next'/>";
			echo "</form>";
			}
			elseif ($_SESSION["table"]=="Books"){				
			echo "<h1>Catalog search for table ", $_SESSION["table"]," </h1> <br>";
			echo "<form method='post' action='http://127.0.0.1/process_search.php'>";
			echo "<label>Choose search type: <br>";
			echo "<select name='term'>
					<option value='ISBN'>ISBN</option>
					<option value='Title'>Title</option>
					<option value='AuthorID'>AuthorID</option>
					<option value='CopyrightYear'>CopyrightYear</option>
					<option value='Publisher'>Publisher</option>
				  </select> <br><br>";
			echo "Enter search term: <br>";			
			echo "<input type='text' name='input'/> <br><br>";
			echo "<input type='submit' name='search' value='Next'/>";
			echo "</form>";			
			}
		}
		elseif($selection == "Insert") {
			$DBHOST = "localhost";
			$DBNAME = "web_development";
			$DBUSER = $_SESSION["name"];
			$DBPASSWD = $_SESSION["pass"];
			$connect = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD, $DBNAME);
			if(mysqli_connect_errno()) {
				die(mysqli_connect_error());
			}
			if ($_SESSION["table"]=="Authors"){
				echo "<h1>Catalog insert for table ", $_SESSION["table"]," </h1> <br>";
				echo "<form method='post' action='http://127.0.0.1/process_insert.php'>";
				echo "AuthorID   ";
				echo "<input type='text' name='id'/> <br> <br>" ;
				echo "Name   ";
				echo "<input type='text' name='name'/><br> <br>";
				echo "Surname   ";
				echo "<input type='text' name='surname'/><br> <br>";
				echo "Nationality   ";
				echo "<input type='text' name='natio'/><br> <br>";
				echo "DateofBith   ";
				echo "<input type='date' name='date'/><br> <br>";
				echo "<input type='submit' value='Insert'/>";
				echo "</form>";
			}
			elseif ($_SESSION["table"]=="Books"){
				echo "<h1>Catalog insert for table ", $_SESSION["table"]," </h1> <br>";
				echo "<form method='post' action='http://127.0.0.1/process_insert.php'>";
				echo "ISBN   ";
				echo "<input type='text' name='isbn'/> <br> <br>" ;
				echo "Title  ";
				echo "<input type='text' name='title'/><br> <br>";
				echo "AuthorID   ";
				echo "<input type='text' name='authorid'/><br> <br>";
				echo "Copyright Year   ";
				echo "<input type='text' name='copyyear'/><br> <br>";
				echo "Publisher   ";
				echo "<input type='text' name='publisher'/><br> <br>";
				echo "<input type='submit' value='Insert'/>";
				echo "</form>";
			}
		}
	}
?>