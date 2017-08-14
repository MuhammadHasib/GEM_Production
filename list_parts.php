
<?php
include "head.php";
?>


<div class="container-fluid">
    <div class="row">

<?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="row">
                <div class="col-xs-6 center-block">
                    <h1 class="page-header">Register</h1>




                    <h2 class="sub-header">  parts </h2>

                    <!-- Columns are always 50% wide -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h4 class="sub-header"> <img src="images/ROPCB.png" width="20%"><!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span> --> Readout board </h4>

                            <a href="new_readout.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new</button></a>
                            <a href="list_parts_readout.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
                        </div> <!-- First row first cell end -->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h4 class="sub-header"> <img src="images/foil2.png" width="20%"><!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span> -->GEM foil </h4>

                            <a href="new_gem_step1.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new </button></a>
                            <a href="list_parts_gem.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
                        </div> <!-- First row Second cell end-->
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h4 class="sub-header"><img src="images/DRIFTPCB.png" width="20%"> <!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span>--> Drift board </h4>

                            <a href="new_drift.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new</button></a>
                            <a href="list_parts_drift.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <h4 class="sub-header"><img src="images/VFAT_1.png" width="20%"> <!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span>--> VFAT </h4>

                            <a href="new_vfat.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new</button></a>
                            <a href="list_parts_vfat.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                               <h4 class="sub-header"><img src="images/GEB.png" width="20%"> <!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span>--> GEM Electronic Board </h4>

                            <a href="new_geb.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new</button></a>
                            <a href="list_parts_geb.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <h4 class="sub-header"><img src="images/opto1.png" width="20%"> <!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span>--> OptoHybrid </h4>

                            <a href="new_opto.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new</button></a>
                            <a href="list_parts_opto.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                               <h4 class="sub-header"><img src="images/GEB.png" width="20%"> <!--<span aria-hidden="true" class="glyphicon glyphicon-th-list"></span>--> GEM External Frame </h4>

                            <a href="new_frame.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new</button></a>
                            <a href="list_parts_frame.php"><button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</button></a>
                        </div>
                        </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 center-block">

                    <h1 class="page-header">Attach</h1>

                    <h2 class="sub-header">  parts </h2>
                    <div class="row hover13" style="text-align: center">
                        <a href="attach_readout_geb.php" class="imgclick readoutch"><img src="images/READOUT-GEB.png" width="50%" style="margin-bottom: 10px; border-radius: 20px;"> </a>
                    </div>
                    <div class="row hover13" style="text-align: center">
                        <a href="attach_geb_opto.php" class="imgclick readoutch"><img src="images/GEB-OPTO.png" width="50%" style="margin-bottom: 10px; border-radius: 20px;"> </a>
                    </div>
                    <div class="row hover13" style="text-align: center">
                        <a href="attach_geb_vfat.php" class="imgclick readoutch"><img src="images/GEB-VFAT.png" width="50%" style="margin-bottom: 10px; border-radius: 20px;"> </a>
                    </div>
                    
                    
                    
                    
                </div>
            </div>
        </div>

<?php
$sql = "SELECT KIND_OF_PART_ID,DISPLAY_NAME FROM CMS_GEM_CORE_CONSTRUCT.KINDS_OF_PARTS"; //select data or insert data
$query = oci_parse($conn, $sql);
//Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
$arr = oci_execute($query);

while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo "<ul>";
    foreach ($row as $item) {
        echo "<li>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</li>";
    }
    echo "</ul>";
}
?>

    </div>




<?php
include "foot.php";
?>
    <script>
        $("#part").attr("class", "active");
    </script>
