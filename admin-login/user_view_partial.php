<?php 
	include 'layouts/session.php';
	
	$bnr_id = isset($_GET['bnr_id']) ? $_GET['bnr_id'] : '';
	
	$sql = "SELECT *,u.created_date as registered_date FROM bnr_user u
        
        WHERE u.bnr_id = ?";

		$stmt = $link->prepare($sql);
		$stmt->bind_param("s", $bnr_id);
		$stmt->execute();
		$result = $stmt->get_result();

		$data = array();

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$data = $row;
			}
		}
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="shortcut icon" href="../assets1/img/bnr-fav.png" type="image/x-icon">

    <!-- Style Files -->
    <link rel="stylesheet" href="../assets1/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets1/css/font-awesome.min.css">
    <!-- Datatable -->
    <link rel="stylesheet" href="../assets1/datatables/datatables.min.css">
    <link rel="stylesheet" href="../assets1/datatables/dataTables.dataTables.css">
    <link rel="stylesheet" href="../assets1/datatables/DateTime-1.5.2/css/dataTables.dateTime.min.css">
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
                  <h1>User Details</h1>
                  <div class="space-between mt_50">
                    
                    <button class="userStatusBtn activeUser"><?php echo $data['registration_status']; ?> user</button>
                  </div>
                  
                  <div class="tableDetail ptb_30 ">
                    <div class="info-title">
                        <h2>Mandatory Form</h2>
                    </div>
                    <div class="dataItems">
                        <div class="dataItem propertyName">
                            <p><b>User ID :</b></p>
                        </div>
                        <div class="dataItem propertyValue">
                            <p><b><?php echo $data['bnr_id']; ?></b></p>
                        </div>
                    </div>
                    <div class="dataItems">
                        <div class="dataItem propertyName">
                            <p>Profile   Created for :</p>
                        </div>
                        <div class="dataItem propertyValue">
                            <p><?php echo $data['profile_created_for']; ?></p>
                        </div>
                    </div>
                    <div class="dataItems">
                        <div class="dataItem propertyName">
                            <p>Name :</p>
                        </div>
                        <div class="dataItem propertyValue">
                            <p><?php echo $data['first_name']; ?> <?php echo $data['last_name']; ?></p>
                        </div>
                    </div>
                    <div class="dataItems">
                        <div class="dataItem propertyName">
                            <p>Gender :</p>
                        </div>
                        <div class="dataItem propertyValue">
                            <p><?php echo $data['gender']; ?></p>
                        </div>
                    </div>
                    <div class="dataItems">
                        <div class="dataItem propertyName">
                            <p>Date of Birth</p>
                        </div>
                        <div class="dataItem propertyValue">
                            <p><?php echo $data['date_of_birth']; ?></p>
                        </div>
                    </div>
                    
                    <div class="dataItems">
                        <div class="dataItem propertyName">
                            <p>Email Id :</p>
                        </div>
                        <div class="dataItem propertyValue">
                            <p><?php echo $data['email_id']; ?></p>
                        </div>
                    </div>
                    <div class="dataItems">
                        <div class="dataItem propertyName">
                            <p>Primary  Contact Number :</p>
                        </div>
                        <div class="dataItem propertyValue">
                            <p><?php echo $data['contact_number']; ?></p>
                        </div>
                    </div>
                    <div class="dataItems">
                        <div class="dataItem propertyName">
                            <p>Whatsapp Number :</p>
                        </div>
                        <div class="dataItem propertyValue">
                            <p><?php echo $data['whatsapp_number']; ?></p>
                        </div>
                    </div>
					<div class="dataItems">
                        <div class="dataItem propertyName">
                            <p>Currently Residing in Country :</p>
                        </div>
                        <div class="dataItem propertyValue">
                            <p><?php echo $data['country']; ?></p>
                        </div>
                    </div>
                    <div class="dataItems">
                        <div class="dataItem propertyName">
                            <p>Currently Residing in State :</p>
                        </div>
                        <div class="dataItem propertyValue">
                            <p><?php echo $data['state']; ?></p>
                        </div>
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
    <!-- plugin Files -->
    
    <script>
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

    </script>
</body>
</html>