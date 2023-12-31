<?php 
	session_start();
	if(isset($_SESSION["user"])){
		header("Location: index.php");
	}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Login Form</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css" />
</head>
<body>
	 
	<div class="container">
		<?php
			if(isset($_POST["login"])){
				$email = $_POST["email"];
				$password = $_POST["password"];
				require_once "database.php";
				$sql = "SELECT * FROM users WHERE email = '$email'";
				$result = mysqli_query($conn, $sql);
				$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
				if($user){
					if(password_verify($password, $user["password"])){
						session_start();
						$_SESSION["user"] =  "yes";
						header("Location: index.php");
						die();
					}else{
						echo "<div class='alert alert-danger'>Password does not match.</div>";
					}
				}else{
					echo "<div class='alert alert-danger'>Email does not match.</div>";
				}
			}
		?>
		<form action="login.php" method="post">
			<div class="form_group"> 
				<input type="email" class="form-control" name="email" placeholder="Email:"/>
			</div>
			<div class="form_group"> 
				<input type="password" class="form-control" name="password" placeholder="Password:"/>
			</div>
			<div class="form_btn"> 
				<input type="submit" class="btn btn-primary" name="login" value="Login"/>
			</div>
		</form>
		<div><p>Not Registered yet <a href="registration.php">Register Here</a></p></div>
	</div>
	 
</body>
</html>