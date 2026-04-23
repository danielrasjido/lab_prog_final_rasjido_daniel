import { authenticationService } from "./service.js";

export const authenticationController = {
    login: async (email, password) => {
        try {
            await authenticationService.login(email, password);
            window.location.href = "/lab_prog_final_rasjido_daniel/public/home/index";
        } catch (error) {
            throw error;
        }
    },

    logout: async () => {
        try {
            await authenticationService.logout();
        } catch (error) {
            console.error("Error al cerrar sesión:", error);
        }
    },

    registrarUsuario: async (usuario) => {
        try {
            await authenticationService.registrarUsuario(usuario);
            window.location.href = "/lab_prog_final_rasjido_daniel/public/authentication/index?registro=ok";
        } catch (error) {
            throw error;
        }
    },

    solicitarRecuperacionPassword: async (correo) => {
        try {
            await authenticationService.solicitarRecuperacionPassword(correo);
        } catch (error) {
            throw error;
        }
    },

    restablecerPassword: async (token, password, confirmacionPassword) => {
        try {
            await authenticationService.restablecerPassword(token, password, confirmacionPassword);
            window.location.href = "/lab_prog_final_rasjido_daniel/public/authentication/index?reset=ok";
        } catch (error) {
            throw error;
        }
    }
};
