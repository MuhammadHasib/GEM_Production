
<?php
include "head.php";
?>


<div class="container-fluid">
    <div class="row">

        <?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"> <img src="images/c2.png" width="4%">Show Chamber  </h1>

            <!--<a href="edit_chamber.php?id=<?php /*echo $_GET["id"];*/ ?>"><button class="btn btn-success" type="button">Edit</button></a>-->
            <a href="list_chambers.php"><button class="btn btn-warning" type="button"><span aria-hidden="true" class="glyphicon glyphicon-backward"></span>Back to list</button></a>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Chamber [<?php echo $_GET["id"]; ?>] </h3>
                </div>
                <div class="panel-body">
                     <?php
                                $data = get_part_by_ID($_GET["id"]);
                                if (!empty($data)) {
                                    ?>
                   <div class="row">
                        <div class="col-md-8">
                            <div class="row">



                                <div class=" col-md-12 col-lg-12 "> 
                                    <table class="table table-user-information">
                                        <tbody>
                             <?php
                                    if (!empty($data[0]['PART_ID'])) {
                                        ?> <tr>
                                                <th>ID</th>
                                                <td><?= $data[0]['PART_ID'] ?></td>
                                            </tr> <?php
                                    }
                                    if (!empty($data[0]['SERIAL_NUMBER'])) {
                                        ?> <tr>
                                                <th>Serial Number:</th>
                                                <td><?= $data[0]['SERIAL_NUMBER'] ?></td>
                                            </tr> <?php
                                    }
                                    if (!empty($data[0]['NAME_LABEL'])) {
                                        ?> 
                                            <tr>
                                                <th>Name:</th>
                                                <td><?= $data[0]['NAME_LABEL'] ?></td>
                                            </tr>
                                            <?php
                                    }
                                    if (!empty($data[0]['BARCODE'])) {
                                        ?> 
                                            <tr>
                                                <th>Barcode:</th>
                                                <td> <?= $data[0]['BARCODE']; ?></td>
                                            </tr>
                                            <?php
                                    }
                                    
                                    if (!empty($data[0]['RECORD_INSERTION_TIME'])) {
                                        ?> 
                                            <tr>
                                                <th>Inserted at:</th>
                                                <td> <?= $data[0]['RECORD_INSERTION_TIME']; ?></td>
                                            </tr>
                                            <?php
                                    }
                                    if (!empty($data[0]['RECORD_INSERTION_USER'])) {
                                        ?> 
                                            <tr>
                                                <th>Inserted by:</th>
                                                <td> <?= $data[0]['RECORD_INSERTION_USER']; ?></td>
                                            </tr>
                                            <?php
                                    }
                                    if (!empty($data[0]['MANUFACTURER_ID'])) {
                                        ?> 
                                            <tr>
                                                <th>Manufacturer name:</th>
                                                <td><?= $data[0]['MANUFACTURER_ID']; ?></td>
                                            </tr>
                                            <?php
                                    }
                                    if (!empty($data[0]['LOCATION_ID'])) {
                                        ?> 
                                             <tr>
                                                 <th>Location:</th>
                                                <td><?= $data[0]['LOCATION_ID']; ?></td>
                                            </tr>
                                            <?php
                                    }
                                    if (!empty($data[0]['COMMENT_DESCRIPTION'])) {
                                        ?> 
                                            <tr>
                                                <th>Comment or description:</th>
                                                <td><?= $data[0]['COMMENT_DESCRIPTION']; ?></td>
                                            </tr>
                                            <?php
                                    }
                                    ?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        <!--<div class="col-md-4"><img alt="200x200" class="img-thumbnail" data-src="holder.js/200x200" style="width: 200px; height: 200px;" src="uploads/GEM.png" data-holder-rendered="true"></div>-->
                    </div>
                                            <?php
                                } else {
                                    echo "No Item found for this ID";
                                }
                                ?>
<!--                     Panel content 
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">



                                <div class=" col-md-12 col-lg-12 "> 
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td>Serial Number</td>
                                                <td><?php echo $_GET["id"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Manufacturer name:</td>
                                                <td>XYZ</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td><span class="label label-success">Accepted</span></td>
                                            </tr>

                                            <tr>
                                            <tr>
                                                <td>equipped with diodes?</td>
                                                <td><span aria-hidden="true" class="glyphicon glyphicon-ok"></span></td>
                                            </tr>
                                            <tr>
                                                <td>Username:</td>
                                                <td> Mr. X</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><a href="mailto:info@support.com">x@cern.ch</a></td>
                                            </tr>


                                        </tbody>
                                    </table>

                                     <a href="#" class="btn btn-primary">My Sales Performance</a>
                                     <a href="#" class="btn btn-primary">Team Sales Performance</a>
                                </div>
                            </div>
                            </div>
                        <div class="col-md-4"><img alt="200x200" class="img-thumbnail" data-src="holder.js/200x200" style="width: 200px; height: 200px;" src="uploads/GEM.png" data-holder-rendered="true"></div>
                    </div>-->
                   <div class="row">
                                <div class="col-md-4"><div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Detector parts:</h3>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-group">
                                                <?php get_attached_parts($data[0]['PART_ID']); ?>
<!--                                                <li class="list-group-item"><label> GEM Foil 1:</label> <a href="show_gem.php?id=FOIL-VI-L-CERN-0001">FOIL-VI-L-CERN-0001</a> </li>
                                                <li class="list-group-item"><label> GEM Foil 2:</label> <a href="show_gem.php?id=FOIL-VI-L-CERN-0004">FOIL-VI-L-CERN-0004</a></li>
                                                <li class="list-group-item"><label> GEM Foil 3:</label> <a href="show_gem.php?id=FOIL-VI-L-CERN-0007">FOIL-VI-L-CERN-0007</a></li>
                                                <li class="list-group-item"><label> Readout:</label> <br> <a href="show_readout.php?id=PCB-RO-VI-L-CERN-0001">PCB-RO-VI-L-CERN-0001</a></li>
                                                <li class="list-group-item"><label> Drift:</label> <a href="show_drift.php?id=PCB-DR-VI-L-CERN-0001">PCB-DR-VI-L-CERN-0001</a></li>-->
                                            </ul>
                                        </div>
                                    </div></div>
                               <!-- <div class="col-md-4"><div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Electronics parts:</h3>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-group">
                                                <li class="list-group-item"><label> GEB:</label> <a href="show_geb.php?id=PCB-GEB-VI-L-CERN-0001">PCB-GEB-VI-L-CERN-0001</a> </li>
                                                <li class="list-group-item"><label> VFAT(s):</label> 
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br><a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br><a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br><a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0012</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0015</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0123</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0126</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                    <br> <a href="show_vfat.php?id=VFAT-VI-2-CERN-0001">VFAT-VI-2-CERN-0001</a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div></div>-->
                       <!-- <div class="col-md-4"><div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">QC performed:</h3>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-group">
                                                
                                                <li class="list-group-item"><label> IV:</label> <a href="show_qc_iv.php?id=qc1-inspxn-000001"><span aria-hidden="true" class="glyphicon glyphicon-ok" style="color: green;"></span> 23-08-2015</a> </li>
                                                
                                            </ul>
                                        </div>
                                    </div></div>-->
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include "foot.php";
?>
