<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$oficina = $data['oficina'];
$andWhere = 'WHERE oficina = ?';

$query = "SELECT * FROM bitacora INNER JOIN oficinas ON oficina = o_nombre $andWhere";

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
  $nombreCliente = $row['nombreCliente'];
  $tipo = $row['tipo'];
  $referencia = $row['referencia'];
  $estatusActual = $row['estatusActual'];
  $estatusSiguiente = $row['estatusSiguiente'];
  $oficina = $row['oficina'];
  $fechaModif = $row['fechaModif'];
  $UsuarioModif = $row['UsuarioModif'];
  $UsuarioAlta = $row['UsuarioAlta'];


  $fechaAlta = $row['fechaAlta'];
  $amarillo = $row['o_amarillo'];
  $rojo = $row['o_rojo'];
  $alerta = $row['o_alerta'];


  $fecha1 = new DateTime($fechaAlta);//fecha inicial
  $fecha2 = new DateTime('2016-11-30 11:55:06');//fecha de cierre

  $intervalo = $fecha1->diff($fecha2);

  $diferencia = $intervalo->format('%Y años %m meses %d days %H horas %i minutos
  %s segundos');//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos



  $system_callback['data'] .="
  <tr class='row m-0 align-items-center bbyellow'>
    <td class='col-md-8'>
      <span class='ls-3'>$nombreCliente</span> <br> $tipo -- $referencia ($UsuarioAlta) <br />
      <span style='color:rgba(127, 141, 142, 0.71);'>Ultima Modificación: $fechaModif / $UsuarioModif</span>
    </td>
    <td class='col-md-3'>
      $estatusActual <br />
      Tiempo total : $diferencia <br />
      Disponible :
    </td>

    <td class='col-md-1'>
      <img src='/pltoolbox/Resources/iconos/$icono'>
    </td>

  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
