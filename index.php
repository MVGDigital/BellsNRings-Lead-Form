<?php   
	include 'admin-login/layouts/config.php';
	$eve_id = isset($_GET['eve_id']) ? $_GET['eve_id'] : '';
	

	function generateBNRID($link) 
	{
		$query = "SELECT MAX(bnr_id) AS last_id FROM bnr_user";
		$result = mysqli_query($link, $query);

		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$lastID = $row['last_id'];

			$lastNumber = (int)substr($lastID, 3);

			$nextNumber = $lastNumber + 1;

			$nextID = 'BNR' . str_pad($nextNumber, strlen($lastID) - 3, '0', STR_PAD_LEFT);

			return $nextID;
		} else {
			echo "Error: " . mysqli_error($link);
			return null;
		}
	}

	//$bnr_id = generateBNRID($link);
//include 'admin-login/layouts/config.php';

	function encrypt($data, $key) {
		$cipher = "aes-256-cbc"; 
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher)); 
		$encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv); 
		return base64_encode($encrypted . '::' . $iv); 
	}

    // Initialize bnr_id variable
$bnr_id = '';

    if (isset($_COOKIE['formData'])) {
        $cookieData = $_COOKIE['formData'];
    
        $formData = json_decode($cookieData, true);
    
        if (isset($formData['bnr_id'])) {
            $bnr_id = $formData['bnr_id'];
        } 
    
	//$encryptedBNRID = encrypt($bnr_id, $encryption_key);
} else {
    // $encryptedBNRID ='';
    //$encryptedBNRID = encrypt($bnr_id, $encryption_key);
    $bnr_id = generateBNRID($link);
}
$encryptedBNRID = encrypt($bnr_id, $encryption_key);
// echo $encryptedBNRID;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>BNR Lead Form - Mandatory</title>
    <link rel="shortcut icon" href="./assets/img/bnr-fav.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/select2.min.css"/>
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css"/>
    <link rel="stylesheet" href="./assets/css/custom.css">
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
                        <h1>STEP 1 of Create Account </h1>
                    </div>

                    <!-- Form -->
					<?php if ($ERROR_MSG <> "") { ?>
						<p class="text-danger errormessage" role="alert"><?php echo $ERROR_MSG; ?></p>
					<?php } ?>
                    <form id="mandatoryForm" name="mandatoryForm" class="form-section" method="POST" action="createprocess.php" enctype="multipart/form-data">
                    <?php //echo $eve_id; ?>
                    <input type="hidden" id="bnr_id" name="bnr_id" value="<?php echo $bnr_id; ?>">
                        <input type="hidden" id="qr_id" name="qr_id" value="<?php echo $eve_id; ?>">
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <label for="profile_created_for">Profile Created for <span class="requirdField" >*</span></label>
                                <select id="profile_created_for" class="form-select" name="profile_created_for">
                                    <option value="">Select Profile</option>
                                    <option value="myself">Myself</option>
                                    <option value="son">Son</option>
                                    <option value="daughter">Daughter</option>
                                    <option value="sister">Sister</option>
                                    <option value="brother">Brother</option>
                                    <option value="relative">Relative</option>
                                    <option value="friend">Friend</option>
                                </select>
                                  <!-- <span id="profilefor-error" class="error-message">This field is required.</span> -->
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <label for="gender">Select Gender <span class="requirdField" >*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="male" name="gender" value="male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check genderErr">
                                    <input class="form-check-input" type="radio" id="female" name="gender" value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <label for="first_name">First Name <span class="requirdField" >*</span></label>
                                <input type="text" id="first_name" name="first_name" placeholder="Enter first name">
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <label for="last_name">Last Name <span class="requirdField" >*</span></label>
                                <input type="text" id="last_name" name="last_name" placeholder="Enter last name">
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <label for="date_of_birth">Select Date of Birth <span class="requirdField" >*</span></label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-select datepic" placeholder="Enter DOB">
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <label for="country">Currently Residing In Country <span class="requirdField" >*</span></label>
                                <select id="country" class="form-select" name="country"></select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <label for="state">Currently Residing In State <span class="requirdField" >*</span></label>
                                <select id="state" name="state" class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <label for="email_id">Email ID <span class="requirdField" >*</span></label>
                                <input type="text" id="email_id" name="email_id" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <label for="contact_number">Primary Mobile Number <span class="requirdField" >*</span></label>
                                <input type="tel" id="contact_number" name="contact_number" class="mob_number" placeholder="Enter Mobile Number">
                                <label for="contact_number" id="error-msg" class="error-msg hide"></label>
                                <label for="contact_number" id="valid-msg" class="valid-msg hide">Valid number</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <label for="chooseNum">Whatsapp Number below is <span class="requirdField" >*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="sameNumber" name="chooseNum" value="sameNumber" checked>
                                    <label class="form-check-label" for="sameNumber">Same as primary number</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="differentNumber" name="chooseNum" value="differentNumber">
                                    <label class="form-check-label" for="differentNumber">Different than primary number</label>
                                </div>
                            </div>
                        </div>
                        <div id="addNewNumber" class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            
                        </div>
                        <div class="col-12 col-lg-5 col-md-5 col-sm-12 mb-3">
                            <div class="form-field">
                                <div class="g-recaptcha" data-sitekey="6Lel4Z4UAAAAAOa8LO1Q9mqKRUiMYl_00o5mXJrR"></div>
                            </div>
                            
                        </div>

                        <div class="col-12 text-center  mt_30 mb_40">
                            <button type="submit" class="submit_btn">Submit & Continue</button>
                        </div>
                    </form>
                    <!-- Form -->
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
	<script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script src="./assets/bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <script src="./assets/js/select2.min.js"></script>
    <script src="./assets/js/country_code.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/recaptcha.api.js" async defer></script>
	<script>
    
	$(document).ready(function() {
        // Initialize select2
        $("#profile_created_for").select2({
            placeholder: "Select profile for",
            allowClear: true,
            minimumResultsForSearch: Infinity
        });

        $("#country").select2({
            placeholder: "Select country",
            allowClear: true
        });
        $("#state").select2({
            placeholder: "Select state",
            allowClear: true
        });



		/* $('#country').select2({
			placeholder: 'Select Country',
			allowClear: true,
			ajax: {
				url: 'getcountry.php',
				dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term 
                    };
                },
				processResults: function(data) {
					console.log(data);
					return {
						results: data.map(function(item) {
							return {
								id: item.id,
								text: item.text
							};
						})
					};
				},
				error: function(xhr, textStatus, errorThrown) {
					console.error('Error fetching country data:', errorThrown);
				}
			}
		}); */	
	});
	
	/* var formDataCookie = getCookie('formData');

	if (formDataCookie) {
		var formData = JSON.parse(formDataCookie);
		var selectedCountryId = formData.country;
		if (selectedCountryId) {
			$.ajax({
				type: 'GET',
				url: 'getcountry.php?term=' + selectedCountryId,
				dataType: 'json', 
			}).then(function(data) {
				var countryData = data[0];
				var option = new Option(countryData.text, countryData.id, true, true);
				$('#country').append(option).trigger('change');
				$('#country').trigger({
					type: 'select2:select',
					params: {
						data: countryData
					}
				});
			});
			$('#country').on('select2:loaded', function() {
				$(this).val(selectedCountryId).trigger('select2:select');
			});
		}
		
		var selectedstateId = formData.state;
		if (selectedstateId) {
			$.ajax({
				type: 'GET',
				url: 'getstate.php?term=' + selectedCountryId,
				dataType: 'json', 
			}).then(function(data) {
				var countryData = data[0];
				var option = new Option(countryData.text, countryData.id, true, true);
				$('#state').append(option).trigger('change');
				$('#state').trigger({
					type: 'select2:select',
					params: {
						data: countryData
					}
				});
			});
			$('#state').on('select2:loaded', function() {
				$(this).val(selectedstateId).trigger('select2:select');
			});
		}
	}
		
	$("#state").select2({
		placeholder: "Select state",
		allowClear: true,
	});
	
	$('#country').on('change', function() {
		var country = $(this).val();
		$('#state').select2({
			placeholder: 'Select State',
			allowClear: true,
			ajax: {
				url: 'getstate.php?term=' + country,
				dataType: 'json',
				processResults: function(data) {
					console.log(data);
					return {
						results: data.map(function(item) {
							return {
								id: item.id,
								text: item.text
							};
						})
					};
				},
				error: function(xhr, textStatus, errorThrown) {
					console.error('Error fetching state data:', errorThrown);
				}
			}
		});
	}); */

	$(document).ready(function () {
		function saveFormData(autoSave = false) {
			const formData = $('#mandatoryForm').serialize() + '&autoSave=' + autoSave;
			$.ajax({
				type: 'POST',
				url: 'save_form_data.php',
				data: formData,
				success: function (response) {
					console.log(response);
				}
			});
		}

		$('#mandatoryForm').on('submit', function (e) {
			e.preventDefault();
			saveFormData();
		});

        $('#mandatoryForm').on('change', 'input, select', function () {

            // Helper function to format the phone number with the country code
            function formatPhoneNumber(countryCode, phoneNumber) {
                phoneNumber = phoneNumber || "";
                if (!phoneNumber.startsWith("+" + countryCode)) {
                    return "+" + countryCode + " " + phoneNumber;
                }
                return phoneNumber;
            }

            // Helper function to extract the local phone number (without country code)
            function extractLocalPhoneNumber(phoneNumber) {
                return phoneNumber.replace(/^\+\d+\s/, ''); // Remove the country code
            }

            // Get the selected country code and phone numbers for the primary number
            var primaryNum_countryCode = iti.getSelectedCountryData().dialCode;
            var primaryNum_phoneNumber = $("#contact_number").val();
            var primaryNumber = formatPhoneNumber(primaryNum_countryCode, primaryNum_phoneNumber);
            var localPrimaryNumber = extractLocalPhoneNumber(primaryNumber);
            $("#contact_number").val(localPrimaryNumber); // Show only the local number

            // Check if the WhatsApp number should be the same as the primary number
            var selectedValue = $('input[name="chooseNum"]:checked').val();
            var whatsappNumNumber;

            if (selectedValue === "sameNumber") {
                whatsappNumNumber = primaryNumber;
            } else {
                var whatsappNum_countryCode = iti.getSelectedCountryData().dialCode;
                var whatsappNum_phoneNumber = $("#whatsapp_number").val();
                whatsappNumNumber = formatPhoneNumber(whatsappNum_countryCode, whatsappNum_phoneNumber);
                var localWhatsappNumber = extractLocalPhoneNumber(whatsappNumNumber);
                $("#whatsapp_number").val(localWhatsappNumber); // Show only the local number
            }

            // Store the full numbers with country code internally
            $("#contact_number").data('fullNumber', primaryNumber);
            $("#whatsapp_number").data('fullNumber', whatsappNumNumber);

            // Now create the FormData object
            const form = document.getElementById('mandatoryForm'); // Ensure 'form' is correctly referenced
            const formData = new FormData(form);
            formData.set('contact_number', primaryNumber);
            formData.set('whatsapp_number', whatsappNumNumber);

            // Convert FormData to JSON
            let formDataJson = {};
            formData.forEach((value, key) => {
                formDataJson[key] = value;
            });

            console.log(formDataJson);

            // Save the form data
            saveFormData(true);
        });

		loadSavedData();
	});

	function loadSavedData() {
    let formData = getCookie('formData');
    if (formData) {
        formData = JSON.parse(formData);
        $.each(formData, function (key, value) {
            if (key === 'gender') {
                $('input[name="gender"][value="' + value + '"]').prop('checked', true);
            } else if (key === 'country') {
                $('#country').val(value).trigger('change'); // Update select2
            } else if (key === 'state') {
                $('#state').val(value).trigger('change'); // Update select2
            } else {
                $('#' + key).val(value);
            }
        });
    } else {
        const bnr_id = getCookie('bnr_id');
        if (bnr_id) {
            $.ajax({
                type: 'POST',
                url: 'load_form_data.php',
                data: { bnr_id: bnr_id },
                success: function (response) {
                    const data = JSON.parse(response);
                    $.each(data, function (key, value) {
                        if (key === 'gender') {
                            $('input[name="gender"][value="' + value + '"]').prop('checked', true);
                        } else if (key === 'country') {
                            $('#country').val(value).trigger('change'); // Update select2
                        } else if (key === 'state') {
                            $('#state').val(value).trigger('change'); // Update select2
                        } else {
                            $('#' + key).val(value);
                        }
                    });
                }
            });
        }
    }
}


	function setCookie(name, value, days) {
		const d = new Date();
		d.setTime(d.getTime() + (days*24*60*60*1000));
		const expires = "expires="+ d.toUTCString();
		document.cookie = name + "=" + value + ";" + expires + ";path=/";
        console.log(name + "=" + value);
	}

	function getCookie(name) {
		const cname = name + "=";
		const decodedCookie = decodeURIComponent(document.cookie);
		const ca = decodedCookie.split(';');
		for (let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(cname) == 0) {
				return c.substring(cname.length, c.length);
			}
		}
		return "";
	}

    function deleteCookie(name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;';
    }
