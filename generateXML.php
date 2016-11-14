<?php

function generate_GEM_Foil_XML() {
    $xml = new SimpleXMLElement('<xml/>');
    $track = $xml->addChild('ROOT');
    $parts = $track->addChild('PARTS');

    for ($i = 1; $i <= 8; ++$i) {

        $part = $parts->addChild('PART');
        $part->addChild('NAME_LABEL', "Track $i - Track Title");
    }

    Header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="gen_xml/mybooks.xml"');
   echo $xml->asXML();
    
    $xml = new DOMDocument("1.0");
    $root = $xml->createElement("data");
	$xml->appendChild($root);
	$id   = $xml->createElement("id");
	$idText = $xml->createTextNode('1');
	$id->appendChild($idText);
	$title   = $xml->createElement("title");
	$titleText = $xml->createTextNode('"PHP Undercover"');
	$title->appendChild($titleText);
        $book = $xml->createElement("book");
	$book->appendChild($id);
	$book->appendChild($title);
	$root->appendChild($book);
	$xml->formatOutput = true;
	echo "<xmp>". $xml->saveXML() ."</xmp>";
        echo $xml_contents;
	$xml->save("gen_xml/mybooks.xml"); // or die("Error");
	 
	 
    return 1;
}

function generate_PCB_Readout_XML() {
    $xml = new SimpleXMLElement('<xml/>');
    $track = $xml->addChild('ROOT');
    $parts = $track->addChild('PARTS');

    for ($i = 1; $i <= 8; ++$i) {

        $part = $parts->addChild('PART');
        $part->addChild('NAME_LABEL', "Track $i - Track Title");
    }

    Header('Content-type: text/xml');
    print($xml->asXML());
    return 1;
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case chamber:
            //echo $action;
            break;
        case gem:
            //echo $action;
            break;
        case geb:
            //echo $action;
            break;
        case pcb_ro:
            //echo $action;
            break;
        case pcb_dr:
            //echo $action;
            break;
        default:
        //echo $action;
    }
}
?>
 
