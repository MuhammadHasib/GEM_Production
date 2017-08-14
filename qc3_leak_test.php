<?php
	  //  Form Submitted , need to generate XML 
	 //if (isset($_POST['foilsnumbersubmitted'])) {
	     if(isset($_POST["submit"])) {


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
		  $headType['EXTENSION_TABLE_NAME'] ="FOIL_QC2_FAST_AMB_COND";
		  $headType['NAME'] = "GEM Foil QC2 Fast Test Condition"; 
		  $head['TYPE'] = $headType;
		  
		  
		  $headRun['RUN_NUMBER'] = $_POST['RUN_NUMBER'];
		  $headRun['RUN_TYPE'] = $_POST['RUN_TYPE'];
		  $headRun['RUN_BEGIN_TIMESTAMP'] = date($_POST['RUN_BEGIN_TIMESTAMP'].':s');
		  $RUN = "check";
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
		  
		  $partdata['TEST_TIME'] = $_POST['HUMIDITY_PERCENT_foil'.$i];
		  $partdata['INCRMNT_SEC'] = $_POST['TEMP_DEG_CENT_foil'.$i];
		  $partdata['MANF_PRSR_MBAR'] = $_POST['PRESSURE_MBAR_foil'.$i];
		  $partdata['AMB_PRSR_MBAR'] = $_POST['PRESSURE_MBAR_foil'.$i];
		  $partdata['TEMP_DEGC'] = $_POST['PRESSURE_MBAR_foil'.$i];
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

<style>
    .scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
}
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


<div class="container-fluid">
  <div class="row">

<?php include "side.php"; ?>
       <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	  <h2 class="sub-header"> <img src="images/ROPCB.png" width="4%"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Leak Test  </h2>

	  <?php

	      echo '<div style="display: none" role="alert" class="alert alert-danger ">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong> Please fill the required fields.
  </div>';
	      ?>

	      <!--<form method="POST" action="qc3_leak_test.php" enctype='multipart/form-data'>-->
	      <form method="POST" action="convert_qc3_Leak.php" enctype='multipart/form-data'>
			<input type="hidden" name="submited" value="true" /><br>
		  <div class="row">
		      <div class="col-xs-6 panel-info panel" style="padding-left: 0px; padding-right: 0px;">
			  <div class="panel-heading">
			      <h3 class="panel-title" >  <span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>On which chamber test performed?</h3>
			  </div>
			  <div class="panel-body">
		 <div class="form-group">
		       <label for="exampleInputEmail1">Choose Chamber:</label>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		      <!-- <p class="help-block">help text here.</p>--> 
		       <!--<input name="chamber1Id" &nbsp value=""  >-->
		
		       <input class="runinput" name="CHAMBER" &amp; value=""  >
		       <!--<input class="foils" href="#" name="SERIAL_NUMBER" value="" hidden/> -->
			<div class="dropdown" >
			   <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"     aria-haspopup="true" aria-expanded="true">
			       Chamber
			       <span class="caret"></span>
			   </button>
			   <ul class="dropdown-menu scrollable-menu  aria-labelledby="dropdownMenu1">
			      <?php 
				list_chambers(); 
				?>
			      <//?php get_locations(); ?>
			  </ul>
		       </div>
			<div class="panel-body">
				     <!-- <div class="form-group">
				      <lable>RUN Number:</lable><br>
				       <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
				      <input class="runinput" name='RUN_NUMBER' >
				      </div>
				      
				      <div class="form-group">
				      <lable>RUN Type:</lable><br>
				       <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
				      <input class="runinput" name='RUN_TYPE' >
				      </div>-->
				      <div class="form-group">
				      <lable>Location:</lable><br>
				       <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
				     <input class="runinput" name="LOCATION" value=""  hidden> 
				      <div class="dropdown" scrollable-menu>
					  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					      Choose Location
					      <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					      <?php get_locations(); ?>
					      <//?php list_chambers(); ?>
					  </ul>
				      </div>
				      </div>
				      
				      <div class="form-group">
				      <lable>Test Begin:</lable><br>
				      <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
				      <input class="runinput date" name="RUN_BEGIN_TIMESTAMP"  >
				      </div>
				      
				      <div class="form-group">
				      <lable>Test End :</lable><br>
				       <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
				      <input class="runinput date" name='RUN_END_TIMESTAMP'  >
				     </div>
				      
				      
				      <div class="form-group">
				      <lable>Initiated by user:</lable><br>
				       <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
				      <input class="runinput" name='INITIATED_BY_USER' >
				      </div>
				      
				      <div class="form-group">
				      <lable>Leave comment Before the Test:</lable><br>
				      <textarea name='COMMENT_DESCRIPTION' > Please Put the comment of your detector:</textarea>
				      </div>
				      

				  </div>
			  
				  <div class="form-group">
				      <label> Upload Data (EXCEL only) <i class="ace-icon glyphicon glyphicon-barcode"></i></label><br>
					

				      <!--<input type="file" name="file" id="file" required >-->
				      <input type="file" name="file" accept=".xls,.xlsx,.xlsm" required >
				  </div>
				 </div>
				</div>
				</div>
		      <div class="col-xs-6 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
			  <div class="panel-heading ">
			      <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-comment"></span>Comments:</h3>
			  </div>
			  <div class="panel-body">
				
				      <div class="form-group">
				      <lable>Elog Link:</lable><br>
				       <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
				      <input class="runinput" name='Elog_Link' >
				      </div>
				      <div class="form-group">
				      <lable>File Name:</lable><br>
				       <span class="alert-danger foilalert" hidden> <i class="ace-icon fa fa-times-circle alert-danger"></i> </span>
				      <input class="runinput" name='File_Name' >
				      </div>
			      <div class="form-group">
				  <label for="comment"> Leave comment After the Test:</label>
				  <textarea class="form-control" rows="5" id="comment" name="comment" > Please Make Summary of Your Detector: </textarea>
			      </div>
			  </div>
			</div>
			</div>



		  <button type="submit" class="btn btn-default subbutt">Submit</button>   



	      </form>


<?php
include "foot.php";
?>
<script type="text/javascript">
  //$(document).ready(function () {
    //  $("#add").click(function () {
//	  $('#mytable tbody>tr:last').clone(true).insertAfter('#mytable tbody>tr:last');
  //          alert($('#mytable tbody>tr:last').find("input").first().val());
    //        $('#mytable tbody>tr:last').find("input").first().val( $(this).val()+100);
      //      return false;
        //});
	jQuery(document).ready(function ($) {
        $( ".date" ).datetimepicker();
        $.fn.datetimepicker.defaults = {
            pickSeconds: false        // disables seconds in the time picker
        };        
            $(".imon").focus(function() {
    console.log('in');
}).blur(function() {
    console.log('out');
    $(this).parent().next().find("input").attr("value","3300")
});
    });
</script>
