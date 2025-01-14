$.ajax({
    url: 'php/controllers/metricas_graficas.controller.php',
    type: 'GET',
    dataType: 'json',
    success: function (data) {

        let informacionAcademica = data.informacion_academica[0];
        let genero = data.genero;

        console.log(genero)
        let especialidad = data.especialidad

        let data1 =[
            {titulo: 'Técnico', value: parseInt(informacionAcademica.total_grado_tecnico)},
            {titulo: 'Post-Técnico', value: parseInt(informacionAcademica.total_grado_posttecnico)},
            {titulo: 'Licenciatura', value: parseInt(informacionAcademica.total_grado_licenciatura)},
            {titulo: 'Especialidad', value: parseInt(informacionAcademica.total_grado_especialidad)},
            {titulo: 'Maestría', value: parseInt(informacionAcademica.total_grado_maestria)},
            {titulo: 'Doctorado', value: parseInt(informacionAcademica.total_grado_doctorado)}
        ]
        // Llamar a la función para crear la gráfica de barras con los datos preparados
        crearGraficaBarras("chartdiv", data1);
        
        // let data2 =[
        //     {titulo: 'H', value: parseInt(genero[0][1])},
        //     {titulo: 'M', value: parseInt(genero[1][1])}
        // ]


        let data2 = genero.map(item => ({
            titulo: item.genero,
            value: parseInt(item.conteo)
        }))

        crearGraficaBarras("chartdiv1", data2);


        let dataEspecialidad = especialidad.map(item => ({
            titulo: item.grado_especialidad,
            value: parseInt(item.conteo)
        }));

        crearGraficaBarras("chartdiv2", dataEspecialidad);


    },
    error: function (xhr, status, error) {
        console.error("Error al obtener los datos:", status, error);
    }
});


// Función para crear la gráfica de barras
function crearGraficaBarras(chartId, data) {
    // Create root element
    var root = am5.Root.new(chartId);

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
        categoryField: "titulo",
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
        categoryXField: "titulo",
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


const exportToExcel = (tableId,Texto) => {
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
    let filename = `Resumen Personal por ${Texto} ` + date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + ".xlsx";
    XLSX.writeFile(workbook, filename);
}