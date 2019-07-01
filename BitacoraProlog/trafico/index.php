<?php
  session_start();

  if (!isset($_SESSION['user'])) {
    header("Location: /pltoolbox/index.php");
  }
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/pltoolbox/BitacoraProlog/barraNavegacion.php';
?>


<form class="p-0 mb-5">
  <ol class="breadcrumb bread py-2 mb-1">
    <li class="breadcrumb-item"><a href="/pltoolbox/bienvenido.php" class="abread">Home</a></li>
    <li class="breadcrumb-item b"><b>Trafico</b></li>
    <li class="b ml-auto text-center mr-4">
      <a href="#agregarTrafico" data-toggle="modal"  class="modalTrafico bt noborder w-100 mr-2">
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
    </li>
  </ol>
  <table class="table table-hover fixed-table mb-5">
    <tbody id="lista_trafico" style="font-family: 'Source Sans Pro';"></tbody>
  </table>
</form>
<script src="/pltoolbox/BitacoraProlog/trafico/js/trafico.js"></script>


<?php
  require $root . '/pltoolbox/BitacoraProlog/footer.php';
  require $root . '/pltoolbox/BitacoraProlog/trafico/modales/modal.php';
?>
