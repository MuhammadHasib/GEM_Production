<?php
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
//$conn = oci_connect("CMS_GEM_APPUSER_R", "GEM_Reader_2015", "int2r1-v.cern.ch:10121/int2r.cern.ch");
if (!$conn)
{
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
$v=$_GET['v'];
$off=$_GET['offset'];
$off=($off-1)*100;
$query="Select * from (select rownum rnum, a.* from (select * from CMS_GEM_MUON_VIEW.$v order by 1) a where rownum<=$off + 100) where rnum> $off";
$array = oci_parse($conn,$query);
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
echo "</table>";
oci_free_statement($array);
oci_close($conn);
?>
