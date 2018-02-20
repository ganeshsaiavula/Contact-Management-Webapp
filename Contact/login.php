<?php
	include('include/conn.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>LogIn</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	</script>
	
</head>
<body>
	<div id="wrapper">
		<form method="POST" onsubmit="return Validate()">
			<div id = "username_div">
				<label>Username</label><br>
				<input type="email" name="username" class="textInput" required>
				<div id="name_error"></div>
			</div>
			<div id="password_div">
				<label>Password</label>
				<input type="password" name="password" class="textInput" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
				<div id="password_error"></div>
			</div>
			<div>
				<input type="submit" name="register" value="LogIn" class="btn" onClick="validateEmail()">
			</div>
		</form>
	</div>
</body>
</html>
<?php
	if(isset($_POST['register'])){
		$uname=$_POST['username'];
		$password=$_POST['password'];
		$mana="SELECT * FROM users WHERE email='$uname' AND password='$password'";
		$mana1=mysqli_query($con,$mana);
		if(mysqli_num_rows($mana1)>0){
			$sa=mysqli_fetch_array($mana1);
			$_SESSION['uid']=$sa['id'];
			echo "<script>window.location.href='welcome.php';</script>";
		}else{
			echo "<script>alert('User not Found')</script>";
		}
	}
?>