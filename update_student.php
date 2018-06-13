<?php
include('.auth.inc');
if (isset($_POST['id']) && !empty($_POST['id'])) {
	$con=@mysqli_connect(host,user,pwd,db);
	if (!$con) {
		echo "Error connecting to Db!!";
		exit(0);
	} else {
		echo "Connected succesfully!"; 
	}
	$query="update students set fname='".$_POST['fname'].
		"', lname='". $_POST['lname']."',contact=".$_POST['cont'].", class='".$_POST['cls']."',enr_date='".$_POST['edate']."' where id=".$_POST['id'];
	 mysqli_query($con,$query);
	mysqli_close($con);

}
if (isset($_GET['id']) && !empty($_GET['id'])) {

	$con=@mysqli_connect(host,user,pwd,db);
	if (!$con) {
		echo "Error connecting to Db!!";
		exit(0);
	}
	$query="select * from students where id=".$_GET['id'];
	$res=mysqli_query($con,$query);
	if (!$res) {
		echo "<br>Λάθος στην Query<br>";
		exit();
	}
 	$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
	mysqli_close($con);
?>
<?php 
	$title = "Update Student";
	echo include('head.php');
?>

<div class="container">
        <div class="modal fade" id="modal" role="dialog">
                <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" style="text-align: center;">Warning</h4>
                                </div>
                                <div class="modal-body" style="text-align: center;">
                                        <p>Εισαι Σιγουρος οτι θελεις</p>
                                        <p>να διαγραψεις τον πινακα;</p>
                                </div>
                                <div class="modal-footer">
                                        <a href="table_delete.php"><button type="button" class="btn btn-success">Ναι</button></a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Οχι</button>
                                </div>
                        </div>
                </div>
        </div>
</div>



<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8">
			<form method=POST action="#"> 
				<div class="form-group">
					<label>Id:</label>
					<input type=text class="form-control" readonly name=id value=<?=$row['id']?>>
				</div>

				<div class="form-group">
					<label>First Name:</label>
					<input type=text class="form-control" name=fname value=<?=$row['fname']?>>
				</div>
				<div class="form-group">
					<label>Last Name:</label>
					<input type=text class="form-control" name=lname value=<?=$row['lname']?>>
				</div>

				<div class="form-group">
					<label>Contact Number:</label>
					<input type=number class="form-control" name=cont value=<?=$row['contact']?>>
				</div>

				<div class="form-group">
					<label>Class:</label>
					<input type=text class="form-control" name=cls value=<?=$row['class']?>>
				</div>

				<div class="form-group">
					<label>Enroll Date:</label>
					<input type=date class="form-control" name=edate value=<?=$row['enr_date']?>>
				</div>
				<button class="btn btn-success" type=submit>Update</button>
				<button class="btn btn-secondary" type=reset>Reset</button>
			</form>
		</div>
	</div>
</div>

<?php
	echo include('foot.php');
}
?>
