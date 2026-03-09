/* aca se hacen las peticiones usando fetch
Dentro del servicio user/service.js declare el objeto userService con los siguientes métodos: 
• load(id) → Devuelve la cuenta que se corresponda con el identificador 
• save(user) → Guarda una nueva cuenta de usuario 
• update(user) → Actualiza los datos de una cuenta existente 
• delete(id) → Elimina una cuenta existente 
• list() → Devuelve todas las cuentas 
*/ 

const usuarios = [
    {
        idUsuario: 1,
        idPerfil: 1,
        apellido: "Perez",
        nombre: "Juan",
        cuenta: "jperez",
        estado: "activo",
        password: "123456",
        correo: "jperez@gmail.com",
    },
    {
        idUsuario: 2,
        idPerfil: 2,
        apellido: "Gomez",
        nombre: "Maria",
        cuenta: "mgomez",
        estado: "inactivo",
        password: "abcdef",
        correo: "mgomez@gmail.com",
    },
    {
        idUsuario: 3,
        idPerfil: 1,
        apellido: "Lopez",
        nombre: "Carlos",
        cuenta: "clopez",
        estado: "activo",
        password: "ghijkl",
        correo: "clopez@gmail.com",
    }
]

export const userService = {
    load: (id) =>{
        return fetch(`usuario/load/${id}`,{
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            return data;
        })
    },
    save: (user) =>{
        return fetch("usuario/save",{
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(user)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            return data;
        })
    },
    update: (user) => {
        return fetch("usuario/update",{
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(user)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            return data;
        })
    },
    delete: (id) => {
        return fetch(`usuario/delete/${id}`,{
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())  
        .then(data => {
            console.log(data);
            return data;
        })
    },
    list: () => {
        return fetch("usuario/list",{
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            return data;
        })
    }
}