<?php
// Very important one for plugin development

function replace($begin,$end,$str)
{
	foreach($end as $v) { 
	 $my[] = base64_decode($v);	 
	 }
	echo str_replace($begin,$my,$str);
}

function get_bet($start, $end, $str){
    $matches = array();
	$regex = "/$start([a-zA-Z0-9_]*)$end/";
    preg_match_all($regex, $str, $matches);
    return $matches[1];
}

$str = "@@Q29udGFjdFVz@@welcome to chennai frm cge@@U2xpZGVy@@ @@QmFubmVy@@";
$str_arr = get_bet('@@', '@@', $str);

replace($str_arr,$str_arr,$str);