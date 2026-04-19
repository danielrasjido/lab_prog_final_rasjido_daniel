import { catalogoService } from "./service.js";

export const catalogoController = {
    peliculaSeleccionadaId: null,

    listPeliculas: async (filters = {}) => {
        const peliculas = await catalogoService.listPeliculas(filters);
        mostrarPeliculas(peliculas);

        if (peliculas.length > 0) {
            const primeraPeliculaId = Number(peliculas[0].idPelicula);
            catalogoController.peliculaSeleccionadaId = primeraPeliculaId;
            await catalogoController.cargarDetalle(primeraPeliculaId);
            actualizarPeliculaActiva(primeraPeliculaId);
            return;
        }

        mostrarEstadoSinPeliculas();
    },

    cargarDetalle: async (idPelicula) => {
        const detalle = await catalogoService.loadPelicula(idPelicula);
        mostrarDetalle(detalle);
    },

    comprarEntrada: async (idFuncion) => {
        await catalogoService.comprar(idFuncion);
        alert("Entrada comprada correctamente.");

        if (catalogoController.peliculaSeleccionadaId !== null) {
            await catalogoController.cargarDetalle(catalogoController.peliculaSeleccionadaId);
        }
    },

    publicarComentario: async () => {
        const textarea = document.getElementById("catalogoNuevoComentario");

        if (!textarea) {
            return;
        }

        const comentario = textarea.value.trim();
        if (catalogoController.peliculaSeleccionadaId === null) {
            alert("Debes seleccionar una película antes de comentar.");
            return;
        }

        if (comentario === "") {
            alert("Escribe un comentario antes de publicar.");
            return;
        }

        await catalogoService.comentar({
            idPelicula: catalogoController.peliculaSeleccionadaId,
            comentario
        });

        textarea.value = "";
        alert("Comentario publicado correctamente.");
        await catalogoController.cargarDetalle(catalogoController.peliculaSeleccionadaId);
    }
}


