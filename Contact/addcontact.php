<?php
	include('include/conn.php');
	if(!isset($_SESSION['uid'])){
		echo "<script>alert('Session Expired')</script>";
		echo "<script>window.location.href='login.php';</script>";
	}
	$id=$_SESSION['uid'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Contact</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="topnav">
        <a href="welcome.php" class="active">Home</a>
        <a href="addcontact.php">Add Contact</a>
        <a href="addGroup.php">Add Group</a>
        <a href="#DeleteContact">Delete Contact</a>
        <a href="#Delete Group">Delete Group</a>
      </div>
      
	<div id="wrapper">
		<form method="post"  name="addContact">
			<div id="contact_name_div">
				<label>Contact Name</label>
				<input type="text" name="contact_name" class="textInput" required pattern="^[a-zA-Z][a-zA-Z \.]+{1,20}$">
				<div id="name_error"></div>
			</div>
			<div id="contact_number_div">
				<label>Phone Number</label>
				<input type="tel" name="contact_phone_number" class="textInput" pattern="^\d{4}-\d{3}-\d{3}$" required>
				<div id="number_error"></div>
			</div>
			<div id="contact_mail_div">
				<label>E-Mail Address</label>
				<input type="email" name="contact_mail" class="textInput" required>
				<div id="mail_error"></div>
			</div>
			<div id="contact_address_div">
				<label>Address</label>
				<input type="text" name="contact_address" class="textInput" required>
				<div id="address_error"></div>
			</div>
			<div>
				<input type="submit" name="add" value="Add Contact" class="btn" onclick="validate()">
			</div>
			<p style="color:red;">*Phone format : XXXX-XXX-XXX</p>
				
		</form>
</body>
</html>
<?php
	if(isset($_POST['add'])){
		$cname=$_POST['contact_name'];
		$contact_phone_number=$_POST['contact_phone_number'];
		$email=$_POST['contact_mail'];
		$address=$_POST['contact_address'];
		$sa="SELECT * FROM contacts WHERE name='$cname' AND phone='$contact_phone_number' AND email='$email' AND address='$address' AND u_id='$id'";
		$sa1=mysqli_query($con,$sa);
		if(mysqli_num_rows($sa1)==0){
			$mana="INSERT INTO `contacts`(`name`, `phone`, `email`, `address`, `u_id`) VALUES ('$cname','$contact_phone_number','$email','$address','$id')";
			$mana1=mysqli_query($con,$mana);
			if(mysqli_affected_rows($con)>0){
				echo "<script>alert('contact Added');</script>";
				echo "<script>window.location.href='welcome.html'</script>";
			}
		}else{
				echo "<script>alert('contact Already Added');</script>";
				echo "<script>window.location.href='welcome.html'</script>";
		}
	}
?>