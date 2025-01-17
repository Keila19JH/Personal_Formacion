<?php

require (__DIR__ . '/../models/database.model.php');
include (__DIR__ . '/../dbconfig.php');

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

    $foto_nombre = $_FILES['foto']['name'];
    $foto_tmp_name = $_FILES['foto']['tmp_name'];

    $directorio_destino = "uploads/";
    $ruta_final = $directorio_destino . $foto_nombre;

    $directorio_destino_2 = "../../uploads/";
    $ruta_final_2 = $directorio_destino_2 . $foto_nombre;


    if (move_uploaded_file($foto_tmp_name, $ruta_final_2)) {

        $Data_informacion_academica = array(
            'grado_tecnico'                 => $_POST['grado_tecnico'],
            'cedula_tecnico'                => $_POST['cedula_tecnico'],
            'grado_posttecnico'             => $_POST['grado_posttecnico'],
            'cedula_posttecnico'            => $_POST['cedula_posttecnico'],
            'grado_licenciatura'            => $_POST['grado_licenciatura'],
            'cedula_lic'                    => $_POST['cedula_lic'],
            'grado_especialidad'            => $_POST['grado_especialidad'],
            'cedula_especialidad'           => $_POST['cedula_especialidad'],
            'grado_maestria'                => $_POST['grado_maestria'],
            'cedula_maestria'               => $_POST['cedula_maestria'],
            'grado_doctorado'               => $_POST['grado_doctorado'],
            'cedula_doctorado'              => $_POST['cedula_doctorado'],
            'colegiacion'                   => $_POST['colegiacion'],
            'fechaExpedicion_colegiacion'   => $_POST['fechaExpedicion_colegiacion'],
            'fechaVigencia_colegiacion'     => $_POST['fechaVigencia_colegiacion'],
            'estatus_colegiacion'           => $_POST['estatus_colegiacion'],
            'certificacion'                 => $_POST['certificacion'],
            'fechaExpedicion_certificacion' => $_POST['fechaExpedicion_certificacion'],
            'fechaVigencia_certificacion'   => $_POST['fechaVigencia_certificacion'],
            'estatus_certificacion'         => $_POST['estatus_certificacion'],
            'competencias_profesionales'    => $_POST['competencias_profesionales'],
            'observaciones'                 => $_POST['observaciones']
        );

        foreach ($Data_informacion_academica as $key => $value) {
            $Data_informacion_academica[$key] = $connectionDB->escapeString($value);
        }
        $Result_informacion_academica = $connectionDB->insertData($Tables[0], $Data_informacion_academica);


        $Data_dias_laborales = array(
            'lunes'     => isset($_POST['lunes']) ? $_POST['lunes'] : '',
            'martes'    => isset($_POST['martes']) ? $_POST['martes'] : '',
            'miercoles' => isset($_POST['miercoles']) ? $_POST['miercoles'] : '',
            'jueves'    => isset($_POST['jueves']) ? $_POST['jueves'] : '',
            'viernes'   => isset($_POST['viernes']) ? $_POST['viernes'] : '',
            'sabado'    => isset($_POST['sabado']) ? $_POST['sabado'] : '',
            'domingo'   => isset($_POST['domingo']) ? $_POST['domingo'] : ''
        );

        foreach ($Data_dias_laborales as $key => $value) {
            $Data_dias_laborales[$key] = $connectionDB->escapeString($value);
        }
        $Result_dias_laborales = $connectionDB->insertData($Tables[1], $Data_dias_laborales);

        $Data_contrato = array(
            'noempleado'      => $_POST['noempleado'],
            'tipocontrato'    => $_POST['tipocontrato'],
            'fechaBasificacion' => $_POST['fechaBasificacion'],
            'codigo'          => $_POST['codigo'],
            'puesto'          => $_POST['puesto'],
            'fechaIngreso'    => $_POST['fechaIngreso'],
            'ayo_curso'       => $_POST['ayo_curso'],
            'turno'           => $_POST['turno'],
            'dias_laborables' => $Result_dias_laborales,
            'servicio'        => $_POST['Servicio'],
            'Otro_empleo'     => $_POST['Otro_empleo'],
            'antigüedad'      => $_POST['antigüedad'],
            'tipo_contratacion' => $_POST['tipo_contratacion'],
            'otro_contratacion' => $_POST['otro_contratacion'],
            'dependencia'     => $_POST['dependencia'],
            'horario_de'      => $_POST['horario_de'],
            'horario_a'       => $_POST['horario_a'],
            'rotaciones'      => $_POST['rotaciones'],
            'foto'            => $ruta_final
        );

        foreach ($Data_contrato as $key => $value) {
            $Data_contrato[$key] = $connectionDB->escapeString($value);
        }
        $Result_contrato = $connectionDB->insertData($Tables[2], $Data_contrato);

        $Data_capacitacion = array(
            'interculturalidad' => ' '
        );
        $Result_capacitacion = $connectionDB->insertData($Tables[3], $Data_capacitacion);

        $Data_cursos_obligatorios = array(
            'BLS' => ' '
        );
        $Result_cursos_obligatorios = $connectionDB->insertData($Tables[4], $Data_cursos_obligatorios);

        $Data_personal = array(
            'curp'                   => $_POST['curp'],
            'apellidoPaterno'        => $_POST['apellidoPaterno'],
            'apellidoMaterno'        => $_POST['apellidoMaterno'],
            'nombre'                 => $_POST['nombre'],
            'genero'                 => $_POST['genero'],
            'onomastico'             => $_POST['onomastico'],
            'edad'                   => $_POST['edad'],
            'domicilio'              => $_POST['domicilio'],
            'email'                  => $_POST['email'],
            'telefono_personal'      => $_POST['telefono_personal'],
            'RFC'                    => $_POST['RFC'],
            'guarderia'              => $_POST['guarderia'],
            'tiempo_guarderia'       => isset($_POST['tiempo_guarderia']) ? $_POST['tiempo_guarderia'] : '',
            'childrens_1'            => isset($_POST['childrens_1']) ? 'Si' : '',
            'childrens_2'            => isset($_POST['childrens_2']) ? 'Si' : '',
            'childrens_3'            => isset($_POST['childrens_3']) ? 'Si' : '',
            'childrens_4'            => isset($_POST['childrens_4']) ? 'Si' : '',
            'contacto_emergencia'    => $_POST['contacto_emergencia'],
            'contacto'               => $_POST['contacto'],
            'no_contacto_emergencia' => $_POST['no_contacto_emergencia'],
            'contrato'               => $Result_contrato,
            'informacion_academica'  => $Result_informacion_academica,
            'capacitacion'           => $Result_capacitacion,
            'cursos_obligatorios'    => $Result_cursos_obligatorios
        );
        foreach ($Data_personal as $key => $value) {
            $Data_personal[$key] = $connectionDB->escapeString($value);
        }
        $Result_datos_personal = $connectionDB->insertData($Tables[5], $Data_personal);

        echo 'success';
    }



}


?>