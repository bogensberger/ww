<?php 

require_once('../classes/Login.php');
//$title="Scholien";
//include('_header_not_in.php'); 
include ("_db.php");

if(isset($_GET['q']))
{
	// #$scholien = htmlentities($scholien);

	// echo $scholien;

	$id = $_GET['q'];

 	$sql = "SELECT * from blog WHERE id='$id'";
	$result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
	$entry = mysql_fetch_array($result);

	$title = $entry[title];
	$public = $entry[public_text];
	$private = $entry[private_text];
	$publ_date = $entry[publ_date];
	
	$length = str_word_count(strip_tags($private), 0, '&;');
	$type = 'blog';

	$description_fb0 = wordwrap(strip_tags($public), 400, "\0");
	$description_fb = preg_replace('/^(.*?)\0(.*)$/is', '$1', $description_fb0);
	
	//check, if there is a image in the blog/gfx folder
/*	$img = 'http://www.scholarium.at/scholien/'.$id.'.jpg';

	if (@getimagesize($img)) {
	    $img_url = $img;
	} else {
	    $img_url = "http://craftprobe.com/img/1.jpg";
	} */

		include('_header_not_in.php');
		
?>		
        <aside class="social">
                   <ul>
                       <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/facebook.png" alt="Facebook" title="Teilen Sie diesen Post auf Facebook!"></a></li>
                       <li><a href="http://twitter.com/share?url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>&text=<?=$title?>&via=scholarium_at" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/twitter.png" alt="Twitter" title="Tweeten Sie diesen Post!"></a></li>
                       <li><a href="https://plus.google.com/share?url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/google.png" alt="Google+" title="Teilen Sie diesen Post auf Google+!"></a></li>
                       <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/linkedin.png" alt="Linkedin" title="Teilen Sie diesen Post auf Linkedin!"></a></li>
                       <li><a href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/xing.png" alt="Xing" title="Teilen Sie diesen Post auf Xing!"></a></li>
                       <li><a href="?q=<?=$id?>&print=TRUE" target="_blank" onclick="openpopup2(this.href); return false"><img src="../style/gfx/print.png" alt="Print" title="Druckansicht &ouml;ffnen!"></a>
                       </li>
                    </ul>                 
        </aside>
        <div class="content">
           <article class="blog">
<?
	$sql = "SELECT * from static_content WHERE (page LIKE 'scholien')";
	$result2 = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
	$entry4 = mysql_fetch_array($result2);
	echo "<div class='blog_info'>";
				
				echo $entry4[info1];			
		
	echo "</div>";
	echo "<header>";
	echo "<h1>$title</h1>";
	echo "</header>";
	echo "<p class='blogdate'>".date('d.m.Y', strtotime($publ_date))."</p>";
	echo "<!--<img class='blog_img' src='$img_url' alt='$id'>-->";
	echo "<div class='blog_text'>";
	echo $public;
	echo "</div>";

if ($length>10) 
	{ ?>
	<div class="blog_upgrade">
		<?php  
			$sql = "SELECT * from static_content WHERE (page LIKE 'scholien')";
			$result2 = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
			$entry4 = mysql_fetch_array($result2);
	
				echo $entry4[mehr_lesen];			
			?>
			
		<script type="text/javascript">
			function length() {
				document.getElementById('length').innerHTML = <?php echo json_encode($length) ?>
			}
			window.open = length();
		</script>
			
		<div class="centered">
		<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="registerform">
  			<input class="inputfield" id="user_email" type="email" placeholder=" E-Mail-Adresse" name="user_email" required>
  			<input type=hidden name="first_reg" value="scholien">
  			<input class="inputbutton" type="submit" name="eintragen_submit" value="Kostenlos eintragen">
		</form>
		</div>
	</div>
	<? } 
else 
	{ 				
		?>
	<div class="blog_upgrade">
		<p>Wie Sie alle Scholien in voller L&auml;nge lesen k&ouml;nnen, indem Sie eine der letzten v&ouml;llig unabh&auml;ngigen Bildungs- und&nbsp;Forschungseinrichtungen als Gast beehren, 
		erfahren Sie, wenn Sie zun&auml;chst einen Schritt weit aus der Anonymit&auml;t treten und hier Ihre E-Mail-Adresse eintragen:</p>
		<div class="centered">
		<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="registerform">
			<input class="inputfield" id="user_email" type="email" placeholder=" E-Mail-Adresse" name="user_email" required>
  			<input type=hidden name="first_reg" value="scholien">
  			<input class="inputbutton" type="submit" name="eintragen_submit" value="Kostenlos eintragen">
		</form>
		</div>
	</div>
	<? } ?>
	
	<footer class="blog_footer">
		<p><a href='index.php'>Alle Scholien</a></p>
		<div class="socialimg">
                   <a href="https://www.facebook.com/sharer/sharer.php?u=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"> <img src="../style/gfx/facebook.png" alt="Facebook" title="Teilen Sie diesen Post auf Facebook!"></a>
                   <a href="http://twitter.com/share?url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>&text=<?=$title?>&via=scholarium_at" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/twitter.png" alt="Twitter" title="Tweeten Sie diesen Post!"></a>
                   <a href="https://plus.google.com/share?url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/google.png" alt="Google+" title="Teilen Sie diesen Post auf Google+!"></a>
                   <a href="http://www.linkedin.com/shareArticle?mini=true&url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/linkedin.png" alt="Linkedin" title="Teilen Sie diesen Post auf Linkedin!"></a>
                   <a href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/xing.png" alt="Xing" title="Teilen Sie diesen Post auf Xing!"></a>
                   <a href="?q=<?=$id?>&print=TRUE" target="_blank" onclick="openpopup2(this.href); return false"><img src="../style/gfx/print.png" alt="Print" title="Druckansicht &ouml;ffnen!"></a>
                   </div>
    </footer>
		<p class="linie"><img src="../style/gfx/linie.png" alt=""></p>
<?php
}
else 
{		
	$title = "Scholien";
	include('_header_not_in.php');
?>
<div class="content">
	<article class="blog">
		<div class="blog_text">
			<?php  
			$sql = "SELECT * from static_content WHERE (page LIKE 'scholien')";
			$result2 = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
			$entry4 = mysql_fetch_array($result2);
	
				echo $entry4[info];			
			?>
		
		</div>
		<div class="centered">
			<div class="blog_subscribe">
				<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="registerform">
        			<input class="inputfield" type="email" placeholder=" E-Mail-Adresse" name="user_email" autocomplete="off" required>
        			<input type=hidden name="first_reg" value="scholien">
        			<input class="inputbutton" type="submit" name="eintragen_submit" value="Kostenlos eintragen">
      			</form>	
			</div>
		</div>
		<p class="linie"><img src="../style/gfx/linie.png" alt=""></p>
		
<?php 
}

	echo "</article>";
	echo "</div>";

include('_footer.php'); ?>

