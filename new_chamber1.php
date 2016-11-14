<?php
include "head.php";

$sql = "SELECT PART_ID FROM CMS_GEM_CORE_CONSTRUCT.PARTS"; //select data or insert data
        
$query = oci_parse($conn,$sql);
//Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
$arr = oci_execute($query);
$i = 0;
while ($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS)) {
    
    foreach ($row as $item) {
        
        //echo  ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") ;
    }
    if ((empty($item)) != 1){
    $i++;
    }
}
if ($i == 0) {
    echo "<p>None Found...</p>";
}

?>
<style>
    
    .cliente {
	margin-top:5px;
        //width: 100%;
	border: #cdcdcd medium solid;
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
}
</style>
 
<div class="container-fluid">
    <div class="row">

<?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Chamber  </h2>

                <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    
                    if(isset($_POST['serial'])){
    echo '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully created Chamber <strong>ID:</strong> '.$_POST['serial'].
                    '</div>';}
                    
} else {
    
    echo '<div style="display: none" role="alert" class="alert alert-danger ">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong> Please fill the required fields.
    </div>';
    ?> 

            
                <form method="POST" action="new_chamber.php">

                    <div class="row">
                        <div class="col-xs-12 panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading">
                                <h3 class="panel-title" >  <span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>Chamber Information</h3>
                            </div>
                            <div class="panel-body">
                            <!-- <span class="text-muted">List single chambers</span> -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Serial Number</label>
                                    <div class="serial"><span class="name">GE1/1-VI-</span><span class="version">VERSION</span><span class="between">-</span><span class="institute">INSTITUTE</span><span class="id">-0010</span></div>
                                    <input class="serialInput" name="serial" value="" hidden>
                                </div>
                                <div class="form-group">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Version
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#">Long</a></li>
                                            <li><a href="#">Short</a></li>
                                        </ul>
                                    </div><br>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Institute
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#">Bari</a></li>
                                            <li><a href="#">CERN</a></li>
                                            <li><a href="#">Florida Tech(FIT)</a></li>
                                            <li><a href="#">Frascati(LNF)</a></li>
                                            <li><a href="#">Ghent</a></li>
                                            <li><a href="#">BARC</a></li>
                                            <li><a href="#">Delhi</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label> Manufacturer name </label><br>
                                    <input name="manufacturer" >
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <label class="control-label">Manufacture date</label>
                                        <div class="controls input-append date form_datetime" data-date="2015-08-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                                            <input size="16" type="text" value="2015-08-16T05:25:07" readonly>
                                            <span class="add-on glyphicon glyphicon-remove"><i class="icon-remove"></i></span>
                                            <span class="add-on glyphicon glyphicon-calendar"><i class="icon-th"></i></span>
                                        </div>
                                        <input type="hidden" id="dtp_input1" value="2015-08-16T05:25:07" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>  Status </label>
                                    <input name="driftId" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Status
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
                                            <input class="testDiod" type="checkbox"> equipped with diodes?
                                            <input class="diodes" name="testDiod" value="" hidden>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                   
                                        <label> Add picture </label><br>
                                        <input class="testDiod" type="file">
                                    
                                </div>

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
                                            Choose GEM-1
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
                                            Choose GEM-2
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
                                            Choose GEM-3
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
                                            Choose Readout Board
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
                                            Choose Drift Board
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
                                <div class="form-group">
                                    <label for="exampleInputFile">GEB Board</label>
                                    <input name="gebId" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose GEB Board
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
                            </div>
                        </div>

                        <div class="col-xs-6 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading ">
                                <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-flash"></span> Attach Electronics parts:</h3>
                            </div>
                            <div class="panel-body">
                                
                                <!--<div class="form-group">
                                    <label for="exampleInputFile">VFAT(s)</label>
                                    <input name="vfatIds" value="" hidden><br>
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


                                </div>-->
                                <!-- ***** VFAT layout begin ******* -->
                                    <div style="border: #000;  text-center">
                                        <!-- 1st Row-->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="cliente"> (1,1)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (1,2)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (1,3)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 2nd Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="cliente"> (2,1)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (2,2)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (2,3)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 3rd Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="cliente"> (3,1)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (3,2)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (3,3)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 4th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="cliente"> (4,1)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (4,2)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (4,3)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 5th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="cliente"> (5,1)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (5,2)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (5,3)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 6th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="cliente"> (6,1)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (6,2)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (6,3)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 7th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="cliente"> (7,1)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (7,2)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (7,3)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 8th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="cliente"> (8,1)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (8,2)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="cliente"> (8,3)
                                                    <div class="dropdown" style="width: auto;">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose VFAT
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0001</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0002</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0003</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0004</a></li>
                                                            <li><a class="PCB-GEB" href="#"> VFAT-VI-2-CERN-0005</a></li>
                                                        </ul>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                </div>
                                <!-- ******** VFAT layout END********* -->
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
                                    <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
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