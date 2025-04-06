import numpy as np
from tensorflow.keras.preprocessing import image

def preprocess_image(img):
    img = img.resize((224, 224))  # Resize to model input size
    img_array = np.array(img) / 255.0  # Normalize
    img_array = np.expand_dims(img_array, axis=0)  # Expand dimensions for model
    return img_array
