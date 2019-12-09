<?php
session_start();
if(isset($_SESSION["user_name"]))
{
	require 'connect.php';
	
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$formQuery = mysqli_query($con,"SELECT * FROM lead_tracker WHERE id = $id") or die(mysqli_error($con));
		$form= mysqli_fetch_array($formQuery,MYSQLI_ASSOC);

		if($form['lead_assigned_date'] != null)
			$lead_assigned_date = date('d-m-Y',strtotime($form['lead_assigned_date']));
		else
			$lead_assigned_date = null;
		
		$lead_source = $form['lead_source'];
		$consumer_name = $form['consumer_name'];
		$consumer_phone = $form['consumer_phone'];
		$consumer_address = $form['consumer_address'];
		$dealer = $form['dealer'];
		$consumer_type = $form['consumer_type'];
		$door_requirement = $form['door_requirement'];
		$window_requirement = $form['window_requirement'];
		$stage = $form['stage'];
		$priority = $form['priority'];

		if($form['demo_date'] != null)
			$demo_date = date('d-m-Y',strtotime($form['demo_date']));
		else
			$demo_date = null;
		
		if($form['next_followup_date'] != null)
			$next_followup_date = date('d-m-Y',strtotime($form['next_followup_date']));
		else
			$next_followup_date = null;
		
		$order_status = $form['order_status'];
		$reason_for_loss = $form['reason_for_loss'];
		$advance_received = $form['advance_received'];
		$remarks = $form['remarks'];
		
		if($form['store_visit'] != null)
			$store_visit = date('d-m-Y',strtotime($form['store_visit']));
		else
			$store_visit = null;
	}
