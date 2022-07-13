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

$muestrario = [
  ['10322780','63079099','99953'],
  ['10322780-1','58071001','99904'],
  ['10322780-2','62093005','9633'],
  ['10322780-3','62093005','5001, 5002, 5003, 5009, 5010, 5012, 5013, 5014, 5016, 5017, 5018, 5019, 5020'],
  ['10322780-4','62092007','5001'],
  ['10322780-5','62093005','5002, 5005, 5011, 5013, 5015, 5016, 5017'],
  ['10322780-6','62099005','5004'],
  ['10322780-7','61113007','5005, 5006, 5008, 5011'],
  ['10322780-8','61113007','5005, 5006, 5011'],
  ['10322780-9','62092007','5007, 5015'],
  ['10322780-10','62092007','5015'],
  ['10322780-11','62045399','5021'],
  ['10322780-12','62044399','5022, 5023, 5024, 5026, 5027, 5028, 5029, 5030, 5031, 5032, 5033, 5035, 5036, 5037, 5038, 5039, 5041, 5042, 5043, 5044, 5045, 5046, 5047, 5048, 5049, 5050, 5051, 5052, 5053, 5054, 5055, 5056, 5057, 5058, 5059'],
  ['10322780-13','62171001','5022, 5023, 5024, 5025, 5027, 5028, 5030, 5032, 5033, 5035, 5036, 5037, 5039, 5041, 5043, 5044, 5045, 5047, 5049, 5051, 5053, 5059, 5232, 5235'],
  ['10322780-14','62044299','5025, 5040'],
  ['10322780-15','62044902','5034'],
  ['10322780-16','62092007','5118, 5119, 5120, 5122, 5227'],
  ['10322780-17','62099005','5121, 5123, 5228, 5229'],
  ['10322780-18','62064092','5124, 5129, 5133'],
  ['10322780-19','62063004','5124'],
  ['10322780-20','62064092','5125, 5130, 5132'],
  ['10322780-21','61061002','5126'],
  ['10322780-22','61091003','5127'],
  ['10322780-23','62063004','5128'],
  ['10322780-24','62063004','5131'],
  ['10322780-25','62092007','5224, 5228, 5229'],
  ['10322780-26','62099005','5225, 5227'],
  ['10322780-27','62092007','5226'],
  ['10322780-28','62093005','5227, 5453'],
  ['10322780-29','62092007','5228'],
  ['10322780-30','62046392','5230'],
  ['10322780-31','62045203','5231'],
  ['10322780-32','62114302','5232, 5234, 5235, 5236, 5237, 5238, 5239, 5240, 5241'],
  ['10322780-33','62114302','5233'],
  ['10322780-34','62046392','5242, 5243, 5244, 5245'],
  ['10322780-35','61112012','5344, 5345, 5349'],
  ['10322780-36','62099005','5346, 5347'],
  ['10322780-37','61119005','5348'],
  ['10322780-38','61103099','5350, 5351, 5352, 5353'],
  ['10322780-39','62029399','5354'],
  ['10322780-40','62029299','5355, 5356, 5357'],
  ['10322780-41','61113007','5424'],
  ['10322780-42','61152101','5425'],
  ['10322780-43','61112012','5426, 5427, 5428'],
  ['10322780-44','61159501','5429'],
  ['10322780-45','62093005','5443, 5444'],
  ['10322780-46','62093005','5445'],
  ['10322780-47','63079099','99956'],
  ['10322780-48','42022203','5447, 5449'],
  ['10322780-49','61112012','102, 190, 1101, 1102, 1103, 1104, 1105, 1106, 1107, 1108, 1109, 1191, 1296'],
  ['10322780-50','61112012','105, 1004, 1005, 1006, 1007, 1008, 1009, 1010, 1011, 1012, 1013, 1014, 1015,1097, 1248, 1249, 1250, 1251, 1276, 1277,1278, 1279, 1281, 1282, 1501, 1502, 1503, 1607, 1608,1609,1610, 1692, 1694,1695,1696, 1744,1745, 1746, 1763, 1770, 1774, 1'],
  ['10322780-51','61112012','106, 1001, 1002,1003, 1016, 1017, 1018, 1019, 1020, 1021,1022,1023, 1024, 1025, 1026, 1027, 1028, 1029, 1030, 1032,1098, 1253, 1254, 1266, 1267, 1268, 1506, 1508, 1618,1619, 1621,1622,1623, 1624, 1625, 1626, 1627, 1628, 1629, 1639, 1'],
  ['10322780-52','62092007','117, 1110, 1112, 1113, 1114, 1115, 1116, 1117, 1118, 1189, 1190, 1252, 1263, 1265, 1295, 1297, 1527'],
  ['10322780-53','61051002','150, 890, 3147, 3148, 3149, 3150, 3151, 3152, 3153, 3154, 3155, 3156, 3157, 3158, 3241, 6101, 6102, 6103, 6104, 6105, 6106, 6107, 6108, 6109'],
  ['10322780-54','61112012','168, 191, 1601, 1602, 1603, 1604, 1614, 1615, 1616, 1617, 1691, 1732, 1733, 1734, 1736,1737,1738, 1739, 1740,1741, 1742,1743, 1747, 1748, 1749, 1750, 1751,1752,1753, 1754, 1755, 1757,1759, 1760,1766, 1767,1768, 17'],
  ['10322780-55','61091003','170, 840, 3001, 3002, 3003, 3004, 3005, 3006, 3007, 3008,3009, 3010, 3011, 3012, 3013, 3014, 3015, 3016, 3017, 3018, 3019, 3020, 3021, 3022,3023, 3024, 3025, 3026, 3027, 3028, 3672, 3673, 3674, 3675, 3676, 3677,3678, 3679, 3680, 3681, 3794, 3795, 3796, 3853, 6068, 60'],
  ['10322780-56','61061002','174'],
  ['10322780-57','62092007','201, 206, 207, 220, 1252, 1253, 1256, 1265, 1266, 1268, 1269, 1270, 1275, 1281, 1282, 1284, 1285, 1286, 1288, 1289, 1291, 1295, 1296, 1297'],
  ['10322780-58','62034292','202, 204, 231, 242, 3220, 3221, 3223, 3224, 3225, 3227, 3229, 3230, 3232, 3233, 3234, 3235, 3239, 3240, 3241, 3242, 6249, 6250, 6251, 6253, 6254, 6256, 6257, 6258, 6261, 6262'],
  ['10322780-59','62046209','234, 235, 236, 275, 3201, 3204, 3205, 3206, 3207, 3209, 6237, 6239'],
  ['10322780-60','62092007','234, 275, 1261, 3209, 3503, 3506, 3509, 3911, 10489'],
  ['10322780-61','62034292','237, 252, 3236, 6252'],
  ['10322780-62','61112012','303, 1362, 1364, 1368, 1369, 1370, 1509'],
  ['10322780-63','61112012','306, 318, 1359, 1360, 1363, 1366, 1374, 1505, 1774, 1897'],
  ['10322780-64','61102005','311, 3347, 3348, 6332, 6333, 6440'],
  ['10322780-65','61102005','320, 321, 332, 3345'],
  ['10322780-66','62092007','506, 507, 522, 535, 595, 596, 1510, 1514, 1515, 1517, 1518, 1519, 1521, 1522, 1523, 1524, 1527, 1762'],
  ['10322780-67','62034292','509, 512, 520, 530, 538, 543, 3512, 3513, 3514, 3515, 3517, 3518, 3519, 3521, 3522, 6588, 6589, 6591, 6592, 6594, 6596, 6597'],
  ['10322780-68','62046209','548, 554, 3502, 3506, 3508, 3510, 6579'],
  ['10322780-69','61112012','550, 703, 706, 711, 1501, 1502, 1503, 1504, 1505, 1506, 1508, 1509, 1511, 1512, 1520, 1525, 1526, 1623, 1744,1745, 1746, 1761,1763,1771, 1772, 1773, 1774, 1775, 1777, 1778, 1779, 1780, 1781, 1782, 1783, 1787, 1810, 1832, 1833, 1834, 1835, 1890, 1891, 1892, 1897, 9290'],
  ['10322780-70','61034203','600, 611, 3222, 3226, 3231, 3238, 3672, 3673, 3674, 3675, 3676, 3677, 3678, 3679, 3680, 3681, 3774, 3795, 3796, 3854, 6255, 6259, 6260, 6651, 6652, 6653, 6654, 6655, 6656, 6657, 6658, 6659, 6660'],
  ['10322780-71','61112012','603, 621, 1250, 1254, 1255,1258, 1259, 1260, 1267, 1273,1276, 1277, 1278, 1279, 1287, 1292, 1293, 1294, 1609, 1610,1619,1620,1621,1622,1629,1644, 1645, 1646, 1647, 1648, 1649, 1695,1696,1770, 1788, 1789, 1834, 1835'],
  ['10322780-72','61046203','607, 3208, 3210,3213, 3215, 3216, 3217, 3218, 3219, 6240, 6242, 6245, 6246, 6247'],
  ['10322780-73','61046203','610, 723, 724, 748, 752, 3504, 3511, 3776, 3777, 3778, 3779, 3781,3782, 3783, 3784, 3785, 3786,3787, 3849, 3850, 3851, 6234, 6581, 6587, 6749, 6750, 6751, 6851'],
  ['10322780-74','61034203','742, 744, 3516, 3520, 3794, 3852, 3853, 3854, 6590, 6593, 6595'],
  ['10322780-75','61091003','854'],
  ['10322780-76','61113007','1031'],
  ['10322780-77','61112012','1033, 1641, 1644, 1648, 1788, 1833'],
  ['10322780-78','61112012','1115'],
  ['10322780-79','62093005','1190, 10436'],
  ['10322780-80','62092007','1192, 1256'],
  ['10322780-81','62092007','1193, 1804, 1811, 1817, 1818, 1824, 1825, 1827, 1957, 1958, 1961, 1962'],
  ['10322780-82','61112012','1248, 1251, 1694, 1975, 9579, 9617'],
  ['10322780-83','62092007','1249, 1804, 1811, 1813, 1815, 1817, 1818, 1824, 1961'],
  ['10322780-84','62099005','1261, 1262, 1264'],
  ['10322780-85','62099005','1261, 1262, 1263, 1264, 1271, 1272, 1274, 1283, 1290'],
  ['10322780-86','62092007','1275'],
  ['10322780-87','61112012','1279, 1602, 1603, 1606, 1691, 1746, 1822, 1972, 9613'],
  ['10322780-88','62093005','1280'],
  ['10322780-89','62093005','1280'],
  ['10322780-90','62099005','1283'],
  ['10322780-91','61112012','1359, 9588, 9589, 9590, 9591,  9592,  9595, 9596, 9617, 10395, 10396, 10397, 10398, 10399,10400,10401,10403'],
  ['10322780-92','61119005','1361'],
  ['10322780-93','62093005','1367, 1372'],
  ['10322780-94','62092007','1371'],
  ['10322780-95','61112012','1373, 1375, 1403, 1405, 1406, 1409, 1414, 1415, 1416, 1420, 1421, 1422, 1424, 1833, 1834, 1835'],
  ['10322780-96','62093005','1401, 1404, 1410, 1411, 1412, 1425, 1427, 1428'],
  ['10322780-97','61112012','1402, 1418'],
  ['10322780-98','62092007','1407, 1408, 1413, 1419, 1426'],
  ['10322780-99','62092007','1417'],
  ['10322780-100','61113007','1423'],
  ['10322780-101','61112012','1504, 1801, 1803, 1805, 1806, 1807, 1822, 1823, 1826, 1953, 1954, 1964, 1965, 1968, 1969, 1970, 1971, 1972, 1974, 1975, 1976, 1977'],
  ['10322780-102','65050004','1505, 1509, 1604, 1605, 1607, 1613, 1614, 1615, 1617, 1626, 1632, 1640, 1692, 1764, 9290, 9291, 9599, 9600, 9602, 9603, 9604, 9617, 10406, 10407, 10408, 10409, 10410, 10474, 10475'],
  ['10322780-103','61119005','1513'],
  ['10322780-104','62099005','1516'],
  ['10322780-105','61112012','1605, 1606, 1608, 1618, 1637, 1638, 1643, 1808'],
  ['10322780-106','62092007','1607, 1626, 1627, 1628, 1634, 1635, 1636, 1693'],
  ['10322780-107','62099005','1611, 1689'],
  ['10322780-108','62092007','1612'],
  ['10322780-109','62092007','1613, 1690, 1765'],
  ['10322780-110','61112012','1620, 1620'],
  ['10322780-111','61113007','1624, 1631, 1632, 1633, 1641, 1650, 1692, 1764, 1784, 1785, 1786'],
  ['10322780-112','62099005','1625'],
  ['10322780-113','61113007','1631'],
  ['10322780-114','62093005','1639, 1640, 1642'],
  ['10322780-115','65050004','1642, 6653, 9601, 9607, 9608, 9609, 10413, 10414, 10415, 10416, 10417, 10478, 10479, 10480, 10481, 10482, 10506'],
  ['10322780-116','61112012','1744, 1778, 1779, 1810, 1832, 1890, 1891, 1892'],
  ['10322780-117','61112012','1752, 9261,  9262, 9263, 9264,9291'],
  ['10322780-118','61113007','1784, 1978'],
  ['10322780-119','62092007','1804'],
  ['10322780-120','61113007','1809'],
  ['10322780-121','62093005','1813, 1815, 1816, 1819, 1946, 1948, 1949, 1950, 1960'],
  ['10322780-122','62099005','1814, 1820, 1821, 1955, 1963'],
  ['10322780-123','62099005','1814, 1820, 1821, 1963'],
  ['10322780-124','62093005','1816, 1819'],
  ['10322780-125','62092007','1830, 1831, 1979, 1980'],
  ['10322780-126','62099005','1893, 1894, 1895'],
  ['10322780-127','61112012','1896'],
  ['10322780-128','61113007','1952'],
  ['10322780-129','61091003','3054, 3055, 3056, 3057, 3058, 3060, 3061, 3062, 3063, 3064, 3067,3068, 3069, 3070, 3071, 3072, 3073, 3074, 3075, 3076, 3213, 3215, 3774, 3779, 3781, 3782, 3783, 3784, 3787, 3850, 3949, 3950, 3951, 6043, 6044, 6046, 6047, 6048, 6050, 6052, 6055, 6058, 6060, 6062, 6066, 6244, 6247, 6750'],
  ['10322780-130','61061002','3059, 3065, 3066, 3214, 3216, 3217, 3218, 3219, 3511, 3785, 3951, 6049, 6057, 6059, 6061, 6063, 6088, 6245, 6246, 6749'],
  ['10322780-131','61178002','3063, 3941'],
  ['10322780-132','62171001','3072'],
  ['10322780-133','61061002','3077'],
  ['10322780-134','62064092','3136, 3137, 3144'],
  ['10322780-135','62063004','3138, 3139, 3140, 3141, 3142, 3143, 3146, 3510, 6191, 6193, 6194, 6196, 6197, 6198'],
  ['10322780-136','62052092','3159, 3160, 3161, 3162, 3163, 3164, 3165, 3166, 3167, 3168, 3169, 3170, 3171, 3240, 3242, 6111, 6112, 6113, 6115, 6116, 6117, 6118, 6119'],
  ['10322780-137','62046392','3202, 6235'],
  ['10322780-138','62046999','3203, 6236'],
  ['10322780-139','61062099','3211, 6243, 6936'],
  ['10322780-140','61046399','3211, 3214, 6241'],
  ['10322780-141','62034901','3237'],
  ['10322780-142','61103099','3344, 3346, 6329, 6330'],
  ['10322780-143','62113202','3349, 6334'],
  ['10322780-144','62019399','3350, 6335'],
  ['10322780-145','61102005','3351, 3447, 3448, 3450, 3454, 3455, 3456, 3457, 6441, 6442, 6443, 6448, 6450'],
  ['10322780-146','61102005','3352, 6336'],
  ['10322780-147','61102005','3435, 3436, 3441, 3442, 3849, 3850, 3851, 6436'],
  ['10322780-149','62029299','3439, 3440, 6433'],
  ['10322780-150','62029399','3443, 3444, 3445, 6438, 6439'],
  ['10322780-151','62021299','3446'],
  ['10322780-152','61103099','3449'],
  ['10322780-153','62019299','3451, 3452, 3453, 3461, 6444, 6445, 6446, 6452'],
  ['10322780-154','61012003','3458, 3852, 3853, 3854, 6447'],
  ['10322780-155','61013099','3459'],
  ['10322780-156','62019399','3460, 3462, 3463, 3464, 3465, 3466, 3467, 6451'],
  ['10322780-157','61046399','3501, 6585, 6586, 6748'],
  ['10322780-158','62046999','3503, 6582, 6583'],
  ['10322780-159','62046999','3505'],
  ['10322780-160','62046209','3509, 6580, 6584'],
  ['10322780-161','61123101','3682, 3683'],
  ['10322780-162','62111101','3684, 3685, 3686, 3687, 6661, 6662, 6663, 6664'],
  ['10322780-163','61083103','3773, 3775'],
  ['10322780-164','61061002','3786'],
  ['10322780-165','62114302','3842, 3843, 3844, 3846, 6840, 6841, 6843'],
  ['10322780-166','62114202','3845, 3847'],
  ['10322780-167','61142001','3848, 6850'],
  ['10322780-168','62045203','3902, 3903, 3904, 6902, 6904'],
  ['10322780-169','61045201','3905, 3951'],
  ['10322780-170','62045203','3906, 3908, 6905, 6907'],
  ['10322780-171','62045906','3907, 6906'],
  ['10322780-172','62044399','3911, 3914, 3919, 3920, 3923, 6909, 6913, 6915, 6916, 6920'],
  ['10322780-173','62044499','3912, 3939, 3940, 6910, 6928, 6930'],
  ['10322780-174','62171001','3912'],
  ['10322780-175','62044299','3915, 3916, 3917, 3921, 3926, 3928, 3929, 3930, 3932, 3938, 3941, 6914, 6919, 6921, 6922, 6924, 6929'],
  ['10322780-176','62044902','3922'],
  ['10322780-177','62044299','3924, 6923, 6926'],
  ['10322780-178','61044203','3933, 3935, 3942, 3943, 3944, 3945, 3946, 3947, 3948, 6848, 6931, 6933, 6935'],
  ['10322780-179','61044302','3934, 6911, 6920, 6932, 6934'],
  ['10322780-180','61045302','3949, 3950, 6901, 6936'],
  ['10322780-181','61099004','6045, 6051, 6054, 6066'],
  ['10322780-182','61142001','6053, 6056, 6751'],
  ['10322780-183','62064092','6064, 6067'],
  ['10322780-184','62063004','6065'],
  ['10322780-185','61091003','6071, 6074, 6076, 6078, 6081, 6083, 6084, 6086, 6087, 6651, 6652, 6653, 6656'],
  ['10322780-186','62053092','6110'],
  ['10322780-187','62052091','6114'],
  ['10322780-188','62064091','6192'],
  ['10322780-189','61046903','6243'],
  ['10322780-190','61046203','6244'],
  ['10322780-191','62034392','6248'],
  ['10322780-192','61103099','6331, 6435'],
  ['10322780-193','61102005','6428, 6429'],
  ['10322780-194','61103099','6430'],
  ['10322780-195','62029299','6431'],
  ['10322780-196','61103099','6437'],
  ['10322780-197','61013099','6449'],
  ['10322780-198','62019399','6453, 6454'],
  ['10322780-199','61046903','6577'],
  ['10322780-200','62046392','6578'],
  ['10322780-201','61102005','6587, 6851'],
  ['10322780-202','62046999','6650'],
  ['10322780-203','61102005','6652'],
  ['10322780-204','62114302','6842'],
  ['10322780-205','62114202','6844'],
  ['10322780-206','61143002','6846'],
  ['10322780-207','61143002','6847'],
  ['10322780-208','61142001','6849'],
  ['10322780-209','62045399','6903'],
  ['10322780-210','63014001','9240'],
  ['10322780-211','63013001','9241, 9246, 9247'],
  ['10322780-212','63013001','9249, 9250'],
  ['10322780-213','63026006','9302, 9303, 9306, 9307, 9308, 9309, 10439, 10440, 10502, 10503'],
  ['10322780-214','63023106','9312'],
  ['10322780-215','63023106','9312'],
  ['10322780-216','63022101','9312'],
  ['10322780-217','61113007','9582, 9583, 9584, 10390, 10391, 10392'],
  ['10322780-218','61113007','9582, 9614'],
  ['10322780-219','61119005',' 9587, 9593'],
  ['10322780-220','61113007','9594, 10402'],
  ['10322780-221','62093005','9612'],
  ['10322780-222','61112012','9641'],
  ['10322780-223','62093005','10427'],
  ['10322780-224','42029204','10430, 10496, 10514, 19282, 19283'],
  ['10322780-225','65040001','10433, 10499'],
  ['10322780-226','62121007','10444'],
  ['10322780-227','61071103','10447, 10450,10451'],
  ['10322780-228','62089101','10454, 10455'],
  ['10322780-229','61152201','10458, 10459, 10460'],
  ['10322780-230','61159501','10463, 10464, 10465, 10466, 10467, 10469, 10470, 10471'],
  ['10322780-231','61159601','10468'],
  ['10322780-232','42029204','10509'],
  ['10322780-233','63079099','19237'],
  ['10322780-234','63013001','19253'],
  ['10322780-235','63019001','19258'],
  ['10322780-236','63079099','99903, 99904'],
  ['10322780-237','63079099','99950, 99951, 99952'],
  ['10322780-238','42022203','3947, 10511, 19279'],
  ['10322781','95030012','19271, 19274'],
  ['10322781-1','95030006','19272'],
  ['10322782','42022203','5446, 5448, 5450, 5451, 5452'],
  ['10322782-1','42022203','10492, 19278'],
  ['10322782-2','42029204','19282'],
  ['10322782-3','42021203','19286, 19287'],
  ['10322782-4','42023203','19294'],
  ['10322782-5','42029204','19297'],
  ['10322783','48203001','67550'],
  ['10322783-1','39269099','63986'],
  ['10322783-2','39269099','63990'],
  ['10322783-4','96151999','5430, 5431,5432, 5433, 5434, 5435'],
  ['10322783-5','96151101','5436, 5437, 5438, 5439, 5440, 5441, 5442'],
  ['10322783-7','48203001','67551'],
  ['10322783-9','48205001','80108'],
  ['10322783-10','96151101','1732, 9612, 10423, 10424, 10485, 10486'],
  ['10322783-11','39262099','3921, 6909, 6915'],
  ['10322783-12','96151999','10420'],
  ['10322783-13','39269099','63986'],
  ['10322783-14','48203001','67550'],
  ['10322783-20','39262099','3437, 6432'],
];

$folios_file = $root . "/pltoolbox/mayoral/resources/TempFiles/muestrario.csv";
$folios_file = fopen($folios_file, "w");

fputcsv($folios_file, ['Linea', 'Fraccion', 'Modelo']);

foreach ($muestrario as $uva){
    $folio = $uva[0];
    $fraccion = $uva[1];
    $modelos = explode(', ',str_replace(' ', '', $uva[2]));


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
