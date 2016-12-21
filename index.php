<?php

include "radar/functions.inc.php";

customExpiresHeader(900,true);
customGZipHandlerStart();

if (file_exists("cache/eff23e763a509d73257e279b8c921b9c")) {
	//needs to be after customGZipHandlerStart, so that $encoding is set!
	customCacheControl(filemtime("cache/eff23e763a509d73257e279b8c921b9c"),'');
}

$data = getJSON("http://www.geograph.org.uk/stuff/homepage.json.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Geograph Britain and Ireland  - photograph every grid square!</title>
	<meta name="description" content="Geograph Britain and Ireland is a web-based project to collect and reference geographically representative images of every square kilometre of the British Isles."/>
	<meta name="DC.title" content="Geograph"/>
	<link rel="dns-prefetch" href="//s0.geograph.org.uk">
	<link rel="dns-prefetch" href="//s1.geograph.org.uk">
	<link rel="dns-prefetch" href="//www.geograph.org.uk">

	<link rel="shortcut icon" type="image/x-icon" href="http://s1.geograph.org.uk/favicon.ico"/>

 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="canonical" href="http://www.geograph.org.uk/" />

<script type="application/ld+json">
{
   "@context": "http://schema.org",
   "@type": "WebSite",
   "url": "https://m.geograph.org.uk/",
   "name": "Geograph",
   "alternateName": "Geograph Britain and Ireland",
   "potentialAction": {
     "@type": "SearchAction",
     "target": "http://m.geograph.org.uk/of/{search_term}",
     "query-input": "required name=search_term"
   }
}
</script>

<style>
html,body {
	padding:0;
	margin:0;
	font-family:Georgia, sans-serif;
	background: #e4e4fc;
}
a {
   text-decoration:none;
   padding:3px;
}
div.header {
   background-color:#000066;
   vertical-align:top;
}
div.header img {
	vertical-align:top;
}
div.header a.a {
	color:white;
	padding:5px;
	background-color:#0033CC;
}
div.content {
	padding:0px 5px;
	max-width:800px;
	margin-left:auto;
	margin-right:auto;
}
div.content p a {
	background-color:#eee;
	padding:4px;
	white-space: nowrap;
	margin:1px;
}
div.content p {
	text-align:center;
}
div.content p.stats, p.foot {
	font-size:0.8em;
}
div.content p.stats a, div.content p.foot a, div.potd p a {
	background-color:transparent;
}
div.content div.potd img {
	max-width:98%;
	height:auto;
}
div #whatis {
	max-width:500px;
	margin-left:auto;
        margin-right:auto;
}
h4 {
	margin-bottom:0;
	text-align:center;
}
h4 a {
	color:gray;	
}
div.potd {
	max-width:400px;
	margin-left:auto;
	margin-right:auto;
	background-color:white;
	border-radius:10px;
	text-align:center;
}
div.potd p {
	margin-top:0;
}
div.recent {
	overflow-x: scroll; 
	overflow-y: hidden;
	height:180px;
	-webkit-overflow-scrolling: touch;
	background-color:white;
	border-radius:3px;
}
div.recent>div {
	width:820px;
}
div.recent div div {
	float:left;
	width:150px;
	height:180px;
	padding-top:3px;
	padding-left:10px;
	text-align:center;
}
div.recent div div a {
}
.nowrap {
	white-space:nowrap;
}
form {
	padding:5px;
	background-color:#eee;
	margin-bottom:0;
}
form div {
	float:right;
}
ul.menu {
	position:absolute;
	top:0;
	right:0;
	width:70%;
	background-color:black;
	padding-top:10px;
	opacity:0.9;
}
ul.menu li {
	padding-bottom:10px;
}
ul.menu a {
	padding:10px;
	color:white
}
ul.menu li.close {
	text-align:right;
}

div.mopen {
	float:right;
	padding:5px;
}
div.mopen a {
	border:1px solid gray;
	border-radius:7px;
	color:white;
}
div.sponsor {
	background-color:white;
	border-radius:10px;
	text-align:center;
}
div.sponsor img {
	vertical-align:middle;
	padding:8px;
}
</style>
</head>
<body>
<div class="header">
<a target="_top" href="http://www.geograph.org.uk/?mobile=0"><img src="/img/logo.gif" height="40"></a>
        <div class="mopen"><a href="#" onclick="document.getElementById('menu').style.display='';return false;">menu</a></div>
