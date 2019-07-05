<?PHP
  mysqli_query($db,"INSERT INTO bitacora_ediciones (usuario_edit,fecha_edit,seccion_edit,descripcion_edit) values ('$usuarioAlta','$fechaAlta','$seccion','$descripcion')");
?>
