
 <!DOCTYPE html>
   <html> 
   <head>
    <title>Finance Tracker - Financial Goals</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   </head>
   <body>
<header>
    <?php include '../includes/nav.php'?>
</header>
</body>
    </html>

    <?php
$apiUrl = 'https://www.alphavantage.co/query?function=OVERVIEW&symbol=MSFT&apikey=WA1B1DRO3ONY73XE';

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Check if API request was successful
if ($response) {
    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if data was retrieved successfully
    if (isset($data) && !isset($data['Note'])) {
        echo "Company Name: " . $data['Name'] . "<br>";
        echo "Symbol: " . $data['Symbol'] . "<br>";
        echo "Description: " . $data['Description'] . "<br>";
        echo "Exchange: " . $data['Exchange'] . "<br>";
        echo "Industry: " . $data['Industry'] . "<br>";
    } else {
        echo "API request failed or symbol not found.";
    }
} else {
    echo "API request failed.";
}
?>