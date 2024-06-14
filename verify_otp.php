<?php
include 'admin-login/layouts/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debugging: Log the entire POST request
    error_log(print_r($_POST, true));

    if (!isset($_POST['bnr_id']) || !isset($_POST['identifier'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Bad Request: Missing required parameters']);
        exit;
    }
    
    $bnr_id = $_POST['bnr_id'];

    function decrypt($data, $key) {
        $cipher = "aes-256-cbc";
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
    }

    // Debugging: Log before decryption
    error_log("Before decryption: bnr_id = $bnr_id");

    $bnr_id = decrypt($bnr_id, $encryption_key);

    // Debugging: Log after decryption
    error_log("After decryption: bnr_id = $bnr_id");

    $identifier = $_POST['identifier'];

    if ($identifier == 'email') {
        if (!isset($_POST['otp']) || !isset($_SESSION['emailotp'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Bad Request: Missing OTP or session data']);
            exit;
        }
        
        $otp = $_POST['otp'];
        $otpCode = $_SESSION['emailotp'];
        
        if ($otp == $otpCode) {
            $sql = "UPDATE bnr_user SET registration_status ='Verified', email_verification_status='1', last_modified_date=now() WHERE bnr_id='$bnr_id'";
            $link->query($sql);
            unset($_SESSION['emailotp']);
            unset($_SESSION['email_id']);
            http_response_code(200);
            echo json_encode(['message' => 'Email OTP Verified successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Email Failed to verify OTP']);
        }
    } elseif ($identifier == 'whatsapp') {
        if (!isset($_POST['wotp']) || !isset($_SESSION['whatsappotp'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Bad Request: Missing OTP or session data']);
            exit;
        }

        $otp = $_POST['wotp'];
        $otpCode = $_SESSION['whatsappotp'];
        
        if ($otp == $otpCode) {
            $sql = "UPDATE bnr_user SET registration_status ='Verified', whatsapp_verification_status='1', last_modified_date=now() WHERE bnr_id='$bnr_id'";
            $link->query($sql);
            unset($_SESSION['whatsappotp']);
            unset($_SESSION['whatsapp_number']);
            http_response_code(200);
            echo json_encode(['message' => 'Whatsapp OTP Verified successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Whatsapp Failed to verify OTP']);
        }
    } elseif ($identifier == 'sms') {
        if (!isset($_POST['smsotp']) || !isset($_SESSION['otp'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Bad Request: Missing OTP or session data']);
            exit;
        }

        $otp = $_POST['smsotp'];
        $otpCode = $_SESSION['otp'];
        
        if ($otp == $otpCode) {
            $sql = "UPDATE bnr_user SET registration_status ='Verified', phone_verification_status='1', last_modified_date=now() WHERE bnr_id='$bnr_id'";
            $link->query($sql);
            unset($_SESSION['otp']);
            unset($_SESSION['contact_number']);
            http_response_code(200);
            echo json_encode(['message' => 'SMS OTP Verified successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'SMS Failed to verify OTP']);
        }
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
