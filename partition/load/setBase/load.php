<?php
// BASE,FRAME,INTERFACE  [[  LOADING PATH  ]]//
require('base.php');
class Mytheme{
	public function connect(){
		require('partition/status/status.php');
		require('partition/load/setFrame/inc.php');
		require('partition/load/interface/interface.php');		
	}
}

