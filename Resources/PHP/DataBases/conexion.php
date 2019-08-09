<?php

$datab = 'pltoolbox';
$host = 'localhost';
$port = 8886;
$usr = 'root';
$pwd = 'root';

/*PRODUCTION ENVIRONMENT*/
$datab = 'pltoolbox';
$host = '10.1.4.10';
$port = 3306;
$usr = 'prolog';
$pwd = 'f4Tnps.03';

$db = new mysqli($host, $usr, $pwd, $datab, $port) or die ('Could not connect to the database server ' . $login->error );

 ?>
