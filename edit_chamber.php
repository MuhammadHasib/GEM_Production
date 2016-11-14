<?php
include "head.php";
?>
<div class="container-fluid">
    <div class="row">

<?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Edit Chamber: <?php echo $_GET["id"]; ?> </h2>

                <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    
                    if(isset($_POST['serial'])){
    echo '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully created Chamber <strong>ID:</strong> '.$_POST['serial'].
                    '</div>';}
                    
} else {
    
    echo '<div style="display: none" role="alert" class="alert alert-danger ">
      <strong>Error!</strong> Please fill the required fields.
    </div>';
    ?> 

            
                <form method="POST" action="edit_chamber.php">

                    <div class="row">
                        <div class="col-xs-12 panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                           
                            <div class="panel-heading">
                                <h3 class="panel-title" >  <span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>Chamber Information</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-xs-6">
                            <!-- <span class="text-muted">List single chambers</span> -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Serial Number</label>
                                    <div class="serial"><?php echo $_GET["id"]; ?></div>
                                    <input class="serialInput" name="serial" value="<?php echo $_GET["id"]; ?>" hidden>
                                </div>
                                
                                <div class="form-group">
                                    <label> Manufacturer name </label><br>
                                    <input name="manufacturer" value="XYZ">
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <label class="control-label">Manufacture date</label>
                                        <div class="controls input-append date form_datetime" data-date="2015-08-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                                            <input size="16" type="text" value="" readonly>
                                            <span class="add-on glyphicon glyphicon-remove"><i class="icon-remove"></i></span>
                                            <span class="add-on glyphicon glyphicon-calendar"><i class="icon-th"></i></span>
                                        </div>
                                        <input type="hidden" id="dtp_input1" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>  Status </label>
                                    <input name="driftId" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <span class="label label-success">Accepted</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a class="status" href="#"> <span class="label label-success">Accepted</span></a></li>
                                            <li><a class="status" href="#"> <span class="label label-danger">Rejected</span></a></li>
                                            <li><a class="status" href="#"> <span class="label label-info">Repaired</span></a></li>
                                            <li><a class="status" href="#"> <span class="label label-primary">Installed</span></a></li>
                                            <li><a class="status" href="#"> <span class="label label-default">Under Test</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input class="testDiod" type="checkbox" checked="true"> equipped with diodes?
                                            <input class="diodes" name="testDiod" value="" hidden>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                   
                                        <label> Add picture </label><br>
                                        <input class="testDiod" type="file">
                                    
                                </div>
</div>
                             <div class="col-md-6"><img alt="200x200" class="img-thumbnail" data-src="holder.js/200x200" style="width: 200px; height: 200px;" src="uploads/GEM.png" data-holder-rendered="true"></div>
                            </div>
                               
                        </div>
                       
                    </div>
                    <div class="row">

                        <div class="col-xs-6 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading ">
                                <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-cog"></span>Attach detector Parts</h3>
                            </div>
                            <div class="panel-body">
                                <span class="text-muted"></span>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">1st GEM Foil:</label>
                                    <!--<p class="help-block">help text here.</p> -->  
                                    <input name="GEM1Id" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            FOIL-VI-L-CERN-0001
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a class="FOIL-VI1" href="#"> FOIL-VI-L-CERN-0001</a></li>
                                            <li><a class="FOIL-VI1" href="#"> FOIL-VI-S-BARI-0002</a></li>
                                            <li><a class="FOIL-VI1" href="#"> FOIL-VI-L-BARI-0003</a></li>
                                            <li><a class="FOIL-VI1" href="#"> FOIL-VI-S-CERN-0004</a></li>
                                            <li><a class="FOIL-VI1" href="#"> FOIL-VI-L-GHENT-0005</a></li>
                                        </ul>
                                    </div><br>
                                    <label for="exampleInputEmail1">2nd GEM Foil:</label>
                                    <input name="GEM2Id" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            FOIL-VI-L-CERN-0001
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a class="FOIL-VI2" href="#"> FOIL-VI-L-CERN-0001</a></li>
                                            <li><a class="FOIL-VI2" href="#"> FOIL-VI-S-BARI-0002</a></li>
                                            <li><a class="FOIL-VI2" href="#"> FOIL-VI-L-BARI-0003</a></li>
                                            <li><a class="FOIL-VI2" href="#"> FOIL-VI-S-CERN-0004</a></li>
                                            <li><a class="FOIL-VI2" href="#"> FOIL-VI-L-GHENT-0005</a></li>
                                        </ul>
                                    </div><br>
                                    <label for="exampleInputEmail1">3rd GEM Foil:</label>  
                                    <input name="GEM3Id" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            FOIL-VI-L-GHENT-0005
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a class="FOIL-VI3" href="#"> FOIL-VI-L-CERN-0001</a></li>
                                            <li><a class="FOIL-VI3" href="#"> FOIL-VI-S-BARI-0002</a></li>
                                            <li><a class="FOIL-VI3" href="#"> FOIL-VI-L-BARI-0003</a></li>
                                            <li><a class="FOIL-VI3" href="#"> FOIL-VI-S-CERN-0004</a></li>
                                            <li><a class="FOIL-VI3" href="#"> FOIL-VI-L-GHENT-0005</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Readout Board</label>
                                    <input name="readoutId" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            PCB-RO-VI-L-CERN-0001
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a class="PCB-RO" href="#"> PCB-RO-VI-L-CERN-0001</a></li>
                                            <li><a class="PCB-RO" href="#"> PCB-RO-VI-S-BARI-0002</a></li>
                                            <li><a class="PCB-RO" href="#"> PCB-RO-VI-L-BARI-0003</a></li>
                                            <li><a class="PCB-RO" href="#"> PCB-RO-VI-S-CERN-0004</a></li>
                                            <li><a class="PCB-RO" href="#"> PCB-RO-VI-L-GHENT-0005</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Drift Board</label>
                                    <input name="driftId" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            PCB-DR-VI-L-BARI-0003
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a class="PCB-DR" href="#"> PCB-DR-VI-L-CERN-0001</a></li>
                                            <li><a class="PCB-DR" href="#"> PCB-DR-VI-S-BARI-0002</a></li>
                                            <li><a class="PCB-DR" href="#"> PCB-DR-VI-L-BARI-0003</a></li>
                                            <li><a class="PCB-DR" href="#"> PCB-DR-VI-S-CERN-0004</a></li>
                                            <li><a class="PCB-DR" href="#"> PCB-DR-VI-L-GHENT-0005</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading ">
                                <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-flash"></span> Attach Electronics parts:</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">GEB Board</label>
                                    <input name="gebId" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            PCB-GEB-VI-L-CERN-0001
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a class="PCB-GEB" href="#"> PCB-GEB-VI-L-CERN-0001</a></li>
                                            <li><a class="PCB-GEB" href="#"> PCB-GEB-VI-S-BARI-0002</a></li>
                                            <li><a class="PCB-GEB" href="#"> PCB-GEB-VI-L-BARI-0003</a></li>
                                            <li><a class="PCB-GEB" href="#"> PCB-GEB-VI-S-CERN-0004</a></li>
                                            <li><a class="PCB-GEB" href="#"> PCB-GEB-VI-L-GHENT-0005</a></li>
                                        </ul>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">VFAT(s)</label>
                                    <input name="vfatIds" value="VFAT-VI-1-CERN-0001" hidden><br>
                                    <select tabindex="-1" multiple="" class="chosen-select" style="width: 350px; " data-placeholder="Choose 16 VFAT(s) ">
                                        <option value=""></option>
                                        <optgroup label="Version 1">
                                            <option>VFAT-VI-1-CERN-0001</option>
                                            <option>VFAT-VI-1-BARI-0002</option>
                                            <option>VFAT-VI-1-GHENT-0003</option>
                                            <option>VFAT-VI-1-CERN-0004</option>
                                        </optgroup>
                                        <optgroup label="Version 2">
                                            <option>VFAT-VI-2-CERN-0001</option>
                                            <option>VFAT-VI-2-BARI-0002</option>
                                            <option>VFAT-VI-2-GHENT-0003</option>
                                            <option>VFAT-VI-2-CERN-0004</option>
                                        </optgroup>
                                        <optgroup label="Version 3">
                                            <option>VFAT-VI-3-CERN-0001</option>
                                            <option>VFAT-VI-3-BARI-0002</option>
                                            <option>VFAT-VI-3-GHENT-0003</option>
                                            <option>VFAT-VI-3-CERN-0004</option>
                                        </optgroup>
                                    </select>


                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading ">
                                <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-comment"></span>Comments:</h3>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label for="comment"> Leave your comment:</label>
                                    <textarea class="form-control" rows="5" id="comment" name="comment"> comment comment </textarea>
                                </div>
                            </div>
                        </div>
                    </div>





                    <button type="submit" class="btn btn-default subbutt">Submit</button>   



                </form>
            <?php } ?>
        </div>
    </div>
