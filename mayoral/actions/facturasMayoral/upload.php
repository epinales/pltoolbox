<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';


/*************************************************

ESTE ARCHIVO SUBE LA FACTURA DE MAYORAL A LA BASE DE DATOS

DURANTE EL PROCESO DE CARGA VALIDA LOS PRECIOS ESTIMADOS Y LAS UMT

*************************************************/


//Sacar los precios estimados y UMT de la base de datos.


$precios_estimados = "SELECT * FROM mayoral_precio_estimado";
$precios = array();
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

$system_callback = [];
$file = $_FILES;

$authorized_files = ['csv'];
$extension = pathinfo($file['file']['name'],PATHINFO_EXTENSION);
$test_extension = in_array($extension, $authorized_files);


$documented_headers = ["﻿AÑO","FACTURA","ARTICULO","PIEZA","RANGO","DESCRIPCION ","DESCRIPCION MX","COMPOSICION","COMP. FORRO","TARIC","MX HS CODE","SUBDIVI","CANTIDAD","PRECIO UN.","IMPORTE TOT,","MONEDA","ORIGEN","PESO NETO","PESO BRUTO","FACERR","SECCION ","MARCA","T1","T2","T3","T4","T5","T6","T7","T8","T9","T10","TK1","TK2","TK3","TK4","TK5","TK6","TK7","TK8","TK9","TK10","C1","C2","C3","C4","C5","C6","C7","C8","C9","C10","PUNTO / PLANA","SEXO","UMC","UMT"
];

if (!$test_extension) {
  $system_callback['code'] = 500;
  $system_callback['message'] = "Los archivos con extensión $extension no están permitidos. Favor de subir un archivo CSV.";
  exit_script($system_callback);
}

$file_handle = fopen($file['file']['tmp_name'], 'r');

$headers = fgetcsv($file_handle,1000);
$table_rows = array();
$facturas = array();
$valor_factura = array();
$today = date('Y-m-d', strtotime('today'));

$num_headers = count($documented_headers);

for ($i=0; $i < $num_headers; $i++) {
  if (!($headers[$i] == $documented_headers[$i])) {
    $system_callback['code'] = 500;
    $system_callback['message'] = "Los encabezados cambiaron, es necesario revisar que el archivo este correcto ($headers[$i] - $documented_headers[$i])";
    exit_script($system_callback);
  }
}

while ($row = fgetcsv($file_handle,1000)) {
  $table_rows[] = $row;
}

foreach ($table_rows as $value) {
  $system_callback['results'][$value[1]] = array();
  $facturas[$value[1]]['factura'] = $value[1];
  $facturas[$value[1]]['orden'] = $value[1];
  $facturas[$value[1]]['ano'] = $value[0];
  $facturas[$value[1]]['moneda'] = str_replace(".", "", $value[15]);
  $facturas[$value[1]]['fecha_carga'] = $today;
  $valor_factura[$value[1]] += $value[14];
  error_log($value[14]);
  $facturas[$value[1]]['items'][] = $value;
}

$system_callback['facturas'] = $facturas;