</div>

<form action="http://www.geograph.org.uk/finder/of.php" onsubmit="window.location='http://m.geograph.org.uk/of/'+encodeUriComponent(this.elements['q'].value);return false;">
	<input type="search" name="q" placeholder="quick keywords search">
	<input type="submit" value="search">
	<div><a href="/links">Links</a></div>
</form>

<div class="content">

<p>The <b>Geograph<sup>&reg;</sup> Britain and Ireland</b> project aims to collect geographically representative photographs and information for every square kilometre of Great Britain and Ireland.</p>

<div class="potd">
<?

$titles = array(
                0=>'Photograph of the day',
                1=>'Photograph for today',
                2=>'Featured photograph',
                3=>"Today's photo",
                4=>'One photo',
                5=>'Selected photograph');
print "<h4>".$titles[array_rand($titles)]." <a href=\"http://www.geograph.org.uk/stuff/daily.php\">More</a></h4>";
print "<a href=\"http://m.geograph.org.uk/photo/{$data['potd']['gridimage_id']}\">{$data['potd']['thumbnail']}</a>";
print "<p><a href=\"http://m.geograph.org.uk/photo/{$data['potd']['gridimage_id']}\"><b>".htmlentities($data['potd']['image']['title'])."</b></a>, ";
print getFormattedDate($data['potd']['image']['imagetaken']);
print ", by <a href=\"http://m.geograph.org.uk/{$data['potd']['image']['profile_link']}\">".htmlentities($data['potd']['image']['realname'])."</a>";
print ", in <a href=\"http://m.geograph.org.uk/gridref/{$data['potd']['image']['grid_reference']}\">{$data['potd']['image']['grid_reference']}</a>";
?></div>

<p class="stats">Since 2005, <b class="nowrap"><? echo thousends($data['stats']['users']); ?> contributors</b> have submitted 
	<b class="nowrap"><? echo thousends($data['stats']['images']); ?> images</b> 
	<span class="nowrap">covering <b class="nowrap"><? echo thousends($data['stats']['squares']); ?> grid squares</b>, <br>
	or <b class="nowrap"><? echo $data['stats']['percentage']; ?>%</b> of the total squares</span>. 
        <b class="nowrap"><? echo thousends($data['stats']['fewphotos']); ?> photographed squares</b> with 
	<b class="nowrap">fewer than 4 photos</b>, <a href="http://www.geograph.org.uk/submit.php">add yours now</a>
</p>

<p><a href="#" onclick="document.getElementById('whatis').style.display='';return false;">What is Geographing?</a></p>
<div id="whatis">
&middot; It's a game - how many grid squares will you contribute?<br>
&middot; It's a geography project for the people<br>
&middot; It's a national photography project<br>
&middot; It's a good excuse to get out more!<br>
&middot; It's a free and open online community project for all<br>
<br>
<a href="http://www.geograph.org.uk/register.php">Registration</a> is free so come and join us and see how many grid squares you submit!<br>
<br>

<a href="http://www.geograph.org.uk/faq3.php?l=0">Frequently Asked Questions</a>
</div>

<h4>5 Recent Submitted Images <a href="http://www.geograph.org.uk/finder/recent.php">More</a></h4>
<div class="recent"><div><?

foreach ($data['recent'] as $image) {
	print "<div>";
	print "<a href=\"http://m.geograph.org.uk/photo/{$image['gridimage_id']}\">{$image['thumbnail']}</a>";
	print "<a href=\"http://m.geograph.org.uk/photo/{$image['gridimage_id']}\">".htmlentities($image['title'])."</a>";
	print ", by <a href=\"http://m.geograph.org.uk/{$image['profile_link']}\">".htmlentities($image['realname'])."</a>";
	print ", in <a href=\"http://m.geograph.org.uk/gridref/{$image['grid_reference']}\">{$image['grid_reference']}</a>";
	print "</div>";
}

?>
</div></div>

<p><a href="https://m.nearby.org.uk/gmap.php?dots=1">Mobile Coverage Map</a></b><br>
		<small>LONG-Press on the map, to view nearby images.</small></p>

<p><b>Please <a href="http://www.geograph.org.uk/help/donate">donate and support</a> the project</b></p>

