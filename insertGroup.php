<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 3/14/16
 * Time: 11:02 AM
 */
?>

<?php
header("Content-Type: text/plain");
include('databaseConnection.php');

$group_id   = $_POST["group_id"];
$operation_mode   = $_POST["operationMode"];
$group_name    = $_POST["groupName"];
$group_member     = $_POST['member'];

$member = implode(",",$group_member);

$created_date = date("Y-m-d");

if($operation_mode == 0){
    $insert = "INSERT INTO contactgroup VALUES(null,'$group_name', '$member','$created_date',NULL ); ";

    echo $insert;

    if($conn ->query($insert)){

        echo "<br>"."Successfully Added"."<br>";

    }
    else{
        echo "<br>"."Unable to Insert Values"."<br>";
    }
}
if($operation_mode == 1){

    $update = "UPDATE contactgroup SET name = '$group_name' ,member = '$group_member' WHERE id = $group_id ";

    echo $update;
    if($conn -> query($update)){
        echo "<br>"."Successfully Updated"."<br>";
    }
    else{
        echo "<br>"."UnSuccessfull Update"."<br>";
    }
}


$conn->close();

header("Location:group.php");

?>