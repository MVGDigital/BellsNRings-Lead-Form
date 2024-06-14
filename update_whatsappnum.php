<?php
include 'admin-login/layouts/config.php';
$bnr_id = $_POST['dbnr_id'];
$whatsapp_number = $_POST['whatsappNum'];

$sql = "UPDATE bnr_user SET whatsapp_number ='$whatsapp_number' where bnr_id='$bnr_id'";

if ($link->query($sql) === TRUE) {

} else 
{
    
}
?>