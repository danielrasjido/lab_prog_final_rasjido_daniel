<nav class="navbar bg-body-tertiary">
    <div class="container-fluid ">
        <form id="formBusqueda" action="" class="d-inline-flex align-items-center gap-2">

            <a href="peliculas/create" class="btn btn-primary flex-fill text-nowrap">Ingresar pelicula</a>
            <button id="btnGenerarPDF" class="btn btn-primary flex-fill text-nowrap" type="button">Exportar listado a PDF</button>
            <input id="datoBusqueda" class="form-control flex-fill text-nowrap" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-primary flex-fill text-nowrap" type="submit">Buscar pelicula</button>
        </form>

    </div>

</nav>
<div class="card shadow-sm mt-4">
    <div class="card-body px-3 px-md-4 m-1">
        <div class="table-responsive rounded overflow-hidden border">
            <table id="tablaPeliculas" class="table table-striped text-center align-middle mb-0">
    <thead>
        <tr>
            <th>Id pelicula</th>
            <th>IMAGEN</th>
            <th>Nombre</th>
            <th>Reparto</th>
            <th>Sinopsis</th>
            <th>duración</th>
            <th>Genero</th>
            <th>Idiomas</th>
            <th>Pais</th>
            <th>Calificacion</th>
            <th>Titulo original</th>
            <th>Sitio web</th>
            <th>Fecha de estreno</th>
            <th>Fecha de ingreso</th>
            <th>Disponibilidad</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody id="cuerpoDeLaTabla">

     
        
    </tbody>
            </table>
        </div>
    </div>
</div>