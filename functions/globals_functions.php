<?php


/*
 * Name: database_connection
 * Description:  Start db connection
 * Return: return Connection otherwise return 0
 * Author: Ola Aboamer [o.aboamer@cern.ch] 
 */

function database_connection() {
    
    //Databbase Connection Information 
$accountname = "CMS_GEM_APPUSER_R";
$password = "GEM_Reader_2015";
$servername = "int2r1-v.cern.ch:10121/int2r.cern.ch";
  

//load oci8 library if not load automatically
    if (!extension_loaded('oci8')) {
        dl("php_oci8.dll");
    }
    //connect to database     
    $conn = oci_connect($accountname, $password, $servername);
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        return $e;
    } else
        return $conn;
}     
/*
 * Name: get_kinds_set_globals
 * Description: Get list of manufacturers
 * return: Array of kind of parts NAME - ID
 * Useage: set globals with Kind of parts IDs as it will change when db change to Production 
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */
function get_parts_kinds_set_globals() {

    //connect to database     
    $conn = database_connection();
    
    $sql = "SELECT KIND_OF_PART_ID,DISPLAY_NAME FROM CMS_GEM_CORE_CONSTRUCT.KINDS_OF_PARTS WHERE IS_RECORD_DELETED = 'F'"; 
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);
    $result = array();
    $item = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        //echo '<a href="#" >' . $row['DISPLAY_NAME'] ."<=>".  $row['KIND_OF_PART_ID']. '</a><br>';
        $result [$row['DISPLAY_NAME']] = $row['KIND_OF_PART_ID'];
    }
    return $result;
}


/*
 * Name: get_conditions_kinds_set_globals
 * Description: Get list of Kind of condition IDs
 * return: Array of kind of parts NAME - ID
 * Useage: set globals with Kind of conditions IDs as it will change when db change to Production 
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */
function get_conditions_kinds_set_globals() {
    
    //connect to database     
    $conn = database_connection();
    
    $sql = "SELECT KIND_OF_CONDITION_ID, NAME FROM CMS_GEM_CORE_COND.KINDS_OF_CONDITIONS WHERE IS_RECORD_DELETED = 'F'"; 
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);
    $result = array();
    $item = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        //echo '<a href="#" >' . $row['DISPLAY_NAME'] ."<=>".  $row['KIND_OF_PART_ID']. '</a><br>';
        $result [$row['NAME']] = $row['KIND_OF_CONDITION_ID'];
    }
    return $result;
}


/*
 * Name: get_part_part_relns_set_globals
 * Description: Get list of part to part relationships IDs
 * return: Array of part to part relationships IDs NAME- ID
 * Useage: set globals with part to part relationships IDs as it will change when db change to Production 
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */
function get_part_part_relns_set_globals() {
    
    //connect to database     
    $conn = database_connection();
    
    $sql = "SELECT RELATIONSHIP_ID, DISPLAY_NAME FROM CMS_GEM_CORE_CONSTRUCT.PART_TO_PART_RLTNSHPS WHERE IS_RECORD_DELETED = 'F'"; 
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);
    $result = array();
    $item = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        //echo '<a href="#" >' . $row['DISPLAY_NAME'] ."<=>".  $row['KIND_OF_PART_ID']. '</a><br>';
        $result [$row['DISPLAY_NAME']] = $row['RELATIONSHIP_ID'];
    }
    return $result;
}


function getROOT($ROOT_KIND_OF_PART_ID){
    
    //connect to database     
    $conn = database_connection();
    
    $sql = "SELECT PART_ID FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE IS_RECORD_DELETED = 'F' AND KIND_OF_PART_ID = '".$ROOT_KIND_OF_PART_ID."' "; 
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);
    $result = "";
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        //echo '<a href="#" >' . $row['DISPLAY_NAME'] ."<=>".  $row['KIND_OF_PART_ID']. '</a><br>';
        $result = $row['PART_ID'];
    }
    return $result;
}