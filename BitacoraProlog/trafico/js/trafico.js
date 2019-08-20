$(document).ready(function(){
listaTrafico();
depositosPagos();

// ESTILOS
$('.folder-factura').popover({
  trigger: 'hover'
})

$('.modalTrafico').click(function(){
  $('.addtrafico').addClass('activo');
  $('#addtrafico').show();
  $('.prealerta').removeClass('activo');
  $('#prealerta').hide();
})

$('.addtrafico').click(function(){
  $('#addtrafico').show();
  $(this).addClass('activo');

  $('#prealerta').hide();
  $('.prealerta').removeClass('activo');
});

$('.prealerta').click(function(){
  $('#prealerta').show();
  $(this).addClass('activo');


  $('.addtrafico').removeClass('activo');
  $('#addtrafico').hide();
});



  $('#menos').click(function(){
    $(this).hide();
    $('#mas').show();
    $('.infoMenos').show();
    $('.infoMas').hide();

  })

  $('#mas').click(function(){
    $(this).hide();
    $('#menos').show();

    $('.infoMas').show();
    $('.infoMenos').hide();
  })
// FIN DE ESTILOS


  $('#a_referencia').change(function(){
    $('#a_cliente').val("");
    $('#a_tipo').val("");
  })

  $('val_referencia').change(function(){
    $('#a_cliente').val("");
    $('#a_tipo').val("");
  })

  $('.filtroOficina').click(function(){
    var data = { oficina : $(this).attr('db-id')}

    var ajaxCall = $.ajax({
        method: 'POST',
        data: data,
        url: 'actions/mostrar.php'
    });

    ajaxCall.done(function(r) {
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#lista_trafico').html(r.data);
      } else {
        console.error(r.message);
      }
    });
  });

  $('.validaRef').click(function(){
    var data = { referencia : $('#a_referencia').val()}

    var ajaxCall = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/mostrarDatosRef.php'
    });

    ajaxCall.done(function(r) {
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#datosReferencia').html(r.data);
        $('#a_trafico').show();
      } else {
        swal("Error", "Selecciona una referencia.", "error");
        $('#a_trafico').hide();
        console.error(r.message);
      }
    });
  }) // funcion validaRef

  $('.a_trafico').click(function(){

    var data = {
      a_cliente: $('#a_cliente').val(),
      a_oficina: $('#a_oficina').val(),
      a_referencia: $('#a_referencia').val(),
      a_estatusTipo: $('#a_estatusTipo').val(),
      a_tipo: $('#a_tipo').val(),
      estatusIndice: "3"
    }

    validacion = $('#a_referencia').val() == "";

    if (validacion) {
      swal('No puedes continuar','Campo referencia es requerido','info')
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
          listaTrafico();
          $('.modal').modal('hide');
        }else if (r.code == 305) {
          swal("Error", "Esta referencia ya existe.", "error");
          console.error(r.message);
        }else {
          console.error(r.message);
          $('.modal').modal('hide');
        }
      });
    }
  });// funcion Agregar bitacora

  $('.a_preAlerta').click(function(){
    var data = {
      a_cliente: $('#pa_cliente').val(),
      a_estatusActual: $('#pa_estatusActual').val(),
      a_estatusSiguiente: $('#pa_estatusSiguiente').val(),
      a_oficina: $('#pa_oficina').val(),
      a_referencia: "SN",
      a_estatusTipo: $('#a_estatusTipo').val(),
      a_tipo: $('#a_tipo').val(),
      estatusIndice: "1"
    }

    validacion = $('#pa_cliente').val() == "" ||
							$('#pa_oficina').val() == "";

    if (validacion) {
      swal('No puedes continuar','Todos los campos necesitan estar llenos','info');
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
          listaTrafico();
          $('.modal').modal('hide');
        }else {
          console.error(r.message);
          $('.modal').modal('hide');
        }
      });
    }
  })

  $('#prealerta_fecha').change(function(){
    validacionEstatus();
    fechahora();

    if (aperturaF != "") {
      $('#prealerta_hora').val(horaActual);
    }else if ($(this).val() == "") {
      $('#prealerta_hora').val("");
    }else {
      $('#prealerta_hora').val(horaActual);
      $('#pk_indice').val("1");
    }
  })

  $('#arribo_fecha').change(function(){
    validacionEstatus();
    fechahora();

    if (aperturaF != "") {
      $('#arribo_hora').val(horaActual);
    }else if ($(this).val() == "" && aperturaF == "") {
      $('#arribo_hora').val("");
      $('#pk_indice').val("1");
    }else if ($(this).val() == "") {
      $('#arribo_hora').val("");
    }else {
      $('#arribo_hora').val(horaActual);
      $('#pk_indice').val("2");
    }
  })

  $('#apertura_fecha').change(function(){
    fechahora();
    validacionEstatus();

    if ($('#arribo_fecha').val() == "") {
      swal("Error","Hay estatus anteriores sin llenar","error");
      $(this).val("");
    }else if ($('#referencia').val() == "SN" && $(capfactF == "")) {
      $('#insertarReferencia').modal('show');
      $('#pk_indice').val("3");
    }else if (capfactF != "") {
      $('#apertura_hora').val(horaActual);
    }else if ($(this).val() == "" && capfactF == "") {
      $('#apertura_hora').val("");
      $('#pk_indice').val("2");
    }else if ($(this).val() == "") {
      $('#apertura_hora').val("");
    }else {
      $('#apertura_hora').val(horaActual);
      $('#pk_indice').val("3");
    }
  })

  $('#capfact_fecha').change(function(){
    fechahora();
    validacionEstatus();
    if (arriboF == "" || aperturaF == "") {
      swal("Error","Hay estatus anteriores sin llenar","error");
      $(this).val("");
    }else if (clasifF != "") {
      $('#capfact_hora').val(horaActual);
    }else if ($(this).val() == "" && clasifF == "") {
      $('#capfact_hora').val("");
      $('#pk_indice').val("3");
    }else if ($(this).val() == "") {
      $('#capfact_hora').val("");
    }else {
      $('#capfact_hora').val(horaActual);
      $('#pk_indice').val("4");
    }
  })

  $('#clasif_fecha').change(function(){
    fechahora();
    validacionEstatus();
    if (arriboF == "" || aperturaF == "" || capfactF == "") {
      swal("Error","Hay estatus anteriores sin llenar","error");
      $(this).val("");
    }else if ($(this).val() == "" && solantF == "") {
      $('#clasif_hora').val("");
      $('#pk_indice').val("4");
    }else if ($(this).val() == "" && solantF != "") {
      $('#clasif_hora').val("");
    }
    // else if (solantF != "") {
    //   $('#clasif_hora').val(horaActual);
    // }
    else {
      $('#clasif_hora').val(horaActual);
      $('#pk_indice').val("5");
    }
  })


  $('#solant_fecha').change(function(){
    fechahora();
    validacionEstatus();

    if (arriboF == "" || aperturaF == "" || capfactF == "" || clasifF == "") {
      swal("Error","Hay estatus anteriores sin llenar","error");
      $(this).val("");
    }else if (depositoF != "") {
      $('#solant_hora').val(horaActual);
    }else if ($(this).val() == "" && depositoF == "") {
      $('#solant_hora').val("");
      $('#pk_indice').val("5");
    }else if ($(this).val() == "") {
      $('#solant_hora').val("");
    }else {
      $('#solant_hora').val(horaActual);
      $('#pk_indice').val("6");
    }
  })


  $('#deposito_fecha').change(function(){
    fechahora();
    validacionEstatus();

    if (arriboF == "" || aperturaF == "" || capfactF == "" || clasifF == "" || solantF == "") {
      swal("Error","Hay estatus anteriores sin llenar","error");
      $(this).val("");
    }else if ($('#dp_deposito').val() == 0 || $('#dp_disponible').val() == 0) {
      $(this).val("");
      actualizar_trafico();
      swal("Ops!","No hay depositos registrados o dinero disponible","info");
      $('#ident').click();
    }
    // else if (pagoF != "") {
    //   $('#deposito_hora').val(horaActual);
    // }
    else if ($(this).val() == "" && pagoF == "") {
      $('#deposito_hora').val("");
      $('#pk_indice').val("6");
    }else if ($(this).val() == "") {
      $('#deposito_hora').val("");
    }else {
      $('#deposito_hora').val(horaActual);
      $('#pk_indice').val("7");
    }
  })

  $('#pago_fecha').change(function(){
    fechahora();
    validacionEstatus();
    if (arriboF == "" || aperturaF == "" || capfactF == "" || clasifF == "" || solantF == "" || depositoF == "") {
      swal("Error","Hay estatus anteriores sin llenar","error");
      $(this).val("");
    }else if ($('#dp_pago').val() == 0 || $('#dp_disponible').val() == 0) {
      $(this).val("");

      actualizar_trafico();
      swal("Ops!","No hay pagos registrados o deposito disponible, favor de verificar","info");
      $('#ident').click();
      $('#tab-pagos').click();
    }else if ($(this).val() == "" && programF == "") {
      $('#pago_hora').val("");
      $('#pk_indice').val("7");
    }
    else if ($(this).val() == "") {
      $('#pago_hora').val("");
    }else {
      $('#pago_hora').val(horaActual);
      $('#pk_indice').val("8");
    }
  })

  $('#program_fecha').change(function(){
    fechahora();
    validacionEstatus();

    if (arriboF == "" || aperturaF == "" || capfactF == "" || clasifF == "" || solantF == "" || depositoF == "" || pagoF == "") {
      swal("Error","Hay estatus anteriores sin llenar","error");
      $(this).val("");
    }else if ($(this).val() == "" && entregaF == "") {
      $('#program_hora').val("");
      $('#pk_indice').val("8");
    }
    // else if (entregaF != "") {
    //   $('#program_hora').val(horaActual);
    // }
    else if ($(this).val() == "") {
      $('#program_hora').val("");
    }else {
      $('#program_hora').val(horaActual);
      $('#pk_indice').val("9");
    }
  })

  $('#entrega_fecha').change(function(){
    fechahora();
    validacionEstatus();

    if (arriboF == "" || aperturaF == "" || capfactF == "" || clasifF == "" || solantF == "" || depositoF == "" || pagoF == "" || programF == "") {
      swal("Error","Hay estatus anteriores sin llenar","error");
      $(this).val("");
    }else if ($(this).val() == "") {
      $('#pk_indice').val("9");
      $('#entrega_hora').val("");
    }
    // else if ($(this).val() == "") {
    //   $('#entrega_hora').val("");
    //   $('#pk_indice').val("9");

    // }else if ($(this).val() == "" && entregaF == "") {
    //   $('#program_hora').val("");
    // }
    else {
      $('#entrega_hora').val(horaActual);
      // back
      // $('#fechaFinalTrafico').val();
      $('#pk_indice').val("10");
    }
  })

  $('.val_ref').click(function(){
   var data = { referencia : $('#val_referencia').val()}
   var ajaxCall = $.ajax({
     method: 'POST',
     data: data,
     url: 'actions/mostrarDatosRef.php'
   });

   ajaxCall.done(function(r) {
     r = JSON.parse(r);
     if (r.code == 1) {
       $('#datosReferencia_val').html(r.data);
       $('#a_trafico').show();
     } else {
       swal("Error", "Selecciona una referencia.", "error");
       $('#a_trafico').hide();
       console.error(r.message);
     }
   });
  })// funcion validaRef

  $('.act_trafico').click(function(){
    var data = {
      pk_bitacora: $('#pk_bitacora').val(),
      referencia: $('#val_referencia').val(),
      cliente: $('#a_cliente').val(),
      tipo: $('#a_tipo').val(),
      oficina: $('#a_oficina').val(),


      estatusIndice: $('#pk_indice').val(),
      prealerta_fecha: $('#prealerta_fecha').val(),
      prealerta_hora: $('#prealerta_hora').val(),
      arribo_fecha: $('#arribo_fecha').val(),
      arribo_hora: $('#arribo_hora').val()
    }

    console.log(data);
    var ajaxCall = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/editar.php'
    });

    ajaxCall.done(function(r) {
      r = JSON.parse(r);
      if (r.code == 1) {
        swal("Exito", "Se actualizo.", "success");
        location.reload();
        listaTrafico();
      } else if (r.code == 305) {
        swal("Error", "Esta referencia ya existe, favor de verificar", "error");
        $('.modal').modal('hide');
        $('#apertura_fecha').val("");
        console.error(r.message);
      }else {
        console.error(r.message);
        $('.modal').modal('hide');

      }
    });
  }) //funciona segun revision

  $('.actualizar_trafico').click(function(){
    validacionEstatus();

    var data = {
      pk_bitacora: $('#pk_bitacora').val(),
      pk_indice: $('#pk_indice').val(),
      prealerta_fecha : $('#prealerta_fecha').val(),
      prealerta_hora : $('#prealerta_hora').val(),
      arribo_fecha : $('#arribo_fecha').val(),
      arribo_hora : $('#arribo_hora').val(),
      apertura_fecha : $('#apertura_fecha').val(),
      apertura_hora : $('#apertura_hora').val(),
      capfact_fecha : $('#capfact_fecha').val(),
      capfact_hora : $('#capfact_hora').val(),
      clasif_fecha : $('#clasif_fecha').val(),
      clasif_hora : $('#clasif_hora').val(),
      solant_fecha : $('#solant_fecha').val(),
      solant_hora : $('#solant_hora').val(),
      deposito_fecha : $('#deposito_fecha').val(),
      deposito_hora : $('#deposito_hora').val(),
      pago_fecha : $('#pago_fecha').val(),
      pago_hora : $('#pago_hora').val(),
      program_fecha : $('#program_fecha').val(),
      program_hora : $('#program_hora').val(),
      entrega_fecha : $('#entrega_fecha').val(),
      entrega_hora : $('#entrega_hora').val(),
      referencia : $('#referencia').val()
    }


    if (arriboF == prealertaF && arriboH < prealertaH ||
      arriboF != "" && arriboF < prealertaF) {
      $('#arribo_fecha').focus();
      swal("Error","La fecha y hora de ARRIBO no puede ser menor a un estatus anterior, favor de verificar","error");
    }else if (prealertaF == "" && arriboF != "") {
      $('#prealerta_fecha').focus();
      swal("Error","hay estatus siguientes llenos, este no puede estar vacio","error");
    }else if (arriboF == "" && aperturaF != "") {
      $('#arribo_fecha').focus();
      swal("Error","hay estatus siguientes llenos, este no puede estar vacio","error");
    }else if (aperturaF == arriboF && aperturaH < arriboH ||
      aperturaF != "" && aperturaF < arriboF) {
      $('#apertura_fecha').focus();
      swal("Error","La fecha y hora de APERTURA no puede ser menor a un estatus anterior, favor de verificar","error");
    }else if (aperturaF == "" && capfactF != "") {
      $('#apertura_fecha').focus();
      swal("Error","hay estatus siguientes llenos, este no puede estar vacio","error");
    }else if (capfactF == aperturaF && capfactH < aperturaH ||
      capfactF != "" && capfactF < aperturaF) {
      $('#capfact_fecha').focus();
      swal("Error","La fecha y hora de CAPTURA DE FACTURA no puede ser menor a un estatus anterior, favor de verificar","error");
    }else if (capfactF == "" && clasifF != "") {
      $('#capfact_fecha').focus();
      swal("Error","hay estatus siguientes llenos, este no puede estar vacio","error");
    }else if (clasifF == capfactF && clasifH < capfactH ||
      clasifF != "" && clasifF < capfactF) {
      $('#clasif_fecha').focus();
      swal("Error","La fecha y hora de CLASIFICACION no puede ser menor a un estatus anterior, favor de verificar","error");
    }else if (clasifF == "" && solantF != "") {
      $('#clasif_fecha').focus();
      swal("Error","hay estatus siguientes llenos, este no puede estar vacio","error");
    }else if (solantF == clasifF && solantH < clasifH ||
      solantF != "" && solantF < clasifF) {
      $('#solant_fecha').focus();
      swal("Error","La fecha y hora de SOLICITUD DE ANTICIPO no puede ser menor a un estatus anterior, favor de verificar","error");
    }else if (solantF == "" && depositoF != "") {
      $('#solant_fecha').focus();
      swal("Error","hay estatus siguientes llenos, este no puede estar vacio","error");
    }else if (depositoF == solantF && depositoH < solantH ||
      depositoF != "" && depositoF < solantF) {
      $('#deposito_fecha').focus();
      swal("Error","La fecha y hora de DEPOSITO no puede ser menor a un estatus anterior, favor de verificar","error");
    }else if (depositoF == "" && pagoF != "") {
      $('#deposito_fecha').focus();
      swal("Error","hay estatus siguientes llenos, este no puede estar vacio","error");
    }else if (pagoF == depositoF && pagoH < depositoH ||
      pagoF != "" && pagoF < depositoF) {
      $('#pago_fecha').focus();
      swal("Error","La fecha y hora de PAGO no puede ser menor a un estatus anterior, favor de verificar","error");
    }else if (pagoF == "" && programF != "") {
      $('#pago_fecha').focus();
      swal("Error","hay estatus siguientes llenos, este no puede estar vacio","error");
    }else if (programF == pagoF && programH < pagoH ||
      programF != "" && programF < pagoF) {
      $('#program_fecha').focus();
      swal("Error","La fecha y hora de PROGRAMACION no puede ser menor a un estatus anterior, favor de verificar","error");
    }else if (programF == "" && entregaF != "") {
      $('#program_fecha').focus();
      swal("Error","hay estatus siguientes llenos, este no puede estar vacio","error");
    }else if (entregaF == programF && entregaH < programH ||
      entregaF != "" && entregaF < programF) {
      $('#entrega_fecha').focus();
      swal("Error","La fecha y hora de ENTREGA no puede ser menor a un estatus anterior, favor de verificar","error");
    }else {
      var ajaxCall = $.ajax({
        method: 'POST',
        data: data,
        url: 'actions/actualizar.php'
      });
      ajaxCall.done(function(r) {
        r = JSON.parse(r);
        if (r.code == 1) {
          listaTrafico();
          swal("Exito", "Se actualizo.", "success");
          // $('.modal').modal('hide');

          setTimeout(function() {
           window.location.reload();
         }, 1500);
        } else if (r.code == 2) {
          $('.modal').modal('hide');
          swal("No hay Cambios", "La referencia no se modifico.", "info");
        }else {
          console.error(r.message);
        }
      });
    }// fin del if
  })// FIN DE LA FUNCION

  $('#inicial').click(function(){
    window.location.reload();
  }) // para recargar saldo de disponible


