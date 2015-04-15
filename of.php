<?php 
$page_title = "Results";
if (empty($canonical)) 
	$canonical = "http://www.geograph.org.uk/of/".urlencode($_GET['q']);
include ".header.php"; ?>

<div class="content">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript"></script>

<?

$link = "http://schools.geograph.org.uk/of/".urlencode($_GET['q']);

$data = file_get_contents($link);

$data = preg_replace('/.*<div id="content" >/s','',$data);
$data = preg_replace("/<div id=\"footer\">.*/ms",'',$data);

$data = str_replace('http://s1.geograph.org.uk/js/lazy.v2.js','/js/lazy.v2.js',$data);
$data = str_replace('<script src="/preview.js.php?d=preview" type="text/javascript"></script>','',$data);

print $data;

?>

</div>

<?php include ".footer.php"; ?>