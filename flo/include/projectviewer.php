						<div class="viewer">
							<p class="viewer-enlarge">CLICK IMAGE TO ENLARGE</p>
							<div class="projectviewer-prev"></div>
<?php
		if( count($images) > 0 ){
?>
							<div class="projectviewer-next"></div>
<?php
		}
?>
							<div class="projectviewer">
								<ul>
<?php
		foreach( $images as $key => $value ){
?>
												<li class="<?php if( $key == 0 ){ echo 'active'; } ?>">
<?php
			if( $key == 0 ){ echo '<span class="spacer"></span>'; }
?>
													<img src="<?php echo $directory.$value; ?>"/>
<?php
			if( $key == count($images)-1 ){ echo '<span class="spacer"></span>'; }
?>
												</li>
<?php
		}
?>
								</ul>
							</div>
							<div class="pages">
								<span class="pages-current"></span>
								<span class="pages-total"></span>
							</div>
						</div>