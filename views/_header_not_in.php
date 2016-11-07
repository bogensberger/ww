<!DOCTYPE html>
<html lang="de">
  <head>  
    <meta charset="UTF-8">
    <title><?=$title?> | Scholarium</title>

    
<?php
    if ($type == 'blog'){
      ?>

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@scholarium_at">
    <meta name="author" content="scholarium">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?=$title?>">
    <meta property="og:image" content="http://www.scholarium.at/style/gfx/cover.jpg">
    <meta property="og:description" content="<?=$description_fb?>">
    <meta property="og:site_name" content="Scholarium">
    <meta property="og:locale" content="de_DE">
    <meta property="article:publisher" content="https://www.facebook.com/scholarium.at">
    <? }
?>

      <link rel="shortcut icon" href="/favicon.ico">
      <link rel="stylesheet" type="text/css" href="../style/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../tools/bootstrap.js"></script>
    <!-- this is used for this fancy login form -->
    <!--<script src="../tools/custom.js"></script>-->
    
	<script langugae="javascript" src="/js/general.js"></script>    
 
    <!-- Google Analytics Code -->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-39285642-1']);
        _gaq.push(['_trackPageview']);
        (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    
    <!-- Social Links PopUp -->
    <script type="text/javascript">
      function openpopup (url) {
        popup = window.open(url, "popup1", "width=640,height=480,status=yes,scrollbars=yes,resizable=yes");
        popup.focus();
      }
    </script>
  </head>
    
<?php
//set timezone
mysql_query("SET time_zone = 'Europe/Vienna'");
?>

<?php

if( isset($_POST['ok2']) ) $ok2 = $_POST['ok2'];

?>  
  
  <body>
        <header class="header">
          <div class="login">

                  <?php
                  // show potential errors / feedback (from login object)
              if (isset($login)) {
                  if ($login->errors) {
                      foreach ($login->errors as $error) {
                          #add some html to make it look nicer
                          
                        ?><p class='error'> <?php echo $error; ?> </p> <?php
                      }
                  }
                  if ($login->messages) {
                      foreach ($login->messages as $message) {
                          #echo $message;
                          ?><p class='message'> <?php echo $message; ?> </p> <?php
                      }
                  }
              }
              // show potential errors / feedback (from registration object)
              if (isset($registration)) {
                  if ($registration->errors) {
                      foreach ($registration->errors as $error) {
                          #echo $error;
                      ?><p class='error'> <?php echo $error; ?> </p> <?php
                      }
                  }
                  if ($registration->messages) {
                      foreach ($registration->messages as $message) {
                          #echo $message;
                          ?><p class='message'> <?php echo $message; ?> </p> <?php
                      }
                  }
              }
              ?>

                  <div class="anmelden"><a href="../en/">English</a></div>
                  <!--div class="anmelden2"><a href="../spende/">Unterst&uuml;tzen</a></div--> 
                  <div class="anmelden"><button class="login_button" type="button" data-toggle="modal" data-target="#login" value="Anmelden">Anmelden</button></div>
                  <div class="anmelden"><button class="login_button" type="button" data-toggle="modal" data-target="#signup" value="Anmelden">Eintragen</button></div>
                  

            </div>
            <div class="logo">
                <a href="/"><img class="logo_img" src="../style/gfx/scholarium_logo_w.png" alt="scholarium" name="Home"></a>
                  
<!-- Login (Anmelden) Modal -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-login">
      <div class="modal-content-login">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-header">

          <h2 class="modal-title" id="myModalLabel">Anmelden</h2>
          <p class="tologin">Sie haben noch keinen Zugang? <br><a data-toggle="modal" data-target="#signup" data-dismiss="modal" aria-label="Close" value="Anmelden">Dann können Sie sich hier eintragen.</a></p>
        </div>
        <div class="modal-body">
          <p>
            <form method="post" action="" name="registerform">
              <input class="inputfield_login" id="user_email_login" type="email" placeholder=" E-Mail-Adresse" name="user_email" autocomplete="on" autofocus required><br>     
              <input class="inputfield_login" id="user_password" type="password" name="user_password" placeholder=" Passwort" required><br>
              <input class="inputbutton_login" id="inputbutton" name="anmelden_submit" type="submit" value="Anmelden">
            </form>     
            <p class="password_login"><a href="/password_reset.php">Passwort vergessen?</a></p>   
          </p>
        </div>
      </div>
    </div>
  </div>
<!-- Sign Up (Eintragen) Modal -->  
  <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-login">
      <div class="modal-content-login">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-header">

          <h2 class="modal-title" id="myModalLabel">Eintragen</h2>
          <p class="tologin">Sie sind bereits eingetragen? <br><a data-toggle="modal" data-target="#login" data-dismiss="modal" aria-label="Close" value="Anmelden">Dann melden Sie sich hier mit ihrer E-Mail-Adresse an.</a></p>
        </div>
        <div class="modal-body">
          <p>
            <form method="post" action="" name="registerform">
                <input class="inputfield_login" id="user_email_signup" type="email" placeholder=" E-Mail-Adresse" name="user_email" required><br>
                <input type="hidden" name="first_reg" value="header">
                <input class="inputbutton_login" id="inputbutton" name="eintragen_submit" type="submit" value="Kostenlos eintragen">
            </form>         
          </p>
        </div>
      </div>
    </div>
  </div>            
          </div>
            <div class="nav">
                <div class="navi">
                  <ul id="nav">
                  		<li id="navelm"><a class="navelm" href="/fragen.php">H&auml;ufige Fragen</a></li>
             			<li id="navelm"><a class="navelm" href="/scholien/">Scholien</a></li>
                    	<!--<li id="navelm"><a class="navelm" href="/salon/">Salon</a></li>-->
                    	<li id="navelm"><a class="navelm" id="drop1" data-toggle="dropdown" href="/veranstaltungen/" data-target="#" role="button" aria-haspopup="true" aria-expanded="false">Veranstaltungen</a>
                    	<div class="subnav dropdown-menu" aria-labelledby="drop1">
                    	<ul>
                    		<li class="subnav_head"><a class="subnav_head" href="/veranstaltungen/">Veranstaltungen</a></li>
                    		<li><a href="/veranstaltungen/">Alle</a></li>
                    		<li><a href="/salon/">Salon</a></li>
                    		<li><a href="/seminare/">Seminare</a></li>
                    	</ul>
                    	</div>
                    </li>
                    	<li id="navelm"><a class="navelm" href="/jubilaeum/">Jubil&auml;um</a></li>
    					<li id="navelm"><a class="navelm" href="/studium/">Studium</a></li>
              <li id="navelm"><a class="navelm" id="drop1" data-toggle="dropdown" href="../spende/" data-target="#" role="button" aria-haspopup="true" aria-expanded="false">Unterst&uuml;tzen</a>
                <div class="subnav dropdown-menu" aria-labelledby="drop1">
                  <ul>
                    <li class="subnav_head"><a class="subnav_head" href="../spende/">Unterst&uuml;tzen</a></li>
                    <li><a href="/spende/">Spenden</a></li>
                    <li><a href="/projekte/">Projekte</a></li>
                  </ul>
                </div>
              </li>
                 </ul>
                </div>
           </div>
        </header>
