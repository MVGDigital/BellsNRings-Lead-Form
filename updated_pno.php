<?php
include 'admin-login/layouts/config.php';
$bnr_id = $_POST['dbnr_id'];
$contact_number = $_POST['primaryMobNum'];

$sql = "UPDATE bnr_user SET contact_number ='$contact_number' where bnr_id='$bnr_id'";

if ($link->query($sql) === TRUE) {

} else 
{
    
}
?>