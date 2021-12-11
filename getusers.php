<?php
ini_set('display_errors', 1);
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if($_SERVER["REQUEST_METHOD"] != "GET") {
	http_response_code(422);
	echo json_encode("Method Not Supported");
	exit();
}

require_once 'dbconnect.php';
$selectQuery = "SELECT * FROM products";
$result = $conn->query($selectQuery);

$products=array();
$products["data"]=array();

while($row = $result->fetch_assoc())
{
	$product=array(
        "name" => $row["name"],
        "description" => $row["description"],
        "image" => $row["img"],
        "category" => $row["category"],
        "price" => $row["price"],
    );

    array_push($products["data"], $product);
 }

// set response code - 200 OK
http_response_code(200);

// show products data in json format
echo json_encode($products["data"]);


$conn->close();
?>