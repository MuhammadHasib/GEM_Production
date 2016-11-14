
<?php 
include "head.php";


?>


    <div class="container-fluid">
      <div class="row">
        
<?php  include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="page-header">Form Submitted </h2>

<?php 
 
if(isset($_SESSION['post_return']) && isset($_SESSION['new_chamber_ntfy'])){
    
    $session = $_SESSION['post_return'];
    $ntfn = $_SESSION['new_chamber_ntfy'];
    
    echo $ntfn;
    
    if($session['statuscode'] == "200"){
        echo '</br><span class="label label-success"> <b>Status code:</b>'.$session['statuscode'].'</span> ';
        echo '<span class="label label-success label-white middle">Successfully loaded into Database</span>';
        echo '<hr><div class="alert alert-success" role="alert"><b>Execution return:</b>'.$session['return'].'</div>'; 
        error_log($session['statuscode']." - ".$session['return'], 3, "gui-errors.log");
    }
    else if($session['statuscode'] == "503"){
        echo '</br><span class="label label-danger"> <b>Status code:</b>'.$session['statuscode'].'</span> ';
        echo '<span class="label label-danger label-white middle">Error in loading into Database, you can contact the <a href="contact.php">Adminstrator</a></span>';
        echo '<hr><div class="alert alert-danger" role="alert"><b>Execution return:</b>'.$session['return'].'</div>';
        error_log($session['statuscode']." - ".$session['return'], 3, "gui-errors.log");
    }
    else{
        echo '</br><span class="label label-warning"> <b>Status code:</b>'.$session['statuscode'].'</span> ';
        echo '<span class="label label-warning label-white middle"><i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>Warning and faild to load into Database, you can contact the <a href="contact.php">Adminstrator</a></span>';
        echo '<hr><div class="alert alert-warning" role="alert"><b>Execution return:</b>'.$session['return'].'</div>';
        error_log($session['statuscode']." - ".$session['return'], 3, "gui-errors.log");
    }
}

?>

        </div>
      </div>
    </div>



  <?php 
include "foot.php";

?>
<script>
    // Script to disable back button 
history.pushState(null, null, document.URL);
window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
});
</script>