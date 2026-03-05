<div>Bienvenidooooooo al modulo usuarioooo</div>


<nav class="navbar bg-body-tertiary">
    <div class="container-fluid ">
        <form action="" class="d-inline-flex align-items-center gap-2">
            <button class="btn btn-primary">Filtros</button>
            <a href="usuario/create" class="btn btn-primary flex-fill text-nowrap">Alta de una nueva cuenta</a>
            <button id="btnGenerarPDF" class="btn btn-primary flex-fill text-nowrap" type="button">Exportar listado a PDF</button>
            <input class="form-control flex-fill text-nowrap" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-primary flex-fill text-nowrap" type="submit">Buscar usuario</button>
        </form>

    </div>

</nav>


<table id="tablaUsuarios" class="table">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Cuenta</th>
            <th>Perfil</th>
            <th>Correo</th>
            <th>Estado de la cuenta</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody id="cuerpoDeLaTabla">

        <tr>
        <td>nombre del usuario</td>
        <td>nombre de la cuenta</td>
        <td>aca debe ir el tipo de perfil en string</td>
        <td>correo@gmail.com</td>
        <td>Activo / Inactivo</td>
        <td>
            <button class="btn btn-primary">Modificar</button>
            <button class="btn btn-danger">Eliminar</button>
        </td>
        </tr>

        <tr>
            <td>Juan Perez</td>
            <td>Cuenta de Juan</td>
            <td>Administrador</td>
            <td>juan.perez@gmail.com</td>
            <td>Activo</td>
            <td>
                <button class="btn btn-primary">Modificar</button>
                <button class="btn btn-danger">Eliminar</button>
            </td>
        </tr>
        
        <tr>
            <td>Helena Gomez</td>
            <td>Cuenta de Helena</td>
            <td>Usuario</td>
            <td>helena.gomez@gmail.com</td>
            <td>Inactivo</td>
            <td>
                <button class="btn btn-primary">Modificar</button>
                <button class="btn btn-danger">Eliminar</button>
            </td>
        </tr>
        
    </tbody>
</table>