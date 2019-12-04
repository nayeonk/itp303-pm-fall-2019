<?php

/********************
 *
 * json_encode():	PHP Array => JSON String
 *
 ********************/

$php_array = [
	"first_name" => "Michael",
	"last_name" => "Scott",
	"age" => 40,
	"phone" => [
		"cell" => "123-123-1234",

		"home" => "456-456-4567"
	],
];

echo $php_array["first_name"];
echo "<hr>";
echo $php_array["phone"]["cell"];
echo "<hr>";

// Convert the PHP associative array to JSON string
echo json_encode($php_array);
echo "<hr>";




/********************
 *
 * json_decode():	JSON String => PHP Array / PHP Object
 *
 ********************/

$json = 
'{
	"first_name": "Michael",
	"last_name": "Scott",
	"age": 40,
	"phone": {
		"cell": "123-123-1234",
		"home": "456-456-4567"
	}
}';
// Convert JSON string to associative array OR PHP objects
$decoded_array = json_decode($json, true);
var_dump($decoded_array);
echo "<hr>";
echo $decoded_array["first_name"];
echo "<hr>";
echo $decoded_array["phone"]["cell"];
echo "<hr>";

$decoded_object = json_decode($json, false);
var_dump($decoded_object);
echo "<hr>";
echo $decoded_object->first_name;
echo "<hr>";
echo $decoded_object->phone->cell;


/********************
 *
 * cURL & iTunes API
 *
 ********************/

// Define a constant for the API endpoint
define("ITUNES_API_ENDPOINT", "https://itunes.apple.com/search");

// Initialize curl
$curl = curl_init();

// Set some curl options
curl_setopt($curl, CURLOPT_URL, ITUNES_API_ENDPOINT . "?term=beatles&limit=5");
// Verifies the authenticity of the peer's SSL certificate
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// Returns the data instead of printing it to the page
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute curl, aka make a HTTP request
$response = curl_exec($curl);
echo "<hr>";
var_dump($response);

// Convert this string to php assoc array
echo "<hr>";
$response = json_decode($response, true);
var_dump($response);
echo "<hr>";
echo $response["resultCount"];
echo "<hr>";
echo $response["results"][0]["collectionName"];


// close curl
curl_close($curl);





?>










