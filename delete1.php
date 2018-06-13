<html>
<head>
</head>
<body>
<?php
include('.auth.inc');
if (isset($_POST['id']) && !empty($_POST['id'])) {
	$con=@mysqli_connect(host,user,pwd,db);
	if (mysqli_connect_errno($con)) {
		echo "Failed to connect -".mysqli_connect_error($con)."<br>";
		exit();
	}
$query="delete from students where id=".$_POST['id'];
$result=mysqli_query($con,$query);
if (!$result) {
	echo "Delete Failed <br>";
}
mysqli_close($con);
}
?>
</body>
</html>
