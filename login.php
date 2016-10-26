<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 10/26/2016
 * Time: 10:52 PM
 */

include 'databaseConnection.php';

session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $select_query = "SELECT *FROM user WHERE email = '$email' AND password = '$password'";

    $result = $conn->query($select_query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $email;

        header("Location: dashboard.php");
    } else {
        header("Location: index.php");
    }
}