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
require ('php/controllers/datos.controller.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar personal</title>
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
          <div class="modal-header">
            <h5 class="modal-title text-center">Alta de Personal</h5>
          </div>



          <div class="body-container">
            <div class="title">
              <h6 class="bi bi-person-fill-add"> Datos Personales</h6>
            </div> <br>

            <form id="patientForm" method="POST">
              <div class="row">

                <div class="col-md-4">
                  <strong>CURP</strong>
                  <input type="text" class="form-control" id="curp" name="curp" required>
                </div>
                <div class="col-md-4">
                  <strong>Apellido Paterno</strong>
                  <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" required>
                </div>
                <div class="col-md-4">
                  <strong>Apellido Materno</strong>
                  <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" required>
                </div>
                <div class="col-md-4">
                  <strong>Nombre(s)</strong>
                  <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="col-md-4">
                  <strong>Género</strong>
                  <input type="text" class="form-control" id="genero" name="genero" readonly>
                </div>
                <div class="col-md-4">
                  <strong>Onomástico</strong>
                  <input type="date" class="form-control" id="onomastico" name="onomastico" readonly>
                </div>
                <div class="col-md-4">
                  <strong>Edad</strong>
                  <input type="text" class="form-control" id="edad" name="edad" readonly>
                </div>
                <div class="col-md-4">
                  <strong>Domicilio</strong>
                  <input type="text" class="form-control" id="domicilio" name="domicilio" required>
                </div>
                <div class="col-md-4">
                  <strong>Correo personal</strong>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-4">
                  <strong>Teléfono personal</strong>
                  <input type="text" class="form-control" id="telefono_personal" name="telefono_personal" required>
                </div>
                <div class="col-md-4">
                  <strong>RFC </strong>
                  <input type="text" class="form-control" id="RFC" name="RFC" required>
                </div>

              </div> <br>

              <div class="row">
                <div class="col-md-4">
                  <strong>Guarderia</strong>
                  <select name="guarderia" id="guarderia" class="control form-control" required>
                    <option value="">Selecciones</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-2" id="horas_guarderia" style="display: none;">
                  <strong>Hora guardería</strong>
                  <div class="radio-container">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="entrada" name="tiempo_guarderia" value="Entrada">
                      <label class="form-check-label" for="entrada">Entrada</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="salida" name="tiempo_guarderia" value="Salida">
                      <label class="form-check-label" for="salida">Salida</label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6" id="num_hijos" style="display: none;">
                  <strong>Hijos</strong>
                  <div class="checkbox-container">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_1" name="childrens_1">
                      <label class="form-check-label" for="childrens_1">0 a 5 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_2" name="childrens_2">
                      <label class="form-check-label" for="childrens_2">6 a 10 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_3" name="childrens_3">
                      <label class="form-check-label" for="childrens_3">11 a 15 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_4" name="childrens_4">
                      <label class="form-check-label" for="childrens_4">más de 15 años</label>
                    </div>
                  </div>
                </div>
              </div> <br>
              <div class="row">

                <div class="col-md-4">
                  <strong>Contacto Emergencia</strong>
                  <select id="contacto_emergencia" name="contacto_emergencia" class="control form-control" required>
                    <option value="Sin seleccion">Seleccione...</option>
                    <option value="Padre / Madre">Padre / Madre</option>
                    <option value="Hermano (a)">Hermano (a)</option>
                    <option value="Esposo (a)">Esposo (a)</option>
                    <option value="Hijo (a)">Hijo (a)</option>
                    <option value="Otro">Otro</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Nombre Contacto Emergencia</strong>
                  <input type="text" class="form-control" id="contacto" name="contacto" required>
                </div>



                <div class="col-md-4">
                  <strong>No. Contacto Emergencia</strong>
                  <input type="number" class="form-control" id="no_contacto_emergencia" name="no_contacto_emergencia"
                    placeholder="5558585767" required>
                </div>



              </div><br>


              <div class="title">
                <h6 class="bi bi-person-vcard"> Información Contrato</h6>
              </div> <br>

              <div class="row">

                <div class="col-md-4">
                  <strong>No. Empleado</strong>
                  <input type="number" name="noempleado" id="noempleado" class="form-control" required>
                </div>

                <div class="col-md-4">
                  <strong>Tipo de Contrato:</strong>
                  <select id="tipocontrato" name="tipocontrato" class="control form-control" required>
                    <option value="Sin seleccion">Seleccione...</option>
                    <option value="Base">Base</option>
                    <option value="Confianza">Confianza</option>
                    <option value="Eventual">Eventual</option>
                    <option value="Provisional Reservada">Provisional Reservada</option>
                    <option value="Base IMSS bienestar">Base IMSS bienestar</option>
                    <option value="Subdirectora">Subdirectora</option>
                    <option value="Interinato">Interinato</option>
                    <option value="Otros">Otros</option>
                  </select>
                </div>

                <div class="col-md-4" id="fechaBas" style="display: none;">
                  <strong>Fecha de basificación</strong>
                  <input type="date" class="form-control" id="fechaBasificacion" name="fechaBasificacion">
                </div>

                <div class="col-md-4">
                  <strong>Código</strong>
                  <input type="text" class="form-control" id="codigo" name="codigo" required>
                </div>

                <div class="col-md-4">
                  <strong>Puesto</strong>
                  <select class="form-control" name="puesto" id="puesto" required>
                    <option value="">Seleccione</option>
                    <?php
                    if (!empty($data_puesto)) {
                      foreach ($data_puesto as $row1) {
                        echo "<option value='" . $row1["id_puesto"] . "'>" . $row1["puesto"] . "</option>";
                      }
                    } else {
                      echo "<option value=''>No hay datos disponibles</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Fecha Ingreso</strong>
                  <input type="date" class="form-control" id="fechaIngreso" name="fechaIngreso" required>
                </div>


                <div class="col-md-4">
                  <strong>Año En Curso</strong>
                  <select class="form-control" name="ayo_curso" id="ayo_curso" required>
                    <option value="">Seleccione</option>
                    <option value="2024-1">2024-1</option>
                    <option value="2024-2">2024-2</option>
                    <option value="2025-1">2025-1</option>
                    <option value="2025-2">2025-2</option>
                    <option value="2026-1">2026-1</option>
                    <option value="2026-2">2026-2</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Turno</strong>
                  <select class="form-control" name="turno" id="turno" required>
                    <option value="">Seleccione</option>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                    <option value="Nocturno">Nocturno</option>
                    <option value="Jornada">Jornada Especial</option>
                  </select>
                </div>


                <div class="col-md-8">
                  <strong>Días laborales</strong>
                  <div class="checkbox-container">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="lunes" name="lunes" value="Lunes">
                      <label class="form-check-label" for="lunes">Lunes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="martes" name="martes" value="Martes">
                      <label class="form-check-label" for="martes">Martes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="miercoles" name="miercoles" value="Miércoles">
                      <label class="form-check-label" for="miercoles">Miércoles</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="jueves" name="jueves" value="Jueves">
                      <label class="form-check-label" for="jueves">Jueves</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="viernes" name="viernes" value="Viernes">
                      <label class="form-check-label" for="viernes">Viernes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="sabado" name="sabado" value="Sábado">
                      <label class="form-check-label" for="sabado">Sábado</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="domingo" name="domingo" value="Domingo">
                      <label class="form-check-label" for="domingo">Domingo</label>
                    </div>

                  </div>
                </div>

                <div class="col-md-4">
                  <strong>Servicio</strong>
                  <select class="form-control" name="Servicio" id="Servicio" required>
                    <option value="">Seleccione</option>
                    <?php
                    if (!empty($data_servicio)) {
                      foreach ($data_servicio as $row1) {
                        echo "<option value='" . $row1["id_servicio"] . "'>" . $row1["servicio"] . "</option>";
                      }
                    } else {
                      echo "<option value=''>No hay datos disponibles</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Horario (De: )</strong>
                  <input type="time" class="form-control" id="horario_de" name="horario_de">
                </div>

                <div class="col-md-4">
                  <strong>Horario (A: )</strong>
                  <input type="time" class="form-control" id="horario_a" name="horario_a">
                </div>

                <div class="col-md-4">
                  <strong>Cuenta con otro empleo</strong>
                  <select name="Otro_empleo" id="Otro_empleo" class="control form-control" required>
                    <option value="">Selecciones</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-4" id="div_antigüedad" style="display: none;">
                  <strong>Antigüedad</strong>
                  <input type="text" class="form-control" id="antigüedad" name="antigüedad">
                </div>

                <div class="col-md-4" id="div_tipo_contratacion" style="display: none;">
                  <strong>Tipo de Contratación</strong>
                  <select name="tipo_contratacion" id="tipo_contratacion" class="control form-control">
                    <option value="">Selecciones</option>
                    <option value="Base">Base</option>
                    <option value="Eventual">Eventual</option>
                    <option value="Otro">Otro</option>
                  </select>
                </div>

                <div class="col-md-4" id="div_otro_contratacion" style="display: none;">
                  <strong>Otro (Contratación)</strong>
                  <input type="text" class="form-control" id="otro_contratacion" name="otro_contratacion">
                </div>

                <div class="col-md-4" id="div_dependencia" style="display: none;">
                  <strong>Dependencia</strong>
                  <select name="dependencia" id="dependencia" class="control form-control">
                    <option value="">Selecciones</option>
                    <option value="IMSS">IMSS</option>
                    <option value="ISSSTE">ISSSTE</option>
                    <option value="PEMEX">PEMEX</option>
                    <option value="ISEM">ISEM</option>
                    <option value="ISEMYM">ISEMYM</option>
                    <option value="SSA">SSA</option>
                    <option value="IMSS BIENESTAR">IMSS BIENESTAR</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Servicios de rotación los últimos 5 años</strong>
                  <input type="text" class="form-control" id="rotaciones" name="rotaciones">
                </div>

                <div class="col-md-4">
                  <strong>Foto</strong>
                  <input type="file" accept=".jpg, .jpeg, .png" class="form-control-file" id="foto" name="foto"
                    required>
                </div>


                <div class="col-md-4">
                  <strong>Previsualización de la Foto</strong>
                  <img id="imagenPrevisualizacion" src="#" alt="Previsualización de la Foto"
                    style="max-width: 70%; max-height: 200px;">
                </div>


              </div> <br>

              <div class="title">
                <h6 class="bi bi-mortarboard-fill"> Información Académica</h6>
              </div> <br>

              <div class="row">

                <div class="col-md-8">
                  <strong>Técnico</strong>
                  <input type="text" class="form-control" id="grado_tecnico" name="grado_tecnico">
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_tecnico" name="cedula_tecnico">
                </div>

                <div class="col-md-8">
                  <strong>Post-Técnico</strong>
                  <input type="text" class="form-control" id="grado_posttecnico" name="grado_posttecnico">
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_posttecnico" name="cedula_posttecnico">
                </div>

                <div class="col-md-8">
                  <strong>Licenciatura</strong>
                  <input type="text" class="form-control" id="grado_licenciatura" name="grado_licenciatura">
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_lic" name="cedula_lic">
                </div>

                <div class="col-md-8">
                  <strong>Especialidad</strong>
                  <select class="form-control" id="grado_especialidad" name="grado_especialidad">
                    <option value="">Seleccione...</option>
                    <option value="Administración">Administración</option>
                    <option value="Quirúrgica">Quirúrgica</option>
                    <option value="Heridas y Estomas">Heridas y Estomas</option>
                    <option value="Tanatología">Tanatología</option>
                    <option value="Terapia Intravenosa">Terapia Intravenosa</option>
                    <option value="Educación">Educación</option>
                    <option value="Enfermería">Enfermería</option>
                    <option value="Intensivista">Intensivista</option>
                    <option value="Pediatría">Pediatría</option>
                    <option value="Neonatos">Neonatos</option>
                    <option value="Cardiología">Cardiología</option>
                    <option value="Materno Infantil">Materno Infantil</option>
                    <option value="Atención el hogar">Atención el hogar</option>
                    <option value="Perinatal">Perinatal</option>
                    <option value="Oncología">Oncología</option>
                    <option value="Rehabilitación">Rehabilitación</option>
                    <option value="Geriatría">Geriatría</option>
                    <option value="Heridas">Heridas</option>
                    <option value="Nefrología">Nefrología</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_especialidad" name="cedula_especialidad">
                </div>

                <div class="col-md-8">
                  <strong>Maestría</strong>
                  <input type="text" class="form-control" id="grado_maestria" name="grado_maestria">
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_maestria" name="cedula_maestria">
                </div>

                <div class="col-md-8">
                  <strong>Doctorado</strong>
                  <select class="form-control" id="grado_doctorado" name="grado_doctorado">
                    <option value="">Seleccione...</option>
                    <option value="Educación">Educación</option>
                    <option value="Administración">Administración</option>
                    <option value="Investigación">Investigación</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_doctorado" name="cedula_doctorado">
                </div>

                <div class="col-md-3">
                  <strong>Colegiación</strong>
                  <select class="form-control" name="colegiacion" id="colegiacion" required
                    onchange="habilitarCampos('colegiacion')">
                    <option value="">Seleccione</option>
                    <option value="Si">Sí</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_colegiacion" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_colegiacion"
                    name="fechaExpedicion_colegiacion"
                    onchange="calcularFechaVigencia('colegiacion')">
                </div>

                <div class="col-md-3" id="divFechaVigencia_colegiacion" style="display: none;">
                  <strong>Vigencia Colegiación</strong>
                  <input type="date" class="form-control" id="fechaVigencia_colegiacion"
                    name="fechaVigencia_colegiacion" readonly>
                </div>

                <div class="col-md-3" id="divEstatus_colegiacion" style="display: none;">
                  <strong>Estatus Colegiación</strong>
                  <input type="text" class="form-control" id="estatus_colegiacion" name="estatus_colegiacion" readonly>
                </div>
              </div>

              <div class="row">
                <div class="col-md-3">
                  <strong>Certificación</strong>
                  <select class="form-control" name="certificacion" id="certificacion" required
                    onchange="habilitarCampos('certificacion')">
                    <option value="">Seleccione</option>
                    <option value="Si">Sí</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_certificacion" style="display: none;">
                  <strong>Fecha Certificación</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_certificacion"
                    name="fechaExpedicion_certificacion"
                    onchange="calcularFechaVigencia('certificacion')">
                </div>

                <div class="col-md-3" id="divFechaVigencia_certificacion" style="display: none;">
                  <strong>Vigencia Certificación</strong>
                  <input type="date" class="form-control" id="fechaVigencia_certificacion"
                    name="fechaVigencia_certificacion" readonly>
                </div>

                <div class="col-md-3" id="divEstatus_certificacion" style="display: none;">
                  <strong>Estatus Certificación</strong>
                  <input type="text" class="form-control" id="estatus_certificacion" name="estatus_certificacion"
                    readonly>
                </div>

                <div class="col-md-12">
                  <strong>Competencias profesionales</strong>
                  <input type="text" class="form-control" id="competencias_profesionales" name="competencias_profesionales">
                </div>

                <div class="col-md-12">
                  <strong>Observaciones</strong>
                  <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>

              </div>

              <br>
              <div class="text-right"> <!-- Agregamos la clase text-right para alinear el contenido a la derecha -->
                <button type="button" class="btn btn-danger btn-sm" id="limpiarFormularioBtn">Limpiar</button>
                <button type="submit" class="btn btn-success btn-sm">Guardar</button>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'components/loader.php'; ?>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/curp.js"></script>



  <script type="module">
    import { mainForm } from './js/insert.js';
    mainForm();
  </script>



</body>

</html>