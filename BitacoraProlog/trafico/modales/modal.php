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
        <form class="form">
          <table class="table">
            <tbody>

              <tr class="row">
                <td class="col-md-6 p-0">
                  <input class="efecto-1 popup-input w-100" id="a_referencia" type="text" id-display="#popup-display-listaClientes" action="bp_listaReferencias" db-id="" autocomplete="off" required>
                  <div class="popup-list" id="popup-display-listaClientes" style="display:none"></div>
                  <!-- <label for="txtDescripcion">Cliente</label> -->
                  <!-- <span class="focus-border"></span> -->
                </td>


                <td class="col-md-12">
                  <label class="m-0 ml-3">Input text</label>
                  <input id="" class="efecto-1" type="text">
                </td>
              </tr>


              <tr class="row">
                <td class="col-md-12">
                  <label class="m-0 ml-3">Input password</label>
                  <input id="" class="efecto-1 ls-2" type="password">
                </td>
              </tr>

              <tr class="row">
                <td class="col-md-12">
                  <label class="m-0 ml-3">Input select</label>
                  <select id="" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                    <option value="opcion 1">opcion 1</option>
                    <option value="opcion 2">opcion 2</option>
                    <option value="opcion 3">opcion 3</option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
        </form>

        <div class="border-0 mb-4">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-3">
              <input class="back-aceptar a_trafico" type="submit" value="Agregar">
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
