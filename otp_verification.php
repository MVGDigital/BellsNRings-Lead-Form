<?php
include 'admin-login/layouts/config.php';


if(isset($_GET['bnr_id'])) 
{
    echo $bnr_id = $_GET['bnr_id'];
    
	
	function decrypt($data, $key) {
		$cipher = "aes-256-cbc";
		list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
		return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
	}
	
	$decryptedBNRID = decrypt($bnr_id, $encryption_key);
	
	$sql = "SELECT * FROM bnr_user 
	WHERE bnr_id = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("s", $decryptedBNRID);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = array();

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data = $row;
		}
	}
	else
	{
		$_SESSION["errorType"] = "danger";
		$_SESSION["errorMsg"] = "Illegal Try";
		// header("location:index.php");
	}


}
else
{
	$_SESSION["errorType"] = "danger";
	$_SESSION["errorMsg"] = "234 Try";
	header("location:index.php");
}


?>
<?php
function maskMobileNumber($mobileNumber) {
    $mobileNumber = (string) $mobileNumber;
    
    $lastFourDigits = substr($mobileNumber, -4);
    return $lastFourDigits;
}

$email_verification_status = $data['email_verification_status'];
$phone_verification_status = $data['phone_verification_status'];
$whatsapp_verification_status = $data['whatsapp_verification_status'];
$contact_number = $data['contact_number'];
$contact_numberfull = $data['contact_number'];
$contact_number = maskMobileNumber($contact_number);


$whatsapp_number = $data['whatsapp_number'];
$whatsapp_numberfull = $data['whatsapp_number'];
$whatsapp_number = maskMobileNumber($whatsapp_number);

?>
<?php
function maskEmail($email) {
    list($name, $domain) = explode('@', $email);
    
    $nameLength = strlen($name);
    
    $visibleLength = 3;
    
    if ($nameLength <= $visibleLength) {
        return $email;
    }
    
    $lastCharacters = substr($name, -$visibleLength);
    
    $maskedName = str_repeat('*', $nameLength - $visibleLength) . $lastCharacters;
    
    return $maskedName . '@' . $domain;
}

// Example usage
$email = $data['email_id'];
$email_id = maskEmail($email);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandatory Form</title>
    <link rel="shortcut icon" href="./assets/img/bnr-fav.png" type="image/x-icon">

    <!-- Style Files -->
    <link rel="stylesheet" href="./assets/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="./assets/css/intlTelInput.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css"/>
    <link rel="stylesheet" href="./assets/css/custom.css">
    <!-- Style Files -->
