      <div class="col-md-9 main-col" id="news-one">

        <h2 style="margin:40px 4px;">Korisnici</h2>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Username</th>
              <th>Email</th>
              <th>Nivo privilegija</th>
              <th>Izmeni</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $privilegije = [
                              1    =>    "Regular",
                              2    =>    "Administrator"
            ];  

            foreach ($korisnici as $korisnik): ?>




            <tr id='<?php echo 'cl'.$korisnik->korisnikID;?>'>
              <td><p class='heading'><?php echo $korisnik->korisnikID; ?></p></td>
              <td>
                <p class='heading headd' id='user<?php echo $korisnik->korisnikID; ?>'><?php echo $korisnik->username; ?></p>
              </td>
              <td>
                <p class='heading headd'><?php echo $korisnik->email; ?></p>
              </td>
              <td><p class='heading headd'><?php echo $privilegije[$korisnik->nivoPrivilegija]; ?></p></td>
              <td><a href='<?php echo 'korisnik_edit?id='.$korisnik->korisnikID; ?>'>
                <button type='button' class='btn btn-info'>Edit</button>
              </a></td>
            </tr>
            





            
          <?php endforeach ?>
        </tbody>
      </table>

      <div align="center">
        <ul class="pagination">
          <li><a href="#">&laquo;</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">&raquo;</a></li>
        </ul>
      </div>
    </div>  <!-- End of 2nd column -->






    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Izmeni!</h4>
          </div>
          <div class="modal-body">
            <!-- Modal body -->

            <form class="form-horizontal" role="form">
             <input type="hidden" class="form-control" id="id" name="id_edit" value="" >
             <div class="form-group">
              <label for="name" class="col-md-2 control-label">Novi naziv</label>
              <div class="col-md-10">
                <input type="text" id="name" class="form-control" placeholder="Your name" name="name">
              </div>
            </div>

          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
          <button type="button" class="btn btn-primary" id="edit" data-dismiss="modal">Izmeni</button>
        </div>
      </div>
    </div>
  </div> <!-- End of modal -->






  <script type="text/javascript">
  function loadScript () {



    var edit;
//pojavljivanje modala za edit
$('.editer').click(function(){
  var valueH = $(this).closest('tr').find('.headd').text();
  edit = $(this).closest('tr').attr('id');
  edit = edit.substring(2, edit.length);
  $('#myModal').find('#name').val(valueH);
 // $('#myModal').find('#id_edit').val(edit);

 // alert($('#name').val());
});

$('#edit').click(function(){

  $('#myModal').find('#name').val();

  var form_data = {

    id: edit+'',
    naziv: $('#name').val(),
    ajax: '1'
  };

  $.ajax({
   url: "<?php echo site_url('admin/izmeni_kategoriju/"+edit+"'); ?>",
   type: 'POST',
   data: form_data,
   async: false,
   success: function(msg){
     $('#myModal').modal('hide');
     $('#crud_message').empty().append(msg).show();
     function hide(){
       $( "#crud_message" ).fadeOut('slow');
     }
     if(msg=="Uspešno ste izmenili kategoriju"){
      $("#heading"+edit).empty().append($('#name').val());
    }
    


    setTimeout(hide,3000);
  //  var id = '#cl'+edit;
  //  $(id).remove();
}
});

  return false;


});



//unos novog
// $('#nova_kategorija').click(function(){

//  var form_data = {
//    naziv: $('#nova_kat').val(),
//    ajax: '1'
//  };

//  $.ajax({
//    url: "<?php echo site_url('admin/dodaj_kategoriju'); ?>",
//    type: 'POST',
//    data: form_data,
//    success: function(msg){
//     // $('#dump').append(msg);
//     //  $('#crud_message').append(msg).show();
//     //  function hide(){
//     //    $( "#crud_message" ).fadeOut('slow');
//     //  }
//     //  setTimeout(hide,3000);



//    var tr = $(document.createElement('tr')).attr("id","cl"+msg);

//    var td1 = $(document.createElement('td')).append(
//     $('<p />')
//     .addClass("heading")
//     .text(msg));
//     tr.append(td1);

//     var td2 = $(document.createElement('td')).append(
//     $('<p />')
//     .addClass("heading")
//     .attr("id","heading")
//     .text($('#nova_kat').val()));
//     tr.append(td2);








//     var td3= $(document.createElement('td')).append(
//       $('<a />')
//       .attr("id", "newDiv1")
//       .attr("href", "#")

//       .attr("data-toggle", "modal")
//       .attr("data-target", "#myModal")
//      //.atrr("data-target", "#myModal")
//       .append($('<button />')
//               .addClass("btn btn-info editer")
//               .attr("type", "button")
//               .text("Edit")));
//       tr.append(td3);


// var td4= $(document.createElement('td')).append(
//       $('<a />')
//       .attr("href", msg)
//               .addClass("btn btn-danger delete")
//               .text("Delete"));
//       tr.append(td4);

//   $('#clnew').before(tr);



// loadScript();
//   }

// });

//  return false;


// });


// $('#nova_kategorija').click(function(){
//    var tr = $(document.createElement('tr'));
//     tr.append('<td>d</td>').append('<td>d</td>').append('<td>d</td>').append('<td>d</td>');
//     $('#clnew').before(tr);
// })




//brisanje

$('.delete').click(function(){

 var address = $(this).attr('href');
 //var uri = 'admin/obrisi_clanak/'+address;
 var form_data = {
   ajax: '1'
 };

 $.ajax({
   url: "<?php echo site_url('admin/obrisi_kategoriju/"+address+"'); ?>",
   type: 'POST',
   data: form_data,
   async: false,
   success: function(msg){
    //$('#dump').append(msg);
    $('#crud_message').empty().append(msg).show();
    function hide(){
     $( "#crud_message" ).fadeOut('slow');
   }
   setTimeout(hide,3000);

   var id = '#cl'+address;
   $(id).remove();
 }
});

 return false;


});

} //end of laodScript function

loadScript();

</script>