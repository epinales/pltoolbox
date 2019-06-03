$(document).ready(function(){
  $('.real-time-search').keyup(function(e){
    if (e.keyCode === 38 || e.keyCode === 40 || e.keyCode === 13 || e.keyCode === 9){return false;} //Igorar si es enter, flecha arriba o flecha abajo

    var table_body = $($(this).attr('table-body'));
    var text = $(this).val();
    var action = $(this).attr('action');
    var url = 'actions/' + action + '.php';

    if (text == "") {
      return false;
    }

    data = {
      string: text
    }

    $.each($(this).data(), function(i, v){
      data[i] = v;
    })

    var db_query = $.ajax({
      method: 'POST',
      data: data,
      url: url
    });

    db_query.done(function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        table_body.html(r.data);
      } else {
        alert(r.message);
      }

    }).fail(function(x){
      console.error(x);
      alert("Error, favor de reportarlo a sistemas.");
    })
  })
});
