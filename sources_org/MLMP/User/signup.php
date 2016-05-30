<?php
if(!isset($_SESSION)){
    session_start();
}
include_once("z_db.php");
//session_start();



$sql="SELECT maintain FROM  settings WHERE sno=0";
		  if ($result = mysqli_query($con, $sql)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        $main= $row[0];
    }
	if($main==2 || $main==3)
	{
	print "
				<script language='javascript'>
					window.location = 'maintain.php';
				</script>
			";
	}

}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['todo']))
{
// Collect the data from post method of form submission // 
$todo=mysqli_real_escape_string($con,$_POST['todo']);
$name=mysqli_real_escape_string($con,$_POST['fname']);
$username=mysqli_real_escape_string($con,$_POST['username']);
$userid=mysqli_real_escape_string($con,$_POST['username']);
$password=mysqli_real_escape_string($con,$_POST['password']);
$password2=mysqli_real_escape_string($con,$_POST['password2']);

$email=mysqli_real_escape_string($con,$_POST['email']);

$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
$ref=mysqli_real_escape_string($con,$_POST['referral']);
$address=mysqli_real_escape_string($con,$_POST['address']);
$country=mysqli_real_escape_string($con,$_POST['country']);
$package=mysqli_real_escape_string($con,$_POST['package']);

$status = "OK";
$msg="";
//validation starts
// if userid is less than 6 char then status is not ok
if(!isset($username) or strlen($username) <6){
$msg=$msg."User Id Should Contain Minimum 6 CHARACTERS.<BR>";
$status= "NOTOK";}					

if(!ctype_alnum($username)){
$msg=$msg."User Id Should Contain Alphanumeric Chars Only.<BR>";
$status= "NOTOK";}					


$rr=mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE username = '$username'");
$r = mysqli_fetch_row($rr);
$nr = $r[0];
if($nr==1){
$msg=$msg."Userid Already Exists. Please Try Another One.<BR>";
$status= "NOTOK";
}	

$rrr=mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE mobile = '$mobile'");
$r3 = mysqli_fetch_row($rrr);
$nr3 = $r3[0];
if($nr3==1){
$msg=$msg."Mobile Number Already Registered.<BR>";
$status= "NOTOK";
}	

$remail=mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE email = '$email'");
$re = mysqli_fetch_row($remail);
$nremail = $re[0];
if($nremail==1){
$msg=$msg."E-Mail Id Already Registered.<BR>";
$status= "NOTOK";
}				

$result = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where username = '$ref'");
$row = mysqli_fetch_row($result);
$numrows = $row[0];
if ($numrows==0)
{
$msg=$msg."Sponsor/Referral Username Not Found..<BR>";
$status= "NOTOK";
}

if ( $package=="" ){
$msg=$msg."Please Select The Package.<BR>";
$status= "NOTOK";}	


if ( strlen($password) < 8 ){
$msg=$msg."Password Must Be More Than 8 Char Length.<BR>";
$status= "NOTOK";}	

if ( strlen($address) < 1 ){
$msg=$msg."Not Available<BR>";
}

if ( strlen($mobile) > 15 ){
$msg=$msg."Please Enter Correct Mobile Number<BR>";
}

if ( strlen($email) < 1 ){
$msg=$msg."Please Enter Your Email Id.<BR>";
$status= "NOTOK";}
			
if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
$msg=$msg."Email Id Not Valid, Please Enter The Correct Email Id .<BR>";
$status= "NOTOK";}

if ( $password <> $password2 ){
$msg=$msg."Both Passwords Are Not Matching.<BR>";
$status= "NOTOK";}		


if ( $country == "" ){
$msg=$msg."Please Enter Your Country Name.<BR>";
$status= "NOTOK";}	

//Test if it is a shared client
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  $ip=$_SERVER['HTTP_CLIENT_IP'];
//Is it a proxy address
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
  $ip=$_SERVER['REMOTE_ADDR'];
}
//The value of $ip at this point would look something like: "192.0.34.166"
$ip = ip2long($ip);
//The $ip would now look something like: 1073732954

$sqlquery="SELECT wlink FROM settings where sno=0"; //fetching website from databse
$rec2=mysqli_query($con,$sqlquery);
$row2 = mysqli_fetch_row($rec2);
$wlink=$row2[0]; //assigning website address

$sqlquery111="SELECT etext FROM emailtext where code='SIGNUP'"; //fetching website from databse
$rec2111=mysqli_query($con,$sqlquery111);
$row2111 = mysqli_fetch_row($rec2111);
$emailtext=$row2111[0]; //assigning email text for email

if(!($package==""))
{
$sqlquery11="SELECT validity FROM packages where id = $package"; //fetching no of days validity from package table from databse
$rec211=mysqli_query($con,$sqlquery11);
$row211 = mysqli_fetch_row($rec211);
$noofdays=$row211[0]; //assigning website address
$cur=date("Y-m-d");
$expiry=date('Y-m-d', strtotime($cur. '+ '.$noofdays.'days'));
$sbonus=0;
}


