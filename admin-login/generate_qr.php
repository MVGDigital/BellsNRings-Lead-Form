<?php 
	include 'layouts/session.php';
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
                    <h1 id="qr-title">Default QR Code</h1>

                    <div class="tab-container generateQRTab mt_30">
                        <a href="generate_qr.php" style="cursor: pointer;color: transparent;">
							<button class="tab-button active">Default QR Code</button>
						</a>
                        <a href="generate_event_qr.php" style="cursor: pointer;color: transparent;">
							<button class="tab-button">Generate QR Code</button>
						</a>
                        <a href="qr_details.php" style="cursor: pointer;color: transparent;">
							<button class="tab-button">QR Code Details</button>
						</a>
                    </div>

                    <div class="tab-content mt_30">
                        <div id="default-qr" class="tab-panel active col-12 col-md-6 col-lg-4 m-auto">
                            <div id="qrcodeContainer">
                                <div id="default-qrcode"><img src="../admin-login/assets1/img/default-qrcode.png" alt=""></div>
                                <button id="default-downloadLink" class="submit_btn">Download</button>
                                <div class="item-middle mtb_30 poss-rlt defaultQRCodeURL">
                                    <div id="default-qrcodeURL">https://bnrstage.mvgdigital.com/</div>
                                    <button id="default-copyButton" onclick="defaultCopyURL()"></button>
                                    <div id="default-copyHint">URL copied!</div>
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <!-- Loader -->
                    <div class="loader">
                        <div class="loader-gif">
                            <img src="../assets1/img/spinner.gif" alt="">
                        </div>
                    </div>
                    <!-- Loader -->
                </div>
              </div>
        </div>
    </div>
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
    </script>
</body>
</html>