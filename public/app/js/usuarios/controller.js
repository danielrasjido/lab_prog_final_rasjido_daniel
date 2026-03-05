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
   load: (id) => {},
   save: () => {},
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
                <a href="usuario/edit/${usuario.id}" class="btn btn-primary">Modificar</a>
                <button type="button" data-id=${usuario.id} class="btn btn-danger btnEliminar">Eliminar</button>
            </td>
        `;
        //insertamos la fila a la tabla
        tabla.appendChild(tr);
    }


}