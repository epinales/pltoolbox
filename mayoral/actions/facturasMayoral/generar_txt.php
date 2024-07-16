<?php
$root = $_SERVER['DOCUMENT_ROOT'];

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


function remove_n($txt){
  $txt = str_replace(iconv('UTF-8', 'ASCII', "ñ"),"n",$txt);
  $txt = str_replace(iconv('UTF-8', 'ASCII', "Ñ"),"N",$txt);
  return $txt;
}



$cnt_1 = [
  ['10324640','62093005','2451, 2478'],
  ['10324640-1','61113007','2471'],
  ['10324640-2','62024099','4485, 4487, 7476'],
  ['10324640-3','62024099','2478, 4485, 4486, 4487'],
  ['10324640-4','61112012','2711, 2807'],
  ['10324640-5','61112012','2807'],
  ['10324640-6','61178002','2711'],
  ['10324640-7','61113007','9778'],
  ['10324640-8','62114202','7191'],
  ['10324640-9','61143002','7192, 7192'],
  ['10324640-10','61112012','2047, 2048, 2049, 2050, 2052, 2052, 2053, 2054, 2253, 2503, 2504, 2612, 2627, 2628, 2628, 2785'],
  ['10324640-11','62099091','2193'],
  ['10324640-12','62092007','2195'],
  ['10324640-13','62063004','7191'],
  ['10324640-14','61061002','2047, 2048, 2049, 2050, 2052, 2052, 2053, 2054, 2253, 2711, 2714, 2928, 4064, 4065, 7011'],
  ['10324640-15','61062099','2193'],
  ['10324640-16','62063004','2195'],
  ['10324640-17','61051002','2709, 2825'],
  ['10324640-18','62064092','4105'],
  ['10324640-19','61112012','2505, 2506, 2507'],
  ['10324640-20','42022203','2915, 4931'],
  ['10324640-21','42029204','4931, 19032, 19112, 19899, 19900'],
  ['10324640-22','61171002','10825'],
  ['10324640-23','42029999','19900'],
  ['10324640-24','61112012','108, 2029, 2029, 2030, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2638, 2709, 2711, 2714, 2818, 2819, 2825, 2928'],
  ['10324640-25','61112012','104, 2182, 2184, 2185, 2186, 2459, 2512'],
  ['10324640-26','62092007','124, 2187, 2188, 2189, 2191, 2192, 2527'],
  ['10324640-27','62052091','874, 7108, 7109, 7110, 7111'],
  ['10324640-28','61051002','7101, 7102'],
  ['10324640-29','62069099','7194'],
  ['10324640-30','61061002','104, 131, 4116'],
  ['10324640-31','61051002','108, 2030, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2182, 2184, 2185, 2186, 2459, 2638, 2818, 2819, 4047, 4102, 4103, 4104, 7101, 7102, 7103'],
  ['10324640-32','62052092','124, 146, 874, 2188, 2189, 2191, 2192, 4109, 4110, 4111, 4112, 4113, 4114, 4115, 7108, 7109, 7110, 7111'],
  ['10324640-33','61091003','830, 7003, 7004, 7007, 7008, 7008, 7008, 7009'],
  ['10324640-34','61091003','7077, 7078, 7079, 7080, 7089, 7091, 7093'],
  ['10324640-35','61091003','7014, 7016, 7017, 7018, 7094'],
  ['10324640-36','61099004','7015'],
  ['10324640-37','61091003','4713, 4713, 7008'],
  ['10324640-38','61112012','307, 2302, 2308, 2709, 2785, 2928'],
  ['10324640-39','61113007','308, 2325'],
  ['10324640-40','61103099','4361, 4362, 7314'],
  ['10324640-41','61103099','308, 2325, 7312'],
  ['10324640-42','61102005','2709'],
  ['10324640-43','61102005','2464, 7394'],
  ['10324640-44','62024099','4498'],
  ['10324640-45','62019091','2470'],
  ['10324640-46','62014099','2471, 4472'],
  ['10324640-47','62019091','4466'],
  ['10324640-48','61112012','2316'],
  ['10324640-49','62093005','2317, 2614'],
  ['10324640-50','61113007','2807'],
  ['10324640-51','62014099','4347'],
  ['10324640-52','61102005','2316'],
  ['10324640-53','62014099','2317, 4347'],
  ['10324640-54','61023099','7474'],
  ['10324640-55','61112012','918, 2309, 2448, 2473, 2475, 2627, 2628, 2818, 2819, 2820, 2824, 2825'],
  ['10324640-56','61113007','2450'],
  ['10324640-57','62014099','412, 4464, 4464, 4465, 4466, 4467, 4470, 4471, 4472'],
  ['10324640-58','61012003','907, 4473, 4475, 4477, 4882, 4884, 7463, 7465, 7841'],
  ['10324640-59','61013099','7843'],
  ['10324640-60','62024099','415, 4488, 4489, 4490, 4491, 4492, 4493, 4494, 4495, 7473, 7478, 7484, 7486'],
  ['10324640-61','61023099','7317, 7474'],
  ['10324640-62','62024099','415, 2480, 2483, 2484, 4488, 4489, 4490, 4491, 4492, 4493, 4494, 4495'],
  ['10324640-63','61022003','2824, 2825, 4888, 4889'],
  ['10324640-64','61023099','4367'],
  ['10324640-65','62014099','412, 2468, 4464'],
  ['10324640-66','61012003','907, 918, 2473, 2475, 2818, 2819, 4473, 4475, 4477, 4876, 4880, 4881, 4882, 4884, 4886'],
  ['10324640-67','61013099','4350, 4464, 4474'],
  ['10324640-68','62093005','2456, 2468, 2480, 2483, 2484'],
  ['10324640-69','62013099','4107'],
  ['10324640-70','62014099','4108'],
  ['10324640-71','62024099','4486'],
  ['10324640-72','61023099','4118'],
  ['10324640-73','62013099','2187, 4107'],
  ['10324640-74','62014099','4108'],
  ['10324640-75','62014099','4465, 4470, 4471'],
  ['10324640-76','62171001','4911, 7214, 7979, 7980'],
  ['10324640-77','62159091','4109'],
  ['10324640-78','62171001','4069'],
  ['10324640-79','61045302','4220'],
  ['10324640-80','62045991','4907'],
  ['10324640-81','62045399','4908'],
  ['10324640-82','62045203','4909'],
  ['10324640-83','61113007','2928'],
  ['10324640-84','61045302','7969, 7971'],
  ['10324640-85','61045302','7971'],
  ['10324640-86','61045302','2928, 4903, 4904, 4935, 4937, 7969'],
  ['10324640-87','62045399','4901, 4902'],
  ['10324640-88','62045203','4905'],
  ['10324640-89','65050004','2502, 2618, 2790, 4339, 9775, 10825, 10833, 19340'],
  ['10324640-90','61169991','10815'],
  ['10324640-91','61112012','19340'],
  ['10324640-92','61112012','2618, 2619, 2780, 2790, 2792, 2793, 2794, 2794'],
  ['10324640-93','63014001','19033'],
  ['10324640-94','42029999','19200, 19283, 19354, 19435'],
  ['10324640-95','62093005','2189, 2527'],
  ['10324640-96','62152001','2189'],
  ['10324640-97','61112012','2638'],
  ['10324640-98','61113007','2253'],
  ['10324640-99','62046999','7213'],
  ['10324640-100','62046391','7214'],
  ['10324640-101','61046399','2253'],
  ['10324640-102','62046209','4219'],
  ['10324640-103','62046999','7213'],
  ['10324640-104','62046392','7214'],
  ['10324640-105','61112012','514, 702, 702, 704, 918, 918, 2502, 2503, 2504, 2505, 2506, 2507, 2509, 2512, 2526, 2532, 2541, 2543, 2612, 2614, 2623, 2623, 2624, 2624, 2627, 2628, 2704, 2705, 2709, 2710, 2711, 2713, 2714, 2785, 2786, 2786, 2818, 2819, 2820, 2820, 2824, 2825'],
  ['10324640-106','61113007','727, 2531, 2550, 2706, 2708, 2827'],
  ['10324640-107','62092007','2522, 2527, 2534'],
  ['10324640-108','61034203','705, 7537, 7841, 7843, 7844'],
  ['10324640-109','61034399','7530, 7840'],
  ['10324640-110','62034291','7539'],
  ['10324640-111','61046203','722'],
  ['10324640-112','62046391','7543'],
  ['10324640-113','62046999','7550'],
  ['10324640-114','61046399','7552, 7751, 7753, 7755'],
  ['10324640-115','61046991','7750'],
  ['10324640-116','61034203','2638'],
  ['10324640-117','61046203','514, 702, 702, 717, 722, 2704, 2705, 2708, 2709, 2710, 2711, 2713, 2714, 2824, 2825, 4704, 4710, 4711, 4711, 4712, 4713, 4887, 4888, 4889'],
  ['10324640-118','61046399','712, 717, 727, 2550, 2706, 2827, 4545, 4549, 4703, 4705, 4706, 4707, 4709, 4888, 4891, 7552, 7751, 7753, 7755'],
  ['10324640-119','62046209','4547'],
  ['10324640-120','61046991','4702, 7750'],
  ['10324640-121','62046392','7543'],
  ['10324640-122','62046999','7550'],
  ['10324640-123','61034203','704, 705, 725, 907, 907, 918, 918, 2532, 2541, 2543, 2818, 2819, 2820, 2820, 4532, 4876, 4880, 4881, 4882, 4882, 4884, 4884, 4885, 4886, 7537, 7840, 7841, 7843, 7844'],
  ['10324640-124','61034399','2531, 7530'],
  ['10324640-125','62034292','2534, 4540, 7539'],
  ['10324640-126','62046392','4217'],
  ['10324640-127','61046203','4544'],
  ['10324640-128','61152201','10795'],
  ['10324640-129','61112012','2701, 2788'],
  ['10324640-130','61112012','125, 125, 2183, 2183'],
  ['10324640-131','62099091','2470'],
  ['10324640-132','62014099','4467'],
  ['10324640-133','61112012','2455, 2462, 2476, 2612, 2614, 2710, 2713, 2786, 2786'],
  ['10324640-134','61113007','2706, 2708, 2827'],
  ['10324640-135','61102005','4449, 4885'],
  ['10324640-136','61103099','2827'],
  ['10324640-137','61102005','4479, 7467, 7468, 7470, 7753, 7755'],
  ['10324640-138','61103099','7472'],
  ['10324640-139','61102005','2476, 2710, 2713, 2928, 4220, 4481, 4482, 4707, 4709, 4712, 4887, 4937'],
  ['10324640-140','61103099','2706, 2708, 4478, 4706, 4710, 4891'],
  ['10324640-141','61102005','2460, 2462, 2820, 4449, 4454, 4885, 7448, 7453'],
  ['10324640-142','63022101','19253, 19253, 19323, 19323, 19323'],
  ['10324640-143','61112012','2464'],
  ['10324640-144','61102005','7840'],
  ['10324640-145','61112012','2460, 2623, 2623, 2624, 2624'],
  ['10324640-146','61102005','4457, 4474, 4881, 4886, 7444, 7445, 7447, 7449, 7450, 7464'],
  ['10324640-147','61102005','4888, 7469'],
  ['10324640-148','61103099','4045'],
  ['10324640-149','61102005','4479'],
  ['10324640-150','61102005','4451, 4457, 7444, 7447, 7449, 7452'],
  ['10324640-151','61102005','4451, 4454, 4709, 4712, 4937, 7394, 7448, 7452, 7453, 7488, 7844'],
  ['10324640-152','61103099','4922'],
  ['10324640-153','61103099','4925, 7302, 7303'],
  ['10324640-154','61112012','307, 309, 351, 2045, 2306, 2307, 2310, 2311, 2315, 2322, 2502, 2509'],
  ['10324640-155','61113007','2321, 2326, 2550'],
  ['10324640-156','61102005','354, 7103, 7392, 7393'],
  ['10324640-157','61103099','7390'],
  ['10324640-158','61102005','345, 4481, 4482, 4887'],
  ['10324640-159','61103099','4061, 4062, 4354, 4478, 4706, 4709, 4710, 4891, 7310, 7311'],
  ['10324640-160','61103099','145, 2321, 2326, 2550, 4062, 4353, 4355, 4356, 4709, 4935, 7001, 7302'],
  ['10324640-161','61102005','313, 345, 2322'],
  ['10324640-162','61102005','309, 311, 323, 351, 354, 2310, 2311, 2315, 4335, 4337, 4338, 4340, 4341, 4344, 4351, 7392, 7393'],
  ['10324640-163','61103099','4334, 4343, 7390'],
  ['10324640-164','61103099','4339'],
  ['10324640-165','61091003','4066, 4067, 4068, 4069, 4070, 4071, 4072, 4073, 4705, 4711, 4713, 4889, 7003, 7004, 7007, 7008, 7014, 7017, 7018, 7094'],
  ['10324640-166','61099004','7015'],
  ['10324640-167','61091003','4040, 4041, 4041, 4042, 4043, 4044, 4046'],
  ['10324640-168','61091003','842, 7081, 7082, 7083, 7083, 7086, 7087, 7088, 7090, 7090, 7092'],
  ['10324640-169','61091003','7005, 7012'],
  ['10324640-170','61091003','178, 830, 4063'],
  ['10324640-171','61091003','4886'],
  ['10324640-172','61091003','173, 842, 4048, 4049, 4050, 4051, 4052, 4053, 4053, 4054, 4055, 4056, 4057, 4058, 4060, 4880, 7077, 7078, 7079, 7080, 7081, 7082, 7083, 7086, 7087, 7088, 7089, 7090, 7090, 7091, 7092, 7093'],
  ['10324640-173','61113007','2806, 2881, 2914, 2919, 2920'],
  ['10324640-174','61112012','2807, 2807, 2885, 2908, 2915, 2922, 2924, 2926'],
  ['10324640-175','62092007','2808, 2883, 2886, 2887, 2925'],
  ['10324640-176','62093005','2903, 2903, 2904, 2913, 2923'],
  ['10324640-177','61044402','4912'],
  ['10324640-178','62044399','7977, 7979, 7980'],
  ['10324640-179','61044302','7984, 7987'],
  ['10324640-180','61044203','7986, 7986'],
  ['10324640-181','61044203','2915'],
  ['10324640-182','62044399','2903, 2903, 2904, 2913, 2923, 4911, 4913, 4914, 4919, 7977'],
  ['10324640-183','61044203','2908, 2922, 2924, 2926, 4912, 4927, 4927, 4930, 4931, 4933'],
  ['10324640-184','61044302','2914, 2919, 2920, 4910, 4918, 4922, 4922, 4924, 4925, 4925, 4926, 4928, 7979, 7980'],
  ['10324640-185','62044299','2925'],
  ['10324640-186','62044499','4917, 4923'],
  ['10324641','39262099','7972, 7972'],
  ['10324642','42029204','19032, 19900'],
  ['10324642-1','42022203','19032, 19112, 19899, 19900'],
  ['10324643','95030012','19271, 19274, 19822'],
];

