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
			form,
			#errors,
			#subscribed{
				width:300px;
				margin:0px auto;
			}
			#errors{
				color:red;
			}
			#subscribed{
				color:green;
			}
			input[type="text"]{
				border: 1px solid silver;
				padding: 2px;
				margin: 10px 0px;
				font-size: 1em;
			}
			input[type="submit"]{
				border: 1px solid grey;
				background: silver;
				color: white;
				padding: 5px;
				font-size: 1em;
				margin:10px 0px;
			}
		</style>
	</head>
	<body>
		<div id="content">
			<div id="nav">
			</div>
			<div id="container">
<?php
	$notSubscribed = true;

	if( isset( $_POST['submit'] ) ){
		$errormessage = array();
		$username = $_POST['username'];
		$email = $_POST['email'];
		include($_SERVER['DOCUMENT_ROOT'].'/db/SQLQuery.php');
		$sql = new SQLQuery();
		$sql->connect('clifftanaka');
		$q = "SELECT * FROM blogsubscription WHERE username = '$username'";
		$result = $sql->query($q);
		if( $sql->getNumRows() > 0 ){
			$errormessage[] = 'user name already exists.';
		}
		$q = "SELECT * FROM blogsubscription WHERE email = '$email'";
		$result = $sql->query($q);
		if( $sql->getNumRows() > 0 ){
			$errormessage[] = 'email already exists.';
		}
		if( $username == '' ){
			$errormessage[] = 'enter a username.';
		} 
		if( $email == '' ){
			$errormessage[] = 'enter an email address.';
		}
		if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
			$errormessage[] = 'enter a valid email address.';
		}
		if( count( $errormessage ) > 0 ){
?>
				<div id="errors">
<?php
					foreach( $errormessage as $message ){
						echo "<p>$message</p>";
					}
?>
				</div>
<?php
		} else {
			$result = $sql->query("INSERT INTO blogsubscription(username, email, time) VALUES('$username', '$email', NOW())");
			$notSubscribed = false;
			echo "<div id=subscribed><p>Subscribed.</p><p>check your email for confirmation.</p></div>";
		}
	}
	if( $notSubscribed ){
?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<p>
						<label for="username">user name: </label><br/>
						<input name="username" type="text" value="<?php if( isset( $_POST['submit'] ) ){ echo $_POST['username']; } ?>"/>
					</p>
					<p>
						<label for="email">email: </label><br/>
						<input name="email" type="text" value="<?php if( isset( $_POST['submit'] ) ){ echo $_POST['email']; } ?>"/>
					</p>
					<p>
						<input type="submit" name="submit" value="Subscribe"/>
					</p>
				</form>
<?php
	}
?>
			</div>
			<div id="bottom">
				<span id="copy">&copy; clifftanaka.com 2012</span>
			</div>
		</div>
	</body>
</html>