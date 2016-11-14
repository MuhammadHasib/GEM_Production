<?php

           if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               include_once "functions/functions.php";
                include_once "functions/generate_xml.php";
                include_once "functions/globals.php";
                if (isset($_POST['serial'])) {


                    $temp = array();
                    $arr = array();
                    /*
                    echo '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully created Gem Chamber <strong>ID:</strong> ' . $_POST['serial'] .
                    '</div>';*/
                    $temp[$SERIAL_NUMBER] = $_POST['serial'];
                    $temp[$NAME_LABEL] = $_POST['serial'];
                    if (isset($_POST['location'])) {
                        //echo $_POST['location'];
                        $temp[$LOCATION] = $_POST['location'];
                    }
                    if (isset($_POST['comment'])) {
                        //echo $_POST['comment'];
                        $temp[$COMMENT_DESCRIPTION] = $_POST['comment'];
                    }
                    if (isset($_POST['barcode'])) {
                        //echo $_POST['barcode'];
                        $temp[$BARCODE] = $_POST['barcode'];
                    }

                    $kindOfPart = $CHAMBER_KIND_OF_PART_NAME;
                    //echo  $kindOfPart;
                    $temp[$KIND_OF_PART] = $kindOfPart;


                    if (isset($logName)) {
                        //echo $logName;
                        $temp[$RECORD_INSERTION_USER] = $logName;
                    }

                    if (isset($_POST['manufacturer']) && !empty($_POST['manufacturer']) ) {
                        //echo $_POST['manufacturer'];
                        $temp[$MANUFACTURER] = $_POST['manufacturer'];
                    }


                    $childs = array();
                    $child = array();
                    $subchild = array();
                    if (!empty($_POST['ros'])) {
                        $child['SERIAL_NUMBER'] = $_POST['ros'];
                        $child['KIND_OF_PART'] = $READOUT_KIND_OF_PART_NAME;
                        $childs[] = $child;
                    }
                    if (!empty($_POST['drifts'])) {
                        $child['SERIAL_NUMBER'] = $_POST['drifts'];
                        $child['KIND_OF_PART'] = $DRIFT_KIND_OF_PART_NAME;
                        $childs[] = $child;
                    }
                    if (!empty($_POST['foil1s'])) {
                        $child['SERIAL_NUMBER'] = $_POST['foil1s'];
                        $child['KIND_OF_PART'] = $FOIL_KIND_OF_PART_NAME;
                        $subchild['NAME'] = "Foil Position";
                        $subchild['VALUE'] = "GEM1";
                        $child ['attr'] = $subchild;
                        $childs[] = $child;
                    }
                    if (!empty($_POST['foil2s'])) {
                        $child['SERIAL_NUMBER'] = $_POST['foil2s'];
                        $child['KIND_OF_PART'] = $FOIL_KIND_OF_PART_NAME;
                        $subchild['NAME'] = "Foil Position";
                        $subchild['VALUE'] = "GEM2";
                        $child ['attr'] = $subchild;
                        $childs[] = $child;
                    }
                    if (!empty($_POST['foil3s'])) {
                        $child['SERIAL_NUMBER'] = $_POST['foil3s'];
                        $child['KIND_OF_PART'] = $FOIL_KIND_OF_PART_NAME;
                        $subchild['NAME'] = "Foil Position";
                        $subchild['VALUE'] = "GEM3";
                        $child ['attr'] = $subchild;
                        $childs[] = $child;
                    }

                    if (!empty($_POST['rol'])) {
                        $child['SERIAL_NUMBER'] = $_POST['rol'];
                        $child['KIND_OF_PART'] = $READOUT_KIND_OF_PART_NAME;
                        $childs[] = $child;
                    }
                    if (!empty($_POST['driftl'])) {
                        $child['SERIAL_NUMBER'] = $_POST['driftl'];
                        $child['KIND_OF_PART'] = $DRIFT_KIND_OF_PART_NAME;
                        $childs[] = $child;
                    }
                    if (!empty($_POST['foil1l'])) {
                        $child['SERIAL_NUMBER'] = $_POST['foil1l'];
                        $child['KIND_OF_PART'] = $FOIL_KIND_OF_PART_NAME;
                        $subchild['NAME'] = "Foil Position";
                        $subchild['VALUE'] = "GEM1";
                        $child ['attr'] = $subchild;
                        $childs[] = $child;
                    }
                    if (!empty($_POST['foil2l'])) {
                        $child['SERIAL_NUMBER'] = $_POST['foil2l'];
                        $child['KIND_OF_PART'] = $FOIL_KIND_OF_PART_NAME;
                        $subchild['NAME'] = "Foil Position";
                        $subchild['VALUE'] = "GEM2";
                        $child ['attr'] = $subchild;
                        $childs[] = $child;
                    }
                    if (!empty($_POST['foil3l'])) {
                        $child['SERIAL_NUMBER'] = $_POST['foil3l'];
                        $child['KIND_OF_PART'] = $FOIL_KIND_OF_PART_NAME;
                        $subchild['NAME'] = "Foil Position";
                        $subchild['VALUE'] = "GEM3";
                        $child ['attr'] = $subchild;
                        $childs[] = $child;
                    }
                    $temp['children'] = $childs;
                    $arr[] = $temp;


//                if ((isset($_POST['ros']) && isset($_POST['drifts']) && isset($_POST['foil1s'])&& isset($_POST['foil2s']) && isset($_POST['foil3s'])) || (isset($_POST['rol']) && isset($_POST['driftl'])&& isset($_POST['foil1l']) && isset($_POST['foil2l']) && isset($_POST['foil3l'])) ){}
//                    echo "TEST TEST".$_POST['rol'].$_POST['driftl'].$_POST['foil1l'].$_POST['foil2l'].$_POST['foil3l'];
                    //.ros, .drifts, .foil1s, .foil2s, .foil3s, rol, .driftl, .foil1l, .foil2l, .foil3l
                    $res_arr = generateXml($arr);
                    
                    // Set session variables with the return 
                    session_start() ;
                    $_SESSION['post_return'] = $res_arr;
                    $_SESSION['new_chamber_ntfy'] = '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully created GEM Chamber XML file <strong>ID:</strong> ' . $_POST['serial'] .
                    '</div>';
                    // redirect to confirm page
                    header('Location: https://gemdb.web.cern.ch/gemdb/confirmation.php'); //?msg='.$msg."&statusCode=".$statusCode."&return=".$return
                        die();
                    
                    
                }
            }

