
export const httpClients = {
    post: async (url = '', formData) => {
        return $.ajax({ 
            url: url, 
            data: formData, 
            processData: false, // Indica a jQuery que no procese los datos
            contentType: false, // Indica a jQuery que no establezca el tipo de contenido
            type: 'POST' 
        });
    },    
    get: async (url = '') => { return $.ajax({ url: url, dataType: 'json', type: 'GET' }); },
    post_1: async (url = '', data) => $.ajax({ url, data, type: 'POST'})

}

