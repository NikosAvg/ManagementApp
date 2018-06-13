<!DOCTYPE html>
<?php
include('.auth.inc');
$con=@mysqli_connect(host,user,pwd,db);
$que="describe students;".
	"describe payments";
$res=mysqli_multi_query($con,$que);
if($res==True){
header("Location:front_page.php");
}

mysqli_close($con);


?>
<?php
	$title = "Home";
	echo include('head.php');
?>

<div class="container">
	<div class="modal fade" id="modal" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" style="text-align: center;">Θελετε Να Δημιουργησετε Νεο Πινακα;</h4>
				</div>
				<div class="modal-body" style="text-align: center;">
					<a href="create.php"><button type="button" class="btn btn-success">Ναι</button></a>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" data-target="#modal">Οχι</button>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-heading">
			<p><h2>Καλως ηρθατε στην εφαρμογη διαχειρισης. Για να ξεκινησετε, δημιουργηστε ενα νεο πινακα!</h2></p>
		</div>
	</div>
</div>
<?php
	echo include('foot.php')
?>
