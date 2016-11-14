
<?php 
include "head.php";


?>


    <div class="container-fluid">
      <div class="row">
        
<?php  include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Parts</h1>




          <h2 class="sub-header"> List parts </h2>
          
<!-- Columns are always 50% wide -->
<div class="row">
  <div class="col-xs-6 center-block">
  <h4 class="sub-header"> <img src="images/ROPCB.png" width="8%"><!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span> --> Readout boards </h4>
  
    <a href="new_readout.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new</button></a>
    <a href="list_parts_readout.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
  </div> <!-- First row first cell end -->
  <div class="col-xs-6">
  <h4 class="sub-header"> <img src="images/foil2.png" width="8%"><!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span> -->GEM foil </h4>
  
    <a href="new_gem.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new </button></a>
    <a href="list_parts_gem.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
  </div> <!-- First row Second cell end-->
</div>
        <hr>
        <div class="row">
  <div class="col-xs-6">
  <h4 class="sub-header"><img src="images/DRIFTPCB.PNG" width="8%"> <!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span>--> Drift </h4>
  
    <a href="new_drift.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new</button></a>
    <a href="list_parts_drift.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
  </div>
  <div class="col-xs-6">
    <h4 class="sub-header"><img src="images/VFAT_1.PNG" width="8%"> <!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span>--> VFAT </h4>
  
    <a href="new_vfat.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new</button></a>
    <a href="list_parts_vfat.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
  </div>
          
        </div>
        
       
      </div>
     
     <?php 
     $sql = "SELECT KIND_OF_PART_ID,DISPLAY_NAME FROM CMS_GEM_CORE_CONSTRUCT.KINDS_OF_PARTS"; //select data or insert data
$query = oci_parse($conn,$sql);
//Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
$arr = oci_execute($query);

while ($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS)) {
   echo "<ul>";
    foreach ($row as $item) {
        echo  "<li>".($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;")."</li>" ;
    }
    echo "</ul>";
}
     ?>

    </div>




  <?php 
include "foot.php";

?>
<script>
$("#part").attr("class","active");
</script>