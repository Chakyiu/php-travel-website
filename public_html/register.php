<!DOCTYPE html>
<?php
	session_start();
	if(isset($_SESSION['user'])) {
		header('location:home.php');
	}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impress Travel</title>

    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/fa/all.css" rel="stylesheet" type="text/css">
    <link href="css/layout.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row"> 
        <img src="src/image/logo.png" style="padding: 5px 0 5px 0;"/>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Impress Travel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"><i class="fas fa-home" style="font-size:16px"></i>Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search_flight.php"><i class="fas fa-fighter-jet" style="font-size:16px"></i>Flight</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search_hotel.php"><i class="fas fa-hotel" style="font-size:16px"></i>Hotel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="list_package.php"><i class="fas fa-cubes" style="font-size:16px"></i>Package</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user" style="font-size:16px"></i>
                <?php
                	if(isset($_SESSION['user']))
						echo $_SESSION['name'];
					else
						echo "Account"
				?>
            </a>
            <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="navbarDropdown">
              <?php
                if(isset($_SESSION['user'])) {
                    if($_SESSION['user'] == "customer") { ?>
                        <a class="dropdown-item" href="customer_profile.php">My Profile</a>
                        <a class="dropdown-item" href="customer_booking.php">My Booking</a>
                        <a class="dropdown-item" href="staff_check_shoppingcart.php">Shopping Cart</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">Sign Out</a>
                <?php
                    }
                    if($_SESSION['user'] == "staff") { ?>
                        <a class="dropdown-item" href="staff_edit_customer.php">Edit Customer</a>
                        <a class="dropdown-item" href="staff_edit_booking.php">Customer Booking</a>
                        <a class="dropdown-item" href="staff_view_airline.php">View Airline</a>
                        <a class="dropdown-item" href="staff_view_hotel.php">View Hotel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="airline_report.php">Analysis Report</a>
                        <a class="dropdown-item" href="hotelowner_report.php">Room Report</a>
                        <a class="dropdown-item" href="staff_view_pop_flight.php">Pop Flight</a>
                        <a class="dropdown-item" href="staff_view_pop_hotel.php">Pop Hotel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">Sign Out</a>
                <?php
                    }
                } else { ?>
                    <a class="dropdown-item" href="login.php">Sign in</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="register.php">Sign up</a>
            <?php } ?>
            </div>
          </li>
    </uL>
  </div>
</nav>

