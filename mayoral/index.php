<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/pltoolbox/Resources/PHP/Utilities/initialScript.php';

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" class="h-100">
  <head>
    <meta charset="utf-8">
    <?php
    require $root . '/pltoolbox/stylesheets.php';
    ?>
    <title>Herramientas Mayoral</title>
  </head>
  <body class="h-100">
    <div class="d-flex w-100 h-100">
      <aside class="border-right h-100 d-fixed side-menu">
        <div class="container-fluid">
          <img src="https://media.mayoral.com/wcsstore/mayoral/images/creatives/Mayoral_Logo_2018.svg" alt="Logo Mayoral" style="max-width: 100%">
        </div>
        <div class="mt-5">
          <ul class="nav flex-column" id="sideMenu-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="inicio-tab" data-toggle="tab" href="#inicio-pane" role="tab" aria-controls="inicio" aria-selected="false">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="identificadores-tab" data-toggle="tab" href="#identificadores-pane" role="tab" aria-controls="identificadores" aria-selected="false">Identificadores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tratoPreferencial-tab" data-toggle="tab" href="#tratoPreferencial-pane" role="tab" aria-controls="tratoPreferencial" aria-selected="false">Trato Preferencial</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="preciosEstimados-tab" data-toggle="tab" href="#preciosEstimados-pane" role="tab" aria-controls="preciosEstimados" aria-selected="false">Precios Estimados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="facturasMayoral-tab" data-toggle="tab" href="#facturasMayoral-pane" role="tab" aria-controls="facturasMayoral" aria-selected="false">Facturas Mayoral</a>
            </li>
          </ul>
        </div>
      </aside>
      <div class="flex-grow-1 container-fluid">
        <div class="tab-content" id="sideMenu-tabContent">
          <div class="tab-pane fade show active mt-5 px-5" id="inicio-pane" role="tabpanel" aria-labelledby="inicio-tab">
            <h4>Bienvenido al portal de procesamiento de facturas de Mayoral!</h4>
            <hr>
            <p>En este portal podrás subir la factura de Mayoral, para que se validen:
              <ul class="">
                <li>Errores de Unidad de Medida (Tarifa)</li>
                <li>Precios Estimados</li>
                <li>Identificadores Requeridos</li>
              </ul>
            </p>
            <h5>¿Como Utilizar el portal?</h5>
            <p>
              <ol>
                <li>En 'Identificadores', se registran todos los identificadores que se necesitan para las operaciones de Mayoral, y se indica a que Fracciones, Capítulos o Partidas se le aplican, o bien si existen fracciones con excepciones.</li>
                <li>En 'Trato Preferencial' se registran los países con los que se tiene trato preferencial, para asegurar que se incluya el identificador TL correspondiente.</li>
                <li>En 'Precios Estimados' carga los precios estimados actualizados, esta información es importante para poder calcular si existen productos por debajo del precio estimado.</li>
                <li>Ya que todas las configuraciones estan actualizadas, en 'Facturas Mayoral' podrás cargar la(s) factura(s) de Mayoral, en formato CSV para poder procesar los indicadores necesarios, revisar los precios estimados, y crear la plantilla para cargar la información al Sistema de Tráfico</li>
              </ol>
            </p>
          </div>
          <div class="tab-pane fade mt-5 px-5 text-center" id="identificadores-pane" role="tabpanel" aria-labelledby="identificadores-tab">
            <div class="" id="lista-identificadores">
              <button type="button" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#agregarIdentificador-modal" name="button">Agregar Identificador</button>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Identificador</th>
                    <th>Complemento 1</th>
                    <th>Complemento 2</th>
                    <th>Complemento 3</th>
                    <th>Complemento 4</th>
                    <th>Fracciones</th>
                    <th>Capitulos</th>
                    <th>Partidas</th>
                    <th>Excepciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>PB</td>
                    <td>UVNOM104</td>
                    <td>NOM-004-SCFI-2006</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="detalle-identificador">

            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <?php

  require 'modales/agregarIdentificador.php';
  require $root . '/pltoolbox/scripts.php';
   ?>
</html>
