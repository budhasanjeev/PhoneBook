<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 10/26/2016
 * Time: 10:08 PM
 */
session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>PhoneBook</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
</head>
<body>
<div class="login-body"></div>

<br/><br/>
<div class="container" style="text-align: center;">
    <div style="height: 200px;"></div>
    <!--    <img height="200px" width="50%" src="../img/banner.jpg" alt=""/>-->
    <h3>PhoneBook</h3>
</div>


<div style="display: flex; justify-content: center; align-items: center;">
    <div class="highlight login-div">

        <form class="form-horizontal"  method="post" action="login.php">
            <!--        <legend><h2>System Login</h2></legend>-->
            <div class="form-group">
                <label class="glyphicon glyphicon-envelope col-md-2 login-glyphicon"></label>
                <div class="col-md-10">
                    <input type="email" class="form-control" name="email" required="" placeholder="email"/>
                </div>
            </div>

            <div class="form-group">
                <label class="glyphicon glyphicon-pencil col-md-2 login-glyphicon" for=""></label>
                <div class="col-md-10">
                    <input type="password" class="form-control" name="password" required="" placeholder="password"/>
                </div>
            </div>

            <input class="btn btn-primary btn-block" name="login" type="submit" value="login"/>
        </form>
    </div>
</div>
</body>
</html>