<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/pltoolbox/dashProlog/barraNavegacion.php';
?>

<form class="p-0" style='font-family: 'Source Sans Pro', sans-serif!important;'>
  <ol class="breadcrumb bread py-2">
    <li class="breadcrumb-item"><a href="/pltoolbox/bienvenido.php" class="abread">Home</a></li>


    <li class="breadcrumb-item b"><b>Dashboard</b></li>


    <!-- <li class="b text-center"></li> -->


    <li class="b ml-auto text-center mr-4">
      <a href="#modal" data-toggle="modal" class="bt noborder w-100 mr-2">
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
      <input type="date" class='efecto-2' value=""> a
      <input type="date" class='efecto-2' value="">
    </li>

  </ol>
  <div id="carousel-graficas" class="carousel carrusel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="row">
          <div class="col"></div>
          <div class="col-md-10 titulo-grafica">Miles.- Amount of miles driven per week</div>
          <div class="col"></div>
        </div>

        <div class="row mt-3">
          <div class="col"></div>
          <div class="col-md-5 border-grafica mr-2">
            <div id="chart"></div>
          </div>
          <div class="col-md-5 border-grafica ml-2">
            <div id="chart1"></div>
          </div>
          <div class="col"></div>
        </div>

        <div class="row mt-4">
          <div class="col"></div>
          <div class="col-md-10 titulo-grafica">Miles per tractor.- Prolog Trucks</div>
          <div class="col"></div>
        </div>

        <div class="row mt-3">
          <div class="col"></div>
          <div class="col-md-5 border-grafica mr-2">
            <div id="chart2"></div>
          </div>
          <div class="col-md-5 border-grafica ml-2">
            <div id="chart3"></div>
          </div>
          <div class="col"></div>
        </div>
      </div>

      <div class="carousel-item">
        <div class="row">
          <div class="col"></div>
          <div class="col-md-10 titulo-grafica">Linehauls and Sat Index.- Amount of trips and truck usage </div>
          <div class="col"></div>
        </div>

        <div class="row mt-3">
          <div class="col"></div>
          <div class="col-md-5 border-grafica mr-2">
            <div id="chart4"></div>
          </div>
          <div class="col-md-5 border-grafica ml-2">
            <div id="chart5"></div>
          </div>
          <div class="col"></div>
        </div>


        <div class="row mt-4">
          <div class="col"></div>
          <div class="col-md-10 titulo-grafica">Sales and Rate per Mile ratio</div>
          <div class="col"></div>
        </div>

        <div class="row mt-3">
          <div class="col"></div>
          <div class="col-md-5 border-grafica mr-2">
            <div id="chart6"></div>
          </div>
          <div class="col-md-5 border-grafica ml-2">
            <div id="chart7"></div>
          </div>
          <div class="col"></div>
        </div>
      </div>
    </div>

    <a class="carousel-control-prev" href="#carousel-graficas" role="button" data-slide="prev" style='width:6%!important'>
      <img src="/pltoolbox/Resources/iconos/back2.svg" style='width: 60px!important;'>
    </a>
    <a class="carousel-control-next" href="#carousel-graficas" role="button" data-slide="next" style='width:6%!important'>
      <img src="/pltoolbox/Resources/iconos/next.svg" style='width: 60px!important;'>

    </a>
  </div>
</form>

<?php
  require $root . '/pltoolbox/dashProlog/footer.php';
?>
