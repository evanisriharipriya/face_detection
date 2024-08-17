from flask import Flask, request, render_template
import cv2
import numpy as np
import base64

app = Flask(__name__)

# Load the pre-trained face detection model
#face_cascade = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
face_cascade = cv2.CascadeClassifier('templates/haarcascade_frontalface_default.xml')

@app.route('/')
def index():
    return render_template('index.php')

@app.route('/detect_faces', methods=['POST'])
def detect_faces():
    # Get the image data from the request
    image_data = request.files['image'].read()

    # Convert the image data to a NumPy array
    nparr = np.frombuffer(image_data, np.uint8)

    # Decode the image
    img = cv2.imdecode(nparr, cv2.IMREAD_COLOR)

    # Convert the image to grayscale for face detection
    gray_img = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    if face_cascade.empty():
        print("Error: Cascade Classifier not loaded correctly!")

    # Detect faces in the grayscale image
    faces = face_cascade.detectMultiScale(gray_img, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

    # Draw rectangles around the detected faces
    for (x, y, w, h) in faces:
        cv2.rectangle(img, (x, y), (x+w, y+h), (0, 0, 255), 14)#bgr

    # Encode the image with detected faces to base64
    retval, buffer = cv2.imencode('.jpg', img)
    image_encoded = base64.b64encode(buffer).decode('utf-8')

    # Return the image with detected faces as base64
    return image_encoded

if __name__ == '__main__':
    app.run(debug=True)
