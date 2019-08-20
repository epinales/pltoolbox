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
o.o_alerta,

bdf.recibidoFact AS bdfRecibido,
bdf.vencimientoFact AS bdfVencimiento,
bdf.finalizar

FROM bitacora b
LEFT JOIN oficinas o ON b.oficina = o.o_nombre
LEFT JOIN bitacora_indice bi ON b.estatusIndice = bi.pk_indice
LEFT JOIN bitacora_transaccion bdp ON b.pk_bitacora = bdp.fk_bitacora_dp
LEFT JOIN bitacora_detalle_facturacion bdf ON b.pk_bitacora = bdf.fk_bitacora
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

  $finalizar = $row['finalizar'];



  $bdfRecibido = $row['bdfRecibido'];
  $bdfVencimiento = $row['bdfVencimiento'];


  $fecha1 = new DateTime($bdfRecibido);//fecha inicial
  $fecha2 = new DateTime($bdfVencimiento);//fecha de cierre
  $intervalo = $fecha1->diff($fecha2);

  $dias = $intervalo->format('%d');

  $fecha3 = new DateTime($fechaAlta);//fecha de cierre
  $intervaloReal = $fecha1->diff($fecha3);
  $diasReal = $intervaloReal->format('%d');


  if ($recibido == "1" AND $diasReal > $dias) {
    $rojo = "rojo";
  }else {
    $rojo = "";
  }

  if ($estatusTipo == "Facturacion" AND $recibido == "1" AND $finalizar == 0) {
    $color = "";
    $onclick = "detalle_eventos_facturacion($pk_bitacora)";
  }elseif ($finalizar == 1) {
    $onclick = "detalle_fetch($pk_bitacora)";
  }else {
    $color = "rojo";
    $onclick = "recibirExpediente($pk_bitacora)";
  }


  $concluir = "";
  if ($finalizar == 1) {
    $concluir = "<img class='w-30'  src='/pltoolbox/Resources/iconos/check-mark.svg'>";
  }else {
    $concluir = $diasReal;
  }

// $diasReal > $dias  // $diasReal


  $system_callback['data'] .="
  <tr class='row m-0 align-items-center bbyellow'>
    <td class='col-md-11 py-1'>
      <span class='ls-3'>
        <a id='' href='#' onclick='$onclick' referencia='$referencia' class='$expediente alink detalle' db-id='$pk_bitacora'>$nombreCliente</a>
      </span>
      <br>
      <span class='$color'>$referencia --  $indice</span>
    </td>
    <td class='col-md-1 py-1 font18 text-center $rojo'>$concluir</td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
