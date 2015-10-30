<?php
header("Access-Control-Allow-Origin: *");
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/functions.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["username"]) && isset($_GET["password"])) {

    $username = $_GET['username'];
    $password = encrypt($_GET['password']);

    // get a product from products table
    $result = mysql_query("SELECT * FROM bigdig_users WHERE password  = '$password' and username  = '$username'");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
                
            $response["success"] = 1;
            $response["message"] = "user exist";

            }else {
            // no user found
            $response["success"] = 0;
            $response["message"] = "No user found";

            
        }
    } else {
        // no user found
        $response["success"] = 0;
        $response["message"] = "No user found";

    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
}
echo json_encode($response);
?>