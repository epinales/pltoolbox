$(document).ready(function(){

  $('.ingresar').click(function(){
    var data = {
      user: $('#usuario').val(),
      pwd: $('#contra').val()
    }

    var ajaxCall = $.ajax({
        method: 'POST',
        data: data,
        url: '/pltoolbox/usuarios/actions/ingresar.php'
    });

    ajaxCall.done(function(r) {
      r = JSON.parse(r);
      if (r.code == 1) {
        window.location.replace("/pltoolbox/Bienvenido.php");
      } else {
        swal("USUARIO O CONTRASEÑA INCORRECTOS","Favor de Verificar","error");
        console.error(r.message);
      }
    });
  });
});//documento
