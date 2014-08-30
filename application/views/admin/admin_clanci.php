<!-- <!DOCTYPE html>
<html>
<?php
//$this->load->view('admin/head.php');
?>
<body>
  <div id="wrapper">
    <div class="row"> -->
      <?php
      //$this->load->view('admin/admin_header.php');
      //var_dump($najcitanijiClanci);
      ?>


      <!-- 3rd column -->
      <div class="col-md-9 main-col" id="news-one">

        <div class="col-md-12 row" style="margin: 30px 10px;">
          <h3 class="col-md-3">Dodaj novi članak</h3>
          <div class="col-md-3" style="margin-top: 15px;"> <a href="<?php echo base_url(); ?>admin/noviclanak"><button type='button' class='btn btn-success'>Dodaj</button></a></div>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Naslov</th>
              <th>Autor</th>
              <th>Datum</th>
              <th>Izmena</th>
              <th>Brisanje</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($najcitanijiClanci as $clanak): ?>




            <tr id='<?php echo 'cl'.$clanak->clanakID;?>'>
              <td><p class='heading'><?php echo $clanak->clanakID; ?></p></td>
              <td><a href='<?php echo 'clanakedit?id='.$clanak->clanakID; ?>'>
                <p class='heading'><?php echo $clanak->naslov; ?></p>
              </a></td>
              <td><a href='#'><p class='sm-heading'><?php echo $clanak->username; ?></p></a></td>
              <td><a href='#'><p class='sm-heading'><?php echo $clanak->datum; ?></p></a></td>
              <td><a href='<?php echo base_url().'admin/clanakedit?id='.$clanak->clanakID; ?>'>
                <button type='button' class='btn btn-info'>Edit</button>
              </a></td>
              <td><a href='<?php echo $clanak->clanakID; ?>' class='btn btn-danger delete'>Delete
              </a></td>
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
//   echo "<li><a href='clanci?page=".($page-1)."'>&laquo;</a></li>";
//   $smallest = -3+$page;
//   $largest = (sizeof($najcitanijiClanci)<10) ? $page : 3+$page;
//   //$largest = 3+$page;
// }



// while ($smallest <= $largest) {
//   $active =($smallest == $page) ? "active" : "";
//   if($smallest > 0){
//   echo "<li class=\"".$active."\"><a href=clanci?page=".$smallest.">".$smallest."</a></li>";
//   }
//   $smallest++;
// }

//  echo "<li><a href='clanci?page=".($page+1)."'>&raquo;</a></li>";

?>
<?php
echo $pagination;
?>

       <!--    <li><a href="#">&laquo;</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">&raquo;</a></li> -->
        </ul>
      </div>
    </div>  <!-- End of 2nd column -->



<!--   </div>
</div> -->

<?php
//$this->load->view('admin/admin_footer.php');
?>

<!-- <div class="col-md-12" id='dump'>
</div> -->

<script type="text/javascript">

$('.btn.delete').click(function(){

 var address = $(this).attr('href');
 //var uri = 'admin/obrisi_clanak/'+address;
 var form_data = {
   ajax: '1'
 };

 $.ajax({
   url: "<?php echo site_url('admin/obrisi_clanak/"+address+"'); ?>",
   type: 'POST',
   data: form_data,
   async: false,
   success: function(msg){
    //$('#dump').append(msg);
    $('#crud_message').append(msg).show();
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


</script>
<!-- </body>
</html> -->