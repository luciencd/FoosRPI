<?php

if(isset($_COOKIE[userId]))
	setcookie('userId', '', time()-(60*60*24*365), '/', '.foosrpi.com');

?>