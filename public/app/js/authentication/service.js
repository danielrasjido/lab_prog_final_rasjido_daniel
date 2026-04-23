const request = async (url, options = {}) => {
    const response = await fetch(url, {
        ...options,
        headers: {
            "Content-Type": "application/json"
        }
    });
    
    if (!response.ok) {
        throw new Error("Error HTTP: " + response.status);
    }

    const data = await response.json();

    if (data.error) {
        throw new Error(data.error || data.message || "Error en la API");
    }

    return data.result;
};

export const authenticationService = {
    login: (email, password) => {
        return request("authentication/login", {
            method: "POST",
            body: JSON.stringify({
                email: email,
                password: password
            })
        });
    },

    registrarUsuario: (usuario) => {
        return request("authentication/registrarUsuario", {
            method: "POST",
            body: JSON.stringify(usuario)
        });
    },

    solicitarRecuperacionPassword: (correo) => {
        return request("authentication/recuperarPassword", {
            method: "POST",
            body: JSON.stringify({ correo })
        });
    },

    restablecerPassword: (token, password, confirmacionPassword) => {
        return request("authentication/restablecerPassword", {
            method: "POST",
            body: JSON.stringify({ token, password, confirmacionPassword })
        });
    },

    logout: () => {
        return request("authentication/logout", {
            method: "GET"
        });
    }
};
