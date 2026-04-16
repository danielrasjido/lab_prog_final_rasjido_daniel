<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h3 class="card-title text-center mb-4">Iniciar sesión</h3>
                    <form id="formLogin">
                        <div class="mb-3">
                            <label for="datoCorreo" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="datoCorreo" name="datoCorreo" required>
                        </div>
                        <div class="mb-3">
                            <label for="datoPassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="datoPassword" name="datoPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                    </form>
                    <hr>
                    <p class="text-center mb-0">
                        ¿No tienes cuenta? <a href="#">Contacta al administrador</a>
                    </p>
                     <!-- CONTENEDOR DEMO -->
                    <div class="card bg-light border">
                        <div class="card-body">
                            <h6 class="card-title text-center mb-3">Cuenta demo (Administrador)</h6>

                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <span id="demoCorreo">admin@gmail.com</span>
                                <button class="btn btn-sm btn-outline-secondary" onclick="copiarTexto('demoCorreo')">
                                    Copiar
                                </button>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span id="demoPassword">123456789</span>
                                <button class="btn btn-sm btn-outline-secondary" onclick="copiarTexto('demoPassword')">
                                    Copiar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script id="p9y5kq">
function copiarTexto(idElemento) {
    const texto = document.getElementById(idElemento).innerText;

    navigator.clipboard.writeText(texto)
        .then(() => {
            console.log("Copiado al portapapeles");
        })
        .catch(err => {
            console.error("Error al copiar: ", err);
        });
}
</script>