import { authenticationController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("autenticación index.js cargado");

    const formLogin = document.getElementById("formLogin");

    if (formLogin) {
        formLogin.addEventListener("submit", async (event) => {
            event.preventDefault();

            const email = document.getElementById("datoCorreo")?.value.trim();
            const password = document.getElementById("datoPassword")?.value.trim();

            if (!email || !password) {
                alert("Correo y contraseña son requeridos.");
                return;
            }

            try {
                await authenticationController.login(email, password);
            } catch (error) {
                alert(error.message || "Error al iniciar sesión.");
            }
        });
    }
});
