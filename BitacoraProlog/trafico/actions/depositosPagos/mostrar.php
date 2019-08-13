<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$pk_bitacora = $_POST['pk_bitacora'];

$queryDeposito = "SELECT * FROM bitacora_transaccion
WHERE dp_tipo = 'Deposito' AND fk_bitacora_dp = ?
ORDER BY pk_depoPago";


$stmt = $db->prepare($queryDeposito);
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
  $system_callback['code'] = 1;
  $system_callback['deposito'] ="<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $pk_depoPago = $row['pk_depoPago'];
  $dp_tipo = $row['dp_tipo'];
  $dp_montoDepo = $row['dp_montoDepo'];
  $dp_iva = $row['dp_iva'];
  $dp_usuario = $row['dp_usuario'];
  $dp_datetime = $row['dp_datetime'];

  if ($dp_iva == 1) {
    $iva = "Con IVA";
  }else {
    $iva = "SIN IVA";
  }


  $system_callback['deposito'] .="
  <tr class='row m-0 align-items-center bbyellow'>
    <td class='col-md-1 px-0 text-right'>
      Deposito :<br />
      Registro :
    </td>
    <td class='col-md-8'>
      <span class='ls-3 alink font16'>
        $$dp_montoDepo -- $iva
      </span>
      <br />
       <span style='color:rgb(112, 112, 112)'>$dp_usuario -- $dp_datetime</span> <br />
    </td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";



$queryPagos = "SELECT * FROM bitacora_transaccion
WHERE dp_tipo = 'Pago' AND fk_bitacora_dp = ?
ORDER BY pk_depoPago";

$stmt = $db->prepare($queryPagos);
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
  $system_callback['code'] = 1;
  $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $pk_depoPago = $row['pk_depoPago'];
  $dp_tipo = $row['dp_tipo'];
  $dp_montoPago = $row['dp_montoPago'];
  $dp_iva = $row['dp_iva'];
  $dp_concepto = $row['dp_concepto'];
  $dp_comentarios = $row['dp_comentarios'];
  $dp_usuario = $row['dp_usuario'];
  $dp_datetime = $row['dp_datetime'];

  if ($dp_iva == 1) {
    $iva = "Con IVA";
  }else {
    $iva = "SIN IVA";
  }


  $system_callback['pago'] .="<tr class='row m-0 align-items-center bbyellow'>
    <td class='col-md-1 px-0 text-right'>
      Concepto :<br />
      Comentario :<br />
      Registro :
    </td>
    <td class='col-md-6' style='color:rgb(112, 112, 112)'>
      $dp_concepto <br />
      $dp_comentarios <br />
      $dp_usuario -- $dp_datetime
    </td>
    <td class='col-md-3'>
      Pago : <br />
       <span class='alink font16'>$ $dp_montoPago $iva</span>
    </td>

  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


 ?>
