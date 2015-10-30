<?php session_start();

/*
 * Following code will delete a product from table
 * A product is identified by product id (id)
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';
    require_once __DIR__ . '/functions.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched id
   $cle=random_string(8); 
    $result = mysql_query("UPDATE bigdig_users SET cle = '$cle' WHERE id = $id");
 
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
        // successfully updated
        $_SESSION["success"] = 1;
        $_SESSION["message"] = "Key successfully refreshed";

    } else {
        // no product found
        $_SESSION["success"] = 0;
        $_SESSION["message"] = "No user found";

    }
} else {
    // required field is missing
    $_SESSION["success"] = 0;
    $_SESSION["message"] = "Required field(s) is missing";

}

?>