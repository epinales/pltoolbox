<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/BitacoraProlog/Resources/PHP/Utilities/initialScript.php';

$pk_usuario = trim($_POST['pk_usuario']);
$u_nombre = trim($_POST['u_nombre']);
$u_apellido = trim($_POST['u_apellido']);
$u_email = trim($_POST['u_email']);
$u_oficina = trim($_POST['u_oficina']);
$u_usuario = trim($_POST['u_usuario']);
$u_contra = trim($_POST['u_contra']);
$u_estatus = trim($_POST['u_estatus']);
$u_tipo = trim($_POST['u_tipo']);

$query = "UPDATE usuarios
SET u_nombre = ?,
u_apellido = ?,
u_usuario = ?,
u_contra = ?,
u_email = ?,
u_tipo = ?,
u_estatus = ?,
u_oficina = ?
WHERE pk_usuario = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('sssssssss',$u_nombre,$u_apellido,$u_usuario,$u_contra,$u_email,$u_tipo,$u_estatus,$u_oficina,$pk_usuario);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
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