<p class="foot">This site is archived for preservation by the <a href="http://www.webarchive.org.uk/ukwa/target/31653948">UK Web Archive project.</a></p>



<hr>
<p><a href="/links">Mobile Links Page</a></p>
<p><a href="http://www.geograph.org.uk/?mobile=0">View Desktop Site</a> - <a href="http://www.geograph.org.uk/article/About-Geograph-page">About Geograph</a></p>

<div class="sponsor">Project sponsored by <a href="https://www.ordnancesurvey.co.uk/education/" title="Geograph Britain and Ireland sponsored by Ordnance Survey"><img src="http://s1.geograph.org.uk/img/os-logo-p64.png" width="64" height="50" alt="Ordnance Survey"></a></div>

<p class="foot">Geograph<sup>&reg;</sup> Britain and Ireland is a project by <a href="http://www.geograph.org.uk/article/About-Geograph-page">Geograph Project Limited</a>, a Charity Registered in England and Wales, no 1145621. Company no 7473967. 
The registered office is 49 Station Road, Polegate, East Sussex, BN26 6EA.</p>



</div>

<ul class="menu" id="menu">
	<li class="close"><a href="#" onclick="document.getElementById('menu').style.display='none';return false;">close</a>
	<li><a href="/links">Search</a>
	<li><a href="https://m.nearby.org.uk/gmap.php?dots=1">Mobile Map</a>
	<li><a href="submit.php">Submit</a>
	<li><a href="http://www.geograph.org.uk/content/">Collections</a>
	<li><a href="http://www.geograph.org.uk/discuss/">Discussions</a>
	<li><a href="http://www.geograph.org.uk/finder/recent.php">Recent Images</a>

	<li><a href="http://www.geograph.org.uk/gallery.php">Gallery</a>
	<li><a href="http://www.geograph.org.uk/content/">Collections</a>
	<li><a href="http://www.geograph.org.uk/stuff/daily.php">Featured</a>

	<li><span class="nowrap"><a title="Twitter" href="http://twitter.com/geograph_bi">Twitter</a><img style="padding-left:2px;" alt="External link" title="External link - shift click to open in new window" src="/img/external.png" width="10" height="10"/></span>
	<li><span class="nowrap"><a title="Facebook" href="http://www.facebook.com/geograph.org.uk">Facebook</a><img style="padding-left:2px;" alt="External link" title="External link - shift click to open in new window" src="/img/external.png" width="10" height="10"/></span>
	<li><a href="http://www.geograph.org.uk/news.php">Project News</a>

	<li><a href="http://www.geograph.org.uk/help/sitemap">Sitemap</a>
	<li><a href="http://www.geograph.org.uk/content/documentation.php">Project Information</a>
	<li><a href="http://www.geograph.org.uk/contact.php">Contact Us</a>
</ul>




<script>
document.getElementById('menu').style.display='none';
document.getElementById('whatis').style.display='none';
</script>
</body>
</html>

<?

function thousends($in) {
	return number_format($in,0);
}

function getJSON($url) {
	$cache = "cache/".md5($url);
	if (file_exists($cache) && filemtime($cache) > time()-3600) {
		return json_decode(file_get_contents($cache),true);
	}
	$contents = file_get_contents($url);
	if (empty($contents) && file_exists($cache)) {
		return json_decode(file_get_contents($cache),true);
	} else {
		file_put_contents($cache,$contents);
	}
	return json_decode($contents,true);
}

function getFormattedDate($input) {
        list($y,$m,$d)=explode('-', $input);
        $date="";
        if ($d>0) {
                if ($y>1970) {
                        //we can use strftime
                        if (strlen($input) > 10)
                                $t=strtotime($input);
                        else
                                $t=strtotime($input." 0:0:0");//stop a warning
                        $date=strftime("%A, %e %B, %Y", $t);   //%e doesnt work on WINDOWS!  (could use %d)
                } else {
                        //oh my!
                        $t=strtotime("2000-$m-$d");
                        $date=strftime("%e %B", $t)." $y";
                }
        } elseif ($m>0) {
                //well, it saves having an array of months...
                $t=strtotime("2000-$m-01");
                if ($y > 0) {
                        $date=strftime("%B", $t)." $y";
                } else {
                        $date=strftime("%B", $t);
                }
        } elseif ($y>0) {
                $date=$y;
        }
        return $date;
}

