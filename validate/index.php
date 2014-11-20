<?php

if(isset($_GET[t])&&preg_match('/^[a-f0-9]{32}$/', $_GET[t])){
	require('../global_assets/global_php/connect.php');
	$query = mysql_query('UPDATE `users` SET `valid`="" WHERE `valid`="'.mysql_real_escape_string($_GET[t]).'"');
	header('Location: /?validated=1');
}

?>