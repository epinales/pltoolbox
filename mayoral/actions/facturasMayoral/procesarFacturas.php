<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';
$invoice_data = array();
$processed_invoice = array();
$hoy = date('d/m/Y', strtotime('today'));
$invoice_raw = array();

$paises = array(
"BD"=>"BGD",
"EG"=>"EGY",
"ES"=>"ESP",
"IN"=>"IND",
"KH"=>"KHM",
"MA"=>"MAR",
"PK"=>"PAK",
"PL"=>"POL",
"PT"=>"PRT",
"TR"=>"TUR",
"VN"=>"VNM",
"TH"=>"THA",
"CN"=>"CHN",
"PT"=>"PRT",
"TW"=>"TWN",
"IT"=>"ITA",
"MM"=>"MMR"
);

extract($_POST);

/*************************************************

ESTE ARCHIVO PROCESA LAS FACTURAS DESDE LA BASE DE DATOS, PRODUCIENDO UN LAYOUT PARA PODER SUBIRA GLOBAL PCNET.

*************************************************/


$header_factura = "SELECT * FROM mayoral_factura WHERE pk_factura_mayoral = ?";
$detalle_factura = "SELECT * FROM mayoral_factura_detalle WHERE fk_factura_mayoral = ?";



$header_factura = $db->prepare($header_factura);
$detalle_factura = $db->prepare($detalle_factura);

foreach ($facturas as $factura) {

  $header_factura->bind_param('s', $factura);
  if (!($header_factura)) {
    $system_callback['results'][$factura]['main']['response'] = 500;
    $system_callback['results'][$factura]['main']['message'] = "[$header_factura->errno]: $header_factura->error";
  }
  if (!($header_factura->execute())) {
    $system_callback['results'][$factura]['detalles']['main']['response'] = 500;
    $system_callback['results'][$factura]['detalles']['main']['message'] = "[$header_factura->errno]: $header_factura->error";
  }

  $header = $header_factura->get_result();

  if ($header->num_rows == 0) {
    $system_callback['results'][$factura]['detalles']['main']['response'] = 500;
    $system_callback['results'][$factura]['detalles']['main']['message'] = "No se encontró el encabezado de esta factura.";
  }

  $row = $header->fetch_assoc();

  $invoice_raw[$factura]['header'] = array(
    $row['pk_factura_mayoral'],
    $row['numero_orden'],
    $hoy,
    "ESP", // <------- Este dato es fijo siempre.
    "MA", // <------- Este dato es fijo siempre.
    $row['moneda'],
    "CIF", // <------- Este dato es fijo siempre.
    $row['valor_moneda_extranjera'],
    $row['valor_comercial'],
    0,0,0,0,0,1
  );

  $detalle_factura->bind_param('s', $factura);
  if (!($detalle_factura)) {
    $system_callback['results'][$factura]['main']['response'] = 500;
    $system_callback['results'][$factura]['main']['message'] = "[$detalle_factura->errno]: $detalle_factura->error";
  }
  if (!($detalle_factura->execute())) {
    $system_callback['results'][$factura]['detalles']['main']['response'] = 500;
    $system_callback['results'][$factura]['detalles']['main']['message'] = "[$detalle_factura->errno]: $detalle_factura->error";
  }

  $detalles = $detalle_factura->get_result();

  if ($detalles->num_rows == 0) {
    $system_callback['results'][$factura]['detalles']['main']['response'] = 500;
    $system_callback['results'][$factura]['detalles']['main']['message'] = "No se encontraron registros de esta factura.";
  }

  while ($row = $detalles->fetch_assoc()) {
    $invoice_raw[$factura]['items'][$row['partida_factura']] = array(
      $row['fk_factura_mayoral'].$row['articulo'].$row['pieza'].$row['mx_hs_code'], //Numero de parte interno esta compuesto por número de factura + articulo + pieza + fraccion.
      $row['descripcion_mx'],
      "", //No se necesita la descripción en inglés de la mercancía.
      $row['cantidad'],
      $row['umc'],
      $row['precio_unitario'],
      2, // Unidad peso unitario siempre se declarará en 2 (Kilos.)
      0, // Peso unitario siempre se declara en 0.
      $row['mx_hs_code'], //Fraccion
      $row['cantidad'], // TODO: Arreglar cantidad UMT. --- NO ESTOY SEGURO DE DONDE SALE.
      1,   // QUESTION: DECLARAR SIEMPRE EL FACTOR DE AJUST EN 1?
      $paises[$row['origen']],
      "" // El valor agregado siempre se dejará en blanco.
    );
  }

}


foreach ($invoice_raw as $invoice_number => $invoice) {
  $tbody = "";
  foreach ($invoice['items'] as $item => $value) {
    $tbody .= "
        <tr>
          <td>$value[0]</td>
          <td>$value[1]</td>
          <td>$value[3]</td>
          <td>$value[4]</td>
          <td>$value[5]</td>
          <td>$value[8]</td>
          <td>$value[9]</td>
        </tr>
    ";
  }
  $system_callback['data'] .= "
  <div>
    <b>Factura: </b><span>{$invoice['header'][0]}</span><br>
    <b>Orden: </b><span>{$invoice['header'][1]}</span><br>
    <b>Fecha Factura: </b><span>{$invoice['header'][2]}</span><br>
    <b>Pais Factura: </b><span>{$invoice['header'][3]}</span><br>
    <b>Entidad Factura: </b><span>{$invoice['header'][4]}</span><br>
    <b>Moneda: </b><span>{$invoice['header'][5]}</span><br>
    <b>Incoterm: </b><span>{$invoice['header'][6]}</span><br>
  </div>
  <table class='table table-striped table-sm'>
    <thead>
      <tr>
        <th>Parte</th>
        <th>Descripcion</th>
        <th>Cantidad UMC</th>
        <th>UMC</th>
        <th>Precio Unitario</th>
        <th>Fraccion</th>
        <th>Cantidad UMT</th>
      </tr>
    </thead>
    <tbody>
      $tbody
    </tbody>
  </table>
  ";
}

$system_callback['invoice'] = $invoice_raw;

exit_script($system_callback);



 ?>
