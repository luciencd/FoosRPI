<?php

$_POST[name] = trim($_POST[name]);
$_POST[email] = trim($_POST[email]);
$_POST[rin] = trim($_POST[rin]);
$_POST[phone] = preg_replace("/[^0-9]/", "", $_POST[phone]);
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
							if(is_numeric($_POST[phone])&&strlen((string)$_POST[phone])==10){
								if(in_array($_POST[dorm], array('Acacia', 'Alpha Chi Rho', 'Alpha Epsilon Pi', 'Alpha Gamma Delta', 'Alpha Omega Epsilon', 'Alpha Phi', 'Alpha Phi Alpha', 'Alpha Sigma Phi', 'BARH (Burdett Avenue Residence Hall)', 'Barton Hall', 'Beman Lane Undergraduate RAHP Apartments', 'Bi Beta Phi', 'Blitman Residence Commons', 'Bray Hall', 'Bryckwyck', 'Cary Hall', 'Chi Phi', 'Colonie Apartments', 'Crockett Hall', 'Davison Hall', 'Delta Phi', 'Delta Tau Delta', 'E-Complex', 'Hall Hall', 'Lambda Chi Alpha', 'Lambda Upsilon Lambda', 'Nason Hall', 'North Hall', 'Nugent Hall', 'Phi Gamma Delta', 'Phi Iota Alpha', 'Phi Kappa Tau', 'Phi Kappa Theta', 'Phi Mu Delta', 'Phi Sigma Kappa', 'Pi Delta Psi', 'Pi Kappa Alpha', 'Pi Kappa Phi', 'Pi Lambda Phi', 'Polytechnic Residence Commons', 'Psi Upsilon', 'Quadrangle (The Quad)', 'Rensselaer Society of Engineers', 'Sharp Hall', 'Sigma Alpha Epsilon', 'Sigma Chi', 'Sigma Delta', 'Sigma Phi Epsilon', 'Single RAHP', 'Stacwyck Apartments', 'Tau Epsilon Pi', 'Theta Chi', 'Theta Xi', 'Warren Hall', 'Zeta Psi'))){
									$validEmailToken = md5(time().mt_rand().sha1(rand(0,10000)));
									if(mysql_query('INSERT INTO `users` (`name`, `email`, `password`, `rin`, `valid`, `rating`, `changeFactor`, `dorm`, `phone`)
											  VALUES ("'.mysql_real_escape_string($_POST[name]).'",
											  		  "'.mysql_real_escape_string($_POST[email]).'",
											  		  "'.hashPassword($_POST[password], $_POST[email]).'",
											  		  "'.$_POST[rin].'",
											  		  "'.$validEmailToken.'",
											  		  1200,
											  		  32,
											  		  "'.mysql_real_escape_string($_POST[dorm]).'",
											  		  '.mysql_real_escape_string($_POST[phone]).')')){
										mail($_POST[email], 'Finish Joining FoosRPI', 'Dear '.$_POST[name].',
				
		Thank you for joining FoosRPI. Please click the following link to validate your email address:
		http://foosrpi.com/validate?t='.$validEmailToken.'
		
		Sincerely,
		--FoosRPI Team');
										echo 'success';
									}else
										echo 'Sorry, there was an error.';
								}else
									echo 'Please select your residence.';
							}else
								echo 'Please enter a valid 10 digit phone number.';
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