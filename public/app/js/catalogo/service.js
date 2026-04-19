const request = async (url, options = {}) => {
    const response = await fetch(url, {
        ...options,
        headers: {
            "Content-Type": "application/json"
        }
    });
    
    if (!response.ok) {
        throw new Error("Error HTTP: " + response.status);
    }

    const data = await response.json();

    if (data.error) {
        throw new Error(data.error || data.message || "Error en la API");
    }

    return data.result;
};

export const catalogoService = {
    listPeliculas: (filters = {}) => {
        return request("catalogo/list", {
            method: "POST",
            body: JSON.stringify(filters)
        });
    },
    loadPelicula: (idPelicula) => {
        return request(`catalogo/load/${idPelicula}`, {
            method: "GET"
        });
    },
    comentar: (data) => {
        return request("catalogo/comentar", {
            method: "POST",
            body: JSON.stringify(data)
        });
    },
    comprar: (idFuncion) => {
        return request("catalogo/comprar", {
            method: "POST",
            body: JSON.stringify({ idFuncion })
        });
    },
    misEntradas: () => {
        return request("catalogo/misEntradas", {
            method: "GET"
        });
    }
}