<?php

    //date venue website detail
    // get the q parameter from URL

    $q = $_POST["query"];




    $Url = "http://dblp.org/search/venue/api?q=$q&h=20&format=xml";
    $xml = file_get_contents($Url);


    $xml = new SimpleXMLElement($xml);
    $list = $xml->xpath('//result//hits');

    foreach( $list as $item){
        $venues = $item->xpath('//info//venue');
        $urls = $item->xpath('//info//url');
    }


    $obj = '';

    for ($i = 0; $i < 5; $i++) {


    $html = file_get_contents($urls[$i]);

    $dom = new \DOMDocument('1.0', 'UTF-8');
    // set error level
    $internalErrors = libxml_use_internal_errors(true);
    // load HTML
    $dom->loadHTML($html);
    // Restore error level
    libxml_use_internal_errors($internalErrors);

    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//a/@href');
    foreach($nodes as $href) {
        if(strpos($href->nodeValue,'.xml')){
            // echo $href->nodeValue;                       // echo current attribute value
            $url2 = $href->nodeValue;
            break;  
        }
    }




    $Xml = file_get_contents($url2);


    $Xml = new SimpleXMLElement($Xml);
    // date website detail;
    $info = $Xml->xpath('//dblp//proceedings');
    $date = $info[0]['mdate'];
    
    $website = $Xml->xpath('//dblp//proceedings//url');
    
    $website = $website[0];
    $detail = $Xml->xpath('//dblp//proceedings//title');
    
    // echo $venues[0];
    // echo "<br>";
    // echo "<br>";
    // echo $detail[0];
    // echo "<br>";
    // echo "<br>";
    // echo $date;
    // echo "<br>";
    // echo "<br>";
    // echo $website[0];
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";    

    $str ="{'date': '$date','detail': '$detail[0]','venue': '$venues[0]','website': '$website[0]'},";
    $obj = $obj.$str;
   

    } 
    $json = "{'list':[ $obj ]}";
    echo $json;

?>