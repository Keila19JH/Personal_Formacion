export const setAlert = {

    errorAlert: (text) => {

        return Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text,
                    confirmButtonText: 'OK'
                });
    },

    successAlert: (text, title = 'Éxito', timer = 0, href, ) => {
        return Swal.fire({
            icon: 'success',
            title,
            text,
            showConfirmButton: true,
            timer,
            willClose: () => {
                window.location.href = href;
            }
        });
    }
    
}


