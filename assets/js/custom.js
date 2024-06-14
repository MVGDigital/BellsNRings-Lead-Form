
$(document).ready(function(){

/* var homePage = "https://mvgdigital.com/bellsnrings/";
var indexPage = "https://mvgdigital.com/bellsnrings/index.html";
var verifyOTPPage = "https://mvgdigital.com/bellsnrings/verify_otp.html";
var detailPage = "https://mvgdigital.com/bellsnrings/detail_form.html";
var successPage = "https://mvgdigital.com/bellsnrings/success.html";
var loginPage = "https://mvgdigital.com/bellsnrings/login.html";
var dashboardPage = "https://mvgdigital.com/bellsnrings/dashboard.html";
var usersPage = "https://mvgdigital.com/bellsnrings/users.html";
var userDetailsPage = "https://mvgdigital.com/bellsnrings/user_details.html";
var generateQRPage =  "https://mvgdigital.com/bellsnrings/generate_qr.html";
var settingsPage = "https://mvgdigital.com/bellsnrings/settings.html"; */

var homePage = "<?php echo $url; >";
var indexPage = "<?php echo $url; >index.php";
var verifyOTPPage = "<?php echo $url; >verify_otp.html";
var detailPage = "<?php echo $url; >detail_form.html";
var successPage = "<?php echo $url; >success.html";
var loginPage = "<?php echo $url; >admin/auth-login.php";
var dashboardPage = "<?php echo $url; >admin/index.php";
var usersPage = "<?php echo $url; >admin/users.php";
var userDetailsPage = "<?php echo $url; >user_details.html";
var generateQRPage =  "<?php echo $url; >admin/generate_qr.php";
var settingsPage = "<?php echo $url; >admin/settings.php";


if (window.location.href === homePage && indexPage) {
    
    
   
}else if(window.location.href === verifyOTPPage) {
   
    
}else if (window.location.href === detailPage) {
    
            
}else if (window.location.href === successPage){

    $("#nav-to-detailForm").click(function(){
        window.location.href = "https://mvgdigital.com/bellsnrings/success.html";
    })
}else if (window.location.href === loginPage){

	setTimeout(function () {
		$('.errormessage').hide();
		$('.errormessage').html();
	}, 3000);
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
     for (let i = currentYear; i >= (currentYear - 25); i--) {
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
   
  
}else if (window.location.href === userDetailsPage){
    //User Details Page

    
    
}else if (window.location.href === generateQRPage){
   //Generate QR Code 

   

        
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
					alert(response);
					if(response == 1)
					{
						$('.passwordUpdated').fadeIn();
						setTimeout(function(){
							// Clear the form fields
							form.reset();
							$('.passwordUpdated').fadeOut();
						}, 2000);
					}
					else
					{
						$('.failedpassword').fadeIn();
						setTimeout(function(){
							// Clear the form fields
							form.reset();
							$('.failedpassword').fadeOut();
						}, 2000);
						
					}
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
}

});

