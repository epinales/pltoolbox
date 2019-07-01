$(document).ready(function(){
listaTrafico();

  $('.filtroOficina').click(function(){
    var data = { oficina : $(this).attr('db-id')}

    console.log(data);
  });


  $('.modalTrafico').click(function(){
    $('.addtrafico').addClass('activo');
    $('#addtrafico').show();


    $('#prealerta').hide();
    $('.prealerta').removeClass('activo');
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


  $('.validaRef').click(function(){
    var data = { referencia : $('#a_referencia').val()}

    var ajaxCall = $.ajax({
        method: 'POST',
        data: data,
        url: 'actions/mostrarDatosRef.php'
    });

    ajaxCall.done(function(r) {
      console.log(r);
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
  })// funcion validaRef


    $('.a_trafico').click(function(){

      var data = {
        a_cliente: $('#a_cliente').val(),
        a_estatusActual: $('#a_estatusActual').val(),
        a_estatusSiguiente: $('#a_estatusSiguiente').val(),
        a_oficina: $('#a_oficina').val(),
        a_referencia: $('#a_referencia').val(),
        a_usuarioAlta: $('#a_usuarioAlta').val(),
        a_fechaAlta: $('#a_fechaAlta').val(),
        a_estatusTipo: $('#a_estatusTipo').val(),
        a_tipo: $('#a_tipo').val()
      }

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
    });// funcion Agregar bitacora


    $('.a_preAlerta').click(function(){
      var data = {
        a_cliente: $('#pa_cliente').val(),
        a_estatusActual: $('#pa_estatusActual').val(),
        a_estatusSiguiente: $('#pa_estatusSiguiente').val(),
        a_oficina: $('#pa_oficina').val(),
        a_referencia: "SN",
        a_usuarioAlta: $('#a_usuarioAlta').val(),
        a_fechaAlta: $('#a_fechaAlta').val(),
        a_estatusTipo: $('#a_estatusTipo').val(),
        a_tipo: $('#a_tipo').val()
      }

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
    })



}); //FIN DEL DOCUMENTO

function listaTrafico(){
  var data = { oficina : $('#oficinaUsuario').val()}

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
}
