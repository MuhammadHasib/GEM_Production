
<?php 
include "head.php";


?>


    <div class="container-fluid">
      <div class="row">
        
<?php  include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Component Tracking </h1>

          <a href="track_parts.php" class="btn btn-default btn-app radius-4">
                <span aria-hidden="true" class="glyphicon glyphicon-globe"></span>
                <br>
                Add <br>Tracking info
                <span class="badge badge-success"><i class="ace-icon glyphicon glyphicon-plus"></i></span>
            </a>
            
          <a class="btn btn-default btn-app radius-4" href="list_tracking_info.php">
                <span aria-hidden="true" class="glyphicon glyphicon-globe"></span>
                <br>
                List <br>Tracking info
                <span class="badge badge-success"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></span>
            </a>
          
        </div>
      </div>
    </div>



  <?php 
include "foot.php";

?>
