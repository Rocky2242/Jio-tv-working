<?php
$jctBase = "cutibeau2ic";
$ssoToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmlxdWUiOiI0NWU1OTMzMC1mZmQ4LTRjNmMtOTk4NS1mZTg5ZjIyMjMyZWIiLCJ1c2VyVHlwZSI6IlJJTHBlcnNvbiIsImF1dGhMZXZlbCI6IjQwIiwiZGV2aWNlSWQiOiJjNDMyMTNhOGMzYjljNTAxYzI4MDY1NjRiYzNkNjlhNDkwY2IwZDdiOTM0MzI4MDQ5Mzk1MTU0Mzk3NmViOTM2ZDcxNmZmZTMwYmNjM2UxOWU1MTMzZjNiNTg1MjNiNGY3OGU0YWMxYjFhYzc4MTVjNTNjMTE5MDBkYTM0ZTEwZCIsImp0aSI6ImI3MDNhOTY5LTJkYWYtNDUyMy05NWUzLWI1NTFjNDhjMmVhNyIsImlhdCI6MTYyMDM5NjE4NX0.VQt-ZNhqZBl3x-DzvLP08KNCwh8VA2Z3x1fyvpwn9hE";
function tokformat($str)
{
$str= base64_encode(md5($str,true));
return str_replace("\n","",str_replace("\r","",str_replace("/","_",str_replace("+","-",str_replace("=","",$str)))));
}
function generateJct($st, $pxe) 
{
 global $jctBase;
 return trim(tokformat($jctBase . $st . $pxe));
}
function generatePxe() {
return time() + 6000000;
}
function generateSt() {
global $ssoToken;
return tokformat($ssoToken);
}
function generateToken() {
$st = generateSt();
$pxe = generatePxe();
$jct = generateJct($st, $pxe);
return "?jct=" . $jct . "&pxe=" . $pxe . "&st=" . $st;
}
echo generateToken();
?>
