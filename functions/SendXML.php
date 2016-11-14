<?php
 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$connection = ssh2_connect('gem-machine-a', 22);
echo "tt".$connection;
ssh2_auth_password($connection, 'gemdbusr', 'Piwanu72');
ssh2_scp_send($connection, 'gen_xml/FOIL-B1-L-0056.xml', '/home/dbspool/data/gem/int2r/FOIL-B1-L-0056.xml', 0644);
$auth_methods = ssh2_auth_none($connection, 'gemdbusr');
var_dump($auth_methods);
if (in_array('password', $auth_methods)) {
  echo "Server supports password based authentication\n";
}
// Add this to flush buffers/close session 
ssh2_exec($connection, 'exit'); 
