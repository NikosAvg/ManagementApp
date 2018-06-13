<?php
	include('.auth.inc');
	$con=@mysqli_connect(host,user,pwd,db);
	if($_GET){
		$page=$_GET['page'];
	}
	$per_page=5;
	$start = ($page-1)*$per_page;
	$query="select students.*, payments.* from students right join payments on ".
               "students.id = payments.uid and payments.to_be_paid != payments.paid ".
               "where students.id is not null order by students.id ".
		"limit $start,$per_page";
	$result = @mysqli_query($con,$query);


        if(@mysqli_num_rows($result)>0){
		echo "<div class='table-responsive'>".
		"<table class='table'>".
		"<thead><tr><th>#</th><th>Ονομα</th><th>Επωνυμο</th><th>Τηλεφωνο Επικοινωνιας</th><th>Χρεως</th><th>Ημερομηνια Πληρωμης</th></thead>".
                "<tbody>";
                while($row=@mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
			echo "<tr><td>".$row['id']."</td><td>".$row['fname']."</td><td>".$row['lname']."</td><td>".$row['contact'].
			"</td><td>".$row['debt'].
                        "</td><td>".$row['pay_date']."</td>".
                       	"<td>&nbsp;<a href=update_payment.php?pid=".$row['pid']."><button class='btn btn-success'>Update</button></a></td>";
                        echo "</tr>";
                }
                echo "</tbody></table>".
                "</div>";
       }
	else{
		echo "<h3>Καμια Οφειλη</h3>";
	}
mysqli_close($con);
?>

