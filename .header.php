<html>
<head>
<title><? echo empty($page_title)?'':"$page_title :: "; ?>Geograph Britain and Ireland</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <? if (!empty($canonical)) { ?>
    <link rel="canonical" href="<? echo $canonical; ?>" />
 <? } ?>
<style>
html,body {
	padding:0;
	margin:0;
	font-family:Georgia, sans-serif;
	line-height:1.5em;
}
a {
   text-decoration:none;
   padding:3px;
}
div.header {
   background-color:#000066
}
div.header a {
	color:white;
}
div.content {
	padding:5px;
}
div.content a {
	background-color:#eee;
	padding:5px;
	white-space: nowrap;
	margin:1px;
}
h4 small {
white-space: nowrap;
}
form {
	background-color:#eee;
}
form input {
	margin:2px;
}
ul {
	margin:0;
	padding:10px;
}
li {
   color:gray;
   padding:3px;
   line-height:1.3em;
   margin-bottom:6px;
}
#thumbs a {
	background-color:inherit;
	padding:0;
}
table {
	line-height:1.5em;
}
</style>

</head>
<body>
<div class="header">
<a target="_top" href="http://m.geograph.org.uk/"><img src="http://s1.geograph.org.uk/templates/basic/img/logo.gif" height="50"></a>
- <a href="<? echo empty($full_link)?"http://www.geograph.org.uk/?mobile=0":$full_link; ?>">View Desktop Site</a>
</div>
