<?php
require('../../../global_assets/global_php/connect.php');
$query = mysql_query('SELECT * FROM `games` WHERE `gameOver`="0" ORDER BY `timeStart` DESC'); //`gameOver`="0"
if(mysql_num_rows($query)==0)
	echo 'No games currently';
else{
	$i = 0;
	while($row=mysql_fetch_array($query)){
		// Get player names
		$player1 = mysql_query('SELECT `name` FROM `users` WHERE `rin`="'.$row[player1].'" LIMIT 1');
		$player2 = mysql_query('SELECT `name` FROM `users` WHERE `rin`="'.$row[player2].'" LIMIT 1');
		$player1 = mysql_fetch_array($player1);
		$player2 = mysql_fetch_array($player2);
		$player1 = $player1[name];
		$player2 = $player2[name];
		if($i>0&&mysql_num_rows($query)!=1){
			echo ' &bull; ';
		}
		echo $player1.' '.$row[score1].' - '.$row[score2].' '.$player2;
		++$i;
	}
}
?>