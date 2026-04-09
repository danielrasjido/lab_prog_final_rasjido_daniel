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

export const programacionService = {
    save: (programacion) => {
        return request("programacion/save", {
            method: "POST",
            body: JSON.stringify(programacion)
        });
    },
    list: (filters) => {
        return request("programacion/list", {
            method: "POST",
            body: JSON.stringify(filters)
        });
    }
}