// FUNCIONES PARA AGREGAR PAGOS Y DEPOSITOS -- FUNCIONES PARA AGREGAR PAGOS Y DEPOSITOS //
  $('#a_depPago').change(function(){
    if ($(this).val() == 'Deposito') {
      $('#agregarDepositos').show();
      $('#agregarPagos').hide();
    }else {
      $('#agregarDepositos').hide();
      $('#agregarPagos').show();
    }
  })

  $('#dep_iva').click(function(){
    if( $('.checkbox').is(':checked') ) {
      $('#dep_ivadepo').val(1);
    }else {
      $('#dep_ivadepo').val(0);
    }
  })

  $('#pag_iva').click(function(){
    if( $(this).is(':checked') ) {
      $('#pag_ivapago').val(1);
    }else {
      $('#pag_ivapago').val(0);
    }
  })

  $('.agregar_deposito').click(function(){
    var data = {
      tipo: $('#a_depPago').val(),
      deposito: $('#dep_monto').val(),
      pago: 0,
      iva: $('#dep_ivadepo').val(),
      concepto: "",
      comentarios: "",
      pk_bitacora: $('#pk_bitacora').val(),
      referencia: $('#referencia').val()
    }

    validacion = $('#dep_monto').val() == "";

    if (validacion) {
      swal('No puedes continuar','El campo monto no puede estar vacio','info')
    }else {
      var ajaxCall = $.ajax({
          method: 'POST',
          data: data,
          url: '/pltoolbox/BitacoraProlog/trafico/actions/depositosPagos/agregar.php'
      });

      ajaxCall.done(function(r) {
        r = JSON.parse(r);
        if (r.code == 1) {
          depositosPagos();
          $('.modal').modal('hide');
          swal("Exito", "Se guardo correctamente.", "success");
        } else {
          console.error(r.message);
        }
      });
    }
  });

  $('.agregar_pago').click(function(){
    var data = {
      tipo: $('#a_depPago').val(),
      pago: $('#pag_monto').val(),
      deposito: 0,
      iva: $('#pag_ivapago').val(),
      concepto: $('#pag_concepto').val(),
      comentarios: $('#pag_comentarios').val(),
      pk_bitacora: $('#pk_bitacora').val(),
      referencia: $('#referencia').val()
    }

    validacion = $('#pag_monto').val() == "" ||
                 $('#pag_concepto').val() == "";


    if (validacion) {
      swal('No puedes continuar','El campo monto y concepto no pueden estar vacios','info')
    }else {
      var ajaxCall = $.ajax({
          method: 'POST',
          data: data,
          url: '/pltoolbox/BitacoraProlog/trafico/actions/depositosPagos/agregar.php'
      });

      ajaxCall.done(function(r) {
        r = JSON.parse(r);
        if (r.code == 1) {
          depositosPagos();
          swal("Exito", "Se guardo correctamente.", "success");
          $('.modal').modal('hide');
          $('#tab-pagos').click();
        } else {
          console.error(r.message);
        }
      });
    }
  });

