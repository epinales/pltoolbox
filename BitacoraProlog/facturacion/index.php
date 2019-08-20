<?php
  session_start();

  if (!isset($_SESSION['user'])) {
    header("Location: /pltoolbox/index.php");
  }

  $activoTrafico = "";
  $activoFact = "activo b";


  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/pltoolbox/BitacoraProlog/barraNavegacion.php';
?>


<form class="p-0 mb-3">
  <ol class="breadcrumb bread py-2 mb-1  align-items-center">
    <li class="breadcrumb-item abread">Bitacora Prolog</li>
    <li class="breadcrumb-item b">
      <b>
        <input class="bt border-0" id="pruebaOficinaFact" type="text" value="<?php echo $_SESSION['user']['u_oficina'] ?>" readonly>
      </b>
    </li>
    <li class="b ml-auto text-center mr-4">

      <button id="add_fact" type="button" class="modalFacturacion add-boton btn-outline-dark" data-toggle="modal" data-target="#agregarFacturacion">Agregar</button>
    </li>
  </ol>
</form>


<table class="table w-100">
  <tr class="row m-0">
    <td class="w-30 p-0 border-right">
      <table class="table table-hover">
        <thead>
          <tr class="row m-0 text-center">
            <td class="col-md-12 b activo">Referencias En Trafico</td>
          </tr>
        </thead>
        <tbody id="listaRefTrafico"></tbody>
      </table>
    </td>
    <td class="w-70 p-0">
      <table class="table table-hover">
        <thead>
          <tr class="row m-0 text-center">
            <td class="col-md-12 b activo">Referencias En Facturación</td>
          </tr>
        </thead>
        <tbody id="listaRefFacturacion"></tbody>
      </table>
    </td>
  </tr>
</table>


<script src="/pltoolbox/BitacoraProlog/trafico/js/trafico.js"></script>
<script src="/pltoolbox/BitacoraProlog/facturacion/js/facturacion.js"></script>


<?php
  require $root . '/pltoolbox/BitacoraProlog/footer.php';
  require $root . '/pltoolbox/BitacoraProlog/facturacion/modales/modal.php';
?>
