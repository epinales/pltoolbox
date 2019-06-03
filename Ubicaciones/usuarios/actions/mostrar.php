<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/BitacoraProlog/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$data['string'];
$text = "%" . $data['string'] . "%";
$variable = $data['variable']; // en caso de pasar una variable
$andWhere = 'WHERE (campo LIKE ?)  OR (campo LIKE ?) OR (campo LIKE ?) OR (campo LIKE ?)'; // en caso de que haya buscador y variable
$query = "SELECT * FROM usuarios ORDER BY u_nombre,u_oficina";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}

//SOLO EN CASO DE QUE SE OCUPE
// $stmt->bind_param('s',$text);
// if (!($stmt)) {
//   $system_callback['code'] = "500";
//   $system_callback['message'] = "Error al pasar variables [$stmt->errno]: $stmt->error";
//   exit_script($system_callback);
// }

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}



while ($row = $rslt->fetch_assoc()) {
  $id = $row['pk_usuario'];
  $u_nombre = $row['u_nombre'];
  $u_apellido = $row['u_apellido'];
  $u_usuario = $row['u_usuario'];
  $u_email = $row['u_email'];
  $u_tipo = $row['u_tipo'];
  $u_oficina = $row['u_oficina'];
  // $editar = "";
  $icono = "";



  $global = $_SESSION['user']['u_tipo'] == 'global';
  $admin = $_SESSION['user']['u_tipo'] == 'administrador';

  $editar = "href='#m-usuarios' class='editar'";


  $system_callback['data'] .="
    <tr class='row m-0 align-items-center bbyellow'>
      <td class='col-md-9'><span class='ls-3'>$u_nombre $u_apellido</span> <br> $u_usuario / $u_email</td>
      <td class='col-md-2'><span style='color:rgba(127, 141, 142, 0.71);'>$u_oficina</span> <br>$u_tipo</td>
      <td class='col-md-1'>
        <a $editar db-id='$id' class='noborder w-100 m-4'>
          <span class='img2'>
            <svg class='w-32' style='width:25px!important;' viewBox='0 0 512 512.001'xmlns='http://www.w3.org/2000/svg'>
              <path style='text-indent:0;text-align:start;line-height:normal;text-transform:none;block-progression:tb;-inkscape-font-specification:Bitstream Vera Sans' d='m487.789062 24.210938c-15.613281-15.613282-36.371093-24.210938-58.449218-24.210938s-42.835938 8.597656-58.449219 24.210938l-301.902344 301.898437c-.976562.976563-1.738281 2.144531-2.242187 3.429687l-66.058594 168.816407c-1.445312 3.699219-.566406 7.90625 2.242188 10.714843 1.910156 1.914063 4.46875 2.929688 7.074218 2.929688 1.222656 0 2.457032-.222656 3.640625-.6875l168.820313-66.058594c1.285156-.503906 2.449218-1.265625 3.425781-2.242187l28.285156-28.285157c3.902344-3.902343 3.902344-10.234374 0-14.140624-3.90625-3.90625-10.238281-3.90625-14.144531 0l-21.210938 21.214843-88.617187-88.617187 240.046875-240.050782 88.617188 88.617188-162.265626 162.265625c-3.90625 3.90625-3.90625 10.238281 0 14.144531 3.902344 3.902344 10.234376 3.902344 14.140626 0l217.046874-217.046875c15.613282-15.613281 24.210938-36.371093 24.210938-58.453125 0-22.078125-8.597656-42.835937-24.210938-58.449218zm-407.988281 326.855468 81.132813 81.132813-69.902344 27.355469-38.585938-38.585938zm-35.308593 90.234375 26.207031 26.210938-43.058594 16.847656zm299.902343-362.308593 17.804688-17.804688 88.617187 88.613281-17.808594 17.804688zm129.253907 47.976562-8.691407 8.691406-88.617187-88.617187 8.691406-8.691407c11.835938-11.832031 27.570312-18.351562 44.308594-18.351562 16.738281 0 32.472656 6.519531 44.308594 18.355469 11.835937 11.832031 18.351562 27.570312 18.351562 44.304687 0 16.738282-6.515625 32.472656-18.351562 44.308594zm0 0'/>
              <path d='m235.351562 369.339844c-2.628906 0-5.199218 1.070312-7.070312 2.929687-1.859375 1.859375-2.917969 4.441407-2.917969 7.070313 0 2.640625 1.058594 5.210937 2.917969 7.070312 1.871094 1.859375 4.441406 2.929688 7.070312 2.929688 2.640626 0 5.21875-1.070313 7.078126-2.929688 1.863281-1.859375 2.921874-4.429687 2.921874-7.070312 0-2.628906-1.058593-5.210938-2.921874-7.070313-1.859376-1.859375-4.4375-2.929687-7.078126-2.929687zm0 0'/>
            </svg>
          </span>
        </a>
      </td>
    </tr>";
  }

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


 ?>
