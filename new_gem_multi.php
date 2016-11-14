 <?php
            //  Form Submitted , need to generate XML 
            if (isset($_POST['foilsnumbersubmitted'])) {
                include_once "functions/functions.php";
                include_once "functions/generate_xml.php";
                include_once "functions/globals.php";
                    $head = array();
                    $headRun =array();
                    $headType =array();
                    $foils =array();
                    $foil = array();
                    $part = array();
                    $partdata = array();
                    $data = array();
                    
                    // Header Data
                    $headType['EXTENSION_TABLE_NAME'] ="FOIL_HISTORY_INFO";
                    $headType['NAME'] = "GEM Foil History Information"; 
                    $head['TYPE'] = $headType;
                    
                    
                    $headRun['RUN_NUMBER'] = $_POST['RUN_NUMBER'];
                    $headRun['RUN_TYPE'] = $_POST['RUN_TYPE'];
                    $headRun['RUN_BEGIN_TIMESTAMP'] = date($_POST['RUN_BEGIN_TIMESTAMP'].':s');
                    $headRun['RUN_END_TIMESTAMP'] = date($_POST['RUN_END_TIMESTAMP'].':s');
                    $headRun['LOCATION'] = $_POST['LOCATION'];
                    $headRun['INITIATED_BY_USER'] = $_POST['INITIATED_BY_USER'];
                    $headRun['COMMENT_DESCRIPTION'] = $_POST['COMMENT_DESCRIPTION'];
                    $head['RUN'] = $headRun;
                    
                    
                    //Foils Data
                 for($i = 1; $i <= $_POST['foilsnumbersubmitted']; $i++){
                    //$_POST['foil'.$i];   
                    $foil['COMMENT_DESCRIPTION'] = $_POST['COMMENT_DESCRIPTION_foil'.$i];
                    $foil['VERSION'] = $_POST['VERSION_foil'.$i];
                    
                    $part['SERIAL_NUMBER'] = $_POST['foil'.$i];
                    $part['VERSION'] = "Batch ".$_POST['VERSIONbatch'.$i];
                    $part['KIND_OF_PART'] = $FOIL_KIND_OF_PART_NAME;
                    $foil['PART'] = $part;
                    
                    $partdata['PI_FILM_NUMBER'] = $_POST['PI_FILM_NUMBER_foil'.$i];
                    $partdata['PROD_LOT_NUMBER'] = $_POST['PROD_LOT_NUMBER_foil'.$i];
                    $partdata['MPT_TECHNICIAN'] = $_POST['MPT_TECHNICIAN_foil'.$i];
                    $partdata['STATUS'] = $_POST['STATUS_foil'.$i];
                    $foil['DATA'] = $partdata;
                    
                    $foils['foil'.$i] = $foil;
                  
                   }
                   $data['head'] = $head;
                   $data['foils'] = $foils;
                   //print_r($data);
                   $res_arr = generateDatasetXml($data);
                    
                    // Set session variables with the return 
                    session_start() ;
                    $_SESSION['post_return'] = $res_arr;
                    $_SESSION['new_chamber_ntfy'] = '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully generated XML file for a list of GEM FOIL(s) data 
                    </div>';
                    // redirect to confirm page
                    header('Location: https://gemdb.web.cern.ch/gemdb/confirmation.php'); //?msg='.$msg."&statusCode=".$statusCode."&return=".$return
                        die();
                   
            }
            ?>
<?php
include "head.php";
?>


<div class="container-fluid">
    <div class="row">

        <?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <?php
