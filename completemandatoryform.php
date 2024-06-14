<?php
include 'admin-login/layouts/config.php';

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $bnr_id = $_POST['bnr_id'];
	
	function decrypt($data, $key) {
		$cipher = "aes-256-cbc";
		list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
		return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
	}
	
	$decbnr_id = decrypt($bnr_id, $encryption_key);
	
  
	$sql = "SELECT id FROM bnr_user 
	WHERE bnr_id = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("s", $decbnr_id);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = array();

	if ($result->num_rows > 0)
	{
		$sql = "UPDATE bnr_user SET registration_status ='Verified',last_modified_date=now() where bnr_id='$decbnr_id'";
		$link->query($sql);
		
		http_response_code(200);
		echo json_encode(['message' => 'Success']);
	}
	else 
	{
		http_response_code(500);
		echo json_encode(['error' => 'Failed to Update']);
	}
} 
else 
{
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
