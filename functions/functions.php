<?php

include_once "globals.php";



/*
 * Name: get_part_ID
 * Description: Get part id of latest inserted part by kind of part
 * Parameters: $part_id [ String ] kind of part id, $version [String] -L- or -S- means long or short 
 * Return: return ID [ String ] if exist otherwise return 0
 * Author: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_part_ID($part_id, $version = NULL) {

    // Database connection 
    $conn = database_connection();

    //Query string
    if ($version == NULL) {
        $sql = "SELECT SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $part_id . "' ORDER BY SUBSTR(SERIAL_NUMBER, -4)  asc "; //select data or insert data
    } else {
        $sql = "SELECT SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $part_id . "' AND SERIAL_NUMBER LIKE '%" . $version . "%' ORDER BY SUBSTR(SERIAL_NUMBER, -4)  asc"; //select data or insert data 
    }
    // Execute query  
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_rec = 0;
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {

        foreach ($row as $item) {
            //echo "<li>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</li>";
            if ($item !== null)
                $result_rec = $item;
        }
    }
    if ($result_rec !== 0) {
        //echo $result_rec ;
        $sql = "SELECT SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE SERIAL_NUMBER='" . $result_rec . "'"; //select data or insert data
        $query = oci_parse($conn, $sql);
        //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
        $arr = oci_execute($query);

        $result_rec = 0;
        while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {

            foreach ($row as $item) {
                //echo "<li>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</li>";
                if ($item !== null)
                    return $item;
            }
        }
    }
    else {
        return 0;
    }
}

/*
 * Name: get_part_ID
 * Description: Get part id of latest inserted part by kind of part
 * Parameters: $part_id [ String ] kind of part id, $version [String] -L- or -S- means long or short 
 * Return: return ID [ String ] if exist otherwise return 0
 * Author: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_list_part_ID($part_id) {

    // Database connection 
    $conn = database_connection();

    $sql = "SELECT PART_ID,SERIAL_NUMBER,RECORD_INSERTION_USER  FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $part_id . "' AND IS_RECORD_DELETED = 'F'"; //select data or insert data
    // Execute query  
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $result[] = $row;
        foreach ($row as $item) {
            
        }
    }

    return $result;
}

/*
 * Name: get_part_by_ID
 * Description: Get part by serial
 * Parameters: $part_id [ String ] part serial number
 * Return: return ID [ String ] if exist otherwise return 0
 * Author: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_part_by_ID($part_id) {

    // Database connection 
    $conn = database_connection();

    $sql = "SELECT PART_ID,SERIAL_NUMBER,NAME_LABEL,BARCODE,RECORD_INSERTION_USER, COMMENT_DESCRIPTION,RECORD_INSERTION_TIME,MANUFACTURER_ID, LOCATION_ID   FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE SERIAL_NUMBER='" . $part_id . "'"; //select data or insert data
    // Execute query  
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $result[] = $row;
    }

    if (!empty($result[0]['LOCATION_ID'])) {
        $sql1 = "SELECT LOCATION_NAME FROM CMS_GEM_CORE_MANAGEMNT.LOCATIONS WHERE LOCATION_ID ='" . $result[0]['LOCATION_ID'] . "'";
        $query1 = oci_parse($conn, $sql1);
        //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
        $arr1 = oci_execute($query1);

        while ($row = oci_fetch_array($query1, OCI_ASSOC + OCI_RETURN_NULLS)) {

            $result[0]['LOCATION_ID'] = $row['LOCATION_NAME'];
        }
    }
    if (!empty($result[0]['MANUFACTURER_ID'])) {
        $sql2 = "SELECT MANUFACTURER_NAME FROM CMS_GEM_CORE_CONSTRUCT.MANUFACTURERS WHERE MANUFACTURER_ID ='" . $result[0]['MANUFACTURER_ID'] . "'";
        $query2 = oci_parse($conn, $sql2);
        //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
        $arr2 = oci_execute($query2);
        while ($row = oci_fetch_array($query2, OCI_ASSOC + OCI_RETURN_NULLS)) {

            $result[0]['MANUFACTURER_ID'] = $row['MANUFACTURER_NAME'];
        }
    }

    //print_r($result);
    return $result;
}

/*
 * Name: part_is_insertd
 * Description: check if part by serial if it is already inserted into db
 * Parameters: $partid [ String ] part serial number
 * Return: return 1 | 0
 * Author: Ola Aboamer [o.aboamer@cern.ch]
 */
