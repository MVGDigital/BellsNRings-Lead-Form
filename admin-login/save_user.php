<?php
include 'layouts/session.php';
// include 'db.php';

function generateUniqueBnrId($link) {
    $query = "SELECT bnr_id FROM bnr_user ORDER BY bnr_id DESC LIMIT 1";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        $lastId = $row['bnr_id'];
        $numericPart = substr($lastId, 3);
        $newNumericPart = str_pad((int)$numericPart + 1, 4, '0', STR_PAD_LEFT);
        return 'BNR' . $newNumericPart;
    }
    // } else {
    //     return 'BNR0001';
    // }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate unique bnr_id
    $bnr_id = generateUniqueBnrId($link);

    $profile_for = mysqli_real_escape_string($link, $_POST["profileFor"]);
    $gender = mysqli_real_escape_string($link, $_POST["gender"]);
    $first_name = mysqli_real_escape_string($link, $_POST["firstName"]);
    $last_name = mysqli_real_escape_string($link, $_POST["lastName"]);
    $dob = mysqli_real_escape_string($link, $_POST["editDateOfBirth"]);
    $country = mysqli_real_escape_string($link, $_POST["editCountry"]);
    $state = mysqli_real_escape_string($link, $_POST["editState"]);
    $email_id = mysqli_real_escape_string($link, $_POST["email"]);
    $primary_contact = mysqli_real_escape_string($link, $_POST["primaryMobNum"]);
    $whatsapp = mysqli_real_escape_string($link, $_POST["addWhatsappNum"]);

    if ($whatsapp == "sameNumber") {
        $whatsapp = $primary_contact;
    }

    // Handle file upload
    $photo = '';
    if (isset($_FILES["editPhoto"]) && $_FILES["editPhoto"]["error"] == 0) {
        $target_dir = "uploads/";
        $photo_name = basename($_FILES["editPhoto"]["name"]);
        $target_file = $target_dir . $photo_name;
        if (move_uploaded_file($_FILES["editPhoto"]["tmp_name"], $target_file)) {
            $photo = $photo_name;  // Store only the filename in the database
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }

    // Check if optional parameters are set and assign default values if not
    $marital_status = isset($_POST["maritalStatus"]) ? mysqli_real_escape_string($link, $_POST["maritalStatus"]) : '';
    $mother_tongue = isset($_POST["mothertongue"]) ? mysqli_real_escape_string($link, $_POST["mothertongue"]) : '';
    $caste = isset($_POST["caste"]) ? mysqli_real_escape_string($link, $_POST["caste"]) : '';
    $denomination = isset($_POST["denomination"]) ? mysqli_real_escape_string($link, $_POST["denomination"]) : '';
    $height = isset($_POST["height"]) ? mysqli_real_escape_string($link, $_POST["height"]) : '';
    $weight = isset($_POST["weight"]) ? mysqli_real_escape_string($link, $_POST["weight"]) : '';
    $complexion = isset($_POST["complexion"]) ? mysqli_real_escape_string($link, $_POST["complexion"]) : '';
    $last_education = isset($_POST["last_edu_level"]) ? mysqli_real_escape_string($link, $_POST["last_edu_level"]) : '';
    $occupation = isset($_POST["occupation"]) ? mysqli_real_escape_string($link, $_POST["occupation"]) : '';
    $company_name = isset($_POST["company_name"]) ? mysqli_real_escape_string($link, $_POST["company_name"]) : '';
    $annual_income = isset($_POST["editAnnualIncome"]) ? mysqli_real_escape_string($link, $_POST["editAnnualIncome"]) : '';
    $work_location = isset($_POST["work_location"]) ? mysqli_real_escape_string($link, $_POST["work_location"]) : '';
    // $citizen_of = isset($_POST["citizenOf"]) ? mysqli_real_escape_string($link, $_POST["citizenOf"]) : '';
    $father_name = isset($_POST["fatherName"]) ? mysqli_real_escape_string($link, $_POST["fatherName"]) : '';
    $father_occupation = isset($_POST["fatherOccupation"]) ? mysqli_real_escape_string($link, $_POST["fatherOccupation"]) : '';
    $mother_name = isset($_POST["motherName"]) ? mysqli_real_escape_string($link, $_POST["motherName"]) : '';
    $mother_occupation = isset($_POST["motherOccupation"]) ? mysqli_real_escape_string($link, $_POST["motherOccupation"]) : '';
    $family_status = isset($_POST["familystatus"]) ? mysqli_real_escape_string($link, $_POST["familystatus"]) : '';
    $brothers = isset($_POST["noOfBrother"]) ? mysqli_real_escape_string($link, $_POST["noOfBrother"]) : '';
    $brother_married = isset($_POST["brotherMarried"]) ? mysqli_real_escape_string($link, $_POST["brotherMarried"]) : '';
    $sisters = isset($_POST["noOfsister"]) ? mysqli_real_escape_string($link, $_POST["noOfsister"]) : '';
    $sister_married = isset($_POST["sisterMarried"]) ? mysqli_real_escape_string($link, $_POST["sisterMarried"]) : '';
    $address = isset($_POST["address"]) ? mysqli_real_escape_string($link, $_POST["address"]) : '';
    $perm_address = isset($_POST["choseAddress"]) ? mysqli_real_escape_string($link, $_POST["choseAddress"]) : '';
    $citizen_of = isset($_POST["citizenOf"]) ? mysqli_real_escape_string($link, $_POST["citizenOf"]) : '';
    $photo = isset($_POST["photo"]) ? mysqli_real_escape_string($link, $_POST["editphoto"]):'';

    if($perm_address == "same_as_above"){
        $perm_address = $address ;
    }

    // Determine registration status based on whether all fields are filled
    $required_fields = [$profile_for, $gender, $first_name, $last_name, $dob, $country, $state, $email_id, $primary_contact, $whatsapp, $marital_status, $mother_tongue, $caste, $denomination, $height, $weight, $complexion, $last_education, $occupation, $company_name, $annual_income, $work_location,$father_name, $father_occupation, $mother_name, $mother_occupation, $family_status, $brothers, $brother_married, $sisters, $sister_married, $address, $perm_address, $citizen_of,$photo];

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
        // Insert into bnr_user table
        $sql1 = "INSERT INTO bnr_user (bnr_id, profile_created_for, gender, first_name, last_name, date_of_birth, country, state, email_id, contact_number, whatsapp_number, registration_status, created_date) 
                 VALUES ('$bnr_id', '$profile_for', '$gender', '$first_name', '$last_name', '$dob', '$country', '$state', '$email_id', '$primary_contact', '$whatsapp', '$registration_status', now())";

        if (!mysqli_query($link, $sql1)) {
            throw new Exception("Error in bnr_user insert: " . mysqli_error($link));
        }

        // Insert into bnr_user_profile table
        $sql2 = "INSERT INTO bnr_user_profile (bnr_id, marital_status, mother_tongue, caste, denomination, height, weight, complexion, last_education_level, occupation, company_name, annual_income, work_location,  father_name, father_occupation, mother_name, mother_occupation, family_status, number_of_brothers, brother_married, number_of_sisters, sister_married, current_address, permanent_address, citizen_of,photo) 
                 VALUES ('$bnr_id', '$marital_status', '$mother_tongue', '$caste', '$denomination', '$height', '$weight', '$complexion', '$last_education', '$occupation', '$company_name', '$annual_income', '$work_location',  '$father_name', '$father_occupation', '$mother_name', '$mother_occupation', '$family_status', '$brothers', '$brother_married', '$sisters', '$sister_married', '$address', '$perm_address','$citizen_of', '$photo')";

        if (!mysqli_query($link, $sql2)) {
            throw new Exception("Error in bnr_user_profile insert: " . mysqli_error($link));
        }

        // Commit transaction
        mysqli_commit($link);
        echo "New record created successfully";
        
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
