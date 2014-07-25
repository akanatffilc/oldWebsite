<?php 
	$link = mysql_connect('clifftanakacom1.ipagemysql.com', 'kurifu', 'kosenrufu2030'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
mysql_select_db(clifftanaka); 
?>