function part_is_insertd($partid){
        // Database connection 
    $conn = database_connection();

    $sql = "SELECT SERIAL_NUMBER  FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE SERIAL_NUMBER='" . $partid . "'"; 
    // Execute query  
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $flag = 0;
    $result = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $result[] = $row;
        
        $flag= 1;
    
    }
    
    echo $flag;
}

/*
 * Name: get_locations
 * Description: Get list of loacations
 * return: Array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_locations() {
    $conn = database_connection();
    $sql = "SELECT LOCATION_ID,INSTITUTION_ID ,LOCATION_NAME FROM CMS_GEM_CORE_MANAGEMNT.LOCATIONS WHERE IS_RECORD_DELETED = 'F'"; //select data or insert data
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();

//        while ($row = oci_fetch_assoc($query)) {
//            //print_r($row);
//            echo $row['LOCATION_ID'];
//              echo  $row['INSTITUTION_ID'];
//               echo $row['LOCATION_NAME'];
//               echo "-----<br>";
//            foreach ($row as $item) { //echo $item;
//                }
//            }
//        
//          exit;



    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<li><a href="#" class="location" location-id="' . $row['LOCATION_ID'] . '">' . $row['LOCATION_NAME'] . '</a></li>';
//                $temp['loc_id']= $row['LOCATION_ID'];
//                $temp['inst_id']= $row['INSTITUTION_ID'];
//                $temp['loc_name']= $row['LOCATION_NAME'];
        //foreach ($row as $item) {
        //echo "<li>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</li>";
//                if ($item !== null)
//                    return $item;
        //}
        $result_arr[] = $temp;
    }


    return $result_arr;
}

/*
 * Name: get_manufacturers
 * Description: Get list of manufacturers
 * return: Array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_manufacturers() {
    $conn = database_connection();
    $sql = "SELECT MANUFACTURER_ID,MANUFACTURER_NAME FROM CMS_GEM_CORE_CONSTRUCT.MANUFACTURERS WHERE IS_RECORD_DELETED = 'F'"; //select data or insert data
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<li><a href="#" class="manufacturer" manufacturer-id="' . $row['MANUFACTURER_ID'] . '">' . $row['MANUFACTURER_NAME'] . '</a></li>';

//                $temp['man_id']= $row['MANUFACTURER_ID'];
//                $temp['man_name']= $row['MANUFACTURER_NAME'];
//            $result_arr[] = $temp;
    }
    return 1;
}

/*
 * Name: get_institutes
 * Description: Get list of institutes
 * return: Array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_institutes() {
    $conn = database_connection();
    $sql = "SELECT INSTITUTION_ID,INSTITUTE_CODE,NAME FROM CMS_GEM_CORE_MANAGEMNT.INSTITUTIONS WHERE IS_RECORD_DELETED = 'F'"; //select data or insert data
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();

    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {

        echo '<li><a href="#" class="institue" institute-id="' . $row['INSTITUTION_ID'] . '">' . $row['NAME'] . '</a></li>';
//                $temp['inst_id']= $row['INSTITUTION_ID'];
//                $temp['inst_code']= $row['INSTITUTE_CODE'];
//                $temp['inst_name']= $row['NAME'];
//               
        //$result_arr[] = $temp;
    }

    //return $result_arr;
}

/*
 * Name: get_kinds
 * Description: Get list of kind of parts which has relation to tracking condition 
 * return: Array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_kinds() {
    $conn = database_connection();
    global $TRACKING_CONDITION_ID;
    
    //$sql = "SELECT KIND_OF_PART_ID,DISPLAY_NAME FROM CMS_GEM_CORE_CONSTRUCT.KINDS_OF_PARTS WHERE IS_RECORD_DELETED = 'F'"; 
    $sql = "SELECT KIND_OF_PART_ID,DISPLAY_NAME FROM CMS_GEM_CORE_CONSTRUCT.KINDS_OF_PARTS WHERE IS_RECORD_DELETED = 'F' AND  KIND_OF_PART_ID IN ( SELECT KIND_OF_PART_ID FROM CMS_GEM_CORE_COND.COND_TO_PART_RLTNSHPS where KIND_OF_CONDITION_ID='".$TRACKING_CONDITION_ID."' )";
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<li><a href="#" class="kinds" kind-id="' . $row['KIND_OF_PART_ID'] . '">' . $row['DISPLAY_NAME'] . '</a></li>';

//                $temp['man_id']= $row['MANUFACTURER_ID'];
//                $temp['man_name']= $row['MANUFACTURER_NAME'];
//            $result_arr[] = $temp;
    }
    return 1;
}

/*
 * Name: get_available_parts (parts with no parent)
 * Description: Get list of parts ( Foil,Drift,Readout, chamber) not attached to chambers according to v (L or S) and kind
 * return: Array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_available_parts($part_id, $version) {
    // Database connection 
    $conn = database_connection();

    $sql = "SELECT SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $part_id . "' AND SERIAL_NUMBER LIKE '%" . $version . "%' AND IS_RECORD_DELETED = 'F' AND PART_ID not in (select PART_ID from CMS_GEM_CORE_CONSTRUCT.PHYSICAL_PARTS_TREE) ORDER BY SUBSTR(SERIAL_NUMBER, -4)  asc"; //select data or insert data 


    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<li><a href="#" class="availablepart" >' . $row['SERIAL_NUMBER'] . '</a></li>';

//                $temp['man_id']= $row['MANUFACTURER_ID'];
//                $temp['man_name']= $row['MANUFACTURER_NAME'];
//            $result_arr[] = $temp;
    }
    return 1;
}

/*
 * Name: get_available_parts_nohtml (Parts with no parent)
 * Description: Get list of parts ( Foil,Drift,Readout, chamber) not attached to chambers according to v (L or S) and kind
 * return: Array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_available_parts_nohtml($part_id, $version) {
    global $ROOT_PART_ID;
    // Database connection 
    $conn = database_connection();

    $sql = "SELECT SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $part_id . "' AND SERIAL_NUMBER LIKE '%" . $version . "%' AND PART_ID not in (select PART_ID from CMS_GEM_CORE_CONSTRUCT.PHYSICAL_PARTS_TREE WHERE PART_PARENT_ID != '".$ROOT_PART_ID."') ORDER BY SUBSTR(SERIAL_NUMBER, -4)  asc"; //select data or insert data 


    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
//        echo '<li><a href="#" class="availablepart" >' . $row['SERIAL_NUMBER'] . '</a></li>';

        $temp['SERIAL_NUMBER'] = $row['SERIAL_NUMBER'];
        $result_arr[] = $temp;
    }
    return $result_arr;
}

/*
 * Name: get_available_parts_nohtml_noversion (Parts with no parent )
 * Description: Get list of parts ( Opto , vfats) not attached to chambers according to v (L or S) and kind
 * return: Array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_available_parts_nohtml_noversion($part_id) {
    // Database connection 
    $conn = database_connection();

    $sql = "SELECT SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $part_id . "' AND IS_RECORD_DELETED = 'F' AND PART_ID not in (select PART_ID from CMS_GEM_CORE_CONSTRUCT.PHYSICAL_PARTS_TREE) ORDER BY SUBSTR(SERIAL_NUMBER, -4)  asc"; //select data or insert data 


    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
//        echo '<li><a href="#" class="availablepart" >' . $row['SERIAL_NUMBER'] . '</a></li>';

        $temp['SERIAL_NUMBER'] = $row['SERIAL_NUMBER'];
        $result_arr[] = $temp;
    }
    return $result_arr;
}

/*
 * Name: get_available_parts_nochild ( Parts with no childrens )
 * Description: Get list of parts ( Foil,Drift,Readout, chamber) not attached to chambers according to v (L or S) and kind
 * return: Array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_available_parts_nochild($part_id, $version, $relationID = "NA") {
    // Database connection 
    $conn = database_connection();
    global $GEB_KIND_OF_PART_ID;
    global $VFAT2_TO_GEB;
    global $OPTOHYBRID_TO_GEB;

    // as GEB has 25 childs not only 1 ( 24 VFAT & 1 OptoHybrid ) we need to FILTER  GEBs and create a specific Query for it
    if ($part_id == $GEB_KIND_OF_PART_ID) {
        // Filtering GEBs that has less than 24 VFATS childs
        if ($relationID != "NA" && $relationID == $VFAT2_TO_GEB) {
            $sql = "SELECT PART_ID , SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS P1
                WHERE  KIND_OF_PART_ID='" . $part_id . "' AND SERIAL_NUMBER LIKE '%" . $version . "%' AND IS_RECORD_DELETED = 'F'
                AND (select COUNT(PART_PARENT_ID) from CMS_GEM_CORE_CONSTRUCT.PHYSICAL_PARTS_TREE WHERE PART_PARENT_ID = P1.PART_ID AND RELATIONSHIP_ID ='".$relationID."' ) < 24
                ORDER BY SUBSTR(SERIAL_NUMBER, -4)  asc";
        }
        // Filtering GEBs that has less than 1 OptoHybrid Child
        if ($relationID != "NA" && $relationID == $OPTOHYBRID_TO_GEB) {
            $sql = "SELECT PART_ID , SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS P1
                WHERE  KIND_OF_PART_ID='" . $part_id . "' AND SERIAL_NUMBER LIKE '%" . $version . "%' AND IS_RECORD_DELETED = 'F'
                AND (select COUNT(PART_PARENT_ID) from CMS_GEM_CORE_CONSTRUCT.PHYSICAL_PARTS_TREE WHERE PART_PARENT_ID = P1.PART_ID AND RELATIONSHIP_ID ='".$relationID."' ) < 1
                ORDER BY SUBSTR(SERIAL_NUMBER, -4)  asc";
        }
    } 
    // Other part Like Readout ( has only one GEB child ) so check will be only on confirming that 
    // there is no current entry for this Readout in Tree table as a parent (i.e: can attatch child to it)
    else {   
        $sql = "SELECT SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $part_id . "' AND IS_RECORD_DELETED = 'F' AND SERIAL_NUMBER LIKE '%" . $version . "%' AND PART_ID not in (select PART_PARENT_ID from CMS_GEM_CORE_CONSTRUCT.PHYSICAL_PARTS_TREE) ORDER BY SUBSTR(SERIAL_NUMBER, -4)  asc"; //select data or insert data 
    }

    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<li><a href="#" class="availablepart" >' . $row['SERIAL_NUMBER'] . '</a></li>';

//                $temp['man_id']= $row['MANUFACTURER_ID'];
//                $temp['man_name']= $row['MANUFACTURER_NAME'];
//            $result_arr[] = $temp;
    }
    return 1;
}

/*
 * Name: get_attached_parts
 * Description: Get list of parts ( Foil,Drift,Readout, chamber)  attached to chamber/super chamber 
 * return: Array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function get_attached_parts($part_id) {

    global $VFAT2_TO_GEB;
    global $OPTOHYBRID_TO_GEB;
    global $GEB_TO_READOUT;
    global $READOUT_TO_CHAMBER;
    global $FRAME_TO_CHAMBER;
    global $DRIFT_TO_CHAMBER;
    global $FOIL_TO_CHAMBER;
    global $CHAMBER_KIND_OF_PART_NAME;
    global $DRIFT_KIND_OF_PART_NAME;
    global $FOIL_KIND_OF_PART_NAME;
    global $READOUT_KIND_OF_PART_NAME;
    global $FRAME_KIND_OF_PART_NAME;
    global $VFAT_KIND_OF_PART_NAME;
    global $OPTOHYBRID_KIND_OF_PART_NAME;
    global $GEB_KIND_OF_PART_NAME;
    global $CHAMBER_TO_SUPER_CHAMBER;

    // Database connection 
    $conn = database_connection();

    $sql = "select PART_ID, RELATIONSHIP_ID from CMS_GEM_CORE_CONSTRUCT.PHYSICAL_PARTS_TREE where PART_PARENT_ID='" . $part_id . "' AND IS_RECORD_DELETED = 'F'"; //select data or insert data 


    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();

    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {

        // foil -> chamber
        if ($row['RELATIONSHIP_ID'] === $FOIL_TO_CHAMBER) {
            $serialarr = getSerialById($row['PART_ID']);
            $serial = $serialarr[0]['SERIAL_NUMBER'];
            echo '<li class="list-group-item" style="white-space:nowrap"><label> GEM Foil:</label> <a href="show_gem.php?id=' . $serial . '">' . $serial . '</a> <a style="color: red; padding-left:4em " href="javascript:void(0);" class="detach" id="' . $serial . '" kind="' . $FOIL_KIND_OF_PART_NAME . '"><span aria-hidden="true" class="glyphicon glyphicon-resize-full"></span> Detach <span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a> </li>';
        }
        // Drift -> chamber
        else if ($row['RELATIONSHIP_ID'] === $DRIFT_TO_CHAMBER) {
            $serialarr = getSerialById($row['PART_ID']);
            $serial = $serialarr[0]['SERIAL_NUMBER'];
            echo '<li class="list-group-item" style="white-space:nowrap"><label> Drift:</label> <a href="show_drift.php?id=' . $serial . '">' . $serial . '</a> <a style="color: red; padding-left:4em " href="javascript:void(0);" class="detach" id="' . $serial . '" kind="' . $DRIFT_KIND_OF_PART_NAME . '"><span aria-hidden="true" class="glyphicon glyphicon-resize-full"></span> Detach <span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a> </li>';
        }
        // Frame -> chamber
        else if ($row['RELATIONSHIP_ID'] === $FRAME_TO_CHAMBER) {
            $serialarr = getSerialById($row['PART_ID']);
            $serial = $serialarr[0]['SERIAL_NUMBER'];
            echo '<li class="list-group-item" style="white-space:nowrap"><label> Frame:</label> <br> <a href="show_frame.php?id=' . $serial . '">' . $serial . '</a> <a style="color: red; padding-left:4em " href="javascript:void(0);" class="detach" id="' . $serial . '" kind="' . $FRAME_KIND_OF_PART_NAME . '"><span aria-hidden="true" class="glyphicon glyphicon-resize-full"></span> Detach <span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a> </li>';
       }
	 // Readout -> chamber
        else if ($row['RELATIONSHIP_ID'] === $READOUT_TO_CHAMBER) {
            $serialarr = getSerialById($row['PART_ID']);
            $serial = $serialarr[0]['SERIAL_NUMBER'];
            echo '<li class="list-group-item" style="white-space:nowrap"><label> Readout:</label> <br> <a href="show_readout.php?id=' . $serial . '">' . $serial . '</a> <a style="color: red; padding-left:4em " href="javascript:void(0);" class="detach" id="' . $serial . '" kind="' . $READOUT_KIND_OF_PART_NAME . '"><span aria-hidden="true" class="glyphicon glyphicon-resize-full"></span> Detach <span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a> </li>';
        }
        // geb -> readout
        else if ($row['RELATIONSHIP_ID'] === $GEB_TO_READOUT) {
            $serialarr = getSerialById($row['PART_ID']);
            $serial = $serialarr[0]['SERIAL_NUMBER'];
            echo '<li class="list-group-item" style="white-space:nowrap"><label> GEB:</label> <a href="show_geb.php?id=' . $serial . '">' . $serial . '</a> <a style="color: red; padding-left:4em " href="javascript:void(0);" class="detach" id="' . $serial . '" kind="' . $GEB_KIND_OF_PART_NAME . '"><span aria-hidden="true" class="glyphicon glyphicon-resize-full"></span> Detach <span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a> </li>';
        }
        // optohybrid -> geb
        else if ($row['RELATIONSHIP_ID'] === $OPTOHYBRID_TO_GEB) {
            $serialarr = getSerialById($row['PART_ID']);
            $serial = $serialarr[0]['SERIAL_NUMBER'];
            echo '<li class="list-group-item" style="white-space:nowrap"><label> Optohybrid:</label> <a href="show_opto.php?id=' . $serial . '">' . $serial . '</a> <a style="color: red; padding-left:4em " href="javascript:void(0);" class="detach" id="' . $serial . '" kind="' . $OPTOHYBRID_KIND_OF_PART_NAME . '"><span aria-hidden="true" class="glyphicon glyphicon-resize-full"></span> Detach <span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a> </li>';
        }
        // vfat -> geb
        else if ($row['RELATIONSHIP_ID'] === $VFAT2_TO_GEB) {
            $serialarr = getSerialById($row['PART_ID']);
            $serial = $serialarr[0]['SERIAL_NUMBER'];
            echo '<li class="list-group-item" style="white-space:nowrap"><label> VFAT:</label> <a href="show_vfat.php?id=' . $serial . '">' . $serial . '</a> <a style="color: red; padding-left:4em " href="javascript:void(0);" class="detach" id="' . $serial . '" kind="' . $VFAT_KIND_OF_PART_NAME . '"><span aria-hidden="true" class="glyphicon glyphicon-resize-full"></span> Detach <span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a> </li>';
        }
        // Chamber -> Super Chamber
        else if($row['RELATIONSHIP_ID'] === $CHAMBER_TO_SUPER_CHAMBER){
            $serialarr = getSerialById($row['PART_ID']);
            $serial = $serialarr[0]['SERIAL_NUMBER'];
            echo '<li class="list-group-item" style="white-space:nowrap"><label> Chamber:</label> <a href="show_chamber.php?id=' . $serial . '">' . $serial . '</a> <a style="color: red; padding-left:4em " href="javascript:void(0);" class="detach" id="' . $serial . '" kind="' . $CHAMBER_KIND_OF_PART_NAME . '"><span aria-hidden="true" class="glyphicon glyphicon-resize-full"></span> Detach <span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a> </li>';
        }
    }
    return 1;
}

/*
 * Name: getSerialById
 * Description: Get  part serial number by its ID
 * return: Array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function getSerialById($id) {

    // Database connection 
    $conn = database_connection();

    $sql = "SELECT SERIAL_NUMBER  FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE PART_ID='" . $id . "'"; //select data or insert data
    // Execute query  
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $result[] = $row;
    }
    return $result;
}

/*
 * Name: list_chambers
 * Description: list all chambers
 * usage: list chambers page
 * return: html
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function list_chambers() {

    // Database connection 
    $conn = database_connection($kindId);
    global $CHAMBER_KIND_OF_PART_ID;
    $sql = "SELECT SERIAL_NUMBER  FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $CHAMBER_KIND_OF_PART_ID . "' AND IS_RECORD_DELETED = 'F'"; //select data or insert data
    //$sql = "SELECT SERIAL_NUMBER  FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $kindId . "' AND IS_RECORD_DELETED = 'F'"; //select data or insert data
    // Execute query  
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<li><a class="foils" href="#"> ' . $row['SERIAL_NUMBER'] . '</a></li>';
    }
    return 1;
}

/*
 * Name: list_parts
 * Description: list all parts of certian kind of part
 * Parameter: $kindId : kind of part id
 * usage: add FOIL/etc conditions history
 * return: html
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */

