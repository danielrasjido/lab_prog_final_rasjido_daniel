<?php $token = htmlspecialchars((string)($_GET['token'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h3 class="card-title text-center mb-2">Nueva contrasena</h3>
                    <p class="text-center text-muted mb-4">Define una nueva contrasena para tu cuenta.</p>

                    <?php if ($token === ''): ?>
                        <div class="alert alert-danger" role="alert">
                            El enlace es invalido. Solicita una nueva recuperacion.
                        </div>
                        <div class="d-grid gap-2">
                            <a class="btn btn-primary" href="authentication/recuperarPassword">Solicitar nuevo enlace</a>
                            <a class="btn btn-outline-primary" href="authentication/index">Volver al login</a>
                        </div>
                    <?php else: ?>
                        <form id="formRestablecerPassword">
                            <input type="hidden" id="datoTokenRecuperacion" value="<?php echo $token; ?>">

                            <div class="mb-3">
                                <label for="datoNuevaPassword" class="form-label">Nueva contrasena</label>
                                <input type="password" class="form-control" id="datoNuevaPassword" required minlength="8" maxlength="64">
                            </div>

                            <div class="mb-4">
                                <label for="datoConfirmacionNuevaPassword" class="form-label">Confirmar nueva contrasena</label>
                                <input type="password" class="form-control" id="datoConfirmacionNuevaPassword" required minlength="8" maxlength="64">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Guardar nueva contrasena</button>
                                <a class="btn btn-outline-primary" href="authentication/index">Volver al login</a>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>