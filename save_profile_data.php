<?php
include 'admin-login/layouts/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $bnr_id = isset($_POST['bnr_id']) ? $_POST['bnr_id'] : '';
    $maritalStatus = isset($_POST['maritalStatus']) ? $_POST['maritalStatus'] : '';
    $motherTongue = isset($_POST['mothertongue']) ? $_POST['mothertongue'] : '';
    $caste = isset($_POST['caste']) ? $_POST['caste'] : '';
    $denomination = isset($_POST['denomination']) ? $_POST['denomination'] : '';
    $height = isset($_POST['height']) ? $_POST['height'] : '';
    $weight = isset($_POST['weight']) ? $_POST['weight'] : '';
    $complexion = isset($_POST['complexion']) ? $_POST['complexion'] : '';
    $lastEducationLevel = isset($_POST['last_edu_level']) ? $_POST['last_edu_level'] : '';
    $occupation = isset($_POST['occupation']) ? $_POST['occupation'] : '';
    $companyName = isset($_POST['company_name']) ? $_POST['company_name'] : '';
    $annualIncome = isset($_POST['annual_income']) ? $_POST['annual_income'] : '';
    $workLocation = isset($_POST['work_location']) ? $_POST['work_location'] : '';
    $fatherName = isset($_POST['fatherName']) ? $_POST['fatherName'] : '';
    $fatherOccupation = isset($_POST['fatherOccupation']) ? $_POST['fatherOccupation'] : '';
    $motherName = isset($_POST['motherName']) ? $_POST['motherName'] : '';
    $motherOccupation = isset($_POST['motherOccupation']) ? $_POST['motherOccupation'] : '';
    $familyStatus = isset($_POST['familystatus']) ? $_POST['familystatus'] : '';
    $numberOfBrothers = isset($_POST['noOfBrother']) ? $_POST['noOfBrother'] : '';
    $brotherMarried = isset($_POST['brotherMarried']) ? $_POST['brotherMarried'] : '';
    $numberOfSisters = isset($_POST['noOfsister']) ? $_POST['noOfsister'] : '';
    $sisterMarried = isset($_POST['sisterMarried']) ? $_POST['sisterMarried'] : '';
    $currentAddress = isset($_POST['address']) ? $_POST['address'] : '';
    $permanentAddress = isset($_POST['permAddress']) ? $_POST['permAddress'] : '';
    if ($permanentAddress === 'same_as_above') {
        $permanentAddress = $currentAddress;
    }
    $citizenOf = isset($_POST['citizenOf']) ? $_POST['citizenOf'] : '';

    $sql = "INSERT INTO bnr_user_profile 
            (bnr_id,marital_status, mother_tongue, caste, denomination, height, weight, complexion, last_education_level, 
            occupation, company_name, annual_income, work_location, father_name, father_occupation, mother_name, 
            mother_occupation, family_status, number_of_brothers, brother_married, number_of_sisters, sister_married, 
            current_address, permanent_address, citizen_of) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssssssss", 
                        $bnr_id, $maritalStatus, $motherTongue, $caste, $denomination, $height, $weight, $complexion, $lastEducationLevel, 
                        $occupation, $companyName, $annualIncome, $workLocation, $fatherName, $fatherOccupation, $motherName, 
                        $motherOccupation, $familyStatus, $numberOfBrothers, $brotherMarried, $numberOfSisters, $sisterMarried, 
                        $currentAddress, $permanentAddress, $citizenOf);

    if ($stmt->execute() === TRUE) {
        echo "Data saved successfully!";
    } else {
        http_response_code(500);
        echo "Error: " . $link->error;
    }
	$stmt->close();
    $link->close();
} else {
    // Return error response
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
