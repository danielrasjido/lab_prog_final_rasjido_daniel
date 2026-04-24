import {peliculasService} from './service.js';


export const peliculasController = {
    initCreateForm: () => {
        const inputArchivo = document.getElementById("datoArchivoImagenCartelera");
        const inputImagen = document.getElementById("datoImagenCartelera");
        const preview = document.getElementById("previewImagenCartelera");

        if (!inputArchivo || !preview) {
            return;
        }

        inputArchivo.addEventListener("change", () => {
            const archivo = inputArchivo.files && inputArchivo.files[0] ? inputArchivo.files[0] : null;

            if (!archivo) {
                if (inputImagen && inputImagen.value.trim() !== "") {
                    preview.src = inputImagen.value.trim();
                    preview.classList.remove("d-none");
                } else {
                    preview.src = "";
                    preview.classList.add("d-none");
                }
                return;
            }

            if (!archivo.type.startsWith("image/")) {
                alert("El archivo seleccionado no es una imagen válida.");
                inputArchivo.value = "";
                return;
            }

            const reader = new FileReader();
            reader.onload = () => {
                preview.src = reader.result;
                preview.classList.remove("d-none");
            };
            reader.readAsDataURL(archivo);
        });

        if (inputImagen) {
            inputImagen.addEventListener("blur", () => {
                if (!preview) {
                    return;
                }

                const valor = inputImagen.value.trim();
                if (valor === "") {
                    return;
                }

                if (inputArchivo.files && inputArchivo.files.length > 0) {
                    return;
                }

                preview.src = valor;
                preview.classList.remove("d-none");
            });
        }
    },

    load: (id) => {
        peliculasService.load(id)
            .then(response => {
                const pelicula = response;
            
            if(!pelicula){
                console.error("no existe la pelicula")
                console.log(pelicula)
                //añadir toast
                return
            }

            document.getElementById("datoNombrePelicula").value = pelicula.nombre;
            document.getElementById("datoImagenCartelera").value = pelicula.imagenCartelera;
            document.getElementById("datoActores").value = pelicula.actores;
            document.getElementById("datoSinopsis").value = pelicula.sinopsis;
            document.getElementById("datoDuracion").value = pelicula.duracion;
            document.getElementById("datoGenero").value = pelicula.genero;
            document.getElementById("datoIdiomas").value = pelicula.idiomas;
            document.getElementById("datoPais").value = pelicula.pais;
            document.getElementById("datoCalificacion").value = pelicula.calificacion;
            document.getElementById("datoTituloOriginal").value = pelicula.tituloOriginal;
            document.getElementById("datoSitioWeb").value = pelicula.sitioWeb;
            document.getElementById("datoFechaEstreno").value = pelicula.fechaEstreno;
            document.getElementById("datoFechaIngreso").value = pelicula.fechaIngreso;
            document.getElementById("datoDisponibilidad").value = pelicula.disponibilidad;

            const preview = document.getElementById("previewImagenCartelera");
            if (preview && pelicula.imagenCartelera) {
                preview.src = pelicula.imagenCartelera;
                preview.classList.remove("d-none");
            }
            })
             .catch(error => {
            console.error("Error al cargar película:", error.message);
        });
    },
    save: async () => {
        const pelicula = await capturarDatosPelicula();
        if(!pelicula){
            console.error("no se pudo capturar la pelicula");
            return;
        }
        try {
            await peliculasService.save(pelicula);
            alert("Película guardada con éxito.");
        } catch (error) {
            alert(error.message || "No se pudo guardar la película.");
            throw error;
        }
    },
    update: async () => {
        const pelicula = await capturarDatosPeliculaUpdate();
        if(!pelicula){
            console.error("no se pudo capturar la pelicula");
            return;
        }
        try {
            await peliculasService.update(pelicula);
            alert("Película actualizada con éxito.");
            peliculasController.enableForm(false);
        } catch (error) {
            alert(error.message || "No se pudo actualizar la película.");
            throw error;
        }
    },
    disable: async (id) => {
        await peliculasService.disable(id);
        alert("Película deshabilitada correctamente.");
    },
    enable: async (id) => {
        await peliculasService.enable(id);
        alert("Película habilitada correctamente.");
    },
    list: async (filters) => {
        try {
            const resultado = await peliculasService.list(filters);
            const peliculas = Array.isArray(resultado)
                ? resultado
                : Object.values(resultado || {});

            mostrarPeliculas(peliculas);
        } catch (error) {
            console.error("Error al listar películas:", error.message || error);
            mostrarErrorListado(error.message || "No se pudieron listar las películas.");
        }
    },
    enableForm: (estado) => {
        let listaBotones = document.querySelectorAll('.form-control');
        let botonActualizar = document.getElementById("btnActualizar");
        let botonCancelarEdicion = document.getElementById("btnCancelarEdicion");


        console.log("lista de botones: ", listaBotones, listaBotones.length);


        if (estado) {
            botonActualizar.disabled = false;
            botonCancelarEdicion.disabled = false;
            listaBotones.forEach(boton => {
                boton.disabled = false;
            });
        } else {
            botonActualizar.disabled = true;
            botonCancelarEdicion.disabled = true;
            listaBotones.forEach(boton => {
                boton.disabled = true;
            });
        }
    },
    resetForm: () => {
        const url = window.location.pathname.split('/'); //devuelve la url divida en arraay
        
        const idFinal = url[url.length - 1]; //devuelve la ultima parte de la url, que es el id
        peliculasController.load(parseInt(idFinal));
        peliculasController.enableForm(false);
    }
}

