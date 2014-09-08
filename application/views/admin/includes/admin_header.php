  <!DOCTYPE html>
<html>
<?php
$this->load->view('admin/head.php');
?>
<body>
  <div id="wrapper">

<!-- This div is top fixed and appears only to show messages -->
    <div id="crud_message"></div>

    <div class="row">
<div class="col-md-2 main-col" id="nav-holder">

<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <a href="<?php echo base_url()."site";?>"><img src="<?php echo base_url();?>images/logo.png" style="width: 100%;"></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav" id="menu">
      <li class>
        <!-- <a href="../admin"> -->
        <a href="<?php echo base_url() . 'admin';?>">
        Početna
      </a></li>
      <li class>
        <!-- <a href="clanci"> -->
        <a href="<?php echo base_url() . 'admin/clanci';?>">
        Članci
      </a></li>
      <li><a href="<?php echo base_url() . 'admin/kategorije';?>">
       Kategorije
      </a></li>
      <li class><a href="<?php echo base_url() . 'admin/komentari';?>">
        Komentari
      </a></li>
      <li class><a href="<?php echo base_url() . 'admin/korisnici';?>">
        Korisnici
      </a></li>
      
    </ul>
   
      
  </div><!-- /.navbar-collapse -->
</nav>

  </div><!-- /.menu end -->


 
  