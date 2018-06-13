
<?php
include('.auth.inc');
$con=mysqli_connect(host,user,pwd,db);

if(isset($_POST)&&!empty($_POST)){
$search=mysqli_real_escape_string($con,$_POST['src']);
$splt=str_split($search,1);
$condition="";
if(count($_POST['src']>=4)){
	$query="select * from students where fname like '%".$_POST['src']."%' or lname like '%".$_POST['src']."%' or class like '".$_POST['src']."%'";
}
else{
for($i=0;$i<count($splt);$i++){
	$condition .= "like '%".$splt[$i]."%'";
}
$query="select * from students where fname ".$condition." or lname ".$condition." or class ".$condition;
}
$result=mysqli_query($con,$query);

}
$que="select * from students";
$res=mysqli_query($con,$que);
?>

<?php
	$title = "Search";
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


<?php
echo "<div class='container-fluid'>";
if(isset($result) && !empty($result)){
			echo "<div class='table-responsive'>";
                        echo "<table class='table'>";
                        echo "<thead><tr><th>#</th><th>Ονομα</th><th>Επωνυμο</th><th>Τηλεφωνο Επικοινωνιας</th>".
                        "<th>Ταξη</th><th>Ημερομηνια Εγγραφης</th></tr></thead>";
                        echo "<tbody>";

        if(@mysqli_num_rows($result)!=0){
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			echo "<tr id=".$row['id']."><td>".$row['id']."</td><td>".$row['fname']."</td><td>".$row['lname']."</td><td>".$row['contact'].
                        "</td><td>".$row['class']."</td><td>".$row['enr_date']."</td>".
                        "<td>&nbsp;<a class='delete' href='#'><button class='btn btn-danger'>Delete</button></a></td>".
                        "<td>&nbsp;<a href=update_student.php?id=".$row['id']."><button class='btn btn-success'>Update</button></a><br></td></tr>";

                }
        }
			echo "</tbody></table></div>";
}
else if(isset($result) && empty($result)){
	echo "<h3>Kαμια Εγγραφη Με Αυτα Τα Στοιχεια!</h3>";
}

mysqli_close($con);

?>
<?php
	echo include('foot.php')
?>
<script>
$(document).ready(function()
{
	$('table td a.delete').click(function()
	{
		if(confirm("Are You Sure?"))
		{
			var id = $(this).parent().parent().attr('id');
			var data = 'id=' + id;
			var parent = $(this).parent().parent();

			$.ajax(
			{
				type: "POST",
				url: "delete1.php",
				data: data,
				cache: false,

				success: function()
				{
					parent.fadeOut('slow',
						function() {$(this).remove();});
				}
			});
		}
	});
});
</script>

