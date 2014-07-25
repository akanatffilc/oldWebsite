<?php 
	$project = '';
	if( isset($_GET['project']) ){
		$project = $_GET['project'];
	}
	$projects = array();
	$projects['himawari'] = array(
		'title' => "Himawari",
		'desc' => "A concept homepage for popular Japanese Ramen Restaurant Himawari in San Mateo, CA.",
		'images' => array(
			'himawari-big1.png',
			'himawari-big2.png'
		)
	);
	$projects['kindermath'] = array(
		'title' => "KinderMath",
		'desc' => "iPad app for children entering or in Kindergarten to help build number skills, motor skills, listening skills, and patience.<br/>(JS/Knockout/PhoneGap API)",
		'images' => array(
			'kindermath-big1.jpg',
			'kindermath-big2.jpg'
		)
	);
	$projects['kuni'] = array(
		'title' => "Custom Sites",
		'desc' => "Birthday website dedicated to a friend where friends can enter messages online that is compiled and displayed in the form of an \"online scrapbook\".",
		'images' => array(
			'kuni-big1.png',
			'kuni-big2.png'
		)
	);
	$projects['makino'] = array(
		'title' => "yomakino.com",
		'desc' => "Personal homepage for freelance Japanese journalist, Yo Makino",
		'images' => array(
			'makino-big1.png',
			'makino-big2.png'
		)
	);
	$projects['mci'] = array(
		'title' => "MathCoach Interactive",
		'desc' => "Designed, maintained, and developed the home page and online gaming content for an interactive online math coaching program.<br/>(JS/PHP/MySQL)",
		'images' => array(
			'mci-big1.png',
			'mci-big2.png'
		)
	);
	$projects['yahoo'] = array(
		'title' => "Yahoo!",
		'desc' => "A Firefox toolbar extension to increase productivity and efficiency of colleagues for usage and navigation of Yahoo! SVVM UI for Yahoo!'s Search Monkey SEO Project.<br/>(XUL/JS)",
		'images' => array(
			'siefbar.png'
		)
	);
?>
<h1>Projects</h1>
<div id="gallery-container">
	<div id="gallery">
		<img class="<?php if( $project == '' || $project == 'himawari' ){ echo 'active'; } ?>" id="himawari" src="/images/himawari.png"/>
		<img class="<?php if( $project == 'kindermath' ){ echo 'active'; } ?>" id="kindermath" src="/images/kindermath.png"/>
		<img class="<?php if( $project == 'kuni' ){ echo 'active'; } ?>" id="kuni" src="/images/kuni.png"/>
		<img class="<?php if( $project == 'makino' ){ echo 'active'; } ?>" id="makino" src="/images/makino.png"/>
		<img class="<?php if( $project == 'mci' ){ echo 'active'; } ?>" id="mci" src="/images/mci.png"/>
		<img class="<?php if( $project == 'yahoo' ){ echo 'active'; } ?>" id="yahoo" src="/images/yahoo.png"/>
	</div>
</div>
<div id="display">
<?php
	foreach( $projects as $key => $value ){
		echo "<div class=\"project ";
		if( $project == '' && $key == 'himawari' || $key == $project ){
			echo "active";
		} 
		echo "\" id=\"display-$key\">\n";
		echo "<h1>{$value['title']}</h1>";
		echo "<p>{$value['desc']}</p>";
		echo "<div class=\"images\">";
		foreach( $value['images'] as $key => $image ){
			echo "<img src=\"/images/$image\"/>";
		}
		echo "</div>";
		echo "</div>";
	}
?>
</div>
<script src="js/projects.js" type="text/javascript"></script>