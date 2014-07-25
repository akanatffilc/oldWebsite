<?php
	include($_SERVER['DOCUMENT_ROOT'].'/db/SQLQuery.php');
	$sql = new SQLQuery();
	$sql->connect('clifftanaka');

	$q = "SELECT * FROM blogcomments WHERE entryid = '$id' ORDER BY time ASC";
	$result = $sql->query($q);
	if($sql->getResult()){
		foreach($result as $key => $value){
			$row = $value['Blogcomment'];
?>
								<div class="<?php if( $row['username'] == 'kurifu' ){ echo 'admin-comment'; } ?> comment-box">
									<p class="comment-box-header">
										<span class="comment-box-user"><?php echo $row['username'] ?></span>
										<span> said...</span>
										<span class="comment-box-timestamp">at <?php echo $row['time'] ?></span>
									</p>
									<div class="comment-box-body"><?php echo nl2br($row['comment']) ?></div>
								</div>
<?php
		}
	}
?>