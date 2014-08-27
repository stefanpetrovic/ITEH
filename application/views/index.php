<?php 
	function vratiMaliClanak($clanak) {
		echo '<div class="col-md-3" style="height: 200px;">';
		echo '<div class="row" style="background-image: url(' . base_url() . $clanak->featuredImage . '); background-repeat: no-repeat; background-size: 100% 100%; background-origin: margin-box;">';
		echo '<div class="col-md-12">';
		echo '<a href="' . base_url() . 'site/vest/' . $clanak->clanakID . '">';
		echo '<div class="row">';
		echo '<div class="col-md-12" style="height: 140px;"></div>';
		echo '</div>';
		echo '<div class="row" style="height: 60px;">';
		echo '<div class="col-md-12" style="color: white; font-weight: 900;">';
		echo substr($clanak->naslov, 0, 14) . '...' ;
		echo '</div>';
		echo '</div>';
		echo '</a>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	function vratiVelikiClanak($clanak) {
		echo '<div class="col-md-6" style="height: 200px;">';
		echo '<div class="row" style="background-image: url(' . base_url() . $clanak->featuredImage . '); background-repeat: no-repeat; background-size: 100% 100%; background-origin: margin-box;">';
		echo '<div class="col-md-12">';
		echo '<a href="' . base_url() . 'site/vest/' . $clanak->clanakID . '">';
		echo '<div class="row">';
		echo '<div class="col-md-12" style="height: 140px;"></div>';
		echo '</div>';
		echo '<div class="row" style="height: 60px;">';
		echo '<div class="col-md-12" style="color: white; font-weight: 900;">';
		echo substr($clanak->naslov, 0, 28) . '...';
		echo '</div>';
		echo '</div>';
		echo '</a>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
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
							vratiVelikiClanak($mixClanci[0]);
							vratiMaliClanak($mixClanci[1]);
							vratiMaliClanak($mixClanci[2]);
						?>
					</div>
			
			
					<!-- Drugi red mix feed-a -->
					<div class="row">
						<?php
							vratiMaliClanak($mixClanci[3]);
							vratiVelikiClanak($mixClanci[4]);
							vratiMaliClanak($mixClanci[5]);
						?>
					</div>
					<!-- Treci red mix feed-a -->
					<div class="row">
			 			<?php
							vratiMaliClanak($mixClanci[6]);
							vratiMaliClanak($mixClanci[7]);
							vratiVelikiClanak($mixClanci[8]);
						?>
					</div>
					<!-- Cetvrti red mix feed-a -->
					<div class="row">
			 			<?php 
							vratiVelikiClanak($mixClanci[9]);
							vratiMaliClanak($mixClanci[10]);
							vratiMaliClanak($mixClanci[11]);
						?>
					</div>
			
			
			<?php
				}else {
					echo "Problem sa ucitavanje clanaka";
				}
			?>
			
		<?php
		
		?>
		
			
		
		<div class="row">
			<div class="col-md-6 col-md-offset-1">
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
	<div class="col-md-4">
	<?php 
		foreach ($najcitanijiClanci as $clanak) {
			$length = strlen($clanak->featuredImage);
			$dotPosition = strrpos($clanak->featuredImage, '.');
			$image = base_url() . substr($clanak->featuredImage, 0, $dotPosition) . '2' . substr($clanak->featuredImage, $dotPosition);
	?>
		<div class="row">
			<div class="col-md-12"  style="height: 220px; background-image: url('<?php echo $image;?>'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: content-box;">
				
				<div class="row" >
						<div class="col-md-12" style="height: 180px;"></div>
				</div>
				<div class="row" style="height: 40px; background-color: #E4DCDC; color:#fff; opacity:0.5;">
					<a href="<?php echo base_url() . 'site/vest/' . $clanak->clanakID;?>">
						<div class="col-md-8" style="color: black; font-size: 15px; font-weight: 900;">
							<p style="padding: 5px;">
								<?php echo $clanak->naslov; ?>
							</p>
						</div>
				    </a>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12" style="font-size: 12px; font-weight: 800; color: black;">
								<?php echo $clanak->autorID; ?>
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