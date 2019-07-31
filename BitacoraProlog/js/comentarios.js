$(document).ready(function(){
  listaComentarios();

  $('.add_comentario').click(function(){

    var data = {
      pk_indice: $('#pk_indice').val(),
      pk_bitacora: $('#pk_bitacora').val(),
      comentario: $('#a_comentario').val(),
      referencia: $('#referencia').val(),
    }

    validacion = $('#a_comentario').val() == "";


    if (validacion) {
      swal("Error", "El campo de comentario esta vacio.", "error");
    }else {
      var ajaxCall = $.ajax({
          method: 'POST',
          data: data,
          url: '/pltoolbox/BitacoraProlog/Comentarios/actions/agregar.php'
      });

      ajaxCall.done(function(r) {
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "Se guardo correctamente.", "success");
          listaComentarios();
          $('#a_comentario').val("");
        } else {
          swal("Error", "Algo fallo.", "error");
          console.error(r.message);
          $('.modal').hide();
        }
      });
    }
  });

}) // FIN DEL DOCUMENTO



function listaComentarios(){
  var data = { pk_bitacora : $('#pk_bitacora').val()}
    var ajaxCall = $.ajax({
        method: 'POST',
        data: data,
        url: '/pltoolbox/BitacoraProlog/Comentarios/actions/mostrar.php'
    });

    ajaxCall.done(function(r) {
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#lista_comentarios').html(r.data);
      } else {
        console.error(r.message);
      }
    });
}
