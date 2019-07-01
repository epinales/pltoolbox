<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/utilities/initialScript.php';

$system_callback = [];
$db->query('LOCK TABLES bitacora WRITE;');
$db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

//variables
$a_cliente = trim($_POST['a_cliente']);
$a_estatusActual = trim($_POST['a_estatusActual']);
$a_estatusSiguiente = trim($_POST['a_estatusSiguiente']);
$a_oficina = trim($_POST['a_oficina']);
$a_referencia = trim($_POST['a_referencia']);
$a_usuarioAlta = trim($_POST['a_usuarioAlta']);
$a_fechaAlta = trim($_POST['a_fechaAlta']);
$a_estatusTipo = trim($_POST['a_estatusTipo']);
$a_tipo = trim($_POST['a_tipo']);



$queryValidar = "SELECT * FROM bitacora WHERE referencia = ?";
$stmtValidar = $db->prepare($queryValidar);
if (!($stmtValidar)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtValidar->bind_param('s',$a_referencia);
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
if ($rsltValidar->num_rows > 0 AND $a_referencia != "SN") {
  $system_callback['code'] = 305;
  $system_callback['message'] = "Esta referencia ya existe.";
  exit_script($system_callback);
}else {
	try{
		$db->begin_transaction(); //Inicia la transaccion



		$query = "INSERT INTO bitacora (nombreCliente,
																		estatusActual,
																		estatusSiguiente,
																		oficina,
																		referencia,
																		UsuarioAlta,
																		fechaAlta,
																		estatusTipo,
																		tipo) VALUES (?,?,?,?,?,?,?,?,?)";

		$stmt = $db->prepare($query);
		if (!($stmt)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
			exit_script($system_callback);
		}

		$stmt->bind_param('sssssssss',$a_cliente,$a_estatusActual,$a_estatusSiguiente,$a_oficina,$a_referencia,$a_usuarioAlta,$a_fechaAlta,$a_estatusTipo,$a_tipo);
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

		$fk_bitacora = $db->insert_id; //Devuelve el ID

		if ($a_referencia  == "SN") {
      $query = "INSERT INTO bitacora_detalle (fk_bitacora,
    																					prealerta_fechahora,
    																					usuarioRegistro)
    																				 VALUES (?,?,?)";
      $stmt = $db->prepare($query);
     	if (!($stmt)) {
     		$system_callback['code'] = "500";
     		$system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
     		exit_script($system_callback);
     	}

     	 $stmt->bind_param('sss',$fk_bitacora,
     														$a_fechaAlta,
     														$a_usuarioAlta);
		}else {
      $query = "INSERT INTO bitacora_detalle (fk_bitacora,
    																					prealerta_fechahora,
    																					arribo_fechahora,
    																					apertura_fechaHora,
    																					usuarioRegistro)
    																				 VALUES (?,?,?,?,?)";
       $stmt = $db->prepare($query);
       	if (!($stmt)) {
       		$system_callback['code'] = "500";
       		$system_callback['message'] = "Error durante la ejecucion del query [$db->errno]: $db->error";
       		exit_script($system_callback);
       	}

     	 $stmt->bind_param('sssss',$fk_bitacora,
     														$a_fechaAlta,
     														$a_fechaAlta,
     														$a_fechaAlta,
     														$a_usuarioAlta);
    }


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
