<?php
include 'admin-login/layouts/config.php';
$bnr_id = $_POST['bnr_id'];
$qr_id = $_POST['qr_id'];
$profile_created_for = $_POST['profile_created_for'];
// Initialize variables
$gender = '';
$state = '';
$country = '';
$qr_id= '';

// Check if the keys exist in the $_POST array
if(isset($_POST['gender'])) {
    $gender = $_POST['gender'];
}

if(isset($_POST['state'])) {
    $state = $_POST['state'];
}
if(isset($_POST['country'])) {
    $country = $_POST['country'];
}
if(isset($_POST['qr_id'])) {
    $qr_id = $_POST['qr_id'];

    function decrypt($data, $key) {
		$cipher = "aes-256-cbc";
		list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
		return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
	}
	
	$qr_id = decrypt($qr_id, $encryption_key);
	
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$date_of_birth = $_POST['date_of_birth'];
$email_id = $_POST['email_id'];
$contact_number = $_POST['contact_number'];
$whatsapp_number = isset($_POST['whatsapp_number']) ? $_POST['whatsapp_number'] : '';
$whatsapp_number = $whatsapp_number == 'sameNumber' ? $contact_number : $whatsapp_number;

$sql = "INSERT INTO bnr_user (registration_status,bnr_id,qr_id, profile_created_for, gender, first_name, last_name, date_of_birth, country, state, email_id, contact_number, whatsapp_number) 
VALUES ('Drop','$bnr_id','$qr_id', '$profile_created_for', '$gender', '$first_name', '$last_name', '$date_of_birth', '$country', '$state', '$email_id', '$contact_number', '$whatsapp_number') 
ON DUPLICATE KEY UPDATE qr_id='$qr_id', profile_created_for='$profile_created_for', gender='$gender', first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth', country='$country', state='$state', email_id = '$email_id',contact_number='$contact_number', whatsapp_number='$whatsapp_number'";

if ($link->query($sql) === TRUE) {
    echo "Record saved successfully";
    setcookie("formData", json_encode($_POST), time() + (86400 * 30), "/");
    setcookie("email", $email_id, time() + (86400 * 30), "/");
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}
?>