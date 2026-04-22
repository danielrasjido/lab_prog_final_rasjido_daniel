<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="toastRegistroExitoso" class="toast text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Usuario registrado correctamente. Ya puede iniciar sesión.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

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
                        ¿No tienes cuenta? <a href="authentication/registrarUsuario">Crear cuenta</a>
                    </p>
                     <!-- CONTENEDOR DEMO -->
                    <div class="card bg-light border">
                        <div class="card-body">
                            <h6 class="card-title text-center mb-3">Cuenta demo (ADMINISTRADOR)</h6>

                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <span id="demoCorreoAdmin">admin@gmail.com</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copiarTexto('demoCorreoAdmin')">
                                    Copiar
                                </button>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span id="demoPasswordAdmin">123456789</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copiarTexto('demoPasswordAdmin')">
                                    Copiar
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <h6 class="card-title text-center mb-3">Cuenta demo (OPERADOR)</h6>

                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <span id="demoCorreoOperador">operador@gmail.com</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copiarTexto('demoCorreoOperador')">
                                    Copiar
                                </button>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span id="demoPasswordOperador">123456789</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copiarTexto('demoPasswordOperador')">
                                    Copiar
                                </button>
                            </div>
                        </div>


                        <div class="card-body">
                            <h6 class="card-title text-center mb-3">Cuenta demo (EXTERNO)</h6>

                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <span id="demoCorreoExterno">externo@gmail.com</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copiarTexto('demoCorreoExterno')">
                                    Copiar
                                </button>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span id="demoPasswordExterno">123456789</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copiarTexto('demoPasswordExterno')">
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