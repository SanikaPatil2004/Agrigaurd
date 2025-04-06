from flask import Flask, request, jsonify
import numpy as np
from tensorflow import keras
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing import image
import os
import io
from PIL import Image
from utils import preprocess_image

app = Flask(__name__)

# Load trained model
MODEL_PATH = "model/crop_disease_model.h5"
model = load_model(MODEL_PATH)

# Class labels for disease prediction
class_labels = {0: "Healthy", 1: "Leaf Spot", 2: "Rust", 3: "Mosaic Virus"}

@app.route('/predict', methods=['POST'])
def predict():
    if 'image' not in request.files:
        return jsonify({"error": "No image uploaded"}), 400

    file = request.files['image']
    img = Image.open(io.BytesIO(file.read()))
    img_array = preprocess_image(img)

    # Predict disease
    prediction = model.predict(img_array)
    predicted_class = np.argmax(prediction)
    disease_name = class_labels[predicted_class]

    # Preventive solutions
    solutions = {
        "Healthy": "No action needed. Maintain proper care.",
        "Leaf Spot": "Use fungicides and remove infected leaves.",
        "Rust": "Apply sulfur-based sprays and remove infected plants.",
        "Mosaic Virus": "Destroy infected plants and control pests."
    }

    return jsonify({"disease": disease_name, "solution": solutions[disease_name]})

if __name__ == '__main__':
    app.run(debug=True)
