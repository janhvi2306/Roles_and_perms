<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php
$con = mysqli_connect("localhost", "root", "", "user");
if ($con) {
    if (isset($_POST['submit'])) {
        $role_name = strtolower($_POST['role_name']);

        $sql_sel = "SELECT * FROM roles WHERE role_name = '$role_name'";
    $result_sel = $con->query($sql_sel);

    if ($result_sel->num_rows > 0) {
        // Role exists, update it
        echo "ERROR:inserting role: ROLE ALREADY EXIST";
    } else {
        // Role doesn't exist, insert it
        $insertSql = "insert into roles(role_name) values ('$role_name')";
        if ($con->query($insertSql) === TRUE) {
            echo "Role inserted successfully.";
        } else {
           echo "ERROR role not inserted";
        }
    }
    }
}

if(isset($_POST['save']))
{
    $checked=$_POST['privl'];
    $checked_arr=[];
    $roleName=$_POST['roleName'];
    $check="";
    
    foreach($checked as $ch)  
    {  
      array_push($checked_arr,$ch); 
   } 
   
   $jsonData=json_encode($checked_arr);
    $sql_sel = "SELECT * FROM privelg WHERE role_selected = '$roleName'";
    $result_sel = $con->query($sql_sel);

    if ($result_sel->num_rows > 0) {
        // Role exists, update it
        $updateSql = "UPDATE privelg SET permission = '$jsonData' WHERE role_selected = '$roleName'";
        echo $updateSql;
        if ($con->query($updateSql) === TRUE) {
            echo "Role's Permission updated successfully.";
        } else {
            echo "Error updating role: " . $con->error;
        }
    } else {
        // Role doesn't exist, insert it
        $insertSql = "insert into privelg(permission,role_selected) values ('$jsonData','$roleName')";
        echo $insertSql;
        if ($con->query($insertSql) === TRUE) {
            echo "Priveleges added successfully.";
        } else {
           echo "Error inserting role: " . $con->error;
        }
    }
}
?>

<body>
    <form action="roles.php" method="post">
        Role : <input type="text" class="form-control" name="role_name" required><br>
        <button type="submit" name="submit">Add Role</button>
    </form>

    <form action="roles.php" method="post">
        <div style="background:#ecfcee;width:500px;height:200px;padding: 10px;box-shadow: 5px 10px #f3efef;border-radius:5%;">
        <h4>Add Privileges</h4>
        Permission :&emsp; <input type="checkbox" name="privl[]" value="View User">View User&emsp;
        <input type="checkbox" name="privl[]" value="Edit User">Edit User&emsp;
        <input type="checkbox" name="privl[]" value="Delete User">Delete User<br>
        <br>
        <label>Select Role</label>
        <select name="roleName">
            <?php
            $query = "SELECT distinct role_name FROM permission";
            $result = mysqli_query($con, $query);
            if ($result->num_rows > 0) {
                while ($optionData = $result->fetch_assoc()) {
                    $option = $optionData['role_name'];
                    $role_id = $optionData['role_id'];
            ?>
                    <option style="color:black;" value="<?php echo $option; ?>"><?php echo $option; ?> </option>
            <?php
                }
            }
            ?>
        </select><br><br>
        <button type="submit" name="save" style="background:red;color:white;font-size:17px;border-radius:5%">Submit</button>
    </form>
</body>

</html>