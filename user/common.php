<?php
// PHP dev__ FRAMEWORK
class common extends site{
	public $width; public $height; public $request; public $js_validate; public $js_validate_;
	public function __construct(){
		$this->js_validate = '';
		$this->js_validate_ = '';
	}
	public function get($req){
		$value = '';
		$url = parse_url($_SERVER['REQUEST_URI']);
		if(array_key_exists('query',$url)){ // if variable passing
		if(!empty($req)){
		$conj = explode('&',$url['query']);
		if(stristr($url['query'],$req)==true){ // if variable is in this url
		$params = array();
		foreach ($conj as $param) {
			$item = explode('=', $param);
			$params[$item[0]] = $item[1];
		} 
		$value = $params[$req]; 
		}
		}else{
			$value = die("Request error in ".__FUNCTION__."() method");			
		}
		}
		return $value;
	}
	public function request($req){
		if(isset($_REQUEST[$req])){
		$req = $_REQUEST[$req];
		}else{ $req=''; }
		return $req;
	}
	public function post($req){
		if(isset($_POST[$req])){
		$req = $_POST[$req];
		}else{ $req=''; }
		return $req;
	}
	public function js(){
		$req ='';
		if( $args= func_get_args() ):
		foreach($args as $req){		
		 return '<script src="design/js/'.$req.'"></script>';
		}
		else:
		return $req;		
		endif;	
	}
	public function image(){
		$req ='';
		if( $args= func_get_args() ):
		foreach($args as $req){		
		 return $req = "design/images/".$req;
		}
		else:
		return $req;		
		endif;
	}
	public function required(){
		$val = func_get_args();	
		$this->js_validate = '<script type="application/javascript">
		function validation(){';	
		foreach($val as $valid){			
			$this->js_validate .= "
			var ".$valid."_dev=document.getElementsByName('".$valid."')[0];
			if(".$valid."_dev.value==''){
				alert('Please enter ".$valid."');
				".$valid."_dev.focus();
				return false;
			}";
		}
		$this->js_validate .= 'document.myform.submit();
		}
		</script>';
		return $this;
		
	}	
	public function validation(){
		return $this->js_validate;
	}
	public function required_(){
		$val = func_get_args();	
		$this->js_validate_ = '<script type="application/javascript">
		function validation_(){';	
		foreach($val as $valid){			
			$this->js_validate_ .= "
			var ".$valid."_dev=document.getElementsByName('".$valid."')[0];
			if(".$valid."_dev.value==''){
				alert('Please enter ".$valid."');
				".$valid."_dev.focus();
				return false;
			}";
		}
		$this->js_validate_ .= 'document.myform.submit();
		}
		</script>';
		return $this;	
	}	
	public function validation_(){
		return $this->js_validate_;
	}
	public function css(){
		$req ='';
		if( $args= func_get_args() ):
		foreach($args as $req){		
		 echo '<link rel="stylesheet" href="design/css/'.$req.'" type="text/css" />';
		}
		else:
		return $req;		
		endif;		
	}
	public function browser(){
		$this->width = '<script>document.write(screen.width)</script>';
        $this->height = '<script>document.write(screen.height)</script>';
		if($func = func_get_args()){
	    if(count($func)==1){
		if($func[0]=='width'){ $browse = $this->width;}
		if($func[0]=='height'){ $browse = $this->height;}
		}
		elseif(count($func)==2){
		 if($func[0]=='width' && $func[1]=='height'){ $browse = $this->width.' X '.$this->height;}
		 if($func[0]=='height' && $func[1]=='width'){ $browse = $this->height.' X '.$this->width;}
		 }
		else{ $browse = die('<span class="error">Sorry, enter correct browser width or height !</span>');}
		}else{		
		$browse = array('width'=>$this->width,'height'=>$this->height);
	   }
	   return $browse;
	}
	
}