<?php

session_start();
if(!isset($_SESSION['IS_LOGIN'])) {
    header('location:signin.php');
    die();
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<style>
    .header{
        width:100%;
        height:50px;
        text-align: center;
        background: #1abc9c;
        color: white;
        font-size: 30px;
        position:relative;
    }
    .sidenav {
      background-color: #f1f1f1;
      height: 650px;
      width: 10%;
      position: absolute;
      font-size:22px;
   
    }

    .sidenav ul li{
        list-style-type:none;
        padding:10px;
        margin-left: -20px;
    }

    .sidenav ul li:hover{
        background-color: #ddd;
        color: black;
    }

    .display{
        width:90%;
        height:auto;
        margin-left: 180px;
        background:#e8f0ef;
    }
</style>


<body>
<?php  
            $con=mysqli_connect("localhost","root","","user");
            $query=mysqli_query($con,"select * from privelg where role_selected='$_SESSION[role_name]'");
            $row=mysqli_fetch_assoc($query);
            ?>
    <div class="header">
    <h2>Dashboard</h2>
    </div>
    <div class="sidenav">
        <ul>
            
            <li>Dashboard</li>
           
            <li><a href="users.php" style="text-decoration: none;color:black" target="iframe_a">Users</a></li>
            
            <li><a href="news.php" style="text-decoration: none;color: black;" target="iframe_a">News</a></li>
            <li><a href="roles.php" style="text-decoration: none;color: black;" target="iframe_a">Roles</a></li>
            <li><a href="logout.php" style="text-decoration: none;color: black;">Logout</a></li>
        </ul>
    </div>
    
    <div class="display" >
        <iframe style="display: block; width: 100%; border: none; overflow-y: auto; overflow-x: hidden;height:600px;" name="iframe_a"></iframe>
        <p><a href="https://www.javatpoint.com" target="iframe_a">JavaTpoint.com</a></p>  
    </div>
    
</body>
</html> 
