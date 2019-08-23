<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /pltoolbox/index.php");
}
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/hus/barraNavegacion.php';


?>

<div class="container-fluid">
    <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#guardar_entrada_modal">Guardar Entrada</button>
    <h3>
        <i class="fas fa-chevron-left text-danger" role="button"></i>
        <span>Nueva Entrada<span>
    </h3>
    <div class="d-flex">
        <div style="max-width: 30%">
            <form>
                <!--div class="form-group">
                    <label for="id_entrada">Numero Entrada</label>
                    <input type="text" class="form-control">
                </div-->
                <div class="border rounded p-1 border-dark">
                    <div>Escaneo de HU's</div>
                    <small class="d-block">Para escanear los HU's tienes que especificar primero el número de parte que se va a escanear. Los HU's se iran registrando del lado derecho.</small>
                    <div class="form-inline mb-1">
                        <!--label for="input-hu" class="col-form-label">Numero Parte</label-->
                        <input type="text" class="form-control flex-grow-1" id="pn-identification" placeholder="Número de parte">
                    </div>
                    <div class="form-inline">
                        <!--label for="input-hu" class="col-form-label">Numero HU</label-->
                        <input type="text" class="form-control flex-grow-1" id="hu-scan-field" disabled placeholder="Especifica el número de parte para poder escanear">
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input mr-2" type="checkbox" id="agruparHUs" value='true'>
                        <label class="form-check-label" for="agruparHUs">Selecciona esta casilla si necesitas agrupar varios HUs en un solo pallet</label>
                    </div>
                </div>
            </form>
            <div class="border rounded border-dark mt-3 p-1" id="pallet-group-div" style="display: none">
                <div>HU's En Pallet:</div>
                <div class="d-flex justify-content-between my-2">
                    <button class="btn btn-sm btn-danger" id="eliminar_pallet">Eliminar Pallet</button>
                    <button class="btn btn-sm btn-primary" id="cerrar_pallet">Cerrar Pallet</button>
                </div>
                <hr>
                <div class="hus-agrupados px-5" id="hus_agrupados">
                </div>
            </div>
        </div>
        <div class="flex-grow-1 pl-5">
            HU's Escaneados
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Pallet</th>
                        <th>Número Parte</th>
                        <th>HU</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="hus_entrada_tbody">

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require 'modales/guardar_entrada.php';

require $root . '/pltoolbox/scripts.php';

?>

<script src="../js/nueva_entrada.js" charset="utf-8"></script>
