<?php 
$page_title = "Results";
$canonical = "http://www.geograph.org.uk/search.php";
include ".header.php"; ?>

<div class="content">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript"></script>


<form action="http://www.geograph.org.uk/search.php">
	<div style="float:left;width:48%">
		<b>Search Images</b> ... Near: <br>
		<input type="text" name="latlong" value="" placeholder="(optional latitude/longitude)" id="loc" style="width:98%"><br/>
		<input type=button value="(Find My Location)" style="font-size:0.7em" onclick="getLocation()">
	</div>
	<div style="float:left;width:48%">
		Matching Keywords:<br/> <input type="text" name="searchtext" size="20" placeholder="(optional keywords)" style="width:98%"><br/>
		<input type="submit" value="Image search &gt;&gt;" style="font-weight:bold">
	</div>
	<br style="clear:both">
	<input type="hidden" name="do" value="1"><input type="hidden" name="displayclass" value="mobile">
</form>


<ul id="list"></ul>


<script>
$(function() {
  $.ajax({
    url: "http://www.geograph.org.uk/stuff/searches.json.php",
    xhrFields: { withCredentials: true },
    success: function(data) {
			if (data) {
				$.each(data,function(idx,row){
				  if (!row['count'])
				  	row['count'] = '';
					$('ul#list').append('<li><a href="http://www.geograph.org.uk/search.php?i='+row['id']+'&displayclass=mobile">'+row['count']+' images'+row['searchdesc']+'</a></li>');
				});
			}
		}
	});
});
</script>


</div>

<?php include ".footer.php"; ?>