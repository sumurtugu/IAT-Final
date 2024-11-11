<?php	
	session_start();
    $name = $_SESSION["name"];
	$pass = $_SESSION["pass"];
?>
<!DOCTYPE html>
<html>
<head lang ="en">
    <title>Select Action</title>
    <meta charset="utf-8" />
</head>
<body>    
    <form method="post" action="http://127.0.0.1/process_action.php">    
    <h1>Select action</h1>
    <p>Current user: <?php echo $name;?> </p> <br>
    <label>Select Action</label> <br>
    <select name="sel">
        <option value="Search">Search</option> 
        <option value="Insert">Insert</option>
    </select> <br><br>
    <label>Select Table</label> <br> 
    <select name="table">
        <option>Authors</option>
        <option>Books</option>
    </select> <br><br><br>    
    <input type='submit' name="Search" value='Next'/>
    </form>
</body>
</html>

