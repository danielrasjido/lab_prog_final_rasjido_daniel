
<nav class="navbar bg-body-tertiary">
    <div class="container-fluid ">
        <form id="formBusqueda" action="" class="d-inline-flex align-items-center gap-2">
            <a href="usuario/create" class="btn btn-primary flex-fill text-nowrap">Alta de una nueva cuenta</a>
            <button id="btnGenerarPDF" class="btn btn-primary flex-fill text-nowrap" type="button">Generar informe</button>
            <input id="datoBusqueda" class="form-control flex-fill text-nowrap" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-primary flex-fill text-nowrap" type="submit">Buscar usuario</button>
        </form>

    </div>

</nav>
<div class="card shadow-sm mt-4">
        <div class="card-body px-3 px-md-4 m-1">
            <div class="table-responsive rounded overflow-hidden border">
                <table id="tablaUsuarios" class="table table-striped text-center align-middle mb-0">
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
        
                
                </tbody>
            </table>
        </div>

    </div>

</div>