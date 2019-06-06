$(document).ready(function(){

  $('.ingresar').click(function(){
    var data = {
      user: $('#usuario').val(),
      pwd: $('#contra').val()
    }

    $.ajax({
      type: "POST",
      url: "/pltoolbox/usuarios/actions/ingresar.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          window.location.replace("/pltoolbox/BitacoraProlog/index.php");
          console.log(r);
        } else {
          swal("USUARIO O CONTRASEÑA INCORRECTOS","Favor de Verificar","error");
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    }); // ajax
  }); // funcion
});//documento
