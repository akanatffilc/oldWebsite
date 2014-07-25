<?php
	function page_protect(){
		$oneDay = 60 * 60 * 24 + time(); 
		if (isset($_COOKIE['lastVisit'])) {
			$old =  $_COOKIE['lastVisit'];
			setcookie('lastVisit', date("G:i - m/d/y"), $oneDay); 
			$new = $_COOKIE['lastVisit'];
		} else {
?>
<script type="text/javascript>login_splash()</script>
<?php
		}
	}
?>