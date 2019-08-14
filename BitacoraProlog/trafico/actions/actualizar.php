<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$db->query('LOCK TABLES bitacora WRITE;');
$db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

$pk_bitacora = $_POST['pk_bitacora'];
$pk_indice = $_POST['pk_indice'];

$prealerta = $_POST['prealerta_fecha'];
if ($prealerta == "") { $prealerta_fecha = NULL;}else {$prealerta_fecha = $prealerta;}
$prealerta_hora = $_POST['prealerta_hora'];


$arribo = $_POST['arribo_fecha'];
if ($arribo == "") {$arribo_fecha = NULL;}else {$arribo_fecha = $arribo;}
$arribo_hora = $_POST['arribo_hora'];


$apertura = $_POST['apertura_fecha'];
if ($apertura == "") {$apertura_fecha = NULL;}else {$apertura_fecha = $apertura;}
$apertura_hora = $_POST['apertura_hora'];


$capfact = $_POST['capfact_fecha'];
if ($capfact == "") {$capfact_fecha = NULL;}else {$capfact_fecha = $capfact;}
$capfact_hora = $_POST['capfact_hora'];


$clasif = $_POST['clasif_fecha'];
if ($clasif == "") {$clasif_fecha = NULL;}else {$clasif_fecha = $clasif;}
$clasif_hora = $_POST['clasif_hora'];


$solant = $_POST['solant_fecha'];
if ($solant == "") {$solant_fecha = NULL;}else {$solant_fecha = $solant;}
$solant_hora = $_POST['solant_hora'];


$deposito = $_POST['deposito_fecha'];
if ($deposito == "") {$deposito_fecha = NULL;}else {$deposito_fecha = $deposito;}
$deposito_hora = $_POST['deposito_hora'];


$pago = $_POST['pago_fecha'];
if ($pago == "") {$pago_fecha = NULL;}else {$pago_fecha = $pago;}
$pago_hora = $_POST['pago_hora'];


$program = $_POST['program_fecha'];
if ($program == "") {$program_fecha = NULL;}else {$program_fecha = $program;}
$program_hora = $_POST['program_hora'];


$entrega = $_POST['entrega_fecha'];
if ($entrega == "") {$entrega_fecha = NULL;}else {$entrega_fecha = $entrega;}
$entrega_hora = $_POST['entrega_hora'];


// para la bitacora_ediciones
$referencia = $_POST['referencia'];

try {
  $db->begin_transaction(); //Inicia la transaccion
  $query = "UPDATE bitacora
  SET UsuarioModif = ?,
  fechaModif = ?,
  estatusIndice = ?
  WHERE pk_bitacora = ?";

  $stmt = $db->prepare($query);
  if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmt->bind_param('ssss',$usuarioAlta,$fechaAlta,$pk_indice,$pk_bitacora);
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
