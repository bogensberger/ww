<?php 

require_once('../classes/Login.php');
$title="Scholienb&uuml;chlein";
include('_header_not_in.php'); 


?>

<div class="content">
	
<?php
if(isset($_GET['q']))
{
  $id = $_GET['q'];

  //Termindetails
  $sql="SELECT * from produkte WHERE (type LIKE 'scholie') AND id='$id' AND status = 1";
  $result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
  $entry3 = mysql_fetch_array($result);
  
        	//check, if there is a image in the salon folder
	$img = 'http://www.scholarium.at/schriften/'.$id.'.jpg';

	if (@getimagesize($img)) {
	    $img_url = $img;
	} else {
	    $img_url = "http://www.scholarium.at/schriften/default.jpg";
	}
?>  	
	<div class="medien_head">
  		<h1><?echo $entry3[title]?></h1>
  		<div class="schriften_img">
			<img src="<?echo $img;?>" alt="<?echo $id;?>">
		</div>
		<div class="schriften_bestellen">
			<span class="schriften_type"><? echo ucfirst($entry3[type]);?></span>
			 <!-- Button trigger modal -->
			<input type="button" class="inputbutton" value="Bestellen und Herunterladen" data-toggle="modal" data-target="#myModal">
		</div>
	</div>
	<div class="medien_seperator">
		<h1>Inhalt</h1>
	</div>
	<div class="medien_content">
<? 
  if ($entry3[text]) echo $entry3[text];
  if ($entry3[text2]) echo $entry3[text2];
?>
  		<div class="medien_anmeldung"><a href="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">zur&uuml;ck zu den Scholienb&uuml;chlein</a></div>
  </div>
<?php
}
         
else { 
?>
	<div class="medien_info">
		<h1>Scholienb&uuml;chlein</h1>

		<?php  
			$sql = "SELECT * from static_content WHERE (page LIKE 'scholienbuechlein')";
			$result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
			$entry4 = mysql_fetch_array($result);
	
				echo $entry4[info];			
			?>
				<div class="centered">
					<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="registerform">
						<input class="inputfield" id="user_email" type="email" placeholder=" E-Mail-Adresse" name="user_email" required>
  						<input type=hidden name="first_reg" value="scholienbuechlein">
  						<input class="inputbutton" type="submit" name="eintragen_submit" value="Kostenlos eintragen">
					</form>
				</div>
	</div>
<? 
}
?>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel">Bestellen und Herunterladen</h2>
      </div>
      <div class="modal-body">
  			<p>Wir freuen uns, dass Sie Interesse an unseren Scholienb&uuml;chlein haben. Bitte tragen Sie hier Ihre E-Mail-Adresse ein, um mehr &uuml;ber die M&ouml;glichkeiten der Bestellung oder des Herunterladens digitaler Dateien zu erfahren (diese k&ouml;nnen wir leider nicht offen zug&auml;nglich machen):</p>
        <div class="subscribe">
          <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="registerform">
          	<input class="inputfield" type="email" placeholder=" E-Mail-Adresse" name="user_email" required>
          	<input type=hidden name="first_reg" value="scholienbuechlein">
          	<input class="inputbutton" type="submit" name="eintragen_submit" value="Kostenlos eintragen">
          </form> 
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('_footer.php'); ?>