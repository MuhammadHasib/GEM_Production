<?php
include_once 'globals.php';
/*
 * Name: generateDatasetXml
 * Description:  Generate XML file for loading datasets for FOILS.
 * Usage: in add FOIL data page
 * Author: Ola Aboamer [o.aboamer@cern.ch] 
 */

function generateDatasetXml($data, $filename = "dataset") {

        /* Error Reporting */
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $xml = new DOMDocument("1.0");
    
    $root = $xml->createElement("ROOT");
    $xml->appendChild($root);
    
    $runnum = "";
    
    $header = $xml->createElement("HEADER");
    foreach ($data['head'] as $key => $value) {
        if(is_array ( $value )){
            $element = $xml->createElement($key);
            $root->appendChild($element);
            foreach ($value as $key1 => $value1) {
                if( $key1 == "RUN_NUMBER" ){ $runnum = $value1; }
                $subElement = $xml->createElement($key1);
                $subElementText = $xml->createTextNode($value1);
                $subElement->appendChild($subElementText);
                $element->appendChild($subElement);
                $header->appendChild($element);
            }
        }
    }
    $root->appendChild($header);
    
    
    
    foreach ($data['foils'] as $key => $value) {
        $dataset = $xml->createElement("DATA_SET");
        if (is_array($value)) {
//            $element = $xml->createElement($key);
//            $root->appendChild($element);
            foreach ($value as $key1 => $value1) {
                if (is_array($value1)) {
                    $element1 = $xml->createElement($key1);
                    foreach ($value1 as $key2 => $value2) {
                        $subElement = $xml->createElement($key2);
                        $subElementText = $xml->createTextNode($value2);
                        $subElement->appendChild($subElementText);
                        $element1->appendChild($subElement);
                        
                    }
                    $dataset->appendChild($element1);
                } else {
                    $subElement = $xml->createElement($key1);
                    $subElementText = $xml->createTextNode($value1);
                    $subElement->appendChild($subElementText);
//                    $element->appendChild($subElement);
                    $dataset->appendChild($subElement);
                }
            }
        }
        $root->appendChild($dataset);
    }


    $xml->formatOutput = true;

    $num = str_replace("/", "-",$runnum);
    $LocalFilePATH = "gen_xml/".$filename.$num.".xml";
    //Generate the file and save it on directory
    $xml->save("gen_xml/".$filename.$num.".xml"); // or die("Error");
 
    // Send the file to the spool area
    $res_arr = SendXML($LocalFilePATH);

    return $res_arr;
}

/*
 * Name: generateDetachXml
 * Description:  Generate XML files for detaching child parts from its parent parts.
 * Usage: in show pages deatach chils listed in there
 * Author: Ola Aboamer [o.aboamer@cern.ch] 
 */

function generateDetachXml($partid, $kind) {

        /* Error Reporting */
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    global $ROOT_BARCODE;
    $xml = new DOMDocument("1.0");
    
    $root = $xml->createElement("ROOT");
    $xml->appendChild($root);
    
    $parts = $xml->createElement("PARTS");
    $root->appendChild($parts);

    $part = $xml->createElement("PART");
    $barcode = $xml->createElement("BARCODE");
    $barcodeText = $xml->createTextNode($ROOT_BARCODE);
    $barcode->appendChild($barcodeText);
    $part->appendChild($barcode);
    
    
    $child = $xml->createElement("CHILDREN");
    $part1 = $xml->createElement("PART");
    
    $serial = $xml->createElement("SERIAL_NUMBER");
    $serialText = $xml->createTextNode($partid);
    $serial->appendChild($serialText);
    $part1->appendChild($serial);
    
    $kindofpart = $xml->createElement("KIND_OF_PART");
    $kindofpartText = $xml->createTextNode($kind);
    $kindofpart->appendChild($kindofpartText);
    $part1->appendChild($kindofpart);
    
    $child->appendChild($part1);
    $part->appendChild($child);
    $parts->appendChild($part);

    $xml->formatOutput = true;

    $serialNum = str_replace("/", "-",$partid);
    $LocalFilePATH = "../gen_xml/" . $serialNum . "-detach.xml";
    //Generate the file and save it on directory
    $xml->save("../gen_xml/" . $serialNum . "-detach.xml"); // or die("Error");
    echo "test test";
    // Send the file to the spool area
    SendXML($LocalFilePATH);

    return 1;
}

/*
 * Name: generateXml
 * Description:  Generate XML files for parts, chambers and super chambers following the db-loader formate
 * Usage: in all add_new_parts/chamber/superchamber scripts
 * Author: Ola Aboamer [o.aboamer@cern.ch] 
 */

