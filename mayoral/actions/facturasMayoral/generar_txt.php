<?php
$root = $_SERVER['DOCUMENT_ROOT'];

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


function remove_n($txt){
  // error_log(mb_detect_encoding("Ñ"));

  $txt = str_replace(iconv('UTF-8', 'ASCII', "ñ"),"n",$txt);
  $txt = str_replace(iconv('UTF-8', 'ASCII', "Ñ"),"N",$txt);
  return $txt;
}

$cnt_1 = [
  ['10321703','61112012','104, 116, 2060, 2083, 2084, 2085, 2504, 2712, 2722'],
  ['10321703-1','61061002','104, 116, 2083, 2084, 2085, 2712, 2722, 4003, 4942'],
  ['10321703-2','61112012','108, 2064, 2065, 2066, 2067, 2068, 2069, 2070, 2071, 2072, 2073, 2074, 2075, 2076, 2077'],
  ['10321703-3','61102005','108, 173, 842, 2064, 2065, 2066, 2067, 2068, 2069, 2070, 2071, 2072, 2073, 2074, 2075, 2076, 2077, 4071, 4072, 4073, 4076, 4077, 4078, 4079, 4080, 4081, 4082, 4082, 4083, 4084, 4085, 4086, 4087, 4088, 4089, 4090, 4091, 4092, 7002, 7003, 7004, 700'],
  ['10321703-4','61112012','125'],
  ['10321703-5','61142001','125'],
  ['10321703-6','61051002','131, 4156, 4157, 4158, 4159, 4160, 7145, 7147, 7148'],
  ['10321703-7','61103099','145, 4001'],
  ['10321703-8','61099004','173, 4086'],
  ['10321703-9','61102005','178, 830, 4002, 4004, 4005, 4006, 4007, 4008, 4009, 4011, 4012, 4013, 4014, 4744, 4746, 4749, 4752, 7083, 7085, 7089, 7090, 7091, 7092, 7095, 7096'],
  ['10321703-10','61112012','307, 308, 2369, 2372, 2387, 2712'],
  ['10321703-11','61102005','308, 314, 2387, 4376'],
  ['10321703-12','61112012','309, 351, 2373, 2375, 2378, 2379, 2516'],
  ['10321703-13','61102005','309, 311, 323, 351, 354, 2373, 2375, 2378, 2379, 4355, 4357, 4359, 4360, 4361, 7340, 7341'],
  ['10321703-14','61102005','313, 345'],
  ['10321703-15','61102005','345'],
  ['10321703-16','61102005','354, 7340, 7341'],
  ['10321703-17','61112012','361, 918, 2424, 2425, 2826, 2829, 2830, 2895, 2896'],
  ['10321703-18','61012003','361, 907, 918, 2424, 2425, 2826, 2829, 2830, 4425, 4828, 4829, 4832, 4835, 7346'],
  ['10321703-19','62021399','415, 2440'],
  ['10321703-20','62092007','502, 2532, 2534'],
  ['10321703-21','62034292','502, 541, 545, 907, 2532, 2534, 4556, 4562, 4568, 4832, 7555'],
  ['10321703-22','61046203','511, 514, 560, 702, 717, 722, 2707, 2712, 2718, 2722, 2895, 2896, 4735, 4739, 4742, 4744, 4746, 4748,  4749, 4750, 4752, 4839, 7725, 7726, 7728, 7731'],
  ['10321703-23','61112012','514, 560, 702, 704, 918, 2504, 2516, 2528, 2536, 2707, 2712, 2718, 2722, 2826, 2829, 2830, 2895,  2896'],
  ['10321703-24','62046209','527, 7557, 7561'],
  ['10321703-25','62034291','545, 7555'],
  ['10321703-26','61034203','704, 705, 725, 918, 2528, 2536, 2826, 2829, 2830, 4571, 4828, 4829, 4835'],
  ['10321703-27','61034203','705'],
  ['10321703-28','61046399','712, 4751, 4837, 7560'],
  ['10321703-29','61046203','722, 7725, 7726, 7728, 7731'],
  ['10321703-30','61102005','830, 7083, 7085, 7089, 7090, 7091, 7093, 7094, 7095, 7096, 7728'],
  ['10321703-31','61102005','842, 7002, 7003, 7004, 7005, 7007, 7009, 7012, 7014, 7015, 7016, 7017, 7018, 7019, 7020'],
  ['10321703-32','61034399','907, 4558, 4828, 4832'],
  ['10321703-33','61112012','2063'],
  ['10321703-34','61051002','2063'],
  ['10321703-35','61112012','2079, 2080, 2081, 2715, 2718, 2925'],
  ['10321703-36','61102005','2079, 4748, 4751, 4839'],
  ['10321703-37','61102005','2080, 2081, 2427, 2718, 2925, 4001, 4428'],
  ['10321703-38','61112012','2139, 2140, 2142, 2143'],
  ['10321703-39','61051002','2139, 2140, 2142, 2143'],
  ['10321703-40','62092007','2146, 2147'],
  ['10321703-41','62052092','2146, 2147, 4165, 4166, 4167, 4168, 4169, 7151, 7153'],
  ['10321703-42','62099005','2151'],
  ['10321703-43','62064092','2151, 4171, 7157'],
  ['10321703-44','61113007','2376, 2931'],
  ['10321703-45','61103099','2376, 4356, 4358, 4363'],
  ['10321703-46','61113007','2389, 2390'],
  ['10321703-47','61103099','2389, 7362'],
  ['10321703-48','61113007','2404, 2432'],
  ['10321703-49','61112012','2410, 2427'],
  ['10321703-50','61102005','2410, 4403, 4405, 4406'],
  ['10321703-51','62093005','2415, 2417, 2419, 2440'],
  ['10321703-52','62011399','2415, 2417, 2419, 4413, 4415'],
  ['10321703-53','63079099','2415'],
  ['10321703-54','61113007','2423'],
  ['10321703-55','61013099','2423, 4370'],
  ['10321703-56','61023099','2432'],
  ['10321703-57','62093005','2433'],
  ['10321703-58','62021399','2433'],
  ['10321703-59','61112012','2676, 2685'],
  ['10321703-60','65050004','2676, 2819, 9438, 10156, 10159, 10160'],
  ['10321703-61','62046392','2696'],
  ['10321703-62','61022003','2712, 2895, 2896, 4446'],
  ['10321703-63','61113007','2715'],
  ['10321703-64','61112012','2808, 2821, 2913, 2925, 2927'],
  ['10321703-65','61112012','2808'],
  ['10321703-66','62093005','2819, 2906, 2908'],
  ['10321703-67','62044399','2906, 2908, 4914, 4934'],
  ['10321703-68','61044203','2913, 2925, 2927, 4931, 4936'],
  ['10321703-69','61113007','2924'],
  ['10321703-70','61044302','2924, 4913, 4927, 4931, 7916, 7921, 7926'],
  ['10321703-71','61103099','2931, 4372, 4373, 4374, 7348, 7350'],
  ['10321703-72','61113007','2931'],
  ['10321703-73','61045302','2931, 4942, 7905'],
  ['10321703-74','62063004','4174'],
  ['10321703-75','61178002','4373'],
  ['10321703-76','61103099','4378, 7355, 7356, 7357'],
  ['10321703-77','62011399','4413, 4415, 7416, 7417'],
  ['10321703-78','62029299','4433'],
  ['10321703-79','62021302','4434'],
  ['10321703-80','62021302','4434'],
  ['10321703-81','61103099','4742, 4750, 4837'],
  ['10321703-82','61102005','4748, 4839'],
  ['10321703-83','61103099','4837'],
  ['10321703-84','62045399','4901'],
  ['10321703-85','62045399','4907, 4910'],
  ['10321703-86','61044302','4931, 7916, 7921, 7927'],
  ['10321703-87','61091003','7011'],
  ['10321703-88','61091003','7011'],
  ['10321703-89','61099004','7086'],
  ['10321703-90','61099004','7086'],
  ['10321703-91','61051002','7145'],
  ['10321703-92','61051002','7147, 7148'],
  ['10321703-93','62052091','7149, 7151, 7153'],
  ['10321703-94','62064091','7157'],
  ['10321703-95','61012003','7346, 7419, 7422'],
  ['10321703-96','61103099','7347, 7348, 7349, 7350, 7352, 7353'],
  ['10321703-97','61103099','7356, 7356, 7357'],
  ['10321703-98','62029399','7359'],
  ['10321703-99','61103099','7361, 7362'],
  ['10321703-100','61102005','7401, 7405, 7406'],
  ['10321703-101','61023099','7429'],
  ['10321703-102','61023099','7429'],
  ['10321703-103','61023099','7433'],
  ['10321703-104','61046399','7560, 7724'],
  ['10321703-105','62046392','7564'],
  ['10321703-106','61062099','7731'],
  ['10321703-107','61045302','7905'],
  ['10321703-108','61045302','7907'],
  ['10321703-109','62044399','7913'],
  ['10321703-110','61044402','7925'],
  ['10321703-111','63013001','9007'],
  ['10321703-112','61112012','9424'],
  ['10321703-113','61152201','10126, 10127'],
  ['10321703-114','61152901','10130'],
  ['10321703-115','61159501','10134, 10135, 10140'],
  ['10321703-116','61171002','10149, 10156'],
  ['10321703-117','61169301','10156'],
  ['10321703-118','63079099','19042, 19270, 19796, 19797, 19799, 19899, 19900'],
  ['10321703-119','63079099','19797, 19900'],
  ['10321704','43040001','2390, 4380'],
  ['10321704-1','42022203','19042, 19269, 19270, 19796, 19797, 19799, 19899, 19900'],
  ['10321704-2','42029204','19270, 19796, 19797, 19799, 19900'],
  ['10321704-3','42029204','19802'],
  ['10321704-4','42021203','19817'],
  ['10321705','39262099','4432'],
  ['10321705-1','39262099','7722'],
  ['10321705-2','39264001','19195'],
  ];

