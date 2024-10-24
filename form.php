<?php
include("connection.php");

$result = array();

if(isset($_POST['searchdata'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $query = "SELECT * FROM form WHERE id='$search'";
    $data = mysqli_query($conn, $query);

    if(mysqli_num_rows($data) == 1) {
        $result = mysqli_fetch_assoc($data);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="center">
    <form action="#" method="POST">
        <h1>Employee Management System</h1>
        <div class="form">
            <input type="text" name="search" id="search" class="textfield" placeholder="Search Id" value="<?php echo isset($_POST['searchdata']) ? htmlspecialchars($result['id']) : ''; ?>">
            <input type="text" name="name" id="name" class="textfield" placeholder="Employee Name" value="<?php echo isset($_POST['searchdata']) ? htmlspecialchars($result['emp_name']) : ''; ?>">

            <select class="textfield" name="gender" >
                <option value="Not Selected">Select Gender</option>
                <option value="Male" <?php if (isset($_POST['searchdata']) && $result['emp_gender'] == 'Male') { echo "selected"; } ?>>Male</option>
                <option value="Female" <?php if (isset($_POST['searchdata']) && $result['emp_gender'] == 'Female') { echo "selected"; } ?>>Female</option>
                <option value="Other" <?php if (isset($_POST['searchdata']) && $result['emp_gender'] == 'Other') { echo "selected"; } ?>>Other</option>
            </select>

            <input type="text" name="email" class="textfield" placeholder="Email Address" value="<?php echo isset($_POST['searchdata']) ? htmlspecialchars($result['emp_email']) : ''; ?>">
            <select class="textfield" name="department" >
                <option value="Not Selected">Select Department</option>
                <option value="IT" <?php if (isset($_POST['searchdata']) && $result['emp_department'] == 'IT') { echo "selected"; } ?>>IT</option>
                <option value="Account" <?php if (isset($_POST['searchdata']) && $result['emp_department'] == 'Account') { echo "selected"; } ?>>Account</option>
                <option value="Sales" <?php if (isset($_POST['searchdata']) && $result['emp_department'] == 'Sales') { echo "selected"; } ?>>Sales</option>
                <option value="HR" <?php if (isset($_POST['searchdata']) && $result['emp_department'] == 'HR') { echo "selected"; } ?>>HR</option>
                <option value="Marketing" <?php if (isset($_POST['searchdata']) && $result['emp_department'] == 'Marketing') { echo "selected"; } ?>>Marketing</option>
            </select>
            <textarea placeholder="Address" name="address" ><?php echo isset($_POST['searchdata']) ? htmlspecialchars($result['emp_address']) : ''; ?></textarea>
            <input type="submit" name="searchdata" value="Search" class="btn" style="border:2px dashed white">
            <input type="submit" name="save" value="Save" class="btn" style="background-color: green;border:2px dashed white;">
            <input type="submit" name="update" value="Update" class="btn" style="background-color: orange;border:2px dashed white;">
            <input type="submit" name="delete" value="Delete" class="btn" onclick="return checkdelete()" style="background-color: red;border:2px dashed white;">
            <input type="submit" name="clear" value="Clear" class="btn" onclick="return reset()" style="background-color: blue;border:2px dashed white;">
        </div>
    </form>
</div>

<script type="text/javascript">
    function checkdelete(){
        return confirm('Are you sure you want to delete this record?');
    }
</script>

<?php
if(isset($_POST['save'])){
    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $address    = mysqli_real_escape_string($conn, $_POST['address']);

    $query = "INSERT INTO form (emp_name,emp_gender,emp_email,emp_department,emp_address) VALUES ('$name','$gender','$email','$department','$address')";
    $data = mysqli_query($conn, $query);
    if($data){
        echo "<script> alert('Data saved into Database')</script>";
    }
    else{
        echo "<script> alert('Failed to save data')</script>";
    }
}

if(isset($_POST['delete']))
{
    $id=mysqli_real_escape_string($conn, $_POST['search']);
    $query = "DELETE FROM form WHERE id='$id' ";
    $data = mysqli_query($conn,$query);
    if($data){
        echo "<script> alert('Record deleted Successfully')</script>";
    }
    else{
        echo "<script> alert('Failed to delete record')</script>";
    }
}

if(isset($_POST['update']))
{
    $id         = mysqli_real_escape_string($conn, $_POST['search']);
    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $address    = mysqli_real_escape_string($conn, $_POST['address']);

    $query = "UPDATE form SET emp_name='$name',emp_gender='$gender',emp_email='$email',emp_department='$department',emp_address='$address' WHERE id='$id'";

    $data = mysqli_query($conn, $query);
    if($data){
        echo "<script> alert('Record Updated Successfully')</script>";
    }
    else{
        echo "<script> alert('Failed to Update')</script>";
    }
}
?>

</body>
</html>
