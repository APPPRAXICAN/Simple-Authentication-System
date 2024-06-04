<?php
namespace Mail ;
ob_start();
include('mail.php');
$msg = ob_get_contents();
ob_clean();
$headers= array(
    'MIME-Version' => '1.0',
    'Content-Type' => 'text/html;charset=UTF-8',
);
return [
    'msg' =>$msg,
    'headers' =>$headers
];