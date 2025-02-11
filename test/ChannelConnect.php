<?php
error_reporting(0);
include_once './UnSafeCrypto.class.php';
$arrtime = date('h:i:s', time());
$curdatetime = date('d-m-Y', time());

$ChannelBooking = json_decode(file_get_contents('php://input'), true);
//exit(json_encode($ChannelBooking));
foreach ($ChannelBooking as $ChnlBooking) 
{
		//echo($ChnlBooking['bookingmode']);
		$encrypted =$ChnlBooking['encrypted'];
		$bookingdate = $ChnlBooking['bookingdate'];
		$bookingid =$ChnlBooking['bookingid'];
		$uniqid =$ChnlBooking['uniqid'];
		$channelResvID=$ChnlBooking['channelResvID'];
		$hotelid=$ChnlBooking['hotelid'];
		$hotelname =$ChnlBooking['hotelname'];
		$pax =$ChnlBooking['pax'];
		$tripple= $ChnlBooking['tripple'];
		$quard=$ChnlBooking['quard'];
		$arrivaldate=$ChnlBooking['arrivaldate'];
		$arrd=$ChnlBooking['arrd'];
		$departuredate=$ChnlBooking['departuredate'];
		$old_date_timesta =$ChnlBooking['old_date_timestamp'];
		$deptd=$ChnlBooking['deptd'];
		$title= $ChnlBooking['title'];
		$guestname=$ChnlBooking['guestname'];
		$guestphone = $ChnlBooking['guestphone'];
		$guestemail = $ChnlBooking['guestemail'];
		$roomtype=$ChnlBooking['roomtype'];
		$channel_room_id = $ChnlBooking['channel_room_id'];
		$numberofroom = $ChnlBooking['numberofroom'];
		$roomstatus=$ChnlBooking['roomstatus'];
		$bookingmode=$ChnlBooking['bookingmode'];
		$BookingStatus = $ChnlBooking['BookingStatus'];
		$resvid=$ChnlBooking['resvid'];
		$tariff=$ChnlBooking['tariff'];
		$discount=$ChnlBooking['discount'];
		$mealplan_Id=$ChnlBooking['mealplan_Id'];
		$mealplan=$ChnlBooking['mealplan'];
		$Bookingtype=$ChnlBooking['Bookingtype'];
		$BusinessSource = $ChnlBooking['BusinessSource'];
		$segment_code=$ChnlBooking['segment_code'];
		$purpose_visit = $ChnlBooking['purpose_visit'];
		$guesttype=$ChnlBooking['guesttype'];
		$national = $ChnlBooking['national'];
		$company=$ChnlBooking['company'];
		$guestcmpny=$ChnlBooking['guestcmpny'];
		$guestaddr=$ChnlBooking['guestaddr'];
		$guestgst=$ChnlBooking['guestgst'];
		$extrabed=$ChnlBooking['extrabed'];
		$extraperson = $ChnlBooking['extraperson'];
		$remarks=$ChnlBooking['remarks'];
		$voucherno=$ChnlBooking['voucherno'];
		$extraprice=$ChnlBooking['extraprice'];
		$payment =$ChnlBooking['payment'];
		$taxInclusive=$ChnlBooking['taxInclusive'];
		$taxAmount=$ChnlBooking['taxAmount'];
		$room_single=$ChnlBooking['room_single'];
		$room_double=$ChnlBooking['room_double'];
		$room_tripple=$ChnlBooking['room_tripple'];
		$room_quadruple= $ChnlBooking['room_quadruple'];
		$BookingAgent = $ChnlBooking['BookingAgent'];
		$staycount = $ChnlBooking['staycount'];
		$single =	$ChnlBooking['single'];
		$double =	$ChnlBooking['double'];
		$tripple =	$ChnlBooking['tripple'];
		$quard = $ChnlBooking['quard'];
		$exp = $ChnlBooking['exp'];
		$exc = $ChnlBooking['exc'];
		$room_extchild = $ChnlBooking['room_extchild'];
		$meal_double   = $ChnlBooking['meal_double'];
		$meal_single   = $ChnlBooking['meal_single'];
		$meal_tripple  = $ChnlBooking['meal_tripple'];
		$meal_quadruple= $ChnlBooking['meal_quadruple'];
		$meal_extperson= $ChnlBooking['meal_extperson'];
		$meal_extchild = $ChnlBooking['meal_extchild'];
		$booker_no = $ChnlBooking['booker_no'];
		$booker_cmpny = $ChnlBooking['booker_cmpny'];
		$booker_addr = $ChnlBooking['booker_addr'];
		$booker_taxid = $ChnlBooking['booker_taxid'];
		$cnclreason = $ChnlBooking['cancelreason'];				
		$curdatetime = date('d-m-Y', time());
		$key = 'MySoftMyConnect';
		$INV_URL = $ChnlBooking['INV_URL'];
		$INV_LOCAL_url = $ChnlBooking['INV_LOCAL_url'];
		$added_On =  $ChnlBooking['added_On'];
		$decrypted = UnsafeCrypto::decrypt($encrypted, $key,true);
		
		$connect1 = explode('|',$decrypted,-1);
		
		if ($INV_URL === null || strlen($INV_URL) == 0)
		{ $Inv_Update = 0;}
		else
		{$Inv_Update = 1;}
		
		if (trim($room_extchild) == "" 
		|| $room_extchild === null 
		|| strlen($room_extchild) == 0)
		{$room_extchild = "0";}

		$servername = $connect1[0];  
		$dbname = $connect1[1];    		
		$username = $connect1[2];   
		$password = $connect1[3];
		
		$fgconn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn,"utf8"); 
		//echo($ChnlBooking['bookingmode']);
	if($ChnlBooking['bookingmode'] == 'modified')
	{	
		$sql = "UPDATE room_booking Set resv_status = '9' where booking_id = '$uniqid'";
		//exit($sql);
		$query=mysqli_query($fgconn , $sql); 
		$slHn = "SELECT * FROM `room_booking` where booking_id = '$uniqid'";	
		$total_pagess = $fgconn->query($slHn) or die(mysqli_error($fgconn));    
		$rwn = $total_pagess->fetch_assoc();
		$resvNo = $rwn['resv_no'];

		$sqlss = "UPDATE `dash_rmstats` SET STATUS = '3' WHERE resv_no = '$resvNo'";
		$query=mysqli_query($fgconn, $sqlss);

		$sqlss = "INSERT INTO ROOM_BOOKING_EDIT SELECT * FROM  ROOM_BOOKING 
		WHERE resv_no =  '$resvNo'";
		$query=mysqli_query($fgconn, $sqlss);

		$sqlss = "INSERT INTO dash_rmstats_EDIT SELECT * FROM  dash_rmstats 
		WHERE resv_no = '$resvNo'";
		$query=mysqli_query($fgconn, $sqlss);

		$sqlss = "DELETE FROM  dash_rmstats WHERE resv_no = '$resvNo'";
		$query=mysqli_query($fgconn, $sqlss);

		$sqlss = "DELETE FROM  ROOM_BOOKING WHERE resv_no = '$resvNo'";
		$query=mysqli_query($fgconn, $sqlss);
		
		if(trim($resvNo) ==="")
		{$resvNo = GetResvNo($fgconn);}		
		
		//$sqlss = "INSERT INTO ROOM_BOOKING_EDIT SELECT * FROM ROOM_BOOKING 
		//WHERE RESV_NO = '$resvNo'";
		//$query=mysqli_query($fgconn, $sqlss);
		//
		//$sqlss = "INSERT INTO DASH_RMSTATS_EDIT SELECT * FROM DASH_RMSTATS 
		//WHERE RESV_NO = '$resvNo'";
		//$query=mysqli_query($fgconn, $sqlss);		
	}
	else if($ChnlBooking['bookingmode'] == 'cancelled') 
	{
		//$resvno = $_REQUEST['resvno'];		

		$sql = "UPDATE room_booking Set con_status='$sts',resv_status = '4' where booker_name = '$uniqid'";
		$query=mysqli_query($fgconn , $sql); 

		$slHn = "SELECT * FROM `room_booking` where booker_name = '$uniqid'";	
		$total_pagess = $fgconn->query($slHn) or die(mysqli_error($fgconn));    
		$rwn = $total_pagess->fetch_assoc();
		$resvnos = $rwn['resv_no'];	
		$sqlss = "UPDATE `dash_rmstats` SET STATUS = '3' WHERE resv_no = '$resvnos'";
		$query=mysqli_query($fgconn, $sqlss);
		continue;
	
	}
	else if($ChnlBooking['bookingmode'] == 'new')
	{		
		//echo($resvid);
		
		$slHn = "SELECT * FROM `room_booking` where booking_id = '$uniqid'";	
		$total_pagess = $fgconn->query($slHn) or die(mysqli_error($fgconn));    
		$rwn = $total_pagess->fetch_assoc();
		$rwHn = $total_pagess->fetch_assoc();
		//echo($slHn);
		if ($total_pagess -> num_rows > 0) 
		{
			$resvNo = $rwn['resv_no'];
		}
		else				
		{$resvNo = GetResvNo($fgconn);}			
	}
		//echo($resvNo);
		if(trim($resvNo) ==="")
		{continue;}
		
		$sqls = "SELECT * FROM `rate_table` WHERE structure_code = 'RACK' AND room_type = '$roomtype'";	
		$total_pages = $fgconn->query($sqls) or die(mysqli_error($fgconn));    
		$rws = $total_pages->fetch_assoc();
		$rate_code = $rws['structure_code'];
		$rate_desc = $rws['description'];


		$sqls = "SELECT * FROM `room_type` WHERE mapid = '$roomtype'";	
		$total_pages = $fgconn->query($sqls) or die(mysqli_error($fgconn));    
		$rwss = $total_pages->fetch_assoc();
		$roomtypecode =$rwss['room_code'];
		
		$sqls = "SELECT A.BOOKER_NAME,A.* FROM ROOM_BOOKING A WHERE BOOKER_NAME LIKE('%$uniqid%')";
		//exit($sqls);
		$total_pages = $fgconn->query($sqls) or die(mysqli_error($fgconn));    		
		if ($total_pages -> num_rows > 0) 
		{		continue;		}
		
		
		
		
		$sql = "INSERT INTO `room_booking` 
		(resv_no,arrival_date,arrival_time,departure_date,
		departure_time,room_type,noof_rms,doubl,
		guest_name,meal_plan,phone,email,
		company_name,con_status,top_code,business_src,
		segment_code,purpose_visit,pay_mode,spl_instruc,
		voucher_num,rate_code,rate_desc,room_single,
		room_double,room_extperson,resv_status,nationality,
		guest_type,title,rowcount,audit_date,
		booking_date,added_by,added_on,single,
		tripple,quad,exp,exc,
		room_tripple,room_quadruple,room_extchild,meal_single,
		meal_double,meal_tripple,meal_quadruple,meal_extperson,
		meal_extchild,booking_id,taxInclusive,booker_no,
		booker_name,address1,address2,guest_gstno)
		VALUES('$resvNo','$arrd','12:00','$deptd',
		'12:00','$roomtypecode',$numberofroom,'$double',
		'$guestname','$mealplan','$guestphone','$guestemail',
		'$company','$BookingStatus','$Bookingtype','$BusinessSource',
		'$segment_code','$purpose_visit','$payment','$remarks',
		'$bookingid','$rate_code','$rate_desc','$room_single',
		'$room_double','$extraperson','$roomstatus','$national',
		'$guesttype','$title','$staycount','$auitdate',
		'$bookingdate','$BookingAgent','$added_On','$single',
		'$tripple','$quard','$exp','$exc',
		'$room_tripple','$room_quadruple','$room_extchild','$meal_single',
		'$meal_double','$meal_tripple','$meal_quadruple','$meal_extperson',
		'$meal_extchild','$uniqid','$taxInclusive','$channelResvID',
		'$resvid','$booker_cmpny','$booker_no/$booker_addr','$booker_taxid')";
		//echo($sql);
		$query=mysqli_query($fgconn, $sql);


		$sqls = "SELECT COUNT(ROOM_TYPE) AS ROOM_COUNT FROM room_master 
		WHERE ROOM_TYPE = '$roomtypecode'";			
		$total_pages = $fgconn->query($sqls) or die(mysqli_error($fgconn));    
		$rwss = $total_pages->fetch_assoc();
		$TotRoomcount =$rwss['ROOM_COUNT'];
		

		$frDate=$arrd;
		$toDate=$deptd;

		$frxpl=explode('/',$frDate);
		$frDt=@$frxpl[2].'-'.@$frxpl[1].'-'.@$frxpl[0];
		$toDat=explode('/',$toDate);
		$toDD=@$toDat[2].'-'.@$toDat[1].'-'.@$toDat[0];

		$date_from = $frDt;   
		$date_from = strtotime($date_from); 
		$date_to = $toDD;  
		$date_to = strtotime($date_to);  
		for ($i=$date_from; $i<=$date_to; $i+=86400) {  
		$rr= date("d/m/Y", $i);
		$arT=explode('/',$rr);

		$sql = "INSERT INTO `dash_rmstats` 
		(room_no,reg_num,resv_no,room_count,
		arrival_date,arr_dt,arr_mt,arr_yr,
		departure_date,room_type,STATUS,added_by,
		added_on)VALUES(
		'Null','Null','$resvNo','$staycount',
		'$rr','$arT[0]','$arT[1]','$arT[2]',
		'$deptd','$roomtypecode','1','CRRS',
		'$bookingdate')";
		$query=mysqli_query($fgconn, $sql);

		if ($Inv_Update == 1)
		{
			$sqls = "SELECT SUM(ROOM_COUNT) as ROOM_COUNT1 FROM dash_rmstats 
			WHERE ROOM_TYPE = '$roomtypecode' AND ARRIVAL_DATE = '$rr'";	
			$total_pages = $fgconn->query($sqls) or die(mysqli_error($fgconn));    
			$rwss = $total_pages->fetch_assoc();
			$OccRoomcount =$rwss['ROOM_COUNT1'];
	
	
			$RoomObj[] = array(
			"hotelid" => $hotelid,
			"roomid" => $channel_room_id,
			"Date_value" => $rr,
			"roomstosell" => $TotRoomcount - $OccRoomcount,
			"INV_URL" => $INV_URL);
		}
		//$rr= date("d-m-Y", $i);				
		//$date[] = array(
		//			"value" => $rr,
		//			"roomstosell" =>$TotRoomcount - $OccRoomcount
		//			);
		}	
		
		//$room[] = array(
		//			"roomid" => $channel_room_id,
		//			"date" => $date);					
		//$hotelid = array(
		//			"hotelid" => "HLRP",
		//			"room" => $room);		
		//exit(json_encode($RoomObj));
		if ($Inv_Update == 1)
		{
			$RtnVal = CallAPI("POST",$INV_LOCAL_url,json_encode($RoomObj));	
		}
		//exit($RtnVal);
		
	}		
		
		
	
		

	$data = array(
	"reservation_notif" =>  array(
	"reservation_notif_id" => [$channelResvID]
	));
	$postdata = json_encode($data); 
	echo $postdata;	
	
function GetResvNo($fgconn_tmp)
{
	
    $slHn = "select prefix,currvalue from gennext_value where field='resvno'";	
		$total_pagess = $fgconn_tmp->query($slHn) or die(mysqli_error($fgconn_tmp));    
		$rwHn = $total_pagess->fetch_assoc();
	
		$prefix=$rwHn['prefix'];
		$currvalue=$rwHn['currvalue'];
		$rsvNo=$rwHn['currvalue'] + 1;

		$sql = "UPDATE gennext_value SET currvalue = '$rsvNo' where field='resvno'";
		$query=mysqli_query($fgconn, $sql);	

		$resvNo=$prefix.$rsvNo;

    return $resvNo;
}
	
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
	
function update_roominventory($fgconn_tmp,$date)
{
	
	
}
	
?>