</script>

<script>
    function validateDOB() {
        var dobInput = document.getElementById('date_of_birth').value;
        var dob = new Date(dobInput);
        var minAgeDate = new Date();
        minAgeDate.setFullYear(minAgeDate.getFullYear() - 18); // Subtract 18 years

        if (dobInput && dob < minAgeDate) {
            return true; // Valid Date of Birth
        } else {
            return false; // Invalid Date of Birth
        }
    }

    var maxDOB = new Date();
    maxDOB.setFullYear(maxDOB.getFullYear() - 18);
    var formattedMaxDOB = maxDOB.toISOString().substr(0, 10);
    document.getElementById('date_of_birth').setAttribute('max', formattedMaxDOB);

    var minDOB = new Date();
    minDOB.setFullYear(minDOB.getFullYear() - 60);
    var formattedMinDOB = minDOB.toISOString().substr(0, 10);
    document.getElementById('date_of_birth').setAttribute('min', formattedMinDOB);

    const firstName = document.querySelector('#first_name');
    firstName.addEventListener('input', function(e) {
        var val = `${e.target.value}`;
        //console.log(val);
    });

    var onloadCallback = function() {
        alert("grecaptcha is ready!");
    };

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

    input.addEventListener('blur', () => {
        reset();
        if (!input.value.trim()) {
            showError("");
        } else if (iti.isValidNumber()) {
            validMsg.classList.remove("hide");
            setTimeout(function() {
                validMsg.classList.add("hide");
            }, 3000);
        } else {
            const errorCode = iti.getValidationError();
            const msg = errorMap[errorCode] || "Invalid number";
            showError(msg);
        }
    });

    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);

    input.addEventListener("input", function(e) {
        let inputValue = e.target.value;

        inputValue = inputValue.replace(/[^\d+]/g, '');

        e.target.value = inputValue;
    });

    $('#profile_created_for').on('change', function() {
            var profileFor = $(this).val();
            $('#profileFor-error').hide(); // Hide error message if the field is not empty
                if(profileFor === 'daughter'|| profileFor === 'sister'){
                    $("#male").prop("disabled", true); 
                    $("#female").prop("disabled", false);
                    $("#female").prop("checked", true);
                    $('#gender-error').hide();
                }else if(profileFor === 'son'|| profileFor === 'brother'){
                    $("#female").prop("disabled", true); 
                    $("#male").prop("disabled", false);
                    $("#male").prop("checked", true);
                    $('#gender-error').hide();
                }else if(profileFor == ''){
                    $("#female").prop("checked", false); 
                    $("#male").prop("checked", false);
                }else{
                    $("#female").prop("disabled", false);
                    $("#male").prop("disabled", false);
                    $("#male").prop("checked", false);
                    $("#female").prop("checked", false);
                    /* $('#gender-error').hide(); */
                }
    });
    
    //Date of Birth
    const dob = document.querySelector("#dob");
    $(dob).on('change', function(){
        if (dob == '') {
			$('#dob-error').show();
        } else {
            $('#dob-error').hide();
        }
    });

    $('input[name="chooseNum"]').change(function() {
        var selectedValue = $('input[name="chooseNum"]:checked').val();
        if (selectedValue === 'differentNumber') {
            $('#addNewNumber').show();            
            document.getElementById('addNewNumber').innerHTML = 
                '<div class="form-field">' +
                    '<label for="whatsapp_number">Whatsapp Number <span class="requirdField">*</span></label>' +
                    '<input type="tel" id="whatsapp_number" name="whatsapp_number" class="mob_number" placeholder="Enter whatsapp Number">' +
                    '<label id="whatsapp-error-msg" class="error-msg hide"></label>' +
                    '<label id="whatsapp-valid-msg" class="valid-msg hide">Valid number</label>' +
                '</div>';

            
                const mobNumber = document.querySelector("#whatsapp_number");
                const input = document.querySelector("#whatsapp_number");
                const errorMsg = document.querySelector("#whatsapp-error-msg");
                const validMsg = document.querySelector("#whatsapp-valid-msg");

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
                mobNumber.addEventListener("input", function(e) {
                    // Get the entered value
                    let inputValue = e.target.value;
                
                    // Remove any non-numeric characters
                    inputValue = inputValue.replace(/[^\d+]/g, '');
                
                    // Update the input field value with only numeric characters
                    e.target.value = inputValue;
                    // Get the selected country's data
                });

            } else {
                // Clear the address field if "Same as above" is selected
                console.log("not woking!");
                $('#addNewNumber').hide();
                document.getElementById('addNewNumber').innerHTML = '';
        }
    });
		setTimeout(function () {
			$('.errormessage').hide();
			$('.errormessage').html();
		}, 3000);
		
        $('#first_name,#last_name').on('input', function() {
            var input = $(this).val();
            var regex = /^[a-zA-Z]*$/; // Regex pattern to allow only letters (both lowercase and uppercase)

            if (!regex.test(input)) {
                // If the input contains characters other than letters
                $(this).val(input.replace(/[^a-zA-Z]/g, '')); // Remove non-letter characters
            }
        });
        $('#email_id').on('input', function() {
            $(this).val(function(_, val) {
                return val.toLowerCase();
            });
        });
        $.validator.addMethod("recaptcha", function(value) {
            return grecaptcha.getResponse() !== "";
        }, "Please solve the reCAPTCHA.");
        // Add custom email validation method
        $.validator.addMethod("customEmail", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(value);
        }, "Please enter a valid email address");
  
        $('#mandatoryForm').validate({
            ignore: [],
            rules: {
                profile_created_for: {
                    required: true,
                },
                gender: {
                    required: true
                },
                first_name: {
                    required: true,
                    minlength: 1, // Minimum length of 10 digits
                    maxlength: 50
                },
                last_name: {
                    required: true,
                    minlength: 1,
                    maxlength: 50
                },
                date_of_birth: {
                    required: true
                },
                country: {
                    required: true,
                },
                state: {
                    required: true
                },
                email_id: {
                    required: true,
                    customEmail: true
                },
                contact_number: {
                    required: true,
                },
                chooseNum:{
                    required: true,
                },
                whatsapp_number: {
                    required: true,
                },
                'g-recaptcha-response': {
                    recaptcha: true
                },
            },
            messages: {
                profile_created_for: {
                    required: "This field is required."
                },
                gender: {
                    required: "This field is required."
                },
                first_name: {
                    required: "This field is required.",
                    minlength: "First name should be must be 1 letters.", // Minimum length of 10 digits
                    maxlength: "First name cannot be more than 50 letters"
                },
                last_name: {
                    required: "This field is required.",
                    minlength: "Last name should be must be 1 letters.", // Minimum length of 10 digits
                    maxlength: "Last name cannot be more than 50 letters"
                },
                date_of_birth: {
                    required: "This field is required."
                },
                country: {
                    required: "This field is required."
                },
                state: {
                    required: "This field is required."
                },
                email_id: {
                    required: "This field is required.",
                    customEmail: "Please enter a valid email address"
                },
                contact_number: {
                    required: "This field is required.",
                },
                chooseNum:{
                    required: "This field is required.",
                },
                whatsapp_number: {
                    required: "This field is required.",
                },
                'g-recaptcha-response': {
                    recaptcha: "Please solve the reCAPTCHA."
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("id") == "profileFor") {
                    error.insertAfter(element.next(".select2-container"));
                }else if (element.attr("name") == "gender") {
                error.insertAfter(".genderErr");
                }else if (element.attr("id") == "country") {
                    error.insertAfter(element.next(".select2-container"));
                }else if (element.attr("id") == "state") {
                    error.insertAfter(element.next(".select2-container"));
                }else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
				event.preventDefault();

				// Helper function to format the phone number with the country code
                function formatPhoneNumber(countryCode, phoneNumber) {
                // Check if the phone number already includes the country code
                phoneNumber = phoneNumber || "";
                if (!phoneNumber.startsWith("+" + countryCode)) {
                    return "+" + countryCode +" "+ phoneNumber;
                }
                return phoneNumber;
                }
            
                // Get the selected country code and phone numbers
                var primarryNum_countryCode = iti.getSelectedCountryData().dialCode;
                var primarryNum_phoneNumber = $("#contact_number").val();
                var primarryNumber = formatPhoneNumber(primarryNum_countryCode, primarryNum_phoneNumber);
                $("#contact_number").val(primarryNumber);
            
                // Check if the WhatsApp number should be the same as the primary number
                var selectedValue = $('input[name="chooseNum"]:checked').val();
                var whatsappNumNumber;

                if (selectedValue === "sameNumber") {
                    whatsappNumNumber = primarryNumber;
                } else {
                    var whatsappNum_countryCode = iti.getSelectedCountryData().dialCode;
                    var whatsappNum_phoneNumber = $("#whatsapp_number").val();
                    whatsappNumNumber = formatPhoneNumber(whatsappNum_countryCode, whatsappNum_phoneNumber);
                }

                $("#whatsapp_number").val(whatsappNumNumber);
            
                // Now create the FormData object
                const formData = new FormData(form);
                formData.set('contact_number', primarryNumber);
                formData.set('whatsapp_number', whatsappNumNumber);

                // Convert FormData to JSON
                let formDataJson = {};
                formData.forEach((value, key) => {
                    formDataJson[key] = value;
                });

                console.log(formDataJson);

				// Make AJAX request
				$.ajax({
					type: 'POST',
					url: 'update_form_data.php',
					data: formDataJson,
					success: function(data) {
						if (data == 1) {
							alert("success");
                            //Delete Cookies
                            deleteCookie('formData');
                            deleteCookie('bnr_id');
                        
							var encryptedBNRID = '<?php echo $encryptedBNRID; ?>'; // Assuming the BNR ID is returned in the 'bnrId' field of the response

							window.location.href = 'otp_verification.php?bnr_id=' + encryptedBNRID;
                            form.reset();
						} else {
							alert("Error");
						}
					},
					error: function(xhr, textStatus, errorThrown) {
						console.error('Error occurred:', errorThrown);
					}
				});
			}

        });
</script>


</body>
</html>