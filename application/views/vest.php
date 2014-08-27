<!-- Container za sadrzaj glavno dela strane -->
<div class="row">

	<?php 
	
		if ($clanak) {
			
			$clanak = $clanak[0][0];
			//$clanak = $clanak[0];
			
			//var_dump($clanak[0]);
			// var_dump($komentari);
			// var_dump($povezaniClanci);
	?>
	<!-- Kolona za sliku autora i + - -->
	<div class="col-md-2" style="height: 200px;padding-top: 50px;">

		<img class="center-block" src="<?php echo base_url(); ?>images/autor.jpg" style="height: 100px; width: 100px;"/>
		<p class="text-center"><?php echo $clanak -> username; ?></p>

		<br/>

		<p class="text-center">
			<button type="button" class="btn btn-link" id="plus" style="font-size: 20px">+</button>
			<button type="button" class="btn btn-link" id="minus" style="font-size: 20px">-</button>
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
						<p><?php echo $komentar->tekst; ?></p>
						<div>
							<p class="text-left" style="float: left;">
								<button type="button" class="btn btn-link" id="plus" style="font-size: 20px" onclick="oceni(<?php echo $komentar->komentarID;?>, 1);">+</button>
								<button type="button" class="btn btn-link" id="minus" style="font-size: 20px" onclick="oceni(<?php echo $komentar->komentarID;?>, -1);">-</button>
								
							</p>
							<p style="float: left; font-size: 17px; padding-top: 10px;" id="brojacGlasova<?php echo $komentar->komentarID; ?>"><?php echo ($komentar->likes - $komentar->dislikes); ?></p>
						</div>
						
						
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
						<p><?php echo $komentar->tekst; ?></p>
						<div>
							<p class="text-left" style="float: left;">
								<button type="button" class="btn btn-link" id="plus" style="font-size: 20px" onclick="oceni(<?php echo $komentar->komentarID;?>, 1);">+</button>
								<button type="button" class="btn btn-link" id="minus" style="font-size: 20px" onclick="oceni(<?php echo $komentar->komentarID;?>, -1);">-</button>
								
							</p>
							<p style="float: left; font-size: 17px; padding-top: 10px;" id="brojacGlasova<?php echo $komentar->komentarID; ?>"><?php echo ($komentar->likes - $komentar->dislikes); ?></p>
						</div>
						
						
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
		
	</div>
	<script type="text/javascript">
		function oceni(komentarID, ocena) {
			var podaci = {
				komentarID: komentarID,
				korisnikID: '4',
				like : ocena
			};
			$.ajax({
				url: "<?php echo site_url('site/lajk');?>",
				type: 'POST',
				data: podaci,
				async: false,
				success: function(msg) {
					var podaci = jQuery.parseJSON(msg);
					alert(podaci.brojKomentara);
					alert(podaci.poruka);
					if (podaci.poruka == 'Uspesno dodat glas') {
						$('#brojacGlasova' + komentarID).html(podaci.brojKomentara);	
					}
					
				}
			});
			return false;
		}
		
	</script>
	
	<?php
		}else {
		echo "Greska prilikom ucitavanja vesti";
		}
	?>
</div>