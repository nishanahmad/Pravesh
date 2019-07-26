<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>

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
			</div>
		</nav>

		<!-- Top content -->
		<div class="top-content">
			<div class="inner-bg">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2 form-box">
							<form role="form" action="user_login_session.php" method="post" class="registration-form">
								<div class="form-top">
									<div class="col-sm-8 col-sm-offset-5 text">
										<h3><strong>LOGIN</strong></h3>
									</div>															
									<br/>
									<div align="center">
										<br/>
										<div class="form-group">
											<input type="text" name="user_name" id="user_name" placeholder="&#xF007; User Name" style="font-family:Arial, FontAwesome">
										</div>											
										<div class="form-group">
											<input type="text" name="password" id="password" placeholder="&#xf084; Password" style="font-family:Arial, FontAwesome">
										</div>
										<br/>
										<button type="submit" class="btn btn-success">Enter</i></button>										
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
	</body>
</html>