<div class="modal fade" id="agregarTrafico">
  <div class="modal-dialog" role="document">
    <div class="modal-content bordenegro">
      <div class="modal-header border-0">
        <h5 class="modal-title"></h5>
        <button type="button" class="close mr-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="mt-3 text-center submodal">
        <div class="row">
          <div class="col-md-6">
            <a href="#" class="b addtrafico">Agregar Trafico</a>
          </div>
          <div class="col-md-6">
            <a href="#" class="b prealerta">Pre-Alerta</a>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div id="addtrafico" style="display:none">
          <form class="form">
            <table class="table">
              <tbody>
                <tr class="row">
                  <td class="col-md-12">
                    <input type="hidden" id="a_estatusActual" value="Apertura Referencia">
                    <input type="hidden" id="a_estatusSiguiente" value="Captura de Facturas / Previo">
                    <input type="hidden" id="a_fechaAlta" value="<?php echo $fechaAlta ?>">
                    <input type="hidden" id="a_usuarioAlta" value="<?php echo $usuarioAlta ?>">
                    <input type="hidden" id="a_estatusTipo" value="Trafico">
                  </td>
                </tr>
                <tr class="row justify-content-center">
                  <td class="col-md-6 text-center p-0">
                    <label class="m-0">Referencia</label>
                    <input class="efecto-1 popup-input w-100" id="a_referencia" type="text" id-display="#popup-display-referencias" action="bp_listaReferencias" db-id="" autocomplete="off" required>
                    <div class="popup-list" id="popup-display-referencias" style="display:none"></div>
                  </td>
                  <td class="col-md-1 p-0 pt-4 ml-2">
                    <a href="#" class="validaRef"><img class="w-25px" src="/pltoolbox/Resources/iconos/loupe.svg"></a>
                  </td>
                </tr>
                <tr class='row m-0 align-items-center' id='datosReferencia'></tr>
              </tbody>
            </table>
          </form>

          <div id='a_trafico' class="border-0 mt-4" style="display:none">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-3">
                <input class="back-aceptar a_trafico" type="submit" value="Agregar">
              </div>
            </div>
          </div>
        </div>

        <div id='prealerta'>
          <input type="hidden" id="pa_estatusActual" value="Pre Alerta">
          <input type="hidden" id="pa_estatusSiguiente" value="Arribo">
          <tr class="row justify-content-center">
            <td class="col-md-12 text-center p-0">
              <label class="ml-2 m-0">Clientes</label>
              <input class="efecto-1 popup-input w-100" id="pa_cliente" type="text" id-display="#popup-display-listaClientes" action="bp_listaClientes" db-id="" autocomplete="off" required>
              <div class="popup-list" id="popup-display-listaClientes" style="display:none"></div>
            </td>
          </tr>

          <tr class="row mt-2">
            <td class="col-md-12">
              <label class="ml-2 m-0 mt-3">Oficina</label>
              <select id="pa_oficina" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                <option value="Aeropuerto">Aeropuerto</option>
                <option value="Laredo Texas">Laredo Texas</option>
                <option value="Manzanillo">Manzanillo</option>
                <option value="Nuevo Laredo">Nuevo Laredo</option>
                <option value="Veracruz">Veracruz</option>
              </select>
            </td>
          </tr>

          <div class="border-0 mt-4">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-3">
                <input class="back-aceptar a_preAlerta" type="submit" value="Agregar">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
