<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<form role="form" action="<?php echo base_url() . 'login/validate_credentials'?>" method="post">
			<div class="form-group">
				<label for="username">Username: </label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Enter username..."/>
				<a href="<?php echo base_url() . 'site/registracija'?>" style="font-size: 10px;">Nemate nalog? Kliknite ovde</a>
			</div>
			<div class="form-group">
				<label for="password">Password: </label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Enter password..."/>
			</div>
			<button type="submit" class="btn btn-default">Uloguj se</button>
		</form>
	</div>
	<div class="col-md-3"></div>
</div>