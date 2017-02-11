<?php
# PHP Dev__ framework
class Module{
		public function connect(){
		   $arg = func_get_args();
		   if(count($arg)!=0){
		    echo connect_module($arg[0]);
		   }
		}
}
class Plugin{
		public function connect(){
		   $arg = func_get_args();
		   if(count($arg)!=0){
		    echo connect_plugin($arg[0]);
		   }
		}
}