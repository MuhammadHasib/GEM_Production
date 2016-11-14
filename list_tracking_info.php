
<?php 
include "head.php";


?>


    <div class="container-fluid">
      <div class="row">
        
<?php  include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">List tracking information</h1>
          <?php 
           if (!isset($_POST['serialnum']) ) {
                        ?>
          <form method="POST" action="">
                            <div class="form-group">
                                
                                
                                <label for="exampleInputFile">Please type the item Serial Number: </label>
                                <input class="num" name="serialnum" value=""  onblur="if($(this).val() !== '' && $('#kindofpart').val() !== '')$('.subbutt_at').attr('disabled', false);">
                                
                                
                            </div>
                            <button type="submit" class="btn btn-default btn-lg subbutt_at" disabled="true" >Next</button>
                        </form>
                    <?php } ?>

          <?php 
           if (isset($_POST['serialnum']) ) {
                        ?>
          <h2 class="sub-header">Tracking info found for: <?= $_POST['serialnum']; ?> </h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th><i class="ace-icon glyphicon glyphicon-map-marker"></i> <span aria-hidden="true" class="glyphicon glyphicon-log-out"></span>Shipped From </th>
                  <th><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span><i class="ace-icon glyphicon glyphicon-map-marker"></i> Destination</th>
                  <th>Date Shipped</th>
                  <th>Mode</th>
                  <th>Info</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php $items= get_tracking_info($_POST['serialnum']);
          //print_r($drifts);
           $i = 1;      
          foreach( $items as $item){
               
              echo '<tr>
                  <td>' .$i .' </td>
                  <td>'.$item['SHIPPED_FROM'].'</td>
                  <td>'.$item['DESTINATION'].'</td>
                  <td>'.$item['DATE_SHIPPED'].'</td>
                  <td>'.$item['MODE_SHIPPED'].'</td>
                  <td>'.$item['ADDN_SHIPPING_INFO'].'</td>
                  <td>'.$item['STATUS'].'</td>
                  
                  
                </tr>';
              $i++;
          }
          
          ?>
                

              </tbody>
            </table>
          </div>
          <?php 
           }
                        ?>
        </div>
      </div>
    </div>



  <?php 
include "foot.php";

?>
