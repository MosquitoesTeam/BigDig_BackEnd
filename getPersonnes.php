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


            $feeds = mysql_query("SELECT * FROM bigdig_users ");
            // check for empty result
            
            if (mysql_num_rows($feeds) > 0) {
            // looping through all results
            // products node
                      
            $response["personnes"] = array();
            
            while ($row = mysql_fetch_array($feeds)) {
                // temp user array
                $product = array();
               
                $product["prenom"] = $row["prenom"];
                $product["nom"] = $row["nom"];
                
                // push single product into final response array
                array_push($response["personnes"], $product);
            }

                echo json_encode($response);   
            }




?>