<div class="container mt-5 mb-5">
	<div class="row justify-content-center">
		<div class="col-md-7 col-lg-6">
			<div class="card shadow">
				<div class="card-body p-5">
					<h3 class="card-title text-center mb-2">Crear cuenta</h3>
					<p class="text-center text-muted mb-4">El registro público crea cuentas con perfil Externo.</p>

					<form id="formRegistroUsuarioExterno">
						<div class="mb-3">
							<label for="datoApellido" class="form-label">Apellido</label>
							<input type="text" class="form-control" id="datoApellido" name="datoApellido" required minlength="2" maxlength="32">
						</div>

						<div class="mb-3">
							<label for="datoNombre" class="form-label">Nombre</label>
							<input type="text" class="form-control" id="datoNombre" name="datoNombre" required minlength="2" maxlength="32">
						</div>

						<div class="mb-3">
							<label for="datoCuenta" class="form-label">Cuenta</label>
							<input type="text" class="form-control" id="datoCuenta" name="datoCuenta" required minlength="2" maxlength="32">
						</div>

						<div class="mb-3">
							<label for="datoCorreo" class="form-label">Correo electrónico</label>
							<input type="email" class="form-control" id="datoCorreo" name="datoCorreo" required maxlength="64">
						</div>

						<div class="mb-3">
							<label for="datoClave" class="form-label">Contraseña</label>
							<input type="password" class="form-control" id="datoClave" name="datoClave" required minlength="8" maxlength="32">
						</div>

						<div class="mb-4">
							<label for="datoConfirmarClave" class="form-label">Confirmar contraseña</label>
							<input type="password" class="form-control" id="datoConfirmarClave" name="datoConfirmarClave" required minlength="8" maxlength="32">
						</div>

						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-primary">Registrarme</button>
							<a class="btn btn-outline-primary" href="authentication/index">Volver al login</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
