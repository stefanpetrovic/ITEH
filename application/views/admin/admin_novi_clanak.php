<!-- <!DOCTYPE html>
<html>
<?php
//$this->load->view('admin/head.php');
?>
<body>
  <div id="wrapper">
    <div class="row"> -->
      <?php
     // $this->load->view('admin/admin_header.php');

      //parametar proleđen - niz kategorija u varijabli $kategorije
      ?>


      <!-- Article column -->
      <div class="col-md-9 main-col" id="news-one">

        <h2 class="col-md-offset-2">Dodaj novi članak</h2>
        <form class="form-horizontal" role="form" action="action" method="post">

          <div class="form-group">
            <label for="heading" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">

              <input type="hidden" class="form-control" id="id" name="id" value="" >
            </div>
          </div>


          <div class="form-group">
            <label for="naslov" class="col-sm-2 control-label">Naslov</label>
            <div class="col-sm-10">

              <input type="text" class="form-control" id="naslov" name="naslov" value="">
            </div>
          </div>
          
          <div class="form-group">
            <label for="fimage" class="col-sm-2 control-label">Featured image</label>
            <div class="col-sm-10">

              <input type="text" class="form-control" id="fimage" name="fimage" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="kratki_text" class="col-sm-2 control-label">Kratki tekst</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="kratki_text" rows="3" name="kratki_text" style="height: 150px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="dugi_text" class="col-sm-2 control-label">Dugi tekst</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="dugi_text" rows="3" name="dugi_text" style="height: 400px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="author" class="col-sm-2 control-label">Odaberi kategorije</label>
            <div class="col-sm-10">

              <?php foreach ($kategorije as $id => $kategorija): ?>
              <div class='checkbox'>
                <label>
                  <input type='checkbox' name='chx' value='<?php echo $kategorija->kategorijaID; ?>'
                  >
                  <?php echo $kategorija->naziv;?>
                </label>
              </div>        
            <?php endforeach ?>


          </div>
        </div>
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary pull-right" id="submit">Dodaj</button>
        </div>
      </form>

    </div>  <!-- End of 2nd column -->


<!--   </div>
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
   fimage: $('#fimage').val(),
   kratki_text: $('#kratki_text').val(),
   dugi_text: $('#dugi_text').val(),
   kategorije: checked,
   ajax: '1'
 };

 $.ajax({
   url: "<?php echo site_url('admin/dodaj_clanak'); ?>",
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
</html> -->