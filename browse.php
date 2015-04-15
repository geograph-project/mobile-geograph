<?

$canonical = "http://www.geograph.org.uk/gridref/".urlencode($_GET['gridref']);

$_GET['q'] = "@grid_reference ".$_GET['gridref'];

include "of.php";