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



$cnt_8 = [
  ['10324221','62023099','1439'],
  ['10324221-1','61112012','9408, 9408, 9409, 9409, 9410, 9410, 9416, 9416, 9417, 9417, 9448'],
  ['10324221-2','61113007','1620, 1633, 1648, 1659, 1659, 1739, 1740, 1741, 1793'],
  ['10324221-3','62093005','1647, 1649, 1650'],
  ['10324221-4','62111101','6674'],
  ['10324221-5','62111101','1619, 1647, 1649, 1650, 3613, 3615, 6674'],
  ['10324221-6','61123101','1648, 1659, 1659, 3611, 3611'],
  ['10324221-7','62034291','6280'],
  ['10324221-8','62114202','6025, 6275, 6276, 6278'],
  ['10324221-9','62114302','5272, 6024, 6026, 6966'],
  ['10324221-10','62114202','6022, 6022'],
  ['10324221-11','61112012','1005, 1008, 1008, 1010, 1013, 1014, 1015, 1016, 1034, 1197, 1201, 1203, 1229, 1229, 1230, 1231, 1235, 1529, 1530, 1531, 1533, 1534, 1609, 1610, 1610, 1611, 1611, 1612, 1612, 1633, 1634, 1634, 1715, 1732, 1734, 1735, 1736, 1737, 1792, 1814, 1836, 1839, 1932, 1933, 52913'],
  ['10324221-12','62092007','1102, 1201, 1204, 1232, 1622'],
  ['10324221-13','62093005','1210, 1233'],
  ['10324221-14','62099091','1298'],
  ['10324221-15','62064091','5273, 5274, 5276, 6105, 6107, 54055'],
  ['10324221-16','61061002','6001, 6002, 6005, 6008, 6011, 6012, 6014, 6020, 6274'],
  ['10324221-17','62063004','6102, 6106'],
  ['10324221-18','61062099','56051'],
  ['10324221-19','61061002','1005, 1008, 1008, 1010, 1013, 1014, 1015, 1197, 1229, 1229, 1230, 1231, 1235, 1732, 1733, 1734, 1735, 1736, 1737, 1932, 1933, 3079, 3082, 3088, 3089, 3094, 3096, 3097, 3098, 3178, 3261, 3262, 3263, 3264, 3266, 3540, 3703, 3706, 3707, 3708, 3954, 6001, 6002, 6004, 6005, 6007, 6014, 6017, 6020, 6021, 6025, 6275, 6276, 6292, 6759, 6967, 52913'],
  ['10324221-20','62063004','1102, 1232, 3172, 3177, 3179, 3258, 6022, 6022, 6106'],
  ['10324221-21','62064092','1233, 3539, 3952, 5141, 5272, 5273, 5274, 5276, 6024, 6026, 6105, 6107, 6966'],
  ['10324221-22','62069001','1298, 3176'],
  ['10324221-23','61062099','3259, 3260, 3705, 6019, 6023, 56051'],
  ['10324221-24','61112012','1234, 1738'],
  ['10324221-25','65050004','9719'],
  ['10324221-26','63079099','19111, 19896'],
  ['10324221-27','63053999','19032, 19110, 19112, 19173, 19799, 19899, 19900'],
  ['10324221-28','42022203','1919, 1919, 3935, 3948, 5434, 10732, 19431'],
  ['10324221-29','61112012','5405, 9706, 9706, 9706, 9706, 9708, 9708, 9709, 9710, 9710, 9711, 9711, 9711, 9711, 9714, 10650, 10650, 10650, 10652, 10652, 10652, 10655, 10655, 10656, 10656, 10656'],
  ['10324221-30','61159501','5405, 5406, 10650, 10650, 10650, 10652, 10652, 10652, 10655, 10655, 10656, 10656, 10656, 10705, 10705, 10705, 10707, 10707, 10707, 10712, 10712, 10712'],
  ['10324221-31','61159601','10710'],
  ['10324221-32','61113007','9712'],
  ['10324221-33','61119091','9713'],
  ['10324221-34','62089202','5011, 5012'],
  ['10324221-35','61112012','1201, 1930, 9698'],
  ['10324221-36','62092007','1203, 1204, 1211, 1801, 1805, 1806, 1807, 1808, 1820, 1824, 1825, 1834'],
  ['10324221-37','62093005','1210, 1821, 1822, 1823, 1827, 1828, 5011, 5012'],
  ['10324221-38','62099091','1829'],
  ['10324221-39','61082103','1930'],
  ['10324221-40','63079099','19429, 19431'],
  ['10324221-41','61051002','1016, 1017, 1034, 1035, 1652, 6035'],
  ['10324221-42','61052003','1028, 3006'],
  ['10324221-43','61112012','106, 1002, 1002, 1003, 1018, 1019, 1020, 1021, 1022, 1023, 1024, 1024, 1027, 1030, 1032, 1205, 1208, 1209, 1223, 1224, 1620, 1623, 1624, 1624, 1625, 1625, 1626, 1626, 1627, 1627, 1628, 1628, 1637, 1638, 1639, 1648, 1651, 1654, 1655, 1655, 1656, 1656, 1657, 1658, 1658, 1815, 1816, 1843, 1844, 1845'],
  ['10324221-44','61051002','106, 1018, 1019, 1020, 1021, 1022, 1023, 1024, 1024, 1025, 1026, 1027, 1029, 1030, 1031, 1032, 1648, 1651, 1653, 1654, 1655, 1655, 1656, 1656, 1657, 1658, 1843, 1844, 1845'],
  ['10324221-45','61112012','102, 190, 1017, 1035, 1104, 1105, 1106, 1106, 1107, 1108, 1222, 1245, 1652, 1653, 52001, 52013, 52138, 52142, 52604'],
  ['10324221-46','62092007','117, 1110, 1112, 1113, 1114, 1115, 1116, 1117, 1118, 1194, 1196, 1196, 1207, 1215, 1219, 1220, 1244, 1246, 1247, 1248, 1555, 5250'],
  ['10324221-47','61113007','1028'],
  ['10324221-48','62099091','1195, 1217, 1221, 5249, 5252, 5253, 5255, 5256, 5257'],
  ['10324221-49','61051002','6035, 6126'],
  ['10324221-50','62052091','6116, 6117, 6118, 6121, 6122, 6123, 6124, 6125'],
  ['10324221-51','61061002','1234, 1738, 6274'],
  ['10324221-52','62052092','117, 140, 1110, 1112, 1113, 1114, 1115, 1116, 1117, 1118, 1244, 1246, 1247, 1248, 1555, 3112, 3113, 3114, 3115, 3117, 3120, 3121, 3122, 3123, 3124, 3281, 3283, 5250, 6116, 6117, 6118, 6121, 6122, 6123, 6124, 6125, 15250'],
  ['10324221-53','61051002','1245, 3282, 52001, 52013'],
  ['10324221-54','62059099','5249, 5252, 5253, 5255, 5256, 5257'],
  ['10324221-55','62059099','15249, 15252, 15255'],
  ['10324221-56','61051002','52138, 52142, 52604, 54138, 54142'],
  ['10324221-57','62059099','15257'],
  ['10324221-58','61051002','890, 6108, 6109, 6110, 6111, 6112, 6113, 6114, 6115'],
  ['10324221-59','61051002','102, 150, 890, 1104, 1105, 1106, 1106, 1107, 1108, 3101, 3102, 3103, 3104, 3107, 3108, 3109, 3110, 3181, 6108, 6109, 6110, 6111, 6112, 6113, 6114, 6115'],
  ['10324221-60','61112012','1032'],
  ['10324221-61','61091003','1032, 1036, 1658, 3029, 3030'],
  ['10324221-62','61112012','306, 1376, 1379, 1380, 1382, 1390'],
  ['10324221-63','61103099','332, 332, 5366, 5367, 6339'],
  ['10324221-64','61103099','306, 306, 332, 332, 5366, 5367, 6338, 6338, 6338'],
  ['10324221-65','61102005','320, 321, 1382, 3354, 5365'],
  ['10324221-66','61102005','1390, 3362'],
  ['10324221-67','62093005','1386'],
  ['10324221-68','62014099','1386, 3360'],
  ['10324221-69','62092007','1387'],
  ['10324221-70','62099091','5362'],
  ['10324221-71','61102005','6343'],
  ['10324221-72','61102005','3358, 6343'],
  ['10324221-73','62093005','5361'],
  ['10324221-74','62113202','1387, 5361, 15361'],
  ['10324221-75','62113991','5362, 15362'],
  ['10324221-76','61112012','1381, 1389, 1435, 1446, 1448, 1449, 1451, 1715, 1813, 1814, 1815, 1816, 1843, 1844, 1845'],
  ['10324221-77','62093005','1429, 1431'],
  ['10324221-78','61113007','1438, 1452, 1453'],
  ['10324221-79','61012003','3488, 6475'],
  ['10324221-80','62014099','3495, 3496, 3497, 6471, 6477, 6478, 6479, 6480'],
  ['10324221-81','62013099','6473'],
  ['10324221-82','61022003','3866, 6461'],
  ['10324221-83','62023099','1434, 3472, 3473, 3474, 3475, 5369, 6459, 6460'],
  ['10324221-84','61022003','1435, 1732, 1733, 1735, 3866, 6457'],
  ['10324221-85','62024099','1438, 3471'],
  ['10324221-86','61023099','6339'],
  ['10324221-87','61012003','1389, 1448, 1449, 1843, 1844, 1845, 3361, 3488, 3490, 3867, 3868, 3869, 6476'],
  ['10324221-88','62013099','1446, 1451, 3487, 3494'],
  ['10324221-89','62014099','1453, 3492, 3493, 3495, 3496, 3497, 6479'],
  ['10324221-90','61112012','1430'],
  ['10324221-91','62092007','1444'],
  ['10324221-92','61119091','5364'],
  ['10324221-93','62033203','6469, 6470, 56405'],
  ['10324221-94','62043399','6458'],
  ['10324221-95','62043399','6458'],
  ['10324221-96','62033203','1444, 3485, 3486, 6469, 6470, 15363'],
  ['10324221-97','62033991','5364, 15364'],
  ['10324221-98','62033301','56405'],
  ['10324221-99','62023099','5369, 6459, 6460'],
  ['10324221-100','61022003','6457'],
  ['10324221-101','62093005','1436'],
  ['10324221-102','62013099','3494'],
  ['10324221-103','62024099','1436, 3478'],
  ['10324221-104','62092007','1914'],
  ['10324221-105','62092007','1218, 1544'],
  ['10324221-106','62093005','1630, 1823, 5004, 5009, 5011'],
  ['10324221-107','62171001','234, 275, 1218, 1544, 1914, 3275, 3531, 3534, 3857, 3861, 3863, 3914, 3917, 3917, 3921, 3959, 5004, 5009, 5011, 5024, 5025, 5027, 5031, 5031, 5032, 5033, 5034, 5035, 5038, 5042, 5044, 5045, 5259, 5260, 5262, 5264, 5266, 6509, 6522, 6852, 6858, 6943, 6955, 10727'],
  ['10324221-108','62152001','10738'],
  ['10324221-109','62092007','1116, 1247, 5249, 5255'],
  ['10324221-110','62099091','1196, 9719'],
  ['10324221-111','62093005','5250'],
  ['10324221-112','62159091','1116, 1247, 5249, 5255, 15249, 15255'],
  ['10324221-113','62152001','5250, 15250'],
  ['10324221-114','61112012','1629, 1702, 1792, 1806, 1923, 1926, 9728'],
  ['10324221-115','61178002','1920, 1920'],
  ['10324221-116','62171001','1923, 1926, 3089, 10677'],
  ['10324221-117','61113007','5427, 5428, 9727, 10677'],
  ['10324221-118','62045399','6940, 6941'],
  ['10324221-119','62045203','3260, 3907, 6938'],
  ['10324221-120','62045399','3908, 6940, 6941'],
  ['10324221-121','62099091','1839, 1933'],
  ['10324221-122','62093005','1932'],
  ['10324221-123','61113007','52913'],
  ['10324221-124','62045399','1932, 3952, 3953, 6966'],
  ['10324221-125','62045991','1933'],
  ['10324221-126','61045302','3901, 6937, 6967'],
  ['10324221-127','62045203','3903, 3905, 6970, 6970'],
  ['10324221-128','61045201','3954, 3958'],
  ['10324221-129','61045302','52913, 54913'],
  ['10324221-130','62023099','6464'],
  ['10324221-131','62023099','3480, 54453'],
  ['10324221-132','65050004','1649, 1649, 9724, 10666, 10667, 10667, 10668, 10668, 10669, 10669, 10718, 10719, 10745'],
  ['10324221-133','65050004','1207, 1211, 1249, 1249, 1531, 1532, 1534, 1605, 1607, 1609, 1613, 1614, 1615, 1616, 1618, 1619, 1620, 1621, 1633, 1638, 1639, 1647, 1647, 1651, 1651, 1653, 1653, 1721, 1723, 1793, 9448, 9717, 9720, 9721, 10659, 10659, 10660, 10660, 10661, 10661, 10662, 10662, 10666, 19340'],
  ['10324221-134','61112012','19340'],
  ['10324221-135','62114302','3863, 3863, 5258, 5259, 5260, 5261, 5263, 5264, 5266, 5267, 5271, 6852, 6853, 6854, 6855, 6856'],
  ['10324221-136','62114202','5262'],
  ['10324221-137','62114991','3859'],
  ['10324221-138','62114302','5258'],
  ['10324221-139','62114202','5262, 6858'],
  ['10324221-140','62114202','3861'],
  ['10324221-141','62114302','6852'],
  ['10324221-142','61143002','6857, 56852'],
  ['10324221-143','61143002','3865'],
  ['10324221-144','62092007','1803, 1846'],
  ['10324221-145','61142001','6860, 6861'],
  ['10324221-146','62114202','1803, 1846, 3858, 3860'],
  ['10324221-147','62114302','3856, 3857, 5258, 5259, 5260, 5266, 5267, 6854, 6856'],
  ['10324221-148','62114991','3859'],
  ['10324221-149','61142001','3862, 3862, 3864, 6859, 6859'],
  ['10324221-150','61151001','10646, 10647, 10700, 10702'],
  ['10324221-151','62171001','3092, 3947'],
  ['10324221-152','61112012','1615, 1617, 1705, 1706, 1706, 1707, 1708, 1709, 1709, 1710, 1710, 1711, 1711, 1712, 1712, 1713, 1713, 1713, 1720, 1721, 1722, 1722, 1723, 1724, 1725, 1725, 1726, 1726, 1727, 1728, 1728, 1729, 1729, 1795, 1795, 1795, 9448'],
  ['10324221-153','61113007','1621'],
  ['10324221-154','62099091','1635'],
  ['10324221-155','63014001','19033'],
  ['10324221-156','63013001','9392, 9393, 9397, 9398, 9399, 9405, 19402, 19402, 19402'],
  ['10324221-157','42029204','10683, 10684, 10735, 19435'],
  ['10324221-158','61143002','56852'],
  ['10324221-159','42021203','19431'],
  ['10324221-160','42029204','19111'],
  ['10324221-161','61112012','1211, 1601, 1605, 1607, 1616, 1618, 1701, 1702, 1703, 1704, 1717, 1718, 1719, 1723, 1790, 1813'],
  ['10324221-162','62092007','1614, 1630'],
  ['10324221-163','62093005','1836'],
  ['10324221-164','62099091','1636'],
  ['10324221-165','62034202','1644, 1645, 1646'],
  ['10324221-166','62092007','1205, 1609, 1613, 1623, 1624, 1638, 1644, 1645, 1646, 1651, 1840'],
  ['10324221-167','61112012','1622, 1639, 1652'],
  ['10324221-168','62099091','1637'],
  ['10324221-169','62046209','1840'],
  ['10324221-170','62034202','1651'],
  ['10324221-171','61034203','1652'],
  ['10324221-172','62092007','201, 206, 207, 1207, 1208, 1209, 1212, 1215, 1218, 1223, 1227, 1232, 1236, 1237, 1239, 1241, 1244, 1245, 1246, 1247, 1248, 1249, 5249, 5255'],
  ['10324221-173','61112012','603, 1224, 1225, 1229, 1230, 1231, 1235, 1240, 1243, 1610, 1610, 1611, 1611, 1612, 1612, 1625, 1625, 1626, 1626, 1627, 1627, 1628, 1628, 1634, 1634, 1653, 1654, 1655, 1656, 1657, 1658, 52220, 52604'],
  ['10324221-174','62099091','1213, 1215, 1217, 1219, 1220, 1221, 1222, 1298, 5252, 5253, 5256'],
  ['10324221-175','62093005','1233, 5250'],
  ['10324221-176','62034291','231, 242, 242, 252, 6263, 6263, 6282, 6284, 6285, 6286, 6286'],
  ['10324221-177','61034203','600, 6281, 6290, 6665, 6666, 6667, 6668, 6669, 6670, 6672, 6673'],
  ['10324221-178','62046209','235, 275, 6265, 6269, 6270'],
  ['10324221-179','61046203','272, 6274, 6276, 6278, 6292'],
  ['10324221-180','62046391','6266, 6268'],
  ['10324221-181','62046999','6291'],
  ['10324221-182','62046209','234, 235, 275, 1212, 1218, 1232, 1234, 1234, 3252, 3258, 6265, 6269, 6270, 6271'],
  ['10324221-183','61046203','272, 603, 607, 1225, 1229, 1230, 1231, 1235, 3254, 3259, 3261, 3263, 3264, 6267, 6267, 6274, 6275, 6276, 6278, 6292'],
  ['10324221-184','62046392','1233, 3250, 5272, 6266'],
  ['10324221-185','62046999','1298, 3256, 6268, 6291'],
  ['10324221-186','61046399','3262, 3266'],
  ['10324221-187','62034292','202, 204, 206, 207, 231, 237, 242, 252, 1227, 1236, 1237, 1241, 1242, 1244, 1245, 1246, 1247, 1248, 1249, 3249, 3267, 3273, 3274, 3275, 3278, 3280, 3281, 3282, 3283, 5249, 5255, 6263, 6263, 6280, 6280, 6282, 6284, 6284, 6285, 6286, 6289, 15255'],
  ['10324221-188','61034203','600, 611, 621, 1240, 1243, 1653, 1654, 1655, 1656, 1657, 1658, 3277, 3601, 3602, 3603, 3604, 3605, 3606, 3607, 3608, 3609, 3610, 3869, 3869, 6281, 6290, 6665, 6666, 6667, 6668, 6669, 6670, 6672, 6673, 52220, 52604, 54220'],
  ['10324221-189','62034392','1239, 5250'],
  ['10324221-190','62034991','5252, 5253, 5256, 15252'],
  ['10324221-191','62034392','15250'],
  ['10324221-192','62092007','522, 535, 595, 596, 1536, 1541, 1544, 1545, 1547, 1548, 1552, 1553, 1555'],
  ['10324221-193','61112012','711, 1528, 1529, 1530, 1531, 1532, 1533, 1534, 1535, 1537, 1543, 1549, 1550, 1640, 1640, 1715, 1730, 1731, 1732, 1734, 1735, 1736, 1737, 1737, 1738, 1792, 1813, 1814, 1815, 1816, 1844, 1845'],
  ['10324221-194','62099091','1551, 5257'],
  ['10324221-195','61113007','1843'],
  ['10324221-196','62034291','520, 530, 543, 6284, 6506, 6512, 6513, 6516, 6517'],
  ['10324221-197','61034203','744, 6520'],
  ['10324221-198','61046203','752, 6504, 6505, 6511, 6759'],
  ['10324221-199','61046991','6502'],
  ['10324221-200','62046391','6503, 6521'],
  ['10324221-201','62046209','6507, 6510, 6522'],
  ['10324221-202','62046999','6509'],
  ['10324221-203','62046209','535, 1544, 1545, 3528, 3531, 3534, 3535, 3536, 6507, 6510, 6522'],
  ['10324221-204','61046203','748, 752, 1543, 1730, 1731, 1732, 1733, 1735, 1738, 3537, 3701, 3702, 3703, 3705, 3706, 3707, 3708, 3708, 3709, 3709, 3710, 3711, 3797, 3866, 6504, 6505, 6511, 6759'],
  ['10324221-205','61046399','3529, 6758'],
  ['10324221-206','62046999','3532, 3539'],
  ['10324221-207','62046392','3540, 5273, 5274, 5276, 6503, 6521'],
  ['10324221-208','61046991','6502, 6509'],
  ['10324221-209','62034292','509, 512, 515, 520, 522, 530, 540, 543, 711, 742, 744, 1547, 1548, 1549, 1550, 1552, 1553, 1555, 1844, 1845, 3542, 3543, 3545, 3546, 3547, 3549, 3550, 6506, 6512, 6513, 6516, 6517'],
  ['10324221-210','62034991','1551, 5257'],
  ['10324221-211','61034203','1843, 3867, 3868, 6520'],
  ['10324221-212','62046391','5273'],
  ['10324221-213','61046203','1734, 1736, 1737, 1737'],
  ['10324221-214','62046392','5276, 54554, 56553, 56553'],
  ['10324221-215','62046209','54555'],
  ['10324221-216','62034392','1541, 15249'],
  ['10324221-217','62034292','6285'],
  ['10324221-218','62034991','15257'],
  ['10324221-219','61113007','9701, 9702, 9703, 10646, 10647'],
  ['10324221-220','61112012','9749'],
  ['10324221-221','61112012','1640, 1640'],
  ['10324221-222','61112012','1441, 1442'],
  ['10324221-223','61102005','3481, 3483, 3490, 3868, 3869, 6467, 6468, 6476'],
  ['10324221-224','61102005','3468, 3469, 6455, 6456'],
  ['10324221-225','61102005','1432, 3468, 3469'],
  ['10324221-226','61102005','1441, 1442, 3481, 3483, 3484'],
  ['10324221-227','61112012','303, 318, 1378, 1384, 1385, 1532, 1535, 1732, 1735, 5365'],
  ['10324221-228','61119091','306'],
  ['10324221-229','61102005','6340'],
  ['10324221-230','61103099','6337'],
  ['10324221-231','61102005','303, 311, 1384, 1385, 3356, 3357, 6340'],
  ['10324221-232','61099004','6003'],
  ['10324221-233','61091003','6007, 6013, 6021'],
  ['10324221-234','61091003','6012, 6013, 54056, 54913, 56050'],
  ['10324221-235','61099004','3603'],
  ['10324221-236','62129099','10680, 10738'],
  ['10324221-237','62093005','10680'],
  ['10324221-238','63026006','9458, 9459, 9460, 9462, 9462, 9462, 10690, 10691, 10691, 10741, 10742'],
  ['10324221-239','61143002','6027'],
  ['10324221-240','61142001','6278'],
  ['10324221-241','61112012','1650'],
  ['10324221-242','61091003','840, 6028, 6029, 6030, 6031, 6032, 6033, 6036, 6036, 6037, 6040, 6041, 6044, 6665, 6666, 6672'],
  ['10324221-243','61091003','6034, 6038, 6042, 6043, 6045, 6046, 6667, 6668, 6669, 6669, 6670, 6673'],
  ['10324221-244','61091003','854, 6006, 6089, 6759, 56050'],
  ['10324221-245','61091003','174, 854, 3080, 3081, 3084, 3087, 3090, 3091, 3092, 3093, 3709, 3710, 3711, 3797, 3953, 3954, 3958, 6008'],
  ['10324221-246','61099004','6003'],
  ['10324221-247','61091003','170, 840, 1650, 3002, 3003, 3004, 3005, 3005, 3007, 3008, 3009, 3009, 3010, 3011, 3012, 3013, 3014, 3016, 3017, 3018, 3019, 3020, 3021, 3021, 3022, 3023, 3024, 3025, 3030, 3601, 3602, 3603, 3604, 3604, 3605, 3606, 3607, 3608, 3608, 3609, 3610, 3867, 3868, 6028, 6029, 6030, 6031, 6032, 6033, 6034, 6036, 6036, 6037, 6038, 6040, 6041, 6042, 6043, 6044, 6045, 6665, 6666, 6667, 6668, 6669, 6669, 6670, 6672'],
  ['10324221-248','61099004','3007'],
  ['10324221-249','62044399','3942'],
  ['10324221-250','61112012','1528, 1528, 1810, 1811, 1831, 1832, 1833, 1919, 1923, 1925, 1926, 1927, 1929, 1930, 1931'],
  ['10324221-251','62092007','1629, 1801, 1804, 1805, 1806, 1807, 1808, 1809, 1820, 1824, 1828, 1834, 1905, 1910, 1912, 1913, 1914, 1915, 1917'],
  ['10324221-252','62093005','1818, 1821, 1822, 1823, 1825, 1827, 1902, 1904, 1907, 1908, 1911, 1920, 5004, 5009, 5011, 5012, 5013, 5014, 5019'],
  ['10324221-253','62099091','1819, 1829, 1901, 1906, 1909, 5001'],
  ['10324221-254','62044399','5024, 5025, 5027, 5031, 5032, 5033, 5034, 5035, 5037, 5039, 5042, 5044, 5045, 5046, 5047, 5060, 6944, 6946, 6947, 6949, 6951, 6952, 6964, 6968'],
  ['10324221-255','62044299','5038, 5043, 6945, 6950, 6955, 6956, 6963, 6969, 54911'],
  ['10324221-256','62044991','5053'],
  ['10324221-257','61044302','6943, 6958, 6959'],
  ['10324221-258','61044203','6957'],
  ['10324221-259','62044499','1901, 5053'],
  ['10324221-260','62044399','1902, 1904, 1907, 1908, 1911, 3912, 3914, 3918, 3920, 3929, 5004, 5009, 5011, 5012, 5013, 5014, 5019, 5024, 5025, 5027, 5031, 5032, 5033, 5034, 5035, 5037, 5039, 5042, 5044, 5045, 5046, 5047, 5048, 5057, 5058, 5060, 5064, 5065, 6944, 6946, 6947, 6949, 6951, 6952, 6953, 6964, 6968'],
  ['10324221-261','62044299','1905, 1910, 1912, 1913, 1914, 1915, 1917, 1918, 3917, 3919, 3921, 3922, 3926, 3930, 3932, 3933, 3934, 3935, 3936, 3937, 3940, 3941, 3947, 3956, 3959, 5038, 5043, 6945, 6950, 6955, 6956, 6962, 6963, 6969'],
  ['10324221-262','62044991','1906, 1909, 3911, 3913, 3915, 3916, 3925, 3925, 3928, 3931, 5001'],
  ['10324221-263','61044203','1919, 1923, 1926, 1927, 1928, 1929, 1930, 1931, 3943, 3944, 3945, 3948, 3949, 6957, 6965'],
  ['10324221-264','61044302','1920, 3950, 6943, 6959'],
  ['10324222','94049099','19037, 19900'],
  ['10324222-1','39269099','19389'],
  ['10324222-2','39262099','3470'],
  ['10324222-3','39262099','6949'],
  ['10324222-4','96151101','5413, 5414, 5415, 5416, 5417, 5418, 5419, 5420, 5422, 5423, 5424, 5426, 9727, 10724'],
  ['10324222-5','96151999','5411, 5411, 10672, 10673'],
  ['10324223','42023203','19452'],
  ['10324223-1','42022203','5436, 5437, 10730, 19032, 19110, 19112, 19173, 19278, 19348, 19349, 19426, 19429, 19442, 19799, 19896, 19899, 19900'],
  ['10324223-2','42029204','19037'],
  ['10324223-3','42021203','19443'],
  ['10324223-4','42029204','19455'],
  ['10324223-5','42029204','19032, 19110, 19799, 19900'],
  ['10324224','95030012','9420, 9421, 9421, 9421, 19168, 19423'],
];


$folios_file = $root . "/pltoolbox/mayoral/resources/TempFiles/items_sin_folio.csv";
$folios_file = fopen($folios_file, "w");

fputcsv($folios_file, ['Linea', 'Fraccion', 'Modelo']);

foreach ($cnt_8 as $uva){
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

}


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
