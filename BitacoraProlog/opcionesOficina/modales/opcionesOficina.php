<div class="modal fade" id="opcOficina">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title"></h5>
        <button type="button" class="close mr-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="mt-3 text-center submodal">
        <input type="hidden" id="pk_oficina">
        CONFIGURACIÓN :
         <select id="o_nombre" class="custom-select border-0">
          <option value="Nuevo Laredo">Nuevo Laredo</option>
          <option value="Manzanillo">Manzanillo</option>
          <option value="Veracruz">Veracruz</option>
          <option value="Aeropuerto">Aeropuerto</option>
          <option value="Laredo Texas">Laredo Texas</option>
        </select>
      </div>
      <div class="modal-body">
        <table class="table text-center">
          <tr class="row">
            <td class="col-md-12 align-items-center">
              Mostrar marcador <img class="w-25px" src="/pltoolbox/Resources/iconos/circular-amarillo.svg">
              a partir de
              <select id="o_amarillo" class="custom-select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
              días
            </td>
          </tr>

          <tr class="row">
            <td class="col-md-12 align-items-center">
              Mostrar marcador <img class="w-25px" src="/pltoolbox/Resources/iconos/circular-rojo.svg">
              a partir de
              <select id="o_rojo" class="custom-select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
              días
            </td>
          </tr>

          <tr class="row">
            <td class="col-md-12 align-items-center">
              Mostrar marcador <img class="w-25px" src="/pltoolbox/Resources/iconos/warning.svg">
              a partir de
              <select id="o_alerta" class="custom-select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
              días
            </td>
          </tr>
        </table>
      </div>
      <div class="border-0 mb-4">
        <div class="row justify-content-center">
          <div class="col-md-3">
            <input id="o_modificar" class="o_modificar back-aceptar" type="submit" value="Modificar">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
