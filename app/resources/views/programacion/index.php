<h1>MODULO PROGRAMACION</h1>

<nav class="navbar bg-body-tertiary">
    <div class="container-fluid ">
        <form id="formBusqueda" action="" class="d-inline-flex align-items-center gap-2">
            <!-- <a href="peliculas/create" class="btn btn-primary flex-fill text-nowrap">Crear programacion</a> -->

            <button id="btnGenerarPDF" class="btn btn-primary flex-fill text-nowrap" type="button">Generar Informe</button>

            <button type="button" class="btn btn-primary" id="btnCrearProgramacion">Crear programacion</button>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Nueva programación</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <div class="mb-2">
                            <label for="datoFechaInicioProgramacion" class="form-label mb-1">Fecha de inicio</label>
                            <input id="datoFechaInicioProgramacion" type="date" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="datoEstadoProgramacion" class="form-label mb-1">Tipo</label>
                            <select id="datoEstadoProgramacion" class="form-control">
                                <option value="3">Programada</option>
                                <option value="4">Vigente Excepción</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button id="btnGuardarProgramacionToast" type="button" class="btn btn-success">Guardar programación</button>
                        </div>
                    </div>
                </div>
            </div>
        
        </form>

    </div>


</nav>


<table id="tablaProgramaciones" class="table table-striped text-center">
    <thead>
        <tr>
            <th>Id programacion</th>
            <th>Fecha de inicio</th>
            <th>Fecha fin</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody id="cuerpoDeLaTabla">



    </tbody>
</table>