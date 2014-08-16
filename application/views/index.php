<div class="row">
<!-- Leva strana glavno dela: mix feed -->
	<div class="col-md-7">
		<!-- Prvi red mix feed-a -->
		<div class="row">
			<div class="col-md-6" style="height: 200px;">
				<div class="row" style="background-image: url('<?php echo base_url()?>images/iraq.jpg'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: border-box;">
					<div class="col-md-12">
						<a href="#">
							<div class="row">
								<div class="col-md-12" style="height: 140px;"></div>
							</div>
							<div class="row" style="height: 60px;">
								<div class="col-md-12" style="color: white; font-weight: 900;">
									Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov
								</div>
							</div> 
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-3" style="height: 200px; border-style: solid;">PPP</div>
			<div class="col-md-3" style="height: 200px; border-style: solid;">PPP</div>
		</div>
		<!-- Drugi red mix feed-a -->
		<div class="row">
			<div class="col-md-3" style="height: 200px; border-style: solid;">PPP</div>
			<div class="col-md-6" style="height: 200px; border-style: solid;">
				<div class="row" style="background-image: url('<?php echo base_url()?>images/iraq.jpg'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: border-box;">
					<div class="col-md-12">
						<a href="#">
							<div class="row">
								<div class="col-md-12" style="height: 140px;"></div>
							</div>
							<div class="row" style="height: 60px;">
								<div class="col-md-12" style="color: white; font-weight: 900;">
									Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov
								</div>
							</div> 
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-3" style="height: 200px; border-style: solid;">PPP</div>
		</div>
		<!-- Treci red mix feed-a -->
		<div class="row">
			<div class="col-md-3" style="height: 200px; border-style: solid;">PPP</div>
			<div class="col-md-3" style="height: 200px; border-style: solid;">PPP</div>
			<div class="col-md-6" style="height: 200px; border-style: solid;">PPP</div>
		</div>
		<!-- Cetvrti red mix feed-a -->
		<div class="row">
			<div class="col-md-6" style="height: 200px; border-style: solid;">PPP</div>
			<div class="col-md-3" style="height: 200px; border-style: solid;">PPP</div>
			<div class="col-md-3" style="height: 200px; border-style: solid;">PPP</div>
		</div>
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
	<!-- Desna strana glavnog dela: najcitanije vesti -->
	<div class="col-md-5">
	<?php 
		foreach ($najcitanijiClanci as $clanak) {
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
								<?php echo $clanak->autorID; ?>
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
				<a href="#"><div class="row" style="background-image: url('<?php echo base_url()?>images/download.jpg'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: content-box;">
					<div class="col-md-12" style="height: 90px;"></div>
				</div>
				<div class="row" style="height: 40px; background-color: #E4DCDC;">
					<div class="col-md-8" style="color: red;">
					Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12" style="font-size: 12px;">
								by: Stefan Petrovic
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="font-size: 12px;">
								+-20
							</div>
						</div>
					</div>
					
					
				</div> </a>
			</div>
		</div> -->
		<!-- <div class="row">
			<div class="col-md-12" style="height: 130px;">
				<a href="#"><div class="row" style="background-image: url('<?php echo base_url()?>images/download.jpg'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: content-box;">
					<div class="col-md-12" style="height: 90px;"></div>
				</div>
				<div class="row" style="height: 40px; background-color: #E4DCDC;">
					<div class="col-md-8" style="color: red;">
					Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12" style="font-size: 12px;">
								by: Stefan Petrovic
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="font-size: 12px;">
								+-20
							</div>
						</div>
					</div>
					
					
				</div> </a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" style="height: 130px;">
				<a href="#"><div class="row" style="background-image: url('<?php echo base_url()?>images/download.jpg'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: content-box;">
					<div class="col-md-12" style="height: 90px;"></div>
				</div>
				<div class="row" style="height: 40px; background-color: #E4DCDC;">
					<div class="col-md-8" style="color: red;">
					Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov Naslov
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12" style="font-size: 12px;">
								by: Stefan Petrovic
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="font-size: 12px;">
								+-20
							</div>
						</div>
					</div>
					
					
				</div> </a>
			</div>
		</div> -->
	</div>
</div>