<?php 

require_once('../classes/Login.php');

if(isset($_GET['q']))
{	
	$id = $_GET['q'];

 	$sql = "SELECT * from blog WHERE id='$id'";
	$result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
	$entry = mysql_fetch_array($result);

	$title = $entry[title];
	$private = $entry[private_text];
	$public = $entry[public_text];
	$publ_date = $entry[publ_date];
	
	$length = str_word_count(strip_tags($private), 0, '&;');
	$l = str_word_count(strip_tags($private), 0, '&;');

	$type = 'blog';
	
	$description_fb0 = wordwrap(strip_tags($public), 400, "\0");
	$description_fb = preg_replace('/^(.*?)\0(.*)$/is', '$1', $description_fb0);

	include('_header_in.php');
	
	if ($_GET['print'] == TRUE) {
?>
	<script>setPrintView();</script>
<?php
	}

?>
        <aside class="social">
                   <ul>
                       <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/facebook.png" alt="Facebook" title="Teilen Sie diesen Post auf Facebook!"></a></li>
                       <li><a href="http://twitter.com/share?url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>&text=<?=$title?>&via=scholarium_at" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/twitter.png" alt="Twitter" title="Tweeten Sie diesen Post!"></a></li>
                       <li><a href="https://plus.google.com/share?url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/google.png" alt="Google+" title="Teilen Sie diesen Post auf Google+!"></a></li>
                       <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/linkedin.png" alt="Linkedin" title="Teilen Sie diesen Post auf Linkedin!"></a></li>
                       <li><a href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/xing.png" alt="Xing" title="Teilen Sie diesen Post auf Xing!"></a></li>
                       <li><a href="?q=<?=$id?>&print=TRUE" target="_blank" onclick="openpopup2(this.href); return false"><img src="../style/gfx/print.png" alt="Print" title="Druckansicht &ouml;ffnen!"></a></li>
                    </ul>                  
               </aside>
        <div class="content">
           <article class="blog">
           		
<?  
	$static_info = $general->getStaticInfo('scholien');
		
	if ($_SESSION['Mitgliedschaft'] == 1) { 
		echo "<div class='blog_info'>";
				
				echo $static_info->info1;
		
		echo "</div>";
		echo "<header>";
		echo "<h1>$title</h1>";
		echo "</header>";	
		
		"<p class='blogdate'>".date('d.m.Y', strtotime($publ_date))."</p>";
		?>
		<div class='blog_text'>			
		<?php
		echo $public;
		echo "</div>";
		
		if ($l>10)
		{
		echo '<div class="blog_upgrade">';
		echo $static_info->mehr_lesen1;
			?>

		<script type="text/javascript">
			function length() {
				document.getElementById('length').innerHTML = <?php echo json_encode($length) ?>
			}
			window.open = length();
		</script>
			

		<a class="blog_linkbutton" href="../spende/">Unterst&uuml;tzen & Zugang erhalten</a>
		</div>
		<? }
		?>
		<footer class="blog_footer">
		<p><a href="index.php">Alle Scholien</a></p>
<?
	}

	elseif ($expired < time()) {
		echo "<div class='blog_info'>";
				
				echo $static_info->info2;
		
		echo "</div>";
		echo "<header>";
		echo "<h1>$title</h1>";
		echo "</header>";	
		
		"<p class='blogdate'>".date('d.m.Y', strtotime($publ_date))."</p>";
		?>
		<div class='blog_text'>			
		<?php
		echo $public;
		echo "</div>";
		
		if ($l>10)
		{
		echo '<div class="blog_upgrade">';
		echo $entry4[mehr_lesen1];
			?>

		<script type="text/javascript">
			function length() {
				document.getElementById('length').innerHTML = <?php echo json_encode($length) ?>
			}
			window.open = length();
		</script>
			

		<a class="blog_linkbutton" href="../spende/">Unterst&uuml;tzen & Zugang erhalten</a>
		</div>
		<? }
		?>
		<footer class="blog_footer">
		<p><a href="index.php">Alle Scholien</a></p>
<?php
	}

	else {
		echo "<h1>$title</h1>";
		echo "<p class='blogdate'>".date('d.m.Y', strtotime($publ_date))."</p>";
		echo '<!--<img class="blog_img" src="'.$img_url.'" alt="'.$id.'">-->';
		echo "<div class='blog_text'>";
		echo $public."\n";
		echo $private;
		echo "</div>";
		echo "<footer class='blog_footer'>";
		echo "<p><a href='index.php'>Alle Scholien</a></p>";
		
	}
?>	   
                   <div class="socialimg">
                   <a href="https://www.facebook.com/sharer/sharer.php?u=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"> <img src="../style/gfx/facebook.png" alt="Facebook" title="Teilen Sie diesen Post auf Facebook!"></a>
                   <a href="http://twitter.com/share?url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>&text=<?=$title?>&via=scholarium_at" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/twitter.png" alt="Twitter" title="Tweeten Sie diesen Post!"></a>
                   <a href="https://plus.google.com/share?url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/google.png" alt="Google+" title="Teilen Sie diesen Post auf Google+!"></a>
                   <a href="http://www.linkedin.com/shareArticle?mini=true&url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/linkedin.png" alt="Linkedin" title="Teilen Sie diesen Post auf Linkedin!"></a>
                   <a href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=http://www.scholarium.at/scholien/index.php?q=<?=$id?>" target="_blank" onclick="openpopup(this.href); return false"><img src="../style/gfx/xing.png" alt="Xing" title="Teilen Sie diesen Post auf Xing!"></a>
                   <a href="?q=<?=$id?>&print=TRUE" target="_blank" onclick="openpopup2(this.href); return false"><img src="../style/gfx/print.png" alt="Print" title="Druckansicht &ouml;ffnen!"></a></li>
                   </div>
               </footer>
               <p class="linie"><img src="../style/gfx/linie.png" alt=""></p>
<?	
}

