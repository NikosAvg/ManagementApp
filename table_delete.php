<?php
	include('.auth.inc');
	$con=mysqli_connect(host,user,pwd,db);
	$query="drop table if exists payments;".
		"drop table if exists students";
	$res=mysqli_multi_query($con,$query);
	mysqli_close($con);
	header("Location:index.php");
?>
