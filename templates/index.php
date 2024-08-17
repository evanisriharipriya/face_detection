<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('https://images.pexels.com/photos/531880/pexels-photo-531880.jpeg?cs=srgb&dl=pexels-pixabay-531880.jpg&fm=jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            width: 100vw;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            color: #fff;
            
        }

        h1 {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .input-container {
            border: 2px solid #ccc;
            background-image: url('https://images.pexels.com/photos/531880/pexels-photo-531880.jpeg?cs=srgb&dl=pexels-pixabay-531880.jpg&fm=jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            padding: 20px;
            width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            filter: brightness(120%) contrast(110%);
        }

        .input-container:hover {
            border-color: #009688;
        }

        .custom-input {
            font-size: 19px;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ccc;
            border-radius: 5px;
            outline: none;
            cursor: pointer;
            background-image: url('https://images.pexels.com/photos/531880/pexels-photo-531880.jpeg?cs=srgb&dl=pexels-pixabay-531880.jpg&fm=jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            filter: brightness(120%) contrast(110%);
            color: black;
            transition: background-color 0.3s;
        }

        .custom-input:hover,
        .custom-input:focus {
            background-color: rgb(50, 60, 50); /* Darker shade of the background color on hover/focus */
            border-color: #009688;
        }

        #result img {
            max-width: 600px;
            max-height: 300px;
            border: 2px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<h1><br>Face Detection</h1>
<div class="input-container">
    <input type="file" id="uploadInput" class="custom-input">
    <button onclick="detectFaces()" class="custom-input">Detect Faces</button>
</div>
<div id="result"></div>

<script>
    function detectFaces() {
        var fileInput = document.getElementById('uploadInput');
        var file = fileInput.files[0];
        var formData = new FormData();
        formData.append('image', file);

        fetch('/detect_faces', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(imageData => {
                var resultDiv = document.getElementById('result');
                resultDiv.innerHTML = '<img src="data:image/jpeg;base64,' + imageData + '" alt="Detected Faces">';
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
