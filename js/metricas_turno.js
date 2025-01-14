$.ajax({
    url: 'php/controllers/metricas_turno.controller.php',
    type: 'GET',
    dataType: 'json',
    success: function (response) {
        let tbody = $('#tabla-recuento');
        tbody.empty(); // Vaciar la tabla antes de llenarla con nuevos datos

        // variables para almacenar los totales por columna
        let totalLunes = 0;
        let totalMartes = 0;
        let totalMiercoles = 0;
        let totalJueves = 0;
        let totalViernes = 0;
        let totalSabado = 0;
        let totalDomingo = 0;

        response.conteo_turnos.forEach(function (item) {
            // Convertir los valores a números
            let lunes = Number(item.total_lunes);
            let martes = Number(item.total_martes);
            let miercoles = Number(item.total_miercoles);
            let jueves = Number(item.total_jueves);
            let viernes = Number(item.total_viernes);
            let sabado = Number(item.total_sabado);
            let domingo = Number(item.total_domingo);

            // Calcular el total por fila (turno)
            let totalTurno = lunes + martes + miercoles + jueves + viernes + sabado + domingo;

            // Agregar los valores a los totales por columna
            totalLunes += lunes;
            totalMartes += martes;
            totalMiercoles += miercoles;
            totalJueves += jueves;
            totalViernes += viernes;
            totalSabado += sabado;
            totalDomingo += domingo;

            // Crear una fila para la tabla
            let row = '<tr>' +
                '<td>' + item.turno + '</td>' +
                '<td>' + lunes + '</td>' +
                '<td>' + martes + '</td>' +
                '<td>' + miercoles + '</td>' +
                '<td>' + jueves + '</td>' +
                '<td>' + viernes + '</td>' +
                '<td>' + sabado + '</td>' +
                '<td>' + domingo + '</td>' +
                '<td>' + totalTurno + '</td>' +
                '</tr>';
            tbody.append(row);
        });

        // Calcular el total general (sumando los totales de los días)
        let totalGeneral = totalLunes + totalMartes + totalMiercoles + totalJueves + totalViernes + totalSabado + totalDomingo;

        // Mostrar los totales por columna en el pie de la tabla
        $('#total_lunes').text(totalLunes);
        $('#total_martes').text(totalMartes);
        $('#total_miercoles').text(totalMiercoles);
        $('#total_jueves').text(totalJueves);
        $('#total_viernes').text(totalViernes);
        $('#total_sabado').text(totalSabado);
        $('#total_domingo').text(totalDomingo);
        $('#total_general').text(totalGeneral);
    },
    error: function (xhr, status, error) {
        console.error("Error al obtener los datos:", status, error);
    }
});