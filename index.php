<?php
// API URL to fetch weather data
$api_url = "https://api.open-meteo.com/v1/forecast?latitude=22.5626&longitude=88.363&hourly=temperature_2m&timezone=auto";

// Use file_get_contents() to fetch the weather data from the API
$response = file_get_contents($api_url);

// Check if the request was successful
if ($response === FALSE) {
    die('Error occurred while fetching weather data.');
}

// Decode the JSON response to a PHP array
$data = json_decode($response, true);

// Check if data was received and if it contains the expected fields
if (isset($data['hourly']['temperature_2m']) && isset($data['timezone'])) {
    $temperature = $data['hourly']['temperature_2m'][0];  // First temperature value
    $timezone = $data['timezone'];  // Timezone

    // Determine the background image based on the temperature
    if ($temperature < 20) {
        $background_image = "cold.jpg";  // Set image for cold weather
    } elseif ($temperature >= 21 && $temperature <= 30) {
        $background_image = "mild.jpg";  // Set image for mild weather
    } else {
        $background_image = "hot.jpg";  // Set image for hot weather
    }
} else {
    echo "<p>Error: Unable to retrieve weather data.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="description" content="Login with PHP">
<meta name="keyword" content="HTML,CSS,JAVASCRIPT,PHP">
<meta name="author" content="Sudipta Kayal">
<meta name="viewport" content="wdith=device-width, initial-scale=1.0">
<title>Login || My Page</title>
    <!-- Bootstrap CSS -->
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<link rel="stylesheet" href="includes/style.css">
<script src="includes/scripts.js"></script>
<link rel="stylesheet" src="style.css">
<style>
        /* Apply background image based on PHP variable */
        body {
            background-image: url('images/<?php echo $background_image; ?>');
            background-repeat: no-repeat;
  /*background-attachment: fixed; 
  background-size: 100% 100%;*/
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            height: 100vh;
            margin: 0;
        }

        h1 {color: #000 !important;
            font-size: 2em;
            margin-top: 50px;
        }

        p {color: #000 !important;
            font-size: 1.2em;
        }

    </style>
</head>
<body>
<h1 >Weather</h1>

<p class="fw-bold fs-1"> <?php echo $temperature; ?>°C</p>
<p>Timezone: <?php echo $timezone; ?></p>
</body>
</html>