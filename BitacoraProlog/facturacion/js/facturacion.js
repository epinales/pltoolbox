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


  // $('.recibirExpediente').click(function(){
  //
  //   var data = {
  //     pk_bitacora: $(this).attr('db-id')
  //   }
  //
  //   alert('recibir expediente');
  //
  //   console.log(data);
  //
  // });


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

function recibirExpediente(pk_bitacora){
  var data = {
    pk_bitacora: pk_bitacora
  }

  swal({
    title: "Estas Seguro?",
    text: "Recibiras este expediente!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Si, Recibir",
    cancelButtonText: "No, Cancelar",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      var ajaxCall = $.ajax({
        method: 'POST',
        data: data,
        url: '/pltoolbox/BitacoraProlog/facturacion/actions/recibirExpediente.php'
      });

      ajaxCall.done(function(r) {
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Enviado!", "Recibiste este expediente.", "success");
          setTimeout(function(){
            window.location.replace('/pltoolbox/BitacoraProlog/facturacion/index.php');
          }, 1500);
        } else {
          console.error(r.message);
        }
      });

    } else {
      swal("Cancelado", "No has recibido este expediente :)", "error");
    }
  });
}

function detalle_eventos_facturacion(pk_bitacora){
  window.location.replace('/pltoolbox/BitacoraProlog/facturacion/detalle_eventos.php?evento='+pk_bitacora);

  console.log(pk_bitacora);
}
