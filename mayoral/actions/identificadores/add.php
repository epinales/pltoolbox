<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
extract($_POST); //Should contain identificador and fracciones[aplicables], fracciones[excepciones]


$db->query('LOCK TABLES mayoral_identificadores, mayoral_identificadores_fraccion, mayoral_identificadores_fraccion_excepciones WRITE;');
$db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

try {

  $db->begin_transaction();

  $insert_identificadores = "INSERT INTO mayoral_identificadores (identificador, complemento1, complemento2, complemento3, complemento4) VALUES (?,?,?,?,?) ";

  $insert_identificadores = $db->prepare($insert_identificadores);
  if (!($insert_identificadores)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during trip query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }


  $insert_identificadores->bind_param('sssss', $identificador['identificador'], $identificador['complemento1'], $identificador['complemento2'], $identificador['complemento3'], $identificador['complemento4']);
  if (!($insert_identificadores)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during trip variables binding [$insert_identificadores->errno]: $insert_identificadores->error";
    exit_script($system_callback);
  }

  if (!($insert_identificadores->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during trip query execution [$insert_identificadores->errno]: $insert_identificadores->error";
    exit_script($system_callback);
  }

  if ($insert_identificadores->affected_rows > 0) {
    $system_callback['code'] = 1;
    $system_callback['message'] = "Identificador agregado exitosamente.";
  } else {
    $system_callback['code'] = "600";
    $system_callback['message'] = "No se pudo agregar el viaje correctamente [$db->errno]: $db->error.";
    exit_script($system_callback);
  }



  $pk_identificador = $db->insert_id;


  $insert_fracciones_aplicables = "INSERT INTO mayoral_identificadores_fracciones(fk_identificador, fraccion) VALUES (?,?)";
  $insert_fracciones_aplicables = $db->prepare($insert_fracciones_aplicables);

  foreach ($fracciones['aplicables'] as $fraccion) {
    $insert_fracciones_aplicables->bind_param('ss', $pk_identificador, $fraccion);
    if (!($insert_fracciones_aplicables)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during trip variables binding [$insert_fracciones_aplicables->errno]: $insert_fracciones_aplicables->error";
      exit_script($system_callback);
    }

    if (!($insert_fracciones_aplicables->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during trip query execution [$insert_fracciones_aplicables->errno]: $insert_fracciones_aplicables->error";
      exit_script($system_callback);
    }

    if ($insert_fracciones_aplicables->affected_rows > 0) {
      $system_callback['code'] = 1;
      $system_callback['message'] = "Fraccion agregada exitosamente";
    } else {
      $system_callback['code'] = "600";
      $system_callback['message'] = "No se pudo agregar la fraccion correctamente [$db->errno]: $db->error.";
      exit_script($system_callback);
    }

  }

  $insert_fracciones_excluisiones = "INSERT INTO mayoral_identificadores_fraccion_excepciones(fk_identificador, fraccion) VALUES (?,?)";
  $insert_fracciones_excluisiones = $db->prepare($insert_fracciones_excluisiones);

  foreach ($fracciones['excepciones'] as $fraccion) {
    $insert_fracciones_excluisiones->bind_param('ss', $pk_identificador, $fraccion);
    if (!($insert_fracciones_excluisiones)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during trip variables binding [$insert_fracciones_excluisiones->errno]: $insert_fracciones_excluisiones->error";
      exit_script($system_callback);
    }

    if (!($insert_fracciones_excluisiones->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during trip query execution [$insert_fracciones_excluisiones->errno]: $insert_fracciones_excluisiones->error";
      exit_script($system_callback);
    }

    if ($insert_fracciones_excluisiones->affected_rows > 0) {
      $system_callback['code'] = 1;
      $system_callback['message'] = "Fraccion agregada exitosamente";
    } else {
      $system_callback['code'] = "600";
      $system_callback['message'] = "No se pudo agregar la fraccion correctamente [$db->errno]: $db->error.";
      exit_script($system_callback);
    }

  }



  $system_callback['code'] = 1;
  $system_callback['identificador'] = $pk_identificador;
  $system_callback['message'] = "Identificador agregado exitosamente!";
  $db->commit();
  $db->query('UNLOCK TABLES;');
  exit_script($system_callback);

} catch (\Exception $e) {
  $db->rollback();
  $system_callback['code'] = "2";
  $system_callback['message'] = "Hubo un problema ejecutando el quuery, reportar a soporte técnico: [$db->errno]: $db->error";
  $db->query('UNLOCK TABLES;');
  exit_script($system_callback);
}







 ?>
