<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/pltoolbox/Resources/PHP/utilities/initialScript.php';

  $nombreCliente = trim($_POST['fa_cliente']);
  $oficina = trim($_POST['fa_oficina']);
  $referencia = "SN";
  $estatusTipo = "Facturacion";
  $estatusIndice = 11;
  $entregadoFact = 0;
  $recibidoFact = 1;
  $cuenta_fact = trim($_POST['fa_identCuenta']);


  $query = "INSERT INTO bitacora (nombreCliente,
                                  oficina,
                                  referencia,
                                  UsuarioAlta,
                                  fechaAlta,
                                  estatusTipo,
                                  estatusIndice,
                                  entregadoFact,
                                  recibidoFact,
                                  cuenta_fact)
                  VALUES (?,?,?,?,?,?,?,?,?,?)";

  $stmt = $db->prepare($query);
  if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmt->bind_param('ssssssssss',$nombreCliente,
                                 $oficina,
                                 $referencia,
                                 $usuarioAlta,
                                 $fechaAlta,
                                 $estatusTipo,
                                 $estatusIndice,
                                 $entregadoFact,
                                 $recibidoFact,
                                 $cuenta_fact);
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

  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

?>
