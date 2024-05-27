
$(document).ready(function(){

var homePage = "https://mvgdigital.com/bellsnrings/";
var indexPage = "https://mvgdigital.com/bellsnrings/index.html";
var verifyOTPPage = "https://mvgdigital.com/bellsnrings/verify_otp.html";
var detailPage = "https://mvgdigital.com/bellsnrings/detail_form.html";
var successPage = "https://mvgdigital.com/bellsnrings/success.html";
var loginPage = "https://mvgdigital.com/bellsnrings/login.html";
var dashboardPage = "https://mvgdigital.com/bellsnrings/dashboard.html";
var usersPage = "https://mvgdigital.com/bellsnrings/users.html";
var userDetailsPage = "https://mvgdigital.com/bellsnrings/user_details.html";
var generateQRPage =  "https://mvgdigital.com/bellsnrings/generate_qr.html";
var settingsPage = "https://mvgdigital.com/bellsnrings/settings.html";

/* var homePage = "http://localhost/projects/BellsNRings/";
var indexPage = "http://localhost/projects/BellsNRings/index.html";
var verifyOTPPage = "http://localhost/projects/BellsNRings/verify_otp.html";
var detailPage = "http://localhost/projects/BellsNRings/detail_form.html";
var successPage = "http://localhost/projects/BellsNRings/success.html";
var loginPage = "http://localhost/projects/BellsNRings/login.html";
var dashboardPage = "http://localhost/projects/BellsNRings/dashboard.html";
var usersPage = "http://localhost/projects/BellsNRings/users.html";
var userDetailsPage = "http://localhost/projects/BellsNRings/user_details.html";
var generateQRPage =  "http://localhost/projects/BellsNRings/generate_qr.html";
var settingsPage = "http://localhost/projects/BellsNRings/settings.html"; */


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
        
    // Initialize intlTelInput after the document is loaded
    /* 
    const primaryNum = document.querySelector("#primaryMobNum");
    const primaryNumItt = window.intlTelInput(primaryNum, {
        initialCountry: "in",
        nationalMode: false,
        separateDialCode: true,
        showSelectedDialCode: true,
        utilsScript: "./assets/js/utils.min.js?1714035314356"
    }); */
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


    // Listen for changes in the value of profileFor
    $('#profileFor').on('change', function() {
        var profileFor = $(this).val();
        if (profileFor != null && profileFor.trim() !== '') {
            $('#profileFor-error').hide(); // Hide error message if the field is not empty
            if(profileFor === 'doughter'|| profileFor === 'sister'){
                $("#male").prop("disabled", true); 
                $("#female").prop("disabled", false);
                $("#female").prop("checked", true);
                $('#gender-error').hide();
            }else if(profileFor === 'son'|| profileFor === 'brother'){
                $("#female").prop("disabled", true); 
                $("#male").prop("disabled", false);
                $("#male").prop("checked", true);
                $('#gender-error').hide();
            }else{
                $("#female").prop("disabled", false);
                $("#male").prop("disabled", false);
                $("#male").prop("checked", false);
                $("#female").prop("checked", false);
                /* $('#gender-error').hide(); */
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
                    <label id="whatsapp-error-msg" class="error-msg hide"></label>
                    <label id="whatsapp-valid-msg" class="valid-msg hide">Valid number</label>
                </div>`;

                const mobNumber = document.querySelector("#whatsappNum");
                const input = document.querySelector("#whatsappNum");
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
                customEmail: true
            },
            primaryMobNum: {
                required: true,
            },
            addWhatsappNum:{
                required: true,
            },
            whatsappNum: {
                required: true,
            },
            'g-recaptcha-response': {
                recaptcha: true
            },
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
                customEmail: "Please enter a valid email address"
            },
            primaryMobNum: {
                required: "This field is required.",
            },
            addWhatsappNum:{
                required: "This field is required.",
            },
            whatsappNum: {
                required: "This field is required.",
            },
            'g-recaptcha-response': {
                recaptcha: "Please solve the reCAPTCHA."
            },
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
            event.preventDefault();

            // Get the selected country code
            var primarryNum_countryCode = iti.getSelectedCountryData().dialCode;
            var primarryNum_phoneNumber = $("#primaryMobNum").val();
            var primarryNumber = "+" + primarryNum_countryCode + primarryNum_phoneNumber;
            $("#primaryMobNum").val(primarryNumber);

            var whatsappNum_countryCode = iti.getSelectedCountryData().dialCode;
            var whatsappNum_phoneNumber = $("#whatsappNum").val();
            var whatsappNumNumber = "+" + whatsappNum_countryCode + whatsappNum_phoneNumber;
            $("#whatsappNum").val(whatsappNumNumber);

            // Now create the FormData object
            const formData = new FormData(form);
            formData.set('primaryMobNum', primarryNumber);
            formData.set('whatsappNum', whatsappNumNumber); 

            new FormData(form).forEach((value, key) => {
                formData[key] = value;
            });
            // Create a hidden input to include the full number
            console.log(formData);
            // Form submission code goes here
           window.location.href = "https://mvgdigital.com/bellsnrings/verify_otp.html";
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
                <input type="tel" name="primaryMobNum" id="primaryMobNum" class="mob_number" placeholder="Enter Mobile Number">
                <label id="error-msg" class="error-msg hide"></label>
                <label id="valid-msg" class="valid-msg hide">Valid number</label>
            </div>`; 
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
           
        }else if(editbtnId == "edit-whatsappNum"){
            $('#popupView').show('slow');

            document.getElementById('update-number').innerHTML = `
                <div id="editWhatsappNum" class="form-field edit-field mb-3">
                <label for="whatsappNum">Whatsapp Number :</label>
                <input type="tel" name="whatsappNum" id="whatsappNum" class="mob_number" placeholder="Enter whatsapp Number">
                <label id="error-msg" class="error-msg hide"></label>
                <label id="valid-msg" class="valid-msg hide">Valid number</label>
                </div>`;
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
        }else if(editbtnId == "edit-email"){
            $('#popupView').show('slow');
            document.getElementById('update-number').innerHTML = `
                <div id="editEmail" class="form-field edit-field mb-3">
                <label for="email">Email ID :</label>
                <input type="text" name="email" id="email" placeholder="Enter email">
                </div>`;
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
            window.location.href = "https://mvgdigital.com/bellsnrings/success.html";
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
        
            // Call updateProgressBar function initially
            updateProgressBar();

            $(document).on("input keyup", ".price-format-input", function (e) {
                // Allow only numbers and certain control keys (e.g., backspace, delete)
                if (e.type === "keypress" && (e.which < 48 || e.which > 57)) {
                    e.preventDefault();
                    return;
                }
            
                let val = this.value.replace(/,/g, "");
            
                // Prevent leading zero
                if (val.length === 1 && val === '0') {
                    e.preventDefault();
                    return;
                }
            
                // Remove any non-digit characters
                val = val.replace(/\D/g, '');
            
                // Format with commas according to Indian numbering system
                if (val.length > 3) {
                    let lastThree = val.substring(val.length - 3);
                    let otherNumbers = val.substring(0, val.length - 3);
                    if (otherNumbers !== '') {
                        lastThree = ',' + lastThree;
                    }
                    let formattedValue = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                    this.value = formattedValue;
                } else {
                    this.value = val;
                }
            
                // Update text below the input field with the amount in words
                let amountInText = convertToIndianWords(val.replace(/,/g, ''));
                $("#textBelowIncome").text(" " + amountInText);
            
                // Hide textBelowIncome if annual_income is empty
                if ($(this).val() === '') {
                    $("#textBelowIncome").hide();
                } else {
                    $("#textBelowIncome").show();
                }
            });
            
            // Function to convert a number to words in the Indian numbering system
            function convertToIndianWords(num) {
                const ones = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
                const tens = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
                const higher = ['Thousand', 'Lakh', 'Crore'];
            
                if (num === '0') return 'Zero';
            
                function getBelowThousand(n) {
                    if (n < 20) return ones[n];
                    if (n < 100) return tens[Math.floor(n / 10) - 2] + (n % 10 ? ' ' + ones[n % 10] : '');
                    return ones[Math.floor(n / 100)] + ' Hundred' + (n % 100 ? ' ' + getBelowThousand(n % 100) : '');
                }
            
                let result = '';
                let n = parseInt(num, 10);
            
                if (n >= 10000000) {
                    result += getBelowThousand(Math.floor(n / 10000000)) + ' Crore ';
                    n = n % 10000000;
                }
                if (n >= 100000) {
                    result += getBelowThousand(Math.floor(n / 100000)) + ' Lakh ';
                    n = n % 100000;
                }
                if (n >= 1000) {
                    result += getBelowThousand(Math.floor(n / 1000)) + ' Thousand ';
                    n = n % 1000;
                }
                if (n > 0) {
                    result += getBelowThousand(n);
                }
            
                return result.trim();
            }
            
            // Set focus on the annual_income input field
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
}else if (window.location.href === loginPage){

    //Password Validation
    const passwordToggle = document.querySelector('.toggle-password');
    const passwordField = document.querySelector(passwordToggle.getAttribute('toggle'));

    passwordToggle.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.querySelector('.fa').classList.toggle('fa-eye-slash');
        this.querySelector('.fa').classList.toggle('fa-eye');
    });

    $('#password').on('input', function() {
        $('#passwordError').hide();
    });
    //Login Page validations
    $("#loginForm").validate({
        rules: {
            userName: {
                required: true,
                minlength: 2,
                maxlength: 50,
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 50,
            }
        },
        messages: {
            userName: {
                required: "Please enter a user name.",
                minlength: "User name should at least 2 letters.",
                maxlength: "User name cannot be more than 50 letters"
            },
            password: {
                required: "Please enter a password.",
                minlength: "Password should be at least  8 charactre.",
                maxlength: "Password cannot be more than 50 letters"
            }
        },
        submitHandler: function(form) {
            // Array to store valid usernames and passwords
            const users = [
                { username: 'username', password: 'password' },
                { username: 'user2', password: 'password2' },
                // Add more users as needed
            ];

            const username = $("#userName").val();
            const password = $("#password").val();
            console.log(username);

            // Validate login
            const isValidLogin = users.some(user => user.username === username && user.password === password);

            if (isValidLogin) {
                // Navigate to the next page
                window.location.href = 'dashboard.html'; // Replace 'next_page.html' with the actual URL of the next page
            } else {
                // Display error message
                $("#passwordError").show("slow");
                $("#passwordError").text("Incorrect username or password.");
                
            }
        }
    });


}else if (window.location.href === dashboardPage){
    //Dashboard Page validations

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.userName').length && !$(event.target).closest('.logout').length) {
            $('.logout').hide();
        }
    });

    $('.userName').click(function(event){
        event.preventDefault();
        $('.logout').toggle();
    });
    // Logout functionality
    $('.logout a').click(function(event) {
        event.preventDefault();
        // Perform logout action (clear session, etc.)

        // Redirect to the login page
        window.location.href = 'login.html'; // Replace 'login.html' with the actual URL of the login page
    });

    //Side Nav
    let btn = document.querySelector("#menu-btn");
    let sidebar = document.querySelector(".sidebar");
    let menu_title = document.querySelector("#menu_title");

    btn.onclick = () => {
        sidebar.classList.toggle('active');

        // Toggle between fa-bars and fa-times
        if (btn.classList.contains('fa-bars')) {
            btn.classList.remove('fa-bars');
            btn.classList.add('fa-times');
            $(menu_title).text("Close")
        } else {
            btn.classList.remove('fa-times');
            btn.classList.add('fa-bars');
            $(menu_title).text("Menu")
        }
    };

    //Chart js Code

    //Setup
    // Utility functions and constants
    // Utility functions and constants
    const Utils = {
        CHART_COLORS: {
            green: 'rgb(75, 192, 192)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            red: 'rgb(255, 99, 132)',
           
            
        }
    };

    // Data values
    const dataValues = [300, 20, 30, 40, 50, 60];  // Example data values

    const data = {
        labels: ['Active', 'Ready', 'Unverified', 'Trash', 'Settled', 'Delete'],  // Updated labels
        datasets: [
            {
                label: 'User',
                data: dataValues,  // Set data using array
                backgroundColor: Object.values(Utils.CHART_COLORS),
            }
        ]
    };

    // Config
    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Registered Counts'
                }
            }
        },
    };

    // Initialize the chart
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    //Select Year
     // Get the current year
     const currentYear = new Date().getFullYear();

     // Select the dropdown element
     const $pastYearSelect = $('#pastYearSelect');
     
     // Populate the dropdown with past years (from the current year to the last year)
     for (let i = currentYear; i >= (currentYear - 70); i--) {
         $pastYearSelect.append($('<option>', {
             value: i,
             text: i
         }));
     }
     
     // Handle change event when the user selects a past year
     $pastYearSelect.on('change', function() {
         const selectedYear = $(this).val();
         console.log(selectedYear);
     });
     
}else if (window.location.href === usersPage){
    //User Details Page validations

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.userName').length && !$(event.target).closest('.logout').length) {
            $('.logout').hide();
        }
    });

    $('.userName').click(function(event){
        event.preventDefault();
        $('.logout').toggle();
    });
    // Logout functionality
    $('.logout a').click(function(event) {
        event.preventDefault();
        // Perform logout action (clear session, etc.)

        // Redirect to the login page
        window.location.href = 'login.html'; // Replace 'login.html' with the actual URL of the login page
    });

    //Side Nav
    let btn = document.querySelector("#menu-btn");
    let sidebar = document.querySelector(".sidebar");
    let menu_title = document.querySelector("#menu_title");

    btn.onclick = () => {
        sidebar.classList.toggle('active');

        // Toggle between fa-bars and fa-times
        if (btn.classList.contains('fa-bars')) {
            btn.classList.remove('fa-bars');
            btn.classList.add('fa-times');
            $(menu_title).text("Close")
        } else {
            btn.classList.remove('fa-times');
            btn.classList.add('fa-bars');
            $(menu_title).text("Menu")
        }
    };

    /* Tab View Code  */
    // Get all tab buttons and tab panels
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanels = document.querySelectorAll('.tab-panel');

    // Add event listeners to tab buttons
    tabButtons.forEach(button => {
    button.addEventListener('click', () => {
        console.log("clicked");
        // Remove 'active' class from all buttons and panels
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabPanels.forEach(panel => panel.classList.remove('active'));

        // Add 'active' class to clicked button and corresponding panel
        button.classList.add('active');
        const tabId = button.getAttribute('data-tab');
        const tabPanel = document.getElementById(tabId);
        tabPanel.classList.add('active');
    });
    });

        //Table Code 
        var table; // Declare table variable in global scope

            $.ajax({
                url: './data.json', // Path to your JSON file
                dataType: 'json',
                success: function(data) {
                       
                    // Initialize DataTable with fetched data
                    table = $('#dataTable').DataTable({
                        data: data,
                        columns: [
                            { data: 'id' },
                            { data: 'profile_for' },
                            { data: 'name' },
                            { data: 'gender' },
                            { data: 'date_of_birth' },
                            { data: 'currently_residing_in_country' },
                            { data: 'currently_residing_in_state' },
                            { data: 'email_id' },
                            { data: 'primary_contact_number' },
                            { data: 'whatsapp_number' },
                            { data: 'marital_status' },
                            { data: 'caste' },
                            { data: 'height' },
                            { data: 'weight' },
                            { data: 'mother_tongue' },
                            { data: 'denomination' },
                            { data: 'complexion' },
                            { data: 'last_education_level' },
                            { data: 'company_name' },
                            { data: 'work_location' },
                            { data: 'occupation' },
                            { data: 'annual_income' },
                            { data: 'father_name' },
                            { data: 'father_occupation' },
                            { data: 'mother_name' },
                            { data: 'mother_occupation' },
                            { data: 'family_status' },
                            { data: 'number_of_brothers' },
                            { data: 'brothers_married' },
                            { data: 'number_of_sisters' },
                            { data: 'sisters_married' },
                            { data: 'address' },
                            { data: 'perm_address' },
                            { data: 'citizen_of' },
                            { 
                                data: 'photo',
                                title: 'Photo',
                                render: function(data, type, row) {
                                    // Check if the data is not empty
                                    if (data !== "") {
                                        // Return HTML for displaying the image
                                        return '<div style="position: relative;">' +
                                                    '<img src="./assets/img/' + data + '" class="ProfImg" alt="Photo" style="width: 100%; height: auto;">' +
                                                    '<button class="downProfImg" data-src="./assets/img/' + data + '" style="position: absolute; top: 0; right: 0;"><img src="./assets/img/prof_down.svg" alt=""></button>' +
                                                '</div>';
                                    } else {
                                        // If data is empty, return empty string
                                        return '';
                                    }
                                }
                            },
                            {
                                data: 'status',
                                title: 'Status',
                                render: function(data, type, row) {
                                    // Check if the data is not empty
                                    if (data !== "") {
                                        // Return HTML for displaying the status with an icon
                                        return '<span>' + data + '</span>' +
                                            '<img src="./assets/img/table_tick_icon.svg" class="statusIcon" alt="active" ">'; // Replace 'fas fa-info-circle' with your desired icon class
                                    } else {
                                        // If data is empty, return empty string
                                        return '';
                                    }
                                }
                            },
                            
                            { data: null, defaultContent: 
                                '<button class="edit edit_table"><img src="./assets/img/editTable_icon.svg" class="action_icons" alt="" "></button> <button class="view_table"><img src="./assets/img/viewTable_icon.svg" class="action_icons" alt="" "></button> <button class="delete_table"><img src="./assets/img/deleteTable_icon.svg" class="action_icons" alt="" "></button>' }
                        ],
                        columnDefs: [
                            { width: '20%', targets: 0 },
                        ],
                        fixedColumns: {
                            start: 0,
                            end: 1
                        },
                        scrollCollapse: true,
                        scrollX: true,
                        autoWidth: false,

                        dom: '<"dt-length"l><"topStart"Bf>rtip',
                        buttons: ['excel'],
                        initComplete: function () {
                            // After DataTable initialization is complete
                            var svgIcon = '<svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M7.76562 7.93275L3.84066 5.2785L4.62498 4.73925L7.21094 6.4875V0H8.32031V6.4875L10.9052 4.74L11.6906 5.2785L7.76562 7.93275ZM1.79164 10.5C1.28133 10.5 0.855328 10.3845 0.51364 10.1535C0.171953 9.9225 0.000739583 9.63425 0 9.28875V7.4715H1.10938V9.28875C1.10938 9.40375 1.18037 9.5095 1.32237 9.606C1.46437 9.7025 1.6208 9.7505 1.79164 9.75H13.7396C13.9097 9.75 14.0661 9.702 14.2089 9.606C14.3516 9.51 14.4226 9.40425 14.4219 9.28875V7.4715H15.5312V9.28875C15.5312 9.63375 15.3604 9.92175 15.0187 10.1528C14.677 10.3837 14.2507 10.4995 13.7396 10.5H1.79164Z" fill="white"/> </svg>';
                            $('.buttons-excel span').prepend(svgIcon);
                        }
                    });
                }   
            });
        
        // Add row
        $('#addRow').on('click', function() {
            table.row.add({
                "id": '',
                "profile_for": '',
                "name": '',
                "gender": '',
                "date_of_birth": '',
                "currently_residing_in_country": '',
                "currently_residing_in_state": '',
                "email_id": '',
                "primary_contact_number": '',
                "whatsapp_number": '',
                "marital_status": '',
                "caste": '',
                "height": '',
                "weight": '',
                "mother_tongue": '',
                "denomination": '',
                "complexion": '',
                "last_education_level": '',
                "company_name": '',
                "work_location": '',
                "occupation": '',
                "annual_income": '',
                "father_name": '',
                "father_occupation": '',
                "mother_name": '',
                "mother_occupation": '',
                "family_status": '',
                "number_of_brothers": '',
                "brothers_married": '',
                "number_of_sisters": '',
                "sisters_married": '',
                "address": '',
                "perm_address": '',
                "citizen_of": '',
                "photo": ''
            }).draw(true);
        });
        // Edit row
        $('#dataTable').on('click', '.edit', function() {
            
        var rowData = table.row($(this).parents('tr')).data();
        console.log(rowData);
        
        // Populate input fields with row data
        var profile_For_value = rowData.profile_for;
        var name = rowData.name;
        var gender = rowData.gender;
        var date_of_birth = rowData.date_of_birth;
        var currently_residing_in_country = rowData.currently_residing_in_country;
        var currently_residing_in_state = rowData.currently_residing_in_state;
        var email_id = rowData.email_id;
        var primary_contact_number = rowData.primary_contact_number;
        var whatsapp_number = rowData.whatsapp_number;
        var marital_status = rowData.marital_status;
        var caste = rowData.caste;
        var height = rowData.height;
        var weight = rowData.weight;
        var mother_tongue = rowData.mother_tongue;
        var denomination = rowData.denomination;
        var complexion = rowData.complexion;
        var last_education_level = rowData.last_education_level;
        var company_name = rowData.company_name;
        var work_location = rowData.work_location;
        var occupation = rowData.occupation;
        var annual_income = rowData.annual_income;
        var father_name = rowData.father_name;
        var father_occupation = rowData.father_occupation;
        var mother_name = rowData.mother_name;
        var mother_occupation = rowData.mother_occupation;
        var family_status = rowData.family_status;
        var number_of_brothers = rowData.number_of_brothers;
        var brother_marrital_status = rowData.brothers_married;  
        var sister_marrital_status = rowData.sisters_married;
        var number_of_sisters = rowData.number_of_sisters;
        var address = rowData.address;
        var perm_address = rowData.perm_address;
        var citizen_of = rowData.citizen_of;
        var photoUpload = rowData.photo;

        // Set input field values
        $('#editProfileFor').val(profile_For_value.toLowerCase());
        $('#editGender').val(gender.toLowerCase());
        $('#editName').val(name);
        $('#editDateOfBirth').val(date_of_birth);
        $('#editCountry').val(currently_residing_in_country);
        $('#editState').val(currently_residing_in_state);
        $('#editEmail').val(email_id);
        $('#editPrimaryContact').val(primary_contact_number);
        $('#editWhatsapp').val(whatsapp_number);
        $('#editMaritalStatus').val(marital_status.toLowerCase());
        $('#editMotherTongue').val(mother_tongue.toLowerCase());
        $('#editCaste').val(caste.toLowerCase());
        $('#editHeight').val(height.toLowerCase());
        $('#editWeight').val(weight);
        $('#editDenomination').val(denomination.toLowerCase());
        $('#editComplexion').val(complexion.toLowerCase());
        $('#editLastEducation').val(last_education_level);
        $('#editCompanyName').val(company_name);
        $('#editWorkLocation').val(work_location);
        $('#editOccupation').val(occupation);
        $('#editAnnualIncome').val(annual_income);
        $('#editFatherName').val(father_name);
        $('#editFatherOccupation').val(father_occupation);
        $('#editMotherName').val(mother_name);
        $('#editMotherOccupation').val(mother_occupation);
        $('#editFamilyStatus').val(family_status.toLowerCase());
        $('#editBrothers').val(number_of_brothers.toLowerCase());
        $('#editBrotherMarried').val(brother_marrital_status.toLowerCase());
        $('#editSisters').val(number_of_sisters.toLowerCase());
        $('#editSisterMarried').val(sister_marrital_status.toLowerCase());
        $('#editAddress').val(address);
        $('#editPermAddress').val(perm_address);
        $('#editCitizenOf').val(citizen_of);
        $('#editphoto').val();
        
        // Call populateStates with the selected state value
        populateStates("editCountry", "editState", currently_residing_in_state);
        // Show edit modal
        $('#editModal').modal('show');

        
        });
        // Save changes
        $('#saveChanges').on('click', function() {
            var newProfileFor = $('#editProfileFor').val();
            var newGender = $('#editGender').val();
            var newName = $('#editName').val();
            var newDateOfBirth = $('#editDateOfBirth').val();
            var newCountry = $('#editCountry').val();
            var newState = $('#editState').val();
            var newEmail = $('#editEmail').val();
            var newPrimaryContact = $('#editPrimaryContact').val();
            var newWhatsapp = $('#editWhatsapp').val();
            var newMaritalStatus = $('#editMaritalStatus').val();
            var newMotherTongue = $('#editMotherTongue').val();
            var newCaste = $('#editCaste').val();
            var newHeight = $('#editHeight').val();
            var newWeight = $('#editWeight').val();
            var newDenomination = $('#editDenomination').val();
            var newComplexion = $('#editComplexion').val();
            var newLastEducation = $('#editLastEducation').val();
            var newCompanyName = $('#editCompanyName').val();
            var newWorkLocation = $('#editWorkLocation').val();
            var newOccupation = $('#editOccupation').val();
            var newAnnualIncome = $('#editAnnualIncome').val();
            var newFatherName = $('#editFatherName').val();
            var newFatherOccupation = $('#editFatherOccupation').val();
            var newMotherName = $('#editMotherName').val();
            var newMotherOccupation = $('#editMotherOccupation').val();
            var newFamilyStatus = $('#editFamilyStatus').val();
            var newBrothers = $('#editBrothers').val();
            var newSisters = $('#editSisters').val();
            var newAddress = $('#editAddress').val();
            var newCitizenOf = $('#editCitizenOf').val();
            var newPhoto = $('#editphoto').val();
            console.log(newPhoto);


            var index = table.row('.selected').index();
            var row = table.row(index).node();

            $(row).find('td:eq(0)').text(newProfileFor);
            $(row).find('td:eq(1)').text(newGender);
            $(row).find('td:eq(2)').text(newName);
            $(row).find('td:eq(3)').text(newDateOfBirth);
            $(row).find('td:eq(4)').text(newCountry);
            $(row).find('td:eq(5)').text(newState);
            $(row).find('td:eq(6)').text(newEmail);
            $(row).find('td:eq(7)').text(newPrimaryContact);
            $(row).find('td:eq(8)').text(newWhatsapp);
            $(row).find('td:eq(9)').text(newMaritalStatus);
            $(row).find('td:eq(10)').text(newMotherTongue);
            $(row).find('td:eq(11)').text(newCaste);
            $(row).find('td:eq(12)').text(newHeight);
            $(row).find('td:eq(13)').text(newWeight);
            $(row).find('td:eq(14)').text(newDenomination);
            $(row).find('td:eq(15)').text(newComplexion);
            $(row).find('td:eq(16)').text(newLastEducation);
            $(row).find('td:eq(17)').text(newCompanyName);
            $(row).find('td:eq(18)').text(newWorkLocation);
            $(row).find('td:eq(19)').text(newOccupation);
            $(row).find('td:eq(20)').text(newAnnualIncome);
            $(row).find('td:eq(21)').text(newFatherName);
            $(row).find('td:eq(22)').text(newFatherOccupation);
            $(row).find('td:eq(23)').text(newMotherName);
            $(row).find('td:eq(24)').text(newMotherOccupation);
            $(row).find('td:eq(25)').text(newFamilyStatus);
            $(row).find('td:eq(26)').text(newBrothers);
            $(row).find('td:eq(27)').text(newSisters);
            $(row).find('td:eq(28)').text(newAddress);
            $(row).find('td:eq(29)').text(newCitizenOf);
            $(row).find('td:eq(30)').text(newPhoto);
            $('#editModal').modal('hide');
        });
        // Save changes
        $('#closeModal').on('click', function() {
            // Hide edit modal
            $('#editModal').modal('hide');
        });
        // Delete row
        $('#dataTable').on('click', '.delete_table', function() {
            table.row($(this).parents('tr')).remove().draw(false);
        });
        // Image Download 
        $(document).on('click', '.downProfImg', function() {
            // Retrieve the image source URL from the data-src attribute of the clicked button
            var imgSrc = $(this).data('src');
            // Check if imgSrc is not empty
            if (imgSrc) {
                var link = document.createElement('a');
                link.href = imgSrc;
                link.download = 'profile.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
        
        //Edit form fields validation code
        var currentDate = new Date();
        var maxDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate()); // Date 18 years ago

        $('#editDateOfBirth').datepicker({
            uiLibrary: 'bootstrap5',
            endDate: maxDate,
            format: 'yyyy-mm-dd',
            autoclose: true,
            //todayHighlight: true
        });

        // Event listener for changes in radio buttons
        const primaryNum = document.querySelector("#editPrimaryContact");
        const primaryNumItt = window.intlTelInput(primaryNum, {
            initialCountry: "in",
            nationalMode: false,
            separateDialCode: true,
            showSelectedDialCode: true,
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
        const whatsappNum = document.querySelector("#editWhatsapp");
        const whatsappNumItt = window.intlTelInput(whatsappNum, {
            initialCountry: "in",
            nationalMode: false,
            separateDialCode: true,
            showSelectedDialCode: true,
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

        // Annual Income Code
        $(document).on("input keyup", ".price-format-input", function (e) {
            // Allow only numbers and certain control keys (e.g., backspace, delete)
            if (e.type === "keypress" && (e.which < 48 || e.which > 57)) {
                e.preventDefault();
                return;
            }

            let val = this.value.replace(/,/g, "");

            // Prevent leading zero
            if (val.length === 1 && val === '0') {
                e.preventDefault();
                return;
            }

            // Format with commas according to Indian numbering system
            if (val.length > 3) {
                let lastThree = val.substring(val.length - 3);
                let otherNumbers = val.substring(0, val.length - 3);
                if (otherNumbers !== '') {
                    lastThree = ',' + lastThree;
                }
                let formattedValue = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                this.value = formattedValue;
            } else {
                this.value = val;
            }

            // Update text below the input field with the amount in words
            let amountInText = convertToIndianWords(val.replace(/,/g, ''));
            $("#textBelowIncome").text(" " + amountInText);

            // Hide textBelowIncome if annual_income is empty
            if ($(this).val() === '') {
                $("#textBelowIncome").hide();
            } else {
                $("#textBelowIncome").show();
            }
        });

        // Function to convert a number to words in the Indian numbering system
        function convertToIndianWords(num) {
            const ones = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
            const tens = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
            const higher = ['Thousand', 'Lakh', 'Crore'];

            if (num === '0') return 'Zero';
            
            function getBelowThousand(n) {
                if (n < 20) return ones[n];
                if (n < 100) return tens[Math.floor(n / 10) - 2] + (n % 10 ? ' ' + ones[n % 10] : '');
                return ones[Math.floor(n / 100)] + ' Hundred' + (n % 100 ? ' ' + getBelowThousand(n % 100) : '');
            }

            let result = '';
            let n = parseInt(num, 10);
            
            if (n >= 10000000) {
                result += getBelowThousand(Math.floor(n / 10000000)) + ' Crore ';
                n = n % 10000000;
            }
            if (n >= 100000) {
                result += getBelowThousand(Math.floor(n / 100000)) + ' Lakh ';
                n = n % 100000;
            }
            if (n >= 1000) {
                result += getBelowThousand(Math.floor(n / 1000)) + ' Thousand ';
                n = n % 1000;
            }
            if (n > 0) {
                result += getBelowThousand(n);
            }
            
            return result.trim();
        }
        // Set focus on the annual_income input field
        $("#editAnnualIncome").focus();

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
          
          $("#editphoto").change(function() {
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
            $("#editphoto").val("");
            //$("#ImgPreview").attr("src", "");
            $("#ImgPreview").hide(function(){
                $("#ImgPreview").attr("src", "");
            });
            $('.preview1').removeClass('it');
            $('.btn-rmv1').removeClass('rmv');
          });
  
}else if (window.location.href === userDetailsPage){
    //User Details Page

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.userName').length && !$(event.target).closest('.logout').length) {
            $('.logout').hide();
        }
    });

    $('.userName').click(function(event){
        event.preventDefault();
        $('.logout').toggle();
    });
    // Logout functionality
    $('.logout a').click(function(event) {
        event.preventDefault();
        // Perform logout action (clear session, etc.)

        // Redirect to the login page
        window.location.href = 'login.html'; // Replace 'login.html' with the actual URL of the login page
    });

    //Side Nav
    let btn = document.querySelector("#menu-btn");
    let sidebar = document.querySelector(".sidebar");
    let menu_title = document.querySelector("#menu_title");

    btn.onclick = () => {
        sidebar.classList.toggle('active');

        // Toggle between fa-bars and fa-times
        if (btn.classList.contains('fa-bars')) {
            btn.classList.remove('fa-bars');
            btn.classList.add('fa-times');
            $(menu_title).text("Close")
        } else {
            btn.classList.remove('fa-times');
            btn.classList.add('fa-bars');
            $(menu_title).text("Menu")
        }
    };

    //Image Download
    $('.downProfImg').click(function() {
        var imgSrc = document.getElementById('ProfileImg').getAttribute('src');
        var link = document.createElement('a');
        link.href = imgSrc;
        link.download = 'profile.png';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    $(".backBtn").click(function(){
        window.history.back();
    });
    
}else if (window.location.href === generateQRPage){
   //Generate QR Code 

   $(document).on('click', function(event) {
    if (!$(event.target).closest('.userName').length && !$(event.target).closest('.logout').length) {
        $('.logout').hide();
    }
    });

    $('.userName').click(function(event){
        event.preventDefault();
        $('.logout').toggle();
    });
    // Logout functionality
    $('.logout a').click(function(event) {
        event.preventDefault();
        // Perform logout action (clear session, etc.)

        // Redirect to the login page
        window.location.href = 'login.html'; // Replace 'login.html' with the actual URL of the login page
    });

    //Side Nav
    let btn = document.querySelector("#menu-btn");
    let sidebar = document.querySelector(".sidebar");
    let menu_title = document.querySelector("#menu_title");

    btn.onclick = () => {
        sidebar.classList.toggle('active');

        // Toggle between fa-bars and fa-times
        if (btn.classList.contains('fa-bars')) {
            btn.classList.remove('fa-bars');
            btn.classList.add('fa-times');
            $(menu_title).text("Close")
        } else {
            btn.classList.remove('fa-times');
            btn.classList.add('fa-bars');
            $(menu_title).text("Menu")
        }
    };

    /* Tab View Code  */
    // Get all tab buttons and tab panels
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanels = document.querySelectorAll('.tab-panel');

    // Add event listeners to tab buttons
    tabButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Remove 'active' class from all buttons and panels
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabPanels.forEach(panel => panel.classList.remove('active'));

        // Add 'active' class to clicked button and corresponding panel
        button.classList.add('active');
        const tabId = button.getAttribute('data-tab');
        const tabPanel = document.getElementById(tabId);
        tabPanel.classList.add('active');


        if(tabId == 'generate-qr'){
            //Change Title
            $('#qr-title').text('Generate QR Code By Event');
        }else if(tabId == 'qr-details'){
            $('#qr-title').text('Generated QR Code Details');
        }else{
            $('#qr-title').text('Default QR Code');
        }
    });
    });

    // Default QR Download
    $('#default-downloadLink').click(function() {
        var imgSrc = document.getElementById('default-qrcode').querySelector('img').getAttribute('src');
        var link = document.createElement('a');
        link.href = imgSrc;
        link.download = 'qrcode.png';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    $("#default-copyButton").click( function() {
            var qrcodeURL = document.getElementById("default-qrcodeURL").textContent;
            navigator.clipboard.writeText(qrcodeURL)
                .then(() => {
                    $("#default-copyHint").addClass("show"); // Show the hint
                    setTimeout(function() {
                        $("#default-copyHint").removeClass("show"); // Hide the hint after 2 seconds
                    }, 500);
                })
                .catch(err => {
                    console.error('Error copying URL to clipboard:', err);
                });
    });

    // Generate QR Code validation 

    //$('#editModal').modal('show');

     //Generate QR Code Page validations
     var currentDate = new Date();
        $('#eventDate').datepicker({
            uiLibrary: 'bootstrap5',
            startDate: currentDate, // Set start date as current date
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        }).on('change', function() {
            // Trigger validation when the datepicker value changes
            var $this = $(this);
            $this.valid();
        });
     
    $('#generateQRForm').validate({
        rules: {
            eventName: {
                required: true,
                minlength: 1,
                maxlength: 60
                
            },
            eventDate: {
                required: true,
            },
            event_location: {
                required: true,
            }
            // Add more fields and their validation rules as needed
        },
        messages: {
            eventName: {
                required: "Please enter your event name",
                minlength: "Event name should be must be 1 letters.", // Minimum length of 10 digits
                maxlength: "Event name cannot be more than 60 letters"
            },
            eventDate: {
                required: "Please select event date",
            },
            event_location: {
                required: "Please select event location",
            }
            // Add more messages for other fields as needed
        },
        submitHandler: function(form) {
            // If form is valid, handle submission here
            // You can access the values of fields using jQuery
            $(".loader").show();
            setTimeout(function() {
                $(".loader").hide();
                generateQRCode();
                $("#popupView").show('slow');
                $(form).trigger("reset");
            }, 2000);

            /* Qr code generate function */
            function generateQRCode() {
    
                // Append the URL with an identifier to the text
                var identifier = generateIdentifier(); // Generate unique identifier
                var registerPageURL = "https://example.com/register?id=" + identifier; // Replace with your register page URL
                var combinedText = registerPageURL;
            
                var qrcode = new QRCode(document.getElementById("qrcode"), {
                    text: combinedText,
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            
                // Display the URL below the QR code
                var qrcodeURL = document.getElementById("qrcodeURL");
                qrcodeURL.textContent = registerPageURL;
                // Show the copy button
                var copyButton = document.getElementById("copyButton");
                copyButton.style.display = "inline-block";
            
                // Convert the QR code to a PNG image
                var downloadLink = document.getElementById("downloadLink");
                var qrCanvas = document.getElementById("qrcode").getElementsByTagName("canvas")[0];
                var qrDataURL = qrCanvas.toDataURL("image/png");
                downloadLink.style.display = "inline-block";
            
                // Show the download button
            
                downloadLink.href = qrDataURL;
                downloadLink.style.display = "inline-block";
            
                // Add event listener to download button
                downloadLink.addEventListener("click", function(event) {
                    // Prevent default link behavior
                    event.preventDefault();
                    
                    // Create a temporary anchor element
                    var tempLink = document.createElement("a");
                    tempLink.href = downloadLink.href;
                    tempLink.download = "qrcode.png"; // Set the filename for the downloaded image
            
                    // Append the anchor element to the body
                    document.body.appendChild(tempLink);
                    
                    // Trigger the click event of the anchor element
                    tempLink.click();
                    
                    // Remove the anchor element from the body
                    document.body.removeChild(tempLink);
            });

            $("#copyButton").click( function() {
                var qrcodeURL = document.getElementById("qrcodeURL").textContent;
                navigator.clipboard.writeText(qrcodeURL)
                    .then(() => {
                        $("#copyHint").addClass("show"); // Show the hint
                        setTimeout(function() {
                            $("#copyHint").removeClass("show"); // Hide the hint after 2 seconds
                        }, 500);
                    })
                    .catch(err => {
                        console.error('Error copying URL to clipboard:', err);
                    });
            });
            
            /* Close icon */
            $('.close-btn').click(function(){
                $('#popupView').hide('slow');
                setTimeout(function() {
                    $("#qrcode").empty();
                    $("#qrcodeURL").empty();
                }, 500);
            });
            
            function generateIdentifier() {
                // Generate a random number or use any other method to generate a unique identifier
                return Math.floor(Math.random() * 10000);
            }
            
            }
            
        },
    });
    
    /*QR Code Details*/
        // Get the current year
        const currentYear = new Date().getFullYear();
        // Select the dropdown element
        const $pastYearSelect = $('#pastYearSelect');
        // Populate the dropdown with past years (from the current year to the last year)
        for (let i = currentYear; i >= (currentYear - 7); i--) {
            $pastYearSelect.append($('<option>', {
                value: i,
                text: i
            }));
        };
        // Function to search by event name
        $('#searchBox').keyup(function() {
            var searchText = $(this).val().toUpperCase();
            $('.event-info').each(function() {
                var eventName = $(this).find('h6').text().toUpperCase();
                if (eventName.indexOf(searchText) !== -1) {
                    $(this).parent('.qrCode-detail').parent('.qrCode-detail-cardItems').show();
                } else {
                        $(this).parent('.qrCode-detail').parent('.qrCode-detail-cardItems').hide();
                }
            });
        });

        // Image Download 
        $('.downEventQR').click(function() {
            const closestQRCodeImg = $(this).closest('.downQR-eventImg').find('.qrCodeImg');
            const imgSrc = closestQRCodeImg.attr('src');
            const link = document.createElement('a');
            link.href = imgSrc;
            link.download = 'qrcode.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
          });

          $(".event-copyButton").click(function() {
            const closestQRCodeURL = $(this).closest('.copy-eventUrl').find('.event-qrcodeURL');
            const qrcodeURL = closestQRCodeURL.text();
          
            navigator.clipboard.writeText(qrcodeURL)
              .then(() => {
                $(this).siblings('.event-copyHint').addClass("show"); // Show the hint
                setTimeout(() => {
                  $(this).siblings('.event-copyHint').removeClass("show"); // Hide the hint after 2 seconds
                }, 500);
              })
              .catch(err => {
                console.error('Error copying URL to clipboard:', err);
              });
          });

        
}else if (window.location.href === settingsPage){
    //Settings Page Validation

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.userName').length && !$(event.target).closest('.logout').length) {
            $('.logout').hide();
        }
    });

    $('.userName').click(function(event){
        event.preventDefault();
        $('.logout').toggle();
    });
    // Logout functionality
    $('.logout a').click(function(event) {
        event.preventDefault();
        // Perform logout action (clear session, etc.)

        // Redirect to the login page
        window.location.href = 'login.html'; // Replace 'login.html' with the actual URL of the login page
    });

    //Side Nav
    let btn = document.querySelector("#menu-btn");
    let sidebar = document.querySelector(".sidebar");
    let menu_title = document.querySelector("#menu_title");

    btn.onclick = () => {
        sidebar.classList.toggle('active');

        // Toggle between fa-bars and fa-times
        if (btn.classList.contains('fa-bars')) {
            btn.classList.remove('fa-bars');
            btn.classList.add('fa-times');
            $(menu_title).text("Close")
        } else {
            btn.classList.remove('fa-times');
            btn.classList.add('fa-bars');
            $(menu_title).text("Menu")
        }
    };

    /* $('#generatePassword').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        // Validate the form
        if ($(this).valid()) {
            // If the form is valid, proceed with your custom action
            // For demonstration, we'll log a success message
            console.log("Form submitted successfully!");
            
            
        }
    }); */

    //passpattern= "(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#&()–{}:;,/*~$^+=<>]).{10,100}"

    $.validator.addMethod("notEqualToOldPassword", function(value, element) {
        return value !== $("#old_password").val();
    }, "New password must be different from the old password.");
    
    // Initialize form validation
    $('#generatePassword').validate({
        rules: {
            old_password: {
                required: true,
                minlength: 8,
                maxlength: 14
            },
            new_password: {
                required: true,
                notEqualToOldPassword: true,
                minlength: 8,
                maxlength: 14
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password",
                minlength: 8,
                maxlength: 14
            }
        },
        messages: {
            old_password: {
                required: "Please enter the old password.",
                minlength: "Password must be at least 8 characters long.",
                maxlength: "Password must not exceed 14 characters."
            },
            new_password: {
                required: "Please enter the new password.",
                minlength: "Password must be at least 8 characters long.",
                maxlength: "Password must not exceed 14 characters."
            },
            confirm_password: {
                required: "Please enter the confirm password.",
                equalTo: "Passwords do not match.",
                minlength: "Password must be at least 8 characters long.",
                maxlength: "Password must not exceed 14 characters."
            }
        },
        submitHandler: function(form) {
            // Perform the form submission, for example with an AJAX request
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    // Show success message
                    $('.passwordUpdated').fadeIn();
                    
                    // Hide success message after 4 seconds
                    setTimeout(function(){
                        // Clear the form fields
                        form.reset();
                        $('.passwordUpdated').fadeOut();
                    }, 2000);
                }
            });
        }
    });
    /*  // Show success message
            $('.passwordUpdated').fadeIn();
            // Hide success message after 4 seconds
            setTimeout(function(){
                $('.passwordUpdated').fadeOut();
            }, 4000); */
}else{
alert("Page not Found!")
}

});

