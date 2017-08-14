<?php

if(isset($_POST["submited"])){
include_once "functions/functions.php";
include_once "functions/generate_xml.php";
include_once "functions/globals.php";
include_once "functions/generate_xml.php";
$conn = database_connection();
//if(isset($_FILES["file"])){
$CHAMBER= $_POST['CHAMBER'];
$RUN_NUMBER = $_POST['RUN_NUMBER'];
$RUN_TYPE = $_POST['RUN_TYPE'];
$RUN_BEGIN_TIMESTAMP = date($_POST['RUN_BEGIN_TIMESTAMP'].':s');
$RUN_END_TIMESTAMP = date($_POST['RUN_END_TIMESTAMP'].':s');
$LOCATION = $_POST['LOCATION'];
$INITIATED_BY_USER = $_POST['INITIATED_BY_USER'];
$COMMENT_DESCRIPTION = $_POST['COMMENT_DESCRIPTION'];
$Elog= $_POST['Elog_Link'];
$Files= $_POST['File_Name'];
$comments= $_POST['comment'];

$FileName= $_FILES['file']['name'];
$FileTmp= $_FILES['file']['tmp_name'];
$FileType= $_FILES['file']['type'];
$FileSize= $_FILES['file']['size'];
$FileError=$_FILES['file']['error'];
//echo var_dump($_POST);
//echo "<div align='center'>File is Invalid</div>";
//echo "<div align='center'>Data is loaded into DB for chamber $CHAMBER</div>";
if (($FileSize > 2000000)){
	die("Error - File is too Long");
}
if (!$FileTmp){
	die("No File Selected, Please Upload Again");
}else{
	move_uploaded_file($FileTmp,"$FileName");
}
?>
<?php
  include "head.php";
  ?>
<?php
$out = shell_exec("python QC4_test.py '$CHAMBER' " );
$outs = trim($out);
//$test=null;
$output=shell_exec("/afs/cern.ch/user/h/hamd/www/dev/my_env/bin/python QC4_HV_Data.py $FileName '$CHAMBER' $outs $LOCATION $INITIATED_BY_USER '$COMMENT_DESCRIPTION' '$RUN_BEGIN_TIMESTAMP' '$RUN_END_TIMESTAMP' '$Elog' '$Files' '$comments'");

$LocalFilePATH =  $FileName .=".xml";
$LocalFilePATH_2 =  $FileName .="_Data.xml";
//$LocalFilePATH =  "GE11-X-S-CERN-0001_QC4_20170504.xlsx_Data.xml";
//$LocalFilePATH =  "GE11-X-L-CERN-0001_QC4_20170608.xlsx_summry.xml";
$LocalFilePATH_3 =  $FileName .="_summry.xml";
//echo $LocalFilePATH;
//$LocalFilePATH_2 =  "GE11-X-L-CERN-0001_QC4_20170608.xlsx_Data.xml";
//$LocalFilePATH_3 =  "GE11-X-L-CERN-0001_QC4_20170608.xlsx.xml";
// Send the file to the spool area
$res_arr = SendXML($LocalFilePATH);
$res_arr_2 = SendXML($LocalFilePATH_2);
$res_arr_3 = SendXML($LocalFilePATH_3);
//echo var_dump($res_arr) 
echo var_dump($res_arr) ;
//echo var_dump($res_arr_2) ;
//echo var_dump($res_arr_3) ;
//return $res_arr;
//return $res_arr_2;
//return $res_arr_3;

// Set session variables with the return 
                    //session_start() ;
                    //$_SESSION['post_return'] = $res_arr;
                    //$_SESSION['post_return'] = $res_arr_2;
                    //$_SESSION['post_return'] = $res_arr_3;
                    //$_SESSION['new_chamber_ntfy'] = '<div role="alert" class="alert alert-success">
      //<strong>Well done!</strong> You successfully generated XML file for a list of GEM FOIL(s) data 
        //            </div>';
         //           // redirect to confirm page
          //         header('Location: https://gemdb.web.cern.ch/gemdb/confirmation.php'); //?msg='.$msg."&statusCode=".$statusCode."&return=".$return
            //            die();
}
?>

<//?php include "side.php"; ?>
<?php
 include "foot.php";
 ?>
