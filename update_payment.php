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
	$query="update payments set debt='".$_POST['debt']."', paid='". $_POST['paid']."', pay_date='".$_POST['pdate'].
	"' where pid=".$_POST['id'];
	mysqli_query($con,$query);
	header("Location:debt.php");
	mysqli_close($con);

}
if (isset($_GET['pid']) && !empty($_GET['pid'])) {

	$con=@mysqli_connect(host,user,pwd,db);
	if (!$con) {
		echo "Error connecting to Db!!";
		exit(0);
	} else {
		echo "Connected succesfully!"; 
	}
	$query="select * from payments where pid=".$_GET['pid'];
	$res=mysqli_query($con,$query);
	if (!$res) {
		echo "<br>Λάθος στην Query<br>";
		exit();
	}
 	$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
	mysqli_close($con);
?>
<?php
	$title = "Update Payment"; 
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
					<label>PId:</label>
					<input type=text class="form-control" readonly name=id value=<?=$row['pid']?>>
				</div>
				<div class="form-group">
					<label>Debt:</label>
					<input type=text class="form-control" name=debt value=<?=$row['debt']?>>
				</div>
				<div class="form-group">
					<label>Paid:</label>
					<input type=text class="form-control" name=paid value=<?=$row['paid']?>>
				</div>
				<div class="form-group">
					<label>Pay Day:</label>
					<input type=date class="form-control" name=pdate value=<?=$row['pay_date']?>>
				</div>
				<button class="btn btn-success" type=submit>Send</button>
				<button class="btn btn-secondary">Reset</button>
			</form>
		</div>
	</div>
</div>
<?php
	echo include('foot.php');
}
?>
