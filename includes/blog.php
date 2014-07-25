<?php
	$entry = '';
	if( isset($_GET['entry']) ){
		$entry = $_GET['entry'];
	}
	if( $entry == '' ){
?>
<h1>Blog</h1>
<div id="bloglist-container">
<ul id="bloglist">
<?php
		include($_SERVER['DOCUMENT_ROOT'].'/db/SQLQuery.php');

		$sql = new SQLQuery();
		$sql->connect('clifftanaka');
		$result = $sql->query("SELECT * FROM blog ORDER BY id DESC");
		foreach( $result as $key => $row ){
			$month = date( "M", strtotime($row['Blog']['time']) );
			$date = date( "d", strtotime($row['Blog']['time']) );
			$year = date( "Y", strtotime($row['Blog']['time']) );
			$id = $row['Blog']['id'];
			$title = $row['Blog']['title'];
			$body = $row['Blog']['body'];
			$comments = $row['Blog']['comments'];
			$tag1 = $row['Blog']['tag1'];
			$tag2 = $row['Blog']['tag2'];
			$tag3 = $row['Blog']['tag3'];
?>
	<li id="<?php echo $id; ?>">
		<div class="mdy">
			<p class="month"><?php echo $month; ?></p>
			<p class="date"><?php echo $date; ?></p>
			<p class="year"><?php echo $year; ?></p>
		</div>
		<h2 class="title">
			<?php echo $title; ?>
			<span>
<?php
				echo $comments;
				if( $comments == 1 ){
					echo ' comment';
				} else {
					echo ' comments';
				}
?>
			</span>
		</h2>
		<p class="tags">
			tags: 
			<span class="tag1"><?php echo $tag1; ?></span>
			<?php if( $tag2 != '' ){ echo ', '; } ?>
			<span class="tag2"><?php echo $tag2; ?></span>
			<?php if( $tag3 != '' ){ echo ', '; } ?>
			<span class="tag3"><?php echo $tag3; ?></span>
		</p>
		<!--<p class="blurb"><?php echo substr($body,0,120); ?></p>-->
	</li>
<?php
		}
?>
</ul>
</div>
<?php
	} else {
		include($_SERVER['DOCUMENT_ROOT'].'/ajax/loadBlog.php');
	}
?>
<script src="js/blog.js" type="text/javascript"></script>