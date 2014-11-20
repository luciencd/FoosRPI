<?php

require('../global_assets/global_php/connect.php');

if(is_numeric($_GET[game])){
	mysql_query('DELETE FROM `games` WHERE `id`="'.$_GET[game].'"');
	if(mysql_affected_rows()==1)
		echo 'success';
	else
		echo 'error';
}

?>