<?php

$link = mysql_connect('leopold.fatcowmysql.com', 'foosrpi', '97d243274aa4f700f238d21dfe15d4e1'); 

if(!$link){ 
    die('Sorry, there was an error!');//'Could not connect: ' . mysql_error()); 
}

mysql_select_db(foosrpi);

?>