function generateXml($arr) {

    //print_r($arr);

    /* Error Reporting */
//    error_reporting(E_ALL);
//    ini_set('display_errors', 1);

    $xml = new DOMDocument("1.0");
    $root = $xml->createElement("ROOT");
    $xml->appendChild($root);
    $parts = $xml->createElement("PARTS");
    $root->appendChild($parts);

    $part = $xml->createElement("PART");
    $serialNum = "Default";
    $flag = 0;
    $filename_isset = 0;
    $filename = "";
    for ($i = 0; $i < sizeof($arr); $i++) {

        foreach ($arr[$i] as $key => $value) {
//            echo $key;
//            echo $value."<br>";
            if ($key == "SERIAL_NUMBER") {
                $serial = $xml->createElement($key);
                $serialText = $xml->createTextNode($value);
                $serialNum = $value;
                $serial->appendChild($serialText);
                $part->appendChild($serial);
            } else if ($key == "children") {
                $flag = 1;
                $child = $xml->createElement("CHILDREN");

                for ($j = 0; $j < sizeof($value); $j++) {
                    $part1 = $xml->createElement("PART");

                    foreach ($value[$j] as $key1 => $value1) {
                        if ($key1 == "attr") {
                            $preattr = $xml->createElement("PREDEFINED_ATTRIBUTES");
                            $attr = $xml->createElement("ATTRIBUTE");


                            foreach ($value1 as $key2 => $value2) {
                                $tag = $xml->createElement($key2);
                                $tagText = $xml->createTextNode($value2);
                                $tag->appendChild($tagText);
                                $attr->appendChild($tag);
                            }
                            $preattr->appendChild($attr);
                            $part1->appendChild($preattr);
                        } elseif ($key1 == "attr1") {
                            $preattr = $xml->createElement("PREDEFINED_ATTRIBUTES");
                            $attr = $xml->createElement("ATTRIBUTE");


                            foreach ($value1 as $key2 => $value2) {
                                $tag = $xml->createElement($key2);
                                $tagText = $xml->createTextNode($value2);
                                $tag->appendChild($tagText);
                                $attr->appendChild($tag);
                            }
                            $preattr->appendChild($attr);
                            $part1->appendChild($preattr);
                        }else {

                            $tag = $xml->createElement($key1);
                            $tagText = $xml->createTextNode($value1);
                            $tag->appendChild($tagText);
                            $part1->appendChild($tag);
                        }
                    }

                    $child->appendChild($part1);
                }
            }else if ($key == "filename") {
                $filename_isset = 1;
                $filename = $value;
                
            } else {
                $tag = $xml->createElement($key);
                $tagText = $xml->createTextNode($value);
                $tag->appendChild($tagText);
                $part->appendChild($tag);
            }
        }
    }

    if ($flag) {
        $part->appendChild($child);
    }
    $parts->appendChild($part);

    $xml->formatOutput = true;
    //echo "<xmp>". $xml->saveXML() ."</xmp>";
    //echo $xml_contents;
    
    // if file name is set to specific value 
    if($filename_isset) $serialNum = $filename;
    $serialNum = str_replace("/", "-", $serialNum);
    //echo exec('whoami');
    //chmod("gen_xml/", 0755);
    $LocalFilePATH = "gen_xml/" . $serialNum . ".xml";
    $LocalFileName = $serialNum . ".xml";
    //Generate the file and save it on directory
    $xml->save("gen_xml/" . $serialNum . ".xml"); // or die("Error");
    // Send the file to the spool area
    $res_arr = SendXML($LocalFilePATH);

    return $res_arr;
}

/*
 * Name: SendXML
 * Description:  start a SSH connection with gem-machine-a to send files from GUI to spool area there
 * Author: Ola Aboamer [o.aboamer@cern.ch] 
 */

function SendXML($LocalFilePATH) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

//CURL
    $username = $_SESSION['user'];
    $password = "kucr3PREruVUchAwEc";
    $target_url = "http://gem-machine-a.cern.ch/cmsdbldr/gem/int2r";
//    $target_url = "http://gem-machine-b.cern.ch/cmsdbldr/gem/int2r";
     

    $file_name_with_full_path = realpath($LocalFilePATH);
    $post = array('file' => '@' . $file_name_with_full_path);

    $ch = curl_init($target_url);
    curl_setopt($ch, CURLOPT_URL, $target_url);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $return = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    //Printing Status Code and execution return 
    $res_arr = array();
//    if($status_code == "200"){
//        echo '</br><span class="label label-success"> <b>Status code:</b>'.$status_code.'</span> ';
//        echo '<hr><div class="alert alert-success" role="alert"><b>Execution return:</b>'.$return.'</div>'; 
//    }
//    else if($status_code == "503"){
//        echo '</br><span class="label label-danger"> <b>Status code:</b>'.$status_code.'</span> ';
//        echo '<hr><div class="alert alert-danger" role="alert"><b>Execution return:</b>'.$return.'</div>';
//    }
//    else{
//        echo '</br><span class="label label-warning"> <b>Status code:</b>'.$status_code.'</span> ';
//        echo '<hr><div class="alert alert-warning" role="alert"><b>Execution return:</b>'.$return.'</div>';
//    }
    $res_arr['statuscode'] = $status_code;
    $res_arr['return'] = $return;
    
    curl_close($ch);
    return $res_arr;
    
}
