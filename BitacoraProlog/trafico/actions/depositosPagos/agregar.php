<?php
 $root = $_SERVER['DOCUMENT_ROOT'];
 require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

 $tipo = trim($_POST['tipo']);
 $iva = trim($_POST['iva']);
 $concepto = trim($_POST['concepto']);
 $comentarios = trim($_POST['comentarios']);
 $deposito = trim($_POST['deposito']);
 $pago = trim($_POST['pago']);
 $pk_bitacora = trim($_POST['pk_bitacora']);
 $referencia = trim($_POST['referencia']);



 $query = "INSERT INTO bitacora_transaccion (dp_tipo,dp_montoDepo,dp_montoPago,dp_iva,dp_concepto,dp_comentarios,dp_usuario,dp_datetime,fk_bitacora_dp) VALUES (?,?,?,?,?,?,?,?,?)";

 $stmt = $db->prepare($query);
 if (!($stmt)) {
   $system_callback['code'] = "500";
   $system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
   exit_script($system_callback);
 }

 $stmt->bind_param('sssssssss',$tipo,
                               $deposito,
                               $pago,
                               $iva,
                               $concepto,
                               $comentarios,
                               $usuarioAlta,
                               $fechaAlta,
                               $pk_bitacora);
 if (!($stmt)) {
   $system_callback['code'] = "500";
   $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
   exit_script($system_callback);
 }

 if (!($stmt->execute())) {
   $system_callback['code'] = "500";
   $system_callback['message'] = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
   exit_script($system_callback);
 }

 $affected = $stmt->affected_rows;
 $system_callback['affected'] = $affected;
 $system_callback['datos'] = $_POST;

 if ($affected == 0) {
   $system_callback['code'] = 2;
   $system_callback['message'] = "El query no hizo ningún cambio a la base de datos";
   exit_script($system_callback);
 }

 $descripcion = "Se agrego nuevo $tipo en la referencia $referencia";
 $seccion = 'trafico';

 require $root . '/pltoolbox/BitacoraProlog/actions/registroActividad.php';

 $system_callback['code'] = 1;
 $system_callback['message'] = "Script called successfully!";
 exit_script($system_callback);


 ?>
