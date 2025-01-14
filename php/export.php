<?php
// Incluir el archivo de configuración de la base de datos
include ('dbconfig.php');

// Conectar a la base de datos
$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Consulta SQL
$query_pacientes = "SELECT 
    dp.id_enfermero,
    dp.curp,
    dp.apellidoPaterno,
    dp.apellidoMaterno,
    dp.nombre,
    dp.genero,
    dp.onomastico,
    dp.edad,
    dp.domicilio,
    dp.email,
    dp.telefono_personal,
    dp.RFC,
    dp.guarderia,
    dp.tiempo_guarderia,
    dp.childrens_1,
    dp.childrens_2,
    dp.childrens_3,
    dp.childrens_4,
    dp.contacto_emergencia,
    dp.contacto,
    dp.no_contacto_emergencia,
    ctr.noempleado,
    ctr.tipocontrato,
    ctr.fechaBasificacion,
    ctr.codigo,
    p.puesto,
    ctr.fechaIngreso,
    ctr.ayo_curso,
    ctr.turno,
    dl.lunes,
    dl.martes,
    dl.miercoles,
    dl.jueves,
    dl.viernes,
    dl.sabado,
    dl.domingo,
    s.servicio,
    ctr.Otro_empleo,
    ctr.antigüedad,
    ctr.tipo_contratacion,
    ctr.otro_contratacion,
    ctr.dependencia,
    ctr.horario_de,
    ctr.horario_a,
    ctr.rotaciones,
    ia.grado_tecnico,
    ia.cedula_tecnico,
    ia.grado_posttecnico,
    ia.cedula_posttecnico,
    ia.grado_licenciatura,
    ia.cedula_lic,
    ia.grado_especialidad,
    ia.cedula_especialidad,
    ia.grado_maestria,
    ia.cedula_maestria,
    ia.grado_doctorado,
    ia.cedula_doctorado,
    ia.colegiacion,
    ia.fechaExpedicion_colegiacion,
    ia.fechaVigencia_colegiacion,
    ia.estatus_colegiacion,
    ia.certificacion,
    ia.fechaExpedicion_certificacion,
    ia.fechaVigencia_certificacion,
    ia.estatus_certificacion,
    ia.observaciones,
    co.BLS,
    co.fechaExpedicion_BLS,
    co.fechaVigencia_BLS,
    co.estatus_BLS,
    co.ACLS,
    co.fechaExpedicion_ACLS,
    co.fechaVigencia_ACLS,
    co.estatus_ACLS,
    co.ReNeo,
    co.fechaExpedicion_ReNeo,
    co.fechaVigencia_ReNeo,
    co.estatus_ReNeo,
    co.PALS,
    co.fechaExpedicion_PALS,
    co.fechaVigencia_PALS,
    co.estatus_PALS,
    co.ALSO,
    co.fechaExpedicion_ALSO,
    co.fechaVigencia_ALSO,
    co.estatus_ALSO,
    co.POE,
    co.fechaExpedicion_POE,
    co.fechaVigencia_POE,
    co.estatus_POE,
    co.CBSPD,
    co.fechaExpedicion_CBSPD,
    co.fechaVigencia_CBSPD,
    co.estatus_CBSPD,
    co.Certificación,
    co.fechaExpedicion_Certificación,
    co.fechaVigencia_Certificación,
    co.estatus_Certificación,
    co.CertificaciónPICC,
    co.fechaExpedicion_CertificaciónPICC,
    co.fechaVigencia_CertificaciónPICC,
    co.estatus_CertificaciónPICC,
    cap.interculturalidad,
    cap.fechaExpedicion_interculturalidad,
    cap.higienemanos,
    cap.fechaExpedicion_higienemanos,
    cap.residuoshospitalarios,
    cap.fechaExpedicion_residuoshospitalarios,
    cap.seguridadpaciente,
    cap.fechaExpedicion_seguridadpaciente,
    cap.cuidadopaliativo,
    cap.fechaExpedicion_cuidadopaliativo,
    cap.combateincendios,
    cap.fechaExpedicion_combateincendios,
    cap.evaluacioncalidad,
    cap.fechaExpedicion_evaluacioncalidad,
    cap.tratodigno,
    cap.fechaExpedicion_tratodigno,
    cap.reanimacion,
    cap.fechaExpedicion_reanimacion,
    cap.saludmental,
    cap.fechaExpedicion_saludmental,
    cap.emergenciasydesastres,
    cap.fechaExpedicion_emergenciasydesastres,
    cap.procesoslimpieza,
    cap.fechaExpedicion_procesoslimpieza
FROM datos_personal dp
JOIN informacion_academica ia ON dp.informacion_academica = ia.id
JOIN contrato ctr ON dp.contrato = ctr.id_contrato
JOIN capacitacion cap ON dp.capacitacion = cap.id_capacitacion
JOIN cursos_obligatorios co ON dp.cursos_obligatorios = co.id_cursos_obligatorios
JOIN dias_laborales dl ON ctr.dias_laborables = dl.id_dias_laborables
JOIN puesto p ON ctr.puesto = p.id_puesto
JOIN servicio s ON ctr.servicio = s.id_servicio";


// Ejecutar la consulta
$result = mysqli_query($conn, $query_pacientes);


