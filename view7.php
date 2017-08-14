<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 

?>
<?php

include "head.php";
?>
<html>
<head>
    <style>
        #sidebar{
            border: none;
            background-color: cadetblue;
            color: floralwhite;
            padding: 0%;
            width: 100%;
            float: left;
        }
        .ip{
          margin-left: 5%;
          margin-bottom: 2%;
        }
        label
        {
          font-family: Calibri;
        }
    </style>
	<script type="text/javascript" src="/js/jquery-2.1.3.min.js"></script>
  </head>
  <!--<body style='margin:0;'>-->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

  <div id="sidebar">

<!--      <a href="Homes.php" style="color: floralwhite; font-family: Calibri; font-size: large;">Home</a>-->
  </div>
  <br>
  <div id="myform" style="margin-left:26%; margin-top:7%;">
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="sprchbrid">Select Super Chamber Serial Number:</label>
  <select class="ip" name="sprchbrid">
  <option value="" selected hidden>Please choose..</option>
  <option value="GE1/1-SCS-001">GE1/1-SCS-01</option>
  <option value="GE1/1-SCS-002">GE1/1-SCS-02</option>
  <option value="GE1/1-SCS-003">GE1/1-SCS-03</option>
  <option value="GE1/1-SCL-001">GE1/1-SCL-01</option>
  <option value="GE1/1-SCL-002">GE1/1-SCL-02</option>
  </select>
  <br>
  <label for="depth">Depth:</label>
  <select class="ip" name="depth">
  <option value="" selected hidden>Please choose..</option>
  <option value="1">1</option>
  <option value="2">2</option>
  </select><br>
  <label for="posn">Foil Part ID:</label>
  <input name="posn" type="number" class="ip"><br>
  <input type="submit" name="sbtbtn"><br>
  </form>
  </div>
  <div id="t">
    <?php
    if(!empty($_POST))
    {
    $d=$_POST['depth'];
    $p=$_POST['posn'];
    $s=$_POST['sprchbrid'];
    $q="Select * from CMS_GEM_MUON_VIEW.GEM_SPRCHMBR_PARTS_VIEW WHERE ";
    if(!empty($_POST['depth']))
    {
        $q=$q."DEPTH LIKE '$d'";
        if(!empty($_POST['posn'])||!empty($_POST['sprchbrid']))
        {
          $q=$q." AND ";
        }
    }
    if(!empty($_POST['posn']))
    {
      $q=$q."VFAT_POSN LIKE '$p'";
      if(!empty($_POST['sprchbrid']))
      {
        $q=$q." AND ";
      }
    }
    if(!empty($_POST['sprchbrid']))
    {
      $q=$q."SPER_CHMBR_SER_NUM LIKE '$s'";
    }
}
$accountname = "CMS_GEM_APPUSER_R";
$password = "GEM_Reader_2015";
$servername = "(DESCRIPTION=(ADDRESS= (PROTOCOL=TCP) (HOST=cmsonr1-adg1-s.cern.ch) (PORT=10121) )
                      (ADDRESS= (PROTOCOL=TCP) (HOST=cmsonr2-adg1-s.cern.ch) (PORT=10121) )
                     (LOAD_BALANCE=on)
                     (ENABLE=BROKEN)
                      (CONNECT_DATA=
                     (SERVER=DEDICATED)
                     (SERVICE_NAME=cms_omds_adg.cern.ch)
                      )
                  )";
    
//$conn = oci_connect("CMS_GEM_APPUSER_R", "GEM_Reader_2015", "int2r1-v.cern.ch:10121/int2r.cern.ch");
    //$conn = oci_connect("CMS_GEM_APPUSER_R", "GEM_Reader_2015", "cmsonr2-adg1-s.cern.ch/cms_omds_adg.cern.ch");
 $conn = oci_connect($accountname, $password, $servername); 
if (!$conn)
      {
         $m = oci_error();
         echo $m['message'], "\n";
         exit;
      }
    $array = oci_parse($conn,$q);
    oci_execute($array);
    echo "<table border=\"1\"><tr>";
     $fields_num = oci_num_fields($array);
      $i=1;
      while($i<=$fields_num)
      {
       $field = oci_field_name($array,$i);
        echo "<th>".$field."</th>";
        $i++;
      }
    echo "</tr>";

    while($row=oci_fetch_row($array))
    {
      echo "<tr>";
      foreach($row as $cell)
      {
        echo "<td>".$cell."</td>";
      }
      echo "</tr>";
      $i++;
    }
    oci_free_statement($array);
    oci_close($conn);
  
    ?>
  </div>
  </body>
  </html>

<?php include "side.php"; ?>
<?php
include "foot.php";
?>

