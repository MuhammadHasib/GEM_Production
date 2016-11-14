<?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     var_dump($_POST);
                    include_once "functions/functions.php";
                    include_once "functions/generate_xml.php";
                    include_once "functions/globals.php";
                // Flag that refers to all vfats ar Set or Not
                $flag = 1;
                for( $i= 0; $i<24 ; $i++ )
                {  if(!isset($_POST['vfat'.$i])){ $flag = 0;} }
                
                
                if ((isset($_POST['version']) && isset($_POST['gebl']) && $flag ) || (isset($_POST['version']) && isset($_POST['gebs']) && $flag  )) {
                    
                    $temp = array();
                    $arr = array();
                    $childs = array();
                    $child = array();
                    $subchild = array();
                    $msg = "";
                    if ($_POST['version'] == "L") {
                        $msg = '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully attached 24 VFATs to GEB [' . $_POST['gebl'] . ']   </div>';
                        $temp[$SERIAL_NUMBER] = $_POST['gebl'];
                        $temp[$KIND_OF_PART] = $GEB_KIND_OF_PART_NAME;
                        for( $i= 0; $i<24 ; $i++ )
                        { 
                            $child['SERIAL_NUMBER'] = $_POST['vfat'.$i];
                            $child['KIND_OF_PART'] = $VFAT_KIND_OF_PART_NAME;
                            $subchild['NAME'] = "VFAT2 Position";
                            $subchild['VALUE'] = $i;
                            $child ['attr'] = $subchild;
                            $childs[] = $child;
                        }
                        $temp['filename'] = $_POST['gebl']."to24VFATS";
                    }
                    if ($_POST['version'] == "S") {
                        $msg = '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully attached 24 VFATs to GEB [' . $_POST['gebs'] . ']   </div>';

                        $temp[$SERIAL_NUMBER] = $_POST['gebs'];
                        $temp[$KIND_OF_PART] = $GEB_KIND_OF_PART_NAME;

                        for( $i= 0; $i<24 ; $i++ )
                        { 
                            $child['SERIAL_NUMBER'] = $_POST['vfat'.$i];
                            $child['KIND_OF_PART'] = $VFAT_KIND_OF_PART_NAME;
                            $subchild['NAME'] = "VFAT2 Position";
                            $subchild['VALUE'] = $i;
                            $child ['attr'] = $subchild;
                            $childs[] = $child;
                        }
                        $temp['filename'] = $_POST['gebs']."toVFATS";
                    }
                    $temp['children'] = $childs;
                    $arr[] = $temp;
                    //print_r($arr);
                   

                    $res_arr = generateXml($arr);
                    
                    // Set session variables with the return 
                    session_start() ;
                    $_SESSION['post_return'] = $res_arr;
                    $_SESSION['new_chamber_ntfy'] = $msg;
                    // redirect to confirm page
                    header('Location: https://gemdb.web.cern.ch/gemdb/confirmation.php'); //?msg='.$msg."&statusCode=".$statusCode."&return=".$return
                        die();
                }
            } else {
                ?>
<?php
include "head.php";
?>


<div class="container-fluid">
    <div class="row">

        <?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Attach VFATs to GEB</h1>
            <img src="images/GEB-VFAT.png" width="20%" style="margin-bottom: 10px; border-radius: 20px;">

            <?php

                echo '<div style="display: none" geble="alert" class="alert alert-danger ">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong> Please fill the required fields.
    </div>';
                echo '<div style="display: none" geble="alert" class="alert alert-danger doublication">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Attention!</strong> Make sure you did not dublicate same VFAT.
    </div>';
                ?> 

                <form method="POST" action="attach_geb_vfat.php">
                    <div class="row">
                        <div class="col-xs-6 panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading">
                                <h3 class="panel-title" >  <span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>Attached parts information</h3>
                            </div>
                            <div class="panel-body">
                                <label for="exampleInputFile" >(1) Choose Version L/S ?</label>
                                <input class="version" name="version" value="" hidden>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Choose Version
                                        <span class="caret"></span>
                                    </button> 
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#">Long</a></li>
                                        <li><a href="#">Short</a></li>
                                    </ul>
                                </div>


                                <label for="exampleInputFile" > (2)Pick a GEB (Parent of VFAT) </label>

                                <!-- GEB S-->
                                <div class="form-group shortreads" style="display: none">
                                    <input class="gebs" name="gebs"  hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Readout GEB
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <?php get_available_parts_nochild($GEB_KIND_OF_PART_ID, "-S-",$VFAT2_TO_GEB); ?>
                                        </ul>

                                    </div>
                                </div>

                                <!-- GEB L-->
                                <div class="form-group longreads" >
                                    <input class="gebl" name="gebl"  hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Readout GEB
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <?php get_available_parts_nochild($GEB_KIND_OF_PART_ID, "-L-",$VFAT2_TO_GEB); ?>
                                        </ul>

                                    </div>
                                </div>

                                <!-- VFATS -->
                                <div class="form-group">
                                    <label for="exampleInputFile"> (3) Pick a VFAT (Child of GEB)</label>
                                    <!-- ***** VFAT layout begin ******* -->
                                    <div style="border: #000;  text-center">
                                        <!-- 1st Row-->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 0 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat0" name="vfat0" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat0" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 8 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat8" name="vfat8" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat8" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 16 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat16" name="vfat16" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat16" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 2nd Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 1 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat1" name="vfat1" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat1" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 9 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat9" name="vfat9" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat9" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 17 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat17" name="vfat17" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat17" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                     
                                            </div>
                                        </div>
                                        <!-- 3rd Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 2 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat2" name="vfat2" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat2" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 10 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat10" name="vfat10" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat10" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 18 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat18" name="vfat18" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat18" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 4th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 3 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat3" name="vfat3" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat3" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                  
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 11 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat11" name="vfat11" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat11" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 19 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat19" name="vfat19" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat19" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                   
                                            </div>
                                        </div>
                                        <!-- 5th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 4 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat4" name="vfat4" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat4" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                  
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 12 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat12" name="vfat12" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat12" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 20 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat20" name="vfat20" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat20" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 6th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 5 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat5" name="vfat5" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat5" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                               
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 13 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat13" name="vfat13" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat13" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 21 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat21" name="vfat21" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat21" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 7th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 6 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat6" name="vfat6" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat6" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 14 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat14" name="vfat14" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat14" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 22 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat22" name="vfat22" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat22" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 8th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 7 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat7" name="vfat7" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat7" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 15 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat15" name="vfat15" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat15" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                  
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 23 (Child of GEB)</label>
                                                    <span class="alert-danger vfatalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                    <input class="vfatinput vfat23" name="vfat23" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat23" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ******** VFAT layout END********* -->


                                </div>


                            </div>
                        </div>

                        <div style="padding-left: 0px; padding-right: 0px;" class="col-xs-6 panel-info panel">

                            <img src="images/vfats_slots.png" style=" width: 59%;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default btn-lg subbutt_at">Submit</button> 
                </form>
            <?php } ?>

        </div>
    </div>
