<?php
require_once("isdk.php");
$app = new iSDK;
//Test Connection
if( $app->cfgCon("al477"))
{
	echo "You are connected to infusion soft";
	
	// $contactId = $_REQUEST['id'];  
	$contactId = $_REQUEST['contactId'];  
	// $contactId = 468; 

	//Fetch the contact data using the contact id
	$returnFields = array('Phone1','_BookingCentre'); 
	$conDat = $app->dsLoad("Contact", $contactId, $returnFields);
	
	//Create a message
	$message="See you at the Cambridge @ ".$conDat['_BookingCentre']." Open House on Saturday 9th March (10am to 12pm)!";
	
	//Format the message into a url format type
	$url= "https://mx.fortdigital.net/http/send-message?username=83672&password=3edc5tgb&to=%2B65".urlencode($conDat['Phone1'])."&from=Cambridge&message=".urlencode($message);
	// $url= "https://mx.fortdigital.net/http/send-message?username=83672&password=3edc5tgb&to=%2B639093140986&from=Cambridge&message=".urlencode($message); 
	// create a new cURL resource 
	$ch = curl_init();
	// set URL and other appropriate options
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	// grab URL and pass it to the browser 
	curl_exec($ch);
	// close cURL resource, and free up system resources
	curl_close($ch);
	
}else{
echo "Not Connected";
}

?>
