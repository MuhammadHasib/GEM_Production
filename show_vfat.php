
<?php
include "head.php";
?>


<div class="container-fluid">
    <div class="row">

        <?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"> <img src="images/VFAT_1.PNG" width="4%"> Show VFAT  </h1>

            <!--<a href="edit_vfat.php?id=<?php /*echo $_GET["id"];*/ ?>"><button class="btn btn-success" type="button">Edit</button></a>-->
            <a href="list_parts_vfat.php.php"><button class="btn btn-warning" type="button"><span aria-hidden="true" class="glyphicon glyphicon-backward"></span>Back to list</button></a>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">VFAT [<?php echo $_GET["id"]; ?>] </h3>
                </div>
                <div class="panel-body">
                     <?php
                                $data = get_part_by_ID($_GET["id"]);
                                if (!empty($data)) {
                                    ?>
                    <!-- Panel content -->
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
                                        
                    
                                           
                                            
<!--                                            <tr>
                                                <td>Status</td>
                                                <td><span class="label label-success">Accepted</span></td>
                                            </tr>

                                            <tr>
                                                <td>Parent Chamber </td>
                                                <td><a href="show_chamber.php?id=GE1/1-VI-L-CERN-0012"><span class="label label-default">GE1/1-VI-L-CERN-0012</span></a></td>
                                            </tr>

                                            <tr>
                                            <tr>
                                                <td>equipped with diodes?</td>
                                                <td><span aria-hidden="true" class="glyphicon glyphicon-ok"></span></td>
                                            </tr>-->
                                            
                                            


                                        </tbody>
                                    </table>

                                    <!-- <a href="#" class="btn btn-primary">My Sales Performance</a>
                                     <a href="#" class="btn btn-primary">Team Sales Performance</a>-->
                                </div>
                            </div>
                        </div>
<!--                        <div class="col-md-4"><img alt="200x200" class="img-thumbnail" data-src="holder.js/200x200" style="width: 200px; height: 200px;" src="uploads/RO.png" data-holder-rendered="true"></div>-->
                    </div>
<!--                    <div class="row">


                        <div class="col-md-4"><div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">QC performed:</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item"><label> visual inspection:</label> <a href="show_qc.php?id=qc1-inspxn-000001"><span aria-hidden="true" class="glyphicon glyphicon-remove" style="color: red;"></span> 22-08-2015</a> </li>
                                        <li class="list-group-item"><label> visual inspection:</label> <a href="show_qc.php?id=qc1-inspxn-000001"><span aria-hidden="true" class="glyphicon glyphicon-ok" style="color: green;"></span> 23-08-2015</a> </li>

                                    </ul>
                                </div>
                            </div></div>
                    </div>-->
                    <?php
                                } else {
                                    echo "No Item found for this ID";
                                }
                                ?>

                </div>
            </div>
        </div>
    </div>
</div>



<?php
include "foot.php";
?>

<script>
 jQuery(document).ready(function($) {
 
 $("#partslist").show();
$("#<?= $VFAT_ID; ?>").attr("class","active");

 }) 
</script>