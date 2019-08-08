<div class="modal fade" id="agregarFacturacion">
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
          <div class="col-md-12">
            <a href="#" class="b">Agregar Factura S/N</a>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <table class="table">
          <tbody>
            <tr class="row justify-content-center">
              <td class="col-md-12">
                <label class="ml-2 m-0">Clientes</label>
                <input class="efecto-1 popup-input w-100" id="fa_cliente" type="text" id-display="#popup-facturacion" action="bp_listaClientes" db-id="" autocomplete="off" required>
                <div class="popup-list" id="popup-facturacion" style="display:none"></div>
              </td>
            </tr>

            <tr class="row">
              <td class="col-md-12">
                <label class="ml-2 m-0">Identificador (cuenta)</label>
                <input id="fa_identCuenta" class="efecto-1" type="text">
              </td>
            </tr>

            <tr class="row">
              <td class="col-md-12">
                <label class="ml-2 m-0">Oficina</label>
                <select id="fa_oficina" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                  <option value="Aeropuerto">Aeropuerto</option>
                  <option value="Laredo Texas">Laredo Texas</option>
                  <option value="Manzanillo">Manzanillo</option>
                  <option value="Nuevo Laredo">Nuevo Laredo</option>
                  <option value="Veracruz">Veracruz</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="border-0 mt-4">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-3">
              <input class="back-aceptar add_factura_SN" type="submit" value="Agregar">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
