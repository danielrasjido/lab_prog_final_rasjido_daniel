<nav class="navbar bg-body-tertiary">
    <div class="container-fluid ">
        <form id="formBusqueda" action="" class="d-inline-flex align-items-center gap-2">
            <button type="button" class="btn btn-primary" id="btnCrearSala">Crear sala</button>

            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Crear sala</strong>
                        <small>Alta</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <div class="mb-3">
                            <label for="datoCapacidadSala" class="form-label">Capacidad</label>
                            <input type="number" min="1" class="form-control" id="datoCapacidadSala" placeholder="Ingrese la capacidad de la sala">
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="btnGuardarSalaToast">Guardar sala</button>
                        </div>
                    </div>
                </div>
            </div>
            <button id="btnGenerarPDF" class="btn btn-primary flex-fill text-nowrap" type="button">Generar reporte</button>
        </form>

    </div>

</nav>
<div class="card shadow-sm mt-4">
    <div class="card-body px-3 px-md-4 m-1">
        <div class="table-responsive rounded overflow-hidden border">
            <table id="tablaSalas" class="table table-striped text-center align-middle mb-0">
    <thead>
        <tr>
            <th>Nro de sala</th>
            <th>Capacidad</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody id="cuerpoDeLaTabla">



    </tbody>
            </table>
        </div>
    </div>
</div>