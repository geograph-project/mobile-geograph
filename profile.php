<?php 
$page_title = "Profile";

if (!empty($_GET['id'])) {
	$uid = intval($_GET['id']);
	$canonical = "http://www.geograph.org.uk/profile/$uid";
	$full_link = $canonical.(strpos($canonical,'?')?'&':'?')."mobile=0";

	$url = "http://api.geograph.org.uk/api/user/$uid?output=json";
	$raw = file_get_contents($url); //todo add caching!

	if (strlen($raw) > 10) {
		$decoded = json_decode($raw);

		if (!empty($decoded->user_id) && $decoded->user_id == $uid) {

			$page_title = "Profile for ".$decoded->realname;
		} else {
			header("HTTP/1.1 404 Not Found");
		}
	}	else {
		header("HTTP/1.1 404 Not Found");
	}
} else {
	header("HTTP/1.1 404 Not Found");
}


include ".header.php"; ?>

<div class="content">

<?

if (!empty($decoded->user_id)) { ?>
	<h3><? echo htmlentities($page_title); ?></h3>
	<ul>
		<? if (!empty($decoded->nickname) && $decoded->nickname != $decoded->realname) { ?>
			<li><b>Nickname:</b> <? echo htmlentities($decoded->nickname); ?></li>
		<? } ?>
		<? if (!empty($decoded->stats) && !empty($decoded->stats->images)) { ?>
			<li><a href="http://www.geograph.org.uk/usermsg.php?to=<? echo $uid; ?>">Send message to <? echo htmlentities($decoded->realname); ?></a></li>
		<? } ?>
	</ul>
	<? if (!empty($decoded->stats) && !empty($decoded->stats->images)) { ?>
		<h4>Statistics</h4>
		<ul>
			<? if (!empty($decoded->stats->images)) { ?>
					<li><b>Images:</b> <? echo htmlentities($decoded->stats->images); ?></li>
			<? } 
			if (!empty($decoded->stats->points)) { ?>
					<li><b>First Points:</b> <? echo htmlentities($decoded->stats->points); ?></li>
			<? } 
			if (!empty($decoded->stats->geosquares)) { ?>
					<li><b>Personal Points:</b> <? echo htmlentities($decoded->stats->geosquares); ?></li>
			<? } 
			if (!empty($decoded->stats->days)) { ?>
					<li><b>Days:</b> <? echo htmlentities($decoded->stats->days); ?></li>
			<? } 
			if (!empty($decoded->stats->tpoints)) { ?>
					<li><b>TPoints:</b> <? echo htmlentities($decoded->stats->tpoints); ?></li>
			<? } ?>
		</ul>
		<a href="http://www.geograph.org.uk/search.php?user_id=<? echo $uid; ?>&do=1&displayclass=mobile">View images by this contributor</a>
		
	
	<? } ?>
		<a href="<? echo htmlentities($canonical); ?>?mobile=0">View Full Profile Page</a>
<? } else {
	print "Not Found";
}

?>

</div>

<?php include ".footer.php";
