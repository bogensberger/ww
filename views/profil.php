<?php 
// require_once('../classes/Login.php');
$title="Profil";
include('_header_in.php'); 

// echo $_SESSION['user_email'];

// $some = $login->getUserData($_SESSION['user_email']); 

//this is used for placeholders to show what is the current user info
$result_row = $general->getUserInfo($_SESSION['user_id']);

$vorname = trim($result_row->Vorname);
$nachname = trim($result_row->Nachname);
$land = trim($result_row->Land);
$ort = trim($result_row->Ort);
$strasse = trim($result_row->Strasse);
$plz = trim($result_row->PLZ);

//additions
$anrede = trim($result_row->Anrede);
$telefon = trim($result_row->Telefon);
$company = trim($result_row->Firma);

$ablauf = date_create_from_format('Y-m-d', $result_row->Ablauf);

/*
if ($result_row->gave_credits == 0) echo "Please fill in this form to get a free credit.";

if ( isset($result_row->Vorname) and trim($result_row->Vorname) and 
     isset($result_row->Nachname) and trim($result_row->Nachname) and
     isset($result_row->Land) and trim($result_row->Land) and
     isset($result_row->Ort) and trim($result_row->Ort) and
     isset($result_row->Strasse) and trim($result_row->Strasse) and
     ($result_row->gave_credits == 0)
     )
    {


    $login->messages[] = "You have just received a credit. Spend wisely!";

    $login->giveCredits();


    #page refresh after form was submitted
    #evaluate AJAX for such action in the future 
    echo '<meta http-equiv="refresh" content="0; url=http://www.scholarium.at/edit.php" />';


    }
*/
?> 
	<div class="content">
		<div class="profil">
			<h1>Profil</h1>
	<?php
	if (strtotime($result_row->Ablauf) < time()) {
	?>
			<p>Ihr Unterst&uuml;tzer-Zugang ist am <?echo date_format($ablauf, 'd.m.Y');?> abgelaufen.<br><br>
				(Nach einer neuen Spende, erhalten Sie wieder Zugang.)<br><br>
				<a href="../spende">&rarr; Unterst&uuml;tzung erneuern.</a>
			</p>
	<?php	
		}
		else {
	?>
			<p>Ihr Unterst&uuml;tzer-Zugang l&auml;uft noch bis zum <?echo date_format($ablauf, 'd.m.Y');?>.<br><br>
				(Verl&auml;ngerung um ein Jahr nach Spendeneingang.)<br><br>
				<a href="../spende">&rarr; Unterst&uuml;tzung erneuern.</a>
			</p>
	<?php
		}
	?>
		
		</div>
		<div class="medien_seperator">
			<h1>Ihre Daten &auml;ndern</h1>
		</div>
		<div class="profil">	
			<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="user_edit_profile_form">

        		<label for="user_email">E-Mail</label>
        		<input id="user_email" type="email" class="profil_inputfield" value="<?php echo $_SESSION['user_email']; ?>"  name="profile[user_email]" required><br>

                <label for="user_anrede">Anrede</label>
                <select id="user_anrede" name="profile[user_anrede]" required>
                	<option value="Herr" <?if ($anrede=='Herr'){echo "selected";}?>>Herr</option>
                	<option value="Frau" <?if ($anrede=='Frau'){echo "selected";}?>>Frau</option>
                </select><br>      	
        		<label for="user_first_name">Vorname</label>
        		<input id="user_first_name" type="text" class="profil_inputfield" value="<?php echo $vorname; ?>" name="profile[user_first_name]" required><br>
       			<label for="user_surname">Nachname</label>
        		<input id="user_surname" type="text" class="profil_inputfield" value="<?php echo $nachname; ?>" name="profile[user_surname]" required><br>

                <label for="user_telefon">Telefon</label>
                <input id="user_telefon" type="tel" class="profil_inputfield" value="<?php echo $telefon; ?>" name="profile[user_telefon]" ><br>
								<label for="user_company">(ggf. Firma)</label>
                <input id="user_company" type="text" class="profil_inputfield" value="<?php echo $company; ?>" name="profile[user_company]" ><br>

        		<label for="user_street">Stra&szlig;e</label>
        		<input id="user_street" type="text" class="profil_inputfield" value="<?php echo $strasse; ?>" name="profile[user_street]"><br>
        		<label for="user_plz">PLZ</label>
        		<input id="user_plz" type="text" class="profil_inputfield" value="<?php echo $plz; ?>" name="profile[user_plz]"><br>
        		<label for="user_city">Ort</label>
        		<input id="user_city" type="text" class="profil_inputfield" value="<?php echo $ort; ?>" name="profile[user_city]"><br>
        		<label for="user_country">Land</label>
    <!--    <input id="user_country" type="text" value="<?php echo $result_row->Land; ?>" name="profile[user_country]" required />-->

        		<select id="user_country" name="profile[user_country]">
        			<option value="<?php echo $result_row->Land; ?>"><?php if ($result_row->Land) echo $result_row->Land; ?></option>
        			<option value="&Ouml;sterreich">&Ouml;sterreich</option>
        			<option value="Deutschland">Deutschland</option>
        			<option value="Schweiz">Schweiz</option>
        			<option value="Liechtenstein">Liechtenstein</option>
        			<option value="divider" disabled>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</option>
        			<option value="Afghanistan">Afghanistan</option>
        			<option value="&Auml;gypten">&Auml;gypten</option>
        			<option value="Aland">Aland</option>
        			<option value="Albanien">Albanien</option>
        			<option value="Algerien">Algerien</option>
        			<option value="Amerikanisch-Samoa">Amerikanisch-Samoa</option>
        			<option value="Amerikanische Jungferninseln">Amerikanische Jungferninseln</option>
        			<option value="Andorra">Andorra</option>
					<option value="Angola">Angola</option>
					<option value="Anguilla">Anguilla</option>
					<option value="Antarktis">Antarktis</option>
					<option value="Antigua und Barbuda">Antigua und Barbuda</option> 					
                    <option value="&Auml;quatorialguinea">&Auml;quatorialguinea</option>
                    <option value="Argentinien">Argentinien</option>
                    <option value="Armenien">Armenien</option>                    
                    <option value="Aruba">Aruba</option>
                    <option value="Ascension">Ascension</option>
                    <option value="Aserbaidschan">Aserbaidschan</option>
                    <option value="&Auml;thiopien">&Auml;thiopien</option>
                    <option value="Australien">Australien</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesch">Bangladesch</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belgien">Belgien</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivien">Bolivien</option>
                    <option value="Bosnien und Herzegowina">Bosnien und Herzegowina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvetinsel">Bouvetinsel</option>
                    <option value="Brasilien">Brasilien</option>
                    <option value="Brunei">Brunei</option>
                    <option value="Bulgarien">Bulgarien</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Cookinseln">Cookinseln</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                    <option value="D&auml;nemark">D&auml;nemark</option>
                    <option value="Diego Garcia">Diego Garcia</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominikanische Republik">Dominikanische Republik</option>
                    <option value="Dschibuti">Dschibuti</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estland">Estland</option>
                    <option value="Europ&auml;ische Union">Europ&auml;ische Union</option>
                    <option value="Falklandinseln">Falklandinseln</option>
                    <option value="F&auml;r&ouml;er">F&auml;r&ouml;er</option>
                    <option value="Fidschi">Fidschi</option>
                    <option value="Finnland">Finnland</option>
                    <option value="Frankreich">Frankreich</option>
                    <option value="Franz&ouml;sisch-Guayana">Franz&ouml;sisch-Guayana</option>
                    <option value="Franz&ouml;sisch-Polynesien">Franz&ouml;sisch-Polynesien</option>
                    <option value="Gabun">Gabun</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgien">Georgien</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Griechenland">Griechenland</option>
                    <option value="Gr&ouml;nland">Gr&ouml;nland</option>
                    <option value="Gro&szlig;britannien">Gro&szlig;britannien</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernsey">Guernsey</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard und McDonaldinseln">Heard und McDonaldinseln</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hongkong">Hongkong</option>
                    <option value="Indien">Indien</option>
                    <option value="Indonesien">Indonesien</option>
                    <option value="Irak">Irak</option>
                    <option value="Iran">Iran</option>
                    <option value="Irland">Irland</option>
                    <option value="Island">Island</option>
                    <option value="Israel">Israel</option>
                    <option value="Italien">Italien</option>
                    <option value="Jamaika">Jamaika</option>
                    <option value="Japan">Japan</option>
                    <option value="Jemen">Jemen</option>
                    <option value="Jersey">Jersey</option>
                    <option value="Jordanien">Jordanien</option>
                    <option value="Kaimaninseln">Kaimaninseln</option>
                    <option value="Kambodscha">Kambodscha</option>
                    <option value="Kamerun">Kamerun</option>
                    <option value="Kanada">Kanada</option>
                    <option value="Kanarische Inseln">Kanarische Inseln</option>
                    <option value="Kap Verde">Kap Verde</option>
                    <option value="Kasachstan">Kasachstan</option>
                    <option value="Katar">Katar</option>
                    <option value="Kenia">Kenia</option>
                    <option value="Kirgisistan">Kirgisistan</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Kokosinseln">Kokosinseln</option>
                    <option value="Kolumbien">Kolumbien</option>
                    <option value="Komoren">Komoren</option>
                    <option value="Kongo">Kongo</option>
                    <option value="Kroatien">Kroatien</option>
                    <option value="Kuba">Kuba</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Laos">Laos</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Lettland">Lettland</option>
                    <option value="Libanon">Libanon</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libyen">Libyen</option>
                    <option value="Litauen">Litauen</option>
                    <option value="Luxemburg">Luxemburg</option>
                    <option value="Macao">Macao</option>
                    <option value="Madagaskar">Madagaskar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Malediven">Malediven</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marokko">Marokko</option>
                    <option value="Marshallinseln">Marshallinseln</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauretanien">Mauretanien</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mazedonien">Mazedonien</option>
                    <option value="Mexiko">Mexiko</option>
                    <option value="Mikronesien">Mikronesien</option>
                    <option value="Moldawien">Moldawien</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolei">Mongolei</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Mosambik">Mosambik</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Neukaledonien">Neukaledonien</option>
                    <option value="Neuseeland">Neuseeland</option>
                    <option value="Neutrale Zone">Neutrale Zone</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niederlande">Niederlande</option>
                    <option value="Niederl&auml;ndische Antillen">Niederl&auml;ndische Antillen</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Nordkorea">Nordkorea</option>
                    <option value="N&ouml;rdliche Marianen">N&ouml;rdliche Marianen</option>
                    <option value="Norfolkinsel">Norfolkinsel</option>
                    <option value="Norwegen">Norwegen</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Pal&auml;stina">Pal&auml;stina</option>
                    <option value="Palau">Palau</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua-Neuguinea">Papua-Neuguinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Philippinen">Philippinen</option>
                    <option value="Pitcairninseln">Pitcairninseln</option>
                    <option value="Polen">Polen</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Réunion">Réunion</option>
                    <option value="Ruanda">Ruanda</option>
                    <option value="Rum&auml;nien">Rum&auml;nien</option>
                    <option value="Russische F&ouml;deration">Russische F&ouml;deration</option>
                    <option value="Salomonen">Salomonen</option>
                    <option value="Sambia">Sambia</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="São Tomé und Príncipe">São Tomé und Príncipe</option>
                    <option value="Saudi-Arabien">Saudi-Arabien</option>
                    <option value="Schweden">Schweden</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbien und Montenegro">Serbien und Montenegro</option>
                    <option value="Seychellen">Seychellen</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Simbabwe">Simbabwe</option>
                    <option value="Singapur">Singapur</option>
                    <option value="Slowakei">Slowakei</option>
                    <option value="Slowenien">Slowenien</option>
                    <option value="Somalia">Somalia</option>
                    <option value="Spanien">Spanien</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="St. Helena">St. Helena</option>
                    <option value="St. Kitts und Nevis">St. Kitts und Nevis</option>
                    <option value="St. Lucia">St. Lucia</option>
                    <option value="St. Pierre und Miquelon">St. Pierre und Miquelon</option>
                    <option value="St. Vincent/Grenadinen (GB)">St. Vincent/Grenadinen (GB)</option>
                    <option value="S&uuml;dafrika, Republik">S&uuml;dafrika, Republik</option>
                    <option value="Sudan">Sudan</option>
                    <option value="S&uuml;dkorea">S&uuml;dkorea</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard und Jan Mayen">Svalbard und Jan Mayen</option>
                    <option value="Swasiland">Swasiland</option>
                    <option value="Syrien">Syrien</option>
                    <option value="Tadschikistan">Tadschikistan</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tansania">Tansania</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-Leste">Timor-Leste</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad und Tobago">Trinidad und Tobago</option>
                    <option value="Tristan da Cunha">Tristan da Cunha</option>
                    <option value="Tschad">Tschad</option>
                    <option value="Tschechische Republik">Tschechische Republik</option>
                    <option value="Tunesien">Tunesien</option>
                    <option value="T&uuml;rkei">T&uuml;rkei</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks- und Caicosinseln">Turks- und Caicosinseln</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="Ungarn">Ungarn</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Usbekistan">Usbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Vatikanstadt">Vatikanstadt</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vereinigte Arabische Emirate">Vereinigte Arabische Emirate</option>
                    <option value="Vereinigte Staaten von Amerika">Vereinigte Staaten von Amerika</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Wallis und Futuna">Wallis und Futuna</option>
                    <option value="Weihnachtsinsel">Weihnachtsinsel</option>
                    <option value="Wei&szlig;russland">Wei&szlig;russland</option>
                    <option value="Westsahara">Westsahara</option>
                    <option value="Zentralafrikanische Republik">Zentralafrikanische Republik</option>
                    <option value="Zypern">Zypern</option></select><br> 
				<input type="submit" class="profil_inputbutton" name="user_edit_profile_submit" value="&Auml;nderung speichern"/>
			</form>
		</div>			
