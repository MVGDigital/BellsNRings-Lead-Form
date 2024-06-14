<?php 
	include 'layouts/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="shortcut icon" href="../assets1/img/bnr-fav.png" type="image/x-icon">

    <!-- Style Files -->
    <link rel="stylesheet" href="../assets1/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets1/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets1/css/custom.css">
    
    
    <!-- Style Files -->
</head>
<body>
    <!-- Main Container -->
    <div class="admin main-container">
        <div class="dashboardContainer-space">
			<?php include 'layouts/menu.php'; ?>
              <!--======================== Dhashboard Information ========================-->
              <div class="dash_container">
                <!--Section header Section -->
                <div class="item-right">
                    <div class="menus">
                        <div class="d-flex userName">
                            <a href="">Admin 
                                <span><img src="../assets1/img/logout-icon.svg" alt=""></span>
                            </a>
                        </div>
                        <div class="logout">
                            <a href="logout.php">Logout 
                                <span><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Section header Section -->

                <div class="dash_content">
                    <h1 id="qr-title">Settings</h1>

                    <div class="col-12 col-md-6 col-lg-4 m-auto">
                        <div class="mt_50">
                            <!-- Form -->
                            <form name="generatePassword" id="generatePassword" class="form-section" method="post" action="passwordupdate.php">
                                <div class="col-12 mb-3">
                                    <div class="form-field">
                                        <label for="old_password">Old Password <span class="requirdField" >*</span></label>
                                        <div class="password-field">
                                            <input type="password" id="old_password" name="old_password" placeholder="Enter old password">
                                            <span toggle="#old_password" class="eye-icon toggle-password">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-field">
                                        <label for="new_password">New Password <span class="requirdField" >*</span></label>
                                        <div class="password-field">
                                            <input type="password" id="new_password" name="new_password" placeholder="New password">
                                            <span toggle="#new_password" class="eye-icon toggle-password">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-field">
                                        <label for="confirm_password">New Password <span class="requirdField" >*</span></label>
                                        <div class="password-field">
                                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password">
                                            <span toggle="#confirm_password" class="eye-icon toggle-password">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="passwordUpdated">
                                    <p>Password updated successfully!</p>
                                </div>
								<div class="error failedpassword" style="display:none;color:red;text-align: center;
    font-family: 'NotoSans-Regular';
    font-size: 16px !important;">
                                    <p>Password update failed!</p>
                                </div>

                                <div class="col-12 text-center  mt_30 mb_40">
                                    <button type="submit" class="submit_btn">Generate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
              </div>
              <!--======================== Dhashboard Information ========================-->
        </div>
    </div>
    <!-- Main Container -->




    <!-- plugin Files -->
    <script src="../assets1/js/jquery-3.7.1.min.js"></script>
    <script src="../assets1/bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <script src="../assets1/js/jquery.validate.min.js"></script>
    <script src="../assets1/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets1/js/custom.js"></script>
    <!-- plugin Files -->
    
    <script> 

        // Password Toggle Functionality
        const passwordToggles = document.querySelectorAll('.toggle-password');

        passwordToggles.forEach(toggle => {
            const passwordField = document.querySelector(toggle.getAttribute('toggle'));

            toggle.addEventListener('click', function () {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.querySelector('.fa').classList.toggle('fa-eye-slash');
                this.querySelector('.fa').classList.toggle('fa-eye');
            });
        });

    </script>
</body>
</html>