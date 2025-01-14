
export const httpClient = {

    post: async (url = '', data) => $.ajax({ url, data, type: 'POST'}),
    // put: async (url = '', data) => $.ajax({ url, data, type: 'PUT'}),

}

