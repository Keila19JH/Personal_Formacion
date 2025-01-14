import { setAlerts } from "./plugins/alerts.plugin.js";
import { httpClients } from "./plugins/http-client.plugin.js";
import { hideLoadingOverlay, showLoadingOverlay } from "./plugins/loader.plugin.js";

const url = "php/controllers/insert.controller.php";
const data = $('#patientForm');
const maxFileSize = 5 * 1024 * 1024; // 2 MB

export const mainForm = () => {
    data.on('submit', async function (event) {
        event.preventDefault();
        let formData = new FormData(this);

        // Obtener el archivo
        let file = formData.get('foto');
        if (file) {
            // Verificar tipo de archivo
            const validFileTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validFileTypes.includes(file.type)) {
                return setAlerts.errorAlert('El archivo debe ser una imagen (jpg, jpeg, png).');
            }

            // Verificar tamaño del archivo
            if (file.size > maxFileSize) {
                return setAlerts.errorAlert('El archivo debe ser menor a 5 MB.');
            }

            // Obtener los valores de nombre y apellidos del formulario
            let apellidoPaterno = formData.get('apellidoPaterno');
            let apellidoMaterno = formData.get('apellidoMaterno');
            let nombre = formData.get('nombre');

            // Obtener el nombre original del archivo
            let fileName = file.name;

            // Obtener la extensión del archivo
            let fileExtension = fileName.split('.').pop();

            // Construir un nuevo nombre de archivo usando los valores del formulario
            let newFileName = `${apellidoPaterno}_${apellidoMaterno}_${nombre}.${fileExtension}`;

            // Cambiar el nombre del archivo en el FormData
            formData.set('foto', file, newFileName);
        }

        showLoadingOverlay();
        validation(formData);
    });
}


const validation = async (formData) => {
    try {
        const response = await httpClients.post(url, formData);
        console.log(response);

        hideLoadingOverlay();

        if (response == 0) {
            return setAlerts.errorAlert('Hubo una Falla en el servidor al Guardar los datos');
        }

        if (response == 'success') {
            return setAlerts.successAlert(
                'Formulario mandado',
                null,
                null,
                'index.php',
            );
        }
    } catch (error) {
        hideLoadingOverlay();
        console.error(error);
        setAlerts.errorAlert('Hubo un error en la solicitud.');
    }
}