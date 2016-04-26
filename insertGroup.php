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

if($operation_mode == 0){
    $insert = "INSERT INTO contactGroup VALUES(null,'$group_name', '$member'); ";

    echo $insert;

    if($conn ->query($insert)=== true){

        echo "<br>"."Successfully Added"."<br>";

    }
    else{
        echo "<br>"."Unable to Insert Values"."<br>";
    }
}
if($operation_mode == 1){

    $update = "UPDATE group SET group_name= '$group_name' ,group_member = '$group_member' WHERE group_id = $group_id ";

    echo $update;
    if($conn -> query($update) === true){
        echo "<br>"."Successfully Updated"."<br>";
    }
    else{
        echo "<br>"."UnSuccessfull Update"."<br>";
    }
}


$conn->close();

header("Location:group.php");

?>