// pasar expediente a facturacion
  $('.folder-factura').click(function(){
    var data = {
      pk_bitacora: $('#pk_bitacora').val(),
      referencia: $('#referencia').val()
    }
    swal({
      title: "Estas Seguro?",
      text: "Pasaras el expediente a facturación!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Si, Enviar",
      cancelButtonText: "No, cancelar",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        var ajaxCall = $.ajax({
          method: 'POST',
          data: data,
          url: '/pltoolbox/BitacoraProlog/trafico/actions/depositosPagos/actualizarTerminado.php'
        });

        ajaxCall.done(function(r) {
          r = JSON.parse(r);
          if (r.code == 1) {
            swal("Enviado!", "El expediente esta en facturacion.", "success");
            setTimeout(function(){
              window.location.replace('/pltoolbox/BitacoraProlog/trafico/index.php');
            }, 1500);
          } else {
            console.error(r.message);
          }
        });

      } else {
        swal("Cancelado", "El expediente se quedo en trafico :)", "error");
      }
    });
  });

// FIN FUNCIONES PARA AGREGAR PAGOS Y DEPOSITOS  -- FIN FUNCIONES PARA AGREGAR PAGOS Y DEPOSITOS //

}); //FIN DEL DOCUMENTO

function depositosPagos(){
  var data = { pk_bitacora : $('#pk_bitacora').val()}
  var ajaxCall = $.ajax({
      method: 'POST',
      data: data,
      url: '/pltoolbox/BitacoraProlog/trafico/actions/depositosPagos/mostrar.php'
  });

  ajaxCall.done(function(r) {
    r = JSON.parse(r);
    if (r.code == 1) {
      $('#listaDepositos').html(r.deposito);
      $('#listaPagos').html(r.pago);

      $('#listaDepositosFact').html(r.deposito);
      $('#listaPagosFact').html(r.pago);
    } else {
      console.error(r.message);
    }
  });
}