</head>
<body>

    <!-- Header Section -->
    <nav class="navbar navbar-light">
        <div class="container-fluid navbar-menu container-space">
          <a class="navbar-brand"><img src="./assets/img/bnr-logo.png" alt=""></a>
          <form class="d-flex menus">
            <a href="https://www.bellsnringsmatrimony.com/">Home</a>
            <a href="https://www.bellsnringsmatrimony.com/about-us">About Us</a>
          </form>
        </div>
    </nav>
    <!-- Header Section -->

    <!-- Main Container -->
    <div class="main-container bg-img">
        <div class="row ml_50 mr_0 form-container">
            <div class="col-md-12 col-lg-3">
                <div class="mt_50 bg-img-content">
                    <h3>And the two shall become one flesh. So they are no longer two but one flesh. - Mark 10:8</h3>
                </div> 
            </div>
            <div class="col-lg-9 mandatoryForm-container">
                <div class="container-space">
                    <div class="title mt_50 mb_40">
                        <h1>STEP 2 of Create Account - Get Verification Code </h1>
                    </div>

                    <!-- Form -->
                    <div class="item-center">
                        <form id="otpVerificationForm" class="col-md-5 col-lg-5 form-section">
                            <h5>Please select your preferred means of verification..<br><br>
                            <label class="error">One verification method is mandatory*</label>
                            </h5>
                            <div class="col-12">
                                <div class="form-field mb-3">
									<input type="hidden" name="bnr_id" id="bnr_id" value="<?php echo $bnr_id; ?>">
                                    <?php if($phone_verification_status != 1) { ?>
									<label for="primaryMobNum-otp">Primary Mobile Number 
                                        <button id="edit-PrimaryNum" class="edit-btn"> <?php echo $contact_numberfull; ?> <img src="./assets/img/edit_ic.svg" alt=""></button></label>
                                    <div class="opt-field">
                                        <div class="fieldWithBtn">
                                            <input type="tel" name="primaryMobNum-otp" id="primaryMobNum-otp" class="enter-otp" placeholder="Enter primary OTP" disabled="disabled" maxlength="4">
                                            <input type="hidden" name="contact_number" id="contact_number" value="<?php echo $contact_numberfull; ?>">
                                            <button id="get-primaryMobNum" class="otp-btn">Get OTP</button>
                                            <button id="verify-primaryMobNum" class="verify-btn">Verify OTP</button>
                                        </div>
                                        <span id="mobOTP-second" class="otp-timer">0.00</span>
                                        <span id="mobOTP-icon" class="verified-icon">
                                            <img src="./assets/img/verify-tick-icon.svg" alt="">
                                        </span>
                                        
                                    </div>
                                    <label id="primaryMobNum-OTPsent" class="success-msg" for="primaryMobNum-otp">
                                        OTP is sent to your mobile number <b id="maskedPrimaryNum">*** <?php echo $contact_number; ?></b>.
                                    </label>
                                    <label id="primaryMobNum-error" class="verify-error" for="primaryMobNum-otp">
                                        Invalid OTP. Please try again.
                                    </label>
									<?php } else { ?>
									<label for="primaryMobNum-otp">Primary Mobile Number 
                                        <button  class="edit-btn">*** <?php echo $contact_number; ?> </button></label>
                                    
									<label id="" class="success-msg" for="email-otp" style="display:block;">
                                        You have successfully verified via SMS
                                    </label>
									<?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div  class="form-field mb-3">
                                    <?php if($whatsapp_verification_status != 1) { ?>
									<label for="whatsappNum-otp">Whatsapp Number<button id="edit-whatsappNum" class="edit-btn"> <?php echo $whatsapp_numberfull; ?>  <img src="./assets/img/edit_ic.svg" alt=""></button></label>
                                    <div class="opt-field">
                                        <div class="fieldWithBtn">
                                            <input type="tel" name="whatsappNum-otp" id="whatsappNum-otp" class="enter-otp" placeholder="Enter whatsapp OTP" disabled="disabled" maxlength="4">
                                            <input type="hidden" name="whatsapp_number" id="whatsapp_number" disabled="disabled" value="<?php echo $whatsapp_numberfull; ?>">
											<button id="get-whatsappNum" class="otp-btn">Get OTP</button>
                                            <button id="verify-whatsappNum" class="verify-btn">Verify OTP</button>
                                        </div>
                                        <span id="whatsappOTP-second" class="otp-timer">0.00</span>
                                        <span id="whatsappOTP-icon" class="verified-icon">
                                            <img src="./assets/img/verify-tick-icon.svg" alt="">
                                        </span>
                                    </div>
                                    <label id="whatsappNum-OTPsent" class="success-msg" for="whatsappNum-otp">
                                        OTP is sent to your whatsapp number <b id="maskedWhatsappNum">*** <?php echo $whatsapp_number; ?>  </b>.
                                    </label>
                                    <label id="whatsappNum-error" class="verify-error" for="whatsappNum-otp">
                                        Invalid OTP. Please try again.
                                    </label>
									<?php } else { ?>
									<label for="whatsappNum-otp">Whatsapp Number<button class="edit-btn">*** <?php echo $whatsapp_number; ?> </button></label>
									<label id="" class="success-msg" for="email-otp" style="display:block;">
                                        You have successfully verified via Whatsapp
                                    </label>
									
									<?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-field mb-3">
									<?php if($email_verification_status != 1) { ?>
									
                                    <label for="email-otp">Email ID : <button id="edit-email" class="edit-btn"><?php echo $email; ?> <img src="./assets/img/edit_ic.svg" alt=""></button></label>
                                    <div class="opt-field">
                                        <div class="fieldWithBtn">
                                            <input type="text" name="email-otp" id="email-otp" class="enter-otp" placeholder="Enter email OTP" disabled="disabled" maxlength="4">
                                            <input type="hidden" name="email_id" id="email_id" value="<?php echo $email; ?>">
                                            <button id="get-email" class="otp-btn">Get OTP</button>
                                            <button id="verify-email" class="verify-btn">Verify OTP</button>
                                        </div>                                
                                        <span id="emailOTP-second" class="otp-timer" >0.00</span>
                                        <span id="emailOTP-icon" class="verified-icon">
                                            <img src="./assets/img/verify-tick-icon.svg" alt="">
                                        </span>
                                    </div>
                                    <label id="email-OTPsent" class="success-msg" for="email-otp">
                                        OTP is sent to your email id <b id="maskedEmail"><?php echo $email_id; ?></b>.
                                    </label>
                                    <label id="email-error" class="verify-error" for="email-otp">Invalid OTP. Please try again.</label>
									<?php } else { ?>
									<label for="email-otp">Email ID : <button class="edit-btn"><?php echo $email_id; ?> </button></label>
									<label id="" class="success-msg" for="email-otp" style="display:block;">
                                        You have successfully verified via email
                                    </label>
									
									<?php } ?>
                                </div>
                            </div>
							<?php if ($email_verification_status == 1 || $phone_verification_status == 1 || $whatsapp_verification_status == 1) { ?>
								<div class="col-12 text-center  mt_30 mb_40">
									<button type="submit" id="veriyBtnSubmit" class="submit_btn">Submit</button>
								</div>
							<?php } else { ?>
								<div class="col-12 text-center  mt_30 mb_40">
									<button type="submit" id="veriyBtnSubmit" class="submit_btn" disabled>Submit</button>
								</div>
							<?php } ?>
                        </form>
                    </div>
                </div>
                <div class="footer">
                    <div class="space-between">
                        <div class="footer-logo">
                            <img src="./assets/img/bnr-logo.png" class="img-fluid" alt="">
                        </div>
                        <div class="footer-info">
                            <h6>For any queries, you can contact us.</h6>
                            <p>95000 58852 / 53 or support@bellsnrings.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Container -->
    <!-- Popup -->
    <div id="popupView" class="popup-container">
        <div class="item-middle popup-height">
            <div class="col-lg-9 item-right">
                <div class="col-lg-7 popup">
                    <div class="col-12 item-right">
                        <img src="./assets/img/close-icon.svg" alt="" class="close-btn">
                    </div>
                    <div class="popup-field">
                        <form action="" id="update_contactInfo">
                            <div id="update-number" class="col-12 col-lg-8 col-md-5 col-sm-12">
                                
                            </div>
                            <div class="spinner">
                                <img class="spinner-gif" src="./assets/img/spinner.gif" alt="">
                                <label class="success-msg">Mobile number updated successfully!</label>
                            </div>
                            <div class="col-12 text-center mt_30">
                                <button type="submit" id="update_num" class="submit_btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popup -->

    <!-- plugin Files -->
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script src="./assets/bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <!-- plugin Files -->
    <script>
	 // Verify OTP Js
    $(".edit-btn").click(function(event){
        event.preventDefault();
        var editbtnId = $(this).attr('id');
        console.log(editbtnId); 
        
        if(editbtnId == "edit-PrimaryNum"){
            $('#popupView').show('slow');

            document.getElementById('update-number').innerHTML = 
            '<input type="hidden" name="dbnr_id" id="dbnr_id" value="<?php echo $decryptedBNRID; ?>">'+
			'<div id="editPrimaryMobNum" class="form-field edit-field mb-3">' +
				'<label for="primaryMobNum">Primary Mobile Number:</label>' +
				'<input type="tel" name="primaryMobNum" id="primaryMobNum" class="mob_number" placeholder="Enter Mobile Number">' +
				'<label id="error-msg" class="error-msg hide"></label>' +
				'<label id="valid-msg" class="valid-msg hide">Valid number</label>' +
			'</div>';

            //update contact info
            const input = document.querySelector(".mob_number");
            const errorMsg = document.querySelector("#error-msg");
            const validMsg = document.querySelector("#valid-msg");

            const errorMap = ["Invalid number", "Invalid country code", "Entered mobile number is too short", "Entered mobile number is too long", "Invalid number"];

            const iti = window.intlTelInput(input, {
                initialCountry: "in",
                nationalMode: false,
                separateDialCode: true,
                showSelectedDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
            });

            const reset = () => {
                input.classList.remove("error");
                errorMsg.innerHTML = "";
                errorMsg.classList.add("hide");
                validMsg.classList.add("hide");
            };

            const showError = (msg) => {
                input.classList.add("error");
                errorMsg.innerHTML = msg;
                errorMsg.classList.remove("hide");
            };

            // Validate on button click
            input.addEventListener('blur', () => {
                reset();
                if (!input.value.trim()) {
                    showError("");
                } else if (iti.isValidNumber()) {
                    validMsg.classList.remove("hide");
                } else {
                    const errorCode = iti.getValidationError();
                    const msg = errorMap[errorCode] || "Invalid number";
                    showError(msg);
                }
            });

            // Reset validation messages on change or keyup
            input.addEventListener('change', reset);
            input.addEventListener('keyup', reset);

            // Get the input field and initialize the intlTelInput instance
            input.addEventListener("input", function(e) {
                // Get the entered value
                let inputValue = e.target.value;
            
                // Remove any non-numeric characters
                inputValue = inputValue.replace(/[^\d+]/g, '');
            
                // Update the input field value with only numeric characters
                e.target.value = inputValue;
                // Get the selected country's data
            });
            $('#update_contactInfo').validate({
                rules: {
                    primaryMobNum: {
                        required: true,
                        // Add more rules as needed
                    },
                },
                messages: {
                    primaryMobNum: {
                        required: "Please enter your primary mobile number"
                        // Add more messages for specific rules as needed
                    },
                },
                submitHandler: function(form) {
                    // If form is valid, handle submission here
                    event.preventDefault();

                    // You can access the values of fields using jQuery
                    var primarryNum_phoneNumber = $("#primaryMobNum").val();

                    // Get the selected country code
                    var primarryNum_countryCode = iti.getSelectedCountryData().dialCode;
                    var primarryNumber = "+" + primarryNum_countryCode + primarryNum_phoneNumber;
                    $("#primaryMobNum").val(primarryNumber);
                    

                    // Now create the FormData object
                    const formData = new FormData(form);
                    formData.set('primaryMobNum', primarryNumber);
                    
                    console.log(FormData);

                    new FormData(form).forEach((value, key) => {
                        formData[key] = value;
                    });

                    $(".spinner-gif").show();
                    
                    setTimeout(function() {
                    //     $(".spinner-gif").hide();
                    //     $(".success-msg").show();
                    //     // Hide the success message after 2 seconds
                    //     setTimeout(function() {
                    //         $(".success-msg").hide();
                    //         $('#popupView').hide('slow')
                    //     }, 2000);
                    // }, 2000);
                    $.ajax({
                            type: "POST",
                            url: "updated_pno.php", // Adjust URL as needed
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $(".spinner-gif").hide();
                                $(".success-msg").show();
                                setTimeout(function() {
                                    $(".success-msg").hide();
                                    $('#popupView').hide('slow');
                                }, 2000);
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }, 2000);
                },
            });
           
        }else if(editbtnId == "edit-whatsappNum"){
            $('#popupView').show('slow');

            document.getElementById('update-number').innerHTML = 
				'<input type="hidden" name="dbnr_id" id="dbnr_id" value="<?php echo $decryptedBNRID; ?>">'+
                '<div id="editWhatsappNum" class="form-field edit-field mb-3">' +
					'<label for="whatsappNum">Whatsapp Number:</label>' +
					'<input type="tel" name="whatsappNum" id="whatsappNum" class="mob_number" placeholder="Enter whatsapp Number">' +
					'<label id="error-msg" class="error-msg hide"></label>' +
					'<label id="valid-msg" class="valid-msg hide">Valid number</label>' +
				'</div>';

                //update contact info
                const input = document.querySelector(".mob_number");
                const errorMsg = document.querySelector("#error-msg");
                const validMsg = document.querySelector("#valid-msg");

                const errorMap = ["Invalid number", "Invalid country code", "Entered mobile number is too short", "Entered mobile number is too long", "Invalid number"];

                const iti = window.intlTelInput(input, {
                    initialCountry: "in",
                    nationalMode: false,
                    separateDialCode: true,
                    showSelectedDialCode: true,
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
                });

                const reset = () => {
                    input.classList.remove("error");
                    errorMsg.innerHTML = "";
                    errorMsg.classList.add("hide");
                    validMsg.classList.add("hide");
                };

                const showError = (msg) => {
                    input.classList.add("error");
                    errorMsg.innerHTML = msg;
                    errorMsg.classList.remove("hide");
                };

                // Validate on button click
                input.addEventListener('blur', () => {
                    reset();
                    if (!input.value.trim()) {
                        showError("");
                    } else if (iti.isValidNumber()) {
                        validMsg.classList.remove("hide");
                    } else {
                        const errorCode = iti.getValidationError();
                        const msg = errorMap[errorCode] || "Invalid number";
                        showError(msg);
                    }
                });

                // Reset validation messages on change or keyup
                input.addEventListener('change', reset);
                input.addEventListener('keyup', reset);

                // Get the input field and initialize the intlTelInput instance
                input.addEventListener("input", function(e) {
                    // Get the entered value
                    let inputValue = e.target.value;
                
                    // Remove any non-numeric characters
                    inputValue = inputValue.replace(/[^\d+]/g, '');
                
                    // Update the input field value with only numeric characters
                    e.target.value = inputValue;
                    // Get the selected country's data
                });
                $('#update_contactInfo').validate({
                    rules: {
                        primaryMobNum: {
                            required: true,
                            // Add more rules as needed
                        },
                    },
                    messages: {
                        primaryMobNum: {
                            required: "Please enter your primary mobile number"
                            // Add more messages for specific rules as needed
                        },
                    },
                    submitHandler: function(form) {
                        // If form is valid, handle submission here
                        event.preventDefault();

                        var whatsappNum_countryCode = iti.getSelectedCountryData().dialCode;
                        var whatsappNum_phoneNumber = $("#whatsappNum").val();
                        var whatsappNumNumber = "+" + whatsappNum_countryCode + whatsappNum_phoneNumber;
                        $("#whatsappNum").val(whatsappNumNumber);

                        // Now create the FormData object
                        const formData = new FormData(form);
                        formData.set('whatsappNum', whatsappNumNumber); 
                        
                        console.log(FormData);

                        new FormData(form).forEach((value, key) => {
                            formData[key] = value;
                        });

                        $(".spinner-gif").show();
                        setTimeout(function() {
                            $.ajax({
                            type: "POST",
                            url: "update_whatsappnum.php", // Adjust URL as needed
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $(".spinner-gif").hide();
                                $(".success-msg").show();
                                setTimeout(function() {
                                    $(".success-msg").hide();
                                    $('#popupView').hide('slow');
                                }, 2000);
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }, 2000);
                    },
                });
        }else if(editbtnId == "edit-email"){
            $('#popupView').show('slow');
            document.getElementById('update-number').innerHTML = 
            '<input type="hidden" name="dbnr_id" id="dbnr_id" value="<?php echo $decryptedBNRID; ?>">'+
				'<div id="editEmail" class="form-field edit-field mb-3">' +
					'<label for="email">Email ID:</label>' +
					'<input type="text" name="email" id="email" placeholder="Enter email">' +
				'</div>';

                // Add custom email validation method
                $.validator.addMethod("customEmail", function(value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(value);
                }, "Please enter a valid email address");
                $('#update_contactInfo').validate({
                    rules: {
                        email: {
                            required: true,
                            customEmail: true
                            // Add more rules as needed
                        },
                    },
                    messages: {
                        email: {
                            required: "Please enter email",
                            customEmail: "Please enter a valid email address"
                            // Add more messages for specific rules as needed
                        },
                    },
                    submitHandler: function(form) {
                        // If form is valid, handle submission here
                        event.preventDefault();

                        // Now create the FormData object
                        const formData = new FormData(form);
                        console.log(FormData);

                        new FormData(form).forEach((value, key) => {
                            formData[key] = value;
                        });

                        $(".spinner-gif").show();
                        setTimeout(function() {
                            $.ajax({
                            type: "POST",
                            url: "update_email.php", // Adjust URL as needed
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $(".spinner-gif").hide();
                                $(".success-msg").show();
                                setTimeout(function() {
                                    $(".success-msg").hide();
                                    $('#popupView').hide('slow');
                                }, 2000);
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }, 2000);
                    },
                });
        }else{
            console.log("Something Wrong!");
        }   
    });
    $(".close-btn").click(function(){
        $('#popupView').hide('slow');
    });

    /* Sent OTP Button */
    var primaryMobNumOTP = $('#primaryMobNum-otp');
    var whatsappNumOTP = $('#whatsappNum-otp');
    var emailOTP = $('#email-otp');

    $(primaryMobNumOTP).on('input', function() {
        // Remove non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
        console.log(this.value);
        if(this.value.length === 4){
            $('#get-primaryMobNum').hide();
            $('#verify-primaryMobNum').show();

        }else{
            //$('#get-primaryMobNum').hide();
            $('#verify-primaryMobNum').show();
        }
    });
    $(whatsappNumOTP).on('input', function() {
        // Remove non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
        if(this.value.length === 4){
            $('#get-whatsappNum').hide();
            $('#verify-whatsappNum').show();

        }else{
            $('#verify-whatsappNum').show();
        }
    });
    $(emailOTP).on('input', function() {
        // Remove non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
        if(this.value.length === 4){
            $('#get-email').hide();
            $('#verify-email').show();

        }else{
            $('#verify-email').show();
        }
    });

    /* Sent OTP Button */

    $(".otp-btn").click(function(event){
        event.preventDefault();

        var getOTPBtnIdm = $(this).attr('id');
        if(getOTPBtnIdm == "get-primaryMobNum"){
			var contact_number = $("#contact_number").val();
			$.ajax({
				url: 'sendsms.php',
				type: 'POST',
				data: {contact_number: contact_number},
				dataType: 'json',
				success: function(response) {
					if (response.message === 'OTP sent successfully') {
						$('#primaryMobNum-OTPsent').show();
                        setTimeout(() => {
                            function countdown() {
                                var counter = $("#mobOTP-second");
                                var getPrimaryMobOTP = $('#get-primaryMobNum')
                                var seconds = 60;
                                $(counter).show();
                                $(getPrimaryMobOTP).attr("disabled", "disabled");

                                    function tick() {
                                        seconds--;
                                        counter.text("0:" + (seconds < 10 ? "0" : "") + seconds);
                                        if (seconds > 0) {
                                            timer = setTimeout(tick, 1000);
                                            $('#edit-PrimaryNum').attr("disabled", "disabled");
                                        } else {
                                            $(getPrimaryMobOTP).text("Resend");
                                            $(getPrimaryMobOTP).removeAttr("disabled", "disabled");
                                            $("#primaryMobNum-otp").attr("disabled", "disabled");
                                            $('#edit-PrimaryNum').removeAttr("disabled", "disabled");
                                            $(counter).hide();
                                            $('#verify-primaryMobNum').hide();
                                            $('#get-primaryMobNum').show();
                                            $('#primaryMobNum-error').hide();
                                        }
                                    }
                                    tick();
                            }
                            countdown();
                        }, 2000);
						var maskedPrimaryNum = "";
						$("#maskedPrimaryNum").text(maskedPrimaryNum);

						$('#primaryMobNum-otp').removeAttr("disabled", "disabled");
						$("#primaryMobNum-OTPsent").fadeIn('slow');
						setTimeout(function(){
							$("#primaryMobNum-OTPsent").fadeOut('slow');
						},5000);   
						startCountdown('#mobOTP-second', '#get-primaryMobNum', '#edit-PrimaryNum', '#verify-primaryMobNum');
					} else {
						console.error("Failed to send OTP");
						
					}
				},
				error: function(response) {
					console.error("Error occurred while sending OTP");
				}
			});
        }
		else if(getOTPBtnIdm == "get-whatsappNum"){
			
			var whatsapp_number = $("#whatsapp_number").val();
			$.ajax({
				url: 'sendwatsapp.php',
				type: 'POST',
				data: {
					whatsapp_number: whatsapp_number
				},
				dataType: 'json',
				success: function(response) {
					if (response.message === 'OTP sent successfully') {
						$('#whatsappNum-OTPsent').show();
						setTimeout(() => {
                            function countdown() { 
                                var getWhatsappOTP = $("#get-whatsappNum");               
                                var counter = $("#whatsappOTP-second");

                                var seconds = 60;
                                $(counter).show();
                                $(getWhatsappOTP).attr("disabled", "disabled");

                                    function tick() {
                                        seconds--;
                                        counter.text("0:" + (seconds < 10 ? "0" : "") + seconds);
                                        if (seconds > 0) {
                                            setTimeout(tick, 1000);
                                            $('#edit-whatsappNum').attr("disabled", "disabled");
                                        } else {
                                            $(getWhatsappOTP).text("Resend");
                                            $(getWhatsappOTP).removeAttr("disabled", "disabled");
                                            $("#whatsappNum-otp").attr("disabled", "disabled");
                                            $('#edit-whatsappNum').removeAttr("disabled", "disabled");
                                            $(counter).hide();
                                            $('#verify-whatsappNum').hide();
                                            $('#get-whatsappNum').show();
                                            $('#whatsappNum-error').hide();
                                        }
                                    }
                                    tick();
                            }
                            countdown();
                        }, 2000);
						var maskedWhatsappNum = "";
						var maskedWhatsappNum = maskedWhatsappNum.substring(0, maskedWhatsappNum.indexOf("@")).replace(/.(?=.{3})/g, "*") + maskedWhatsappNum.substring(maskedWhatsappNum.indexOf("@"));
						$("#maskedWhatsappNum").text(maskedWhatsappNum);
						
						$('#whatsappNum-otp').removeAttr("disabled", "disabled");
						$("#whatsappNum-OTPsent").fadeIn('slow');
						setTimeout(function(){
							$("#whatsappNum-OTPsent").fadeOut('slow');
						},5000); 
						
						startCountdown('#mobOTP-second', '#get-primaryMobNum', '#edit-PrimaryNum', '#verify-primaryMobNum');
					} else {
						console.error("Failed to send OTP");
						
					}
				},
				error: function(response) {
					console.error("Error occurred while sending OTP");
				}
			});
        }
		else if(getOTPBtnIdm == "get-email"){
			var email_id = $("#email_id").val();
			$.ajax({
				url: 'sendemail.php',
				type: 'POST',
				data: {
					email_id: email_id
				},
				dataType: 'json',
				success: function(response) {
					if (response.message === 'OTP sent successfully') 
					{
						$('#email-OTPsent').show();
						setTimeout(() => {
                            function countdown() {
                                var getEmailOTP = $("#get-email");
                                var counter = $("#emailOTP-second");
                                var seconds = 60;
                                $(counter).show();
                                $(getEmailOTP).attr("disabled", "disabled");

                                    function tick() {
                                        seconds--;
                                        counter.text("0:" + (seconds < 10 ? "0" : "") + seconds);
                                        if (seconds > 0) {
                                            setTimeout(tick, 1000);
                                            $('#edit-email').attr("disabled", "disabled");
                                        } else {
                                            $(getEmailOTP).text("Resend");
                                            $(getEmailOTP).removeAttr("disabled", "disabled");
                                            $("#email-otp").attr("disabled", "disabled");
                                            $('#edit-email').removeAttr("disabled", "disabled");
                                            $(counter).hide();
                                            $('#verify-email').hide();
                                            $('#get-email').show();
                                            $('#email-error').hide();
                                        }
                                    }
                                    tick();
                            }
                            countdown();
                        }, 2000);
						$('#email-otp').removeAttr("disabled", "disabled");
						$("#email-OTPsent").fadeIn('slow');
						
						setTimeout(function(){
							$("#email-OTPsent").fadeOut('slow');
						},5000);   
						startCountdown('#mobOTP-second', '#get-primaryMobNum', '#edit-PrimaryNum', '#verify-primaryMobNum');
					} else {
						console.error("Failed to send OTP");
						
					}
				},
				error: function(response) {
					console.error("Error occurred while sending OTP");
				}
			});
        }
    });
	
	
	$('#email-otp').on('input', function() {
		var otp = $(this).val();
		if (otp.length === 4) {
			var identifier = 'email'; 
            $('<input>').attr({
                type: 'hidden',
                id: 'identifier',
                name: 'identifier',
                value: identifier
            }).appendTo('#otpVerificationForm');
			
			$('#otpVerificationForm').submit();
		}
	});
	
	$('#whatsappNum-otp').on('input', function() {
		var otp = $(this).val();
		if (otp.length === 4) {
			var identifier = 'whatsapp'; 
            $('<input>').attr({
                type: 'hidden',
                id: 'identifier',
                name: 'identifier',
                value: identifier
            }).appendTo('#otpVerificationForm');
			
			$('#otpVerificationForm').submit();
		}
	});
	
	$('#primaryMobNum-otp').on('input', function() {
		var otp = $(this).val();
		if (otp.length === 4) {
			var identifier = 'sms'; 
            $('<input>').attr({
                type: 'hidden',
                id: 'identifier',
                name: 'identifier',
                value: identifier
            }).appendTo('#otpVerificationForm');
			
			$('#otpVerificationForm').submit();
		}
	});
	
	
	
	$('#otpVerificationForm').on('submit', function(event){
		event.preventDefault(); 
		var bnr_id = $('#bnr_id').val();
		var otp = $('#email-otp').val();
		var wotp = $('#whatsappNum-otp').val();
		var smsotp = $('#primaryMobNum-otp').val();
		var identifier = $('#identifier').val();
		var email_id = $("#email_id").val();
		$.ajax({
			url: 'verify_otp.php',
			type: 'POST',
			data: { otp: otp,bnr_id: bnr_id,identifier: identifier,wotp: wotp,smsotp: smsotp },
			dataType: 'json',
			success: function(response) 
			{
				if (response.message === 'Email OTP Verified successfully') 
				{
					$('#emailOTP-icon').show();
					$('#email-error').hide();
					$('#verify-email').hide();
					$('#emailOTP-second').hide();
					setTimeout(function() {
						location.reload();
					}, 5000);

				} 
				else if (response.message === 'Whatsapp OTP Verified successfully') 
				{
					$('#whatsappOTP-icon').show();
					$('#whatsappNum-error').hide();
					$('#verify-whatsappNum').hide();
					$('#whatsappOTP-second').hide();
					setTimeout(function() {
						location.reload();
					}, 5000);

				} 
				else if (response.message === 'SMS OTP Verified successfully') 
				{
					$('#mobOTP-icon').show();
					$('#primaryMobNum-error').hide();
					$('#verify-primaryMobNum').hide();
					$('#mobOTP-second').hide();
					setTimeout(function() {
						location.reload();
					}, 5000);

				} 
				else if (response.message === 'Whatsapp Failed to verify OTP') 
				{
					$('#whatsappOTP-icon').hide();
					$('#whatsappNum-error').show();
					$('#verify-whatsappNum').show();
					$('#whatsappOTP-second').hide();

				} 
				else 
				{
					$('#email-error').show();
					$('#emailOTP-icon').hide();
					
				}
			},
			error: function() {
				$('#email-error').show();
				$('#emailOTP-icon').hide();
			}
		});
	});
	
	$("#veriyBtnSubmit").click(function(event){
		var bnr_id = $('#bnr_id').val();
		$.ajax({
			url: 'completemandatoryform.php',
			type: 'POST',
			dataType: 'json',
			data: { bnr_id: bnr_id},
			success: function(response) 
			{
				window.location.href = 'success.php?bnr_id=' + encodeURIComponent(bnr_id);

			},
			error: function() {
				
			}
		});
	});
	
	</script>
</body>
</html>