<?php

require('../global_assets/global_php/connect.php');

if($_POST[player]==1||$_POST[player]==2){
	if(is_numeric($_POST[game])){
		mysql_query('UPDATE `games` SET `score'.$_POST[player].'`=1+`score'.$_POST[player].'` WHERE `id`="'.mysql_real_escape_string($_POST[game]).'" AND `score'.$_POST[player].'`<10');
		if(mysql_affected_rows()==1){
			// Now mark game as completed if 10 goals have been scored
			mysql_query('UPDATE `games` SET `gameOver`="1", `timeOver`="'.time().'" WHERE `id`="'.mysql_real_escape_string($_POST[game]).'" AND `score'.$_POST[player].'`="10"');
			if(mysql_affected_rows()==1){ // Update the ELOs of the players since the game is over
				// Get the IDs of the players
				$idsQuery = mysql_query('SELECT `player1`, `player2`, `score1`, `score2` FROM `games` WHERE `id`="'.$_POST[game].'" LIMIT 1');
				$idsResults = mysql_fetch_array($idsQuery);
				$player1 = $idsResults[player1];
				$player2 = $idsResults[player2];
				$player1Score = $idsResults[score1];
				$player2Score = $idsResults[score2];
				// Get the current ELO ratings of the players
				$query = mysql_query('SELECT `rating`,`gamesWon`,`gamesLost` FROM `users` WHERE `rin`="'.$player1.'" LIMIT 1');
				$results = mysql_fetch_array($query);
				$rating1 = $results[rating];
				$gamesWon1 = $results[gamesWon];
				$gamesLost1 = $results[gamesLost];
				$query = mysql_query('SELECT `rating`,`gamesWon`,`gamesLost` FROM `users` WHERE `rin`="'.$player2.'" LIMIT 1');
				$results = mysql_fetch_array($query);
				$rating2 = $results[rating];
				$gamesWon2 = $results[gamesWon];
				$gamesLost2 = $results[gamesLost];
				// Update the ELO rating and the change factor for PLAYER 1
				if($gamesWon1+$gamesLost1<20)
					$k = 32;
				else if($gamesWon1+$gamesLost1>=36)
					$k = 16;
				else
					$k = 32-(($gamesWon1+$gamesLost1)-20);
				$newELO = $rating1+($k*((($_POST[player]==1)?1:0)-(1/(1+pow(10, (($rating2-$rating1)/400))))));
				mysql_query('UPDATE `users` SET 
												`rating`="'.$newELO.'", 
												`gamesWon`=`gamesWon`+'.(($_POST[player]==1)?1:0).', 
												`gamesLost`=`gamesLost`+'.(($_POST[player]==1)?0:1).',
												`goalsFor`=`goalsFor`+'.$player1Score.', 
												`goalsAgainst`=`goalsAgainst`+'.$player2Score.' WHERE `rin`="'.$player1.'"');
				// Update the ELO rating and the change factor for PLAYER 2
				if($gamesWon2+$gamesLost2<20)
					$k = 32;
				else if($gamesWon2+$gamesLost2>=36)
					$k = 16;
				else
					$k = 32-(($gamesWon2+$gamesLost2)-20);
				$newELO = $rating2+($k*((($_POST[player]==2)?1:0)-(1/(1+pow(10, (($rating1-$rating2)/400))))));
				mysql_query('UPDATE `users` SET 
												`rating`="'.$newELO.'", 
												`gamesWon`=`gamesWon`+'.(($_POST[player]==2)?1:0).', 
												`gamesLost`=`gamesLost`+'.(($_POST[player]==2)?0:1).',
												`goalsFor`=`goalsFor`+'.$player2Score.', 
												`goalsAgainst`=`goalsAgainst`+'.$player1Score.' WHERE `rin`="'.$player2.'"');
			}
			echo 'success';
		}else
			echo 'error';
	}else
		echo 'error';
}else
	echo 'error';

?>