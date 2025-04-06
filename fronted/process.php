<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $imagePath = $_FILES["image"]["tmp_name"];

    $ch = curl_init();
    $cfile = new CURLFile($imagePath, $_FILES["image"]["type"], $_FILES["image"]["name"]);
    $data = array("image" => $cfile);

    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:5000/predict"); // Flask API URL
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    echo "<h3>Disease: " . $result["disease"] . "</h3>";
    echo "<p>Solution: " . $result["solution"] . "</p>";
}
?>
