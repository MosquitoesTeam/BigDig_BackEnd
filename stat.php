<?php session_start();

/*
 * Following code will delete a product from table
 * A product is identified by product id (id)
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['id']) && isset($_POST['val'])) {
    $id = $_POST['id'];
    $val = $_POST['val'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched id

    $result = mysql_query("UPDATE bigdig_users SET etat = '$val' WHERE id = $id");
    $result = mysql_fetch_array($result);
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
        // successfully updated
        $_SESSION["success"] = 1;
        $_SESSION["message"] = "Stat successfully updated";

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