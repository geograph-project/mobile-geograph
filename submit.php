<?php 
$page_title = "Submit to Geograph";
$canonical = "http://www.geograph.org.uk/submit.php";
include ".header.php"; ?>

<div class="content">
<hr/>
While you can use both of the desktop submission processes on most Mobile devices: 

<ul>
	<li><b><a href="http://www.geograph.org.uk/submit.php?redir=false&mobile=0">Submission Method v1</a></b></li>
	<li><b><a href="http://www.geograph.org.uk/submit2.php?redir=false&mobile=0">Submission Method v2</a></b></li>
</ul>

... it's recommended at this time to store the photos and just upload them via a Desktop Computer. It's usually quicker and easier.

<? if (empty($_GET['vote'])) { ?>
	<p>We may in future make a mobile optimized submission process. If interested <button onclick="location.href='?vote=yes'">Click here</button> - so we can guage interest.
<? } ?>


</div>

<?php include ".footer.php"; ?>
