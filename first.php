
<?php 
include "head.php";

?>


    <div class="container-fluid">
      <div class="row">
<?php  include "side.php"; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>

          <div class="row placeholders">
            <a href="list_parts.php">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/parts.png" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>Parts</h4>
              <span class="text-muted">Add/Edit/List detector parts</span>
            </div>
            </a>
            <a href="list_chambers.php">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/c1.bmp" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>Chambers</h4>
              <span class="text-muted">Add/Edit/List single chambers</span>
            </div>
            </a>
            <a href="list_sup_chambers.php">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/sc1.bmp" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>Super Chambers</h4>
              <span class="text-muted">Add/Edit/List Super chambers</span>
            </div>
            </a>
            <a href="list_qc.php">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/qc.png" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>Quality controls</h4>
              <span class="text-muted">Add/Edit/List Quality controls</span>
            </div>
            </a>
          </div>
          
          <div class="row placeholders">
              <a href="track_parts_step1.php">
            <div class="col-xs-6 col-sm-3 placeholder">
                <img src="images/tracking1.png" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>Track Parts</h4>
              <span class="text-muted">track all components</span>
            </div>
            </a>
              <a href="search_channels_pin.php">
            <div class="col-xs-6 col-sm-3 placeholder">
                <img src="images/tracking_channels1.png" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>GEM Channel Mapping</h4>
              <span class="text-muted">Search for connector pin numbers</span>
            </div>
            </a>
            
          </div>
<!--
          <h2 class="sub-header">Section title</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1,001</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>dolor</td>
                  <td>sit</td>
                </tr>
                <tr>
                  <td>1,002</td>
                  <td>amet</td>
                  <td>consectetur</td>
                  <td>adipiscing</td>
                  <td>elit</td>
                </tr>
                <tr>
                  <td>1,003</td>
                  <td>Integer</td>
                  <td>nec</td>
                  <td>odio</td>
                  <td>Praesent</td>
                </tr>
                <tr>
                  <td>1,003</td>
                  <td>libero</td>
                  <td>Sed</td>
                  <td>cursus</td>
                  <td>ante</td>
                </tr>
                <tr>
                  <td>1,004</td>
                  <td>dapibus</td>
                  <td>diam</td>
                  <td>Sed</td>
                  <td>nisi</td>
                </tr>
                <tr>
                  <td>1,005</td>
                  <td>Nulla</td>
                  <td>quis</td>
                  <td>sem</td>
                  <td>at</td>
                </tr>
                <tr>
                  <td>1,006</td>
                  <td>nibh</td>
                  <td>elementum</td>
                  <td>imperdiet</td>
                  <td>Duis</td>
                </tr>
                <tr>
                  <td>1,007</td>
                  <td>sagittis</td>
                  <td>ipsum</td>
                  <td>Praesent</td>
                  <td>mauris</td>
                </tr>
                <tr>
                  <td>1,008</td>
                  <td>Fusce</td>
                  <td>nec</td>
                  <td>tellus</td>
                  <td>sed</td>
                </tr>
                <tr>
                  <td>1,009</td>
                  <td>augue</td>
                  <td>semper</td>
                  <td>porta</td>
                  <td>Mauris</td>
                </tr>
                <tr>
                  <td>1,010</td>
                  <td>massa</td>
                  <td>Vestibulum</td>
                  <td>lacinia</td>
                  <td>arcu</td>
                </tr>
                <tr>
                  <td>1,011</td>
                  <td>eget</td>
                  <td>nulla</td>
                  <td>Class</td>
                  <td>aptent</td>
                </tr>
                <tr>
                  <td>1,012</td>
                  <td>taciti</td>
                  <td>sociosqu</td>
                  <td>ad</td>
                  <td>litora</td>
                </tr>
                <tr>
                  <td>1,013</td>
                  <td>torquent</td>
                  <td>per</td>
                  <td>conubia</td>
                  <td>nostra</td>
                </tr>
                <tr>
                  <td>1,014</td>
                  <td>per</td>
                  <td>inceptos</td>
                  <td>himenaeos</td>
                  <td>Curabitur</td>
                </tr>
                <tr>
                  <td>1,015</td>
                  <td>sodales</td>
                  <td>ligula</td>
                  <td>in</td>
                  <td>libero</td>
                </tr>
              </tbody>
            </table>
          </div>-->
        </div>
      </div>
    </div>



  <?php 
include "foot.php";

?>
<script>
$("#dash").attr("class","active");
</script>