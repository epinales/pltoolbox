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
  ['1032197','61123101','1674, 3647'],
  ['1032197-1','61113007','1652, 1674, 1719'],
  ['1032197-2','62093005','1666'],
  ['1032197-3','62111101','6632, 6634'],
  ['1032197-4','61112012','105, 1072, 1073, 1079, 1081, 1082, 1083, 1085, 1086, 1087, 1088, 1089, 1092, 1230, 1231, 1232, 1235, 1298, 1618, 1619, 1620, 1649, 1706, 1707, 1708, 1709, 1710, 1711, 1712, 1714, 1716, 1718, 1795, 1797, 1798, 1814, 1840, 1843, 1976, 1996'],
  ['1032197-5','62099005','1177'],
  ['1032197-6','62092007','1208'],
  ['1032197-7','62063004','3960, 6176, 6179, 6183, 6189'],
  ['1032197-8','61061002','6002, 6006, 6007, 6027, 6277, 6279, 6282, 6550, 6728, 6730'],
  ['1032197-9','61062099','6026, 6028'],
  ['1032197-10','62064091','6180, 6184, 6185, 6187'],
  ['1032197-11','61062099','6029, 6186, 6281'],
  ['1032197-12','61061002','105, 1078, 1079, 1081, 1083, 1085, 1086, 1087, 1088, 1089, 1092, 1229, 1230, 1231, 1232, 1235, 1706, 1707, 1709, 1710, 1711, 1712, 1714, 1716, 1798, 1843, 1976, 1996, 3008, 3014, 3023, 3026, 3212, 3214, 3215, 3216, 3220, 3735, 3961, 6007, 6030, 6277, 6279, 6282, 6550'],
  ['1032197-13','61112012','1078, 1815'],
  ['1032197-14','62069001','1177'],
  ['1032197-15','61062099','3006, 3011, 6026, 6028, 6280'],
  ['1032197-16','62063004','3188, 3190, 3192, 3194, 3561, 3959, 3960, 6177, 6178, 6179, 6183, 6189'],
  ['1032197-17','62064092','3189, 3191, 3195, 3222, 6180, 6184, 6187'],
  ['1032197-18','42022203','5463, 5466'],
  ['1032197-19','63079099','19042, 19270, 19548, 19796, 19864, 19896, 19899, 19900, 19930'],
  ['1032197-20','62092007','1170, 1823, 1825, 1827, 1829, 1831'],
  ['1032197-21','61112012','1298'],
  ['1032197-22','61113007','1618'],
  ['1032197-23','62093005','1819'],
  ['1032197-24','62099005','1960'],
  ['1032197-25','62089903','1960'],
  ['1032197-26','61159501','10007, 10008, 10009, 10011, 10012, 10052, 10053, 10054, 10055, 10056, 10058'],
  ['1032197-27','61112012','9359, 9360, 9361, 9362, 9363, 9364, 9365, 9367, 9368, 10008, 10009, 10011, 10012'],
  ['1032197-28','61113007','9366'],
  ['1032197-29','63079099','19900'],
  ['1032197-30','61112012','106, 1001, 1002, 1003, 1005, 1006, 1007, 1008, 1009, 1011, 1012, 1013, 1014, 1015, 1017, 1075, 1076, 1204, 1205, 1218, 1219, 1640, 1644, 1645, 1652, 1654, 1657, 1668, 1669, 1670 1671, 1672, 1673, 1817'],
  ['1032197-31','61051002','106, 1001, 1002, 1003, 1005, 1006, 1007, 1008, 1009, 1011, 1013, 1014, 1015, 1017, 1668, 1669, 1670, 1671, 1672, 1673'],
  ['1032197-32','62092007','117, 1113, 1114, 1115, 1116, 1117, 1118, 1119, 1121, 1173, 1175, 1213, 1215, 1222, 1251'],
  ['1032197-33','62099005','1174'],
  ['1032197-34','61112012','1566, 1645, 1657'],
  ['1032197-35','61051002','6079'],
  ['1032197-36','62052091','6111, 6112, 6113, 6114, 6115, 6117, 6120, 6122'],
  ['1032197-37','62052092','117, 141, 1113, 1114, 1115, 1116, 1117, 1118, 1119, 1121, 1251, 3116, 3117, 3119, 3120, 3124, 3125, 3126, 3127, 3129, 3130, 3131, 6111, 6112, 6113, 6114, 6115, 6120, 6122'],
  ['1032197-38','61112012','102, 190, 1004, 1016, 1101, 1102, 1103, 1104, 1106, 1107, 1108, 1109, 1111, 1253, 1254'],
  ['1032197-39','61061002','1176'],
  ['1032197-40','61051002','1004, 1016, 6079'],
  ['1032197-41','61051002','890, 6101, 6102, 6103, 6106, 6108, 6109, 6110, 6631'],
  ['1032197-42','61051002','102, 150, 890, 1101, 1102, 1103, 1104, 1106, 1107, 1108, 1109, 1111, 1253, 1254, 3101, 3102, 3103, 3104, 3105, 3106, 3108, 3109, 3111, 3112, 3113, 3114, 3245, 3640, 6101, 6102, 6103, 6104, 6106, 6108, 6109, 6110'],
  ['1032197-43','61112012','1228'],
  ['1032197-44','61099004','6281'],
  ['1032197-45','61091003','3025, 3218, 3219, 3221, 6027'],
  ['1032197-46','61091003','6083'],
  ['1032197-47','61112012','306, 318, 325,  1330, 1332, 1335, 1344, 1345, 1795'],
  ['1032197-48','61113007','1331'],
  ['1032197-49','61119005','1336, 1337'],
  ['1032197-50','61102005','332, 6319'],
  ['1032197-51','61102005','306, 320, 321, 332, 1335, 1706, 1710, 6319'],
  ['1032197-52','61103099','1336, 1337, 3325, 6318'],
  ['1032197-53','61102005','1345, 3332'],
  ['1032197-54','62114202','3326'],
  ['1032197-55','61112012','1408, 1410, 1411, 1817, 1843, 1845, 1846'],
  ['1032197-56','62093005','1415'],
  ['1032197-57','62019299','6481'],
  ['1032197-58','61012003','6483, 6485, 6486'],
  ['1032197-59','62019399','6490'],
  ['1032197-60','62029399','6468, 6472'],
  ['1032197-61','61022003','6471'],
  ['1032197-62','62029399','3483'],
  ['1032197-63','62029299','1482, 3478, 3479, 6470'],
  ['1032197-64','61022003','1843, 3481, 3825'],
  ['1032197-65','62029399','3484, 6468'],
  ['1032197-66','61012003','1408, 1410, 1411, 1845, 1846, 3334, 3410, 3411, 3412, 3413, 3827, 3828, 3829, 6321'],
  ['1032197-67','62019399','1415, 3415, 3419'],
  ['1032197-68','62019299','3407, 6481'],
  ['1032197-69','61112012','1478'],
  ['1032197-70','62092007','1482'],
  ['1032197-71','61033201','3406'],
  ['1032197-72','62029299','6470'],
  ['1032197-73','62021901','6173'],
  ['1032197-74','62171001','1235, 1985, 3022, 3954'],
  ['1032197-75','62171001','234, 275, 1238, 1576, 1582, 1963, 1971, 3204, 3210, 3552, 3574, 3821, 3922, 5012, 5025, 5027, 5045, 6922, 10073, 10074'],
  ['1032197-76','62093005','1238, 1576, 1582, 1963'],
  ['1032197-77','62092007','1971'],
  ['1032197-78','62152001','10087'],
  ['1032197-79','62093005','1175, 9388'],
  ['1032197-80','62092007','1235'],
  ['1032197-81','61112012','1641, 1814, 9384, 9385'],
  ['1032197-82','61113007','1791, 1985, 9383, 10029'],
  ['1032197-83','62092007','1814'],
  ['1032197-84','62045203','3910, 6914'],
  ['1032197-85','62045203','3909, 3910'],
  ['1032197-86','62045203','6911'],
  ['1032197-87','61045903','6913'],
  ['1032197-88','62045203','3908, 6911'],
  ['1032197-89','61045903','6913'],
  ['1032197-90','62092007','1208, 1815, 1953'],
  ['1032197-91','62093005','1996'],
  ['1032197-92','62045399','3907, 6901, 6908'],
  ['1032197-93','61045302','6902'],
  ['1032197-94','62045203','6903, 6904, 6907'],
  ['1032197-95','62045203','1953, 3904, 3959, 6903, 6904, 6907'],
  ['1032197-96','62045399','1996, 3901, 3960, 6901, 6908'],
  ['1032197-97','61045302','3739, 3903, 3961, 6902'],
  ['1032197-98','61045201','6906'],
  ['1032197-99','62045906','6910'],
  ['1032197-100','62021399','5327'],
  ['1032197-101','65050004','9378, 9379, 9380, 10020, 10023, 10024, 10025, 10061, 10064, 10065, 10066'],
  ['1032197-102','65050004','1170, 1618, 1632, 1666, 9371, 9372, 9375, 9380, 10015, 10016, 10017, 10035, 19916'],
  ['1032197-103','61112012','19916'],
  ['1032197-104','61112012','1842'],
  ['1032197-105','62114302','3821, 6816, 6819'],
  ['1032197-106','61143002','6817, 6818'],
  ['1032197-107','62114901','6820'],
  ['1032197-108','62114302','3821, 6816, 6819'],
  ['1032197-109','62114901','6820'],
  ['1032197-110','61142001','1842, 3824'],
  ['1032197-111','61143002','3822, 6817, 6818'],
  ['1032197-112','62092007','1602'],
  ['1032197-113','61112012','1603, 1604, 1608, 1612, 1615, 1623, 1625, 1628, 1630, 1632, 1633, 1634'],
  ['1032197-114','63013001','9852, 9853, 9858'],
  ['1032197-115','63014001','9853, 19033'],
  ['1032197-116','61112012','1619, 1640'],
  ['1032197-117','62092007','1650, 1654, 1663, 1664, 1840'],
  ['1032197-118','62046209','3635'],
  ['1032197-119','62046999','6622'],
  ['1032197-120','62046209','3635'],
  ['1032197-121','62034202','1663, 1664'],
  ['1032197-122','62034202','1663'],
  ['1032197-123','61046203','1228'],
  ['1032197-124','62046209','235, 236, 1225, 3210, 6273'],
  ['1032197-125','62034291','252, 6293, 6296'],
  ['1032197-126','62046209','235, 6273'],
  ['1032197-127','62034292','203, 237, 252, 1241, 3230, 3232, 3239, 6293, 6296'],
  ['1032197-128','62092007','203, 206, 1205, 1213, 1215, 1218, 1219, 1225, 1235, 1238, 1239, 1240, 1241, 1243, 1245, 1246, 1247, 1251, 1253, 1254'],
  ['1032197-129','61112012','621, 1204, 1206, 1212, 1227, 1228, 1230, 1231, 1232, 1620, 1620, 1644, 1645, 1649, 1657, 1668, 1669, 1670, 1671, 1672, 1673, 1845, 1846'],
  ['1032197-130','62034291','231, 6283,  6289,  6292'],
  ['1032197-131','61034203','600, 6623, 6624, 6625, 6626, 6627, 6629, 6630'],
  ['1032197-132','62046209','275, 6270'],
  ['1032197-133','62046391','6274'],
  ['1032197-134','61046203','6276, 6277, 6278, 6280, 6281, 6282'],
  ['1032197-135','61046399','6279'],
  ['1032197-136','62046392','3203, 3222, 6274'],
  ['1032197-137','62046209','3204, 3208'],
  ['1032197-138','62034292','1253'],
  ['1032197-139','61034203','6631'],
  ['1032197-140','62046209','234, 275, 1235, 3201, 3207, 3209, 6268, 6270'],
  ['1032197-141','61046203','607, 723, 1227, 1229, 1230, 1231, 1232, 3202, 3212, 3213, 3214, 3215, 3216, 3218, 3219, 3220, 3560, 3732, 3734, 3735, 3737, 3741, 6276, 6277, 6278, 6279, 6280, 6281, 6282'],
  ['1032197-142','62046999','1226'],
  ['1032197-143','62046392','3221'],
  ['1032197-144','61046399','3739, 3740'],
  ['1032197-145','62034292','202, 204, 206, 231, 1238, 1239, 1240, 1243, 1245, 1246, 1247, 1251, 1254, 3223, 3224, 3226, 3228, 3229, 3234, 3236, 3238, 3241, 3245, 6283, 6287, 6289, 6292'],
  ['1032197-146','61034203','600, 611, 621, 1249, 1668, 1669, 1670, 1671, 1672, 1673, 1845, 1846, 3638, 3639, 3640, 3641, 3642, 3643, 3644, 3645, 3646, 3827, 3829, 6285, 6623, 6624, 6625, 6626, 6627, 6629, 6630'],
  ['1032197-147','61034399','3240'],
  ['1032197-148','61046203','1843, 6728'],
  ['1032197-149','61046399','3740, 6267, 6730'],
  ['1032197-150','62034292','506, 509, 512, 520, 1579, 1580, 1581, 1582, 1587, 3564, 3568, 3569, 3574, 6557'],
  ['1032197-151','62046209','6542, 6545, 6549'],
  ['1032197-152','62092007','500, 506, 596, 1577, 1578, 1579, 1580, 1581, 1582, 1584, 1585, 1586, 1587, 1794'],
  ['1032197-153','61112012','550, 706, 711, 1569, 1572, 1704, 1705, 1706, 1707, 1708, 1709, 1710, 1711, 1712, 1714, 1716, 1718, 1793, 1795, 1797, 1798, 1817, 1843, 1845, 1846'],
  ['1032197-154','61113007','1573'],
  ['1032197-155','62034291','520, 6556, 6557'],
  ['1032197-156','61034203','744, 6823'],
  ['1032197-157','61046203','724, 752, 6548, 6550, 6728, 6729'],
  ['1032197-158','61046399','1573, 6730'],
  ['1032197-159','62046999','1574, 3561, 6541, 6544'],
  ['1032197-160','62046209','3551, 6266, 6546'],
  ['1032197-161','61046399','748'],
  ['1032197-162','62046392','3553, 3558'],
  ['1032197-163','61034203','600, 6623, 6624, 6625, 6626, 6627, 6629, 6630'],
  ['1032197-164','62034292','6289, 6292'],
  ['1032197-165','61046203','550, 723, 724, 748, 752, 1704, 1705, 1706, 1707, 1708, 1709, 1710, 1711, 1712, 1714, 1716, 1798, 3555, 3560, 3732, 3733, 3734, 3735, 3736, 3737, 3738, 3741, 3825, 3825, 6548, 6550, 6729'],
  ['1032197-166','62046999','1576, 3552, 6541, 6544'],
  ['1032197-167','62046209','1577, 1578, 3556, 3557, 6542, 6545, 6549'],
  ['1032197-168','62046392','3549'],
  ['1032197-169','62034292','500, 515, 540, 1584, 1585, 1586, 3567, 3570, 3572, 6556, 6558'],
  ['1032197-170','61034203','711, 742, 744, 1845, 1846, 3827, 3828, 3829, 6823'],
  ['1032197-171','61112012','1561, 1566'],
  ['1032197-172','62099005','1222, 1226, 1574, 1576'],
  ['1032197-173','62046999','3206, 6269, 6272, 6297'],
  ['1032197-174','61113007','9353, 9355, 9356'],
  ['1032197-175','61112012','10004'],
  ['1032197-176','61152901','10004'],
  ['1032197-177','61152101','5444, 10048, 10049'],
  ['1032197-178','61112012','168, 191, 1651, 1651, 1702, 1789, 1790, 1791, 1792'],
  ['1032197-179','65040001','5468, 10080'],
  ['1032197-180','61102005','6823'],
  ['1032197-181','61102005','6466'],
  ['1032197-182','61103099','6467'],
  ['1032197-183','61102005','3476'],
  ['1032197-184','61102005','3403'],
  ['1032197-185','61103099','6316'],
  ['1032197-186','61112012','303, 1333, 1338, 1339, 1340, 1706, 1710'],
  ['1032197-187','61102005','6321'],
  ['1032197-188','61103099','6318'],
  ['1032197-189','61102005','6318'],
  ['1032197-190','61103099','3325, 6318, 6320'],
  ['1032197-191','61102005','6318'],
  ['1032197-192','61102005','303, 311, 1338, 1339, 1340, 3328, 3329'],
  ['1032197-193','62093005','10032'],
  ['1032197-194','63026006','9917, 9918, 9926'],
  ['1032197-195','62111101','1666, 3648, 3649, 3650, 6632, 6634'],
  ['1032197-196','61091003','170, 840, 1668, 1672, 3029, 3030, 3031, 3032, 3033, 3034, 3035, 3036, 3037, 3038, 3039, 3040, 3042, 3043, 3044, 3045,  3046, 3048, 3049, 3050, 3050, 3052, 3053, 3055, 3056, 3638, 3639, 3639, 3641, 3642, 3643, 3644, 3645, 3646, 6075, 6076, 6077, 6078, 6080, 6081, 6082, 60'],
  ['1032197-197','61091003','840, 6075, 6076, 6077, 6078, 6080, 6081, 6082, 6083, 6084, 6086, 6087, 6088, 6089, 6090, 6091, 6092, 6093, 6094, 6095, 6623, 6624, 6625, 6626, 6627, 6629, 6630'],
  ['1032197-198','61091003','854, 6004, 6008, 6009, 6013, 6014, 6016, 6018, 6020, 6021, 6022, 6023, 6024, 6278, 6729'],
  ['1032197-199','61099004','3010, 3739, 6001, 6005, 6011, 6017, 6019'],
  ['1032197-200','61091003','174, 854, 1228, 3001, 3002, 3003, 3004, 3005, 3007, 3009, 3009, 3013, 3016, 3019, 3020, 3022, 3024, 3077, 3213, 3734, 3736, 3737, 3738, 3740, 3741, 6002, 6003, 6004, 6006, 6009, 6013, 6015, 6016, 6018, 6020, 6021, 6022, 6023, 6024, 6278, 6931'],
  ['1032197-201','61099004','3010, 3015, 3017, 3739, 6001, 6005, 6008, 6011, 6017, 6019'],
  ['1032197-202','62092007','1170, 1641, 1805, 1823, 1824, 1825, 1827, 1829, 1831, 1959, 1965, 1966, 1971, 1973, 1982, 1990'],
  ['1032197-203','61112012','1561, 1801, 1804, 1811, 1812, 1836, 1838, 1969, 1976, 1983, 1992, 1993, 1995'],
  ['1032197-204','62093005','1819, 1828, 1963, 1970, 1974, 1986'],
  ['1032197-205','62099005','1960'],
  ['1032197-206','61113007','1985'],
  ['1032197-207','62044399','5036, 6915, 6942'],
  ['1032197-208','62044499','6922, 6924, 6926, 6935, 6938'],
  ['1032197-209','61044302','6923'],
  ['1032197-210','62044299','6925, 6930, 6933, 6940, 6941, 6945, 6947'],
  ['1032197-211','61044203','6949'],
  ['1032197-212','61044402','3966'],
  ['1032197-213','62044399','5022, 5025, 5026, 5027, 5035, 5036, 5037, 5045'],
  ['1032197-214','62044399','1957, 1963, 1970, 1974, 1986, 3915, 3920, 3923, 3924, 3928, 3937, 3944, 5003, 5010, 6915'],
  ['1032197-215','62044299','1959, 1965, 1966, 1971, 1973, 1982, 1990, 3917, 3918, 3919, 3922, 3929, 3933, 3935, 3939, 3954, 5012, 6925, 6933, 6940, 6941, 6945, 6946, 6947'],
  ['1032197-216','62044902','1960, 3925'],
  ['1032197-217','61044203','1969, 1975, 1976, 1983, 1992, 1993, 1995, 3560, 3952, 3953, 3955, 3956, 3958, 6927, 6949'],
  ['1032197-218','61044302','1985, 3916, 3938, 6923, 6931'],
  ['1032197-219','62044499','3932, 3934, 3949, 6924, 6926, 6935'],
  ['1032197-220','62044299','6930'],
  ['1032198','39262099','1225, 1225, 1577, 3201, 3904, 6545, 6907, 6942'],
  ['1032198-1','96151101','5454, 5456, 5458, 5459, 10070'],
  ['1032198-2','48205001','19195'],
  ['1032199','42022203','5465, 19042, 19270, 19548, 19796, 19864, 19896, 19899, 19900, 19901, 19930'],
  ['1032199-1','42021203','19046, 19905'],
  ['1032199-2','42029204','19270, 19548, 19796, 19864, 19900'],
  ['1032199-3','42029204','19802'],
  ['1032199-4','42029204','19817'],
];

