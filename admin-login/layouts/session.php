<?php
// Initialize the session

require_once "config.php";


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //header("location: pages-comingsoon.php");
	header("location: auth-login.php");
    exit;
}


$querysel = mysqli_query($link,"select * from bnr_admin_user where admin_id ='".$_SESSION['admin_id']."'");
$querysel_cnt = mysqli_num_rows($querysel);
$user_details = array();
if($querysel_cnt > 0)
{
	while($row=mysqli_fetch_assoc($querysel)) 
	{
		$user_details = $row;
	}
}

$logaccessed_on=date("Y-m-d H:i:s");
$logaccessed_by=$_SESSION['username'];

//echo "<pre>";
//print_r($entity_details);
?>