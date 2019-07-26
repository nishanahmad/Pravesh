<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'connect.php';
session_start();
if(isset($_SESSION["user_name"]))
{
	$id = $_POST['id'];
	if(!empty($_POST['lead_assigned_date']))
		$lead_assigned_date = date('Y-m-d',strtotime($_POST['lead_assigned_date']));
	else
		$lead_assigned_date = null;
	
	$lead_source = $_POST['lead_source'];
	$consumer_name = $_POST['consumer_name'];
	$consumer_phone = $_POST['consumer_phone'];
	$consumer_address = $_POST['consumer_address'];
	$dealer = $_POST['dealer'];
	$consumer_type = $_POST['consumer_type'];
	$door_requirement = $_POST['door_requirement'];
	$window_requirement = $_POST['window_requirement'];
	$stage = $_POST['stage'];
	$priority = $_POST['priority'];

	if(!empty($_POST['demo_date']))
		$demo_date = date('Y-m-d',strtotime($_POST['demo_date']));
	else
		$demo_date = null;
	
	if(!empty($_POST['next_followup_date']))
		$next_followup_date = date('Y-m-d',strtotime($_POST['next_followup_date']));
	else
		$next_followup_date = null;		
	
	$order_status = $_POST['order_status'];
	$reason_for_loss = $_POST['reason_for_loss'];
	$advance_received = $_POST['advance_received'];
	$remarks = $_POST['remarks'];	
	$store_visit = = $_POST['store_visit'];			
	$sales_executive = $_SESSION["user_name"];	
	$created_on = date('Y-m-d H:i:s');		

	if(!empty($id))
	{
		$query="UPDATE lead_tracker SET lead_assigned_date = '$lead_assigned_date',
										lead_source = '$lead_source',
										consumer_name = '$consumer_name',
										consumer_phone = '$consumer_phone',
										consumer_address = '$consumer_address',
										dealer = '$dealer',
										consumer_type = '$consumer_type',
										door_requirement = '$door_requirement',
										window_requirement = '$window_requirement',
										stage = '$stage',
										priority = '$priority',
										demo_date = ".var_export($demo_date, true).",
										next_followup_date = ".var_export($next_followup_date, true).",
										order_status = '$order_status',
										reason_for_loss = '$reason_for_loss',
										advance_received = '$advance_received',
										remarks = '$remarks',
										store_visit = '$store_visit'
									WHERE id = '$id'";
		
		$update = mysqli_query($con, $query) or die(mysqli_error($con));		
	}
	else
	{
		$sql="INSERT INTO lead_tracker (lead_assigned_date, lead_source, consumer_name, consumer_phone, consumer_address, dealer, consumer_type, 
										door_requirement, window_requirement, stage, priority, demo_date, next_followup_date,
										order_status,reason_for_loss,advance_received,sales_executive,created_on)
			 VALUES
			 ('$lead_assigned_date', '$lead_source', '$consumer_name', '$consumer_phone', '$consumer_address', '$dealer', '$consumer_type', 
										'$door_requirement', '$window_requirement', '$stage', '$priority', ".var_export($demo_date, true).", 
										".var_export($next_followup_date, true).",'$order_status','$reason_for_loss','$advance_received',
										'$sales_executive','$store_visit','$created_on')";

		$insert = mysqli_query($con, $sql) or die(mysqli_error($con));		
	}

	header( "Location: index.php" );
}
else
	header( "Location: ../index.php" );
?> 