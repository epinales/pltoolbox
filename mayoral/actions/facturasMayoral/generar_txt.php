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




$cnt_1_A24000069 = [
  ['1032439','62093005','2451, 2453, 2477, 2478, 2479'],
  ['1032439-1','61112012','2452'],
  ['1032439-2','62099091','5809, 5816'],
  ['1032439-3','62093005','5810, 5815'],
  ['1032439-4','62024099','4485, 7475, 7476'],
  ['1032439-5','62022001','5833'],
  ['1032439-6','62023099','5834, 5835'],
  ['1032439-7','62024099','4484, 4487'],
  ['1032439-8','61112012','9483, 9483, 9484, 9484, 9485, 9485, 9486, 9486, 9516'],
  ['1032439-9','62093005','5930, 5931, 5932'],
  ['1032439-10','61112012','2602, 2711, 2783, 2807, 2812, 2814, 9763'],
  ['1032439-11','62093005','10781'],
  ['1032439-12','62093005','2803'],
  ['1032439-13','62092007','2890'],
  ['1032439-14','61113007','9778'],
  ['1032439-15','61143002','4550, 7192'],
  ['1032439-16','62114202','7191'],
  ['1032439-17','61142001','7553'],
  ['1032439-18','61142001','7013'],
  ['1032439-19','61142001','5727'],
  ['1032439-20','61112012','2047, 2048, 2049, 2050, 2051, 2053, 2054, 2194, 2253, 2503, 2504, 2520, 2551, 2610, 2611, 2612, 2613, 2622, 2627, 2628, 2629, 2633, 2697, 2702, 2785, 2798, 2891, 2892, 2927'],
  ['1032439-21','62099091','2193'],
  ['1032439-22','62092007','2195, 2243, 2245, 2246'],
  ['1032439-23','61113007','5670'],
  ['1032439-24','62092007','5671'],
  ['1032439-25','61062099','5544, 5675, 5723'],
  ['1032439-26','61061002','5673'],
  ['1032439-27','61051002','4064, 4065'],
  ['1032439-28','62064092','4105, 4117, 7190'],
  ['1032439-29','61061002','7006, 7011'],
  ['1032439-30','62064092','5546, 5677, 5679'],
  ['1032439-31','61112012','2505, 2506, 2507'],
  ['1032439-32','63052001','19502'],
  ['1032439-33','42022203','2915, 4931, 10843, 19503'],
  ['1032439-34','42022203','5937, 5939, 5940, 5941'],
  ['1032439-35','61082103','10791, 10791, 10791, 10791'],
  ['1032439-36','61112012','2891'],
  ['1032439-37','61171002','10819, 10820, 10823, 10824, 10825, 10826, 10827'],
  ['1032439-38','61171002','5909, 5911, 5912'],
  ['1032439-39','61112012','10767, 10768'],
  ['1032439-40','61113007','10769'],
  ['1032439-41','61159501','10803, 10803, 10803, 10804, 10804, 10804, 10805, 10805, 10805, 10806, 10806, 10806, 10807, 10808, 10808, 10808, 10809, 10830'],
  ['1032439-42','61159501','5906'],
  ['1032439-43','61112012','9757, 9758, 9758, 9758, 9758, 9758, 9758, 9759, 9759, 9759, 9759, 9760, 9760, 9761, 9762, 9762, 9762, 9762, 9763, 9770, 10757, 10757, 10757, 10758, 10758, 10758, 10759, 10760, 10760, 10760, 10761'],
  ['1032439-44','61112012','5907, 5907'],
  ['1032439-45','62093005','2245'],
  ['1032439-46','61071103','10788, 10788, 10788'],
  ['1032439-47','61112012','108, 116, 2029, 2029, 2030, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2044, 2638, 2639, 2709, 2711, 2714, 2818, 2819, 2825, 2928'],
  ['1032439-48','61119091','2031'],
  ['1032439-49','61112012','104, 2182, 2184, 2185, 2186, 2190, 2459, 2512, 2530, 2608, 2621, 2632'],
  ['1032439-50','62092007','124, 2180, 2181, 2187, 2188, 2189, 2191, 2192, 2247, 2527, 2530, 2545, 2631'],
  ['1032439-51','62099091','2251'],
  ['1032439-52','62092007','5668, 5701, 5702, 5703, 5704, 5705'],
  ['1032439-53','62069099','7194'],
  ['1032439-54','61061002','131, 4116'],
  ['1032439-55','61061002','5674'],
  ['1032439-56','62063004','5678'],
  ['1032439-57','62052092','146, 874, 4109, 4110, 4111, 4112, 4113, 4114, 4115, 7108, 7109, 7110, 7111'],
  ['1032439-58','61051002','4047, 4101, 4102, 4103, 4104, 7101, 7102, 7103, 7104, 7105'],
  ['1032439-59','61099004','7006'],
  ['1032439-60','61112012','307, 2301, 2302, 2303, 2308, 2318, 2320, 2516, 2516, 2608, 2621, 2709, 2785, 2798, 2891, 2892, 2928, 9514'],
  ['1032439-61','61113007','308, 2245, 2325, 2326, 2702'],
  ['1032439-62','61113007','5804, 5805, 5814'],
  ['1032439-63','61103099','4361, 4362, 4363, 7313, 7314'],
  ['1032439-64','61103099','5828'],
  ['1032439-65','61103099','7312'],
  ['1032439-66','61102005','4348, 7394'],
  ['1032439-67','61103099','4459'],
  ['1032439-68','62019091','4466'],
  ['1032439-69','62024099','4498'],
  ['1032439-70','62014099','4472'],
  ['1032439-71','61112012','2316'],
  ['1032439-72','62093005','2317, 2614, 2636, 2640'],
  ['1032439-73','61113007','2327, 2551, 2807, 2826'],
  ['1032439-74','61099091','5806'],
  ['1032439-75','62093005','5811'],
  ['1032439-76','62014099','7396, 7397'],
  ['1032439-77','62024099','4366'],
  ['1032439-78','62029091','7316'],
  ['1032439-79','61103099','4364, 7315'],
  ['1032439-80','62024099','4365'],
  ['1032439-81','61102005','4345, 7395'],
  ['1032439-82','62014099','4346, 4347, 4606'],
  ['1032439-83','61039099','4483'],
  ['1032439-84','61023099','7474'],
  ['1032439-85','61112012','918, 2304, 2309, 2319, 2448, 2473, 2474, 2475, 2485, 2610, 2613, 2627, 2628, 2629, 2815, 2818, 2819, 2820, 2823, 2824, 2825'],
  ['1032439-86','61113007','2447, 2450, 2472, 2615'],
  ['1032439-87','62093005','2449, 2454, 2458, 2466, 2469'],
  ['1032439-88','62014099','7455, 7456, 7457, 7458, 7459, 7460, 7461'],
  ['1032439-89','62024099','415, 4488, 4489, 4490, 4493, 4494, 4495, 7473, 7478, 7479, 7480, 7481, 7482, 7483, 7484, 7485, 7486'],
  ['1032439-90','61023099','7317'],
  ['1032439-91','61022003','7487'],
  ['1032439-92','61023099','4367'],
  ['1032439-93','62024099','4491, 4492, 4496'],
  ['1032439-94','61022003','4497, 4888, 4889, 4890'],
  ['1032439-95','62014099','412, 4462, 4464'],
  ['1032439-96','61012003','907, 4473, 4476, 4477, 4876, 4878, 4880, 4881, 4882, 4884, 4886, 7463, 7464, 7465, 7466, 7841, 7842'],
  ['1032439-97','61013099','4349, 4350, 4474, 4475'],
  ['1032439-98','61013099','7843'],
  ['1032439-99','62024099','5831, 5837, 5838, 5839'],
  ['1032439-100','62093005','2456, 2457, 2465, 2467, 2468, 2471, 2480, 2481, 2482, 2483, 2484, 2486'],
  ['1032439-101','62093005','5807, 5811, 5818'],
  ['1032439-102','62013099','7107'],
  ['1032439-103','61023099','4118'],
  ['1032439-104','61013099','4106'],
  ['1032439-105','62013099','4107'],
  ['1032439-106','62014099','4108, 4463, 7106'],
  ['1032439-107','62014099','4465, 4468, 4469, 4470, 4471'],
  ['1032439-108','62171001','5501, 5506, 5507, 5528, 5532, 5534, 5536, 5540, 5714, 5715'],
  ['1032439-109','62093005','2907, 2909'],
  ['1032439-110','62093005','5509'],
  ['1032439-111','62171001','10840'],
  ['1032439-112','62171001','4906, 4911, 7214, 7979, 7980'],
  ['1032439-113','62024099','4486, 7477'],
  ['1032439-114','62093005','2607, 2607, 2620, 2620, 2620'],
  ['1032439-115','62159091','4109, 10830'],
  ['1032439-116','62171001','4069'],
  ['1032439-117','61113007','2814'],
  ['1032439-118','62045991','4907'],
  ['1032439-119','62045399','4908, 7975'],
  ['1032439-120','62045203','4909'],
  ['1032439-121','61045302','7976'],
  ['1032439-122','61045302','4220'],
  ['1032439-123','61112012','2246, 2611, 2816, 2817, 2892, 2929'],
  ['1032439-124','62093005','2803, 2927'],
  ['1032439-125','61113007','2901, 2902, 2928'],
  ['1032439-126','61119091','5516'],
  ['1032439-127','61045302','5519, 5520, 5521, 5544, 5545, 5548'],
  ['1032439-128','61045991','5547'],
  ['1032439-129','62045399','4901, 4902, 7970, 7973'],
  ['1032439-130','61045302','4903, 4904, 4935, 4937, 7969, 7971, 7974'],
  ['1032439-131','62045203','4905, 4906'],
  ['1032439-132','61045201','4936'],
  ['1032439-133','62045991','7972'],
  ['1032439-134','62045399','5517, 5518, 5522, 5546'],
  ['1032439-135','63022101','9529'],
  ['1032439-136','63021001','9529, 9532'],
  ['1032439-137','62050004','5917'],
  ['1032439-138','65050004','2312, 2452, 2502, 2511, 2514, 2520, 2546, 2606, 2618, 2626, 2639, 2782, 2790, 2888, 4339, 9514, 9516, 9766, 9767, 9770, 9771, 9774, 9775, 10767, 10768, 10769, 10772, 10823, 10824, 10825, 10826, 10827, 10833, 10834'],
  ['1032439-139','62050004','5913, 5914, 5915, 5916'],
  ['1032439-140','61169991','10815, 10816'],
  ['1032439-141','61169301','10823, 10826'],
  ['1032439-142','61112012','9766, 9767, 10768, 10772'],
  ['1032439-143','61113007','10769'],
  ['1032439-144','61112012','2601, 2602, 2603, 2605, 2616, 2617, 2618, 2619, 2776, 2777, 2777, 2778, 2778, 2779, 2780, 2781, 2781, 2782, 2790, 2791, 2792, 2793, 2794, 2794, 2795, 2796, 2796, 9516'],
  ['1032439-145','61113007','2606, 2615'],
  ['1032439-146','63013001','9489, 9490'],
  ['1032439-147','63014001','9491, 9492'],
  ['1032439-148','63013001','19476'],
  ['1032439-149','63014001','9477'],
  ['1032439-150','42029204','10785, 10846, 19507'],
  ['1032439-151','42029204','5942'],
  ['1032439-152','61143002','5714, 5715'],
  ['1032439-153','62093005','2180, 2189, 2527, 9771'],
  ['1032439-154','62093005','5701, 5702, 5703, 5944'],
  ['1032439-155','61113007','5704'],
  ['1032439-156','61112012','2608, 2621, 2622, 2630, 2633, 2638'],
  ['1032439-157','62092007','2631, 2632, 2637, 2697'],
  ['1032439-158','62092007','2244, 2247, 2248, 2249, 2250, 2251'],
  ['1032439-159','62092007','2248'],
  ['1032439-160','61113007','2252, 2253'],
  ['1032439-161','62093005','5701, 5702, 5707'],
  ['1032439-162','62046392','4217, 4218, 4219, 7214'],
  ['1032439-163','62046999','7213'],
  ['1032439-164','62046392','5709, 5710, 5711, 5712'],
  ['1032439-165','61046991','5720'],
  ['1032439-166','62092007','502, 510, 521, 563, 593, 2517, 2519, 2521, 2522, 2523, 2524, 2527, 2528, 2529, 2533, 2534, 2535, 2536, 2537, 2547, 2548'],
  ['1032439-167','61112012','514, 560, 702, 702, 704, 918, 918, 2243, 2501, 2502, 2503, 2504, 2505, 2506, 2507, 2509, 2510, 2511, 2512, 2513, 2514, 2515, 2516, 2518, 2520, 2525, 2526, 2530, 2532, 2538, 2540, 2541, 2542, 2543, 2546, 2610, 2612, 2613, 2614, 2623, 2623, 2624, 2624, 2625, 2625, 2626, 2627, 2628, 2629, 2635, 2635, 2636, 2639, 2640, 2641, 2702, 2703, 2704, 2705, 2707, 2709, 2710, 2711, 2712, 2713, 2714, 2783, 2784, 2784, 2785, 2786, 2786, 2798, 2815, 2815, 2818, 2819, 2820, 2820, 2821, 2822, 2822, 2823, 2823, 2824, 2825, 2826, 2893, 9514, 9751, 9753, 9754, 10764'],
  ['1032439-168','61113007','727, 2508, 2531, 2549, 2550, 2551, 2706, 2708, 2827'],
  ['1032439-169','62093005','2539, 2544, 2545'],
  ['1032439-170','61119091','9752'],
  ['1032439-171','62093005','5703'],
  ['1032439-172','61113007','5704'],
  ['1032439-173','61112012','5705'],
  ['1032439-174','61119091','5706'],
  ['1032439-175','61046203','4544'],
  ['1032439-176','61046399','7544, 7553'],
  ['1032439-177','62046209','7546'],
  ['1032439-178','61046203','511, 722, 4704, 4710, 4711, 4711, 4712, 4713, 4887, 4888, 4889, 4890, 7548, 7549, 7551, 7845'],
  ['1032439-179','62046209','527, 557, 577, 578, 4543, 4546, 4547, 4548, 7545, 7547'],
  ['1032439-180','61046399','712, 717, 4545, 4549, 4550, 4551, 4552, 4553, 4554, 4703, 4705, 4706, 4707, 4708, 4709, 4888, 4891, 7552, 7554, 7555, 7751, 7752, 7753, 7754, 7755, 7846'],
  ['1032439-181','61046991','4701, 4702, 7750, 10812'],
  ['1032439-182','62046392','7543'],
  ['1032439-183','62046999','7550'],
  ['1032439-184','62046392','5716'],
  ['1032439-185','62046209','5717'],
  ['1032439-186','61046991','5721, 5725'],
  ['1032439-187','61046399','5722, 5723'],
  ['1032439-188','61046203','5726, 5727'],
  ['1032439-189','62034292','504, 513, 516, 517, 530, 537, 582, 4527, 4529, 4530, 4531, 4533, 4534, 4535, 4536, 4537, 4538, 4539, 4540, 4541, 7531, 7532, 7533, 7534, 7535, 7536, 7538, 7539, 7540, 7541, 7542'],
  ['1032439-190','61034203','705, 725, 907, 907, 4532, 4542, 4605, 4606, 4876, 4877, 4878, 4879, 4879, 4880, 4881, 4882, 4882, 4883, 4884, 4884, 4885, 4886, 7530, 7537, 7840, 7841, 7842, 7843, 7844'],
  ['1032439-191','61034991','4528'],
  ['1032439-192','61112012','2244, 2249, 2250, 2631, 2634, 2814, 2816, 2817, 10752, 10753, 10754'],
  ['1032439-193','61113007','5901'],
  ['1032439-194','61112012','5905'],
  ['1032439-195','61152201','5902, 5903, 5904'],
  ['1032439-196','61152201','10794, 10795'],
  ['1032439-197','61152101','10798, 10799, 10800'],
  ['1032439-198','61112012','2701, 2787, 2788, 2789, 2797'],
  ['1032439-199','61112012','125, 2183, 2775, 2775'],
  ['1032439-200','62092007','2609, 2609'],
  ['1032439-201','62093005','2634'],
  ['1032439-202','62093005','2467'],
  ['1032439-203','62099091','2470'],
  ['1032439-204','62014099','4467'],
  ['1032439-205','61112012','9798'],
  ['1032439-206','61113007','2604'],
  ['1032439-207','61112012','2250, 2455, 2461, 2462, 2476, 2510, 2513, 2514, 2515, 2528, 2544, 2546, 2612, 2614, 2640, 2707, 2710, 2712, 2713, 2784, 2784, 2786, 2786, 2821'],
  ['1032439-208','61113007','2508, 2706, 2708, 2816, 2827, 2929'],
  ['1032439-209','61102005','4479, 7467, 7468, 7470, 7471, 7753, 7754, 7755'],
  ['1032439-210','61103099','7472'],
  ['1032439-211','61103099','5545, 5548, 5819, 5820, 5821'],
  ['1032439-212','61102005','4220, 4481, 4482, 4551, 4707, 4708, 4709, 4712, 4887, 4937'],
  ['1032439-213','61103099','4478, 4480, 4554, 4706, 4710, 4891'],
  ['1032439-214','61102005','5726'],
  ['1032439-215','61102005','4449, 4452, 4454, 4455, 4456, 4605, 4883, 4885, 7448, 7451, 7453, 7488, 7844'],
  ['1032439-216','63022201','9480'],
  ['1032439-217','63021001','19536'],
  ['1032439-218','63022101','9532, 9532'],
  ['1032439-219','94043001','9543, 19539, 19544'],
  ['1032439-220','61113007','2463'],
  ['1032439-221','61112012','2464, 2893'],
  ['1032439-222','61119091','5706'],
  ['1032439-223','61113007','5808'],
  ['1032439-224','61032201','4460'],
  ['1032439-225','61033302','7454'],
  ['1032439-226','61112012','2460, 2623, 2623, 2624, 2624, 2625, 2625, 2635, 2635, 2636, 2822, 2826'],
  ['1032439-227','61113007','2641'],
  ['1032439-228','61102005','7469, 7845'],
  ['1032439-229','61103099','7555, 7846'],
  ['1032439-230','61103099','5725'],
  ['1032439-231','61103099','4552, 4936'],
  ['1032439-232','61102005','4450, 4451, 4453, 4457, 4458, 4877, 4879, 7444, 7445, 7447, 7449, 7450, 7452'],
  ['1032439-233','61103099','7840'],
  ['1032439-234','61112012','309, 351, 2045, 2243, 2249, 2305, 2306, 2307, 2310, 2311, 2312, 2313, 2315, 2322, 2501, 2502, 2509, 2511, 2517, 2518, 2519, 2529, 2549, 2626, 2783, 2817'],
  ['1032439-235','61119091','2046, 2314, 2323'],
  ['1032439-236','61113007','2244, 2321, 2324, 2550'],
  ['1032439-237','61113007','5516, 5803, 5812, 5813'],
  ['1032439-238','61112012','5801, 5802'],
  ['1032439-239','61103099','4061, 4062, 4354, 4355, 4359, 4360, 7301, 7304, 7306, 7309, 7310, 7311'],
  ['1032439-240','61102005','7307'],
  ['1032439-241','61103099','5547, 5720, 5721, 5722, 5822, 5823, 5824, 5825, 5826, 5827, 5829, 5830'],
  ['1032439-242','61102005','5672'],
  ['1032439-243','61103099','145, 4353, 4356, 4357, 4358, 4553, 4935, 7001, 7302, 7303, 7305, 7308, 7554'],
  ['1032439-244','61102005','313, 345, 7002'],
  ['1032439-245','61102005','311, 323, 354, 4335, 4337, 4338, 4340, 4341, 4344, 4351, 7391, 7392, 7393'],
  ['1032439-246','61103099','4334, 4343, 7390'],
  ['1032439-247','61103099','4339'],
  ['1032439-248','61091003','4066, 4067, 4068, 4069, 4070, 4071, 4072, 4073, 4705, 4711, 4713, 4889, 7003, 7004, 7008, 7009, 7010, 7014, 7016, 7017, 7018, 7094'],
  ['1032439-249','61099004','7007, 7015'],
  ['1032439-250','61091003','4039, 4040, 4041, 4041, 4042, 4043, 4044, 4046'],
  ['1032439-251','61092003','4045'],
  ['1032439-252','62093005','9771'],
  ['1032439-253','62093005','5933, 5935'],
  ['1032439-254','63026006','9525, 9526'],
  ['1032439-255','62041302','5728'],
  ['1032439-256','62093005','5669'],
  ['1032439-257','61091003','7005, 7012'],
  ['1032439-258','61091003','178, 830, 4063'],
  ['1032439-259','61091003','4059, 4606, 4878, 4886'],
  ['1032439-260','61091003','173, 842, 4048, 4049, 4050, 4051, 4052, 4053, 4053, 4054, 4055, 4056, 4057, 4058, 4060, 4880, 7077, 7078, 7079, 7080, 7081, 7082, 7083, 7083, 7084, 7085, 7086, 7087, 7088, 7089, 7090, 7090, 7091, 7092, 7093'],
  ['1032439-261','61112012','2703, 2802, 2807, 2812, 2884, 2885, 2888, 2894, 2896, 2908, 2917, 2922, 2924, 2926'],
  ['1032439-262','62092007','2801, 2808, 2813, 2882, 2883, 2886, 2887, 2910, 2921, 2925'],
  ['1032439-263','62093005','2804, 2805, 2806, 2809, 2810, 2890, 2903, 2904, 2909, 2913, 2923'],
  ['1032439-264','61113007','2811, 2880, 2881, 2906, 2907, 2911, 2914, 2915, 2916, 2918, 2919, 2920'],
  ['1032439-265','62093005','5501, 5502, 5503, 5504, 5505, 5506, 5507, 5508, 5509, 5511, 5512, 5513, 5514'],
  ['1032439-266','62099091','5510, 5515'],
  ['1032439-267','61044402','4912'],
  ['1032439-268','62044399','7979, 7980'],
  ['1032439-269','61044302','7984, 7987'],
  ['1032439-270','61044203','7986'],
  ['1032439-271','62044399','5523, 5524, 5525, 5526, 5527, 5528, 5529, 5530, 5531, 5532, 5535, 5536, 5537, 5539, 5541, 5542'],
  ['1032439-272','61044302','5534, 5538'],
  ['1032439-273','61044402','5540'],
  ['1032439-274','62044499','5543'],
  ['1032439-275','61044302','4910, 4912, 4916, 4918, 4922, 4922, 4924, 4925, 4925, 4926, 4928, 4929, 4932, 4932, 4934'],
  ['1032439-276','62044399','4911, 4914, 4915, 4919, 7977, 7981'],
  ['1032439-277','62043399','4913'],
  ['1032439-278','62044499','4917, 4920, 4923'],
  ['1032439-279','61044991','4921, 7985'],
  ['1032439-280','61044203','4927, 4927, 4930, 4931, 4933, 7982, 7983, 7986'],
  ['1032439-281','42023203','19511'],
  ['1032440','48205001','80143'],
  ['1032440-1','48205001','80029, 80043, 80057'],
  ['1032440-2','48205001','80108'],
  ['1032440-3','48205001','80001, 80072'],
  ['1032440-4','94042999','19473, 19506, 19511'],
  ['1032440-5','96159099','10778, 10837'],
  ['1032440-6','96151101','5923, 5924, 5925, 5926, 5927, 5928, 5929'],
  ['1032440-7','96151999','5918, 5918, 5919, 5919, 5920, 5920, 5921, 5921, 5922, 5931'],
  ['1032441','42022203','4365, 10849, 19500, 19501, 19502'],
  ['1032441-1','42022203','5938'],
  ['1032441-2','42029204','10852, 19506'],
  ['1032441-3','42029204','19510'],
  ['1032441-4','42029204','19522'],
  ['1032441-5','42023203','19519'],
  ['1032441-6','42029204','19502'],
  ['1032442','95030012','9495, 19497'],
];

