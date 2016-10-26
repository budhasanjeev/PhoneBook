<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 10/26/2016
 * Time: 11:13 PM
 */

session_start();
session_destroy();
header('Location: index.php');