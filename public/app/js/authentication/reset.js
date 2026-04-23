import { authenticationController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formRestablecerPassword");
    if (!form) {
        return;
    }

    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const token = document.getElementById("datoTokenRecuperacion")?.value.trim() || "";
        const password = document.getElementById("datoNuevaPassword")?.value.trim() || "";
        const confirmacionPassword = document.getElementById("datoConfirmacionNuevaPassword")?.value.trim() || "";

        if (!token) {
            alert("El enlace de recuperacion no es valido.");
            return;
        }

        if (!password || !confirmacionPassword) {
            alert("Debes completar ambos campos de contrasena.");
            return;
        }

        if (password !== confirmacionPassword) {
            alert("Las contrasenas no coinciden.");
            return;
        }

        try {
            await authenticationController.restablecerPassword(token, password, confirmacionPassword);
        } catch (error) {
            alert(error.message || "No se pudo restablecer la contrasena.");
        }
    });
});