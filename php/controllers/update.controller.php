<?php

require(__DIR__ . '/../models/database.model.php');
include(__DIR__ . '/../dbconfig.php');

$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $Tables = array(
        $table_informacion_academica = 'informacion_academica',
        $table_dias_laborales = 'dias_laborales',
        $table_contrato = 'contrato',
        $table_capacitacion = 'capacitacion',
        $table_cursos_obligatorios = 'cursos_obligatorios',
        $table_datos_personal = 'datos_personal'
    );

    $updateColum_ia = 'id';
    $updateColum_dl = 'id_dias_laborables';
    $updateColum_contrato = 'id_contrato';
    $updateColum_capacitacion = 'id_capacitacion';
    $updateColum_cursos_obligatorios = 'id_cursos_obligatorios';
    $updateColum = 'id_enfermero';
    $updateId = $_POST['id_enfermero'];

    // Verificar si se seleccionó una nueva imagen
    if (!empty($_FILES['foto']['name'])) {
        $foto_nombre = $_FILES['foto']['name'];
        $foto_tmp_name = $_FILES['foto']['tmp_name'];

        // Definir las rutas de destino
        $directorio_destino = "uploads/";
        $ruta_final = $directorio_destino . $foto_nombre;

        // Mover la imagen a la carpeta de uploads
        if (move_uploaded_file($foto_tmp_name, "../../uploads/" . $foto_nombre)) {
            // Si se movió el archivo, actualizamos el array con la nueva ruta
            $Data_contrato['foto'] = $ruta_final;

            // Aquí haces la actualización de la base de datos para incluir el campo 'foto'
            $connectionDB->updateData($Tables[2], $Data_contrato, $updateColum_contrato, $updateId);
        }
    }



    $Data_informacion_academica = array(
        'grado_tecnico' => $_POST['grado_tecnico'],
        'cedula_tecnico' => $_POST['cedula_tecnico'],
        'grado_posttecnico' => $_POST['grado_posttecnico'],
        'cedula_posttecnico' => $_POST['cedula_posttecnico'],
        'grado_licenciatura' => $_POST['grado_licenciatura'],
        'cedula_lic' => $_POST['cedula_lic'],
        'grado_especialidad' => $_POST['grado_especialidad'],
        'cedula_especialidad' => $_POST['cedula_especialidad'],
        'grado_maestria' => $_POST['grado_maestria'],
        'cedula_maestria' => $_POST['cedula_maestria'],
        'grado_doctorado' => $_POST['grado_doctorado'],
        'cedula_doctorado' => $_POST['cedula_doctorado'],
        'colegiacion' => $_POST['colegiacion'],
        'fechaExpedicion_colegiacion' => $_POST['fechaExpedicion_colegiacion'],
        'fechaVigencia_colegiacion' => $_POST['fechaVigencia_colegiacion'],
        'estatus_colegiacion' => $_POST['estatus_colegiacion'],
        'certificacion' => $_POST['certificacion'],
        'fechaExpedicion_certificacion' => $_POST['fechaExpedicion_certificacion'],
        'fechaVigencia_certificacion' => $_POST['fechaVigencia_certificacion'],
        'estatus_certificacion' => $_POST['estatus_certificacion'],
        'competencias_profesionales' => $_POST['competencias_profesionales'],
        'observaciones' => $_POST['observaciones']
    );

    $connectionDB->updateData($Tables[0], $Data_informacion_academica, $updateColum_ia, $updateId);


    $Data_dias_laborales = array(
        'lunes' => isset($_POST['lunes']) ? $_POST['lunes'] : '',
        'martes' => isset($_POST['martes']) ? $_POST['martes'] : '',
        'miercoles' => isset($_POST['miercoles']) ? $_POST['miercoles'] : '',
        'jueves' => isset($_POST['jueves']) ? $_POST['jueves'] : '',
        'viernes' => isset($_POST['viernes']) ? $_POST['viernes'] : '',
        'sabado' => isset($_POST['sabado']) ? $_POST['sabado'] : '',
        'domingo' => isset($_POST['domingo']) ? $_POST['domingo'] : ''
    );

    $connectionDB->updateData($Tables[1], $Data_dias_laborales, $updateColum_dl, $updateId);

    // Datos del contrato que se van a actualizar
    $Data_contrato = array(
        'noempleado' => $_POST['noempleado'],
        'tipocontrato' => $_POST['tipocontrato'],
        'fechaBasificacion' => $_POST['fechaBasificacion'],
        'codigo' => $_POST['codigo'],
        'puesto' => $_POST['puesto'],
        'fechaIngreso' => $_POST['fechaIngreso'],
        'ayo_curso' => $_POST['ayo_curso'],
        'turno' => $_POST['turno'],
        'servicio' => $_POST['Servicio'],
        'Otro_empleo' => $_POST['Otro_empleo'],
        'antigüedad' => $_POST['antigüedad'],
        'tipo_contratacion' => $_POST['tipo_contratacion'],
        'otro_contratacion' => $_POST['otro_contratacion'],
        'dependencia' => $_POST['dependencia'],
        'horario_de' => $_POST['horario_de'],
        'horario_a' => $_POST['horario_a'],
        'rotaciones' => $_POST['rotaciones'],
    );

    // Actualizar los datos del contrato
    $connectionDB->updateData($Tables[2], $Data_contrato, $updateColum_contrato, $updateId);

    $Data_capacitacion = array(
        'interculturalidad' => $_POST['interculturalidad'],
        'fechaExpedicion_interculturalidad' => $_POST['fechaExpedicion_interculturalidad'],
        'higienemanos' => $_POST['higienemanos'],
        'fechaExpedicion_higienemanos' => $_POST['fechaExpedicion_higienemanos'],
        'residuoshospitalarios' => $_POST['residuoshospitalarios'],
        'fechaExpedicion_residuoshospitalarios' => $_POST['fechaExpedicion_residuoshospitalarios'],
        'seguridadpaciente' => $_POST['seguridadpaciente'],
        'fechaExpedicion_seguridadpaciente' => $_POST['fechaExpedicion_seguridadpaciente'],
        'cuidadopaliativo' => $_POST['cuidadopaliativo'],
        'fechaExpedicion_cuidadopaliativo' => $_POST['fechaExpedicion_cuidadopaliativo'],
        'combateincendios' => $_POST['combateincendios'],
        'fechaExpedicion_combateincendios' => $_POST['fechaExpedicion_combateincendios'],
        'evaluacioncalidad' => $_POST['evaluacioncalidad'],
        'fechaExpedicion_evaluacioncalidad' => $_POST['fechaExpedicion_evaluacioncalidad'],
        'tratodigno' => $_POST['tratodigno'],
        'fechaExpedicion_tratodigno' => $_POST['fechaExpedicion_tratodigno'],
        'reanimacion' => $_POST['reanimacion'],
        'fechaExpedicion_reanimacion' => $_POST['fechaExpedicion_reanimacion'],
        'saludmental' => $_POST['saludmental'],
        'fechaExpedicion_saludmental' => $_POST['fechaExpedicion_saludmental'],
        'emergenciasydesastres' => $_POST['emergenciasydesastres'],
        'fechaExpedicion_emergenciasydesastres' => $_POST['fechaExpedicion_emergenciasydesastres'],
        'procesoslimpieza' => $_POST['procesoslimpieza'],
        'fechaExpedicion_procesoslimpieza' => $_POST['fechaExpedicion_procesoslimpieza']
    );
    $connectionDB->updateData($Tables[3], $Data_capacitacion, $updateColum_capacitacion, $updateId);

    $Data_cursos_obligatorios = array(
        'BLS' => $_POST['BLS'],
        'fechaExpedicion_BLS' => $_POST['fechaExpedicion_BLS'],
        'fechaVigencia_BLS' => $_POST['fechaVigencia_BLS'],
        'estatus_BLS' => $_POST['estatus_BLS'],
        'ACLS' => $_POST['ACLS'],
        'fechaExpedicion_ACLS' => $_POST['fechaExpedicion_ACLS'],
        'fechaVigencia_ACLS' => $_POST['fechaVigencia_ACLS'],
        'estatus_ACLS' => $_POST['estatus_ACLS'],
        'ReNeo' => $_POST['ReNeo'],
        'fechaExpedicion_ReNeo' => $_POST['fechaExpedicion_ReNeo'],
        'fechaVigencia_ReNeo' => $_POST['fechaVigencia_ReNeo'],
        'estatus_ReNeo' => $_POST['estatus_ReNeo'],
        'PALS' => $_POST['PALS'],
        'fechaExpedicion_PALS' => $_POST['fechaExpedicion_PALS'],
        'fechaVigencia_PALS' => $_POST['fechaVigencia_PALS'],
        'estatus_PALS' => $_POST['estatus_PALS'],
        'ALSO' => $_POST['ALSO'],
        'fechaExpedicion_ALSO' => $_POST['fechaExpedicion_ALSO'],
        'fechaVigencia_ALSO' => $_POST['fechaVigencia_ALSO'],
        'estatus_ALSO' => $_POST['estatus_ALSO'],
        'POE' => $_POST['POE'],
        'fechaExpedicion_POE' => $_POST['fechaExpedicion_POE'],
        'fechaVigencia_POE' => $_POST['fechaVigencia_POE'],
        'estatus_POE' => $_POST['estatus_POE'],
        'CBSPD' => $_POST['CBSPD'],
        'fechaExpedicion_CBSPD' => $_POST['fechaExpedicion_CBSPD'],
        'fechaVigencia_CBSPD' => $_POST['fechaVigencia_CBSPD'],
        'estatus_CBSPD' => $_POST['estatus_CBSPD'],
        'Certificación' => $_POST['Certificación'],
        'fechaExpedicion_Certificación' => $_POST['fechaExpedicion_Certificación'],
        'fechaVigencia_Certificación' => $_POST['fechaVigencia_Certificación'],
        'estatus_Certificación' => $_POST['estatus_Certificación'],
        'CertificaciónPICC' => $_POST['CertificaciónPICC'],
        'fechaExpedicion_CertificaciónPICC' => $_POST['fechaExpedicion_CertificaciónPICC'],
        'fechaVigencia_CertificaciónPICC' => $_POST['fechaVigencia_CertificaciónPICC'],
        'estatus_CertificaciónPICC' => $_POST['estatus_CertificaciónPICC'],
    );

    $connectionDB->updateData($Tables[4], $Data_cursos_obligatorios, $updateColum_cursos_obligatorios, $updateId);

    $Data_personal = array(
        'curp' => $_POST['CURP'],
        'apellidoPaterno' => $_POST['apellidoPaterno'],
        'apellidoMaterno' => $_POST['apellidoMaterno'],
        'nombre' => $_POST['nombre'],
        'genero' => $_POST['genero'],
        'onomastico' => $_POST['onomastico'],
        'edad' => $_POST['edad'],
        'domicilio' => $_POST['domicilio'],
        'email' => $_POST['email'],
        'telefono_personal' => $_POST['telefono_personal'],
        'RFC' => $_POST['RFC'],
        'guarderia' => $_POST['guarderia'],
        'tiempo_guarderia' => isset($_POST['tiempo_guarderia']) ? $_POST['tiempo_guarderia'] : '',
        'childrens_1' => isset($_POST['childrens_1']) ? 'Si' : '',
        'childrens_2' => isset($_POST['childrens_2']) ? 'Si' : '',
        'childrens_3' => isset($_POST['childrens_3']) ? 'Si' : '',
        'childrens_4' => isset($_POST['childrens_4']) ? 'Si' : '',
        'contacto_emergencia' => $_POST['contacto_emergencia'],
        'contacto' => $_POST['contacto'],
        'no_contacto_emergencia' => $_POST['no_contacto_emergencia'],
    );

    $connectionDB->updateData($Tables[5], $Data_personal, $updateColum, $updateId);

    echo 'success';


}


?>