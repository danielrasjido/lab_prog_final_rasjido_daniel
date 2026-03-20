export const entradasService = {
    list: (filters = {}) => {
        return fetch("entradas/list",{
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(filters)
        })
    },
    disable: (idEntrada) => {
        return fetch(`entradas/disable/${idEntrada}`, {
            method: "GET"
        });
    },
    enable: (idEntrada) => {
        return fetch(`entradas/enable/${idEntrada}`, {
            method: "GET"
        });
    }
}