 <?php
  include "head.php";
  ?>
 <?php
  include "side.php";
  ?>
<html>
<head>
    <style>
        #sidebar{
            border: none;
            background-color: ;
            color: floralwhite;
            padding: 0%;
            width: 100%;
            float: left;
        }
    </style>
	<script type="text/javascript" src="/js/jquery-2.1.3.min.js"></script>
    <script>

function ajfunc(str,offset){
  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("t").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "list.php?v=" + str + "&offset="+offset, true);
        xmlhttp.send();
}
//$(document).scroll(function(){
  //  var scrollAmount = $(window).scrollTop();
    //var documentHeight = $(document).height();
    //var scrollPercent = (scrollAmount / documentHeight) * 100;
    //if(scrollPercent > 50) {
      //var st=document.getElementById("getval").innerHTML;
    //  var off=document.getElementById("offval").innerHTML+50;
    //  ocument.getElementById("offval").innerHTML=off;
      //ajfunc(st,off);
    //}
//});
    </script>
</head>
<?php
$t=$_GET['viewtype'];
$v="";
switch($t)
{
case 1:
$v='COSMIC_VFAT_CHANNELS_VIEW';
break;
case 2:
$v='GEM_AMC13_CONFIGURATION_VIEW';
break;
case 3:
$v='GEM_CHMBR_PARTS_VIEW';
break;
case 4:
$v='GEM_IPADRS_MAP_VIEW';
break;
case 5:
$v='GEM_QC2_FAST_DATA_VIEW';
break;
case 6:
$v='GEM_SPRCHMBR_OPTHYB_VFATS_VIEW';
break;
case 7:
$v='GEM_SPRCHMBR_PARTS_VIEW';
break;
case 8:
$v='GEM_VFAT_CHANNELS_VIEW';
break;
case 9:
$v='GEM_VFAT2_CHAN_SET_VIEW';
break;
case 10:
$v='GEM_VFAT2_CONFIGURATION_VIEW';
break;
case 11:
$v='V_CHMBER_VFAT_CHAN_VIEW';
break;
case 12:
$v='V_CMS_GEM_CHMBER_VFATS_VIEW';
break;
}
echo "<body style='margin:0;' onload='ajfunc(\"$v\",1)'>";
//echo "<p id='getval' style='display:None;'>".$v."</p>";
//<p id="offval" style="display:None;">1</p>
?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div id="sidebar">
    <a href="Homes.php" style="color: floralwhite; font-family: Calibri; font-size: large;">Home</a>
</div>
<div style="float: right; margin-right:12%; margin-top:3%;" id="filter">
    <!--<form>
        <select style="width: 200%;">
            <option disabled selected hidden>Filter</option>
        </select>
    </form>-->
</div>
<div id="t">
</div>
<?php
$conn = oci_connect("CMS_GEM_APPUSER_R", "GEM_Reader_2015", "int2r1-v.cern.ch:10121/int2r.cern.ch");
  if (!$conn)
  {
     $m = oci_error();
     echo $m['message'], "\n";
     exit;
  }
//$q="Select count (*) from CMS_GEM_MUON_VIEW.$v";
//$q="Select count(*) as total from CMS_GEM_MUON_VIEW.$v";
$q="Select count(*) as total from CMS_GEM_MUON_VIEW.V_CHMBER_VFAT_CHAN_VIEW";
//$q="Select * from CMS_GEM_MUON_VIEW.$v";
$array = oci_parse($conn,$q);
oci_execute($array);
$co=oci_fetch_row($array);
//$co=oci_fetch_array($array);
$c=$co[0];
if($c%100==0)
  {
    $c=$c/100;
  }
  else {
    $c=($c/100)+1;
  }
  echo "<div id=\"pagebtns\" style=\"float: left;\">";
  for($count=1;$count<=$c;$count++)
  {
    //echo "<a href=\"#\" onClick='ajfunc(\"$v\",$count)'>$count</a>";
    echo "<a href=\"#\" onClick='ajfunc(\"V_CHMBER_VFAT_CHAN_VIEW\",$count)'>$count</a>";
  }
  oci_free_statement($array);
  oci_close($conn);
  ?>
</body>
</html>
 <?php
  include "foot.php";
  ?>