function list_parts($kindId) {
// Database connection 
    $conn = database_connection();
    
   $sql = "SELECT SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $kindId . "' AND IS_RECORD_DELETED = 'F' " ;

    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();

    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {

            echo '<option>' . $row['SERIAL_NUMBER'] . '</option>';
  
       
    }
    return 1;
 
}

/*
 * Name: getKindIdByKindName
 * Description: get id of certian kind of part
 * Parameter: $kind : kind of part name
 * usage: gloabal file and tracking script
 * return: id
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */
//function getKindIdByKindName($kind){
//    // Database connection 
//    $conn = database_connection();
//    
//   $sql = "SELECT SERIAL_NUMBER FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE KIND_OF_PART_ID='" . $kindId . "' AND IS_RECORD_DELETED = 'F'" ;
//       $query = oci_parse($conn, $sql);
//    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
//    $arr = oci_execute($query);
//
//    $result_arr = array();
//
//    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
//
//            echo '<option>' . $row['SERIAL_NUMBER'] . '</option>';
//  
//       
//    }
//    return 1;
//}

/*
 * Name: getKindNameByKindId
 * Description: get name of certian kind of part
 * Parameter: $kindid : kind of part id
 * usage: gloabal file and tracking script
 * return: name
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */
function getKindNameByKindId($kindid){
    // Database connection 
    $conn = database_connection();
    
   $sql = "SELECT DISPLAY_NAME FROM CMS_GEM_CORE_CONSTRUCT.KINDS_OF_PARTS WHERE KIND_OF_PART_ID ='". $kindid."' AND IS_RECORD_DELETED = 'F'" ;
       $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();

    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {

            return $row['DISPLAY_NAME'];
  
       
    }
    return 1;
}

