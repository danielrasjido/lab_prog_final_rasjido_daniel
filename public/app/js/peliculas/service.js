//acá vamos a hacer las peticiones para el modulo peliculas, para no repetir cada fetch armo un objeto que voy a llamar en cada método del service

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

export const peliculasService = {
    load: (id) => {
        return request(`peliculas/load/${id}`, {
            method: "GET",
        })
    },
    save: (pelicula) => {
        return request("peliculas/save", {
            method: "POST",
            body: JSON.stringify(pelicula)
        })
    },
    update: (pelicula) => {
        return request("peliculas/update", {
            method: "POST",
            body: JSON.stringify(pelicula)
        })
    },
    disable: (id) => {
        return request(`peliculas/disable/${id}`, {
            method: "GET"
        })
    },
    enable: (id) => {
        return request(`peliculas/enable/${id}`, {
            method: "GET"
        })
    },
    list: (filters = {}) => {
        return request("peliculas/list", {
            method: "POST",
            body: JSON.stringify(filters)
        });

    }
}

/**
 * load(id) → Devuelve la cuenta que se corresponda con el identificador 
• save(user) → Guarda una nueva cuenta de usuario 
• update(user) → Actualiza los datos de una cuenta existente 
• delete(id) → Elimina una cuenta existente 
• list() → Devuelve todas las cuentas 
 */