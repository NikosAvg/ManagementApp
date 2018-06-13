<html>
<body>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
include('.auth.inc');
$con=@mysqli_connect(host,user,pwd,db);
if (mysqli_connect_errno($con)) {
	echo "Failed to connect -".mysqli_connect_error($con)."<br>";
	exit();
}
$query=	"create table students(id int(4) auto_increment,".
	"fname varchar(80),lname varchar(80),contact bigint(15),class varchar(80),enr_date date,".
	"primary key(id));".
        "create table payments(pid int(4) auto_increment,".
        "uid int(4),to_be_paid double(10,2),paid double(10,2),debt double(10,2),".
        "pay_date date,primary key(pid),constraint mk foreign key(uid) references students(id) on delete cascade on update cascade)";

if (@mysqli_multi_query($con,$query)) {
	echo "<div class='alert alert-success'>O πίνακας δημιουργήθηκε επιτυχώς!</div>";
	echo "<script>"."window.setTimeout(function(){".
	"window.location = 'index.php';},2000);"."</script>";
}
else {
	echo "<div class='alert alert-danger'>Ο πίνακας  δεν δημιουργήθηκε:".mysqli_error($con)."</div>>";
}
mysqli_close($con);

?>

<script src="/jquery-min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
