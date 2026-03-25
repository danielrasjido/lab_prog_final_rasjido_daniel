<div>Bienvenidooooooo al modulo  de peliculas</div>

<h1>PELICUALS</h1>
<nav class="navbar bg-body-tertiary">
    <div class="container-fluid ">
        <form id="formBusqueda" action="" class="d-inline-flex align-items-center gap-2">
            <button class="btn btn-primary">Filtros</button>
            <a href="usuario/create" class="btn btn-primary flex-fill text-nowrap">Ingresar pelicula</a>
            <button id="btnGenerarPDF" class="btn btn-primary flex-fill text-nowrap" type="button">Exportar listado a PDF</button>
            <input id="datoBusqueda" class="form-control flex-fill text-nowrap" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-primary flex-fill text-nowrap" type="submit">Buscar pelicula</button>
        </form>

    </div>

</nav>


<table id="tablaPeliculas" class="table table-striped text-center">
    <thead>
        <tr>
            <th>Id pelicula</th>
            <th>Nombre</th>
            <th>IMAGEN</th>
            <th>Titulo original</th>
            <th>duración</th>
            <th>Fecha de estreno</th>
            <th>Fecha de ingreso</th>
            <th>Sitio web</th>
            <th>Sinopsis</th>
            <th>imagen cartelera</th>
            <th>Reparto</th>
            <th>Genero</th>
            <th>Pais</th>
            <th>Idiomas</th>
            <th>Calificacion</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody id="cuerpoDeLaTabla">

     
        
    </tbody>
</table>