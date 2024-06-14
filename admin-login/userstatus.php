<?php
header('Content-Type: application/json');

include 'layouts/session.php';

$response = array('success' => false);

if (isset($_GET['bnr_id']) && isset($_GET['current_page_url'])) 
{
    $bnrId = $_GET['bnr_id'];
    $currentPageUrl = $_GET['current_page_url'];

    
	$query = "UPDATE `bnr_user` SET 
			`registration_status`='Settled',
			`last_modified_date`=now(),
			`last_modified_by`='".$_SESSION['admin_id']."'
			 WHERE bnr_id = '".$bnrId."'";
			
	$res = mysqli_query($link,$query);
    

    if ($res) {
        $response['success'] = true;
    } else {
        $response['error'] = 'Failed to update the profile. It may not exist.';
    }
} 
else 
{
    $response['error'] = 'Invalid request. Missing bnr_id or current_page_url.';
}

echo json_encode($response);
?>
