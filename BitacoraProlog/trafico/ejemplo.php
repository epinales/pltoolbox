<?php
$root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';
require $root . '/pltoolbox/stylesheets.php';
require $root . '/pltoolbox/links.php';
 ?>


 <form id="formulario" class="">
   <table class="table">
     <tr class="row">
       <td class="col-md-3">
         <input class="importe" type="text" name="" value="200">
       </td>
       <td class="col-md-3">
         <input class="saldo" type="text" name="" value="">
       </td>
       <td class="col-md-3">
         <input class="nombre" type="text" name="" value="">
       </td>
       <td class="col-md-2">
         <input class="apellido" type="text" name="" value="pinales">
       </td>
       <td class="col-md-1">
         <button class="agregar" type="button" name="button"> agregar</button>
       </td>
     </tr>
     <tr class="row">
       <td class="col-md-3">
         <input class="importe" type="text" name="" value="">
       </td>
       <td class="col-md-3">
         <input class="saldo" type="text" name="" value="">
       </td>
       <td class="col-md-3">
         <input class="nombre" type="text" name="" value="">
       </td>
       <td class="col-md-2">
         <input class="apellido" type="text" name="" value="avalos">
       </td>
       <td class="col-md-1">
         <button class="agregar" type="button" name="button"> agregar</button>
       </td>
     </tr>
   </table>
 </form>

<script src="/pltoolbox/BitacoraProlog/trafico/js/trafico.js"></script>
