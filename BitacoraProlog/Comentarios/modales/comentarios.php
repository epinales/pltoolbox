<!-- COMENTARIOS COMENTARIOS COMENTARIOS COMENTARIOS -->

<div class="modal fade" id="comentarios">
  <div class="modal-dialog modal-lg">
    <div class="modal-content bordenegro">
      <div class="modal-header border-0">
        <h5 class="modal-title">Agregar comentarios</h5>
        <button type="button" class="close mr-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover mb-5">
          <thead>
            <tr class="row justify-content-center mb-5">
              <td class="col-md-8">
                <label class="ml-3">Comentario :</label>
                <textarea id="a_comentario" class="efecto-1"></textarea>
              </td>
            </tr>
          </thead>
          <tbody id='lista_comentarios' class="lista_comentarios"></tbody>
        </table>
      </div>
      <div class="modal-footer justify-content-center">
        <input class="back-aceptar add_comentario" type="submit" value="Agregar">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="comentariosDetalle">
  <div class="modal-dialog modal-lg">
    <div class="modal-content bordenegro">
      <div class="modal-header border-0">
        <h5 class="modal-title">Agregar comentarios</h5>
        <button type="button" class="close mr-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover mb-5">
          <tbody id='lista_comentariosDetalle' class="lista_comentarios"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
