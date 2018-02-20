<?php
include('include/conn.php');
	if(isset($_GET['id'])){
		$iid=$_GET['id'];
		$saa="SELECT * FROM contacts WHERE id='$iid'";
		$saa1=mysqli_query($con,$saa);
		if(mysqli_num_rows($saa1)>0){
			$r=mysqli_fetch_array($saa1);
			$status=$r['status'];
			if($status==1){
				$stat=0;
			}else if($status==0){
				$stat=1;
			}
			$mana="UPDATE `contacts` SET status='$stat' WHERE id='$iid'";
			$mana1=mysqli_query($con,$mana);
			if(mysqli_affected_rows($con)>0){
				echo "<script>window.location.href='welcome.php'</script>";
			}
		}
	}
?>