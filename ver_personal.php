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
require ('php/controllers/ver_personal.controller.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver detalles</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="css/styles.css" rel="stylesheet" type="text/css">
  <link href="css/style_logout_admin.css" rel="stylesheet" type="text/css">
  <link href="css/style_logout_general.css" rel="stylesheet" type="text/css">
</head>

<body>

  <?php if ($username == 'admin'): ?>
    <?php include 'components/navbar.php'; ?>
  <?php else: ?>
    <?php include 'components/navbar_general.php'; ?>
  <?php endif; ?>

    <div class="container mt-5">
      <div class="row">
          <div class="col-sm-12">
              <div class="enfermero-container d-flex align-items-center">
                  <div class="foto-enfermero mr-3">
                      <img src="<?php echo $foto; ?>" alt="Foto del Enfermero" class="img-fluid">
                  </div>

                  <div class="nombre-enfermero">
                      <h4><?php echo $apellidoPaterno . ' ' . $apellidoMaterno . ' ' . $nombre ?></h4>
                          
                      <table class="tabla-datos">

                          <tr>
                              <td>CURP</td>
                              <th><?php echo $curp ?></th>
                          </tr>

                          <tr>
                              <td>Género</td>
                              <th><?php echo $genero ?></th>
                          </tr>

                          <tr>
                              <td>Onomástico</td>
                              <th><?php echo $onomastico ?></th>
                          </tr>

                          <tr>
                              <td>Edad</td>
                              <th><?php echo $edad ?></th>
                          </tr>

                          <tr>
                              <td>Domicilio</td>
                              <th><?php echo $domicilio ?></th>
                          </tr>

                          <tr>
                              <td>Correo personal</td>
                              <th><?php echo $email ?></th>
                          </tr>

                          <tr>
                              <td>Teléfono personal</td>
                              <th><?php echo $telefono_personal ?></th>
                          </tr>

                          <tr>
                              <td>RFC</td>
                              <th><?php echo $RFC ?></th>
                          </tr>
                      </table>

                  </div>
              </div>
          </div>
      </div>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="datos-container d-flex align-items-center">
                
                    <table class="tabla-datos">
                        <tr>
                            <th>CONTACTO EMERGENCIA</th>
                        </tr>

                        <tr>
                            <td>Contacto Emergencia</td>
                            <th><?php echo $contacto_emergencia ?></th>
                        </tr>

                        <tr>
                            <td>Nombre Contacto</td>
                            <th><?php echo $contacto ?></th>
                        </tr>

                        <tr>
                            <td>Teléfono Emergencia</td>
                            <th><?php echo $no_contacto_emergencia ?></th>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="datos-container d-flex align-items-center">
                    
                    <table class="tabla-datos">
                        <tr>
                            <th>INFORMACIÓN CONTRATO</th>
                        </tr>

                        <tr>
                            <td>No. Empleado</td>
                            <th><?php echo $noempleado ?></th>
                        </tr>
                        
                        <tr>
                            <td>Tipo de Contrato</td>
                            <th><?php echo $tipocontrato ?></th>
                        </tr>

                        <tr>
                            <td>Fecha de basificación</td>
                            <th><?php echo $fechaBasificacion ?></th>
                        </tr>

                        <tr>
                            <td>Código</td>
                            <th><?php echo $codigo ?></th>
                        </tr>

                        <tr>
                            <td>Puesto</td>
                            <th><?php echo $puesto ?></th>
                        </tr>

                        <tr>
                            <td>Turno actual</td>
                            <th><?php echo $turno ?></th>
                        </tr>
                        
                        <tr>
                            <td>Días Laborales</td>
                            <th><?php echo $diasLaborales ?></th>
                        </tr>

                        <tr>
                            <td>Servicio</td>
                            <th><?php echo $servicio ?></th>
                        </tr>

                        <tr>
                            <td>Horario</td>
                            <th><?php echo $horario_de ?> - <?php echo $horario_a ?></th>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="datos-container d-flex align-items-center">
                    <table class="tabla-datos">
                        <tr>
                            <th>INFORMACIÓN ACADÉMICA</th>
                        </tr>

                        <tr>
                            <td>Técnico</td>
                            <th><?php echo $grado_tecnico ?></th>
                            <th> - </th>
                            <th><?php echo $cedula_tecnico ?></th>
                        </tr>

                        <tr>
                            <td>Post-técnico</td>
                            <th><?php echo $grado_posttecnico ?></th>
                            <th> - </th>
                            <th><?php echo $cedula_posttecnico ?></th>
                        </tr>

                        <tr>
                            <td>Licenciatura</td>
                            <th><?php echo $grado_licenciatura ?></th>
                            <th> - </th>
                            <th><?php echo $cedula_lic ?></th>
                        </tr>

                        <tr>
                            <td>Especialidad</td>
                            <th><?php echo $grado_especialidad ?></th>
                            <th> - </th>
                            <th><?php echo $cedula_especialidad ?></th>
                        </tr>

                        <tr>
                            <td>Maestría</td>
                            <th><?php echo $grado_maestria ?></th>
                            <th> - </th>
                            <th><?php echo $cedula_maestria ?></th>
                        </tr>

                        <tr>
                            <td>Doctorado</td>
                            <th><?php echo $grado_doctorado ?></th>
                            <th> - </th>
                            <th><?php echo $cedula_doctorado ?></th>
                        </tr>

                        <tr>
                            <td>Colegiación</td>
                            <th><?php echo $colegiacion ?></th>
                            <th> Expedición: </th>
                            <th><?php echo $fechaExpedicion_colegiacion ?></th>
                            <th> Vigencia: </th>
                            <th><?php echo $fechaVigencia_colegiacion ?></th>
                            <th> Estatus: </th>
                            <th><?php echo $estatus_colegiacion ?></th>
                        </tr>

                        <tr>
                            <td>Cerificación</td>
                            <th><?php echo $certificacion ?></th>
                            <th> Expedición: </th>
                            <th><?php echo $fechaExpedicion_certificacion ?></th>
                            <th> Vigencia: </th>
                            <th><?php echo $fechaVigencia_certificacion ?></th>
                            <th> Estatus: </th>
                            <th><?php echo $estatus_certificacion ?></th>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="datos-container d-flex align-items-center">
                    <table class="tabla-datos">
                        <thead>
                        <tr>
                            <th scope="col">CURSO</th>
                            <th scope="col">Fecha Expedición</th>
                            <th scope="col">Fecha Vigencia</th>
                            <th scope="col">Estatus</th>
                        </tr>
                        </thead>
                    
                        <tbody>
                            <tr>
                                <td scope="row">BLS</td>
                                <td><?php echo $fechaExpedicion_BLS ?></td>
                                <td><?php echo $fechaVigencia_BLS ?></td>
                                <td><?php echo $estatus_BLS ?></td>
                            </tr>

                            <tr>
                                <td scope="row">ACLS</td>
                                <td><?php echo $fechaExpedicion_ACLS ?></td>
                                <td><?php echo $fechaVigencia_ACLS ?></td>
                                <td><?php echo $estatus_ACLS ?></td>
                            </tr>
                            
                            <tr>
                                <td scope="row">ReNeo</td>
                                <td><?php echo $fechaExpedicion_ReNeo ?></td>
                                <td><?php echo $fechaVigencia_ReNeo ?></td>
                                <td><?php echo $estatus_ReNeo ?></td>
                            </tr>

                            <tr>
                                <td scope="row">PALS</td>
                                <td><?php echo $fechaExpedicion_PALS ?></td>
                                <td><?php echo $fechaVigencia_PALS ?></td>
                                <td><?php echo $estatus_PALS ?></td>
                            </tr>

                            <tr>
                                <td scope="row">ALSO</td>
                                <td><?php echo $fechaExpedicion_ALSO ?></td>
                                <td><?php echo $fechaVigencia_ALSO ?></td>
                                <td><?php echo $estatus_ALSO ?></td>
                            </tr>

                            <tr>
                                <td scope="row">POE</td>
                                <td><?php echo $fechaExpedicion_POE ?></td>
                                <td><?php echo $fechaVigencia_POE ?></td>
                                <td><?php echo $estatus_POE ?></td>
                            </tr>

                            <tr>
                                <td scope="row">CBSPD</td>
                                <td><?php echo $fechaExpedicion_CBSPD ?></td>
                                <td><?php echo $fechaVigencia_CBSPD ?></td>
                                <td><?php echo $estatus_CBSPD ?></td>
                            </tr>

                            <tr>
                                <td scope="row">Certificación</td>
                                <td><?php echo $fechaExpedicion_Certificación ?></td>
                                <td><?php echo $fechaVigencia_Certificación ?></td>
                                <td><?php echo $estatus_Certificación ?></td>
                            </tr>
                            <tr>
                                <td scope="row">Certificación PICC</td>
                                <td><?php echo $fechaExpedicion_CertificaciónPICC ?></td>
                                <td><?php echo $fechaVigencia_CertificaciónPICC ?></td>
                                <td><?php echo $estatus_CertificaciónPICC ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="datos-container d-flex align-items-center">

                    <table class="tabla-datos">

                        <thead>
                            <tr>
                                <th scope="col">Nombre del Curso</th>
                                <th scope="col">¿Realizó?</th>
                                <th scope="col">Fecha Expedición</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td scope="row">Interculturalidad</td>
                                <td><?php echo $interculturalidad ?></td>
                                <td><?php echo $fechaExpedicion_interculturalidad ?></td>
                            </tr>
                        
                            <tr>
                                <td scope="row">Capacitación Virtual de Higiene de Manos</td>
                                <td><?php echo $higienemanos ?></td>
                                <td><?php echo $fechaExpedicion_higienemanos ?></td>

                            </tr>

                            <tr>
                                <td scope="row">Capacitación Virtual Manejo de Residuos Hospitalarios</td>
                                <td><?php echo $residuoshospitalarios ?></td>
                                <td><?php echo $fechaExpedicion_residuoshospitalarios ?></td>
                            </tr>

                            <tr>
                                <td scope="row">Acciones Esenciales de Seguridad del Paciente</td>
                                <td><?php echo $seguridadpaciente ?></td>
                                <td><?php echo $fechaExpedicion_seguridadpaciente ?></td>
                            </tr>

                            <tr>
                                <td scope="row">Curso Virtual Sobre los Fundamentos del Cuidado Paliativo</td>
                                <td><?php echo $cuidadopaliativo ?></td>
                                <td><?php echo $fechaExpedicion_cuidadopaliativo ?></td>
                            </tr>

                            <tr>
                                <td scope="row">Curso Básico de Combate de Incendios</td>
                                <td><?php echo $combateincendios ?></td>
                                <td><?php echo $fechaExpedicion_combateincendios ?></td>
                            </tr>

                            <tr>
                                <td scope="row">Introducción al Modelo Único de Evaluación de la Calidad</td>
                                <td><?php echo $evaluacioncalidad ?></td>
                                <td><?php echo $fechaExpedicion_evaluacioncalidad ?></td>
                            </tr>

                            <tr>
                                <td scope="row">Trato Digno en los Servicios de Salud</td>
                                <td><?php echo $tratodigno ?></td>
                                <td><?php echo $fechaExpedicion_tratodigno ?></td>
                            </tr>

                            <tr>
                                <td scope="row">Reanimación Cardiopulmonar en Adulto para Profesionales de la Salud</td>
                                <td><?php echo $reanimacion ?></td>
                                <td><?php echo $fechaExpedicion_reanimacion ?></td>
                            </tr>

                            <tr>
                                <td scope="row">Salud Mental en Profesionales de la Salud</td>
                                <td><?php echo $saludmental ?></td>
                                <td><?php echo $fechaExpedicion_saludmental ?></td>
                            </tr>

                            <tr>
                                <td scope="row">Capacitación de Códigos y Protocolos Hospitalarios de Emergencias y Desastres</td>
                                <td><?php echo $emergenciasydesastres ?></td>
                                <td><?php echo $fechaExpedicion_emergenciasydesastres ?></td>
                            </tr>

                            <tr>
                                <td scope="row">Medidas Basadas en la Transmisión de Agentes Infecciosos y Procesos de Limpieza</td>
                                <td><?php echo $procesoslimpieza ?></td>
                                <td><?php echo $fechaExpedicion_procesoslimpieza ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  <br>
  <br>





  <script src="js/script_index.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>