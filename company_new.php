<?php
include("db.ini.php");
include("auth.ini.php");

$name = mysqli_real_escape_string($con,$_POST['name']);
$description = mysqli_real_escape_string($con,$_POST['description']);
$address = mysqli_real_escape_string($con,$_POST['address']);
$from = $address = mysqli_real_escape_string($con,$_GET['from']);

$sql = "INSERT into companies (name,description,address) VALUES ('".$name."','".$description."','".$address."')";
if(mysqli_query($con, $sql))
{
    if($from != "")
    {
        header("location: ".$from."?new_company=1");
    }
    else
    {
        header("location: companies.php?new_company=1");
    }
}
else{
    echo "Sorry Error Occured";
}

?>