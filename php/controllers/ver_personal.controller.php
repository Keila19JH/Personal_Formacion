<?php
require (__DIR__ . '/../models/database.model.php');
include (__DIR__ . '/../dbconfig.php');


$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_enfermero = $_GET['id'];


    $query = "SELECT dp.*,ia.*,
    ctr.noempleado,
    ctr.tipocontrato,
    ctr.fechaBasificacion,
    ctr.codigo,
    ctr.fechaIngreso,
    ctr.ayo_curso,
    ctr.foto,
    ctr.turno,
    ctr.horario_de,
    ctr.horario_a,
    ctr.dias_laborables,
    dl.*,co.*,cap.*,p.puesto,s.servicio
        FROM datos_personal dp
        JOIN informacion_academica ia ON dp.informacion_academica = ia.id
        JOIN contrato ctr ON dp.contrato = ctr.id_contrato
        JOIN capacitacion cap ON dp.capacitacion = cap.id_capacitacion
        JOIN cursos_obligatorios co ON dp.cursos_obligatorios = co.id_cursos_obligatorios
        JOIN dias_laborales dl ON ctr.dias_laborables = dl.id_dias_laborables
        JOIN puesto p ON ctr.puesto = p.id_puesto
        JOIN servicio s ON ctr.servicio = s.id_servicio
    WHERE dp.id_enfermero ='$id_enfermero'";

    $AllData = $connectionDB->getRows($query);


    if (!empty($AllData)) {
        foreach ($AllData as $data) {

            $id_enfermero = $data['id_enfermero'];
            $curp = $data['curp'];
            $apellidoPaterno = $data['apellidoPaterno'];
            $apellidoMaterno = $data['apellidoMaterno'];
            $nombre = $data['nombre'];
            $genero = $data['genero'];
            $onomastico = $data['onomastico'];
            $edad = $data['edad'];
            $domicilio = $data['domicilio'];
            $email = $data['email'];
            $telefono_personal = $data['telefono_personal'];
            $RFC = $data['RFC'];
            $contacto_emergencia = $data['contacto_emergencia'];
            $contacto = $data['contacto'];
            $no_contacto_emergencia = $data['no_contacto_emergencia'];
            $noempleado = $data['noempleado'];
            $tipocontrato = $data['tipocontrato'];
            $fechaBasificacion = $data['fechaBasificacion'];
            $codigo = $data['codigo'];
            $puesto = $data['puesto'];
            $fechaIngreso = $data['fechaIngreso'];
            $ayo_curso = $data['ayo_curso'];
            $turno = $data['turno'];
            $dias = [
                $data['lunes'],
                $data['martes'],
                $data['miercoles'],
                $data['jueves'],
                $data['viernes'],
                $data['sabado'],
                $data['domingo']
            ];
            $diasLaborales = implode(', ', array_filter($dias));
            $servicio = $data['servicio'];
            $horario_de = $data['horario_de'];
            $horario_a = $data['horario_a'];
            $foto = $data['foto'];
            $grado_tecnico = $data['grado_tecnico'];
            $cedula_tecnico = $data['cedula_tecnico'];
            $grado_posttecnico = $data['grado_posttecnico'];
            $cedula_posttecnico = $data['cedula_posttecnico'];
            $grado_licenciatura = $data['grado_licenciatura'];
            $cedula_lic = $data['cedula_lic'];
            $grado_especialidad = $data['grado_especialidad'];
            $cedula_especialidad = $data['cedula_especialidad'];
            $grado_maestria = $data['grado_maestria'];
            $cedula_maestria = $data['cedula_maestria'];
            $grado_doctorado = $data['grado_doctorado'];
            $cedula_doctorado = $data['cedula_doctorado'];
            $colegiacion = $data['colegiacion'];
            $fechaExpedicion_colegiacion = $data['fechaExpedicion_colegiacion'];
            $fechaVigencia_colegiacion = $data['fechaVigencia_colegiacion'];
            $estatus_colegiacion = $data['estatus_colegiacion'];
            $certificacion = $data['certificacion'];
            $fechaExpedicion_certificacion = $data['fechaExpedicion_certificacion'];
            $fechaVigencia_certificacion = $data['fechaVigencia_certificacion'];
            $estatus_certificacion = $data['estatus_certificacion'];
            $BLS = $data['BLS'];
            $fechaExpedicion_BLS = $data['fechaExpedicion_BLS'];
            $fechaVigencia_BLS = $data['fechaVigencia_BLS'];
            $estatus_BLS = $data['estatus_BLS'];
            $ACLS = $data['ACLS'];
            $fechaExpedicion_ACLS = $data['fechaExpedicion_ACLS'];
            $fechaVigencia_ACLS = $data['fechaVigencia_ACLS'];
            $estatus_ACLS = $data['estatus_ACLS'];
            $ReNeo = $data['ReNeo'];
            $fechaExpedicion_ReNeo = $data['fechaExpedicion_ReNeo'];
            $fechaVigencia_ReNeo = $data['fechaVigencia_ReNeo'];
            $estatus_ReNeo = $data['estatus_ReNeo'];
            $PALS = $data['PALS'];
            $fechaExpedicion_PALS = $data['fechaExpedicion_PALS'];
            $fechaVigencia_PALS = $data['fechaVigencia_PALS'];
            $estatus_PALS = $data['estatus_PALS'];
            $ALSO = $data['ALSO'];
            $fechaExpedicion_ALSO = $data['fechaExpedicion_ALSO'];
            $fechaVigencia_ALSO = $data['fechaVigencia_ALSO'];
            $estatus_ALSO = $data['estatus_ALSO'];
            $POE = $data['POE'];
            $fechaExpedicion_POE = $data['fechaExpedicion_POE'];
            $fechaVigencia_POE = $data['fechaVigencia_POE'];
            $estatus_POE = $data['estatus_POE'];
            $CBSPD = $data['CBSPD'];
            $fechaExpedicion_CBSPD = $data['fechaExpedicion_CBSPD'];
            $fechaVigencia_CBSPD = $data['fechaVigencia_CBSPD'];
            $estatus_CBSPD = $data['estatus_CBSPD'];
            $Certificación = $data['Certificación'];
            $fechaExpedicion_Certificación = $data['fechaExpedicion_Certificación'];
            $fechaVigencia_Certificación = $data['fechaVigencia_Certificación'];
            $estatus_Certificación = $data['estatus_Certificación'];
            $CertificaciónPICC = $data['CertificaciónPICC'];
            $fechaExpedicion_CertificaciónPICC = $data['fechaExpedicion_CertificaciónPICC'];
            $fechaVigencia_CertificaciónPICC = $data['fechaVigencia_CertificaciónPICC'];
            $estatus_CertificaciónPICC = $data['estatus_CertificaciónPICC'];
            $interculturalidad = $data['interculturalidad'];
            $fechaExpedicion_interculturalidad = $data['fechaExpedicion_interculturalidad'];
            $higienemanos = $data['higienemanos'];
            $fechaExpedicion_higienemanos = $data['fechaExpedicion_higienemanos'];
            $residuoshospitalarios = $data['residuoshospitalarios'];
            $fechaExpedicion_residuoshospitalarios = $data['fechaExpedicion_residuoshospitalarios'];
            $seguridadpaciente = $data['seguridadpaciente'];
            $fechaExpedicion_seguridadpaciente = $data['fechaExpedicion_seguridadpaciente'];
            $cuidadopaliativo = $data['cuidadopaliativo'];
            $fechaExpedicion_cuidadopaliativo = $data['fechaExpedicion_cuidadopaliativo'];
            $combateincendios = $data['combateincendios'];
            $fechaExpedicion_combateincendios = $data['fechaExpedicion_combateincendios'];
            $evaluacioncalidad = $data['evaluacioncalidad'];
            $fechaExpedicion_evaluacioncalidad = $data['fechaExpedicion_evaluacioncalidad'];
            $tratodigno = $data['tratodigno'];
            $fechaExpedicion_tratodigno = $data['fechaExpedicion_tratodigno'];
            $reanimacion = $data['reanimacion'];
            $fechaExpedicion_reanimacion = $data['fechaExpedicion_reanimacion'];
            $saludmental = $data['saludmental'];
            $fechaExpedicion_saludmental = $data['fechaExpedicion_saludmental'];
            $emergenciasydesastres = $data['emergenciasydesastres'];
            $fechaExpedicion_emergenciasydesastres = $data['fechaExpedicion_emergenciasydesastres'];
            $procesoslimpieza = $data['procesoslimpieza'];
            $fechaExpedicion_procesoslimpieza = $data['fechaExpedicion_procesoslimpieza'];

        }
    }
}

?>