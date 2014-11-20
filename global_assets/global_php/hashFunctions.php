<?php

function hashPassword($password, $username){
	$salt = hash('sha512', uniqid(mt_rand(), true).'randomHash'.strtolower($username));
	$hash = $salt.$password;
	for($i=0;$i<100000;$i++){
		$hash = hash('sha384', $hash);
	}
	$hash = $salt.$hash;
	return $hash;
}

function passwordsMatch($real, $new){
	$salt = substr($real, 0, 128);
	$new = $salt.$new;
	for($i=0;$i<100000;$i++){
		$new = hash('sha384', $new);
	}
	$new = $salt.$new;
	if($real==$new)
		return true;
	else
		return false;
}

?>