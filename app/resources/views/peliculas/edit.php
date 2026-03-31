<main>
    <form method="POST" autocomplete="off" id="formPelicula">

        <div class="mb-3">
            <label for="datoNombrePelicula" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="datoNombrePelicula" id="datoNombrePelicula" required disabled>
        </div>

        <div class="mb-3">
            <label for="datoImagenCartelera" class="form-label">Imagen Cartelera (URL)</label>
            <input type="text" class="form-control" name="datoImagenCartelera" id="datoImagenCartelera" disabled>
        </div>

        <div class="mb-3">
            <label for="datoActores" class="form-label">Actores</label>
            <input type="text" class="form-control" name="datoActores" id="datoActores" disabled>
        </div>

        <div class="mb-3">
            <label for="datoSinopsis" class="form-label">Sinopsis</label>
            <textarea class="form-control" name="datoSinopsis" id="datoSinopsis" rows="3" disabled></textarea>
        </div>

        <div class="mb-3">
            <label for="datoDuracion" class="form-label">Duración (minutos)</label>
            <input type="number" class="form-control" name="datoDuracion" id="datoDuracion" disabled>
        </div>

        <div class="mb-3">
            <label for="datoGenero" class="form-label">Género</label>
            <input type="text" class="form-control" name="datoGenero" id="datoGenero" disabled>
        </div>

        <div class="mb-3">
            <label for="datoIdiomas" class="form-label">Idiomas</label>
            <input type="text" class="form-control" name="datoIdiomas" id="datoIdiomas" disabled>
        </div>

        <div class="mb-3">
            <label for="datoPais" class="form-label">País</label>
            <input type="text" class="form-control" name="datoPais" id="datoPais" disabled>
        </div>

        <div class="mb-3">
            <label for="datoCalificacion" class="form-label">Calificación</label>
            <input type="number" step="0.1" class="form-control" name="datoCalificacion" id="datoCalificacion" disabled>
        </div>

        <div class="mb-3">
            <label for="datoTituloOriginal" class="form-label">Título Original</label>
            <input type="text" class="form-control" name="datoTituloOriginal" id="datoTituloOriginal" disabled>
        </div>

        <div class="mb-3">
            <label for="datoSitioWeb" class="form-label">Sitio Web</label>
            <input type="url" class="form-control" name="datoSitioWeb" id="datoSitioWeb" disabled>
        </div>

        <div class="mb-3">
            <label for="datoFechaEstreno" class="form-label">Fecha de Estreno</label>
            <input type="date" class="form-control" name="datoFechaEstreno" id="datoFechaEstreno" disabled>
        </div>

        <div class="mb-3">
            <label for="datoFechaIngreso" class="form-label">Fecha de Ingreso</label>
            <input type="date" class="form-control" name="datoFechaIngreso" id="datoFechaIngreso" disabled>
        </div>

        <div class="mb-3">
            <label for="datoDisponibilidad" class="form-label">Disponibilidad</label>
            <select class="form-control" name="datoDisponibilidad" id="datoDisponibilidad" disabled>
                <option value="1">Disponible</option>
                <option value="0">No disponible</option>
            </select>
        </div>

        <div class="mb-3">
        <button id="btnActualizar" type="submit" class="btn btn-primary" disabled>Actualizar</button>
        <a class="btn btn-primary" href="usuario/index">Volver</a>
        <button id="btnEditar" type="button" class="btn btn-primary">Editar</button>
        <button id="btnCancelarEdicion" class="btn btn-warning" disabled>Cancelar edición</button>
        <button type="button" id="btnEliminarRegistro" class="btn btn-danger">Eliminar registro actual</button>
        <button id="btnExportarUsuarioPDF" class="btn btn-primary" type="button">Exportar a PDF</button>
    </div>
    </form>
</main>