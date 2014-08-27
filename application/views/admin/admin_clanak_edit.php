<!-- <!DOCTYPE html>
<html> -->
<?php
//$this->load->view('admin/head.php');
?>
<!-- <body>
  <div id="wrapper">
    <div class="row"> -->
      <?php
     // $this->load->view('admin/admin_header.php');
      //članci u nizu
      $kategorijeClanka = $article[0]['kategorije'];
      $article = $article[0][0];
      //var_dump($article);
      //var_dump($kategorijeClanka);
      //još jedan parametar proleđen - niz kategorija u varijabli $kategorije
      ?>


      <!-- Article column -->
      <div class="col-md-9 main-col" id="news-one">

        <h2 class="col-md-offset-2">Izmeni članak</h2>
        <form class="form-horizontal" role="form" action="edt_clanak" method="post">

          <div class="form-group">
            <label for="heading" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">

              <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $article->clanakID; ?>" >
            </div>
          </div>

          <div class="form-group">
            <label for="naslov" class="col-sm-2 control-label">Broj pregleda</label>
            <div class="col-sm-10">

              <input type="text" class="form-control" id="brojPregleda" name="brojPregleda" value="<?php echo $article->brojPregleda;?>" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="naslov" class="col-sm-2 control-label">Naslov</label>
            <div class="col-sm-10">

              <input type="text" class="form-control" id="naslov" name="naslov" value="<?php echo $article->naslov;?>">
            </div>
          </div>
          <div class="form-group">
            <label for="datum" class="col-sm-2 control-label">Datum</label>
            <div class="col-sm-10">

              <input type="text" class="form-control" id="datum" name="datum" value="<?php echo $article->datum;?>">
            </div>
          </div>
          <div class="form-group">
            <label for="fimage" class="col-sm-2 control-label">Featured image</label>
            <div class="col-sm-10">

              <input type="text" class="form-control" id="fimage" name="fimage" value="<?php echo $article->featuredImage;?>">
            </div>
          </div>
          <div class="form-group">
            <label for="kratki_text" class="col-sm-2 control-label">Kratki tekst</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="kratki_text" rows="3" name="kratki_text" style="height: 150px;"><?php echo $article->kratakTekst;?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="dugi_text" class="col-sm-2 control-label">Dugi tekst</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="dugi_text" rows="3" name="dugi_text" style="height: 400px;"><?php echo $article->dugiTekst;?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="author" class="col-sm-2 control-label">Odaberi kategorije</label>
            <div class="col-sm-10">

              <?php foreach ($kategorije as $id => $kategorija): ?>
              <div class='checkbox'>
                <label>
                  <input type='checkbox' name='chx' value='<?php echo $kategorija->kategorijaID; ?>'
                  <?php 
                  if($kategorijeClanka != false)
                  foreach ($kategorijeClanka as $kategorijaClanka) {
                    if($kategorijaClanka->kategorijaID == $kategorija->kategorijaID){
                      echo 'checked';
                    } else {
                      echo '';
                    }
                  }?>
                  >
                  <?php echo $kategorija->naziv;?>
                </label>
              </div>        
            <?php endforeach ?>


          </div>
        </div>
        <div class="col-md-12">
         <button type="submit" class="btn btn-primary pull-right" id="submit">Izmeni</button>
       </div>
     </form>


   </div>  <!-- End of 2nd column -->


<!--  </div>
</div> -->

<?php
//$this->load->view('admin/admin_footer.php');
?>
<!-- <div class="col-md-12" id='dump'>
</div> -->
<script type="text/javascript">

$('#submit').click(function(){

 var checked = new Array();   
 $("input:checkbox[name=chx]:checked").each(function()
 {
  checked.push($(this).val());
});

 var form_data = {
   id: $('#id').val(),
   naslov: $('#naslov').val(),
   datum: $('#datum').val(),
   fimage: $('#fimage').val(),
   kratki_text: $('#kratki_text').val(),
   dugi_text: $('#dugi_text').val(),
   kategorije: checked,
   ajax: '1'
 };

 $.ajax({
   url: "<?php echo site_url('admin/edit_clanak'); ?>",
   type: 'POST',
   data: form_data,
   success: function(msg){
    $('#dump').append(msg);
     $('#crud_message').append(msg).show();
     function hide(){
       $( "#crud_message" ).fadeOut('slow');
     }
     setTimeout(hide,3000);
  }
});

 return false;


});


</script>
<!-- </body>
</html>