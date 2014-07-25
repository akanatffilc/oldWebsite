<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script>
		<script src="js/javascript.js" type="text/javascript"></script>
		<script src="js/viewer.js" type="text/javascript"></script>
		<!--[if IE]>
		  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href='css/stylesheet.css' rel='stylesheet' type='text/css'>
		<link href='css/viewer.css' rel='stylesheet' type='text/css'>
		<link href='css/art.css' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="content">
			<div id="left">
				<div id="container">
					<div id="inner-container">
<?php 
	$t = '';
	if( isset( $_GET['t'] ) ){
		$t = $_GET['t'];
	}
	if( !$t ){
?>
						<div class="gallery">
							<h1>Commissions</h1>
							<div class="gallery-container">
								<div class="gallery-button-prev"></div>
								<ul class="gallery-inner">
									<a href="?t=sgi"><li>
										<div class="image"><img src="images/Commissions/sgi_usa_commish_icon.png"/></div>
										<h2 class="t1">test title line 1</h2>
										<h2 class="t2">test title line 2</h2>
										<h3 class="desc">test title description</h3>
									</li></a>
									<a href="?t=pbrc"><li>
										<div class="image"><img src="images/Commissions/sua_pbrc_commish_icon.png"/></div>
										<h2 class="t1">test title line 1</h2>
										<h2 class="t2">test title line 2</h2>
										<h3 class="desc">test title description</h3>
									</li></a>
									<a href="?t=other"><li>
										<div class="image"><img src="images/Commissions/other_commish_icon.png"/></div>
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
			case "sgi":
				$title = 'SGI USA Commission';
				$images[] = array('1_sgiusa_thumb.jpg','1_nuclear_doves.jpg');
				$images[] = array('2_sgiusa_thumb.jpg','2_YWDcircle.jpg');
				$images[] = array('3_sgiusa_thumb.jpg','3_kayokai_logo.jpg');
				$images[] = array('4_sgiusa_thumb.jpg','4_kayokai_logo_drafting.jpg');
				$images[] = array('5_sgiusa_thumb.jpg','5_kayokai_logo_drafting.jpg');
				$images[] = array('6_sgiusa_thumb.jpg','6_nuclear_birds_drafting.jpg');
				$images[] = array('7_sgiusa_thumb.jpg','7_nuclear_ver2_drafting.jpg');
				$images[] = array('8_sgiusa_thumb.jpg','8_nuclear_ver3_drafting.jpg');
				$directory = 'images/Commissions/SGI/';
				break;
			case "pbrc":
				$title = 'PBRC Logo Design';
				$images[] = array('1_pbrc_thumb.jpg','final_pbrc_logo4_gradient.jpg');
				$images[] = array('2_pbrc_thumb.jpg','PBRC_logo_design_batch_2.jpg');
				$images[] = array('3_pbrc_thumb.jpg','PBRClogo_drafts2.jpg');
				$directory = 'images/Commissions/PBRC/';
				break;
			case "other":
				$title = 'Other Commissions';
				$images[] = array('commish_cheylyne_thumb.jpg','commish_cheylyne.jpg');
				$images[] = array('commish_jessie_thumb.jpg','commish_jessie.jpg');
				$images[] = array('commish_kaitlyn_birthday_thumb.jpg','commish_kaitlyn_birthday_ver4.jpg');
				$images[] = array('naruto_thumb.jpg','commission_naruto.jpg');
				$images[] = array('FML_harry_potter_contacts_thumb.jpg','FML_harry_potter_contacts.jpg');
				$images[] = array('happy_birthday_natalie_thumb.jpg','happy_birthday_natalie.jpg');
				$images[] = array('julieanddhan_thumb.jpg','julieanddhan.jpg');
				$images[] = array('lisa_save_the_date_thumb.jpg','lisa_save_the_date.jpg');
				$images[] = array('LP_Link_thumb.jpg','LP_Link.jpg');
				$directory = 'images/Commissions/Other/';
				break;
		}
		include('include/viewer.php');
?>
<?php
	}
?>
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
		<div id="back"><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><img src="images/back_to_commissions_gallery_icon.png"/></a></div>
<?php
	}
?>
	</body>
</html>