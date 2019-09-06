<div class="modal fade" tabindex="-1" id="agregarIdentificador-modal" role="dialog" aria-labelledby="agregarIdentificadorModal" aria-hidden="true">
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
        <form id="agregarIdentificadores-forma">
          <div class="form-group">
            <input type="text" class="form-control custom-input" name="identificador" placeholder="Identificador" name="" value="">
          </div>
          <div class="form-group">
            <input type="text" class="form-control custom-input" name="complemento1" placeholder="Complemento 1" name="" value="">
            <small style="display: none">Este complemento (correspondiente a la UV) se modificará al momento de procesar la factura.</small>
          </div>
          <div class="form-group">
            <input type="text" class="form-control custom-input" name="complemento2" placeholder="Complemento 2" name="" value="">
          </div>
          <div class="form-group">
            <input type="text" class="form-control custom-input" name="complemento3" placeholder="Complemento 3" name="" value="">
          </div>
          <div class="form-group">
            <input type="text" class="form-control custom-input" name="complemento4" placeholder="Complemento 4" name="" value="">
          </div>
          <h5 class="mb-0">Capitulos, Partidas o Fracciones</h5>
          <small class="mb-2">Escribe el número de Capítulo, Partida o Fraccion sobre la que este indicador es aplicable o bien, si tiene alguna excepción; presiona 'Enter' para agregarla a la lista.</small>
          <div class="d-flex justify-content-between">
            <div class="fracciones-aplicables flex-grow-1 pr-1">
              <h6>Aplicables</h6>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Capítulo, Partida o Fracción" data-toggle="listAddInput" data-target="#fracciones-aplicables" name="" value="">
              </div>
              <ul class="list-group" id="fracciones-aplicables"></ul>
            </div>
            <div class="fracciones-exceptuadas flex-grow-1 pl-1">
              <h6>Excepciones</h6>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Capítulo, Partida o Fracción" data-toggle="listAddInput" data-target="#fracciones-exceptuadas" name="" value="">
              </div>
              <ul class="list-group" id="fracciones-exceptuadas"></ul>
            </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarIdentificador_btn">Guardar Identificador</button>
      </div>
    </div>
  </div>
</div>
