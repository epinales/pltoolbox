$(document).ready(function(){
listaTrafico();

});

function listaTrafico(){
  var data = { oficina : $('#oficinaUsuario').val()}

  var ajaxCall = $.ajax({
      method: 'POST',
      data: data,
      url: 'actions/mostrar.php'
  });

  ajaxCall.done(function(r) {
    console.log(r);
    r = JSON.parse(r);
    if (r.code == 1) {
      $('#lista_trafico').html(r.data);
    } else {
      console.error(r.message);
    }
  });
}
