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

        switch (usuario.idPerfil) {
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
        const usuario = capturarDatosUsuarioSave();
        userService.save(usuario);
    },
    update: () => {
        const usuario = capturarDatosUsuario();
        userService.update(usuario);
    },
    delete: (id) => {
        if (!confirm("¿Está seguro que desea eliminar este usuario? Esta acción no se puede deshacer.")) {
            return;
        }

        userService.delete(id);
    },
    list: (filters) => {

        userService.list(filters)
            .then(response => {
                const usuarios = response.result;
                mostrarUsuarios(usuarios);
            })

    },
    exportToPDF: () => {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Obtener la fecha actual
        const fecha = new Date().toLocaleDateString('es-AR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });

        //Agregar la fecha al Pdf
        doc.setFontSize(10);
        doc.text(`Fecha: ${fecha}`, 160, 10);

        doc.autoTable({
            html: '#tablaUsuarios',
            theme: 'grid',
            headStyles: { fillColor: [41, 128, 185] },
            margin: { top: 20 },
        });
        doc.output('dataurlnewwindow');
    },
    resetForm: () => {
        //esto carga de nuevo el usuario que habia en la pagina, haciendo uso de la url
        const params = new URLSearchParams(window.location.search);
        const urlFinal = params.get("id");
        userController.load(parseInt(urlFinal));
        userController.enableForm(false);
    },
    enableForm: (estado) => {
        let listaBotones = document.querySelectorAll('.control');
        let botonActualizar = document.getElementById("btnActualizar");
        let botonCancelarEdicion = document.getElementById("btnCancelarEdicion");



        if (estado) {
            botonActualizar.disabled = false;
            botonCancelarEdicion.disabled = false;
            listaBotones.forEach(boton => {
                boton.disabled = false;
            });
        } else {
            botonActualizar.disabled = true;
            botonCancelarEdicion.disabled = true;
            listaBotones.forEach(boton => {
                boton.disabled = true;
            });
        }
    },
}

function mostrarUsuarios(usuarios) {
    let tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.innerHTML = '';

    for (let i = 0; i < usuarios.length; i++) {
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

function capturarDatosUsuarioSave() {


    const dtApellido = document.getElementById("datoApellido").value.trim();
    const dtNombre = document.getElementById("datoNombre").value.trim();
    const dtCuenta = document.getElementById("datoCuenta").value.trim();
    const dtPerfil = document.getElementById("perfilAdministrador");
    const dtCorreo = document.getElementById("datoCorreo").value.trim();
    const dtClave = document.getElementById("datoClave").value.trim();
    const dtConfirmacionClave = document.getElementById("datoConfirmarClave").value.trim();


    let claveFinal = '';
    if (dtClave === dtConfirmacionClave) {
        claveFinal = dtConfirmacionClave;
        console.log("la clave se guardó correctamente");
    } else {
        console.log("las claves son diferentes")
    }

    const perfilSeleccionado = document.querySelector('input[name="datoPerfil"]:checked');

    console.log("perfil ->>>>: ", perfilSeleccionado.value)

    let dtPerfilFinal = '';
    switch (perfilSeleccionado?.value) {
        case 'administrador':
            dtPerfilFinal = 1;
            break;
        case 'operador':
            dtPerfilFinal = 2;
            break;
        case 'externo':
            dtPerfilFinal = 3;
            break;
        default:
            console.error('No se seleccionó un perfil válido');
            return null;
    }

    let usuario = {
        idPerfil: dtPerfilFinal,
        apellido: dtApellido,
        nombre: dtNombre,
        cuenta: dtCuenta,
        estado: 1,
        password: claveFinal,
        correo: dtCorreo,
        resetPassword: 0
    }


    console.table(usuario)
    return usuario;
}