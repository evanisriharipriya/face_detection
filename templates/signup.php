<?php
if(isset($_POST['submit'])){
    include "connection.php";
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $cpassword = mysqli_real_escape_string($conn,$_POST['cpassword']);
    
    $sql = "select * from users where username='$username'";
    $result = mysqli_query($conn,$sql);
    $count_user = mysqli_num_rows($result);

    $sql = "select * from users where email='$email'";
    $result = mysqli_query($conn,$sql);
    $count_email = mysqli_num_rows($result);

    if($count_user == 0 && $count_email == 0){
        if($password == $cpassword){
            $hash = password_hash($password,PASSWORD_DEFAULT); // Hash the password
            $sql = "insert into users(username,email,password) values('$username', '$email', '$hash')"; // Insert hashed password into database
            $result = mysqli_query($conn,$sql);
            // Redirect to the desired URL after successful signup
            echo '<script>
            window.location.href="http://127.0.0.1:5000/";
            </script>';
        }
        else {
            echo '<script>
            alert("Check the password");
            window.location.href = "signup.php";
            </script>';
        }
    }
    else {
        echo '<script>
        alert("Username or Email already exists. Please try again.");
        window.location.href = "signup.php";
        </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('logoutback.jpg');
            background-size: cover;
            background-position: center;
            color: #fff; /* Default text color */
        }
        
        #form {
            width: 400px;
            margin: 0 auto;
            margin-top: 50px; /* Adjust as needed */
            padding: 20px;
            border: 1px solid #fff; /* White border */
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        }

        #form h1 {
            text-align: center;
            margin-bottom: 20px; /* Spacing below heading */
        }

        #form label {
            display: block;
            margin-bottom: 10px;
        }

        #form input[type="text"],
        #form input[type="email"],
        #form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc; /* Light border */
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
            color: #000; /* Text color */
        }

        #form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        #form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    include "navbar.php";
    ?>
    <div id="form">
        <h1>Signup </h1>
        <form name="form" action="signup.php" method="POST">
            <label>Enter Username</label>
            <input type="text" id="username" name="username" required>
            <label>Enter Email-id</label>
            <input type="email" id="email" name="email" required>
            <label>Enter Password</label>
            <input type="password" id="password" name="password" required>
            <label>Confirm Password</label>
            <input type="password" id="cpassword" name="cpassword" required>
            <input type="submit" id="btn" value="Signup" name="submit"/>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
