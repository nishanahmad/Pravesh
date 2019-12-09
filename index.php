<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

session_start();
if(isset($_SESSION["user_name"]))
{
	require 'connect.php';
	require 'monthMap.php';
	
	require_once __DIR__ . '/vendor/phpoffice/phpspreadsheet/src/Bootstrap.php';	
	
	if(isset($_GET['fromDate']))
	{
		$sqlFromDate = date('Y-m-d',strtotime($_GET['fromDate']));
		$fromDate = date('d-m-Y',strtotime($sqlFromDate));
		
		$sqlToDate = date('Y-m-d',strtotime($_GET['toDate']));
		$toDate = date('d-m-Y',strtotime($sqlToDate));		
	}
	else
	{
		$sqlFromDate = date('Y-m-01');
		$fromDate = date('d-m-Y',strtotime($sqlFromDate));
		
		$sqlToDate = date('Y-m-d');
		$toDate = date('d-m-Y',strtotime($sqlToDate));		
	}
	
	if($_POST)
	{
		//$date = date('Y-m-d',strtotime($_POST['date']));
		
		$helper = new Sample();
		if ($helper->isCli()) {
			$helper->log('This example should only be run from a Web Browser' . PHP_EOL);

			return;
		}
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Lead Assigned Date')
			->setCellValue('B1', 'Lead Source')
			->setCellValue('C1', 'SE')
			->setCellValue('D1', 'Consumer Name')
			->setCellValue('E1', 'Consumer Contact No')
			->setCellValue('F1', 'Consumer Full Address')
			->setCellValue('G1', 'Dealer')
			->setCellValue('H1', 'Consumer Type')
			->setCellValue('I1', 'Door requirement')
			->setCellValue('J1', 'Window requirement')
			->setCellValue('K1', 'Stage of Construction')
			->setCellValue('L1', 'Priority')
			->setCellValue('M1', 'Demo Date')
			->setCellValue('N1', 'Next Followup Date')
			->setCellValue('O1', 'Order Status')		
			->setCellValue('P1', 'Reason for Loss')
			->setCellValue('Q1', 'Advance Received (Y/N)')
			->setCellValue('R1', 'Store Visit')
			->setCellValue('S1', 'Remarks');
		
		$i = 2;		
		$formList = mysqli_query($con,"SELECT * FROM lead_tracker WHERE lead_assigned_date >= '$sqlFromDate' AND lead_assigned_date <= '$sqlToDate' ") or die(mysqli_error($con));
		foreach($formList as $form)
		{
			$lead_assigned_date = date('d-m-Y',strtotime($form['lead_assigned_date']));
			
			if($form['demo_date'] != null)
				$demo_date = date('d-m-Y',strtotime($form['demo_date']));
			else
				$demo_date = null;

			if($form['next_followup_date'] != null)
				$next_followup_date = date('d-m-Y',strtotime($form['next_followup_date']));
			else
				$next_followup_date = null;
			
			if($form['store_visit'] != null)
				$store_visit = date('d-m-Y',strtotime($form['store_visit']));
			else
				$store_visit = 'No';
			
			$spreadsheet->setActiveSheetIndex(0)
				
				->setCellValue('A'.$i, (string)$lead_assigned_date)    
				->setCellValue('B'.$i, $form['lead_source'])
				->setCellValue('C'.$i, $form['sales_executive'])
				->setCellValue('D'.$i, $form['consumer_name'])
				->setCellValue('E'.$i, $form['consumer_phone'])
				->setCellValue('F'.$i, $form['consumer_address'])
				->setCellValue('G'.$i, $form['dealer'])
				->setCellValue('H'.$i, $form['consumer_type'])
				->setCellValue('I'.$i, $form['door_requirement'])
				->setCellValue('J'.$i, $form['window_requirement'])
				->setCellValue('K'.$i, $form['stage'])
				->setCellValue('L'.$i, $form['priority'])
				->setCellValue('M'.$i, $demo_date)
				->setCellValue('N'.$i, $next_followup_date)
				->setCellValue('O'.$i, $form['order_status'])
				->setCellValue('P'.$i, $form['reason_for_loss'])
				->setCellValue('Q'.$i, $form['advance_received'])
				->setCellValue('R'.$i, $store_visit)
				->setCellValue('S'.$i, $form['remarks']);
				
			$i++;	
		}
				
		
		//Style the sheet
		
		$headerStyleArray = [
			'font' => [
				'bold' => true,
				'name' => 'Arial',
				'size' => 10,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,	
				'wrapText' => true,	
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],						
		];
		
		$styleArray = [
			'font' => [
				'size' => 11,
			],		
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
			],			
		];		
		
		$i = $i-1;
		$spreadsheet->getActiveSheet()->getStyle('A1:S1')->applyFromArray($headerStyleArray);
		$spreadsheet->getActiveSheet()->getStyle('A2:S'.$i)->applyFromArray($styleArray);
		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(12);
		$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(12);
		$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(12);
		$spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(55);
		
		
		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle($fromDate.' to '.$toDate);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a clientâ€™s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fromDate.' to '.$toDate.'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		
		exit;
	}	
?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Home</title>

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
											<div class="input-group">
												<input type="text" name="fromDate" id="fromDate" value="<?php echo $fromDate;?>" onchange="document.location.href = 'index.php?toDate=<?php echo $toDate;?>&fromDate=' + this.value" class="form-control">
												<span class="input-group-addon">- TO -</span>
												<input type="text" name="toDate" id="toDate" value="<?php echo $toDate;?>" onchange="document.location.href = 'index.php?fromDate=<?php echo $fromDate;?>&toDate=' + this.value" class="form-control">												
											</div>
											<br/>
											<a href="form.php" class="btn btn-primary">New&nbsp;&nbsp;<i class="fas fa-plus-square"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
											<button type="submit" class="btn btn-success" style="line-height:0;height:34px;">Excel&nbsp;&nbsp;<i class="fas fa-file-excel-o"></i></button>											
											<br/>
											  <table class="responsive-table">
												<caption><?php echo $fromDate;?>&nbsp;&nbsp;&nbsp;&nbsp;to&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $toDate;?></caption>
												<thead>
												  <tr>
													<th scope="col">Name</th>
													<th scope="col">Date</th>													
													<th scope="col">Address</th>
													<th scope="col"></th>
												  </tr>
												</thead>
												<tfoot>
												</tfoot>
												<tbody>																		<?php
												$leads = mysqli_query($con,"SELECT * FROM lead_tracker WHERE lead_assigned_date >= '$sqlFromDate' AND lead_assigned_date <= '$sqlToDate' ORDER BY lead_assigned_date") or die(mysqli_error($con));												
												foreach($leads as $lead)
												{																							?>
													<tr>
														<th scope="row"><?php echo $lead['consumer_name'];?></th>
														<td scope="row"><?php echo date('d-m-Y',strtotime($lead['lead_assigned_date']));?></td>	
														<td scope="row"><?php echo $lead['consumer_address'];?></td>
														<td><?php if($_SESSION['user_name'] != 'Demo')
																  {																										?>
																	<a href="form.php?id=<?php echo $lead['id'];?>" class="btn btn-success" style="width:80px;">Edit <i class="fas fa-pen"></i></a>
														</td>																																								<?php
																  }																																	?>
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
					var format = { dateFormat:"dd-mm-yy"}; 
					$( "#fromDate" ).datepicker(format);
					$( "#toDate" ).datepicker(format);
				});
			</script>			
		</body>
	</html>
<?php
}
else
	header("Location:loginPage.php");