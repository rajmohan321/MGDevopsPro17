<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
</head>

<body>
    <h1>Sign Up</h1>
    <form id="signupForm" onsubmit="submitForm(event)">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name"><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name"><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age"><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>

    <button type="submit" id="submit">Submit</button>
</form>

<script>
    function submitForm(event) {
        event.preventDefault();  // Prevent form submission
        
        // Collect form data and send via AJAX (same as above)
        var formData = {
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            email: document.getElementById('email').value,
            age: document.getElementById('age').value,
            password: document.getElementById('password').value
        };

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process.php', true); // Send data via POST to process.php  
        //  The file can be any kind of file, like .txt and .xml, or server scripting files like .asp and .php (which can perform actions on the server before sending the response back).
        xhr.setRequestHeader('Content-Type', 'application/json'); // Set content type to JSON

        // Handle response
        xhr.onload = function() {    //xhr.onload	Defines a function to be called when the request is received (loaded)
            if (xhr.status == 200) {
                console.log('Response:', xhr.responseText);
               window.location.href = 'action.php'; // Redirect to another page after success
            } else {
                alert('Error: ' + xhr.status);
            }
        };

        // Send data as JSON
        //console.log(typeof(formData));
        xhr.send(JSON.stringify(formData));   //send()	Sends the request to the server (used for GET)
                                             //send(string)	Sends the request to the server (used for POST)
    }
</script>

</body>

</html>

<?php // flow 

// open command actually send the data to the backend that is called process.php and here we are store the value to the session and status =200 is used in onload function to redirect to another webpage
?>