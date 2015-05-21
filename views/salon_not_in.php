<!-- Bootstrap -->
<link href="../style/modal.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../tools/bootstrap.js"></script>


<?
require_once('../classes/Login.php');
$title="Salon";
include "_header.php"; 
?>
<!--Content-->
<div id="center">
        <div id="content">
          <a class="content" href="../index.php">Index &raquo;</a> <a class="content" href="index.php">Salon</a>
      <div id="tabs-wrapper"></div>
<?php

if(isset($_GET['q']))
{
  $id = $_GET['q'];

  //Termindetails
  $sql="SELECT * from produkte WHERE type LIKE 'salon' AND id='$id'";
  $result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
  $entry3 = mysql_fetch_array($result);
?>
  
  <h3 style="font-style:none;"><?echo $entry3[title]?></h3>

  <p><? if ($entry3[img]) echo $entry3[img]; ?>

  <b>Termin:</b> 
  <?php
  /* weekdays don't work
    $day=date("w",strtotime($entry3[start]));
    if ($day==0) $day=7;
    echo Phrase('day'.$day).", ";
    */
    echo strftime("%d.%m.%Y %H:%M Uhr", strtotime($entry3[start]));
  
  if ($entry3[text]) echo "<p>$entry3[text]</p>";
  if ($entry3[text2]) echo "<p>$entry3[text2]</p>";

?>
  <hr>
  <p>Unser Salon erweckt eine alte Wiener Tradition zu neuem Leben: Wie im Wien der Jahrhundertwende widmen wir uns gesellschaftlichen, philosophischen und wirtschaftlichen Themen ohne Denkverbote, politische Abh&auml;ngigkeiten und Ideologien, Sonderinteressen und Schablonen. Dieser Salon soll ein erfrischender Gegenentwurf zum vorherrschenden Diskurs sein. Wir besinnen uns dabei auf das Beste der Wiener Salontradition.</p>

  <p>N&uuml;tzen Sie die Gelegenheit, die Wertewirtschaft und deren au&szlig;ergew&ouml;hnliche G&auml;ste bei einem unserer Salonabende kennenzulernen. Ein spannender und tiefgehender Input bringt Ihren Geist auf Hochtouren, worauf dann eine intensive Diskussion in intimer Atmosph&auml;re folgt. Dabei kommt auch das leibliche Wohl nicht zu kurz: Selbst zu bereitete Gaumenfreuden und gute Tropfen machen den Abend auch zu einem kulinarischen Erlebnis.</p>
  <hr>

  <!-- Button trigger modal -->
  <input type="button" value="Reservieren" data-toggle="modal" data-target="#myModal">  
  
<?php
}
         
