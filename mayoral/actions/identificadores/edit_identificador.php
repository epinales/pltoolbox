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

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

extract($_POST);

$system_callback = [];

$agregar_fracciones_aplicables = "INSERT INTO mayoral_identificadores_fracciones(fk_identificador, fraccion) VALUES (?,?)";
$agregar_fracciones_aplicables = $db->prepare($agregar_fracciones_aplicables);

$query_name = "NUEVAS FRACCIONES APLICABLES";

foreach ((array)$nuevas_fracciones['aplicables'] as $fraccion) {
  $agregar_fracciones_aplicables->bind_param('ss', $pk_identificador, $fraccion);
  if (!($agregar_fracciones_aplicables)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during $query_name variables binding [$agregar_fracciones_aplicables->errno]: $agregar_fracciones_aplicables->error";
    exit_script($system_callback);
  }

  if (!($agregar_fracciones_aplicables->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during $query_name query execution [$agregar_fracciones_aplicables->errno]: $agregar_fracciones_aplicables->error";
    exit_script($system_callback);
  }

  if ($agregar_fracciones_aplicables->affected_rows > 0) {
    $system_callback['code'] = 1;
    $system_callback['message'] = "Fraccion agregada exitosamente";
  } else {
    $system_callback['code'] = "600";
    $system_callback['message'] = "No se pudo agregar la fraccion correctamente [$db->errno]: $db->error.";
    exit_script($system_callback);
  }
}

$agregar_fracciones_excepciones = "INSERT INTO mayoral_identificadores_fraccion_excepciones(fk_identificador, fraccion) VALUES (?,?)";
$agregar_fracciones_excepciones = $db->prepare($agregar_fracciones_excepciones);

$query_name = "NUEVAS FRACCIONES EXCEPCIONES";

foreach ((array)$nuevas_fracciones['excepciones'] as $fraccion) {
  $agregar_fracciones_excepciones->bind_param('ss', $pk_identificador, $fraccion);
  if (!($agregar_fracciones_excepciones)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during $query_name variables binding [$agregar_fracciones_excepciones->errno]: $agregar_fracciones_excepciones->error";
    exit_script($system_callback);
  }

  if (!($agregar_fracciones_excepciones->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during $query_name query execution [$agregar_fracciones_excepciones->errno]: $agregar_fracciones_excepciones->error";
    exit_script($system_callback);
  }

  if ($agregar_fracciones_excepciones->affected_rows > 0) {
    $system_callback['code'] = 1;
    $system_callback['message'] = "Fraccion agregada exitosamente";
  } else {
    $system_callback['code'] = "600";
    $system_callback['message'] = "No se pudo agregar la fraccion correctamente [$db->errno]: $db->error.";
    exit_script($system_callback);
  }
}


$eliminar_fracciones_aplicables = "DELETE FROM mayoral_identificadores_fracciones WHERE fk_identificador = ? AND fraccion = ?";
$eliminar_fracciones_aplicables = $db->prepare($eliminar_fracciones_aplicables);

$query_name = "ELIMINAR FRACCIONES APLICABLES";

if (!($eliminar_fracciones_aplicables)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during $query_name prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}


foreach ((array)$eliminar_fracciones['aplicables'] as $fraccion) {
  $eliminar_fracciones_aplicables->bind_param('ss', $pk_identificador, $fraccion);
  if (!($eliminar_fracciones_aplicables)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during $query_name variables binding [$eliminar_fracciones_aplicables->errno]: $eliminar_fracciones_aplicables->error";
    exit_script($system_callback);
  }

  if (!($eliminar_fracciones_aplicables->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during $query_name query execution [$eliminar_fracciones_aplicables->errno]: $eliminar_fracciones_aplicables->error";
    exit_script($system_callback);
  }

  if ($eliminar_fracciones_aplicables->affected_rows > 0) {
    $system_callback['code'] = 1;
    $system_callback['message'] = "Fraccion agregada exitosamente";
  } else {
    $system_callback['code'] = "600";
    $system_callback['message'] = "No se pudo agregar la fraccion correctamente [$db->errno]: $db->error.";
    exit_script($system_callback);
  }
}


$eliminar_fracciones_excepciones = "DELETE FROM mayoral_identificadores_fraccion_excepciones WHERE fk_identificador = ? AND fraccion = ?";
$eliminar_fracciones_excepciones = $db->prepare($eliminar_fracciones_excepciones);

$query_name = "ELIMINAR FRACCIONES EXCEPCIONES";

foreach ((array)$eliminar_fracciones['excepciones'] as $fraccion) {
  $eliminar_fracciones_excepciones->bind_param('ss', $pk_identificador, $fraccion);
  if (!($eliminar_fracciones_excepciones)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during $query_name variables binding [$eliminar_fracciones_excepciones->errno]: $eliminar_fracciones_excepciones->error";
    exit_script($system_callback);
  }

  if (!($eliminar_fracciones_excepciones->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during $query_name query execution [$eliminar_fracciones_excepciones->errno]: $eliminar_fracciones_excepciones->error";
    exit_script($system_callback);
  }

  if ($eliminar_fracciones_excepciones->affected_rows > 0) {
    $system_callback['code'] = 1;
    $system_callback['message'] = "Fraccion agregada exitosamente";
  } else {
    $system_callback['code'] = "600";
    $system_callback['message'] = "No se pudo agregar la fraccion correctamente [$db->errno]: $db->error.";
    exit_script($system_callback);
  }
}


//Cambiar complemento 3 para el folio de la UVA.

  //Determinar que en efecto estemos hablando de un identificador PB.

$query = "SELECT identificador FROM mayoral_identificadores WHERE pk_identificador = ?";
$editar_c3 = "UPDATE mayoral_identificadores SET complemento3 = ? WHERE pk_identificador = ?";

$consultar_identificador = $db->prepare($query);
$consultar_identificador->bind_param('s', $pk_identificador);
$consultar_identificador->execute();

$cual_identificador = $consultar_identificador->get_result()->fetch_assoc();

if ($cual_identificador['identificador'] == "PB") {
  $editar_c3 = $db->prepare($editar_c3);
  $editar_c3->bind_param('ss', $comple3, $pk_identificador);
  $editar_c3->execute();
}



$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>
