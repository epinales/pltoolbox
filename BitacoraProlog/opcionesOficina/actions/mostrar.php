<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

// $data['string'];
// $text = "%" . $data['string'] . "%";
// $variable = $data['variable'];
// $andWhere = 'WHERE (campo LIKE ?)  OR (campo LIKE ?) OR (campo LIKE ?) OR (campo LIKE ?)'; // en caso de que haya buscador y variable
$query = "SELECT * FROM oficinas WHERE o_nombre = ?";

$stmt = $conn->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$conn->errno]: $conn->error";
  exit_script($system_callback);
}

//SOLO EN CASO DE QUE SE OCUPE
$stmt->bind_param('s',$data['dbid']);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error al pasar variables [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

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
  $variable1 = $row['campo'];
  $variable2 = $row['campo2'];

  $system_callback['data'] .="<tr class='row text-center m-0 borderojo'>
    <td class='col-md-1'>
      <a href='#nombremodal' class='editar' db-id='$pk_id'>
        <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
      </a>
    </td>
    <td class='col-md-1'>$variable1</td>
    <td class='col-md-1'>$variable2</td>
    <td class='col-md-1'>$variable3</td>
    <td class='col-md-6'>$variable4</td>
    <td class='col-md-1'>$variable5</td>
    <td class='col-md-1'>$variable6</td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

?>
