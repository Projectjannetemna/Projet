<?php 
session_start();
$username="";
$email="";
$errorrs=array();


//connect database

$db = mysqli_connect('localhost', 'root','','projet');

// if the register button is clicked
if (isset($_POST['register'])) {

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password_1 = $_POST['password_1'];
	$password_2 =$_POST['password_2'];


	if(empty($username)) {
        array_push($errorrs,"username is required");//add error to errors array
	}
	if(empty($email)) {
        array_push($errorrs,"email is required");//add error to errors array
	}

	if(empty($password_1)) {
        array_push($errorrs,"password is required");//add error to errors array
	}
	if(empty($password_2)) {
        array_push($errorrs," confirmation password is required");//add error to errors array
	}
	 if ($password_1 != $password_2) {

	 	array_push($errorrs, "The two password do not much");
	 }

//if there are no errors
	 if (count($errorrs)==0){
	 	
	 	
	 	$sql = "INSERT INTO admin (username ,email ,password) VALUES ('$username', '$email','$password_1')";
	 	mysqli_query($db,$sql);
	 	$_SESSION['username']=$username;
	 	$_SESSION['success']="you are now logged in";
	 	header('location: product-list.php');


echo '<script>alert("member already registred")</script>';
				//echo '<script>window.location="product-list.php"</script>';
	} 


	}


//login
	if(isset($_POST['login']))
	{
	$username = $_POST['username'];
	
	$password_1 =$_POST['password_1'];

if(empty($username)) {
        array_push($errorrs,"username is required");//add error to errors array
	}
	if(empty($password_1)) {
        array_push($errorrs,"password is required");//add error to errors array
	}
if (count($errorrs)==0)
{
	$query = "SELECT * FROM admin WHERE username='$username' AND password='$password_1' " ;
	$result= mysqli_query($db,$query);
	if(mysqli_num_rows($result)==1){
		//login
		
	 	$_SESSION['username']=$username;
	 	$_SESSION['success']="you are now logged in";
	 	header('location: product-list.php');

	}else {
		array_push($errorrs,"wrong username/password combination");
		header('location : product-list.php');
	}

 }



}



//logout
	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['username']);
		header('location: loginadministrateur.php');
}

?>