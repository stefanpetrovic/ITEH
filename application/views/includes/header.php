<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <!-- Glavni omotac strane -->
  <div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<!-- Header -->
      <div class="row">
        <div class="col-xs-3" style="background-color: green; height: 150px;">
          logo
        </div>
        <div class="col-xs-9" style="background-color: grey; height: 150px;">
          baner
        </div>
      </div>
      <!-- Menu -->
      <div class="row">
        <div class="col-md-10 col-md-offset-1" style="height: 40px;">
          <ul class="nav nav-pills" role="tablist">
            <li class="active"><a href="#">Naslovna</a></li>
            <li><a href="#">Fudbal</a></li>
            <li><a href="#">Kosarka</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Ostali sportovi <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="kategorije/kategorijaA">Kategorija A</a></li>
                <li><a href="kategorije/kategorijaB">Kategorija B</a></li>
              </ul>
            </li>
            <li><a href="#">Kontakt</a></li>
            <li><a href="#">Najcitanije</a></li>
          </ul>
          
          <!-- <div class="row">
            <div class="col-xs-2" style="background-color: yellow; height: 30px;">Menu 1</div>
            <div class="col-xs-2" style="background-color: purple; height: 30px;">Menu 2</div>
            <div class="col-xs-2" style="background-color: yellow; height: 30px;">Menu 3</div>
            <div class="col-xs-2" style="background-color: purple; height: 30px;">Menu 4</div>
            <div class="col-xs-2" style="background-color: yellow; height: 30px;">Menu 5</div>
            <div class="col-xs-2" style="background-color: purple; height: 30px;">Menu 6</div>
            </div> -->
        </div>
      </div>
