<?php
include_once('.auth.inc');
$con=mysqli_connect(host,user,pwd,db);
$query="select * from students";
$result=mysqli_query($con,$query);
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
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Καλως ηρθατε στην εφαρμογη διαχειρισης:</h2>
		</div>
		<div class="panel-body">
			<p><h4>Η εφαρμογη αυτη σχεδιαστηκε για να εξυπηρετησει τους ιδιοκτητες</h4></p>
			<p><h4>φροντιστηριων και αλλων εκπαιδευτικων ιδρυματων να διαχειριστουν εγγραφες μαθητων και πληρωμων.</h4></p>
			<p><h4>Για πληροφοριες ως προς τη χρηση της εφαρμογης πατηστε <a href="tech_report.pdf">εδω</a> για να κατεβασετε την <b>τεχνικη αναφορα</b>.</h4></p>
		</div>
	</div>
</div>

<?php
	echo include('foot.php')
?>