</div>

<?php
include "foot.php";
?>
<script>
    $(".chosen-choices").empty();
$(".chosen-choices").append('<li class="search-choice"><span>VFAT-VI-1-BARI-0002</span><a class="search-choice-close" data-option-array-index="3"></a></li><li class="search-choice"><span>VFAT-VI-1-CERN-0001</span><a class="search-choice-close" data-option-array-index="2"></a></li><li class="search-choice"><span>VFAT-VI-1-CERN-0004</span><a class="search-choice-close" data-option-array-index="5"></a></li><li class="search-choice"><span>VFAT-VI-1-GHENT-0003</span><a class="search-choice-close" data-option-array-index="4"></a></li><li class="search-choice"><span>VFAT-VI-2-BARI-0002</span><a class="search-choice-close" data-option-array-index="8"></a></li><li class="search-choice"><span>VFAT-VI-2-GHENT-0003</span><a class="search-choice-close" data-option-array-index="9"></a></li><li class="search-choice"><span>VFAT-VI-2-CERN-0001</span><a class="search-choice-close" data-option-array-index="7"></a></li><li class="search-choice"><span>VFAT-VI-3-CERN-0001</span><a class="search-choice-close" data-option-array-index="12"></a></li><li class="search-choice"><span>VFAT-VI-3-BARI-0002</span><a class="search-choice-close" data-option-array-index="13"></a></li><li class="search-choice"><span>VFAT-VI-2-CERN-0004</span><a class="search-choice-close" data-option-array-index="10"></a></li><li class="search-field"><input type="text" style="width: 25px;" autocomplete="off" class="" value="Choose 16 VFAT(s) " tabindex="-1"></li>');
</script>
