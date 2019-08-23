<?php

spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . '/pltoolbox/Resources/classes/' . $class_name . '.php';
});

$datab = 'pltoolbox';
$host = 'localhost';
$port = 8886;
$usr = 'root';
$pwd = 'root';

/*PRODUCTION ENVIRONMENT*/
// $datab = 'pltoolbox';
// $host = '10.1.4.10';
// $port = 3306;
// $usr = 'prolog';
// $pwd = 'f4Tnps.03';

$db = new mysqli($host, $usr, $pwd, $datab, $port) or die ('Could not connect to the database server ' . $db->error );
$toolbox = new my_mysqli($host, $usr, $pwd, $datab, $port) or die ('Could not connect to the database server ' . $toolbox->error );

?>
