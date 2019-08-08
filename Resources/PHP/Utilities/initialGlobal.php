<?php
error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'];

session_start();
if (!isset($_SESSION['user'])) {
 header("Location: /pltoolbox/index.php");
}

date_default_timezone_set('America/Monterrey');


include($root . '/pltoolbox/Resources/PHP/DataBases/global.php');
function exit_script($input_array){
 $json_string = json_encode($input_array);
 echo $json_string;
 global $global;
 $global->close();
 die();
} 


 ?>
