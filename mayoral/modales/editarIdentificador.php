<div class="modal fade" tabindex="-1" id="editarIdentificador-modal" data-id="" role="dialog" aria-labelledby="editarIdentificadorModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar nuevo identificador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Datos Identificador</h5>
        <form id="editarIdentificadores-forma">
          <div class="mb-3">
            <p class="mb-1"><b>Identificador:</b> <span id="identificador" class="font-weight-light">PS</span></p>
            <p class="mb-1"><b>Complemento 1:</b> <span id="complemento1" class="font-weight-light">PS</span></p>
            <p class="mb-1"><b>Complemento 2:</b> <span id="complemento2" class="font-weight-light">PS</span></p>
            <p class="mb-1"><b>Complemento 3:</b> <span id="complemento3" class="font-weight-light">PS</span></p>
            <p class="mb-1"><b>Complemento 4:</b> <span id="complemento4" class="font-weight-light">PS</span></p>
          </div>
          <h5 class="mb-0">Capitulos, Partidas o Fracciones</h5>
          <small class="mb-2">Escribe el número de Capítulo, Partida o Fraccion sobre la que este indicador es aplicable o bien, si tiene alguna excepción; presiona 'Enter' para agregarla a la lista.</small>
          <div class="d-flex justify-content-between">
            <div class="fracciones-aplicables flex-grow-1 pr-1">
              <h6>Aplicables</h6>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Capítulo, Partida o Fracción" data-toggle="listAddInput" data-target="#db-fracciones-aplicables" name="" value="">
              </div>
              <ul class="list-group" id="db-fracciones-aplicables"></ul>
            </div>
            <div class="fracciones-exceptuadas flex-grow-1 pl-1">
              <h6>Excepciones</h6>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Capítulo, Partida o Fracción" data-toggle="listAddInput" data-target="#db-fracciones-exceptuadas" name="" value="">
              </div>
              <ul class="list-group" id="db-fracciones-exceptuadas"></ul>
            </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="editarIdentificador_btn">Guardar Identificador</button>
      </div>
    </div>
  </div>
</div>
