$(document).ready(function(){
/* var homePage = "https://mvgdigital.com/bellsnrings/";
var indexPage = "https://mvgdigital.com/bellsnrings/index.html";
var verifyOTPPage = "https://mvgdigital.com/bellsnrings/verify-otp.html";
var detailPage = "https://mvgdigital.com/bellsnrings/detail-form.html";
var successPage = "https://mvgdigital.com/bellsnrings/success.html"; */

var homePage = "http://localhost/projects/BellsNRings/";
var indexPage = "http://localhost/projects/BellsNRings/index.html";
var verifyOTPPage = "http://localhost/projects/BellsNRings/verify-otp.html";
var detailPage = "http://localhost/projects/BellsNRings/detail-form.html";
var successPage = "http://localhost/projects/BellsNRings/success.html";



if (window.location.href === homePage && indexPage) {
    // Index page Js
        var currentDate = new Date();
        var maxDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate()); // Date 18 years ago

        $('#dob').datepicker({
            uiLibrary: 'bootstrap5',
            endDate: maxDate,
            format: 'yyyy-mm-dd',
            autoclose: true,
            //todayHighlight: true
        });
        // Initialize select2
        $("#profileFor").select2({
            placeholder: "Select profile for",
            allowClear: true,
            minimumResultsForSearch: Infinity
        }).val(null).trigger('change');
    
        $("#country").select2({
            placeholder: "Select country",
            allowClear: true
        });
        $("#state").select2({
            placeholder: "Select state",
            allowClear: true
        });
    
    const firstName = document.querySelector('#firstName');
    firstName.addEventListener('input', function(e) {
    var val = `${e.target.value}`;
    console.log(val);
    });

    var onloadCallback = function() {
        alert("grecaptcha is ready!");
    };
    // Whatsapp Number Below Is - Change event
    $('input[name="addWhatsappNum"]').change(function() {
        // Get the value of the selected radio button
        var selectedValue = $('input[name="addWhatsappNum"]:checked').val();
        if(selectedValue == 'differentNumber'){
            $('#addNewNumber').show()
        }else{
            $('#addNewNumber').hide()
        }
    });

    // Initialize intlTelInput after the document is loaded
    const mobNumber = document.querySelector(".mob_number");
    const primaryNum = document.querySelector("#primaryMobNum");
    const primaryNumItt = window.intlTelInput(primaryNum, {
        initialCountry: "in",
        nationalMode: false,
        separateDialCode: true,
        showSelectedDialCode: false,
        utilsScript: "./assets/js/utils.min.js?1714035314356"
    });

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

    $.validator.addMethod("matchCountryCode", function(value, element) {
        // Get the selected country's dial code
        const selectedCountryData = primaryNumItt.getSelectedCountryData();
        const countryCode = selectedCountryData.dialCode;
    
        // Remove any non-numeric characters from the entered mobile number
        const sanitizedMobileNumber = value.replace(/\D/g, '');
    
        // Check if the mobile number starts with the country code
        return sanitizedMobileNumber.startsWith(countryCode);
    }, "Mobile number must match the selected country code.");

    // Listen for changes in the value of profileFor
    $('#profileFor').on('change', function() {
        var profileFor = $(this).val();
        if (profileFor != null && profileFor.trim() !== '') {
            $('#profileFor-error').hide(); // Hide error message if the field is not empty
            if(profileFor === 'doughter'|| profileFor === 'sister'){
                $("#male").prop("disabled", true); 
                $("#female").prop("disabled", false);
                $("#female").prop("checked", true);
            }else if(profileFor === 'son'|| profileFor === 'brother'){
                $("#female").prop("disabled", true); 
                $("#male").prop("disabled", false);
                $("#male").prop("checked", true);
            }else{
                $("#female").prop("disabled", false);
                $("#male").prop("disabled", false);
            }
        }else {
            $('#profileFor-error').show(); // Show error message if the field is empty
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
    
    // Event listener for changes in radio buttons
    $('input[name="addWhatsappNum"]').change(function() {
        var selectedValue = $('input[name="addWhatsappNum"]:checked').val();
        if (selectedValue === 'differentNumber') {
            // Show the address field if "Different than above" is selected
            // Initialize intlTelInput after the document is loaded
            $('#addNewNumber').show();            
            document.getElementById('addNewNumber').innerHTML = `
                <div  class="form-field">
                    <label for="whatsappNum">Whatsapp Number <span class="requirdField" >*</span></label>
                    <input type="tel" id="whatsappNum" name="whatsappNum" class="mob_number" placeholder="Enter whatsapp Number">
                </div>`
            ;
            const whatsappNum = document.querySelector("#whatsappNum");
            const whatsappNumItt = window.intlTelInput(whatsappNum, {
                initialCountry: "in",
                nationalMode: false,
                separateDialCode: true,
                showSelectedDialCode: false,
                utilsScript: "./assets/js/utils.min.js?1714035314356"

            }); 
            // Get the input field and initialize the intlTelInput instance
            whatsappNum.addEventListener("input", function(e) {
                // Get the entered value
                let inputValue = e.target.value;
            
                // Remove any non-numeric characters
                inputValue = inputValue.replace(/[^\d+]/g, '');
            
                // Update the input field value with only numeric characters
                e.target.value = inputValue;
                // Get the selected country's data
            });
            $.validator.addMethod("matchCountryCode", function(value, element) {
                // Get the selected country's dial code
                const selectedCountryData = whatsappNumItt.getSelectedCountryData();
                const countryCode = selectedCountryData.dialCode;
            
                // Remove any non-numeric characters from the entered mobile number
                const sanitizedMobileNumber = value.replace(/\D/g, '');
            
                // Check if the mobile number starts with the country code
                return sanitizedMobileNumber.startsWith(countryCode);
            }, "Mobile number must match the selected country code.");
            
        } else {
            // Clear the address field if "Same as above" is selected
            console.log("not woking!");
            $('#addNewNumber').hide();
            document.getElementById('addNewNumber').innerHTML = '';
        }
    });
    
    $('#mandatoryForm').validate({
        ignore: [],
        rules: {
            profileFor: {
                required: true,
            },
            gender: {
                required: true
            },
            firstName: {
                required: true,
                minlength: 1, // Minimum length of 10 digits
                maxlength: 50
            },
            lastName: {
                required: true,
                minlength: 1,
                maxlength: 50
            },
            dob: {
                required: true
            },
            country: {
                required: true,
            },
            state: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            primaryMobNum: {
                required: true,
                minlength: 13,
                maxlength: 13,
                matchCountryCode: true
            },
            addWhatsappNum:{
                required: true,
            },
            whatsappNum: {
                required: true,
                minlength: 13,
                maxlength: 13,
                matchCountryCode: true
            }
        },
        messages: {
            profileFor: {
                required: "This field is required."
            },
            gender: {
                required: "This field is required."
            },
            firstName: {
                required: "This field is required.",
                minlength: "First name should be must be 1 letters.", // Minimum length of 10 digits
                maxlength: "First name cannot be more than 50 letters"
            },
            lastName: {
                required: "This field is required.",
                minlength: "Last name should be must be 1 letters.", // Minimum length of 10 digits
                maxlength: "Last name cannot be more than 50 letters"
            },
            dob: {
                required: "This field is required."
            },
            country: {
                required: "This field is required."
            },
            state: {
                required: "This field is required."
            },
            email: {
                required: "This field is required.",
                email: "Please enter a valid email address"
            },
            primaryMobNum: {
                required: "This field is required.",
                minlength: "Mobile number must be at least 12 digits.",
                maxlength: "Mobile number cannot be more than 12 digits.",
                matchCountryCode: "Mobile number must match the selected country code."
            },
            addWhatsappNum:{
                required: "This field is required.",
            },
            whatsappNum: {
                required: "This field is required.",
                minlength: "Mobile number must be at least 12 digits.",
                maxlength: "Mobile number cannot be more than 12 digits.",
                matchCountryCode: "Please enter a valid Whatsapp number"
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("id") == "profileFor") {
                error.insertAfter(element.next(".select2-container"));
            }else if (element.attr("id") == "country") {
                error.insertAfter(element.next(".select2-container"));
            }else if (element.attr("id") == "state") {
                error.insertAfter(element.next(".select2-container"));
            }else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            const formData = {};
            new FormData(form).forEach((value, key) => {
                formData[key] = value;
            });
            console.log(formData);
            // Form submission code goes here
            window.location.href = "https://mvgdigital.com/bellsnrings/verify-otp.html";
            return false; // Prevent form submission for this example
        },
    });
   
}else if(window.location.href === verifyOTPPage) {
    // Verify OTP Js
    $(".edit-btn").click(function(event){
        event.preventDefault();
        var editbtnId = $(this).attr('id');
        console.log(editbtnId); 
        
        if(editbtnId == "edit-PrimaryNum"){
            $('#popupView').show('slow');
            

            document.getElementById('update-number').innerHTML = `
                <div id="editPrimaryMobNum" class="form-field edit-field mb-3">
                <label for="primaryMobNum">Primary Mobile Number :</label>
                <input type="tel" name="primaryMobNum" id="primaryMobNum" class="" placeholder="Enter Mobile Number">
            </div>`;

            //Mobile number validation
            const primaryNum = document.querySelector("#primaryMobNum");
            const primaryNumItt = window.intlTelInput(primaryNum, {
                initialCountry: "in",
                nationalMode: false,
                separateDialCode: true,
                showSelectedDialCode: false,
                utilsScript: "./assets/js/utils.min.js?1714035314356"
            });

            // Get the input field and initialize the intlTelInput instance
            primaryNum.addEventListener("input", function(e) {
                // Get the entered value
                let inputValue = e.target.value;

                // Remove any non-numeric characters
                inputValue = inputValue.replace(/[^\d+]/g, '');

                // Update the input field value with only numeric characters
                e.target.value = inputValue;
                // Get the selected country's data
            });

            $.validator.addMethod("matchCountryCode", function(value, element) {
                // Get the selected country's dial code
                const selectedCountryData = primaryNumItt.getSelectedCountryData();
                const countryCode = selectedCountryData.dialCode;

                // Remove any non-numeric characters from the entered mobile number
                const sanitizedMobileNumber = value.replace(/\D/g, '');

                // Check if the mobile number starts with the country code
                return sanitizedMobileNumber.startsWith(countryCode);
            }, "Mobile number must match the selected country code.");


        }else if(editbtnId == "edit-whatsappNum"){
            $('#popupView').show('slow');

            document.getElementById('update-number').innerHTML = `
                <div id="editWhatsappNum" class="form-field edit-field mb-3">
                <label for="whatsappNum">Whatsapp Number :</label>
                <input type="tel" name="whatsappNum" id="whatsappNum" class="" placeholder="Enter whatsapp Number">
                </div>`;

                const whatsappNum = document.querySelector("#whatsappNum");
                const whatsappNumItt = window.intlTelInput(whatsappNum, {
                    initialCountry: "in",
                    nationalMode: false,
                    separateDialCode: true,
                    showSelectedDialCode: false,
                    utilsScript: "./assets/js/utils.min.js?1714035314356"

                }); 
                // Get the input field and initialize the intlTelInput instance
                whatsappNum.addEventListener("input", function(e) {
                    // Get the entered value
                    let inputValue = e.target.value;

                    // Remove any non-numeric characters
                    inputValue = inputValue.replace(/[^\d+]/g, '');

                    // Update the input field value with only numeric characters
                    e.target.value = inputValue;
                    // Get the selected country's data
                });
                $.validator.addMethod("matchCountryCode", function(value, element) {
                    // Get the selected country's dial code
                    const selectedCountryData = whatsappNumItt.getSelectedCountryData();
                    const countryCode = selectedCountryData.dialCode;

                    // Remove any non-numeric characters from the entered mobile number
                    const sanitizedMobileNumber = value.replace(/\D/g, '');

                    // Check if the mobile number starts with the country code
                    return sanitizedMobileNumber.startsWith(countryCode);
                }, "Mobile number must match the selected country code.");
        }else if(editbtnId == "edit-email"){
            $('#popupView').show('slow');
            document.getElementById('update-number').innerHTML = `
                <div id="editEmail" class="form-field edit-field mb-3">
                <label for="email">Email ID :</label>
                <input type="text" name="email" id="email" class="" placeholder="Enter email">
                </div>`;
        }else{
            console.log("Something Wrong!");
        }        
    });
    $(".close-btn").click(function(){
        $('#popupView').hide('slow');
    });

    //update contact info
    $('#update_contactInfo').validate({
        rules: {
            primaryMobNum: {
                required: true,
                matchCountryCode: true
                // Add more rules as needed
            },
            whatsappNum: {
                required: true,
                matchCountryCode: true
                // Add more rules as needed
            },
            email: {
                required: true,
                email: /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i
            }
            // Add more fields and their validation rules as needed
        },
        messages: {
            primaryMobNum: {
                required: "Please enter your primary mobile number",
                matchCountryCode: "Mobile number must match the selected country code."
                // Add more messages for specific rules as needed
            },
            whatsappNum: {
                required: "Please enter your whatsapp number",
                matchCountryCode: "Mobile number must match the selected country code."
                // Add more messages for specific rules as needed
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address" // Message for invalid email
            }
            // Add more messages for other fields as needed
        },
        submitHandler: function(form) {
            // If form is valid, handle submission here
            // You can access the values of fields using jQuery
            var primaryMobNum = $('#primaryMobNum').val();
            var whatsappNum = $('#whatsappNum').val();
            var email = $('#email');

            $(".spinner-gif").show();
            setTimeout(function() {
                $(".spinner-gif").hide();
                $(".success-msg").show();
                // Hide the success message after 2 seconds
                setTimeout(function() {
                    $(".success-msg").hide();
                    $('#popupView').hide('slow')
                }, 2000);
            }, 2000);
        },
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
        console.log(getOTPBtnIdm);

        if(getOTPBtnIdm == "get-primaryMobNum"){

            var maskedPrimaryNum = "developer@mvgdigital.com";
            var maskedPrimaryNum = maskedPrimaryNum.substring(0, maskedPrimaryNum.indexOf("@")).replace(/.(?=.{3})/g, "*") + maskedPrimaryNum.substring(maskedPrimaryNum.indexOf("@"));
            $("#maskedPrimaryNum").text(maskedPrimaryNum);

            $('#primaryMobNum-otp').removeAttr("disabled", "disabled");
            $("#primaryMobNum-OTPsent").fadeIn('slow');
            setTimeout(function(){
                $("#primaryMobNum-OTPsent").fadeOut('slow');
            },5000);            
        
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
                            console.log("Something Wrong!");
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
        }else if(getOTPBtnIdm == "get-whatsappNum"){

            var maskedWhatsappNum = "developer@mvgdigital.com";
            var maskedWhatsappNum = maskedWhatsappNum.substring(0, maskedWhatsappNum.indexOf("@")).replace(/.(?=.{3})/g, "*") + maskedWhatsappNum.substring(maskedWhatsappNum.indexOf("@"));
            $("#maskedWhatsappNum").text(maskedWhatsappNum);

            $('#whatsappNum-otp').removeAttr("disabled", "disabled");
            $("#whatsappNum-OTPsent").fadeIn('slow');
            setTimeout(function(){
                $("#whatsappNum-OTPsent").fadeOut('slow');
            },5000); 

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
        }else if(getOTPBtnIdm == "get-email"){

            var email = "developer@mvgdigital.com";
            var maskedEmail = email.substring(0, email.indexOf("@")).replace(/.(?=.{3})/g, "*") + email.substring(email.indexOf("@"));
            $("#maskedEmail").text(maskedEmail);

            $('#email-otp').removeAttr("disabled", "disabled");
            $("#email-OTPsent").fadeIn('slow');
            setTimeout(function(){
                $("#email-OTPsent").fadeOut('slow');
            },5000); 

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
        }else{
            
        }
    });

    var timer;
    var otpValue = "9987";
    var verifyPrimaryMobNumOTP = $('#verify-primaryMobNum');
    var verifyWhatsappNumOTP = $('#verify-whatsappNum');
    var verifyEmailOTP = $('#verify-email');
    var isVerified = false;
    
    // Function to handle OTP verification
    function handleVerification(verifyButton, otpInput, successMessage, errorMessage, successIcon, seconds) {
        $(verifyButton).click(function(event) {
            event.preventDefault();
            isVerified = true;
    
            var enteredOTP = $(otpInput).val();
    
            if (enteredOTP === otpValue) {
                // If the OTP matches, display a success message
                $(verifyButton).text(successMessage);
                $(verifyButton).addClass("success");
                $(verifyButton).attr("disabled", "disabled");
                $(otpInput).attr("disabled", "disabled");
                $(otpInput).css("border", "2px solid #17c008");
                $(errorMessage).hide();
                $(seconds).hide();
                $(successIcon).show();
                // Stop the countdown
                clearTimeout(timer);
                // Form submission code goes here
                
            } else {
                // If the OTP does not match, display an error message
                $(verifyButton).show();
                $(errorMessage).show();
            }
    
            // Enable the submit button if any one OTP verification is successful
            $(".submit_btn").prop('disabled', !isVerified);
        });
    }
    
    // Handle OTP verification for primary mobile number
    handleVerification(verifyPrimaryMobNumOTP, "#primaryMobNum-otp", "Verified", "#primaryMobNum-error", "#mobOTP-icon", "#mobOTP-second");
    
    // Handle OTP verification for whatsapp number
    handleVerification(verifyWhatsappNumOTP, "#whatsappNum-otp", "Verified", "#whatsappNum-error","#whatsappOTP-icon", "#whatsappOTP-second");
    
    // Handle OTP verification for email
    handleVerification(verifyEmailOTP, "#email-otp", "Verified", "#email-error","#emailOTP-icon", "#emailOTP-second");

    $("#veriyBtnSubmit").on("click", function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        
        // Check if the submit button is enabled
        if ($(this).prop('disabled') === false) {
            // Redirect the user to the desired page
            window.location.href = "https://mvgdigital.com/bellsnrings/detail-form.html";
        }
    });
    
}else if (window.location.href === detailPage) {
    // Detailde Form Js
    $("#mothertongue").select2({
        placeholder: "Select mother tongue",
        allowClear: true
    }).val(null).trigger('change');
    
    $("#caste").select2({
        placeholder: "Select caste",
        allowClear: true,
    }).val(null).trigger('change');

    $("#denomination").select2({
        placeholder: "Select denomination",
        allowClear: true
    }).val(null).trigger('change');

    $("#height").select2({
        placeholder: "Select height",
        allowClear: true
    }).val(null).trigger('change');

    $("#weight").select2({
        placeholder: "Select weight",
        allowClear: true
    }).val(null).trigger('change');

    $("#maritalStatus").select2({
        placeholder: "Select marital status",
        allowClear: true,
        minimumResultsForSearch: Infinity
    }).val(null).trigger('change');

    $("#complexion").select2({
        placeholder: "Select complexion",
        allowClear: true,
        minimumResultsForSearch: Infinity
    }).val(null).trigger('change');
    $("#familystatus").select2({
        placeholder: "Select family status",
        allowClear: true,
        minimumResultsForSearch: Infinity
    }).val(null).trigger('change');

    // Function to populate options in "Brothers Married" select element
    function populateMarriedBrothersOptions(num) {
        var marriedBrothersSelect = document.getElementById("brotherMarried");
        marriedBrothersSelect.innerHTML = ''; // Clear previous options

        var noneOption = document.createElement("option");
        noneOption.value = "No";
        noneOption.text = "No";
        marriedBrothersSelect.appendChild(noneOption);
        
        for (var i = 1; i <= num; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.text = i;
            marriedBrothersSelect.appendChild(option);
        }
    }

    // Event listener for changes in "No. of Brothers" select element
    document.getElementById("noOfBrother").addEventListener("change", function() {
        var numBrothers = parseInt(this.value);
        var addmarriedBrotherscol = document.getElementById("brother-married-field");
        var marriedBrothersField = document.getElementById("brotherMarried");
        
        if (numBrothers > 0) {
            // Show "Brothers Married" field and populate options
            $("#brother-married-field").show();
            addmarriedBrotherscol.innerHTML = `
                <div class="form-field mb-3">
                    <label for="brotherMarried">Brothers Married <span class="requirdField" >*</span></label>
                    <select id="brotherMarried" name="brotherMarried" class="form-select">
                        <option value="no" selected>No</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>`;
            populateMarriedBrothersOptions(numBrothers);
        } else {
            // Hide "Brothers Married" field if no brothers selected
            $("#brother-married-field").hide();
            marriedBrothersField.style.display = "none";
        }
    });

    // Function to populate options in "Brothers Married" select element
    function populateMarriedSisterOptions(num) {
        var marriedSistersSelect = document.getElementById("sisterMarried");
        marriedSistersSelect.innerHTML = ''; // Clear previous options

        var noneOption = document.createElement("option");
        noneOption.value = "No";
        noneOption.text = "No";
        marriedSistersSelect.appendChild(noneOption);
        
        for (var i = 1; i <= num; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.text = i;
            marriedSistersSelect.appendChild(option);
        }
    }

    // Event listener for changes in "No. of Brothers" select element
    document.getElementById("noOfsister").addEventListener("change", function() {
        var numSisters = parseInt(this.value);
        var addmarriedSisterscol = document.getElementById("sister-married-field");
        var marriedSisterField = document.getElementById("sisterMarried");
        
        if (numSisters > 0) {
            // Show "Brothers Married" field and populate options
            $("#sister-married-field").show();
            addmarriedSisterscol.innerHTML = `
                <div class="form-field mb-3">
                    <label for="sisterMarried">Sisters Married <span class="requirdField" >*</span></label>
                    <select id="sisterMarried" name="sisterMarried" class="form-select">
                        <option value="no" selected>No</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>`;
            populateMarriedSisterOptions(numSisters);
        } else {
            // Hide "Brothers Married" field if no brothers selected
            $("#sister-married-field").hide();
            marriedSisterField.style.display = "none";
        }
    });

    // Event listener for changes in radio buttons
    $('input[name="choseAddress"]').change(function() {
        var selectedValue = $('input[name="choseAddress"]:checked').val();
        if (selectedValue === 'diff_address') {
            console.log("woking!");
            // Show the address field if "Different than above" is selected
            $('#addNewAddress').show();
            document.getElementById('addNewAddress').innerHTML = `
                <div class="form-field mb-3">
                    <label for="permAddress">Permanent Address <span class="requirdField" >*</span></label>
                    <textarea id="permAddress" class="address" name="permAddress"></textarea>
                </div>`;
        } else {
            // Clear the address field if "Same as above" is selected
            console.log("not woking!");
            $('#addNewAddress').hide();
            document.getElementById('addNewAddress').innerHTML = '';
        }
    });

    $("#multi-step-form").validate({
        rules: {
            maritalStatus: {
                required: true
            },
            mothertongue: {
                required: true
            },
            caste: {
                required: true
            },
            denomination: {
                required: true
            },
            height: {
                required: true
            },
            weight: {
                required: true
            },
            complexion: {
                required: true
            },
            last_edu_level: {
                required: true
            },
            occupation: {
                required: true
            },
            company_name: {
                required: true
            },
            annual_income: {
                required: true
            },
            work_location: {
                required: true
            },
            fatherName: {
                required: true
            },
            fatherOccupation: {
                required: true
            },
            motherName: {
                required: true
            },
            motherOccupation: {
                required: true
            },
            familystatus: {
                required: true
            },
            noOfBrother: {
                required: true
            },
            brotherMarried: {
                required: true
            },
            noOfsister: {
                required: true
            },
            sisterMarried: {
                required: true
            },
            address: {
                required: true
            },
            citizenOf: {
                required: true
            },
            permAddress: {
                required: true
            },
            choseAddress: {
                required: true
            },
            imag: {
                required: false
            },
            
            
        },
        messages: {
            maritalStatus: {
                required: "This field is required."
            },
            mothertongue: {
                required: "This field is required."
            },
            caste: {
                required: "This field is required."
            },
            denomination: {
                required: "This field is required."
            },
            height: {
                required: "This field is required."
            },
            weight: {
                required: "This field is required."
            },
            complexion: {
                required: "This field is required."
            },
            last_edu_level: {
                required: "This field is required."
            },
            occupation: {
                required: "This field is required."
            },
            company_name: {
                required: "This field is required."
            },
            annual_income: {
                required: "This field is required."
            },
            work_location: {
                required: "This field is required."
            },
            fatherName: {
                required: "This field is required."
            },
            fatherOccupation: {
                required: "This field is required."
            },
            motherName: {
                required: "This field is required."
            },
            motherOccupation: {
                required: "This field is required."
            },
            familystatus: {
                required: "This field is required."
            },
            noOfBrother: {
                required: "This field is required."
            },
            brotherMarried: {
                required: "This field is required."
            },
            noOfsister: {
                required: "This field is required."
            },
            sisterMarried: {
                required: "This field is required."
            },
            address: {
                required: "This field is required."
            },
            citizenOf: {
                required: "This field is required."
            },
            permAddress: {
                required: "This field is required."
            },
            choseAddress: {
                required: "This field is required."
            },
            imag: {
                required: false
            },
        },
        errorElement: 'label',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-field').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            // Submit the form
            form.submit();
        }
    });

    function handleFieldChange(fieldId, errorId) {
        $(fieldId).on('change', function() {
            if ($(this).val() == '') {
                $(errorId).show();
                console.log("empty");
            } else {
                console.log("fill");
                $(errorId).hide();
            }
        });
    }
    handleFieldChange('#maritalStatus', '#maritalStatus-error');
    handleFieldChange('#mothertongue', '#mothertongue-error');
    handleFieldChange('#caste', '#caste-error');
    handleFieldChange('#denomination', '#denomination-error');
    handleFieldChange('#height', '#height-error');
    handleFieldChange('#weight', '#weight-error');
    handleFieldChange('#complexion', '#complexion-error');

    handleFieldChange('#fatherName', '#fatherName-error');
    handleFieldChange('#fatherOccupation', '#fatherOccupation-error');
    handleFieldChange('#motherName', '#motherName-error');
    handleFieldChange('#motherOccupation', '#motherOccupation-error');
    handleFieldChange('#familystatus', '#familystatus-error');
    handleFieldChange('#noOfBrother', '#noOfBrother-error');
    handleFieldChange('#brotherMarried', '#brotherMarried-error');
    handleFieldChange('#noOfsister', '#noOfsister-error');
    handleFieldChange('#sisterMarried', '#sisterMarried-error');
    handleFieldChange('#address', '#address-error');

    handleFieldChange('#citizenOf', '#citizenOf-error');
    handleFieldChange('#permAddress', '#permAddress-error');
    handleFieldChange('#choseAddress', '#choseAddress-error');
    handleFieldChange('#imag', '#imag-error');
    

    var currentStep = 1;
        var updateProgressBar;

        function displayStep(stepNumber) {
            if (stepNumber >= 1 && stepNumber <= 3) {
                $(".step-" + currentStep).hide();
                $(".step-" + stepNumber).show();
                currentStep = stepNumber;
                updateProgressBar();
            }
        }

            $("#multi-step-form").find(".step").slice(1).hide();

            $(".next-step").click(function () {
                // Validate the form
                if ($("#multi-step-form").valid()) {
                    if (currentStep < 3) {
                        $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
                        currentStep++;
                        setTimeout(function () {
                            $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
                            $(".step-" + currentStep)
                                .show()
                                .addClass("animate__animated animate__fadeInRight");
                            updateProgressBar();
                            changeSvgColor();
                        }, 500);
                    }
                } else {
                    // If the form is not valid, do not proceed to the next step
                    // Optionally, you can display an error message to the user
                    console.log("Please fill in all required fields.");
                }
            });
            
            $(".prev-step").click(function () {
                if (currentStep > 1) {
                    $(".step-" + currentStep).addClass(
                        "animate__animated animate__fadeOutRight"
                    );
                    currentStep--;
                    setTimeout(function () {
                        $(".step")
                            .removeClass("animate__animated animate__fadeOutRight")
                            .hide();
                        $(".step-" + currentStep)
                            .show()
                            .addClass("animate__animated animate__fadeInLeft");
                        updateProgressBar();
                        changeSvgColor();
                    }, 500);
                }
            });
            updateProgressBar = function () {
                var progressPercentage = ((currentStep - 1) / 2) * 100;
                $(".progress-bar").css("width", progressPercentage + "%");
            };
            function changeSvgColor() {
                var progressPercentage = ((currentStep - 1) / 2) * 100;
                if (progressPercentage === 0) {
                    // Change icon color here
                    $(".progress-step-1").css('font-weight', "600");
                    $(".progress-step-2").css('font-weight', "500");
                    $(".progress-step-3").css('font-weight', "500");
                    
                }if (progressPercentage === 50) {
                    // Change icon color here
                    $(".step2-circle svg path").css("fill", "#DC75B0"); 
                    $(".step3-circle svg path").css("fill", "");
                    $(".progress-step-1").css('font-weight', "500");
                    $(".progress-step-2").css('font-weight', "600");
                    $(".progress-step-3").css('font-weight', "500");
                }else if(progressPercentage === 100) {
                    // Change icon color here
                    $(".progress-step-1").css('font-weight', "500");
                    $(".progress-step-2").css('font-weight', "500");
                    $(".progress-step-3").css('font-weight', "600");
                    $(".step3-circle svg path").css("fill", "#DC75B0"); // Replace "#DC75B0" with your desired color
                } else {
                    // Reset icon color if progress bar width is not 50%
                    $(".step-circle svg path").css("fill", ""); // Reset color to 
                }
            }
        
            /* var currentWidth = $(window).width();
                if(currentWidth < 600){
                    
                }else{
                    console.log('wrong!');
                } */
            // Call updateProgressBar function initially
            updateProgressBar();

            //Annual Income Code
            $(document).on("keypress keyup", ".price-format-input", function (e) {
                // Allow only numbers and certain control keys (e.g., backspace, delete)
                if (e.which < 48 || e.which > 57) {
                    e.preventDefault();
                } else {
                    let val = this.value;
                    val = val.replace(/,/g, "");
                    if (val.length === 1 && val === '0') {
                        e.preventDefault();
                        return;
                    }else if (val.length > 3) {
                        let noCommas = Math.ceil(val.length / 3) - 1;
                        let remain = val.length - noCommas * 3;
                        let newVal = [];
                        for (let i = 0; i < noCommas; i++) {
                            newVal.unshift(val.substr(val.length - i * 3 - 3, 3));
                        }
                        newVal.unshift(val.substr(0, remain));
                        this.value = newVal.join(",");
                    } else {
                        this.value = val;
                    }
            
                    // Update text below the input field
                    let amountInText = convertToWords(val);
                    $("#textBelowIncome").text(" " + amountInText);
                }
                // Hide textBelowIncome if annual_income is empty
                if ($(this).val() === '') {
                    $("#textBelowIncome").hide();
                } else {
                    $("#textBelowIncome").show();
                }                
            });
            
            function convertToWords(num) {
                const ones = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
                const tens = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
            
                if (num === '0') return 'Zero';
                if (num < 20) return ones[num];
                if (num < 100) return tens[Math.floor(num / 10) - 2] + (num % 10 ? ' ' + ones[num % 10] : '');
                if (num < 1000) return ones[Math.floor(num / 100)] + ' Hundred' + (num % 100 ? ' ' + convertToWords(num % 100) : '');
                if (num < 1000000) return convertToWords(Math.floor(num / 1000)) + ' Thousand' + (num % 1000 ? ' ' + convertToWords(num % 1000) : '');
                if (num < 1000000000) return convertToWords(Math.floor(num / 1000000)) + ' Million' + (num % 1000000 ? ' ' + convertToWords(num % 1000000) : '');
                return 'Number too large';
            }
            $("#annual_income").focus();

            //Image Upload Code
            function readURL(input, imgControlName) {
                if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    $(imgControlName).attr('src', e.target.result);
                  }
                  reader.readAsDataURL(input.files[0]);
                }
              }
              
              $("#imag").change(function() {
                // add your logic to decide which image control you'll use
                var imgControlName = "#ImgPreview";
                readURL(this, imgControlName);
                $('.preview1').addClass('it');
                $("#ImgPreview").show('slow',function(){
                    $('.btn-rmv1').addClass('rmv');
                })
              });
              
              $("#removeImage1").click(function(e) {
                e.preventDefault();
                $("#imag").val("");
                //$("#ImgPreview").attr("src", "");
                $("#ImgPreview").hide(function(){
                    $("#ImgPreview").attr("src", "");
                });
                $('.preview1').removeClass('it');
                $('.btn-rmv1').removeClass('rmv');
              });
            
}else if (window.location.href === successPage){

    $("#nav-to-detailForm").click(function(){
        window.location.href = "https://mvgdigital.com/bellsnrings/success.html";
    })
}else{
alert("Page not Found!")
}

});

