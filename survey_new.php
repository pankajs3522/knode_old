<?php
include("db.ini.php");
include("auth.ini.php");

$name = mysqli_real_escape_string($con,$_POST['name']);
$description = mysqli_real_escape_string($con,$_POST['description']);
$from = mysqli_real_escape_string($con,$_GET['from']);
$company = mysqli_real_escape_string($con,$_POST['company']);

$sql = "INSERT into survey_details (name,description,company) VALUES ('".$name."','".$description."','".$company."')";
echo $sql;
echo $from;
if(mysqli_query($con, $sql))
{
    if($from != "")
    {
        header("location: ".$from."?new_survey=1&company=".$company);
    }
    else
    {
        header("location: surveys.php?new_surveyy=1");
    }
}
else{
    echo "Sorry Error Occured";
}

?>