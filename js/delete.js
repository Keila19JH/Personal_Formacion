
import { setAlerts } from "./plugins/alerts.plugin.js";
import { httpClients } from "./plugins/http-client.plugin.js";
import { hideLoadingOverlay, showLoadingOverlay } from "./plugins/loader.plugin.js";

const deleteUrl = "http://localhost/personal_formacion/php/controllers/delete.controller.php";

export const handleDelete = () => {
    // Delegar el evento para el botón de eliminar
    $(document).on("click", ".eliminar-registro", async function () {
        const id = $(this).data("id");

        console.log("ID enviado al servidor:", id);
        if (!id) {
            setAlerts.errorAlert("El ID es inválido o no se encontró.");
            return;
        }

        // Mostrar confirmación con SweetAlert
        const confirmation = await setAlerts.confirmationAlert(
            "¿Estás seguro?",
            "Esta acción no se puede deshacer.",
            "warning"
        );

        if (confirmation.isConfirmed) {
            try {
                // Mostrar un overlay de carga
                showLoadingOverlay();

                console.log("Enviando solicitud al servidor con el ID:", id);
                


                // Enviar solicitud al servidor para eliminar el registro

                
                const response = await httpClients.post(deleteUrl, { id });

                console.log("Datos enviados al servidor:", { id });  // Verifica que el ID esté presente

                // Ocultar el overlay de carga
                hideLoadingOverlay();

                if (response && response.status === "success") {
                    setAlerts.successAlert(
                        "¡Eliminado!",
                        response.message,
                        null,
                        null
                    );

                    // Eliminar la fila correspondiente del DOM
                    const row = $(`button[data-id="${id}"]`).closest("tr");
                    if (row.length > 0) {
                        row.remove();
                    } else {
                        console.warn("No se encontró la fila en el DOM.");
                    }
                } else if (response && response.status === "error") {
                    setAlerts.errorAlert(
                        "No se pudo eliminar el registro: " + response.message
                    );
                } else {
                    setAlerts.errorAlert(
                        "Respuesta inesperada del servidor. Verifica el log."
                    );
                }
            } catch (error) {
                // Ocultar el overlay de carga en caso de error
                hideLoadingOverlay();

                console.error("Error en la solicitud:", error);
                setAlerts.errorAlert(
                    "Hubo un error al conectar con el servidor para eliminar el registro."
                );
            }
        }
    });
};
