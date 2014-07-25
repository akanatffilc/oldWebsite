<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
		<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script>
		<script src="js/javascript.js" type="text/javascript"></script>
		<!--[if IE]>
		  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Poly' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Petrona' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/blog.css"/>
		<link rel="stylesheet" type="text/css" href="css/about.css"/>
		<link rel="stylesheet" type="text/css" href="css/projects.css"/>
		<style type="text/css">
		
		</style>
	</head>
	<body>
		<div id="content">
			<div id="nav">
			</div>
			<div id="container">
<?php
	
	if( isset( $_GET['email'] ) ){
		$email = $_GET['email'];
		echo $email;
		include($_SERVER['DOCUMENT_ROOT'].'/db/SQLQuery.php');
		$sql = new SQLQuery();
		$sql->connect('clifftanaka');
		$q = "UPDATE blogsubscription SET inactive=1 WHERE email = '$email'";
		$result = $sql->query($q);
		if( $sql->getResult() ){
			echo "Unsubscribed";
		} else {
			echo "Error connecting to Database";
		}
	} else {
			echo "No email provided";
	}
?>
				</div>
			</div>
			<div id="bottom">
				<span id="copy">&copy; clifftanaka.com 2012</span>
			</div>
		</div>
	</body>
</html>