function actualizar_trafico(){
  validacionEstatus();

  var data = {
    pk_bitacora: $('#pk_bitacora').val(),
    pk_indice: $('#pk_indice').val(),
    prealerta_fecha : $('#prealerta_fecha').val(),
    prealerta_hora : $('#prealerta_hora').val(),
    arribo_fecha : $('#arribo_fecha').val(),
    arribo_hora : $('#arribo_hora').val(),
    apertura_fecha : $('#apertura_fecha').val(),
    apertura_hora : $('#apertura_hora').val(),
    capfact_fecha : $('#capfact_fecha').val(),
    capfact_hora : $('#capfact_hora').val(),
    clasif_fecha : $('#clasif_fecha').val(),
    clasif_hora : $('#clasif_hora').val(),
    solant_fecha : $('#solant_fecha').val(),
    solant_hora : $('#solant_hora').val(),
    deposito_fecha : $('#deposito_fecha').val(),
    deposito_hora : $('#deposito_hora').val(),
    pago_fecha : $('#pago_fecha').val(),
    pago_hora : $('#pago_hora').val(),
    program_fecha : $('#program_fecha').val(),
    program_hora : $('#program_hora').val(),
    entrega_fecha : $('#entrega_fecha').val(),
    entrega_hora : $('#entrega_hora').val(),
    referencia : $('#referencia').val()
  }

  if (arriboF == prealertaF && arriboH < prealertaH ||
    arriboF != "" && arriboF < prealertaF) {
    $('#arribo_fecha').focus();
    swal("Error","La fecha y hora de ARRIBO no puede ser menor a un estatus anterior, favor de verificar","error");
  }else if (aperturaF == arriboF && aperturaH < arriboH ||
    aperturaF != "" && aperturaF < arriboF) {
    $('#apertura_fecha').focus();
    swal("Error","La fecha y hora de APERTURA no puede ser menor a un estatus anterior, favor de verificar","error");
  }else if (capfactF == aperturaF && capfactH < aperturaH ||
    capfactF != "" && capfactF < aperturaF) {
    $('#capfact_fecha').focus();
    swal("Error","La fecha y hora de CAPTURA DE FACTURA no puede ser menor a un estatus anterior, favor de verificar","error");
  }else if (clasifF == capfactF && clasifH < capfactH ||
    clasifF != "" && clasifF < capfactF) {
    $('#clasif_fecha').focus();
    swal("Error","La fecha y hora de CLASIFICACION no puede ser menor a un estatus anterior, favor de verificar","error");
  }else if (solantF == clasifF && solantH < clasifH ||
    solantF != "" && solantF < clasifF) {
    $('#solant_fecha').focus();
    swal("Error","La fecha y hora de SOLICITUD DE ANTICIPO no puede ser menor a un estatus anterior, favor de verificar","error");
  }else if (depositoF == solantF && depositoH < solantH ||
    depositoF != "" && depositoF < solantF) {
    $('#deposito_fecha').focus();
    swal("Error","La fecha y hora de DEPOSITO no puede ser menor a un estatus anterior, favor de verificar","error");
  }else if (pagoF == depositoF && pagoH < depositoH ||
    pagoF != "" && pagoF < depositoF) {
    $('#pago_fecha').focus();
    swal("Error","La fecha y hora de PAGO no puede ser menor a un estatus anterior, favor de verificar","error");
  }else if (programF == pagoF && programH < pagoH ||
    programF != "" && programF < pagoF) {
    $('#program_fecha').focus();
    swal("Error","La fecha y hora de PROGRAMACION no puede ser menor a un estatus anterior, favor de verificar","error");
  }else if (entregaF == programF && entregaH < programH ||
    entregaF != "" && entregaF < programF) {
    $('#entrega_fecha').focus();
    swal("Error","La fecha y hora de ENTREGA no puede ser menor a un estatus anterior, favor de verificar","error");
  }else {
    var ajaxCall = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/actualizar.php'
    });
    ajaxCall.done(function(r) {
      r = JSON.parse(r);
      if (r.code == 1) {
        listaTrafico();
        console.error(r.message);
      } else if (r.code == 2) {
        console.error(r.message);
      }else {
        console.error(r.message);
      }
    });
  }// fin del if
}// FIN DE LA FUNCION

