<?php
	$ty;
	if( isset($_POST['submit']) ){
			include($_SERVER['DOCUMENT_ROOT'].'/db/SQLQuery.php');
			$sql = new SQLQuery();
			$sql->connect('clifftanaka');
			
			$titleraw = $_POST['title'];
			$bodyraw = $_POST['body'];
			$tag1raw = $_POST['tag1'];
			$tag2raw = $_POST['tag2'];
			$tag3raw = $_POST['tag3'];
			$tag1 = mysql_real_escape_string($tag1raw);
			$tag2 = mysql_real_escape_string($tag2raw);
			$tag3 = mysql_real_escape_string($tag3raw);
			$title = mysql_real_escape_string($titleraw);
			$body = mysql_real_escape_string($bodyraw);
			$q = "INSERT INTO blog (title, body, tag1, tag2, tag3, time) VALUES ('$title','$body','$tag1','$tag2','$tag3',NOW() )";		
			$result = $sql->query($q);
			
			if ($sql->getResult()) { // If it ran OK.
				
				$q = "SELECT * FROM blogsubscription WHERE inactive=0";		
				$result = $sql->query($q);
				$id = $sql->getInsertID();
				$sentto = '';
				foreach($result as $value){
						$row = $value['Blogsubscription'];
						$email = $row['email'];
						$name = $row['username'];
						$emailmessage = "Hi ".$name.", \n\n";
						$emailmessage .= "Check out a new blog entry on clifftanaka.com:\n";
						$emailmessage .= $bodyraw."\n\n";
						$emailmessage .= "view the new post here: http://clifftanaka.com/?page=blog&entry=$id\nTo stop receiving email updates on this post, click <a href='http://clifftanaka.com/unsubscribe?email=$email' target='_blank' >here</a>";
						$title_converted = mb_convert_encoding( $title, "utf-8", "HTML-ENTITIES" );
						mail($email, '"'.$title_converted.'" (clifftanaka.com/blog)',mb_convert_encoding( $emailmessage, "utf-8", "HTML-ENTITIES" ));
						$sentto .= $email.'<br/>';
				}
				
				echo $sentto;
				mysql_close($link); // Close the database connection.
				$ty = 'submitted.';
			} else { // If it did not run OK.
				// Public message:
				$ty = '<h1>System Error</h1>
				<p class="error">Message not saved due to a system error.</p>'; 
				// Debugging message:
				$ty .=  '<p>' . mysql_error($link) . '<br /><br />Query: ' . $q . '</p>'.$r;
			} // End of if ($r)
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="jquery-1.6.1.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<style type="text/css">
			body{
				background:#99CCFF;
				background:url('bg.png');
				color:#333;
				font-family:'Lato',"lucida grande",tahoma,verdana,arial,sans-serif;
				margin:0px;
			}
			#content{
				width:960px;
				margin:auto;
			}
		</style>
	</head>
	<body>
		<div id="content">
<?php	
	if( !isset($_POST['submit']) ){
?>
		<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
			<input name="title" size="100" /><br/>
			<textarea name="body" cols="100" rows="40"></textarea><br/>
			<input name="tag1" size="100" /><br/>
			<input name="tag2" size="100" /><br/>
			<input name="tag3" size="100" /><br/>
			<input type="submit" value="submit" name="submit" />
		</form>
<?php 
	} else {
		echo $ty;
	}
?>
		</div>
	</body>
</html>