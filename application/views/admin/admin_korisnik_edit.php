<?php
$korisnik = $korisnik[0];
?>
<!-- Article column -->
<div class="col-md-9 main-col" id="news-one">

  <h2 class="col-md-offset-2">Izmeni podatke korisnika</h2>
  <form class="form-horizontal" role="form" action="edt_clanak" method="post">

    <div class="form-group">
      <label for="heading" class="col-sm-2 control-label"></label>
      <div class="col-sm-10">

        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $korisnik->korisnikID; ?>" >
      </div>
    </div>

    <div class="form-group">
      <label for="username" class="col-sm-2 control-label">Korisničko ime</label>
      <div class="col-sm-10">

        <input type="text" class="form-control" id="username" name="username" value="<?php echo $korisnik->username;?>" disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">

        <input type="email" class="form-control" id="email" name="email" value="<?php echo $korisnik->email;?>">
      </div>
    </div>



    <div class="form-group">
      <label for="author" class="col-sm-2 control-label">Podesi nivo privilegija</label>
      <div class="col-sm-10">

        <?php 
        $privilegije = [
        "Običan korisnik"   =>  1,
        "Administrator"     =>  2,
        ];

        foreach ($privilegije as $opis => $vrednost): ?>
        <div class='radio'>
          <label>
            <input type='radio' name='status' value='<?php echo $vrednost; ?>'
            <?php
            if($korisnik->nivoPrivilegija == $vrednost){
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
   email: $('#email').val(),
   nivoPrivilegija: selectedVal,
   ajax: '1'
 };

 $.ajax({
   url: "<?php echo site_url('admin/edit_korisnika'); ?>",
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