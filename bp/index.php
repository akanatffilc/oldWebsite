<?php
	$newTime = 60 * 60 * 24 + time(); 
	$cookie = false;
	if (isset($_COOKIE['lastVisit'])) {
		setcookie('lastVisit', date("m/d/y - G:i:s"), $newTime); 
		$cookie = true;
	} 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bring Protection</title>
		<link id="style" rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="../jq/jquery-1.6.1.min.js"></script>
		<script type="text/javascript" src="../jq/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="../jq/jquery.flip.min.js"></script>
		<script type="text/javascript" src="functions.js"></script>
	</head>
	<body>
		<div id=content>
			<div id=header>
				<ul id=nav>
					<li id=nav-home class=current><a href=#home>home</a></li>
					<li id=nav-roster><a href=#roster>roster</a></li>
					<li id=nav-stats><a href=#stats>stats</a></li>
					<li id=nav-schedule><a href=#schedule>schedule</a></li>
				</ul>
			</div>
			<!--<div id=innercontent>-->
				<a name=home></a>
				<div class=spacer></div>
				<div id=homeDiv class=block>
					thisishome
				</div>
				<a name=roster></a>
				<div class=spacer></div>
				<div id=rosterDiv class=block>
					<div class=select-year>
						<span>select year:</span>
						<select id=roster-select-year>
							<option></option>
							<option>2010</option>
							<option>2011</option>
						</select>
					</div>
					<div id=player-cards></div>
				</div>
				<a name=stats></a>
				<div class=spacer></div>
				<div id=statsDiv class=block>
					thisisstats
				</div>
				<a name=schedule></a>
				<div class=spacer></div>
				<div id=scheduleDiv class=block>
					thisisschedule
				</div>
				<a name=admin></a>
				<div class=spacer></div>
				<div id=adminDiv class=block>
					<div id=adminNav>
						<div id=admin-view class="adminTab adminCurrentTab">view / edit</div>
						<div id=admin-new class=adminTab>new</div>
					</div>
					<div id=adminInner>
						<div id="admin-view-content" class=admin-block>
							<div id=admin-view-menu>
							year: <select id=admin-view-select-year><option>2010</option><option>2011</option></select>
							view: <select id=admin-view-thing><option id=view-stat>stat</option></select>
								<input id=admin-view-go type=button value=go />
								<div id=admin-view-selector></div>
							</div>
							<div id=view-content></div>
						</div>
						<div id="admin-new-content" class=admin-block>
							<div id=admin-new-menu>
							year: <select id=admin-new-select-year><option>2010</option><option>2011</option></select>
							new <select id=admin-new-thing><option id=new-stat>stat</option>
								<!--
								<p id=new-roster>roster</p>
								<p id=new-schedule>schedule</p>
								-->
								</select>
								<input id=admin-new-go type=button value=go />
							</div>
							<div id=new-content></div>
						</div>
					</div>
					<div id=adminLogin><p>admin access only</p>
					<input size=14 name=adminPassword id=adminPassword type=password />
					<p id=adminsubmit>submit</p></div>
					<div id=adminInnerMask></div>
				</div>
				<div class=spacer></div>
				
			<!--</div>-->
			<div id=footer>
				<p>&copy; 2011 BringProtection / Created by Cliff / All rights reserved / last login: <?php echo $_COOKIE['lastVisit']; ?> / <a id=adminLink href="#admin">admin</a> </p>
			</div>
		</div>
		<div id=mask></div>
		<div id=login-splash><input maxlength="10" size="10" type=password id=password /><p id=submit>enter</p></div>
		<?php
			if (!$cookie) {
		?>
				<script type="text/javascript">login_splash(); console.log('index page cookie expired');</script>
		<?php
		}
		?>
	</body>
</html>