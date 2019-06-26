$(document).ready(function(){
	usuarios();

	$('.u_agregar').click(function(){

	  var data = {
			a_nombre: $('#a_nombre').val(),
			a_apellido: $('#a_apellido').val(),
			a_email: $('#a_email').val(),
			a_oficina: $('#a_oficina').val(),
			a_usuario: $('#a_usuario').val(),
			a_contra: $('#a_contra').val(),
			a_estatus: $('#a_estatus').val(),
			a_tipo: $('#a_tipo').val()
	  }
		validacion = $('#a_nombre').val() == "" ||
							$('#a_apellido').val() == "" ||
							$('#a_email').val() == "" ||
							$('#a_oficina').val() == "" ||
							$('#a_usuario').val() == "" ||
							$('#a_contra').val() == "" ||
							$('#a_estatus').val() == "" ||
							$('#a_tipo').val() == "";

	  if (validacion) {
	  	swal("Error","Todos los campos son obligatorios","error");
	  }else {
			var ajaxCall = $.ajax({
		      method: 'POST',
		      data: data,
		      url: '/pltoolbox/usuarios/actions/agregar.php'
		  });

		  ajaxCall.done(function(r) {
		    r = JSON.parse(r);
		    if (r.code == 1) {
		      swal("Exito", "Se guardo correctamente.", "success");
		      usuarios();
					$('.modal').modal('hide');
		    }else {
					swal("FALLO AL AGREGAR","Verificar con sistemas","error");
					usuarios();
					$('.modal').modal('hide');
		    	console.error(r.message);
		    }
		  });
	  }
	});

	$('tbody').on('click', '.editar', function(){
	  var dbid = $(this).attr('db-id');
	  var tar_modal = $($(this).attr('href'));

	  var fetch_usuario = $.ajax({
	    method: 'POST',
	    data: {dbid: dbid},
	    url: 'actions/fetch.php'
	  });

	  fetch_usuario.done(function(r){
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

	$('.u_actualizar').click(function(){
	   validacion = $('#u_nombre').val() == "" ||
							 $('#u_apellido').val() == "" ||
							 $('#u_email').val() == "" ||
							 $('#u_oficina').val() == "" ||
							 $('#u_usuario').val() == "" ||
							 $('#u_contra').val() == "" ||
		 					 $('#u_estatus').val() == "" ||
	             $('#u_tipo').val() == "";

	  var data = {
			pk_usuario: $('#pk_usuario').val(),
			u_nombre: $('#u_nombre').val(),
			u_apellido: $('#u_apellido').val(),
			u_email: $('#u_email').val(),
			u_oficina: $('#u_oficina').val(),
			u_usuario: $('#u_usuario').val(),
			u_contra: $('#u_contra').val(),
			u_estatus: $('#u_estatus').val(),
			u_tipo: $('#u_tipo').val()
	  }


	  if (validacion) {
	    swal("Error","Todos los campos son obligatorios","error");
	  }else{

	    var ajaxCall = $.ajax({
	        method: 'POST',
	        data: data,
	        url: 'actions/editar.php'
	    });

	    ajaxCall.done(function(r) {
	      r = JSON.parse(r);
	      if (r.code == 1) {
	        usuarios();
	        swal("Exito", "Se actualizo.", "success");
	        $('.modal').modal('hide');
	      } else {
	        console.error(r.message);
					$('.modal').modal('hide');
					usuarios();
	      }
	    });
	  }
	})
});//documento

function usuarios(){
	var ajaxCall = $.ajax({
		method: 'POST',
		url: 'actions/mostrar.php'
	});

	ajaxCall.done(function(r) {
		r = JSON.parse(r);
		if (r.code == 1) {
			$('#lista_usuarios').html(r.data);
		} else {
			console.error(r.message);
		}
	});
}
