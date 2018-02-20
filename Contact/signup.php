<?php 
	include('include/conn.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SignUp</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script>
		function validate(){
			if(document.signup.email.value.length > 0) {
				var theEmail = document.signup.email.toLowerCase();
				var at = theEmail.value.indexOf('@');
				var period = theEmail.value.lastIndexOf('.');
				var space = theEmail.value.indexOf(' ');
				var length = theEmail.value.length -  1;

				if((at < 1) || (period <= at+1) || (period == length) || (length <=period + 1) || (space !=-1)) {
					alert('Invalid Email');
					return false;
				}
				var inmarcom = theEmail.value.indexOf('inmar.com');

				if((inmarcom == -1)) {
					// Donothing
					alert('invalid Email address')
					document.signup.eamil.select();
					return false;
				}

			}
			if(document.signup.password.value == document.signup.password_confirm.value) {
				return true
			}
			else{
				alert('passwords do not match');
			}
		}
	</script>
</head>
<body>
	<div id="wrapper">
		<form method="post" name ="signup" >
			<div id = "username_div">
				<label>Username</label><br>
				<input type="text" name="username" class="textInput" required pattern="^[a-zA-Z][a-zA-Z\.]{1,20}$">
				<div id="name_error"s></div>
			</div>
			<div id="email_div">
				<label>Email</label><br>
				<input type="email" name="email" class="textInput">
				<div id="email_error"></div>
			</div>
			<div id="password_div">
				<label>Password</label>
				<input type="password" name="password" class="textInput" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
				<div id="password_error"></div>
			</div>
			<div id="password_confirm_div">
				<label>Re-Type Password</label>
				<input type="password" name="password_confirm" class="textInput" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
			</div>
			<div>
				<input type="submit" name="register" value="register" class="btn" onsubmit="return validate()">

			</div>
			<div>
				<p style="color:red;">* Password should contain atleast uppercase,lowercase, one number or one symbol</p>
			</div>
		</form>
	</div>
</body>
</html>
<?php
	if(isset($_POST['register'])){
		$uname=$_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$password_confirm=$_POST['password_confirm'];
		if($password==$password_confirm){
			$sql="SELECT * FROM users WHERE name='$uname' AND email='$email'";
			$ss=mysqli_query($con,$sql);
			if(mysqli_num_rows($ss)>0){
				echo "<script>alert('User already Registered')</script>";
			}else{
				$mana="INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$uname','$email','$password_confirm')";
				$mana1=mysqli_query($con,$mana);
				echo "<script>alert('User Registered Please Login')</script>";
				echo "<script>window.location.href='login.php'</script>";
			} 
		}else{
			echo "<script>alert('Passwords not Matched')</script>";
		}
	}
?>