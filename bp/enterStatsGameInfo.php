<?php
$year = $_POST['year'];
$name = $_POST['name'];
$gymaddress = $_POST['gymaddress'];
$time = $_POST['time'];
$month = $_POST['month'];
$day = $_POST['day'];
$dow = $_POST['dow'];
$opponent = $_POST['opponent'];
require_once('../mysqli.php');		
$q = "INSERT INTO games ( year, opponent, gymaddress, time, month, day, dow) VALUES ('$year', '$opponent', '$gymaddress', '$time', '$month', '$day', '$dow')";
$r = mysqli_query($dbc, $q);
if($r){
	mysqli_free_result($r);
} else {
	echo '<span>Unable to retrieve query.</span><br/>';
	echo '<span>'.mysqli_error().'</span>';
}
mysqli_close($dbc);
		
?>