echo '<div style="display: none" geble="alert" class="alert alert-danger empty">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong> Please fill the required fields.
    </div>';
                echo '<div style="display: none" geble="alert" class="alert alert-danger doublication">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Attention!</strong> Make sure you did not dublicate same FOIL .
    </div>';
                ?> 
            
            
            <img src="images/foildata.png" class="img-responsive" alt="Generic placeholder thumbnail" style="width: 100px; float: left;">
            <h1 class="page-header">GEM FOIL Data </h1>
            <div class="col-xs-12 panel-info panel" style="padding-left: 0px; padding-right: 0px;" <?php if(isset($_POST['foilsnumbersubmitted'])){ echo "hidden";} ?> >
                <div class="panel-heading">
                    <h3 class="panel-title" >  <span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>Foil Data Set</h3>
                </div>
                <div class="panel-body">




                    <?php
                    // Access the page 1st time need to define number of foils having History info to be inserted
                    if (!isset($_POST['numOfFoils']) && !isset($_POST['foilsnumbersubmitted'])) {
                        ?>
                        <form method="POST" action="new_gem_multi.php">
                            <div class="form-group">
                                <label for="exampleInputFile">How many FOILs do you want to load history information for ?? </label>
                                <input class="" name="numOfFoils" value=""  onblur="if($(this).val() !== '' )$('.subbutt_at').attr('disabled', false);">
                            </div>
                            <button type="submit" class="btn btn-default btn-lg subbutt_at" disabled="true" >Next</button>
                        </form>
                    <?php } ?>

                    <?php
                    //  number of foils having History info to be inserted, defined , generate form 
                    if (isset($_POST['numOfFoils'])) {
                        $num = $_POST['numOfFoils'];
                        ?>

                        <form method="POST" action="new_gem_multi.php">
                            <input hidden="" value="<?= $num; ?>" name="foilsnumbersubmitted">
                            <div class="row">
                            <div class="col-xs-12">
                            <div class="form-group">
                                <div style="padding-left: 0px; padding-right: 0px;" class=" panel-info panel">
                                    <div class="widget-header widget-header-large">
                                    <h4 class="widget-title"> <i class="ace-icon glyphicon glyphicon-cog"></i> HEADER information:</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                        <lable>RUN Number:</lable><br>
                                         <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                        <input class="runinput" name='RUN_NUMBER'>
                                        </div>
                                        
                                        <div class="form-group">
                                        <lable>RUN Type:</lable><br>
                                         <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                        <input class="runinput" name='RUN_TYPE'>
                                        </div>
                                        
                                        <div class="form-group">
                                        <lable>RUN Begin timestamp:</lable><br>
                                        <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                        <input class="runinput date" name="RUN_BEGIN_TIMESTAMP" >
                                        </div>
                                        
                                        <div class="form-group">
                                        <lable>RUN End timestamp:</lable><br>
                                         <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                        <input class="runinput date" name='RUN_END_TIMESTAMP' >
                                       </div>
                                        
                                        <div class="form-group">
                                        <lable>Location:</lable><br>
                                         <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                        <input class="runinput" name="LOCATION" value="" hidden>
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
                                        <lable>Initiated by user:</lable><br>
                                         <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                        <input class="runinput" name='INITIATED_BY_USER'>
                                        </div>
                                        
                                        <div class="form-group">
                                        <lable>COMMENT_DESCRIPTION</lable><br>
                                        <textarea name='COMMENT_DESCRIPTION'></textarea>
                                        </div>
                                        

                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-xs-12">
                            <div class="form-group">
                                <div class=" panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                                    <div class="widget-header widget-header-large">
                                    <h4 class="widget-title">   Data Set(s):</h4>
                                    </div>
                                    <div class="panel-body">
                                        
                                        <div class="row">
    <?php for ($i = 1; $i <= $num; $i++) { ?>
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-16">
                                                    <div class="form-group" style="border: 1px solid #ccc;">
                                                        
                                                        <div class="widget-header widget-header-blue widget-header-flat">
										<h5 class="widget-title lighter"><i class="ace-icon fa fa-circle"></i>   FOIL  <?= $i ?> </h5>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                       
                                                        <div style="white-space:nowrap">
                                                        <label for="exampleInputFile">Related FOIL: </label>
                                                        <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                        <input class="foilinput foil<?= $i ?>" name="foil<?= $i ?>" value="" hidden><br>
                                                        <!--multiple=""-->
                                                        <select tabindex="-1"  class="chosen-select-foil-<?= $i ?>" style="" data-placeholder="Choose FOIL">
                                                            <option value=""></option>
                                                            <optgroup label="Foil">
                                                                <?php
                                                                $arr = list_parts($FOIL_KIND_OF_PART_ID);
                                                                foreach ($arr as $value) {
                                                                    echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                                }
                                                                ?>

                                                            </optgroup>
                                                        </select>
                                                        </div>
                                                        
                                                         <div style="white-space:nowrap">
                                                        <label class="sublabel" for="exampleInputFile">Version: </label>
                                                        <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                        <input name="VERSION_foil<?= $i; ?>" >
                                                        
                                                        </div>
                                                        
                                                        <div style="white-space:nowrap">
                                                        <label class="sublabel" for="exampleInputFile">Batch: </label>
                                                        <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                        <input name="VERSIONbatch<?= $i; ?>" >
                                                        </div>
                                                        <div style="white-space:nowrap">
                                                        <label class="sublabel" for="exampleInputFile">PI film Number: </label>
                                                        <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                        <input name="PI_FILM_NUMBER_foil<?= $i; ?>" >
                                                        </div>
                                                        
                                                        <div style="white-space:nowrap">
                                                        <label class="sublabel" for="exampleInputFile">Prod Lot Number:  </label>
                                                        <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                        <input name="PROD_LOT_NUMBER_foil<?= $i; ?>">
                                                        </div>
                                                        
                                                        <div style="white-space:nowrap">
                                                        <label class="sublabel" for="exampleInputFile">MPT Technician:  </label>
                                                        <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                        <input name="MPT_TECHNICIAN_foil<?= $i; ?>">
                                                        </div>
                                                        
                                                        
                                                        <div style="white-space:nowrap">
                                                        <label class="sublabel" for="exampleInputFile">Comments: </label>
                                                        <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                        <textarea name="COMMENT_DESCRIPTION_foil<?= $i; ?>" ></textarea>
                                                        </div>
			
                                                        <div style="white-space:nowrap">
                                                        <label class="sublabel" for="exampleInputFile">Status </label>
                                                        <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
                                                        <input name="STATUS_foil<?= $i; ?>" hidden>
                                                        <div class="dropdown">
                                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                Choose Status
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                                <li ><a herf="#" class="label label-info arrowed-right arrowed-in">Good</a></li>
                                                                <li ><a herf="#" class="label label-success arrowed-in arrowed-in-right">Approved</a></li>
                                                                <li ><a herf="#" class="label label-danger arrowed">Bad</a></li>
                                                                <li ><a herf="#" class="label label-warning arrowed arrowed-right">Pending</a></li>
                                                            </ul>
                                                        </div>
                                                        </div>
			

                                                    </div>  
                                                    </div>
    <?php } ?>
                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </div>
                                </div>
                            <button type="submit" class="btn btn-default btn-lg subbutt_gen">Submit</button>
                        </form>

<?php } ?>
                </div>
            </div>
           

        </div>
    </div>
