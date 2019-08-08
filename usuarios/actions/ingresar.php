<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';


$system_callback = [];
$data = $_POST;

$usuario = $data['user'];
$contra = $data['pwd'];


$query = "SELECT * FROM usuarios WHERE u_usuario = ? AND u_contra = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt->bind_param('ss',$usuario,$contra);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error al pasar variables [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 1) {
  $_SESSION['user'] = $rslt->fetch_assoc();
  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);
}
// else {
//   $system_callback['code'] = 200;
//   $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
//   $system_callback['message'] = "Script called successfully but there are no rows to display.";
//   exit_script($system_callback);
// }

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

 ?>
