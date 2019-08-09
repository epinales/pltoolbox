<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$oficina = $data['oficina'];
$andWhere = 'WHERE oficina = ? AND entregadoFact = 1';

$query = "SELECT

b.pk_bitacora,
b.nombreCliente,
b.referencia,
b.oficina,
b.UsuarioAlta,
b.fechaAlta,
b.UsuarioModif,
b.fechaModif,
b.entregadoFact,
b.recibidoFact,
b.estatusTipo,

bi.pk_indice,
bi.indice,

SUM(bdp.dp_montoDepo) AS deposito,
SUM(bdp.dp_montoPago) AS pago,

o.pk_oficina,
o.o_nombre,
o.o_amarillo,
o.o_rojo,
o.o_alerta

FROM bitacora b
LEFT JOIN oficinas o ON b.oficina = o.o_nombre
LEFT JOIN bitacora_indice bi ON b.estatusIndice = bi.pk_indice
LEFT JOIN bitacora_transaccion bdp ON b.pk_bitacora = bdp.fk_bitacora_dp
$andWhere GROUP BY b.pk_bitacora ";


$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$oficina);
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
  $pk_bitacora = $row['pk_bitacora'];
  $nombreCliente = $row['nombreCliente'];
  $referencia = $row['referencia'];
  $pk_indice = $row['pk_indice'];
  $indice = $row['indice'];
  $recibido = $row['recibidoFact'];
  $estatusTipo = $row['estatusTipo'];



  if ($estatusTipo == "Facturacion" AND $recibido == "1") {
    $color = "";
    $onclick = "detalle_eventos_facturacion($pk_bitacora)";
  }else {
    $color = "rgb(171, 42, 42)";
    $onclick = "recibirExpediente($pk_bitacora)";
  }



  $system_callback['data'] .="
  <tr class='row m-0 align-items-center bbyellow'>
    <td class='col-md-12'>
      <span class='ls-3'>
        <a id='' href='#' onclick='$onclick' referencia='$referencia' class='$expediente alink detalle' db-id='$pk_bitacora'>$nombreCliente</a>
      </span>
      <br>
      <span style='color:$color'>$referencia --  $indice</span>
    </td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
