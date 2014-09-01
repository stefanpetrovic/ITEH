<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rest API</title>


	<!-- Bootstrap -->
	<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/custom-frontend.css" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
</head>
<body>
	<header>
	</header>

	<?php

	$api_functions[] = array(
		'naslov' 	=> 'Vrati autore',
		'tip'		=> 'GET',
		'base_url'	=> 'api/autori',
		'opis'		=> 'Vraća autore. Ukoliko nijedan parametar nije obezbeđen, vraća prvih 100 autora.',
		'obavezni'	=> false,
		'opcioni'	=> array(
			array(
				'param' => '?name=<autor>',
				'opis' 	=> 'Servis u ovom slučaju vraća sve autore koji u svom imenu imaju prosleđeni parametar.',
				'primer'=> 'api/autori/?name=Pera'
				)
			)

		);

	$api_functions[] = array(
		'naslov' 	=> 'Vest',
		'tip'		=> 'GET',
		'base_url'	=> 'api/vest',
		'opis'		=> 'Vraća jednu vest za prosleđeni parametar. Prosleđuje se jedan parametar - id članka ili pun naslov.',
		'opcioni'	=> false,
		'obavezni'	=> array(
			array(
				'param' => '?id=<id>',
				'opis' 	=> 'Parametar predstavlja jedinstveni identifikator vesti. Tip vrednosti je integer (celobrojna vrednost).',
				'primer'=> 'api/vest/?id=4'
				),
			array(
				'param' => '?naslov=<naslov>',
				'opis' 	=> 'Parametar predstavlja naslov vesti. Tip vrednosti je string (tekstualna vrednost).',
				'primer'=> 'api/vest/?naslov="Odigrana je utakmica u Londonu"'
				)
			)

		);

	$api_functions[] = array(
		'naslov' 	=> 'Više vesti',
		'tip'		=> 'GET',
		'base_url'	=> 'api/vesti',
		'opis'		=> 'Vraća više vesti. U slučaju da nije prosleđen nijedan parametar vraća poslednjih 100 vesti.',
		'obavezni'	=> false,
		'opcioni'	=> array(
			array(
				'param' => '?author=<autor1,autor,autor3...>',
				'opis' 	=> 'Vraća one vesti gde je autor neki od prosleđenih. Autori se odvajaju zarezima.',
				'primer'=> 'api/vesti?author=marko,petar'
				),
			array(
				'param' => '?heading=<reč1,reč2,reč3,...,rečn>',
				'opis' 	=> 'Vraća vesti koje u naslovu sadrže određene reči. Reči se prosleđuju razdvojene zarezima.',
				'primer'=> 'api/vesti?heading=lopta,selekcija,trava'
				),
			array(
				'param' => '?text=<reč1,reč2,reč3,...,rečn>',
				'opis' 	=> 'Vraća vesti koje u kratkoj ILI dugoj vesti sadrže određene reči. Reči se prosleđuju razdvojene zarezima.',
				'primer'=> 'api/vesti?text=lopta,selekcija,trava,igrači,protivnik'
				),
			array(
				'param' => '?num=<brojClanaka>',
				'opis' 	=> 'Omogućuje kontrolu broja vesti. Parametar je tipa integer (celi broj)',
				'primer'=> 'api/vesti?num=140'
				),
			array(
				'param' => '?kategorije=<kategorija1,kategorija2,...,kategorijan>',
				'opis' 	=> 'Omogućuje odabir kategorija vesti. Moguć je unos više kategorija. Odabir se vrši po principu OR (da vest pripada bar jednoj kategoriji). Parametri se odvajaju zarezima.',
				'primer'=> 'api/vesti?kategorije=Odbojka,Vaterpolo'
				)
			)

);
$api_functions[] = array(
	'naslov' 	=> 'Komentari',
	'tip'		=> 'GET',
	'base_url'	=> 'api/komentari',
	'opis'		=> 'Vraća komentare. Ukoliko nije prosleđen nijedan parametar, vraća poslednjih 100 komentara.',
	'opcioni'	=> false,
	'obavezni'	=> array(
		array(
			'param' => '?id=<id>',
			'opis' 	=> 'Vraća komentare za vest sa određenim id-jem. U tom slučaju, ne prosleđuje se parametar "kategorije".',
			'primer'=> 'api/komentari?id=4'
			),
		array(
			'param' => '?kategorije=<kategorija1,kategorija2,...,kategorijan>',
			'opis' 	=> 'Omogućuje odabir kategorija vesti za koje se vraćaju komentari. Moguć je unos više kategorija. Odabir se vrši po principu OR (da vest pripada bar jednoj kategoriji). Parametri se odvajaju zarezima.  U tom slučaju, ne prosleđuje se parametar "kategorije".',
			'primer'=> 'api/komentari?kategorije=Odbojka,Vaterpolo'
			)
		)

	);
