<?php
    $title = "Add Student";
    echo include("head.php");
?>
<?php
include('.auth.inc');
if (isset($_POST) && !empty($_POST)) {
        $con=@mysqli_connect(host,user,pwd,db);
        if (!$con) {
                echo "Error connecting to Db!!";
                exit(0);
        }

        $query = "insert into students values ('',?,?,?,?,?)";
        $stmt = mysqli_prepare($con,$query);
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$cont=$_POST['cont'];
	$cls=$_POST['cls'];
        if(preg_match("/^[a-zA-Z]*$/",$fname) && preg_match("/^[a-zA-Z]*$/",$lname) && is_string($cls)){
        mysqli_stmt_bind_param($stmt,"ssiss",$fname,$lname,$cont,$cls,$_POST['sdate']);
                $res=@mysqli_stmt_execute($stmt);
        }
}

$con=mysqli_connect(host,user,pwd,db);
$que="select * from students";
$result=mysqli_query($con,$que);
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
                <div class="col-sm-8 col-lg-8">
<?php
if(isset($res) && !empty($res)){
        if($res){
                echo "<div class='alert alert-success alert-dismissable'>".
                "Επιτυχια Εγγραφης &nbsp;<a href='#' data-dismiss='alert' class='close' aria-label='close'>&times;</a>".
                "</div>";
        }
        else{
                echo "<div class='alert alert-danger alert-dismissable'>".
                "Αποτυχια Εγγραφης &nbsp;<a href='#' data-dismiss='alert' class='close' aria-label='close'>&times;</a>".
                "</div>";

        }
        @mysqli_stmt_close($stmt);
}
?>

                       <h2>Εισαγωγη Mαθητων:</h2>
                        <div class="panel-body"><form action="#" method=post>
                        <div class="form-group">
                                <label> Ονομα: </label>
                                <input type="text" class="form-control" name="fname" required>
                        </div>

                        <div class="form-group">
                                <label> Επωνυμο: </label>
                                <input type="text" class="form-control" name="lname" required>
                        </div>

                        <div class="form-group">
                                <label>Αριθμος Επικοινωνιας:</label>
                                <input type="number" class="form-control" name="cont">
                        </div>

                        <div class="form-group">
                                <label> Ταξη: </label>
                                <input type="text" class="form-control" name="cls" required>
                        </div>
                        <div class="form-group">
                                <label>Ημερομηνια Εγγραφης:</label>
                                <input type="date" class="form-control" name="sdate" required>
                        </div>
                                <button type="submit" class="btn btn-success">Εισαγωγη</button>
                                <button type="reset" class="btn btn-secondary">Επαναφορα</button>
                        </div>
                        </form>
                </div>
        </div>
</div>
<?php echo include("foot.php");?>