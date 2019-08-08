<?php

// $db_global = 'bd_demo_13';
// $host_global = '10.1.4.10';
// $port_global = 3306;
// $usr_global = 'prolog';
// $pwd_global = 'f4Tnps.03';

$db_global = 'bd_demo_13';
$host_global = '70.125.225.93';
$port_global = 3306;
$usr_global = 'prolog';
$pwd_global = 'f4Tnps.03';

$global = new mysqli($host_global, $usr_global, $pwd_global, $db_global, $port_global) or die ('No se pudo hacer la conexión al servidor de usuarios ('. $global->errno . '): ' . $global->error);


 ?>
