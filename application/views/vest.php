<!-- Container za sadrzaj glavno dela strane -->
<div class="row">
	<?php 
		if ($clanak) {
			$clanak = $clanak[0];
	?>
	<!-- Kolona za sliku autora i + - -->
	<div class="col-md-2" style="height: 200px;">

		<!-- <img class="center-block" src="<?php echo base_url() . featuredImage;?>"/> -->
		<p class="text-center"><?php echo $clanak -> username; ?></p>

		<br/>

		<p class="text-center">
			<button type="button" class="btn btn-link" style="font-size: 20px">+</button>
			<button type="button" class="btn btn-link" style="font-size: 20px">-</button>
		</p>
	</div>
	<!-- Kolona za clanak -->
	<div class="col-md-7">
		<div class="page-header">
			<h1><?php echo $clanak -> naslov; ?></h1>
		</div>
		<img src="<?php echo base_url() . $clanak -> featuredImage; ?>" class="center-block img-responsive"/>
		<!-- Sadrzaj clanka -->
		<div>
			<?php echo $clanak -> dugiTekst; ?>
		</div>

		<!-- Forma za unos komentara na clanak-->
		
		<div style="padding: 10px;">
			<form class="form-horizontal" role="form" action="ostaviKomentar/">
				<textarea class="form-control" rows="3">Ostavite komentar...</textarea>
			</form>
			<br/>
			<button class="submit" class="btn btn-default">Ostavi komentar</button>
			<br />
		</div>

		<!-- Komentari -->
		<div style="border-style: none;">
			<p>Komentari</p> <br/>
			<ul class="media-list">
				<?php 
					$i = 0;
					foreach($komentari as $komentar) {
						if ($i < 5) {
				?>
				<li class="media">
					<img class="media-object pull-left" src="<?php echo base_url(); ?>images/autor.jpg" style="height: 100px; width: 100px;"/>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $komentar->username; ?> <small>on <?php echo $komentar->datum; ?></small></h4>
						<?php echo $komentar->tekst; ?>
						
						
						
					</div>
				</li>
				<?php 
							$i++;
						}else {
							break;
						}
					}
				?>
			</ul>
					<a data-toggle="collapse" href="#collapseOne">Prikazi sve komentare</a>
					<ul id="collapseOne" class="media-list collapse">
				<?php 
					$i = 0;
					foreach($komentari as $komentar) {
						$i ++;
						if ($i < 5) {
							continue;
						}
					
				?>
				
						<li class="media">
							<img class="media-object pull-left" src="<?php echo base_url(); ?>images/autor.jpg" style="height: 100px; width: 100px;"/>
							<div class="media-body">
								<h4 class="media-heading"><?php echo $komentar->username; ?> <small>on <?php echo $komentar->datum; ?></small></h4>
								<?php echo $komentar->tekst; ?>
							</div>
						</li>
					
				<?php
						
					}
				?>
					</ul>
				
			
		</div>
	</div>
	<!-- Kolona za suggested vesti -->
	<div class="col-md-3" style="height: 200px;">
	<?php 
		foreach($povezaniClanci as $clanak) {
	?>
		<div class="row">
			<div class="col-md-12" style="height: 220px;">
				<a href="#"><div class="row" style="background-image: url('<?php echo base_url().$clanak->featuredImage?>'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: content-box;">
					<div class="col-md-12" style="height: 180px;"></div>
				</div>
				<div class="row" style="height: 40px; background-color: #E4DCDC;">
					<div class="col-md-8" style="color: red;">
					<?php echo $clanak->naslov; ?>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12" style="font-size: 12px;">
								<?php echo $clanak->username; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="font-size: 12px;">
								<?php echo $clanak->brojPregleda; ?>
							</div>
						</div>
					</div>
					
					
				</div> </a>
			</div>
		</div>
	<?php
		}
	?>
	
		<!-- <div class="row">
			<div class="col-md-12" style="height: 130px;">
				<div class="row">
					<div class="col-md-12" style="height: 100px;"><img src="<?php echo base_url(); ?>images/download.jpg" class="img-responsive"/></div>
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
					<div class="col-md-12" style="height: 100px;"><img src="<?php echo base_url(); ?>images/download.jpg" class="img-responsive"/></div>
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
					<div class="col-md-12" style="height: 110px;"><img src="<?php echo base_url(); ?>images/download.jpg" class="img-responsive"/></div>
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
					<div class="col-md-12" style="height: 100px;"><img src="<?php echo base_url(); ?>images/download.jpg" class="img-responsive"/></div>
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
					<div class="col-md-12" style="height: 110px;"><img src="<?php echo base_url(); ?>images/download.jpg" class="img-responsive"/></div>
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
					<div class="col-md-12" style="height: 110px;"><img src="<?php echo base_url(); ?>images/download.jpg" class="img-responsive"/></div>
				</div>
				<div class="row">
					<div class="col-md-6">
						Naslov broj 1, duzina naslova moze biti problem
						<?php print_r($povezaniClanci); ?>
					</div>
					<div class="col-md-4" style="font-size: 10px;">
						by: Stefan Petrovic
					</div>
					<div class="col-md-2" style="font-size: 10px;">
						+-20
					</div>
				</div>
			</div>
		</div> -->
		
	</div>
	<?php
		}else {
		echo "Greska prilikom ucitavanja vesti";
		}
	?>
</div>