
<?php
include "head.php";
?>


<div class="container-fluid">
    <div class="row">

<?php include "side.php"; ?>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Add IV Characteristics </h1>
            <form method="POST" action="new_qc_iv.php.php">
            <div class="row">
            <div class="col-xs-12 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                <div class="panel-heading ">
                    <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-cog"></span>On which chamber test performed?</h3>
                </div>
                <div class="panel-body">
                    <span class="text-muted"></span>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Choose Chamber:</label>
                        <!--<p class="help-block">help text here.</p> -->  
                        <input name="chamber1Id" value="" hidden>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Chamber
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <?php list_chambers(); ?>
<!--                                <li><a class="FOIL-VI1" href="#"> GE1/1-VI-L-CERN-0001</a></li>
                                <li><a class="FOIL-VI1" href="#"> GE1/1-VI-S-BARI-0002</a></li>
                                <li><a class="FOIL-VI1" href="#"> GE1/1-VI-L-BARI-0003</a></li>
                                <li><a class="FOIL-VI1" href="#"> GE1/1-VI-S-CERN-0004</a></li>
                                <li><a class="FOIL-VI1" href="#"> GE1/1-VI-L-GHENT-0005</a></li>-->
                            </ul>
                        </div>
                        
                    </div>


                </div>
            </div>
            </div>
            <div class="row">
             <div class="col-xs-12 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                <div class="panel-heading ">
                    <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-cog"></span>Enviroment:</h3>
                </div>
                <div class="panel-body">
                    <label> Pressure</label><br><input type="text" name="name" id="pressure" class="pressure" value=""/> 
                    <br><label>Temperature</label><br> <input type="text" name="name" id="temp" value=""/> 
                    <br><label>Humidity</label><br> <input type="text" name="name" id="name" class="v" value=""/>
                    </div>
                 </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                <div class="panel-heading ">
                    <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-cog"></span>Add V & I Values</h3>
                </div>
                <div class="panel-body">
                <a  id="add"><span class="label label-success"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span></span></a></td>
                        <table id="mytable" width="300" border="1" cellspacing="0" cellpadding="2">
                            <tbody>
                                <tr>
                                    <td>Vset (V)</td>
                                    <td>Imon (uA)</td>
                                    <td>Resistance (MΩ)</td>
                                </tr>
                                <tr class="person">
                                    <td><input type="text" name="name" id="name" class="v" value=""/></td>
                                    <td><input type="text" name="name" id="imon" class="imon"/></td>
                                    <td><input type="text" name="name" id="risit" class="risit" /></td>
                                </tr>
                            </tbody>
                        </table>
            </div>
                    </div>
                </div>
<div class="row">
                        <div class="col-xs-12 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading ">
                                <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-comment"></span>Comments:</h3>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label for="comment"> Leave your comment:</label>
                                    <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                <button type="submit" class="btn btn-default btn-lg subbutt">Submit</button> 
</form>

        </div>
    </div>
</div>



<?php
include "foot.php";
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#add").click(function () {
            $('#mytable tbody>tr:last').clone(true).insertAfter('#mytable tbody>tr:last');
            //alert($('#mytable tbody>tr:last').find("input").first().val());
            //$('#mytable tbody>tr:last').find("input").first().val( $(this).val()+100);
            return false;
        });
        
            $(".imon").focus(function() {
    console.log('in');
}).blur(function() {
    console.log('out');
    $(this).parent().next().find("input").attr("value","3300")
});
    });
</script>