<form autocomplete="off">

            <div class="mb-3">
                <label for="datoApellido" class="form-label">Apellido</label>
                <input type="text" class="form-control control" name="datoApellido" id="datoApellido" required minlength="2" maxlength="32" disabled>
            </div>

            <div class="mb-3">
                <label for="datoNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control control" name="datoNombre" id="datoNombre" required minlength="2" maxlength="32" disabled>
            </div>

            <div class="mb-3">
                <label for="datoCuenta" class="form-label">Cuenta</label>
                <input type="text" class="form-control control" name="datoCuenta" id="datoCuenta" required minlength="2" maxlength="32" disabled>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Perfil</label>
                <div>
                    <input class="form-check-input control" type="radio" name="datoPerfil" id="perfilAdministrador" required disabled>
                    <label class="form-check-label" for="perfilAdministrador">
                        Administrador
                    </label>
                    <input class="form-check-input control" type="radio" name="datoPerfil" id="perfilOperador" disabled>
                    <label class="form-check-label" for="perfilOperador">
                        Operador
                    </label>
                </div>
            </div>

            <div class="mb-3">
                <label for="datoCorreo" class="form-label">Correo</label>
                <input type="email" class="form-control control" name="datoCorreo" id="datoCorreo" required pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" minlength="2" maxlength="32" disabled>
            </div>

            <div class="mb-3">
                <label for="datoClave" class="form-label">Clave</label>
                <input type="password" class="form-control control" name="datoClave" id="datoClave" required minlength="8" maxlength="32" disabled>
            </div>

            <div class="mb-3">
                <label for="datoConfirmarClave" class="form-label">Confirmar clave</label>
                <input type="password" class="form-control control" name="datoConfirmarClave" id="datoConfirmarClave" required minlength="8" maxlength="32" disabled>
            </div>

            <div class="mb-3">
                <label for="datoEstadoCuenta" class="form-label">Estado de la cuenta</label>
                <!-- <input type="text" class="form-control control" id="datoEstadoCuenta" disabled value=""> -->
                <select name="datoEstadoCuenta" id="datoEstadoCuenta" class="form-control control" disabled>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="datoFechaCreacionCuenta" class="form-label">Fecha de creación</label>
                <input type="text" class="form-control control" id="datoFechaCreacionCuenta" disabled value="">
            </div>

            <div class="mb-3">
                <button id="btnActualizar" type="submit" class="btn btn-primary" disabled>Actualizar en base de datos</button>
                <a class="btn btn-primary" href="usuario/index">Volver a usuarios</a>
                <button  id="btnEditar" type="button" class="btn btn-primary">Editar</button>
                <button id="btnCancelarEdicion" class="btn btn-warning" disabled>Cancelar edición</button>
                <button type="button" id="btnEliminarRegistro" class="btn btn-danger">Eliminar registro actual</button>
                <button id="btnExportarUsuarioPDF" class="btn btn-primary" type="button">Exportar a PDF</button>
            </div>
            
            
        </form>