<?php

$link = mysql_connect('***', '***', '***'); 

if(!$link){ 
    die('Sorry, there was an error!');//'Could not connect: ' . mysql_error()); 
}

mysql_select_db(***);

?>