/*
 * Name: getSectors
 * Description: get sectors name from VFAT_CHANNEL_MAPPING
 * Parameter: NA
 * usage: list sectors in page of Search for pin number by channel info
 * return: html
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */
function getSectors(){
    // Database connection 
    $conn = database_connection();
    
   $sql = "SELECT SECTOR FROM CMS_GEM_MUON_COND.GEM_VFAT_CHANNELS GROUP BY SECTOR ORDER BY SECTOR ASC" ;
       $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result_arr = array();

    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {

            echo '<option>' . $row['SECTOR'] . '</option>';
  
       
    }
    return ;
}

/*
 * Name: searchPinNum
 * Description: get pin number from VFAT_CHANNEL_MAPPING
 * Parameter: array
 * usage:  Search for pin number by channel info
 * return: array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */
function searchPinNum($search){
    
    $queryString ="";
    $i = 0;
    $len = count($search);
    foreach ($search as $key => $value) {
        if ($i == $len - 1) {
            // last
            $queryString .= " " . $key . "= '" . $value . "'";
        } else {
            $queryString .= " " . $key . "= '" . $value . "' AND";
            $i++;
        }
    }

    // Database connection 
    $conn = database_connection();
    
   $sql = "SELECT CHANNEL_MAP_ID,SECTOR,CONN_PIN FROM CMS_GEM_MUON_COND.GEM_VFAT_CHANNELS WHERE". $queryString . "ORDER BY CONN_PIN ASC" ;
//   echo $sql;
       $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);

    $result = array();
    $itr = array();