</div>
<?php
include "foot.php";
?>
<script>
    /**
     * [4] When selecting Long or Short version , run Ajax get latest ID Short or Long.
     */
    $('.dropdown-menu a').on('click', function () {

        if ($(this).html() == "Long") {

            $(".longreads,.longgebs").show();
            $(".shortreads,.shortgebs").hide();
            $(".gebs,.gebl").val("");

        }

        if ($(this).html() == "Short") {

            $(".shortreads,.shortgebs").show();
            $(".chosen-select").chosen();
            $(".longreads,.longgebs").hide();
            $(".gebl,.gebs").val("");

        }




    })



    $('.chosen-select-vfat0,.chosen-select-vfat1, .chosen-select-vfat2, .chosen-select-vfat3, .chosen-select-vfat4, .chosen-select-vfat5, .chosen-select-vfat6, .chosen-select-vfat7, .chosen-select-vfat8, .chosen-select-vfat9, .chosen-select-vfat9, .chosen-select-vfat10, .chosen-select-vfat11, .chosen-select-vfat12, .chosen-select-vfat13, .chosen-select-vfat14, .chosen-select-vfat15, .chosen-select-vfat16, .chosen-select-vfat17, .chosen-select-vfat18, .chosen-select-vfat19, .chosen-select-vfat20, .chosen-select-vfat21, .chosen-select-vfat22, .chosen-select-vfat23').on('change', function (evt, params) {
        if ($(this).attr('class') == "chosen-select-vfat0") {
            $('.vfat0').val($(this).chosen().val());
//            alert($(this).chosen().val());
//            alert($(".vfat0").val().length);

        }
        if ($(this).attr('class') == "chosen-select-vfat1") {
            $('.vfat1').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat2") {
            $('.vfat2').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat3") {
            $('.vfat3').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat4") {
            $('.vfat4').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat5") {
            $('.vfat5').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat6") {
            $('.vfat6').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat7") {
            $('.vfat7').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat8") {
            $('.vfat8').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat9") {
            $('.vfat9').val($(this).chosen().val());
        }

        if ($(this).attr('class') == "chosen-select-vfat10") {
            $('.vfat10').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat11") {
            $('.vfat11').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat12") {
            $('.vfat12').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat13") {
            $('.vfat13').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat14") {
            $('.vfat14').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat15") {
            $('.vfat15').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat16") {
            $('.vfat16').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat17") {
            $('.vfat17').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat18") {
            $('.vfat18').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat19") {
            $('.vfat19').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat20") {
            $('.vfat20').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat21") {
            $('.vfat21').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat22") {
            $('.vfat22').val($(this).chosen().val());
        }
        if ($(this).attr('class') == "chosen-select-vfat23") {
            $('.vfat23').val($(this).chosen().val());
        }

        // ,.chosen-select-vfat1, .chosen-select-vfat2, .chosen-select-vfat3, .chosen-select-vfat4, .chosen-select-vfat5, .chosen-select-vfat6, .chosen-select-vfat7, .chosen-select-vfat8, .chosen-select-vfat9, .chosen-select-vfat9, .chosen-select-vfat10, .chosen-select-vfat11, .chosen-select-vfat12, .chosen-select-vfat13, .chosen-select-vfat14, .chosen-select-vfat15, .chosen-select-vfat16, .chosen-select-vfat17, .chosen-select-vfat18, .chosen-select-vfat19, .chosen-select-vfat20, .chosen-select-vfat21, .chosen-select-vfat22, .chosen-select-vfat23

    });



    $('.chosen-select-gebl').on('change', function (evt, params) {
        $('.gebl').val($(this).chosen().val());
        alert($(this).chosen().val());
    });

    $('.chosen-select-gebs').on('change', function (evt, params) {
        $('.gebs').val($(this).chosen().val());
        alert($(this).chosen().val());
    });


    $(".subbutt_at").click(function (e) {
        
                /****** Check for Emptiness/doublication Solution 2 *******/
        // Check if one of them is empty
        check_vfats_empty(e);
        // Check for doublicated fields values
        check_vfats_different(e);
        
        /*******End********/
        
        
        if ($(".version").html().length == 0) {
            $('.alert-danger').show();
            return false;
        }
        
        if (($(".gebs").val().length == 0 && $(".gebl").val().length == 0) )
        {
            $('.alert-danger').show();
            return false;
        }

        // Check if not doublication in selection the VFATS
//     var arr = $(".vfatinput").map(function(){
//                return $(this).val();
//            }).toArray();
//            //console.log(arr);
//     var allHaveSameValue = uniqueArray(arr).length == 1;
//     if(allHaveSameValue == true){
//         $('.doublication').show();
//            return false;
//     }

$('#preloader').fadeIn('fast');

    })




