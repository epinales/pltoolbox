<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Bitacora Prolog</title>
  <link rel="stylesheet" href="/BitacoraProlog/Resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/BitacoraProlog/Resources/css/login.css">
  <link rel="stylesheet" href="/BitacoraProlog/Resources/sweetAlert/css/sweetalert.css">
  <link rel="stylesheet" href="/BitacoraProlog/Resources/alertify/css/alertify.min.css">
  <link rel="stylesheet" href="/BitacoraProlog/Resources/alertify/css/themes/default.min.css">
</head>

<body>
  <form id="login-form" class="container w-25 shadow-sm p-3 mb-5 rounded" onsubmit="return false">
    <table class="table text-center" >

      <tr class="row">
        <td class="col-md-12">
          <h1>Ingresar</h1>
          <input id="usuario" class="w-100" type="text" placeholder="Usuario">
        </td>
      </tr>
      <tr class="row">
        <td class="col-md-12">
          <input id="contra" class="w-100" type="password" placeholder="Contraseña">
        </td>
      </tr>
      <tr class="row">
        <td class="col-md-12">
          <input id="ingresar" class="ingresar w-50" type="submit">
        </td>
      </tr>
    </table>
  </form>
</body>


<script src="/BitacoraProlog/Resources/js/jquery.js"></script>
<script src="/BitacoraProlog/Resources/alertify/js/alertify.min.js"></script>
<script src="/BitacoraProlog/Resources/sweetAlert/js/sweetalert.min.js"></script>
<script src="/BitacoraProlog/Resources/js/popper.js"></script>
<script src="/BitacoraProlog/Resources/js/tether.min.js"></script>
<script src="/BitacoraProlog/Resources/bootstrap/js/bootstrap.min.js"></script>

<script src="/BitacoraProlog/Ubicaciones/usuarios/js/ingresar.js"></script>
</html>
