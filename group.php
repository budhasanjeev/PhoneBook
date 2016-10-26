<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 3/14/16
 * Time: 10:33 AM
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
    <link href="select2.min.css" type="text/css" rel="stylesheet">

    <script src="bootstrap/js/jquery-1.12.0.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="contact.js" type="text/javascript"></script>

    <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="select2.min.js" type="text/javascript"></script>
    <script src="group.js" type="text/javascript"></script>

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
            <li id="add-group" type="button" class="btn btn-info" data-toggle="modal" data-target="#insert-group"><span class=" glyphicon glyphicon-pencil"></span> Create New Group</li>
        </div>

        <div class="alert alert-success" role="alert" id="alertDeleted">
            <p>Well done! Successfully Deleted</p>
        </div>


        <table class="table" class="display" cellspacing="0" width="100%" id="group-table">
            <thead style="background-color: rgb(147, 179, 221)">
            <tr>
                <th>Group Name</th>
                <th>Member</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php

            include('databaseConnection.php');

            $select = 'SELECT *from contactGroup';


            $result = $conn->query($select);

            if(!$result){
                die('Could not get Data'.mysql_errr());
            }

            while($row = mysqli_fetch_assoc($result)){

                echo '
                        <tr id="'.$row["id"].'">
                            <td id="group_name">'.$row["name"].'</td>
                            <td id="group_member">'.$row["member"].'</td>
                            <td>
                                <button id="edit-contact" type="button" class="glyphicon glyphicon-edit btn btn-primary " onclick="editGroup('.$row["id"].')" ></button>
                                <button type="button" class="glyphicon glyphicon-minus-sign btn btn-danger" onclick="deleteGroup('.$row["id"].')" title="DELETE"></button>
                            </td>
                        </tr>
                    ';
            }

            ?>
            </tbody>

        </table>

    </div>

</div>


<div id="insert-group" class="modal fade" role="dialog" tabindex="-1">

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
                <form method="post" action="insertGroup.php" id="group-form" class="form-horizontal" role="form">

                    <input type="hidden" name="operationMode" id="operationMode">
                    <input type="hidden" name="group_id" id="group_id">

                    <div class="form-group">
                        <label for="group-name" class="control-label col-sm-4">Group Name <span style="color: red">*</span></label>

                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="groupName" id="group-name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="member">Members <span style="color: red">*</span></label>

                        <div class="col-sm-8">


                            <select class="js-example-basic-multiple form-control" multiple="multiple" name="member[]" id="member" style="width: 100%">
                                <?php

                                include('databaseConnection.php');

                                $select = 'SELECT *from contact';

                                $result = $conn->query($select);

                                if(!$result){
                                    die('Could not get Data'.mysql_errr());
                                }

                                while($row = mysqli_fetch_assoc($result)){

                                    echo '
                                        <option value="'.$row["first_name"].' '.$row["last_name"].'">'.$row["first_name"].' '.$row["last_name"].'</option>
                                    ';
                                }

                                ?>
                            </select>
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

    $('#add-group').click(function(){
        $('#operationMode').attr("value",0);
        document.getElementById("group-form").reset();
        $('#insert-group .modal-title').html("Add New Group");
        $('#insert-group button[type=submit]').html("Save Group");

    });

    $('#insert-group').on('shown.bs.modal', function(){
        $('input[name=groupName]').focus();
    });

    $('#group-table').DataTable({
        "lengthMenu": [ [6, 12, 24, -1], [6, 12, 24, "All"] ]
    });

    $('select').select2()

</script>
</body>

</html>