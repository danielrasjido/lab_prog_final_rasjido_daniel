<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h3 class="card-title text-center mb-2">Recuperar contrasena</h3>
                    <p class="text-center text-muted mb-4">Ingresa tu correo y te enviaremos un enlace para restablecerla.</p>

                    <form id="formRecuperarPassword">
                        <div class="mb-4">
                            <label for="datoCorreoRecuperacion" class="form-label">Correo electronico</label>
                            <input type="email" class="form-control" id="datoCorreoRecuperacion" name="datoCorreoRecuperacion" required maxlength="64">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Enviar enlace</button>
                            <a class="btn btn-outline-primary" href="authentication/index">Volver al login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>