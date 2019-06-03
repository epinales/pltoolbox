<?php
  session_start();

  if (!isset($_SESSION['user'])) {
    header("Location: /BitacoraProlog/index.php");
  }
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/BitacoraProlog/Ubicaciones/barraNavegacion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <h1 class="bienvenido"><span class="wel">Bienvenido  <?php echo $_SESSION['user']['u_nombre']; ?></span><h1>
  </div>
</body>

<?php
  require $root . '/BitacoraProlog/Ubicaciones/footer.php';
?>
</html>
