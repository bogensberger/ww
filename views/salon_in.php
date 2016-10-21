<?php
require_once('../classes/Login.php');

#####################################
#        Redirect to stream         #
#####################################

# if the user has alreday registered for the stream, directly redirect him to the stream view

if($_GET['stream'] != true) {

$id = $_GET['q'];

$salon_info = $general->getProduct($id);
$event_id = $salon_info->n;
$event_reg = $general->getEventReg($_SESSION['user_id'],$event_id);

	if($event_reg->format == 'Stream') {
		header('Location: index.php?q='.$id.'&stream=true');
	}
}

$title="Salon";
include "_header_in.php";

if(!isset($_SESSION['basket'])){
    $_SESSION['basket'] = array();
}

if(isset($_POST['add'])){

  $add_id = $_POST['add'];
  $add_quantity = $_POST['quantity'];
  $add_format = $_POST['sformat'];
  $add_code = $add_id . $add_format;
  if ($add_quantity==1) $wort = "wurde";
  else $wort = "wurden";
  echo "<div class='basket_message'><i>".$add_quantity." Artikel ".$wort." in Ihren Korb gelegt.</i> &nbsp <a href='../spende/korb.php'>&raquo; zum Korb</a></div>";

  if (isset($_SESSION['basket'][$add_code])) {
    $_SESSION['basket'][$add_code] += $add_quantity;
  }
  else {
    $_SESSION['basket'][$add_code] = $add_quantity;
  }

}

#####################################
# Single Event View + Registration  #
#####################################

