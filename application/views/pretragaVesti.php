<!-- Kontejner za glavni deo stranice tj. listu clanaka iz kategorije sa paginacijom -->
<div class="row">
	<div class="col-md-12">
		<!-- Pojedinacna vest -->
		<?php 
			if ($clanci && count($clanci) > 0) {
				foreach ($clanci as $clanak) {
		?>

		<div class="row">
			<div class="col-md-12" style="height: 150px;">
				<div class="row">
					<div class="col-md-3"><a href="<?php echo base_url(). 'site/vest/'.$clanak->clanakID;?>"><img src="<?php echo base_url() . $clanak->featuredImage;?>" class="img-responsive media-object pull-right" style="height: 150px;"/></a></div>
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12" style="height: 30px; font-weight: 800; color: blue;"><a href="<?php echo base_url(). 'site/vest/'.$clanak->clanakID;?>"><?php echo $clanak->naslov;?></a></div>
						</div>
						<div class="row">
							<div class="col-md-12" style="height: 120px">
								<p><?php echo $clanak->kratakTekst;?></p>
								<a href="<?php echo base_url(). 'site/vest/'.$clanak->clanakID;?>">Citaj dalje</a>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<p><?php echo $clanak->datum;?></p>
						<p>Autor: <a href="<?php echo base_url() . 'site/vestiPoAutoru/' . $clanak -> korisnikID . '/0';?>"><?php echo $clanak->username;?></a></p>
						<p><?php echo $clanak->brojPregleda?></p>
					</div>
				</div>
			</div>
		</div>
		<br />

		<?php
				}
			} else {
				echo "Nema clanaka.";
			}
		?>


		<!-- Druga vest -->
		<?php $url = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/';?>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<ul class="pagination pagination-lg">
					<li><a href="<?php $page = $this->uri->segment(3); if ($page > 0) $page -= 1; else $page = 0; echo $page . '?kljucnaRec=' . $kljucnaRec . '&kategorija='.$kategorijaID; ?>">&laquo;</a></li>
					<?php 
						$brojStrana = ceil(($brojClanaka[0]/10));
						for($i = 0; $i < $brojStrana; $i++) {
							echo '<li><a href="' .  $url . $i . '?kljucnaRec=' . $kljucnaRec . '&kategorija='.$kategorijaID . '">' . ($i + 1) . '</a></li>';
						}
					?>
					<li><a href="<?php $page = $this->uri->segment(3); if ($page < $brojStrana - 1) $page += 1; else $page = $brojStrana - 1; echo $page . '?kljucnaRec=' . $kljucnaRec . '&kategorija='.$kategorijaID; ?>">&raquo;</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>