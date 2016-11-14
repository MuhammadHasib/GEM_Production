
<?php 
include "head.php";


?>


    <div class="container-fluid">
      <div class="row">
        
<?php  include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Report visual inspection </h1>

<div class="col-xs-6 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading ">
                                <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-cog"></span>Attach single chambers</h3>
                            </div>
                            <div class="panel-body">
                                <span class="text-muted"></span>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Choose 1st Chamber:</label>
                                    <!--<p class="help-block">help text here.</p> -->  
                                    <input name="chamber1Id" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Chamber
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a class="FOIL-VI1" href="#"> GE1/1-VI-L-CERN-0001</a></li>
                                            <li><a class="FOIL-VI1" href="#"> GE1/1-VI-S-BARI-0002</a></li>
                                            <li><a class="FOIL-VI1" href="#"> GE1/1-VI-L-BARI-0003</a></li>
                                            <li><a class="FOIL-VI1" href="#"> GE1/1-VI-S-CERN-0004</a></li>
                                            <li><a class="FOIL-VI1" href="#"> GE1/1-VI-L-GHENT-0005</a></li>
                                        </ul>
                                    </div><br>
                                    <label for="exampleInputEmail1">Choose 2nd Chamber:</label>
                                    <input name="chamber2Id" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Chamber
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a class="FOIL-VI2" href="#"> GE1/1-VI-L-CERN-0001</a></li>
                                            <li><a class="FOIL-VI2" href="#"> GE1/1-VI-S-BARI-0002</a></li>
                                            <li><a class="FOIL-VI2" href="#"> GE1/1-VI-L-BARI-0003</a></li>
                                            <li><a class="FOIL-VI2" href="#"> GE1/1-VI-S-CERN-0004</a></li>
                                            <li><a class="FOIL-VI2" href="#"> GE1/1-VI-L-GHENT-0005</a></li>
                                        </ul>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
         
          
        </div>
      </div>
    </div>



  <?php 
include "foot.php";

?>
