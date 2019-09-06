<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$anexo30 = array();
$trato_preferencial = array();
$precios_estimados = array();
$txt_array = array();
$identificadores = array();
$today = date('Y-m-d');
$mh = date('Hi');


$codigo_paises = array(
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

$uvnom = "UVNOM" . $_POST['uvnom'];
$fecha_factura = $_POST['fecha_factura'];
$contenedor = $_POST['contenedor'];

$pbs = array();
$pbs_origenes = array();
$pbs_descripciones = array();

$alertas = array();
$advertencias = array();

$anexo30_query = $db->query('SELECT fraccion FROM mayoral_identificadores_anexo30');
while ($item = $anexo30_query->fetch_assoc()) {
  $anexo30[] = $item['fraccion'];
}

$trato_preferencial_query = $db->query('SELECT 3_siglas 3siglas FROM mayoral_trato_preferencial');
while ($item = $trato_preferencial_query->fetch_assoc()) {
  $trato_preferencial[] = $item['3siglas'];
}

$precios_estimados_query = $db->query('SELECT fraccion, precio_estimado FROM mayoral_precio_estimado');
while ($item = $precios_estimados_query->fetch_assoc()) {
  $precios_estimados[$item['fraccion']] = $item['precio_estimado'];
}

$identificadores_aplicables_query = $db->prepare("SELECT * FROM mayoral_identificadores mi LEFT JOIN mayoral_identificadores_fracciones mif ON mi.pk_identificador = mif.fk_identificador WHERE mif.fraccion = ? OR mif.fraccion = ? OR mif.fraccion = ?");
$identificadores_excepciones_query = $db->prepare("SELECT * FROM mayoral_identificadores mi LEFT JOIN mayoral_identificadores_fraccion_excepciones mife ON mi.pk_identificador = mife.fk_identificador WHERE mife.fraccion = ? OR mife.fraccion = ? OR mife.fraccion = ?");

if (!$identificadores_aplicables_query) {
    error_log("Error en prepare queries aplicables: " . $db->error);
}

if (!$identificadores_excepciones_query) {
    error_log("Error en prepare queries exceppciones: " . $db->error);
}

// $system_callback['anexo30'] = $anexo30;
// $system_callback['trato_preferencial'] = $trato_preferencial;
// $system_callback['precios_estimados'] = $precios_estimados;


$file = $_FILES;
$text_file = "";

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
$invoice_items = array();
$facturas = array();
$valor_factura = array();
$today = date('Y-m-d', strtotime('today'));

$num_headers = count($documented_headers);

for ($i=0; $i < $num_headers; $i++) {
  if (!($headers[$i] == $documented_headers[$i])) {
    $system_callback['code'] = 500;
    $system_callback['message'] = "Los encabezados no son correctos. Se esperaba $headers[$i]; y se encontró: $documented_headers[$i].";
    exit_script($system_callback);
  }
}

while ($row = fgetcsv($file_handle,1000)) {
  $invoice_items[] = $row;
}
fclose($file_handle);

$i = 1;

foreach ($invoice_items as $item) {
  $i++;
  $pais_origen = "";

  if ($item[1] == "") {
    continue;
  }
  $invoice_num = substr($item[1], 0, 2) . "." . substr($item[1], -3);
  $importe_total_factura += (double)$item[14];
  $numero_parte = $invoice_num . $item[2] . $item[3] . $i . $item[10] . $hm;

  $c_umt = 0;
  //Calcular Cantidad UMT!!
  if ($item[54] == $item[55]) {
    $c_umt = $item[12];
  } elseif ($item[55] == 1) {
    $c_umt = $item[17];
  } elseif ($item[55] == 9 && $item[54] == 6) {
    $c_umt = $item[12] * 2;
  } elseif ($item[55] == 6 && $item[54] == 9) {
    $c_umt = $item[12] / 2;
  } else {
    // Record error on this PN.
  }


  if (array_key_exists($item[16], $codigo_paises)) {
    $pais_origen = $codigo_paises[$item[16]];
  } else {
    $alertas[] = array(
      'line_item'=>$i,
      'message'=>"El codigo de país $item[16] no existe en el programa.",
      'comentarios'=>"Porfavor reportarlo a sistemas para corregir."
    );
  }

  $txt_array[$invoice_num]['header'] = array(
    $invoice_num,   //NumeroFactura
    $invoice_num,   //NumeroFactura - reemplaza número de órden
    $today,         //Fecha -- Hoy es default
    'ESP',          //Siempre se pone ESP(España) como país facturación
    'MA',           //Siempre se pone MA(Málaga) como entidad de facturación
    $item[14],      //Moneda --
    'CIF',          //Poner un campo para seleccionar el INCOTERM.
    $importe_total_factura, //Valor Moneda Extranjera
    $importe_total_factura, //Valor Comercial - Factura
    0,0,0,0,0,      //Flete, Seguros, Embalajes, Incrementables, Deducibles
    1,              //FactorMonedaExtranjera
  );

  $txt_array[$invoice_num]['items'][] = array(
    $numero_parte,   //Numero de Parte,
    $item[6],                                               //Descripcion MX
    "",                                                     //Descripcion Inglés
    $item[12],                                              //Cantidad UMC
    $item[54],                                              //UMC
    $item[13],                                              //PrecioUnitario
    2,0,                                                    //UnidadPesoUnitario - PesoUnitario
    $item[10],                                              //Fraccion
    $c_umt,                                                 //CantidadUMT
    (double) $c_umt / $item[12],                            //FactorAjuste
    $pais_origen,                                           //PaisOrigen,
    0,                                                      //ValorAgregado
    $item[21] == "NUKUTAVAKE" ? $item[21] : $item[21] . " Y DISENO", //Marca,
    $item[2],                                               //Modelo
    ""                                                       //Serie se manda en blanco.
  );
  $capitulo = substr($item[10], 0,2);
  $partida_fraccion = substr($item[10], 0, 4);

  //Si la fracción esta en el listado de precios estimados, lo revisa para agergar identificador EX o arrojar una alerta.
  if ($item[55] == 1) {
    $precio_unitario_tarifa = $item[14] / $item[17];
  } else {
    $precio_unitario_tarifa = $item[13];
  }
  if (  array_key_exists($item[10], $precios_estimados)) {
    $precio_estimado_item = $precios_estimados[$item[10]];
    if ($precio_unitario_tarifa > $precio_estimado_item) {
      if ($capitulo == 64) {
        $identificadores[$numero_parte][] = array($numero_parte, 'EX', '29');
      } elseif ($capitulo >= 50 && $capitulo <= 63) {
        $identificadores[$numero_parte][] = array($numero_parte, 'EX', '31');
      }
    } else {
      $alertas[] = array(
        'line_item'=>$i,
        'message'=>'Este producto esta por debajo del precio estimado.',
        'comentarios'=>"Precio Estimado: $precio_estimado_item - Precio Unitario: $item[13]"
      );
    }
  }

  //Aplicar identificador TL - EMU si eta en la lista de trato preferencial.
  if (in_array($pais_origen, $trato_preferencial)) {
    $identificadores[$numero_parte][] = array($numero_parte, 'TL', 'EMU');
  }

  //Si la fracción pertenece al Anexo 30, agrega el identificador MC correspondiene, o arroja una alerta, si no encuentra que MC poner.
  if (in_array($item[10], $anexo30)) {
    if ($item[21] == "NUKUTAVAKE") {
      $identificadores[$numero_parte][] = array($numero_parte, 'MC', '2', '1', '1');
    } elseif ($item[21] == "MAYORAL" || $item[10] == 39262099) {
      $identificadores[$numero_parte][] = array($numero_parte, 'MC', '2', '1', '4');
    } elseif ($capitulo == 42) {
      $identificadores[$numero_parte][] = array($numero_parte, 'MC', '4', '4');
    }
  }

  $identificadores_aplicables_query->bind_param('sss', $capitulo, $partida_fraccion, $item[10]);
  $identificadores_aplicables_query->execute();
  $identificadores_aplicables = $identificadores_aplicables_query->get_result();

  while ($idents = $identificadores_aplicables->fetch_assoc()) {
    $comple1 = $idents['identificador'] == "PB" ? $uvnom : $idents['complemento1'];

    $identificadores[$numero_parte][$idents['pk_identificador']] = array($numero_parte, $idents['identificador'], $comple1, $idents['complemento2'], $idents['complemento3'], $idents['complemento4']);

    if ($idents['identificador'] == "PB") {
      $clave_identificador = $idents['identificador'] . $uvnom . $idents['complemento2'] . $idents['complemento3'] . $idents['complemento4'];
      $pbs[$clave_identificador] = array(
        'norma' => $idents['identificador'] . "," . $uvnom . "," . $idents['complemento2'] . "," . $idents['complemento3'] . "," . $idents['complemento4'],
        'items' => $pbs[$clave_identificador]['items'] + 1,
        'umcs' => $pbs[$clave_identificador]['umcs'] + $item[54],
      );

      $pbs_origenes[] = $clave_identificador . "~" . $item[16];
      $pbs_descripciones[] = $clave_identificador . "~" . $item[6];

      $pbs[$clave_identificador]['totales'] = array(
        'items' => $pbs[$clave_identificador]['items'] + 1,
        'umcs' => $pbs[$clave_identificador]['umcs'] + $item[54],
      );
    }

  }

  $identificadores_excepciones_query->bind_param('sss', $capitulo, $partida_fraccion, $item[10]);
  $identificadores_excepciones_query->execute();
  $identificadores_excepciones = $identificadores_excepciones_query->get_result();

  while ($idents = $identificadores_aplicables->fetch_assoc()) {
    unset($identificadores[$numero_parte][$idents['pk_identificador']]);
    $pbs_origenes[] = $clave_identificador . "~" . $item[16];
    $pbs_descripciones[] = $clave_identificador . "~" . $item[6];
    if ($idents['identificador'] == "PB") {
      $clave_identificador = $idents['identificador'] . $uvnom . $idents['complemento2'] . $idents['complemento3'] . $idents['complemento4'];
      $pbs[$clave_identificador] = array(
        'norma' => $idents['identificador'] . "," . $uvnom . "," . $idents['complemento2'] . "," . $idents['complemento3'] . "," . $idents['complemento4'],
        'items' => $pbs[$clave_identificador]['items'] - 1,
        'umcs' => $pbs[$clave_identificador]['umcs'] - $item[54],
      );
      $pbs[$clave_identificador]['totales'] = array(
        'items' => $pbs[$clave_identificador]['items'] - 1,
        'umcs' => $pbs[$clave_identificador]['umcs'] - $item[54],
      );
    }
  }
}

$pbs_origenes = array_unique($pbs_origenes);
$pbs_descripciones = array_unique($pbs_descripciones);
$pbs_origenes_unique = array();
$pbs_descripciones_unique = array();

foreach ($pbs_origenes as $origen) {
  $handler_origen = explode("~", $origen);
  $pbs_origenes_unique[$handler_origen[0]][] = $handler_origen[1];
}

foreach ($pbs_descripciones as $descripcion) {
  $handler_descripcion = explode("~", $descripcion);
  $pbs_descripciones_unique[$handler_descripcion[0]][] = $handler_descripcion[1];
}

$system_callback['pbs'] = $pbs;
$system_callback['pbs_origenes'] = $pbs_origenes_unique;
$system_callback['pbs_descripcioes'] = $pbs_descripcioes_unique;

if (count($alertas) > 0) {
  foreach ($alertas as $alerta) {
    $system_callback['alertas'] .= "<tr><td>$alerta[line_item]</td><td>$alerta[message]</td><td>$alerta[comentarios]</td></tr>";
  }

  $system_callback['code'] = 2;
  exit_script($system_callback);
}

foreach ($txt_array as $factura) {
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

$uniq = uniqid();
$txt_file_path = $root . "/pltoolbox/mayoral/resources/TempFiles/txt_file_{$uniq}.txt";
file_put_contents($txt_file_path, $txt_file);

$system_callback['code'] = 1;
$system_callback['uniq'] = $uniq;

exit_script($system_callback);




 ?>
