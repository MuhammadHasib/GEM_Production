
<?php
include "head.php";
?>
<?php include "head_panel.php"; ?>


<ul class="list-group">
<div class="container-fluid">
    <div class="row">
<?php include "side.php"; ?>
<!--        <div class="col-xs-6 col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-2 main">-->
        <div class="col-xs-6 col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            
            <h1 class="page-header">Quality control list</h1>



          <div class="row placeholders">
            <a href="list_qc1.php">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/parts.png" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>QC1</h4>
              <span class="text-muted">PCB Test</span>
            </div>
            </a>
            <a href="list_qc2.php">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/parts.png" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>QC2</h4>
              <span class="text-muted">Foil Test</span>
            </div>
            </a>
            <a href="list_qc3.php">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/c1.bmp" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>QC3</h4>
              <span class="text-muted">Leak Test</span>
            </div>
            </a>
            <a href="list_qc4.php">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/sc1.bmp" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>QC4</h4>
              <span class="text-muted">HV Test</span>
            </div>
            </a>
          </div>
        <div class="row placeholders">    
            <a href="list_qc5.php">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/qc.png" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>QC5</h4>
              <span class="text-muted">Gain Test</span>
            </div>
            </a>
	<a href="list_qc6.php">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/qc.png" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 150px;">
              <h4>QC6</h4>
              <span class="text-muted">HV Test</span>
            </div>
            </a>
          </div>
<!--
                <li class="list-group-item"><div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Visual Inspection</h3>
                </div>
                <div class="panel-body">
                  <a href="new_qc_inspxn.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Report Visual inspection </button></a>
                </div>
              </div></li>

                            <li class="list-group-item"><div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">IV Characteristics</h3>
                            </div>
                            <div class="panel-body">
                             <a href="new_qc_iv.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new IV Characteristics</button></a>
                            </div>
                          </div></li>
                <li class="list-group-item" style="text-align:center">
                        <span class="label label-warning"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Notification !!</span>
                          <div class="alert alert-warning" role="alert" style="text-align: center;"><span aria-hidden="true" class="glyphicon glyphicon-wrench"></span> Still Under Development, We'll keep you informed Soon <span aria-hidden="true" class="glyphicon glyphicon-hourglass"></span></div> 
                </li>

                <li class="list-group-item">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cosmic Stand layout</h3>
                        </div>
                        <div class="panel-body">
                            <img width="10%" src="images/cosmicStand.png">
                            <a href="qc_cosmic_stand_layout.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Setup</button></a>
                        </div>
                    </div>-->
                </li>

            </ul>

        </div>

    </div>
</div>



<?php
include "foot.php";
?>
<script>
    $("#qc").attr("class", "active");
</script>
