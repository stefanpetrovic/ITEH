
<!-- 3rd column -->
<div class="col-md-9 main-col" id="news-one">

  <h2 style="margin:40px 4px;">Komentari</h2>

  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th><a href="<?php echo current_url();?>/?sort=status&c=t">Status</a></th>
        <th><a href="<?php echo current_url();?>/?sort=korisnik&c=t">Autor</a></th>
        <th>Komentar</th>
        <th>Članak</th>
        <th><a href="<?php echo current_url();?>/?sort=datum&c=t">Datum</a></th>
        <th>Odobri</th>
        <th>Arhiviraj</th>
      </tr>
    </thead>
    <tbody>
      <?php 

      function returnColor($status){
        switch ($status) {
          case '0': 
          return "#f0ad4e";
          break;
          case '1':
          return "#449d44";
          break;
          case '-1':
          return "#c9302c";
          break;
          default:
          return "#0000FF";
          break;
        }
      }

      function createOdobri($id){
        echo "<td><a href=".base_url().'admin/odobrikomentar/'.$id.">
        <button type='button' class='btn btn-success'>Odobri</button>
        </a></td>";
      }

      function createDraftuj($id){
       echo "<td><a href=".base_url().'admin/draftujkomentar/'.$id.">
       <button type='button' class='btn btn-warning'>Draftuj</button>
       </a></td>";
     }
     function createOdbij($id){
       echo "<td><a href=".base_url().'admin/odbijkomentar/'.$id.">
       <button type='button' class='btn btn-danger'>Odbij</button>
       </a></td>";
     }
     function createDugmad($status, $id){
      switch ($status) {
        case '0': 
        createOdobri($id);
        createOdbij($id);
        break;
        case '1':
        createDraftuj($id);
        createOdbij($id);
        break;
        case '-1':
        createOdobri($id);
        createDraftuj($id);
        break;
        default:
        echo "<td></td><td></td>";
        break;
      }
    }


    if(!empty($komentari))
      foreach ($komentari as $komentar): ?>



    <tr id='<?php echo 'cl'.$komentar->komentarID;?>'>
      <td style="background-color: <?php echo returnColor($komentar->odabran)?>"><p class='heading'> </p></td>
      <td><p class='sm-heading'><?php echo $komentar->username; ?></p>
      </td>
      <td><a href='<?php echo base_url()."admin/clanak?id=".$komentar->komentarID; ?>'>
        <p class='sm-heading'><?php echo substr($komentar->tekst,0,20); ?></p>
      </a></td>
      <td>
        <p class='sm-heading'><?php echo substr($komentar->naslov,0,20); ?></p>
      </td>
      <td><p class='sm-heading'><?php echo $komentar->datum; ?></p></td>
      <?php createDugmad($komentar->odabran, $komentar->komentarID) ?>

    </tr>

  <?php endforeach ?>


</tbody>
</table>

</tbody>
</table>

<div align="center">
  <ul class="pagination">

    <?php
// if($page == false || $page==1){
//   $page = '1';
//   echo "<li class=\"disabled\"><a href='#'>&laquo;</a></li>";
//   $smallest = '1';
//   $largest = '6';
// } else {
//   echo "<li><a href='komentari?page=".($page-1)."'>&laquo;</a></li>";
//   $smallest = -3+$page;
//   $largest = (sizeof($komentari)<10) ? $page : 3+$page;
//   //$largest = 3+$page;
// }



// while ($smallest <= $largest) {
//   $active =($smallest == $page) ? "active" : "";
//   if($smallest > 0){
//   echo "<li class=\"".$active."\"><a href=komentari?page=".$smallest.">".$smallest."</a></li>";
//   }
//   $smallest++;
// }

//  echo "<li><a href='komentari?page=".($page+1)."'>&raquo;</a></li>";

    ?>
    <?php
    echo $pagination;
    ?>


<!-- 
          <li><a href="#">&laquo;</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">&raquo;</a></li> -->
        </ul>
      </div>
    </div>  <!-- End of 2nd column -->



    <script type="text/javascript">

// $('.btn.delete').click(function(){

//  var address = $(this).attr('href');
//  //var uri = 'admin/obrisi_clanak/'+address;
//  var form_data = {
//    ajax: '1'
//  };

//  $.ajax({
//    url: "<?php echo site_url('admin/obrisi_clanak/"+address+"'); ?>",
//    type: 'POST',
//    data: form_data,
//    async: false,
//    success: function(msg){
//     //$('#dump').append(msg);
//     $('#crud_message').append(msg).show();
//    function hide(){
//        $( "#crud_message" ).fadeOut('slow');
//      }
//      setTimeout(hide,3000);

//     var id = '#cl'+address;
//     $(id).remove();
//   }
// });

//  return false;


// });


</script>
