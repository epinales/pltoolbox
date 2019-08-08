<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;
$pk_bitacora = $_GET['evento'];

$query = "SELECT * FROM bitacora
INNER JOIN bitacora_detalle ON pk_bitacora = fk_bitacora
INNER JOIN bitacora_indice ON estatusIndice = pk_indice
WHERE pk_bitacora = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s', $pk_bitacora);
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
  $rslt = $stmt->get_result();
  $row = $rslt->fetch_assoc();
  $referencia = $row['referencia'];

// $rows = $rslt->num_rows;
//
// if ($rows == 0) {
//   $system_callback['code'] = 2;
//   $system_callback['data'] = "No hay informacion que mostrar";
//   exit_script($system_callback);
// } elseif ($rows == 1) {
//   $system_callback['code'] = 1;
//   $system_callback['data'] = $rslt->fetch_assoc();
//   $system_callback['message'] = "Script called successfully!";
//   exit_script($system_callback);
// } else {
//   $system_callback = 3;
// }

?>
