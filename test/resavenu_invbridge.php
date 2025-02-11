<?php 

include_once './UnSafeCrypto.class.php';
error_reporting(0);
// $arrtime = date('h:i:s', time());
// $curdatetime = date('d-m-Y', time());
// $dt = new DateTime(date());
// $tz = new DateTimeZone('Asia/Kolkata');
// $dt->setTimezone($tz);
// $curdatetime=$dt->format('d-m-Y h:i');
$request = file_get_contents('php://input');
//$xml = simplexml_load_string($request);
 $xml = new SimpleXMLElement($request);






// Loop through each <Inventory> node under <Inventories>
foreach ($xml->Inventories->Inventory as $inventory) {
    
    // Print Hotel Name and Hotel Code from each Inventory
    $hotel_name=(string) $inventory->StatusApplicationControl->attributes()->HotelName;
    $hotel_id=(string) $inventory->StatusApplicationControl->attributes()->HotelCode;

    // Access and print the inventory counts (like Sun, Mon, Tue, etc.)

    foreach ($inventory->InvCounts->attributes() as $day => $status) {
        $InvStatus = (string)$status;
       $Invcounts[]=array(
        "INVdays"=>$day,
        "INvstatus"=>$InvStatus
       );
    }
   
    $date[]=array(
        //here date is mentioned '-' 
        "startDate"=>date($inventory->StatusApplicationControl->attributes()->Start),
        "endDate"=>date($inventory->StatusApplicationControl->attributes()->End),
        "roomtosell"=>(string)$inventory->InvCounts->StopSell,
        "invcounts"=>$Invcounts
         );
}

     $room[]=array(
      "invroom_id"=> (string)$inventory->StatusApplicationControl->attributes()->InvTypeCode,
      "date"=>$date    
    );
    $RoomINV[]=array(
    "hotel_id"=>$hotel_id,
    "hotel_name"=>$hotel_name,
    "room"=>$room,
    "closeon_arrival"=> (string)$inventory->InvCounts->CloseOnArrival,
    "closeon_departure"=>(string) $inventory->InvCounts->CloseOnDeparture,
    "cutoff"=>(string) $inventory->InvCounts->CutOff

);
$postdata = json_encode($RoomINV);	
// echo "<pre>";
// print_r($date);
// echo "</pre>";
// exit;
$url = $INV_URL;
	$headers = array(
		'Content-Type: application/json',
		'Authorization: Basic {b0V0QnRIWVo6NDkyZUdSbXg}'
	);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$resultss = curl_exec($ch);
	curl_close($ch);
	print_r($resultss);


function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
?>


