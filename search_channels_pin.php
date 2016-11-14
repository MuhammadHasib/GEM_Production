
<?php
include "head.php";
?>


<div class="container-fluid">
    <div class="row">
<?php include "side.php"; ?>
        <div class="col-xs-6 col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-2 main">
           
            <div style="display: none" geble="alert" class="alert alert-danger empty">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong> Please fill the required fields.
    </div>
            <!--<h1 class="page-header">Search By pin number for channel info</h1>-->


            <!--                <ul class="list-group">
            
            
                                <li class="list-group-item" style="text-align:center">
                                    <span class="label label-warning"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Notification !!</span>
                                    <div class="alert alert-warning" role="alert" style="text-align: center;"><span aria-hidden="true" class="glyphicon glyphicon-wrench"></span> Still Under Development, We'll keep you informed Soon <span aria-hidden="true" class="glyphicon glyphicon-hourglass"></span></div>
                                </li>
                            </ul>-->

            <div class=" panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="widget-title">   Search for connector pin numbers:</h4>
                </div>
                <div class="panel-body">

                    <div class="row col-xs-6 ">

                        <form method="POST" action="search_channels_pin.php">
                            
                            <input class="query" name="query" hidden>
                            <div class="form-group">
                                <label >Search by:</label>
                                <input class="searchby required" name="searchby" value="<?php if(isset($_POST['query']) && $_POST['query'] == "sdv" ) { echo "SECTOR - DEPTH - VFAT_POSN";} if(isset($_POST['query']) && $_POST['query'] == "epd" ) { echo "IETA - IPHI - DEPTH";} ?> " hidden>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <?php if(isset($_POST['query']) && $_POST['query'] == "sdv" ) { echo "SECTOR - DEPTH - VFAT_POSN";} elseif(isset($_POST['query']) && $_POST['query'] == "epd" ) { echo "IETA - IPHI - DEPTH";} else{ echo "Choose Search by";} ?>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a class="searchbysdv" href="#">SECTOR - DEPTH - VFAT_POSN</a></li>
                                        <li><a class="searchbyepd" href="#">IETA - IPHI - DEPTH</a></li>
                                    </ul>
                                </div>
                            </div> 
                            
                             
                
                
                            <div class="form-group sdv" <?php if(isset($_POST['query']) && $_POST['query'] == "sdv" ) { echo "style='display:block;'";} ?>  >
                                <label >Sector:</label>
                                <input class="sector" name="SECTOR" value="<?php if(isset($_POST['SECTOR']) ) { echo $_POST['SECTOR'];} ?>" hidden>
                                <!--multiple=""-->
                                <select tabindex="-1"  class="chosen-select-sector" style="" data-placeholder="Choose Sector" elementvalue="sector">
                                    <option value=""></option>
                                    <optgroup label="sectors ">
                                        <?= getSectors(); ?>
                                    </optgroup>
                                </select>

                                <br/>
                                <div style="white-space:nowrap">
                                    <label class="sublabel" >Depth:</label>
                                    <input class="depth" value="<?php if(isset($_POST['DEPTH']) ) { echo $_POST['DEPTH'];} ?>" name="DEPTH">
                                </div>
                                <br/>
                                <div style="white-space:nowrap">
                                    <label class="sublabel" >VFAT position:</label>
                                    <input class="vfatpos" value="<?php if(isset($_POST['VFAT_POSN']) ) { echo $_POST['VFAT_POSN'];} ?>" name="VFAT_POSN">
                                </div>
                            </div>
                            <div class="form-group epd" <?php if(isset($_POST['query']) && $_POST['query'] == "epd" ) { echo "style='display:block;'"; } ?> >
                                <div style="white-space:nowrap">
                                    <label class="sublabel" >IETA:</label>
                                    <input class="ieta" value="<?php if(isset($_POST['IETA']) ) { echo $_POST['IETA'];} ?>" name="IETA">
                                </div>
                                <br/>
                                <div style="white-space:nowrap">
                                    <label class="sublabel" >IPHI:</label>
                                    <input class="iphi" value="<?php if(isset($_POST['IPHI']) ) { echo $_POST['IPHI'];} ?>" name="IPHI">
                                </div>
                                <br/>
                                <div style="white-space:nowrap">
                                    <label class="sublabel" >Depth:</label>
                                    <input class="depth1" value="<?php if(isset($_POST['DEPTH1']) ) { echo $_POST['DEPTH1'];} ?>" name="DEPTH1">
                                </div>
                            </div>
                            
<!--CHANNEL_MAP_ID
SUBDET
SECTOR
TYPE
ZPOSN
IETA
IPHI
DEPTH
VFAT_POSN
DET_STRIP
VFAT_CHAN
CONN_PIN-->
                            <button type="submit" class="btn btn-default btn-lg subbutt_gen">Search</button>
                        </form>
                    </div>
                </div>

            </div>

            <?php if(isset($_POST['query'])) {
                $arr = array();
                if ($_POST['query'] == "sdv") {

                    $arr['SECTOR'] = $_POST['SECTOR'];
                    $arr['DEPTH'] = $_POST['DEPTH'];
                    $arr['VFAT_POSN'] = $_POST['VFAT_POSN'];
                }
                if ($_POST['query'] == "epd"){
                      
                    $arr['IETA'] = $_POST['IETA'];
                    $arr['DEPTH'] = $_POST['DEPTH1'];
                    $arr['IPHI'] = $_POST['IPHI'];
                }
                ?>
                
             <div class=" panel-info panel" style="padding-left: 0px; padding-right: 0px;"  >
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="widget-title">   Search Result:</h4>
                </div>
                 <div class="panel-body">
                     <?php $items = searchPinNum($arr) ; ?>
                     <table class="table table-striped">
                             <thead>
                                 <tr>
                                     <th>Sector</th>
                   <!--                  <th>Status</th>-->
                                     <th> PIN number </th>
                                     <?php foreach ($arr as $key => $value) {
                                                      echo "<th>".$key."</th>" ;  
                                                     }?>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($items as $key => $value) {
                                                  echo "<tr>";
                                                  echo "<th>".$value['SECTOR']."</th><th>".$value['CONN_PIN']."</th>";
                                                  foreach ($arr as $key => $value) {
                                                      echo "<th>".$value."</th>" ;  
                                                     }
                                                  echo "</tr>";
                                                  
                                     }
                                 ?>
                             </tbody>
                         </table>

                     </div>
                 </div>
                 <?php }?>
        </div>

    </div>
</div>



<?php
include "foot.php";
?>
<script>
    <?php 
    if($_POST['query'] == "sdv") {
            ?>
                $(".epd").hide();
                    $('.chosen-select-sector').val("<?= $_POST['SECTOR']; ?>");
                    $('.chosen-select-sector').trigger("chosen:updated");
            <?php
    }
          
    elseif($_POST['query'] == "epd") {
             ?>
                 $(".sdv").hide();
             <?php
    }
    else{
    ?>
        $(".sdv,.epd").hide();
    <?php } 
    ?>
    $("#map").attr("class", "active");
    
        $(".subbutt_gen").on("click", function(e){
 
        // Check if one of them is empty
        check_emptyness(e);
    });
    $(".chosen-select-sector").on('change', function (evt, params) {

        $('.' + $(this).attr("elementvalue")).val($(this).chosen().val());
        //alert($(this).chosen().val());
    });
</script>