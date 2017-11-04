<?php
class plug_load{
 public function code($end){ $dev_plugin=array();
	  /*foreach(glob("partition/plugins/*") as $files){
			$explode = explode("partition/plugins/",$files);
			$path[] = $explode[1];	
		}	  
	  foreach($end as $v){ $check = str_replace('@@','',$v);
		if(in_array($check,$path)){
		   $PPATH = 'partition/plugins/'.$check;
			if(file_exists($PPATH.'/index.php')){
				$status_code = '[STATUS:TRUE]';
				chmod($PPATH.'/status.php',0777);
				$data = file_get_contents($PPATH.'/status.php');
				if(strpos($data,$status_code)===false){ 
				 #PLUG INACTIVE
				 }else{
					ob_start();
			         require("partition/plugins/".$check.'/index.php');
				    $dev_plugin[] = ob_get_clean();
				 }
			  }	 
	  
		   }
	    }
		return $dev_plugin;*/
	  # DONT DELETE IT [ IT IS USING FOR FOLDER SHORT CODE PURCPOSE ] ## [ Not User Define It will take folder name as short cose]
  }
  
  public function Pcode($short){ $dev_plugin=array(); # DONT DELETE IT [ IT IS USING FOR short_code.txt user defined SHORT CODE PURCPOSE ]
			if(count($short)!=''){
			$PL = explode('/',INTER);
			$Plug_path = $PL[0].'/plugins/';
			if(is_dir($Plug_path)){
				
				foreach(glob($Plug_path.'*',GLOB_ONLYDIR) as $file){ 
				$current = $file.'/short_code.txt';
				$PPATH = $file.'/status.php';
				if(file_exists($current)){
					$data = file_get_contents($current);
					
					foreach($short as $code){ 
						$plug_code = str_replace("@@","",$code);
						$sql = db()->query("select * from ".DB_PREFIX."plugins WHERE plugin='".$plug_code."'");		
				 		if($sql->num_rows==1){
							$fetch = fetch_once(DB_PREFIX."plugins","plugin='".$plug_code."'");
							if($fetch->status==1){
								if(strpos($data,$plug_code)===false){ # Sorry short code is not found!
								
								 }else{ 
								 	ob_start();
									 require($file.'/index.php'); 
									 $dev_plugin[] = ob_get_clean();
								  }
							 }
						}
					}
					
				}else{ $dev_plugin=error('Plugin Structure Invalid!'); }
				}
			  }
			}
			return $dev_plugin;
  }
}
$plug = new plug_load;
?>
