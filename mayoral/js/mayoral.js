$(document).ready(function(){

  //Init function
  $(function(){
    $('#tabla-identificadores').trigger('fetch');
    $('#trato-preferencial-tbl').trigger('fetch');
  });

  //Eventos pagina principal
  $('#tabla-identificadores').on('fetch', function(){
    var tabla = $(this);
    var fetch_identificadores = $.ajax({
      method: 'POST',
      url: 'actions/identificadores/fetch.php'
    });

    fetch_identificadores.done(function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        tabla.html(r.data);
        alertify.success('Identificadores cargados con éxito');
      } else {
        tabla.html('<tr class="bg-transparent"><td>No se encontraron identificadores en el sistema.</td></tr>')
      }
    }).fail(function(x,y,z){
      alertify.error(z);
      console.warn(x);
      console.warn(z);
    });
  });
  $('#tabla-identificadores').on('click', 'tr', function(){
    var id = $(this).data('id');
    var modal = $('#editarIdentificador-modal');
    var lista_fracciones = $('#db-fracciones-aplicables');
    var lista_excepciones = $('#db-fracciones-exceptuadas');

    var data = {
      pk_identificador: id
    }

    var details = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/identificadores/fetchDetails.php'
    });

    var fracciones = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/identificadores/fetchDetails_fracciones.php'
    });

    var excepciones = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/identificadores/fetchDetails_excepciones.php'
    });

    $.when(details, fracciones, excepciones).done(function(i, f, e){
      var i = JSON.parse(i[0]);
      var f = JSON.parse(f[0]);
      var e = JSON.parse(e[0]);
      var item = $();

      if (i.code == 1) {
        for (var field in i.data) {
          if (i.data.hasOwnProperty(field)) {
            $('#'+field).html(i.data[field]);
          }
        }

        for (var i = 0; i < f.data.length; i++) {
          item = $(`<li class="list-group-item"><span>${f.data[i]}</span><i class="far fa-check-circle float-right text-success" action="set-removal" role="button"></i></li>`)
          lista_fracciones.append(item);
        }

        for (var i = 0; i < e.data.length; i++) {
          item = $(`<li class="list-group-item"><span>${e.data[i]}</span><i class="far fa-check-circle float-right text-success" action="set-removal" role="button"></i></li>`)
          lista_excepciones.append(item);
        }

        modal.data('id', id).modal('show');



      } else {
        if (i.code != 1) {
          alertify.message('Error en los identificadores: ' + i.message);
          console.warn(i.message);
        }
        if (f.code != 1) {
          alertify.message('Error en las fracciones aplicables: ' + f.message);
          console.warn(f.message);
        }
        if (e.code != 1) {
          alertify.message('Error en las fracciones excluidas: ' + e.message);
          console.warn(e.message);
        }
      }

    });

  });


  //Eventos modal agregarIdentificadorModal
  $('[name=identificador]').change(function(){
    var testValue = this.value;
    testValue = testValue.toUpperCase();

    this.value = testValue;

    if (testValue == "PB") {
      $('[name=complemento1]')
        .attr('disabled', true)
        .val('UVNOMXXX')
        .siblings('small').fadeIn();
    } else {
      $('[name=complemento1]')
        .attr('disabled', false)
        .attr('placeholder', 'Complemento 1')
        .siblings('small').fadeOut();
    }
  });
  $('[data-toggle=listAddInput]').change(function(){
    var listTarget = $(this).data('target');
    var li = $('<li></li>');

    li.addClass('list-group-item');
    li.append('<span class="nueva-fraccion">' + this.value + '</span>');
    li.append('<i class="fas fa-times float-right text-danger remove-line"></i>');

    $(listTarget).prepend(li);

    $(this).val("").focus();
  });
  $('.list-group').on('click', '.remove-line', function(){
    var li = $(this).parents('li');
    li.remove();
  });
  $('#guardarIdentificador_btn').click(function(){
    var inputs = $('#agregarIdentificadores-forma').find('.custom-input');
    var fracciones_aplicables = $('#fracciones-aplicables').find('li');
    var fracciones_excepciones = $('#fracciones-exceptuadas').find('li');
    var identificador = {};
    var fracciones = {
      aplicables: [],
      excepciones: []
    }

    inputs.each(function(){
      identificador[this.name] = this.value;
    });

    fracciones_aplicables.each(function(){
      var fraccion = $(this).find('span');
      fracciones.aplicables.push(fraccion.html());
    })

    fracciones_excepciones.each(function(){
      var fraccion = $(this).find('span');
      fracciones.excepciones.push(fraccion.html());
    })

    var data = {
      identificador, fracciones
    }

    var add_identificador = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/identificadores/add.php'
    });

    add_identificador.done(function(r){
      r = JSON.parse(r);
      console.log(r);
      if (r.code == 1) {
        alertify.success(r.message);
        $('.modal.show').modal('hide');
        $('#tabla-identificadores').trigger('fetch');
      }
    }).fail(function(x, y, z){
      alertify.warning(z);
      console.warn(y);
    });

  });
  $('.modal').on('hidden.bs.modal', function(){
    var modal = $(this);

    modal.find('.custom-input')
      .val("")
      .attr("disabled", false);
    modal.find('small').fadeOut();
    modal.find('[name=complemento1]').attr('placeholder', "Complemento 1");
    modal.find('.list-group').html('');
  });

  //Eventos modal editarIdentificadorModal
  $('#editarIdentificador-modal').on('fetch', function(){
    var id = $(this).data('id');
    var lista_fracciones = $('#db-fracciones-aplicables');
    var lista_excepciones = $('#db-fracciones-exceptuadas');
    var data = {
      pk_identificador: id
    }


    var fracciones = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/identificadores/fetchDetails_fracciones.php'
    });

    var excepciones = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/identificadores/fetchDetails_excepciones.php'
    });

    $.when(fracciones, excepciones).done(function(f, e){
      var f = JSON.parse(f[0]);
      var e = JSON.parse(e[0]);
      var item = $();

      lista_fracciones.html('');
      lista_excepciones.html('');

      for (var i = 0; i < f.data.length; i++) {
        item = $(`<li class="list-group-item"><span>${f.data[i]}</span><i class="far fa-check-circle float-right text-success" action="set-removal" role="button"></i></li>`)
        lista_fracciones.append(item);
      }

      for (var i = 0; i < e.data.length; i++) {
        item = $(`<li class="list-group-item"><span>${e.data[i]}</span><i class="far fa-check-circle float-right text-success" action="set-removal" role="button"></i></li>`)
        lista_excepciones.append(item);
      }
    })
  });
  $('#editarIdentificador-modal * .list-group').on('click', 'i[action=set-removal]', function(){
    var icon = $(this);

    icon
      .removeClass('text-success')
      .addClass('text-danger')
      .attr('action', 'unset-removal')
      .find('svg').attr('data-icon', 'times-circle')

    icon.parents('li').data('remove', true).addClass('bg-warning');

  });
  $('#editarIdentificador-modal * .list-group').on('click', 'i[action=unset-removal]', function(){
    var icon = $(this);

    icon
      .addClass('text-success')
      .removeClass('text-danger')
      .attr('action', 'set-removal')
      .find('svg').attr('data-icon', 'check-circle')

    icon.parents('li').data('remove', false).removeClass('bg-warning');

  });
  $('#editarIdentificador_btn').click(function(){
    var modal = $(this).parents('.modal');
    var identif = modal.data('id');


    var nuevas_fracciones = {
      aplicables: [],
      excepciones: []
    };
    var eliminar_fracciones = {
      aplicables: [],
      excepciones: []
    };

    modal.find('#db-fracciones-aplicables').find('.nueva-fraccion').each(function(){
      nuevas_fracciones.aplicables.push($(this).html());
    });
    modal.find('#db-fracciones-aplicables').find('li').each(function(){
      if ($(this).data('remove')) {
        eliminar_fracciones.aplicables.push($(this).find('span').html());
      }
    });

    modal.find('#db-fracciones-exceptuadas').find('.nueva-fraccion').each(function(){
      nuevas_fracciones.excepciones.push($(this).html());
    });
    modal.find('#db-fracciones-exceptuadas').find('li').each(function(){
      if ($(this).data('remove')) {
        eliminar_fracciones.excepciones.push($(this).find('span').html());
      }
    });

    data = {
      pk_identificador: identif,
      nuevas_fracciones,
      eliminar_fracciones
    }

    console.log(data);

    var editar_identificador = $.ajax({
      method: 'POST',
      url: 'actions/identificadores/edit_identificador.php',
      data: data
    });

    editar_identificador.done(function(r){
      r = JSON.parse(r);
      modal.trigger('fetch');
    });

  });

  //Eventos trato preferencial
  $('#trato-preferencial-tbl').on('fetch', function(){
    var table = $(this);

    var trato_preferencial = $.ajax({
      method: 'POST',
      url: 'actions/tratoPreferencial/fetch.php'
    });

    trato_preferencial.done(function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        table.html(r.data);
      } else {
        alertify.message('No se encontró la tabla de trato preferencial');
      }
    }).fail(function(x,y,z){
      alertify.error(y + ": " + z);
    });

  });
  $('#tratoPreferencial-tab').on('show.bs.tab', function(){
    $('#trato-preferencial-tbl').trigger('fetch');
  });

  //Eventos precios Estimados
  $('#precios-estimados-tbl').on('fetch', function(){
    var table = $(this);

    var trato_preferencial = $.ajax({
      method: 'POST',
      url: 'actions/preciosEstimados/fetch.php'
    });

    trato_preferencial.done(function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        table.html(r.data);
      } else {
        alertify.message('No se encontró la tabla de trato preferencial');
      }
    }).fail(function(x,y,z){
      alertify.error(y + ": " + z);
    });

  });
  $('#preciosEstimados-tab').on('show.bs.tab', function(){
    $('#precios-estimados-tbl').trigger('fetch');
  });
});
