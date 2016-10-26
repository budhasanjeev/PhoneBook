<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 10/26/2016
 * Time: 10:22 PM
 */


    include('databaseConnection.php');

    if(isset($_GET['del']))
    {
        $id = $_GET['del'];

        $delete = "DELETE FROM contactgroup WHERE id = $id";

        $conn->query($delete);

        $message=array("success"=>true);
        echo json_encode($message);

        header("Location:dashboard.php");
    }
