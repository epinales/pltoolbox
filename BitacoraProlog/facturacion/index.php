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
    <li class="breadcrumb-item b"><b><?php echo $_SESSION['user']['u_oficina'] ?></b></li>
    <li class="b ml-auto text-center mr-4">

      <button id="add_fact" type="button" class="modalFacturacion add-boton btn-outline-dark" data-toggle="modal" data-target="#agregarFacturacion">Agregar</button>

      <!-- <a id="mas_fact" href="#" class="bt noborder w-100 mr-2">
        <span class="img3">
          <svg class="w-28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 502 502">
          	<path style="text-indent:0;text-align:start;line-height:normal;text-transform:none;block-progression:tb;-inkscape-font-specification:Bitstream Vera Sans"
            d="M251,502c-67.045,0-130.076-26.108-177.483-73.516C26.108,381.076,0,318.044,0,251S26.108,120.924,73.517,73.516
        			C120.924,26.108,183.955,0,251,0s130.076,26.108,177.483,73.516C475.892,120.924,502,183.956,502,251
        			s-26.108,130.076-73.517,177.484C381.076,475.892,318.045,502,251,502z M251,20C123.626,20,20,123.626,20,251s103.626,231,231,231
        			s231-103.626,231-231S378.374,20,251,20z"/>
            <path d="M251,445.5c-22.721,0-41.205-18.484-41.205-41.205v-112.09H97.705C74.984,292.205,56.5,273.721,56.5,251
      				s18.484-41.205,41.205-41.205h112.09V97.705c0-22.721,18.484-41.205,41.205-41.205s41.205,18.484,41.205,41.205v112.09h112.09
      				c22.721,0,41.205,18.484,41.205,41.205s-18.484,41.205-41.205,41.205h-112.09v112.09C292.205,427.016,273.721,445.5,251,445.5z
      				 M97.705,229.795c-11.692,0-21.205,9.513-21.205,21.205s9.513,21.205,21.205,21.205h122.09c5.522,0,10,4.477,10,10v122.09
      				c0,11.692,9.513,21.205,21.205,21.205s21.205-9.513,21.205-21.205v-122.09c0-5.523,4.478-10,10-10h122.09
      				c11.692,0,21.205-9.513,21.205-21.205s-9.513-21.205-21.205-21.205h-122.09c-5.522,0-10-4.477-10-10V97.705
      				c0-11.692-9.513-21.205-21.205-21.205s-21.205,9.513-21.205,21.205v122.09c0,5.523-4.478,10-10,10H97.705z"/>
          	<path d="M217,258h-56c-5.522,0-10-4.477-10-10s4.478-10,10-10h56c5.522,0,10,4.477,10,10S222.522,258,217,258z"/>
            <path d="M126.671,258h-22.887c-5.522,0-10-4.477-10-10s4.478-10,10-10h22.887c5.522,0,10,4.477,10,10S132.193,258,126.671,258z"
      				/>
          </svg>
        </span>
      </a>

      <a id="menos_fact" href="#" class="bt noborder w-100 mr-2" style="display:none">
        <span class="img3">
          <svg class="w-28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44.238 44.238">
            <path d="M22.119,44.237C9.922,44.237,0,34.315,0,22.12C0,9.924,9.922,0.001,22.119,0.001S44.238,9.923,44.238,22.12
        			S34.316,44.237,22.119,44.237z M22.119,1.501C10.75,1.501,1.5,10.751,1.5,22.12s9.25,20.619,20.619,20.619
        			s20.619-9.25,20.619-20.619S33.488,1.501,22.119,1.501z"/>
              <path d="M31.434,22.869H12.805c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h18.628c0.414,0,0.75,0.336,0.75,0.75
        				S31.848,22.869,31.434,22.869z"/>
          </svg>
        </span>
      </a> -->
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



<script src="/pltoolbox/BitacoraProlog/facturacion/js/facturacion.js"></script>
<script src="/pltoolbox/BitacoraProlog/trafico/js/trafico.js"></script>


<?php
  require $root . '/pltoolbox/BitacoraProlog/footer.php';
  require $root . '/pltoolbox/BitacoraProlog/facturacion/modales/modal.php';
?>