if(isset($_GET['q']) && !isset($_GET['stream']))
{
  $id = $_GET['q'];

  //Termindetails
  $salon_info = $general->getProduct($id);

  $event_id = $salon_info->n;
  $title = $salon_info->title;
  $price = $salon_info->price;
  $price2 = $salon_info->price_book;
  $spots_total = $salon_info->spots;
  $spots_available = $spots_total - $salon_info->spots_sold;
  $livestream = $salon_info->livestream;
  $status = $salon_info->status;

  $date = $general->getDate($salon_info->start, $salon_info->end);
  if($price2 != '') {
  	$streamprice = $price2;
  }
  else {
	$streamprice = $price;
  }

  //Userdetails
  $user_id = $_SESSION['user_id'];
  $user_itm_info = $general->getEventReg($user_id, $event_id);
  $quantity = $user_itm_info->quantity;
  $format = $user_itm_info->format;


    ################## No valid Event ##################

	if ($status == 0) {
  	echo '<div class="salon_head"><p class="salon_date">Es wurde keine Veranstaltung gefunden.</p></div>';
    }

	################### Valid Event ####################

    else {
?>
    <div class="content">
  		<div class="salon_head">
  			<h1><?=$title?></h1>
			<p class="salon_date">
      			<?=$date?>
      		</p>
      	<?php
  			if ($spots_total > 59 && $livestream != '') {
  		?>
  				<div class="startpage_section_last_scholie startpage-livestream">
  				<p><a href='?q=<?=$id?>&stream=true'>&Uuml;ber diesen Link gelangen Sie zum Livestream des Offenen Salons</a></p>
  				</div>
		<?php
		}
  		?>
      	</div>

      	<?php
	##################### Event Info ###################
?>

  		<div class="salon_seperator">
			<h1>Inhalt und Informationen</h1>
		</div>
		<div class="salon_content">
  		<?php
  			if ($salon_info->text) echo "<p>".$salon_info->text."</p>";
  			if ($salon_info->text2) echo "<p>".$salon_info->text2."</p>";

			$static_info = $general->getStaticInfo('salon');
			echo $static_info->info
			?>

  			<div class="medien_anmeldung"><a href="http://www.scholarium.at/salon/index.php">zur&uuml;ck zu den Salons</a></div>

  			<div class="centered">
    			<div class="salon_reservation">
<?php

		###################### Reg Form ####################

		# Offener Salon

		if($spots_total > 59) {

			/*if(isset($livestream)) {
?>
				<div class="sinfo">
					<h5>Im Stream</h5>

					<p>
<?php
						if($quantity >= 1 && $format == 'Stream') {
							echo 'Sie haben sich f&uuml;r diese Veranstaltung bereits registriert.<br><br>';
						}
?>
					</p>

					<form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="post">
      					<input type="hidden" name="profile[event_id]" value="<?=$event_id?>">
						<input type="hidden" name="profile[quantity]" value="1">
						<input type="hidden" name="sformat" value="2">
      					<input class="inputbutton" type="submit" name="register_open_salon" value="Reservieren" <? if($quantity >= 1) echo "disabled"?>><br>
    				</form>
					<span class="coin-span"><?=$streamprice?></span> &euro;

    			</div>
<?php
			}*/
?>
			<div class="sinfo">
				<!--<h5>Vor Ort</h5>-->

					<p>
<?php
						echo 'F&uuml;r unseren Offenen Salon ist nur Barzahlung vor Ort m&ouml;glich. Der Eintritt kostet 5&euro; pro Teilnehmer. Mit dem Klick auf &quot;Reservieren&quot; werden Sie unmittelbar eingetragen.<br><br>';

						if($quantity >= 1 && $format == 'vorOrt') {
							echo 'Sie haben sich f&uuml;r diese Veranstaltung bereits registriert ('.$quantity.' Ticket(s)).<br><br>';
						}
						if($spots_available == 0) {
?>
  							Die Pl&auml;tze vor Ort sind leider ausgebucht, sie k&ouml;nnen stattdessen per <a href='?q=<?=$id?>&stream=true'>Livestream</a> dazukommen.
<?php
						}
?>
					</p>
					<p>Anzahl gew&uuml;nschter Teilnehmer:</p>

			    	<form action="<?php htmlentities($_SERVER['PHP_SELF'])?>" method="post">
      					<input type="hidden" name="profile[event_id]" value="<?=$event_id?>">
      					<input type="hidden" name="profile[sformat]" value="1">
      					<select class="input-select" name="profile[quantity]" onchange="changePrice(this.value,'<?=$price?>')">>
      					<?php
		  					if ($spots_available == 0){echo '<option value="0">0</option>';}
		  					if ($spots_available >= 1){echo '<option value="1" selected>1</option>';}
		  					if ($spots_available >= 2){echo '<option value="2">2</option>';}
		  					if ($spots_available >= 3){echo '<option value="3">3</option>';}
		  					if ($spots_available >= 4){echo '<option value="4">4</option>';}
		  					if ($spots_available >= 5){echo '<option value="5">5</option>';}
		  				?>
     					</select>
      					<input class="inputbutton" type="submit" name="register_open_salon" value="Reservieren" <? if($spots_available == 0) echo "disabled"?>><br>
    				</form>
  					<span id="change" class="coin-span"><?=$streamprice?></span> &euro;
  				</div>
		<?php
		}

		# Normal Form

		else {

			########## Reg Options For level 1 members #########

  			if ($_SESSION['Mitgliedschaft'] == 1) {

			if ($quantity >= 1) {
				echo '<span class="salon_reservation_span_a">Sie haben sich f&uuml;r diese Veranstaltung bereits registriert.</span><br>';
			}
  			if ($spots_available == 0){
  				echo '<span class="salon_reservation_span_a">Diese Veranstaltung ist leider ausgebucht. Unsere Unterst&uuml;tzer k&ouml;nnen dennoch per Livestream dabei sein. <a href="../spende/">&rarr;Unterst&uuml;tzer werden</a></span><br>';
  			}
			?>
    		<!--Button trigger modal-->
    		<input class="salon_reservation_inputbutton" type="button" value="Reservieren" data-toggle="modal" data-target="#myModal" <?if($spots_available == 0){echo 'disabled';}?>>

<?php
  			}

			######### Reg Options For level > 1 members ########

			else {

			if(isset($livestream)) {
?>
				<div class="sinfo">
					<h5>Im Stream</h5>

					<p>
<?php
						if($quantity >= 1 && $format == 'Stream') {
							echo 'Sie haben sich f&uuml;r diese Veranstaltung bereits registriert.<br><br>';
						}
?>
					</p>

					<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
      					<input type="hidden" name="add" value="<?=$event_id?>">
						<input type="hidden" name="quantity" value="1">
						<input type="hidden" name="sformat" value="2">
      					<input class="inputbutton" type="submit" value="Ausw&auml;hlen" <? if($quantity >= 1) echo "disabled"?>><br>
    				</form>
					<span class="coin-span"><?=$streamprice?></span><img class="coin-span__img" src="../style/gfx/coin.png">

    			</div>
<?php
			}
?>
				<div class="sinfo">
					<h5>Vor Ort</h5>

					<p>
<?php
						if($quantity >= 1 && $format == 'vorOrt') {
							echo 'Sie haben sich f&uuml;r diese Veranstaltung bereits registriert ('.$quantity.' Ticket(s)).<br><br>';
						}
						if($spots_available == 0) {
  							echo 'Die Pl&auml;tze vor Ort sind leider ausgebucht, sie k&oumlnnen stattdessen per Livestream dazukommen.';
						}
?>
					</p>
					<p>Anzahl gew&uuml;nschter Teilnehmer:</p>

			    	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
      					<input type="hidden" name="add" value="<?=$event_id?>">
      					<input type="hidden" name="sformat" value="1">
      					<select class="input-select" name="quantity" onchange="changePrice(this.value,'<?=$price?>')">>
      					<?php
		  					if ($spots_available == 0){echo '<option value="0">0</option>';}
		  					if ($spots_available >= 1){echo '<option value="1" selected>1</option>';}
		  					if ($spots_available >= 2){echo '<option value="2">2</option>';}
		  					if ($spots_available >= 3){echo '<option value="3">3</option>';}
		  					if ($spots_available >= 4){echo '<option value="4">4</option>';}
		  					if ($spots_available >= 5){echo '<option value="5">5</option>';}
		  				?>
     					</select>
      					<input class="inputbutton" type="submit" value="Ausw&auml;hlen" <? if($spots_available == 0) echo "disabled"?>><br>
    				</form>
  					<span id="change" class="coin-span"><?=$price?></span><img class="coin-span__img" src="../style/gfx/coin.png">
  				</div>
<?php
		}
  	}
?>
			</div>
			</div>
		</div>
	</div>
<?php
	}
}

