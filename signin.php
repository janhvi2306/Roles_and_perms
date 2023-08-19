<html>
<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php
session_start();

$con=mysqli_connect("localhost","root","","user");

if($con)
{
  if(isset($_POST['signin']))
  {
    $username=$_POST['username'];
    $password=$_POST['password'];

    $query="select * from permission where username='$username' and password='$password'";
    $result = mysqli_query($con,$query);
    $count=mysqli_num_rows($result);
    //echo $count;
    if ($count>0) {
      
      echo '<script type="text/javascript">
      window.onload = function () 
      { alert("Login Successfully"); }
      </script>';
      $row=mysqli_fetch_assoc($result);
      $_SESSION['role_name']=$row['role_name'];
      $_SESSION['IS_LOGIN']='yes';
      if($row['role_name']=='manager')
      {
        header("location:dashboard.php");
      }if($row['role_name']=='admin')
      {
        header("location:dashboard.php");
      }if($row['role_name']=='user')
      {
        header("location:dashboard.php");
      }
     

    } else {
      echo '<script type="text/javascript">
      window.onload = function () 
      { alert("User Not Found"); }
      </script>';
    }
  }
}
    
    ?>
  

<body>
<form action="signin.php" method="post">
  <h1 style="margin-left:650px;"><b>Sign In</b></h1>
  <div class="container" style="width: 400px;height:290px;border: 5px solid green;padding: 30px;margin-top: 40px;margin-left: 500px;">

    <div class="form-group">
      <label for="inputusername4">Username</label>
      <input type="username" class="form-control" name="username" placeholder="username" required>
      <br>

      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name="password" placeholder="password" required>
    </div>

  <button type="submit" class="btn btn-success" style="margin-top: 10px;" name="signin">Sign In</button><br>
    <!-- <a href="signup.php">New User?Create Account</a> -->

  </div>

  </form>

  
</body>
  </html>