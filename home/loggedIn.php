<div id="liveScores">
	<div id="innerScores">
		<?php
		require(realpath(dirname(__FILE__)).'/../global_assets/global_php/connect.php');
		?>
	</div>
</div>
<div id="myStats">
	<?php
	$myStats = mysql_query('SELECT `gamesWon`, `gamesLost`, `goalsFor`, `goalsAgainst`, `rating` FROM `users` WHERE `rin`="'.mysql_real_escape_string($_COOKIE[userId]).'"');
	$myStats = mysql_fetch_array($myStats);
	?>
	<div id="eloRating"><?=$myStats[rating]?><br><span>You have won <?=((($myStats[gamesWon]+$myStats[gamesLost])==0)?'0':round(($myStats[gamesWon]/($myStats[gamesWon]+$myStats[gamesLost]))*100))?>% of your games</span></div>
	<div id="gameStats">
		<div><span style="color: green;"><?=$myStats[gamesWon]?></span><br>wins</div>
		<div><span style="color: red;"><?=$myStats[gamesLost]?></span><br>loses</div>
		<div><span style="color: green;"><?=$myStats[goalsFor]?></span><br>goals for</div>
		<div><span style="color: red;"><?=$myStats[goalsAgainst]?></span><br>goals against</div>
	</div>
	<div class="clear"></div>
</div>
<div id="leaderboards">
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
<div id="myGames">
	<h1>Your last 10 games</h1>
	
	<div class="row" style="background-color: rgb(120, 120, 120)!important; color: white!important;">
		<div>
			Player 1
		</div>
		<div>
			Score
		</div>
		<div>
			Player 2
		</div>
		<div>
			Duration
		</div>
		<div>
			
		</div>
		<div class="clear"></div>
	</div>
	
	<?php
	
	$query = mysql_query('SELECT `player1`, `player2`, `score1`, `score2`, `timeStart`, `timeOver`, `gameOver` FROM `games` WHERE `player1`="'.mysql_real_escape_string($_COOKIE[userId]).'" OR `player2`="'.mysql_real_escape_string($_COOKIE[userId]).'" ORDER BY `timeOver` DESC, `timeStart` DESC LIMIT 10');
	while($row=mysql_fetch_array($query)){
		$player1 = mysql_query('SELECT `name`, `rating` FROM `users` WHERE `rin`="'.$row[player1].'" LIMIT 1');
		$player1 = mysql_fetch_array($player1);
		$player1Name = $player1[name];
		$player1Rating = $player1[rating];
		$player2 = mysql_query('SELECT `name`, `rating` FROM `users` WHERE `rin`="'.$row[player2].'" LIMIT 1');
		$player2 = mysql_fetch_array($player2);
		$player2Name = $player2[name];
		$player2Rating = $player2[rating];
		?>
		<div class="row">
			<div<?=(($row[player1]==$_COOKIE[userId])?' style="color: green!important;"':'')?>>
				<?=$player1Name?> (<?=$player1Rating?>)
			</div>
			<div>
				<?=$row[score1]?> - <?=$row[score2]?>
			</div>
			<div<?=(($row[player2]==$_COOKIE[userId])?' style="color: green!important;"':'')?>>
				<?=$player2Name?> (<?=$player2Rating?>)
			</div>
			<div>
				<?php
					if($row[gameOver]==1)
						echo round(($row[timeOver]-$row[timeStart])/60).' minute'.((round(($row[timeOver]-$row[timeStart])/60)!=1)?'s':'');
					else
						echo 'currently happening';
				?>
			</div>
			<div>
				<?php
					if($row[gameOver]==1)
						echo round((time()-$row[timeOver])/3600).' hour'.((round((time()-$row[timeOver])/3600)!=1)?'s':'').' ago';
					else
						echo 'currently happening';
				?>
			</div>
			<div class="clear"></div>
		</div>
		<?php
	}
	
	?>
</div>