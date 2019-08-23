<?php
  session_start();

  if (!isset($_SESSION['user'])) {
    header("Location: /pltoolbox/index.php");
  }
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/pltoolbox/hus/barraNavegacion.php';
?>
<link rel="stylesheet" href="resources/hus.css">

<div class="container-fluid flex-grow-1">
    <div class="float-right">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text" id="Filtro"><i class="fas fa-filter"></i></div>
            </div>
            <input type="text" class="form-control" placeholder="Filtro">
        </div>
    </div>
    <ul class="nav nav-pills" id="hus-tablist" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="inventario-tab" data-toggle="tab" href="#inventario-pane" role="tab" aria-controls="inventario" aria-selected="true">Inventario</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="entradas-tab" data-toggle="tab" href="#entradas-pane" role="tab" aria-controls="entradas" aria-selected="false">Entradas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="salidas-tab" data-toggle="tab" href="#salidas-pane" role="tab" aria-controls="salidas" aria-selected="false">Salidas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="consulta-tab" data-toggle="tab" href="#consulta-pane" role="tab" aria-controls="consulta" aria-selected="false">Consulta</a>
        </li>
    </ul>
    <div class="tab-content" id="hus-tabContent">
        <div class="tab-pane show active" id="inventario-pane" role="tabpanel" aria-labelledby="inventario-tab">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Entrada</th>
                    <th>Pallet</th>
                    <th>Número de Parte</th>
                    <th>HU</th>
                    <th>Piezas</th>
                    <th>Fecha Entrada</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>2565436</td>
                    <td>1</td>
                    <td>190-23546780</td>
                    <td>1234567890987654323456789</td>
                    <td>1,440</td>
                    <td>08/14/2019</td>
                </tr>
                <tr>
                    <td>2565436</td>
                    <td>1</td>
                    <td>190-23546780</td>
                    <td>1234567890987654323456789</td>
                    <td>2,880</td>
                    <td>08/14/2019</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="entradas-pane" role="tabpanel" aria-labelledby="entradas-tab">
            <button class="btn btn-info float-right">Nueva Entrada</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Entrada</th>
                        <th>Pallets</th>
                        <th>Fecha Entrada</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1222029</td>
                        <td>25</td>
                        <td>08/14/2019</td>
                        <td class="text-right">
                            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-list-ol"></i></button>
                            <button class="btn btn-sm btn-outline-secondary"><i class="far fa-edit"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="salidas-pane" role="tabpanel" aria-labelledby="salidas-tab">
            Aquí va la información de las salidas
        </div>
        <div class="tab-pane" id="consulta-pane" role="tabpanel" aria-labelledby="consulta-tab">
            Aquí va la información de consulta
        </div>
    </div>
</div>



<?php
require $root . '/pltoolbox/scripts.php';
require $root . '/pltoolbox/hus/footer.php';
?>