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
}