$folios_file = $root . "/pltoolbox/mayoral/resources/TempFiles/items_sin_folios_cnt_1.csv";
$folios_file = fopen($folios_file, "w");

fputcsv($folios_file, ['Linea', 'Fraccion', 'Modelo']);

foreach ($cnt_1 as $uva){
    $folio = $uva[0];
    $fraccion = $uva[1];
    $modelos = explode(', ', $uva[2]);


    foreach($modelos as $modelo){
        $folios_computados[$fraccion . "_" . $modelo] = $folio;
    }
}

require $root . "/pltoolbox/mayoral/resources/specific_classes/csv_to_utf8.php";
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';
require $root . '/pltoolbox/Resources/vendor/autoload.php';

$system_callback = [];
$anexo30 = array();
$trato_preferencial = array();
$precios_estimados = array();
$txt_array = array();
$identificadores = array();
$today = date('Y-m-d');
$hm = date('Hi');
$csv_file = array();


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
$fecha_factura = date('d/m/Y', strtotime($_POST['fecha_factura']));
// $fecha_factura = date_format($fecha_factura, 'd/m/Y');
$contenedor = $_POST['contenedor'];

$datos_pbs = array();
$pbs = array();
$nopbs = array();
$pbs_origenes = array();
$pbs_descripciones = array();