<!-- user_email
user_first_name
user_surname
user_street
user_city
user_country
user_plz -->

<!-- <form method="post" action="edit.php" name="user_edit_form_email">
    <label for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
    <input id="user_email" type="email" name="user_email" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $_SESSION['user_email']; ?>)
    <input type="submit" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />
</form><hr/> -->


<!-- Form to change name/surname  -->

<!-- <form method="post" action="edit.php" name="user_edit_form_name">
    <label for="user_first_name"></label>
    <input id="user_first_name" type="text" value="bla" name="user_first_name" placeholder="Name" required/>
<br>
    <label for="user_surname"></label>
    <input id="user_surname" type="text" name="user_surname" placeholder="Surname" required/>
<br>
    <input type="submit" name="user_edit_submit_name" value="Change Name" />
</form>
<hr/> -->


<!-- Form to change address -->
<!-- <form method="post" action="edit.php" name="user_edit_form_address">
   
    <label for="user_country"></label>
    <input id="user_country" type="text" name="user_country" placeholder="Country" required/>
<br>

    <label for="user_city"></label>
    <input id="user_city" type="text" name="user_city" placeholder="City" required/>
<br>
 
    <label for="user_street"></label>
    <input id="user_street" type="text" name="user_street" placeholder="Street" required/>
<br> 

    <label for="user_plz"></label>
    <input id="user_plz" type="text" name="user_plz" placeholder="PLZ" required/>
<br> 

    <input type="submit" name="user_edit_submit_address" value="Change Address" required/>
</form>
<hr/> -->
	<div class="medien_seperator">
		<h1 id="password_change">Passwort &auml;ndern</h1>
	</div>
	<div class="profil">
		
		<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="user_edit_form_password">
    		<label for="user_password_old">Altes Passwort</label>
    		<input id="user_password_old" class="profil_inputfield" type="password" name="user_password_old" autocomplete="off"><br>
    		<label for="user_password_new">Neues Passwort</label>
    		<input id="user_password_new" class="profil_inputfield" type="password" name="user_password_new" autocomplete="off"><br>
    		<label for="user_password_repeat">Neues Passwort wiederholen</label>
    		<input id="user_password_repeat" class="profil_inputfield" type="password" name="user_password_repeat" autocomplete="off"><br>
    		<input type="submit" class="profil_inputbutton" name="user_edit_submit_password" value="Passwort &auml;ndern">
		</form>
	</div>
</div>
<?php include('_footer.php'); ?>
