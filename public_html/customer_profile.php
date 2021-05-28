<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		header('location:index.php');
	}
	
	if($_SESSION['user'] == "customer") {
		$id = $_SESSION['id'];
		require('conn.php');
		$sql = "SELECT * FROM user WHERE user_account = '$id';";
		$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
		$rc = mysqli_fetch_assoc($rs);
		mysqli_free_result($rs);
		mysqli_close($conn);
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

<?php
	$id = $_SESSION['id'];
	require('conn.php');
	$sql = "SELECT * FROM user WHERE user_account = '$id';";
	$rs = mysqli_query($conn, $sql);
	$rc = mysqli_fetch_assoc($rs);
	
	if($rc['Gender'] == "M") {
		$male = "checked";
		$female = "";
	}
	else {
		$female = "checked";
		$male ="";
	}
?>
<div class="container mt-4">
  <div class="row well trbox shadow">
    <div class="col-md-12" style="margin: 20px 0;"> <img src="src/image/myprofile.jpg" alt="My Profile"/> </div>
    <ul class="nav nav-tabs">
      <li style="margin-left: 20px;" <?php if(!isset($_GET['password'])) echo 'class="nav-item active"'; ?>><a class="nav-link" data-toggle="tab" href="#myProfile">View Profile</a></li>
      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#editProfile">Edit Profile</a></li>
      <li <?php if(isset($_GET['password'])) echo 'class="nav-item active"'; ?>><a class="nav-link" data-toggle="tab" href="#changePassword">Change Password</a></li>
    </ul>
    <div class="tab-content" style="width: 100%;"> <!-- The whole tab -->
      <div id="myProfile" class="tab-pane fade <?php if(!isset($_GET['password'])) echo "active"; ?>"> <!-- View Profile panel -->
        <div class="col-md-12" style="margin-top: 20px;">
          <form class="form-horizontal d-flex">
            <!-- View Profile form -->
            <div class="col-md-offset-2 col-md-6"> <!-- account information -->
              <div class="col-md-12" style="display: flex; justify-content: center;"><img src="src/image/user.png" alt="" width="200" height="200"/></div>
              <div class="col-md-offset-1 col-md-12" style="display: flex; justify-content: center; margin-top:20px; margin-bottom:20px"><u>Account Information</u></div>
              <!-- ID -->
              <div class="form-group d-flex">
                <label class="col-md-6 control-label" style="display: flex; justify-content: center;"><b>ID</b></label>
                <div class="col-md-6">
                  <p class="form-control-static" style="display: flex; justify-content: center;"><?php echo $rc['user_account']; ?></p>
                </div>
              </div>
              <!-- END ID --> 
            </div>
            <!-- END account information -->
            <div class="col-md-6">
            <div class="form-group d-flex"> <!-- Surname -->
              <label class="col-md-3 control-label"><b>Last Name</b></label>
              <div class="col-md-9">
                <p class="form-control-static"><?php echo $rc['lastname']; ?></p>
              </div>
            </div>
            <!-- END Surname -->
            <div class="form-group d-flex"> <!-- Given Name -->
              <label class="col-md-3 control-label"><b>First Name</b></label>
              <div class="col-md-9">
                <p class="form-control-static"><?php echo $rc['firstname']; ?></p>
              </div>
            </div>
            <!-- END Given Name -->
            <div class="form-group d-flex"> <!-- Date of Birth -->
              <label class="col-md-3 control-label"><b>Date of Birth</b></label>
              <div class="col-md-9">
                <p class="form-control-static"><?php echo $rc['DateOfBirth']; ?></p>
              </div>
            </div>
            <!-- END Date of Birth -->
            <div class="form-group d-flex"> <!-- Gender -->
              <label class="col-md-3 control-label"><b>Gender</b></label>
              <div class="col-md-9">
                <p class="form-control-static"><?php echo $rc['Gender']; ?></p>
              </div>
            </div>
            <!-- END Gender -->
            <div class="form-group d-flex"> <!-- Passport -->
              <label class="col-md-3 control-label"><b>Passport</b></label>
              <div class="col-md-9">
                <p class="form-control-static"><?php echo $rc['passport_no']; ?></p>
              </div>
            </div>
            <!-- END Passport -->
            <div class="form-group d-flex"> <!-- Mobile No. -->
              <label class="col-md-3 control-label"><b>Mobile No.</b></label>
              <div class="col-md-9">
                <p class="form-control-static"><?php echo $rc['contact_no']; ?></p>
              </div>
            </div>
            <!-- END Mobile No. -->
            <div class="form-group d-flex"> <!-- Nationality -->
              <label class="col-md-3 control-label"><b>Nationality</b></label>
              <div class="col-md-9">
                <p class="form-control-static"><?php echo $rc['Nationality']; ?></p>
              </div>
            </div>
            <!-- END Nationality -->
          </form>
          <!-- END View Profile form --> 
        </div>
      </div>
    </div>
    <!-- END View Profile panel --> 
    
    <!-- Edit Profile panel -->
    <div id="editProfile" class="tab-pane fade">
      <div class="offset-md-3 col-md-6" style="margin-top: 20px;"> 
        <!-- Edit Profile form -->
        <form class="form-horizontal" action="customer_update_profile.php" method="post">
            <input type="hidden" class="form-control" name="user_account" value="<?php echo $rc['user_account']; ?>" readonly>
          <!-- END ID -->
          <div class="form-group d-flex"> <!-- Surname -->
            <label class="col-md-3 control-label">Last Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="lastname" pattern="[A-Za-z ]{1,15}" required value="<?php echo $rc['lastname']; ?>">
            </div>
          </div>
          <!-- END Surname -->
          <div class="form-group d-flex"> <!-- Given Name -->
            <label class="col-md-3 control-label">First Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="firstname" pattern="[A-Za-z ]{1,30}" required value="<?php echo $rc['firstname']; ?>">
            </div>
          </div>
          <!-- END Given Name -->
          <div class="form-group d-flex"> <!-- Date of Birth -->
            <label class="col-md-3 control-label">Date of Birth</label>
            <div class="col-md-9">
              <input type="date" class="form-control" name="DateOfBirth" required value="<?php echo $rc['DateOfBirth']; ?>">
            </div>
          </div>
          <!-- END Date of Birth -->
          <div class="form-group d-flex"> <!-- Gender -->
            <label class="col-md-3 control-label">Gender</label>
            <div class="col-md-9">
              <label class="radio-inline">
                <input type="radio" name="Gender" value="M" <?php echo $male; ?>>
                M </label>
              <label class="radio-inline">
                <input type="radio" name="Gender" value="F" <?php echo $female; ?>>
                F </label>
            </div>
          </div>
          <!-- END Gender -->
          <div class="form-group d-flex"> <!-- Passport -->
            <label class="col-md-3 control-label">Passport</label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="passport_no" pattern="[A-Z0-9]{1,15}" required value="<?php echo $rc['passport_no']; ?>">
            </div>
          </div>
          <!-- END Passport -->
          <div class="form-group d-flex"> <!-- Mobile No. -->
            <label class="col-md-3 control-label">Mobile No.</label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="contact_no" pattern="[0-9]{1,15}" required value="<?php echo $rc['contact_no']; ?>">
            </div>
          </div>
          <!-- END Mobile No. -->
          <div class="form-group d-flex">
            <label class="col-md-3 control-label">Nationality</label>
            <div class="col-md-9">
              <select class="form-control" name="Nationality">
                <option value="<?php echo $rc['Nationality']; ?>"><?php echo $rc['Nationality']; ?></option>
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
          </div>
          <div class="form-group">
            <div class="offset-md-5">
              <button type="submit" class="btn btn-info">Edit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </div>
        </form>
        <!-- END Edit Profile form --> 
      </div>
    </div>
    <!-- END Edit Profile panel --> 
    
    <!-- Change password panel -->
    <div id="changePassword" class="tab-pane fade <?php if(isset($_GET['password'])) echo "in active"; ?>">
      <div class="row">
        <div class="offset-md-3 col-md-9" style="margin-top: 20px;"> 
          <!-- Change password form -->
          <form class="form-horizontal" action="customer_change_password.php" method="post">
            <input type="hidden" name="user_account" value="<?php echo $rc['user_account']; ?>">
            <?php if(isset($_GET['password']) && $_GET['password'] == "old_pwd_not_match") {?>
            <div class="form-group d-flex has-error has-feedback">
              <label class="col-md-3 control-label">Old Password*</span></label>
              <div class="col-md-4">
                <input type="password" class="form-control" name="oldPassword" required>
                <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span> </div>
            </div>
            <?php } else { ?>
            <div class="form-group d-flex"> <!-- Password -->
              <label class="col-md-3 control-label">Old Password*</span></label>
              <div class="col-md-4">
                <input type="password" class="form-control" name="oldPassword" required>
              </div>
            </div>
            <?php } ?>
            <!-- END Current Password -->
            <?php if(isset($_GET['password']) && $_GET['password'] == "confirm_pwd_not_match") {?>
            <div class="form-group d-flex has-warning has-feedback">
              <label class="col-md-3 control-label">New Password*</label>
              <div class="col-md-4">
                <input type="password" class="form-control" name="newPassword" required>
                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span> </div>
            </div>
            <div class="form-group d-flex has-warning has-feedback">
              <label class="col-md-3 control-label">Confirm Password*</label>
              <div class="col-md-4">
                <input type="password" class="form-control" name="confirmPassword" required>
                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span> </div>
            </div>
            <?php } else {?>
            <div class="form-group d-flex"> <!-- New Password -->
              <label class="col-md-3 control-label">New Password*</label>
              <div class="col-md-4">
                <input type="password" class="form-control" name="newPassword" required>
              </div>
            </div>
            <!-- END New Password -->
            <div class="form-group d-flex"> <!-- Surname -->
              <label class="col-md-3 control-label">Confirm Password*</label>
              <div class="col-md-4">
                <input type="password" class="form-control" name="confirmPassword" required>
              </div>
            </div>
            <!-- END Surname -->
            <?php } ?>
            <div class="form-group d-flex">
              <div class="offset-md-3">
                <button type="submit" class="btn btn-info">Confirm</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </div>
          </form>
          <!-- END Edit Profile form --> 
        </div>
      </div>
      <?php if(isset($_GET['password']) && $_GET['password'] == "confirm_pwd_not_match") { ?>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="alert alert-warning shadow" role="alert"><strong>Warning!</strong> Your confirm password is not match.</div>
        </div>
      </div>
      <?php }else if(isset($_GET['password']) && $_GET['password'] == "old_pwd_not_match") {?>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="alert alert-danger shadow" role="alert"><strong>Warning!</strong> Your old password is incorrect.</div>
        </div>
      </div>
      <?php }else if(isset($_GET['password']) && $_GET['password'] == "change_successfully") {?>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="alert alert-success shadow" role="alert"><strong>DONE!</strong> You password is changed.</div>
        </div>
      </div>
      <?php }else if(isset($_GET['password']) && $_GET['password'] == "change_unsuccessfully") {?>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="alert alert-danger shadow" role="alert"><strong>OOPS!</strong> Please try submitting again.</div>
        </div>
      </div>
      <?php } ?>
    </div>
    <!-- END Edit Profile panel --> 
  </div>
  <!-- The whole tab --> 
</div>
</div>

<?php require_once('customer_bonus_modal.php') ?> <!-- the customer bonus modal -->

<?php require_once('logout_modal.php') ?> <!-- logout modal -->


<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>
</body>
</html>