import { authenticationController } from "./controller.js";

function capturarDatosRegistro() {
    const apellido = document.getElementById("datoApellido")?.value.trim();
    const nombre = document.getElementById("datoNombre")?.value.trim();
    const cuenta = document.getElementById("datoCuenta")?.value.trim();
    const correo = document.getElementById("datoCorreo")?.value.trim();
    const password = document.getElementById("datoClave")?.value.trim();
    const confirmacionPassword = document.getElementById("datoConfirmarClave")?.value.trim();

    return {
        apellido,
        nombre,
        cuenta,
        correo,
        password,
        confirmacionPassword
    };
}

document.addEventListener("DOMContentLoaded", () => {
    const formRegistro = document.getElementById("formRegistroUsuarioExterno");

    if (!formRegistro) {
        return;
    }

    formRegistro.addEventListener("submit", async (event) => {
        event.preventDefault();

        const usuario = capturarDatosRegistro();

        if (!usuario.apellido || !usuario.nombre || !usuario.cuenta || !usuario.correo || !usuario.password || !usuario.confirmacionPassword) {
            alert("Todos los campos son obligatorios.");
            return;
        }

        if (usuario.password !== usuario.confirmacionPassword) {
            alert("Las contraseñas no coinciden.");
            return;
        }

        try {
            await authenticationController.registrarUsuario(usuario);
        } catch (error) {
            alert(error.message || "No fue posible registrar el usuario.");
        }
    });
});