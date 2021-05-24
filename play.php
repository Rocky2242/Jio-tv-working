<html>
<head>
<title>STREAMSAW LIVE STREAMING</title>
<script type="text/javascript" src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script src="https://cdn.plyr.io/2.0.18/plyr.js"></script>
<link rel="stylesheet" href="https://cdn.plyr.io/2.0.18/plyr.css">
</head>
<body>
<div id="player">
<video id="video" style="width:100%;height:97%;object-fit: fill;"></video>
</div>
<script>
var url="m3u8.php?c=<?php echo $_REQUEST["c"]; ?>&q=<?php echo $_REQUEST["q"]; ?>&e=junk.m3u8";

plyr.setup(video);

 if(Hls.isSupported()) {
    var video = document.getElementById('video');
    var hls = new Hls();
    hls.loadSource(url);
    hls.attachMedia(video);
    hls.on(Hls.Events.MANIFEST_PARSED,function() {
      video.play();
  });
 }
  else if (video.canPlayType('application/vnd.apple.mpegurl')) {
    video.src = url;
    video.addEventListener('canplay',function() {
      video.play();
    });

  }


</script>

</body>
</html>