function mostrarPeliculas(peliculas){
    console.log("mostrar peliculas")
    let tabla = document.getElementById("cuerpoDeLaTabla");
    if (!tabla) {
        return;
    }

    tabla.innerHTML = '';

    if (!Array.isArray(peliculas) || peliculas.length === 0) {
        tabla.innerHTML = `<tr><td colspan="16" class="text-muted">No hay películas para mostrar.</td></tr>`;
        return;
    }

    for (let i = 0; i < peliculas.length; i++) {
        console.log("bucle")
        console.log("mensaje bucle")
        console.log(i);
        //guardamos peli
        let p = peliculas[i];
        //creamos fila :)
        let tr = document.createElement("tr");
        //modificamos el contenido de la fila
        const imagenHtml = p.imagenCartelera
            ? `<img src="${escapeHtml(p.imagenCartelera)}" alt="Poster" style="max-height: 70px; max-width: 70px; object-fit: cover;" class="rounded">`
            : "Sin imagen";

        tr.innerHTML = `
            <td>${p.idPelicula}</td>
            <td>${imagenHtml}</td>
            <td>${p.nombre}</td>
            <td>${p.actores}</td>
            <td>${p.sinopsis}</td>
            <td>${p.duracion}</td>
            <td>${p.genero}</td>
            <td>${p.idiomas}</td>
            <td>${p.pais}</td>
            <td>${p.calificacion}</td>
            <td>${p.tituloOriginal}</td>
            <td>${p.sitioWeb}</td>
            <td>${p.fechaEstreno}</td>
            <td>${p.fechaIngreso}</td>
            <td>${Number(p.disponibilidad) === 1 ? "Disponible" : "No disponible"}</td>
            <td>
                <a href="peliculas/edit/${p.idPelicula}" class="btn btn-primary">Modificar</a>
                <button type="button" data-id-pelicula=${p.idPelicula} class="btn btn-warning btnDeshabilitar" ${Number(p.disponibilidad) === 1 ? '' : 'disabled'}>Deshabilitar</button>
                <button type="button" data-id-pelicula=${p.idPelicula} class="btn btn-success btnHabilitar" ${Number(p.disponibilidad) === 0 ? '' : 'disabled'}>Habilitar</button>
            </td>
        `;
        //insertamos la fila a la tabla
        tabla.appendChild(tr);
    }

    


}

function mostrarErrorListado(mensaje) {
    const tabla = document.getElementById("cuerpoDeLaTabla");
    if (!tabla) {
        return;
    }

    tabla.innerHTML = `<tr><td colspan="16" class="text-danger">${escapeHtml(mensaje)}</td></tr>`;
}

