export function abrirInformeTabla({ tableSelector, title, excludeColumns = [], orientation = "landscape" }) {
    const tabla = document.querySelector(tableSelector);
    if (!tabla) {
        alert("No se encontro la tabla para generar el informe.");
        return;
    }

    const encabezadosOriginales = Array.from(tabla.querySelectorAll("thead th"));
    const cantidadColumnas = encabezadosOriginales.length;

    const encabezados = encabezadosOriginales
        .map((th, index) => ({ texto: normalizarTexto(th.textContent), index }))
        .filter((columna) => !excludeColumns.includes(columna.index))
        .map((columna) => columna.texto || "Columna");

    const filas = Array.from(tabla.querySelectorAll("tbody tr"))
        .map((fila) => {
            const celdas = Array.from(fila.children).slice(0, cantidadColumnas);

            return celdas
                .map((celda, index) => ({ valor: obtenerTextoCelda(celda), index }))
                .filter((celda) => !excludeColumns.includes(celda.index))
                .map((celda) => celda.valor);
        })
        .filter((fila) => fila.length > 0);

    if (filas.length === 0) {
        alert("No hay datos para generar el informe.");
        return;
    }

    try {
        const { jsPDF } = window.jspdf || {};

        if (!jsPDF) {
            throw new Error("La libreria jsPDF no esta disponible.");
        }

        const doc = new jsPDF({ orientation, unit: "mm", format: "a4" });
        const fecha = new Date().toLocaleDateString("es-AR", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric"
        });

        doc.setFontSize(16);
        doc.text(title, 14, 15);
        doc.setFontSize(10);
        doc.text(`Fecha: ${fecha}`, 14, 22);

        doc.autoTable({
            head: [encabezados],
            body: filas,
            startY: 28,
            theme: "grid",
            styles: {
                fontSize: 8,
                cellPadding: 2,
                overflow: "linebreak"
            },
            headStyles: {
                fillColor: [162, 37, 34]
            }
        });

        doc.output("dataurlnewwindow");
    } catch (error) {
        console.error("Error al generar reporte PDF. Se abrira fallback HTML.", error);
        abrirInformeHtml({ title, encabezados, filas });
    }
}

function abrirInformeHtml({ title, encabezados, filas }) {
    const fecha = new Date().toLocaleDateString("es-AR", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric"
    });

    const ventana = window.open("", "_blank");
    if (!ventana) {
        alert("El navegador bloqueo la nueva ventana del informe.");
        return;
    }

    const encabezadoHtml = encabezados.map((texto) => `<th>${escapeHtml(texto)}</th>`).join("");
    const filasHtml = filas
        .map((fila) => `<tr>${fila.map((celda) => `<td>${escapeHtml(celda)}</td>`).join("")}</tr>`)
        .join("");

    ventana.document.write(`
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>${escapeHtml(title)}</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 24px; color: #212529; }
                h1 { margin-bottom: 4px; }
                p { margin-top: 0; color: #555; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ccc; padding: 8px; text-align: left; font-size: 14px; }
                th { background: #a22522; color: #fff; }
                tr:nth-child(even) { background: #f8f9fa; }
            </style>
        </head>
        <body>
            <h1>${escapeHtml(title)}</h1>
            <p>Fecha: ${escapeHtml(fecha)}</p>
            <table>
                <thead>
                    <tr>${encabezadoHtml}</tr>
                </thead>
                <tbody>
                    ${filasHtml}
                </tbody>
            </table>
        </body>
        </html>
    `);
    ventana.document.close();
}

function escapeHtml(valor) {
    return String(valor || "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/\"/g, "&quot;")
        .replace(/'/g, "&#39;");
}

function obtenerTextoCelda(celda) {
    if (celda.querySelector("img")) {
        return "Imagen cargada";
    }

    const texto = normalizarTexto(celda.textContent);
    return texto || "-";
}

function normalizarTexto(valor) {
    return String(valor || "").replace(/\s+/g, " ").trim();
}