<div id="contenedor1">
    <?php
        $idPerfilSesion = (int)($_SESSION['idPerfil'] ?? 0);
        $esAdmin = $idPerfilSesion === APP_PERFIL_ADMIN;
        $esOperador = $idPerfilSesion === APP_PERFIL_OPERADOR;
        $esExterno = $idPerfilSesion === APP_PERFIL_EXTERNO;
    ?>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if ($esAdmin || $esOperador || $esExterno): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home">Home</a>
                        </li>
                    <?php endif; ?>

                    <?php if ($esAdmin): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="usuario">Usuarios</a>
                        </li>
                    <?php endif; ?>

                    <?php if (!$esExterno): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="comentarios">Comentarios</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="entradas">Entradas</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="funciones">Funciones</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="peliculas">Peliculas</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="programacion">Programacion</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="salas">Salas</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="catalogo">Catalogo</a>
                    </li>

                </ul>
                <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-success" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>
</div>