<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';


$system_callback = [];
$db->query('LOCK TABLES bitacora WRITE;');
$db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

$pk_bitacora = trim($_POST['pk_bitacora']);
$referencia = trim($_POST['referencia']);
$recibidoFact = 1;
$estatusTipo = "Facturacion";
$estatusIndice = "11";

try {

  $db->begin_transaction();

  $query = "UPDATE bitacora
  SET UsuarioModif = ?,
  fechaModif = ?,
  estatusTipo = ?,
  estatusIndice = ?,
  recibidoFact = ?
  WHERE pk_bitacora = ?";

  $stmt = $db->prepare($query);
  if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmt->bind_param('ssssss',$usuarioAlta,$fechaAlta,$estatusTipo,$estatusIndice,$recibidoFact,$pk_bitacora);
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
  SET recibidoFact = ?
  WHERE fk_bitacora = ?";

  $stmt_detalle = $db->prepare($query_detalle);
   if (!($stmt_detalle)) {
     $system_callback['code'] = "500";
     $system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
     exit_script($system_callback);
   }

   $stmt_detalle->bind_param('ss',$fechaAlta,
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




  $descripcion = "A recibido el expediente con referencia $referencia";
  $seccion = 'facturacion';

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
