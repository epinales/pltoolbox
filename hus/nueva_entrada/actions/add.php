<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

extract($_POST);

$add_entry_query = "INSERT INTO humanagement_entry(entry_number, carrier, trailer_number_plates, guide_bol, added_by) VALUES(?, ?, ?, ?, ?)";
$add_pallet_query = "INSERT INTO humanagement_entry_pallet (fkid_entry, pallet_number, part_number) VALUES (?, ?, ?)";
$add_hu_query = "INSERT INTO humanagement_entry_pallet_hu (fkid_pallet, hu_number) VALUES (?,?)";

$add_entry_query = $toolbox->prepare($add_entry_query);
$add_pallet_query = $toolbox->prepare($add_pallet_query);
$add_hu_query = $toolbox->prepare($add_hu_query);

$toolbox->query('LOCK TABLES humanagement_entry, humanagement_entry_pallet, humanagement_entry_pallet_hu WRITE;');
$toolbox->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

try {



$add_entry_query->execute();

} catch (\Exception $e) {

}



 ?>
