//acá vamos a hacer las peticiones para el modulo peliculas, para no repetir cada fetch armo un objeto que voy a llamar en cada método del service

const request = (url, options = {}) => {
    return fetch(url, {
        headers: {
            "Content-Type": "application/json"
        },
        
    })
    .then(response => {
        if(!response.ok){
            throw new Error("Error HTTP: " + response.status);
        }
        return response.json();
    })
}