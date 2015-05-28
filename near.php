<?php 

if (!function_exists('urlplus')) {
        function urlplus($string) {
                return str_replace('%2F','/',str_replace('%3A',':',urlencode($string)));
        }
}

$page_title = "Results";
if (empty($canonical)) 
	$canonical = "http://www.geograph.org.uk/near/".urlplus($_GET['q']).(isset($_GET['filter'])?"?filter=".urlencode(trim($_GET['filter'])):'');
$full_link = $canonical.(strpos($canonical,'?')?'&':'?')."mobile=0";

include ".header.php"; ?>

<div class="content">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript"></script>

<?

$link = "http://schools.geograph.org.uk/near/".urlplus($_GET['q']).(isset($_GET['filter'])?"?filter=".urlencode(trim($_GET['filter'])):'');

$data = file_get_contents($link);

$data = preg_replace('/.*<div id="content" >/s','',$data);
$data = preg_replace("/<div id=\"footer\">.*/ms",'',$data);

$data = preg_replace('/<div style="float:right">.+?<\/div>/ms','',$data);

$data = str_replace('"/browser','"http://www.geograph.org.uk/browser',$data);
$data = str_replace('"/search.php','"http://www.geograph.org.uk/search.php',$data);
$data = preg_replace('/\bdo=1/','do=1&displayclass=mobile',$data);

$data = str_replace("'/stuff/record","'http://www.geograph.org.uk/stuff/record",$data);


$data = str_replace('http://s1.geograph.org.uk/js/lazy.v2.js','/js/lazy.v2.js',$data);
$data = str_replace('<script src="/preview.js.php?d=preview" type="text/javascript"></script>','',$data);

print $data;

?>

</div>

<?php include ".footer.php"; 



exit;

$link = "http://schools.geograph.org.uk/near/".urlencode($_GET['q']);

$data = file_get_contents($link);


$data = str_replace('<head>','<head><base href="http://www.geograph.org.uk/">',$data);
$data = str_replace('<head>','<head><meta name="viewport" content="width=device-width, initial-scale=1">',$data);
$data = str_replace('<head>','<head><style>#content {width:inherit !important }</style>',$data);

#$data = 

print $data;

