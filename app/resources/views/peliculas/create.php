<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-7">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <form method="POST" autocomplete="off" id="formPelicula">

                        <div class="mb-3">
                            <label for="datoNombrePelicula" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="datoNombrePelicula" id="datoNombrePelicula" required>
                        </div>

                        <div class="mb-3">
                            <label for="datoArchivoImagenCartelera" class="form-label">Cargar imagen de cartelera</label>
                            <input type="file" class="form-control" id="datoArchivoImagenCartelera" accept="image/*" required>
                            <div class="form-text">Puedes usar URL o subir un archivo. Si subes archivo, se usará esa imagen.</div>
                        </div>

                        <div class="mb-3">
                            <img id="previewImagenCartelera" src="" alt="Vista previa de imagen" class="img-fluid rounded d-none" style="max-height: 220px;">
                        </div>

                        <div class="mb-3">
                            <label for="datoActores" class="form-label">Actores</label>
                            <input type="text" class="form-control" name="datoActores" id="datoActores">
                        </div>

                        <div class="mb-3">
                            <label for="datoSinopsis" class="form-label">Sinopsis</label>
                            <textarea class="form-control" name="datoSinopsis" id="datoSinopsis" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="datoDuracion" class="form-label">Duración (minutos)</label>
                            <input type="number" class="form-control" name="datoDuracion" id="datoDuracion">
                        </div>

                        <div class="mb-3">
                            <label for="datoGenero" class="form-label">Género</label>
                            <input type="text" class="form-control" name="datoGenero" id="datoGenero">
                        </div>

                        <div class="mb-3">
                            <label for="datoIdiomas" class="form-label">Idiomas</label>
                            <input type="text" class="form-control" name="datoIdiomas" id="datoIdiomas">
                        </div>

                        <div class="mb-3">
                            <label for="datoPais" class="form-label">País</label>
                            <input type="text" class="form-control" name="datoPais" id="datoPais">
                        </div>

                        <div class="mb-3">
                            <label for="datoCalificacion" class="form-label">Calificación</label>
                            <input type="number" step="0.1" class="form-control" name="datoCalificacion" id="datoCalificacion">
                        </div>

                        <div class="mb-3">
                            <label for="datoTituloOriginal" class="form-label">Título Original</label>
                            <input type="text" class="form-control" name="datoTituloOriginal" id="datoTituloOriginal">
                        </div>

                        <div class="mb-3">
                            <label for="datoSitioWeb" class="form-label">Sitio Web</label>
                            <input type="url" class="form-control" name="datoSitioWeb" id="datoSitioWeb">
                        </div>

                        <div class="mb-3">
                            <label for="datoFechaEstreno" class="form-label">Fecha de Estreno</label>
                            <input type="date" class="form-control" name="datoFechaEstreno" id="datoFechaEstreno">
                        </div>

                        <div class="mb-3">
                            <label for="datoFechaIngreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" class="form-control" name="datoFechaIngreso" id="datoFechaIngreso">
                        </div>

                        <div class="mb-3">
                            <label for="datoDisponibilidad" class="form-label">Disponibilidad</label>
                            <select class="form-control" name="datoDisponibilidad" id="datoDisponibilidad">
                                <option value="1">Disponible</option>
                                <option value="0">No disponible</option>
                            </select>
                        </div>

                        <div class="d-flex flex-column flex-md-row gap-2">
                            <button type="button" id="btnGuardarPelicula" class="btn btn-primary">Guardar película</button>
                            <a class="btn btn-secondary" href="peliculas/index">Volver a películas</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>