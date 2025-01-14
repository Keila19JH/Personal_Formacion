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
include('php/controllers/edit.controller.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Personal</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="css/styles.css" rel="stylesheet" type="text/css" />
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
            <h5 class="modal-title text-center">Edición de Personal</h5>
          </div>
          <div class="body-container">
            <div class="titulo-personal">
              <h6 class="bi bi-person-fill-add"> Datos Personales</h6>
            </div> <br>

            <form id="patientForm" method="POST" enctype="multipart/form-data">
              <div class="row">
                <input type="hidden" id="id_enfermero" name="id_enfermero" value="<?php echo $id_enfermero; ?>">

                <div class="col-md-4">
                  <strong>CURP</strong>
                  <input type="text" class="form-control" id="CURP" name="CURP" required value="<?php echo $curp ?>">
                </div>

                <div class="col-md-4">
                  <strong>Apellido Paterno</strong>
                  <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno"
                    value="<?php echo $apellidoPaterno ?>" required>
                </div>

                <div class="col-md-4">
                  <strong>Apellido Materno</strong>
                  <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno"
                    value="<?php echo $apellidoMaterno ?>" required>
                </div>

                <div class="col-md-4">
                  <strong>Nombre(s)</strong>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>"
                    required>
                </div>

                <div class="col-md-4">
                  <strong>Género</strong>
                  <input type="text" class="form-control" id="genero" name="genero" readonly
                    value="<?php echo $genero ?>">
                </div>

                <div class="col-md-4">
                  <strong>Onomástico</strong>
                  <input type="date" class="form-control" id="onomastico" name="onomastico" readonly
                    value="<?php echo $onomastico ?>">
                </div>

                <div class="col-md-4">
                  <strong>Edad</strong>
                  <input type="text" class="form-control" id="edad" name="edad" readonly value="<?php echo $edad ?>">
                </div>

                <div class="col-md-4">
                  <strong>Domicilio</strong>
                  <input type="text" class="form-control" id="domicilio" name="domicilio" required
                    value="<?php echo $domicilio ?>">
                </div>
                <div class="col-md-4">
                  <strong>Correo personal</strong>
                  <input type="email" class="form-control" id="email" name="email" required
                    value="<?php echo $email ?>">
                </div>
                <div class="col-md-4">
                  <strong>Teléfono personal</strong>
                  <input type="text" class="form-control" id="telefono_personal" name="telefono_personal" required
                    value="<?php echo $telefono_personal ?>">
                </div>

                <div class="col-md-4">
                  <strong>RFC </strong>
                  <input type="text" class="form-control" id="RFC" name="RFC" required value="<?php echo $RFC ?>">
                </div>

              </div> <br>

              <div class="row">
                <div class="col-md-4">
                  <strong>Guarderia</strong>
                  <select name="guarderia" id="guarderia" class="control form-control" required>
                    <option value="" <?php if ($guarderia == '')
                      echo 'selected'; ?>>Selecciones</option>
                    <option value="Si" <?php if ($guarderia == 'Si')
                      echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($guarderia == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-2" id="horas_guarderia" style="display: none;">
                  <strong>Hora guardería</strong>
                  <div class="radio-container">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="entrada" name="tiempo_guarderia" value="Entrada"
                        <?php if ($tiempo_guarderia == 'Entrada')
                          echo "checked"; ?>>
                      <label class="form-check-label" for="entrada">Entrada</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="salida" name="tiempo_guarderia" value="Salida"
                        <?php if ($tiempo_guarderia == 'Salida')
                          echo "checked"; ?>>
                      <label class="form-check-label" for="salida">Salida</label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6" id="num_hijos" style="display: none;">
                  <strong>Hijos</strong>
                  <div class="checkbox-container">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_1" name="childrens_1" <?php if ($childrens_1 == 'Si')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="childrens_1">0 a 5 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_2" name="childrens_2" <?php if ($childrens_2 == 'Si')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="childrens_2">6 a 10 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_3" name="childrens_3" <?php if ($childrens_3 == 'Si')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="childrens_3">11 a 15 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_4" name="childrens_4" <?php if ($childrens_4 == 'Si')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="childrens_4">más de 15 años</label>
                    </div>
                  </div>
                </div>
              </div> <br>

              <div class="row">

                <div class="col-md-4">
                  <strong>Contacto Emergencia</strong>
                  <select id="contacto_emergencia" name="contacto_emergencia" class="control form-control" required>
                    <option value="Sin seleccion" <?php if ($contacto_emergencia == 'Sin seleccion')
                      echo 'selected'; ?>>
                      Seleccione...</option>
                    <option value="Padre / Madre" <?php if ($contacto_emergencia == 'Padre / Madre')
                      echo 'selected'; ?>>
                      Padre / Madre</option>
                    <option value="Hermano (a)" <?php if ($contacto_emergencia == 'Hermano (a)')
                      echo 'selected'; ?>>
                      Hermano (a)</option>
                    <option value="Esposo (a)" <?php if ($contacto_emergencia == 'Esposo (a')
                      echo 'selected'; ?>>Esposo
                      (a)</option>
                    <option value="Hijo (a)" <?php if ($contacto_emergencia == 'Hijo (a)')
                      echo 'selected'; ?>>Hijo (a)
                    </option>
                    <option value="Otro" <?php if ($contacto_emergencia == 'Otro')
                      echo 'selected'; ?>>Otro</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Nombre Contacto Emergencia</strong>
                  <input type="text" class="form-control" id="contacto" name="contacto" required
                    value="<?php echo $contacto ?>">
                </div>



                <div class="col-md-4">
                  <strong>No. Contacto Emergencia</strong>
                  <input type="number" class="form-control" id="no_contacto_emergencia" name="no_contacto_emergencia"
                    placeholder="5558585767" required value="<?php echo $no_contacto_emergencia ?>">
                </div>



              </div><br>

              <div class="titulo-personal">
                <h6 class="bi bi-person-vcard"> Información Contrato</h6>
              </div> <br>

              <div class="row">
                <div class="col-md-4">
                  <strong>No. Empleado</strong>
                  <input type="number" name="noempleado" id="noempleado" class="form-control"
                    value="<?php echo $noempleado ?>" required>
                </div>

                <div class="col-md-4">
                  <strong>Tipo de Contrato:</strong>
                  <select id="tipocontrato" name="tipocontrato" class="control form-control" style="font-size: 13px;"
                    required>
                    <option value="Sin seleccion" <?php if ($tipocontrato == 'Sin seleccion')
                      echo 'selected'; ?>>
                      Seleccione...</option>
                    <option value="Base" <?php if ($tipocontrato == 'Base')
                      echo 'selected'; ?>>Base</option>
                    <option value="Confianza" <?php if ($tipocontrato == 'Confianza')
                      echo 'selected'; ?>>Confianza
                    </option>
                    <option value="Eventual" <?php if ($tipocontrato == 'Eventual')
                      echo 'selected'; ?>>Eventual</option>
                    <option value="Provisional Reservada" <?php if ($tipocontrato == 'Provisional Reservada')
                      echo 'selected'; ?>>Provisional Reservada</option>
                    <option value="Base IMSS bienestar" <?php if ($tipocontrato == 'Base IMSS bienestar')
                      echo 'selected'; ?>>Base IMSS bienestar</option>
                    <option value="Subdirectora" <?php if ($tipocontrato == 'Subdirectora')
                      echo 'selected'; ?>>Subdirectora</option>
                    <option value="Interinato" <?php if ($tipocontrato == 'Interinato')
                      echo 'selected'; ?>>Interinato
                    </option>
                    <option value="Otros" <?php if ($tipocontrato == 'Otros')
                      echo 'selected'; ?>>Otros</option>
                  </select>
                </div>

                <div class="col-md-4" id="fechaBas" style="display: none;">
                  <strong>Fecha de basificación</strong>
                  <input type="date" class="form-control" id="fechaBasificacion" name="fechaBasificacion"
                    value="<?php echo $fechaBasificacion ?>">
                </div>

                <div class="col-md-4">
                  <strong>Código</strong>
                  <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $codigo ?>"
                    required>
                </div>

                <div class="col-md-4">
                  <strong>Puesto</strong>
                  <select class="form-control" name="puesto" id="puesto" required>
                    <?php
                    if (!empty($data_puesto)) {
                      foreach ($data_puesto as $row1) {
                        $selected = ($row1["id_puesto"] == $puesto) ? 'selected' : '';
                        echo "<option value='" . $row1["id_puesto"] . "' $selected>" . $row1["puesto"] . "</option>";
                      }
                    } else {
                      echo "<option value=''>No hay datos disponibles</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Fecha Ingreso</strong>
                  <input type="date" class="form-control" id="fechaIngreso" name="fechaIngreso"
                    value="<?php echo $fechaIngreso ?>" required>
                </div>


                <!-- PONER AÑO -->
                <div class="col-md-4">
                  <strong>Año En Curso</strong>
                  <select class="form-control" name="ayo_curso" id="ayo_curso" required>
                    <option value="" <?php if ($ayo_curso == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="2024-1" <?php if ($ayo_curso == '2024-1')
                      echo 'selected'; ?>>2024-1</option>
                    <option value="2024-2" <?php if ($ayo_curso == '2024-2')
                      echo 'selected'; ?>>2024-2</option>
                    <option value="2025-1" <?php if ($ayo_curso == '2025-1')
                      echo 'selected'; ?>>2025-1</option>
                    <option value="2025-2" <?php if ($ayo_curso == '2025-2')
                      echo 'selected'; ?>>2025-2</option>
                    <option value="2026-1" <?php if ($ayo_curso == '2026-1')
                      echo 'selected'; ?>>2026-1</option>
                    <option value="2026-2" <?php if ($ayo_curso == '2026-2')
                      echo 'selected'; ?>>2026-2</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Turno</strong>
                  <select class="form-control" name="turno" id="turno">
                    <option value="Seleccione..." <?php if ($turno == 'Seleccione...')
                      echo 'selected'; ?>>Seleccione...
                    </option>
                    <option value="Matutino" <?php if ($turno == 'Matutino')
                      echo 'selected'; ?>>Matutino</option>
                    <option value="Vespertino" <?php if ($turno == 'Vespertino')
                      echo 'selected'; ?>>Vespertino</option>
                    <option value="Nocturno" <?php if ($turno == 'Nocturno')
                      echo 'selected'; ?>>Nocturno</option>
                    <option value="Jornada Especial" <?php if ($turno == 'Jornada Especial')
                      echo 'selected'; ?>>Jornada
                      Especial</option>
                  </select>
                </div>


                <div class="col-md-8">
                  <strong>Días laborales</strong>
                  <div class="checkbox-container">

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="lunes" name="lunes" value="Lunes" <?php if ($lunes == 'Lunes')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="lunes">Lunes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="martes" name="martes" value="Martes" <?php if ($martes == 'Martes')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="martes">Martes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="miercoles" name="miercoles" value="Miércoles"
                        <?php if ($miercoles == 'Miércoles')
                          echo "checked"; ?>>
                      <label class="form-check-label" for="miercoles">Miércoles</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="jueves" name="jueves" value="Jueves" <?php if ($jueves == 'Jueves')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="jueves">Jueves</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="viernes" name="viernes" value="Viernes" <?php if ($viernes == 'Viernes')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="viernes">Viernes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="sabado" name="sabado" value="Sábado" <?php if ($sabado == 'Sábado')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="sabado">Sábado</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="domingo" name="domingo" value="Domingo" <?php if ($domingo == 'Domingo')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="domingo">Domingo</label>
                    </div>

                  </div>
                </div>



                <div class="col-md-4">
                  <strong>Servicio</strong>
                  <select class="form-control" name="Servicio" id="Servicio" required>
                    <?php
                    if (!empty($data_servicio)) {
                      foreach ($data_servicio as $row1) {
                        $selected = ($row1["id_servicio"] == $servicio) ? 'selected' : '';
                        echo "<option value='" . $row1["id_servicio"] . "' $selected>" . $row1["servicio"] . "</option>";
                      }
                    } else {
                      echo "<option value=''>No hay datos disponibles</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Horario (De: )</strong>
                  <input type="time" class="form-control" id="horario_de" name="horario_de"
                    value="<?php echo $horario_de ?>">
                </div>

                <div class="col-md-4">
                  <strong>Horario (A: )</strong>
                  <input type="time" class="form-control" id="horario_a" name="horario_a"
                    value="<?php echo $horario_a ?>">
                </div>

                <div class="col-md-4">
                  <strong>Cuenta con otro empleo</strong>
                  <select name="Otro_empleo" id="Otro_empleo" class="control form-control" required>
                    <option value="" <?php if ($Otro_empleo == '')
                      echo 'selected'; ?>>Selecciones</option>
                    <option value="Si" <?php if ($Otro_empleo == 'Si')
                      echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($Otro_empleo == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-4" id="div_antigüedad" style="display: none;">
                  <strong>Antigüedad</strong>
                  <input type="text" class="form-control" id="antigüedad" name="antigüedad"
                    value="<?php echo $antigüedad ?>">
                </div>

                <div class="col-md-4" id="div_tipo_contratacion" style="display: none;">
                  <strong>Tipo de Contratación</strong>
                  <select name="tipo_contratacion" id="tipo_contratacion" class="control form-control">
                    <option value="" <?php if ($tipo_contratacion == '')
                      echo 'selected'; ?>>Selecciones</option>
                    <option value="Base" <?php if ($tipo_contratacion == 'Base')
                      echo 'selected'; ?>>Base</option>
                    <option value="Eventual" <?php if ($tipo_contratacion == 'Eventual')
                      echo 'selected'; ?>>Eventual
                    </option>
                    <option value="Otro" <?php if ($tipo_contratacion == 'Otro')
                      echo 'selected'; ?>>Otro</option>
                  </select>
                </div>

                <div class="col-md-4" id="div_otro_contratacion" style="display: none;">
                  <strong>Otro (Contratación)</strong>
                  <input type="text" class="form-control" id="otro_contratacion" name="otro_contratacion"
                    value="<?php echo $otro_contratacion ?>">
                </div>

                <div class="col-md-4" id="div_dependencia" style="display: none;">
                  <strong>Dependencia</strong>
                  <select name="dependencia" id="dependencia" class="control form-control">
                    <option value="" <?php if ($dependencia == '')
                      echo 'selected'; ?>>Selecciones</option>
                    <option value="IMSS" <?php if ($dependencia == 'IMSS')
                      echo 'selected'; ?>>IMSS</option>
                    <option value="ISSSTE" <?php if ($dependencia == 'ISSSTE')
                      echo 'selected'; ?>>ISSSTE</option>
                    <option value="PEMEX" <?php if ($dependencia == 'PEMEX')
                      echo 'selected'; ?>>PEMEX</option>
                    <option value="ISEM" <?php if ($dependencia == 'ISEM')
                      echo 'selected'; ?>>ISEM</option>
                    <option value="ISEMYM" <?php if ($dependencia == 'ISEMYM')
                      echo 'selected'; ?>>ISEMYM</option>
                    <option value="SSA" <?php if ($dependencia == 'SSA')
                      echo 'selected'; ?>>SSA</option>
                    <option value="IMSS BIENESTAR" <?php if ($dependencia == 'IMSS BIENESTAR')
                      echo 'selected'; ?>>IMSS
                      BIENESTAR</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Servicios de rotación los últimos 5 años</strong>
                  <input type="text" class="form-control" id="rotaciones" name="rotaciones"
                    value="<?php echo $rotaciones ?>">
                </div>

                <div class="col-md-4">
                  <strong>Foto</strong>
                  <input type="file" accept=".jpg, .jpeg, .png" class="form-control-file" id="foto" name="foto">
                </div>


                <div class="col-md-4">
                  <strong>Previsualización de la Foto</strong>
                  <img id="imagenPrevisualizacion" src="<?php echo './' . trim($foto); ?>"
                    alt="Previsualización de la Foto" style="max-width: 70%; max-height: 200px;">
                </div>

                <script>
                  document.getElementById('foto').addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                      const reader = new FileReader();
                      reader.onload = function (e) {
                        document.getElementById('imagenPrevisualizacion').src = e.target.result;
                      };
                      reader.readAsDataURL(file);
                    }
                  });
                </script>


              </div><br>


              <div class="titulo-personal">
                <h6 class="bi bi-mortarboard-fill"> Información Académica</h6>
              </div> <br>

              <div class="row">

                <div class="col-md-8">
                  <strong>Técnico</strong>
                  <input type="text" class="form-control" id="grado_tecnico" name="grado_tecnico"
                    value="<?php echo $grado_tecnico ?>">
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_tecnico" name="cedula_tecnico"
                    value="<?php echo $cedula_tecnico ?>">
                </div>

                <div class="col-md-8">
                  <strong>Post-Técnico</strong>
                  <input type="text" class="form-control" id="grado_posttecnico" name="grado_posttecnico"
                    value="<?php echo $grado_posttecnico ?>">
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_posttecnico" name="cedula_posttecnico"
                    value="<?php echo $cedula_posttecnico ?>">
                </div>

                <div class="col-md-8">
                  <strong>Licenciatura</strong>
                  <input type="text" class="form-control" id="grado_licenciatura" name="grado_licenciatura"
                    value="<?php echo $grado_licenciatura ?>">
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_lic" name="cedula_lic"
                    value="<?php echo $cedula_lic ?>">
                </div>

                <div class="col-md-8">
                  <strong>Especialidad</strong>
                  <select class="form-control" id="grado_especialidad" name="grado_especialidad">
                    <option value="" <?php if ($grado_especialidad == '')
                      echo 'selected'; ?>>Seleccione...</option>
                    <option value="Administración" <?php if ($grado_especialidad == 'Administración')
                      echo 'selected'; ?>>
                      Administración</option>
                    <option value="Quirúrgica" <?php if ($grado_especialidad == 'Quirúrgica')
                      echo 'selected'; ?>>
                      Quirúrgica</option>
                    <option value="Heridas y Estomas" <?php if ($grado_especialidad == 'Heridas y Estomas')
                      echo 'selected'; ?>>Heridas y Estomas</option>
                    <option value="Tanatología" <?php if ($grado_especialidad == 'Tanatología')
                      echo 'selected'; ?>>
                      Tanatología</option>
                    <option value="Terapia Intravenosa" <?php if ($grado_especialidad == 'Terapia Intravenosa')
                      echo 'selected'; ?>>Terapia Intravenosa</option>
                    <option value="Educación" <?php if ($grado_especialidad == 'Educación')
                      echo 'selected'; ?>>Educación
                    </option>
                    <option value="Enfermería" <?php if ($grado_especialidad == 'Enfermería')
                      echo 'selected'; ?>>
                      Enfermería</option>
                    <option value="Intensivista" <?php if ($grado_especialidad == 'Intensivista')
                      echo 'selected'; ?>>
                      Intensivista</option>
                    <option value="Pediatría" <?php if ($grado_especialidad == 'Pediatría')
                      echo 'selected'; ?>>Pediatría
                    </option>
                    <option value="Neonatos" <?php if ($grado_especialidad == 'Neonatos')
                      echo 'selected'; ?>>Neonatos
                    </option>
                    <option value="Cardiología" <?php if ($grado_especialidad == 'Cardiología')
                      echo 'selected'; ?>>
                      Cardiología</option>
                    <option value="Materno Infantil" <?php if ($grado_especialidad == 'Materno Infantil')
                      echo 'selected'; ?>>Materno Infantil</option>
                    <option value="Atención el hogar" <?php if ($grado_especialidad == 'Atención el hogar')
                      echo 'selected'; ?>>Atención el hogar</option>
                    <option value="Perinatal" <?php if ($grado_especialidad == 'Perinatal')
                      echo 'selected'; ?>>Perinatal
                    </option>
                    <option value="Oncología" <?php if ($grado_especialidad == 'Oncología')
                      echo 'selected'; ?>>Oncología
                    </option>
                    <option value="Rehabilitación" <?php if ($grado_especialidad == 'Rehabilitación')
                      echo 'selected'; ?>>
                      Rehabilitación</option>
                    <option value="Geriatría" <?php if ($grado_especialidad == 'Geriatría')
                      echo 'selected'; ?>>Geriatría
                    </option>
                    <option value="Heridas" <?php if ($grado_especialidad == 'Heridas')
                      echo 'selected'; ?>>Heridas
                    </option>
                    <option value="Nefrología" <?php if ($grado_especialidad == 'Nefrología')
                      echo 'selected'; ?>>
                      Nefrología</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_especialidad" name="cedula_especialidad"
                    value="<?php echo $cedula_especialidad ?>">
                </div>

                <div class="col-md-8">
                  <strong>Maestría</strong>
                  <input type="text" class="form-control" id="grado_maestria" name="grado_maestria"
                    value="<?php echo $grado_maestria ?>">
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_maestria" name="cedula_maestria"
                    value="<?php echo $cedula_maestria ?>">
                </div>

                <div class="col-md-8">
                  <strong>Doctorado</strong>
                  <select class="form-control" id="grado_doctorado" name="grado_doctorado">
                    <option value="" <?php if ($grado_doctorado == '')
                      echo 'selected'; ?>>Seleccione...</option>
                    <option value="Educación" <?php if ($grado_doctorado == 'Educación')
                      echo 'selected'; ?>>Educación
                    </option>
                    <option value="Administración" <?php if ($grado_doctorado == 'Administración')
                      echo 'selected'; ?>>
                      Administración</option>
                    <option value="Investigación" <?php if ($grado_doctorado == 'Investigación')
                      echo 'selected'; ?>>
                      Investigación</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Cédula</strong>
                  <input type="number" class="form-control" id="cedula_doctorado" name="cedula_doctorado"
                    value="<?php echo $cedula_doctorado ?>">
                </div>

                <!-- Sección de Colegiación -->
                <div class="col-md-3">
                  <strong>Colegiación</strong>
                  <select class="form-control" name="colegiacion" id="colegiacion" required
                    onchange="habilitarCampos('colegiacion')">
                    <option value="" <?php if ($colegiacion == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($colegiacion == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($colegiacion == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_colegiacion">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_colegiacion"
                    name="fechaExpedicion_colegiacion" onchange="calcularFechaVigencia('colegiacion')"
                    value="<?php echo $fechaExpedicion_colegiacion ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_colegiacion">
                  <strong>Vigencia Colegiación</strong>
                  <input type="date" class="form-control" id="fechaVigencia_colegiacion"
                    name="fechaVigencia_colegiacion" readonly value="<?php echo $fechaVigencia_colegiacion ?>">
                </div>

                <div class="col-md-3" id="divEstatus_colegiacion">
                  <strong>Estatus Colegiación</strong>
                  <input type="text" class="form-control" id="estatus_colegiacion" name="estatus_colegiacion" readonly
                    value="<?php echo $estatus_colegiacion ?>">
                </div>


                <!-- Sección de Certificación -->

                <div class="col-md-3">
                  <strong>Certificación</strong>
                  <select class="form-control" name="certificacion" id="certificacion" required
                    onchange="habilitarCampos('certificacion')">
                    <option value="" <?php if ($certificacion == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($certificacion == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($certificacion == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_certificacion">
                  <strong>Fecha Certificación</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_certificacion"
                    name="fechaExpedicion_certificacion" onchange="calcularFechaVigencia('certificacion')"
                    value="<?php echo $fechaExpedicion_certificacion ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_certificacion">
                  <strong>Vigencia Certificación</strong>
                  <input type="date" class="form-control" id="fechaVigencia_certificacion"
                    name="fechaVigencia_certificacion" readonly value="<?php echo $fechaVigencia_certificacion ?>">
                </div>

                <div class="col-md-3" id="divEstatus_certificacion">
                  <strong>Estatus Certificación</strong>
                  <input type="text" class="form-control" id="estatus_certificacion" name="estatus_certificacion"
                    readonly value="<?php echo $estatus_certificacion ?>">
                </div>

                <div class="col-md-12">
                  <strong>Competencias profesionales</strong>
                  <input type="text" class="form-control" id="competencias_profesionales"
                    name="competencias_profesionales" value="<?php echo $competencias_profesionales ?>">
                </div>

                <div class="col-md-12">
                  <strong>Observaciones</strong>
                  <input type="text" class="form-control" id="observaciones" name="observaciones"
                    value="<?php echo $observaciones ?>">
                </div>

              </div> <br>
              <div class="titulo-personal">
                <h6 class="bi bi-mortarboard-fill"> Cursos Obligatorios</h6>
              </div> <br>
              <div class="row">

                <div class="col-md-3">
                  <strong>BLS</strong>
                  <select class="form-control" name="BLS" id="BLS" onchange="toggleFields('BLS')">
                    <option value="" <?php if ($BLS == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($BLS == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($BLS == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_BLS" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_BLS" name="fechaExpedicion_BLS"
                    onchange="calcularFechaVigencia('BLS')" value="<?php echo $fechaExpedicion_BLS ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_BLS" style="display: none;">
                  <strong>Fecha Vigencia</strong>
                  <input type="date" class="form-control" id="fechaVigencia_BLS" name="fechaVigencia_BLS" readonly
                    value="<?php echo $fechaVigencia_BLS ?>">
                </div>

                <div class="col-md-3" id="divEstatus_BLS" style="display: none;">
                  <strong>Estatus BLS</strong>
                  <input type="text" class="form-control" id="estatus_BLS" name="estatus_BLS" readonly
                    value="<?php echo $estatus_BLS ?>">
                </div>


                <div class="col-md-3">
                  <strong>ACLS</strong>
                  <select class="form-control" name="ACLS" id="ACLS" onchange="toggleFields('ACLS')">
                    <option value="" <?php if ($ACLS == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($ACLS == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($ACLS == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_ACLS" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_ACLS" name="fechaExpedicion_ACLS"
                    onchange="calcularFechaVigencia('ACLS')" value="<?php echo $fechaExpedicion_ACLS ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_ACLS" style="display: none;">
                  <strong>Fecha Vigencia</strong>
                  <input type="date" class="form-control" id="fechaVigencia_ACLS" name="fechaVigencia_ACLS" readonly
                    value="<?php echo $fechaVigencia_ACLS ?>">
                </div>

                <div class="col-md-3" id="divEstatus_ACLS" style="display: none;">
                  <strong>Estatus ACLS</strong>
                  <input type="text" class="form-control" id="estatus_ACLS" name="estatus_ACLS" readonly
                    value="<?php echo $estatus_ACLS ?>">
                </div>



                <div class="col-md-3">
                  <strong>ReNeo</strong>
                  <select class="form-control" name="ReNeo" id="ReNeo" onchange="toggleFields('ReNeo')">
                    <option value="" <?php if ($ReNeo == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($ReNeo == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($ReNeo == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_ReNeo" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_ReNeo" name="fechaExpedicion_ReNeo"
                    onchange="calcularFechaVigencia('ReNeo')" value="<?php echo $fechaExpedicion_ReNeo ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_ReNeo" style="display: none;">
                  <strong>Fecha Vigencia</strong>
                  <input type="date" class="form-control" id="fechaVigencia_ReNeo" name="fechaVigencia_ReNeo" readonly
                    value="<?php echo $fechaVigencia_ReNeo ?>">
                </div>

                <div class="col-md-3" id="divEstatus_ReNeo" style="display: none;">
                  <strong>Estatus ReNeo</strong>
                  <input type="text" class="form-control" id="estatus_ReNeo" name="estatus_ReNeo" readonly
                    value="<?php echo $estatus_ReNeo ?>">
                </div>





                <div class="col-md-3">
                  <strong>PALS</strong>
                  <select class="form-control" name="PALS" id="PALS" onchange="toggleFields('PALS')">
                    <option value="" <?php if ($PALS == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($PALS == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($PALS == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_PALS" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_PALS" name="fechaExpedicion_PALS"
                    onchange="calcularFechaVigencia('PALS')" value="<?php echo $fechaExpedicion_PALS ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_PALS" style="display: none;">
                  <strong>Fecha Vigencia</strong>
                  <input type="date" class="form-control" id="fechaVigencia_PALS" name="fechaVigencia_PALS" readonly
                    value="<?php echo $fechaVigencia_PALS ?>">
                </div>

                <div class="col-md-3" id="divEstatus_PALS" style="display: none;">
                  <strong>Estatus PALS</strong>
                  <input type="text" class="form-control" id="estatus_PALS" name="estatus_PALS" readonly
                    value="<?php echo $estatus_PALS ?>">
                </div>





                <div class="col-md-3">
                  <strong>ALSO</strong>
                  <select class="form-control" name="ALSO" id="ALSO" onchange="toggleFields('ALSO')">
                    <option value="" <?php if ($ALSO == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($ALSO == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($ALSO == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_ALSO" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_ALSO" name="fechaExpedicion_ALSO"
                    onchange="calcularFechaVigencia('ALSO')" value="<?php echo $fechaExpedicion_ALSO ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_ALSO" style="display: none;">
                  <strong>Fecha Vigencia</strong>
                  <input type="date" class="form-control" id="fechaVigencia_ALSO" name="fechaVigencia_ALSO" readonly
                    value="<?php echo $fechaVigencia_ALSO ?>">
                </div>

                <div class="col-md-3" id="divEstatus_ALSO" style="display: none;">
                  <strong>Estatus ALSO</strong>
                  <input type="text" class="form-control" id="estatus_ALSO" name="estatus_ALSO" readonly
                    value="<?php echo $estatus_ALSO ?>">
                </div>

                <div class="col-md-3">
                  <strong>POE</strong>
                  <select class="form-control" name="POE" id="POE" onchange="toggleFields('POE')">
                    <option value="" <?php if ($POE == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($POE == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($POE == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_POE" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_POE" name="fechaExpedicion_POE"
                    onchange="calcularFechaVigencia('POE')" value="<?php echo $fechaExpedicion_POE ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_POE" style="display: none;">
                  <strong>Fecha Vigencia</strong>
                  <input type="date" class="form-control" id="fechaVigencia_POE" name="fechaVigencia_POE"
                    value="<?php echo $fechaVigencia_POE ?>">
                </div>

                <div class="col-md-3" id="divEstatus_POE" style="display: none;">
                  <strong>Estatus POE</strong>
                  <input type="text" class="form-control" id="estatus_POE" name="estatus_POE" readonly
                    value="<?php echo $estatus_POE ?>">
                </div>

                <div class="col-md-3">
                  <strong>CBSPD</strong>
                  <select class="form-control" name="CBSPD" id="CBSPD" onchange="toggleFields('CBSPD')">
                    <option value="" <?php if ($CBSPD == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($CBSPD == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($CBSPD == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_CBSPD" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_CBSPD" name="fechaExpedicion_CBSPD"
                    onchange="calcularFechaVigencia('CBSPD')" value="<?php echo $fechaExpedicion_CBSPD ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_CBSPD" style="display: none;">
                  <strong>Fecha Vigencia</strong>
                  <input type="date" class="form-control" id="fechaVigencia_CBSPD" name="fechaVigencia_CBSPD"
                    value="<?php echo $fechaVigencia_CBSPD ?>">
                </div>

                <div class="col-md-3" id="divEstatus_CBSPD" style="display: none;">
                  <strong>Estatus CBSPD</strong>
                  <input type="text" class="form-control" id="estatus_CBSPD" name="estatus_CBSPD" readonly
                    value="<?php echo $estatus_CBSPD ?>">
                </div>

                <div class="col-md-3">
                  <strong>Certificación</strong>
                  <select class="form-control" name="Certificación" id="Certificación"
                    onchange="toggleFields('Certificación')">
                    <option value="" <?php if ($Certificación == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($Certificación == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($Certificación == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_Certificación" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_Certificación"
                    name="fechaExpedicion_Certificación" onchange="calcularFechaVigencia('Certificación')"
                    value="<?php echo $fechaExpedicion_Certificación ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_Certificación" style="display: none;">
                  <strong>Fecha Vigencia</strong>
                  <input type="date" class="form-control" id="fechaVigencia_Certificación"
                    name="fechaVigencia_Certificación" value="<?php echo $fechaVigencia_Certificación ?>">
                </div>

                <div class="col-md-3" id="divEstatus_Certificación" style="display: none;">
                  <strong>Estatus Certificación</strong>
                  <input type="text" class="form-control" id="estatus_Certificación" name="estatus_Certificación"
                    readonly value="<?php echo $estatus_Certificación ?>">
                </div>

                <div class="col-md-3">
                  <strong>Certificación PICC</strong>
                  <select class="form-control" name="CertificaciónPICC" id="CertificaciónPICC"
                    onchange="toggleFields('CertificaciónPICC')">
                    <option value="" <?php if ($CertificaciónPICC == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($CertificaciónPICC == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($CertificaciónPICC == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-3" id="divFechaExpedicion_CertificaciónPICC" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_CertificaciónPICC"
                    name="fechaExpedicion_CertificaciónPICC" onchange="calcularFechaVigencia('CertificaciónPICC')"
                    value="<?php echo $fechaExpedicion_CertificaciónPICC ?>">
                </div>

                <div class="col-md-3" id="divFechaVigencia_CertificaciónPICC" style="display: none;">
                  <strong>Fecha Vigencia</strong>
                  <input type="date" class="form-control" id="fechaVigencia_CertificaciónPICC"
                    name="fechaVigencia_CertificaciónPICC" value="<?php echo $fechaVigencia_CertificaciónPICC ?>">
                </div>

                <div class="col-md-3" id="divEstatus_CertificaciónPICC" style="display: none;">
                  <strong>Estatus Certificación</strong>
                  <input type="text" class="form-control" id="estatus_CertificaciónPICC"
                    name="estatus_CertificaciónPICC" readonly value="<?php echo $estatus_CertificaciónPICC ?>">
                </div>

              </div> <br>

              <div class="titulo-personal">
                <h6 class="bi bi-mortarboard-fill"> Capacitación HRAEI </h6>
              </div> <br>

              <div class="row">

                <div class="col-md-6">
                  <strong>Interculturalidad</strong>
                  <select class="form-control" name="interculturalidad" id="interculturalidad"
                    onchange="toggleFechaExpedicion('interculturalidad')">
                    <option value="" <?php if ($interculturalidad == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($interculturalidad == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($interculturalidad == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_interculturalidad" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_interculturalidad"
                    name="fechaExpedicion_interculturalidad" value="<?php echo $fechaExpedicion_interculturalidad ?>">
                </div>

                <div class="col-md-6">
                  <strong>Capacitación Virtual de Higiene de Manos</strong>
                  <select class="form-control" name="higienemanos" id="higienemanos"
                    onchange="toggleFechaExpedicion('higienemanos')">
                    <option value="" <?php if ($higienemanos == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($higienemanos == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($higienemanos == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_higienemanos" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_higienemanos"
                    name="fechaExpedicion_higienemanos" value="<?php echo $fechaExpedicion_higienemanos ?>">
                </div>

                <div class="col-md-6">
                  <strong>Capacitación Virtual Manejo de Residuos Hospitalarios</strong>
                  <select class="form-control" name="residuoshospitalarios" id="residuoshospitalarios"
                    onchange="toggleFechaExpedicion('residuoshospitalarios')">
                    <option value="" <?php if ($residuoshospitalarios == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($residuoshospitalarios == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($residuoshospitalarios == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_residuoshospitalarios" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_residuoshospitalarios"
                    name="fechaExpedicion_residuoshospitalarios"
                    value="<?php echo $fechaExpedicion_residuoshospitalarios ?>">
                </div>

                <div class="col-md-6">
                  <strong>Acciones Esenciales de Seguridad del Paciente</strong>
                  <select class="form-control" name="seguridadpaciente" id="seguridadpaciente"
                    onchange="toggleFechaExpedicion('seguridadpaciente')">
                    <option value="" <?php if ($seguridadpaciente == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($seguridadpaciente == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($seguridadpaciente == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_seguridadpaciente" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_seguridadpaciente"
                    name="fechaExpedicion_seguridadpaciente" value="<?php echo $fechaExpedicion_seguridadpaciente ?>">
                </div>

                <div class="col-md-6">
                  <strong>Curso Virtual Sobre los Fundamentos del Cuidado Paliativo</strong>
                  <select class="form-control" name="cuidadopaliativo" id="cuidadopaliativo"
                    onchange="toggleFechaExpedicion('cuidadopaliativo')">
                    <option value="" <?php if ($cuidadopaliativo == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($cuidadopaliativo == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($cuidadopaliativo == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_cuidadopaliativo" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_cuidadopaliativo"
                    name="fechaExpedicion_cuidadopaliativo" value="<?php echo $fechaExpedicion_cuidadopaliativo ?>">
                </div>

                <div class="col-md-6">
                  <strong>Curso Básico de Combate de Incendios</strong>
                  <select class="form-control" name="combateincendios" id="combateincendios"
                    onchange="toggleFechaExpedicion('combateincendios')">
                    <option value="" <?php if ($combateincendios == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($combateincendios == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($combateincendios == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_combateincendios" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_combateincendios"
                    name="fechaExpedicion_combateincendios" value="<?php echo $fechaExpedicion_combateincendios ?>">
                </div>

                <div class="col-md-6">
                  <strong>Introducción al Modelo Único de Evaluación de la Calidad</strong>
                  <select class="form-control" name="evaluacioncalidad" id="evaluacioncalidad"
                    onchange="toggleFechaExpedicion('evaluacioncalidad')">
                    <option value="" <?php if ($evaluacioncalidad == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($evaluacioncalidad == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($evaluacioncalidad == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_evaluacioncalidad" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_evaluacioncalidad"
                    name="fechaExpedicion_evaluacioncalidad" value="<?php echo $fechaExpedicion_evaluacioncalidad ?>">
                </div>

                <div class="col-md-6">
                  <strong>Trato Digno en los Servicios de Salud</strong>
                  <select class="form-control" name="tratodigno" id="tratodigno"
                    onchange="toggleFechaExpedicion('tratodigno')">
                    <option value="" <?php if ($tratodigno == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($tratodigno == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($tratodigno == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_tratodigno" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_tratodigno"
                    name="fechaExpedicion_tratodigno" value="<?php echo $fechaExpedicion_tratodigno ?>">
                </div>

                <div class="col-md-6">
                  <strong>Reanimación Cardiopulmonar en Adulto para Profesionales de la Salud</strong>
                  <select class="form-control" name="reanimacion" id="reanimacion"
                    onchange="toggleFechaExpedicion('reanimacion')">
                    <option value="" <?php if ($reanimacion == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($reanimacion == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($reanimacion == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_reanimacion" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_reanimacion"
                    name="fechaExpedicion_reanimacion" value="<?php echo $fechaExpedicion_reanimacion ?>">
                </div>

                <div class="col-md-6">
                  <strong>Salud Mental en Profesionales de la Salud</strong>
                  <select class="form-control" name="saludmental" id="saludmental"
                    onchange="toggleFechaExpedicion('saludmental')">
                    <option value="" <?php if ($saludmental == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($saludmental == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($saludmental == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_saludmental" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_saludmental"
                    name="fechaExpedicion_saludmental" value="<?php echo $fechaExpedicion_saludmental ?>">
                </div>

                <div class="col-md-6">
                  <strong style="font-size:13px;">Capacitación de Códigos y Protocolos Hospitalarios de Emergencias y
                    Desastres</strong>
                  <select class="form-control" name="emergenciasydesastres" id="emergenciasydesastres"
                    onchange="toggleFechaExpedicion('emergenciasydesastres')">
                    <option value="" <?php if ($emergenciasydesastres == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($emergenciasydesastres == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($emergenciasydesastres == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>
                <div class="col-md-6" id="divFechaExpedicion_emergenciasydesastres" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_emergenciasydesastres"
                    name="fechaExpedicion_emergenciasydesastres"
                    value="<?php echo $fechaExpedicion_emergenciasydesastres ?>">
                </div>

                <div class="col-md-6">
                  <strong style="font-size:13px;">Medidas Basadas en la Transmisión de Agentes Infecciosos y Procesos de
                    Limpieza</strong>
                  <select class="form-control" name="procesoslimpieza" id="procesoslimpieza"
                    onchange="toggleFechaExpedicion('procesoslimpieza')">
                    <option value="" <?php if ($procesoslimpieza == '')
                      echo 'selected'; ?>>Seleccione</option>
                    <option value="Si" <?php if ($procesoslimpieza == 'Si')
                      echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($procesoslimpieza == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_procesoslimpieza" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_procesoslimpieza"
                    name="fechaExpedicion_procesoslimpieza" value="<?php echo $fechaExpedicion_procesoslimpieza ?>">
                </div>
              </div> <br>
              <br>
              <div class="text-right"> <!-- Agregamos la clase text-right para alinear el contenido a la derecha -->
                <button type="hidden" class="btn btn-danger btn-sm" id="limpiarFormularioBtn">Limpiar</button>
                <button type="submit" class="btn btn-success btn-sm">Guardar Cambios</button>
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

  <script type="module">
    import { editForm } from "./js/update.js";
    editForm();
  </script>


</body>

</html>