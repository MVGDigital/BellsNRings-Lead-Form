<?php
include 'admin-login/layouts/config.php';

$country_id = '';

if(isset($_GET['term'])) {
    $country_id = $_GET['term'];
}

if($country_id == '')
{
	$sql = "SELECT state_id, state_name FROM master_states";
}
else
{
	$sql = "SELECT state_id, state_name FROM master_states WHERE country_id = '$country_id';";
}
$result = $link->query($sql);

$countries = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $countries[] = [
            'id' => $row['state_id'],
            'text' => $row['state_name']
        ];
    }
}

$link->close();

header('Content-Type: application/json');
echo json_encode($countries);

?>