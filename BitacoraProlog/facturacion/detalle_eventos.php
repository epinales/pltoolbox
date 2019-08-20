<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';
require $root . '/pltoolbox/stylesheets.php';
require $root . '/pltoolbox/links.php';

$system_callback = [];
$data = $_POST;

$pk_bitacora = $_GET['evento'];

$query = "SELECT * FROM bitacora
INNER JOIN bitacora_indice ON estatusIndice = pk_indice
INNER JOIN bitacora_detalle_facturacion ON pk_bitacora = fk_bitacora
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

  $concluir = "";
  $indiceFact = $row['estatusIndice'];
  if ($indiceFact == "12") {
    $concluir = "<button id='' type='button' class='concluirCuenta add-boton btn-outline-dark mr-3'>Concluir</button>";
  }else {
    $concluir = "";
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
          <ul class="nav flex-column" id="sideMenuFact" role="tablist">
            <li class="p-0 btn text bblack f19">
              <a id="backFact" href="/pltoolbox/BitacoraProlog/facturacion/index.php">
                <span class="title"> << REGRESAR</span>
              </a>
            </li>
            <li class="p-0 btn text bblack f19">
              <a class="active" id="inicialFact" data-toggle="tab" href="#panelinicio" role="tab" aria-controls="inicio" aria-selected="false">
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
        <div class="tab-content" id="sideMenuFact-tabContent">
          <div class="tab-pane fade show active mt-5 px-5" id="panelinicio" role="tabpanel" aria-labelledby="inicialFact">
            <div class="row">
              <div class="col-md-10">
                <h4>
                  <?php echo $row['referencia'] ?> -- <?php echo $row['nombreCliente'] ?> (Cta .<?php echo $row['numCuenta'] ?>)
                </h4>
              </div>
              <div class="col-md-2 text-center">
                <a href="#comentarios" data-toggle="modal" class="comentario mr-4"><img src='/pltoolbox/Resources/iconos/comentario.svg' class='w-32'></a>

                <?php echo $concluir ?>
              </div>
            </div>

            <hr class="bbyellow">
            <table class="table text-center">
              <tbody>
                <tr class="row">
                  <td class="col-md-12">
                    <input id="dp_deposito" type="hidden" value="<?php echo $rowdp['deposito'] ?>">
                    <input id="dp_pago" type="hidden" value="<?php echo $rowdp['pago'] ?>">
                    <input id="pk_indice" type="hidden" value="<?php echo $row['pk_indice'] ?>">
                    <input id="indice" type="hidden" value="<?php echo $row['indice'] ?>">
                    <input id="pk_bitacora" type="hidden"  value="<?php echo $pk_bitacora ?>">
                    <input id="recibidoFact" type="hidden" value="<?php echo $row['recibidoFact'] ?>">
                    <input id="vencimientoFact" type="hidden" value="<?php echo $row['vencimientoFact'] ?>">
                    <input class="fecha" type="hidden" value="<?php echo $fechaActual ?>">
                    <input class="hora" type="hidden" value="<?php echo $horaActual ?>">
                    <input id="referencia" type="hidden" value="<?php echo $row['referencia'] ?>">
                  </td>
                </tr>

                <tr class="row align-items-center">
                  <td class="col-md-3 submodal py-0">
                    <label class="m-0 b activo">Numero de Cuenta</label>
                  </td>
                  <td class="col-md-2 submodal py-0">
                    <label class="m-0 b activo">Track  ID</label>
                  </td>
                  <td class="col-md-2 py-0">

                  </td>
                  <td class="col-md-3 submodal py-0">
                    <label class="m-0 b activo">Saldo</label>
                  </td>
                  <td class="col-md-2 submodal py-0">
                    <label class="m-0 b activo">Tipo</label>
                  </td>
                </tr>

                <tr class="row">
                  <td class="col-md-3">
                    <input id="numCuenta" class="efecto-1" type="text" value='<?php echo $row['numCuenta'] ?>' placeholder="Numero de Cuenta">
                  </td>
                  <td class="col-md-2">
                    <input id="trackId" class="efecto-1" type="text" value='<?php echo $row['trackId'] ?>' placeholder="Track Id">
                  </td>
                  <td class="col-md-2"></td>

                  <td class="col-md-3">
                    <input id="saldo" class="efecto-1" type="text" value='<?php echo $row['saldo'] ?>' placeholder="Saldo">
                  </td>
                  <td class="col-md-2">
                    <input id="tipoSaldo" list="saldoEstatus" class="efecto-1" value='<?php echo $row['tipoSaldo'] ?>' placeholder="Tipo de Saldo">
                    <datalist id="saldoEstatus">
                      <option value="A favor">A favor</option>
                      <option value="En contra">En contra</option>
                    </datalist>
                  </td>
                </tr>


                <tr class="row mt-5">
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">Cuenta de Gastos</label>
                  </td>
                  <td class="col-md-2"></td>
                  <td class="col-md-5 p-0 submodal">
                    <label class="m-0 b activo">Cobranza / Devolucion</label>
                  </td>
                </tr>

                <tr class="row">
                  <td class="col-md-3">
                    <input id="ctaGastos_fecha" class="efecto-1" type="date" indice="11" value='<?php echo $row['ctaGastos_fecha'] ?>'>
                  </td>
                  <td class="col-md-2">
                    <input id="ctaGastos_hora" class="efecto-1" type="time" value='<?php echo $row['ctaGastos_hora'] ?>'>
                  </td>
                  <td class="col-md-2"></td>
                  <td class="col-md-3">
                    <input id="cobDev_fecha" class="efecto-1" type="date" indice="12" value='<?php echo $row['cobDev_fecha'] ?>'>
                  </td>
                  <td class="col-md-2">
                    <input id="cobDev_hora" class="efecto-1" type="time" value='<?php echo $row['cobDev_hora'] ?>'>
                  </td>
                </tr>

                <tr class="row mt-5 justify-content-center">
                  <td class="col-md-9 p-0 submodal">
                    <label class="m-0 b activo">Vencimiento</label>
                  </td>
                </tr>

                <tr class="row justify-content-center align-items-center">
                  <td class="col-md-3">
                    <input id="vencimientoFact" class="efecto-1" type="date" value='<?php echo $row['vencimientoFact'] ?>' readonly>
                  </td>
                  <td class="col-md-1 text-left pl-0">
                    <a href="#financiamiento" data-toggle="modal"><img src='/pltoolbox/Resources/iconos/calendar.svg' class='w-32'> </a>


                  </td>

                  <td class="col-md-1 px-0">Honorarios :</td>
                  <td class="col-md-2 pl-1">
                    <input id="honorarios" class="efecto-1" type="text" value='<?php echo $row['honorarios'] ?>' placeholder="Honorarios">
                  </td>
                </tr>


                <tr class="row mt-5 bbyellow btyellow">
                  <td class="col-md-12">
                    DISPONIBLE :<input type="text" id="dpFact_disponible" class="bt border-0 text-center" value="<?php echo $disponible ?>" readonly>
                  </td>
                </tr>
              </tbody>
            </table>
            <div id='a_ctaGastos' class="text-center border-0 mb-4 m-0 mt-5">
              <div class="row justify-content-center">
                <div class="col-md-3">
                  <input class="back-aceptar actualizar_factura" type="submit" value="ACTUALIZAR">
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
                    <tbody id="listaDepositosFact" style="font-family: 'Source Sans Pro';"></tbody>
                  </table>
                </div>



                <div class="tab-pane fade" id="pagos" role="tabpanel" aria-labelledby="tab-pagos">
                  <table class="table table-hover fixed-table mb-5">
                    <tbody id="listaPagosFact" style="font-family: 'Source Sans Pro';"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

  <script src="/pltoolbox/BitacoraProlog/facturacion/js/facturacion.js"></script>
  <script src="/pltoolbox/BitacoraProlog/trafico/js/trafico.js"></script>
  <script src="/pltoolbox/BitacoraProlog/js/comentarios.js"></script>
  <script src="/pltoolbox/Resources/js/table-fetch-plugin.js"></script>
  <script src="/pltoolbox/Resources/js/popup-list-plugin.js"></script>
  <script src="/pltoolbox/Resources/js/table-fetch-plugin.js"></script>

</html>

<?php
require $root . '/pltoolbox/BitacoraProlog/facturacion/modales/modal.php';
require $root . '/pltoolbox/BitacoraProlog/trafico/modales/modal.php';
require $root . '/pltoolbox/BitacoraProlog/Comentarios/modales/comentarios.php';
?>