$alertas = array();
$advertencias = array();

$anexo30_query = $db->query('SELECT fraccion FROM mayoral_identificadores_anexo30');
while ($item = $anexo30_query->fetch_assoc()) {
  $anexo30[] = substr($item['fraccion'], 0, 8);
}

$trato_preferencial_query = $db->query('SELECT 3_siglas 3siglas FROM mayoral_trato_preferencial');
while ($item = $trato_preferencial_query->fetch_assoc()) {
  $trato_preferencial[] = $item['3siglas'];
}

$precios_estimados_query = $db->query('SELECT fraccion, precio_estimado FROM mayoral_precio_estimado');
while ($item = $precios_estimados_query->fetch_assoc()) {
  $precios_estimados[$item['fraccion']] = $item['precio_estimado'];
}

$identificadores_aplicables_query = $db->prepare("SELECT * FROM mayoral_identificadores mi LEFT JOIN mayoral_identificadores_fracciones mif ON mi.pk_identificador = mif.fk_identificador WHERE mif.fraccion = ? OR mif.fraccion = ? OR mif.fraccion = ? OR mif.fraccion = ?");
$identificadores_excepciones_query = $db->prepare("SELECT * FROM mayoral_identificadores mi LEFT JOIN mayoral_identificadores_fraccion_excepciones mife ON mi.pk_identificador = mife.fk_identificador WHERE mife.fraccion = ? OR mife.fraccion = ? OR mife.fraccion = ? OR mife.fraccion = ?");

