<!-- Bootstrap -->
<link href="../style/modal.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../tools/bootstrap.js"></script>

<?php 
require_once('../classes/Login.php');
include ("_header.php"); 
$title="Projekte";
?>


<!--Content-->
<div id="center">
<div id="content">
<a class="content" href="../index.php">Index &raquo;</a> <a class="content" href="index.php">Projekte</a>
<div id="tabs-wrapper-lower"></div>


<?php
if ($id = $_GET["id"])
{
  $sql="SELECT * from termine WHERE id='$id'";
  $result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
  $entry = mysql_fetch_array($result);
  $title=$entry[title];
  $avail=$entry[spots]-$entry[spots_sold];
  $text=$entry[text];

  echo '<h3>'.$title.'</h3>';

  echo "<p>".$text."</p>";


?>
  <!-- Button trigger modal -->
 <input type="button" value="Investieren" data-toggle="modal" data-target="#myModal"> 


<?php
}

else {
?>

<h2>Projekte</h2>  

<div>
<p>In der Wertewirtschaft finden Sie eine professionelle, seri&ouml;se und realistische Alternative, als B&uuml;rger in den langfristigen Bestand, die Entwicklung und das Gedeihen Ihrer Gesellschaft zu investieren. Ohne dieses b&uuml;rgerliche Engagement bliebe es bei der ewigen Polarisierung von Markt und Staat, die meist zugunsten der Gewalt entschieden wird. Wir &uuml;berlassen Ihnen aber freilich Ausma&szlig; und Verwendung Ihres Beitrages &ndash; bitte w&auml;hlen Sie jene Projekte aus, die Ihnen sinnvoll erscheinen. Je nach H&ouml;he Ihrer Investition profitieren Sie als Anerkennung Ihres Beitrages von den Angeboten der Wertewirtschaft.</p>
</div>

<?php 


$sql = "SELECT * from termine WHERE `type` LIKE 'project' AND spots_sold < spots order by id asc";
$result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());

?>
<br>

<table style="width:100%;border-collapse: collapse">


<?php

  while($entry = mysql_fetch_array($result))
  {
    $id = $entry[id];
   ?>

    <tr>
        <td class="bottomline"><a href='?id=<?php echo $id;?>'><i><?php echo $id."</i> <b>".$entry[title];?></b></a>
    </tr>
    <tr>
        <td><?php echo $entry[text]; ?></td>
    </tr>      
    <tr><td>&nbsp;</td><td></td></tr>
    
    <?php
    }
    ?>
</table>



<?php 
} 
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel">Investieren</h2>
      </div>
      <div class="modal-body">
        Spendenformular

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
      </div>
    </div>
  </div>
</div>



</div>
<?php include "_side_not_in.php"; ?>
</div>


<?php 
include "_footer.php"; 
?>