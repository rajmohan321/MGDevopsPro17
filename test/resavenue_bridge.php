<?php
include_once 'UnSafeCrypto.class.php';
error_reporting(0);
$arrtime = date('h:i:s', time());
$curdatetime = date('d-m-Y', time());
$dt = new DateTime(date('d-m-Y', time()));
$tz = new DateTimeZone('Asia/Kolkata');
$dt->setTimezone($tz);
$curdatetime=$dt->format('d-m-Y h:i');


$request = json_decode(file_get_contents('php://input'), true);
$added_On = $curdatetime;
$commonObj = $request['OTA_HotelResNotifRQ'];
$reservationObj = $request['OTA_HotelResNotifRQ']['HotelReservations']; //$reserv
$roomObj = $reservationObj[0]['HotelReservation']['RoomStays'];
// hotelid is taken from hotelcode under the roomstay 
$hotelid = $roomObj[0]['RoomStay']['BasicPropertyInfo']['HotelCode'];
$ResGuests = $reservationObj[0]['HotelReservation']['ResGuests'];
$noofrooms = $roomObj[0]['RoomStay']['RoomTypes']['RoomType']['NumberOfUnits'];

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
	}else{
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
	 //$decrypted = UnsafeCrypto::decrypt($encrypted, $key,true);
	 
	  $fgconn -> close();	



$single = 0;
$double = 0;
$triple = 0;
$quadruple = 0;
$pax=0;
foreach ($reservationObj as $reserv) {
foreach($reserv['HotelReservation']['RoomStays'] as $roomstay ){
	foreach( $roomstay['RoomStay']['GuestCounts']['GuestCount']as $guestcount){
	   $pax += (int)($guestcount['Count']);

			switch ($pax) {
				case "1":
					$single = 1;
					$double = 0;
					$tripple = 0;
					$quadruple = 0;
					$room_single = $roomObj[0]['RoomStay']['Total']['AmountBeforeTax'];
					$room_double =	0;
					$room_tripple = 0;
					$room_quadruple = 0;
					break;
				case "2":
					$single = 0;
					$double = 1;
					$tripple = 0;
					$quadruple = 0;
					$room_single = 0;
					$room_double = $roomObj[0]['RoomStay']['Total']['AmountBeforeTax'];
					$room_tripple = 0;
					$room_quadruple = 0;
					break;
				case "3":
					$single = 0;
					$double = 0;
					$tripple = 1;
					$quadruple = 0;
					$room_single =  0;
					$room_double =	0;
					$room_tripple = $roomObj[0]['HotelReservation']['RoomStays'][0]['RoomStay']['AmountBeforeTax'];
					$room_quadruple = 0;
					break;
				case "4":
					$single = 0;
					$double = 0;
					$tripple = 0;
					$quadruple = 1;
					$room_single =  0;
					$room_double =	0;
					$room_tripple = 0;
					$room_quadruple = $roomObj[0]['HotelReservation']['RoomStays'][0]['RoomStay']['AmountBeforeTax'];
					break;
				default:
					$room_single = $roomObj[0]['HotelReservation']['RoomStays'][0]['RoomStay']['AmountBeforeTax'];
					$single = $pax;
					$double = 0;
					$tripple = 0;
					$quadruple = 0;
			}
		}
}
	foreach ($reserv['HotelReservation']['ResGuests'] as $reservguest) {
		foreach ($reservguest['Profiles']['ProfileInfo'] as $profile_info) {
			$guesttype =  $profile_info['UniqueID']['Type'];
			$guestname = $profile_info['Profile']['Customer']['PersonName']['GivenName'] . ' ' . $profile_info['Profile']['Customer']['PersonName']['Surname']; // Guest Name
			$telephone=$profile_info['Profile']['Customer']['Telephone']['PhoneNumber'];
			$email =$profile_info['Profile']['Customer']['Email'];
			
		}
		
	}
	$ReservationObj[] = array(
		"encrypted" => $encrypted,
		"bookingid" => $commonObj['POS']['Source']['RequestorID']['ID'],
		"added_On" => $added_On,
		"reservationid" => $reserv['HotelReservation']['UniqueID']['ID'],	
		"arrivaldate"=>$roomstay['RoomStay']['TimeSpan']['Start'],
		"arrd" => date('d/m/Y', $old_date_timestamp), 
		"departuredate"=>$roomstay['RoomStay']['TimeSpan']['End'],
		"deptd" => date('d/m/Y', $dep_date_timestamp), 
		"hotelname" => $roomstay['RoomStay']['BasicPropertyInfo']['HotelName'],  // Hotel Name
		"pax" => count($roomstay['RoomStay']['GuestCounts']['GuestCount']),
		"title" => "Mr",
		"guestname"=>  $profile_info['Profile']['Customer']['PersonName']['GivenName'] . ' ' . $profile_info['Profile']['Customer']['PersonName']['Surname'],
		"guestphone" =>$profile_info['Profile']['Customer']['Telephone']['PhoneNumber'],
		"guestemail" => $profile_info['Profile']['Customer']['Email'],
		"roomtype_id"=>$roomstay['RoomStay']['RoomTypes']['RoomType']['RoomTypeCode'],
		"roomtype" => $roomstay['RoomStay']['RoomTypes']['RoomType']['RoomTypeName'],
		"noofrooms"=>$noofrooms,
		"roomstatus" => "1",
		"bookingmode" =>  $commonObj['POS']['Source']['BookingChannel']['Type'],
		"BookingStatus" => 'Confirm',
		"Bookingtype" => $commonObj['POS']['Source']['RequestorID']['Type'],
		"BookingAgent" => "RESERVATIONAVENUE",
		"guesttype" =>$profile_info['UniqueID']['Type'],
		"beforetaxAmount" => $reserv['HotelReservation']['ResGlobalInfo']['Total']['AmountBeforeTax'],
		"aftertaxamount" => $reserv['HotelReservation']['ResGlobalInfo']['Total']['AmountAfterTax'],
		"room_single" => $room_single,
		"room_double" => $room_double,
		"room_tripple" => $room_tripple,
		"room_quadruple" => $room_quadruple,
		"single" =>	$single,
		"double" =>	$double,
		"tripple" => $tripple,
		"quard"	=> $quadruple,
		"staycount" => $noofrooms,
		"CurrencyCode" => "INR",
		"guestaddress" => $profile_info['Profile']['Customer']['Address']['AddressLine'],
		"guest_cityname" => $profile_info['Profile']['Customer']['Address']['CityName'],
		"CountryCode"=>$profile_info['Profile']['Customer']['Address']['CountryName']['Code'],
        "CardHolderName"=>$profile_info['Profile']['Customer']['PaymentForm']['PaymentCard']['CardHolderName'],
        "CardType"=>$profile_info['Profile']['Customer']['PaymentForm']['PaymentCard']['CardType'],
		"CardNumber"=>$profile_info['Profile']['Customer']['PaymentForm']['PaymentCard']['CardNumber'],
        "CardCode"=>$profile_info['Profile']['Customer']['PaymentForm']['PaymentCard']['CardCode'],
        "ExpireDate"=>$profile_info['Profile']['Customer']['PaymentForm']['PaymentCard']['ExpireDate'],
		"INV_URL" => $INV_URL,
		"INV_LOCAL_url" => $INV_LOCAL_url,
		"PayatHotel"=>$reserv['HotelReservation']['PayAtHotel'],

	);
}
//exit(json_encode($ReservationObj));
$RtnVal = CallAPI("POST", $prefix, json_encode($ReservationObj));
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






























