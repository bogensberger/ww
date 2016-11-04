<?php
header('refresh:3;url=index.php');
// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
// include the config
require_once('config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/de.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the login class
require_once('classes/General.php');
require_once('classes/Login.php');
require_once('classes/Registration.php');
require_once('classes/Email.php');

$general = new General();

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
//TODO Login and Email don't work together because of header send issues. It might be better to generate the email object wihtin he other functions to avoid this
$email = new Email();
$registration = new Registration();
$title="Logout";

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    include("views/index_in.php");

} 

else {
    // the user is not logged in. you can do whatever you want here.
    
include("views/_header_not_in.php");
    
?>

<!--Content-->
<div class="content">
        <div class="salon_content">
            <div class='centered'>
            <h3>Logout erfolgreich</h3>
            <p class="centered">Sie werden automatisch weitergeleitet.</p>

            <p class='centered'><a href='index.php'>&raquo; zur Startseite</a></p>
        
            </div>
        </div>
</div>
<? include "views/_footer.php"; 

}
?>
