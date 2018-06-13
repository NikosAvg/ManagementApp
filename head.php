<html>
<head>
<title><?php echo $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="styles/styles.css" rel="stylesheet">
<body>

<nav class="navbar  navbar-default navbar-fixed-top">
        <div class="container-fluid" style="padding:  0em 1em;">
                <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">Αρχικη</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#NavBar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                </div>

                <div class="collapse navbar-collapse" id="NavBar">
                        <ul class="nav navbar-nav navbar-right">
                                <li class="disabled"><a>Δημιουργια Πινακα Μαθητων</a></li>
                                <?php
					if(mysqli_num_rows($res)!=0){
						echo "<li><a href='add_payment.php'>Πληρωμη</a></li>";
					}
					else{
						echo "<li class='disabled'><a href='#'>Πληρωμη</a></li>";
					}
				?>
                                <li><a href="add_student.php">Εισαγωγη Νεων Μαθητων</a></li>
                                <li><a href="debt.php">Διαχειριση Οφειλων</a></li>
				<li class="bg-danger"><a data-toggle="modal" data-target="#modal">Διαγραφη Πινακα</a></li>
                        </ul>


                        <form class="navbar-form" action="" method="post">
                                <div class="input-group">
                                        <input type="text" class="form-control"  name=src placeholder="Αναζητηση">
                                        <div class="input-group-btn">
                                                <button class="btn btn-default" type="submit">
                                                        <i class="glyphicon glyphicon-search"></i>
                                                </button>
                                        </div>
                                </div>
                        </form>
                </div>
        </div>
</nav>
