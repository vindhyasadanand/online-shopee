<?php

$errors = array();

//Connecting to database
$db = mysqli_connect('localhost', 'root', '', 'demo');

//Log in user from existing user page
if(isset($_POST['click']))
{
	session_start();

	$firstname = $_POST['uname'];
	$password = $_POST['pasword'];

	//Ensure form fields are properly filled
	if(empty($firstname))
		array_push($errors, "Username is required");
	if(empty($password))
		array_push($errors, "Password is required");

	if(count($errors) == 0)
	{
		$_SESSION['firstname'] = $firstname;
		$query = "SELECT * FROM admin WHERE name='{$_SESSION['firstname']}' and password='$password' ";
		$result = mysqli_query($db, $query);
		//resultant tuples in result
		$row = mysqli_fetch_assoc($result);
		$_SESSION['adminid']=$row['id'];
         $_SESSION['username']=$firstname;
		if(mysqli_num_rows($result) == 1)
		{ // if matching no of rows is 1
            // echo"hi".$_SESSION['username'];
			//header('location: img2.php');
			echo "<script>
           alert('welcome $firstname');
            window.location.href='view.php';
            </script>";
		}
		else
			echo"<script>
           alert('incorrect password');
            window.location.href='admin.html';
            </script>";
			//array_push($errors, "Wrong Name/Password");
	}
}

?>