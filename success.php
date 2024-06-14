<?php
include 'admin-login/layouts/config.php';
if(isset($_GET['bnr_id'])) 
{
	$bnr_id = $_GET['bnr_id'];
	
	function decrypt($data, $key) {
		$cipher = "aes-256-cbc";
		list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
		return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
	}
	
	$decryptbnr_id = decrypt($bnr_id, $encryption_key);
	
	$sql = "SELECT * FROM bnr_user 
	WHERE bnr_id = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("s", $decryptbnr_id);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = array();
	if ($result->num_rows > 0) 
	{
		
	}
	else
	{
		$_SESSION["errorType"] = "danger";
		$_SESSION["errorMsg"] = "Illegal Try";
		header("location:index.php");
	}
}
else
{
	$_SESSION["errorType"] = "danger";
	$_SESSION["errorMsg"] = "Illegal Try";
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <link rel="shortcut icon" href="./assets/img/bnr-fav.png" type="image/x-icon">
    
    <!-- Style Files -->
    <link rel="stylesheet" href="./assets/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">
    
    <!-- Style Files -->
</head>
<body>

    <!-- Header Section -->
    <nav class="navbar navbar-light">
        <div class="container-fluid navbar-menu container-space">
          <a class="navbar-brand"><img src="./assets/img/bnr-logo.png" alt=""></a>
          <form class="d-flex menus">
            
          </form>
        </div>
    </nav>
    <!-- Header Section -->

    <!-- Main Container -->
    <div class="main-container bg-img height100vh">
        <div class="row ml_50 mr_0 form-container height100vh">
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

                    <div class="item-middle">
                        <div class="col-12 col-md-6 col-lg-6 success-content">
                            <div class="success-icon">
                                <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 28C0 20.5739 2.94999 13.452 8.20101 8.20101C13.452 2.94999 20.5739 0 28 0C35.4261 0 42.548 2.94999 47.799 8.20101C53.05 13.452 56 20.5739 56 28C56 35.4261 53.05 42.548 47.799 47.799C42.548 53.05 35.4261 56 28 56C20.5739 56 13.452 53.05 8.20101 47.799C2.94999 42.548 0 35.4261 0 28ZM26.4021 39.984L42.5227 19.8315L39.6107 17.5019L25.8645 34.6789L16.128 26.5664L13.7387 29.4336L26.4021 39.984Z" fill="#06BB44"/>
                                </svg>
                            </div>
                            <h4>Successful!</h4>
                            <p>Congratulations! Your ID has been successfully created.</p>
                            <p>ID Number : <b class=""><?php echo $decryptbnr_id; ?></b></p>
                            <p>Thank you for choosing bells n rings. If you have any questions or need further assistance, feel free to contact our support team at 95000 58852 / 53 or support@bellsnrings.com </p>
                            <div class="col-12 text-center  mt_30 mb_40">
                                <a href="detail_form.php?bnr_id=<?php echo $bnr_id; ?>"><button type="button" id="nav-to-detailForm" class="submit_btn">Continue</button></a>
                            </div>
                        </div>
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




    <!-- plugin Files -->
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <!-- plugin Files -->

    <!--  -->
    <script>
    
    </script>
    <!--  -->
    
</body>
</html>