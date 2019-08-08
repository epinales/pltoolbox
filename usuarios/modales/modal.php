<div class="modal fade" id="agregarUsuario">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bordenegro">
      <div class="modal-header border-0">
        <h5 class="modal-title"></h5>
        <button type="button" class="close mr-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="mt-3 text-center submodal">
        Usuario Nuevo
      </div>
      <div class="modal-body">

        <form class="form">
          <table class="table">
            <tbody>
              <tr class="row">
                <td class="col-md-6">
                  <label class="m-0 ml-3">Nombre</label>
                  <input id="a_nombre" class="efecto-1" type="text" required>
                </td>
                <td class="col-md-6">
                  <label class="m-0 ml-3">Apellido</label>
                  <input id="a_apellido" class="efecto-1" type="text" required>
                </td>
              </tr>

              <tr class="row">
                <td class="col-md-6">
                  <label class="m-0 ml-3">E-mail</label>
                  <input id="a_email" class="efecto-1 ls-2" type="email" required>
                </td>

                <td class="col-md-6">
                  <label class="m-0 ml-3">Oficina</label>
                  <select id="a_oficina" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                    <option value="Nuevo Laredo">Nuevo Laredo</option>
                    <option value="Manzanillo">Manzanillo</option>
                    <option value="Veracruz">Veracruz</option>
                    <option value="Aeropuerto">Aeropuerto</option>
                    <option value="Laredo Texas">Laredo Texas</option>
                  </select>
                </td>
              </tr>

              <tr class="row">
                <td class="col-md-6">
                  <label class="m-0 ml-3">Usuario</label>
                  <input id="a_usuario" class="efecto-1 ls-2" type="text" required>
                </td>
                <td class="col-md-6">
                  <label class="m-0 ml-3">Contraseña</label>
                  <input id="a_contra" class="efecto-1 ls-2" type="password" required>
                </td>
              </tr>

              <tr class="row">
                <td class="col-md-6">
                  <label class="m-0 ml-3">Estatus</label>
                  <select id="a_estatus" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                    <option value="activo">activo</option>
                    <option value="inactivo">inactivo</option>
                  </select>
                </td>

                <td class="col-md-6">
                  <label class="m-0 ml-3">Tipo</label>
                  <select id="a_tipo" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                    <option value="usuario">usuario</option>
                    <option value="administrador">administrador</option>
                  </select>
                </td>
              </tr>

            </tbody>
          </table>
        </form>

      </div>
      <div class="border-0 mb-4">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-3">
            <input class="u_agregar back-aceptar" type="submit" value="Agregar">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="m-usuarios">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bordenegro">
      <div class="modal-header border-0">
        <h5 class="modal-title"></h5>
        <button type="button" class="close mr-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form">
          <table class="table">
            <tbody>
              <tr class="row">
                <td class="col-md-6">
                  <input id="pk_usuario" type="hidden" value="">
                  <label class="m-0 ml-3">Nombre</label>
                  <input id="u_nombre" class="efecto-1" type="text">
                </td>
                <td class="col-md-6">
                  <label class="m-0 ml-3">Apellido</label>
                  <input id="u_apellido" class="efecto-1" type="text">
                </td>
              </tr>

              <tr class="row">
                <td class="col-md-6">
                  <label class="m-0 ml-3">E-mail</label>
                  <input id="u_email" class="efecto-1 ls-2" type="email">
                </td>
                <td class="col-md-6">
                  <label class="m-0 ml-3">Oficina</label>
                  <select id="u_oficina" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                    <option value="Nuevo Laredo">Nuevo Laredo</option>
                    <option value="Manzanillo">Manzanillo</option>
                    <option value="Veracruz">Veracruz</option>
                    <option value="Aeropuerto">Aeropuerto</option>
                    <option value="Laredo Texas">Laredo Texas</option>
                  </select>
                </td>
              </tr>

              <tr class="row">
                <td class="col-md-6">
                  <label class="m-0 ml-3">Usuario</label>
                  <input id="u_usuario" class="efecto-1 ls-2" type="text">
                </td>
                <td class="col-md-6">
                  <label class="m-0 ml-3">Contraseña</label>
                  <input id="u_contra" class="efecto-1 ls-2" type="password">
                </td>
              </tr>

              <tr class="row">
                <td class="col-md-6">
                  <label class="m-0 ml-3">Estatus</label>
                  <select id="u_estatus" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                    <option value="activo">activo</option>
                    <option value="inactivo">inactivo</option>
                  </select>
                </td>
                <td class="col-md-6">
                  <label class="m-0 ml-3">Tipo</label>
                  <select id="u_tipo" class="efecto-1 ls-2 custom-select py-0" style="height: calc(1.8rem)!important;">
                    <option value="administrador">administrador</option>
                    <option value="usuario">usuario</option>
                  </select>
                </td>
              </tr>

            </tbody>
          </table>
        </form>

      </div>
      <div class="border-0 mb-4">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-3">
            <input id="u_actualizar" class="u_actualizar back-aceptar" type="submit" name="" value="Actualizar">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
