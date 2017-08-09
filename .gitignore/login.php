<?php
session_start();
// Check Connection
include("config.php");

if (isset($_GET["logout"])) {
	// remove all session variables
		session_unset(); 
	// destroy the session 
		session_destroy();
	echo "You have logged Out !";
}

if (isset($_POST["username"])) {

	// Get data from form
		$username = $_POST["username"];
		$form_password = $_POST["password"];

	// Select data from table
		$sql = "SELECT password, username FROM login WHERE username='$username'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        $username = $row["username"];
		        $db_password = $row["password"];
		    }
		} else {
		    echo "No Records Found";
		}

	// Validate password and create session
		if ($form_password==$db_password) {
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $db_password;
				header("location: index.php");
			}

		
		else{
			echo "Username or Password Incorrect !, Retry";
		}

}

// Close connection
mysqli_close($conn);
?>

<form action="login.php" method="post">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  <input type="submit" value="Submit">
</form>

