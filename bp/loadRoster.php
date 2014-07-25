<?php
$year = $_POST['year'];
require_once('../mysqli.php');		
$q = "SELECT * FROM roster WHERE years LIKE '%$year%'";
$r = mysqli_query($dbc, $q);
$roster;
if($r){
	while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			$roster .= '<div class=player-card>';
			$roster .= '<img src=""/>';
			$roster .= '<div class="player-bio player-name">'.$row['name'].'</div>';
			/*
			$roster .= '<div class="player-bio player-name"><p class="player-label player-name-label">name:&nbsp;&nbsp;</p><p class="player-value player-name-value">'.$row['name'].'</p></div>';
			$roster .= '<div class="player-bio player-number"><p class="player-label player-number-label">number:&nbsp;&nbsp;</p><p class="player-value player-number-value">'.$row['number'].'</p></div>';
			$roster .= '<div class="player-bio player-position"><p class="player-label player-position-label">position:&nbsp;&nbsp;</p><p class="player-value player-position-value">'.$row['position'].'</p></div>';
			$roster .= '<div class="player-bio player-height"><p class="player-label player-height-label">height:&nbsp;&nbsp;</p><p class="player-value player-height-value">'.$row['height'].'</p></div>';
			$roster .= '<div class="player-bio player-weight"><p class="player-label player-weight-label">weight:&nbsp;&nbsp;</p><p class="player-value player-weight-value">'.$row['weight'].'</p></div>';
			$roster .= '<div class="player-bio player-birthdate"><p class="player-label player-birthdate-label">birth date:&nbsp;&nbsp;</p><p class="player-value player-birthdate-value">'.$row['birthdate'].'</p></div>';
			$roster .= '<div class="player-bio player-years"><p class="player-label player-years-label">years:&nbsp;&nbsp;</p><p class="player-value player-years-value">'.$row['years'].'</p></div>';
			$roster .= '<div class="player-bio player-almamater"><p class="player-label player-almamater-label">alma mater:&nbsp;&nbsp;</p><p class="player-value player-almamater-value">'.$row['almamater'].'</p></div>';
			*/
			$roster .= '</div>';
	}
	mysqli_free_result($r);
} else {
	echo '<span>Unable to retrieve query.</span><br/>';
	echo '<span>'.mysqli_error().'</span>';
}

echo $roster;
mysqli_close($dbc);
		
?>