$cnt_2 = [

];

$folios_file = $root . "/pltoolbox/mayoral/resources/TempFiles/items_sin_folio.csv";
$folios_file = fopen($folios_file, "w");

fputcsv($folios_file, ['Linea', 'Fraccion', 'Modelo']);

foreach ($cnt_1 as $uva){
    $folio = $uva[0];
    $fraccion = $uva[1];
    $modelos = explode(',',str_replace(' ', '', $uva[2]));


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
  $numero_nico = str_pad($item[11], 2, 0, STR_PAD_LEFT); //si


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


  } elseif ($item[55] == 9 && $item[54] == 6) { //Si UMC es Par y UMT es Pieza. Entonces Cantidad Comercial / 2.
    $c_umt = $item[12] / 2;


  } elseif ($item[55] == 6 && $item[54] == 9) { //Si UMC es Pieza y UMT es PAR. Entonces CANTIDAD COMERCIAL * 2.
    $c_umt = $item[12] * 2;


  } elseif ($item[55] == 6 && $item[54] == 12) { //Si UMC es Juego y UMT es Pieza. Entonces Cantidad Comercial * 2.
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
    remove_n($item[6]),                                     //Descripcion MX
    "",                                                     //Descripcion Inglés
    $item[12],                                              //Cantidad UMC
    $item[54],                                              //UMC
    $item[13],                                              //PrecioUnitario
    2,0,                                                    //UnidadPesoUnitario - PesoUnitario
    $item[10].$numero_nico,                                 //Fraccion
    $c_umt,                                                 //CantidadUMT
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
    $identificadores[$numero_parte . "_" . $i]['identificadores']['EO'] = array($numero_parte, 'EO', '1');
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

  $has_pb = false;

  while ($idents = $identificadores_aplicables->fetch_assoc()) {
    $folio = "";

    // if ($idents['identificador'] != "PB") {
        $comple1 = $idents['identificador'] == "PB" ? $uvnom : $idents['complemento1'];
        // $comple3 = $idents['identificador'] == "PB" ? "" : $idents['complemento3'];
        $identificadores[$numero_parte . "_" . $i]['identificadores'][$idents['pk_identificador']] = array($numero_parte, $idents['identificador'], $comple1, $idents['complemento2'], $idents['complemento3'], $idents['complemento4']);
    // }

    

    // esta sección se utiliza para el archivo TXT
    if ($idents['identificador'] == "PB") {
      $has_pb = true;
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

  if($has_pb){
    unset($identificadores[$numero_parte . "_" . $i]['identificadores']['NM']);
  }


  $identificadores_excepciones_query->bind_param('ssss', $capitulo, $partida_fraccion, $item[10], $nico);
  $identificadores_excepciones_query->execute();
  $identificadores_excepciones = $identificadores_excepciones_query->get_result();

  if($item[10] === '98010001'){
    unset($identificadores[$numero_parte . "_" . $i]['identificadores']['TL']);
  }

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

} //fin


$txt_file = "";
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
$writeXLS->save($xls_file);


$system_callback['code'] = 1;
$system_callback['uniq'] = $uniq;
fclose($folios_file);

exit_script($system_callback);



?>
