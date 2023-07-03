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


$aer_2_23 = [
  ['10323581','61061002','5140, 5276'],
  ['10323581-1','62064092','5141, 5272, 5273, 5274, 5275, 5277, 5278'],
  ['10323581-2','42022203','5433, 5434'],
  ['10323581-3','61112012','5403, 5405'],
  ['10323581-4','61159501','5406'],
  ['10323581-5','61159601','5407'],
  ['10323581-6','62093005','5011, 5012'],
  ['10323581-7','62099091','5136, 5249, 5251, 5252, 5253, 5254, 5255, 5256, 5257'],
  ['10323581-8','62092007','5138, 5139, 5250'],
  ['10323581-9','61103099','5366, 5367'],
  ['10323581-10','62099091','5362'],
  ['10323581-11','62093005','5361'],
  ['10323581-12','62023099','5369'],
  ['10323581-13','61113007','5360'],
  ['10323581-14','61112012','5363'],
  ['10323581-15','61119091','5364'],
  ['10323581-16','62099091','5701'],
  ['10323581-17','62024099','5279, 5368'],
  ['10323581-18','62093005','5003, 5004, 5005, 5007, 5008, 5009, 5011, 5015, 5020, 5021, 5023'],
  ['10323581-19','62171001','5024, 5025, 5027, 5029, 5030, 5031, 5031, 5032, 5033, 5034, 5035, 5036, 5038, 5040, 5041, 5042, 5044, 5045, 5054, 5055, 5061, 5062, 5063, 5259, 5260, 5262, 5264, 5266, 5279'],
  ['10323581-20','62092007','5249, 5255'],
  ['10323581-21','62093005','5250, 5439'],
  ['10323581-22','61113007','5427, 5428'],
  ['10323581-23','62114302','5258, 5258, 5259, 5260, 5261, 5262, 5263, 5264, 5265, 5266, 5267, 5268, 5269, 5270, 5271'],
  ['10323581-24','61151001','5401'],
  ['10323581-25','62099091','5247, 5251, 5252, 5253, 5254, 5256'],
  ['10323581-26','62092007','5249, 5255'],
  ['10323581-27','62093005','5250'],
  ['10323581-28','62046392','5272'],
  ['10323581-29','62092007','5248'],
  ['10323581-30','62099091','5257, 5701'],
  ['10323581-31','62046392','5273, 5274, 5275, 5277, 5278, 5279'],
  ['10323581-32','61046399','5276'],
  ['10323581-33','61113007','5402'],
  ['10323581-34','61112012','5365'],
  ['10323581-35','62093005','5430'],
  ['10323581-36','62099091','5001, 5006'],
  ['10323581-37','62093005','5002, 5003, 5004, 5005, 5007, 5008, 5009, 5010, 5011, 5012, 5013, 5014, 5015, 5016, 5017, 5018, 5019, 5020, 5021, 5022, 5023'],
  ['10323581-38','62044399','5024, 5025, 5027, 5029, 5030, 5031, 5032, 5033, 5034, 5035, 5036, 5037, 5039, 5040, 5041, 5042, 5044, 5045, 5046, 5047, 5048, 5049, 5050, 5051, 5052, 5054, 5055, 5056, 5057, 5058, 5059, 5060, 5061, 5062, 5063, 5064, 5065'],
  ['10323581-39','62044991','5026, 5028'],
  ['10323581-40','62044299','5038, 5043'],
  ['10323581-41','62044499','5053'],
  ['10323582','96151101','5413, 5414, 5415, 5416, 5417, 5418, 5419, 5420, 5421, 5422, 5423, 5424, 5425, 5426'],
  ['10323582-1','96151999','5408, 5409, 5410, 5410, 5411, 5411, 5412'],
  ['10323582-2','48205001','80108'],
  ['10323582-3','44211001','63954'],
  ['10323583','42022203','5431, 5432, 5435, 5436'],
];

