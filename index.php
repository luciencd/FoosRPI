<!DOCTYPE html>
<html>
	<head>
		<title>FoosRPI</title>
		<link rel="stylesheet" type="text/css" href="/global_assets/global_css/main.css?cache=<?=time()?>" media="screen" />
		<link rel="stylesheet" type="text/css" href="/home/assets/loggedOut.css?cache=<?=time()?>" media="screen" />
		<link rel="stylesheet" type="text/css" href="/home/assets/loggedIn.css?cache=<?=time()?>" media="screen" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="/global_assets/global_js/main.js?cache=<?=time()?>"></script>
		<script src="/home/assets/loggedOut.js?cache=<?=time()?>"></script>
		<script src="/home/assets/loggedIn.js?cache=<?=time()?>"></script>
		<?php
		if(isset($_GET[validated])){
			?>
			<script type="text/javascript">
				alert('Thank you! Your email has now been validated.');
			</script>
			<?php
		}
		?>
	</head>
	<body>
		<?php
		if(isset($_COOKIE[userId])){ // User is logged in
			?>
			<div id="signOut" class="button">Sign Out</div>
			<?php
		}
		?>
		<div id="title">FoosRPI</div>
		<div id="content">
			<div id="loading" style="display: none;"></div>
			<div id="innerContent">
				<?php
				if(!isset($_COOKIE[userId])) // User is not logged in
					require('home/loggedOut.php');
				else // User is logged in
					require('home/loggedIn.php');
				?>
			</div>
		</div>
	</body>
</html>