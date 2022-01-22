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

$cnt_2 = [
  ['1032292','61112012','102, 1101, 1103, 1104, 1105, 1106, 1107, 1109, 1233'],
  ['1032292-1','61051002','102, 150, 1101, 1103, 1104, 1105, 1106, 1107, 1109, 1233, 3101, 3103, 3105, 3106, 3107, 3109, 3110, 3110, 3111, 3112, 3113, 6101, 6103, 6104, 6105, 6109'],
  ['1032292-2','61112012','105, 1003, 1023, 1094, 1095, 1096, 1667'],
  ['1032292-3','61061002','105, 1022, 1023, 1024, 1025, 1026, 1028, 1031, 1033, 1034, 1035, 1241, 1242, 1243, 1244, 1245, 1247, 1719, 1721, 1722, 1724, 1725, 1726, 1727, 1888, 1942, 1943, 3029, 3031, 3034, 3046, 3051, 3281, 3283, 3284, 3285, 3286, 3289, 3758, 3957, 6022, 6023, 6040, 6042, 6121, 6230, 6231'],
  ['1032292-4','61112012','106, 1004, 1005, 1006, 1007, 1008, 1009, 1010, 1011, 1012, 1013, 1014, 1015, 1016, 1035, 1184, 1203, 1204, 1207, 1207, 1212, 1216, 1217, 1591, 1649, 1659, 1662, 1663, 1664, 1723'],
  ['1032292-5','61051002','106, 1004, 1005, 1006, 1007, 1008, 1009, 1010, 1011, 1013, 1014, 1015, 1016, 1659, 1662, 1663, 1664, 1667'],
  ['1032292-6','61112012','168, 1707, 1709, 1710'],
  ['1032292-7','61091003','170, 840, 1012, 3001, 3002, 3003, 3004, 3005, 3006, 3007, 3008, 3009, 3010, 3011, 3012, 3014, 3015, 3017, 3018, 3019, 3020, 3021, 3022, 3023, 3025, 3026, 3027, 3028, 3268, 3651, 3653, 3654, 3655, 3656, 3657, 3658, 3659, 3660, 6001, 6003, 6004, 6005, 6006, 6007, 6009, 60'],
  ['1032292-8','61091003','174, 854, 3032, 3033, 3035, 3036, 3038, 3039, 3040, 3041, 3044, 3045, 3047, 3048, 3049, 3050, 3053, 3750, 3756, 3761, 3764, 3765, 3766, 3956, 3957, 6024, 6029, 6030, 6033, 6034, 6035, 6037, 6229, 6232, 6233'],
  ['1032292-9','62092007','201, 203, 206, 207, 1203, 1207, 1208, 1210, 1212, 1216, 1220, 1222, 1224, 1226, 1228, 1232, 1233'],
  ['1032292-10','62034292','203, 204, 206, 207, 231, 1220, 1222, 1224, 1226, 1232, 1233, 3247, 3249, 3253, 3259, 3260, 3265, 3267, 6201, 6204, 6205, 6207, 6212, 6213'],
  ['1032292-11','62034291','231, 6201, 6204, 6205, 6207, 6212, 6213'],
  ['1032292-12','62046209','235, 6222'],
  ['1032292-13','62046209','235, 236, 6222'],
  ['1032292-14','62034292','237, 252, 1228, 3256, 3258, 3261, 6215'],
  ['1032292-15','62034291','252, 6215'],
  ['1032292-16','61112012','303, 1348, 1350, 1595, 1597, 1598'],
  ['1032292-17','61102005','303, 311, 1350, 3336, 3337'],
  ['1032292-18','61112012','306, 318, 1346, 1358, 1727'],
  ['1032292-19','61102005','306, 320, 321, 1358, 6328'],
  ['1032292-20','62092007','500, 503, 506, 535, 595, 1502, 1505, 1507, 1510'],
  ['1032292-21','62034292','500, 503, 506, 509, 512, 515, 538, 543, 1502, 1505, 1507, 1510, 3576, 3577, 3578, 3579, 3580, 3582, 6561, 6563, 6566'],
  ['1032292-22','62046209','535, 548, 554, 6567, 6570, 6571'],
  ['1032292-23','62034291','538, 543, 6560, 6561, 6563, 6566'],
  ['1032292-24','61112012','550, 703, 711, 1503, 1508, 1590, 1591, 1593, 1595, 1597, 1598, 1705, 1705, 1713, 1715, 1718, 1719, 1720, 1721, 1722, 1723, 1724, 1725, 1726, 1727, 1862, 1888'],
  ['1032292-25','61046203','550, 703, 723, 748, 752, 1718, 1719, 1720, 1721, 1722, 1723, 1725, 1726, 1727, 1888, 3586, 3592, 3750, 3752, 3754, 3756, 3758, 3759, 3760, 3761, 3764, 3765, 3766, 3839, 6216, 6740, 6741, 6837'],
  ['1032292-26','62046209','554, 6567, 6570, 6571'],
  ['1032292-27','61034203','600, 3747, 6211, 6636, 6638, 6640, 6642, 6643, 6644, 6645'],
  ['1032292-28','61034203','600, 600, 611, 621, 1225, 1663, 1664, 1667, 3262, 3268, 3651, 3653, 3654, 3655, 3656, 3657, 3658, 3659, 3660, 3747, 3830, 3831, 6211, 6636, 6636, 66380, 6638, 6640, 6640, 6642, 6643, 6644, 6645'],
  ['1032292-29','61046203','607, 723, 1237, 1241, 1242, 1243, 1244, 1247, 1724, 3279, 3280, 3280, 3283, 3284, 3285, 3286, 3287, 3288, 3752, 3758, 3764, 3766, 6216, 6225, 6228, 6230, 6231, 6232, 6233, 6837'],
  ['1032292-30','61112012','621, 1204, 1217, 1225, 1237, 1241, 1242, 1243, 1244, 1247, 1622, 1624, 1626, 1649, 1650, 1651,  1652, 1653, 1663, 1664, 1667, 1682'],
  ['1032292-31','61034203','711, 742, 744, 1508, 3585, 3748, 3830, 3831, 6211, 6562, 6564, 6644'],
  ['1032292-32','61034203','744, 3748, 6562, 6564'],
  ['1032292-33','61046203','752, 6216, 6741, 6837'],
  ['1032292-34','61091003','840, 6001, 6002, 6003, 6004, 6005, 6006, 6007, 6009, 6010, 6011, 6012, 6013, 6015, 6016, 6019, 6020, 6636, 6638, 6640, 6642, 6643, 6644, 6645'],
  ['1032292-35','61091003','854, 3750, 6023, 6023, 6024, 6026, 6029, 6030, 6032, 6033, 6034, 6035, 6036, 6037, 6042, 6121, 6232, 6740, 6741'],
  ['1032292-36','61112012','1002, 1022, 1024, 1025, 1026, 1028, 1031, 1033, 1034, 1202, 1205, 1241, 1242, 1243, 1244, 1590, 1593, 1621, 1622, 1624, 1626, 1652, 1705, 1715, 1719, 1721, 1722, 1724, 1725, 1726, 1727, 1859, 1888, 1942, 1943'],
  ['1032292-37','61113007','1017'],
  ['1032292-38','61052003','1017'],
  ['1032292-39','62092007','1115, 1116, 1117, 1118, 1181, 1182, 1215, 1232'],
  ['1032292-40','62052092','1115, 1116, 1117, 1118, 1232, 3114, 3115, 3116, 3117, 3119, 3121, 3122, 3123, 3124, 3267, 6113, 6114, 6116, 6118'],
  ['1032292-41','62092007','1117'],
  ['1032292-42','62159001','1117'],
  ['1032292-43','61061002','1184'],
  ['1032292-44','62092007','1187'],
  ['1032292-45','62063004','1187, 3128, 3132, 6121, 6127, 6131'],
  ['1032292-46','62092007','1202, 1847, 1850, 1865, 1869, 1870, 1874, 1927, 1930'],
  ['1032292-47','61112012','1205, 9464'],
  ['1032292-48','62099005','1215, 1221, 1245'],
  ['1032292-49','62034901','1221, 3251'],
  ['1032292-50','62046999','1245, 3274, 3281, 6218, 6219'],
  ['1032292-51','61112012','1245, 1247'],
  ['1032292-52','61112012','1346, 9473, 9474, 9476, 9477, 9481, 10174, 10176, 10177'],
  ['1032292-53','61112012','1356, 1495, 1862, 1888'],
  ['1032292-54','61012003','1356, 3408, 3830, 3831, 6409'],
  ['1032292-55','61112012','1401, 1492'],
  ['1032292-56','61102005','1401, 3403'],
  ['1032292-57','62093005','1489'],
  ['1032292-58','61102005','1492, 3422'],
  ['1032292-59','62092007','1494'],
  ['1032292-60','62029299','1494, 3425, 3426, 3427, 6422'],
  ['1032292-61','61022003','1495, 1725, 1727, 1888, 3429, 3759, 3839'],
  ['1032292-62','65050004','1593, 1597, 1616, 1620, 1621, 1635, 1661, 1675, 1685, 9485, 10181, 10182'],
  ['1032292-63','62092007','1601'],
  ['1032292-64','61112012','1602, 1605, 1606, 1610, 1613, 1615, 1616, 1617, 1619, 1628, 1629, 1631, 1633, 1635, 1637, 1639, 1641'],
  ['1032292-65','61112012','1615, 1619, 1715, 1857'],
  ['1032292-66','61112012','1620'],
  ['1032292-67','61113007','1620, 1685, 1686, 1688'],
  ['1032292-68','62092007','1621, 1646, 1654, 1656'],
  ['1032292-69','61112012','1637'],
  ['1032292-70','61112012','1646, 1647, 1648, 1650, 1651, 1652, 1653, 1678, 1680, 1682'],
  ['1032292-71','61112012','1647, 1648, 1662, 1675, 1680'],
  ['1032292-72','62034202','1654, 1656'],
  ['1032292-73','62093005','1659, 1661'],
  ['1032292-74','62111101','1659, 1661, 3663, 3665, 3666, 6646, 6647, 6648, 6649'],
  ['1032292-75','61034203','1662'],
  ['1032292-76','61051002','1664'],
  ['1032292-77','61113007','1669, 1678, 1730, 1731'],
  ['1032292-78','61123101','1669, 3662'],
  ['1032292-79','62099005','1683'],
  ['1032292-80','61113007','1686'],
  ['1032292-81','61062099','1686, 6027, 6228, 6576'],
  ['1032292-82','61112012','1720, 1852, 1853, 1857, 1877, 1878, 1912, 1917, 1922, 1924, 1932, 1933, 1934, 1936, 1937, 1938, 1939, 1940'],
  ['1032292-83','61044203','1720, 1912, 1917, 1922, 1924, 1932, 1933, 1934, 1936, 1937, 1938, 1939, 1940, 3935, 3942, 3943, 3944, 3945, 3946, 3947, 3948, 3949, 3950, 3951, 3954, 6983, 6984, 6990'],
  ['1032292-84','61061002','1723'],
  ['1032292-85','61112012','1725'],
  ['1032292-86','62092007','1847, 1850, 1865, 1869, 1870, 1873, 1874, 1907, 1911, 1916, 1920, 1921, 1927, 1929, 1930'],
  ['1032292-87','62092007','1850'],
  ['1032292-88','62092007','1859, 1942'],
  ['1032292-89','62099005','1865, 1872, 1914'],
  ['1032292-90','62099005','1865, 1914'],
  ['1032292-91','62093005','1876, 1903, 1904, 1909, 1915'],
  ['1032292-92','61112012','1886'],
  ['1032292-93','61142001','1886, 3837, 3838, 6834, 6836'],
  ['1032292-94','62044399','1903, 1904, 1909, 1915, 3911, 3913, 3918, 3926, 3935, 3938, 6956, 6959, 6963, 6964'],
  ['1032292-95','62093005','1903'],
  ['1032292-96','62171001','1903, 3910, 6571, 6833, 6968, 10252'],
  ['1032292-97','62044299','1907, 1911, 1916, 1920, 1921, 1927, 1929, 1930, 3127, 3916, 3921, 3923, 3924, 3925, 3927, 3930, 3931, 3933, 3934, 3937, 3940, 3952, 6962, 6969, 6986, 6988'],
  ['1032292-98','62092007','1912, 9499'],
  ['1032292-99','62171001','1912'],
  ['1032292-100','62044499','1914, 3912, 3914, 3917, 3919, 3928, 3932, 6967, 6968, 6971, 6978'],
  ['1032292-101','62089202','1914'],
  ['1032292-102','62089101','1927, 1930'],
  ['1032292-103','61112012','1936, 9501'],
  ['1032292-104','61178002','1936'],
  ['1032292-105','62045203','1942, 3901, 3902'],
  ['1032292-106','61112012','1943'],
  ['1032292-107','61045201','1943, 3957'],
  ['1032292-108','61091003','3009'],
  ['1032292-109','61091003','3024, 3651, 6002, 6005, 6636'],
  ['1032292-110','61091003','3027'],
  ['1032292-111','62171001','3040, 6233'],
  ['1032292-112','61099004','3043, 6025, 6031, 6032'],
  ['1032292-113','61178002','3049'],
  ['1032292-114','61061002','3052, 3288'],
  ['1032292-115','62064092','3130, 3131, 3135'],
  ['1032292-116','62046209','3271, 3272, 3273, 3275, 3276, 3277'],
  ['1032292-117','61142001','3287'],
  ['1032292-118','61046399','3289, 6229, 6838'],
  ['1032292-119','61103099','3342'],
  ['1032292-120','62033203','3405, 6405'],
  ['1032292-121','61102005','3422, 6418, 6420, 6837'],
  ['1032292-122','62029299','3425, 3427, 6422'],
  ['1032292-123','61022003','3429, 3839'],
  ['1032292-124','62021299','3431'],
  ['1032292-125','62021299','3431'],
  ['1032292-126','62046999','3588, 6573'],
  ['1032292-127','62046209','3667'],
  ['1032292-128','62046209','3667'],
  ['1032292-129','62046999','3668, 6827'],
  ['1032292-130','62046999','3668'],
  ['1032292-131','61072101','3748'],
  ['1032292-132','61072101','3748'],
  ['1032292-133','61083103','3749, 3751'],
  ['1032292-134','61091003','3759, 3760, 3839, 6023'],
  ['1032292-135','62114202','3834, 6829'],
  ['1032292-136','61142001','3835, 6834, 6836'],
  ['1032292-137','62045906','3903'],
  ['1032292-138','61045302','3904'],
  ['1032292-139','62045203','3905'],
  ['1032292-140','62045399','3906, 3956'],
  ['1032292-141','62044902','3910'],
  ['1032292-142','61044203','3945, 3946, 6983, 6984, 6990'],
  ['1032292-143','62171001','3952, 6967'],
  ['1032292-144','61061002','6022, 6230, 6231, 6233'],
  ['1032292-145','61062099','6025, 6027, 6228, 6576'],
  ['1032292-146','61099004','6031'],
  ['1032292-147','61102005','6036'],
  ['1032292-148','61051002','6101, 6103, 6104, 6105, 6108, 6109'],
  ['1032292-149','61051002','6107'],
  ['1032292-150','61051002','6107'],
  ['1032292-151','62052091','6113, 6114, 6116, 6118'],
  ['1032292-152','62063004','6121, 6125, 6126, 6131'],
  ['1032292-153','62064091','6124'],
  ['1032292-154','62063004','6126'],
  ['1032292-155','62046999','6218, 6219'],
  ['1032292-156','61046203','6225, 6228, 6231, 6232, 6233, 6837'],
  ['1032292-157','61091003','6229'],
  ['1032292-158','61046399','6229'],
  ['1032292-159','61103099','6326'],
  ['1032292-160','61102005','6328'],
  ['1032292-161','61102005','6403'],
  ['1032292-162','62033203','6405'],
  ['1032292-163','61012003','6409'],
  ['1032292-164','61103099','6419'],
  ['1032292-165','62046999','6573'],
  ['1032292-166','61046399','6574, 6576'],
  ['1032292-167','61046399','6574, 6576'],
  ['1032292-168','62111101','6646, 6647, 6648, 6649'],
  ['1032292-169','61091003','6740'],
  ['1032292-170','62114302','6824, 6833'],
  ['1032292-171','62114302','6824'],
  ['1032292-172','61143002','6825'],
  ['1032292-173','62114302','6827'],
  ['1032292-174','62114202','6829, 6830, 6832'],
  ['1032292-175','61103099','6838'],
  ['1032292-176','62045399','6953'],
  ['1032292-177','62044399','6956, 6959, 6963, 6964'],
  ['1032292-178','62044299','6962, 6965, 6969, 6986'],
  ['1032292-179','62044499','6968, 6971, 6978'],
  ['1032292-180','63013001','9080'],
  ['1032292-181','63026006','9131, 9132, 9136, 9137'],
  ['1032292-182','61113007','9467, 9468, 9469, 10169'],
  ['1032292-183','62093005','9467'],
  ['1032292-184','61113007','9479, 10175'],
  ['1032292-185','65050004','9491, 9493, 9493, 10188, 10188, 10189, 10190, 10240, 10243, 10245'],
  ['1032292-186','61112012','9505'],
  ['1032292-187','61152201','10169, 10223, 10224'],
  ['1032292-188','61159501','10174, 10176, 10177, 10230, 10232, 10233'],
  ['1032292-189','61159601','10175, 10230, 10231'],
  ['1032292-190','62093005','10196'],
  ['1032292-191','63079099','19031, 19037, 19075, 19900'],
  ['1032292-192','63079099','19031, 19032, 19042, 19110, 19111, 19112, 19270, 19548, 19692, 19796, 19799, 19896, 19899, 19900, 19930'],
  ['1032292-193','63014001','19033'],
  ['1032292-194','42021203','19115'],
  ['1032292-195','42022203','1492, 19111'],
  ['1032293','39262099','6959'],
  ['1032293-1','96151101','9500, 9500, 10248'],
  ['1032293-2','39269099','19076, 19849'],
  ['1032293-3','83025001','64980'],
  ['1032294','42022203','19031, 19032, 19042, 19110, 19112, 19269, 19270, 19548, 19692, 19693, 19796, 19799, 19896, 19899, 19900, 19930'],
  ['1032294-1','42029204','19031, 19032, 19110, 19270, 19548, 19796, 19799, 19900'],
  ['1032294-2','42029204','19037, 19802'],
  ['1032294-3','42029204','19053, 19126, 19127, 19565, 19720'],
  ['1032294-4','42021203','19116'],
  ['1032294-5','42029204','19712'],
  ['1032294-6','42029204','19835'],
  ['1032295','95030012','19101, 19106, 19107, 19822'],
  ['1032295-1','95030012','19213'],
];

$folios_file = $root . "/pltoolbox/mayoral/resources/TempFiles/items_sin_folios_cnt_2.csv";
$folios_file = fopen($folios_file, "w");

fputcsv($folios_file, ['Linea', 'Fraccion', 'Modelo']);

foreach ($cnt_2 as $uva){
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
