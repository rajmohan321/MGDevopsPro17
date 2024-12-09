<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Form</title>
</head>
<body>
    <form method="POST" action="index.php?action=createBooking">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" id="user_id" required><br>
        <label for="agent_id">Agent ID:</label>
        <input type="text" name="agent_id" id="agent_id" required><br>
        <label for="service_id">Service ID:</label>
        <input type="text" name="service_id" id="service_id" required><br>
        <label for="booking_date">Booking Date:</label>
        <input type="datetime-local" name="booking_date" id="booking_date" required><br>
        <button type="submit">Create Booking</button>
    </form>
</body>
</html>