$validate_factura = "SELECT pk_factura_mayoral FROM mayoral_factura WHERE pk_factura_mayoral = ?";
$insert_factura = "INSERT INTO mayoral_factura (pk_factura_mayoral, numero_orden, ano_factura, moneda, valor_comercial, valor_moneda_extranjera) VALUES (?,?,?,?,?,?)";
$insert_factura_detalles = "INSERT INTO mayoral_factura_detalle (ano, fk_factura_mayoral, partida_factura, articulo, pieza, rango, descripcion , descripcion_mx, composicion, composicion_forro, taric, mx_hs_code, subdivi, cantidad, precio_unitario, importe_total, moneda, origen, peso_neto, peso_bruto, facerr, seccion , marca, t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, tk1, tk2, tk3, tk4, tk5, tk6, tk7, tk8, tk9, tk10, c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, punto_plana, sexo, umc, umt, alerta_precio_estimado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$validate_factura = $db->prepare($validate_factura);
if (!($validate_factura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during VALIDATE FACTURA query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$insert_factura = $db->prepare($insert_factura);
if (!($insert_factura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during INSERT FACTURA query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$insert_factura_detalles = $db->prepare($insert_factura_detalles);
if (!($insert_factura_detalles)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during INSERT FACTURA DETALLE query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($facturas as $factura => $header) {
  $validate_factura->bind_param('s', $factura);
  if (!($validate_factura)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during VALIDATE FACTURA binding [$validate_factura->errno]: $validate_factura->error";
    exit_script($system_callback);
  }

  if (!($validate_factura->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during VALIDATE FACTURA execution [$validate_factura->errno]: $validate_factura->error";
    exit_script($system_callback);
  }

  $facturas_validation = $validate_factura->get_result();

  if ($facturas_validation->num_rows > 0) {
    $system_callback['results'][$factura]['response'] = 400;
    $system_callback['results'][$factura]['message'] = "La factura ya existe en la base de datos.";
    continue;
  }



  $insert_factura->bind_param('ssssss', $header['factura'], $header['factura'], $header['ano'], $header['moneda'], $valor_factura[$factura], $valor_factura[$factura] );
  if (!($insert_factura)) {
    $system_callback['results'][$factura]['response'] = 500;
    $system_callback['results'][$factura]['message'] = "[$insert_factura->errno]: $insert_factura->error";
  }

  if (!($insert_factura->execute())) {
    $system_callback['results'][$factura]['response'] = 500;
    $system_callback['results'][$factura]['message'] = "[$insert_factura->errno]: $insert_factura->error";
  }

  if ($insert_factura->affected_rows > 0) {
    $system_callback['results'][$factura]['response'] = 1;
    $system_callback['results'][$factura]['message'] = "Factura agregada exitosamente.";
  } else {
    $system_callback['results'][$factura]['response'] = 500;
    $system_callback['results'][$factura]['message'] = "[$db->errno]: $db->error";
    continue;
  }



  foreach ($header['items'] as $i => $items) {

      //Row 11 es la fraccion
      //Row 14 es el precio unitario
      //Row 56 es UMT
    $v_precio_estimado = $items[13] < $precios[$item[10]]['precio_estimado'];
    $alerta_pe = NULL;

    if ($v_precio_estimado) {
      $alerta_pe = 1;
    } else {
      $alerta_pe = 0;
    }

    $partida = $i+1;

    $insert_factura_detalles->bind_param('ssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
    $items[0],$items[1],$partida,$items[2],$items[3],$items[4],$items[5],$items[6],$items[7],$items[8],$items[9],$items[10],$items[11],$items[12],$items[13],$items[14],$items[15],$items[16],$items[17],$items[18],$items[19],$items[20],$items[21],$items[22],$items[23],$items[24],$items[25],$items[26],$items[27],$items[28],$items[29],$items[30],$items[31],$items[32],$items[33],$items[34],$items[35],$items[36],$items[37],$items[38],$items[39],$items[40],$items[41],$items[42],$items[43],$items[44],$items[45],$items[46],$items[47],$items[48],$items[49],$items[50],$items[51],$items[52],$items[53],$items[54],$items[55],$alerta_pe
    );
    if (!($insert_factura_detalles)) {
      $system_callback['results'][$factura]['detalles'][$i]['response'] = 500;
      $system_callback['results'][$factura]['detalles'][$i]['message'] = "[$insert_factura_detalles->errno]: $insert_factura_detalles->error";
    }

    if (!($insert_factura_detalles->execute())) {
      $system_callback['results'][$factura]['detalles'][$i]['response'] = 500;
      $system_callback['results'][$factura]['detalles'][$i]['message'] = "[$insert_factura_detalles->errno]: $insert_factura_detalles->error";
    }

  }


  if (!($insert_factura_detalles->affected_rows > 0)) {
    $system_callback['results'][$factura]['detalles'][$i]['response'] = 500;
    $system_callback['results'][$factura]['detalles'][$i]['message'] = "[$db->errno]: $db->error";
  }


}


exit_script($system_callback);







 ?>
