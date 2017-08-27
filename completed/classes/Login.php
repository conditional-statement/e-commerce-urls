<?php
class Login {

	public static $_login_page_front = "/login";
	public static $_dashboard_front = "/orders";
	public static $_login_front = "cid";
	
	public static $_login_page_admin = "/panel/";
	public static $_dashboard_admin = "/panel/products";
	public static $_login_admin = "aid";
	
	public static $_valid_login = "valid";
	
	public static $_referrer = "refer";
	
	
	
	
	
	
	
	
	
	public static function isLogged($case = null) {
		if (!empty($case)) {
			if (
				isset($_SESSION[self::$_valid_login]) && 
				$_SESSION[self::$_valid_login] == 1
			) {
				return isset($_SESSION[$case]) ? true : false;
			}
			return false;
		}
		return false;
	}
	
	
	
	
	
	
	
	
	
	
	
	public static function loginFront($id = null, $url = null) {
		if (!empty($id)) {
			$url = !empty($url) ? $url : self::$_dashboard_front.PAGE_EXT;
			$_SESSION[self::$_login_front] = $id;
			$_SESSION[self::$_valid_login] = 1;
			Helper::redirect($url);
		}
	}
	
	
	
	
	
	
	
	public static function loginAdmin($id = null, $url = null) {
		if (!empty($id)) {
			$url = !empty($url) ? $url : self::$_dashboard_admin;
			$_SESSION[self::$_login_admin] = $id;
			$_SESSION[self::$_valid_login] = 1;
			Helper::redirect($url);
		}
	}
	
	
	
	
	
	
	
	
	
	public static function restrictFront($objUrl = null) {
		$objUrl = is_object($objUrl) ? $objUrl : new Url();
		if (!self::isLogged(self::$_login_front)) {
			$url = $objUrl->cpage != "logout" ?
					self::$_login_page_front."/".self::$_referrer."/".$objUrl->cpage.PAGE_EXT :
					self::$_login_page_front.PAGE_EXT;
			Helper::redirect($url);
		}
	}
	
	
	
	
	
	
	
	public static function restrictAdmin() {
		if (!self::isLogged(self::$_login_admin)) {
			Helper::redirect(self::$_login_page_admin);
		}
	}
	
	
	
	
	
	
	
	
	public static function string2hash($string = null) {
		if (!empty($string)) {
			return hash('sha512', $string);
		}
	}
	
	
	
	
	
	
	
	public static function getFullNameFront($id = null) {
		if (!empty($id)) {
			$objUser = new User();
			$user = $objUser->getUser($id);
			if (!empty($user)) {
				return $user['first_name']." ".$user['last_name'];
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	public static function logout($case = null) {
		if (!empty($case)) {
			$_SESSION[$case] = null;
			$_SESSION[self::$_valid_login] = null;
			unset($_SESSION[$case]);
			unset($_SESSION[self::$_valid_login]);
		} else {
			session_destroy();
		}
	}
	
	
	
	
	
	
	
	
	


}