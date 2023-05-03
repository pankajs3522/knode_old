<?php
include("db.ini.php");
include("auth.ini.php");

$id = mysqli_real_escape_string($con,$_POST['id']);
$name = mysqli_real_escape_string($con,$_POST['name']);
$description = mysqli_real_escape_string($con,$_POST['description']);
$address =     mysqli_real_escape_string($con,$_POST['address']);
$from = mysqli_real_escape_string($con,$_GET['from']);
$active = mysqli_real_escape_string($con,$_POST['active']);

$sql = "UPDATE companies SET name = '".$name."', description = '".$description."', address = '".$address."', active = '".$active."' WHERE id = ".$id;

if(mysqli_query($con, $sql))
{
    if($from != "")
    {
        header("location: ".$from."?edit_company=1");
    }
    else
    {
        header("location: companies.php?edit_company=1");
    }
}
else{
    echo "Sorry Error Occured";
}

?>