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

    $created_date = date("Y-m-d");

    if($hiddenField == 0){
        $insert = "INSERT INTO contact VALUES(NULL ,'$first_name', '$last_name', '$mobile_number', '$address', '$service_provider','$created_date',NULL ) ";
        echo $insert;
        if($conn ->query($insert)){

            echo "<br>"."Successfully Added"."<br>";

        }
        else{
            echo "<br>"."Unable to Insert Values"."<br>";
        }
    }
    else{

        $update = "UPDATE contact SET first_name = '$first_name' ,last_name = '$last_name', mobile_number = '$mobile_number', address = '$address', service_provider = '$service_provider' WHERE id = $contact_id ";

        echo $update;
        if($conn -> query($update)){
            echo "<br>"."Successfully Updated"."<br>";
        }
        else{
            echo "<br>"."UnSuccessfull Update"."<br>";
        }
    }


    $conn->close();

    header("Location:dashboard.php");

?>
