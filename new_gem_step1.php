
<?php
include "head.php";
?>


<div class="container-fluid">
    <div class="row">

        <?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">New GEM FOIL</h1>


<!--            <a href="new_gem.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add 1 new Foil</button></a>
            <a href="new_gem_multi.php"><button type="button" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Multiple new Foils</button></a>-->


            <a href="new_gem.php" class="btn btn-default btn-app radius-4">
                <img height="42" src="images/foil2.png">
                <br>
                Add Foil
                <span class="badge badge-success"><i class="ace-icon glyphicon glyphicon-plus"></i></span>
            </a>
            
            <a class="btn btn-default btn-app radius-4" href="new_gem_multi.php">
                <i class="ace-icon glyphicon glyphicon-book"></i>
                Foil Data
                <span class="badge badge-success"><i class="ace-icon glyphicon glyphicon-plus"></i></span>
            </a>

        </div>
    </div>
</div>



<?php
include "foot.php";
?>
