<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dash Prolog</title>

  <!--***************ESTILOS*****************-->
  <link rel="stylesheet" href="/pltoolbox/Resources/css/dashProlog.css">
  <link rel="stylesheet" href="/pltoolbox/Resources/css/estilos.css">
  <link rel="stylesheet" href="/pltoolbox/Resources/css/barraNavegacion.css">
  <link rel="stylesheet" href="/pltoolbox/Resources/css/modales.css">
  <link rel="stylesheet" href="/pltoolbox/Resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/pltoolbox/Resources/sweetAlert/css/sweetalert.css">
  <link rel="stylesheet" href="/pltoolbox/Resources/alertify/css/alertify.min.css">
  <link rel="stylesheet" href="/pltoolbox/Resources/alertify/css/themes/default.min.css">

  <!--***************SCRIPTS*****************-->
  <script src="/pltoolbox/Resources/js/jquery.js"></script>
  <script src="/pltoolbox/Resources/alertify/js/alertify.min.js"></script>
  <script src="/pltoolbox/Resources/sweetAlert/js/sweetalert.min.js"></script>
  <script src="/pltoolbox/Resources/js/popper.js"></script>
  <script src="/pltoolbox/Resources/js/tether.min.js"></script>
  <script src="/pltoolbox/Resources/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
  <ul class="navbar p-0">
    <!-- <li id="home" class="p-0 btn img f5 bblack">
      <a class="nav-link" href="/pltoolbox/bienvenido.php" role="button">
        <span class="img">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.001 512.001" >
            <path style="text-indent:0;text-align:start;line-height:normal;text-transform:none;block-progression:tb;-inkscape-font-specification:Bitstream Vera Sans" d="M509.014,262.276L263.213,16.475c-3.985-3.983-10.441-3.983-14.425,0L2.987,262.276 c-2.916,2.916-3.789,7.304-2.211,11.114c1.579,3.81,5.297,6.296,9.423,6.296h40.532v208.627c0,5.633,4.567,10.199,10.199,10.199
              h143.054c5.632,0,10.199-4.566,10.199-10.199v-149.7h83.633v149.7c0,5.633,4.567,10.199,10.199,10.199h144.352
              c5.633,0,10.199-4.566,10.2-10.199V279.686h39.233c4.126,0,7.844-2.485,9.423-6.296
              C512.803,269.58,511.929,265.193,509.014,262.276z M452.368,259.288c-5.632,0-10.199,4.566-10.199,10.199v208.627H318.215v-149.7
              c0-5.633-4.567-10.199-10.199-10.199H203.984c-5.632,0-10.199,4.566-10.199,10.199v149.7H71.129V269.487
              c0-5.633-4.567-10.199-10.199-10.199H34.823L256,38.11l221.177,221.178H452.368z" color="#000" overflow="visible" font-family="Bitstream Vera Sans"/>
            <path d="M166.83,160.564c-3.985-3.983-10.441-3.983-14.425,0l-74.964,74.964c-3.983,3.984-3.983,10.442,0,14.425
              c1.992,1.992,4.601,2.987,7.212,2.987c2.611,0,5.22-0.995,7.213-2.987l74.964-74.964
              C170.813,171.005,170.813,164.547,166.83,160.564z"/>
            <path d="M198.448,128.946c-3.985-3.983-10.441-3.983-14.425,0l-6.629,6.63c-3.983,3.984-3.983,10.442,0,14.425
              c1.992,1.992,4.601,2.987,7.212,2.987c2.611,0,5.22-0.995,7.213-2.987l6.629-6.63
              C202.431,139.387,202.431,132.929,198.448,128.946z"/>
          </svg>
        </span>
      </a>
    </li> -->
    <li class="p-0 btn text bblack f19">
      <a href="/pltoolbox/dashProlog/dashboard/index.php">
        <span class="title">DASHBOARD</span>
        <div class="arrow"></div>
      </a>
    </li>

    <li class="p-0 btn text bblack f19">
      <a href="/pltoolbox/dashProlog/trucks/index.php">
        <span class="title">TRUCKS</span>
        <div class="arrow"></div>
      </a>
    </li>
  </ul>
</body>
</html>