function escapeHtml(valor) {
    return String(valor)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/\"/g, "&quot;")
        .replace(/'/g, "&#39;");
}

async function capturarDatosPelicula(){

        const dtNombrePelicula = document.getElementById("datoNombrePelicula").value.trim();
        const dtImagenCartelera = await obtenerImagenCarteleraValue();
        const dtActores = document.getElementById("datoActores").value.trim();
        const dtSinopsis = document.getElementById("datoSinopsis").value.trim();
        const dtDuracion = document.getElementById("datoDuracion").value.trim();
        const dtGenero = document.getElementById("datoGenero").value.trim();
        const dtIdiomas = document.getElementById("datoIdiomas").value.trim();
        const dtPais = document.getElementById("datoPais").value.trim();
        const dtCalificacion = document.getElementById("datoCalificacion").value.trim();
        const dtTituloOriginal = document.getElementById("datoTituloOriginal").value.trim();
        const dtSitioWeb = document.getElementById("datoSitioWeb").value.trim();
        const dtFechaEstreno = document.getElementById("datoFechaEstreno").value.trim();
        const dtFechaIngreso = document.getElementById("datoFechaIngreso").value.trim();
        const dtDisponibilidad = parseInt(document.getElementById("datoDisponibilidad").value);

        let pelicula = {
            nombre: dtNombrePelicula,
            imagenCartelera: dtImagenCartelera,
            actores: dtActores,
            sinopsis: dtSinopsis,
            duracion: dtDuracion,
            genero: dtGenero,
            idiomas: dtIdiomas,
            pais: dtPais,
            calificacion: dtCalificacion,
            tituloOriginal: dtTituloOriginal,
            sitioWeb: dtSitioWeb,
            fechaEstreno: dtFechaEstreno,
            fechaIngreso: dtFechaIngreso,
            disponibilidad: dtDisponibilidad
        }

        if(!dtImagenCartelera){
            alert("Debes indicar una imagen de cartelera (URL o archivo).");
            return null;
        }

        return pelicula;

    }

    /**
     * Lo mismo que capturarDatosPelicula pero acá captura tambien el id
     * @returns 
     */
    async function capturarDatosPeliculaUpdate(){

        const urlId = window.location.pathname.split('/')
        const id = urlId[urlId.length - 1];

        const idPelicula = parseInt(id);
        const dtNombrePelicula = document.getElementById("datoNombrePelicula").value.trim();
        const dtImagenCartelera = await obtenerImagenCarteleraValue();
        const dtActores = document.getElementById("datoActores").value.trim();
        const dtSinopsis = document.getElementById("datoSinopsis").value.trim();
        const dtDuracion = document.getElementById("datoDuracion").value.trim();
        const dtGenero = document.getElementById("datoGenero").value.trim();
        const dtIdiomas = document.getElementById("datoIdiomas").value.trim();
        const dtPais = document.getElementById("datoPais").value.trim();
        const dtCalificacion = document.getElementById("datoCalificacion").value.trim();
        const dtTituloOriginal = document.getElementById("datoTituloOriginal").value.trim();
        const dtSitioWeb = document.getElementById("datoSitioWeb").value.trim();
        const dtFechaEstreno = document.getElementById("datoFechaEstreno").value.trim();
        const dtFechaIngreso = document.getElementById("datoFechaIngreso").value.trim();
        const dtDisponibilidad = parseInt(document.getElementById("datoDisponibilidad").value);

        let pelicula = {
            idPelicula: idPelicula,
            nombre: dtNombrePelicula,
            imagenCartelera: dtImagenCartelera,
            actores: dtActores,
            sinopsis: dtSinopsis,
            duracion: dtDuracion,
            genero: dtGenero,
            idiomas: dtIdiomas,
            pais: dtPais,
            calificacion: dtCalificacion,
            tituloOriginal: dtTituloOriginal,
            sitioWeb: dtSitioWeb,
            fechaEstreno: dtFechaEstreno,
            fechaIngreso: dtFechaIngreso,
            disponibilidad: dtDisponibilidad
        }

        if(!dtImagenCartelera){
            alert("Debes indicar una imagen de cartelera (URL o archivo).");
            return null;
        }

        return pelicula;

    }

function obtenerImagenCarteleraValue(){
    const inputArchivo = document.getElementById("datoArchivoImagenCartelera");
    const inputImagen = document.getElementById("datoImagenCartelera");

    const imagenUrl = inputImagen ? inputImagen.value.trim() : "";
    const archivo = inputArchivo && inputArchivo.files && inputArchivo.files.length > 0
        ? inputArchivo.files[0]
        : null;

    if (!archivo) {
        return Promise.resolve(imagenUrl);
    }

    return new Promise((resolve, reject) => {
        if (!archivo.type.startsWith("image/")) {
            reject(new Error("El archivo seleccionado no es una imagen válida."));
            return;
        }

        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = () => reject(new Error("No se pudo leer el archivo de imagen."));
        reader.readAsDataURL(archivo);
    });
}

/**
 
idPelicula
imagenCartelera
nombre
actores
sinopsis
duracion
genero
idiomas
pais
calificacion
tituloOriginal
sitioWeb
fechaEstreno
fechaIngreso
disponibilidad
 */