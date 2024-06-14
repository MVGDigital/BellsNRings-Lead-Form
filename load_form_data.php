<?php
include 'admin-login/layouts/config.php';
$bnr_id = $_POST['bnr_id'];

$sql = "SELECT * FROM bnr_user WHERE bnr_id='$bnr_id'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode([]);
}

$link->close();

?>