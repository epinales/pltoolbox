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

<div class="modal fade" id="insertarReferencia">
  <div class="modal-dialog modal-lg">
    <div class="modal-content bordenegro">
      <div class="modal-header border-0">
        <h5 class="modal-title">Insertar Referencia</h5>
        <button type="button" class="close mr-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr class="row justify-content-center">

            <td class="col-md-6 text-center p-0">
              <label class="m-0">Referencia</label>
              <input class="efecto-1 popup-input w-100" id="val_referencia" type="text" id-display="#popup-display-referencias-val" action="bp_listaReferencias" db-id="" autocomplete="off" required>
              <div class="popup-list" id="popup-display-referencias-val" style="display:none"></div>
            </td>
            <td class="col-md-1 p-0 pt-4 ml-2">
              <a href="#" class="val_ref"><img class="w-25px" src="/pltoolbox/Resources/iconos/loupe.svg"></a>
            </td>
          </tr>
          <tr class='row m-0 align-items-center' id='datosReferencia_val'></tr>
        </table>
      </div>
      <div class="modal-footer">
        <input class="back-aceptar act_trafico" type="submit" value="Agregar">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="depositoPago">
  <div class="modal-dialog">
    <div class="modal-content bordenegro">
      <div class="modal-header border-0">
        <h5 class="modal-title">Agregar Deposito o Pago</h5>
        <button type="button" class="close mr-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pb-1">
        <table class="table mb-0">
          <tr class="row justify-content-center mb-5">
            <td class="col-md-10">
              <select id="a_depPago" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                <option value="">Selecciona un tipo</option>
                <option value="Deposito">Déposito</option>
                <option value="Pago">Pago</option>
              </select>
            </td>
          </tr>

          <!-- DEPOSITOS DEPOSITOS DEPOSITOS DEPOSITOS -->

          <tr class="row justify-content-center" id="agregarDepositos" style="display:none">
            <td class="col-md-2 mb-5"></td>
            <td class="col-md-5">
              <input id="dep_monto" class="efecto-1" type="text" placeholder="Monto">
            </td>
            <td class="col-md-3">
              <div class="input-group-prepend">
               <div class="input-group-text w-100">
                 <input id="dep_iva" type="checkbox" class="checkbox mr-3">IVA

                 <input id="dep_ivadepo" type="hidden" name="" value="0">
               </div>
             </div>
            </td>
            <td class="col-md-2"></td>
            <td class="col-md-3">
              <input class="back-aceptar agregar_deposito" type="submit" value="Agregar">
            </td>
          </tr>


          <!-- PAGOS PAGOS PAGOS PAGOS -->

          <tr id="agregarPagos" style="display:none" class="row justify-content-center">
            <td class="col-md-5 offset-md-2">
              <input id="pag_monto" class="efecto-1" type="text" placeholder="Monto Pago">
            </td>
            <td class="col-md-3">
              <div class="input-group-prepend">
               <div class="input-group-text w-100">
                 <input id="pag_iva" type="checkbox" class="mr-3">IVA
                 <input id="pag_ivapago" type="hidden" name="" value="0">

               </div>
             </div>
            </td>
            <td class="col-md-2"></td>

            <td class="col-md-8 offset-md-2">
              <select id="pag_concepto" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                <option value="">Selecciona un concepto</option>
                <option value="Impuestos">Impuestos</option>
                <option value="Desconsolidacion">Desconsolidacion</option>
                <option value="Maniobras">Maniobras</option>
                <option value="Almacenaje">Almacenaje</option>
                <option value="Revalidacion">Revalidacion</option>
                <option value="Corresponsal">Corresponsal</option>
                <option value="Otro">Otro</option>
                <option value="Honorarios y Servicios">Honorarios y Servicios</option>
              </select>
            </td>
            <td class="col-md-2"></td>

            <td class="col-md-8 offset-md-2 mb-5">
              <textarea id="pag_comentarios" class="efecto-1" placeholder="Comentario.."></textarea>
            </td>
            <td class="col-md-2"></td>

            <td class="col-md-3">
              <input class="back-aceptar agregar_pago" type="submit" value="Agregar">
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
