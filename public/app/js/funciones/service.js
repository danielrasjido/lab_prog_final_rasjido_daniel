const request = async (url, options = {}) => {
    const response = await fetch(url, {
        ...options,
        headers: {
            "Content-Type": "application/json"
        }
    })
    
    if(!response.ok){
        throw new Error("Error HTTP: " + response.status);
    }

    const data = await response.json();

    if (data.error) {
        throw new Error(data.error || data.message || "Error en la API");
    }

    console.log("Retornando data.result:", data.result);
    return data.result;
}


export const funcionesService = {
    list: (filters = {}) => {
        return request("funciones/list", {
            method: "POST",
            body: JSON.stringify(filters)
        });
    },
    listPeliculas: (filters = {}) => {
        return request("peliculas/list", {
            method: "POST",
            body: JSON.stringify(filters)
        });
    },
    listSalas: (filters = {}) => {
        return request("salas/list", {
            method: "POST",
            body: JSON.stringify(filters)
        });
    },
    save: (funcion) => {
        return request("funciones/save", {
            method: "POST",
            body: JSON.stringify(funcion)
        });
    },
    cancelar: (idFuncion) => {
        return request(`funciones/cancelar/${idFuncion}`, {
            method: "GET"
        });
    }
}