<?php
  require $root . '/pltoolbox/BitacoraProlog/opcionesOficina/modales/opcionesOficina.php';
?>

<footer class="footer">
  <li class="nav-item">
    <div class="row justify-content-center m-3">
      <div class="col-md-1 text-center">
        <input type="hidden" id="oficinaUsuario" value="<?php echo $_SESSION['user']['u_oficina'] ?>" db-id="<?php echo $_SESSION['user']['u_oficina'] ?>">
        <a  class="noborder w-100 m-4" href="/pltoolbox/Resources/PHP/Utilities/cerrarSesion.php">
          <span class="img2"><svg class='w-32' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 502 502">
        	<path style="text-indent:0;text-align:start;line-height:normal;text-transform:none;block-progression:tb;-inkscape-font-specification:Bitstream Vera Sans" d="M428.483,73.517C381.076,26.108,318.045,0,251,0S120.924,26.108,73.517,73.517C26.108,120.924,0,183.955,0,251
        		s26.108,130.076,73.517,177.483C120.924,475.892,183.955,502,251,502s130.076-26.108,177.483-73.517
        		C475.892,381.076,502,318.045,502,251S475.892,120.924,428.483,73.517z M251,482C123.626,482,20,378.374,20,251
        		S123.626,20,251,20s231,103.626,231,231S378.374,482,251,482z"/>
        	<path d="M295.434,249l69.658-69.657c12.525-12.527,12.525-32.908,0-45.434c-6.069-6.068-14.137-9.41-22.718-9.41
        		c-8.581,0-16.65,3.343-22.717,9.41L250,203.566l-69.657-69.656c-6.068-6.068-14.136-9.411-22.717-9.411
        		c-8.581,0-16.65,3.342-22.718,9.41c-12.525,12.527-12.525,32.908,0,45.434L204.566,249l-69.658,69.657
        		c-12.526,12.527-12.526,32.909,0.001,45.436c6.069,6.066,14.136,9.407,22.717,9.407c8.582,0,16.65-3.341,22.717-9.408
        		L250,294.434l69.657,69.658c6.068,6.067,14.135,9.408,22.717,9.408c8.581,0,16.648-3.341,22.718-9.408
        		c12.526-12.527,12.526-32.909,0-45.435L295.434,249z M350.95,349.948c-2.291,2.29-5.336,3.552-8.576,3.552
        		c-3.239,0-6.285-1.261-8.574-3.551l-76.729-76.729c-1.876-1.875-4.419-2.929-7.071-2.929s-5.195,1.054-7.071,2.929L166.2,349.949
        		c-2.289,2.29-5.335,3.551-8.574,3.551c-3.24,0-6.285-1.262-8.575-3.551c-4.729-4.728-4.729-12.421,0-17.149l76.729-76.729
        		c1.875-1.876,2.929-4.419,2.929-7.071c0-2.652-1.054-5.195-2.929-7.071L149.051,165.2c-4.729-4.727-4.729-12.42,0-17.148
        		c2.29-2.291,5.336-3.553,8.575-3.553c3.239,0,6.284,1.262,8.574,3.553l76.728,76.728c3.907,3.904,10.237,3.904,14.143,0
        		l76.729-76.729c2.29-2.29,5.335-3.552,8.574-3.552s6.285,1.262,8.575,3.553c4.729,4.727,4.729,12.42,0,17.148l-76.729,76.729
        		c-1.875,1.876-2.929,4.419-2.929,7.071s1.054,5.195,2.929,7.071l76.729,76.729C355.678,337.527,355.678,345.22,350.95,349.948z"
        		/>
        	<path d="M168.913,67.198c-2.504-4.924-8.526-6.886-13.446-4.38c-34.189,17.389-63.035,43.789-83.422,76.346
        		C51.081,172.642,40,211.313,40,251c0,5.522,4.478,10,10,10s10-4.478,10-10c0-72.283,40.055-137.56,104.533-170.356
        		C169.456,78.14,171.417,72.12,168.913,67.198z"/>
        	<path d="M209.99,64.187c0.673,0,1.356-0.069,2.04-0.21C224.762,61.338,237.873,60,251,60c5.522,0,10-4.478,10-10s-4.478-10-10-10
        		c-14.487,0-28.964,1.478-43.028,4.393c-5.409,1.121-8.884,6.413-7.763,11.821C201.188,60.938,205.349,64.187,209.99,64.187z"/>
        </svg></span> </a>

      </div>
    </div>
  </li>

<!--***************SCRIPTS*****************-->
<script src="/pltoolbox/Resources/js/jquery.js"></script>
<script src="/pltoolbox/Resources/alertify/js/alertify.min.js"></script>
<script src="/pltoolbox/Resources/sweetAlert/js/sweetalert.min.js"></script>
<script src="/pltoolbox/Resources/js/popper.js"></script>
<script src="/pltoolbox/Resources/js/tether.min.js"></script>
<script src="/pltoolbox/Resources/Bootstrap_4_3/js/bootstrap.min.js"></script>
<script src="/pltoolbox/BitacoraProlog/opcionesOficina/js/opcionesOficina.js"></script>
<script src="/pltoolbox/Resources/js/table-fetch-plugin.js"></script>
<script src="/pltoolbox/Resources/js/popup-list-plugin.js"></script>
<script src="/pltoolbox/Resources/js/table-fetch-plugin.js"></script>

</footer>
