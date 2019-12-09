<?php
session_start();
if(isset($_SESSION["user_name"]))
{
	require 'connect.php';
	require 'monthMap.php';
	
?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Walk Ins</title>

			<!-- CSS -->
			<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
			<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
			<link rel="stylesheet" href="assets/css/form-elements.css">
			<link rel="stylesheet" href="assets/css/style.css">
			<link rel="stylesheet" href="assets/css/jquery-ui.css">
			<link rel="stylesheet" href="assets/css/loadBar.css">
			<link rel="stylesheet" href="assets/css/indexTable.css">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

			<!-- Favicon and touch icons -->
			<link rel="shortcut icon" href="assets/ico/favicon.png">
			<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
			<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
			<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
			<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
		</head>

		<body>
			<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<a class="navbar-brand" href="index.php">TATA PRAVESH</a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="top-navbar-1">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<span class="li-social">
									<a href="index.php"><i class="fa fa-home"></i></a>
									<a href="priorityList.php"><i class="fa fa-fire"></i></a> 
									<a href="statusList.php"><i class="fa fa-hourglass-half"></i></a>
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
							<div class="col-sm-8 col-sm-offset-2 form-box">
								<form role="form" action="" method="post" class="registration-form">
									<div class="form-top">
										<div align="center">
											<br/>
											<a href="walkinForm.php" class="btn btn-success" style="width:120px;font-size:20px;">NEW&nbsp;&nbsp;<i class="fa fa-plus-square"></i></a>
											<br/>
											<table class="responsive-table">
												<caption>Walk In Count</caption>
												<thead>
													<tr>
														<th scope="col">Date</th>
														<th scope="col">Walk In Count</th>
														<th scope="col"></th>
													</tr>
												</thead>
												<tfoot>
												</tfoot>
												<tbody>																		<?php
													$leads = mysqli_query($con,"SELECT * FROM walk_ins ORDER BY date DESC") or die(mysqli_error($con));
													foreach($leads as $lead)
													{																							?>
														<tr>
															<th scope="row"><?php echo date('d-m-Y',strtotime($lead['date']));?></th>													
															<td data-title="Count"><?php echo $lead['count'];?></td>														
															<td><?php 
																if($_SESSION['user_name'] != 'Demo')
																{																										?>
																	<a href="walkinForm.php?id=<?php echo $lead['id'];?>" class="btn btn-success" style="width:80px;">Edit <i class="fas fa-pen"></i></a><?php
																}																																	?>																	
															</td>																																																						
														</tr>																																										<?php
													}																																												?>			
												</tbody>
											</table>												
										</div>
									</div>
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
	</html>
<?php
}
else
	header("Location:loginPage.php");