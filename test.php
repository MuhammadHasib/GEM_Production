<?php
include "head.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* $header = "POST /someendpoint HTTP/1.1\r\n".
  "Host:example.com\n".
  "Content-Type: application/x-www-form-urlencoded\r\n".
  "User-Agent: PHP-Code\r\n".
  "Content-Length: " . strlen($req) . "\r\n".
  "Authorization: Basic ".base64_encode($username.':'.$password)."\r\n".
  "Connection: close\r\n\r\n";
 */

$username= "gemdbusr";
$password= "Piwanu72";
$host= "gem-machine-b";
$data= array();
$ch = curl_init($host);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', $additionalHeaders));
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$return = curl_exec($ch);
curl_close($ch);

?>

<div class="container">

    <form>


        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>
<?php
include "foot.php";
?>