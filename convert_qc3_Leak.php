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
if (($FileSize > 2000000)){
	die("Error - File is too Long");
}
if (!$FileTmp){
	die("No File Selected, Please Upload Again");
}else{
	move_uploaded_file($FileTmp,"$FileName");
}
}
?>
<?php
  include "head.php";
  ?>
<?php include "side.php"; ?>
<?php
     // <strong>Well done!</strong> You successfully generated XML file for a list of GEM FOIL(s) data 

echo "<div align='center'>Data is loaded into DB for chamber $CHAMBER</div>";
$out = shell_exec("python test.py $CHAMBER " );
?>
<?php
$outs = trim($out);
$output = shell_exec("/afs/cern.ch/user/h/hamd/www/dev/my_env/bin/python QC3_Data_SERVER_COPY.py $FileName $outs $LOCATION $INITIATED_BY_USER '$COMMENT_DESCRIPTION' '$RUN_BEGIN_TIMESTAMP' '$RUN_END_TIMESTAMP' '$Elog' '$Files' '$comments' ");
echo var_dump($output);
//echo $outs;
?>
<?php
 include "foot.php";
 ?>
