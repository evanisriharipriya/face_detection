<?php
if(isset($_POST['submit'])){
    include "connection.php";
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
    $result = mysqli_query($conn,$sql);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($row)
        {
          if(password_verify($password, $row["password"])) {
            header("Location: http://127.0.0.1:5000/");
            exit(); // Add exit after header redirect to prevent further execution
        } 
        else {
            echo '<script>
                    alert("Invalid password!!");
                    window.location.href="login.php";
                  </script>';
        }
        }
        
    } 
    else {
        echo '<script>
                alert("Invalid username or email!!");
                window.location.href="login.php";
              </script>';
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body {
        background-image: url('https://img.freepik.com/free-vector/geometric-gradient-futuristic-background_23-2149116406.jpg');
        background-size: cover;
        background-position: center;
        color: #fff; /* Default text color */
      }
      #form {
        width: 350px;
        margin: 0 auto;
        margin-top: 100px; /* Adjust as needed */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
      }

      #form h1 {
        text-align: center;
      }
      #form h6 {
        text-align: center;
      }
      #form label {
        display: block;
        margin-bottom: 10px;
      }

      #form input[type="text"],
      #form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
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
        <h1>Login</h1>
        <h6>Not a user? <a href="signup.php">Signup</a></h6>
        <form name="form" action="login.php" method="POST">
            <label>Enter Username/Email</label>
            <input type="text" id="username" name="username" required><br><br>
            <label>Enter Password</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" id="btn" value="Login" name="submit"/>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>