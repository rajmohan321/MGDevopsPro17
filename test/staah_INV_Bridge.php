<?php
include_once './UnSafeCrypto.class.php';
error_reporting(0);
$arrtime = date('h:i:s', time());
$curdatetime = date('d-m-Y', time());
$dt = new DateTime(date());
$tz = new DateTimeZone('Asia/Kolkata');
$dt->setTimezone($tz);
$curdatetime=$dt->format('d-m-Y h:i');


$RoomINVSet = json_decode(file_get_contents('php://input'), true);

//exit(json_encode($RoomINVSet));

foreach ($RoomINVSet as $RoomInv ) 
{	
	$hotelid =   $RoomInv['hotelid'];
	$cur_date =  $RoomInv['Date_value'];
	$channel_room_id =   $RoomInv['roomid'];
	$roomstosell = $RoomInv['roomstosell'];
	$INV_URL = $RoomInv['INV_URL'];
	
	$from_dte = explode('/', $cur_date);
	$from_dExp = $from_dte[2] . '-' . $from_dte[1] . '-' . $from_dte[0];
							
		$date[] = array(
					"value" => $from_dExp,
					"roomstosell" =>$roomstosell
					);
									
		}	
		
		$room[] = array(
					"roomid" => $channel_room_id,
					"date" => $date);					
		$hotelid = array(
					"hotelid" => $hotelid,
					"room" => $room);		
		//exit(json_encode($hotelid));
		$postdata = json_encode($hotelid);		

	//$url = "https://mysoftindia-sp.staah.net/SUAPI/jservice/availability";
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