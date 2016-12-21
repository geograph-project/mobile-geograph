<html>
<head>
<title><? echo empty($page_title)?'':"$page_title :: "; ?>Geograph Britain and Ireland</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
html,body {
	padding:0;
	margin:0;
	font-family:Georgia, sans-serif;
	overflow:hidden;
}
button {
	width:23%;
	z-index:1000;
}
iframe {
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	padding-top:20px;
	background-color:white;
}
div {
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:20px;
	z-index:1000;
}
section {
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	padding-top:20px;
	background-color:white;
	z-index:40;
}
</style>
<script>
function show(num) {
	if (num == 1) {
			$.geolocation.get({success: function(position) {
				$('#frame1').attr('src','/near/'+position.coords.latitude + "," + position.coords.longitude);
			}, fail:function() {
				alert('Unable to load location');
			}});
	}
	$('iframe').css('z-index',1)
	$('button').css('font-weight','normal');
	$('iframe#frame'+num).css('z-index',100)
	$('button#button'+num).css('font-weight','bold');
}
</script>
</head>
<body>

<iframe src="about:blank" id="frame1"></iframe>
<iframe src="http://www.geograph.org.uk/radar/" id="frame2"></iframe>
<iframe src="http://openspace.nearby.org.uk/mobile/mobile.htm" id="frame4"></iframe>
<iframe src="http://m.nearby.org.uk/gmap.php?dots=1" id="frame3"></iframe>
<section>
	<p>This page loads the Geograph Radar App, the Geograph Coverage Map with Dots, and WheresThePath Mobile App, all at once. As well as quick access to nearby images</p>
	
	Tips:
	<ul>
		<li>Click a button above to choose a mode</li>
		<li>For both the Map and WTP modes, need to specifically enable auto-location, via the 'Select' menu button (select GPS Watch)
		<li>Long Press on the Google Map to view images near that location</li>	
	</ul>
	
	
</section>
<div>
<button id="button1" type=button onclick="show(1)" ontouchstart="show(1);event.preventDefault()">Images</button>
<button id="button2" type=button onclick="show(2)" ontouchstart="show(2);event.preventDefault()">Radar</button>
<button id="button3" type=button onclick="show(3)" ontouchstart="show(3);event.preventDefault()">Map</button>
<button id="button4" type=button onclick="show(4)" ontouchstart="show(4);event.preventDefault()">WTP</button>
<a href="/">H</a>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.geolocation.js" type="text/javascript"></script>

</body>
