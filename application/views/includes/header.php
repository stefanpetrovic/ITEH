<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sportske vesti</title>
    

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/custom-frontend.css" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
        <div class="col-xs-3" style="height: 150px; background-image: url('<?php echo base_url()?>images/logo.png'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: border-box;">
          
        </div>
        <div class="col-xs-9" style="height: 150px; background-image: url('<?php echo base_url()?>images/banner.png'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: border-box;">
          
        </div>
      </div>
      <!-- Menu -->
      <div class="row" style="height: 60px;">
        <div class="col-md-10 col-md-offset-1" style="height: 40px; padding: 10px;">
          <ul class="nav nav-pills" role="tablist">
            <li class="active"><a href="<?php echo base_url().'site/index';?>">Naslovna</a></li>
            <li><a href="<?php echo base_url() . 'site/vestiPoKategoriji/fudbal/0';?>">Fudbal</a></li>
            <li><a href="<?php echo base_url() . 'site/vestiPoKategoriji/kosarka/0';?>">Kosarka</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Ostali sportovi <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Kategorija A</a></li>
                <li><a href="#">Kategorija B</a></li>
              </ul>
            </li>
            <li><a href="#">Kontakt</a></li>
            <li><a href="#">Najcitanije</a></li>
          </ul>
        </div>
      </div>
