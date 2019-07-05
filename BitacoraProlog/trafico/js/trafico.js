$(document).ready(function(){
listaTrafico();

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

   $('tbody').on('click', '.adminEstatus', function(){
     var dbid = $(this).attr('db-id');
     var tar_modal = $($(this).attr('href'));

     var fetch = $.ajax({
       method: 'POST',
       data: {dbid: dbid},
       url: '/pltoolbox/BitacoraProlog/trafico/actions/fetch.php'
     });

     fetch.done(function(r){
       r = JSON.parse(r);

       if (r.code == 1) {

       console.log(r.data);
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
       tar_modal.modal('show');

       } else {
         console.error(r);
       }
     })
   })


   // ESTATUS ESTATUS ESTATUS ESTATUS ESTATUS ESTATUS
   function fechahora(){
     fechaActual = $('.fecha').val();
     horaActual = $('.hora').val();
   }

   $('#uno').click(function(){
     fechahora();
     $('#prealerta_fecha').val(fechaActual);
     $('#prealerta_hora').val(horaActual);
   })

   $('#dos').click(function(){
     fechahora();
     $('#arribo_fecha').val(fechaActual);
     $('#arribo_hora').val(horaActual);
   })

   $('#tres').click(function(){
     fechahora();

     if ($('#arribo_fecha').val() == "") {
       swal("Error","Hay estatus anteriores sin llenar","error");
     }else if ($('#referencia').val() == "SN") {
       $('#exampleModal').modal('show');
     }else {
       $('#apertura_fecha').val(fechaActual);
       $('#apertura_hora').val(horaActual);
     }

   })//fin de #3


   $('.val_ref').click(function(){
     var data = { referencia : $('#val_referencia').val()}

     var ajaxCall = $.ajax({
         method: 'POST',
         data: data,
         url: 'actions/mostrarDatosRef.php'
     });

     ajaxCall.done(function(r) {
       console.log(r);
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


   $('#cuatro').click(function(){
     fechahora();

     if ($('#arribo_fecha').val() == "" || $('#apertura_fecha').val() == "") {
      swal("Error","Hay estatus anteriores sin llenar","error");
      }else {
        $('#capfact_fecha').val(fechaActual);
        $('#capfact_hora').val(horaActual);
      }
    })

    $('#cinco').click(function(){
      fechahora();

      if ($('#arribo_fecha').val() == "" || $('#apertura_fecha').val() == "" || $('#capfact_fecha').val() == "") {
       swal("Error","Hay estatus anteriores sin llenar","error");
       }else {
         $('#clasif_fecha').val(fechaActual);
         $('#clasif_hora').val(horaActual);
       }
     })

     $('#seis').click(function(){
       fechahora();

       if ($('#arribo_fecha').val() == "" || $('#apertura_fecha').val() == "" || $('#capfact_fecha').val() == "" || $('#clasif_fecha').val() == "") {
        swal("Error","Hay estatus anteriores sin llenar","error");
        }else {
          $('#solant_fecha').val(fechaActual);
          $('#solant_hora').val(horaActual);
        }
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
