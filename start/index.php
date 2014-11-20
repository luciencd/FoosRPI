<?php

require('../global_assets/global_php/connect.php');

if(strlen($_GET[rin1])==9&&$_GET[rin1][0]==6&&$_GET[rin1][1]==6&&is_numeric($_GET[rin1])){
	if(strlen($_GET[rin2])==9&&$_GET[rin2][0]==6&&$_GET[rin2][1]==6&&is_numeric($_GET[rin2])){
		// Overwrite any games currently taking place between these two players...
		mysql_query('DELETE FROM `games` WHERE (`player1`="'.mysql_real_escape_string($_GET[rin1]).'" AND `player2`="'.mysql_real_escape_string($_GET[rin2]).'" OR `player2`="'.mysql_real_escape_string($_GET[rin1]).'" AND `player1`="'.mysql_real_escape_string($_GET[rin2]).'") AND `gameOver`="0"');
		
		mysql_query('INSERT INTO `games` (`player1`,`player2`,`timeStart`) VALUES ("'.$_GET[rin1].'", "'.$_GET[rin2].'", "'.time().'")');
		echo mysql_insert_id();
	}else
		echo 'error';
}else
	echo 'error';

?>