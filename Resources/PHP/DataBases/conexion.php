<?php

/*TEST ENVIRONMENT*/
$datab = 'pltoolbox';
$host = 'localhost';
$port = 8886;
$usr = 'root';
$pwd = 'root';

/*PRODUCTION ENVIRONMENT*/
// $datab = 'pltoolbox';
// $host = 'localhost';
// $port = 8886;
// $usr = 'root';
// $pwd = 'root';

$db = new mysqli($host, $usr, $pwd, $datab, $port) or die ('Could not connect to the database server ' . $login->error );

 ?>
