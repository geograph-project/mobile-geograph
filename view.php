<?php 
//$_GET['id'] = 19;
if (!empty($_GET['id'])) {
	$id = intval($_GET['id']);

	$url = "http://api.geograph.org.uk/api-facetql.php?where=id=$id&select=*&limit=1";
	$raw = file_get_contents($url); //todo add caching!

	if (strlen($raw) > 10) {
		$decoded = json_decode($raw);

		if (!empty($decoded->rows) && count($decoded->rows) == 1) {
			$row = $decoded->rows[0];
			
			$page_title = he($row->title)." &copy; ".he($row->realname);
	
			if ($row->scenti < 2000000000) { 
				$canonical = "http://www.geograph.org.uk/photo/$id";
				$full_link = "http://www.geograph.org.uk/photo/$id?mobile=0";
			} else {
				$canonical = "http://www.geograph.ie/photo/$id";
				$full_link = "http://www.geograph.ie/photo/$id?mobile=0";
			}

			$ll = sprintf("%.6f,%.6f",rad2deg($row->wgs84_lat),rad2deg($row->wgs84_long));

		} else {
			 $error = "unable to load image - please try later or try <a href=\"http://www.geograph.org.uk/photo/$id\">http://www.geograph.org.uk/photo/$id</a>"; 
			 $id = 0;
		}

	} else {$id = 0; $error = "unable to load image - please try later"; }

} else {
	$error = "page not found";
}

include ".header.php"; 

?>

<div class="content" align=center>

