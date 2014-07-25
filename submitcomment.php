<?php
	require_once ('../mysqli.php'); // Connect to the db.
			
	$idraw = $_POST['id'];
	$nameraw = $_POST['name'];
	$commentraw = $_POST['comment'];
	$isValidUser = false;
	$id = mysql_real_escape_string($idraw);
	$name = mysql_real_escape_string($nameraw);
	$comment = mysql_real_escape_string($commentraw);
	$message;
	
	$q = "SELECT * FROM blogsubscription WHERE email = '$name'";		
	$r = mysql_query ($q); // Run the query.
		
	//CHECK DUP USERNAME
	if(mysql_num_rows($r)==0){	
		$message = "invalid";
	} else {
		$isValidUser = true;
		while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			$name = $row['username'];
		}
	}
	
	if( $isValidUser ){
			
		$q = "INSERT INTO blogcomments (entryid, username, comment, time) VALUES ('$id','$name','$comment',NOW() )";		
		$r = mysql_query ($q); // Run the query.
		if ($r) { // If it ran OK.
			
			$emailmessage = "New Comment!\nname: ".$name."\ncomment: \n".$comment."\n\nView here: http://clifftanaka.com/20111121/blog?id=".$id;
			mail('tanaka.cliff@gmail.com',"New Comment!",mb_convert_encoding( $emailmessage, "utf-8", "HTML-ENTITIES" ));
			
			$q = "SELECT * FROM blogcomments WHERE entryid = '$id'";
			$r = mysql_query ($q); // Run the query.
			$totalcomments = 0;
			$names = array();
			
			while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
				
				$exists = false;
				foreach ( $names as $value){
					if( $value == $row['username'] ){
						$exists = true;
					}
				}
				if( !$exists ){
					$names[] = $row['username'];
				}
				
				$totalcomments++;
			}
			
			$q = "UPDATE blog SET comments = '$totalcomments' WHERE id = '$id'";
			$r = mysql_query ($q); // Run the query.
			
			foreach ( $names as $value){
				$q = "SELECT email FROM blogsubscription WHERE username = '$value'";
				$r = mysql_query ($q); // Run the query.
				$email;
				
				while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
					$email = $row['email'];
				}
				$emailmessage = "Someone commented on a post you commented on...\n\n";
				$emailmessage .= "They said:\n";
				$emailmessage .= $commentraw;
				$emailmessage .= "\n\nTo view the original post, go here:\n";
				$emailmessage .= "http://clifftanaka.com/20111121/blog?id=".$id;
				$emailmessage .= "\n\nothers that commented:\n";
				if( $email == 'tanakuri@gmail.com' ){
					foreach ( $names as $value){
						$emailmessage .= $value.', ';
					}
					mail($email,"New Comment!",mb_convert_encoding( $emailmessage, "utf-8", "HTML-ENTITIES" ));
				} else {
					mail($email,"New Comment!",mb_convert_encoding( $emailmessage, "utf-8", "HTML-ENTITIES" ));
				}
			}
			
			$message = 'comment submitted!';
		} else { // If it did not run OK.
			// Public message:
			$message = '<h1>System Error</h1>
			<p class="error">Message not saved due to a system error.</p>'; 
			// Debugging message:
			$message .=  '<p>' . mysql_error($link) . '<br /><br />Query: ' . $q . '</p>'.$r;
		} // End of if ($r)
	} else {
		$message = 'invalid';
	}
	echo $message;
?>