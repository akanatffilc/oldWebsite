<a id="backtoblog" href="?page=blog">back to index</a>
<div id="entry">
<?php
	include($_SERVER['DOCUMENT_ROOT'].'/db/SQLQuery.php');
	$id = '';
	if( !isset( $entry ) ){
		$id = $_POST['id'];
	} else {
		$id = $entry;
	}
	
	$sql = new SQLQuery();
	$sql->connect('clifftanaka');
	$result = $sql->query("SELECT * FROM blog WHERE id = $id");
	if( $sql->getNumRows() > 0 ){
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
	<div class="mdy">
			<p class="month"><?php echo $month; ?></p>
			<p class="date"><?php echo $date; ?></p>
			<p class="year"><?php echo $year; ?></p>
		</div>
		<h2 class="title">
			<?php echo $title; ?>
			<a href="#comments">
<?php
			echo $comments;
			if( $comments == 1 ){
				echo ' comment';
			} else {
				echo ' comments';
			}
?>
			</a>
		</h2>
		<p class="tags">
			tags: 
			<span class="tag1"><?php echo $tag1; ?></span>
			<?php if( $tag2 != '' ){ echo ', '; } ?>
			<span class="tag2"><?php echo $tag2; ?></span>
			<?php if( $tag3 != '' ){ echo ', '; } ?>
			<span class="tag3"><?php echo $tag3; ?></span>
		</p>
		<iframe src="//www.facebook.com/plugins/like.php?href=<?php  echo urlencode("http://" . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?>&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=40&amp;appId=121506734612756" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:40px; margin-left:10px;" allowTransparency="true"></iframe>
		<div class="body"><?php echo nl2br($body); ?></div>
		<a name="comments"></a>
		<div id="comments">
			<div id="comments-header">
				Comments
			</div>
			<div id="comments-body">
<?php
			$result = $sql->query("SELECT * FROM blogcomments WHERE entryid = '$id' ORDER BY time ASC");

			if($sql->getNumRows()==0){	
?>
				<div class="comment-box" id="<?php echo $row['id']; ?>">
					<p class="comment-box-header">
						<span class="comment-box-user"></span>
						<span></span>
						<span class="comment-box-timestamp"></span>
					</p>
					<div class="comment-box-body">there are no comments yet :(</div>
				</div>
<?php
			} else {
				foreach( $result as $key => $value ){
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
			</div>
			<a name="newcomment"></a>
			<div id="comments-new">
				<p id="comments-new-header">New comment</p>
				<div id="comments-new-body">
					<div class="error-messages">
						<div class="successful">your comment has been successfully submitted<br/>Please wait one sec for the page to update your new comment.</div>
						<div class="incorrect">unsubscribed email address</div>
						<div class="incomplete">this email address needs confirmation. <br/>an email has been sent to your inbox to confirm your subscription.</div>
						<div class="username">you forgot to enter your email</div>
						<div class="password">you forgot to enter your password</div>
						<div class="message">you forgot to type a comment</div>
					</div>
					<div id="subscribe"><a target="_blank" href="subscribe"><span>click here to subscribe &#9786;</span></a></div>
					<label for="username">email</label><br/><input id="username-input" type="text"/><br/>
					<label>comment</label><br/>
					<textarea id="comment-input"></textarea><br/>
					<button id="comment-button"><span>comment!</span><img src="images/ajax-loader.gif"/></button>
				</div>
			</div>
		</div>
	</div>
<?php
		}
	} else {
?>
		<p>This blog post is no longer available.</p>
<?php
	}
?>
</div>
