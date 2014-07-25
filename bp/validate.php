<?php
		$password = $_POST["password"];
		if ($password == "bp2011") {
			$oneDay = 60 * 60 * 24 + time(); 
			setcookie('lastVisit', date("m/d/y - G:i:s"), $oneDay); 
			echo 'true';
		} else {
			echo 'false';	
		}
?>