else 
{
	$title = "Scholien";
	include('_header_in.php');
	
	//Pagination Script found at http://www.phpeasystep.com/phptu/29.html
	$tbl_name="blog";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE publ_date<=CURDATE() and publ_date >'1999-12-31'";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "index.php"; 	//your file name  (the name of this file)
	$limit = 5; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * from blog WHERE publ_date<=CURDATE() AND publ_date > '2000-01-01' order by publ_date desc, id asc LIMIT $start, $limit";
	
	$result = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
	

		/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">&laquo; zur&uuml;ck</a>";
		else
			$pagination.= "<span class=\"disabled\">&laquo; zur&uuml;ck</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">vor &raquo;</a>";
		else
			$pagination.= "<span class=\"disabled\">vor &raquo;</span>";
		$pagination.= "</div>\n";
	}
?>
	 <div class="content">
           <article class="blog">
	
		<?php if ($_SESSION['Mitgliedschaft'] == 1) { 
		echo "<div class='blog_info'>";
		
				$sql = "SELECT * from static_content WHERE (page LIKE 'scholien')";
				$result2 = mysql_query($sql) or die("Failed Query of " . $sql. " - ". mysql_error());
				$entry4 = mysql_fetch_array($result2);
				
				echo $entry4[info1];
		?>
			<div class="centered">
				<a class="blog_linkbutton" href="../spende/">Unterst&uuml;tzen & Zugang erhalten</a>
			</div>
		</div>
		<?
		}
		elseif ($_SESSION['Mitgliedschaft'] > 1){

		while($entry = mysql_fetch_array($result))
		{
	
		$id = $entry[id];
		$title = $entry[title];
		$public = $entry[public_text];
		$publ_date = $entry[publ_date];

		echo "<div class='blog_entry'>";
		echo "<h2><a href='?q=$id'>".$title."</a></h2>";
		##echo "<p class='blogdates'><!--Keyword: ".$id."&nbsp &nbsp &nbsp Datum: -->".date('d.m.Y', strtotime($publ_date))."</p>";
		
		$public1 = wordwrap($public, 500, "\0");
		$public_short = preg_replace('/^(.*?)\0(.*)$/is', '$1', $public1);
		
		if (strlen($public) > 500) {
			echo $public_short;
			echo " ... <a href='?q=$id'>Weiterlesen</a>";
			echo "</div>";
			echo "<p class='linie'><img src='../style/gfx/linie.png' alt=''></p>";
		}
		else {
			echo $public;
			echo "... <a href='?q=$id'>Weiterlesen</a>";
			echo "</div>";
			echo "<p class='linie'><img src='../style/gfx/linie.png' alt=''></p>";
		}
	  }

	echo $pagination;
	   }
}
?>
           </article> 
        </div>

<?php include('_footer.php'); ?>