</div>



<?php
include "foot.php";
?>
<script>
    $("select[class^='chosen-select-foil-']").chosen();

    $("select[class^='chosen-select-foil-']").on('change', function (evt, params) {
        $(this).prev().prev().val($(this).chosen().val());
    });
    jQuery(document).ready(function ($) {
        $( ".date" ).datetimepicker();
        $.fn.datetimepicker.defaults = {
            pickSeconds: false        // disables seconds in the time picker
        };
        <?php 
        
        ?>
                
          <?php 
          if (isset($_POST['numOfFoils'])){}
          for( $x = 1; $x <= $_POST['numOfFoils']; $x++){
              
          ?>      
            $("#spinner-foil<?= $x; ?>").ace_spinner({value:0,min:0,max:200,step:1, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//console.log($('#spinner1').val())
				});
        <?php }?>         
    })
    $(".subbutt_gen").on("click", function(e){
        //$(".foilinput").each();
                // Check if one of them is empty
        check_foils_empty(e);
        // Check for doublicated fields values
        check_foils_different(e);
    });
    function check_foils_empty(e){
    var ev = e;
    try{
    var flag = true;
    $('.foilinput').each(function () {
            if ($(this).val() == '') {
                console.log('empty');
                $(this).prev().show();
                $('.empty').show();
                flag = false;
                throw "Exit Error";
                return false;

            }
        });
        
       $('.runinput').each(function () {
            if ($(this).val() == '') {
                console.log('empty');
                $(this).prev().show();
                $('.empty').show();
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

function check_foils_different(e){
    var ev = e;
    try{ var count = 0;
        var flag = true;
        $('.foilinput').each(function () {
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
                $('.foilinput').each(function () {
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

</script>