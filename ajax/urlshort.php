<?php
include_once "../core/Functions.php";
$fn=new Functions();

$shorturl=$_POST['shorturl'];
$curl=$fn->baseurl('api/v1/cd8b3804baa648d4fa3b8f9e6f4ef993/set-short-url');
$post=array(
    "url"=>$shorturl
);
$response = json_decode($fn->curlResponse('POST', $curl, $post));
$response->data=$fn->baseurl("short/".$response->data);
echo json_encode($response);