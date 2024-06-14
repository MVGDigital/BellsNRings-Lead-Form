<?php 
	include 'layouts/session.php';
	
	$bnr_id = isset($_GET['bnr_id']) ? $_GET['bnr_id'] : '';
	
	$sql = "SELECT *,u.created_date as registered_date,p.creation_date as profile_created_date FROM bnr_user u
        JOIN bnr_user_profile p ON u.bnr_id = p.bnr_id
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
        <title>Add Users</title>
        <link rel="shortcut icon" href="../assets1/img/bnr-fav.png" type="image/x-icon">

        <!-- Style Files -->
        <link rel="stylesheet" href="../assets1/bootstrap-5.0.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets1/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="../assets1/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets1/css/select2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css"/>
        <link rel="stylesheet" href="../assets1/css/custom.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        
        <script>
            // JavaScript code to set the selected option based on the PHP variable
            document.addEventListener('DOMContentLoaded', function() {
                // Get the value from PHP and set it in a JS variable
                var profileCreatedFor = "<?php echo $data['profile_created_for']; ?>";
                

                // Set the selected option in the dropdown
                var selectElement = document.getElementById('profileFor');
                selectElement.value = profileCreatedFor;

                document.getElementById('editDateOfBirth').value = "<?php echo $data['date_of_birth']; ?>";
                document.getElementById('editCountry').value = "<?php echo $data['country']; ?>";
                document.getElementById('editState').value = "<?php echo $data['state']; ?>";
                document.getElementById('editEmail').value = "<?php echo $data['email_id']; ?>";
                var profileCreatedFor = "<?php echo $data['marital_status']; ?>";
                

                // Set the selected option in the dropdown
                var selectElement = document.getElementById('editMaritalStatus');
                selectElement.value = profileCreatedFor;
                document.getElementById('editMotherTongue').value = "<?php echo $data['mother_tongue']; ?>";
                document.getElementById('editCaste').value  = "<?php echo $data['caste']; ?>";
                var states = "<?php echo $data['state']; ?>";
                

                // Set the selected option in the dropdown
                var selectElement = document.getElementById('editState');
                selectElement.value = states;
                document.getElementById('editMotherTongue').value = "<?php echo $data['mother_tongue']; ?>";
                document.getElementById('editDenomination').value = "<?php echo $data['denomination']; ?>";
                document.getElementById('editHeight').value = "<?php echo $data['height']; ?>";
                document.getElementById('editWeight').value = "<?php echo $data['weight']; ?>";
                // document.getElementById('editComplexion').value = "<?php echo $data['complexion']; ?>";
                var completxion = "<?php echo $data['complexion']; ?>";
                

                // Set the selected option in the dropdown
                var selectElement = document.getElementById('editComplexion');
                selectElement.value = complextion;
                document.getElementById('editFamilyStatus').value = "<?php echo $data['family_status']; ?>";
                
                document.getElementById('editBrothers').value = "<?php echo $data['number_of_brothers']; ?>";
                document.getElementById('editBrotherMarried').value = "<?php echo $data['brother_married']; ?>";
                document.getElementById('editSisters').value = "<?php echo $data['number_of_sisters']; ?>";
                document.getElementById('editSisterMarried').value = "<?php echo $data['sister_married']; ?>";
                // editFamilyStatus
                
        
            });
            
        
        </script>
                
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
                        <h1>Edit Users</h1>

                        <!-- Edit Modal -->
                        <div id="editModal" class="addUser_Container">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Form -->
                                            <form action="" method="" enctype="" id="editUserDetailsForm">
                                            <div class="modal-body row">
                                            <input type="hidden" name="bnr_id" value="<?php echo $data['bnr_id']; ?>">
                                                
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field ">
                                                    <label for="profileFor">Profile Created for</label>
                                                    <select id="profileFor" class="form-select" name="profileFor">
                                                        <option value="" >Select Profile For</option>
                                                        <option value="Myself" >Myself</option>
                                                        <option value="Son">Son</option>
                                                        <option value="Daughter" >Daughter</option>
                                                        <option value="Sister" >Sister</option>
                                                        <option value="Brother" >Brother</option>
                                                        <option value="Relative" >Relative</option>
                                                        <option value="Friend" >Friend</option>
                                                    </select>

                                                        
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label>Select Gender</label>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="male" name="gender" value="male" <?php echo ($data['gender'] == 'male') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="male">Male</label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="female" name="gender" value="female" <?php echo ($data['gender'] == 'female') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="female">Female</label>
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editName">Name</label>
                                                        <input type="text" value="<?php echo $data['first_name']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editDateOfBirth">Select Date of Birth</label>
                                                        <input type="text" id="editDateOfBirth" name="editDateOfBirth" class="form-select datepic" placeholder="Enter DOB">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editCountry">Currently Residing In Country</label>
                                                        <select id="editCountry" name="editCountry" class="form-select"></select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editState">Currently Residing In State</label>
                                                        <select id="editState" name="editState" class="form-select"></select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editEmail">Email ID</label>
                                                        <input type="text" id="editEmail" name="editEmail" placeholder="Enter email">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editPrimaryContact">Primary Mobile Number</label>
                                                        <input type="tel" id="editPrimaryContact" name="editPrimaryContact" class="mob_number" placeholder="Enter Mobile Number" value="<?php echo $data['contact_number']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div  class="form-field">
                                                    <label for="editWhatsapp">Whatsapp Number</label>
                                                    <input type="tel" id="editWhatsapp" name="editWhatsapp" class="mob_number" placeholder="Enter whatsapp Number" value="<?php echo $data['whatsapp_number']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editMaritalStatus">Marital Status</label>
                                                        
                                                        <select id="editMaritalStatus" class="form-select" name="editMaritalStatus">
                                                        
                                                            <option value="never married">Never Married</option>
                                                            <option value="separated">Separated</option>
                                                            <option value="divorced">Divorced</option>
                                                            <option value="widow_widower">Widow / Widower</option>
                                                            <option value="awaiting divorce">Awaiting Divorce</option>
                                                            <option value="annulled">Annulled</option> 
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editMotherTongue">Mother Tongue</label>
                                                        <select id="editMotherTongue" class="form-select" name="editMotherTongue">
                                                        <!-- <input type="text" value="<?php echo $data['mother_tongue']; ?>"> -->
                                                            <option value="arabic">Arabic</option>
                                                            <option value="assamese">Assamese</option>
                                                            <option value="bengali">Bengali</option>
                                                            <option value="bodo">Bodo</option>
                                                            <option value="chinese">Chinese</option>
                                                            <option value="dhunhdari_jaipuri">Dhunhdari / Jaipuri</option>
                                                            <option value="dogri">Dogri</option>
                                                            <option value="english">English</option>
                                                            <option value="french">French</option>
                                                            <option value="gujarati">Gujarati</option>
                                                            <option value="german">German</option>
                                                            <option value="hindi">Hindi</option>
                                                            <option value="kannada">Kannada</option>
                                                            <option value="kashmiri">Kashmiri</option>
                                                            <option value="konkani">Konkani</option>
                                                            <option value="malayalam">Malayalam</option>
                                                            <option value="marathi">Marathi</option>
                                                            <option value="manipuri">Manipuri</option>
                                                            <option value="nepali">Nepali</option>
                                                            <option value="odia">Odia</option>
                                                            <option value="punjabi">Punjabi</option>
                                                            <option value="portuguese">Portuguese</option>
                                                            <option value="russian">Russian</option>
                                                            <option value="spanish">Spanish</option>
                                                            <option value="sourastra">Sourastra</option>
                                                            <option value="sanskrit">Sanskrit</option>
                                                            <option value="turkish">Turkish</option>
                                                            <option value="tamil">Tamil</option>
                                                            <option value="telugu">Telugu</option>
                                                            <option value="urdu">Urdu</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editCaste">Caste</label>
                                                    <!-- <input type="text" value="<?php echo $data['caste']; ?>"> -->
                                                        <select id="editCaste" class="form-select" name="editCaste">
                                                            <option value="achari">Achari</option>
                                                            <option value="adi dravida">Adi Dravida</option>
                                                            <option value="agamudiyar">Agamudiyar</option>
                                                            <option value="anglo indian">Anglo Indian</option>
                                                            <option value="arunthathiyar">Arunthathiyar</option>
                                                            <option value="bc">BC</option>
                                                            <option value="brahmin">Brahmin</option>
                                                            <option value="caste nobar">Caste Nobar</option>
                                                            <option value="chettiyar">Chettiyar</option>
                                                            <option value="devendra kula vellalar">Devendra Kula Vellalar</option>
                                                            <option value="ediga">Ediga</option>
                                                            <option value="gounder">Gounder</option>
                                                            <option value="intercaste">Intercaste</option>
                                                            <option value="kallar">Kallar</option>
                                                            <option value="kamalar">Kamalar</option>
                                                            <option value="kongu vellalar_gounder">Kongu Vellalar Gounder</option>
                                                            <option value="maravar">Maravar</option>
                                                            <option value="meenavar">Meenavar</option>
                                                            <option value="moopanar">Moopanar</option>
                                                            <option value="mudaliyar">Mudaliyar</option>
                                                            <option value="mukkuvar">Mukkuvar</option>
                                                            <option value="maruthuvar">Maruthuvar</option>
                                                            <option value="nadar">Nadar</option>
                                                            <option value="naidu">Naidu</option>
                                                            <option value="naicker">Naicker</option>
                                                            <option value="obc">OBC</option>
                                                            <option value="oc">OC</option>
                                                            <option value="pallar">Pallar</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editDenomination">Denomination</label>
                                                        <!-- <input type="text" value="<?php echo $data['denomination']; ?>"> -->
                                                        <select id="editDenomination" class="form-select" name="editDenomination">
                                                            <option value="ag">AG</option>
                                                            <option value="adventist">Adventist</option>
                                                            <option value="aci anglican church of india">ACI-Anglican Church of India</option>
                                                            <option value="apostolic">Apostolic</option>
                                                            <option value="arcot lutheran">Arcot Lutheran</option>
                                                            <option value="baptist">Baptist</option>
                                                            <option value="brethren">Brethren</option>
                                                            <option value="catholic">Catholic</option>
                                                            <option value="christian others">Christian -others</option>
                                                            <option value="church of christ">Church of Christ</option>
                                                            <option value="church of god">Church of God</option>
                                                            <option value="cni church of north india">CNI- Church of North India</option>
                                                            <option value="congregational">Congregational</option>
                                                            <option value="cpm ceylon pentecostal mission">CPM-Ceylon Pentecostal Mission</option>
                                                            <option value="csi church of south india">CSI-Church of South India</option>
                                                            <option value="don’t wish to specify">Don’t Wish to specify</option>
                                                            <option value="evangelical">Evangelical</option>
                                                            <option value="eci evangelical church of india">ECI- Evangelical Church of India</option>
                                                            <option value="evangelist">Evangelist</option>
                                                            <option value="independent church">Independent Church</option>
                                                            <option value="jacobite">Jacobite</option>
                                                            <option value="jehovah witness">Jehovah Witness</option>
                                                            <option value="jehovah shammah">Jehovah Shammah</option>
                                                            <option value="latin">Latin</option>
                                                            <option value="lutheran">Lutheran</option>
                                                            <option value="methodist">Methodist</option>
                                                            <option value="orthodox">Orthodox</option>
                                                            <option value="others">Others</option>
                                                            <option value="pentecostal">Pentecostal</option>
                                                            <option value="presbyterian">Presbyterian</option>
                                                            <option value="protestant">Protestant</option>
                                                            <option value="reformed baptist">Reformed Baptist</option>
                                                            <option value="roman catholic">Roman Catholic</option>
                                                            <option value="seventh day adventist">Seventh day Adventist</option>
                                                            <option value="st thomas evangalical">St Thomas Evangalical</option>
                                                            <option value="syrian catholic">Syrian Catholic</option>
                                                            <option value="syrian orthodox">Syrian Orthodox</option>
                                                            <option value="syrian jacobite">Syrian Jacobite</option>
                                                            <option value="syro malabar">Syro Malabar</option>
                                                            <option value="telc tamil evangelical lutheran church">TELC- Tamil Evangelical Lutheran Church</option>
                                                            <option value="tpm the pentecostal mission">TPM-The Pentecostal Mission</option>
                                                            <option value="woj assembly of god">Woj -Assembly of God</option>
                                                            <option value="woj pentecostal">WOJ- Pentecostal</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3 d-flex">
                                                    <div class="height-width pr">
                                                        <div class="form-field">
                                                            <label for="editHeight">Height</label>
                                                            <!-- <input type="text" value="<?php echo $data['height']; ?>"> -->
                                                            <select id="editHeight" class="form-select" name="editHeight">
                                                                <option value="4ft 1in">4ft 1in</option>
                                                                <option value="4ft 2in">4ft 2in</option>
                                                                <option value="4ft 3in">4ft 3in</option>
                                                                <option value="4ft 4in">4ft 4in</option>
                                                                <option value="4ft 5in">4ft 5in</option>
                                                                <option value="4ft 6in">4ft 6in</option>
                                                                <option value="4ft 7in">4ft 7in</option>
                                                                <option value="4ft 8in">4ft 8in</option>
                                                                <option value="4ft 9in">4ft 9in</option>
                                                                <option value="4ft 10in">4ft 10in</option>
                                                                <option value="4ft 11in">4ft 11in</option>
                                                                <option value="5ft 0in">5ft 0in</option>
                                                                <option value="5ft 1in">5ft 1in</option>
                                                                <option value="5ft 2in">5ft 2in</option>
                                                                <option value="5ft 3in">5ft 3in</option>
                                                                <option value="5ft 4in">5ft 4in</option>
                                                                <option value="5ft 5in">5ft 5in</option>
                                                                <option value="5ft 6in">5ft 6in</option>
                                                                <option value="5ft 7in">5ft 7in</option>
                                                                <option value="5ft 8in">5ft 8in</option>
                                                                <option value="5ft 9in">5ft 9in</option>
                                                                <option value="5ft 10in">5ft 10in</option>
                                                                <option value="5ft 11in">5ft 11in</option>
                                                                <option value="6ft 0in">6ft 0in</option>
                                                                <option value="6ft 1in">6ft 1in</option>
                                                                <option value="6ft 2in">6ft 2in</option>
                                                                <option value="6ft 3in">6ft 3in</option>
                                                                <option value="6ft 4in">6ft 4in</option>
                                                                <option value="6ft 5in">6ft 5in</option>
                                                                <option value="6ft 6in">6ft 6in</option>
                                                                <option value="6ft 7in">6ft 7in</option>
                                                                <option value="6ft 8in">6ft 8in</option>
                                                                <option value="6ft 9in">6ft 9in</option>
                                                                <option value="6ft 10in">6ft 10in</option>
                                                                <option value="6ft 11in">6ft 11in</option>
                                                                <option value="7ft 0in">7ft 0in</option>
                                                                <option value="7ft 1in">7ft 1in</option>
                                                                <option value="7ft 2in">7ft 2in</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="height-width pl">
                                                        <div class="form-field">
                                                            <label for="editWeight">Weight</label>
                                                            <!-- <input type="text" value="<?php echo $data['weight']; ?>"> -->
                                                            <select id="editWeight" class="form-select" name="editWeight">
                                                                <option value="40 kg">40 kg</option>
                                                                <option value="41 kg">41 kg</option>
                                                                <option value="42 kg">42 kg</option>
                                                                <option value="43 kg">43 kg</option>
                                                                <option value="44 kg">44 kg</option>
                                                                <option value="45 kg">45 kg</option>
                                                                <option value="46 kg">46 kg</option>
                                                                <option value="47 kg">47 kg</option>
                                                                <option value="48 kg">48 kg</option>
                                                                <option value="49 kg">49 kg</option>
                                                                <option value="50 kg">50 kg</option>
                                                                <option value="51 kg">51 kg</option>
                                                                <option value="52 kg">52 kg</option>
                                                                <option value="53 kg">53 kg</option>
                                                                <option value="54 kg">54 kg</option>
                                                                <option value="55 kg">55 kg</option>
                                                                <option value="56 kg">56 kg</option>
                                                                <option value="57 kg">57 kg</option>
                                                                <option value="58 kg">58 kg</option>
                                                                <option value="59 kg">59 kg</option>
                                                                <option value="60 kg">60 kg</option>
                                                                <option value="61 kg">61 kg</option>
                                                                <option value="62 kg">62 kg</option>
                                                                <option value="63 kg">63 kg</option>
                                                                <option value="64 kg">64 kg</option>
                                                                <option value="65 kg">65 kg</option>
                                                                <option value="66 kg">66 kg</option>
                                                                <option value="67 kg">67 kg</option>
                                                                <option value="68 kg">68 kg</option>
                                                                <option value="69 kg">69 kg</option>
                                                                <option value="70 kg">70 kg</option>
                                                                <option value="71 kg">71 kg</option>
                                                                <option value="72 kg">72 kg</option>
                                                                <option value="73 kg">73 kg</option>
                                                                <option value="74 kg">74 kg</option>
                                                                <option value="75 kg">75 kg</option>
                                                                <option value="76 kg">76 kg</option>
                                                                <option value="77 kg">77 kg</option>
                                                                <option value="78 kg">78 kg</option>
                                                                <option value="79 kg">79 kg</option>
                                                                <option value="80 kg">80 kg</option>
                                                                <option value="81 kg">81 kg</option>
                                                                <option value="82 kg">82 kg</option>
                                                                <option value="83 kg">83 kg</option>
                                                                <option value="84 kg">84 kg</option>
                                                                <option value="85 kg">85 kg</option>
                                                                <option value="86 kg">86 kg</option>
                                                                <option value="87 kg">87 kg</option>
                                                                <option value="88 kg">88 kg</option>
                                                                <option value="89 kg">89 kg</option>
                                                                <option value="90 kg">90 kg</option>
                                                                <option value="91 kg">91 kg</option>
                                                                <option value="92 kg">92 kg</option>
                                                                <option value="93 kg">93 kg</option>
                                                                <option value="94 kg">94 kg</option>
                                                                <option value="95 kg">95 kg</option>
                                                                <option value="96 kg">96 kg</option>
                                                                <option value="97 kg">97 kg</option>
                                                                <option value="98 kg">98 kg</option>
                                                                <option value="99 kg">99 kg</option>
                                                                <option value="100 kg">100 kg</option>
                                                                <option value="101 kg">101 kg</option>
                                                                <option value="102 kg">102 kg</option>
                                                                <option value="103 kg">103 kg</option>
                                                                <option value="104 kg">104 kg</option>
                                                                <option value="105 kg">105 kg</option>
                                                                <option value="106 kg">106 kg</option>
                                                                <option value="107 kg">107 kg</option>
                                                                <option value="108 kg">108 kg</option>
                                                                <option value="109 kg">109 kg</option>
                                                                <option value="110 kg">110 kg</option>
                                                                <option value="111 kg">111 kg</option>
                                                                <option value="112 kg">112 kg</option>
                                                                <option value="113 kg">113 kg</option>
                                                                <option value="114 kg">114 kg</option>
                                                                <option value="115 kg">115 kg</option>
                                                                <option value="116 kg">116 kg</option>
                                                                <option value="117 kg">117 kg</option>
                                                                <option value="118 kg">118 kg</option>
                                                                <option value="119 kg">119 kg</option>
                                                                <option value="120 kg">120 kg</option>
                                                                <option value="121 kg">121 kg</option>
                                                                <option value="122 kg">122 kg</option>
                                                                <option value="123 kg">123 kg</option>
                                                                <option value="124 kg">124 kg</option>
                                                                <option value="125 kg">125 kg</option>
                                                                <option value="126 kg">126 kg</option>
                                                                <option value="127 kg">127 kg</option>
                                                                <option value="128 kg">128 kg</option>
                                                                <option value="129 kg">129 kg</option>
                                                                <option value="130 kg">130 kg</option>
                                                                <option value="131 kg">131 kg</option>
                                                                <option value="132 kg">132 kg</option>
                                                                <option value="133 kg">133 kg</option>
                                                                <option value="134 kg">134 kg</option>
                                                                <option value="135 kg">135 kg</option>
                                                                <option value="136 kg">136 kg</option>
                                                                <option value="137 kg">137 kg</option>
                                                                <option value="138 kg">138 kg</option>
                                                                <option value="139 kg">139 kg</option>
                                                                <option value="140 kg">140 kg</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editComplexion">Complexion</label>
                                                        <select id="editComplexion" class="form-select" name="editComplexion">
                                                            <option value="dark">Dark</option>
                                                            <option value="wheatish">Wheatish</option>
                                                            <option value="wheetish brown">Wheatish Brown</option>
                                                            <option value="fair">Fair</option>
                                                            <option value="very fair">Very Fair</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <div class="form-field">
                                                        <label for="editLastEducation">Last Education Level</label>
                                                        <input type="text" id="editLastEducation" name="editLastEducation" placeholder="Enter Last education level"  value="<?php echo $data['last_education_level']; ?>">
                                                    </div>
                                                </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editOccupation">Occupation</label>
                                                    <input type="text" id="editOccupation" name="editOccupation" placeholder="Enter Occupation"  value="<?php echo $data['occupation']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editCompanyName">Company Name</label>
                                                    <input type="text" id="editCompanyName" name="editCompanyName" placeholder="Enter company name" value="<?php echo $data['company_name']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editAnnualIncome">Annual Income</label>
                                                    <input type="text" id="editAnnualIncome" name="editAnnualIncome" class="price-format-input form-select inr-icon" placeholder="Enter annual income"  value="<?php echo $data['annual_income']; ?>">
                                                    <div id="textBelowIncome" class=""></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editWorkLocation">Work Location</label>
                                                    <input type="text" id="editWorkLocation" name="editWorkLocation" class="form-select locarion" placeholder="Enter work location"  value="<?php echo $data['work_location']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editFatherName">Father Name</label>
                                                    <input type="text" id="editFatherName" name="editFatherName" placeholder="Enter father name"  value="<?php echo $data['father_name']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editFatherOccupation">Father Occupation</label>
                                                    <input type="text" id="editFatherOccupation" name="editFatherOccupation" placeholder="Enter father occupation" value="<?php echo $data['father_occupation']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editMotherName">Mother Name</label>
                                                    <input type="text" id="editMotherName" name="editMotherName" placeholder="Enter mother name" value="<?php echo $data['mother_name']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editMotherOccupation">Mother Occupation</label>
                                                    <input type="text" id="editMotherOccupation" name="editMotherOccupation" placeholder="Enter mother occupation" value="<?php echo $data['mother_occupation']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editFamilyStatus">Family Status</label>
                                                    <!-- <input type="text" value="<?php echo $data['family_status']; ?>"> -->
                                                    <select id="editFamilyStatus" name="editFamilyStatus"  class="form-select">
                                                        <option value="lower middle class">Lower Middle Class</option>
                                                        <option value="middle class">Middle Class</option>
                                                        <option value="upper middle class">Upper Middle Class</option>
                                                        <option value="rich">Rich</option>
                                                        <option value="affluent">Affluent</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <div class="form-field">
            <label for="editBrothers">No. of Brothers</label>
            <select id="editBrothers" name="editBrothers" class="form-select">
                <option value="none" <?php echo $data['number_of_brothers'] == 'none' ? 'selected' : ''; ?>>None</option>
                <option value="1" <?php echo $data['number_of_brothers'] == '1' ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo $data['number_of_brothers'] == '2' ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo $data['number_of_brothers'] == '3' ? 'selected' : ''; ?>>3</option>
                <option value="4" <?php echo $data['number_of_brothers'] == '4' ? 'selected' : ''; ?>>4</option>
                <option value="5" <?php echo $data['number_of_brothers'] == '5' ? 'selected' : ''; ?>>5</option>
                <option value="6" <?php echo $data['number_of_brothers'] == '6' ? 'selected' : ''; ?>>6</option>
            </select>
        </div>
    </div>

                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <div class="form-field">
                            <label for="editBrotherMarried">Brothers Married</label>
                            <select id="editBrotherMarried" name="editBrotherMarried" class="form-select">
                                <option value="none" <?php echo isset($data['brother_married']) && $data['brother_married'] == 'none' ? 'selected' : ''; ?>>None</option>
                                <option value="1" <?php echo isset($data['brother_married']) && $data['brother_married'] == '1' ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo isset($data['brother_married']) && $data['brother_married'] == '2' ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo isset($data['brother_married']) && $data['brother_married'] == '3' ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo isset($data['brother_married']) && $data['brother_married'] == '4' ? 'selected' : ''; ?>>4</option>
                                <option value="5" <?php echo isset($data['brother_married']) && $data['brother_married'] == '5' ? 'selected' : ''; ?>>5</option>
                                <option value="6" <?php echo isset($data['brother_married']) && $data['brother_married'] == '6' ? 'selected' : ''; ?>>6</option>
                            </select>
                        </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                <label for="editSisters">No. of Sisters</label>
                            <select id="editSisters" name="editSisters" class="form-select">
                                <option value="none" <?php echo isset($data['number_of_sisters']) && $data['number_of_sisters'] == 'none' ? 'selected' : ''; ?>>None</option>
                                <option value="1" <?php echo isset($data['number_of_sisters']) && $data['number_of_sisters'] == '1' ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo isset($data['number_of_sisters']) && $data['number_of_sisters'] == '2' ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo isset($data['number_of_sisters']) && $data['number_of_sisters'] == '3' ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo isset($data['number_of_sisters']) && $data['number_of_sisters'] == '4' ? 'selected' : ''; ?>>4</option>
                                <option value="5" <?php echo isset($data['number_of_sisters']) && $data['number_of_sisters'] == '5' ? 'selected' : ''; ?>>5</option>
                                <option value="6" <?php echo isset($data['number_of_sisters']) && $data['number_of_sisters'] == '6' ? 'selected' : ''; ?>>6</option>
                            </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field mb-3">
                                                <label for="editSisterMarried">Sisters Married</label>
                            <select id="editSisterMarried" name="editSisterMarried" class="form-select">
                                <option value="none" <?php echo isset($data['sister_married']) && $data['sister_married'] == 'none' ? 'selected' : ''; ?>>None</option>
                                <option value="1" <?php echo isset($data['sister_married']) && $data['sister_married'] == '1' ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo isset($data['sister_married']) && $data['sister_married'] == '2' ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo isset($data['sister_married']) && $data['sister_married'] == '3' ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo isset($data['sister_married']) && $data['sister_married'] == '4' ? 'selected' : ''; ?>>4</option>
                                <option value="5" <?php echo isset($data['sister_married']) && $data['sister_married'] == '5' ? 'selected' : ''; ?>>5</option>
                                <option value="6" <?php echo isset($data['sister_married']) && $data['sister_married'] == '6' ? 'selected' : ''; ?>>6</option>
                            </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editAddress">Address</label>
                                                    <textarea id="editAddress" name="editAddress" class="address" value=""><?php echo $data['current_address']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field mb-3">
                                                    <label for="editPermAddress">Permanent Address</label>
                                                    <textarea id="editPermAddress" class="address" name="editPermAddress"><?php echo $data['permanent_address']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editCitizenOf">Citizen of</label>
                                                    <input type="text" id="editCitizenOf" name="editCitizenOf" placeholder="Enter citizen of" value="<?php echo $data['citizen_of']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="form-field">
                                                    <label for="editphoto">Need to upload your recent photo</label>
                                                    <div class="img-upload">
                                                        <span class="btn_upload">
                                                            <input type="file" id="editphoto" name="editphoto" class="input-img"/>
                                                            Choose Image
                                                            </span>
                                                        <img id="ImgPreview" src="" class="preview1" />
                                                        <input type="button" id="removeImage1" value="<?php echo $data['photo']; ?>" class="btn-rmv1" />
                                                        </div>
                                                </div>
                                            </div>
                                        
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" id="saveChanges" class="submit_btn">Save Changes</button>
                                            </div>
                                            </form>
                                            
                                            <!-- Form -->
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
        <script src="../assets1/js/bootstrap-datepicker.min.js"></script>
        <script src="../assets1/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
        <script src="../assets1/js/editForm_country_code.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <!-- plugin Files -->
            
            <script>
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
        
            //Side Nav
            let btn = document.querySelector("#menu-btn");
            let sidebar = document.querySelector(".sidebar");
            let menu_title = document.querySelector("#menu_title");

            // getElementbyId.(#editCountry)=val()
            

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
                    utilsScript: "../assets/js/utils.min.js?1714035314356"
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
                    utilsScript: "../assets/js/utils.min.js?1714035314356"

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
                $("#editUserDetailsForm").submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Perform form validation here if needed
            // If validation passes, proceed with AJAX submission

            $.ajax({
                url: 'show_data.php', // Update with the actual URL for your API endpoint
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle the success response from the server
                    // alert('User details updated successfully!');
                    // Optionally, update the UI or redirect to another page
                    // if (response.success) {
                // Show SweetAlert2 pop-up upon successful submission
                Swal.fire({
                    title: 'Updated!',
                    text: 'The profile has been updated successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Redirect the user if they click 'OK'
                    if (result.isConfirmed) {
                        window.location = "http://localhost/admin-login/admin-login/users.php"; // Refresh the page
                    }
                });
            // }
                },
                error: function(xhr, status, error) {
                    // Handle the error response from the server
                    alert('An error occurred while updating user details: ' + error);
                }
            });
        });
                
                
                
            </script>
        </body>
        </html>