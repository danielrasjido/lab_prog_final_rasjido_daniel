<main>
    <form method="POST" autocomplete="off" id="formFuncion">

        <div class="mb-3">
            <label for="datoIdPelicula" class="form-label">Película</label>
            <select class="form-select" name="datoIdPelicula" id="datoIdPelicula" required>
                <option value="">Seleccione una película</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="datoIdSala" class="form-label">Sala</label>
            <select class="form-select" name="datoIdSala" id="datoIdSala" required>
                <option value="">Seleccione una sala</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="datoPrecio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" name="datoPrecio" id="datoPrecio" required>
        </div>

        <div class="mb-3">
            <label for="datoFecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="datoFecha" id="datoFecha" required>
        </div>

        <div class="mb-3">
            <label for="datoHora" class="form-label">Hora</label>
            <input type="time" class="form-control" name="datoHora" id="datoHora" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar función</button>
        <a class="btn btn-secondary" href="funciones/index">Volver a funciones</a>
    </form>
</main>