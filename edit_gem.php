<?php
include "head.php";
?>
<div class="container-fluid">
    <div class="row">

<?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Edit GEM: <?php echo $_GET["id"]; ?> </h2>

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

            
                <form method="POST" action="edit_gem.php">

                    <div class="row">
                        <div class="col-xs-12 panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                           
                            <div class="panel-heading">
                                <h3 class="panel-title" >  <span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>GEM Information</h3>
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
                                    <label>  Parent Chamber </label>
                                    <input name="chamberparent" value="" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Chamber
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a class="status" href="#"> Not attached yet  </a></li>
                                            <li><a class="status" href="#"> GE1/1-VI-L-CERN-0012</a></li>
                                            <li><a class="status" href="#"> GE1/1-VI-L-CERN-0014</a></li>
                                            <li><a class="status" href="#"> GE1/1-VI-S-CERN-0013</a></li>
                                            <li><a class="status" href="#"> GE1/1-VI-S-CERN-0016</a></li>
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
                             <div class="col-md-6"><img alt="200x200" class="img-thumbnail" data-src="holder.js/200x200" style="width: 200px; height: 200px;" src="uploads/FOIL.png" data-holder-rendered="true"></div>
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

