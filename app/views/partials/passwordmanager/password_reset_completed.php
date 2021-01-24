<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-6">
			<div class="card card-body">
				<h2>Administrador de restablecimiento de contraseña</h2>
				<hr />	
				<h4 class="animated bounce text-success">
					<i class="fa fa-check-circle"></i> Tu contraseña ha sido restablecida
				</h4>
				<hr />
			</div>
			<br />
			<a href="<?php print_link(""); ?>" class="btn btn-info">Haga clic aquí para ingresar</a>
			<?php 
				if(DEVELOPMENT_MODE){ 
			?>
				<div class="text-muted">To edit the email template, browse to :- <i>app/view/partials/passwordmanager/password_reset_completed.php</i></div>
			<?php 
				} 
			?>
		</div>
	</div>
</div>
	