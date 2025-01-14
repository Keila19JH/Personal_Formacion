$.ajax({
    url: 'php/controllers/metricas.controller.php',
    type: 'GET',
    dataType: 'json',
    success: function (data) {

        // Preparar datos para la gráfica
        var chartData = [
            { turno: "JORNADA ESPECIAL", value: parseInt(data.conteo_turnos.jornada[0]["0"]) },
            { turno: "MATUTINO", value: parseInt(data.conteo_turnos.matutino[0]["0"]) },
            { turno: "VESPERTINO", value: parseInt(data.conteo_turnos.vespertino[0]["0"]) },
            { turno: "NOCTURNO", value: parseInt(data.conteo_turnos.nocturno[0]["0"]) }
        ];

        // Llamar a la función para crear la gráfica de barras con los datos preparados
        crearGraficaBarras(chartData);


        // Asignar valores directamente a las celdas de la tabla
        $('#recuento-jornada').text(data.conteo_turnos.jornada[0][0] || "0");
        $('#recuento-matutino').text(data.conteo_turnos.matutino[0][0] || "0");
        $('#recuento-vespertino').text(data.conteo_turnos.nocturno[0][0] || "0");
        $('#recuento-nocturno').text(data.conteo_turnos.vespertino[0][0] || "0");

        // Obtener el elemento thead y tbody
        let thead = $('#tabla-cabeceras');
        let tbody = $('#tabla-datos');

        // Limpiar cualquier contenido previo
        thead.empty();
        tbody.empty();

        // Crear la fila de encabezados de turno
        let encabezadoTurno = '<tr><th scope="col"> </th>';
        data.turno.forEach(function (turno) {
            encabezadoTurno += `<th scope="col">${turno.turno}</th>`;
        });
        encabezadoTurno += '</tr>';
        thead.append(encabezadoTurno);

        // Crear las filas de datos de servicios
        data.servicio.forEach(function (servicio) {
            let filaServicio = `<tr><th scope="row">${servicio.servicio}</th>`;
            data.turno.forEach(function (turno) {
                // Buscar el conteo de personal para este turno/servicio
                let conteo = 0;
                data.personal.forEach(function (personal) {
                    if (personal.servicio === servicio.servicio && personal.turno === turno.turno) {
                        conteo++;
                    }
                });
                // Agregar el conteo como dato en la celda correspondiente
                filaServicio += `<td>${conteo}</td>`;
            });
            filaServicio += '</tr>';
            tbody.append(filaServicio);
        });
    },
    error: function (xhr, status, error) {
        console.error("Error al obtener los datos:", status, error);
    }
});


// Función para crear la gráfica de barras
function crearGraficaBarras(data) {
    // Create root element
    var root = am5.Root.new("chartdiv");

    // Set themes
    root.setThemes([
        am5themes_Animated.new(root)
    ]);

    // Create chart
    var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoomX: true,
        paddingLeft: 0,
        paddingRight: 1
    }));

    // Add cursor
    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
    cursor.lineY.set("visible", false);

    // Create axes
    var xRenderer = am5xy.AxisRendererX.new(root, {
        minGridDistance: 30,
        minorGridEnabled: true
    });

    xRenderer.labels.template.setAll({
        rotation: -90,
        centerY: am5.p50,
        centerX: am5.p100,
        paddingRight: 15
    });

    xRenderer.grid.template.setAll({
        location: 1
    });

    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
        maxDeviation: 0.3,
        categoryField: "turno",
        renderer: xRenderer,
        tooltip: am5.Tooltip.new(root, {})
    }));

    var yRenderer = am5xy.AxisRendererY.new(root, {
        strokeOpacity: 0.1
    });

    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        maxDeviation: 0.3,
        renderer: yRenderer
    }));

    // Create series
    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
        name: "Series 1",
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: "value",
        sequencedInterpolation: true,
        categoryXField: "turno",
        tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
        })
    }));

    series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
    series.columns.template.adapters.add("fill", function (fill, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
    });

    series.columns.template.adapters.add("stroke", function (stroke, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
    });

    // Set data
    xAxis.data.setAll(data);
    series.data.setAll(data);

    // Make stuff animate on load
    series.appear(1000);
    chart.appear(1000, 100);
}

const exportToExcel = (tableId) => {
    // Obtener la tabla DOM
    let tabla = document.getElementById(tableId);

    // Crear un nuevo libro de Excel
    let workbook = XLSX.utils.book_new();

    // Convertir la tabla a una hoja de Excel
    let ws = XLSX.utils.table_to_sheet(tabla);

    // Agregar la hoja al libro
    XLSX.utils.book_append_sheet(workbook, ws, "Datos");

    // Generar el archivo Excel y guardarlo
    let date = new Date();
    let filename = "Resumen Personal por Servicio y Turno" + date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + ".xlsx";
    XLSX.writeFile(workbook, filename);
}