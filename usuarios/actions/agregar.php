<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$a_nombre = trim($_POST['a_nombre']);
$a_apellido = trim($_POST['a_apellido']);
$a_email = trim($_POST['a_email']);
$a_oficina = trim($_POST['a_oficina']);
$a_usuario = trim($_POST['a_usuario']);
$a_contra = trim($_POST['a_contra']);
$a_estatus = trim($_POST['a_estatus']);
$a_tipo = trim($_POST['a_tipo']);


$query = "INSERT INTO usuarios (u_nombre,u_apellido,u_usuario,u_contra,u_email,u_tipo,u_estatus,u_oficina) VALUES (?,?,?,?,?,?,?,?)";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ssssssss',$a_nombre,$a_apellido,$a_usuario,$a_contra,$a_email,$a_tipo,$a_estatus,$a_oficina);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$affected = $stmt->affected_rows;
$system_callback['affected'] = $affected;
$system_callback['datos'] = $_POST;

if ($affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "El query no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>