$folios_file = $root . "/pltoolbox/mayoral/resources/TempFiles/items_sin_folio.csv";
$folios_file = fopen($folios_file, "w");

fputcsv($folios_file, ['Linea', 'Fraccion', 'Modelo']);

foreach ($cnt_1_A24000069 as $uva){
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

  $has_pb = false;

  while ($idents = $identificadores_aplicables->fetch_assoc()) {
    $folio = "";

    // if ($idents['identificador'] != "PB") {
        $comple1 = $idents['identificador'] == "PB" ? $uvnom : $idents['complemento1'];
        // $comple3 = $idents['identificador'] == "PB" ? "" : $idents['complemento3'];
        $identificadores[$numero_parte . "_" . $i]['identificadores'][$idents['pk_identificador']] = array($numero_parte, $idents['identificador'], $comple1, $idents['complemento2'], $idents['complemento3'], $idents['complemento4']);
    // }

    
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


  // while ($idents = $identificadores_aplicables->fetch_assoc()) {
  //   $folio = "";

  //   if ($idents['identificador'] != "PB") {
  //       // $comple1 = $idents['identificador'] == "PB" ? $uvnom : $idents['complemento1'];
  //       // $comple3 = $idents['identificador'] == "PB" ? "" : $idents['complemento3'];
  //       $identificadores[$numero_parte . "_" . $i]['identificadores'][$idents['pk_identificador']] = array($numero_parte, $idents['identificador'], $idents['complemento1'], $idents['complemento2'], $idents['complemento3'], $idents['complemento4']);
  //   }

    
  //   if ($idents['identificador'] == "PB") {
  //     $clave = $item[10] . "_" . $item[2];
  //     $folio = $folios_computados[$clave];

  //     if ($folio == "") {
  //       $datos_error = [
  //         $i, //linea,
  //         $item[10], //fraccion
  //         $item[2], //modelo
  //       ];
  //       fputcsv($folios_file, $datos_error);
  //       error_log("PERMISOERR: La linea $i ($item[10] - $item[2]) debe tener folio, y no se encontro\n");
  //     }

  //     $permisos .=
  //       $numero_parte . "|" .
  //       "N3|" .
  //       $idents['complemento2'] . "|" .
  //       $folio . "|||"
  //     ;
  //   }
  // }

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
