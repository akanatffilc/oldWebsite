						<div class="viewer">
							<div class="viewer-left">
								<h2><?php echo $title; ?></h2>
								<div id="previews">
									<div class="previews-prev"></div>
<?php
		if( count($images) >= 15 ){
?>
									<div class="previews-next"></div>
<?php
		}
?>
									<div class="preview-container">
										<div class="preview-container-inner">
											<ul class="active">
<?php
		foreach( $images as $key => $value ){
			$imageurl = $directory.$value[0];
			if( $key > 0 && $key % 15 == 0 ){
?>
											</ul><ul>
<?php
			}
?>
												<li class="preview <?php if( $key == 0 ){ echo 'active'; } ?>" id="preview<?php echo $key; ?>"><img src="<?php echo $imageurl; ?>"/><div class="preview-load"><span class="preview-loading">loading...</span><div class="preview-loaded"></div></div></li>
<?php
		}
?>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="viewer-right">
								<p class="enlarge">CLICK IMAGE TO ENLARGE</p>
								<div class="view-container">
<?php
		foreach( $images as $key => $value ){
			$imageurl = $directory.$value[1];
?>
									<div class="view-container-image <?php if( $key == 0 ){ echo 'active'; } ?>">
										<img class="loader" src="images/ajax-loader.gif"/>
										<img class="image" src="<?php echo $imageurl; ?>"/>
									</div>
<?php
		}
?>
								</div>
								<p class="title">Title of Piece</p>
								<p class="print">PRINT AVAILABLE</p>
							</div>
						</div>