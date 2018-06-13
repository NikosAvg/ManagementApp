<?php
include_once('.auth.inc');
$con=mysqli_connect(host,user,pwd,db);
$query="select * from students";
$result=mysqli_query($con,$query);

if (isset($_POST) && !empty($_POST)) {
        if (!$con) {
                echo "Error connecting to Db!!";
                exit(0);
        }
        //Calculate debt
        $debt=floatval($_POST['tut']) - floatval($_POST['cash']);
        $query1="select id from students where fname='".$_POST['fname']."'and "."lname='".$_POST['lname']."'";

        $res=@mysqli_query($con,$query1);
        if (@mysqli_num_rows($res)>0){
                while($row = mysqli_fetch_assoc($res)){
                        $uid=$row["id"];
                }
                $que="insert into payments values('',?,?,?,?,?)";
                $stmt=@mysqli_prepare($con,$que);
                $tut=floatval($_POST['tut']);
                $cash=floatval($_POST['cash']);
                $pdate=$_POST['pdate'];
                $result1=@mysqli_stmt_bind_param($stmt,"iddds",$uid,$tut,$cash,$debt,$pdate);
                @mysqli_stmt_execute($stmt);
                @mysqli_stmt_close($stmt);
	}
        else{
                echo "<div class='alert alert-warning alert-dismissable'><a href='#' class='close'  aria-label='close' data-dismiss='alert'>&times;</a></div>";
        }
}
$title = "Πληρωμη"
?>
<?php  echo include('head.php');?>
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
<?php
if(isset($result1) && !empty($result1)){
	if(!$result1){
		echo "<div class='alert alert-warning alert-dismissable'> Αποτυχια Πληρωμης! <a href='#' class='close' aria-label='close' data-dismiss='alert'>&times;</a></div>";
	}
        else{
		echo "<div class='alert alert-success alert-dismissable'> Eπιτυχης Πληρωμη! <a href='#' class='close' aria-label='close' data-dismiss='alert'>&times;</a></div>";
	}
}

?>
                        <h2>Πληρωμη:</h2>
                        <form method=post action="#">
                                <div class="form-group">
                                        <label>Ονομα:</label>
                                        <input type=text class="form-control" name=fname value="">
                                </div>
                                <div class="form-group">
                                        <label>Επωνυνο:</label>
                                        <input type=text class="form-control" name=lname value="">
                                </div>
                                <div class="form-group">
                                        <label>Ποσο Πληρωμης:</label>
                                        <input type=text class="form-control" name=cash value="">
                                </div>
                                <div class="form-group">
                                        <label>Διδακτρα:</label>
                                        <input type=text class="form-control" name=tut value="120">
                                </div>
                                <div class="form-group">
                                        <label>Ημερομηνια:</label>
                                        <input type=date class="form-control" name=pdate valeu="">
                                </div>
                                <button class="btn btn-success" type=submit>Υποβολη</button>
                                <button class="btn btn-secondary" type=reset>Επαναφορα</button>
                        </form>
                </div>
        </div>
</div>
<?php echo include("foot.php"); ?>