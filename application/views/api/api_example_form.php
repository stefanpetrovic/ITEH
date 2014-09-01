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


<div id="wrapper">
	<div class="col-md-10 col-md-offset-1">
		<div class="col-md-12" style="margin: 20px 0px 20px;">
			<h1>API Example</h1>
		</div>
		<form class="form-horizontal" role="form" action="<?php echo base_url().'api/example_result';?>" method="POST">
			<div class="form-group">
				<label for="author" class="col-sm-2 control-label">Autor(i)</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="author" placeholder="name1,name2,name3.." name="author">
				</div>
			</div>
			<div class="form-group">
				<label for="naslov" class="col-sm-2 control-label">Naslov</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="naslov" placeholder="ex: word1,word2,word3..." name="heading">
				</div>
			</div>
			<div class="form-group">
				<label for="text" class="col-sm-2 control-label">Tekst</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="text" placeholder="ex: word1,word2,word3..." name="text">
				</div>
			</div>
			<div class="form-group">
				<label for="broj_cl" class="col-sm-2 control-label">Broj članaka:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="broj_cl" placeholder="ex: word1,word2,word3..." name="num">
				</div>
			</div>
			<div class="form-group">
				<label for="kategorije" class="col-sm-2 control-label">Kategorije:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="kategorije" placeholder="ex: word1,word2,word3..." name="kategorije">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Preuzmi podatke</button>
				</div>
			</div>
		</form>

		<div class="col-md-12 api_func" style="margin-bottom: 40px;">

			
		</div>
			</div>

</div>
</body>
</html>