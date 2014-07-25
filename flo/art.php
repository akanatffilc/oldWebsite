<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script>
		<script src="js/javascript.js" type="text/javascript"></script>
		<script src="js/viewer.js" type="text/javascript"></script>
		<script src="js/jquery.jqzoom-core-pack.js" type="text/javascript"></script>
		<!--[if IE]>
		  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href='css/stylesheet.css' rel='stylesheet' type='text/css'>
		<link href='css/viewer.css' rel='stylesheet' type='text/css'>
		<link href='css/art.css' rel='stylesheet' type='text/css'>
		<link href='css/jquery.jqzoom.css' rel='stylesheet' type='text/css'>
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
							<h1>Art</h1>
							<div class="gallery-container">
								<div class="gallery-button-prev"></div>
								<ul class="gallery-inner">
									<a href="?t=original"><li>
										<div class="image"><img src="images/Art/original_art_icon.png"/></div>
										<h2 class="t1">test title line 1</h2>
										<h2 class="t2">test title line 2</h2>
										<h3 class="desc">test title description</h3>
									</li></a>
									<a href="?t=fan"><li>
										<div class="image"><img src="images/Art/fan_art_icon.png"/></div>
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
			case "original":
				$title = 'ORIGINAL ART';
				$images[] = array('1_Avery_thumb.jpg','1_Avery.jpg');
				$images[] = array('2_paper_whale_thumb.jpg','2_paper_whale.jpg');
				$images[] = array('3_ocean_inc_thumb.jpg','3_ocean_inc.jpg');
				$images[] = array('4_rescue_japan_thumb.jpg','4_rescue_japan.jpg');
				$images[] = array('5_concept_red_fish_thumb.jpg','5_concept_red_fish.jpg');
				$images[] = array('6_ginkgo_id_thumb.jpg','6_ginkgo_id.png');
				$images[] = array('7_june_thumb.jpg','7_june.jpg');
				$images[] = array('8_Weed_Koi_Tattoo_thumb.jpg','8_Weed_Koi_Tattoo.jpg');
				$images[] = array('9_cliff_thumb.jpg','9_cliff.jpg');
				$images[] = array('10_jenny_thumb.jpg','10_jenny.jpg');
				$images[] = array('11_mercury7_thumb.jpg','11_mercury7.jpg');
				$images[] = array('12_mh_karlei_briggs_thumb.jpg','12_mh_karlei_briggs.jpg');
				$directory = 'images/Art/Original/';
				break;
			case "fan":
				$title = 'FAN ART';
				$images[] = array('0_katniss_thumb.jpg','0_hungergames_katniss.jpg');
				$images[] = array('1_tintin_and_milou_thumb.jpg','1_tintin_and_milou.jpg');
				$images[] = array('2_amelie_letters_thumb.jpg','2_amelie_letters.jpg');
				$images[] = array('3_hp_ron_birthday_thumb.jpg','3_hp_ron_birthday.jpg');
				$images[] = array('4_arthur_ariadne_thumb.jpg','4_arthur_ariadne.jpg');
				$images[] = array('5_happy_year_of_the_dragon_2012_thumb.jpg','5_happy_year_of_the_dragon_2012.jpg');
				$images[] = array('6_tangled2_thumb.jpg','6_tangled2.jpg');
				$images[] = array('7_v_unmasked_burn_thumb.jpg','7_v_unmasked_burn.jpg');
				$images[] = array('8_500days_tom_doll_thumb.jpg','8_500days_tom_doll.jpg');
				$images[] = array('9_a_critical_reader_thumb.jpg','9_a_critical_reader.jpg');
				$images[] = array('10_house_thumb.jpg','10_house.jpg');
				$images[] = array('11_masquerade_finn_thumb.jpg','11_masquerade_finn.jpg');
				$images[] = array('12_hp_harry_thumb.jpg','12_hp_harry.jpg');
				$images[] = array('13_hp_hermione_books_and_cleverness_thumb.jpg','13_hp_hermione_books_and_cleverness.jpg');
				$images[] = array('14_hp_goodbyeseverus_thumb.jpg','14_hp_goodbyeseverus.jpg');
				$images[] = array('15_hp_luna_lovegood_thumb.jpg','15_hp_luna_lovegood.jpg');
				$images[] = array('16_favorite_ships_thumb.jpg','16_favorite_ships.jpg');
				$images[] = array('17_favorite_ships2_thumb.jpg','17_favorite_ships2.jpg');
				$images[] = array('18_inception_buddies_thumb.jpg','18_inception_buddies.jpg');
				$images[] = array('19_howl_group2_thumb.jpg','19_howl_group2.jpg');
				$images[] = array('20_howl_couple_thumb.jpg','20_howl_couple.jpg');
				$images[] = array('21_howl_sophie_ring_thumb.jpg','21_howl_sophie_ring.jpg');
				$images[] = array('22_httyd_hiccup_thumb.jpg','22_httyd_hiccup.jpg');
				$images[] = array('23_httyd_astrid_thumb.jpg','23_httyd_astrid.jpg');
				$images[] = array('24_httyd_hiccup_toothless_thumb.jpg','24_httyd_hiccup_toothless.jpg');
				$images[] = array('25_pnp_lizzy_darcyb_thumb.jpg','25_pnp_lizzy_darcyb.jpg');
				$images[] = array('26_pnp_jane_bingley_thumb.jpg','26_pnp_jane_bingley.jpg');
				$images[] = array('27_boondock_saints_thumb.jpg','27_boondock_saints.jpg');
				$directory = 'images/Art/Fan/';
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
		<div id="back"><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><img src="images/back_to_art_gallery_icon.png"/></a></div>
<?php
	}
?>
	</body>
</html>