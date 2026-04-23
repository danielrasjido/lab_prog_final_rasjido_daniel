import { authenticationController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formRecuperarPassword");
    if (!form) {
        return;
    }

    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const correo = document.getElementById("datoCorreoRecuperacion")?.value.trim() || "";
        if (!correo) {
            alert("Debes ingresar un correo electronico.");
            return;
        }

        try {
            await authenticationController.solicitarRecuperacionPassword(correo);
            alert("Si el correo existe, se envio un enlace de recuperacion.");
            form.reset();
        } catch (error) {
            alert(error.message || "No fue posible enviar el correo de recuperacion.");
        }
    });
});