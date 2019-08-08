<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/utilities/initialScript.php';

$pk_indice = trim($_POST['pk_indice']);
$pk_bitacora = trim($_POST['pk_bitacora']);
$comentario = trim($_POST['comentario']);
$referencia = trim($_POST['referencia']);


$query = "INSERT INTO bitacora_comentarios (fk_bitacora,fk_indice,comentario,coment_usuario,coment_datetime) VALUES (?,?,?,?,?)";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('sssss',$pk_bitacora,$pk_indice,$comentario,$usuarioAlta,$fechaAlta);
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

$descripcion = "Se agrego un comentario: en referencia $referencia";
$seccion = 'trafico_comentario';

require $root . '/pltoolbox/BitacoraProlog/actions/registroActividad.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

 ?>