function detalle_eventos_trafico(pk_bitacora){
  window.location.replace('/pltoolbox/BitacoraProlog/trafico/detalle_eventos.php?evento='+pk_bitacora);
  console.log(pk_bitacora);
}

function fechahora(){
  fechaActual = $('.fecha').val();
  horaActual = $('.hora').val();
}

function listaTrafico(){
  var data = { oficina : $('#oficinaUsuario').val()}

  var ajaxCall = $.ajax({
    method: 'POST',
    data: data,
    url: '/pltoolbox/BitacoraProlog/trafico/actions/mostrar.php'
  });

  ajaxCall.done(function(r) {
    r = JSON.parse(r);
    if (r.code == 1) {
      $('#lista_trafico').html(r.data);
      $('#listaRefTrafico').html(r.dataFact);
    } else {
      console.error(r.message);
    }
  });
}

function validacionEstatus(){
  prealertaF = $('#prealerta_fecha').val();
  prealertaH = $('#prealerta_hora').val();

  arriboF = $('#arribo_fecha').val();
  arriboH = $('#arribo_hora').val();

  aperturaF = $('#apertura_fecha').val();
  aperturaH = $('#apertura_hora').val();

  capfactF = $('#capfact_fecha').val();
  capfactH = $('#capfact_hora').val();

  clasifF = $('#clasif_fecha').val();
  clasifH = $('#clasif_hora').val();

  solantF = $('#solant_fecha').val();
  solantH = $('#solant_hora').val();

  depositoF = $('#deposito_fecha').val();
  depositoH = $('#deposito_hora').val();

  pagoF = $('#pago_fecha').val();
  pagoH = $('#pago_hora').val();

  programF = $('#program_fecha').val();
  programH = $('#program_hora').val();

  entregaF = $('#entrega_fecha').val();
  entregaH = $('#entrega_hora').val();
}
