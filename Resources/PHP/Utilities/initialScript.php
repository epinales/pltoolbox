<?php
// error_reporting(0);

error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/BitacoraProlog/Resources/PHP/Utilities/session.php';


session_start();
if (!isset($_SESSION['user'])) {
 header("Location: /pltoolbox/index.php");
}



include($root . '/pltoolbox/Resources/PHP/DataBases/Conexion.php');
date_default_timezone_set('America/Monterrey');
function exit_script($input_array){
 $json_string = json_encode($input_array);
 echo $json_string;
 global $db;
 $db->close();
 die();

}


 ?>
