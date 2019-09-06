<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$file_factura_mayoral = fopen('/Users/EduardoSantos/Google Drive/Prolog/Mayoral/V19000337 - 23/Factura_csv.csv','r');
// $factura = array();

$facturas = array();
$identificadores = array();
$hour = date('H');
$minute = date('i');


$precios_estimados = "SELECT * FROM mayoral_precio_estimado";
$precios = array();
$valor_factura = array();
$precios_estimados = $db->prepare($precios_estimados);
if (!($precios_estimados)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during PRECIOS ESTIMADOS query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($precios_estimados->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during PRECIOS ESTIMADOS execution [$precios_estimados->errno]: $precios_estimados->error";
  exit_script($system_callback);
}

$precios_estimados = $precios_estimados->get_result();

if ($precios_estimados->num_rows == 0) {
  $system_callback['results'][$factura]['response'] = 400;
  $system_callback['results'][$factura]['message'] = "No se pudo sacar la información de precios estimados.";
  exit_script($system_callback);
} else {
  while ($row = $precios_estimados->fetch_assoc()) {
    $precios[$row['fraccion']] = array('umt'=>$row['umt'], 'precio_estimado'=>$row['precio_estimado']);
  }
}

$hoy = date('d/m/Y', strtotime('today'));
$comparacion_precios = array();

fgetcsv($file_factura_mayoral);
while ($row = fgetcsv($file_factura_mayoral,1000)) {
  $item = array();
  $comparacion_precios[$row[10]]['Excel'] = $row[21] / $row[18];
  $comparacion_precios[$row[10]]['Tarifa'] = $precios[$row[13]]['precio_estimado'];

  if ($row[1] == ".") {
    continue;
  }

  $valor_factura[$row[1]] += (float)$row[21];

  $facturas[$row[1]]['header'] = array(
    $row[1],  //NumeroFactura
    $row[1],  //NumeroFactura - pero es numero pedido
    $hoy,     //FechaFactura --- hoy es default.
    'ESP',    //PaisFacturacion
    'MA',    //EntidadFacturacion // TODO: Agregar entidad de facturacion
    $row[4],  //Moneda
    $row[5],  //Incoterm
    $row[3],  //ValorMonedaExtranjera
    $row[3],  //Valorcomercial
    0,0,0,0,0,//Flete, Seguros, Embalajes, Incrementables, Deducibles
    1,         //FactorMonedaExtranjera
  );

  $facturas[$row[1]]['items'][] = array(
    $row[10].$hour.$minute,    //NumeroParte
    $row[14],    //Descripcion
    "",          //DescripcionIngles
    $row[18],    //CantUMC
    $row[17],    //UMC
    (float)$row[21]/$row[18],    //PrecioUnitario
    2,0,         //UnidadPesoUnitario - PesoUnitario
    $row[13],   //Fraccion
    $row[20],   //CantUMT
    (float)$row[20]/(float)$row[18],          //FactorAjuste
    $row[16],   //PaisOrigen
    0,           //ValorAgregado
    $row[36], //Marca
    $row[11], //Modelo
    "" //Serie, se manda en blanco.
  );

  // $identificadores[$row[10]] = array();

  if ($row[29] != "") {
    $identif1 = explode(",",$row[29]);
    array_unshift($identif1, $row[10].$hour.$minute);
    $identificadores[$row[10].$hour.$minute][] = $identif1;
  }
  if ($row[30] != "") {
    $identif2 = explode(",",$row[30]);
    array_unshift($identif2, $row[10].$hour.$minute);
    $identificadores[$row[10].$hour.$minute][] = $identif2;
  }
  if ($row[31] != "") {
    $identif3 = explode(",",$row[31]);
    array_unshift($identif3, $row[10].$hour.$minute);
    $identificadores[$row[10].$hour.$minute][] = $identif3;
  }
  if ($row[32] != "") {
    $identif4 = explode(",",$row[32]);
    array_unshift($identif4, $row[10].$hour.$minute);
    $identificadores[$row[10].$hour.$minute][] = $identif4;
  }

  if ($precios[$row[13]]['precio_estimado'] != "") {
    $compare = $precios[$row[13]]['precio_estimado'] < [$row[21] / $row[18]];
    $capitulo = substr($row[13], 0, 2);

    if ($capitulo <= 63 && $capitulo >= 50) {
      $comple_ex = 31;
    } elseif ($capitulo = 64) {
      $comple_ex = 29;
    }

    if ($compare) {
      $identificadores[$row[10].$hour.$minute][] = array($row[10].$hour.$minute, 'EX', $comple_ex);
    }
  }

  if ($row[23] == "TL") {
    $identificadores[$row[10].$hour.$minute][] = array($row[10].$hour.$minute, 'TL', $row['24']);
  }

}

foreach ($facturas as $id => $factura) {
  $facturas[$id]['header'][7] = $valor_factura[$id];
  $facturas[$id]['header'][8] = $valor_factura[$id];
}

$txt_file = "";


foreach ($facturas as $factura) {
  foreach ($factura['header'] as $valor_header) {
    $txt_file .= $valor_header . "|";
  }
  foreach ($factura['items'] as $item) {
    foreach ($item as $valor_item) {
      $txt_file .= $valor_item . "|";
    }
  }
  // $txt_file = rtrim($txt_file, "|");
  $txt_file = substr($txt_file, 0, -1);
  $txt_file .= "^";
}

$txt_file = rtrim($txt_file, "^");
$txt_file .= "~";

foreach ($identificadores as $identificadores_parte) {
  foreach ($identificadores_parte as $identificador) {
    for ($i=0; $i < 7; $i++) {
      $txt_file .= $identificador[$i] . "|";
    }
  }
}

$txt_file .= "@||||||";

$txt_file = str_replace("ñ","n",$txt_file);
$txt_file = str_replace("Ñ","N",$txt_file);


$json_print = json_encode(array($facturas, $identificadores));



 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" class="h-100">
  <head>
    <meta charset="utf-8">
    <?php
    require $root . '/pltoolbox/stylesheets.php';
    ?>
    <title>Herramientas Mayoral</title>
  </head>
  <body class="h-100">
    <div class="d-flex w-100 h-100">
      <aside class="border-right h-100 d-fixed side-menu" style="width: 15%; min-width: 15%">
        <div class="container-fluid">
          <img src="https://media.mayoral.com/wcsstore/mayoral/images/creatives/Mayoral_Logo_2018.svg" alt="Logo Mayoral" style="max-width: 100%">
        </div>
        <div class="mt-5">
          <ul class="nav flex-column" id="sideMenu-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="inicio-tab" data-toggle="tab" href="#inicio-pane" role="tab" aria-controls="inicio" aria-selected="false">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="identificadores-tab" data-toggle="tab" href="#identificadores-pane" role="tab" aria-controls="identificadores" aria-selected="false">Identificadores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tratoPreferencial-tab" data-toggle="tab" href="#tratoPreferencial-pane" role="tab" aria-controls="tratoPreferencial" aria-selected="false">Trato Preferencial</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="preciosEstimados-tab" data-toggle="tab" href="#preciosEstimados-pane" role="tab" aria-controls="preciosEstimados" aria-selected="false">Precios Estimados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="facturasMayoralcsv-tab" data-toggle="tab" href="#facturasMayoralcsv-pane" role="tab" aria-controls="facturasMayoral" aria-selected="false">Facturas Mayoral</a>
            </li>
          </ul>
        </div>
      </aside>
      <div class="flex-grow-1 container-fluid" style="overflow-y: scroll">
        <div class="tab-content" id="sideMenu-tabContent">
          <div class="tab-pane fade show active mt-5 px-5" id="inicio-pane" role="tabpanel" aria-labelledby="inicio-tab">
            <h4>Bienvenido al portal de procesamiento de facturas de Mayoral!</h4>
            <hr>
            <p>En este portal podrás subir la factura de Mayoral, para que se validen:
              <ul class="">
                <li>Errores de Unidad de Medida (Tarifa)</li>
                <li>Precios Estimados</li>
                <li>Identificadores Requeridos</li>
              </ul>
            </p>
            <h5>¿Como Utilizar el portal?</h5>
            <p>
              <ol>
                <li>En 'Identificadores', se registran todos los identificadores que se necesitan para las operaciones de Mayoral, y se indica a que Fracciones, Capítulos o Partidas se le aplican, o bien si existen fracciones con excepciones.</li>
                <li>En 'Trato Preferencial' se registran los países con los que se tiene trato preferencial, para asegurar que se incluya el identificador TL correspondiente.</li>
                <li>En 'Precios Estimados' carga los precios estimados actualizados, esta información es importante para poder calcular si existen productos por debajo del precio estimado.</li>
                <li>Ya que todas las configuraciones estan actualizadas, en 'Facturas Mayoral' podrás cargar la(s) factura(s) de Mayoral, en formato CSV para poder procesar los indicadores necesarios, revisar los precios estimados, y crear la plantilla para cargar la información al Sistema de Tráfico</li>
              </ol>
            </p>
          </div>
          <div class="tab-pane fade mt-5 px-5 text-center" id="identificadores-pane" role="tabpanel" aria-labelledby="identificadores-tab">
            <div class="" id="lista-identificadores">
              <button type="button" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#agregarIdentificador-modal" name="button">Agregar Identificador</button>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Identificador</th>
                    <th>Complemento 1</th>
                    <th>Complemento 2</th>
                    <th>Complemento 3</th>
                    <th>Complemento 4</th>
                    <!-- <th>Fracciones / Cap Aplicables</th>
                    <th>Excepciones</th> -->
                  </tr>
                </thead>
                <tbody id="tabla-identificadores">
                </tbody>
              </table>
            </div>
            <div class="detalle-identificador">

            </div>
          </div>
          <div class="tab-pane fade mt-5 px-5" id="tratoPreferencial-pane" role="tabpanel" aria-labelledby="tratoPreferencial-tab" >
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Pais</th>
                    <th>3 Siglas</th>
                  </tr>
                </thead>
                <tbody id="trato-preferencial-tbl">
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade mt-5 px-5" id="preciosEstimados-pane" role="tabpanel" aria-labelledby="preciosEstimados-tab">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Fraccion</th>
                  <th>UMT</th>
                  <th>Precio Estimado</th>
                  <th>Descripción</th>
                </tr>
              </thead>
              <tbody id="precios-estimados-tbl">
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade mt-5 px-5" id="facturasMayoral-pane" role="tabpanel" aria-labelledby="facturasMayoral-tab">
            <div class="">
              <button type="button" class="btn btn-small btn-outline-primary float-right" id="marcasModelos_btn" name="button">Archivo Marcas y Modelos</button>
              <div class="float-right">
                <button type="button" class="btn btn-small btn-outline-primary" data-toggle="modal" data-target="#subirFactura-modal" name="button">Agregar Factura</button>
                <button type="button" class="btn btn-small btn-outline-info" id="procesarFacturas_btn" name="button">Procesar Facturas</button>
              </div>
              <h4>Facturas Mayoral</h4>
            </div>
            <hr>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th></th>
                  <th>Factura</th>
                  <th>Año</th>
                  <th>Fecha Carga</th>
                  <th>Items</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="facturasMayoral_tbl">

              </tbody>
            </table>


            <?php echo $txt_file ?>
            <div class="" id="insert-here-off">

            </div>
          </div>
          <div class="tab-pane fade mt-5 px-5" id="facturasMayoralcsv-pane" role="tabpanel" aria-labelledby="facturasMayoralcsv-tab">
            <div class="">
              <h4>Factuas CSV</h4>
            </div>
            <hr>
            <div class="">
              <b>Instrucciones:</b>
              <p>
                <ol>
                  <li>Convierte la factura de mayoral a CSV.</li>
                  <li>Selecciona el archivo CSV abajo, y haz click en procesar para generar el TXT que se subirá a Global.</li>
                  <li>Si hay algún error, se describirán abajo y tendrás que corregirlos en el CSV</li>
                  <li>Si no hay ningún error, se generará un archivo TXT y un archivo CSV. El CSV es solamente informativo para que puedas conocer el contenido del TXT de una manera amigable. El Archivo TXT es el que importa que hay que subir a global.</li>
                  <li>Descarga el TXT y subelo a Global, usando el Layout 19.</li>
                </ol>
                <form class="form-inline justify-content-around">
                  <div class="custom-file w-75">
                    <input type="file" class="custom-file-input" id="input_factura_csv">
                    <label class="custom-file-label" for="customFile">Selecciona la factura en CSV</label>
                  </div>
                  <button type="button" class="btn btn-primary" name="button" id="generar_txt">Generar TXT</button>
                </form>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <?php

  require 'modales/agregarIdentificador.php';
  require 'modales/editarIdentificador.php';
  require 'modales/nuevaFactura.php';
  require $root . '/pltoolbox/scripts.php';
   ?>
   <script src="js/mayoral.js" charset="utf-8"></script>
</html>
