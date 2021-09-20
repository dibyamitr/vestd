<?php
include_once "core/Functions.php";
$fn=new Functions();

$page=$_REQUEST['page'];
include_once "page/".$page.".php";