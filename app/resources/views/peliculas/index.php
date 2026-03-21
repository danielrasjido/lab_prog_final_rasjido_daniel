<div>Bienvenidooooooo al modulo  de peliculas</div>

<h1>PELICUALS</h1>
<nav class="navbar bg-body-tertiary">
    <div class="container-fluid ">
        <form id="formBusqueda" action="" class="d-inline-flex align-items-center gap-2">
            <button class="btn btn-primary">Filtros</button>
            <a href="usuario/create" class="btn btn-primary flex-fill text-nowrap">Alta de una nueva cuenta</a>
            <button id="btnGenerarPDF" class="btn btn-primary flex-fill text-nowrap" type="button">Exportar listado a PDF</button>
            <input id="datoBusqueda" class="form-control flex-fill text-nowrap" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-primary flex-fill text-nowrap" type="submit">Buscar usuario</button>
        </form>

    </div>

</nav>


<table id="tablaPeliculas" class="table table-striped text-center">
    <thead>
        <tr>
            <th>id pelicula</th>
            <th>Cuenta</th>
            <th>Perfil</th>
            <th>Correo</th>
            <th>Estado de la cuenta</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody id="cuerpoDeLaTabla">

     
        
    </tbody>
</table>