if (!$identificadores_aplicables_query) {
    error_log("Error en prepare queries aplicables: " . $db->error);
}

if (!$identificadores_excepciones_query) {
    error_log("Error en prepare queries exceppciones: " . $db->error);
}


$file = $_FILES;
$text_file = "";

$authorized_files = ['csv'];
$extension = pathinfo($file['file']['name'],PATHINFO_EXTENSION);
$test_extension = in_array($extension, $authorized_files);


$documented_headers = ["﻿AÑO","FACTURA","ARTICULO","PIEZA","RANGO","DESCRIPCION ","DESCRIPCION MX","COMPOSICION","COMP. FORRO","TARIC","MX HS CODE","SUBDIVI","CANTIDAD","PRECIO UN.","IMPORTE TOT,","MONEDA","ORIGEN","PESO NETO","PESO BRUTO","FACERR","SECCION ","MARCA","T1","T2","T3","T4","T5","T6","T7","T8","T9","T10","TK1","TK2","TK3","TK4","TK5","TK6","TK7","TK8","TK9","TK10","C1","C2","C3","C4","C5","C6","C7","C8","C9","C10","PUNTO / PLANA","SEXO","UMC","UMT"
];

$documented_headers = [
  "ANO",
  "FACTURA",
  "ARTICULO",
  "PIEZA",
  "RANGO",
  "DESCRIPCION ",
  "DESCRIPCION MX",
  "COMPOSICION",
  "COMP. FORRO",
  "TARIC",
  "MX HS CODE",
  "NICO",
  "CANTIDAD",
  "PRECIO UN.",
  "IMPORTE TOT,",
  "MONEDA",
  "ORIGEN",
  "PESO NETO",
  "PESO BRUTO",
  "FACERR",
  "SECCION ",
  "MARCA",
  "T1",
  "T2",
  "T3",
  "T4",
  "T5",
  "T6",
  "T7",
  "T8",
  "T9",
  "T10",
  "TK1",
  "TK2",
  "TK3",
  "TK4",
  "TK5",
  "TK6",
  "TK7",
  "TK8",
  "TK9",
  "TK10",
  "C1",
  "C2",
  "C3",
  "C4",
  "C5",
  "C6",
  "C7",
  "C8",
  "C9",
  "C10",
  "PUNTO / PLANA",
  "SEXO",
  "UMC",
  "UMT",
];


if (!$test_extension) {
  $system_callback['code'] = 500;
  $system_callback['message'] = "Los archivos con extensión $extension no están permitidos. Favor de subir un archivo CSV.";
  exit_script($system_callback);
}

// $conversion = new convert_csv_to_utf8($file['file']['tmp_name']);

// error_log("Conversion: " . var_export($conversion));

$file_handle = fopen($file['file']['tmp_name'], 'r');

$headers = fgetcsv($file_handle,1000);
$invoice_items = array();
$facturas = array();
$valor_factura = array();
$today = date('Y-m-d', strtotime('today'));

$num_headers = count($documented_headers);

