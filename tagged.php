<?

function urlplus($string) {
        return str_replace('%2F','/',str_replace('%3A',':',urlencode($string)));
}

$canonical = "http://www.geograph.org.uk/tagged/".urlplus($_GET['tag']);

$_GET['q'] = "[".$_GET['tag']."]";

include "of.php";

