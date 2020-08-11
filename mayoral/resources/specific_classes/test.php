<?php

require "csv_to_utf8.php";

$cv = new convert_csv_to_utf8("/Applications/MAMP/htdocs/pltoolbox/mayoral/resources/helper_files/32191_INVOICE.csv", "/Applications/MAMP/htdocs/pltoolbox/mayoral/resources/helper_files/32191_INVOICE_UTF8.csv");

echo $cv;
 ?>
