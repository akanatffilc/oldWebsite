<?php
$stats = $_POST['stats'];
$year = $_POST['year'];
$name = $_POST['name'];
$opponent = $_POST['opponent'];
require_once('../mysqli.php');		
$q = "INSERT INTO stats (year, opponent, name, fgm, fga, 3ptfgm, 3ptfga, ftm, fta, offreb, defreb, ast, stl, blk, turnover, foul) VALUES ('$year', '$opponent', '$name', $stats[0], $stats[1], $stats[2], $stats[3], $stats[4], $stats[5], $stats[6], $stats[7], $stats[8], $stats[9], $stats[10], $stats[11], $stats[12] )";
$r = mysqli_query($dbc, $q);
if($r){
	mysqli_free_result($r);
} else {
	echo '<span>Unable to retrieve query.</span><br/>';
	echo '<span>'.mysqli_error().'</span>';
}
mysqli_close($dbc);
		
?>