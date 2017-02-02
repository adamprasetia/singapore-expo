<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function greeting(){
	$jam = date('H');
	if($jam < 10){
		return "Selamat Pagi";
	}else if($jam < 14){
		return "Selamat Siang";
	}else{
		return "Selamat Sore";
	}
}
function send_email($id){
	if($id==1){
		return '<span class="glyphicon glyphicon-envelope"></span>';
	}
}
function status_data($id=null){
	$data = array(
		''=>'-Status Data-'
		,1=>'ONPROSES'
		,2=>'VALID'
		,3=>'AUDIT'
	);
	if(is_null($id)){
		return $data;
	}else if($id==0){
		return "";
	}else{
		return $data[$id];		
	}
}
function status_phone($id=null){
	$data = array(
		''=>'-Status Phone-'
		,1=>'NO ANSWER'
		,2=>'REJECT'
		,3=>'BUSY'
		,4=>'WRONG NUMBER'
		,41=>'FOREIGN NUMBER'
		,5=>'CALL BACK'
		,6=>'ATTEND'
		,7=>'CONSIDER ATTENDING'
		,8=>'NOT ATTEND'
	);
	if(is_null($id)){
		return $data;
	}else if($id==0){
		return "";
	}else{
		return $data[$id];		
	}
}
function sort_icon($order_type){
	if($order_type=='asc'){
		return '<span class="glyphicon glyphicon-arrow-up"></span>';
	}else{
		return '<span class="glyphicon glyphicon-arrow-down"></span>';
	}
}
function format_tanggal($date){
	if($date <> '0000-00-00' && $date <> '' && $date <> null && $date <> '0000-00-00 00:00:00'){
		return date_format(date_create($date),'d/m/Y');
	}
}
function format_tanggal_barat($date){
	if($date <> '0000-00-00' && $date <> '' && $date <> null && $date <> '0000-00-00 00:00:00'){
		$tgl = explode('/',$date);
		return $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
	}
	return '';
}