include "head.php";
?>
<style>
    /* Flashing */
    .hover13 a:hover img {
        opacity: 1;
        -webkit-animation: flash 1.5s;
        animation: flash 1.5s;
        border: 1px inset;
    }
    @-webkit-keyframes flash {
        0% {
            opacity: .4;
        }
        100% {
            opacity: 1;
        }
    }
    @keyframes flash {
        0% {
            opacity: .4;
        }
        100% {
            opacity: 1;
        }
    }


    .rellists{
        display: none;
    }

    .rellists .dropdown{
        margin: 15px;
    }

</style>
<?php
//$serial_num_of_newest_part = get_part_ID($CHAMBER_KIND_OF_PART_ID);
//if ($serial_num_of_newest_part) {
//    $serial_num = explode('-', $serial_num_of_newest_part);
//} else {
//    $serial_num = array();
//    $serial_num[2] = "L";
//    $serial_num[3] = "CERN";
//    $serial_num[4] = 0000;
//}
//echo $serial_num[3];
//echo $serial_num[4];
//echo "loacations"; print_r(get_locations());
//echo "<br>institutes"; print_r(get_institutes());
//echo "<br>Manufacturers";print_r(get_manufacturers());
?>
<div class="container-fluid" >
    <div class="row">

        <?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header"> <img src="images/c2.png" width="4%"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Chamber  </h2>

            <?php
  if ($_SERVER['REQUEST_METHOD'] != 'POST') {

                echo '<div style="display: none" role="alert" class="alert alert-danger empt">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong> Please fill the required fields. <strong>Also</strong> make sure you attached all parts.
    </div>';
                echo '<div  style="display: none" role="alert" class="alert alert-danger same ">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong>  Make sure you did not choose same foil twice.
    </div>';
                ?> 


                <form method="POST" action="new_chamber.php">

                    <div class="row">
                        <div class="col-xs-6 panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading">
                                <h3 class="panel-title" >  <span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>Chamber Information</h3>
                            </div>
                            <div class="panel-body">
                            <!-- <span class="text-muted">List single chambers</span> -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="float: left;">Serial Number:&nbsp;</label>
                                    <div class="serial"><span class="name">GE1/1-VII-</span><span id="vers" class="version" >VERSION</span>-<span id="inst" class="institute">INSTITUTE</span><span class="id">-XXXX</span></div>
                                    <input class="serialInput" name="serial" value="" hidden>
                                </div>
                                <div class="form-group">
                                    &nbsp;<b style=" color: red">*</b>
                                    <label for="exampleInputFile" >Version</label>
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
                                    <div class="form-group">&nbsp;<b style=" color: red">*</b>
                                        <label for="exampleInputFile" >Institute</label>
                                        <input name="Institute" value="" hidden>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Choose Institute
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <?php get_institutes(); ?>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="dropdown">&nbsp;<b style=" color: red">*</b>
                                    <label> 4 digits Serial </label><br>
                                    <input placeholder="XXXX" class="serialValidation">
                                    <i class="ace-icon fa fa-times-circle alert-danger exist" style="display: none">Already in  Database</i>
                                    <i class="ace-icon fa fa-check-circle alert-success newId" style="display: none"> Valid Serial</i>
                                </div><br>
                                    <div class="form-group">
                                        <label> Barcode <i class="ace-icon glyphicon glyphicon-barcode"></i></label><br>
                                        <input name="barcode" >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputFile" >Location</label>
                                        <input name="location" value="" hidden>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Choose Location
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <?php get_locations(); ?>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile" >Manufacturer</label>
                                        <input name="manufacturer" value="" hidden>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Choose Manufacturer
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <?php get_manufacturers(); ?>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                                <!--                                <div class="form-group">
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
                                                                        <input type="hidden" id="dtp_input1" value="" />
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
                                                                    
                                                                </div>-->

                            </div>
                        </div>
                        <div class="col-xs-6 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
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






                    <div class="row">
                        <div class="col-md-12 panel-info " style="padding-left: 0px; padding-right: 0px;"><div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span aria-hidden="true" class="glyphicon glyphicon-cog"></span> Attach parts:</h3>
                                </div>
                                <div class="panel-body">
                                    <!--                                            <ul class="list-group">
                                                                                    <li class="list-group-item"><label> GEM Foil 1:</label> <a href="show_gem.php?id=FOIL-VI-L-CERN-0001">FOIL-VI-L-CERN-0001</a> </li>
                                                                                    <li class="list-group-item"><label> GEM Foil 2:</label> <a href="show_gem.php?id=FOIL-VI-L-CERN-0004">FOIL-VI-L-CERN-0004</a></li>
                                                                                    <li class="list-group-item"><label> GEM Foil 3:</label> <a href="show_gem.php?id=FOIL-VI-L-CERN-0007">FOIL-VI-L-CERN-0007</a></li>
                                                                                    <li class="list-group-item"><label> Readout:</label> <br> <a href="show_readout.php?id=PCB-RO-VI-L-CERN-0001">PCB-RO-VI-L-CERN-0001</a></li>
                                                                                    <li class="list-group-item"><label> Drift:</label> <a href="show_drift.php?id=PCB-DR-VI-L-CERN-0001">PCB-DR-VI-L-CERN-0001</a></li>
                                                                                </ul>-->
                                    <div class="col-md-4 hover13">

                                        <a href="#/" class="imgclick foilch"> <img src="images/FOIL-CHAMBER1.PNG" width="100%"></a>
                                        <div class="rellists">
                                            <!--Short FOILS-->
                                            <div class="shortfoils" style="background: rgb(236, 249, 249) none repeat scroll 0 0;border: 1px outset;border-radius: 15px; <?php
                                            if ($serial_num[2] == "L") {
                                                echo "display: none;";
                                            }
                                            ?>">
                                                <!-- Foil 1 S-->
                                                <div class="form-group">
                                                    <input class="foil1s" name="foil1s"  hidden>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose FOIL1
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <?php get_available_parts($FOIL_KIND_OF_PART_ID, "-S-"); ?>
                                                        </ul>

                                                    </div>
                                                </div>

                                                <!-- Foil 2 S-->
                                                <div class="form-group">
                                                    <input class="foil2s" name="foil2s"  hidden>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose FOIL2
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <?php get_available_parts($FOIL_KIND_OF_PART_ID, "-S-"); ?>
                                                        </ul>

                                                    </div>
                                                </div>
                                                <!-- Foil 3 S-->
                                                <div class="form-group">
                                                    <input class="foil3s" name="foil3s"  hidden>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose FOIL3
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <?php get_available_parts($FOIL_KIND_OF_PART_ID, "-S-"); ?>
                                                        </ul>

                                                    </div>
                                                </div>


                                            </div>

                                            <!--LONG FOILS-->
                                            <div class="longfoils" style="background: rgb(236, 249, 249) none repeat scroll 0 0;border: 1px outset;border-radius: 15px; <?php
                                            if ($serial_num[2] == "S") {
                                                echo "display: none;";
                                            }
                                            ?>">
                                                <!-- Foil 1 L-->
                                                <div class="form-group">
                                                    <input class="foil1l" name="foil1l"  hidden>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose FOIL1
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <?php get_available_parts($FOIL_KIND_OF_PART_ID, "-L-"); ?>
                                                        </ul>

                                                    </div>
                                                </div>

                                                <!-- Foil 2 L-->
                                                <div class="form-group">
                                                    <input class="foil2l" name="foil2l"  hidden>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose FOIL2
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <?php get_available_parts($FOIL_KIND_OF_PART_ID, "-L-"); ?>
                                                        </ul>

                                                    </div>
                                                </div>
                                                <!-- Foil 3 L-->
                                                <div class="form-group">
                                                    <input class="foil3l" name="foil3l"  hidden>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Choose FOIL3
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <?php get_available_parts($FOIL_KIND_OF_PART_ID, "-L-"); ?>
                                                        </ul>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 hover13">

                                        <a href="#/" class="imgclick driftch"><img src="images/drift-chamber.png" width="100%"></a>
                                        <div class="rellists">
                                            <!-- Drift S-->
                                            <div class="form-group shortdrifts" style="background: rgb(236, 249, 249) none repeat scroll 0 0;border: 1px outset;border-radius: 15px;  <?php
                                            if ($serial_num[2] == "L") {
                                                echo "display: none;";
                                            }
                                            ?>">
                                                <input class="drifts" name="drifts"  hidden>
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Choose Drift PCB
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <?php get_available_parts($DRIFT_KIND_OF_PART_ID, "-S-"); ?>
                                                    </ul>

                                                </div>
                                            </div>

                                            <!-- Drift L-->
                                            <div class="form-group longdrifts" style="background: rgb(236, 249, 249) none repeat scroll 0 0;border: 1px outset;border-radius: 15px;  <?php
                                            if ($serial_num[2] == "S") {
                                                echo "display: none;";
                                            }
                                            ?>">
                                                <input class="driftl" name="driftl"  hidden>
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Choose Drift PCB
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <?php get_available_parts($DRIFT_KIND_OF_PART_ID, "-L-"); ?>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 hover13">

                                        <a href="#/" class="imgclick readoutch"><img src="images/readout-chamber.png" width="100%"></a>
                                        <div class="rellists">
                                            <!-- Readout S-->
                                            <div class="form-group shortreads" style="background: rgb(236, 249, 249) none repeat scroll 0 0;border: 1px outset;border-radius: 15px;  <?php
                                            if ($serial_num[2] == "L") {
                                                echo "display: none;";
                                            }
                                            ?>">
                                                <input class="ros" name="ros"  hidden>
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Choose Readout PCB
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <?php get_available_parts($READOUT_KIND_OF_PART_ID, "-S-"); ?>
                                                    </ul>

                                                </div>
                                            </div>

                                            <!-- Readout L-->
                                            <div class="form-group longreads" style="background: rgb(236, 249, 249) none repeat scroll 0 0;border: 1px outset;border-radius: 15px;  <?php
                                            if ($serial_num[2] == "S") {
                                                echo "display: none;";
                                            }
                                            ?>">
                                                <input class="rol" name="rol"  hidden>
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Choose Readout PCB
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <?php get_available_parts($READOUT_KIND_OF_PART_ID, "-L-"); ?>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div></div>
                    </div>

                    <button type="submit" class="btn btn-default btn-lg subbutt_ch">Submit</button>   



                </form>
            <?php } ?>



        </div>
    </div>