<? if ($id) { ?>
	<h2><a href="/gridref/<? echo $row->grid_reference; ?>"><? echo $row->grid_reference; ?></a> :: 
		<? echo he($row->title); ?></h2>
	<h4>Taken in <a href="/near/<? echo $row->grid_reference; ?>?filter=@takenyear+<? echo $row->takenyear; ?>"><? echo $row->takenyear; ?></a> by <a href="/profile/<? echo $row->user_id; ?>"><? echo he($row->realname); ?></a> <small>near <? echo he($row->place); ?>, <? echo he($row->county); ?>, <? echo he($row->country); ?></small></h4>
	
	<p align="center"><img src="<? echo ($fullurl = getGeographUrl($id,$row->hash,'full')); ?>" style="max-width:100%" alt="<? echo he($row->title); ?> by <? echo he($row->realname); ?>"><br>
	<b><? echo he($row->title); ?></b></p>
	
	<?
	flush();
		
	$url = "http://www.geograph.org.uk/stuff/description.json.php?id=$id";
	$raw = file_get_contents($url); //todo add caching!
	if (strlen($raw) > 10) {
		$decoded = json_decode($raw);
		
		if (!empty($decoded->comment)) {
			print "<div class=\"desc\">{$decoded->comment}</div>";
		} 
		if (!empty($decoded->snippets)) {
			if (count($decoded->snippets) == 1 && empty($decoded->comment)) {
				print "<div class=\"desc\">{$decoded->snippets[0]->comment}</div>";
				$url = "/near/{$row->grid_reference}?filter=[snippet:".urlencode($decoded->snippets[0]->title)."]";
				print "<div class=\"desc\">See other images of <a href=\"$url\">{$decoded->snippets[0]->title}</a></div>";
			} else {
				foreach ($decoded->snippets  as $snippet) {
					$url = "/near/{$row->grid_reference}?filter=[snippet:".urlencode($snippet->title)."]";
					print "<div class=\"desc\" align=left><a href=\"$url\"><b>{$snippet->title}</b></a>";
					if (!empty($snippet->comment))
						print "<blockquote>{$snippet->comment}</blockquote>";
					print "</div>";
				}
			}
		}
		
	}
	
	?>
	
	
	
	
	<div align="center" class="ccmessage"><a rel="license" href="http://creativecommons.org/licenses/by-sa/2.0/"><img alt="Creative Commons Licence [Some Rights Reserved]" src="http://creativecommons.org/images/public/somerights20.gif"></a> &nbsp; © Copyright <a title="View profile" href="/profile/<? echo $row->user_id; ?>" xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName" rel="cc:attributionURL dct:creator"><? echo he($row->realname); ?></a> and
licensed for <a href="http://www.geograph.org.uk/reuse.php?id=<? echo $id; ?>">reuse</a> under this <a rel="license" href="http://creativecommons.org/licenses/by-sa/2.0/" class="nowrap" about="<? echo $fullurl; ?>" title="Creative Commons Attribution-Share Alike 2.0 Licence">Creative Commons Licence</a>.</div>


<div  align="center" style="margin:10px;padding:5px;border-bottom:1px solid gray;font-size:0.8em;">
	· <a href="http://www.geograph.org.uk/reuse.php?id=<? echo $id; ?>">Find out <b>How to reuse</b> this image</a> ·

	Share: 
	<a title="Share this photo via Twitter" href="https://twitter.com/intent/tweet?text=<? echo urlencode($row->title); ?>+by+<? echo urlencode($row->realname); ?>&amp;url=http://www.geograph.org.uk/photo/<? echo $id; ?>" onclick="window.open(this.href,'share','width=500;height=400'); return false;"><img alt="Twitter" src="http://s1.geograph.org.uk/img/twitter_16.png" width="16" height="16" style="vertical-align:middle"></a>
	<a title="Share this photo via Facebook" href="https://www.facebook.com/sharer/sharer.php?u=http://www.geograph.org.uk/photo/<? echo $id; ?>" onclick="window.open(this.href,'share','width=500;height=400'); return false;"><img alt="Facebook" src="http://s1.geograph.org.uk/img/facebook_16.png" width="16" height="16" style="vertical-align:middle"></a>
	<a title="Share this photo via Google Plus" href="https://plus.google.com/share?url=http://www.geograph.org.uk/photo/<? echo $id; ?>&amp;t=<? echo urlencode($row->title); ?>+by+<? echo urlencode($row->realname); ?>" onclick="window.open(this.href,'share','width=500;height=400'); return false;"><img alt="Google Plus" src="http://s1.geograph.org.uk/img/googleplus_16.png" width="16" height="16" style="vertical-align:middle"></a>
	<a title="Share this photo via Pinterest" href="http://www.pinterest.com/pin/create/button/?media=<? echo $fullurl; ?>&amp;url=http://www.geograph.org.uk/photo/<? echo $id; ?>&amp;description=<? echo urlencode($row->title); ?>+by+<? echo urlencode($row->realname); ?>" onclick="window.open(this.href,'share','width=500;height=400'); return false;"><img alt="Pinterest" src="http://s1.geograph.org.uk/img/pinterest_16.png" width="16" height="16" style="vertical-align:middle"></a>
	<a title="Share this photo via Flipboard" href="https://share.flipboard.com/bookmarklet/popout?v=2&amp;title=<? echo urlencode($row->title); ?>+by+<? echo urlencode($row->realname); ?>&amp;url=http://www.geograph.org.uk/photo/<? echo $id; ?>" onclick="window.open(this.href,'share','width=500;height=400'); return false;"><img alt="Flipboard" src="http://s1.geograph.org.uk/img/flipboard_16.png" width="16" height="16" style="vertical-align:middle"></a>
	<a title="Send an this via email/e-card" href="http://www.geograph.org.uk/ecard.php?image=<? echo $id; ?>"><img src="http://s1.geograph.org.uk/img/email_16.png" width="16" height="16" style="vertical-align:middle"></a> ·

	<a href="http://www.geograph.org.uk/reuse.php?id=<? echo $id; ?>"><img src="http://s1.geograph.org.uk/img/download_16.png" width="16" height="16" style="vertical-align:middle"> <b>Download Image</a></b> ·
	
	<? if ($row->original) { ?> 
		<a href="http://www.geograph.org.uk/more.php?id=<? echo $id; ?>">Larger Sizes</a>
	<? } ?>
</div>

<p align="center"><small>(click any of the following to view more images)</small></p>

		<div style="float:right">
			<iframe src="http://www.geograph.org.uk/map_frame.php?id=<? echo $id; ?>&hash=<? echo $row->hash; ?>"
			width=256 height=256 frameborder=0></iframe><br>
			<? if (strpos($full_link,'org.uk')) { ?><a href="http://www.geograph.org.uk/showmap.php?gridref=<? echo $row->grid_reference; ?>" target="_blank">popup map</a><? } ?>
			<a href="http://m.nearby.org.uk/gmap.php?dots=1#ll=<? echo $ll; ?>&z=15&t=t">coverage map</a>
			<a href="http://maps.google.com/maps?daddr=loc:<? echo $ll; ?>">navigate</a>
		</div>


<table align="center" cellpadding=5>
	<tr>
		<th>Subject Grid Square</th>
		<td><a href="/gridref/<? echo $row->grid_reference; ?>"><? echo $row->grid_reference; ?></a></td>
	</tr>
	<tr>
		<th>Subject Lat/Long</th>
		<td><a href="/near/<? echo $ll; ?>"><? echo $ll; ?></a>
		</td>
	</tr>
	<tr>
		<th>Near</th>
		<td><a href="/near/<? echo $row->grid_reference; ?>?filter=@place+<? echo urlencode($row->place); ?>"><? echo he($row->place); ?></a>, 
			<a href="/near/<? echo $row->grid_reference; ?>?filter=@county+<? echo urlencode($row->county); ?>"><? echo he($row->county); ?></a>, 
			<a href="/near/<? echo $row->grid_reference; ?>?filter=@country+<? echo urlencode($row->country); ?>"><? echo he($row->country); ?></a></td>
	</tr>
	<tr>
		<th>Photographer</th>
		<td><b><a href="http://www.geograph.org.uk/search.php?gridref=<? echo $row->grid_reference; ?>&user_id=<? echo $row->user_id; ?>&do=1&displayclass=mobile"><? echo he($row->realname); ?></a></b></td>
	</tr>
	<tr>
		<th>Taken</th>
		<td><a href="/near/<? echo $row->grid_reference; ?>?filter=@takenday+<? echo $row->takenday; ?>"><? echo $row->takenday; ?></a>
		<a href="/near/<? echo $row->grid_reference; ?>?filter=@takenmonth+<? echo $row->takenmonth; ?>"><? echo $row->takenmonth; ?></a>
		<a href="/near/<? echo $row->grid_reference; ?>?filter=@takenyear+<? echo $row->takenyear; ?>"><? echo $row->takenyear; ?></a></td>
	</tr>
	<tr>
		<th>Submitted</th>
		<? $submited = date('Y-m-d',$row->submitted); ?>
		<td><a href="http://www.geograph.org.uk/search.php?gridref=<? echo $row->grid_reference; ?>&submitted_start=<? echo $submited; ?>&amp;submitted_end=<? echo $submited; ?>&do=1&displayclass=mobile"><? echo $submited; ?></a></td>
	</tr>
	<? foreach(array('snippet','context','subject','tag','bucket','group','term') as $key) {
		if (!empty($row->{$key.'_ids'})) { ?>
			<tr>
					<th><? print ucfirst($key); ?></th>
					<td><? 
					$list = explode(' _SEP_ ',preg_replace('/^_SEP_ | _SEP_$/','',$row->{$key.'s'}));
					foreach ($list as $idx => $item) {
						switch($key) {
							case 'snippet': 
								$ids = explode(",",$row->{$key.'_ids'});
								$url = "/snippet/".$ids[$idx];
								$url = "/near/{$row->grid_reference}?filter=[snippet:".urlencode($item)."]";
								break;
							case 'context':
								$url = "/tagged/top:".urlencode($item);
								$url = "/near/{$row->grid_reference}?filter=[top:".urlencode($item)."]";
								break;
							case 'bucket':
								$url = "/tagged/bucket:".urlencode($item);
								$url = "/near/{$row->grid_reference}?filter=[bucket:".urlencode($item)."]";
								break;
							case 'tag':
								$url = "/tagged/".urlencode($item);
								$url = "/near/{$row->grid_reference}?filter=[".urlencode($item)."]";
								break;
							case 'group':
							case 'term':
								$url = "/near/{$row->grid_reference}?filter=@{$key}s+%22_SEP_+".urlencode($item)."+_SEP_%22";
								$url = "/near/{$row->grid_reference}?filter=[$key:".urlencode($item)."]";
								break;
						}
						print "<a href=\"$url\">".he($item)."</a> &middot; ";
					}
					?></td>
			</tr>
		<? }
		
	
	} ?>
</table>

<hr>
<p align="center">View full page at <a href="<? echo $full_link; ?>">geograph.org.uk/photo/<? echo $id; ?></a></p>

<? } else {
	print $error;
} ?>
</div>

<?php include ".footer.php";

function he($in) {
	return htmlentities($in);
}
function getGeographUrl($gridimage_id,$hash,$size = 'small') {
	$ab=sprintf("%02d", floor(($gridimage_id%1000000)/10000));
	$cd=sprintf("%02d", floor(($gridimage_id%10000)/100));
	$abcdef=sprintf("%06d", $gridimage_id);
	if ($gridimage_id<1000000) {
		$fullpath="/photos/$ab/$cd/{$abcdef}_{$hash}";
	} else {
		$yz=sprintf("%02d", floor($gridimage_id/1000000));
		$fullpath="/geophotos/$yz/$ab/$cd/{$abcdef}_{$hash}";
	}
	$server =  "http://s".($gridimage_id%4).".geograph.org.uk";

	switch($size) {
		case 'full': return "http://s0.geograph.org.uk$fullpath.jpg"; break;
		case 'med': return "$server{$fullpath}_213x160.jpg"; break;
		case 'small':
		default: return "$server{$fullpath}_120x120.jpg";

	}
}






