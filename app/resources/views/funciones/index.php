<nav class="navbar bg-body-tertiary">
    <div class="container-fluid ">
        <form id="formBusqueda" action="" class="d-inline-flex align-items-center gap-2">
            <a href="funciones/create" class="btn btn-primary flex-fill text-nowrap">Generar función</a>
            <button id="btnGenerarPDF" class="btn btn-primary flex-fill text-nowrap" type="button">Generar reporte</button>
        </form>

    </div>

</nav>
<div class="card shadow-sm mt-4">
    <div class="card-body px-3 px-md-4 m-1">
        <div class="table-responsive rounded overflow-hidden border">
            <table id="tablaFunciones" class="table table-striped text-center align-middle mb-0">
    <thead>
        <tr>
            <th>Nro de función</th>
            <th>Nro de programación</th>
            <th>Pelicula</th>
            <th>Sala</th>
            <th>Precio</th>
            <th>Fecha</th>
            <th>Hora</th>
        </tr>
    </thead>
    <tbody id="cuerpoDeLaTabla">



    </tbody>
            </table>
        </div>
    </div>
</div>