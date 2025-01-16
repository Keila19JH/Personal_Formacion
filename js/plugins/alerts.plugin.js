

export const setAlerts = {
    errorAlert: (text) => {
        return Swal.fire({
            icon: 'error',
            title: 'Error',
            text,
            confirmButtonText: 'OK'
        });
    },

    successAlert: (text, title = 'Éxito', timer = 0, href) => {
        return Swal.fire({
            icon: 'success',
            title,
            text,
            showConfirmButton: true,
            timer,
            willClose: () => {
                if (href) {
                    window.location.href = href;
                }
            }
        });
    },

    confirmationAlert: async (title, text, icon = 'warning') => {
        return await Swal.fire({
            title,
            text,
            icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        });
    }
};


