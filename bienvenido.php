<?php
  session_start();

  if (!isset($_SESSION['user'])) {
    header("Location: /pltoolbox/index.php");
  }
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/pltoolbox/BitacoraProlog/links.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<div class="row">
  <div class="col">
    <!-- <div class="card border-dark m-5 b2px" style="max-width: 18rem;"> -->
    <div class="card border-dark m-5 b2px">
      <div class="card-body text-dark text-center">
        <h5 class="card-title ls-3"><a href="/pltoolbox/BitacoraProlog/trafico/index.php"><b class="b">Bitacora Prolog</b></a></h5>
        <p class="card-text"></p>
      </div>
    </div>
  </div>
  <div class="col">
    <!-- <div class="card border-dark m-5 b2px" style="max-width: 18rem;"> -->
    <div class="card border-dark m-5 b2px">
      <div class="card-body text-dark text-center">
        <h5 class="card-title ls-3"><a href="/pltoolbox/dashProlog/dashboard/index.php"><b class="b">Dashboard</b></a></h5>
        <p class="card-text"></p>
      </div>
    </div>
  </div>
</div>
<!--

<div class="card border-dark m-5 b2px" style="max-width: 18rem;">



</div> -->

<?php
  require $root . '/pltoolbox/BitacoraProlog/footer.php';
?>
</html>
