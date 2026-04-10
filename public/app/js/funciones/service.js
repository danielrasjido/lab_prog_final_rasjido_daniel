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
        throw new Error(data.message || "Error en la API");
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
    }
}