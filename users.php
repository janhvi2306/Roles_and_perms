<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

session_start();
$con = mysqli_connect("localhost", "root", "", "user");
if ($con) {
    $query = "select * from permission";
    $result_all = mysqli_query($con, $query);
    
    $query_privel = mysqli_query($con, "select * from privelg where role_selected='$_SESSION[role_name]'");
    $row_privel = mysqli_fetch_assoc($query_privel);
    print_r($row_privel);
    $array = json_decode($row_privel['permission'],true);
    if ($array === null && json_last_error() !== JSON_ERROR_NONE) {
        echo "JSON Decode Error: " . json_last_error_msg();
    }
   // print_r($array);
   
    // // look through query{
    //     echo "inside while";
    //     // add each row returned into an array
    //     $array[] = $row;
    //     print_r($array);

    }



if (isset($_POST['addRec'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "insert into permission(username,password,role) values('$username','$password','$role')";
    $result = mysqli_query($con, $query);
    if ($result >= 1) {

        echo '<script type="text/javascript">
        window.onload = function () 
        { alert("Record Inserted Successfully"); }
        </script>';
        header("location:users.php");
    }
}
?>



<button name="addbtn" class="addbtn" style="background:red;color:white;padding:4px;font-size:17px;border:none;border-radius:6%;float:right;margin-right:40px;"><i class="fas fa-plus">Add User</i></button>
<table style="width:600px;height:auto;">
    <h1> All Records</h1>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Role</th>
        <th>Action</th>
    </tr>


    <?php

    while ($row = $result_all->fetch_assoc()) { ?>

        <tr>
            <!-- <input type="hidden" name="user_id" id="user_id"> -->
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['role_name']; ?></td>
            <td>

                <?php
                if (in_array("View User", $array)) {
                ?><button style="background:#b79406;padding:4px;" name="view"><i class="fas fa-eye" style="color:white;padding:2px;"></i></button>
                <?php } ?>

                <?php
                if (in_array("Edit User", $array)) {
                ?><button style="background:green;padding:4px;" name="edit"><i class="fas fa-edit" style="color:white;"></i></button>
                <?php } ?>

                <?php
                if (in_array("Delete User", $array)) {
                ?><button style="background:red;padding:4px;" name="delete"><i class="fas fa-trash" style="color:white;"></i></button>
                <?php } ?>

        </tr>
    <?php } ?>
</table>

<!-- add modal -->
<div class="modal" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="users.php" method="post">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input class="form-control" type="text" name="role" id="role" required>
                    </div>

                    <button type="submit" class="btn btn-primary" id="addRec" name="addRec">Add</button>
                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
                </form>


            </div>

        </div>
    </div>

</div>
<!-- 
  add modal end -->
<script>
    $(document).ready(function() {
        $('.addbtn').on('click', function() {
            $('#addModal').modal('show');
        })
    })
</script>

</html>