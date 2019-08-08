<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];

$pk_bitacora = trim($_POST['pk_bitacora']);
$referencia = trim($_POST['referencia']);
$entregadoFact = 1;
// $tipo = "Fact";
// $estatusTipo = "Fact";

$query = "UPDATE bitacora
SET entregadoFact = ?
WHERE pk_bitacora = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss',$entregadoFact,$pk_bitacora);
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
  $system_callback['message'] = "El query actualizarTerminar no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}

$descripcion = "Paso la referencia $referencia a facturacion";
$seccion = 'trafico';

require $root . '/pltoolbox/BitacoraProlog/actions/registroActividad.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Correcto se actualizo";
exit_script($system_callback);

?>
