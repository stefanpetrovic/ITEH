<!DOCTYPE html>
<html>
<?php
$this->load->view('admin/head.php');
?>
<body>
  <div id="wrapper">
    <div class="row">
      <?php
      $this->load->view('admin/admin_header.php');
      //var_dump($najcitanijiClanci);
      ?>


      <!-- 3rd column -->
      <div class="col-md-10 main-col" id="news-one">
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
              
           

            <tr>
              <td><p class='heading'><?php echo $clanak->clanakID; ?></p></td>
              <td><a href='#'><p class='heading'><?php echo $clanak->naslov; ?></p></a></td>
              <td><a href='#'><p class='sm-heading'><?php echo $clanak->username; ?></p></a></td>
              <td><a href='#'><p class='sm-heading'><?php echo $clanak->datum; ?></p></a></td>
              <td><a href='#'><button type='button' class='btn btn-info'>Edit</button></a></td>
              <td><a href='#'><button type='button' class='btn btn-danger'>Delete</button></a></td>
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

      

    </div>
  </div>

   <?php
      $this->load->view('admin/admin_footer.php');
      ?>
</body>
</html>