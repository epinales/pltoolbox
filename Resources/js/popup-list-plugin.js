$(document).ready(function(){

  $('.popup-input').keyup(function(e){
    if (e.keyCode === 38 || e.keyCode === 40 || e.keyCode === 13 || e.keyCode === 9){return false;} //Igorar si es enter, flecha arriba o flecha abajo

    var display = $($(this).attr('id-display'));
    var text = $(this).val();
    var action = $(this).attr('action');
    var url = '/BitacoraProlog/Resources/PHP/actions/popup-actions/' + action + '.php';

    $(this).attr('db-id', '');

    if (text == "") {
      display.slideUp();
      return false;
    }

    var db_query = $.ajax({
      method: 'POST',
      data: {string: text},
      url: url
    });

    db_query.done(function(r){
      //console.log(r);
      r = JSON.parse(r);
      if (r.code == 1) {
        display.html(r.data).slideDown();
      } else {
        alert(r.message);
      }

    }).fail(function(x){
      console.error(x);
      alert("Error, favor de reportarlo a sistemas.");
    })
  })

  $('.popup-list').on('click', 'p', function(){
    var dbid = $(this).attr('db-id');
    var value = $(this).html();
    var inputTarget = $(this).parent().attr('id');

    $("[id-display='#" + inputTarget+ "']").attr("value", value).attr('db-id', dbid).change();
    $("[id-display='#" + inputTarget+ "']").prop("value", value).change();
    $('.popup-list').slideUp();
  });

  $('.popup-list').on('mouseenter', 'p', function(){
    $('.hovered').attr('class', '');
    $(this).attr('class', 'hovered');
  });

  $('.popup-list').on('mouseleave', 'p', function(){
    $(this).attr('class', '')
  });

});

$(document).keydown(function(e){
  if (e.keyCode == 38 || e.keyCode == 40){
    if ($(document.activeElement).attr('id-display') !== undefined) {
      var target = $(document.activeElement).attr('id-display') + " p";
      var targetFocus = $(document.activeElement).attr('id-display') + " p" + ".hovered";

      if ($(targetFocus).length == 0) {
        $(target).first().addClass('hovered');
      } else {
        if (e.keyCode == 40) {
          $(targetFocus).removeClass('hovered').next().addClass('hovered');
        }

        if (e.keyCode == 38) {
          $(targetFocus).removeClass('hovered').prev().addClass('hovered');
        }
      }

    }
  }

  if (e.keyCode === 13 || e.keyCode === 9) {
    var targetFocus = $(document.activeElement).attr('id-display') + " p" + ".hovered";
    var value = $(targetFocus).html();
    var dbid = $(targetFocus).attr('db-id');
    var inputTarget = $(targetFocus).parent().attr('id');

    $("[id-display='#" + inputTarget+ "']").attr("value", value).attr('db-id', dbid);
    $("[id-display='#" + inputTarget+ "']").prop("value", value);
    $('.popup-list').slideUp();

  }
});