</div>

<?php
include "foot.php";
?>

<script>
    $(document).ready(function () {

        /**
         * [1] Ajax to refresh the Id once enter the page ( 1st time landing )
         */
//        $.ajax({
//            url: 'functions/ajaxActions.php?kindid=<?= $CHAMBER_KIND_OF_PART_ID; ?>',
//            success: function () { /*alert('test');*/
//            }
//        });

        /**
         * [2] Ajax to refresh the Id every 10 seconds to check for updated ID
         * @returns {undefined}
         */
        //setInterval(ajaxCall, 7000); //7000 MS == 7s Seconds

        function ajaxCall() {
            if ($("#vers").text() == "L-") {
                $.ajax({
                    url: 'functions/ajaxActions.php?kindid=<?= $CHAMBER_KIND_OF_PART_ID; ?>&version=-L-',
                    success: function (data) {
                        $(".id").text(data);
                        $(".serialInput").val($(".serial").text());
                        $(".longfoils,.longdrifts,.longreads").show();
                        $(".shortfoils,.shortdrifts,.shortreads").hide();
                        $(".ros, .drifts, .foil1s, .foil2s, .foil3s").empty();


                    }
                });

            }
            else if ($("#vers").text() == "S-") {
                $.ajax({
                    url: 'functions/ajaxActions.php?kindid=<?= $CHAMBER_KIND_OF_PART_ID; ?>&version=-S-',
                    success: function (data) {
                        $(".id").text(data);
                        $(".serialInput").val($(".serial").text());
                        $(".shortfoils,.shortdrifts,.shortreads").show();
                        $(".longfoils,.longdrifts,.longreads").hide();
                        $(".rol, .driftl, .foil1l, .foil2l, .foil3l").empty();
                    }
                });

            }
            else {
                $.ajax({
                    url: 'functions/ajaxActions.php?kindid=<?= $CHAMBER_KIND_OF_PART_ID; ?>',
                    success: function () { /*alert('test');*/
                    }
                });
            }

        }


        /**
         * [3] Show  loader when user clickes submit button
         * @param {type} param1
         * @param {type} param2
         */
        $(".subbutt").on('click', function () {

            if ($(".serialInput").val() != "") {
                $('#preloader').fadeIn('fast');
            }
        });
    })

    /**
     * [4] When selecting Long or Short version , run Ajax get latest ID Short or Long.
     */
