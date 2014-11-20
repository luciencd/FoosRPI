<?php

$parts = explode('@', $_POST[email]);
if(filter_var($_POST[email], FILTER_VALIDATE_EMAIL)&&$parts[1]=='rpi.edu'){
	if(strlen($_POST[password])>=6&&strlen($_POST[password])<=16){
		require('../../../global_assets/global_php/connect.php');
		require('../../../global_assets/global_php/hashFunctions.php');
		$query = mysql_query('SELECT `password`, `valid`, `rin` FROM `users` WHERE `email`="'.mysql_real_escape_string($_POST[email]).'" LIMIT 1');
		if(mysql_num_rows($query)==1){
			$results = mysql_fetch_array($query);
			if(passwordsMatch($results[password], $_POST[password])){
				if(strlen($results[valid])==0){
					setcookie('userId', $results[rin], time()+(60*60*24*365), '/', '.foosrpi.com');
					echo 'success';
					exit();
				}else{
					echo 'You must first validate your email to sign in.';
					exit();
				}
			}
		}
	}
}

echo 'Email or password incorrect.';

?>