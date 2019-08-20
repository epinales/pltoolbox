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

$('.add_program_cobranza').click(function(){
  var data = {
    vencimiento: $('#a_vencimiento').val(),
    pk_bitacora: $('#pk_bitacora').val()
  }

  var ajaxCall = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/actualizarCobranza.php'
  });

  ajaxCall.done(function(r) {
    r = JSON.parse(r);
    if (r.code == 1) {
      swal("Exito", "Se actualizo.", "success");
      $('.modal').modal('hide');
      location.reload();
    } else {
      console.error(r.message);
    }
  });
})

//validacion de ESTATUS
  $('#ctaGastos_fecha').change(function(){
    fechahora();
    $('#ctaGastos_hora').val(horaActual);
  })


  $('#cobDev_fecha').change(function(){
    fechahora();

    if ($('#ctaGastos_fecha').val() == "") {
      swal("Error","Hay estatus anteriores sin llenar","error");
      $(this).val("");
      $('#ctaGastos_fecha').focus();
    }else if ($(this).val() == "") {
      $('#cobDev_hora').val("");
      $('#pk_indice').val("11");
    }else {
      $('#cobDev_hora').val(horaActual);
      $('#pk_indice').val("12");
    }
  })



  $('.actualizar_factura').click(function(){
    var data = {
      pk_bitacora: $('#pk_bitacora').val(),
      referencia: $('#referencia').val(),
      pk_indice: $('#pk_indice').val(),
      numCuenta: $('#numCuenta').val(),
      trackId: $('#trackId').val(),
      saldo: $('#saldo').val(),
      tipoSaldo: $('#tipoSaldo').val(),
      ctaGastos_fecha: $('#ctaGastos_fecha').val(),
      ctaGastos_hora: $('#ctaGastos_hora').val(),
      cobDev_fecha: $('#cobDev_fecha').val(),
      cobDev_hora: $('#cobDev_hora').val(),
      vencimientoFact: $('#vencimientoFact').val(),
      honorarios: $('#honorarios').val(),
      finalizar: 0,
    }

    var ajaxCall = $.ajax({
        method: 'POST',
        data: data,
        url: 'actions/actualizar.php'
    });

    ajaxCall.done(function(r) {
      r = JSON.parse(r);
      if (r.code == 1) {
        // mostrarTabla();
        swal("Exito", "Se actualizo.", "success");
        setTimeout(function() {
         window.location.reload();
         }, 1500);
      } else {
        console.error(r.message);
      }
    });
  })


  $('.concluirCuenta').click(function(){
    validar = $('#numCuenta').val() == "" ||
              $('#honorarios').val() == "";

    var data = {
      pk_bitacora : $('#pk_bitacora').val()
    }

    if (validar) {
      swal("Error","Los campos #Cuenta y honorarios, no pueden estar vacios. Favor de verificar","error");
    }else{
      var ajaxCall = $.ajax({
          method: 'POST',
          data: data,
          url: 'actions/finalizarCuenta.php'
      });

      ajaxCall.done(function(r) {
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "Se actualizo.", "success");
          setTimeout(function() {
           window.location.reload();
           }, 1500);
        } else {
          console.error(r.message);
        }
      });
    }
  })

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
    pk_bitacora: pk_bitacora,
    referencia: $('.detalle').attr('referencia')
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

  // console.log(pk_bitacora);
}

function detalle_fetch(pk_bitacora){
  window.location.replace('/pltoolbox/BitacoraProlog/facturacion/detalle_consultar.php?evento='+pk_bitacora);

  // console.log(pk_bitacora);
}

function incrementarFecha(days){
    milisegundos=parseInt(35*24*60*60*1000);
    fecha = new Date($('#a_vencimiento').val());
    day = fecha.getDate();
    month = fecha.getMonth()+1;
    year = fecha.getFullYear();

    tiempo = fecha.getTime();
    milisegundos = parseInt(days*24*60*60*1000);
    total = fecha.setTime(tiempo+milisegundos);
    day = ('0' + (fecha.getDate())).slice(-2);
    month = ('0' + (fecha.getMonth()+1)).slice(-2);
    year = fecha.getFullYear();
    fecha_actual_incrementada = year+"-"+month+"-"+day;

    $('#a_vencimiento').val(fecha_actual_incrementada);
}