//function uniqueArray(arr){
//return $.grep(arr,function(v,k){
//    return $.inArray(v,arr) !== k;
//});
//}

function check_vfats_empty(e){
    var ev = e;
    try{
    var flag = true;
    $('.vfatinput').each(function () {
            if ($(this).val() == '') {
                console.log('empty');
                $(this).prev().show();
                $('.alert-danger').show();
                flag = false;
                throw "Exit Error";
                return false;

            }
        });
        $('#preloader').fadeIn('fast');
    }
    catch(e){ 
        //alert('catch');
        ev.preventDefault(); 
        return false; 
    }
}

function check_vfats_different(e){
    var ev = e;
    try{ var count = 0;
        var flag = true;
        $('.vfatinput').each(function () {
            if ($(this).val() === '') {
                $('.doublication').show();
                //alert('stop');
                flag = false;
                throw "Exit Error";
                return false;
            }
            if ($(this).val() !== '') {
                var val1 = $(this).val();
                var elem1 = $(this);
                //console.log(val1);
                $('.vfatinput').each(function () {
                    if ($(this).val() !== '') {
                        if (val1 === $(this).val())
                        {
                            count = count + 1; //if found itself and another field, counter would be = 2
                            if (count > 1) {
                                console.log(val1+$(this).val());
                                console.log('error');
                                elem1.prev().show();
                                $(this).prev().show();
                                $('.doublication').show();
                                //alert('stop');
                                flag = false;
                                throw "Exit Error";
                                return false;
                            }
                        }
                    }
                });
                count = 0;
            }
        });
        $('#preloader').fadeIn('fast');
    }
    catch(e){
        //alert('catch');
        ev.preventDefault(); 
        return false;
    }
    
   
}

//    alert($(".version").val().length);
//    alert($(".gebs").val().length);alert($(".opto").val().length);alert($(".gebl").val().length );alert($(".gebs").val().length);
</script>
