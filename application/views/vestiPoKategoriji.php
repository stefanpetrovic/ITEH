<!-- Kontejner za glavni deo stranice tj. listu clanaka iz kategorije sa paginacijom -->
<div class="row">
	<div class="col-md-12">
		<!-- Pojedinacna vest -->
		<?php 

			foreach ($clanci as $clanak) {
		?>

		<div class="row">
			<div class="col-md-12" style="height: 150px;">
				<div class="row">
					<div class="col-md-3"><img src="<?php echo base_url() . $clanak->featuredImage;?>" class="img-responsive"/></div>
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12" style="height: 30px; font-weight: 800; color: blue;"><a href="<?php echo base_url(). 'site/vest/'.$clanak->clanakID;?>"><?php echo $clanak->naslov;?></a></div>
						</div>
						<div class="row">
							<div class="col-md-12" style="height: 120px">
								<p><?php echo $clanak->kratakTekst;?></p>
								<a href="#">Citaj dalje</a>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<p><?php echo $clanak->datum;?></p>
						<p>AutorID: <?php echo $clanak->autorID;?></p>
						<p><?php echo $clanak->brojPregleda?></p>
					</div>
				</div>
			</div>
		</div>

		<?php
			}
		?>


		<!-- Druga vest -->
		
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<ul class="pagination pagination-lg">
					<li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>