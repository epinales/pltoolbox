<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/utilities/initialGlobal.php';

$system_callback = [];
$data = $_POST;

$referencia = $data['referencia'];

$query = "SELECT
t.eTipoOperacion,
t.sCveTrafico,
t.sCveCliente,


c.sCveCliente,
c.sRazonSocial

FROM cb_trafico t
INNER JOIN cu_cliente c ON t.sCveCliente = c.sCveCliente
WHERE sCveTrafico = ?";

$stmt = $global->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$global->errno]: $global->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$referencia);
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
  $sRazonSocial = $row['sRazonSocial'];
  $sCveTrafico = $row['sCveTrafico'];
  $tipo = $row['eTipoOperacion'];
  $primeraLetra = substr($sCveTrafico,0,1);
  $impoExpo = "";
  $oficina = "";

  if ($tipo == "I") {
    $impoExpo = 'Impo';
  }elseif ($tipo == "E") {
    $impoExpo = "Expo";
  }

  if ($primeraLetra == "N" AND $tipo == 'I') {
    $oficina = 'Laredo Texas';
  }elseif ($primeraLetra == "N" AND $tipo == 'E') {
    $oficina = 'Nuevo Laredo';
  }elseif ($primeraLetra == "V") {
    $oficina = "Veracruz";
  }elseif ($primeraLetra == "M") {
    $oficina = "Manzanillo";
  }elseif ($primeraLetra == "A") {
    $oficina = "Aeropuerto";
  }



  $system_callback['data'] .="
    <td class='col-md-12'>
      <input id='a_oficina' type='hidden' value='$oficina'>
      Cliente : <input id='a_cliente' type='text' value='$sRazonSocial' class='w-100 bt border-0'>
    </td>

    <td class='col-md-12'>
      Tipo : <input id='a_tipo' type='text' value='$impoExpo' class='bt border-0'>
    </td>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
