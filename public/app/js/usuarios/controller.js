/*
Dentro del controlador user/controller.js declare el objeto userController con los siguientes métodos: 
• load(id) → Solicita al servicio una cuenta existente y lo muestra en la vista 
• save() → Crea una cuenta con los datos de la vista y lo envía al servicio para persistir 
• update() → Crea una cuenta con los datos de la vista y lo envía al servicio para persistir 
• delete(id) → Solicita al servicio eliminar una cuenta existente y actualizar la vista
• list() → Solicita al servicio las cuentas existentes y las muestra en la vista
• exportToPDF() → Genera un archivo PDF 
• resetForm()  → Resetea un formulario de la vista y restaura los valores por defecto 
• enableForm(true/false) → Habilita o deshabilita todos los controles del formulario de la vista 

*/

import { userService } from "./service.js";

export const userController = {
   load: (id) => {

    //a partir de un usuario...

    const usuario = {
        idUsuario: 1,
        idPerfil: 1,
        apellido: "Perez",
        nombre: "Juan",
        cuenta: "jperez",
        estado: "activo",
        password: "123456",
        correo: "jperez@gmail.com",
    }

    //validamos el usuario

    if (!usuario) {
        console.error("no existe el usuario");
        //añadir toast mas adelante
        return
    }

    //voy insertando en cada campo del formulario los datos del usuario

    document.getElementById("datoApellido").value = usuario.apellido;
    document.getElementById("datoNombre").value = usuario.nombre;
    document.getElementById("datoCuenta").value = usuario.cuenta;
    document.getElementById("datoCorreo").value = usuario.correo;

    switch(usuario.idPerfil){
        case 1:
            document.getElementById("perfilAdministrador").checked = true;
        break;
        case 2:
            document.getElementById("perfilOperador").checked = true;
        break;
        default:
            document.getElementById("perfilExterno").checked = true;
    }


   },
   save: () => {

   },
   update: () => {},
   delete: (id) => {},
   list: (filters) => {

     userService.list(filters)
            .then(response => {
                const usuarios = response.result;
                mostrarUsuarios(usuarios);
            })

   },
   exportToPDF: () => {},
   resetForm: () => {},
   enableForm: () => {},
}

function mostrarUsuarios(usuarios){
    let tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.innerHTML = '';

    for(let i = 0; i < usuarios.length; i++){
        //guardamos usuario
        let usuario = usuarios[i];
        //creamos fiila
        let tr = document.createElement("tr");
        //modificamos el contenido de la fila
        tr.innerHTML = `
            <td>${usuario.nombre} ${usuario.apellido}</td>
            <td>${usuario.cuenta}</td>
            <td>${usuario.idPerfil}</td>
            <td>${usuario.correo}</td>
            <td>${usuario.estado}</td>
            <td>
                <a href="usuario/edit/${usuario.idUsuario}" class="btn btn-primary">Modificar</a>
                <button type="button" data-id-usuario=${usuario.idUsuario} class="btn btn-danger btnEliminar">Eliminar</button>
            </td>
        `;
        //insertamos la fila a la tabla
        tabla.appendChild(tr);
    }


}

function capturarDatosUsuario() {


    const dtApellido = document.getElementById("datoApellido").value.trim();
    const dtNombre = document.getElementById("datoNombre").value.trim();
    const dtCuenta = document.getElementById("datoCuenta").value.trim();
    const dtPerfil = document.getElementById("perfilAdministrador");
    const dtCorreo = document.getElementById("datoCorreo").value.trim();
    const dtClave = document.getElementById("datoClave").value.trim();
    const dtConfirmacionClave = document.getElementById("datoConfirmarClave").value.trim();
    const dtEstado = document.getElementById("datoEstadoCuenta").value;

    let claveFinal = '';
    if (dtClave === dtConfirmacionClave) {
        claveFinal = dtConfirmacionClave;
        console.log("la clave se guardó correctamente");
    } else {
        console.log("las claves son diferentes")
    }

    let dtPerfilFinal = '';
    (dtPerfil.checked) ? dtPerfilFinal = 'Administrador' : dtPerfilFinal = 'Operador';

    let usuario = {
        apellido: dtApellido,
        nombres: dtNombre,
        cuenta: dtCuenta,
        perfil: dtPerfilFinal,
        clave: claveFinal,
        correo: dtCorreo,
        estado: dtEstado === 'Activo' ? true : false,
    }

    return usuario;
}