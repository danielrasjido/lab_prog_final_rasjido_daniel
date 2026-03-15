export const comentariosService = {
    list: (filters = {}) => {
        return fetch("comentarios/list",{
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(filters)
        })
    },
    delete: (id) => {return fetch(`comentarios/delete/${id}`,{
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())  
        .then(data => {
            console.log(data);
            return data;
        })}
}