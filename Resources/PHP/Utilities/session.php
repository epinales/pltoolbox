<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


date_default_timezone_set('America/Monterrey');

if (!isset($_SESSION['user'])) {
  header("location:/BitacoraProlog/index.php");
}


 ?>