else { 
?>
  <h3>Salon</h3>

  <!--<p><img class='wallimg big' src='salon.jpg' alt='Salon im Institut für Wertewirtschaft'></p>-->
  <p>Unser Salon erweckt eine alte Wiener Tradition zu neuem Leben: Wie im Wien der Jahrhundertwende widmen wir uns gesellschaftlichen, philosophischen und wirtschaftlichen Themen ohne Denkverbote, politische Abh&auml;ngigkeiten und Ideologien, Sonderinteressen und Schablonen. Dieser Salon soll ein erfrischender Gegenentwurf zum vorherrschenden Diskurs sein. Wir besinnen uns dabei auf das Beste der Wiener Salontradition.</p>

  <p>N&uuml;tzen Sie die Gelegenheit, die Wertewirtschaft und deren au&szlig;ergew&ouml;hnliche G&auml;ste bei einem unserer Salonabende kennenzulernen. Ein spannender und tiefgehender Input bringt Ihren Geist auf Hochtouren, worauf dann eine intensive Diskussion in intimer Atmosph&auml;re folgt. Dabei kommt auch das leibliche Wohl nicht zu kurz: Selbst zu bereitete Gaumenfreuden und gute Tropfen machen den Abend auch zu einem kulinarischen Erlebnis.</p>
          
  <h5>Termine:</h5>        

  <p><table>

  <?php
  $sql = "SELECT * from produkte WHERE type LIKE 'salon' AND start > NOW() AND spots > spots_sold AND status = 1 order by start asc, n asc";
  $result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());

  while($entry = mysql_fetch_array($result))
  {
    $id = $entry[id];
      ?>
      <tr>
        <td class="bottomline"><?php echo date("d.m.Y",strtotime($entry[start])); ?></td>
        <td class="bottomline"><?php echo "<a href='?q=$id'><i>".$event_id."</i> <b>".$entry[title]; ?></b></a></td>
      </tr> 
      <tr>
        <td><?php echo date("H:i",strtotime($entry[start])); ?></td>
        <td class="bottomline"><?php echo $entry[text]; ?></td>
      </tr>
       <tr><td>&nbsp;</td><td></td></tr>
  <?php
  }
  ?>

  </table></p>

  <h5>Informationen</h5>

  <p><b>Veranstaltungsort:</b></p>

  <p><table width="570px"><tr><td width="50%" valign="top">
  <ul>
  <li class="ort"><b>Institut f&uuml;r Wertewirtschaft</b></li>
  <li class="ort">Schl&ouml;sselgasse 19/2/18</li>
  <li class="ort">A 1080 Wien</li>
  <li class="ort">&Ouml;sterreich</li>
  <li class="ort">&nbsp;</li>
  <li class="ort">Fax: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+43 1 2533033 4733</li>
  <li class="ort">E-Mail: &nbsp;<a href="mailto:&#105;nf&#111;&#064;&#119;&#101;rt&#101;wirtsc&#104;&#097;f&#116;.or&#103;">&#105;nf&#111;&#064;&#119;&#101;rt&#101;wirtsc&#104;&#097;f&#116;.or&#103;</a></li>
  </ul>

  <p><b>Teilnahme:</b></p> <p>10 Euro (5 Euro f&uuml;r <a href="../institut/mitglied.php">Mitglieder</a>). Inkludiert sind Buffet und Getr&auml;nke. Eine Anmeldung ist n&ouml;tig, da beschr&auml;nkte Platzzahl. Aufpreis an der Abendkassa (f&uuml;r unangemeldete Teilnehmer, falls noch Pl&auml;tze frei) 5 Euro, Platzgarantie nur f&uuml;r <a href="../institut/mitglied.php">M&auml;zene</a>. Video&uuml;bertragung f&uuml;r <a href="../institut/mitglied.php">Mitglieder</a>.</p></td> 
  <td><iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.de/maps?f=q&amp;source=s_q&amp;hl=de&amp;geocode=&amp;q=Schl%C3%B6sselgasse+19%2F18+1080+Wien,+%C3%96sterreich&amp;aq=0&amp;oq=Schl%C3%B6sselgasse+19%2F18,+1080+Wien&amp;sll=51.175806,10.454119&amp;sspn=7.082438,21.643066&amp;ie=UTF8&amp;hq=&amp;hnear=Schl%C3%B6sselgasse+19,+Josefstadt+1080+Wien,+%C3%96sterreich&amp;t=m&amp;z=14&amp;ll=48.213954,16.353095&amp;output=embed"></iframe><br /><small><a href="https://maps.google.de/maps?f=q&amp;source=embed&amp;hl=de&amp;geocode=&amp;q=Schl%C3%B6sselgasse+19%2F18+1080+Wien,+%C3%96sterreich&amp;aq=0&amp;oq=Schl%C3%B6sselgasse+19%2F18,+1080+Wien&amp;sll=51.175806,10.454119&amp;sspn=7.082438,21.643066&amp;ie=UTF8&amp;hq=&amp;hnear=Schl%C3%B6sselgasse+19,+Josefstadt+1080+Wien,+%C3%96sterreich&amp;t=m&amp;z=14&amp;ll=48.213954,16.353095"></iframe>
  </td></tr>
  </table></p>

<?php
}
?> 

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel">Reservierung</h2>
      </div>
      <div class="modal-body">
        <p>Wir freuen uns, dass Sie Interesse an einer Teilnahme haben. Bitte tragen Sie hier Ihre E-Mail-Adresse ein, um mehr &uuml;ber die M&ouml;glichkeiten einer Teilnahme zu erfahren:</p>
        <div class="subscribe">
<!--           
  Commented out, because of the clashes between forms
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="registerform">
          <input class="inputfield" id="keyword" type="email" placeholder=" E-Mail Adresse" name="user_email" autocomplete="off" required />
          <input class="inputfield" id="user_password" type="password" name="user_password" placeholder=" Passwort" autocomplete="off" style="display:none"  />
          <input class="inputbutton" id="inputbutton" type="submit" name="fancy_ajax_form_submit" value="Eintragen" />
          </form>  -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
      </div>
    </div>
  </div>
</div>



  <div id="tabs-wrapper-lower"></div>
</div>
 <? include "_side_not_in.php"; ?>
</div>
<? include "_footer.php"; ?>