<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';
require $root . '/pltoolbox/Resources/vendor/autoload.php';

/****************************************************

ESTE DOCUMENTO GENERA EL ARCHIVO DE EXCEL PARA SUBIR MARCAS Y MODELOS A GLOBAL.

CAMPOS:

  PRODUCTO    - Es en numero de parte del producto
  ITEM        - Es el número de ITEM de la factura. Este archivo debe de subirse por factura, por lo que se genera un archivo por factura.
  MARCA       - Es la marca del producto
  MODELO      - Es el modelo del producto
  SUBMODELO   - Es el submodelo del producto
  SERIE       - Es la serie del producto

****************************************************/



$excel = array();
$spreadsheets = array();

$file_factura_mayoral = fopen($root . '/pltoolbox/mayoral/resources/helper_files/factura_aeropuerto_II.csv','r');

fgetcsv($file_factura_mayoral);
while ($row = fgetcsv($file_factura_mayoral, 1000)) {
  $record = array();
  if ($row[1] == ".") {
    continue;
  }
  $excel[$row[1]][] = array(
    $record[] = $row[10], //NumeroParte
    $record[] = $row[8], //Item
    $record[] = $row[36], //Item
    $record[] = $row[11], //Moelo
  );
}



foreach ($excel as $key => $value) {
  $spreadsheets[$key] = new Spreadsheet();
}

foreach ($spreadsheets as $name => $data) {
  $xlsActive = $data->getActiveSheet();

  $xlsActive->setCellValue("A1", "PRODUCTO");
  $xlsActive->setCellValue("B1", "ITEM");
  $xlsActive->setCellValue("C1", "MARCA");
  $xlsActive->setCellValue("D1", "MODELO");
  $xlsActive->setCellValue("E1", "SUBMODELO");
  $xlsActive->setCellValue("F1", "SERIE");

  $x = 1;
  foreach ($excel[$name] as $line) {
    $x++;
    $xlsActive->getCell("A$x")->setValueExplicit(
      $line[0],
      \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
    );
    // $xlsActive->setCellValue("A$x", "'" . $line[0]);
    $xlsActive->setCellValue("B$x", $line[1]);
    $xlsActive->setCellValue("C$x", $line[2]);
    $xlsActive->setCellValue("D$x", $line[3]);
    $xlsActive->setCellValue("E$x", "");
    $xlsActive->setCellValue("F$x", "");
  }

  $file = $root . "/pltoolbox/mayoral/resources/TempFiles/marcasModelos_$name";
  $file = str_replace(".","",$file);
  $file = $file . ".xlsx";
  $writeXLS = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($data);
  // $file = "/home/esantos/Crons/TempFiles/detalle_pedimentos_$cliente_rfc.xlsx";
  $writeXLS->save($file);

}











 ?>
