<?php
	$ty;
	if( isset($_POST['submit']) ){
			include($_SERVER['DOCUMENT_ROOT'].'/db/SQLQuery.php');
			$sql = new SQLQuery();
			$sql->connect('clifftanaka');
			
			$titleraw = $_POST['title'];
			$body = '';
			echo "post:<br/>";
			print_r($_POST);
			echo "<br/>files:<br/>";
			print_r($_FILES);
			echo "<br/><br/>";

			$body .= '<div id="ingredients">';
			$body .= '<h3>Ingredients</h3>';
			$body .= '<ul id="ingredients-container">';
			foreach($_POST as $key => $value ){
				if( strpos($key, 'group') !== false ){ 
					$body .= '<li class="'.$value.'">';
				}
				if( strpos($key, 'ingredient') !== false ){
					$body .= '<div class="ingredient">'.$value.'</div>';
				}
				if( strpos($key, 'amount') !== false ){
					$body .= '<div class="amount">'.$value.'</div></li>';
				}
			}
			$body .= '</ul>';
			$body .= '</div>';
			
			$body .= '<div id="steps">';
			$body .= '<h3>Steps</h3>';
			$body .= '<ul id="steps-container">';
			$steps = 1;
			foreach($_FILES as $key => $value ){
				if( strpos($key, 'image') !== false ){ 
					$body .= '<li><p>Step <span>'.$steps.'</span></p><img src="/blogphotos/'.$value['name'].'"/></li>';
					$steps++;
					$target_path = 'blogphotos/'.basename( $value['name']);
					
					if(move_uploaded_file($value['tmp_name'], $target_path)) {
					  echo "The file ".basename( $value['name'])." has been uploaded<br/>";
					} else{
					  echo "There was an error uploading the file (".$key." : ".$value['name']."), please try again!<br/>";
					}
				}
			}
			$body .= '</ul>';
			$body .= '</div>';

			$body .= '<div id="current-step">';
			$body .= '<ul id="current-step-container">';
			$steps = 1;
			foreach($_POST as $key => $value ){
				if( strpos($key, 'image') !== false ){ 
					$body .= '<li><img src="/blogphotos/'.$value['name'].'"/>';
				}
				if( strpos($key, 'instruction') !== false ){
					$body .= '<p>Step '.$steps.': '.$value.'</p></li>';
					$steps++;
				}
			}
			$body .= '</ul>';
			$body .= '</div>';

			$body .= '<div id="video">';
			$body .= '<div id="video-container">';
			$body .= '<iframe width="560" height="315" src="'.$video.'" frameborder="0" allowfullscreen></iframe>';
			$body .= '</div>';
			$body .= '</div>';

			echo $body;
			
			$tag1 = 'cooking';
			$tag2 = '';
			$tag3 = '';
			$title = mysql_real_escape_string($titleraw);
			$q = "INSERT INTO blog (title, body, tag1, tag2, tag3, time) VALUES ('$title','$body','$tag1','$tag2','$tag3',NOW() )";		
			$result = $sql->query($q);
			
			if ($sql->getResult()) { // If it ran OK.
				
				$q = "SELECT * FROM blogsubscription";		
				$result = $sql->query($q);
				$id = $sql->getInsertID();
				
				foreach($result as $value){
						$row = $value['Blogsubscription'];
						$email = $row['email'];
						$name = $row['username'];
						$emailmessage = "Hi ".$name.", \n\n";
						$emailmessage .= "Check out a recipe entry on clifftanaka.com:\n";
						$emailmessage .= "view the new post here: http://clifftanaka.com/?page=blog&entry=".$id."\n";
						echo $emailmessage;
						//mail($email, '"'.$title.'" (clifftanaka.com - blog)',mb_convert_encoding( $emailmessage, "utf-8", "HTML-ENTITIES" ));
				}
				
				
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
		<script type="text/javascript" src="/js/jquery-1.6.1.min.js"></script>
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
			form p{
				margin:3px 0px;
			}
		</style>
	</head>
	<body>
		<div id="content">
<?php	
	if( !isset($_POST['submit']) ){
?>
		<form enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
			title: <input name="title" size="100" /><br/>
			<p>finished photo: <input name="finished" type="file" /></p>
			<div id="ingredients">
				<p id="ingredients-add">add</p>
				<p>group: <input name="group1" size="5" /> ingredient: <input name="ingredient1" size="20" /> amount: <input name="amount1" size="10" /></p>
			</div>
			<div id="instructions">
				<p id="instructions-add">add</p>
				<p>image: <input type="file" name="image1" /> instruction: <input name="instruction1" size="100" />
			</div>
			video: <input type="text" name="video" size="100"/><br/>
			<input type="submit" value="submit" name="submit" />
		</form>
		<script>
			$(function(){
				$('#ingredients-add').click(function(){
					var number = $('#ingredients p').length;
					var ingredient = $('<p>group: <input name="group'+number+'" size="5" /> ingredient: <input name="ingredient'+number+'" size="20" /> amount: <input name="amount'+number+'" size="10" /></p>');
					$('#ingredients').append(ingredient);
				});
				$('#instructions-add').click(function(){
					var number = $('#instructions p').length;
					var instruction = $('<p>image: <input type="file" name="image'+number+'" /> instruction: <input name="instruction'+number+'" size="100" />');
					$('#instructions').append(instruction);
				});
			});
		</script>
<?php 
	} else {
		echo $ty;
	}
?>
		</div>
	</body>
</html>