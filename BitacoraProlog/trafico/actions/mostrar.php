<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$oficina = $data['oficina'];
$andWhere = 'WHERE oficina = ? AND terminado = 0';

$query = "SELECT

b.pk_bitacora,
b.nombreCliente,
b.tipo,
b.referencia,
b.oficina,
b.UsuarioAlta,
b.fechaAlta,
b.UsuarioModif,
b.fechaModif,

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
LEFT JOIN bitacora_depoPago bdp ON b.pk_bitacora = bdp.fk_bitacora_dp
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
  $tipo = $row['tipo'];
  $referencia = $row['referencia'];
  $estatusActual = $row['estatusActual'];
  $estatusSiguiente = $row['estatusSiguiente'];
  $oficina = $row['oficina'];
  $fechaModif = $row['fechaModif'];
  $UsuarioModif = $row['UsuarioModif'];
  $UsuarioAlta = $row['UsuarioAlta'];
  $icono = '';


  $fechaActual = date("Y-m-d h:i:s");
  $fechaAlta = $row['fechaAlta'];
  $amarillo = $row['o_amarillo'];
  $rojo = $row['o_rojo'];
  $alerta = $row['o_alerta'];


  $deposito = number_format($row['deposito'], 2);
  $pago = number_format($row['pago'], 2);


  $pk_indice = $row['pk_indice'];
  $indice = $row['indice'];


  $fecha1 = new DateTime($fechaAlta);//fecha inicial
  $fecha2 = new DateTime($fechaActual);//fecha de cierre
  $intervalo = $fecha1->diff($fecha2);
  $diferencia = $intervalo->format('%d dias %H:%i horas');

  $dias = $intervalo->format('%d');

  if ($dias < $amarillo) {
    $icono = 'circular-verde.svg';
  }elseif ($dias >=  $amarillo AND $dias < $rojo) {
    $icono = 'circular-amarillo.svg';
  }elseif ($dias >=  $rojo AND $dias < $alerta) {
    $icono = 'circular-rojo.svg';
  }elseif ($dias >=  $alerta) {
    $icono = 'warning.svg';
  }




  $system_callback['data'] .="
  <tr class='row m-0 align-items-center bbyellow'>
    <td class='col-md-8'>
      <span class='ls-3'>
        <a href='#' onclick='correspAsignar($pk_bitacora)' class='alink' db-id='$pk_bitacora'>$nombreCliente</a>
      </span>
      <br> $tipo -- $referencia ($UsuarioAlta) <br />
      <span style='color:rgba(127, 141, 142, 0.71);'>
        Ultima Modificación: $fechaModif / $UsuarioModif
      </span>
    </td>
    <td class='col-md-3'>
      $indice <br />
      Tiempo total : $diferencia <br />
      Disponible : $deposito
    </td>

    <td class='col-md-1 text-center'>
      <img class='w-32'  src='/pltoolbox/Resources/iconos/$icono'>
    </td>

  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
