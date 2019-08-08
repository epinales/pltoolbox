<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$pk_bitacora = $data['pk_bitacora'];

$query = "SELECT * FROM bitacora_comentarios
LEFT JOIN bitacora ON pk_bitacora = fk_bitacora
LEFT JOIN bitacora_indice ON pk_indice = fk_indice
WHERE fk_bitacora = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$pk_bitacora);
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

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 2;
  $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $estatusIndice = $row['indice'];
  $usuario = $row['coment_usuario'];
  $datetime = $row['coment_datetime'];
  $comentario = $row['comentario'];



  $system_callback['data'] .="
  <tr class='row m-0 align-items-center bbyellow' >
    <td class='col-md-6'>
      <span class='ls-3'>
        Estatus : $estatusIndice
      </span>
      <br />
      <span style='color:rgba(127, 141, 142, 0.71);'>
        Agrego: $usuario -- $datetime
      </span>
    </td>
    <td class='col-md-6'>
      Comentario : <br />
      $comentario
    </td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
