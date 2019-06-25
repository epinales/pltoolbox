$(document).ready(function(){
  $('.opcOficina').click(function(){
    var id = $(this).attr('db-id');
    if (id == "Nuevo Laredo") {
      var dbid = 1;
    }else if (id == 'Manzanillo') {
      var dbid = 2;
    }else if (id == 'Veracruz') {
      var dbid = 3;
    }else if (id == 'Aeropuerto') {
      var dbid = 4;
    }else {
      var dbid = 5;
    }
    var fetch_opc = $.ajax({
      method: 'POST',
      data: {dbid: dbid},
      url: '/pltoolbox/BitacoraProlog/opcionesOficina/actions/fetch.php'
    });

    fetch_opc.done(function(r){
      r = JSON.parse(r);

      if (r.code == 1) {
        for (var key in r.data) {

          if (r.data.hasOwnProperty(key)) {
            var iterated_element = $('#' + key);
            var element_type = iterated_element.prop('nodeName');
            var dbid = iterated_element.attr('db-id');
            var value = r.data[key];

            iterated_element.val(value);
            if (typeof dbid !== undefined && dbid !== false) {
              iterated_element.attr('db-id', value)
            }
          }
        }
      } else {
        console.error(r);
      }
    })
  })

  $('#o_nombre').change(function(){

    if ($('#o_nombre').val() == 'Nuevo Laredo') {
      var dbid = 1;
    }else if ($('#o_nombre').val() == 'Manzanillo') {
      var dbid = 2;
    }else if ($('#o_nombre').val() == 'Veracruz') {
      var dbid = 3;
    }else if ($('#o_nombre').val() == 'Aeropuerto') {
      var dbid = 4;
    }else if ($('#o_nombre').val() == 'Laredo Texas') {
      var dbid = 5;
    }

    var fetch_opc = $.ajax({
      method: 'POST',
      data: {dbid: dbid},
      url: '/pltoolbox/BitacoraProlog/opcionesOficina/actions/fetch.php'
    });

    fetch_opc.done(function(r){
      r = JSON.parse(r);

      if (r.code == 1) {
        for (var key in r.data) {

          if (r.data.hasOwnProperty(key)) {
            var iterated_element = $('#' + key);
            var element_type = iterated_element.prop('nodeName');
            var dbid = iterated_element.attr('db-id');
            var value = r.data[key];

            iterated_element.val(value);
            if (typeof dbid !== undefined && dbid !== false) {
              iterated_element.attr('db-id', value)
            }
          }
        }
      } else {
        console.error(r);
      }
    })
  })

  $('.o_modificar').click(function(){
    var data = {
      pk_oficina: $('#pk_oficina').val(),
      o_nombre: $('#o_nombre').val(),
      o_amarillo: $('#o_amarillo').val(),
      o_rojo: $('#o_rojo').val(),
      o_alerta: $('#o_alerta').val(),
    }

    var ajaxCall = $.ajax({
        method: 'POST',
        data: data,
        url: '/pltoolbox/BitacoraProlog/opcionesOficina/actions/editar.php'
    });

    ajaxCall.done(function(r) {
      r = JSON.parse(r);
      if (r.code == 1) {
        swal("Exito", "Se actualizo.", "success");
        $('.modal').modal('hide');
      } else {
        alertify.error('No hubo cambios');
        $('.modal').modal('hide');
        console.error(r.message);
      }
    });
  })

});//documento
