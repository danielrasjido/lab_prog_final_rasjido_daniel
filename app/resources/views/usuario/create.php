<main>
    <form method="POST" autocomplete="off">

        <div class="mb-3">
            <label for="datoApellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="datoApellido" id="datoApellido" required minlength="2"
                maxlength="32">
        </div>

        <div class="mb-3">
            <label for="datoNombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="datoNombre" id="datoNombre" required minlength="2"
                maxlength="32">
        </div>

        <div class="mb-3">
            <label for="datoCuenta" class="form-label">Cuenta</label>
            <input type="text" class="form-control" name="datoCuenta" id="datoCuenta" required minlength="2"
                maxlength="32">
        </div>
        
        <div class="mb-3">
            <label for="datoCorreo" class="form-label">Correo</label>
            <input type="email" class="form-control" name="datoCorreo" id="datoCorreo" required
                pattern="^[a-zA-Z0-9._%+\-]+@gmail\.com$" minlength="2" maxlength="32">
        </div>
        
        
        <div class="mb-3">
            <label class="form-label">Perfil</label>
            <div>
                <input class="form-check-input" type="radio" name="datoPerfil" id="perfilAdministrador" required>
                <label class="form-check-label" for="perfilAdministrador">
                    Administrador
                </label>
                
                <input class="form-check-input" type="radio" name="datoPerfil" id="perfilOperador">
                <label class="form-check-label" for="perfilOperador">
                    Operador
                </label>
                
                <input class="form-check-input" type="radio" name="datoPerfil" id="perfilExterno">
                <label class="form-check-label" for="perfilExterno">
                    Externo
                </label>
                
            </div>
        </div>


        <div class="mb-3">
            <label for="datoClave" class="form-label">Clave</label>
            <input type="password" class="form-control" name="datoClave" id="datoClave" required minlength="8"
                maxlength="32">
        </div>

        <div class="mb-3">
            <label for="datoConfirmarClave" class="form-label">Confirmar clave</label>
            <input type="password" class="form-control" name="datoConfirmarClave" id="datoConfirmarClave" required
                minlength="8" maxlength="32">
        </div>
        <button type="submit" class="btn btn-primary">Validar y guardar información</button>
        <a class="btn btn-primary" href="usuario/index">Volver a usuarios</a>
    </form>
</main>