
$(document).ready(function () {
    // Detectar cambios en el campo CURP
    $('#curp').on('input', function () {
        var curp = $(this).val().toUpperCase(); // Convertir a mayúsculas
        $(this).val(curp); // Asignar el valor en mayúsculas de nuevo al campo
    });
});

$(document).ready(function () {
    $('#curp').on('input', function () {
        var curp = $(this).val().toUpperCase(); // Convertir a mayúsculas

        // Validamos que la longitud del CURP sea correcta (18 caracteres)
        if (curp.length === 18) {
            var genero = curp.charAt(10);
            var fechaNacimiento = curp.substr(4, 6);
            var año = fechaNacimiento.substr(0, 2);
            var mes = fechaNacimiento.substr(2, 2);
            var dia = fechaNacimiento.substr(4, 2);

            // Obtener fecha de nacimiento
            var fechaNacimientoCompleta = new Date("19" + año + "-" + mes + "-" + dia);
            var onomastico = fechaNacimientoCompleta.toISOString().split('T')[0];

            // Calcular edad
            var hoy = new Date();
            var edad = hoy.getFullYear() - fechaNacimientoCompleta.getFullYear();
            var mesActual = hoy.getMonth() + 1;
            if (mesActual < parseInt(mes) || (mesActual === parseInt(mes) && hoy.getDate() < parseInt(dia))) {
                edad--;
            }

            // Obtener RFC sin homoclave
            var rfc = curp.substr(0, 10);

            // Asignar valores a los campos
            $('#genero').val(genero);
            $('#onomastico').val(onomastico);
            $('#edad').val(edad);
            $('#RFC').val(rfc);
        } else {
            // Limpiar campos si el CURP no tiene la longitud correcta
            $('#genero').val('');
            $('#onomastico').val('');
            $('#edad').val('');
            $('#RFC').val('');
        }
    });
});



