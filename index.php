<?php
	$page = '';
	if( isset($_GET['page']) ){
		$page = $_GET['page'];
	}
?>
<!doctype html>
<html>
	<head>
		 <meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
		<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-24823024-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
		</script>
	</head>
	<body>
		<div id="content">
			<div id="nav">
				<div class="nav-item <?php if( $page == 'about' ){ echo 'active'; }?>" id="nav-about"><p class="color"></p><p class="arrow"><span></span></p><p class="title">about / contact</p></div>
				<div class="nav-item <?php if( $page == '' || $page == 'projects' ){ echo 'active'; }?>" id="nav-projects"><p class="color"></p><p class="arrow"><span></span></p><p class="title">projects</p></div>
				<div class="nav-item <?php if( $page == 'blog' ){ echo 'active'; }?>" id="nav-blog"><p class="color"></p><p class="arrow"><span></span></p><p class="title">blog</p></div>
			</div>
			<div id="container">
<?php
	$pos = 'left:-100%';
	switch( $page ){
		case "about":
			$pos = 'left:-0%';
			break;
		case "blog":
			$pos = 'left:-200%';
			break;
	}
?>
				<ul id="inner" style="<?php echo $pos; ?>">
					<li id="about">
<?php
						if( $page == 'about'){
							include('includes/about.php');
						} else {
							include('includes/loading.php');
						}
?>
					</li>
					<li id="projects">
<?php
						if( $page == 'projects' || $page == '' ){
							include('includes/projects.php');
						} else {
							include('includes/loading.php');
						}
?>
					</li>
					<li id="blog">
<?php
						if( $page == 'blog'){
							include('includes/blog.php');
						} else {
							include('includes/loading.php');
						}
?>
					</li>
				</ul>
			</div>
			<div id="bottom">
				<span id="copy">&copy; clifftanaka.com 2012</span>
			</div>
		</div>
	</body>
</html>