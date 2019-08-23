<div class="modal fade" id="guardar_entrada_modal" tabindex="-1" role="dialog" aria-labelledby="guardarEntrada" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelGuardarEntrada">Guardar Entrada Nueva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="new-entry-form">
          <div class="form-row">
            <label for="">Numero de Entrada</label>
            <input type="text" class="form-control" name="" value="" id="entry_num" placeholder="">
            <small class="invalid-feedback">Este campo no puede estar vacío.</small>
          </div>
          <div class="form-row">
            <label for="">Linea Transportista</label>
            <input type="text" class="form-control" name="" value="" id="carrier_name" placeholder="">
            <small class="invalid-feedback">Este campo no puede estar vacío.</small>
          </div>
          <div class="form-row">
            <label for="">Caja o Placas</label>
            <input type="text" class="form-control" name="" value="" id="plates_trailer" placeholder="">
            <small class="invalid-feedback">Este campo no puede estar vacío.</small>
          </div>
          <div class="form-row">
            <label for="">Guía o BL</label>
            <input type="text" class="form-control" name="" value="" id="tracking_bol" placeholder="">
            <small class="invalid-feedback">Este campo no puede estar vacío.</small>
          </div>
        </form>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Número de Parte</th>
              <th>Cantidad HU's</th>
              <th>Pallets</th>
            </tr>
          </thead>
          <tbody id="partes_modal">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardar_entrada_nueva">Guardar</button>
      </div>
    </div>
  </div>
</div>
