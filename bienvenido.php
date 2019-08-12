<?php
  session_start();

  if (!isset($_SESSION['user'])) {
    header("Location: /pltoolbox/index.php");
  }
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/pltoolbox/links.php';
?>


<div class="bread p-2 font18">
  <b>Bienvenido, <?php echo $_SESSION['user']['u_nombre'] ?></b>
</div>
<div class="cartas">
  <div class="row m-0">
    <!-- <div class="col">
      <div class="card border-dark my-5 b2px">
        <div class="card-body text-center">
          <h5 class="card-title text-dark ls-3"><a href="/pltoolbox/usuarios/index.php"><b class="b">Usuarios</b></a></h5>
          <p class="card-text"></p>
        </div>
      </div>
    </div> -->

    <div class="col-md-3">
      <div class="card border-dark my-5 b2px">
        <div class="card-body text-center">
          <h5 class="card-title text-dark  ls-3"><a href="/pltoolbox/BitacoraProlog/trafico/index.php"><b class="b">Bitacora Prolog</b></a></h5>
          <p class="card-text"></p>
        </div>
      </div>
    </div>

    <!-- <div class="col">
      <div class="card border-dark my-5 b2px">
        <div class="card-body text-center">
          <h5 class="card-title text-dark ls-3"><a href="/pltoolbox/dashProlog/dashboard/index.php"><b class="b">Dashboard</b></a></h5>
          <p class="card-text"></p>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card border-dark my-5 b2px">
        <div class="card-body text-center">
          <h5 class="card-title text-dark ls-3"><a href="/pltoolbox/mayoral/"><b class="b">Mayoral</b></a></h5>
          <p class="card-text"></p>
        </div>
      </div>
    </div> -->
  </div>
</div>

<?php
  require $root . '/pltoolbox/footer.php';
?>
</html>