// Verificar si se obtuvieron resultados
if ($result) {
    // Importar la biblioteca PhpSpreadsheet
    require '../vendor/autoload.php';

    // Crear un nuevo objeto de hoja de cálculo
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar los encabezados de las columnas
    $columns = array(
        'ID',
        'CURP',
        'Apellido Paterno',
        'Apellido Materno',
        'Nombre(s)',
        'Género',
        'Onomástico',
        'Edad',
        'Domicilio',
        'Correo personal',
        'Teléfono personal',
        'RFC',
        'Guarderia',
        'Hora guardería',
        '0 a 5 años',
        '6 a 10 años',
        '11 a 15 años',
        'más de 15 años',
        'Contacto Emergencia',
        'Nombre Contacto',
        'No. Contacto Emergencia',
        'No. Empleado',
        'Tipo de Contrato',
        'Fecha de basificación',
        'Código',
        'Puesto',
        'Fecha Ingreso',
        'Año En Curso',
        'Turno',
        'Lunes',
        'Martes',
        'Miércoles',
        'Jueves',
        'Viernes',
        'Sábado',
        'Domingo',
        'Servicio',
        'Cuenta con otro empleo',
        'Antigüedad',
        'Tipo de Contratación',
        'Otro (Contratación)',
        'Dependencia',
        'Horario (De: )',
        'Horario (A: )',
        'Servicios de rotación los últimos 5 años',
        'Técnico',
        'Cédula',
        'Post-Técnico',
        'Cédula',
        'Licenciatura',
        'Cédula',
        'Especialidad',
        'Cédula',
        'Maestría',
        'Cédula',
        'Doctorado',
        'Cédula',
        'Colegiación',
        'Fecha Expedición',
        'Vigencia Colegiación',
        'Estatus Colegiación',
        'Certificación',
        'Fecha Certificación',
        'Vigencia Certificación',
        'Estatus Certificación',
        'Observaciones',
        'BLS',
        'Fecha Expedición',
        'Fecha Vigencia',
        'Estatus BLS',
        'ACLS',
        'Fecha Expedición',
        'Fecha Vigencia',
        'Estatus ACLS',
        'ReNeo',
        'Fecha Expedición',
        'Fecha Vigencia',
        'Estatus ReNeo',
        'PALS',
        'Fecha Expedición',
        'Fecha Vigencia',
        'Estatus PALS',
        'ALSO',
        'Fecha Expedición',
        'Fecha Vigencia',
        'Estatus ALSO',
        'POE',
        'Fecha Expedición',
        'Fecha Vigencia',
        'Estatus POE',
        'CBSPD',
        'Fecha Expedición',
        'Fecha Vigencia',
        'Estatus CBSPD',
        'Certificación',
        'Fecha Expedición',
        'Fecha Vigencia',
        'Estatus Certificación',
        'Certificación PICC',
        'Fecha Expedición',
        'Fecha Vigencia',
        'Estatus Certificación',
        'Interculturalidad',
        'Fecha Expedición',
        'Capacitación Virtual de Higiene de Manos',
        'Fecha Expedición',
        'Capacitación Virtual Manejo de Residuos Hospitalarios',
        'Fecha Expedición',
        'Acciones Esenciales de Seguridad del Paciente',
        'Fecha Expedición',
        'Curso Virtual Sobre los Fundamentos del Cuidado Paliativo',
        'Fecha Expedición',
        'Curso Básico de Combate de Incendios',
        'Fecha Expedición',
        'Introducción al Modelo Único de Evaluación de la Calidad',
        'Fecha Expedición',
        'Trato Digno en los Servicios de Salud',
        'Fecha Expedición',
        'Reanimación Cardiopulmonar en Adulto para Profesionales de la Salud',
        'Fecha Expedición',
        'Salud Mental en Profesionales de la Salud',
        'Fecha Expedición',
        'Capacitación de Códigos y Protocolos Hospitalarios de Emergencias y Desastres',
        'Fecha Expedición',
        'Medidas Basadas en la Transmisión de Agentes Infecciosos y Procesos de Limpieza',
        'Fecha Expedición'
    );

    $sheet->fromArray([$columns], null, 'A1');

    // Ajustar el tamaño de las columnas automáticamente
    foreach ($sheet->getColumnIterator() as $column) {
        $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
    }

    // Establecer estilos para los encabezados
    $styleArray = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'ffffff'],
            'size' => 10,
            'name' => 'Avenir Next LT Pro'
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '20485f']
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'wrapText' => true
        ]
    ];


    $sheet->getStyle('A1:DV1')->applyFromArray($styleArray);

    // Agregar los datos desde la base de datos
    $row = 2;
    while ($fila = mysqli_fetch_assoc($result)) {
        $sheet->fromArray([$fila], null, 'A' . $row);
        $row++;
    }

    // Crear un objeto Writer para guardar el archivo Excel
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

    // Definir la ubicación del archivo Excel
    $excel_file = 'Datos Personal_Formación.xlsx';

    // Guardar el archivo Excel
    $writer->save($excel_file);

    // Descargar el archivo Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $excel_file . '"');
    header('Cache-Control: max-age=0');

    $file_path = realpath($excel_file);
    readfile($file_path);
    unlink($file_path); // Eliminar el archivo temporal

    exit();
} else {
    echo "Error al ejecutar la consulta SQL: " . mysqli_error($conn);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>