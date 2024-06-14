<?php
include 'admin-login/layouts/config.php';
$bnr_id = $_POST['dbnr_id'];
$email_id = $_POST['email'];

$sql = "UPDATE bnr_user SET email_id ='$email_id' where bnr_id='$bnr_id'";

if ($link->query($sql) === TRUE) {

} else 
{
    
}
?>