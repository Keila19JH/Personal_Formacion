import { setAlert } from "./plugins/alerts.plugin.js";
import { httpClient } from "./plugins/http-client.plugin.js";



const url = 'php/controllers/login.controller.php';

const formLogin = $('#login_form');

export const mainLogin = () => {
    formLogin.on('submit',  async function (event) {
        event.preventDefault();
        let formData = $(this).serialize();

        showLoadingOverlay();

        validateLogin(formData);
        
    })
}

const validateLogin = async (formData) => {

    try{

        const response = JSON.parse( await httpClient.post(url, formData) );

        hideLoadingOverlay();
        
        if(response === 0) return setAlert.errorAlert('Usuario o Password incorrectos');



        const typeToken = response[0].rol;

        if(typeToken === 1 || typeToken === 2){
            return setAlert.successAlert(
                'La operación se ha completado correctamente.',
                null,
                null,
                '../index.php'
            )
        }

    }catch(error){

        hideLoadingOverlay();
            // Aquí puedes manejar el error en la petición AJAX
        console.error('An error ocurred in the system, please contact with your administrator:', error);

        return setAlert.errorAlert('Se produjo un error al procesar la solicitud.');
    
    }
}


const showLoadingOverlay = () => {
    document.getElementById('loading-overlay').style.display = 'flex';
}

const hideLoadingOverlay = () => {
    document.getElementById('loading-overlay').style.display = 'none';
}
    