$cnt_1_23 = [
  ['10323609','62093005','2405, 2406, 2415, 2416, 2418'],
  ['10323609-1','62024099','2415, 2416, 2418, 4407, 4407, 4408, 4408, 4409, 4409, 7408, 7409, 7409'],
  ['10323609-2','61112012','2844'],
  ['10323609-3','61113007','2862'],
  ['10323609-4','61061002','2006, 7178'],
  ['10323609-5','61112012','2772'],
  ['10323609-6','61046203','2772, 4004, 4196'],
  ['10323609-7','62064092','4197, 7177'],
  ['10323609-8','62064091','7175, 7177'],
  ['10323609-9','62064092','7175'],
  ['10323609-10','61062099','7178'],
  ['10323609-11','61142001','125'],
  ['10323609-12','61112012','125'],
  ['10323609-13','63059091','19112, 19173, 19175'],
  ['10323609-14','63053999','19176, 19796, 19896'],
  ['10323609-15','42022203','19176'],
  ['10323609-16','42022203','4932'],
  ['10323609-17','42029204','19176'],
  ['10323609-18','61171002','10535, 10535, 10593, 10597'],
  ['10323609-19','62093005','2664'],
  ['10323609-20','62093005','2664'],
  ['10323609-21','61112012','9653, 9653, 9653, 9653, 9655, 9655, 9655, 9655, 9655, 9655, 9656, 9656, 9656, 9659'],
  ['10323609-22','62092007','124'],
  ['10323609-23','62052091','874, 4107, 7184, 7187, 7188'],
  ['10323609-24','62052092','874, 2178, 2179, 4105, 4107, 4108, 4109, 4110, 4111, 4111, 4112, 7187, 7188'],
  ['10323609-25','61051002','4101, 4102, 4103, 4104, 7181, 7182, 7182, 7183'],
  ['10323609-26','61062099','4194'],
  ['10323609-27','62063004','4198, 7180, 7181'],
  ['10323609-28','62064091','7179'],
  ['10323609-29','62092007','2165, 2176, 2177, 2178, 2179'],
  ['10323609-30','62052092','146, 2176, 2177'],
  ['10323609-31','61051002','2168, 2169, 2171, 2172'],
  ['10323609-32','61091003','830, 830, 842, 842, 2007, 2008, 2009, 2010, 2011, 2011, 2012, 2014, 2016, 2016, 2017, 2018, 2020, 2021, 2022, 2022, 2023, 2024, 2025, 2027, 2028, 2242, 2764, 2766, 2768, 2769, 2770, 4003, 4005, 4006, 4006, 4007, 4008, 4009, 4009, 4009, 4010, 4011, 4012, 4013, 4014, 4015, 4015, 4015, 4016, 4017, 4018'],
  ['10323609-33','61112012','2001, 2001, 2002, 2002, 2006, 2007, 2008, 2009, 2010, 2011, 2011, 2012, 2014, 2016, 2016, 2017, 2018, 2020, 2021, 2022, 2022, 2023, 2025, 2027, 2028, 2501, 2502, 2503, 2505, 2666, 2684, 2741, 2741, 2742, 2764, 2766, 2768, 2769, 2770, 2873'],
  ['10323609-34','61099004','4795'],
  ['10323609-35','61112012','2242'],
  ['10323609-36','61091003','116, 178'],
  ['10323609-37','61091003','108, 173'],
  ['10323609-38','61112012','108, 116'],
  ['10323609-39','62092007','124'],
  ['10323609-40','61112012','2301, 2308'],
  ['10323609-41','61112012','2667'],
  ['10323609-42','61113007','2766, 2871'],
  ['10323609-43','61103099','2766, 2871'],
  ['10323609-44','62024099','4315, 4316, 4316, 7315, 7316, 7316'],
  ['10323609-45','61102005','4327'],
  ['10323609-46','62014099','4328, 4329, 4329, 7388, 7388'],
  ['10323609-47','62024099','2315'],
  ['10323609-48','62093005','2315'],
  ['10323609-49','62024099','415, 416, 4410, 4411, 4413, 4414, 4416, 4417, 4418, 7402, 7403, 7404, 7405, 7407, 7410, 7410, 7410, 7411, 7412, 7413, 7414, 7415'],
  ['10323609-50','61113007','2402'],
  ['10323609-51','62093005','2407, 2410, 2411, 2434'],
  ['10323609-52','62014099','2434, 2436, 4431, 4434, 4435, 4435, 4437, 4437, 4438, 4440, 4440, 4441, 4441, 4442, 4442, 4443, 4443, 7431, 7432, 7433, 7434, 7435, 7436, 7437'],
  ['10323609-53','62093005','2421, 2422, 2423, 2425, 2436, 2438, 2441, 2442'],
  ['10323609-54','62024099','416, 4410, 4411, 4412, 4417'],
  ['10323609-55','62024099','2421, 2422, 2423, 2425, 4412, 4413, 4414'],
  ['10323609-56','62014099','2441, 2442'],
  ['10323609-57','62024099','415'],
  ['10323609-58','62014099','412'],
  ['10323609-59','62014099','412'],
  ['10323609-60','63079099','99903, 99904'],
  ['10323609-61','62171001','4315, 4501, 4914, 4917, 7211, 10615'],
  ['10323609-62','61112012','2239'],
  ['10323609-63','62159091','4108'],
  ['10323609-64','61045302','2967'],
  ['10323609-65','62045203','4909'],
  ['10323609-66','61045302','4906'],
  ['10323609-67','62045399','4908'],
  ['10323609-68','61112012','2867'],
  ['10323609-69','61113007','2967'],
  ['10323609-70','62045399','4901, 4902, 4902, 4903'],
  ['10323609-71','62045203','4907'],
  ['10323609-72','61045302','4935, 7951, 7951'],
  ['10323609-73','62045991','7950, 7950, 7952, 7952'],
  ['10323609-74','65050004','2504, 9671, 10535, 10535, 10593, 10597, 10600, 10643'],
  ['10323609-75','61113007','10535'],
  ['10323609-76','61169301','10535, 10597'],
  ['10323609-77','61112012','10517, 10518'],
  ['10323609-78','61152991','10517, 10518, 10568'],
  ['10323609-79','63014001','19033'],
  ['10323609-80','63014001','9319, 9335, 9336'],
  ['10323609-81','63013001','19253, 19253'],
  ['10323609-82','42029204','10640, 19196, 19200'],
  ['10323609-83','62152001','2165, 2177, 2177'],
  ['10323609-84','61112012','918, 918'],
  ['10323609-85','61034203','705, 2529, 2538, 2773, 2872, 2873, 2873, 2874, 2876, 2876, 2877, 2877, 2878, 2878, 4510, 4522, 4866, 4867, 4867, 4868, 4868, 4869, 4870, 4873, 4875, 4875, 7516, 7519, 7520, 7528, 7834, 7834, 7835, 7835, 7836, 7836, 7837, 7837, 7839, 7839'],
  ['10323609-86','61046399','2242, 2528, 4502, 4508, 4509, 4512, 4780, 4785, 4786, 4789, 7502, 7502, 7505, 7505, 7513, 7513, 7513, 7514, 7514, 7743, 7743, 7745, 7745, 7749, 7749, 10530, 10565'],
  ['10323609-87','62092007','2517, 2521, 2522, 2527, 2530, 2531, 2539, 2540, 2544'],
  ['10323609-88','61046203','2525, 2762, 2762, 2763, 2764, 2765, 2766, 2767, 2768, 2768, 2769, 2770, 2772, 2870, 2870, 2871, 4784, 4787, 4788, 4790, 4791, 4793, 4794, 4794, 4795, 4862, 4863, 4864, 4865, 4865, 7512, 7512, 7512, 7748, 7748, 7832, 7832'],
  ['10323609-89','62046209','2527, 4501, 4504, 7501, 7501, 7507, 7507'],
  ['10323609-90','61119091','2528'],
  ['10323609-91','61113007','2529, 2741, 2741, 9643, 10530'],
  ['10323609-92','62034292','2530, 2531, 2539, 2540, 2544, 4513, 4515, 4516, 4518, 4520, 4521, 7523, 7524, 7527'],
  ['10323609-93','61112012','2538, 2597, 2666, 2667, 2680, 2680, 2684, 2744, 2744, 2755, 2755, 2762, 2762, 2763, 2764, 2765, 2766, 2767, 2768, 2768, 2769, 2770, 2771, 2772, 2773, 2867, 2870, 2870, 2871, 2872, 2873, 2874, 2876, 2876, 2877, 2877, 2878, 2878'],
  ['10323609-94','61103099','4508, 4509'],
  ['10323609-95','61091003','4794, 4795'],
  ['10323609-96','62046391','7506, 7506'],
  ['10323609-97','62046999','7508, 7508'],
  ['10323609-98','62034991','7522'],
  ['10323609-99','62092007','2239'],
  ['10323609-100','62046392','4213, 4216, 7210, 7967'],
  ['10323609-101','62046209','7209, 7209, 7211, 7211'],
  ['10323609-102','62046391','7210, 7967'],
  ['10323609-103','61046399','7212, 7212'],
  ['10323609-104','62046392','4215'],
  ['10323609-105','61112012','2525'],
  ['10323609-106','61034203','918'],
  ['10323609-107','62034291','516'],
  ['10323609-108','62092007','502, 510, 521'],
  ['10323609-109','61112012','514'],
  ['10323609-110','61046203','511, 514'],
  ['10323609-111','62034292','510, 513, 516, 517'],
  ['10323609-112','61112012','560, 702, 702, 704, 2242'],
  ['10323609-113','62092007','563, 576'],
  ['10323609-114','62046209','557, 578'],
  ['10323609-115','61046203','722'],
  ['10323609-116','62034291','7516, 7519, 7520, 7522, 7523, 7524, 7527, 7528'],
  ['10323609-117','62046209','527, 557, 576, 577, 578'],
  ['10323609-118','61046203','560, 702, 702, 717, 722'],
  ['10323609-119','62034292','521, 537, 563'],
  ['10323609-120','61034203','704, 705, 725, 907, 907'],
  ['10323609-121','61112012','9648'],
  ['10323609-122','62034292','502, 504'],
  ['10323609-123','62093005','2664'],
  ['10323609-124','61112012','2773'],
  ['10323609-125','61072201','2773, 4798, 4798'],
  ['10323609-126','61112012','2501, 2502, 2503, 2504, 2505, 2509'],
  ['10323609-127','61113007','2742'],
  ['10323609-128','61112012','104, 2168, 2169, 2171, 2172'],
  ['10323609-129','61061002','104, 131'],
  ['10323609-130','61102005','4401'],
  ['10323609-131','61112012','2660, 2671, 2734, 2734, 2735, 2736, 2736, 2737, 2738, 2738, 2739, 2740, 2745, 2746, 2748, 2749, 2749, 2751'],
  ['10323609-132','94043001','19232, 19311'],
  ['10323609-133','61112012','307, 918, 2004, 2304, 2305, 2306, 2307, 2309, 2310, 2312, 2313, 2316, 2317, 2318, 2321, 2322, 2325, 2327, 2398, 2413, 2504, 2509, 2521, 2522, 2544, 2666, 2667, 2680, 2680, 2684, 2742, 2744, 2744, 2764, 2764, 2765, 2767, 2771, 2870, 2871, 2872, 2872, 2873, 2874, 2876, 2877, 2878, 2878'],
  ['10323609-134','61102005','907, 907, 918, 2312, 2316, 2317, 2318, 2321, 2322, 2325, 2327, 2413, 2429, 2431, 2544, 2764, 2872, 2872, 2873, 2874, 2876, 2877, 4318, 4320, 4321, 4323, 4324, 4325, 4403, 4403, 4404, 4404, 4404, 4404, 4420, 4420, 4422, 4422, 4423, 4423, 4430, 4430, 4786, 4789, 4789, 4789, 4789, 4790, 4791, 4791, 479'],
  ['10323609-135','61119091','2005, 2528'],
  ['10323609-136','61103099','2005, 2309, 2310, 2313, 2428, 2528, 2765, 2767, 2870, 2871, 4301, 4301, 4302, 4303, 4303, 4304, 4305, 4306, 4307, 4308, 4310, 4319, 4322, 4326, 4419, 4419, 4428, 4428, 4445, 4445, 4447, 4447, 4448, 4448, 4508, 4509, 4790, 4869, 4915, 4923, 4923, 4935, 7040, 7302, 7302, 7303, 7303, 7304, 7304, 7305,,'],
  ['10323609-137','61113007','2403, 2765, 2867'],
  ['10323609-138','61091003','7060, 7061, 7063, 7064, 7066, 7067, 7071, 7073, 7073, 7074, 7076'],
  ['10323609-139','61102005','2004'],
  ['10323609-140','61112012','309, 351, 2429, 2431, 2445'],
  ['10323609-141','61113007','2428'],
  ['10323609-142','61102005','367'],
  ['10323609-143','61102005','354'],
  ['10323609-144','61102005','2764'],
  ['10323609-145','61034203','918'],
  ['10323609-146','61102005','2445'],
  ['10323609-147','61102005','309, 311, 313, 323, 345, 345, 351, 354'],
  ['10323609-148','61103099','319'],
  ['10323609-149','61112012','2838, 2839, 2840, 2841, 2843, 2844, 2987, 2988, 2989, 2992, 2993, 2994'],
  ['10323609-150','62044399','2971, 2978, 2983, 4910, 4914, 4917, 4918, 4920, 4928'],
  ['10323609-151','62093005','2978, 2983'],
  ['10323609-152','61113007','2981, 2985'],
  ['10323609-153','61044203','2981, 2987, 2988, 2989, 2992, 2993, 2994, 4929, 4929, 4933, 4934, 7960, 7962, 7965'],
  ['10323609-154','61044302','2990, 4923, 4926, 4926, 4932, 7959, 7963, 7963, 7964, 7964, 7966, 7966'],
  ['10323609-155','61103099','4001, 4002'],
  ['10323609-156','61044402','4912, 4916'],
  ['10323609-157','62044299','4915'],
  ['10323609-158','62044499','4921, 7961, 7961'],
  ['10323609-159','62034399','7954, 7954, 7955, 7956'],
  ['10323609-160','62045399','7955, 7956'],
  ['10323609-161','62093005','2856'],
  ['10323609-162','62092007','2859, 2862, 2864'],
  ['10323609-163','61112012','2863'],
  ['10323609-164','61044302','2985'],
  ['10323609-165','61113007','2990'],
  ['10323609-166','94049099','19037, 19176, 19196, 19279'],
  ['10323610','95030012','19271, 19272'],
  ['10323611','42022203','10637'],
  ['10323611-1','42029204','19112, 19173, 19175, 19278, 19279, 19796, 19796, 19896'],
  ['10323611-2','42029204','19037'],
  ['10323611-3','42029204','19802'],
  ['10323611-4','42029204','19912'],
  ['10323612','96159099','2772, 2772, 2993, 2993'],
  ['10323612-1','83025001','67920'],
  ['10323612-2','48201002','99901, 99902'],
];

$folios_file = $root . "/pltoolbox/mayoral/resources/TempFiles/items_sin_folio.csv";
$folios_file = fopen($folios_file, "w");

fputcsv($folios_file, ['Linea', 'Fraccion', 'Modelo']);

foreach ($cnt_1_23 as $uva){
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
