<?php
	require_once "layouts/config.php";
	//header("location: pages-comingsoon.php");
	//	exit;
	if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["forcereset"] == '0') 
	{
		header("location: index.php");
		exit;
	}
	$username = $password = "";
	$username_err = $password_err = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{

		if (empty(trim($_POST["username"]))) 
		{
			$username_err = "Please enter your email.";
		} 
		else 
		{
			$username = trim($_POST["username"]);
		}

		if (empty(trim($_POST["password"]))) 
		{
			$password_err = "Please enter your password.";
		} 
		else 
		{
			$password = trim($_POST["password"]);
		}
		
		$ipaddress = $_SERVER['REMOTE_ADDR'];

		if (empty($username_err) && empty($password_err)) 
		{
			$result=mysqli_query($link,"SELECT * FROM bnr_admin_user WHERE username ='$username' AND password='$password'");
			if($result) 
			{
				if(mysqli_num_rows($result) == 1) 
				{
					$member = mysqli_fetch_assoc($result);
					$user_id = $member['admin_id'];		
					
					$_SESSION["admin_id"] = $member['admin_id'];
					$_SESSION["username"] = $member['username'];
					$_SESSION["loggedin"] = true;
					header("location: index.php");
				} 
				else
				{
					$_SESSION["errorType"] = "danger";
					$_SESSION["errorMsg"] = "Invalid Credentials";
					header("location: auth-login.php");
				}
			}
			else 
			{
				$_SESSION["errorType"] = "danger";
				$_SESSION["errorMsg"] = "Invalid Credentials";
				header("location: auth-login.php");
			}
		}
		mysqli_close($link);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="shortcut icon" href="../assets1/img/bnr-fav.png" type="image/x-icon">

    <!-- Style Files -->
    <link rel="stylesheet" href="../assets1/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets1/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets1/css/custom.css">
    
    
    <!-- Style Files -->
</head>
<body>

<body>

	<div class="loginPage-bg">
       <div class="item-middle height100">
            <div class="login-info col-12 col-md-4 col-lg-3">
                <div class="item-middle">
                    <div class="login-title">
                        <div class="cercle-logo">
                            <span><img src="../assets1/img/bnr-admin-log.png" class="img-fluid" alt=""></span>
                        </div>
                        <h1>login</h1>
                    </div>
                </div>
                <!-- Form -->
                <form method="post" id="loginForm" class="form-section" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <?php if ($ERROR_MSG <> "") { ?>
						<p class="text-danger" role="alert"><?php echo $ERROR_MSG; ?></p>
					<?php } ?>
					<div class="col-12 col-sm-12 mb-3">
                        <div class="form-field">
                            <label for="username">User Name <span class="requirdField" >*</span></label>
                            <input type="text" id="username" name="username" placeholder="Enter user name">
                        </div>
						<span class="text-danger"><?php echo $username_err; ?></span>
                    </div>
                    <div class="col-12 col-sm-12 mb-3">
                        <div class="form-field">
                            <label for="password">Password <span class="requirdField" >*</span></label>
                            <div class="password-field">
                                <input type="password" id="password" name="password" placeholder="Enter password">
                                <span toggle="#password" class="eye-icon toggle-password">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </span>
								
                            </div>
							<span class="text-danger"><?php echo $password_err; ?></span>
                        </div>
                    </div>
    
                    <div class="col-12 text-center  mt_30 mb_40">
                        <button type="submit" class="submit_btn">Login</button>
                    </div>
                </form>
                <!-- Form -->
            </div>
        </div>
    </div>
    
    <script src="../assets1/js/jquery-3.7.1.min.js"></script>
    <script src="../assets1/bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <script src="../assets1/js/jquery.validate.min.js"></script>
    <script src="../assets1/js/custom.js"></script>
</body>
</html>