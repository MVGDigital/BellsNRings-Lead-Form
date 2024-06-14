<?php
include 'admin-login/layouts/config.php';

$country_id = '';

if(isset($_GET['term'])) {
    $country_id = $_GET['term'];
}

if($country_id == '')
{
	$sql = "SELECT country_id, country_name, phonecode FROM master_countries";
}
else
{
	$sql = "SELECT country_id, country_name, phonecode FROM master_countries WHERE country_id = '$country_id';";
}
$result = $link->query($sql);

$countries = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $countries[] = [
            'id' => $row['country_id'],
            'text' => $row['country_name']
        ];
    }
}

$link->close();

header('Content-Type: application/json');
echo json_encode($countries);

?>