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
	padding:5px;
}
div.content a {
	background-color:#eee;
	padding:5px;
	white-space: nowrap;
	margin:1px;
}
div.footer {
	background-color:#000066;
	margin-top:6px;
	padding:5px;
}
div.footer a {
	color:white;
	white-space: nowrap;
	background-color:#0033CC;
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
div.desc {
  margin-left:auto;
  margin-right:auto;
  width:70%;
	font-size:0.9em;
}
div.searchbtn {
	float:right;
	width:2em;
}
div.searchbtn a {
	color:white;
}
form#searchform {
	display:block;
	text-align:right;
}
form#searchform input[type=text] {
	width:50%;
}
</style>

</head>
<body>
<div class="header">
<div class="searchbtn"><a href="#" onclick="document.getElementById('searchform').style.display='';this.style.display='none';return false">&#128269;</a></div>
<a target="_top" href="http://m.geograph.org.uk/"><img src="http://s1.geograph.org.uk/templates/basic/img/logo.gif" height="40"></a>
- <a class=a href="<? echo empty($full_link)?"http://www.geograph.org.uk/?mobile=0":$full_link; ?>">View Desktop Site</a>
</div>
<form action="/of/" id="searchform" style="display:none" onsubmit="location.href='/of/'+encodeURIComponent(this.q.value);return false">
	Search:<input type="text" name="q" placeholder="keyword search"><input type=submit value="go">
</form>