$folios_file = $root . "/pltoolbox/mayoral/resources/TempFiles/items_sin_folios_cont_1.csv";
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
    $item[10],                                              //Fraccion
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
  if (  array_key_exists($item[10] . $item[11], $precios_estimados)) {
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

  //Si la fracción pertenece al Anexo 30, agrega el identificador MC correspondiene, o arroja una alerta, si no encuentra que MC poner.
  if (in_array($item[10].$item[11], $anexo30)) {
    if ($marca == "NUKUTAVAKE") {
      $identificadores[$numero_parte . "_" . $i]['identificadores']['MC'] = array($numero_parte, 'MC', '2', '1', '1');
    } elseif ($marca == "MAYORAL Y DISENO" ||$marca == "ABEL & LULA Y DISENO" ||$item[10] == 39262099) {
      $identificadores[$numero_parte . "_" . $i]['identificadores']['MC'] = array($numero_parte, 'MC', '2', '1', '4');
    } elseif ($capitulo == 42) {
      $identificadores[$numero_parte . "_" . $i]['identificadores']['MC'] = array($numero_parte, 'MC', '4', '4');
    } else {
      $advertencias[$numero_parte . "_" . $i] = "No se encontró que identificador aplicar. Marca: $marca";
    }
  }

  $nico = $item[10] . $item[11];

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

?>