//    $('.dropdown-menu a').on('click', function () {
//
//        if ($(this).html() == "Long") {
//            $('#preloader').fadeIn('fast', function () {/*$(this).remove();*/
//            });
//            $("#vers").text("L-");
//            $.ajax({
//                url: 'functions/ajaxActions.php?kindid=<? $CHAMBER_KIND_OF_PART_ID; ?>&version=-L-',
//                success: function (data) {
//                    $(".id").text(data);
//                    $(".serialInput").val($(".serial").text());
//                    $('#preloader').fadeOut('fast', function () {/*$(this).remove();*/
//                    });
//                    $(".longfoils,.longdrifts,.longreads").show();
//                    $(".shortfoils,.shortdrifts,.shortreads").hide();
//                    $(".ros, .drifts, .foil1s, .foil2s, .foil3s").val("");
//
//                }
//            });
//
//        }
//
//        if ($(this).html() == "Short") {
//            $('#preloader').fadeIn('fast', function () {/*$(this).remove();*/
//            });
//            $("#vers").text("S-");
//            $.ajax({
//                url: 'functions/ajaxActions.php?kindid=<? $CHAMBER_KIND_OF_PART_ID; ?>&version=-S-',
//                success: function (data) {
//                    $(".id").text(data);
//                    $(".serialInput").val($(".serial").text());
//                    $('#preloader').fadeOut('fast', function () {/*$(this).remove();*/
//                    });
//                    $(".shortfoils,.shortdrifts,.shortreads").show();
//                    $(".longfoils,.longdrifts,.longreads").hide();
//                    $(".rol, .driftl, .foil1l, .foil2l, .foil3l").val("");
//                }
//            });
//
//        }
//
//        if ($(this).attr('class') == "institue") {
//
//            $("#inst").text($(this).html());
//            $(".serialInput").val($(".serial").text());
//
//        }
//    })

    /**
     * [4] When selecting Long or Short version , run Ajax get latest ID Short or Long.
     */
    $('.dropdown-menu a').on('click', function () {

        if ($(this).html() == "Long") {
            
            $("#vers").text("L");
            $(".longfoils,.longdrifts,.longreads").show();
            $(".shortfoils,.shortdrifts,.shortreads").hide();
            $(".ros, .drifts, .foil1s, .foil2s, .foil3s").val("");
             $(".serialInput").val($(".serial").text());
            validateInput($(".serial").text());

        }

        if ($(this).html() == "Short") {
            
            $("#vers").text("S");
            $(".shortfoils,.shortdrifts,.shortreads").show();
            $(".longfoils,.longdrifts,.longreads").hide();
            $(".rol, .driftl, .foil1l, .foil2l, .foil3l").val("");
             $(".serialInput").val($(".serial").text());
            validateInput($(".serial").text());

        }

        if ($(this).attr('class') == "institue") {

            $("#inst").text($(this).html());
            $(".serialInput").val($(".serial").text());
            validateInput($(".serial").text());

        }
    })

    $('.imgclick').on('click', function () {
        $(this).next().toggle("fast", "swing");
    });



    $(".subbutt_ch").click(function () {

        //alert(($(".rol").val().length == 0 || $(".driftl").val().length == 0  &&  $(".foil1l").val().length == 0  && $(".foil2l").val().length == 0  && $(".foil3l").val().length == 0  ));
        var x = (($(".rol").val().length == 0) || ($(".driftl").val().length == 0) || ($(".foil1l").val().length == 0) || ($(".foil2l").val().length == 0) || ($(".foil3l").val().length == 0));
        //alert(($(".ros").val().length == 0  && $(".drifts").val().length == 0  && $(".foil1s").val().length == 0  && $(".foil2s").val().length == 0  && $(".foil3s").val().length == 0 ) ) ;
        var y = (($(".ros").val().length == 0) || ($(".drifts").val().length == 0) || ($(".foil1s").val().length == 0) || ($(".foil2s").val().length == 0) || ($(".foil3s").val().length == 0));
//       alert($(".serialInput").val().length == 0 );
        //alert(x);
        //alert(y);

        if ($(".serialInput").val().length == 0 || (x && y))
        {

            $(".empt").show();
            if ($(".foil1l").val().length != 0 && $(".foil2l").val().length != 0 && $(".foil3l").val().length != 0) {

                if (($(".foil1l").val() == $(".foil2l").val()) || ($(".foil1l").val() == $(".foil3l").val()) || ($(".foil2l").val() == $(".foil3l").val())) {
                    $(".same").show();
                }
            }
            if ($(".foil1s").val().length != 0 && $(".foil2s").val().length != 0 && $(".foil3s").val().length != 0 ) {
                      
                        if (($(".foil1s").val() == $(".foilsl").val()) || ($(".foil1s").val() == $(".foil3s").val()) || ($(".foil2s").val() == $(".foil3s").val())) {
                             $(".same").show();
                        }
                    }
            $('html, body').animate({scrollTop: 0}, 0);
            return false;
        }
        if ($(".foil1l").val().length != 0 && $(".foil2l").val().length != 0 && $(".foil3l").val().length != 0) {

            if (($(".foil1l").val() == $(".foil2l").val()) || ($(".foil1l").val() == $(".foil3l").val()) || ($(".foil2l").val() == $(".foil3l").val())) {
                $(".same").show();
                $(".empt").hide();
                $('html, body').animate({scrollTop: 0}, 0);
            return false;
            }
        }
        if ($(".foil1s").val().length != 0 && $(".foil2s").val().length != 0 && $(".foil3s").val().length != 0) {

            if (($(".foil1s").val() == $(".foil2s").val()) || ($(".foil1s").val() == $(".foil3s").val()) || ($(".foil2s").val() == $(".foil3s").val())) {
                $(".same").show();
                $(".empt").hide();
                $('html, body').animate({scrollTop: 0}, 0);
            return false;
            }
        }
        $('#preloader').fadeIn('fast');

    });


    $(".serialValidation").on('blur', function(){
        if($(this).val() != "" ){
            $('#preloader').fadeIn('fast', function () {});
            $('.id').html("-"+$(this).val());
            $(".serialInput").val($(".serial").text());
            validateInput($(".serial").text());
            $('#preloader').fadeOut('fast', function () {});

        }
        
    })

</script>
<?php /*


 */ ?>