<?php
// error_reporting(0);

error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/BitacoraProlog/Resources/PHP/Utilities/session.php';


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

function returnJsonHttpResponse($success, $data){
    // remove any string that could create an invalid JSON
    // such as PHP Notice, Warning, logs...
    ob_clean();

    // this will clean up any previously added headers, to start clean
    header_remove();

    // Set the content type to JSON and charset
    // (charset can be set to something else)
    header("Content-type: application/json; charset=utf-8");

    // Set your HTTP response code, 2xx = SUCCESS,
    // anything else will be error, refer to HTTP documentation
    if ($success) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }

    // encode your PHP Object or Array into a JSON string.
    // stdClass or array
    echo json_encode($data);

    // making sure nothing is added
    exit();
}

function exit_script($input_array){
 // $json_string = json_encode($input_array);
 returnJsonHttpResponse(true, $input_array);
 // echo $json_string;
 // global $db;
 // $db->close();
 // die();

}


 ?>
