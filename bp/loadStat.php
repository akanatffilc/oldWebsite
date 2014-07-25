<?php
	$year = $_POST['year'];
	require_once('../mysqli.php');		
	$q = "SELECT name FROM roster WHERE years LIKE '%$year%'";
	$r = mysqli_query($dbc, $q);
	$attrs = array( 'name', 'fgm', 'fga', '3pt fgm', '3pt fga', 'ftm', 'fta', 'off reb', 'def reb', 'ast', 'stl', 'blk', 'to', 'foul');
	$month_names = array("January","February","March","April","May","June","July","August","September","October","November","December");
	$statTable = '<div>opponent: <input name=opponent type=text /></div>';
	$statTable .= '<div>gym address: <input name=gymaddress size=30 type=text /></div>';
	$statTable .= '<div>date: <select class=month >';
	for( $i = 0; $i < count($month_names); $i++ ){
		$statTable .= '<option class='.$i.'>'.$month_names[$i].'</option>';
	}
	$statTable .= '</select>';
	$statTable .= '<select class=day></select>&nbsp;&nbsp;<select id=statdow ><option>Monday</option><option>Tuesday</option><option>Wednesday</option><option>Thursday</option><option>Friday</option><option>Saturday</option><option>Sunday</option></select>';
	$statTable .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;time: <select class=timehr><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option></select>:<select class=timemin><option>00</option><option>15</option><option>30</option><option>45</option></select> <select class=ampm><option>am</option><option>pm</option></select></div><br/>';
	$statTable .= '<table cellspacing=0 id=new-stat-table><tbody><tr>';
	foreach( $attrs as $attribute ){
		$statTable .= '<th>'.$attribute.'</th>';
	}
	$count = 0;
	$alt;
	$statTable .= '</tr>';
	if($r){
		while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				$count++;
				( $count % 2 == 0 ) ? $alt = 'even' : $alt = 'odd';
				$statTable .= '<tr class="'.$alt.' input"><td class=name>'.$row['name'].'</td>';
				$statTable .= '<td class=fgm><input name="fgm-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=fga><input name="fga-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=3fgm><input name="3fgm-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=3fga><input name="3fga-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=ftm><input name="ftm-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=fta><input name="fta-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=offreb><input name="offreb-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=defreb><input name="defreb-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=ast><input name="ast-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=stl><input name="stl-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=blk><input name="blk-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=to><input name="to-'.$row['name'].'" size="3" type="text" /></td>';
				$statTable .= '<td class=foul><input name="foul-'.$row['name'].'" size="3" type="text" /></td></tr>';
		}
		mysqli_free_result($r);
	} else {
		echo '<span>Unable to retrieve query.</span><br/>';
		echo '<span>'.mysqli_error().'</span>';
	}
	$statTable .= '<tr><td>Total</td>';
	$statTable .= '<td><span class="fgm-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="fga-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="3fgm-total" size="3" type="text" ></span></td>';
	$statTable .= '<td><span class="3fga-total" size="3" type="text" ></span></td>';
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
	$statTable .= '<div id=new-stat-submit>submit</div>';
	
	echo $statTable;
	mysqli_close($dbc);
?>
