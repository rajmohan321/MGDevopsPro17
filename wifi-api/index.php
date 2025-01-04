<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
</head>

<body>
    <h1>Sign Up</h1>
    <!-- <form id="signupForm" > onsubmit="submitForm(event)" -->
    <form method="POST" action="process.php">
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

<!-- <script>
    function submitForm(event) {
        event.preventDefault();  // Prevent form submission
        
        var formData = {
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            email: document.getElementById('email').value,
            age: document.getElementById('age').value,
            password: document.getElementById('password').value
        };

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process.php', true); // Send data via POST to process.php  
        xhr.setRequestHeader('Content-Type', 'application/json'); // Set content type to JSON

        // Handle response
        xhr.onload = function() {    
            if (xhr.status == 200) {
                // console.log('Response:', xhr.responseText);
               window.location.href = 'action.php'; // Redirect to another page after success
            } else {
                alert('Error: ' + xhr.status);
            }
        };


        xhr.send(JSON.stringify(formData));  
    }
</script> -->

</body>

</html>

