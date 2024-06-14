<?php
include 'layouts/session.php';
// Get the registration status from the request
$registration_status = isset($_GET['registration_status']) ? $_GET['registration_status'] : '';

// SQL query to fetch data from two tables with a specific registration_status
$sql = "SELECT 
            u.bnr_id, 
            u.profile_created_for, 
            u.first_name, 
            u.last_name, 
            u.gender, 
            u.date_of_birth, 
            u.country, 
            u.state, 
            u.email_id, 
            u.contact_number, 
            u.whatsapp_number,             
            u.registration_status, 
            u.created_date
        FROM bnr_user u
        WHERE u.registration_status = ?";

$stmt = $link->prepare($sql);
$stmt->bind_param("s", $registration_status);
$stmt->execute();
$result = $stmt->get_result();

$data = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$stmt->close();
$link->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>