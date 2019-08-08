<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$db->query('LOCK TABLES bitacora WRITE;');
$db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

$pk_bitacora = trim($_POST['pk_bitacora']);
$referencia = trim($_POST['referencia']);
$cliente = trim($_POST['cliente']);
$tipo = trim($_POST['tipo']);
$estatusIndice = trim($_POST['estatusIndice']);
$oficina = trim($_POST['oficina']);

$prealerta_fecha = trim($_POST['prealerta_fecha']);
$prealerta_hora = trim($_POST['prealerta_hora']);
$arribo_fecha = trim($_POST['arribo_fecha']);
$arribo_hora = trim($_POST['arribo_hora']);



$queryValidar = "SELECT * FROM bitacora WHERE referencia = ?";
$stmtValidar = $db->prepare($queryValidar);
if (!($stmtValidar)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtValidar->bind_param('s',$referencia);
if (!($stmtValidar)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error al pasar variables [$stmtValidar->errno]: $stmtValidar->error";
  exit_script($system_callback);
}
if (!($stmtValidar->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion [$stmtValidar->errno]: $stmtValidar->error";
  exit_script($system_callback);
}
$rsltValidar = $stmtValidar->get_result();
if ($rsltValidar->num_rows > 0) {
  $system_callback['code'] = 305;
  $system_callback['message'] = "Esta referencia ya existe, favor de verificar";
  exit_script($system_callback);
}else {
  try {
    $db->begin_transaction(); //Inicia la transaccion
    $query = "UPDATE bitacora
    SET nombreCliente = ?,
    oficina = ?,
    referencia = ?,
    UsuarioModif = ?,
    fechaModif = ?,
    estatusIndice = ?,
    tipo = ?
    WHERE pk_bitacora = ?";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    $stmt->bind_param('ssssssss',$cliente,
                                 $oficina,
                                 $referencia,
                                 $usuarioAlta,
                                 $fechaAlta,
                                 $estatusIndice,
                                 $tipo,
                                 $pk_bitacora);
    if (!($stmt)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
      exit_script($system_callback);
    }

    if (!($stmt->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
      exit_script($system_callback);
    }

    $affected = $stmt->affected_rows;
    $system_callback['affected'] = $affected;
    $system_callback['datos'] = $_POST;

    if ($affected == 0) {
      $system_callback['code'] = 2;
      $system_callback['message'] = "el query uno no hizo nada";
      exit_script($system_callback);
    }


    $query_detalle = "UPDATE bitacora_detalle
    SET prealerta_fecha = ?,
    prealerta_hora = ?,
    arribo_fecha = ?,
    arribo_hora = ?,
    apertura_fecha = ?,
    apertura_hora = ?,
    usuarioRegistro = ?
    WHERE fk_bitacora = ?";

     $stmt_detalle = $db->prepare($query_detalle);
      if (!($stmt_detalle)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
        exit_script($system_callback);
      }

     $stmt_detalle->bind_param('ssssssss',$prealerta_fecha,
                                          $prealerta_hora,
                                          $arribo_fecha,
                                          $arribo_hora,
                                          $fechaActual,
                                          $horaActual,
                                          $usuarioAlta,
                                          $pk_bitacora);



    if (!($stmt_detalle)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_detalle->errno]: $stmt_detalle->error";
    exit_script($system_callback);
    }

    if (!($stmt_detalle->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error durante la ejecucion [$stmt_detalle->errno]: $stmt_detalle->error";
    exit_script($system_callback);
    }

    $affected_detalle = $stmt_detalle->affected_rows;
    $system_callback['affected'] = $affected_detalle;
    $system_callback['datos'] = $_POST;

    if ($affected_detalle == 0) {
    $system_callback['code'] = 2;
    $system_callback['message'] = "El query 2 no hizo nada";
    exit_script($system_callback);
    }



    $descripcion = "Se modifico el trafico, cambio de SN a referencia :$referencia";
    $seccion = 'trafico';

    require $root . '/pltoolbox/BitacoraProlog/actions/registroActividad.php';

    $db->commit();
    $db->query('UNLOCK TABLES;');
    $system_callback['code'] = 1;
    $system_callback['message'] = "Script called successfully!";
  } catch (\Exception $e) {
    $db->rollback();
    $system_callback['code'] = 501;
    $system_callback['message'] = $db->error;
  }

  exit_script($system_callback);

}




?>
