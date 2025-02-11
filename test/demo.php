<?php


// Example JSON data (You would typically load this data from a file or an API)
// $request = json_decode(file_get_contents('php://input'), true);
// $guest = $request['GuestCounts']['GuestCount'];

// // Extracting values and storing them in individual variables
// // Hotel Information
// $hotelCode = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['BasicPropertyInfo']['HotelCode']; // Hotel Code
// $hotelName = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['BasicPropertyInfo']['HotelName']; // Hotel Name

// // Rate Information
// $ratePlanCode = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['RatePlans'][0]['RatePlan']['RatePlanCode']; // Rate Plan Code
// $ratePlanName = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['RatePlans'][0]['RatePlan']['RatePlanName']; // Rate Plan Name

// // Room Information
// $roomTypeName = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['RoomTypes'][0]['RoomType']['RoomTypeName']; // Room Type Name
// $roomTypeCode = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['RoomTypes'][0]['RoomType']['RoomTypeCode']; // Room Type Code
// $numberOfUnits = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['RoomTypes'][0]['RoomType']['NumberOfUnits']; // Number of Rooms

// // Amount Information
// $amountBeforeTax = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGlobalInfo']['Total']['AmountBeforeTax']; // Amount Before Tax
// $currencyCode = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGlobalInfo']['Total']['CurrencyCode']; // Currency Code
// $amountAfterTax = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGlobalInfo']['Total']['AmountAfterTax']; // Amount After Tax

// // Guest Counts Information
// $guestCount1 = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['GuestCounts']['GuestCount'][0]['Count']; // Guest Count 1
// $guestCount2 = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['GuestCounts']['GuestCount'][1]['Count']; // Guest Count 2

// // Guest Information
// $guestName = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGuests']['ResGuest']['Profiles']['ProfileInfo'][0]['Profile']['Customer']['PersonName']['GivenName'] . ' ' . $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGuests']['ResGuest']['Profiles']['ProfileInfo'][0]['Profile']['Customer']['PersonName']['Surname']; // Guest Name
// $guestEmail = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGuests']['ResGuest']['Profiles']['ProfileInfo'][0]['Profile']['Customer']['Email']; // Guest Email
// $guestPhone = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGuests']['ResGuest']['Profiles']['ProfileInfo'][0]['Profile']['Customer']['Telephone']['PhoneNumber']; // Guest Phone Number

// // Payment Information
// $cardHolderName = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGuests']['ResGuest']['Profiles']['ProfileInfo'][0]['Profile']['Customer']['PaymentForm']['PaymentCard']['CardHolderName']; // Card Holder Name
// $cardType = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGuests']['ResGuest']['Profiles']['ProfileInfo'][0]['Profile']['Customer']['PaymentForm']['PaymentCard']['CardType']; // Card Type
// $cardNumber = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGuests']['ResGuest']['Profiles']['ProfileInfo'][0]['Profile']['Customer']['PaymentForm']['PaymentCard']['CardNumber']; // Card Number
// $cardExpireDate = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['ResGuests']['ResGuest']['Profiles']['ProfileInfo'][0]['Profile']['Customer']['PaymentForm']['PaymentCard']['ExpireDate']; // Card Expiry Date

// // Reservation Dates
// $reservationStart = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['TimeSpan']['Start']; // Reservation Start Date
// $reservationEnd = $request['OTA_HotelResNotifRQ']['HotelReservations'][0]['HotelReservation']['RoomStays'][0]['RoomStay']['TimeSpan']['End']; // Reservation End Date

// // Print all extracted values
// echo "Hotel Code: $hotelCode\n";
// echo "Hotel Name: $hotelName\n";
// echo "Rate Plan Code: $ratePlanCode\n";
// echo "Rate Plan Name: $ratePlanName\n";
// echo "Room Type Name: $roomTypeName\n";
// echo "Room Type Code: $roomTypeCode\n";
// echo "Number of Units: $numberOfUnits\n";
// echo "Amount Before Tax: $amountBeforeTax\n";
// echo "Currency Code: $currencyCode\n";
// echo "Amount After Tax: $amountAfterTax\n";
// echo "Guest Count 1: $guestCount1\n";
// echo "Guest Count 2: $guestCount2\n";
// echo "Guest Name: $guestName\n";
// echo "Guest Email: $guestEmail\n";
// echo "Guest Phone: $guestPhone\n";
// echo "Card Holder Name: $cardHolderName\n";
// echo "Card Type: $cardType\n";
// echo "Card Number: $cardNumber\n";
// echo "Card Expiry Date: $cardExpireDate\n";
// echo "Reservation Start Date: $reservationStart\n";
// echo "Reservation End Date: $reservationEnd\n";

// Assuming the XML data is stored in $xmlString


// Convert the XML string to a SimpleXMLElement object
$request = file_get_contents('php://input');
//$xml = simplexml_load_string($request);
 $xml = new SimpleXMLElement($request);

// Accessing different parts of the object and printing them
echo "OTA Name: " . $xml->OTAName;

echo "Hotel Name: " . $xml->Inventories->Inventory->StatusApplicationControl->attributes()->HotelName;
echo "Hotel Code: " . $xml->Inventories->Inventory->StatusApplicationControl->attributes()->HotelCode . "<br>";

// Access Inventory Counts
echo "Inventory Counts:<br>";
foreach ($xml->Inventories->Inventory->InvCounts->attributes() as $day => $status) {
    echo "$day: $status<br>";
}

// Accessing other data like Start and End dates
echo "Inventory Start Date: " . $xml->Inventories->Inventory->StatusApplicationControl->attributes()->Start . "<br>";
echo "Inventory End Date: " . $xml->Inventories->Inventory->StatusApplicationControl->attributes()->End . "<br>";
echo "InvTypeCode: " . $xml->Inventories->Inventory->StatusApplicationControl->attributes()->InvTypeCode . "<br>";
echo "Stop Sell: " . $xml->Inventories->Inventory->InvCounts->StopSell . "<br>";
echo "Close On Arrival: " . $xml->Inventories->Inventory->InvCounts->CloseOnArrival . "<br>";
echo "Close On Departure: " . $xml->Inventories->Inventory->InvCounts->CloseOnDeparture . "<br>";
echo "Cut Off: " . $xml->Inventories->Inventory->InvCounts->CutOff . "<br>";



 
// echo "<pre>";

// var_dump($counting);
// echo $totalCount;
// echo "\n";
// echo "</pre>";


// Example JSON data (you would normally read this from a file or request)
// $request = json_decode(file_get_contents('reservation_data.json'), true);

// // Function to print values recursively
// function printValues($array) {
//     foreach ($array as $key => $value) {
//         // If the value is an array, call the function recursively to print nested arrays
//         if (is_array($value)) {
//             printValues($value);
//         } else {
//             // Print the value (ignoring the key)
//             echo $value . "<br>";
//         }
//     }
// }

// // Call the function to print all values from the decoded JSON
// printValues($request);
?>

