<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li id="dash" class=""><a href="first.php"><i class="menu-icon fa fa-tachometer"></i> Dashboard <span class="sr-only">(current)</span></a></li>
        <li id="part" class=""><a href="list_parts.php"><i class="menu-icon fa fa-file-o"></i> Parts</a>
            <ul id="partslist" style="display: none; margin-left: 45px;" class=" nav-sidebar ">
                <li id="<?= $FOIL_ID; ?>" class=""><a href="list_parts_gem.php">FOILs</a>
                <li id="<?= $GEB_ID; ?>" class=""><a href="list_parts_geb.php">GEBs</a>
                <li id="<?= $DRIFT_ID; ?>" class=""><a href="list_parts_drift.php">DRIFTs</a>
                <li id="<?= $READOUT_ID; ?>" class=""><a href="list_parts_readout.php">READOUTs</a>  
                <li id="<?= $OPTOHYBRID_ID; ?>" class=""><a href="list_parts_opto.php">OPTOHYBRIDs</a>
                <li id="<?= $VFAT_ID; ?>" class=""><a href="list_parts_vfat.php">VFATs</a>
            </ul>
        </li>
        <li id="chamber" class=""><a href="list_chambers.php"><i class="menu-icon fa fa-file-o"></i> Chambers</a></li>
        <li id="schamber" class=""><a href="list_sup_chambers.php"><i class="menu-icon fa fa-file-o"></i> SuperChambers</a></li>
        <li id="qc" class=""><a href="list_qc.php"><i class="menu-icon fa fa-file-o"></i> Quality Controls</a></li>
        <li id="track" class=""><a href="track_parts_step1.php"><span aria-hidden="true" class="glyphicon glyphicon-globe"></span> Tracking Parts</a></li>
        <li id="map" class=""><a href="search_channels_pin.php"><span aria-hidden="true" class="glyphicon glyphicon-search"></span> Channel mapping</a></li>
    </ul>
    <!-- <ul class="nav nav-sidebar">
       <li><a href="">Nav item</a></li>
       <li><a href="">Nav item again</a></li>
       <li><a href="">One more nav</a></li>
       <li><a href="">Another nav item</a></li>
       <li><a href="">More navigation</a></li>
     </ul>
     <ul class="nav nav-sidebar">
       <li><a href="">Nav item again</a></li>
       <li><a href="">One more nav</a></li>
       <li><a href="">Another nav item</a></li>
     </ul>-->
</div>