<h1>Modulo funciones</h1>

<nav class="navbar bg-body-tertiary">
    <div class="container-fluid ">
        <form id="formBusqueda" action="" class="d-inline-flex align-items-center gap-2">
            <a href="peliculas/create" class="btn btn-primary flex-fill text-nowrap">Ingresar función</a>
            <button id="btnGenerarPDF" class="btn btn-primary flex-fill text-nowrap" type="button">Generar reporte</button>
            <input id="datoBusqueda" class="form-control flex-fill text-nowrap" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-primary flex-fill text-nowrap" type="submit">Buscar pelicula</button>
        </form>

    </div>

</nav>

<table id="tablaFunciones" class="table table-striped text-center">
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