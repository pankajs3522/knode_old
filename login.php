<?php
//Detect OS First
//include('detect_os.php');

include("db.ini.php");

$email = mysqli_real_escape_string($con,$_POST['email']);
$pass = md5(mysqli_real_escape_string($con,$_POST['password']));

$query = "SELECT * FROM admins WHERE email='" . $email . "' AND  password='". $pass ."'";
//echo $query;
$result = mysqli_query($con, $query) or die("Error Occured!");
if (mysqli_num_rows($result) == 0) {
    mysqli_close($con);
    die("Account Not Found");
} else {
    $row = mysqli_fetch_array($result);
    $_SESSION['id'] = $row['id'];
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['surname'] = $row['surname'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['employee_id'] = $row['employee_id'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['designation'] = $row['designation'];
    mysqli_close($con);
    //echo "Reached 3". $_SESSION['designation'];
    header('location: index.php');
}

$urlParts = explode('.', $_SERVER['HTTP_HOST']);
//print_r($urlParts);

?>