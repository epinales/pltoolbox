<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';
require $root . '/pltoolbox/stylesheets.php';
require $root . '/pltoolbox/links.php';

$system_callback = [];
$data = $_POST;

$pk_bitacora = $_GET['evento'];

$query = "SELECT * FROM bitacora
INNER JOIN bitacora_detalle ON pk_bitacora = fk_bitacora
INNER JOIN bitacora_indice ON estatusIndice = pk_indice
WHERE pk_bitacora = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s', $pk_bitacora);
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
  $rslt = $stmt->get_result();
  $row = $rslt->fetch_assoc();

  $iconoTerminado = "";
  $estatusIndice = $row['estatusIndice'];
  if ($estatusIndice == "10") {
    $iconoTerminado = "<img src='/pltoolbox/Resources/iconos/folder.svg' class='w-32'>";
  }else {
    $iconoTerminado = "";
  }



  $queryDepoPago = "SELECT
  SUM(dp_montoDepo) AS deposito,
  SUM(dp_montoPago) AS pago
  FROM bitacora_transaccion WHERE fk_bitacora_dp = ?";

  $stmtDepoPago = $db->prepare($queryDepoPago);
  $stmtDepoPago->bind_param('s', $pk_bitacora);
  if (!($stmtDepoPago->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmtDepoPago->errno]: $stmtDepoPago->error";
    exit_script($system_callback);
  }
    $rsltDepoPago = $stmtDepoPago->get_result();
    $rowdp = $rsltDepoPago->fetch_assoc();

    $deposito = $rowdp['deposito'];
    $pago = $rowdp['pago'];
    $disponible = $deposito - $pago;
 ?>
 <link rel="stylesheet" href="/pltoolbox/Resources/css/bitacoraProlog.css">

  <body class="h-100" style="font-family: 'Source Sans Pro';">
    <div class="d-flex w-100 h-100">
      <aside class="border-right h-100 d-fixed side-menu">
        <div class="">
          <ul class="nav flex-column" id="sideMenu" role="tablist">
            <li class="p-0 btn text bblack f19">
              <a id="back" href="/pltoolbox/BitacoraProlog/trafico/index.php">
                <span class="title">REGRESAR</span>
              </a>
            </li>
            <li class="p-0 btn text bblack f19">
              <a class="active" id="inicial" data-toggle="tab" href="#panelinicio" role="tab" aria-controls="inicio" aria-selected="false">
                <span class="title">ESTATUS</span>
              </a>
            </li>
            <li class="p-0 btn text bblack f19">
              <a id="ident" data-toggle="tab" href="#panelidentificadores" role="tab" aria-controls="identificadores" aria-selected="false">
                <span class="title">ADMINISTRACIÓN</span>
              </a>
            </li>
          </ul>
        </div>
      </aside>
      <div class="flex-grow-1 container-fluid">
        <div class="tab-content" id="sideMenu-tabContent">
          <div class="tab-pane fade show active mt-5 px-5" id="panelinicio" role="tabpanel" aria-labelledby="inicial">
            <div class="row">
              <div class="col-md-10">
                <h4>
                  <?php echo $row['referencia'] ?> -- <?php echo $row['nombreCliente'] ?>
                </h4>
              </div>
              <div class="col-md-2 text-center">
                <a href="#comentarios" data-toggle="modal" class="comentario"><img src='/pltoolbox/Resources/iconos/comentario.svg' class='w-32'></a>
                <a href="#" class="folder-factura ml-4" role="button" data-toggle="popover" title="Facturación" data-content="Pasar expediente a facturación"><?php echo $iconoTerminado ?></a>
              </div>
            </div>

            <hr class="bbyellow">
            <table class="table text-center">
              <tbody>
                <tr class="row">
                  <td class="col-md-12">
                    <input id="dp_deposito" type="hidden" value="<?php echo $rowdp['deposito'] ?>">
                    <input id="dp_pago" type="hidden" value="<?php echo $rowdp['pago'] ?>">
                    <input id="pk_indice" type="text" value="<?php echo $row['pk_indice'] ?>">
                    <input id="indice" type="text" value="<?php echo $row['indice'] ?>">
                    <input id="pk_bitacora" type="hidden"  value="<?php echo $pk_bitacora ?>">
                    <input id="referencia" type="hidden" value="<?php echo $row['referencia'] ?>">
                    <input id="nombreCliente" type="hidden" value="<?php echo $row['nombreCliente'] ?>">
                    <input id='user-modif' type="hidden" value="<?php echo $usuarioAlta ?>" >
                    <input id='fecha-modif' type="hidden" value="<?php echo $fechaAlta ?>" >
                    <input class="fecha" type="hidden" value="<?php echo $fechaActual ?>">
                    <input class="hora" type="hidden" value="<?php echo $horaActual ?>">
                  </td>
                </tr>


                <tr class="row">
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">1. Pre-alerta</label>
                  </td>
                  <td class="col-md-2">
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">6. Solicitud de anticipo / Proforma</label>
                  </td>
                </tr>
                <tr class="row">
                  <td class="col-md-3">
                    <input id="prealerta_fecha" class="efecto-1" type="date" indice="1" value='<?php echo $row['prealerta_fecha'] ?>'>
                  </td>
                  <td class="col-md-2">
                    <input id="prealerta_hora" class="efecto-1" type="time" value='<?php echo $row['prealerta_hora'] ?>'>
                  </td>
                  <td class="col-md-2">
                  </td>
                  <td class="col-md-3">
                    <input id="solant_fecha" class="efecto-1" type="date" indice="6" value='<?php echo $row['solant_fecha'] ?>'>
                  </td>
                  <td class="col-md-2">
                    <input id="solant_hora" class="efecto-1" type="time" value='<?php echo $row['solant_hora'] ?>'>
                  </td>
                </tr>


                <tr class="row">
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">2. Arribo / ETA</label>
                  </td>
                  <td class="col-md-2">
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">7. Depósito</label>
                  </td>
                </tr>
                <tr class="row">
                  <td class="col-md-3">
                    <input id="arribo_fecha" class="efecto-1" type="date" indice="2" value="<?php echo $row['arribo_fecha'] ?>">
                  </td>
                  <td class="col-md-2">
                    <input id="arribo_hora" class="efecto-1" type="time" value='<?php echo $row['arribo_hora'] ?>'>
                  </td>
                  <td class="col-md-2">
                  <td class="col-md-3">
                    <input id="deposito_fecha" class="efecto-1" type="date" indice="7" value="<?php echo $row['deposito_fecha'] ?>">
                  </td>
                  <td class="col-md-2">
                    <input id="deposito_hora" class="efecto-1" type="time" value="<?php echo $row['deposito_hora'] ?>">
                  </td>
                </tr>


                <tr class="row">
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">3. Apertura</label>
                  </td>
                  <td class="col-md-2"></td>
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">8. Pago</label>
                  </td>
                </tr>
                <tr class="row">
                  <td class="col-md-3">
                    <input id="apertura_fecha" class="efecto-1" type="date" indice="3" value="<?php echo $row['apertura_fecha'] ?>">
                  </td>
                  <td class="col-md-2">
                    <input id="apertura_hora" class="efecto-1" type="time" value="<?php echo $row['apertura_hora'] ?>">
                  </td>
                  <td class="col-md-2"></td>
                  <td class="col-md-3">
                    <input id="pago_fecha" class="efecto-1" type="date" indice="8" value="<?php echo $row['pago_fecha'] ?>">
                  </td>
                  <td class="col-md-2">
                    <input id="pago_hora" class="efecto-1" type="time" value="<?php echo $row['pago_hora'] ?>">
                  </td>
                </tr>


                <tr class="row">
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">4. Captura de factura / Previo</label>
                  </td>
                  <td class="col-md-2"></td>
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">9. Programación</label>
                  </td>
                </tr>
                <tr class="row">
                  <td class="col-md-3">
                    <input id="capfact_fecha" class="efecto-1" type="date" indice="4" value="<?php echo $row['capfact_fecha'] ?>">
                  </td>
                  <td class="col-md-2">
                    <input id="capfact_hora" class="efecto-1" type="time" value="<?php echo $row['capfact_hora'] ?>">
                  </td>
                  <td class="col-md-2">
                  </td>
                  <td class="col-md-3">
                    <input id="program_fecha" class="efecto-1" type="date" indice="9" value="<?php echo $row['program_fecha'] ?>">
                  </td>
                  <td class="col-md-2">
                    <input id="program_hora" class="efecto-1" type="time" value="<?php echo $row['program_hora'] ?>">
                  </td>
                </tr>


                <tr class="row">
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">5. Clasificación</label>
                  </td>
                  <td class="col-md-2"></td>
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">10. Entrega / Despacho</label>
                  </td>
                </tr>
                <tr class="row">
                  <td class="col-md-3">
                    <input id="clasif_fecha" class="efecto-1" type="date" indice="5" value="<?php echo $row['clasif_fecha'] ?>">
                  </td>
                  <td class="col-md-2">
                    <input id="clasif_hora" class="efecto-1" type="time" value="<?php echo $row['clasif_hora'] ?>">
                  </td>
                  <td class="col-md-2"></td>
                  <td class="col-md-3">
                    <input id="entrega_fecha" class="efecto-1" type="date" indice="10" value="<?php echo $row['entrega_fecha'] ?>">
                  </td>
                  <td class="col-md-2">
                    <input id="entrega_hora" class="efecto-1" type="time" value="<?php echo $row['entrega_hora'] ?>">
                  </td>
                </tr>
                <tr class="row mt-5 bbyellow btyellow">
                  <td class="col-md-12">
                    DISPONIBLE :<input type="text" id="dp_disponible" class="bt border-0 text-center" value="<?php echo $disponible ?>" readonly>
                  </td>
                </tr>
              </tbody>
            </table>
            <div id='a_trafico' class="text-center border-0 mb-4 m-0 mt-5">
              <div class="row justify-content-center">
                <div class="col-md-3">
                  <input class="back-aceptar actualizar_trafico" type="submit" value="ACTUALIZAR">
                </div>
              </div>
            </div>
          </div>



          <div class="tab-pane fade mt-5 px-5 text-center" id="panelidentificadores" role="tabpanel" aria-labelledby="ident">
            <div class="" id="lista-identificadores">

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active gris" id="tab-deposito" data-toggle="tab" href="#deposito" role="tab" aria-controls="deposito" aria-selected="true">Deposito</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link gris" id="tab-pagos" data-toggle="tab" href="#pagos" role="tab" aria-controls="pagos" aria-selected="false">Pagos y Honorarios</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <button type="button" class="btn btn-outline-dark float-right mb-4 mt-3" data-toggle="modal" data-target='#depositoPago'>Agregar</button>


                <div class="tab-pane fade show active" id="deposito" role="tabpanel" aria-labelledby="tab-deposito">
                  <table class="table table-hover fixed-table mb-5">
                    <tbody id="listaDepositos" style="font-family: 'Source Sans Pro';"></tbody>
                  </table>
                </div>



                <div class="tab-pane fade" id="pagos" role="tabpanel" aria-labelledby="tab-pagos">
                  <table class="table table-hover fixed-table mb-5">
                    <tbody id="listaPagos" style="font-family: 'Source Sans Pro';"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

  <script src="/pltoolbox/BitacoraProlog/trafico/js/trafico.js"></script>
  <script src="/pltoolbox/BitacoraProlog/js/comentarios.js"></script>
  <script src="/pltoolbox/Resources/js/table-fetch-plugin.js"></script>
  <script src="/pltoolbox/Resources/js/popup-list-plugin.js"></script>
  <script src="/pltoolbox/Resources/js/table-fetch-plugin.js"></script>

</html>

<?php
require $root . '/pltoolbox/BitacoraProlog/trafico/modales/modal.php';
require $root . '/pltoolbox/BitacoraProlog/Comentarios/modales/comentarios.php';
?>
