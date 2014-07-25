<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script>
		<script src="js/javascript.js" type="text/javascript"></script>
		<script src="js/projectviewer.js" type="text/javascript"></script>
		<!--[if IE]>
		  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href='css/stylesheet.css' rel='stylesheet' type='text/css'>
		<link href='css/projectviewer.css' rel='stylesheet' type='text/css'>
		<link href='css/art.css' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="content">
			<div id="left">
				<div id="container" class="loading">
					<div id="loader"><div id="bar"><div id="progress"></div><img src="images/progress.gif"/></div></div>
					<div id="inner-container">
<?php 
	$t = '';
	if( isset( $_GET['t'] ) ){
		$t = $_GET['t'];
	}
	if( !$t ){
?>
						<div class="gallery">
							<h1>Projects</h1>
							<div class="gallery-container">
								<div class="gallery-button-prev"></div>
								<ul class="gallery-inner">
									<a href="?t=capstone"><li>
										<div class="image"><img src="images/Projects/capstone_spatiality_icon.png"/></div>
										<h2 class="t1">test title line 1</h2>
										<h2 class="t2">test title line 2</h2>
										<h3 class="desc">test title description</h3>
									</li></a>
									<a href="?t=pearl"><li>
										<div class="image"><img src="images/Projects/10_anniversary_pearl_icon.png"/></div>
										<h2 class="t1">test title line 1</h2>
										<h2 class="t2">test title line 2</h2>
										<h3 class="desc">test title description</h3>
									</li></a>
									<a href="#"><li>
										<div class="image"><img src="images/Projects/project_on_soka_education_exhibition_icon.png"/></div>
										<h2 class="t1">test title line 1</h2>
										<h2 class="t2">test title line 2</h2>
										<h3 class="desc">test title description</h3>
									</li></a>
								</ul>
								<div class="gallery-button-next"></div>
							</div>
						</div>
<?php
	} else {
		$title = '';
		$images = array();
		switch( $t ){
			case "capstone":
				$title = 'Capstone';
				$images[] = 'capstone_0.jpg';
				$images[] = 'capstone_2.jpg';
				$images[] = 'capstone_3.jpg';
				$images[] = 'capstone_4.jpg';
				$images[] = 'capstone_5.jpg';
				$images[] = 'capstone_6.jpg';
				$images[] = 'capstone_7.jpg';
				$images[] = 'capstone_8.jpg';
				$images[] = 'capstone_9.jpg';
				$images[] = 'capstone_10.jpg';
				$images[] = 'capstone_11.jpg';
				$images[] = 'capstone_12.jpg';
				$images[] = 'capstone_13.jpg';
				$images[] = 'capstone_14.jpg';
				$images[] = 'capstone_15.jpg';
				$images[] = 'capstone_16.jpg';
				$images[] = 'capstone_17.jpg';
				$images[] = 'capstone_18.jpg';
				$images[] = 'capstone_19.jpg';
				$images[] = 'capstone_20.jpg';
				$images[] = 'capstone_21.jpg';
				$images[] = 'capstone_22.jpg';
				$images[] = 'capstone_23.jpg';
				$images[] = 'capstone_24.jpg';
				$images[] = 'capstone_25.jpg';
				$images[] = 'capstone_26.jpg';
				$images[] = 'capstone_27.jpg';
				$images[] = 'capstone_28.jpg';
				$images[] = 'capstone_29.jpg';
				$images[] = 'capstone_30.jpg';
				$images[] = 'capstone_31.jpg';
				$images[] = 'capstone_32.jpg';
				$images[] = 'capstone_33.jpg';
				$images[] = 'capstone_34.jpg';
				$images[] = 'capstone_35.jpg';
				$directory = 'images/Projects/Capstone/';
				break;
			case "pearl":
				$title = '10th Anniv Pearl';
				$images[] = 'pearl_0.jpg';
				$images[] = 'pearl_1.jpg';
				$images[] = 'pearl_2.jpg';
				$images[] = 'pearl_3.jpg';
				$images[] = 'pearl_4.jpg';
				$images[] = 'pearl_5.jpg';
				$images[] = 'pearl_6.jpg';
				$images[] = 'pearl_7.jpg';
				$images[] = 'pearl_8.jpg';
				$images[] = 'pearl_9.jpg';
				$images[] = 'pearl_10.jpg';
				$images[] = 'pearl_11.jpg';
				$images[] = 'pearl_12.jpg';
				$images[] = 'pearl_13.jpg';
				$images[] = 'pearl_14.jpg';
				$images[] = 'pearl_15.jpg';
				$images[] = 'pearl_16.jpg';
				$images[] = 'pearl_17.jpg';
				$images[] = 'pearl_18.jpg';
				$images[] = 'pearl_19.jpg';
				$images[] = 'pearl_20.jpg';
				$images[] = 'pearl_21.jpg';
				$images[] = 'pearl_22.jpg';
				$images[] = 'pearl_23.jpg';
				$images[] = 'pearl_24.jpg';
				$images[] = 'pearl_25.jpg';
				$images[] = 'pearl_26.jpg';
				$images[] = 'pearl_27.jpg';
				$images[] = 'pearl_back.jpg';
				$directory = 'images/Projects/Pearl/';
				break;
			case "pose":
				$title = 'Project On Soka Education';
				$images[] = '';
				$directory = '';
				break;
		}
		include('include/projectviewer.php');
?>
<?php
	}
?>
					</div>
				</div>
				<div id="tab">
					<div id="tab-inner">
						<h3><?php echo $title; ?></h3>
						<div class="pick">Pick a chapter to view</div>
						<ul>
						</ul>
					</div>
				</div>
			</div>
			<div id="right">
<?php include('include/ribbon.php'); ?>
			</div>
		</div>
		<div id="zoom">
			<img src=""/>
			<div id="zoom-close">&times;</div>
		</div>
<?php
	if( $t ){
?>
		<div id="back"><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><img src="images/back_to_projects_gallery_icon.png"/></a></div>
<?php
	}
?>
	</body>
</html>