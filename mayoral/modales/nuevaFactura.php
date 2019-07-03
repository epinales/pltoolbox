<div class="modal fade" tabindex="-1" id="subirFactura-modal" role="dialog" aria-labelledby="subirFacturaModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Subir Nueva Factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Recuerda las siguientes consideraciones:</p>
        <ul>
          <li>El archivo de la(s) factura(s) deberá estar en CSV.</li>
          <li>Solo debe haber 1 hoja en el archivo, con el detalle de todas las facturas</li>
          <li>No importa el orden de las facturas</li>
        </ul>
        <form>
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="facturaMayoral">
              <label class="custom-file-label" for="customFile">Selecciona el archivo</label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="subirFactura_btn">Agregar Factura</button>
      </div>
    </div>
  </div>
</div>