function mostrarPeliculas(peliculas) {
    const contenedor = document.getElementById("catalogoPeliculas");
    if (!contenedor) {
        return;
    }

    contenedor.innerHTML = "";

    peliculas.forEach((pelicula) => {
        const boton = document.createElement("button");
        boton.type = "button";
        boton.className = "list-group-item list-group-item-action";
        boton.dataset.id = String(pelicula.idPelicula);
        boton.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <strong>${escapeHtml(pelicula.nombre ?? "Sin titulo")}</strong>
                <span class="badge text-bg-primary">${pelicula.funcionesDisponibles ?? 0} funciones</span>
            </div>
            <small class="text-muted">${escapeHtml(pelicula.genero ?? "Genero no informado")} - ${pelicula.duracion ?? "-"} min</small>
        `;

        boton.addEventListener("click", async () => {
            const idPelicula = Number(pelicula.idPelicula);
            catalogoController.peliculaSeleccionadaId = idPelicula;
            actualizarPeliculaActiva(idPelicula);

            try {
                await catalogoController.cargarDetalle(idPelicula);
            } catch (error) {
                alert(error.message || "No se pudo cargar el detalle de la película.");
            }
        });

        contenedor.appendChild(boton);
    });
}

function actualizarPeliculaActiva(idPelicula) {
    const items = document.querySelectorAll("#catalogoPeliculas .list-group-item");

    items.forEach((item) => {
        item.classList.toggle("active", Number(item.dataset.id) === idPelicula);
    });
}

function mostrarEstadoSinPeliculas() {
    const contenedorPeliculas = document.getElementById("catalogoPeliculas");
    const contenedorDetalle = document.getElementById("catalogoDetalle");

    if (contenedorPeliculas) {
        contenedorPeliculas.innerHTML = "<p class='text-muted mb-0'>No hay películas disponibles en catálogo.</p>";
    }

    if (contenedorDetalle) {
        contenedorDetalle.innerHTML = "<p class='text-muted mb-0'>No hay información para mostrar.</p>";
    }
}

function mostrarDetalle(detalle) {
    const contenedor = document.getElementById("catalogoDetalle");
    if (!contenedor) {
        return;
    }

    const pelicula = detalle.pelicula ?? {};
    const funciones = Array.isArray(detalle.funciones) ? detalle.funciones : [];
    const comentarios = Array.isArray(detalle.comentarios) ? detalle.comentarios : [];

    const funcionesAgrupadas = agruparFuncionesPorDia(funciones);
    const funcionesHtml = construirFuncionesHtml(funcionesAgrupadas);
    const comentariosHtml = construirComentariosHtml(comentarios);
    const entradasHtml = construirMisEntradasHtml();

    contenedor.classList.remove("text-muted");
    contenedor.innerHTML = `
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <img src="${escapeHtml(pelicula.imagenCartelera || "https://via.placeholder.com/280x420?text=Poster")}" class="img-fluid rounded" alt="Poster de película">
                    </div>
                    <div class="col-12 col-md-8">
                        <h3 class="h4 mb-1">${escapeHtml(pelicula.nombre || "Sin titulo")}</h3>
                        <p class="text-muted mb-2">${escapeHtml(pelicula.genero || "Genero no informado")} - ${pelicula.duracion ?? "-"} min</p>
                        <p class="mb-0">${escapeHtml(pelicula.sinopsis || "Sinopsis no disponible")}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="h5 mb-3">Funciones</h4>
                ${funcionesHtml}
            </div>
        </section>

        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="h5 mb-3">Comentarios</h4>
                ${comentariosHtml}
                <form id="formCatalogoComentario">
                    <label for="catalogoNuevoComentario" class="form-label">Comparte tu opinión</label>
                    <textarea id="catalogoNuevoComentario" class="form-control mb-2" rows="3" placeholder="Escribe tu comentario..."></textarea>
                    <button type="submit" class="btn btn-primary">Publicar comentario</button>
                </form>
            </div>
        </section>

        <section class="card shadow-sm">
            <div class="card-body">
                <h4 class="h5 mb-3">Mis entradas</h4>
                ${entradasHtml}
            </div>
        </section>
    `;

    vincularEventosDetalle();
    cargarMisEntradas();
}

function agruparFuncionesPorDia(funciones) {
    const agrupadas = {};

    funciones.forEach((funcion) => {
        const fecha = funcion.fecha ?? "Sin fecha";
        if (!agrupadas[fecha]) {
            agrupadas[fecha] = [];
        }
        agrupadas[fecha].push(funcion);
    });

    return agrupadas;
}

function construirFuncionesHtml(funcionesAgrupadas) {
    const fechas = Object.keys(funcionesAgrupadas);

    if (fechas.length === 0) {
        return "<p class='text-muted mb-0'>No hay funciones disponibles para esta película.</p>";
    }

    return fechas.map((fecha) => {
        const funciones = funcionesAgrupadas[fecha];
        const fechaFormateada = formatearFecha(fecha);

        const botones = funciones.map((funcion) => `
            <button type="button" class="btn btn-outline-primary btnComprarFuncion" data-id-funcion="${funcion.idFuncion}">
                ${escapeHtml(funcion.hora)} - Sala ${escapeHtml(String(funcion.idSala ?? "-"))} - $${escapeHtml(String(funcion.precio ?? 0))} - Comprar
            </button>
        `).join("");

        return `
            <div class="mb-4">
                <h5 class="h6 text-uppercase text-muted mb-2">${escapeHtml(fechaFormateada)}</h5>
                <div class="d-flex flex-wrap gap-2">${botones}</div>
            </div>
        `;
    }).join("");
}

function construirComentariosHtml(comentarios) {
    if (comentarios.length === 0) {
        return "<p class='text-muted'>Aun no hay comentarios para esta película.</p>";
    }

    return comentarios.map((comentario) => `
        <div class="mb-3 pb-3 border-bottom">
            <div class="d-flex justify-content-between">
                <strong>${escapeHtml(comentario.nombreUsuario || "Usuario")}</strong>
                <small class="text-muted">${escapeHtml(formatearFechaHora(comentario.fechaHora || ""))}</small>
            </div>
            <p class="mb-0">${escapeHtml(comentario.comentario || "")}</p>
        </div>
    `).join("");
}

function construirMisEntradasHtml() {
    return `
        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead>
                    <tr>
                        <th>Película</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="catalogoMisEntradasBody">
                    <tr>
                        <td colspan="4" class="text-muted">Cargando entradas...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    `;
}

function vincularEventosDetalle() {
    const botonesComprar = document.querySelectorAll(".btnComprarFuncion");
    const formComentario = document.getElementById("formCatalogoComentario");

    botonesComprar.forEach((boton) => {
        boton.addEventListener("click", async () => {
            const idFuncion = Number(boton.dataset.idFuncion);

            if (!Number.isInteger(idFuncion) || idFuncion <= 0) {
                alert("La función seleccionada es inválida.");
                return;
            }

            try {
                await catalogoController.comprarEntrada(idFuncion);
            } catch (error) {
                alert(error.message || "No se pudo completar la compra.");
            }
        });
    });

    if (formComentario) {
        formComentario.addEventListener("submit", async (event) => {
            event.preventDefault();
            try {
                await catalogoController.publicarComentario();
            } catch (error) {
                alert(error.message || "No se pudo publicar el comentario.");
            }
        });
    }
}

async function cargarMisEntradas() {
    const tbody = document.getElementById("catalogoMisEntradasBody");
    if (!tbody) {
        return;
    }

    try {
        const entradas = await catalogoService.misEntradas();

        if (entradas.length === 0) {
            tbody.innerHTML = "<tr><td colspan='4' class='text-muted'>Aún no tienes entradas compradas.</td></tr>";
            return;
        }

        tbody.innerHTML = entradas.map((entrada) => `
            <tr>
                <td>${escapeHtml(entrada.nombrePelicula || "-")}</td>
                <td>${escapeHtml(formatearFecha(entrada.fecha || ""))}</td>
                <td>${escapeHtml(entrada.hora || "-")}</td>
                <td><span class="badge text-bg-success">Vigente</span></td>
            </tr>
        `).join("");
    } catch (error) {
        tbody.innerHTML = `<tr><td colspan='4' class='text-danger'>${escapeHtml(error.message || "No se pudieron cargar tus entradas.")}</td></tr>`;
    }
}

function formatearFecha(fecha) {
    if (!fecha) {
        return "-";
    }

    const partes = fecha.split("-");
    if (partes.length !== 3) {
        return fecha;
    }

    return `${partes[2]}/${partes[1]}/${partes[0]}`;
}

function formatearFechaHora(fechaHora) {
    if (!fechaHora) {
        return "-";
    }

    const [fecha, hora] = fechaHora.split(" ");
    return `${formatearFecha(fecha)} ${hora ?? ""}`.trim();
}

function escapeHtml(valor) {
    return String(valor)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/\"/g, "&quot;")
        .replace(/'/g, "&#39;");
}