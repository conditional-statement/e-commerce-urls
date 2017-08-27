<?php
class Core {

	public $objUrl;
	public $objNavigation;
	
	public $_meta_title = 'E-commerce project';
	public $_meta_description = 'E-commerce project';
	public $_meta_keywords = 'E-commerce project';
	
	
	
	
	
	
	
	
	
	public function __construct() {
		$this->objUrl = new Url();
		$this->objNavigation = new Navigation($this->objUrl);
	}









	
	public function run() {
	
		ob_start();
		
		switch($this->objUrl->module) {
			
			case 'panel':
			set_include_path(implode(PATH_SEPARATOR, array(
				realpath(ROOT_PATH.DS.'admin'.DS.TEMPLATE_DIR),
				realpath(ROOT_PATH.DS.'admin'.DS.PAGES_DIR),
				get_include_path()
			)));
			@require_once(ROOT_PATH.DS.'admin'.DS.PAGES_DIR.DS.$this->objUrl->cpage.'.php');
			break;
			
			default:
			set_include_path(implode(PATH_SEPARATOR, array(
				realpath(ROOT_PATH.DS.TEMPLATE_DIR),
				realpath(ROOT_PATH.DS.PAGES_DIR),
				get_include_path()
			)));
			@require_once(ROOT_PATH.DS.PAGES_DIR.DS.$this->objUrl->cpage.'.php');
			
		}
		
		ob_get_flush();
		
	}
	
	
	
	
	
	
	
	

}





