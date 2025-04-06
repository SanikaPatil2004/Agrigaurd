import os
import numpy as np
import tensorflow as tf
from tensorflow.keras.preprocessing import image
import matplotlib.pyplot as plt

# Define paths
BASE_DIR = "../plantvillage dataset"
CATEGORIES = ["Corn_(maize)__Cercospora_leaf_spot Gray_leaf_spot",
              "Corn_(maize)__Common_rust_",
              "Corn_(maize)__Northern_Leaf_Blight",
              "Corn_(maize)__healthy"]

MODEL_PATH = MODEL_PATH = "model/corn_disease_model.h5"  # Update with actual path
 

# Load the trained model
model = tf.keras.models.load_model(MODEL_PATH)

# Function to process images
def process_image(img_path):
    img = image.load_img(img_path, target_size=(224, 224))  # Resize to model input size
    img_array = image.img_to_array(img) / 255.0  # Normalize
    img_array = np.expand_dims(img_array, axis=0)  # Add batch dimension
    return img_array

# Function to predict disease
def predict_disease(img_path):
    img_array = process_image(img_path)
    prediction = model.predict(img_array)
    predicted_class = np.argmax(prediction, axis=1)[0]
    return CATEGORIES[predicted_class], prediction[0][predicted_class]

# Process all images in dataset
results = []
for category in CATEGORIES:
    category_path = os.path.join(BASE_DIR, category)
    if not os.path.exists(category_path):
        continue
    
    for img_name in os.listdir(category_path):
        img_path = os.path.join(category_path, img_name)
        if img_name.lower().endswith(('.png', '.jpg', '.jpeg')):
            disease, confidence = predict_disease(img_path)
            results.append((img_name, disease, confidence))
            print(f"{img_name} → {disease} ({confidence:.2f})")

# Optional: Save results to a file
with open("disease_predictions.txt", "w") as f:
    for img_name, disease, confidence in results:
        f.write(f"{img_name} → {disease} ({confidence:.2f})\n")

print("Processing completed. Results saved in disease_predictions.txt")
