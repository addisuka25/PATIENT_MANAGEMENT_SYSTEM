<!DOCTYPE html>
<?php
	require_once '../logincheck.php';
	$date = date("Y", strtotime("+ 8 HOURS"));
	$conn = new mysqli("localhost", "root", "", "patient_management_system") or die(mysqli_error());
	
	$qmaternity = $conn->query("SELECT COUNT(*) as total FROM `birthing` `prenatal` WHERE `year` = '$date' GROUP BY `itr_no`") or die(mysqli_error());
	$fmaternity = $qmaternity->fetch_array();
	
	$qdental = $conn->query("SELECT COUNT(*) as total FROM `dental` WHERE `year` = '$date' GROUP BY `itr_no`") or die(mysqli_error());
	$fdental = $qdental->fetch_array();

?>
<html lang = "eng">
	<head>
		<title>Patient Management System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "../images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/customize.css" />
		<?php require 'script.php'?>
		<script src = "../js/jquery.canvasjs.min.js"></script>

	</head>
<body>
	<div class = "navbar navbar-default navbar-fixed-top">
		<img src = "../images/logo.png" style = "float:left;" height = "55px" /><label class = "navbar-brand">Patient Management System</label>
		<?php 
			$q = $conn->query("SELECT * FROM `user` WHERE `user_id` = $_SESSION[user_id]") or die(mysqli_error());
			$f = $q->fetch_array();
		?>
			<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						<?php 
							echo $f['firstname']." ".$f['lastname'];
						?>
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a class = "me" href = "../logout.php"><i class = "glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
	</div>
	<div id = "sidebar">
			<ul id = "menu" class = "nav menu">
				<li><a href = "home.php"><i class = "glyphicon glyphicon-home"></i> Dashboard</a></li>
				<li><a href = ""><i class = "glyphicon glyphicon-cog"></i> Accounts</a>
					<ul>
						<li><a href = "admin.php"><i class = "glyphicon glyphicon-cog"></i> Administrator</a></li>
						<li><a href = "user.php"><i class = "glyphicon glyphicon-cog"></i> User</a></li>
					</ul>
				</li>
				<li><li><a href = "patient.php"><i class = "glyphicon glyphicon-user"></i> Patient</a></li></li>
				<li><a href = ""><i class = "glyphicon glyphicon-folder-close"></i> Sections</a>
					<ul>
						
						<li><a href = "maternity.php"><i class = "glyphicon glyphicon-folder-open"></i> Maternity</a></li>
						
						<li><a href = "dental.php"><i class = "glyphicon glyphicon-folder-open"></i> Dental</a></li>

					
						
					</ul>
				</li>
			</ul>
	</div>
	<div id = "content">
		<br />
		<br />
		<br />
		<div class = "well">
			<div style="width: 100%; height: 400px">
				<h1>Total Patient Population <?php echo $date ?></h1>
				<ul>
					<li>Maternity <span>
						<?php 
							if($fmaternity == ""){
										echo 0;
							}else{
										echo $fmaternity['total'];
							}	
						?>
									
								</span></li>
					<li>Dental <span>
						<?php 
							if($fdental == ""){
								echo 0;
							}else{
								echo $fdental['total'];
							}
						?>		
								</span</li>
				</ul>
			</div> 
		</div>
	</div>
	<div id = "footer">
		<label class = "footer-title">&copy; Copyright Patient Management System 2020</label>
	</div>
		
</body>
</html>