<?php
error_reporting(E_ALL);
include_once "core/Functions.php";
$fn=new Functions();
$req=$_GET;
$post=$_POST;

$result=array();

if($req['apikey']=="cd8b3804baa648d4fa3b8f9e6f4ef993")
{
    if($req['method']=="setshorturl")
    {
        $sql="call seturlshort('".$post['url']."')";
        $row=$fn->runAnyProcedure($sql);
        $result['data']=$row->getshortcode;
        $result['status']=200;
        $result['msg']="Shortcode generated successfully";
    }
    elseif($req['method']=="callfullurl")
    {
        $arr=array('id','fullurl');
        $where=array('shortcode'=>$post['shortcode']);
        $res=$fn->selSingleRow($arr,'urlshort',$where);
        if(isset($res) and !empty($res))
        {
            $urlid=$res->id;
            $fieldvar=array('urlid'=>$urlid);
            $fn->userQuery($fieldvar,'urltrack',NULL,'i');

            $result['data']=$res->fullurl;
            $result['status']=200;
            $result['msg']="URL retrieved successfully";
        }
        else
        {
            $result['status']=400;
            $result['msg']="Bad Request";
        }
    }
    elseif($req['method']=="urltrackrecord")
    {
        $arr=array('fullurl','tracked');
        $where=array('shortcode'=>$post['shortcode']);
        $res=$fn->selSingleRow($arr,'view_urlshort',$where);
        if(isset($res) and !empty($res))
        {
            $arr=array("url"=>$res->fullurl,"track_status"=>$res->tracked);
            $result['data']=$arr;
            $result['status']=200;
            $result['msg']="URL status retrieved successfully";
        }
        else
        {
            $result['status']=400;
            $result['msg']="Bad Request";
        }
    }
    else
    {
        $result['status']=404;
        $result['msg']="No Page Found";
    }
}
else
{
    $result['status']=401;
    $result['msg']="Unauthorized Access";
}
echo json_encode($result);