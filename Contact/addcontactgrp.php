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
	<style type="text/css">
		select{
			width: 200px;
		}
	</style>
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
				<label>Contact Phone Number</label>
				<input type="tel" name="contact_phone_number" class="textInput" pattern="^\d{4}-\d{3}-\d{3}$" required>
			
				<label>Group Name</label>
					<select name="grp_name">
						<?php 
							$sa="SELECT * FROM groups WHERE status='1'";
							$sa1=mysqli_query($con,$sa);
							while($r=mysqli_fetch_array($sa1)){
							?>
								<option value="<?php echo $r['id']; ?>"><?php echo $r['grp_name']; ?></option>
						<?php } ?>
					</select>
				</div>
			<div>
				<input type="submit" name="add" value="Add Group" class="btn">
			</div>
		</form>
</body>
</html>
<?php
	if(isset($_POST['add'])){
		$gname=$_POST['group_name'];
		$cno=$_POST['contact_phone_number'];
		$sa="SELECT * FROM contacts WHERE phone='$cno' AND u_id='$id' AND status=1";
		$sa1=mysqli_query($con,$sa);
		if(mysqli_num_rows($sa1)>0){
			$r=mysqli_fetch_array($sa1);
			$iiid=$r['id'];
			$g_id=$r['g_id'];
			if($g_id==""){
				$gid=$gname;
			}else{
				$gid=$g_id.",".$gname;
			}
			$sas="UPDATE `contacts` SET g_id='$gid' WHERE id='$iiid'";
			$sas1=mysqli_query($con,$sas);
			if(mysqli_affected_rows($con)>0){
				echo "<script>window.location.href='welcome.php'</script>";
			}
		}else{
			echo "<script>alert('Contact Not Found')</script>";
			echo "<script>window.location.href='welcome.php'</script>";
		}
	}
?>
