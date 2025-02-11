<?php
include_once './UnSafeCrypto.class.php';
error_reporting(0);
$arrtime = date('h:i:s', time());
$curdatetime = date('d-m-Y', time());
$dt = new DateTime(date());
$tz = new DateTimeZone('Asia/Kolkata');
$dt->setTimezone($tz);
$curdatetime=$dt->format('d-m-Y h:i');


$datas = json_decode(file_get_contents('php://input'), true);
//exit(json_encode($datas));
$added_On = $curdatetime;
$bookingdate =  $datas['reservations'][0]['booked_at'];
$bookingid =  $datas['reservations'][0]['vendor_booking_id'];
$uniqid =  $datas['reservations'][0]['channel_booking_id'];
$noficid =  $datas['reservations'][0]['reservation_notif_id'];
$hotelid = $datas['reservations'][0]['hotel_id'];
//exit($hotelid);		
//exit(json_encode($datas));

	//$postdata = json_encode($datas); 
	
	$servername = "localhost";  
	$username = "root";   
	$password = "";
	$dbname = "channelmanager";    
	$fgconn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,"utf8"); 
	
	$slHn = "SELECT CHANNEL_CODE,HOTELID,URL,SERVERNAME,DATABASE_NAME,
	         USERNAME,PASSWRD,INV_URL,INV_LOCAL_url FROM cm_master WHERE channel_code = '$hotelid'";	
	$total_pagess = $fgconn->query($slHn) or die(mysqli_error($fgconn)); 		
	$rwHn = $total_pagess->fetch_assoc();
	//echo($slHn);
	if ($total_pagess -> num_rows > 0) 
	{
		//echo "Returned rows are: " . $total_pagess -> num_rows;
	}
	else{
		$data = array(
		"reservation_notif" =>  array(
		"reservation_notif_id" => 
		["The requested hotel_id :".$hotelid." is not configured"]
		));
		$postdata = json_encode($data); 
		exit($postdata);		
		}	
	$prefix=$rwHn['URL'];
	$servername = $rwHn['SERVERNAME'];
	$database1 = $rwHn['DATABASE_NAME'];
	$username1 = $rwHn['USERNAME'];
	$PASSWRD1 = $rwHn['PASSWRD'];
	$INV_URL = $rwHn['INV_URL'];
	$INV_LOCAL_url = $rwHn['INV_LOCAL_url'];
	
 
   $message = $servername.'|'.$database1.'|'.$username1.'|'.$PASSWRD1.'|';
  //exit($message);
   $key = 'MySoftMyConnect';
   $encrypted = UnsafeCrypto::encrypt($message, $key,true);     
   $decrypted = UnsafeCrypto::decrypt($encrypted, $key,true);
   
	$fgconn -> close();	
	$noofrooms = count($datas['reservations'][0]['rooms']);
	$roomsObj = $datas['reservations'][0]['rooms'];
	$ReservationObj = $datas['reservations'];

