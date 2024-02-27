<?php


$txt_file = "";

$txt_array = array();



function remove_n($txt){
    $txt = str_replace(iconv('UTF-8', 'ASCII', "ñ"),"n",$txt);
    $txt = str_replace(iconv('UTF-8', 'ASCII', "Ñ"),"N",$txt);
    return $txt;
}


$txt_array[$invoice_num]['header'] = array(
    $invoice_num,                   //NumeroFactura
    $invoice_num,                   //NumeroFactura - reemplaza número de órden
    $fecha_factura,                 //Fecha -- Hoy es default
    'ESP',                          //Siempre se pone ESP(España) como país facturación
    '',                             //Siempre se pone MA(Málaga) como entidad de facturación
    $item[15],                      //Moneda --
    'CIF',                          //Poner un campo para seleccionar el INCOTERM.
    $importe_total_factura,         //Valor Moneda Extranjera
    $importe_total_factura,         //Valor Comercial - Factura
    0,0,0,0,0,                      //Flete, Seguros, Embalajes, Incrementables, Deducibles
    1,                              //FactorMonedaExtranjera
);

$txt_array[$invoice_num]['items'][] = array(
    $numero_parte,                                          //Numero de Parte,
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