<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 2/24/16
 * Time: 12:07 PM
 */

?>
<?php
    $serverName = "localhost";
    $username = "root";
    $password = "123";
    $databaseName = 'phone_book';

    // Create connection
    $conn = mysqli_connect($serverName, $username, $password,$databaseName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    /*echo "Connected successfully"."<br>";*/

?>