$single = 0;$doubl = 0;$tripple = 0;$quard = 0;
foreach ($ReservationObj as $Reserv) 
	{
	foreach ($roomsObj as $ResRoom) 
			{
		$pax = $ResRoom['numberofadults'];
		
		switch ($pax)
		{
        case "1":
            $single = 1;
			$double = 0;
			$tripple = 0;
			$quard = 0;
			$room_single =  $ResRoom['totalprice']; 
			$room_double =	0;		
			$room_tripple =0;
			$room_quadruple =0;
            break;
        case "2":
			$single = 0;
			$double = 1;
			$tripple = 0;
			$quard = 0;
			$room_single = 0; 			
			$room_double = $ResRoom['totalprice'];				
			$room_tripple =0;
			$room_quadruple =0;
            break;
        case "3":
			$single = 0;
			$double = 0;
			$tripple = 1;
			$quard = 0;
			$room_single =  0; 
			$room_double =	0;	
			$room_tripple =  $ResRoom['totalprice'];
			$room_quadruple =0;
            break;
        case "4":
			$single = 0;
			$double = 0;
			$tripple = 0;
			$quard = 1;
			$room_single =  0; 
			$room_double =	0;	
			$room_tripple = 0;			
			$room_quadruple =  $ResRoom['totalprice'];
            break;
        default:
			$room_single =  $ResRoom['totalprice']; 	
            $single = $pax;			
			$double = 0;
			$tripple = 0;
			$quard = 0;
		}
		$arr =  $ResRoom['arrival_date'];
		$dep =  $ResRoom['departure_date'];
		$old_date_timestamp = strtotime($arr);	
		$dep_date_timestamp = strtotime($dep);	
		$BookingObj[] = array(
		"encrypted" => $encrypted,
		"bookingdate" =>  $Reserv['booked_at'],
		"added_On" => $added_On,
		"bookingid" =>  $Reserv['vendor_booking_id'],
		"booker_no" => $Reserv['id'],
		"uniqid" =>  $Reserv['channel_booking_id'],
		"channelResvID" =>  $Reserv['reservation_notif_id'],
		"hotelid" => $Reserv['hotel_id'],
		"hotelname" => $Reserv['hotel_name'],
		"pax" => $ResRoom['numberofadults'],
		"tripple" =>  $tripple,
		"quard" =>  $quard, 		
		"arrivaldate" =>  $ResRoom['arrival_date'],				
		"arrd" => date('d/m/Y', $old_date_timestamp), 
		"departuredate" =>  $ResRoom['departure_date'],
		"old_date_timestamp" => strtotime($deptd),
		"deptd" => date('d/m/Y', $dep_date_timestamp), 
		"title" => "Mr",
		"guestname" => $ResRoom['guest_name'],
		"guestphone" => $Reserv['customer']['telephone'],
		"guestemail" => $Reserv['customer']['email'], 
		"roomtype" => $ResRoom['id'],
		"channel_room_id" => $ResRoom['channel_room_id'],
		"numberofroom" => 1,
		"roomstatus" => "1",
		"cancelreason" => $Reserv['cancelreason'],
		"bookingmode" => $ResRoom['roomstaystatus'],
		"BookingStatus" => 'Confirm',
		"resvid" => $ResRoom['roomreservation_id'],
		"tariff" => $ResRoom['totalprice'],
		"discount" => $ResRoom['discount'],
		"mealplan_Id" =>  $ResRoom['price'][0]['mealplan_id'],
		"mealplan" =>  $ResRoom['price'][0]['rate_id'],
		"Bookingtype" => "OTA", 
		"BookingAgent" => "STAAH",
		"BusinessSource" => "B003",
		"segment_code" => 'ota', 
		"purpose_visit" => 'leisure',
		"guesttype" => 'normal', 
		"national" => "INDIAN",
		"company" => $Reserv['affiliation']['source'],  
		"guestcmpny" => $Reserv['affiliation']['companyname'],
		"guestaddr" => $Reserv['affiliation']['companyaddress'],
		"Channelgstno" => $Reserv['affiliation']['gstno'],
		"extrabed" => 0,
		"extraperson" => 0.00,
		"remarks" => ' ', //$Reserv['customer']['remarks'],
		"voucherno" => '',
		"extraprice" => '', 
		"payment"=>'OTA',
		"taxInclusive" => "inclyes",
		"taxAmount" => $ResRoom['totaltax'],
		"room_single" => $room_single,
		"room_double" => $room_double,
		"room_tripple" => $room_tripple,
		"room_quadruple" => $room_quadruple,
		"single" =>	$single,
		"double" =>	$double,
		"tripple"=>	$tripple,
		"quard"	 => $quard,
		"staycount" =>$noofrooms,
		"exp" => 0,
		"exc" => 0,
		"meal_extchild" => 0,
		"meal_double"   => 0,
		"meal_single"   => 0,
		"meal_tripple"  => 0,
		"meal_quadruple"=> 0,
		"meal_extperson"=> 0,
		"meal_extchild" => 0,		
		"room_extchild" => $ResRoom['max_children'],
		"booker_cmpny" => $Reserv['customer']['corporate_booking_detail']['billing_company'],
		"booker_addr" =>  $Reserv['customer']['corporate_booking_detail']['billing_address'],				
		"booker_taxid" => $Reserv['customer']['corporate_booking_detail']['booker_taxid'],
		"INV_URL" => $INV_URL,
		"INV_LOCAL_url" => $INV_LOCAL_url
		);
		
		}
	}
	//exit(json_encode($BookingObj));
	$RtnVal = CallAPI("POST",$prefix,json_encode($BookingObj));	
	echo($RtnVal);

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