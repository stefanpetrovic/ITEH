<!-- Container za sadrzaj glavno dela strane -->
<div class="row">
	<?php 
		if ($clanak) {
			$clanak = $clanak[0];
	?>
	<!-- Kolona za sliku autora i + - -->
	<div class="col-md-2" style="height: 200px;">

		<!-- <img class="center-block" src="<?php echo base_url() . featuredImage;?>"/> -->
		<p class="text-center"><?php echo $clanak->username;?></p>

		<br/>

		<p class="text-center">
			<button type="button" class="btn btn-link" style="font-size: 20px">+</button>
			<button type="button" class="btn btn-link" style="font-size: 20px">-</button>
		</p>
	</div>
	<!-- Kolona za clanak -->
	<div class="col-md-7" style="height: 200px;">
		<div class="page-header">
			<h1><?php echo $clanak->naslov;?></h1>
		</div>
		<img src="<?php echo base_url() . $clanak->featuredImage;?>" class="center-block img-responsive"/>
		<!-- Sadrzaj clanka -->
		<div>
			<?php echo $clanak->dugiTekst?>
		</div>

		<!-- Komentari -->
		<div style="border-style: solid;">
			<p>Komentari</p>
			<ul class="media-list">
				<li class="media">
					<a href="#" class="pull-left">
						<img class="media-object" src="<?php echo base_url();?>images/autor.jpg"/>
					</a>
					<div class="media-body">
						<h4 class="media-heading">User in reply to user2</h4>
						Sadrzaj komentaraSadrzaj komentaraSadrzaj komentaraSadrzaj komentaraSadrzaj komentara
						Sadrzaj komentaraSadrzaj komentaraSadrzaj komentaraSadrzaj komentaraSadrzaj komentara
						<a data-toggle="collapse" href="#collapseOne">Komentari</a>
					</div>
				</li>
				<li>
					<ul id="collapseOne" class="collapse in">
						<li class="media">
							<a href="#" class="pull-left">
								<img class="media-object" src="<?php echo base_url();?>images/autor.jpg"/>
							</a>
							<div class="media-body">
								<h4 class="media-heading">User in reply to user2</h4>
								Sadrzaj komentaraSadrzaj komentaraSadrzaj komentaraSadrzaj komentaraSadrzaj komentara
								Sadrzaj komentaraSadrzaj komentaraSadrzaj komentaraSadrzaj komentaraSadrzaj komentara
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- Kolona za suggested vesti -->
	<div class="col-md-3" style="height: 200px;">
		<div class="row">
			<div class="col-md-12" style="height: 130px;">
				<div class="row">
					<div class="col-md-12" style="height: 100px;"><img src="<?php echo base_url();?>images/download.jpg" class="img-responsive"/></div>
				</div>
				<div class="row">
					<div class="col-md-6" style="height: 30px;">
						Naslov broj 1
					</div>
					<div class="col-md-4" style="font-size: 10px;">
						by: Stefan Petrovic
					</div>
					<div class="col-md-2" style="font-size: 10px;">
						+-20
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" style="height: 130px;">
				<div class="row">
					<div class="col-md-12" style="height: 100px;"><img src="<?php echo base_url();?>images/download.jpg" class="img-responsive"/></div>
				</div>
				<div class="row">
					<div class="col-md-6" style="height: 30px;">
						Naslov broj 1, duzina naslova moze biti problem
					</div>
					<div class="col-md-4" style="font-size: 10px;">
						by: Stefan Petrovic
					</div>
					<div class="col-md-2" style="font-size: 10px;">
						+-20
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" style="height: 130px;">
				<div class="row">
					<div class="col-md-12" style="height: 110px;"><img src="<?php echo base_url();?>images/download.jpg" class="img-responsive"/></div>
				</div>
				<div class="row">
					<div class="col-md-6">
						Naslov broj 1
					</div>
					<div class="col-md-4" style="font-size: 10px;">
						by: Stefan Petrovic
					</div>
					<div class="col-md-2" style="font-size: 10px;">
						+-20
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" style="height: 130px;">
				<div class="row">
					<div class="col-md-12" style="height: 100px;"><img src="<?php echo base_url();?>images/download.jpg" class="img-responsive"/></div>
				</div>
				<div class="row">
					<div class="col-md-6">
						Naslov broj 1, duzina naslova moze biti problem
					</div>
					<div class="col-md-4" style="font-size: 10px;">
						by: Stefan Petrovic
					</div>
					<div class="col-md-2" style="font-size: 10px;">
						+-20
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" style="height: 130px;">
				<div class="row">
					<div class="col-md-12" style="height: 110px;"><img src="<?php echo base_url();?>images/download.jpg" class="img-responsive"/></div>
				</div>
				<div class="row">
					<div class="col-md-6">
						Naslov broj 1, duzina naslova moze biti problem
					</div>
					<div class="col-md-4" style="font-size: 10px;">
						by: Stefan Petrovic
					</div>
					<div class="col-md-2" style="font-size: 10px;">
						+-20
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" style="height: 130px;">
				<div class="row">
					<div class="col-md-12" style="height: 110px;"><img src="<?php echo base_url();?>images/download.jpg" class="img-responsive"/></div>
				</div>
				<div class="row">
					<div class="col-md-6">
						Naslov broj 1, duzina naslova moze biti problem
					</div>
					<div class="col-md-4" style="font-size: 10px;">
						by: Stefan Petrovic
					</div>
					<div class="col-md-2" style="font-size: 10px;">
						+-20
					</div>
				</div>
			</div>
		</div>

	</div>
	<?php 
		}else {
			echo "Greska prilikom ucitavanja vesti";
		}
	?>
</div>