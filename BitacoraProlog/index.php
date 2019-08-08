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
<!-- <body>
  <div class="container">
    <h1 class="bienvenido"><span class="wel">Bienvenido  <?php echo $_SESSION['user']['u_nombre']; ?></span><h1>
  </div>
</body> -->


<div class="card border-dark m-5 b2px" style="max-width: 18rem;">
  <div class="card-body text-dark text-center">
    <h5 class="card-title ls-3"><a href="/pltoolbox/BitacoraProlog/trafico/index.php"><b class="b">Bitacora Prolog</b></a></h5>
    <p class="card-text"></p>
  </div>
</div>

<?php
  require $root . '/pltoolbox/BitacoraProlog/footer.php';
?>
</html>
