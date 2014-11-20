<?php

$_POST[name] = trim($_POST[name]);
$_POST[email] = trim($_POST[email]);
$_POST[rin] = trim($_POST[rin]);
if(strlen($_POST[name])>=2&&strlen($_POST[name])<=100){
	$parts = explode('@', $_POST[email]);
	if(filter_var($_POST[email], FILTER_VALIDATE_EMAIL)&&$parts[1]=='rpi.edu'){
		// Connect to database
		require('../../../global_assets/global_php/connect.php');
		require('../../../global_assets/global_php/hashFunctions.php');
		//Check that email is unique
		$query = mysql_query('SELECT `id` FROM `users` WHERE `email`="'.mysql_real_escape_string($_POST[email]).'" LIMIT 1');
		if(mysql_num_rows($query)==0){
			if(strlen($_POST[rin])==9&&$_POST[rin][0]==6&&$_POST[rin][1]==6&&is_numeric($_POST[rin])){
				//Check that rin is unique
				$query = mysql_query('SELECT `id` FROM `users` WHERE `rin`="'.$_POST[rin].'" LIMIT 1');
				if(mysql_num_rows($query)==0){
					if(strlen($_POST[password])>=6&&strlen($_POST[password])<=16){
						if($_POST[password]==$_POST[password2]){
							$validEmailToken = md5(time().mt_rand().sha1(rand(0,10000)));
							if(mysql_query('INSERT INTO `users` (`name`, `email`, `password`, `rin`, `valid`, `rating`, `changeFactor`)
									  VALUES ("'.mysql_real_escape_string($_POST[name]).'",
									  		  "'.mysql_real_escape_string($_POST[email]).'",
									  		  "'.hashPassword($_POST[password], $_POST[email]).'",
									  		  "'.$_POST[rin].'",
									  		  "'.$validEmailToken.'",
									  		  1200,
									  		  32)')){
								mail($_POST[email], 'Finish Joining FoosRPI', 'Dear '.$_POST[name].',
		
Thank you for joining FoosRPI. Please click the following link to validate your email address:
http://foosrpi.com/validate?t='.$validEmailToken.'

Sincerely,
--FoosRPI Team');
								echo 'success';
							}else
								echo 'Sorry, there was an error.';
						}else
							echo 'Passwords do not match.';
					}else
						echo 'Password must be between 6 and 16 characters in length.';
				}else
					echo 'There is already an account associated with that RIN number!';
			}else
				echo 'Please enter your RIN number.';
		}else
			echo 'There is already an account associated with that email address!';
	}else
		echo 'You must enter a valid @rpi.edu email address.';
}else
	echo 'Name must be between 2 and 100 characters in length.';

?>