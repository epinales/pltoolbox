<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$db->query('LOCK TABLES bitacora WRITE;');
$db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

$pk_bitacora = $_POST['pk_bitacora'];
$pk_indice = $_POST['pk_indice'];
$numCuenta = $_POST['numCuenta'];
$trackId = $_POST['trackId'];
$saldo = $_POST['saldo'];
$tipoSaldo = $_POST['tipoSaldo'];
$honorarios = $_POST['honorarios'];
$vencimientoFact = $_POST['vencimientoFact'];
$referencia = $_POST['referencia'];
// $finalizar = $_POST['finalizar'];



$ctaGastos = $_POST['ctaGastos_fecha'];
if ($ctaGastos == "") {$ctaGastos_fecha = NULL;}else {$ctaGastos_fecha = $ctaGastos;}
$ctaGastos_hora = $_POST['ctaGastos_hora'];

$cobDev = $_POST['cobDev_fecha'];
if ($cobDev == "") {$cobDev_fecha = NULL;}else {$cobDev_fecha = $cobDev;}
$cobDev_hora = $_POST['cobDev_hora'];


try{
  $db->begin_transaction();

  //primer query
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


  //segunda query

  $query_detalle = "UPDATE bitacora_detalle_facturacion
  SET vencimientoFact = ?,
  ctaGastos_fecha = ?,
  ctaGastos_hora = ?,
  cobDev_fecha = ?,
  cobDev_hora = ?,
  numCuenta = ?,
  trackId = ?,
  honorarios = ?,
  saldo = ?,
  tipoSaldo = ?
  WHERE fk_bitacora = ?";

  $stmt_detalle = $db->prepare($query_detalle);
   if (!($stmt_detalle)) {
     $system_callback['code'] = "500";
     $system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
     exit_script($system_callback);
   }


//pendiente
   $stmt_detalle->bind_param('sssssssssss',$vencimientoFact,
                                           $ctaGastos_fecha,
                                           $ctaGastos_hora,
                                           $cobDev_fecha,
                                           $cobDev_hora,
                                           $numCuenta,
                                           $trackId,
                                           $honorarios,
                                           $saldo,
                                           $tipoSaldo,
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

   //en caso de tener botacora de Actividad
   //Tercer query

   $descripcion = "Se modifico detalle referencia $referencia";
   $seccion = 'Facturacion';

   require $root . '/pltoolbox/BitacoraProlog/actions/registroActividad.php';

   $db->commit();
   $db->query('UNLOCK TABLES;');
   $system_callback['code'] = 1;
   $system_callback['message'] = "Script called successfully!";
} catch (Exception $e) {
  $db->rollback();
  $system_callback['code'] = 501;
  $system_callback['message'] = $db->error;
}
exit_script($system_callback);
?>
