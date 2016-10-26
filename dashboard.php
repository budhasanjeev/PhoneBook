<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 2/24/16
 * Time: 9:08 AM
 */

session_start();

if(!isset($_SESSION["email"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PhoneBook</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="media/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">

        <script src="bootstrap/js/jquery-1.12.0.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <script src="contact.js" type="text/javascript"></script>

        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <style>
            #container{
                width: auto;
                margin: auto;
            }
            .contact-div{
                width: 1200px;
                margin: auto;
            }

        </style>


    </head>

    <body>
        <div id="container">

            <div class="navbar navbar-default">
                <h2 style="text-align: center"><span class="glyphicon glyphicon-phone-alt">PHONE </span>&nbsp;&nbsp;&nbsp;BOOK<span class="glyphicon glyphicon-book"></span></h2>

                <div class="dropdown pull-right" style="margin-top: -49px;margin-right: 44px;">
                    <button class="btn btn-primary dropdown-toggle glyphicon glyphicon-cog" type="button" id="setting" data-toggle="dropdown"></button>

                    <ul class="dropdown-menu" role="menu" aria-labelledby="setting">
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="group.php">
                                Group
                            </a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="dashboard.php">
                                Contact
                            </a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="logout.php">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>

            </div>


            <div class="jumbotron contact-div">
                <div style="margin-bottom: 1%">
                    <li id="add-contact" type="button" class="btn btn-info" data-toggle="modal" data-target="#insert-contact"><span class="glyphicon glyphicon-pencil"></span>Create New Contact</li>
                </div>
                <div class="alert alert-success" role="alert" id="alertDeleted">
                    <p>Well done! Successfully Deleted</p>
                </div>


                <table class="table" class="display" cellspacing="0" width="100%" id="contact-table">
                    <thead style="background-color: rgb(147, 179, 221)">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile Number</th>
                            <th>Address</th>
                            <th>Service Provider</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                            include('databaseConnection.php');

                            $select = 'SELECT *from contact';

                            $result = $conn->query($select);

                            if(!$result){
                                die('Could not get Data'.mysql_errr());
                            }

                            while($row = mysqli_fetch_assoc($result)){

                                echo '
                                    <tr id="'.$row["id"].'">
                                        <td id="first_name">'.$row["first_name"].'</td>
                                        <td id="last_name">'.$row["last_name"].'</td>
                                        <td id="mobile_number">'.$row["mobile_number"].'</td>
                                        <td id="address">'.$row["address"].'</td>
                                        <td id="service_provider">'.$row["service_provider"].'</td>
                                        <td>
                                            <button id="edit-contact" type="button" class="glyphicon glyphicon-edit btn btn-primary " onclick="editContact('.$row["id"].')" ></button>
                                            <button type="button" class="glyphicon glyphicon-minus-sign btn btn-danger" onclick="deleteContact('.$row["id"].')" title="DELETE"></button>
                                        </td>
                                    </tr>
                                ';
                            }

                        ?>
                    </tbody>

                </table>

            </div>

        </div>


        <div id="insert-contact" class="modal fade" role="dialog" tabindex="-1">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>

                    <div class="modal-body">
                        <div class="alert alert-info" id="compulsory">
                            <p>All Fields are compulsory
                        </div>
                        <form method="post" action="contact.php" id="contact-form" class="form-horizontal" role="form">

                            <input type="hidden" name="operationMode" id="operationMode">
                            <input type="hidden" name="contact_id" id="contact_id">

                            <div class="form-group">
                                <label for="firstName" class="control-label col-sm-4">First Name <span style="color: red">*</span></label>

                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="firstName" id="firstName">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4" for="lastName">Last Name <span style="color: red">*</span></label>

                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="lastName" id="lastName">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-sm-4" for="mobileNumber">Mobile Number <span style="color: red">*</span></label>

                                <div class="col-sm-8">
                                    <input class="form-control" id="mobileNumber" type="text" name="mobileNumber">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-sm-4" for="address">Address <span style="color: red">*</span></label>

                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="address" id="addresses">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4">Service Provider <span style="color: red">*</span></label>

                                <div class="col-sm-8">

                                    <input type="radio" name="serviceProvider" value="NTC" id="NTC">NTC
                                    <input type="radio" name="serviceProvider" value="Ncell" id="Ncell">Ncell
                                </div>

                            </div>

                        </form>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-primary" type="submit" onclick="$('form').submit()"></button>
                        <button type="button" class="btn btn-danger " data-dismiss="modal">CANCEL</button>
                    </div>

                </div>
            </div>

        </div>


    <script>

        $('#add-contact').click(function(){
            $('#operationMode').attr("value",0);
            document.getElementById("contact-form").reset();
            $('#insert-contact .modal-title').html("Add New Contact");
            $('#insert-contact button[type=submit]').html("Add Contact");

        });

        $('#insert-contact').on('shown.bs.modal', function(){
            $('input[name=firstName]').focus();
        });

        $('#contact-table').DataTable({
            "lengthMenu": [ [6, 12, 24, -1], [6, 12, 24, "All"] ]
        });

    </script>
    </body>

</html>