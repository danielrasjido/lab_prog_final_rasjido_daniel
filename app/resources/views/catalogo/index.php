<div class="container py-4">
    <div class="mb-4">
        <h1 class="h2">Catalogo</h1>
        <p class="text-muted mb-0">Explora películas, funciones disponibles y tus entradas.</p>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-7">
            <section class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="h5">Películas disponibles</h2>
                    <div id="catalogoPeliculas" class="mt-3"></div>
                </div>
            </section>
        </div>

        <div class="col-12 col-lg-5">
            <section class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="h5">Detalle de la película</h2>
                    <div id="catalogoDetalle" class="mt-3 text-muted">
                        Selecciona una película para ver funciones, comentarios y compra de entradas.
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="container py-4">
    <div class="mb-4">
        <h1 class="h2 mb-1">Catálogo</h1>
        <p class="text-muted mb-0">Explora películas, revisa funciones por día y compra tu entrada.</p>
    </div>

    <div class="row g-4">
        <!-- COLUMNA IZQUIERDA: LISTA DE PELICULAS -->
        <div class="col-12 col-lg-4">
            <section class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="h5 mb-3">Películas disponibles</h2>

                    <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active">
                            <div class="d-flex justify-content-between">
                                <strong>Interestelar</strong>
                                <span class="badge text-bg-primary">4 funciones</span>
                            </div>
                            <small class="text-light">Ciencia ficción • 169 min</small>
                        </button>

                        <button type="button" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <strong>El origen</strong>
                                <span class="badge text-bg-secondary">3 funciones</span>
                            </div>
                            <small class="text-muted">Thriller • 148 min</small>
                        </button>

                        <button type="button" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <strong>Duna</strong>
                                <span class="badge text-bg-secondary">5 funciones</span>
                            </div>
                            <small class="text-muted">Aventura • 155 min</small>
                        </button>
                    </div>
                </div>
            </section>
        </div>

        <!-- COLUMNA DERECHA: DETALLE + FUNCIONES -->
        <div class="col-12 col-lg-8">
            <section class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <img src="https://via.placeholder.com/280x420" class="img-fluid rounded" alt="Poster">
                        </div>
                        <div class="col-12 col-md-8">
                            <h3 class="h4 mb-1">Interestelar</h3>
                            <p class="text-muted mb-2">Ciencia ficción • 169 min • +13</p>
                            <p class="mb-0">
                                Un equipo de exploradores viaja a través de un agujero de gusano en el espacio para
                                asegurar el futuro de la humanidad.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- FUNCIONES AGRUPADAS POR DIA -->
            <section class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="h5 mb-3">Funciones</h4>

                    <div class="mb-4">
                        <h5 class="h6 text-uppercase text-muted mb-2">Lunes 21/04</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-outline-primary">16:00 • Sala 2 • $3500 • Comprar</button>
                            <button class="btn btn-outline-primary">18:15 • Sala 1 • $3500 • Comprar</button>
                            <button class="btn btn-outline-primary">20:30 • Sala 3 • $4000 • Comprar</button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="h6 text-uppercase text-muted mb-2">Martes 22/04</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-outline-primary">17:00 • Sala 2 • $3500 • Comprar</button>
                            <button class="btn btn-outline-primary">19:15 • Sala 1 • $3500 • Comprar</button>
                        </div>
                    </div>

                    <div>
                        <h5 class="h6 text-uppercase text-muted mb-2">Miércoles 23/04</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-outline-primary">16:45 • Sala 3 • $4000 • Comprar</button>
                            <button class="btn btn-outline-primary">21:00 • Sala 1 • $3500 • Comprar</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- COMENTARIOS -->
            <section class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="h5 mb-3">Comentarios</h4>

                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between">
                            <strong>Lucía R.</strong>
                            <small class="text-muted">18/04/2026 20:35</small>
                        </div>
                        <p class="mb-0">Excelente película, muy emotiva y con gran banda sonora.</p>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between">
                            <strong>Tomás G.</strong>
                            <small class="text-muted">17/04/2026 22:10</small>
                        </div>
                        <p class="mb-0">Visualmente increíble, volvería a verla en sala.</p>
                    </div>

                    <form>
                        <label for="nuevoComentario" class="form-label">Comparte tu opinión</label>
                        <textarea id="nuevoComentario" class="form-control mb-2" rows="3" placeholder="Escribe tu comentario..."></textarea>
                        <button type="button" class="btn btn-primary">Publicar comentario</button>
                    </form>
                </div>
            </section>

            <!-- MIS ENTRADAS -->
            <section class="card shadow-sm">
                <div class="card-body">
                    <h4 class="h5 mb-3">Mis entradas</h4>

                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>Película</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Sala</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Interestelar</td>
                                    <td>22/04/2026</td>
                                    <td>19:15</td>
                                    <td>1</td>
                                    <td><span class="badge text-bg-success">Vigente</span></td>
                                </tr>
                                <tr>
                                    <td>Duna</td>
                                    <td>25/04/2026</td>
                                    <td>21:00</td>
                                    <td>3</td>
                                    <td><span class="badge text-bg-success">Vigente</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</div>