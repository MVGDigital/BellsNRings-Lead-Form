<?php 
	include 'layouts/session.php';
?>
<?
// Set the initial event name value from PHP
$eventName = isset($_POST['eventName']) ? htmlspecialchars($_POST['eventName']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate QR</title>
    <link rel="shortcut icon" href="../assets1/img/bnr-fav.png" type="image/x-icon">

    <!-- Style Files -->
    <link rel="stylesheet" href="../assets1/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets1/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets1/css/custom.css">
    <!-- Style Files -->
  <script>
        // JavaScript function to update event title
        function updateEventTitle() {
            const eventName = document.getElementById('eventName').value;
            document.getElementById('eventTitle').innerText = eventName || "Event Title";
            document.getElementById('hiddenEventName').value = eventName;
        }
    </script>  
    
    
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
                    <h1 id="qr-title">Generate QR Code</h1>

                    <div class="tab-container generateQRTab mt_30">
                        <a href="generate_qr.php" style="cursor: pointer;color: transparent;">
							<button class="tab-button">Default QR Code</button>
						</a>
                        <a href="generate_event_qr.php" style="cursor: pointer;color: transparent;">
							<button class="tab-button active">Generate QR Code</button>
						</a>
                        <a href="qr_details.php" style="cursor: pointer;color: transparent;">
							<button class="tab-button">QR Code Details</button>
						</a>
                    </div>

                    <div class="tab-content mt_30">
                        <div id="generate-qr" class="tab-panel active col-12 col-md-6 col-lg-4 m-auto">
                            <!-- Form -->
                            <form name="generateQRForm" id="generateQRForm" class="form-section" method="post" >
                                <div class="col-12 mb-3">
                                    <div class="form-field">
                                        <label for="eventName">Event Name <span class="requirdField" >*</span></label>
                                        <input type="text" id="eventName" name="eventName" placeholder="Enter event name" value="<?php echo $eventName; ?>" oninput="updateEventTitle()">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-field">
                                        <label for="eventDate">Select Event Date<span class="requirdField" >*</span></label>
                                        <input type="date" id="eventDate" name="eventDate" class="form-select datepic" placeholder="Select event date">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-field">
                                        <label for="event_location">Event Location <span class="requirdField" >*</span></label>
                                        <input type="text" id="event_location" name="event_location" class="form-select locarion" placeholder="Enter event location">
                                    </div>
                                </div>
                                
                                <!-- Hidden input to pass event name to JavaScript -->
                                <input type="hidden" id="hiddenEventName" name="hiddenEventName" value="<?php echo $eventName; ?>">

                                <div class="col-12 text-center  mt_30 mb_40">
                                    <button type="submit" class="submit_btn">Generate</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Loader -->
                    <div class="loader">
                        <div class="loader-gif">
                            <img src="../assets1/img/spinner.gif" alt="">
                        </div>
                    </div>
                    <!-- Loader -->
                    <!-- Generate QR Code Popup -->
                    
                    <div id="popupView" class="popup-container">
                        <div class="item-middle popup-height">
                            <div class="col-md-8 col-lg-8 item-middle">
                                <div class="col-12 col-lg-8 popup">
                                    <div class="col-12 item-right">
                                        <img src="../assets1/img/close-icon.svg" alt="" class="close-btn">
                                    </div>
                                    <div class="popup-field">
                                        <div id="qrcodeContainer">
                                            
                                            <h2 id="eventTitle"><?php echo $eventName ? $eventName : 'Event Title'; ?></h2>
                                            
                                            <div id="qrcode"></div>
                                            <button id="downloadLink" class="submit_btn"  style="display: none;">Download</button>
                                            <div class="item-middle mtb_30 poss-rlt">
                                                <div id="qrcodeURL"></div>
                                                <button id="copyButton" style="display: none;"></button>
                                                <div id="copyHint">URL copied!</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <script>
                                      // Set initial event title on page load
                                       document.addEventListener("DOMContentLoaded", function() {
                                             updateEventTitle();
                                                   });
                                 </script>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
  
                    <!-- Generate QR Code Popup -->
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
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>    
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
      // Function to validate Date of Birth
        // Set minimum date to the current date
        var currentDate = new Date();
        var formattedCurrentDate = currentDate.toISOString().substr(0, 10);
        document.getElementById('eventDate').setAttribute('min', formattedCurrentDate);
     
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
        },
        submitHandler: function(form) {
            $(".loader").show();
			var formData = $(form).serialize();
			// Send AJAX request to save event details
			$.ajax({
				type: "POST",
				url: "event_create_process.php", // Replace with your PHP file to handle database operations
				data: formData,
				success: function(response) {
					// On successful save, response should contain the new event ID
					var newEventID = response.trim();

					setTimeout(function() {
					$(".loader").hide();
						generateQRCode(newEventID);
						$("#popupView").show('slow');
						$(form).trigger("reset");
					}, 2000);
					
				},
				error: function(xhr, status, error) {
					console.error("Error saving event:", error);
					// Handle error
				}
			});
            
            /* Qr code generate function */
            function generateQRCode(newEventID)
			{
                var identifier = newEventID;
                var registerPageURL = "https://bnrstage.mvgdigital.com/?eve_id=" + identifier;
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
                
                
                // Get the event name from the hidden field
            var eventName = document.getElementById("hiddenEventName").value;
            
                downloadLink.style.display = "inline-block";
            
                // Show the download button
            
                downloadLink.href = qrDataURL;
                downloadLink.download = eventName + "_qrcode.png"; // Set the filename for the downloaded image
            
                // Add event listener to download button
                downloadLink.addEventListener("click", function(event) 
				{
                    // Prevent default link behavior
                    event.preventDefault();
                    
                    // Create a temporary anchor element
                    var tempLink = document.createElement("a");
                    tempLink.href = downloadLink.href;
                     tempLink.download = eventName + "_qrcode.png"; // Set the filename for the downloaded image
            
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


    </script>
</body>
</html>