$(document).ready(function(){

  $('#pn-identification').change(function(){
     var val = this.value;

     if (val == ""){
         $('#hu-scan-field').val('').attr('disabled',true).attr('placeholder', 'Especifica el número de parte para poder escanear');
     } else {
         $('#hu-scan-field').attr('disabled',false).attr('placeholder', 'Escanea o escribe el HU').focus();
     }
  });


  //Scanning field events.
  $('#hu-scan-field').change(function(){
    var hu_td = $('<tr><td class="pallet_num"></td><td class="part_num"></td><td class="hu_num"></td><td class="text-right"><button class="btn btn-sm btn-danger remove-tr"><i class="fas fa-times remove-hu-td" role="button"></i></button></td></tr>');
    var hu_p = $('<p><span></span><i class="fas fa-times text-danger float-right remove-grouped-hu" role="button"></i></p>');
    var stack_hus = $('#agruparHUs').prop('checked');

    var part_num = $('#pn-identification').val();
    var this_hu = this.value

    if (!(stack_hus)) {
      var this_td = hu_td.clone();
      var current_pallets = $('#hus_entrada_tbody tr').length;

      this_td.find('.pallet_num').html(current_pallets + 1);
      this_td.find('.part_num').html(part_num);
      this_td.find('.hu_num').html("<p class='m-0'>" + this_hu + '</p>');

      $('#hus_entrada_tbody').prepend(this_td);

      $('#hu-scan-field')
        .val('')
        .focus();
    } else {
      var this_p = hu_p.clone();

      this_p.find('span').html(this_hu);

      $('#hus_agrupados').prepend(this_p);
      $('#hu-scan-field')
        .val('')
        .focus();
    }

  });
  $('#agruparHUs').change(function(e){
    var hus_agrupados = $('#hus_agrupados p').length;
    if (!this.checked && hus_agrupados > 0) {
        alertify.error("No puedes incluir HU's desagrupados sin cerrar o eliminar el pallet actual");
        $(this).prop('checked', true);
        $('#pallet-group-div').addClass('alert-danger');
        setTimeout(function () {
          $('#pallet-group-div').removeClass('alert-danger');
        }, 1500);
    } else if (!this.checked) {
      $('#pallet-group-div').fadeOut();
    } else {
      $('#pallet-group-div').fadeIn();
    }
  });

  $('#eliminar_pallet').click(function(){
    $('#hus_agrupados p').remove();
  });
  $('#cerrar_pallet').click(function(){

    if ($('#hus_agrupados p span').length == 0) {
      return false;
    }

    var grouped_hus = []
    var grouped_tr = $('<tr><td class="pallet_num"></td><td class="part_num"></td><td class="hu_num"></td><td class="text-right"><button class="btn btn-sm btn-info edit-grouped-td"><i class="fas fa-angle-double-left"></i></button><button class="btn btn-sm btn-danger ml-2 remove-tr"><i class="fas fa-times" role="button"></i></button></td></tr>');

    var current_pallets = $('#hus_entrada_tbody tr').length;
    var part_num = $('#pn-identification').val();

    grouped_tr.find('.pallet_num').html(current_pallets + 1);
    grouped_tr.find('.part_num').html(part_num);
    $('#hus_agrupados p span').each(function(){
      var individual_hu = $(this).html();
      grouped_tr.find('.hu_num').prepend('<p class="m-0">' + individual_hu + '</p>')
    });

    $('#hus_entrada_tbody').prepend(grouped_tr);
    $('#hus_agrupados p').remove();

  })

  $('#hus_entrada_tbody').on('click', '.edit-grouped-td', function(e){

    var $tr = $(this).parents('tr');
    console.log($tr);
    var pn = $tr.find('.part_num').html();
    var hu_p = $('<p><span></span><i class="fas fa-times text-danger float-right remove-grouped-hu" role="button"></i></p>');

    $('#pn-identification').val(pn);
    $('#hu-scan-field').val('')
    $('#agruparHUs').prop('checked', true);
    $()

    $tr.find('.hu_num p').each(function(){
      var hu_p_i = hu_p.clone();

      hu_p_i.find('span').html($(this).html());

      console.log(hu_p_i);
      $('#hus_agrupados').prepend(hu_p_i);
      $tr.remove();
      $('#pallet-group-div').fadeIn();
    });
  });
  $('#hus_entrada_tbody').on('click', '.remove-tr',function(){
    $(this).parents('tr').remove();
    $('#hus_entrada_tbody').trigger('enum_tds')
  });
  $('#hus_entrada_tbody').on('enum_tds', function(){
    var ps = $(this).find('tr');
    var ps_i = ps.length;

    ps.each(function(i){
      $(this).find('.pallet_num').html(ps_i - i);
    })
  });


  //Modal Events
  $('#guardar_entrada_modal').on('show.bs.modal', function(){

    $('#partes_modal').html('');

    var parts = {}
    var pallets = 0;
    var hus = 0

    var tr = $('<tr><td class="pn"></td><td class="hu_number"></td><td class="pallet_number"></td></tr>');

    $('#hus_entrada_tbody tr').each(function(){
      var pn = $(this).find('.part_num').html();
      parts[pn] = {pallets: 0, hus: 0}
    });

    $('#hus_entrada_tbody tr').each(function(){
      var pn = $(this).find('.part_num').html();
      parts[pn].pallets++;
      $(this).find('.hu_num p').each(function(){
        parts[pn].hus++
      });
    });

    pallets = 0;
    hus = 0;

    for (var part in parts) {
      if (parts.hasOwnProperty(part)) {
        var thistr = tr.clone();
        thistr.find('.pn').html(part);
        thistr.find('.hu_number').html(parts[part].hus);
        thistr.find('.pallet_number').html(parts[part].pallets);

        $('#partes_modal').append(thistr)
      }
    }
  });
  $('#guardar_entrada_nueva').click(function(){

    var data = {};
    var stop = false;

    $('#new-entry-form input').each(function(){

      if (this.value == "") {
        var stop = true;
        $(this).addClass('is-invalid');
      } else {
        data[this.id] = this.value;
        $(this).removeClass('is-invalid');
      }




    });

    if (stop) {
      return false;
    }
    data.pallets = {};

    $('#hus_entrada_tbody tr').each(function(i){
      var tr = $(this);

      var pallet_num = tr.find('.pallet_num').html();
      var part_num = tr.find('.part_num').html();
      var hu_num = tr.find('.hu_num p');

      data.pallets[i] = {};

      data.pallets[i].pallet_num = pallet_num;
      data.pallets[i].part_num = part_num;
      data.pallets[i].hus = {}

      hu_num.each(function(e){
        data.pallets[i].hus[e] = $(this).html();
      });
    });




    console.log(data);
  });
});
