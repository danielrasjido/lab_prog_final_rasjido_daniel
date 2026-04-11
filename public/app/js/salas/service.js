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

    return data.result;
}

export const salasService = {
    list: (filters) => {
        return request("salas/list", {
            method: "POST",
            body: JSON.stringify(filters)
        });
    },
    save: (sala) => {
        return request("salas/save", {
            method: "POST",
            body: JSON.stringify(sala)
        });
    },
    enable: (idSala) => {
        return request(`salas/enable/${idSala}`, {
            method: "GET"
        });
    },
    disable: (idSala) => {
        return request(`salas/disable/${idSala}`, {
            method: "GET"
        });
    }
}