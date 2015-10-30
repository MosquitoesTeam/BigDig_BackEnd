<?php session_start();

/*
 * Following code will delete a product from table
 * A product is identified by product id (id)
 */
require_once __DIR__ . '/functions.php';

// array for JSON response
$response = array();

// check for required fields
if (isset($_GET['id']) ) {
    $id = $_GET['id'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';


    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched id
    $result = mysql_query("DELETE FROM bigdig_users WHERE id = $id");
    
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {

        $result = mysql_query("DELETE FROM bigdig_feed_user WHERE id_user = $id");

        // successfully updated
        $_SESSION["success"] = 1;
        $_SESSION["message"] = "User successfully deleted";

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
print_r($_SESSION);
header("Location:users");
?>