$api_functions[] = array(
	'naslov' 	=> 'Kategorije',
	'tip'		=> 'GET',
	'base_url'	=> 'api/kategorije',
	'opis'		=> 'Vraća nazive svih postojećih kategorija na sajtu.',
	'obavezni'	=> false,
	'opcioni'	=> false,
	);

function showOneApiFunction($property){ 

	?>

	<h2><span class="label label-primary" style="padding: 0.3em 0.5em 0.2em;"><?php echo $property['tip'];?></span> <?php echo "  ".$property['naslov'];?></h2>
	<table class="table">
		<thead>
			<tr>
				<th>Resurs</th>
				<th>Opis</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="col-md-4" style=""><a href="#"><?php echo $property['base_url'];?></a></td>
				<td class="col-md-8" style=""><?php echo $property['opis'];?></td>
			</tr>
		</tbody>
	</table>



	<?php
	if($opcioniParametri = $property['opcioni']) {?>

	<h4 style="color: #f0ad4e;">Opcioni parametri</h4>
	<div class="col-md-11 col-md-offset-1">
		<table class="table">
			<thead>
				<tr>
					<th>Parametar</th>
					<th>Opis parametra</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php foreach ($opcioniParametri as $keyp => $parametar): ?>


					<td class="col-md-4" style=""><a href="#"><?php echo $parametar['param'];?></a></td>
					<td class="col-md-8" style=""><p><?php echo $parametar['opis'];?></p>
						<p>Primer: <a href="#"><?php echo $parametar['primer'];?></a></p>
					</td>
				</tr>

			<?php endforeach  ?>

		</tbody>
	</table>
</div>


<?php
 } //endif
 ?>








 <?php
 if($obavezniParametri = $property['obavezni']) {?>

 <h4 style="color: #d43f3a;">Obavezni parametri</h4>
 <div class="col-md-11 col-md-offset-1">
 	<table class="table">
 		<thead>
 			<tr>
 				<th>Parametar</th>
 				<th>Opis parametra</th>
 			</tr>
 		</thead>
 		<tbody>
 			<tr>
 				<?php foreach ($obavezniParametri as $keyp => $parametar): ?>


 				<td class="col-md-4" style=""><a href="#"><?php echo $parametar['param'];?></a></td>
 				<td class="col-md-8" style=""><p><?php echo $parametar['opis'];?></p>
 					<p>Primer: <a href="#"><?php echo $parametar['primer'];?></a></p>
 				</td>
 			</tr>

 		<?php endforeach  ?>

 	</tbody>
 </table>
</div>


<?php }
//endif
?>











<?php }
?>

<div id="wrapper">
	<div class="col-md-10 col-md-offset-1">
		<div class="col-md-12" style="margin: 20px 0px 20px;">
			<h1>REST API Resources</h1>
		</div>

		<div class="col-md-12 api_func" style="margin-bottom: 40px;">


			<?php foreach ($api_functions as $key => $value){

				showOneApiFunction($value);
			} 

			?>
		</div>
			</div>

</div>
</body>
</html>