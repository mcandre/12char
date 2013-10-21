<?php
if(isset($metayes))
	$extra = "<meta name = 'description' content = 'Share BitTorrent Syncs here. Find pics, music, movies and more!'>";
else
	$extra = "";
echo"
<!DOCTYPE html>
<html lang='en'>
	<link href='bootstrap.css' rel='stylesheet'>
    <link href='todc.css' rel='stylesheet'>
	<link rel = 'shortcut icon' href = '/favicon.ico' type = 'image/x-icon' />
	<meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>
	".$extra."
	<title>12char</title>
	";
?>

	
