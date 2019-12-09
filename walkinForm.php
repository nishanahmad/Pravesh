<?php	
session_start();
if(isset($_SESSION["user_name"]))
{
	require 'connect.php';																				
	
	if(isset($_GET['id']))
		$id = $_GET['id'];
	
	if($_POST)
	{
		$date = date('Y-m-d',strtotime($_POST['date']));
		$count = (integer)$_POST['count'];
		
		if(isset($id))
		{
			$query="UPDATE walk_ins SET date = '$date',count = $count WHERE Id = $id";
			$update = mysqli_query($con, $query);
			
			if($update)
				header("Location:walkins.php");
			else
				header("Location:walkinForm.php?error=Duplicate entry. Please enter again");					
		}
		else
		{
			$sql="INSERT INTO walk_ins (date, count) VALUES ('$date', $count)";
			$insert = mysqli_query($con, $sql);
			
			if($insert)
				header("Location:walkins.php");
			else
				header("Location:walkinForm.php?error=Duplicate entry. Please enter again");			
		}
	}
?>		
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Walk In</title>

			<!-- CSS -->
			<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
			<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
			<link rel="stylesheet" href="assets/css/form-elements.css">
			<link rel="stylesheet" href="assets/css/style.css">
			<link rel="stylesheet" href="assets/css/jquery-ui.css">

			<!-- Favicon and touch icons -->
			<link rel="shortcut icon" href="assets/ico/favicon.png">
			<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
			<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
			<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
			<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		</head>

		<body>
			<!-- Top menu -->
			<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<a class="navbar-brand" href="index.php">TATA Pravesh</a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="top-navbar-1">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<span class="li-social">
									<a href="index.php"><i class="fa fa-home"></i></a>
									<a href="priorityList.php"><i class="fa fa-fire"></i></a>
									<a href="pending.php"><i class="fa fa-hourglass-half"></i></a>
									<a href="walkins.php"><i class="fa fa-street-view"></i></a>
									<a href="logout.php"><i class="fa fa-power-off"></i></a>  										
								</span>
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<!-- Top content -->
			<div class="top-content">
				<div class="inner-bg">
					<div class="container">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2 text">
								<h1><strong>Walk In</strong></h1>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-sm-offset-3 form-box">
								<form role="form" action="" method="post" class="registration-form">
									
									<!------------------ BLOCK 1 ------------------------->	
									<fieldset id="f1">
										<div class="form-top">
											<div class="form-top-left">													<?php
												if(isset($_GET['error']))
												{
													echo '<font style="color:red;text-shadow: none;font-weight:bold;font-size:20px;">'.$_GET['error'].'</font>';																										
												}
												else
												{
													echo '<h3>Walk In</h3>'; 
												}													?>											
											</div>														
										</div>
										<div class="form-bottom">											
											<div class="form-group">
												<label for="date">Lead Assigned Date </label>
												<input type="text" name="date" required class="form-control" id="date" value="<?php echo date('d-m-Y'); ?>">
											</div>			
											<div class="form-group">
												<label for="count">count </label>
												<input type="text" name="count" required class="form-control" id="count">
											</div>																					
											<button type="submit" class="btn btn-next btn-primary">Submit</button>
										</div>
									</fieldset>
								</form>		
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Javascript -->
			<script src="assets/js/jquery-1.11.1.min.js"></script>
			<script src="assets/js/jquery-ui.min.js"></script>	
			<script src="assets/bootstrap/js/bootstrap.min.js"></script>
			<script src="assets/js/jquery.backstretch.min.js"></script>
			<script src="assets/js/retina-1.1.0.min.js"></script>
			<script src="assets/js/scripts.js"></script>
			<script>
				$(function() {
					var date = { dateFormat:"dd-mm-yy"}; 
					$( "#date" ).datepicker(date);
				});
			</script>
		</body>
	</html>																																							<?php		
}
else
	header("Location:loginPage.php");