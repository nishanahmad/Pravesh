<?php
session_start();
if(isset($_SESSION["user_name"]))
{
	require 'connect.php';
	require 'monthMap.php';
	
	if($_POST)
	{
		$export_data = array();
		$date = date('Y-m-d',strtotime($_POST['date']));
		$formList = mysqli_query($con,"SELECT * FROM lead_tracker WHERE lead_assigned_date = '$date'") or die(mysqli_error($con));
		foreach($formList as $form)
		{
			$export_data[] = array(
									'Lead Assigned Date' => $form['lead_assigned_date'],
									'Lead Source' => $form['lead_source'],
									'SE' => $form['sales_executive'],
									'Consumer Name' => $form['consumer_name'],
									'Consumer Contact No' => $form['consumer_phone'],
									'Consumer Full Address' => $form['consumer_address'],
									'Dealer' => $form['dealer'],
									'Consumer Type' => $form['consumer_type'],
									'Door requirement' => $form['door_requirement'],
									'Window requirement' => $form['window_requirement'],
									'Stage of Construction' => $form['stage'],
									'Priority' => $form['priority'],
									'Demo Date' => $form['demo_date'],
									'Next Followup Date' => $form['next_followup_date'],
									'Order Status' => $form['order_status'],
									'Reason for Loss' => $form['reason_for_loss'],
									'Advance Received (Y/N)' => $form['advance_received'],
									'REMARKS' => $form['remarks']
								  );
		}
		//var_dump($export_data);
		
		$fileName = date('d-m-Y',strtotime($date)) . ".xls";

		if ($export_data) 
		{
			function filterData(&$str) 
			{
				$str = preg_replace("/\t/", "\\t", $str);
				$str = preg_replace("/\r?\n/", "\\n", $str);
				if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
			}

			// headers for download
			header("Content-Disposition: attachment; filename=\"$fileName\"");
			header("Content-Type: application/vnd.ms-excel");

			$flag = false;
			foreach($export_data as $row) 
			{
				if(!$flag) 
				{
					// display column names as first row
					echo implode("\t", array_keys($row)) . "\n";
					$flag = true;
				}
				// filter data
				array_walk($row, 'filterData');
				echo implode("\t", array_values($row)) . "\n";
			}
			exit;			
		}
	}
	
?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Export Reports</title>

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
									<a href="form.php"><i class="fa fa-plus-square"></i></a> 
									<a href="reports.php"><i class="fa fa-envelope"></i></a> 
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
								<h1><strong>Export Reports</strong></h1>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-sm-offset-3 form-box">
								<form role="form" action="" method="post" class="registration-form">
										<div class="form-top">
											<div class="form-top-left">
												<h3>Select Date</h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<input type="text" name="date" class="form-control" id="date" value="<?php echo date('d-m-Y'); ?>">
											</div>
											<button type="submit" class="btn btn-next btn-primary">Export Report</button>
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
					var lead_assigned_date = { dateFormat:"dd-mm-yy"}; 
					$( "#date" ).datepicker(lead_assigned_date);
				});
			</script>			
		</body>
	</html>
<?php
}
//else
	//header("Location:loginPage.php");