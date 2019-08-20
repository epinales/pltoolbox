<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';


$system_callback = [];
$db->query('LOCK TABLES tablabloqueada WRITE;');
$db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

$nombreCliente = trim($_POST['fa_cliente']);
$oficina = trim($_POST['fa_oficina']);
$referencia = "SN";
$estatusTipo = "Facturacion";
$estatusIndice = 11;
$entregadoFact = 1;
$recibidoFact = 1;
$finalizar = 0;
$cuenta_fact = trim($_POST['fa_identCuenta']);
// $fecha = date('Y-m-d h:i:s');


$fecha = strtotime ( '+1 day' , strtotime ( $fechaAlta ) ) ;
$fecha = date ( 'Y-m-d h:i:s' , $fecha );
// echo $nuevafecha;

try{
  $db->begin_transaction();

  //primer query
  $query = "INSERT INTO bitacora (nombreCliente,
                                  oficina,
                                  referencia,
                                  UsuarioAlta,
                                  fechaAlta,
                                  estatusTipo,
                                  estatusIndice,
                                  entregadoFact,
                                  recibidoFact)
                  VALUES (?,?,?,?,?,?,?,?,?)";

  $stmt = $db->prepare($query);
  if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmt->bind_param('sssssssss',$nombreCliente,
                                 $oficina,
                                 $referencia,
                                 $usuarioAlta,
                                 $fechaAlta,
                                 $estatusTipo,
                                 $estatusIndice,
                                 $entregadoFact,
                                 $recibidoFact);
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


  $fk_bitacora = $db->insert_id;



  //segunda query
  $query_detalle = "INSERT INTO bitacora_detalle_facturacion (fk_bitacora,
                                                              recibidoFact,
                                                              vencimientoFact,
                                                              numCuenta,
                                                              finalizar)
                                                       VALUES (?,?,?,?,?)";

  $stmt_detalle = $db->prepare($query_detalle);
   if (!($stmt_detalle)) {
     $system_callback['code'] = "500";
     $system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
     exit_script($system_callback);
   }

   $stmt_detalle->bind_param('sssss',$fk_bitacora,
                                      $fechaAlta,
                                      $fecha,
                                      $cuenta_fact,
                                      $finalizar);


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

   //en caso de tener bitacora de Actividad
   //Tercer query

   $descripcion = "Se agrego esta cuenta $cuenta_fact en bitacora facturacion sin referencia (pk:$fk_bitacora)";
   $seccion = 'facturacion';

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
