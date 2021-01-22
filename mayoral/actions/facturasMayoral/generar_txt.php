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

$contenedor_20 = [
  ['1032084','62093091','2406, 2409, 2466'],
  ['1032084-1','61113008','2459'],
  ['1032084-2','62021392','414, 2406, 2409, 4409, 4414, 4415, 4416, 4420, 7411, 7414'],
  ['1032084-3','61112099','2769, 9765'],
  ['1032084-4','61142001','125'],
  ['1032084-5','61112008','116, 2033, 2052, 2054, 2055, 2056, 2057, 2058, 2059, 2219, 2221, 2548, 2550, 2551, 2645, 2784, 2786, 2787, 2791, 2792, 2794, 2795, 2879, 2882, 2971, 2972'],
  ['1032084-6','62092005','2136, 2881'],
  ['1032084-7','62063002','4151, 5606, 7135, 7137, 7138, 7142, 7961'],
  ['1032084-8','61061091','5605, 5816, 7064, 7074'],
  ['1032084-9','62064091','5607, 5608, 7136, 7139, 7140, 7141, 7143'],
  ['1032084-10','61061092','116, 2052, 2054, 2055, 2056, 2057, 2058, 2059, 2219, 2221, 2358, 2401, 2784, 2786, 2787, 2789, 2790, 2791, 2792, 2794, 2795, 2971, 2972, 2974, 4061, 4063, 4207, 4724, 4725, 7062, 7064, 7074, 7079'],
  ['1032084-11','61062092','2053, 2357, 2785, 4059'],
  ['1032084-12','62063003','2136, 4152, 4991, 7135, 7137, 7138, 7142, 7961'],
  ['1032084-13','62064092','4148, 4149, 4150, 4153, 7136, 7139, 7141'],
  ['1032084-14','61119003','2785'],
  ['1032084-15','63079099','19270, 19411, 19796, 19799'],
  ['1032084-16','42022202','5933'],
  ['1032084-17','61082199','10858'],
  ['1032084-18','61171099','10842, 10843, 10895'],
  ['1032084-19','61112099','10840, 10841'],
  ['1032084-20','61119099','10842, 10843'],
  ['1032084-21','61171099','5913, 5914, 10840, 10841, 10887, 10892, 10893, 10894, 10896, 10898'],
  ['1032084-22','61112011','2215, 9308, 10832, 10833'],
  ['1032084-23','61159501','5909, 10832, 10833, 10871, 10873, 10874, 10875, 10876, 10877'],
  ['1032084-24','61071102','10855'],
  ['1032084-25','61071199','10853, 10854, 10855'],
  ['1032084-26','61112008','108, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046, 2047, 2048, 2638, 2641, 2653, 2859'],
  ['1032084-27','61051099','2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046, 2047'],
  ['1032084-28','61051099','108, 173'],
  ['1032084-29','61112008','104, 2121, 2122, 2124, 2553, 2556'],
  ['1032084-30','62092005','113, 2119, 2120, 2127, 2128, 2130, 2131, 2132, 2133, 2134, 2479'],
  ['1032084-31','62052092','113, 146, 882, 2127, 2128, 2130, 2131, 2132, 2133, 2134, 4139, 4140, 4141, 4142, 4143, 4144, 4145, 4146, 4147, 7129, 7130, 7131, 7133'],
  ['1032084-32','61061004','104'],
  ['1032084-33','61051004','2121, 2122, 2124, 4128, 4129, 4130, 4131, 4132, 4133, 4134, 4135, 4136, 4137, 7043, 7122, 7123, 7124, 7125, 7126'],
  ['1032084-34','62052091','882, 7129, 7130, 7131, 7133'],
  ['1032084-35','61051003','7043, 7122, 7123, 7124, 7125, 7126'],
  ['1032084-36','61112092','307, 308, 361, 2333, 2334, 2362, 2559, 2645, 2859'],
  ['1032084-37','61119003','2336, 2360'],
  ['1032084-38','61102094','326'],
  ['1032084-39','61103093','7334'],
  ['1032084-40','61102099','308, 314, 326, 2362, 4349, 4350, 5818, 5819'],
  ['1032084-41','61103099','2360, 2361, 7333'],
  ['1032084-42','61102099','327, 361'],
  ['1032084-43','62019399','7322'],
  ['1032084-44','62029391','7337'],
  ['1032084-45','62029392','7337'],
  ['1032084-46','62019399','4334, 4336'],
  ['1032084-47','61102091','4335'],
  ['1032084-48','61112092','918, 2355, 2356, 2491, 2492, 2493, 2641, 2653, 2883, 2887, 2888, 2890, 2891, 2892'],
  ['1032084-49','61113092','2335, 2354, 2404, 2416, 2795, 2883, 2885'],
  ['1032084-50','62092092','2405'],
  ['1032084-51','62093092','2413, 2469'],
  ['1032084-52','62019399','7463, 7472'],
  ['1032084-53','61013091','7464, 7808'],
  ['1032084-54','61012002','7475, 7806'],
  ['1032084-55','62029391','416, 4407, 7407, 7418'],
  ['1032084-56','61023003','7338, 7405, 7810'],
  ['1032084-57','62029291','7406'],
  ['1032084-58','61023002','2404, 2416, 2795, 4405, 7405'],
  ['1032084-59','62029292','2405, 4406, 7406'],
  ['1032084-60','61022099','2890, 2891, 2892, 4822, 4824, 4825'],
  ['1032084-61','62029392','4408, 4417'],
  ['1032084-62','61012099','43, 918, 2355, 2356, 2491, 2492, 2493, 2883, 2887, 2888, 4338, 4481, 4483, 4484, 4486, 4814, 4815, 4818, 4819, 4821, 7475'],
  ['1032084-63','61013003','2354, 2883, 2885, 4340'],
  ['1032084-64','62019292','2479, 4138'],
  ['1032084-65','62019399','4470'],
  ['1032084-66','61112092','2476, 2477'],
  ['1032084-67','61033201','7462'],
  ['1032084-68','62043392','5822'],
  ['1032084-69','61033201','2476, 2477, 4467, 7462'],
  ['1032084-70','62093091','414, 2471, 2483'],
  ['1032084-71','62011391','412, 4471, 4473, 4476, 4478, 4479, 7468, 7470'],
  ['1032084-72','62021391','2413, 7411, 7413, 7414, 7415, 7419'],
  ['1032084-73','62011392','412, 2483, 4471, 4473, 4474, 4476, 4477, 4478, 4479'],
  ['1032084-74','62093099','2968'],
  ['1032084-75','62171099','2968, 4535, 4547, 4553, 4959, 4960, 4974, 4981, 5551, 5557, 5564, 7203, 7524, 7538, 10916'],
  ['1032084-76','62093007','2627'],
  ['1032084-77','62159001','4139'],
  ['1032084-78','62093099','2119'],
  ['1032084-79','61112099','2847, 9325, 9326'],
  ['1032084-80','62081101','10925'],
  ['1032084-81','61113091','2879'],
  ['1032084-82','62092091','2943, 2638, 2852, 2866, 2869, 2960, 2849, 2863, 2881, 2947, 2956, 2962, 2967'],
  ['1032084-83','62093091','2943'],
  ['1032084-84','62045299','2943, 2941, 4956, 7949, 7955'],
  ['1032084-85','62045392','2943'],
  ['1032084-86','62045391','7951'],
  ['1032084-87','61045391','7952, 7954'],
  ['1032084-88','62045392','7951'],
  ['1032084-89','61045392','7952, 7954'],
  ['1032084-90','61112004','2859'],
  ['1032084-91','61119004','2938'],
  ['1032084-92','62092004','2941'],
  ['1032084-93','62093004','2971, 2972'],
  ['1032084-94','61113016','2974'],
  ['1032084-95','61045391','7944, 7945'],
  ['1032084-96','62045391','7946, 7947, 7956'],
  ['1032084-97','62045202','7949, 7955'],
  ['1032084-98','61045901','2938'],
  ['1032084-99','62045392','2971, 2972, 4952, 4955, 4959, 7950, 7956'],
  ['1032084-100','61045392','2974, 4953, 4958, 4991, 4992, 4993, 7944, 7945, 7946, 7947, 7948'],
  ['1032084-101','62045901','4954'],
  ['1032084-102','62045392','4960'],
  ['1032084-103','65050002','10906, 10909'],
  ['1032084-104','65050099','2459, 2562, 2866, 5913, 5914, 9316, 9320, 9321, 10840, 10841, 10842, 10843, 10846, 10892, 10893, 10894, 10895, 10896, 10898, 10901, 10902, 10903'],
  ['1032084-105','61169301','5913, 5914'],
  ['1032084-106','61169901','10884, 10895'],
  ['1032084-107','61169901','10842'],
  ['1032084-108','61143099','7715, 7329'],
  ['1032084-109','61112099','2218, 2869, 9294, 10826, 10827, 10828'],
  ['1032084-110','61119099','9295'],
  ['1032084-111','61152901','10867'],
  ['1032084-112','61152201','10861, 10862, 10863'],
  ['1032084-113','61152901','10826, 10828, 10866, 10867, 10868'],
  ['1032084-114','61112017','2625, 2633, 2635, 2751, 2752, 2753, 2754, 2755, 2756, 2758, 2759, 2764, 2765, 2766, 2767, 2768, 2769, 2770, 2772, 2774'],
  ['1032084-115','61113018','2631'],
  ['1032084-116','61169901','10843'],
  ['1032084-117','62093099','2627'],
  ['1032084-118','61112011','9316'],
  ['1032084-119','61119099','10842'],
  ['1032084-120','61113020','10843'],
  ['1032084-121','63013001','9755, 9777, 9778'],
  ['1032084-122','63014001','9783'],
  ['1032084-123','61112007','125, 2559, 2775, 2778'],
  ['1032084-124','61112091','2655, 2656'],
  ['1032084-125','61046392','7601'],
  ['1032084-126','62034202','2655, 2656'],
  ['1032084-127','62093004','2219, 2221'],
  ['1032084-128','61113017','2212'],
  ['1032084-129','61112020','2212, 2215'],
  ['1032084-130','61119004','2218'],
  ['1032084-131','62046310','5710, 7203'],
  ['1032084-132','62046309','2219, 2221, 4206'],
  ['1032084-133','62046307','4204, 4207, 5712, 7203, 4547, 7536'],
  ['1032084-134','62046296','576, 577, 578'],
  ['1032084-135','62046295','70, 80, 2590, 4549, 4550, 7538, 7539'],
  ['1032084-136','62034294','30, 50, 7530, 7532, 7533'],
  ['1032084-137','62046294','80, 7538, 7539'],
  ['1032084-138','62034295','40, 50, 504, 510, 516, 2577, 2582, 2584, 4527, 4530, 4531, 4536, 4539, 7530, 7532, 7533'],
  ['1032084-139','61112019','514, 560, 702, 704, 918, 2557, 2559, 2563, 2574, 2639, 2645, 2649, 2653, 2776, 2783, 2784, 2786, 2789, 2790, 2791, 2792, 2794, 2795, 2883, 2884, 2885, 2886, 2887, 2888, 2890, 2891, 2892, 10837'],
  ['1032084-140','61113093','704, 727, 918, 2566, 2787, 2883, 2884, 2886'],
  ['1032084-141','62092014','2560, 2568, 2571, 2575, 2590'],
  ['1032084-142','62034291','516, 582, 7524, 7526, 7527, 7528'],
  ['1032084-143','61034302','705, 4820, 7522, 7809'],
  ['1032084-144','61034202','4820, 7529, 7806, 7808'],
  ['1032084-145','62046293','578'],
  ['1032084-146','61046291','722, 7713, 7714, 7715, 7718, 7719, 7721, 7811'],
  ['1032084-147','61046901','5716, 7534'],
  ['1032084-148','61046392','7535, 7537, 7541, 7543, 7711, 7718, 7720, 7810'],
  ['1032084-149','62046395','7536'],
  ['1032084-150','62046291','7540'],
  ['1032084-151','62046393','7542'],
  ['1032084-152','61046292','511, 560, 702, 714, 717, 722, 2783, 2784, 2786, 2789, 2790, 2791, 2792, 2794, 2795, 2890, 2891, 2892, 4551, 4552, 4554, 4719, 4721, 4723, 4725, 4726, 4727, 4729, 4730, 4731, 4732, 4733, 4822, 4824, 4825, 7545, 7713, 7714, 7715, 7718, 7719, 7721, 7811, 10837'],
  ['1032084-153','61046391','712, 727, 2787, 4544, 4555, 4717, 4722, 4724, 4728, 4729, 4732, 4822, 4826, 7535, 7537, 7541, 7711, 7716, 7717, 7718, 7720, 7810'],
  ['1032084-154','61046901','2589, 2785, 5716, 7534, 7710'],
  ['1032084-155','62046394','4545, 4546, 4553, 7542'],
  ['1032084-156','62046292','4548, 7540'],
  ['1032084-157','62034292','41, 513, 517, 521, 537, 563, 582, 2575, 2581, 2586, 2587, 4526, 4528, 4529, 4533, 4535, 4541, 7524, 7526, 7527, 7528'],
  ['1032084-158','61034304','43, 704, 705, 725, 918, 2883, 2884, 2886, 4814, 4815, 4817, 4820, 7522, 7809'],
  ['1032084-159','61034204','43, 704, 725, 918, 2574, 2883, 2884, 2885, 2886, 2887, 2888, 4532, 4538, 4543, 4814, 4815, 4816, 4817, 4818, 4819, 4820, 4821, 7529, 7806, 7808'],
  ['1032084-160','62034293','2576, 2578, 2579, 2580, 2585, 4537, 4540'],
  ['1032084-161','61113093','2562'],
  ['1032084-162','61112019','2547, 2548, 2549, 2550, 2551, 2553, 2556, 2641'],
  ['1032084-163','61119004','2589, 2785'],
  ['1032084-164','62046905','5711'],
  ['1032084-165','62092014','30, 510, 521, 563, 576, 593, 2567, 2576, 2577, 2578, 2579, 2580, 2581, 2582, 2584, 2585, 2586, 2587'],
  ['1032084-166','61152201','5905, 5906'],
  ['1032084-167','62143001','5942'],
  ['1032084-168','62093099','2627'],
  ['1032084-169','61112011','9347'],
  ['1032084-170','61112092','2401, 2571, 2789, 2790, 2974'],
  ['1032084-171','61102091','4403, 4404, 4723, 4726, 4732, 7073'],
  ['1032084-172','61102002','842, 7042, 7044, 7045, 7046, 7047, 7048, 7049, 7050, 7051, 7053, 7055, 7056, 7058, 7059'],
  ['1032084-173','61102091','178, 830, 4060, 4062, 4064, 4065, 4066, 4067, 4068, 4069, 4070, 4727, 4731, 4733, 7063, 7065, 7066, 7067, 7068, 7070, 7071, 7075, 7076, 7077, 7080, 7545'],
  ['1032084-174','61102091','842, 4037, 4038, 4039, 4040, 4041, 4042, 4043, 4045, 4046, 4047, 4047, 4048, 4049, 4050, 4051, 4052, 4053, 4054, 4056, 4057, 7042, 7044, 7045, 7046, 7047, 7048, 7049, 7050, 7051, 7053, 7055, 7056, 7058, 7059'],
  ['1032084-175','61102002','830, 7062, 7063, 7065, 7066, 7067, 7068, 7070, 7071, 7073, 7076, 7077, 7078, 7079, 7080, 7545, 7718'],
  ['1032084-176','61103093','7061'],
  ['1032084-177','61103099','136, 4058, 4728, 4986, 4993, 5817, 7061'],
  ['1032084-178','94043001','9845'],
  ['1032084-179','61112015','2338, 2560, 2639, 2649, 2790, 2884, 2886, 2888'],
  ['1032084-180','61102004','7456, 7457, 7809'],
  ['1032084-181','61103093','4401, 5604, 7330, 7402, 7720'],
  ['1032084-182','61102004','7401, 7717, 7719, 7720, 7721, 7811, 7965'],
  ['1032084-183','61103003','7716'],
  ['1032084-184','61102093','4401, 4728, 4729, 4986, 4992, 4993'],
  ['1032084-185','61103092','4401, 4402, 4730, 4826, 4327'],
  ['1032084-186','61102092','4555'],
  ['1032084-187','61102092','2884, 2886, 2888, 4820'],
  ['1032084-188','61102093','4458, 4459, 4461, 4462, 4465, 4466, 4816, 4817, 4819, 7456'],
  ['1032084-189','61112016','309, 316, 351, 2212, 2215, 2218, 2343, 2344, 2345, 2346, 2557, 2568, 2586, 2587'],
  ['1032084-190','61113014','2348, 2357, 2562'],
  ['1032084-191','61102002','350, 354, 7317, 7319'],
  ['1032084-192','61103093','7339'],
  ['1032084-193','61103093','7324, 7325, 7326, 7327, 7328, 7331, 7974'],
  ['1032084-194','61102091','313, 316, 345'],
  ['1032084-195','61103099','4342, 4343, 4345, 4346, 4347, 4722, 7324, 7327, 7974'],
  ['1032084-196','61102091','309, 311, 323, 350, 351, 354, 2343, 2344, 2345, 2346, 2350, 2586, 2587, 4325, 4330, 4333, 7317, 7319'],
  ['1032084-197','61103099','2348, 4328, 4329, 4332, 7339'],
  ['1032084-198','61103007','4331'],
  ['1032084-199','61099003','842, 7060'],
  ['1032084-200','61099003','7069, 7072'],
  ['1032084-201','61099091','7073, 7069, 7072'],
  ['1032084-202','63026099','9823, 9829'],
  ['1032084-203','62093091','2488'],
  ['1032084-204','62011392','2488, 4480'],
  ['1032084-205','61099091','4044, 842, 7053, 7060'],
  ['1032084-206','61091099','7078, 7718'],
  ['1032084-207','61112014','2547, 2549, 2847, 2850, 2855, 2882, 2948, 2955, 2961, 2965, 2968, 2970'],
  ['1032084-208','62093091','2944'],
  ['1032084-209','61113011','2948, 2964'],
  ['1032084-210','62044391','5548, 5549, 5557, 5560, 5563, 5565, 5568, 5570, 7958, 7959, 7962, 7967, 7968, 7972, 7973'],
  ['1032084-211','62044291','5558, 7964'],
  ['1032084-212','61044403','7957, 7975'],
  ['1032084-213','61044202','7965, 7974, 7976'],
  ['1032084-214','61044391','7965'],
  ['1032084-215','62044392','2944, 4974, 5551, 5564, 5568'],
  ['1032084-216','61044392','2946, 2948, 2958, 2963, 2964, 2966, 2969, 4961, 4963, 4966, 4967, 4970, 4981, 4986, 4987, 4989, 7960, 7965'],
  ['1032084-217','62044292','2947, 2956, 2960, 2962, 2967, 2968, 4964, 5556, 5574, 7964, 7974'],
  ['1032084-218','61044299','2948, 2955, 2961, 2965, 2970, 4966, 4978, 4979, 4982, 4985, 4988, 4990, 7965'],
  ['1032084-219','62044492','4973, 4980, 4984, 5555, 5567'],
  ['1032084-220','61044499','4976, 5561, 7957, 7963, 7975'],
  ['1032084-221','61112014','2563'],
  ['1032084-222','62093091','2862, 2870, 2872, 2945, 2951, 2953, 2954, 2957, 2959'],
  ['1032084-223','61113011','2865, 2875, 2946, 2958, 2963, 2966, 2969'],
  ['1032084-224','62044491','5555'],
  ['1032084-225','62044392','2945, 2953, 2954, 2957, 2959, 4962, 4965, 4968, 4969, 4971, 4972, 4975, 4977, 4983, 5545, 5546, 5549, 5560, 5563, 5565, 5570, 5572, 7958, 7959, 7962, 7967, 7968, 7970, 7972, 7973'],
  ['1032085','43040001','415, 2410, 2411, 2414, 2415, 4412, 4418, 4419, 7416'],
  ['1032085-1','43040001','2337, 4353, 7417'],
  ['1032085-2','43040001','2363, 2784, 4351, 4352, 7336'],
  ['1032085-3','43040001','2407, 2408, 4410, 4411, 5825, 5827, 7409'],
  ['1032085-4','43040001','4472'],
  ['1032085-5','42022201','5932, 5934, 5936, 19270, 19411, 19796, 19799'],
  ['1032085-6','42029201','5939, 10922, 19802'],
  ['1032085-7','43040001','5942'],
  ['1032085-8','42029201','19270, 19796, 19799'],
  ['1032085-9','42021201','19805'],
  ['1032085-10','42029201','19817'],
  ['1032086','39262099','2590, 2941, 2943, 4548, 4549, 4550, 4956, 4963, 5568, 5710, 5711, 5713, 7543'],
  ['1032086-1','96151101','5926, 5927, 5928, 5929, 10850, 10912'],
  ['1032086-2','39269099','19805'],
];

$folios_file = $root . "/pltoolbox/mayoral/resources/TempFiles/items_sin_folios_contenedor_27.csv";
$folios_file = fopen($folios_file, "w");

fputcsv($folios_file, ['Linea', 'Fraccion', 'Modelo']);

foreach ($contenedor_27 as $uva){
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
