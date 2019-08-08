$(document).ready(function(){
listaFacturasEntregadas();


// ESTILOS
  $('.modalFacturacion').popover({
    trigger: 'hover'
  })

// FIN DE ESTILO

  $('#add_fact').click(function(){
    $('#agregarFacturacion').modal('show');
  })




  $('.add_factura_SN').click(function(){

    var data = {
      fa_cliente: $('#fa_cliente').val(),
      fa_identCuenta: $('#fa_identCuenta').val(),
      fa_oficina: $('#fa_oficina').val()
    }

    validacion = $('#fa_cliente').val() == "" ||
                 $('#fa_identCuenta').val() == "" ||
                 $('#fa_oficina').val() == "";

    if (validacion) {
      swal('Error','Todos los campos necesitan estar completos','error');
    }else {
      var ajaxCall = $.ajax({
          method: 'POST',
          data: data,
          url: 'actions/agregar.php'
      });

      ajaxCall.done(function(r) {
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "Se guardo correctamente.", "success");
          listaFacturasEntregadas();
          $('.modal').modal('hide');
        } else {
          console.error(r.message);
        }
      });
    }
  });



})//fin del documento


function listaFacturasEntregadas(){
  var data = { oficina : $('#oficinaUsuario').val()}

  var ajaxCall = $.ajax({
    method: 'POST',
    data: data,
    url: '/pltoolbox/BitacoraProlog/facturacion/actions/mostrar.php'
  });

  ajaxCall.done(function(r) {
    r = JSON.parse(r);
    if (r.code == 1) {
      $('#listaRefFacturacion').html(r.data);
    } else {
      console.error(r.message);
    }
  });
}

function detalle_eventos_facturacion(pk_bitacora){
  window.location.replace('/pltoolbox/BitacoraProlog/facturacion/detalle_eventos.php?evento='+pk_bitacora);

  console.log(pk_bitacora);
}
