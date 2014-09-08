 <?php
//var_dump($komentar);
 $komentar = $komentar[0];
 ?>


 <!-- Article column -->
 <div class="col-md-8 main-col" id="news-one">

  <h2 class="col-md-offset-2">Izmeni komentar</h2>
  <form class="form-horizontal" role="form" action="edt_clanak" method="post">

    <div class="form-group">
      <label for="heading" class="col-sm-2 control-label"></label>
      <div class="col-sm-10">

        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $komentar->komentarID; ?>" >
      </div>
    </div>

    <div class="form-group">
      <label for="komentator" class="col-sm-2 control-label">Komentator</label>
      <div class="col-sm-10">

        <input type="text" class="form-control" style = "width: 200px;" id="komentator" name="komentator" value="<?php echo $komentar->username;?>" disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="datum" class="col-sm-2 control-label">Datum</label>
      <div class="col-sm-10">

        <input type="text" class="form-control" style = "width: 200px;" id="datum" name="datum" value="<?php echo $komentar->datum;?>" disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="likes" class="col-sm-2 control-label">Likes</label>
      <div class="col-sm-10">

        <input type="text" class="form-control" style = "background-color: #449d44; color: #fff; width: 100px;" id="likes" name="likes" value="<?php echo $komentar->likes;?>"disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="dislikes" class="col-sm-2 control-label">Dislikes</label>
      <div class="col-sm-10">

        <input type="text" class="form-control" style = "background-color: #c9302c; color: #fff; width: 100px;" id="dislikes" name="dislikes" value="<?php echo $komentar->dislikes;?>" disabled>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
        <div id="clanak_info">
         <div class="form-group">
          <label for="naslov_clanka" class="col-sm-2 control-label">Naslov teksta</label>
          <div class="col-sm-10">

            <input type="text" class="form-control" id="naslov_clanka" name="naslov_clanka" value="<?php echo $komentar->naslov;?>" disabled>
          </div>
        </div>
        <div class="form-group">
          <label for="kratki_text" class="col-sm-2 control-label">Kratki tekst članka</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="kratki_text" rows="3" name="kratki_text" style="height: 150px;" disabled><?php echo$komentar->tekstClanka;?></textarea>
          </div>
        </div>

      </div> <!-- End of clanak_info -->

    </div>

  </div>
  <div class="form-group">
    <label for="tekst_komentara" class="col-sm-2 control-label">Tekst komentara</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="tekst_komentara" rows="3" name="tekst_komentara" style="height: 150px;"><?php echo $komentar->tekst;?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="author" class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">

      <?php 
      $odobrenost = [
      "Odbijen"   => -1,
      "Draftovan" =>  0,
      "Odobren"   =>  1
      ];

      foreach ($odobrenost as $opis => $vrednost): ?>
      <div class='radio'>
        <label>
          <input type='radio' name='status' value='<?php echo $vrednost; ?>'
          <?php
          if($komentar->odabran == $vrednost){
            echo 'checked';
          } else echo '';
          ?>
          >
          <?php echo $opis;?>
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
var selectedVal = "";
var selected = $("input[type='radio'][name='status']:checked");
if (selected.length > 0) {
    selectedVal = selected.val();
}

 var form_data = {
   id: $('#id').val(),
   tekst_komentara: $('#tekst_komentara').val(),
   dugi_text: $('#dugi_text').val(),
   status: selectedVal,
   ajax: '1'
 };

 $.ajax({
   url: "<?php echo site_url('admin/edit_komentar'); ?>",
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