for ($i=0; $i < $num_headers; $i++) {
  $internal_header = mb_strtoupper($documented_headers[$i]);
  $document_header = mb_strtoupper($headers[$i]);

  $internal_header = utf8_decode($internal_header);
  $document_header = utf8_decode($document_header);

  $internal_header = $documented_headers[$i];
  $document_header = $headers[$i];

  if (!($internal_header == $document_header)) {
    $system_callback['code'] = 500;
    $system_callback['message'] = "Los encabezados no son correctos. Se esperaba $internal_header; y se encontró: " . $document_header;
    error_log($system_callback['message']);
    error_log(mb_detect_encoding($documented_headers[$i]));
    exit_script($system_callback);
  }
}

while ($row = fgetcsv($file_handle,1000)) {
  $invoice_items[] = $row;
}
fclose($file_handle);

$i = 1;
$permisos = "";
foreach ($invoice_items as $item) {
  $i++;
  $pais_origen = "";
  $identificadores_item = array();
  $aplicar_permiso = false;
  $numero_nico = str_pad($item[11], 2, 0, STR_PAD_LEFT);


  $invoice_num = substr($item[1], 0, 2) . "." . substr($item[1], -3);
  $invoice_num = $item[1];
  $importe_total_factura += (double)$item[14];
  $numero_parte = $invoice_num . $item[2] . $item[3] . $i . $item[10] . $hm . "x";

  //Si la marca es New Born, se debe cambiar por mayoral.
  // $marca = str_replace('MAYORAL     ', 'MAYORAL', $marca);
  $marca = preg_replace('/[^a-zA-Z0-9&](\s)/', '', $item[21]);
  $marca = $marca == "NEWBORN " ? "MAYORAL" : $marca;

  if ($marca == "MAYORAL     ") {
    $advertencias[$numero_parte . "_" . $i] = "La marca es extraña. Marca: $marca";
  }

  //Agregar Y DISEÑO a todas las marcas excepto NUKUTAVAKE (o si hay registros vacíos).
  if (!($marca == 'NUKUTAVAKE' ||$marca == "" ||$marca == " ")) {
    $test = substr($marca, -1);
    if($test == " "){
      $marca .= "Y DISENO";
    } else {
      $marca .= " Y DISENO";
    }
  }

  if ($item[1] == "") {
    continue;
  }


  $c_umt = 0;
  //Calcular Cantidad UMT!!
    //54 es UMC
    //55 es UMT
        // Codigo 9 es Par
        // Codigo 6 es Pieza
  if ($item[54] == $item[55]) { //Si UMC = UMT.
    $c_umt = $item[12];
  } elseif ($item[55] == 1) { //Si UMT = Kilo, usa el peso unitario que viene en la factura.
    $c_umt = $item[17];
  } elseif ($item[55] == 9 && $item[54] == 6) { //Si UMC es Pieza y UMT es PAR. Entonces CANTIDAD COMERCIAL * 2.
    $c_umt = $item[12] / 2;
  } elseif ($item[55] == 6 && $item[54] == 9) { //Si UMC es Par y UMT es Pieza. Entonces Cantidad Comercial / 2.
    $c_umt = $item[12] * 2;
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
    $fecha_factura,         //Fecha -- Hoy es default
    'ESP',          //Siempre se pone ESP(España) como país facturación
    '',           //Siempre se pone MA(Málaga) como entidad de facturación
    $item[15],      //Moneda --
    'CIF',          //Poner un campo para seleccionar el INCOTERM.
    $importe_total_factura, //Valor Moneda Extranjera
    $importe_total_factura, //Valor Comercial - Factura
    0,0,0,0,0,      //Flete, Seguros, Embalajes, Incrementables, Deducibles
    1,              //FactorMonedaExtranjera
  );

  $txt_array[$invoice_num]['items'][] = array(
    $numero_parte,   //Numero de Parte,
    remove_n($item[6]),                                               //Descripcion MX
    "",                                                     //Descripcion Inglés
    $item[12],                                              //Cantidad UMC
    $item[54],                                              //UMC
    $item[13],                                              //PrecioUnitario
    2,0,                                                    //UnidadPesoUnitario - PesoUnitario
    $item[10].$numero_nico,                                              //Fraccion
    $c_umt,                                                 //CantidadUMT
    // "",
    (double) $c_umt / $item[12],                            //FactorAjuste
    $pais_origen,                                           //PaisOrigen,
    0,                                                      //ValorAgregado
    $marca,                                                  //Marca,
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
  if (  array_key_exists($item[10] . $numero_nico, $precios_estimados)) {
    $precio_estimado_item = $precios_estimados[$item[10]];
    if ($precio_unitario_tarifa > $precio_estimado_item) {
      if ($capitulo == 64) {
        $identificadores[$numero_parte . "_" . $i]['identificadores']['EX'] = array($numero_parte, 'EX', '29');
      } elseif ($capitulo >= 50 && $capitulo <= 63) {
        $identificadores[$numero_parte . "_" . $i]['identificadores']['EX'] = array($numero_parte, 'EX', '31');
      } elseif ($capitulo = 94) {
        $identificadores[$numero_parte . "_" . $i]['identificadores']['EX'] = array($numero_parte, 'EX', '31');
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
    $identificadores[$numero_parte . "_" . $i]['identificadores']['TL'] = array($numero_parte, 'TL', 'EMU');
  }

  if ($numero_parte ==  "1852389009161051002".$hm."x") {
    error_log("Special Debug: Fraccion: $item[10]");
  }

  if ($numero_parte ==  "1852389009161051002".$hm."x") {
    error_log("Special Debug: Marca: $marca");
  }

  //Si la fracción pertenece al Anexo 30, agrega el identificador MC correspondiene, o arroja una alerta, si no encuentra que MC poner.

  if ($numero_parte ==  "1852389009161051002".$hm."x") {
    error_log("Special Debug: Comparacion de Fraccion:" . in_array($item[10], $anexo30));
  }
  if ($numero_parte ==  "1852389009161051002".$hm."x") {
    error_log("Special Debug: Comparacion de Marca:" . strpos($marca, 'NUKUTAVAKE'));
  }

  if ($numero_parte ==  "1852389009161051002".$hm."x") {
    error_log("Special Debug: Marca: $marca");
  }

  if (in_array($item[10], $anexo30)) {
    if (strpos("______" . $marca . "_____", 'NUKUTAVAKE')) {
      if ($numero_parte ==  "1852389009161051002".$hm."x") {
        error_log("Special Debug: Se debe aplicar el identificador MC");
      }
      $identificadores[$numero_parte . "_" . $i]['identificadores']['MC'] = array($numero_parte, 'MC', '2', '1', '1');
    } elseif ($marca == "MAYORAL Y DISENO" ||$marca == "ABEL & LULA Y DISENO" ||$item[10] == 39262099) {
      $identificadores[$numero_parte . "_" . $i]['identificadores']['MC'] = array($numero_parte, 'MC', '2', '1', '4');
    } elseif ($capitulo == 42) {
      $identificadores[$numero_parte . "_" . $i]['identificadores']['MC'] = array($numero_parte, 'MC', '4', '4');
    } else {
      $advertencias[$numero_parte . "_" . $i] = "No se encontró que identificador aplicar. Marca: $marca";
    }
  }

  $nico = $item[10] . $numero_nico;

  $identificadores_aplicables_query->bind_param('ssss', $capitulo, $partida_fraccion, $item[10], $nico);
  $identificadores_aplicables_query->execute();
  $identificadores_aplicables = $identificadores_aplicables_query->get_result();

  while ($idents = $identificadores_aplicables->fetch_assoc()) {
    $folio = "";
    $comple1 = $idents['identificador'] == "PB" ? $uvnom : $idents['complemento1'];
    // $comple3 = $idents['identificador'] == "PB" ? "" : $idents['complemento3'];
    $identificadores[$numero_parte . "_" . $i]['identificadores'][$idents['pk_identificador']] = array($numero_parte, $idents['identificador'], $comple1, $idents['complemento2'], $idents['complemento3'], $idents['complemento4']);
    if ($idents['identificador'] == "PB") {
      $clave = $item[10] . "_" . $item[2];
      $folio = $folios_computados[$clave];

      if ($folio == "") {
        $datos_error = [
          $i, //linea,
          $item[10], //fraccion
          $item[2], //modelo
        ];
        fputcsv($folios_file, $datos_error);
        error_log("PERMISOERR: La linea $i ($item[10] - $item[2]) debe tener folio, y no se encontro\n");
      }

      $permisos .=
        $numero_parte . "|" .
        "NM|" .
        $idents['complemento2'] . "|" .
        $folio . "|||"
      ;
    }
  }

  $identificadores_excepciones_query->bind_param('ssss', $capitulo, $partida_fraccion, $item[10], $nico);
  $identificadores_excepciones_query->execute();
  $identificadores_excepciones = $identificadores_excepciones_query->get_result();

  while ($idents = $identificadores_excepciones->fetch_assoc()) {
    unset($identificadores[$numero_parte . "_" . $i]['identificadores'][$idents['pk_identificador']]);
  }
  $no_pb = true;
  foreach ($identificadores[$numero_parte . "_" . $i]['identificadores'] as $identificador) {
    if ($identificador[1] == "PB") {
      $no_pb = false;
      $datos_pbs[$identificador[1].",".$identificador[2].",".$identificador[3]]['items']++;
      $datos_pbs[$identificador[1].",".$identificador[2].",".$identificador[3]]['umcs'] += $item[12];
      $datos_pbs[$identificador[1].",".$identificador[2].",".$identificador[3]]['origenes'][]= $pais_origen;
      $datos_pbs[$identificador[1].",".$identificador[2].",".$identificador[3]]['descripciones'][] = remove_n($item[6]);
    }
  }
  if ($no_pb) {
    $datos_pbs['sin_norma']['items']++;
    $datos_pbs['sin_norma']['umcs'] += $item[12];
  }

}

// $pbs_origenes = array_unique($pbs_origenes);
// $pbs_descripciones = array_unique($pbs_descripciones);
// $pbs_origenes_unique = array();
// $pbs_descripciones_unique = array();

// foreach ($pbs_origenes as $origen) {
//   $handler_origen = explode("~", $origen);
//   $pbs_origenes_unique[$handler_origen[0]][] = $handler_origen[1];
// }

// foreach ($pbs_descripciones as $descripcion) {
//   $handler_descripcion = explode("~", $descripcion);
//   $pbs_descripciones_unique[$handler_descripcion[0]][] = $handler_descripcion[1];
// }


$uniq = uniqid();
$csv_file = fopen($root . "/pltoolbox/mayoral/resources/TempFiles/csv_file_{$uniq}.csv", "w");
$identificadores_csv = fopen($root . "/pltoolbox/mayoral/resources/TempFiles/csv_identificadores_{$uniq}.csv", "w");

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



  fputcsv($csv_file, explode(",", "Numero Factura,	Número Orden,	Fecha Factura,	Pais Factura,	Entidad Factura,	Moneda,	Incoterm,	Valor Total Factura,	Valor Total USD,	Flete,	Seguros,	Embalajes,	Incrementables,	Deducibles,	Factor Moneda Extranjera"));
  fputcsv($csv_file, $factura['header']);

  fputcsv($csv_file, explode(",","Numero Parte,	Descripcion Español,	Descripcion Ingles,	Cantidad UMC,	UMC,	Precio Unitario,	Unidad Peso Unitario,	Peso Unitario,	Fraccion,	Cantidad UMT,	UMT,	Pais Origen,	Valor Agregado,	Marca,	Modelo,	Serie"));

  foreach ($factura['items'] as $item) {
    foreach ($item as $valor_item) {
      $txt_file .= rtrim($valor_item) . "|";
    }
    fputcsv($csv_file, $item);

  }
  $txt_file = rtrim($txt_file, "|");
  // $txt_file = substr($txt_file, 0, -1);
  $txt_file .= "^";
}

$txt_file = rtrim($txt_file, "^");
$txt_file .= "~";

$identificadores_print = "";

foreach ($identificadores as $identificadores_item) {
  foreach($identificadores_item['identificadores'] as $identificador_parte){
    fputcsv($identificadores_csv, $identificador_parte);
    for ($i=0; $i < 7; $i++) {
      $identificadorparte = isset($identificador_parte[$i]) ? $identificador_parte[$i] : "";
      $txt_file .= $identificadorparte . "|";
    }
  }
}

$txt_file .= "@$permisos";

$txt_file = str_replace("ñ","n",$txt_file);
$txt_file = str_replace("Ñ","N",$txt_file);

$txt_file_path = $root . "/pltoolbox/mayoral/resources/TempFiles/txt_file_{$uniq}.txt";
file_put_contents($txt_file_path, $txt_file);
fclose($csv_file);

foreach ($datos_pbs as $norma_id => $datos_norma) {
  $datos_pbs[$norma_id]['origenes'] = array_unique($datos_pbs[$norma_id]['origenes']);
  $datos_pbs[$norma_id]['descripciones'] = array_unique($datos_pbs[$norma_id]['descripciones']);
}

$pbs_origenes_unique = array_unique($pbs_origenes);
$pbs_descripciones_unique = array_unique($pbs_descripciones);

$xls = new Spreadsheet();
$xlsActive = $xls->getActiveSheet();
$rows_var = "FGHIJKLMNOPQRSTUVWXY";

$xlsActive->setCellValue('B3', "Norma");
$xlsActive->setCellValue('C3', "Items");
$xlsActive->setCellValue('D3', "UMCs");

$i = 3;
foreach ($datos_pbs as $norma => $datos) {
  $i++;
  $xlsActive->setCellValue("B$i", utf8_encode($norma));
  $xlsActive->setCellValue("C$i", utf8_encode($datos['items']));
  $xlsActive->setCellValue("D$i", utf8_encode($datos['umcs']));
}


$c1=0;
foreach ($datos_pbs as $norma => $datos) {

  if ($norma == "sin_norma") {
    continue;
  }

  $r=2;
  $c2=$c1+1;
  $xlsActive->mergeCells("$rows_var[$c1]$r:$rows_var[$c2]$r");
  $xlsActive->setCellValue("$rows_var[$c1]$r", utf8_encode($norma));
  $r_data = 3;
  $xlsActive->setCellValue("$rows_var[$c1]$r_data", "Origenes");
  foreach ($datos['origenes'] as $origen) {
    $r_data++;
    $xlsActive->setCellValue("$rows_var[$c1]$r_data", utf8_encode($origen));
  }
  $r_data = 3;
  $xlsActive->setCellValue("$rows_var[$c2]$r_data", "Descripciones");
  foreach ($datos['descripciones'] as $descripcion) {
    $r_data++;
    $xlsActive->setCellValue("$rows_var[$c2]$r_data", utf8_encode($descripcion));
  }

  $c1++;
  $c1++;
}

$columns = strlen($rows_var);
for ($i=0; $i < $columns; $i++) {
  $xlsActive->getColumnDimension($rows_var[$i])->setAutoSize(true);
}


$writeXLS = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($xls);

$xls_file = $root . "/pltoolbox/mayoral/resources/TempFiles/uvas_file_{$uniq}.xlsx";
// $file = "/home/esantos/Crons/TempFiles/detalle_pedimentos_$cliente_rfc.xlsx";
$writeXLS->save($xls_file);


// $system_callback['pbs'] = $datos_pbs;
$system_callback['code'] = 1;
$system_callback['uniq'] = $uniq;
// $system_callback['advertencias'] = $advertencias;
fclose($folios_file);

exit_script($system_callback);

/*
<div class="row flex-grow-1">
                    <div class="col-lg-4 p-3">
                        <div class="card shadow-1 m-0">
                            <div class="card-header op-grayMouse text-bold">Clientes Especiales</div>
                            <div class="card-content p-2" style="overflow: scroll; height: 250px">
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                                <p>Aqui ponemos clientes mamones.</p>
                            </div>
                        </div>
                    </div>
                </div>

*/


?>
