<div class="modal fade" tabindex="-1" id="errores-generacion-csv-modal" role="dialog" aria-labelledby="errores-generacion-csvModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Errores Detectados en CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-sm border-danger mt-1">
          <thead>
            <tr>
              <th>Linea Factura</th>
              <th>Mensaje</th>
              <th>Detalles</th>
            </tr>
          </thead>
          <tbody id="tbody_alertas">
          </tbody>
        </table>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
