<?php
include 'admin-login/layouts/config.php';
$bnr_id = $_POST['bnr_id'];
$email_id = $_POST['email_id'];

$sql = "UPDATE bnr_user SET registration_status ='Unverified' where bnr_id='$bnr_id'";

if ($link->query($sql) === TRUE) {
    echo "1";
    setcookie("formData", json_encode($_POST), time() + (86400 * 30), "/");
    setcookie("email", $email_id, time() + (86400 * 30), "/");
} else 
{
    echo "2";
}
?>