#####################################
#           Stream View             #
#####################################

elseif(isset($_GET['q']) && $_GET['stream'] === 'true') {

	$id = $_GET['q'];
	$salon_info = $general->getProduct($id);
	$reg_info = $general->getEventReg($_SESSION['user_id'], $salon_info->n);

	$chat_loc = $general->createChat($salon_info->n, $salon_info->type);

	if ($reg_info->format === 'Stream' || $salon_info->spots > 59) {

		$livestream = substr($salon_info->livestream,32);
?>
	<div class="content-area">
		<div class="centered">
			<h2><?=$salon_info->title?></h2>
		</div>
		<?php
		if ($salon_info->spots < 60) {
		?>
		<div class="chat-info">
			<p>&Uuml;ber den unten stehenden Chat k&ouml;nnen Sie aus der Ferne mitdiskutieren. Hierzu einfach einen Namen in das Login-Feld eingeben und &bdquo;Ok&ldquo; dr&uuml;cken. Wir werden dann vor Ort auf Ihre Fragen und Kommentare eingehen.</p>
		</div>
		<?php
		}
		?>
		<div class="centered">
			<iframe width="100%" height="500" src="https://www.youtube.com/embed/<?=$livestream?>?rel=0&modestbranding=1" frameborder="0" allowfullscreen></iframe>
		</div>
		<?php
		if ($salon_info->spots < 60) {
		?>
		<div class="chat-wrapper">
			<iframe src="<?=$chat_loc?>" width="100%" height="600"></iframe>
			<!--<div class="pfc-hook"><a href="http://www.phpfreechat.net">Creating chat rooms everywhere - phpFreeChat</a></div>
    			<script type="text/javascript">
      				$('.pfc-hook').phpfreechat({ serverUrl: '../phpfreechat/server' });
   				</script>-->
		</div>
		<?php
		}
		?>
	</div>
<?php
	}
	else {
?>
	<div class="content-area">
		<div class="centered content-elm">
			<h2><?=$salon_info->title?></h2>
		</div>
		<div class="centered content-elm">
			<p>Wir freuen uns, dass Sie an unserem Salon aus der Ferne teilnehmen m&ouml;chten. <a href="index.php?q=<?=$id?>">Bitte buchen Sie dazu zun&auml;chst einen Streamplatz.</a></p>
		</div>
	</div>
<?php
	}
}

#####################################
#            Event List             #
#####################################

else {
?>
	<div class="content">
		<?

#für Interessenten (Mitgliedschaft 1) Erklärungstext oben
  if ($_SESSION['Mitgliedschaft'] == 1) {
  	echo "<div class='salon_info'>";
	  		$static_info = $general->getStaticInfo('salon');
			echo $static_info->info;
	?>
			<div class="centered">
				<a class="blog_linkbutton" href="../spende/">Unterst&uuml;tzen & Zugang erhalten</a>
			</div>
   </div>
   <?
  }
  elseif ($_SESSION['Mitgliedschaft'] > 1) {
?>
		<div class="salon_content">
<?
  $sql = "SELECT * from produkte WHERE type LIKE 'salon' AND end > NOW() AND status = 1 order by start asc, n asc";
  $result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());


  while($entry = mysql_fetch_array($result))
  {
    $id = $entry[id];
	$date = $general->getDate($entry[start], $entry[end]);
      ?>

<?php echo "<h1><a href='?q=$id'>".$entry[title]; ?></a></h1>
		<div class="salon_dates">
      <?=$date?>
		</div>
<?php
		if ($entry[spots] > 59 && $entry[livestream] != '') {
?>
		<div class="salon_dates">
			<a href='?q=<?=$id?>&stream=true'>zum Stream</a>
		</div>
<?php
}
			echo $entry[text];
?>
			<div class="centered"><p class='linie'><img src='../style/gfx/linie.png' alt=''></p></div>
  <?php
  }
  ?>
  	</div>
  </div>
  	<?php
  }
}
  ?>

 <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog-login modal-form-width">
      <div class="modal-content-login">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="modal-title" id="myModalLabel">Reservieren</h2>
        </div>
        <div class="modal-body">
        	<?php
        	if ($spots_total > 59){
        		$pass_to = 'register_open_salon'; //Register from level 1
      			$submit = 'register_open_salon'; //Register from level 1
        		include ('../tools/open_salon_form.php');
				echo '</div>';
        	}
			else {
			$sql = "SELECT * from static_content WHERE (page LIKE 'salon')";
			$result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
			$entry4 = mysql_fetch_array($result);

				echo $entry4[modal];
			?>
        </div>
        <div class="modal-footer">
			<a href="../spende/"><button type="button" class="inputbutton">Besuchen Sie uns als Gast</button></a>
        </div>
        	<?php
        	}
			?>
      </div>
    </div>
  </div>


<? include "_footer.php"; ?>
