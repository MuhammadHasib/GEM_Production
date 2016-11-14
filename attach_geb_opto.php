<?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     var_dump($_POST);
                    include_once "functions/functions.php";
                    include_once "functions/generate_xml.php";
                    include_once "functions/globals.php";
                if ((isset($_POST['version']) && isset($_POST['gebl']) && isset($_POST['opto']) ) || (isset($_POST['version']) && isset($_POST['gebs']) && isset($_POST['gebs']))) {
                    $temp = array();
                    $arr = array();
                    $childs = array();
                        $child = array();
                        $subchild = array();
                        $msg = "";
                    if ($_POST['version'] == "L") {
                        $msg=  '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully attached OptoHybrid [' . $_POST['opto'] . '] to GEB [' . $_POST['gebl'] . ']   </div>';
                        $temp[$SERIAL_NUMBER] = $_POST['gebl'];
                        $temp[$KIND_OF_PART] = $GEB_KIND_OF_PART_NAME;
                        
                        $child['SERIAL_NUMBER'] = $_POST['opto'];
                        $child['KIND_OF_PART'] = $OPTOHYBRID_KIND_OF_PART_NAME;
                        $childs[] = $child;
                        
                        $temp['filename'] = $_POST['gebl']."toOpto".$_POST['opto'];
                    }
                    if ($_POST['version'] == "S") {
                        $msg = '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully attached OptoHybrid [' . $_POST['opto'] . '] to GEB [' . $_POST['gebs'] . ']   </div>';
                    
                        $temp[$SERIAL_NUMBER] = $_POST['gebs'];
                        $temp[$KIND_OF_PART] = $GEB_KIND_OF_PART_NAME;
                        
                        $child['SERIAL_NUMBER'] = $_POST['opto'];
                        $child['KIND_OF_PART'] = $OPTOHYBRID_KIND_OF_PART_NAME;
                        $childs[] = $child;
                        
                        $temp['filename'] = $_POST['gebs']."toOpto".$_POST['opto'];
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
        
<?php  include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Attach Optohybrid to GEB </h1>
          <img src="images/GEB-OPTO.png" width="20%" style="margin-bottom: 10px; border-radius: 20px;">

      <?php

                echo '<div style="display: none" geble="alert" class="alert alert-danger ">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong> Please fill the required fields.
    </div>';
                ?> 

          <form method="POST" action="attach_geb_opto.php">
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


                                <label for="exampleInputFile" > (2)Pick a GEB (Parent of OptoHybrid) </label>

                                <!-- GEB S-->
                                <div class="form-group shortreads" style="display: none">
                                    <input class="gebs" name="gebs"  hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Readout GEB
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php get_available_parts_nochild($GEB_KIND_OF_PART_ID, "-S-",$OPTOHYBRID_TO_GEB); ?>
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
                <?php get_available_parts_nochild($GEB_KIND_OF_PART_ID, "-L-",$OPTOHYBRID_TO_GEB); ?>
                                        </ul>

                                    </div>
                                </div>

                                <!-- Optohybrid -->
                                <div class="form-group">
                                    <label for="exampleInputFile"> (3) Pick a OptoHybrid (Child of GEB)</label>
                                    <input class="opto" name="opto" value="" hidden><br>
                                    <!--multiple=""-->
                                    <select tabindex="-1"  class="chosen-select-opto" style="width: 350px; " data-placeholder="Choose OptoHybrid ">
                                        <option value=""></option>
                                        <optgroup label="OptoHybrids">
                                            <?php
                                            $arr = get_available_parts_nohtml_noversion($OPTOHYBRID_KIND_OF_PART_ID);
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


$('.chosen-select-opto').on('change', function (evt, params) {
        $('.opto').val($(this).chosen().val());
        alert($(this).chosen().val());
        //alert($(".opto").val().length);
    });


    $('.chosen-select-gebl').on('change', function (evt, params) {
        $('.gebl').val($(this).chosen().val());
        //alert($(this).chosen().val());
    });

    $('.chosen-select-gebs').on('change', function (evt, params) {
        $('.gebs').val($(this).chosen().val());
        //alert($(this).chosen().val());
    });


    $(".subbutt_at").click(function () {
        if ($(".version").html().length == 0) {
            $('.alert-danger').show();
            return false;
        }
        if (($(".gebs").val().length == 0 && $(".gebl").val().length == 0) || ($(".opto").val().length == 0 ))
        {
            $('.alert-danger').show();
            return false;
        }
        $('#preloader').fadeIn('fast');
    })
//    alert($(".version").val().length);
//    alert($(".gebs").val().length);alert($(".opto").val().length);alert($(".gebl").val().length );alert($(".gebs").val().length);
</script>
