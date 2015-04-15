<?

$canonical = "http://www.geograph.org.uk/tagged/".urlencode($_GET['tag']);

$_GET['q'] = "[".$_GET['tag']."]";

include "of.php";