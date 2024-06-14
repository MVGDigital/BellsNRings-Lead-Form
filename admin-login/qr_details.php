<?php 
	include 'layouts/session.php';
	
	if(isset($_GET['selectedyear']))
	{
		$selectedyear = $_GET['selectedyear'];
	}
	else
	{
		$selectedyear = date("Y");;
	}
	
	$current_year = date("Y");
	$end_year = $current_year - 10; 
	$trash = 0;
	$unverified = 0;
	$ready = 0;
	$active = 0;
	$settled = 0;
	$delete = 0;
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Default QR</title>
    <link rel="shortcut icon" href="../assets1/img/bnr-fav.png" type="image/x-icon">

    <!-- Style Files -->
    <link rel="stylesheet" href="../assets1/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets1/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets1/css/custom.css">
    <script src="../assets1/js/jquery-3.7.1.min.js"></script>
    <script src="../assets1/bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <script src="../assets1/js/jquery.validate.min.js"></script>
    <script src="../assets1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>    
    
    
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
                    <h1 id="qr-title">QR Code Details</h1>

                    <div class="tab-container generateQRTab mt_30">
                        <a href="generate_qr.php" style="cursor: pointer;color: transparent;">
							<button class="tab-button">Default QR Code</button>
						</a>
                        <a href="generate_event_qr.php" style="cursor: pointer;color: transparent;">
							<button class="tab-button">Generate QR Code</button>
						</a>
                        <a href="qr_details.php" style="cursor: pointer;color: transparent;">
							<button class="tab-button active">QR Code Details</button>
						</a>
                    </div>

                    <div class="tab-content mt_30">
                        <div id="qr-details" class="tab-panel active">
                            <div class="space-between mt_30">
                                <div class="selectYear qrField form-field">
                                    <form id="yearForm" method="GET" action="">
										<label for="selectedyear">Select Year :</label>
										<select onchange="updateYear()" id="selectedyear" class="form-select" name="selectedyear" >
											<option value="">--Select Year--</option>
											<?php for ($year = $current_year; $year >= $end_year; $year--) { ?>
												<option <?php if ($selectedyear == $year) { ?> selected <?php } ?>  value="<?php echo $year; ?>"><?php echo $year; ?></option>
											<?php } ?>
										</select>
									</form>
                                </div>
                                <div class="searchField qrField form-field">
                                    <label for="searchBox">Search :</label>
                                    <input type="search" name="" id="searchBox" class="form-select">
                                </div>
                            </div>
                            <!-- Card Items -->

                            <div class="col-lg-10 col-lg-9 mt_50">
                                <div class="qrCode-detail-Container">
                                    
										<?php
											
											$i = 1;
											
											$sql = "select * from bnr_generated_qrcode where YEAR(created_date) = $selectedyear";
											$sql .= " order by qr_id desc";
											$querysel = mysqli_query($link,$sql);
											
											$querysel_cnt = mysqli_num_rows($querysel);
											$req_details = array();
											if($querysel_cnt > 0)
											{	
											    
												while($row=mysqli_fetch_array($querysel)) 
												{
													$sql_query_result[] = $row;
												}
												foreach($sql_query_result as $sql_query_results)
												{
													
													
													
													$sql = "
														SELECT 
															YEAR(created_date) AS year, 
															registration_status, 
															COUNT(*) AS user_count 
														FROM 
															bnr_user 
														WHERE 
															YEAR(created_date) = ? and qr_id = ?
														GROUP BY 
															registration_status
													";

													$stmt = mysqli_prepare($link, $sql);
													
													mysqli_stmt_bind_param($stmt, "ii", $selectedyear, $sql_query_results['qr_id']);
													
													mysqli_stmt_execute($stmt);

													$result = mysqli_stmt_get_result($stmt);
													if (mysqli_num_rows($result) > 0) 
													{
														while($row = mysqli_fetch_assoc($result)) 
														{
															if($row["registration_status"] == 'Trash')
															{
																$trash = $row["user_count"];
															}
															if($row["registration_status"] == 'Unverified')
															{
																$unverified = $row["user_count"];
															}
															if($row["registration_status"] == 'Ready')
															{
																$ready = $row["user_count"];
															}
															if($row["registration_status"] == 'Active')
															{
																$active = $row["user_count"];
															}
															if($row["registration_status"] == 'Settled')
															{
																$settled = $row["user_count"];
															}
															if($row["registration_status"] == 'Delete')
															{
																$delete = $row["user_count"];
															}
														}
													}
										?>
										<div class="qrCode-detail-cardItems">
                                            <div class="qrCode-detail">
                                                <div class="event-info">
                                                    <!--<h6><?php echo $sql_query_results['event_name']; ?></h6>-->
                                                    <h6 id="event-name-<?php echo $sql_query_results['qr_id']; ?>"><?php echo $sql_query_results['event_name']; ?></h6>
                                                    <p><?php echo $sql_query_results['event_location']; ?></p>
                                                    <p><?php echo $sql_query_results['event_date']; ?></p>
                                                </div>
                                                <div class="eventCount-info">
                                                    <div class="coutList">
                                                        <p>Active</p>
                                                        <h5><?php echo $active; ?></h5>
                                                    </div>
                                                    <div class="coutList">
                                                        <p>Ready</p>
                                                        <h5><?php echo $ready; ?></h5>
                                                    </div>
                                                    <div class="coutList">
                                                        <p>Unverified</p>
                                                        <h5><?php echo $unverified; ?></h5>
                                                    </div>
                                                    <div class="coutList">
                                                        <p>Trash</p>
                                                        <h5><?php echo $trash; ?></h5>
                                                    </div>
                                                    <div class="coutList">
                                                        <p>Settled</p>
                                                        <h5><?php echo $settled; ?></h5>
                                                    </div>
                                                    <div class="coutList">
                                                        <p>Delete</p>
                                                        <h5><?php echo $delete; ?></h5>
                                                    </div>
                                                </div>
                                                <div class="eventImg-info">
                                                    <div class="downQR-eventImg">
                                                        <button class="downEventQR" id="generate-download<?php echo $sql_query_results['qr_id']; ?>">
                                                            <img src="../assets1/img/down-eventImg.svg" alt="">
                                                        </button>
                                                    </div>
                                                    <div class="copy-eventUrl">
                                                        <div class="event-qrcodeURL">https://bnrstage.mvgdigital.com/?eve_id=<?php echo $sql_query_results['qr_id']; ?></div>
                                                        <button class="event-copyButton">
                                                            <img src="../assets1/img/copy-eventUrl.svg" alt="">
                                                        </button>
                                                        <div class="event-copyHint">URL copied!</div>
                                                    </div>
                                                </div>
                                                <div class="goToDetail-Table">
                                                    <img src="../assets1/img/navigateArrow.svg" class="img-fluid" alt="">
                                                </div>
                                            </div>
                                            
                                            <script>
                                                $(document).ready(function() {
                                                    $('#generate-download<?php echo $sql_query_results['qr_id']; ?>').click(function() {
                                                        // Create a temporary container for the QR code
                                                        var tempContainer = $('<div></div>').css({
                                                            position: 'absolute',
                                                            top: '-10000px'
                                                        });
                                                        $('body').append(tempContainer);
                                                        
                                                         // Get the event name for the file name
                                                             var eventName = $('#event-name-<?php echo $sql_query_results['qr_id']; ?>').text().trim();
                                        
                                                        // Generate the QR code
                                                        var qrcode = new QRCode(tempContainer[0], {
                                                            text: "https://bnrstage.mvgdigital.com/?eve_id=<?php echo $sql_query_results['qr_id']; ?>",
                                                            width: 500,
                                                            height: 500,
                                                            correctLevel: QRCode.CorrectLevel.H // High correction level for better scanning
                                                        });
                                        
                                                        // Wait for the QR code to be generated
                                                        setTimeout(function() {
                                                            // Convert the canvas to an image
                                                            var canvas = tempContainer.find('canvas')[0];
                                                            var img = canvas.toDataURL("image/png");
                                        
                                                            // Create a link and trigger the download
                                                            var link = document.createElement('a');
                                                            link.href = img;
                                                            //link.download = 'qrcode.png';
                                                            link.download = eventName + '_qrcode.png'; // Set the filename for the downloaded image
                                                            link.click();
                                        
                                                            // Remove the temporary container
                                                            tempContainer.remove();
                                                        }, 1000); // Wait 1 second to ensure QR code is fully generated
                                                    });
                                                });
                                            </script>
                                        </div>
										<?php $i++; } } else { ?>
											<h4 style="color:white;text-align:center;">No Events Created</h4>
										<?php } ?>
                                    </div>
                                </div>
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
                var registerPageURL = "https://bnrstage.mvgdigital.com?id=" + identifier; // Replace with your register page URL
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
	
		function updateYear() {
            document.getElementById('yearForm').submit();
        }

    </script>
</body>
</html>