//    CHANNEL_MAP_ID
//SUBDET
//SECTOR
//TYPE
//ZPOSN
//IETA
//IPHI
//DEPTH
//VFAT_POSN
//DET_STRIP
//VFAT_CHAN
//CONN_PIN
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
           $itr['CONN_PIN'] = $row['CONN_PIN'];
           $itr['SECTOR'] = $row['SECTOR'];
           $result [$row['CHANNEL_MAP_ID']] = $itr;
  
       
    }
    
    return $result;
}

/*
 * Name: get_tracking_info
 * Description: get tracking info by item Serial number
 * Parameter: array
 * usage:   list tracking info page 
 * return: array
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */
function get_tracking_info($serial) {

    global $TRACKING_CONDITION_ID;
    $result2 = array();
    // Database connection 
    $conn = database_connection();
    //Get part id by its serial number
    $sql = "SELECT PART_ID FROM CMS_GEM_CORE_CONSTRUCT.PARTS WHERE SERIAL_NUMBER='" . $serial . "'";

    $query = oci_parse($conn, $sql);
    $arr = oci_execute($query);
    $result = '';

    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $result = $row['PART_ID'];
    }
    // if found get its condition datasets where kind of condition == $TRACKING_CONDITION_ID
    if ($result != '') {
        $sql1 = "SELECT CONDITION_DATA_SET_ID, COND_RUN_ID FROM CMS_GEM_CORE_COND.COND_DATA_SETS WHERE PART_ID ='" . $result . "' AND KIND_OF_CONDITION_ID ='" . $TRACKING_CONDITION_ID . "' ";
        $query1 = oci_parse($conn, $sql1);
        $arr1 = oci_execute($query1);
        $result1 = array();
        $itr = array();
        while ($row1 = oci_fetch_array($query1, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $itr['CONDITION_DATA_SET_ID'] = $row1['CONDITION_DATA_SET_ID'];
            $itr['COND_RUN_ID'] = $row1['COND_RUN_ID'];
            $result1[] = $itr;
        }
        // if datasets found get tracking info
        if ( sizeof($result1) >= 1) {
            foreach ($result1 as $key => $value) {
                $run = $value['COND_RUN_ID'];
                $sql2 = "SELECT SHIPPED_FROM,DESTINATION,DATE_SHIPPED,MODE_SHIPPED,ADDN_SHIPPING_INFO,STATUS FROM CMS_GEM_MUON_COND.GEM_COMPONENT_TRACKING WHERE CONDITION_DATA_SET_ID = '" .$value['CONDITION_DATA_SET_ID']. "'";
                $query2 = oci_parse($conn, $sql2);
                $arr2 = oci_execute($query2);
                $itr1 = array();
                while ($row2 = oci_fetch_array($query2, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    $itr1['SHIPPED_FROM'] = $row2['SHIPPED_FROM'];
                    $itr1['DESTINATION'] = $row2['DESTINATION'];
                    $itr1['DATE_SHIPPED'] = $row2['DATE_SHIPPED'];
                    $itr1['MODE_SHIPPED'] = $row2['MODE_SHIPPED'];
                    $itr1['ADDN_SHIPPING_INFO'] = $row2['ADDN_SHIPPING_INFO'];
                    $itr1['STATUS'] = $row2['STATUS'];
                    $itr1['COND_RUN_ID'] = $run;
                    $result2[] = $itr1;
                }
            }
        } else {
            //no data sets found 
            return -1;
        }
    } else {
        //no part with this serial
        return 0;
    }



    return $result2;
}
