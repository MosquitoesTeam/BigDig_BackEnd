<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["username"]) && isset($_GET["key"])) {

    $username = $_GET['username'];

    $key = $_GET['key'];

   

    // get a product from products table
    $result = mysql_query("SELECT * FROM bigdig_users WHERE username  = '$username' and cle  = '$key'");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
                
            $result = mysql_fetch_array($result);
            $id=$result["id"];
            // success
            $response["success"] = 1;
            $response["message"] = "user exist";
            $feeds = mysql_query("SELECT bigdig_feeds.id,bigdig_feeds.url,bigdig_feeds.nom,bigdig_feeds.full,bigdig_feeds.color,bigdig_feeds.separator FROM bigdig_feeds,bigdig_feed_user where bigdig_feeds.id=bigdig_feed_user.id_feed and id_user='$id'");
            // check for empty result
            
            if (mysql_num_rows($feeds) > 0) {
            // looping through all results
            // products node
            $response["user"] = array();
            array_push($response["user"], $result);                
            $response["products"] = array();
            
            while ($row = mysql_fetch_array($feeds)) {
                // temp user array
                $product = array();
                $product["id"] = $row["id"];
                $product["url"] = $row["url"];
                $product["nom"] = $row["nom"];
                $product["full"] = $row["full"];
                $product["color"] = $row["color"];
                $product["separator"] = $row["separator"];

                // push single product into final response array
                array_push($response["products"], $product);
            }




                echo json_encode($response);   
            }

// echo "<pre>";
// print_r($product);
// echo "</pre>";

// echo "<pre>";
// print_r($result);
// echo "</pre>";
            
        } else {
            // no user found
            $response["success"] = 0;
            $response["message"] = "No user found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no user found
        $response["success"] = 0;
        $response["message"] = "No user found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>