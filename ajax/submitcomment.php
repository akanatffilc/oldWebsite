<?php
	include($_SERVER['DOCUMENT_ROOT'].'/db/SQLQuery.php');
	$sql = new SQLQuery();
	$sql->connect('clifftanaka');
			
	$idraw = $_POST['id'];
	$nameraw = $_POST['name'];
	$commentraw = $_POST['comment'];
	$isValidUser = false;
	$id = mysql_real_escape_string($idraw);
	$name = mysql_real_escape_string($nameraw);
	$comment = mysql_real_escape_string($commentraw);
	$message;
	$subscriptionid;
	
	$q = "SELECT * FROM blogsubscription WHERE email = '$name'";	
	$result = $sql->query($q);	

	//CHECK DUP USERNAME
	if($sql->getNumRows()==0){	
		$message = "invalid";
	} else {
		$isValidUser = true;
		$username = $result[0]['Blogsubscription']['username'];
	}
	if( $isValidUser ){
			
		$q = "INSERT INTO blogcomments (entryid, username, comment, time) VALUES ('$id','$username','$comment',NOW() )";		
		$result = $sql->query($q);	
		if ($sql->getResult()) { // If it ran OK.
			
			$emailmessage = "New Comment!\nname: ".$username."\ncomment: \n".$comment."\n\nView here: http://clifftanaka.com/?page=blog&entry=".$id;
			mail('tanaka.cliff@gmail.com',"New Comment!",mb_convert_encoding( $emailmessage, "utf-8", "HTML-ENTITIES" ));
			
			$q = "SELECT * FROM blogcomments WHERE entryid = '$id'";
			$result = $sql->query($q);	
			$totalcomments = 0;
			$names = array();
			
			foreach($result as $key => $value){
				$row = $value['Blogcomment'];
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
			$result = $sql->query($q);	

			foreach ( $names as $value){
				$q = "SELECT email FROM blogsubscription WHERE username = '$value' AND inactive = 0";
				$result = $sql->query($q);	
				$email;
				
				foreach($result as $key => $value){
					$row = $value['Blogsubscription'];
					$email = $row['email'];
				}
				$emailmessage = "Someone commented on a post you commented on...\n\n";
				$emailmessage .= "They said:\n";
				$emailmessage .= $commentraw;
				$emailmessage .= "\n\nTo view the original post, go here:\n";
				$emailmessage .= "http://clifftanaka.com/?page=blog&entry=".$id;
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