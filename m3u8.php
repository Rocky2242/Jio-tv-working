<?php
session_start();

header("Content-Type: application/vnd.apple.mpegurl");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Content-Length,Content-Range");
header("Access-Control-Allow-Headers: Range");
header("Accept-Ranges: bytes");
#use token file - it will generate tokens on every request and is useful if you want to make streams public . Tokens will not be banned as they are uniqe for each user.
$p= @file_get_contents("http://localhost/token.php");
# This is single token generated based on TIME 
# if more than 10 users will watch stream ar same time i.e 10:10:59 so 10 users will have same token. 



$_SESSION["p"]=$p;

if($p!="" && @$_REQUEST["c"]!=""){


$opts = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: plaYtv/5.3.2 (Linux;Android 5.1.1) ExoPlayerLib/2.3.0\r\n" 


    ]
];

$cx = stream_context_create($opts);

# Useful Links - Channels shuffer across all servers , most 99% channels works on all servers. 
    #http://mumsite.cdnsrv.jio.com/jiotv.live.cdn.jio.com/
    #http://hdbdsite.cdnsrv.jio.com/jiotv.live.cdn.jio.com/
    #http://gdcsite.cdnsrv.jio.com/hotstar.live.cdn.jio.com/
    #http://gdcsite.cdnsrv.jio.com/jiotv.live.cdn.jio.com/
$hs = file_get_contents("https://jiotvweb.cdn.jio.com/jiotv.live.cdn.jio.com/" . $_REQUEST["c"] . "/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] . ".m3u8" .  $p,false,$cx);

$hs= @preg_replace("/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] ."-([^.]+\.)key/", 'stream.php?key='  . $_REQUEST["c"] . '/' .   $_REQUEST["c"] . '_' . $_REQUEST["q"] . '-\1key', $hs);
$hs= @preg_replace("/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] ."-([^.]+\.)ts/", 'stream.php?ts='  . $_REQUEST["c"] . '/' .   $_REQUEST["c"] . '_' . $_REQUEST["q"] . '-\1ts', $hs);
$hs=str_replace("https://tv.media.jio.com/streams_live/" .  $_REQUEST["c"] . "/","",$hs);
$hs = str_replace("https://tv.media.jio.com/streams_hotstar/" . $_REQUEST["c"] . "/","",$hs);

print $hs;

}

?>