if ($status=="OK") 
{
$scode=rand(1111111111,9999999999); //generating random code, this will act as signup key
$query=mysqli_query($con,"insert into affiliateuser(username,password,fname,address,email,referedby,ipaddress,mobile,doj,country,signupcode,tamount,pcktaken,expiry) values('$username','$password','$name','$address','$email','$ref','$ip','$mobile','$cur','$country','$scode','$sbonus','$package','$expiry')");
$_SESSION['paypalidsession'] = $userid;
// More headers
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <no-reply@'.$wlink.'>' . "\r\n";
$to=$email;
$subject="Order Confirmation";
$message=$emailtext;
mail($to,$subject,$message,$headers);
print "
				<script language='javascript'>
					window.location = 'thankyou.php?username=$username';
				</script>
			"; 

}



else
{ 
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>".$msg."</div>"; //printing error if found in validation
					
}

}
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<style type="text/css">html {
    overflow-y: scroll;
background: url(images/login2.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

</style>
<meta charset="utf-8" />
<title>Registration</title>
<meta name="google-translate-customization" content="c3c91eff8b5a0ded-878e61fea3a9f875-g9379dbb792475ecb-13"></meta>
<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" href="css/app.v1.css" type="text/css" />
<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->
<div id="google_translate_element" align="right"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
</head>
<body style="overflow: scroll;">
<section id="content" >
  <div class="container aside-xl"> <a class="navbar-brand block" href="#">Great Decision... ;)</a>
  <div class="row">
                <div class="col-sm-18">
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post" data-validate="parsley">
                    <section class="panel panel-default">
                      <header class="panel-heading">
                        <span class="h4">Register</span>
                      </header>
                      <div class="panel-body">
					  
                        <p class="text-muted">Please fill the information to continue</p>
						<?php 
						if($_SERVER['REQUEST_METHOD'] == 'POST' && ($status=="NOTOK"))
						{
						print $errormsg;
						}
						?>
						<input type="hidden" name="todo" value="post">
						<div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                          <label>Username</label>
                          <input type="text" class="form-control" data-required="true" name="username" value="" required>                        
                        </div>
                        <div class="col-sm-6">
                          <label>Full Name</label>
                         <input type="text" class="form-control" data-required="true" name="fname" required>                          
                        </div>
						</div>
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Enter password</label>
                            <input type="password" class="form-control" data-required="true" id="pwd" name="password" required>   
                          </div>
                          <div class="col-sm-6">
                            <label>Confirm password</label>
                            <input type="password" class="form-control" data-equalto="#pwd" data-required="true" name="password2" required>      
                          </div>   
                        </div>
						<div class="form-group pull-in clearfix">
						<div class="col-sm-6">
                          <label>Email</label>
                          <input type="email" class="form-control" data-type="email" data-required="true" name="email" required>                        
                        </div>
						<div class="col-sm-6">
                          <label>Phone</label>
                          <input type="text" class="form-control" data-type="phone" placeholder="(XXX) XXXX XXX" data-required="true" name="mobile" required>
                        </div>
						</div>
						
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" class="form-control" data-required="true" name="address">
                        </div>
						
						<div class="form-group">
						<label>Country</label>
                            <select data-required="true" class="form-control m-t" name="country" required>
                                <option value="">Please choose</option>
                                
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
                            </select>
                          </div>
						  <div class="form-group">
						<label>Package</label>
                            <select data-required="true" class="form-control m-t" name="package" required>
                                <option value="">Please choose</option>
								<?php $query="SELECT id,name,price,currency,tax FROM  packages"; 
 
 
 $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
	$id="$row[id]";
	$pname="$row[name]";
	$pprice="$row[price]";
	$pcur="$row[currency]";
	$ptax="$row[tax]";
$total=$pprice+$ptax;
  print "<option value='$id'>$pname | Price - $pcur $total </option>";
  
  }
  ?>
								</select>
                          </div>


<?php 
			if(isset($_GET["aff"])){
			$aff=mysqli_real_escape_string($con,$_GET["aff"]);
			$_SESSION['aff'] = $aff;
			
			

	}		
			
			?>
			<div class="form-group">
                          <label>Sponsor/Referral Username</label>
                          <input type="text" class="form-control" data-required="true" name="referral" value="<?php if (isset($_SESSION['aff'])){
			echo $_SESSION['aff']; } ?>" required>                        
                        </div>


								
                        <div class="checkbox i-checks">
                          <label>
                            <input type="checkbox" name="check" data-required="true" required><i></i> I agree to the <a href="#" class="text-info">Terms of Service</a>
                          </label>
                        </div>
                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Register</button>
                      </footer>
                    </section>
					<div class="line line-dashed"></div>
          <p class="text-muted text-center"><small style="color:#ffffff;">Already have an account?</small></p>
          <a href="index.php" class="btn btn-lg btn-default btn-block">Sign in</a>
                  </form>
                </div>
                
              </div>
     </div>
</section>
<!-- footer -->
<footer id="footer">
  <div class="text-center padder clearfix">
    <p> <small style="color:#ffffff;"><?php $query="SELECT footer from settings where sno=0"; 
 
 
 $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
	$footer="$row[footer]";
	print $footer;
	}
  ?>
 </small> </p>
  </div>
</footer>
<!-- / footer -->
<!-- Bootstrap -->
<!-- App -->
<script src="js/app.v1.js"></script>
<script src="js/app.plugin.js"></script>
</body>
</html>