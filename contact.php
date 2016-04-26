<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 2/24/16
 * Time: 2:42 PM
 */

?>

<?php

    include('databaseConnection.php');

    $contact_id   = $_POST["contact_id"];
    $hiddenField   = $_POST["operationMode"];
    $first_name    = $_POST["firstName"];
    $last_name     = $_POST["lastName"];
    $mobile_number = $_POST["mobileNumber"];
    $address       = $_POST["address"];
    $service_provider = $_POST["serviceProvider"];

    if($hiddenField == 0){
        $insert = "INSERT INTO contact VALUES(null,'$first_name', '$last_name', '$mobile_number', '$address', '$service_provider') ";

        if($conn ->query($insert)=== true){

            echo "<br>"."Successfully Added"."<br>";

        }
        else{
            echo "<br>"."Unable to Insert Values"."<br>";
        }
    }
    else{

        $update = "UPDATE contact SET first_name = '$first_name' ,last_name = '$last_name', mobile_number = '$mobile_number', address = '$address', service_provider = '$service_provider' WHERE contact_id = $contact_id ";

        echo $update;
        if($conn -> query($update) === true){
            echo "<br>"."Successfully Updated"."<br>";
        }
        else{
            echo "<br>"."UnSuccessfull Update"."<br>";
        }
    }


    $conn->close();

    header("Location:index.php");

?>
