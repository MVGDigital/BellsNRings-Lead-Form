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
    <title>Detailed Form</title>
    <link rel="shortcut icon" href="./assets/img/bnr-fav.png" type="image/x-icon">

    <!-- Style Files -->
    <link rel="stylesheet" href="./assets/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/select2.min.css"/>
    <link rel="stylesheet" href="./assets/css/jquery-ui.min.css"/>
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
    <div class="main-container bg-img">
        <div class="row ml_50 mr_0 form-container">
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

                    <!-- Form -->
                   

                    <div class="mt_50">
                        <div class="progress-container">
                            <div class="progress px-1" style="height: 3px;">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="step-container d-flex justify-content-between">
                                <div class="wizard-progress" onclick="displayStep(1)">
                                    <div class="step-circle step1-circle">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 0C6.71484 0 0 6.71484 0 15C0 23.2852 6.71484 30 15 30C23.2852 30 30 23.2852 30 15C30 6.71484 23.2852 0 15 0ZM15 25.002C9.47461 25.002 4.99805 20.5254 4.99805 15C4.99805 9.47461 9.47461 4.99805 15 4.99805C20.5254 4.99805 25.002 9.47461 25.002 15C25.002 20.5254 20.5254 25.002 15 25.002ZM15 10.002C12.2402 10.002 10.002 12.2402 10.002 15C10.002 17.7598 12.2402 19.998 15 19.998C17.7598 19.998 19.998 17.7598 19.998 15C19.998 12.2402 17.7598 10.002 15 10.002Z" fill="#DC75B0"/>
                                        </svg> 
                                    </div> 
                                    <h5 class="progress-step-1">BASIC DETAILS</h5>
                                </div>
                                <div class="wizard-progress" onclick="displayStep(2)">
                                    <div class="step-circle step2-circle">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 0C6.71484 0 0 6.71484 0 15C0 23.2852 6.71484 30 15 30C23.2852 30 30 23.2852 30 15C30 6.71484 23.2852 0 15 0ZM15 25.002C9.47461 25.002 4.99805 20.5254 4.99805 15C4.99805 9.47461 9.47461 4.99805 15 4.99805C20.5254 4.99805 25.002 9.47461 25.002 15C25.002 20.5254 20.5254 25.002 15 25.002ZM15 10.002C12.2402 10.002 10.002 12.2402 10.002 15C10.002 17.7598 12.2402 19.998 15 19.998C17.7598 19.998 19.998 17.7598 19.998 15C19.998 12.2402 17.7598 10.002 15 10.002Z" fill="#C5C5C5"/>
                                        </svg>
                                    </div>
                                    <h5 class="progress-step-2">PROFESSIONAL<br> DETAILS</h5>
                                </div>
                                <div class="wizard-progress" onclick="displayStep(3)">
                                    <div class="step-circle step3-circle">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 0C6.71484 0 0 6.71484 0 15C0 23.2852 6.71484 30 15 30C23.2852 30 30 23.2852 30 15C30 6.71484 23.2852 0 15 0ZM15 25.002C9.47461 25.002 4.99805 20.5254 4.99805 15C4.99805 9.47461 9.47461 4.99805 15 4.99805C20.5254 4.99805 25.002 9.47461 25.002 15C25.002 20.5254 20.5254 25.002 15 25.002ZM15 10.002C12.2402 10.002 10.002 12.2402 10.002 15C10.002 17.7598 12.2402 19.998 15 19.998C17.7598 19.998 19.998 17.7598 19.998 15C19.998 12.2402 17.7598 10.002 15 10.002Z" fill="#C5C5C5"/>
                                        </svg>
                                    </div>
                                    <h5 class="progress-step-3">FAMILY DETAILS</h5>
                                </div>
                            </div>
                        </div>

                      
                        <form id="multi-step-form">
                        <input type="hidden" id="bnr_id" name="bnr_id" value="<?php echo $decryptbnr_id; ?>">
                          <div class="step step-1">
                            <!-- Step 1 form fields here -->
                            
                            <!-- Form -->
                            <div id="detailedForm1" class="form-section">
                                
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="maritalStatus">Marital Status<span class="requirdField" >*</span> </label>
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
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="mothertongue">Mother Tongue <span class="requirdField" >*</span></label>
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
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="caste">Caste <span class="requirdField" >*</span></label>
                                        <select id="caste" class="form-select" name="caste">
                                            <option value="">Select caste</option>
                                            <option value="achari">Achari</option>
                                            <option value="adi_dravida">Adi Dravida</option>
                                            <option value="agamudiyar">Agamudiyar</option>
                                            <option value="anglo_indian">Anglo Indian</option>
                                            <option value="arunthathiyar">Arunthathiyar</option>
                                            <option value="bc">BC</option>
                                            <option value="brahmin">Brahmin</option>
                                            <option value="caste_nobar">Caste Nobar</option>
                                            <option value="chettiyar">Chettiyar</option>
                                            <option value="devendra_kula_vellalar">Devendra Kula Vellalar</option>
                                            <option value="ediga">Ediga</option>
                                            <option value="gounder">Gounder</option>
                                            <option value="intercaste">Intercaste</option>
                                            <option value="kallar">Kallar</option>
                                            <option value="kamalar">Kamalar</option>
                                            <option value="kongu_vellalar_gounder">Kongu Vellalar Gounder</option>
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
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="denomination">Denomination <span class="requirdField" >*</span></label>
                                        <select id="denomination" class="form-select" name="denomination">
                                            <option value="">Select denomination</option>
                                            <option value="ag">AG</option>
                                            <option value="adventist">Adventist</option>
                                            <option value="aci_anglican_church_of_india">ACI-Anglican Church of India</option>
                                            <option value="apostolic">Apostolic</option>
                                            <option value="arcot_lutheran">Arcot Lutheran</option>
                                            <option value="baptist">Baptist</option>
                                            <option value="brethren">Brethren</option>
                                            <option value="catholic">Catholic</option>
                                            <option value="christian_others">Christian -others</option>
                                            <option value="church_of_christ">Church of Christ</option>
                                            <option value="church_of_god">Church of God</option>
                                            <option value="cni_church_of_north_india">CNI- Church of North India</option>
                                            <option value="congregational">Congregational</option>
                                            <option value="cpm_ceylon_pentecostal_mission">CPM-Ceylon Pentecostal Mission</option>
                                            <option value="csi_church_of_south_india">CSI-Church of South India</option>
                                            <option value="dont_wish_to_specify">Don’t Wish to specify</option>
                                            <option value="evangelical">Evangelical</option>
                                            <option value="eci_evangelical_church_of_india">ECI- Evangelical Church of India</option>
                                            <option value="evangelist">Evangelist</option>
                                            <option value="independent_church">Independent Church</option>
                                            <option value="jacobite">Jacobite</option>
                                            <option value="jehovah_witness">Jehovah Witness</option>
                                            <option value="jehovah_shammah">Jehovah Shammah</option>
                                            <option value="latin">Latin</option>
                                            <option value="lutheran">Lutheran</option>
                                            <option value="methodist">Methodist</option>
                                            <option value="orthodox">Orthodox</option>
                                            <option value="others">Others</option>
                                            <option value="pentecostal">Pentecostal</option>
                                            <option value="presbyterian">Presbyterian</option>
                                            <option value="protestant">Protestant</option>
                                            <option value="reformed_baptist">Reformed Baptist</option>
                                            <option value="roman_catholic">Roman Catholic</option>
                                            <option value="seventh_day_adventist">Seventh day Adventist</option>
                                            <option value="st_thomas_evangalical">St Thomas Evangalical</option>
                                            <option value="syrian_catholic">Syrian Catholic</option>
                                            <option value="syrian_orthodox">Syrian Orthodox</option>
                                            <option value="syrian_jacobite">Syrian Jacobite</option>
                                            <option value="syro_malabar">Syro Malabar</option>
                                            <option value="telc_tamil_evangelical_lutheran_church">TELC- Tamil Evangelical Lutheran Church</option>
                                            <option value="tpm_the_pentecostal_mission">TPM-The Pentecostal Mission</option>
                                            <option value="woj_assembly_of_god">Woj -Assembly of God</option>
                                            <option value="woj_pentecostal">WOJ- Pentecostal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12 d-flex">
                                    <div class="height-width pr">
                                        <div class="form-field mb-3">
                                            <label for="height">Height <span class="requirdField" >*</span></label>
                                            <select id="height" class="form-select" name="height">
                                                <option value="">select height</option>
                                                <option value="4ft_1in">4ft 1in</option>
                                                <option value="4ft_2in">4ft 2in</option>
                                                <option value="4ft_3in">4ft 3in</option>
                                                <option value="4ft_4in">4ft 4in</option>
                                                <option value="4ft_5in">4ft 5in</option>
                                                <option value="4ft_6in">4ft 6in</option>
                                                <option value="4ft_7in">4ft 7in</option>
                                                <option value="4ft_8in">4ft 8in</option>
                                                <option value="4ft_9in">4ft 9in</option>
                                                <option value="4ft_10in">4ft 10in</option>
                                                <option value="4ft_11in">4ft 11in</option>
                                                <option value="5ft_0in">5ft 0in</option>
                                                <option value="5ft_1in">5ft 1in</option>
                                                <option value="5ft_2in">5ft 2in</option>
                                                <option value="5ft_3in">5ft 3in</option>
                                                <option value="5ft_4in">5ft 4in</option>
                                                <option value="5ft_5in">5ft 5in</option>
                                                <option value="5ft_6in">5ft 6in</option>
                                                <option value="5ft_7in">5ft 7in</option>
                                                <option value="5ft_8in">5ft 8in</option>
                                                <option value="5ft_9in">5ft 9in</option>
                                                <option value="5ft_10in">5ft 10in</option>
                                                <option value="5ft_11in">5ft 11in</option>
                                                <option value="6ft_0in">6ft 0in</option>
                                                <option value="6ft_1in">6ft 1in</option>
                                                <option value="6ft_2in">6ft 2in</option>
                                                <option value="6ft_3in">6ft 3in</option>
                                                <option value="6ft_4in">6ft 4in</option>
                                                <option value="6ft_5in">6ft 5in</option>
                                                <option value="6ft_6in">6ft 6in</option>
                                                <option value="6ft_7in">6ft 7in</option>
                                                <option value="6ft_8in">6ft 8in</option>
                                                <option value="6ft_9in">6ft 9in</option>
                                                <option value="6ft_10in">6ft 10in</option>
                                                <option value="6ft_11in">6ft 11in</option>
                                                <option value="7ft_0in">7ft 0in</option>
                                                <option value="7ft_1in">7ft 1in</option>
                                                <option value="7ft_2in">7ft 2in</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="height-width pl">
                                        <div class="form-field mb-3">
                                            <label for="weight">Weight <span class="requirdField" >*</span></label>
                                            <select id="weight" class="form-select" name="weight">
                                                <option value="">select weight</option>
                                                <option value="40_kg">40 kg</option>
                                                <option value="41_kg">41 kg</option>
                                                <option value="42_kg">42 kg</option>
                                                <option value="43_kg">43 kg</option>
                                                <option value="44_kg">44 kg</option>
                                                <option value="45_kg">45 kg</option>
                                                <option value="46_kg">46 kg</option>
                                                <option value="47_kg">47 kg</option>
                                                <option value="48_kg">48 kg</option>
                                                <option value="49_kg">49 kg</option>
                                                <option value="50_kg">50 kg</option>
                                                <option value="51_kg">51 kg</option>
                                                <option value="52_kg">52 kg</option>
                                                <option value="53_kg">53 kg</option>
                                                <option value="54_kg">54 kg</option>
                                                <option value="55_kg">55 kg</option>
                                                <option value="56_kg">56 kg</option>
                                                <option value="57_kg">57 kg</option>
                                                <option value="58_kg">58 kg</option>
                                                <option value="59_kg">59 kg</option>
                                                <option value="60_kg">60 kg</option>
                                                <option value="61_kg">61 kg</option>
                                                <option value="62_kg">62 kg</option>
                                                <option value="63_kg">63 kg</option>
                                                <option value="64_kg">64 kg</option>
                                                <option value="65_kg">65 kg</option>
                                                <option value="66_kg">66 kg</option>
                                                <option value="67_kg">67 kg</option>
                                                <option value="68_kg">68 kg</option>
                                                <option value="69_kg">69 kg</option>
                                                <option value="70_kg">70 kg</option>
                                                <option value="71_kg">71 kg</option>
                                                <option value="72_kg">72 kg</option>
                                                <option value="73_kg">73 kg</option>
                                                <option value="74_kg">74 kg</option>
                                                <option value="75_kg">75 kg</option>
                                                <option value="76_kg">76 kg</option>
                                                <option value="77_kg">77 kg</option>
                                                <option value="78_kg">78 kg</option>
                                                <option value="79_kg">79 kg</option>
                                                <option value="80_kg">80 kg</option>
                                                <option value="81_kg">81 kg</option>
                                                <option value="82_kg">82 kg</option>
                                                <option value="83_kg">83 kg</option>
                                                <option value="84_kg">84 kg</option>
                                                <option value="85_kg">85 kg</option>
                                                <option value="86_kg">86 kg</option>
                                                <option value="87_kg">87 kg</option>
                                                <option value="88_kg">88 kg</option>
                                                <option value="89_kg">89 kg</option>
                                                <option value="90_kg">90 kg</option>
                                                <option value="91_kg">91 kg</option>
                                                <option value="92_kg">92 kg</option>
                                                <option value="93_kg">93 kg</option>
                                                <option value="94_kg">94 kg</option>
                                                <option value="95_kg">95 kg</option>
                                                <option value="96_kg">96 kg</option>
                                                <option value="97_kg">97 kg</option>
                                                <option value="98_kg">98 kg</option>
                                                <option value="99_kg">99 kg</option>
                                                <option value="100_kg">100 kg</option>
                                                <option value="101_kg">101 kg</option>
                                                <option value="102_kg">102 kg</option>
                                                <option value="103_kg">103 kg</option>
                                                <option value="104_kg">104 kg</option>
                                                <option value="105_kg">105 kg</option>
                                                <option value="106_kg">106 kg</option>
                                                <option value="107_kg">107 kg</option>
                                                <option value="108_kg">108 kg</option>
                                                <option value="109_kg">109 kg</option>
                                                <option value="110_kg">110 kg</option>
                                                <option value="111_kg">111 kg</option>
                                                <option value="112_kg">112 kg</option>
                                                <option value="113_kg">113 kg</option>
                                                <option value="114_kg">114 kg</option>
                                                <option value="115_kg">115 kg</option>
                                                <option value="116_kg">116 kg</option>
                                                <option value="117_kg">117 kg</option>
                                                <option value="118_kg">118 kg</option>
                                                <option value="119_kg">119 kg</option>
                                                <option value="120_kg">120 kg</option>
                                                <option value="121_kg">121 kg</option>
                                                <option value="122_kg">122 kg</option>
                                                <option value="123_kg">123 kg</option>
                                                <option value="124_kg">124 kg</option>
                                                <option value="125_kg">125 kg</option>
                                                <option value="126_kg">126 kg</option>
                                                <option value="127_kg">127 kg</option>
                                                <option value="128_kg">128 kg</option>
                                                <option value="129_kg">129 kg</option>
                                                <option value="130_kg">130 kg</option>
                                                <option value="131_kg">131 kg</option>
                                                <option value="132_kg">132 kg</option>
                                                <option value="133_kg">133 kg</option>
                                                <option value="134_kg">134 kg</option>
                                                <option value="135_kg">135 kg</option>
                                                <option value="136_kg">136 kg</option>
                                                <option value="137_kg">137 kg</option>
                                                <option value="138_kg">138 kg</option>
                                                <option value="139_kg">139 kg</option>
                                                <option value="140_kg">140 kg</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="complexion">Complexion <span class="requirdField" >*</span></label>
                                        <select id="complexion" class="form-select" name="complexion">
                                            <option value="">Select complexion</option>
                                            <option value="dark">Dark</option>
                                            <option value="wheatish">Wheatish</option>
                                            <option value="wheetish_brown">Wheatish Brown</option>
                                            <option value="fair">Fair</option>
                                            <option value="very_fair">Very Fair</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-12 text-center  mt_30 mb_40">
                                    <button type="button" class="submit_btn next-step">Next</button>
                                </div>
                            </div>
                            <!-- Form -->
                          </div>
                      
                          <div class="step step-2">
                            <!-- Step 2 form fields here -->
                            <div id="detailedForm2" class="form-section">
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="last_edu_level">Last Education Level <span class="requirdField" >*</span></label>
                                        <input type="text" id="last_edu_level" name="last_edu_level" placeholder="Enter Last education level">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="occupation">Occupation <span class="requirdField" >*</span></label>
                                        <input type="text" id="occupation" name="occupation" placeholder="Enter Occupation">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="company_name">Company Name <span class="requirdField" >*</span></label>
                                        <input type="text" id="company_name" name="company_name" placeholder="Enter company name">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="annual_income">Annual Income <span class="requirdField" >*</span></label>
                                        <input type="text" id="annual_income" name="annual_income" class="price-format-input form-select inr-icon" placeholder="Enter annual income">
                                        <div id="textBelowIncome" class=""></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="work_location">Work Location <span class="requirdField" >*</span></label>
                                        <input type="text" id="work_location" name="work_location" class="form-select locarion" placeholder="Enter work location">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center  mt_30 mb_40">
                                <button type="button" class="submit_btn prev-step">Back</button>
                                <button type="button" class="submit_btn next-step">Next</button>
                            </div>
                          </div>
                      
                          <div class="step step-3">
                            <!-- Step 3 form fields here -->
                            <div id="detailedForm2" class="form-section">
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="fatherName">Father Name <span class="requirdField" >*</span></label>
                                        <input type="text" id="fatherName" name="fatherName" placeholder="Enter father name">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="fatherOccupation">Father Occupation <span class="requirdField" >*</span></label>
                                        <input type="text" id="fatherOccupation" name="fatherOccupation" placeholder="Enter father occupation">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="motherName">Mother Name <span class="requirdField" >*</span></label>
                                        <input type="text" id="motherName" name="motherName" placeholder="Enter mother name">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="motherOccupation">Mother Occupation <span class="requirdField" >*</span></label>
                                        <input type="text" id="motherOccupation" name="motherOccupation" placeholder="Enter mother occupation">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="familystatus">Family Status <span class="requirdField" >*</span></label>
                                        <select id="familystatus" name="familystatus"  class="form-select">
                                            <option value="" selected>Select family status</option>
                                            <option value="lower_middle_class">Lower Middle Class</option>
                                            <option value="middle_class">Middle Class</option>
                                            <option value="upper_middle_class">Upper Middle Class</option>
                                            <option value="rich">Rich</option>
                                            <option value="affluent">Affluent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 sec-title mt_30">
                                    <h4>Siblings</h4>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="noOfBrother">No. of Brothers <span class="requirdField" >*</span></label>
                                        <select id="noOfBrother" name="noOfBrother" class="form-select" >
                                            <option value="no" selected>No</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                          </select>
                                    </div>
                                </div>
                                <div id="brother-married-field" class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="noOfsister">No. of Sisters <span class="requirdField" >*</span></label>
                                        <select id="noOfsister" name="noOfsister" class="form-select">
                                            <option value="no" selected>No</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                          </select>
                                    </div>
                                </div>
                                <div id="sister-married-field" class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    
                                </div>
                                <div class="col-12 sec-title mt_30">
                                    <h4>Contact Information</h4>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="address">Address <span class="requirdField" >*</span></label>
                                        <textarea id="address" name="address" class="address"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="citizenOf">Citizen of <span class="requirdField" >*</span></label>
                                        <input type="text" id="citizenOf" name="citizenOf" placeholder="Enter citizen of">
                                    </div>
                                </div>
                                <div id="addNewAddress" class="col-12 col-lg-5 col-md-5 col-sm-12">

                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="same_address">Permanent Address is <span class="requirdField" >*</span></label>
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
                                <div class="col-12 sec-title mt_30">
                                    <h4>Photo</h4>
                                </div>
                                <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-field mb-3">
                                        <label for="imag">Need to upload your recent photo</label>
                                        <div class="img-upload">
                                            <span class="btn_upload">
                                              <input type="file" id="imag" name="imag" class="input-img"/>
                                              Choose Image
                                              </span>
                                            <img id="ImgPreview" src="" class="preview1" />
                                            <input type="button" id="removeImage1" value="" class="btn-rmv1" />
                                          </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 text-center  mt_30 mb_40">
                                <button type="button" class="submit_btn prev-step">Back</button>
                                <button type="submit" class="submit_btn">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    
                    <!-- Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- Main Container -->

    <!-- plugin Files -->
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/jquery-ui.min.js"></script>
    <script src="./assets/bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <script src="./assets/js/select2.min.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <script>
       // Detailde Form Js
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
			addmarriedBrotherscol.innerHTML = 
			'<div class="form-field mb-3">' +
				'<label for="brotherMarried">Brothers Married <span class="requirdField" >*</span></label>' +
				'<select id="brotherMarried" name="brotherMarried" class="form-select">' +
					'<option value="no" selected>No</option>' +
					'<option value="1">1</option>' +
					'<option value="2">2</option>' +
					'<option value="3">3</option>' +
					'<option value="4">4</option>' +
					'<option value="5">5</option>' +
					'<option value="6">6</option>' +
				'</select>' +
			'</div>';

           
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
            $("#sister-married-field").show();
            addmarriedSisterscol.innerHTML = 
			'<div class="form-field mb-3">' +
				'<label for="sisterMarried">Sisters Married <span class="requirdField" >*</span></label>' +
				'<select id="sisterMarried" name="sisterMarried" class="form-select">' +
					'<option value="no" selected>No</option>' +
					'<option value="1">1</option>' +
					'<option value="2">2</option>' +
					'<option value="3">3</option>' +
					'<option value="4">4</option>' +
					'<option value="5">5</option>' +
					'<option value="6">6</option>' +
				'</select>' +
			'</div>';

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
            document.getElementById('addNewAddress').innerHTML =
				'<div class="form-field mb-3">' +
				'<label for="permAddress">Permanent Address <span class="requirdField" >*</span></label>' +
				'<textarea id="permAddress" class="address" name="permAddress"></textarea>' +
				'</div>';

        } else {
            // Clear the address field if "Same as above" is selected
            console.log("not woking!");
            $('#addNewAddress').hide();
            document.getElementById('addNewAddress').innerHTML = '';
        }
    });

    $("#multi-step-form").validate({
        rules: {
            maritalStatus: {
                required: true
            },
            mothertongue: {
                required: true
            },
            caste: {
                required: true
            },
            denomination: {
                required: true
            },
            height: {
                required: true
            },
            weight: {
                required: true
            },
            complexion: {
                required: true
            },
            last_edu_level: {
                required: true
            },
            occupation: {
                required: true
            },
            company_name: {
                required: true
            },
            annual_income: {
                required: true
            },
            work_location: {
                required: true
            },
            fatherName: {
                required: true
            },
            fatherOccupation: {
                required: true
            },
            motherName: {
                required: true
            },
            motherOccupation: {
                required: true
            },
            familystatus: {
                required: true
            },
            noOfBrother: {
                required: true
            },
            brotherMarried: {
                required: true
            },
            noOfsister: {
                required: true
            },
            sisterMarried: {
                required: true
            },
            address: {
                required: true
            },
            citizenOf: {
                required: true
            },
            permAddress: {
                required: true
            },
            choseAddress: {
                required: true
            },
            imag: {
                required: false
            },
            
            
        },
        messages: {
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
            annual_income: {
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
            imag: {
                required: false
            },
        },
        errorElement: 'label',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-field').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
    // Submit the form via AJAX
    $.ajax({
        url: 'save_profile_data.php',
        type: 'POST',
        data: $(form).serialize(), // Serialize the form data
        success: function(response) 
			{
				window.location.href = 'success_page.php';

			},
        error: function(xhr, status, error) {
            $('#responseMessage').html("An error occurred: " + xhr.status + " " + error); // Display the error
        }
    });
}

    });

    function handleFieldChange(fieldId, errorId) {
        $(fieldId).on('change', function() {
            if ($(this).val() == '') {
                $(errorId).show();
                console.log("empty");
            } else {
                console.log("fill");
                $(errorId).hide();
            }
        });
    }
    handleFieldChange('#maritalStatus', '#maritalStatus-error');
    handleFieldChange('#mothertongue', '#mothertongue-error');
    handleFieldChange('#caste', '#caste-error');
    handleFieldChange('#denomination', '#denomination-error');
    handleFieldChange('#height', '#height-error');
    handleFieldChange('#weight', '#weight-error');
    handleFieldChange('#complexion', '#complexion-error');

    handleFieldChange('#fatherName', '#fatherName-error');
    handleFieldChange('#fatherOccupation', '#fatherOccupation-error');
    handleFieldChange('#motherName', '#motherName-error');
    handleFieldChange('#motherOccupation', '#motherOccupation-error');
    handleFieldChange('#familystatus', '#familystatus-error');
    handleFieldChange('#noOfBrother', '#noOfBrother-error');
    handleFieldChange('#brotherMarried', '#brotherMarried-error');
    handleFieldChange('#noOfsister', '#noOfsister-error');
    handleFieldChange('#sisterMarried', '#sisterMarried-error');
    handleFieldChange('#address', '#address-error');

    handleFieldChange('#citizenOf', '#citizenOf-error');
    handleFieldChange('#permAddress', '#permAddress-error');
    handleFieldChange('#choseAddress', '#choseAddress-error');
    handleFieldChange('#imag', '#imag-error');
    

    var currentStep = 1;
        var updateProgressBar;

        function displayStep(stepNumber) {
            if (stepNumber >= 1 && stepNumber <= 3) {
                $(".step-" + currentStep).hide();
                $(".step-" + stepNumber).show();
                currentStep = stepNumber;
                updateProgressBar();
            }
        }

            $("#multi-step-form").find(".step").slice(1).hide();

            $(".next-step").click(function () {
                // Validate the form
                if ($("#multi-step-form").valid()) {
                    if (currentStep < 3) {
                        $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
                        currentStep++;
                        setTimeout(function () {
                            $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
                            $(".step-" + currentStep)
                                .show()
                                .addClass("animate__animated animate__fadeInRight");
                            updateProgressBar();
                            changeSvgColor();
                        }, 500);
                    }
                } else {
                    // If the form is not valid, do not proceed to the next step
                    // Optionally, you can display an error message to the user
                    console.log("Please fill in all required fields.");
                }
            });
            
            $(".prev-step").click(function () {
                if (currentStep > 1) {
                    $(".step-" + currentStep).addClass(
                        "animate__animated animate__fadeOutRight"
                    );
                    currentStep--;
                    setTimeout(function () {
                        $(".step")
                            .removeClass("animate__animated animate__fadeOutRight")
                            .hide();
                        $(".step-" + currentStep)
                            .show()
                            .addClass("animate__animated animate__fadeInLeft");
                        updateProgressBar();
                        changeSvgColor();
                    }, 500);
                }
            });
            updateProgressBar = function () {
                var progressPercentage = ((currentStep - 1) / 2) * 100;
                $(".progress-bar").css("width", progressPercentage + "%");
            };
            function changeSvgColor() {
                var progressPercentage = ((currentStep - 1) / 2) * 100;
                if (progressPercentage === 0) {
                    // Change icon color here
                    $(".progress-step-1").css('font-weight', "600");
                    $(".progress-step-2").css('font-weight', "500");
                    $(".progress-step-3").css('font-weight', "500");
                    
                }if (progressPercentage === 50) {
                    // Change icon color here
                    $(".step2-circle svg path").css("fill", "#DC75B0"); 
                    $(".step3-circle svg path").css("fill", "");
                    $(".progress-step-1").css('font-weight', "500");
                    $(".progress-step-2").css('font-weight', "600");
                    $(".progress-step-3").css('font-weight', "500");
                }else if(progressPercentage === 100) {
                    // Change icon color here
                    $(".progress-step-1").css('font-weight', "500");
                    $(".progress-step-2").css('font-weight', "500");
                    $(".progress-step-3").css('font-weight', "600");
                    $(".step3-circle svg path").css("fill", "#DC75B0"); // Replace "#DC75B0" with your desired color
                } else {
                    // Reset icon color if progress bar width is not 50%
                    $(".step-circle svg path").css("fill", ""); // Reset color to 
                }
            }
        
            // Call updateProgressBar function initially
            updateProgressBar();

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
              
              $("#imag").change(function() {
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
                $("#imag").val("");
                //$("#ImgPreview").attr("src", "");
                $("#ImgPreview").hide(function(){
                    $("#ImgPreview").attr("src", "");
                });
                $('.preview1').removeClass('it');
                $('.btn-rmv1').removeClass('rmv');
              });

    </script>    
</body>
</html>