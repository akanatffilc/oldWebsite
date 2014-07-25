<?php
	$year = $_POST['year'];
	$opponent = $_POST['opponent'];
	$name = $_POST['player'];
	$field = $_POST['field'];
	$value = $_POST['value'];
	require_once ('../mysqli.php'); // Connect to the db.
	$q = "UPDATE stats SET $field =  $value WHERE year = '$year' AND opponent = '$opponent' AND name = '$name'";		
	$r = @mysqli_query ($dbc, $q); // Run the query.
	if($r){
		while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		}
		mysqli_free_result($r);
	} else {
		echo '<span>Unable to retrieve query.</span><br/>';
		echo '<span>'.$q.'</span>';
	}
	mysqli_close($dbc);
?>