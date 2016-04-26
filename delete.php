<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 3/1/16
 * Time: 10:14 AM
 */
?>

<?php

    include('databaseConnection.php');

    if(isset($_GET['del']))
    {
        $id = $_GET['del'];
//        echo $id;

        $delete = "DELETE FROM contact WHERE contact_id = $id";

        $conn->query($delete);

        $message=array("success"=>true);
        echo json_encode($message);

//        header("Location:index.php");
    }

?>