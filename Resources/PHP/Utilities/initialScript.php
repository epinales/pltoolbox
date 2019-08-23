<?php
// error_reporting(0);

error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/BitacoraProlog/Resources/PHP/Utilities/session.php';

spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . '/pltoolbox/Resources/classes/' . $class_name . '.php';
});


session_start();
if (!isset($_SESSION['user'])) {
 header("Location: /pltoolbox/index.php");
}

date_default_timezone_set('America/Monterrey');

$global = $_SESSION['user']['u_tipo'] == 'global';
$admin = $_SESSION['user']['u_tipo']== "administrador";
$usuario = $_SESSION['user']['u_tipo']== "usuario";
$fechaAlta = date('Y-m-d h:i:s');
$usuarioAlta = $_SESSION['user']['u_usuario'];
$fechaActual = date('Y-m-d');
$horaActual = date('H:i');



include($root . '/pltoolbox/Resources/PHP/DataBases/conexion.php');
function exit_script($input_array){
 $json_string = json_encode($input_array);
 echo $json_string;
 global $db;
 $db->close();
 die();

}


 ?>
