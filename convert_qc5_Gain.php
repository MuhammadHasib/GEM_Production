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
<?php include "head_panel.php"; ?>
<?php
$out = shell_exec("python QC5_test.py '$CHAMBER' " );
$outs = trim($out);
//$test=null;
$output=shell_exec("/afs/cern.ch/user/h/hamd/www/dev/my_env/bin/python QC5_Gain_Data.py $FileName '$CHAMBER' $outs '$LOCATION' '$INITIATED_BY_USER' '$COMMENT_DESCRIPTION' '$RUN_BEGIN_TIMESTAMP' '$RUN_END_TIMESTAMP' '$Elog' '$Files' '$comments'");

$LocalFilePATH =  $FileName .=".xml";
$LocalFilePATH_2 =  $FileName .="_Data.xml";
$LocalFilePATH_3 =  $FileName .="_summry.xml";
//$check = shell_exec ("zip -r archive-$(date + %Y-%m-%d-%H:%M:%S).zip '$LocalFilePATH' '$LocalFilePATH_2' '$LocalFilePATH_3'");
//$check = shell_exec ("zip -r 'archive-$("`date + %Y-%m-%d-%H:%M:%S`").zip' '$LocalFilePATH' '$LocalFilePATH_2' '$LocalFilePATH_3'");
$check = shell_exec ("zip -r archive-$("date + %Y-%m-%d-%H:%M:%S").zip $LocalFilePATH $LocalFilePATH_2 $LocalFilePATH_3");
echo $check;

// Send the file to the spool area
//$res_arr = SendXML($check);
//echo var_dump($res_arr) ;
//echo var_dump($check) ;


// Send the file to the spool area
//$res_arr = SendXML($LocalFilePATH);
//echo var_dump($res_arr) ;
//return $res_arr;
}
?>
<?php
function unlinkr($dir, $pattern = "*") {
    // find all files and folders matching pattern
    $files = glob($dir . "/$pattern"); 

    //interate thorugh the files and folders
    foreach($files as $file){ 
    //if it is a directory then re-call unlinkr function to delete files inside this directory     
        if (is_dir($file) and !in_array($file, array('..', '.')))  {
            echo "<p>opening directory $file </p>";
            unlinkr($file, $pattern);
            //remove the directory itself
            echo "<p> deleting directory $file </p>";
            rmdir($file);
        } else if(is_file($file) and ($file != __FILE__)) {
            // make sure you don't delete the current script
            echo "<p>deleting file $file </p>";
            unlink($file); 
        }
    }
}
$dir= getcwd();
//echo $dir;
//unlinkr ($dir, "*.xml");
//unlinkr ($dir, "*.zip");
?>
<//?php include "side.php"; ?>
<?php
 include "foot.php";
 ?>
