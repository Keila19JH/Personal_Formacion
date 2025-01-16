$(document).ready(function () {
    
    const userType = window.userType;
    console.log("Tipo de usuario:", userType);
    
    $.ajax({
        url: 'php/controllers/consulta_tabla.controller.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {

            const registrosPorPagina = 10; // Número de registros por página
            let paginaActual = 1; // Página actual inicialmente
            let totalRegistros = data.length; // Total de registros

            // Función para mostrar la tabla con paginación
            function mostrarTablaEnfermeros(datos, pagina) {
                let html = "";
                const inicio = (pagina - 1) * registrosPorPagina;
                const fin = inicio + registrosPorPagina;
                const datosPagina = datos.slice(inicio, fin);

                datosPagina.forEach(enfermero => {
                    html += `
                        <tr>
                            <td><img src="${enfermero.foto || ''}" class="imagen-enfermero"></td>
                            <td>${enfermero.noempleado || ''}</td>
                            <td>${enfermero.apellidoPaterno || ''}</td>
                            <td>${enfermero.apellidoMaterno || ''}</td>
                            <td>${enfermero.nombre || ''}</td>    
                            <td>${enfermero.codigo || ''}</td>
                            <td><a href="ver_personal.php?id=${enfermero.id_enfermero || ''}">Ver</a></td>
                            ${userType === 'admin' ? `
                                <td><a href="editar.php?id=${enfermero.id_enfermero || ''}">Editar</a></td>
                                <td><button class="btn btn-danger btn-sm eliminar-registro" data-id="${enfermero.id_enfermero}">Eliminar</button></td>
                            ` : ''}
                        </tr>
                    `;
                });
                $("#tablaEnfermeros").html(html);
            }
        
            // Función para mostrar el paginador
            function mostrarPaginador(totalRegistros, paginaActual) {
                const numeroPaginas = Math.ceil(totalRegistros / registrosPorPagina);
                let visiblePages = 5; // Máximo número de páginas visibles a la vez
                let startPage = Math.max(paginaActual - Math.floor(visiblePages / 2), 1);
                let endPage = Math.min(startPage + visiblePages - 1, numeroPaginas);

                let html = "";

                if (paginaActual > 1) {
                    html += `<li class="page-item"><a href="#" class="page-link pagina" data-page="${paginaActual - 1}">&laquo;</a></li>`;
                }

                if (startPage > 1) {
                    html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }

                for (let i = startPage; i <= endPage; i++) {
                    html += `<li class="page-item ${i === paginaActual ? 'active' : ''}"><a href="#" class="page-link pagina" data-page="${i}">${i}</a></li>`;
                }

                if (endPage < numeroPaginas) {
                    html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }

                if (paginaActual < numeroPaginas) {
                    html += `<li class="page-item"><a href="#" class="page-link pagina" data-page="${paginaActual + 1}">&raquo;</a></li>`;
                }

                $("#paginador").html(html);
            }

            // Mostrar la tabla con todos los enfermeros al cargar la página
            mostrarTablaEnfermeros(data, paginaActual);
            mostrarPaginador(totalRegistros, paginaActual);

            // Evento para cambiar de página
            $(document).on("click", ".pagina", function (event) {
                event.preventDefault();
                paginaActual = parseInt($(this).data('page'));
                mostrarTablaEnfermeros(data, paginaActual);
                mostrarPaginador(totalRegistros, paginaActual);
            });

            // Función para filtrar los enfermeros en tiempo real
            $("#buscador").on("input", function () {
                const valorBusqueda = $(this).val().toLowerCase();
                const resultados = data.filter(enfermero => 
                    (enfermero.noempleado && enfermero.noempleado.toString().toLowerCase().includes(valorBusqueda)) ||
                    (enfermero.apellidoPaterno && enfermero.apellidoPaterno.toLowerCase().includes(valorBusqueda)) ||
                    (enfermero.apellidoMaterno && enfermero.apellidoMaterno.toLowerCase().includes(valorBusqueda)) ||
                    (enfermero.nombre && enfermero.nombre.toLowerCase().includes(valorBusqueda)) ||
                    (enfermero.codigo && enfermero.codigo.toLowerCase().includes(valorBusqueda))
                );

                totalRegistros = resultados.length;
                mostrarTablaEnfermeros(resultados, 1); // Mostrar resultados desde la primera página
                mostrarPaginador(totalRegistros, 1); // Actualizar paginador con los nuevos resultados
            });
        },
        error: function (xhr, status, error) {
            console.error("Error al obtener los datos:", status, error);
        }
    });
});
