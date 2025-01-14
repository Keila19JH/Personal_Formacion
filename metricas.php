<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// Verificar si el usuario ha iniciado sesión y si tiene el sistema correcto
if (!isset($_SESSION['valid_user']) || $_SESSION['system_type'] !== 'personal_enf') {
  // El usuario no ha iniciado sesión o no tiene permiso para este sistema
  header('Location: login/index.php');
  exit;
}
$username = $_SESSION['valid_user'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Métricas</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="css/styles.css" rel="stylesheet" type="text/css">
  <link href="css/style_logout_admin.css" rel="stylesheet" type="text/css">
  <link href="css/style_logout_general.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

  <?php if ($username == 'admin'): ?>
    <?php include 'components/navbar.php'; ?>
  <?php else: ?>
    <?php include 'components/navbar_general.php'; ?>
  <?php endif; ?>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="modal-content">
          <div class="edicion-personal">
            <h5 class="modal-title text-center">Datos Actuales</h5>
          </div>
          <div class="body-container">
            <div class="titulo-personal">
              <h6 class="bi bi-person-fill-add"> Resumen Personal por Turno</h6>
            </div> <br>
            <div style="overflow-x: auto;" id="tabla-turnos-areas">
              <table class="table">
                <thead>
                  <th>Turno</th>
                  <th>Lunes</th>
                  <th>Martes</th>
                  <th>Miércoles</th>
                  <th>Jueves</th>
                  <th>Viernes</th>
                  <th>Sábado</th>
                  <th>Domingo</th>
                  <th>Total por Turno</th>
                </thead>
                <tbody id="tabla-recuento">
                  <!-- Los datos se insertarán aquí -->
                </tbody>
                <tfoot>
                  <tr>
                    <th>Total por Día</th>
                    <th id="total_lunes"></th>
                    <th id="total_martes"></th>
                    <th id="total_miercoles"></th>
                    <th id="total_jueves"></th>
                    <th id="total_viernes"></th>
                    <th id="total_sabado"></th>
                    <th id="total_domingo"></th>
                    <th id="total_general"></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="text-center mt-3">
              <button class="btn btn-outline-info" onclick="exportToExcel('tabla-turnos-areas','Turnos')">Exportar a Excel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="modal-content">
          <div class="edicion-personal">
            <h5 class="modal-title text-center">Datos Actuales</h5>
          </div>
          <div class="body-container">
            <div class="titulo-personal">
              <h6 class="bi bi-person-fill-add"> Resumen Personal por Servicio</h6>
            </div> <br>
            <div style="overflow-x: auto;" id="tabla-servicios-areas">
              <table class="table">
                <thead>
                  <th>Servicio</th>
                  <th>Lunes</th>
                  <th>Martes</th>
                  <th>Miércoles</th>
                  <th>Jueves</th>
                  <th>Viernes</th>
                  <th>Sábado</th>
                  <th>Domingo</th>
                  <th>Total por Servicio</th>
                </thead>
                <tbody id="tabla-servicio">
                  <!-- Los datos se insertarán aquí -->
                </tbody>
                <tfoot>
                  <tr>
                    <th>Total por Día</th>
                    <th id="total_lunes_servicio"></th>
                    <th id="total_martes_servicio"></th>
                    <th id="total_miercoles_servicio"></th>
                    <th id="total_jueves_servicio"></th>
                    <th id="total_viernes_servicio"></th>
                    <th id="total_sabado_servicio"></th>
                    <th id="total_domingo_servicio"></th>
                    <th id="total_general_servicio"></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="text-center mt-3">
              <button class="btn btn-outline-info" onclick="exportToExcel('tabla-servicios-areas','Servicios')">Exportar a Excel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="modal-content">
          <div class="edicion-personal">
            <h5 class="modal-title text-center">Datos Actuales</h5>
          </div>
          <div class="body-container">
            <div class="titulo-personal">
              <h6 class="bi bi-person-fill-add"> Resumen Academico</h6>
            </div> <br>
            <div id="chartdiv"></div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="modal-content">
          <div class="edicion-personal">
            <h5 class="modal-title text-center">Datos Actuales</h5>
          </div>
          <div class="body-container">
            <div class="titulo-personal">
              <h6 class="bi bi-person-fill-add"> Resumen Especialidad</h6>
            </div> <br>
            <div id="chartdiv2"></div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="modal-content">
          <div class="edicion-personal">
            <h5 class="modal-title text-center">Datos Actuales</h5>
          </div>
          <div class="body-container">
            <div class="titulo-personal">
              <h6 class="bi bi-person-fill-add"> Resumen Genero</h6>
            </div> <br>
            <div id="chartdiv1"></div>

          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="modal-content">
          <div class="body-container">
            <div class="titulo-personal">
              <h6 class="bi bi-person-fill-add"> Resumen Personal por Servicio y Turno</h6>
            </div> <br>
            <div style="overflow-x: auto;" id="tabla-turnos-areas">
              <table class="table">
                <thead id="tabla-cabeceras">
                </thead>
                <tbody id="tabla-datos">
                </tbody>
              </table>
            </div>
            <div class="text-center mt-3">
              <button class="btn btn-success" onclick="exportToExcel('tabla-turnos-areas')">Exportar a Excel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
  <script src="js/metricas_turno.js"></script>
  <script src="js/metricas_servicio.js"></script>
  <script src="js/metricas_graficas.js"></script>






</body>

</html>