?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>New Lead</title>

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
							<div class="col-sm-8 col-sm-offset-2 text">
								<h1><strong>Lead</strong></h1>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-sm-offset-3 form-box">
								<form role="form" action="upsert.php" method="post" class="registration-form">
									
									<!------------------ BLOCK 1 ------------------------->	
									<fieldset id="f1">
										<div class="form-top">
											<div class="form-top-left">
												<h3>Page 1</h3>
											</div>
										</div>
										<div class="form-bottom">
											<input type="hidden" name="id" id="id" <?php if(isset($id)) echo 'value="'.$id.'"'?>>
											<div class="form-group">
												<label for="lead_assigned_date">Lead Assigned Date </label>
												<input type="text" name="lead_assigned_date" class="form-control" id="lead_assigned_date" value="<?php if(isset($lead_assigned_date)) echo $lead_assigned_date; else echo date('d-m-Y'); ?>">
											</div>
											<div class="form-group">
												<label for="lead_source">Lead Source</label>
												<select id="lead_source" name="lead_source" class="form-control">
													<option value=""></option>
													<option <?php if(isset($lead_source) && $lead_source == 'Van Campaign') echo 'selected';?> value="Van Campaign">Van Campaign</option>
													<option <?php if(isset($lead_source) && $lead_source == 'Tiscon Leads') echo 'selected';?> value="Tiscon Leads">Tiscon Leads</option>													
													<option <?php if(isset($lead_source) && $lead_source == 'Web/Digital Platforms') echo 'selected';?> value="Web/Digital Platforms">Web/Digital Platforms</option>
													<option <?php if(isset($lead_source) && $lead_source == 'News Paper') echo 'selected';?> value="News Paper">News Paper</option>
													<option <?php if(isset($lead_source) && $lead_source == 'Call Center') echo 'selected';?> value="Call Center">Call Center</option>
													<option <?php if(isset($lead_source) && $lead_source == 'Dealer Walk-ins') echo 'selected';?> value="Dealer Walk-ins">Dealer Walk-ins</option>
													<option <?php if(isset($lead_source) && $lead_source == 'Exhibition') echo 'selected';?> value="Exhibition">Exhibition</option>
												</select>
											</div>				
											<div class="form-group">
												<label for="consumer_name">Consumer Name </label>
												<input type="text" name="consumer_name" class="form-control" id="consumer_name" <?php if(isset($consumer_name)) echo 'value="'.$consumer_name.'"'?>>
											</div>																				
											<div class="form-group">
												<label for="consumer_phone">Consumer Phone</label>
												<input type="text" name="consumer_phone" class="form-control" id="consumer_phone" <?php if(isset($consumer_name)) echo 'value="'.$consumer_phone.'"'?> >
											</div>																				
											<div class="form-group">
												<label for="consumer_address">Consumer Address</label>
												<input type="text" name="consumer_address" class="form-control" id="consumer_address" <?php if(isset($consumer_address)) echo 'value='.$consumer_address;?>>
											</div>																				
											<div class="form-group">
												<label for="dealer">Dealer </label>
												<input type="text" name="dealer" class="form-control ignore" id="dealer" <?php if(isset($dealer)) echo 'value='.$dealer;?>>
											</div>																				
											<button type="button" class="btn btn-next btn-primary">Next</button>
										</div>
									</fieldset>
									
									<!------------------ BLOCK 1 END ------------------------->	



									<!------------------ BLOCK 2 ------------------------->		
									<fieldset id="f2">
										<div class="form-top">
											<div class="form-top-left">
												<h3>Page 2</h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="consumer_type">Consumer Type</label>
												<select id="consumer_type" name="consumer_type" class="form-control">
													<option value=""></option>
													<option <?php if(isset($consumer_type) && $consumer_type == 'IHB') echo 'selected';?> value="IHB">IHB</option>
													<option <?php if(isset($consumer_type) && $consumer_type == 'Engineer') echo 'selected';?> value="Engineer">Engineer</option>
													<option <?php if(isset($consumer_type) && $consumer_type == 'Dealership Query') echo 'selected';?> value="Dealership Query">Dealership Query</option>
													<option <?php if(isset($consumer_type) && $consumer_type == 'Contractor') echo 'selected';?> value="Contractor">Contractor</option>
												</select>
											</div>														
											<div class="form-group">
												<label for="door_requirement">Door requirement</label>
												<input type="text" name="door_requirement" class="form-control ignore" id="door_requirement" <?php if(isset($door_requirement)) echo 'value="'.$door_requirement.'"'?>>
											</div>
											<div class="form-group">
												<label for="window_requirement">Window requirement</label>
												<input type="text" name="window_requirement" class="form-control ignore" id="window_requirement" <?php if(isset($window_requirement)) echo 'value="'.$window_requirement.'"'?>>
											</div>											
											<div class="form-group">
												<label for="stage">Stage of Construction</label>
												<select id="stage" name="stage" class="form-control">
													<option value=""></option>
													<option <?php if(isset($stage) && $stage == 'Planning') echo 'selected';?> value="Planning">Planning</option>
													<option <?php if(isset($stage) && $stage == 'Foundation') echo 'selected';?> value="Foundation">Foundation</option>
													<option <?php if(isset($stage) && $stage == 'Slab Casting') echo 'selected';?> value="Slab Casting">Slab Casting</option>
													<option <?php if(isset($stage) && $stage == 'Brick Work') echo 'selected';?> value="Brick Work">Brick Work</option>
													<option <?php if(isset($stage) && $stage == 'Piller Work') echo 'selected';?> value="Piller Work">Piller Work</option>
													<option <?php if(isset($stage) && $stage == 'Plastering') echo 'selected';?> value="Plastering">Plastering</option>	
												</select>
											</div>				
											<div class="form-group">
												<label for="priority">Priority</label>
												<select id="priority" name="priority" class="form-control">
													<option value=""></option>
													<option <?php if(isset($priority) && $priority == 'Hot') echo 'selected';?> value="Hot">Hot</option>
													<option <?php if(isset($priority) && $priority == 'Warm') echo 'selected';?> value="Warm">Warm</option>
													<option <?php if(isset($priority) && $priority == 'Cold') echo 'selected';?> value="Cold">Cold</option>
												</select>
											</div>				
											<div class="form-group">
												<label for="store_visit">Store Visited On</label>
												<input type="text" name="store_visit" class="form-control ignore" id="store_visit" value="<?php if(isset($store_visit)) echo $store_visit;?>">
											</div>															
											<button type="button" class="btn btn-previous btn-primary">Previous</button>
											<button type="button" class="btn btn-next btn-primary">Next</button>
										</div>
									</fieldset>
									<!------------------ BLOCK 2 End ------------------------->	
									
									
									
									<!------------------ BLOCK 3 ------------------------->	
									<fieldset id="f3">
										<div class="form-top">
											<div class="form-top-left">
												<h3>Page 3</h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="demo_date">Demo Date </label>
												<input type="text" name="demo_date" class="form-control ignore" id="demo_date" value="<?php if(isset($demo_date)) echo $demo_date;?>">
											</div>
											<div class="form-group">
												<label for="next_followup_date">Next Followup Date</label>
												<input type="text" name="next_followup_date" class="form-control ignore" id="next_followup_date" value="<?php if(isset($next_followup_date)) echo $next_followup_date;?>">
											</div>
											<div class="form-group">
												<label for="order_status">Order Status</label>
												<select id="order_status" name="order_status" class="form-control">
													<option <?php if(isset($order_status) && $order_status == 'Open') echo 'Open';?> value="Open">Open</option>
													<option <?php if(isset($order_status) && $order_status == 'Delivery/Fitting Pending') echo 'Delivery/Fitting Pending';?> value="Delivery/Fitting Pending">Delivery/Fitting Pending</option>
													<option <?php if(isset($order_status) && $order_status == 'Closed') echo 'Closed';?> value="Closed">Closed</option>
													<option <?php if(isset($order_status) && $order_status == 'Lost') echo 'Lost';?> value="Lost">Lost</option>
												</select>	
											</div>
											<div class="form-group">
												<label for="reason_for_loss">Reason for Loss</label>
												<input type="text" name="reason_for_loss" class="form-control ignore" id="reason_for_loss" <?php if(isset($reason_for_loss)) echo 'value='.$reason_for_loss;?>>
											</div>
											<div class="form-group">
												<label for="advance_received">Advance Received?</label>
												<select id="advance_received" name="advance_received" class="form-control">
													<option <?php if(isset($advance_received) && $advance_received == 'Yes') echo 'Yes';?> value="Yes">Yes</option>
													<option <?php if(isset($advance_received) && $advance_received == 'No') echo 'No';?> value="No">No</option>
												</select>	
											</div>
											<div class="form-group">
												<label for="remarks">Remarks</label>
												<input type="text" name="remarks" class="form-control ignore" id="remarks" <?php if(isset($remarks)) echo 'value='.$remarks;?>>
											</div>											
											
											<button type="button" class="btn btn-previous btn-primary">Previous</button>
											<button type="submit" class="btn btn-success">Save & Exit  <i class="fas fa-save"></i></button>										
										</div>
									</fieldset>
									<!------------------ BLOCK 3 End ------------------------->	
									
									
			
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
			<script src="assets/js/blockFunctions.js"></script>
			<script src="assets/js/saveFunctions.js"></script>
			<script>
				$(function() {
					var lead_assigned_date = { dateFormat:"dd-mm-yy"}; 
					$( "#lead_assigned_date" ).datepicker(lead_assigned_date);
					
					var demo_date = { dateFormat:"dd-mm-yy"}; 
					$( "#demo_date" ).datepicker(demo_date);					
					
					var next_followup_date = { dateFormat:"dd-mm-yy"};
					$( "#next_followup_date" ).datepicker(next_followup_date);
					
					var store_visit = { dateFormat:"dd-mm-yy"};
					$( "#store_visit" ).datepicker(store_visit);					
				});
			</script>
		</body>
	</html>																																							<?php		
}
else
	header("Location:loginPage.php");