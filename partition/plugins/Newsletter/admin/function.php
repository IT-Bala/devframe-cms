<?php
function current_theme_url_news(){
	return '../'.THEME_PATH_PREFIX().THEME_BASE().'/'.basename(__DIR__).'/';
}
function tables(){
	query("CREATE TABLE IF NOT EXISTS ".DATABASE.".".DB_PREFIX."newsletter (
		`news_id` INT NOT NULL AUTO_INCREMENT ,
		`news_email` VARCHAR( 255 ) NOT NULL ,
		`news_subject` VARCHAR( 255 ) NOT NULL ,
		`news_msg` VARCHAR( 255 ) NOT NULL ,
		`news_date` VARCHAR( 255 ) NOT NULL ,
		`status` VARCHAR( 255 ) NOT NULL ,
		PRIMARY KEY ( `news_id` )
		) ENGINE = InnoDB");
}
function Get_All_User_Email(){ $email = array();
	$slt = select("dev_user"); // u_email
    while($Ft = fetch($slt)){ $email[]=$Ft->u_email; }
	return $email;
}
function send_newsletter(){ $msg ='';
    if(!empty($_REQUEST['news_email']) && !empty($_REQUEST['news_subject']) && !empty($_REQUEST['news_msg'])){
		$emails = '';
		foreach($_REQUEST['news_email'] as $email){
			$emails = implode(',',$email);
				query("insert into ".DB_PREFIX."newsletter set 
				news_email = '".$email."',
				news_msg = '".$_REQUEST['news_msg']."',
				news_date = now(),
				status = '1'
				");
		}
	
		$to      = $emails;
		$subject = $_REQUEST['news_subject'] ;
		$message = $_REQUEST['news_msg'] ;
		$header = "From: qwiknote@info.com\r\n"; 
		$header.= "MIME-Version: 1.0\r\n"; 
		$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
		$header.= "X-Priority: 1\r\n"; 
		#mail($to,$subject,$message,$headers);
		$msg = success('Newsletter has been sent successfully!');
	}else{ $msg = error('Please fill required fields!');}
	return $msg;
}

function delete_newsletter(){$msg='';
		if(isset($_REQUEST['news_id'])&& ($_REQUEST['news_id']!='')){ $id = $_REQUEST['news_id'];
			if(query("delete from ".DB_PREFIX."newsletter where news_id=".$id)){
				$msg = success("Newsletter has been deleted !");
			}			
		}return $msg;
	}
