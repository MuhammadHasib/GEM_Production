
<?php 
include "head.php";


?>


    <div class="container-fluid">
      <div class="row">
        
<?php  include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Search result for <?php echo $_GET["id"]; ?></h1>


      <ul class="list-group">
            <?php if(strpos($_GET["id"],'SUP-GE1/1') !== false) {?>
            <li class="list-group-item"><div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Super chamber</h3>
            </div>
            <div class="panel-body">
              <?php if(strpos($_GET["id"],'SUP-GE1/1') !== false) {echo "Super Chamber: ".$_GET["id"]." <a href='show_sup_chamber.php?id=".$_GET["id"]."'>Show</a>";} else echo "N/A"; ?>
            </div>
          </div></li>
          <?php } ?>
          <?php   if( (strpos($_GET["id"],'SUP-GE1/1') !== 0) && (strpos($_GET["id"],'GE1/1') !== false) ) {?>
            <li class="list-group-item"><div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Single chamber</h3>
            </div>
            <div class="panel-body">
              <?php if(strpos($_GET["id"],'GE1-1') !== false) {echo "Chamber: ".$_GET["id"]." <a href='show_chamber.php?id=".$_GET["id"]."'>Show</a>";} else echo "N/A"; ?>
            </div>
          </div></li>
          <?php } ?>
          
          <?php if (strpos($_GET["id"], 'PCB_DR') !== false || strpos($_GET["id"], 'PCB_RO') !== false || strpos($_GET["id"], 'FOIL') !== false) {?>
            <li class="list-group-item"><div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Part</h3>
            </div>
            <div class="panel-body">
                <?php
                if (strpos($_GET["id"], 'PCB_DR') !== false) {
                    echo "Drift: " . $_GET["id"]." <a href='show_drift.php?id=".$_GET["id"]."'>Show</a>";;
                } elseif (strpos($_GET["id"], 'PCB_RO') !== false) {
                    echo "Readout: " . $_GET["id"]." <a href='show_readout.php?id=".$_GET["id"]."'>Show</a>";;
                } elseif (strpos($_GET["id"], 'FOIL') !== false) {
                    echo "GEM Foil: " . $_GET["id"]." <a href='show_gem.php?id=".$_GET["id"]."'>Show</a>";;
                } else
                    echo "N/A";
                ?>

            </div>
          </div></li>
          <?php } ?>
          </ul>
          
          
    </div>


</div>
        </div>
  <?php 
include "foot.php";

?>
