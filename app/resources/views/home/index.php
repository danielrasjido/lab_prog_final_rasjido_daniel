<div class="container py-4">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="h3 mb-0">Bienvenido<?php echo isset($_SESSION["usuario"]) ? ", " . htmlspecialchars($_SESSION["usuario"]) : ""; ?></h1>
		<div class="d-flex gap-2">
			<a class="btn btn-outline-primary" href="authentication/recuperarPassword">Recuperar contrasena</a>
			<a class="btn btn-outline-danger" href="<?php echo APP_URL; ?>/authentication/logout">Cerrar sesion</a>
		</div>
	</div>
</div>