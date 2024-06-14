<?php
include 'layouts/session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bnr_id = mysqli_real_escape_string($link, $_POST["bnr_id"]);

    // Fetch existing data
    $query = "SELECT * FROM bnr_user u LEFT JOIN bnr_user_profile p ON u.bnr_id = p.bnr_id WHERE u.bnr_id = '$bnr_id'";
    $result = mysqli_query($link, $query);
    $existing_data = mysqli_fetch_assoc($result);

    if (!$existing_data) {
        echo "Error: User not found.";
        exit;
    }

    // Get POST data or use existing data if not provided
    $profile_for = mysqli_real_escape_string($link, $_POST["profileFor"] ?? $existing_data["profile_created_for"]);
    $gender = mysqli_real_escape_string($link, $_POST["gender"] ?? $existing_data["gender"]);
    $name = mysqli_real_escape_string($link, $_POST["editName"] ?? $existing_data["first_name"] . ' ' . $existing_data["last_name"]);
    list($first_name, $last_name) = explode(' ', $name, 2) + ['', ''];
    $dob = mysqli_real_escape_string($link, $_POST["editDateOfBirth"] ?? $existing_data["date_of_birth"]);
    $country = mysqli_real_escape_string($link, $_POST["editCountry"] ?? $existing_data["country"]);
    $state = mysqli_real_escape_string($link, $_POST["editState"] ?? $existing_data["state"]);
    $email = mysqli_real_escape_string($link, $_POST["editEmail"] ?? $existing_data["email_id"]);
    $primary_contact = mysqli_real_escape_string($link, $_POST["editPrimaryContact"] ?? $existing_data["contact_number"]);
    $whatsapp = mysqli_real_escape_string($link, $_POST["editWhatsapp"] ?? $existing_data["whatsapp_number"]);

    // Handle file upload
    $photo = $existing_data["photo"];
    if (isset($_FILES["editPhoto"]) && $_FILES["editPhoto"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["editPhoto"]["name"]);
        if (move_uploaded_file($_FILES["editPhoto"]["tmp_name"], $target_file)) {
            $photo = $target_file;
        }
    }

    // Optional fields
    $mother_tongue = mysqli_real_escape_string($link, $_POST["editMotherTongue"] ?? $existing_data["mother_tongue"]);
    $caste = mysqli_real_escape_string($link, $_POST["editCaste"] ?? $existing_data["caste"]);
    $denomination = mysqli_real_escape_string($link, $_POST["editDenomination"] ?? $existing_data["denomination"]);
    $height = mysqli_real_escape_string($link, $_POST["editHeight"] ?? $existing_data["height"]);
    $weight = mysqli_real_escape_string($link, $_POST["editWeight"] ?? $existing_data["weight"]);
    $complexion = mysqli_real_escape_string($link, $_POST["editComplexion"] ?? $existing_data["complexion"]);
    $last_education = mysqli_real_escape_string($link, $_POST["editLastEducation"] ?? $existing_data["last_education_level"]);
    $occupation = mysqli_real_escape_string($link, $_POST["editOccupation"] ?? $existing_data["occupation"]);
    $company_name = mysqli_real_escape_string($link, $_POST["editCompanyName"] ?? $existing_data["company_name"]);
    $annual_income = mysqli_real_escape_string($link, $_POST["editAnnualIncome"] ?? $existing_data["annual_income"]);
    $work_location = mysqli_real_escape_string($link, $_POST["editWorkLocation"] ?? $existing_data["work_location"]);
    $citizen_of = mysqli_real_escape_string($link, $_POST["editCitizenOf"] ?? $existing_data["citizen_of"]);
    $father_name = mysqli_real_escape_string($link, $_POST["editFatherName"] ?? $existing_data["father_name"]);
    $father_occupation = mysqli_real_escape_string($link, $_POST["editFatherOccupation"] ?? $existing_data["father_occupation"]);
    $mother_name = mysqli_real_escape_string($link, $_POST["editMotherName"] ?? $existing_data["mother_name"]);
    $mother_occupation = mysqli_real_escape_string($link, $_POST["editMotherOccupation"] ?? $existing_data["mother_occupation"]);
    $family_status = mysqli_real_escape_string($link, $_POST["editFamilyStatus"] ?? $existing_data["family_status"]);
    $brothers = mysqli_real_escape_string($link, $_POST["editBrothers"] ?? $existing_data["number_of_brothers"]);
    $brother_married = mysqli_real_escape_string($link, $_POST["editBrotherMarried"] ?? $existing_data["brother_married"]);
    $sisters = mysqli_real_escape_string($link, $_POST["editSisters"] ?? $existing_data["number_of_sisters"]);
    $sister_married = mysqli_real_escape_string($link, $_POST["editSisterMarried"] ?? $existing_data["sister_married"]);
    $address = mysqli_real_escape_string($link, $_POST["editAddress"] ?? $existing_data["current_address"]);
    $perm_address = mysqli_real_escape_string($link, $_POST["editPermAddress"] ?? $existing_data["permanent_address"]);

    // Determine registration status
    $required_fields = [$profile_for, $gender, $first_name, $last_name, $dob, $country, $state, $email, $primary_contact, $whatsapp, $mother_tongue, $caste, $denomination, $height, $weight, $complexion, $last_education, $occupation, $company_name, $annual_income, $work_location, $citizen_of, $father_name, $father_occupation, $mother_name, $mother_occupation, $family_status, $brothers, $brother_married, $sisters, $sister_married, $address, $perm_address];

    $registration_status = 'Active';
    foreach ($required_fields as $field) {
        if (empty($field)) {
            $registration_status = 'Ready';
            break;
        }
    }

    // Start transaction
    mysqli_begin_transaction($link);

    try {
        // Update bnr_user table
        $sql1 = "UPDATE bnr_user SET 
                    profile_created_for='$profile_for', 
                    gender='$gender', 
                    first_name='$first_name', 
                    last_name='$last_name', 
                    date_of_birth='$dob', 
                    country='$country', 
                    state='$state', 
                    email_id='$email', 
                    contact_number='$primary_contact', 
                    whatsapp_number='$whatsapp', 
                    registration_status='$registration_status', 
                    created_date=now() 
                 WHERE bnr_id='$bnr_id'";

        if (!mysqli_query($link, $sql1)) {
            throw new Exception("Error in bnr_user update: " . mysqli_error($link));
        }

        // Update bnr_user_profile table
        $sql2 = "UPDATE bnr_user_profile SET 
                    mother_tongue='$mother_tongue', 
                    caste='$caste', 
                    denomination='$denomination', 
                    height='$height', 
                    weight='$weight', 
                    complexion='$complexion', 
                    last_education_level='$last_education', 
                    occupation='$occupation', 
                    company_name='$company_name', 
                    annual_income='$annual_income', 
                    work_location='$work_location', 
                    citizen_of='$citizen_of', 
                    father_name='$father_name', 
                    father_occupation='$father_occupation', 
                    mother_name='$mother_name', 
                    mother_occupation='$mother_occupation', 
                    family_status='$family_status', 
                    number_of_brothers='$brothers', 
                    brother_married='$brother_married', 
                    number_of_sisters='$sisters', 
                    sister_married='$sister_married', 
                    current_address='$address', 
                    permanent_address='$perm_address', 
                    photo='$photo' 
                 WHERE bnr_id='$bnr_id'";

        if (!mysqli_query($link, $sql2)) {
            throw new Exception("Error in bnr_user_profile update: " . mysqli_error($link));
        }

        // Commit transaction
        mysqli_commit($link);
        echo "Record updated successfully";
    } catch (Exception $e) {
        // Rollback transaction
        mysqli_rollback($link);
        echo $e->getMessage();
    }

    mysqli_close($link);
} else {
    echo "Error: Method Not Allowed. Please use POST method to submit the form.";
}
?>
