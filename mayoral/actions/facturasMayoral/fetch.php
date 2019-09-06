<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function parseDate($datestamp){
  $return = array(
    'date'=>"",
    'time'=>array(
      'hour'=>"",
      'minute'=>""
    )
  );

  if ($datestamp == "") {
    return $return;
  }

  $return['date'] = date('Y-m-d', strtotime($datestamp));
  $return['time']['hour'] = date('H', strtotime($datestamp));
  $return['time']['minute'] = date('i', strtotime($datestamp));

  return $return;
}

$closeable = true;

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

extract($_POST);

$system_callback = [];
$query = "SELECT mf.pk_factura_mayoral pk_factura_mayoral, mf.ano_factura ano_factura, mf.fecha_carga fecha_carga, count(mfd.fk_factura_mayoral) items FROM mayoral_factura mf LEFT JOIN mayoral_factura_detalle mfd ON mf.pk_factura_mayoral = mfd.fk_factura_mayoral GROUP BY pk_factura_mayoral ORDER BY mf.fecha_carga ASC";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

// $stmt->bind_param('ss', $date_from, $date_to);
// if (!($stmt)) {
//   $system_callback['code'] = "500";
//   $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
//   exit_script($system_callback);
// }

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$db->errno]: $db->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "No se encontró ningún identificador en el sistema.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $system_callback['data'] .= "
  <tr data-id='$row[pk_factura_mayoral]' role='button'>
    <td><input type='checkbox'></td>
    <td>$row[pk_factura_mayoral]</td>
    <td>$row[ano_factura]</td>
    <td>$row[fecha_carga]</td>
    <td>$row[items]</td>
    <td>
      <!--button type='button' class='btn btn-primary btn-sm' id='subirFactura_btn'>Detalles</button-->
    </td>
  </tr>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>
