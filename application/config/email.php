<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
| -------------------------------------------------------------------
| EMAIL CONFIG
| -------------------------------------------------------------------
| Konfigurasi email keluar melalui mail server
| */  
$config['protocol']='smtp'; 
$config['smtp_port']='25'; 
$config['smtp_timeout']='30'; 
$config['charset']='utf-8'; 
$config['newline']="\r\n"; 
$config['mailtype']="html"; 

//$config['smtp_host']='ssl://smtp.googlemail.com'; 
//$config['smtp_user']='adam.prasetia@gmail.com'; 
//$config['smtp_pass']='alfatihah'; 

$config['smtp_host']='mail.adirect.web.id'; 
$config['smtp_user']='adam@adirect.web.id'; 
$config['smtp_pass']='Pr4set14'; 

//$config['smtp_host']='ssl://mail.marlboro.co.id'; 
//$config['smtp_user']='info@marlboro.co.id'; 
//$config['smtp_pass']='$w0uhQF_Gmg-PM4Q'; 

//$config['smtp_host']='ssl://mail.amild.com'; 
//$config['smtp_user']='info@amild.com'; 
//$config['smtp_pass']='$d%z=+WG[=^Cktpd'; 

   
/* End of file email.php */ 
/* Location: ./system/application/config/email.php */