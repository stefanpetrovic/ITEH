<!-- Container za sadrzaj glavno dela strane -->
<div class="row">


	<?php 
		
		if ($clanak) {
			
			$clanak = $clanak[0][0];
			$clanakIDd = $clanak->clanakID;


			//$clanak = $clanak[0];
			
			//var_dump($clanak[0]);
			// var_dump($komentari);
			// var_dump($povezaniClanci);
	?>
	<!-- Kolona za sliku autora i + - -->
	<!-- <div class="col-md-2" style="height: 200px;padding-top: 50px;">

		<img class="center-block" src="<?php echo base_url(); ?>images/autor.jpg" style="height: 100px; width: 100px;"/>
		<p class="text-center"><?php echo $clanak -> username; ?></p>

		<br/>

		<p class="text-center">
			<button type="button" class="btn btn-link" id="plus" style="font-size: 20px">+</button>
			<button type="button" class="btn btn-link" id="minus" style="font-size: 20px">-</button>
		</p>
	</div> -->
	<!-- Kolona za clanak -->
	<div class="col-md-8">
		<div class="page-header">
			<h1><?php echo $clanak -> naslov; ?></h1>
			<p><a class="naslov" href="<?php echo base_url() . 'site/vestiPoAutoru/' . $clanak -> autorID . '/0';?>"><?php echo $clanak->username;?></a></p>
			<p style="font-size: 12px;"><?php echo $clanak->datum;?></p>
		</div>
		<img src="<?php echo base_url() . $clanak -> featuredImage; ?>" class="center-block img-responsive"/>
		<!-- Sadrzaj clanka -->
		<div>
			<?php echo $clanak -> dugiTekst; ?>
		</div>

		<!-- Forma za unos komentara na clanak-->
		
		<div style="padding: 10px;">
			<textarea class="form-control" rows="3" id="sadrzajKomentara" >Ostavite komentar...</textarea>
			<br/>
				<button class="button" class="btn btn-default" onclick="ostaviKomentar();">Ostavi komentar</button>
			<br />
		</div>

		<!-- Komentari -->
		<div style="border-style: none;">
			<p>Komentari</p> <br/>
			<ul class="media-list">
				<?php 
					if ($komentari) {
					$i = 0;
					foreach($komentari as $komentar) {
						if ($i < 5) {
				?>
				<li class="media">
					
					<div class="media-body">
						<h4 class="media-heading"><?php echo $komentar->username; ?> <small>on <?php echo $komentar->datum; ?></small></h4>
						<p style="margin-left: 30px; margin-top: 10px;"><?php echo $komentar->tekst; ?></p>
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
				}else {
					echo 'Nema komentara';
				}
				?>
					</ul>
				
			
		</div>
	</div>
	<!-- Kolona za suggested vesti -->
	<div class="col-md-4" style="height: 200px;">
	<?php 
	if ($povezaniClanci) {
		
		foreach($povezaniClanci as $clanak) {
			$length = strlen($clanak->featuredImage);
			$dotPosition = strrpos($clanak->featuredImage, '.');
			$image = base_url() . substr($clanak->featuredImage, 0, $dotPosition) . '2' . substr($clanak->featuredImage, $dotPosition);
	?>
		<div class="row">
			<div class="col-md-12 sidenews"  style="height: 220px; background-image: url('<?php echo $image;?>'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: content-box;">
				
				<div class="row" >
						<div class="col-md-12" style="height: 160px;"></div>
				</div>
				<div class="row naslovPozadina" style="height: 55px; margin: 0px;">
					<div class="col-md-8 naslov">
						<p style="padding: 5px;">
							<a class="naslov"href="<?php echo base_url() . 'site/vest/' . $clanak->clanakID;?>">
								<?php echo $clanak->naslov; ?>
							</a>
						</p>
					</div>
				    
					<div class="col-md-3 col-md-offset-1">
						<div class="row">
							<div class="col-md-12" style="font-size: 12px; font-weight: 800; color: black;">
								<a class="autor" href="<?php echo base_url() . 'site/vestiPoAutoru/' . $clanak -> autorID . '/0';?>">
									<?php echo $clanak->username; ?>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="font-size: 12px; font-weight: 800; color: black;">
								<?php echo $clanak->brojPregleda; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
		}
	}
	?>
		
	</div>
	<script type="text/javascript">
		function oceni(komentarID, ocena) {
			var ulogovan = <?php if ($korisnik['ulogovan']) echo '1'; else echo '0'; ?>;
			if (ulogovan == 0) {
				alert('Ne mozete glasati ako niste ulogovani!');
				return false;
			}
			var podaci = {
				komentarID: komentarID,
				korisnikID: '<?php if ($korisnik['ulogovan']) echo $korisnik['idKorisnika']; else echo -1;?>',
				like : ocena
			};
			$.ajax({
				url: "<?php echo site_url('site/lajk');?>",
				type: 'POST',
				data: podaci,
				async: false,
				success: function(msg) {
					var podaci = jQuery.parseJSON(msg);
					alert(podaci.poruka);
					if (podaci.poruka == 'Uspesno dodat glas') {
						$('#brojacGlasova' + komentarID).html(podaci.brojKomentara);	
					}
					
				}
			});
			return false;
		}
		
		function ostaviKomentar() {
			var ulogovan = <?php if ($korisnik['ulogovan']) echo '1'; else echo '0'; ?>;
			if (ulogovan == 0) {
				alert('Ne mozete ostaviti komentar ako niste ulogovani!');
				return false;
			}
			var podaci = {
				sadrzajKomentara : $('#sadrzajKomentara').val(),
				korisnikID: '<?php if ($korisnik['ulogovan']) echo $korisnik['idKorisnika']; else echo -1;?>', 
				clanakID: '<?php echo $clanakIDd; ?>'
			};
			$.ajax({
				url: "<?php echo site_url('site/ostaviKomentar')?>",
				type: 'POST',
				data: podaci,
				success: function(msg) {
					alert(msg);
					$('#sadrzajKomentara').val("");
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