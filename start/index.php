<?php

require('../global_assets/global_php/connect.php');

if(strlen($_POST[rin1])==9&&$_POST[rin1][0]==6&&$_POST[rin1][1]==6&&is_numeric($_POST[rin1])){
	if(strlen($_POST[rin2])==9&&$_POST[rin2][0]==6&&$_POST[rin2][1]==6&&is_numeric($_POST[rin2])){
		// Overwrite any games currently taking place between these two players...
		mysql_query('DELETE FROM `games` WHERE (`player1`="'.mysql_real_escape_string($_POST[rin1]).'" AND `player2`="'.mysql_real_escape_string($_POST[rin2]).'" OR `player2`="'.mysql_real_escape_string($_POST[rin1]).'" AND `player1`="'.mysql_real_escape_string($_POST[rin2]).'") AND `gameOver`="0"');
		
		mysql_query('INSERT INTO `games` (`player1`,`player2`,`timeStart`) VALUES ("'.$_POST[rin1].'", "'.$_POST[rin2].'", "'.time().'")');
		echo mysql_insert_id();
	}else
		echo 'error';
}else
	echo 'error';

?>