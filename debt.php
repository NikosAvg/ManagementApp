<?php
    $title = "Debt";
    echo include('head.php');

?>
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
        //echo $query;
        @mysqli_query($con,$query);
        @mysqli_close($con);

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

        $res=@mysqli_query($con,$query);
        if (!$res) {
                echo "<br>Λάθος στην Query<br>";
                exit();
        }
        $row=@mysqli_fetch_array($res,MYSQLI_ASSOC);

	mysqli_close($con);

}
$con=mysqli_connect(host,user,pwd,db);
$que="select * from students";
$result1 = mysqli_query($con,$que);
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
                        <h2> Τρεχων Οφειλες: </h2>
			<br>
                        <?php
                                $con=@mysqli_connect(host,user,pwd,db) or die ("error");
                                if(@mysqli_connect_errno($con)){
                                        echo "Failed To Connect!".mysqli_connect_error();
                                }
                                $query="select students.*, payments.* from students right join payments on ".
                                "students.id = payments.uid and payments.to_be_paid != payments.paid ".
                                "where students.id is not null order by students.id ";
                        ?>

                        <div class="container">
                                <?php
					$per_page=5;
					$result=@mysqli_query($con,$query);
					$count=@mysqli_num_rows($result);
					$pages=ceil($count/$per_page);
                          	?>

                                <div id="content"></div>
                                <div id="pagination">
                                        <ul class="pagination">
                                                <?php
                                                        for($i=1; $i<=$pages;$i++){
                                                                echo "<li id='".$i."'><a href='#'>".$i."</a></li>";
                                                        }
                                                ?>
                                        </ul>
                                </div>
                        </div>
                </div>
        </div>
</div>

<?php echo include("foot.php"); ?>
<script>
$(document).ready(function() {
//Default Starting Page Results
$("#pagination li:first").css({'color' : '#FF0084'}).css({'border' : 'none'});
$("#content").load("pagination_data.php?page=1");
//Pagination Click
$("#pagination li").click(function(){
//CSS Styles
$("#pagination li").css({'border' : 'solid #dddddd 1px'}).css({'color' : '#0063DC'});
$(this).css({'color' : '#FF0084'}).css({'border' : 'none'});
//Loading Data
var pageNum = this.id;
$("#content").load("pagination_data.php?page=" + pageNum);
});
});
</script>

