<?php 
	include 'layouts/session.php';
	$registration_status = isset($_GET['registration_status']) ? $_GET['registration_status'] : 'Active';
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
                  <h1>Add Users</h1>

                <!-- Edit Modal -->
                <!-- Form -->
                <div class="col-lg-8 m-auto">
                <form method="post" id="addUser" class="form-section" action="">
                        <!-- <div class="row"> -->
<div class="row">
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="profileFor">Profile Created for</label>
                                    <select id="profileFor" class="form-select" name="profileFor">
                                        <option value="" seleted>Select Profile For</option>
                                        <option value="Myself">Myself</option>
                                        <option value="Son">Son</option>
                                        <option value="Daughter">Daughter</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Relative">Relative</option>
                                        <option value="Friend">Friend</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label>Select Gender</label>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" id="male" name="gender" value="male">
                                    <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" id="female" name="gender" value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="firstName">First Name</label>
                                    <input type="text" id="firstName" name="firstName" placeholder="Enter name">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" id="lastName" name="lastName" placeholder="Enter name">
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
                                    <label for="email">Email ID</label>
                                    <input type="email" id="email" name="email" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="primaryMobNum">Primary Mobile Number</label>
                                    <input type="tel" id="primaryMobNum" name="primaryMobNum" class="mob_number" placeholder="Enter Mobile Number">
                                    <label id="error-msg" class="error-msg hide"></label>
                                    <label id="valid-msg" class="valid-msg hide">Valid number</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-5 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="sameNumber">Whatsapp Number below is <span class="requirdField" >*</span></label>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" id="sameNumber" name="addWhatsappNum" value="sameNumber" checked>
                                    <label class="form-check-label" for="sameNumber">Same as primary number</label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" id="differentNumber" name="addWhatsappNum" value="differentNumber">
                                    <label class="form-check-label" for="differentNumber">Different than primary number</label>
                                    </div>
                                </div>
                            </div>
                            <div id="addNewNumber" class="col-12 col-lg-6 col-md-5 col-sm-12 mb-3">
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="maritalStatus">Marital Status</label>
                                    <select id="maritalStatus" class="form-select" name="maritalStatus">
                                        <option value="">Select marital status</option>
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
                                    <label for="mothertongue">Mother Tongue</label>
                                    <select id="mothertongue" class="form-select" name="mothertongue">
                                        <option value="">Select mother tongue</option>
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
                                    <label for="caste">Caste</label>
                                    <select id="caste" class="form-select" name="caste">
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
                                    <label for="denomination">Denomination</label>
                                    <select id="denomination" class="form-select" name="denomination">
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
                                    <label for="height">Height</label>
                                    <select id="height" class="form-select" name="height">
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
                                    <label for="weight">Weight</label>
                                    <select id="weight" class="form-select" name="weight">
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
                                    <label for="complexion">Complexion</label>
                                    <select id="complexion" class="form-select" name="complexion">
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
                                    <label for="last_edu_level">Last Education Level</label>
                                    <input type="text" id="last_edu_level" name="last_edu_level" placeholder="Enter Last education level">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" id="occupation" name="occupation" placeholder="Enter Occupation">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" placeholder="Enter company name">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="editAnnualIncome">Annual Income</label>
                                    <input type="text" id="editAnnualIncome" name="editAnnualIncome" class="price-format-input form-select inr-icon" placeholder="Enter annual income">
                                    <div id="textBelowIncome" class=""></div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="work_location">Work Location</label>
                                    <input type="text" id="work_location" name="work_location" class="form-select locarion" placeholder="Enter work location">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="fatherName">Father Name</label>
                                    <input type="text" id="fatherName" name="fatherName" placeholder="Enter father name">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="fatherOccupation">Father Occupation</label>
                                    <input type="text" id="fatherOccupation" name="fatherOccupation" placeholder="Enter father occupation">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="motherName">Mother Name</label>
                                    <input type="text" id="motherName" name="motherName" placeholder="Enter mother name">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="motherOccupation">Mother Occupation</label>
                                    <input type="text" id="motherOccupation" name="motherOccupation" placeholder="Enter mother occupation">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="familystatus">Family Status</label>
                                    <select id="familystatus" name="familystatus"  class="form-select">
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
                                    <label for="noOfBrother">No. of Brothers</label>
                                    <select id="noOfBrother" name="noOfBrother" class="form-select" >
                                        <option value="none">None</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div id="brother-married-field" class="col-12 col-lg-6 col-md-5 col-sm-12 mb-3">
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="noOfsister">No. of Sisters</label>
                                    <select id="noOfsister" name="noOfsister" class="form-select">
                                        <option value="none">None</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div id="sister-married-field" class="col-12 col-lg-6 col-md-5 col-sm-12 mb-3">
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="address" class="address"></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="citizenOf">Citizen of</label>
                                    <input type="text" id="citizenOf" name="citizenOf" placeholder="Enter citizen of">
                                </div>
                            </div>
                            <div id="addNewAddress" class="col-12 col-lg-6 col-md-5 col-sm-12 mb-3">
                            </div>
                            <div class="col-12 col-lg-6 col-md-5 col-sm-12 mb-3">
                                <div class="form-field">
                                    <label for="same_address">Permanent Address is</label>
                                    <div class="form-check"> 
                                    <input class="form-check-input" type="radio" id="same_address" name="choseAddress" value="same_as_above" checked>
                                    <label class="form-check-label" for="same_address">Same as above</label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" id="diff_address" name="choseAddress" value="diff_address">
                                    <label class="form-check-label" for="diff_address">Different than above</label>
                                    </div>
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
                                    <input type="button" id="removeImage1" value="" class="btn-rmv1" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="submit" class="submit_btn">Submit</button>
                            </div>
                        </div>
                </form>
                </div>
                                    <!-- Form -->
                <!-- Edit Code -->
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
        // jQuery function to collect form data
        $(document).ready(function() {

            $.validator.addMethod("customEmail", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(value);
            }, "Please enter a valid email address");
            $("#addUser").validate({
                rules: {
                    profileFor: {
                        required: false,
                    },
                    gender: {
                        required: false,
                    },
                    firstName: {
                        required: false,
                    },
                    lastName: {
                        required: false,
                    },
                    editDateOfBirth: {
                        required: false,
                    },
                    editCountry: {
                        required: false,
                    },
                    editState: {
                        required: true
                    },
                    email: {
                        required: false,
                        customEmail: true
                    },
                    primaryMobNum: {
                        required: false,
                    },
                    addWhatsappNum:{
                        required: false,
                    },
                    whatsappNum: {
                        required: false,
                    },
                    maritalStatus: {
                        required: false,
                    },
                    mothertongue: {
                        required: false,
                    },
                    caste: {
                        required: false,
                    },
                    denomination: {
                        required: false,
                    },
                    height: {
                        required: false,
                    },
                    weight: {
                        required: false,
                    },
                    complexion: {
                        required: false,
                    },
                    last_edu_level: {
                        required: false,
                    },
                    occupation: {
                        required: false,
                    },
                    company_name: {
                        required: false,
                    },
                    editAnnualIncome:{
                        required: false,
                    },
                    work_location: {
                        required: false,
                    },
                    fatherName: {
                        required: false,
                    },
                    fatherOccupation: {
                        required: false,
                    },
                    motherName: {
                        required: false,
                    },
                    motherOccupation: {
                        required: false,
                    },
                    familystatus: {
                        required: false,
                    },
                    noOfBrother: {
                        required: false,
                    },
                    brotherMarried: {
                        required: false,
                    },
                    noOfsister: {
                        required: false,
                    },
                    sisterMarried: {
                        required: false,
                    },
                    editAnnualIncome:{
                        required: false,
                    },
                    address: {
                        required: false,
                    },
                    citizenOf: {
                        required: false,
                    },
                    permAddress: {
                        required: false,
                    },
                    choseAddress: {
                        required: false,
                    },
                    editphoto: {
                        required: false,
                    }
                },
                messages: {
                    profileFor: {
                        required: "This field is required."
                    },
                    gender: {
                        required: "This field is required."
                    },
                    firstName: {
                        required: "This field is required."
                    },
                    lastName: {
                        required: "This field is required."
                    },
                    editDateOfBirth: {
                        required: "This field is required."
                    },
                    editCountry: {
                        required: "This field is required."
                    },
                    editState: {
                        required: true
                    },
                    email: {
                        required: "This field is required.",
                        customEmail: "This field is required."
                    },
                    primaryMobNum: {
                        required: "This field is required."
                    },
                    addWhatsappNum:{
                        required: "This field is required."
                    },
                    whatsappNum: {
                        required: "This field is required."
                    },
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
                    editAnnualIncome:{
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
                    editAnnualIncome:{
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
                    editphoto: {
                        required: "This field is required."
                    }
                },
                submitHandler: function (form, event) {
                    event.preventDefault();

                    // Get the selected country code
                    var primarryNum_countryCode = iti.getSelectedCountryData().dialCode;
                    var primarryNum_phoneNumber = $("#primaryMobNum").val();
                    var primarryNumber = "+" + primarryNum_countryCode + primarryNum_phoneNumber;
                    $("#primaryMobNum").val(primarryNumber);

                    // Now create the FormData object
                    const formData = new FormData(form);
                    formData.set('primaryMobNum', primarryNumber);

                    // Check the selected value for WhatsApp number
                    var selectedValue = $('input[name="addWhatsappNum"]:checked').val();
                    if (selectedValue === 'differentNumber') {
                        // Get the selected country code for the WhatsApp number
                        var whatsappNum_countryCode = iti.getSelectedCountryData().dialCode;
                        var whatsappNum_phoneNumber = $("#whatsappNum").val();
                        var whatsappNumNumber = "+" + whatsappNum_countryCode + whatsappNum_phoneNumber;
                        $("#whatsappNum").val(whatsappNumNumber);

                        formData.set('whatsappNum', whatsappNumNumber);
                    }

                    var formStatus = 'active';
                    formData.forEach(function(value, key) {
                        if (!value) {
                            formData.set(key, null);
                            formStatus = 'ready';
                            return false;
                        }
                    });

                    formData.set('status', formStatus);

                    // Convert FormData to JSON object
                    var jsonObject = {};
                    formData.forEach(function(value, key) {
                        jsonObject[key] = value;
                    });

                    console.log(jsonObject);

                    // Send form data using AJAX
                    // Send form data using AJAX
                    $.ajax({
    url: 'save_user.php', // PHP file to handle form submission
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
        console.log(response); // Check the response in the console

        // Assuming your response is an object with 'success' property
        if (response.success) {
            // Show SweetAlert2 pop-up upon successful submission
            Swal.fire({
                title: 'Created!',
                text: 'The profile has been updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                // Redirect the user if they click 'OK'
                if (result.isConfirmed) {
                    window.location.reload(); // Refresh the page
                }
            });
        } else {
            // Handle failure scenario
            Swal.fire({
                title: 'Created!',
                text: 'The profile has been created successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
								if (result.isConfirmed) {
									window.location.href = "https://bnrstage.mvgdigital.com/admin-login/users.php";
								}
							});
        }
    },
    error: function(xhr, status, error) {
        console.error('Error occurred during AJAX request:', error);
        // Handle error response
        Swal.fire({
            title: 'Error!',
            text: 'An error occurred while processing your request. Please try again later.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
});



                    return false; // Prevent form submission for this example
                }
            });
        });


         //User Details Page validations
         window.scrollTo(0, 0);
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

        //Profile code
        // Listen for changes in the value of profileFor
        $('#profileFor').on('change', function() {
            var profileFor = $(this).val();
            if (profileFor != null && profileFor.trim() !== '') {
                $('#profileFor-error').hide(); // Hide error message if the field is not empty
                if(profileFor === 'Daughter'|| profileFor === 'Sister'){
                    $("#male").prop("disabled", true); 
                    $("#female").prop("disabled", false);
                    $("#female").prop("checked", true);
                    $('#gender-error').hide();
                }else if(profileFor === 'Son'|| profileFor === 'Brother'){
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
            }
        });
        
        //Date validation code
        var currentDate = new Date();
        var maxDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate()); // Date 18 years ago

        $('#editDateOfBirth').datepicker({
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
    
        $("#editCountry").select2({
            placeholder: "Select country",
            allowClear: true
        });
        $("#editCountry").select2({
            placeholder: "Select state",
            allowClear: true
        });
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

        /* Whatsapp Mobile Number */
        // Event listener for changes in radio buttons
        $('input[name="addWhatsappNum"]').change(function() {
            var selectedValue = $('input[name="addWhatsappNum"]:checked').val();
            if (selectedValue === 'differentNumber') {
                // Show the address field if "Different than above" is selected
                // Initialize intlTelInput after the document is loaded
                $('#addNewNumber').show();            
                document.getElementById('addNewNumber').innerHTML = `
                    <div  class="form-field">
                        <label for="whatsappNum">Whatsapp Number</label>
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

          //Detail Form code
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
                        <div class="form-field">
                            <label for="brotherMarried">Brothers Married</label>
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
                        <div class="form-field">
                            <label for="sisterMarried">Sisters Married</label>
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
                        <div class="form-field">
                            <label for="permAddress">Permanent Address</label>
                            <textarea id="permAddress" class="address" name="permAddress"></textarea>
                        </div>`;
                } else {
                    // Clear the address field if "Same as above" is selected
                    console.log("not woking!");
                    $('#addNewAddress').hide();
                    document.getElementById('addNewAddress').innerHTML = '';
                }
            });
          
          //Upload Photo
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

          // Add custom email validation method
            $.validator.addMethod("customEmail", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(value);
            }, "Please enter a valid email address");

           
		
	</script>
</body>
</html>