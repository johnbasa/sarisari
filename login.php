<?php 

	echo "form received";


	$username = $_POST['username'];
	$password = $_POST['password'];

	echo "Username: $username and Password: $password <br>";

	$server = "localhost";
	$mysqluser = "root";
	$mysqlpass = "";
	$mysqldb = "sarisari";

	$conn = mysqli_connect($server,$mysqluser,$mysqlpass,$mysqldb);

	if(!$conn)
	{
	  die("Failed to connect to MySQL----: " . mysqli_connect_error() );
	 
	}else{
		$statement = "SELECT * FROM users WHERE username='$username' AND password='$password'";

		echo "statement =  $statement <br>";

		$result = mysqli_query($conn,$statement);
		echo "result is:";
		print_r($result);
		
		if($row = mysqli_fetch_assoc($result) ){	//true if there is atleast 1 row from the result
			echo "<br> ROW: " . $row['username'] . " AND  " . $row['password'] . " role: " . $row['role'] . "<br>";

			//save to session: id,username and role information

			session_start(); 	//use whenever we want to use a session. 
			$_SESSION['userid_sess'] = $row['id'];	//store in the session the id field from db
			$_SESSION['username_sess'] = $row['username'];
			$_SESSION['role_sess'] = $row['role'];

			header("location:home2.php");

		}else{
			echo "<br>No results found";
			header("location:home2.php");
		}

	}
 ?>