<?php
include("db.ini.php");
include("auth.ini.php");


$id = mysqli_real_escape_string($con,$_POST['id']);
$name = mysqli_real_escape_string($con,$_POST['name']);
$description = mysqli_real_escape_string($con,$_POST['description']);
$from = mysqli_real_escape_string($con,$_GET['from']);
$company = mysqli_real_escape_string($con,$_GET['company']);
if($company == "")
{
    $company = mysqli_real_escape_string($con,$_POST['company']);
}
//echo $company;
$active = mysqli_real_escape_string($con,$_POST['status']);

$sql = "UPDATE survey_details SET name = '".$name."', description = '".$description."', company = '".$company."', status = '".$active."' WHERE id = ".$id;

if(mysqli_query($con, $sql))
{
    if($from != "")
    {
        header("location: ".$from."?edit_company=1&company=".$company);
    }
    else
    {
        header("location: surveys.php?edit_company=1");
    }
}
else{
    echo "Sorry Error Occured";
}

?>