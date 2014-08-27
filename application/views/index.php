<?php 
	function vratiMaliClanak($clanak) {
		echo '<div class="col-md-3">';
		echo '<div class="row">';
		echo '<div class="col-md-12"  style="height: 200px; background-image: url(' . base_url() . $clanak->featuredImage . '); background-repeat: no-repeat; background-size: 100% 100%; background-origin: content-box;">';
		echo '<div class="row">';
		echo '<div class="col-md-12" style="height: 140px;"></div>';
		echo '</div>';
		echo '<div class="row naslovPozadina" style="height: 60px;">';
		echo '<div class="col-md-12 naslov">';
		echo '<p>';
		echo '<a class="naslov" href="' . base_url() . 'site/vest/' . $clanak->clanakID . '">';
		echo substr($clanak->naslov, 0, 100) . '...';
		echo '</a>';
		echo '</p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	function vratiVelikiClanak($clanak) {
		echo '<div class="col-md-6">';
		echo '<div class="row">';
		echo '<div class="col-md-12 kockaPozadina" style="background-image: url(' . base_url() . $clanak->featuredImage . ');">';
		echo '<div class="row" >';
		echo '<div class="col-md-12" style="height: 140px;"></div>';
		echo '</div>';
		echo '<div class="row naslovPozadina" style="height: 60px;">';
		echo '<div class="col-md-12 ">';
		echo '<p>';
		echo '<a class="naslov" href="' . base_url() . 'site/vest/' . $clanak->clanakID . '">';
		echo substr($clanak->naslov, 0, 80) . '...';
		echo '</a>';
		echo '</p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	function vratiPrviRed($clanci) {
		if (count($clanci) > 0) {
			vratiVelikiClanak($clanci[0]);
		}
		if (count($clanci) > 1) {
			vratiMaliClanak($clanci[1]);
		}
		if (count($clanci) > 2) {
			vratiMaliClanak($clanci[2]);
		}
	}
	function vratiDrugiRed($clanci) {
		if (count($clanci) > 3) {
			vratiMaliClanak($clanci[3]);
		}
		if (count($clanci) > 4) {
			vratiVelikiClanak($clanci[4]);
		}
		if (count($clanci) > 5) {
			vratiMaliClanak($clanci[5]);
		}
	}
	function vratiTreciRed($clanci) {
		if (count($clanci) > 6) {
			vratiMaliClanak($clanci[6]);
		}
		if (count($clanci) > 7) {
			vratiMaliClanak($clanci[7]);
		}
		if (count($clanci) > 8) {
			vratiVelikiClanak($clanci[8]);
		}
	}
	function vratiCetvrtiRed($clanci) {
		if (count($clanci) > 9) {
			vratiVelikiClanak($clanci[9]);
		}
		if (count($clanci) > 10) {
			vratiMaliClanak($clanci[10]);
		}
		if (count($clanci) > 11) {
			vratiMaliClanak($clanci[11]);
		}
	}	
?>

<div class="row">
<!-- Leva strana glavno dela: mix feed -->
	<div class="col-md-8">
		
			
			<?php 
				if ($mixClanci) {
			?>
					<!-- Prvi red mix feed-a -->
					<div class="row">
						<?php 
							vratiPrviRed($mixClanci);
						?>
					</div>
			
			
					<!-- Drugi red mix feed-a -->
					<div class="row">
						<?php
							vratiDrugiRed($mixClanci);
						?>
					</div>
					<!-- Treci red mix feed-a -->
					<div class="row">
			 			<?php
							vratiTreciRed($mixClanci);
						?>
					</div>
					<!-- Cetvrti red mix feed-a -->
					<div class="row">
			 			<?php 
							vratiCetvrtiRed($mixClanci);
						?>
					</div>
			
			
			<?php
				}else {
					echo "Nema clanaka";
				}
			?>
			
		<?php
		
		?>
		
			
		
		<div class="row">
			<div class="col-md-6 col-md-offset-1">
				<ul class="pagination pagination-lg">
					<li><a href="<?php $page = $this->uri->segment(3); if ($page > 0) $page -= 1; else $page = 0; echo $page; ?>">&laquo;</a></li>
					<li><a href="<?php echo base_url() . 'site/index';?>">1</a></li>
					<li><a href="<?php echo base_url() . 'site/index/1';?>">2</a></li>
					<li><a href="<?php echo base_url() . 'site/index/2';?>">3</a></li>
					<li><a href="<?php echo base_url() . 'site/index/3';?>">4</a></li>
					<li><a href="<?php $page = $this->uri->segment(3); if ($page < 3) $page += 1; else $page = 3; echo $page; ?>">&raquo;</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Desna strana glavnog dela: najcitanije vesti -->
	<div class="col-md-4">
	<?php 
		foreach ($najcitanijiClanci as $clanak) {
			$length = strlen($clanak->featuredImage);
			$dotPosition = strrpos($clanak->featuredImage, '.');
			$image = base_url() . substr($clanak->featuredImage, 0, $dotPosition) . '2' . substr($clanak->featuredImage, $dotPosition);
	?>
		<div class="row">
			<div class="col-md-12 sidenews"  style="height: 220px; background-image: url('<?php echo $image;?>'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: content-box;">
				
				<div class="row" >
						<div class="col-md-12" style="height: 160px;"></div>
				</div>
				<div class="row naslovPozadina" style="height: 60px;">
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
								<a class="autor" href="<?php echo base_url() . 'site/vestiPoAutoru/' . $clanak -> korisnikID . '/0';?>">
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
	?>

	</div>
</div>