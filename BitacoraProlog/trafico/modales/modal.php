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

<div class="modal fade" id="adminEstatus">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bordenegro">
      <div class="modal-header border-0 pt-1 pb-0">
        <table class="table mb-0">
          <tr class="row">
            <td class="col-md-2 pt-2 pr-0">
              <input id='referencia' class="w-100 border-0 bt text-center activo" type="text" readonly>
            </td>
            <td class="col-md-9 pt-2 pl-0">
              <input id='nombreCliente' class="w-100 border-0 bt activo" type="text" readonly>
            </td>
            <td class="col-md-1 pr-5">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-body">
        <form class="">
          <table class="table text-center">
            <tbody>
              <tr class="row">
                <td class="col-md-12">
                  <input id='pk_bitacora' type="hidden">
                  <input id='user-modif' value="<?php echo $usuarioAlta ?>" type="hidden">
                  <input id='fecha-mofif' value="<?php echo $fechaAlta ?>" type="hidden">
                  <input class="fecha" type="hidden" value="<?php echo $fechaActual ?>">
                  <input class="hora" type="hidden" value="<?php echo $horaActual ?>">
                </td>
              </tr>


              <tr class="row m-0">
                <td class="col-md-5 p-0 submodal">
                  <label class="m-0 b activo">1. Pre-alerta</label>
                </td>
                <td class="col-md-1"></td>
                <td class="col-md-5 p-0 submodal">
                  <label class="m-0 b activo">6. Solicitud de anticipo / Proforma</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-3">
                  <input id="prealerta_fecha" class="efecto-1" type="date">
                </td>
                <td class="col-md-2 px-0">
                  <input id="prealerta_hora" class="efecto-1" type="time">
                </td>
                <td class="col-md-1 text-left pr-0">
                  <a href="#" id="uno">
                    <img class="w-50" src="/pltoolbox/Resources/iconos/check-mark.svg">
                  </a>
                </td>
                <td class="col-md-3 pl-0">
                  <input id="solant_fecha" class="efecto-1" type="date">
                </td>
                <td class="col-md-2 pl-0">
                  <input id="solant_hora" class="efecto-1" type="time">
                </td>
                <td class="col-md-1 text-left pl-0">
                  <a href="#" id="seis">
                    <img class="w-50" src="/pltoolbox/Resources/iconos/check-mark.svg">
                  </a>
                </td>
              </tr>


              <tr class="row m-0">
                <td class="col-md-5 p-0 submodal">
                  <label class="m-0 b activo">2. Arribo / ETA</label>
                </td>
                <td class="col-md-1"></td>
                <td class="col-md-5 p-0 submodal">
                  <label class="m-0 b activo">7. Depósito</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-3">
                  <input id="arribo_fecha" class="efecto-1" type="date">
                </td>
                <td class="col-md-2 px-0">
                  <input id="arribo_hora" class="efecto-1" type="time">
                </td>

                <td class="col-md-1 text-left pr-0">
                  <a href="#" id="dos">
                    <img class="w-50" src="/pltoolbox/Resources/iconos/check-mark.svg">
                  </a>
                </td>
                <td class="col-md-3 pl-0">
                  <input id="deposito_fecha" class="efecto-1" type="date">
                </td>
                <td class="col-md-2 pl-0">
                  <input id="deposito_hora" class="efecto-1" type="time">
                </td>
                <td class="col-md-1 text-left pl-0">
                  <a href="#" id="">
                    <img class="w-50" src="/pltoolbox/Resources/iconos/check-mark.svg">
                  </a>
                </td>
              </tr>


              <tr class="row m-0">
                <td class="col-md-5 p-0 submodal">
                  <label class="m-0 b activo">3. Apertura</label>
                </td>
                <td class="col-md-1"></td>
                <td class="col-md-5 p-0 submodal">
                  <label class="m-0 b activo">8. Pago</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-3">
                  <input id="apertura_fecha" class="efecto-1" type="date">
                </td>
                <td class="col-md-2 px-0">
                  <input id="apertura_hora" class="efecto-1" type="time">
                </td>
                <td class="col-md-1 text-left pr-0">
                  <a href="#" id="tres">
                    <img class="w-50" src="/pltoolbox/Resources/iconos/check-mark.svg">
                  </a>
                </td>
                <td class="col-md-3 pl-0">
                  <input id="pago_fecha" class="efecto-1" type="date">
                </td>
                <td class="col-md-2 pl-0">
                  <input id="pago_hora" class="efecto-1" type="time">
                </td>
                <td class="col-md-1 text-left pl-0">
                  <a href="#" id="">
                    <img class="w-50" src="/pltoolbox/Resources/iconos/check-mark.svg">
                  </a>
                </td>
              </tr>


              <tr class="row m-0">
                <td class="col-md-5 p-0 submodal">
                  <label class="m-0 b activo">4. Captura de factura / Previo</label>
                </td>
                <td class="col-md-1"></td>
                <td class="col-md-5 p-0 submodal">
                  <label class="m-0 b activo">9. Programación</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-3">
                  <input id="capfact_fecha" class="efecto-1" type="date">
                </td>
                <td class="col-md-2 px-0">
                  <input id="capfact_hora" class="efecto-1" type="time">
                </td>
                <td class="col-md-1 text-left pr-0">
                  <a href="#" id="cuatro">
                    <img class="w-50" src="/pltoolbox/Resources/iconos/check-mark.svg">
                  </a>
                </td>
                <td class="col-md-3 pl-0">
                  <input id="program_fecha" class="efecto-1" type="date">
                </td>
                <td class="col-md-2 pl-0">
                  <input id="program_hora" class="efecto-1" type="time">
                </td>
                <td class="col-md-1 text-left pl-0">
                  <a href="#" id="ocho">
                    <img class="w-50" src="/pltoolbox/Resources/iconos/check-mark.svg">
                  </a>
                </td>
              </tr>


              <tr class="row m-0">
                <td class="col-md-5 p-0 submodal">
                  <label class="m-0 b activo">5. Clasificación</label>
                </td>
                <td class="col-md-1"></td>
                <td class="col-md-5 p-0 submodal">
                  <label class="m-0 b activo">10. Entrega / Despacho</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-3">
                  <input id="clasif_fecha" class="efecto-1" type="date">
                </td>
                <td class="col-md-2 px-0">
                  <input id="clasif_hora" class="efecto-1" type="time">
                </td>
                <td class="col-md-1 text-left pr-0">
                  <a href="#" id="cinco">
                    <img class="w-50" src="/pltoolbox/Resources/iconos/check-mark.svg">
                  </a>
                </td>
                <td class="col-md-3 pl-0">
                  <input id="entrega_fecha" class="efecto-1" type="date">
                </td>
                <td class="col-md-2 pl-0">
                  <input id="entrega_hora" class="efecto-1" type="time">
                </td>
                <td class="col-md-1 text-left pl-0">
                  <a href="#" id="diez">
                    <img class="w-50" src="/pltoolbox/Resources/iconos/check-mark.svg">
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>

      <div id='a_trafico' class="text-center border-0 mb-4 m-0">
        <div class="row m-0 justify-content-center">
          <div class="col-md-3">
            <input class="back-aceptar actualizar_trafico" type="submit" value="ACTUALIZAR">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal">
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
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <input class="back-aceptar a_trafico" type="submit" value="Agregar">

        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>

      <!-- <div class="row align-items-center justify-content-center">
        <div class="col-md-3">
        </div>
      </div> -->
    </div>
  </div>
</div>
