<?php

// $datab = 'pltoolbox';
// $host = 'localhost';
// $port = 8886;
// $usr = 'root';
// $pwd = 'root';

/*PRODUCTION ENVIRONMENT*/
$datab = 'pltoolbox';
$host = '3.20.125.227';
$port = 3306;
$usr = 'web-agent';
$pwd = 'W3b@g3n7';

$db = new mysqli($host, $usr, $pwd, $datab, $port) or die ('Could not connect to the database server ' . $login->error );

// error_log(json_encode($db));

 ?>
