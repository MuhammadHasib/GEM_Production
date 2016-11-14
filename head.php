<?php 

// if development mode
if(isset($_GET['dev']))
{
	/*Error Reporting */
//	error_reporting(E_ALL);
//	ini_set('display_errors', 1);
}
/**********/

/******************************/
/*** Get User Information *****/
/******************************/
//print_r($_SERVER);
$logName = $_SERVER['ADFS_LOGIN'];
//$pieces = (explode("\\",$name));
//$logName = $pieces[1];

// xml post structure
$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <GetUserInfoFromLogin xmlns="https://winservices-soap.web.cern.ch/winservices-soap/Generic/Authentication.asmx">
      <UserName>string</UserName>
    </GetUserInfoFromLogin>
  </soap:Body>
</soap:Envelope>';
$headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: https://winservices-soap.web.cern.ch/winservices-soap/Generic/Authentication.asmx/GetUserInfoFromLogin", 
                        "Content-length: ".strlen($xml_post_string),
                    ); //SOAPAction: your op URL

        $url = 'https://winservices-soap.web.cern.ch/winservices-soap/Generic/Authentication.asmx/GetUserInfoFromLogin';
$data = array('UserName' => $logName);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Authorization: Basic " . base64_encode("gemdbusr:Dixa-Saku"),//"Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

//var_dump($result);
    
$xml = simplexml_load_string($result);

//print_r($xml);
$userInfo = (array)$xml;
session_start();
$_SESSION['user'] = $userInfo['login'];
//print_r($userInfo);
//print_r($data);
//echo $userInfo['name'];
/*****************************************/
/******* End Get user Information ********/
/*****************************************/




?>

<?php
include_once "functions/functions.php";
include_once "functions/generate_xml.php";
include_once "functions/globals.php";

?>

<!DOCTYPE html>
<html lang="en" class="js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GEM detector database</title>
 
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon"> 

    <!-- Bootstrap -->
    <link href="css/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/dashboard.css" rel="stylesheet">
        <link href="bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <link href="plugins/chosen_v1.4.2/chosen.css" rel="stylesheet" media="screen">
        <link href="css/custom_GEM.css" rel="stylesheet">
        
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body style='background-image: url("images/1bg.jpg");'>

<div id="preloader"></div>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="first.php"> <img src="images/logo.jpg" style="height:35px;
width:35px;
display:inline-block;    
text-decoration: none;
vertical-align:text-center; border-radius: 25px; margin-top: -8px;">  GEM Detector Database</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
             <form class="navbar-form navbar-right" method="GET" action="search.php">
                <span class="glyphicon glyphicon-search" aria-hidden="true" style="color: white;"></span> <input class="form-control" placeholder="Search Part, chamber Or s-chamber" type="text" name="id">
          </form> 
            
          <ul class="nav navbar-nav navbar-right">
            <li> <a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Welcome, <?php echo $userInfo['name'];?></a></li>
            <li><a href="first.php">Dashboard</a></li>
            <!-- <li><a href="#">Settings</a></li> -->
            <!--  <li><a href="profile.php">Profile</a></li> -->
            <li><a href="how_to_use.php">How to use</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
           
        </div>
      </div>
    </nav>
<?php include "head_panel.php"; ?>