<?php
	$year = $_POST['year'];
	$opponent = $_POST['opponent'];
	require_once('../mysqli.php');		
	
	$statTable = '<div>gym address: <span class="editable gymaddress"></span></div>';
	$statTable .= '<div>date: <span class="statdow" >, </span><span class="month" ></span> <span class="day"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;time: <span class=timehr></span>:<span class=timemin></span><span class=ampm></span></div>';
	
	$q = "SELECT * FROM stats WHERE year LIKE '$year' AND opponent LIKE '$opponent'";
	$r = mysqli_query($dbc, $q);
	$attrs = array( 'name', 'fgm', 'fga', '3fgm', '3fga', 'ftm', 'fta', 'off reb', 'def reb', 'ast', 'stl', 'blk', 'to', 'foul');
	$classes = array( 'name', 'fgm', 'fga', '3ptfgm', '3ptfga', 'ftm', 'fta', 'offreb', 'defreb', 'ast', 'stl', 'blk', 'to', 'foul');
	$statTable .= '<table cellspacing=0 id=view-stat-table><tbody><tr>';
	for( $i = 0; $i <  count($attrs); $i++ ){
		$statTable .= '<th class='.$classes[$i].'>'.$attrs[$i].'</th>';
	}
	$statTable .= '</tr>';
	$count = 0;
	$alt;
	if($r){
		while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				$count++;
				( $count % 2 == 0 ) ? $alt = 'even' : $alt = 'odd';
				$statTable .= '<tr class="'.$alt.' name"><td class=namevalue>'.$row['name'].'</td>';
				$statTable .= '<td class="editable fgm">'.$row['fgm'].'</td>';
				$statTable .= '<td class="editable fga">'.$row['fga'].'</td>';
				$statTable .= '<td class="editable 3ptfgm">'.$row['3ptfgm'].'</td>';
				$statTable .= '<td class="editable 3ptfga">'.$row['3ptfga'].'</td>';
				$statTable .= '<td class="editable ftm">'.$row['ftm'].'</td>';
				$statTable .= '<td class="editable fta">'.$row['fta'].'</td>';
				$statTable .= '<td class="editable offreb">'.$row['offreb'].'</td>';
				$statTable .= '<td class="editable defreb">'.$row['defreb'].'</td>';
				$statTable .= '<td class="editable ast">'.$row['ast'].'</td>';
				$statTable .= '<td class="editable stl">'.$row['stl'].'</td>';
				$statTable .= '<td class="editable blk">'.$row['blk'].'</td>';
				$statTable .= '<td class="editable turnover">'.$row['turnover'].'</td>';
				$statTable .= '<td class="editable foul">'.$row['foul'].'</td></tr>';
		}
		mysqli_free_result($r);
	} else {
		echo '<span>Unable to retrieve query.</span><br/>';
		echo '<span>'.mysqli_error().'</span>';
	}
	$statTable .= '<tr><td>Total</td>';
	$statTable .= '<td><span class="fgm-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="fga-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="3ptfgm-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="3ptfga-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="ftm-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="fta-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="offreb-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="defreb-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="ast-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="stl-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="blk-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="to-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="foul-total" size="3" type="text" ></span></td></tr>';
	$statTable .= '</tbody></table>';
	
	echo $statTable;
	mysqli_close($dbc);
?>
