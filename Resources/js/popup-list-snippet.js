$(document).ready(function(){

  $('.popup-input').keyup(function(){

    var txt = $(this).val();
    var action = $(this).attr('action');
    var url = '/BitacoraProlog/Resources/PHP/actions/' + action + '.php';
    var display = $($(this).attr('id-display'));

    var query_db = $.ajax({
      method: 'POST',
      url: url,
      data: {string: txt}
    });

    query_db.done(function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        display.html(r.data)
          .slideDown();
      } else {
        alert(r.message);
      }
    }).fail(function(x){
      console.error(x);
      alert("Hubo un error, favor de intentar nuevamente.");
    })

  });

  $('.popup-list').on('click', 'p', function(){
    var dbid = $(this).attr('db-id');
    var value = $(this).attr('value');
    var inputTarget = $(this).parent().attr('id');
    $("[id-display='#" + inputTarget+ "']").attr("value", $(this).html()).attr('db-id', $(this).attr('db-id')).change();
    $("[id-display='#" + inputTarget+ "']").prop("value", $(this).html()).change();
    $('.popup-list').slideUp();
  })


});
