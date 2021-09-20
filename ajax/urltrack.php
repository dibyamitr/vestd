<?php
include_once "../core/Functions.php";
$fn=new Functions();

$shorturl=$_POST['shorturl'];
$urlarr=explode('/',$shorturl);
$curl=$fn->baseurl('api/v1/cd8b3804baa648d4fa3b8f9e6f4ef993/track-url-record');
$post=array(
    "shortcode"=>end($urlarr)
);
$response = $fn->curlResponse('POST', $curl, $post);
echo $response;