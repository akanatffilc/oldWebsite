<?php
	$year = $_POST['year'];
	require_once('../mysqli.php');		
	$q = "SELECT opponent FROM games WHERE year LIKE '%$year%'";
	$r = mysqli_query($dbc, $q);
	$select = 'opponent: <select id=selectOpponent>';
	if($r){
		while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				$select .= '<option>'.$row['opponent'].'</option>';
		}
		mysqli_free_result($r);
	} else {
		echo '<span>Unable to retrieve query.</span><br/>';
		echo '<span>'.mysqli_error().'</span>';
	}
	$select .= '</select>';
	echo $select;
	mysqli_close($dbc);
?>
