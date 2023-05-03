<?php


if(!isset($_SESSION['id']))
{
	header('location: login.html?auth=1');
	echo "Not Authorised!<br>";
	echo "<a href='login.html?auth=1'>Click Here To Go back</a>";

}

?>