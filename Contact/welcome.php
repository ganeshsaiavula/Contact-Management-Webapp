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
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
   	<title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script  src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
  .example1{
    width: 50%;
  }
</style>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
      <div class="topnav">
        <a href="welcome.php" class="active">Home</a>
        <a href="addcontact.php">Add Contact</a>
        <a href="addGroup.php">Add Group</a>
  <a href="addcontactgrp.php">Add Contact to Group</a>
            </div>
      <br>

      <div class="row">
        <div class="col-md-2"><h1>Contacts</h1></div>
        <div class="col-md-5">
      <table id="myTable" class="table table-responsive table-bordered table-hover example1">
        <thead>
          <tr>
           <th>S.no</th>
            <th>Contact Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Groups</th>
          </tr>
        </thead>
        <div id="hiding">
        <tbody>
          <?php $sq="SELECT * FROM contacts WHERE u_id='$id'";
                $mana1=mysqli_query($con,$sq);
				$n=0;
                while($r=mysqli_fetch_array($mana1)){
					$n=$n+1;
           ?>
          <tr><td><?php echo $n; ?></td><td><?php echo $r['name']; ?></td><td><?php echo $r['phone']; ?></td><td><?php echo $r['email']; ?></td><td><?php echo $r['g_id']; ?></td></tr>
          <?php } ?>
</tbody>
</div>
</table>
</div>
<div class="col-md-2"></div></div>
<br><br>
<div class="row">
        <div class="col-md-2"><h1>Groups</h1></div>
        <div class="col-md-5">
      <table id="myTable" class="table table-responsive table-bordered table-hover example2">
        <thead>
          <tr>
           <th>S.no</th>
            <th>Group Name</th>
            <th>Status</th>
          </tr>
        </thead>
        <div id="hiding">
        <tbody>
          <?php $sq="SELECT * FROM groups WHERE c_id='$id'";
          $n=0;
                $mana1=mysqli_query($con,$sq);
                if(mysqli_num_rows($mana1)>0){
                while($r=mysqli_fetch_array($mana1)){
                  $n=$n+1;
           ?>
          <tr><td><?php echo $n; ?></td><td><?php echo $r['grp_name']; ?></td><td><?php if($r['status']==1){ ?><a href="grpstat.php?id=<?php echo $r['id']; ?>">Inactive</a><?php }else if($r['status']==0){ ?><a href="grpstat.php?id=<?php echo $r['id']; ?>">Active</a><?php } ?></td></tr>
          <?php } }?>
</tbody>
</div>
</table>
</div>
<div class="col-md-2"></div></div>
  </body>
   <script>
$(document).ready(function(){
  $('.example1').DataTable( {
           "paging"      : true,
      "lengthChange": true,
      "searching"   : true,
      "ordering"    : true,
      "info"        : true,
      "autoWidth"   : true,
        "order": [[ 0, "desc" ]]
    } );
  $.fn.dataTable.ext.errMode = 'none';
 $('.example2').DataTable( {
           "paging"      : true,
      "lengthChange": true,
      "searching"   : true,
      "ordering"    : false,
      "info"        : true,
      "autoWidth"   : true,
        "order": [[ 0, "desc" ]]
    } );
  $.fn.dataTable.ext.errMode = 'none';

});

</script>

</html>