import { authenticationController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("autenticación index.js cargado");

    const registroExitoso = new URLSearchParams(window.location.search).get("registro");
    const toastElement = document.getElementById("toastRegistroExitoso");

    if (registroExitoso === "ok" && toastElement && typeof bootstrap !== "undefined") {
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
        window.history.replaceState({}, document.title, "/lab_prog_final_rasjido_daniel/public/authentication/index");
    }

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
