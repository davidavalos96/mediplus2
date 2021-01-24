<div class="container">
	<div class="jumbotron text-center">
		<h3>¡Comunicate con nosotros! Estamos aquí por tí...</h3>
	</div>
	<div style="margin:40px 0">
		<div class="row">
			<div class="col-sm-5">
				<div class="panel-body panel">
					<?php $this::display_page_errors(); ?>
					<h4>Comparta información con nosotros por correo electrónico</h4>
					<hr />
					<form method="post" action="<?php print_link("info/contact"); ?>">
						<div class="form-group">
							<input type="text" class="form-control" required id="name" name="name" placeholder="Escriba su nombre *">
						</div>

						<div class="form-group">
							<input type="email" class="form-control" required id="email" name="email" placeholder="Ingrese su correo electronico *">
						</div>

						<div class="form-group">
							<textarea class="form-control" id="msg" name="msg" rows="4" required placeholder="Escriba su mensaje *"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

				</div>
			</div>

			<div class="col-sm-7">
				<div class="panel panel-body">
					<h4>Otras maneras de comunicarte con nosotros</h4>
					<hr />

					<p>
						<b class="chead"><span class="material-icons">location_on</span>Address | Location</b><br />
						<p class="adr clearfix">
							<span class="adr-group">
								<span class="street-address">Alem 111</span><br>
								<span class="postal-code">Cod Postal 9000</span><br>
								<span class="country-name">Comodoro Rivadavia,Chubut</span>
							</span>
						</p>
					</p>
					<hr />
					<p>
						<b class="chead"><span class="material-icons">contact_phone</span> Telefono</b><br />
						<span class="editContent"> 2974248613 / +233233000000</span>
					</p>
					<hr />

					<p>
						<b class="chead"><span class="material-icons">email</span> brechasdigitales@gmail.com</b><br />
						<a href="#" class="editContent">administracion1@centropilares.com</a>
					</p>
				</div>
			</div>
		</div>
	</div>
	<?php
	if (DEVELOPMENT_MODE) {
	?>
		<small class="text-muted">To edit this file, browse to :- <i>app/view/partials/info/contact.php</i></small>
	<?php
	}
	?>

</div>