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
	<title>Add Group</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="topnav">
        <a href="welcome.php" class="active">Home</a>
        <a href="addcontact.php">Add Contact</a>
        <a href="addGroup.php">Add Group</a>
          <a href="addcontactgrp.php">Add Contact to Group</a>
      </div>
      
	<div id="wrapper">
		<form method="post">
			<div id="group_name_div">
				<label>Group Name</label>
				<input type="text" name="group_name_div" class="textInput" pattern="^[a-zA-Z][a-zA-Z0-9\.]{1,20}$">
				<div id="group_name_error"></div>
			</div>
			<div>
				<input type="submit" name="add" value="Add Group" class="btn">
			</div>
		</form>
</body>
</html>
<?php
	if(isset($_POST['add'])){
		$gname=$_POST['group_name_div'];
		$sa="SELECT * FROM groups WHERE grp_name='$gname' AND c_id='$id'";
		$sa1=mysqli_query($con,$sa);
		if(mysqli_num_rows($sa1)==0){
			$mana="INSERT INTO `groups`(`grp_name`, `c_id`) VALUES ('$gname','$id')";
			$mana1=mysqli_query($con,$mana);
			if(mysqli_affected_rows($con)>0){
				echo "<script>alert('Group Added');</script>";
				echo "<script>window.location.href='welcome.html'</script>";
			}
		}else{
			echo "<script>alert('contact Already Added');</script>";
				echo "<script>window.location.href='welcome.html'</script>";
		}
	}
?>