<div class="container mt-4">
  <div class="row">
      <div class="col-md-offset-1 col-12 well shadow" style="background-color:rgba(255,255,255,0.8)">
        <h2 style="margin-bottom:30px; margin-top:30px; text-align:center;">Register</h2>
		<!-- form -->
        <form action="registerVerify.php" method="post">
			<div class="form-group">
				<label for="user_account_ID">User Account</label>
				<input type="text" class="form-control" id="user_account_ID" placeholder="User Account" name="user_account_ID">
			</div>
			
			<div class="form-group">
				<label for="user_account_PW">Account Password</label>
				<input type="text" class="form-control" id="user_account_PW" placeholder="Password" name="user_account_PW">
			</div>
			
			<div class="form-group">
				<label for="firstname ">First Name</label>
				<input type="text " class="form-control" id="firstname " placeholder="First Name" name="firstname">
			</div>
			
			<div class="form-group">
				<label for="lastname">Last Name</label>
				<input type="text " class="form-control" id="lastname" placeholder="Last Name" name="lastname">
			</div>
			
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text " class="form-control" id="email " placeholder="Email" name="email">
			</div>
			
			<div class="form-group">
				<label>Gender</label>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="gender1" name="gender" value="M" required checked>
					<label class="custom-control-label" for="gender1">Male</label>
				</div>
				<div class="custom-control custom-radio mb-3">
					<input type="radio" class="custom-control-input" id="gender2" name="gender" value="F" required>
					<label class="custom-control-label" for="gender2">Female</label>
				</div>
			</div>
			
			<div class="form-group">
				<label>Date Of Birth</label>
				<div class="custom-control">
                <input type="date" name="DateOfBirth">
				</div>
            </div>
			
			<div class="form-group">
            <label class="control-label">Nationality</label>
			<select class="form-control" name="Nationality">
                <option value="Afghan">Afghan</option>
                <option value="Albanian">Albanian</option>
                <option value="Algerian">Algerian</option>
                <option value="American">American</option>
                <option value="Andorran">Andorran</option>
                <option value="Angolan">Angolan</option>
                <option value="Antiguans">Antiguans</option>
                <option value="Argentinean">Argentinean</option>
                <option value="Armenian">Armenian</option>
                <option value="Australian">Australian</option>
                <option value="Austrian">Austrian</option>
                <option value="Azerbaijani">Azerbaijani</option>
                <option value="Bahamian">Bahamian</option>
                <option value="Bahraini">Bahraini</option>
                <option value="Bangladeshi">Bangladeshi</option>
                <option value="Barbadian">Barbadian</option>
                <option value="Barbudans">Barbudans</option>
                <option value="Batswana">Batswana</option>
                <option value="Belarusian">Belarusian</option>
                <option value="Belgian">Belgian</option>
                <option value="Belizean">Belizean</option>
                <option value="Beninese">Beninese</option>
                <option value="Bhutanese">Bhutanese</option>
                <option value="Bolivian">Bolivian</option>
                <option value="Bosnian">Bosnian</option>
                <option value="Brazilian">Brazilian</option>
                <option value="British">British</option>
                <option value="Bruneian">Bruneian</option>
                <option value="Bulgarian">Bulgarian</option>
                <option value="Burkinabe">Burkinabe</option>
                <option value="Burmese">Burmese</option>
                <option value="Burundian">Burundian</option>
                <option value="Cambodian">Cambodian</option>
                <option value="Cameroonian">Cameroonian</option>
                <option value="Canadian">Canadian</option>
                <option value="Cape verdean">Cape Verdean</option>
                <option value="Central african">Central African</option>
                <option value="Chadian">Chadian</option>
                <option value="Chilean">Chilean</option>
                <option value="Chinese">Chinese</option>
                <option value="Colombian">Colombian</option>
                <option value="Comoran">Comoran</option>
                <option value="Congolese">Congolese</option>
                <option value="Costa rican">Costa Rican</option>
                <option value="Croatian">Croatian</option>
                <option value="Cuban">Cuban</option>
                <option value="Cypriot">Cypriot</option>
                <option value="Czech">Czech</option>
                <option value="Danish">Danish</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominican">Dominican</option>
                <option value="Dutch">Dutch</option>
                <option value="East timorese">East Timorese</option>
                <option value="Ecuadorean">Ecuadorean</option>
                <option value="Egyptian">Egyptian</option>
                <option value="Emirian">Emirian</option>
                <option value="Equatorial guinean">Equatorial Guinean</option>
                <option value="Eritrean">Eritrean</option>
                <option value="Estonian">Estonian</option>
                <option value="Ethiopian">Ethiopian</option>
                <option value="Fijian">Fijian</option>
                <option value="Filipino">Filipino</option>
                <option value="Finnish">Finnish</option>
                <option value="French">French</option>
                <option value="Gabonese">Gabonese</option>
                <option value="Gambian">Gambian</option>
                <option value="Georgian">Georgian</option>
                <option value="German">German</option>
                <option value="Ghanaian">Ghanaian</option>
                <option value="Greek">Greek</option>
                <option value="Grenadian">Grenadian</option>
                <option value="Guatemalan">Guatemalan</option>
                <option value="Guinea-bissauan">Guinea-Bissauan</option>
                <option value="Guinean">Guinean</option>
                <option value="Guyanese">Guyanese</option>
                <option value="Haitian">Haitian</option>
                <option value="Herzegovinian">Herzegovinian</option>
                <option value="Honduran">Honduran</option>
                <option value="Hungarian">Hungarian</option>
                <option value="Icelander">Icelander</option>
                <option value="Indian">Indian</option>
                <option value="Indonesian">Indonesian</option>
                <option value="Iranian">Iranian</option>
                <option value="Iraqi">Iraqi</option>
                <option value="Irish">Irish</option>
                <option value="Israeli">Israeli</option>
                <option value="Italian">Italian</option>
                <option value="Ivorian">Ivorian</option>
                <option value="Jamaican">Jamaican</option>
                <option value="Japanese">Japanese</option>
                <option value="Jordanian">Jordanian</option>
                <option value="Kazakhstani">Kazakhstani</option>
                <option value="Kenyan">Kenyan</option>
                <option value="Kittian and nevisian">Kittian and Nevisian</option>
                <option value="Kuwaiti">Kuwaiti</option>
                <option value="Kyrgyz">Kyrgyz</option>
                <option value="Laotian">Laotian</option>
                <option value="Latvian">Latvian</option>
                <option value="Lebanese">Lebanese</option>
                <option value="Liberian">Liberian</option>
                <option value="Libyan">Libyan</option>
                <option value="Liechtensteiner">Liechtensteiner</option>
                <option value="Lithuanian">Lithuanian</option>
                <option value="Luxembourger">Luxembourger</option>
                <option value="Macedonian">Macedonian</option>
                <option value="Malagasy">Malagasy</option>
                <option value="Malawian">Malawian</option>
                <option value="Malaysian">Malaysian</option>
                <option value="Maldivan">Maldivan</option>
                <option value="Malian">Malian</option>
                <option value="Maltese">Maltese</option>
                <option value="Marshallese">Marshallese</option>
                <option value="Mauritanian">Mauritanian</option>
                <option value="Mauritian">Mauritian</option>
                <option value="Mexican">Mexican</option>
                <option value="Micronesian">Micronesian</option>
                <option value="Moldovan">Moldovan</option>
                <option value="Monacan">Monacan</option>
                <option value="Mongolian">Mongolian</option>
                <option value="Moroccan">Moroccan</option>
                <option value="Mosotho">Mosotho</option>
                <option value="Motswana">Motswana</option>
                <option value="Mozambican">Mozambican</option>
                <option value="Namibian">Namibian</option>
                <option value="Nauruan">Nauruan</option>
                <option value="Nepalese">Nepalese</option>
                <option value="New zealander">New Zealander</option>
                <option value="Ni-vanuatu">Ni-Vanuatu</option>
                <option value="Nicaraguan">Nicaraguan</option>
                <option value="Nigerien">Nigerien</option>
                <option value="North korean">North Korean</option>
                <option value="Northern irish">Northern Irish</option>
                <option value="Norwegian">Norwegian</option>
                <option value="Omani">Omani</option>
                <option value="Pakistani">Pakistani</option>
                <option value="Palauan">Palauan</option>
                <option value="Panamanian">Panamanian</option>
                <option value="Papua new guinean">Papua New Guinean</option>
                <option value="Paraguayan">Paraguayan</option>
                <option value="Peruvian">Peruvian</option>
                <option value="Polish">Polish</option>
                <option value="Portuguese">Portuguese</option>
                <option value="Qatari">Qatari</option>
                <option value="Romanian">Romanian</option>
                <option value="Russian">Russian</option>
                <option value="Rwandan">Rwandan</option>
                <option value="Saint lucian">Saint Lucian</option>
                <option value="Salvadoran">Salvadoran</option>
                <option value="Samoan">Samoan</option>
                <option value="San marinese">San Marinese</option>
                <option value="Sao tomean">Sao Tomean</option>
                <option value="Saudi">Saudi</option>
                <option value="Scottish">Scottish</option>
                <option value="Senegalese">Senegalese</option>
                <option value="Serbian">Serbian</option>
                <option value="Seychellois">Seychellois</option>
                <option value="Sierra leonean">Sierra Leonean</option>
                <option value="Singaporean">Singaporean</option>
                <option value="Slovakian">Slovakian</option>
                <option value="Slovenian">Slovenian</option>
                <option value="Solomon islander">Solomon Islander</option>
                <option value="Somali">Somali</option>
                <option value="South african">South African</option>
                <option value="South korean">South Korean</option>
                <option value="Spanish">Spanish</option>
                <option value="Sri lankan">Sri Lankan</option>
                <option value="Sudanese">Sudanese</option>
                <option value="Surinamer">Surinamer</option>
                <option value="Swazi">Swazi</option>
                <option value="Swedish">Swedish</option>
                <option value="Swiss">Swiss</option>
                <option value="Syrian">Syrian</option>
                <option value="Taiwanese">Taiwanese</option>
                <option value="Ttajik">Tajik</option>
                <option value="Tanzanian">Tanzanian</option>
                <option value="Thai">Thai</option>
                <option value="Togolese">Togolese</option>
                <option value="Tongan">Tongan</option>
                <option value="Trinidadian or Tobagonian">Trinidadian or Tobagonian</option>
                <option value="Tunisian">Tunisian</option>
                <option value="Turkish">Turkish</option>
                <option value="Tuvaluan">Tuvaluan</option>
                <option value="Ugandan">Ugandan</option>
                <option value="Ukrainian">Ukrainian</option>
                <option value="Uruguayan">Uruguayan</option>
                <option value="Uzbekistani">Uzbekistani</option>
                <option value="Venezuelan">Venezuelan</option>
                <option value="Vietnamese">Vietnamese</option>
                <option value="Welsh">Welsh</option>
                <option value="Yemenite">Yemenite</option>
                <option value="Zambian">Zambian</option>
                <option value="Zimbabwean">Zimbabwean</option>
              </select>
          </div>
			
			<div class="form-group">
				<label for="contactNo">Contact No.</label>
				<input type="text" class="form-control" id="contactNo" placeholder="Contact No." name="contact_NO">
			</div>
			
			<div class="form-group">
				<label for="passport_no ">Passport No. </label>
				<input type="text " class="form-control" id="passport_no " placeholder="Passport No." name="passport_no">
			</div>
			
			<div class="checkbox">
			<label>
				<input type="checkbox" required> Confirm
			</label>
			</div>
			<button type="submit" class="btn btn-success" style="margin-bottom: 20px;">Submit</button>
		</form>
		<!-- form -->
      </div>
  </div>
</div>

<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>
</body>
</html>