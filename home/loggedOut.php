<div id="liveScores">
	<div id="innerScores">
		<?php
		require(realpath(dirname(__FILE__)).'/../global_assets/global_php/connect.php');
		?>
	</div>
</div>
<div class="signInUp">
	<h2>Sign In</h2>
	<form method="POST" id="signInForm">
		<input type="text" name="email" id="email" value="Email" /><br>
		<input type="text" name="passwordFake" id="passwordFake" value="Password" /><input type="password" name="password" id="password" value="" style="display: none;" /><br>
		<input type="submit" name="submitButton" id="submitButton" value="Sign In" class="button" />
		<div class="error"></div>
	</form>
</div>

<div class="signInUp">
	<h2>Join</h2>
	<form method="POST" id="joinForm">
		<input type="text" name="name" id="name" value="Full Name" /><br>
		<input type="text" name="email" id="email" value="Email" /><br>
		<input type="text" name="rin" id="rin" value="RIN Number" /><br>
		<input type="text" name="passwordFake" id="passwordFake" value="Password" /><input type="password" name="password" id="password" value="" style="display: none;" /><br>
		<input type="text" name="password2Fake" id="password2Fake" value="Repeat Password" /><input type="password" name="password2" id="password2" value="" style="display: none;" /><br>
		<input type="submit" name="submitButton" id="submitButton" value="Join" class="button" />
		<div class="error"></div>
	</form>
</div>
<div class="clear"></div>
<div id="leaderboards" style="padding-bottom: 0px!important;">
	<h1>Leaderboard</h1>
	
	<div class="row" id="headRow">
		<div style="width: 8%; line-height: 32px;">Position</div>
		<div style="width: 25%; line-height: 32px; text-align: left;">Name</div>
		<div style="width: 7%; line-height: 32px;">Rating</div>
		<div style="width: 7%; line-height: 32px;">Played</div>
		<div style="width: 7%; line-height: 32px;">Wins</div>
		<div style="width: 7%; line-height: 32px;">Loses</div>
		<div style="width: 7%;">Goals For</div>
		<div style="width: 7%;">Goals Against</div>
		<div style="width: 7%;">Goal Diff.</div>
		<div class="clear" style="width: 0%;"></div>
	</div>
	<?php
	// Query to obtain top players
	$query = mysql_query('SELECT * FROM `users` ORDER BY `rating` DESC LIMIT 10');
	$i = 0;
	while($row=mysql_fetch_array($query)){
		?>
		<div class="row">
			<div style="width: 8%;"><?=($i+1)?></div>
			<div style="width: 25%; text-align: left;"><?=$row[name]?></div>
			<div style="width: 7%;"><?=$row[rating]?></div>
			<div style="width: 7%;"><?=($row[gamesWon]+$row[gamesLost])?></div>
			<div style="width: 7%;"><?=$row[gamesWon]?></div>
			<div style="width: 7%;"><?=$row[gamesLost]?></div>
			<div style="width: 7%;"><?=$row[goalsFor]?></div>
			<div style="width: 7%;"><?=$row[goalsAgainst]?></div>
			<div style="width: 7%;"><?=($row[goalsFor]-$row[goalsAgainst])?></div>
			<div class="clear" style="width: 0%;"></div>
		</div>
		<?php
		++$i;
	}
	?>
</div>