<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$db->query('LOCK TABLES bitacora WRITE;');
$db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

$pk_bitacora = trim($_POST['pk_bitacora']);
$pk_indice = trim($_POST['pk_indice']);
$prealerta_fecha = trim($_POST['prealerta_fecha']);
$prealerta_hora = trim($_POST['prealerta_hora']);
$arribo_fecha = trim($_POST['arribo_fecha']);
$arribo_hora = trim($_POST['arribo_hora']);
$apertura_fecha = trim($_POST['apertura_fecha']);
$apertura_hora = trim($_POST['apertura_hora']);
$capfact_fecha = trim($_POST['capfact_fecha']);
$capfact_hora = trim($_POST['capfact_hora']);
$clasif_fecha = trim($_POST['clasif_fecha']);
$clasif_hora = trim($_POST['clasif_hora']);
$solant_fecha = trim($_POST['solant_fecha']);
$solant_hora = trim($_POST['solant_hora']);
$deposito_fecha = trim($_POST['deposito_fecha']);
$deposito_hora = trim($_POST['deposito_hora']);
$pago_fecha = trim($_POST['pago_fecha']);
$pago_hora = trim($_POST['pago_hora']);
$program_fecha = trim($_POST['program_fecha']);
$program_hora = trim($_POST['program_hora']);
$entrega_fecha = trim($_POST['entrega_fecha']);
$entrega_hora = trim($_POST['entrega_hora']);

// para la bitacora_ediciones
$referencia = trim($_POST['referencia']);

try {
  $db->begin_transaction(); //Inicia la transaccion
  $query = "UPDATE bitacora
  SET estatusIndice = ?
  WHERE pk_bitacora = ?";

  $stmt = $db->prepare($query);
  if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmt->bind_param('ss',$pk_indice,$pk_bitacora);
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



  $query_detalle = "UPDATE bitacora_detalle
  SET prealerta_fecha = ?,
  prealerta_hora = ?,
  arribo_fecha = ?,
  arribo_hora = ?,
  apertura_fecha = ?,
  apertura_hora = ?,
  capfact_fecha = ?,
  capfact_hora = ?,
  clasif_fecha = ?,
  clasif_hora = ?,
  solant_fecha = ?,
  solant_hora = ?,
  deposito_fecha = ?,
  deposito_hora = ?,
  pago_fecha = ?,
  pago_hora = ?,
  program_fecha = ?,
  program_hora = ?,
  entrega_fecha = ?,
  entrega_hora = ?,
  usuarioEdito = ?
  WHERE fk_bitacora = ?";


 $stmt_detalle = $db->prepare($query_detalle);
  if (!($stmt_detalle)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
    exit_script($system_callback);
  }



  $stmt_detalle->bind_param('ssssssssssssssssssssss',$prealerta_fecha,
                                                     $prealerta_hora,
                                                     $arribo_fecha,
                                                     $arribo_hora,
                                                     $apertura_fecha,
                                                     $apertura_hora,
                                                     $capfact_fecha,
                                                     $capfact_hora,
                                                     $clasif_fecha,
                                                     $clasif_hora,
                                                     $solant_fecha,
                                                     $solant_hora,
                                                     $deposito_fecha,
                                                     $deposito_hora,
                                                     $pago_fecha,
                                                     $pago_hora,
                                                     $program_fecha,
                                                     $program_hora,
                                                     $entrega_fecha,
                                                     $entrega_hora,
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

  if ($affected_detalle == 0 AND $affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "No hubo ningun cambio";
  exit_script($system_callback);
  }



  $descripcion = "Se actualizo el detalle de la bitacora en referencia $referencia";
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

?>
