<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$file_factura_mayoral = fopen($root . '/pltoolbox/mayoral/resources/helper_files/factura_aeropuerto.csv','r');
// $factura = array();

$facturas = array();
$identificadores = array();

$hoy = date('d/m/Y', strtotime('today'));

while ($row = fgetcsv($file_factura_mayoral,1000)) {
  $item = array();

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
    $row[10],    //NumeroParte
    $row[14],    //Descripcion
    "",          //DescripcionIngles
    $row[18],    //CantUMC
    $row[17],    //UMC
    $row[21],    //PrecioUnitario
    2,0,         //UnidadPesoUnitario - PesoUnitario
    $row[13],   //Fraccion
    $row[20],   //CantUMT
    1,          //FactorAjuste
    $row[16],   //PaisOrigen
    0           //ValorAgregado
  );

  $identificadores[$row[10]] = array();


  $generic = array();

  if ($row[30] != "") {
    $identif1 = explode(",",$row[30]);
    array_unshift($identif1, $row[10]);
    $identificadores[$row[10]][] = $identif1;
  }
  if ($row[31] != "") {
    $identif2 = explode(",",$row[31]);
    array_unshift($identif2, $row[10]);
    $identificadores[$row[10]][] = $identif2;
  }
  if ($row[32] != "") {
    $identif3 = explode(",",$row[32]);
    array_unshift($identif3, $row[10]);
    $identificadores[$row[10]][] = $identif3;
  }
  if ($row[33] != "") {
    $identif4 = explode(",",$row[33]);
    array_unshift($identif4, $row[10]);
    $identificadores[$row[10]][] = $identif4;
  }

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
  $txt_file = rtrim($txt_file, "|");
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

$txt_file .= "@";


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
              <a class="nav-link" id="facturasMayoral-tab" data-toggle="tab" href="#facturasMayoral-pane" role="tab" aria-controls="facturasMayoral" aria-selected="false">Facturas Mayoral</a>
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
            <h4>Facturas Mayoral</h4>
            <hr>
            <?php echo $txt_file ?>
            <!-- <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <!-- <tr>
                    <th>AÑO</th>
                    <th>FACTURA</th>
                    <th>ARTICULO</th>
                    <th>PIEZA</th>
                    <th>RANGO</th>
                    <th>DESCRIPCION </th>
                    <th>DESCRIPCION MX</th>
                    <th>COMPOSICION</th>
                    <th>COMP. FORRO</th>
                    <th>TARIC</th>
                    <th>MX HS CODE</th>
                    <th>SUBDIVI</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO UNITARIO</th>
                    <th>IMPORTE TOTAL</th>
                    <th>MONEDA</th>
                    <th>ORIGEN</th>
                    <th>PESO NETO</th>
                    <th>PESO BRUTO</th>
                    <th>FACERR</th>
                    <th>SECCION </th>
                    <th>MARCA</th>
                    <th>T1</th>
                    <th>T2</th>
                    <th>T3</th>
                    <th>T4</th>
                    <th>T5</th>
                    <th>T6</th>
                    <th>T7</th>
                    <th>T8</th>
                    <th>T9</th>
                    <th>T10</th>
                    <th>TK1</th>
                    <th>TK2</th>
                    <th>TK3</th>
                    <th>TK4</th>
                    <th>TK5</th>
                    <th>TK6</th>
                    <th>TK7</th>
                    <th>TK8</th>
                    <th>TK9</th>
                    <th>TK10</th>
                    <th>C1</th>
                    <th>C2</th>
                    <th>C3</th>
                    <th>C4</th>
                    <th>C5</th>
                    <th>C6</th>
                    <th>C7</th>
                    <th>C8</th>
                    <th>C9</th>
                    <th>C10</th>
                    <th>PUNTO / PLANA</th>
                    <th>SEXO</th>
                    <th>UMC</th>
                    <th>UMT</th>
                  </tr>
                  <tr>
                    <th>ClaveProveedor</th>
                    <th>NumFac</th>
                    <th>FechaFactura</th>
                    <th>ValorComercial</th>3
                    <th>Moneda</th>4
                    <th>Incoterm</th>5
                    <th>SubdV</th>
                    <th>CertOrigin</th>
                    <th>NúmeroItem</th>
                    <th>PartidaPed</th>
                    <th>NúmeroParte</th>10
                    <th>ModeloCOVE</th>
                    <th>SubModeloCOVE</th>
                    <th>Fracción</th>13
                    <th>Descripción</th>14
                    <th>Vendedor</th>
                    <th>Origen</th>16
                    <th>ClaveUMC</th>17
                    <th>CantUMC</th>18
                    <th>ClaveUMT</th>19
                    <th>CantUMT</th>20
                    <th>ValorMercancía</th>21
                    <th>Moneda(2)</th>
                    <th>PreferenciaTL</th>
                    <th>IdentPref</th>
                    <th>MétVal</th>
                    <th>TipoMerc</th>
                    <th>UsoMerc</th>
                    <th>Vinc</th>
                    <th>Ident1</th>
                    <th>Ident2</th>
                    <th>Ident3</th>
                    <th>Ident4</th>
                    <th>Permisos1</th>
                    <th>Permisos2</th>
                    <th>ObservPart</th>
                    <th>MarcaCOVE</th>
                    <th>SerieCOVE</th>
                    <th>SubDiv</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($factura as $item): ?>
                    <tr>
                      <?php foreach ($item as $field): ?>
                        <td><?php echo $field ?></td>
                      <?php endforeach; ?>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </body>
  <?php

  require 'modales/agregarIdentificador.php';
  require 'modales/editarIdentificador.php';
  require $root . '/pltoolbox/scripts.php';
   ?>
   <script src="js/mayoral.js" charset="utf-8"></script>
</html>
