<?php

namespace App;

use \Cfg\Config;

class Validate
{
	/**
	 * Aceita POST apenas de dentro do site
	 * @throws Exception
	 * @return void
	 */
	public static function doPost(): void
	{
		if (strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
			if (Config::DEBUG)
				throw new \Exception('ONLY POST METHODS!');
			else
				header('Location: /');
			exit;
		}
		if ($_SERVER['HTTP_ORIGIN'] !== Config::DOMAIN) {
			if (Config::DEBUG)
				throw new \Exception('DOMAIN ERROR!');
			else
				header('Location: /');
			exit;
		}
	}


    /**
	 * Aceita GET apenas de dentro do site
	 * @throws Exception
	 * @return void
	 */
	public static function doGet(): void
	{
		
		if (strtolower($_SERVER['REQUEST_METHOD']) !== 'get') {
			if (Config::DEBUG)
				throw new \Exception('ONLY POST METHODS!');
			else
				header('Location: ./');
			exit;
		}
	}

    /**
	 * Aceita GET apenas de dentro do site
	 * @throws Exception
	 * @return void
	 */
	public static function doPut(): void
	{
		if (strtolower($_SERVER['REQUEST_METHOD']) !== 'put') {
			if (Config::DEBUG)
				throw new \Exception('ONLY POST METHODS!');
			else
				header('Location: /');
			exit;
		}
		if ($_SERVER['HTTP_ORIGIN'] !== Config::DOMAIN) {
			if (Config::DEBUG)
				throw new \Exception('DOMAIN ERROR!');
			else
				header('Location: /');
			exit;
		}
	}

	/**
	 * Bloqueia métodos
	 * @see chamado por Core\Controller::__call
	 * @throws Exception
	 * @return void
	 */
	public static function blockMethods(array $methods): void
	{
		if (in_array(strtolower($_SERVER['REQUEST_METHOD']), $methods )) {
			if (Config::DEBUG)
				throw new \Exception("{$_SERVER['REQUEST_METHOD']} METHOD NOT ALLOWED", 405);
			else
				header('HTTP/1.0 405 Method Not Allowed');
			exit;
		}
	}

	public static function checkpassword($pass1, $pass2)
	{
		$errors =0;
		if(strlen($pass1)==strlen($pass2))
		{
			$errors =0;
			$char1 = str_split($pass1);
			$char2 = str_split($pass2);
			if(sizeof($char1)==sizeof($char2))
			{
				$errors =0;
				for($i=0; $i<sizeof($char1); $i++)
				{
					if($char1[$i]==$char2[$i])
					{
						$errors =0;
					}
					else 
					{
						$errors.=1;
					}
				}
			}
			else
			{
				$errors =4;
			}
		}
		else 
		{
			$errors =5;
		}
		if(intval($errors)==0)
		{
			return true;
		}
		else return false;
	}


	public static function antiInjection($frase)
	{
		/** 
		 * SELECT CONCAT(CHAR(75),CHAR(76),CHAR(77)) (M) 
		 *  SELECT CHAR(75)+CHAR(76)+CHAR(77) (S) 
		 *  SELECT CHR(75)||CHR(76)||CHR(77) (O) 
		 * SELECT (CHaR(75)||CHaR(76)||CHaR(77)) (P) 
		 * admin' --
		*	admin' #
		*	admin'/*
		*	' or 1=1--
		*	' or 1=1#
		*   ' or 1=1/*
		*  ') or '1'='1--
		*  ') or ('1'='1--
		 */

		 $catch =0;

		 $injection = [ 'SELECT CONCAT(CHAR(75),CHAR(76),CHAR(77)) (M)' , 
		 				'SELECT CONCAT(CHAR(75),CHAR(76),CHAR(77))' ,
						'SELECT CHAR(75)+CHAR(76)+CHAR(77) (S) ' , 
						'SELECT CHAR(75)+CHAR(76)+CHAR(77)',
						'SELECT CHR(75)||CHR(76)||CHR(77) (O)',
						'SELECT CHR(75)||CHR(76)||CHR(77)',
						'SELECT (CHaR(75)||CHaR(76)||CHaR(77)) (P)',
						'SELECT (CHaR(75)||CHaR(76)||CHaR(77))',
						"admin' --",
						"admin'/*",
						"' or 1=1--",
						"' or 1=1#",
						"') or '1'='1--",
						"') or ('1'='1--"
					];

	    foreach($injection as $k =>$v)
		{
			//print_r(self::compareStrings($frase, $v));echo PHP_EOL;
			if(intval(self::compareStrings($frase, $v))> 65)
			{
				$catch +=1;
			}
		}

		if($catch > 0)
		{
			return true;
		}
		else
		{
			if(stripos($frase, $v)!=false)
			{
				$catch +=1;
			}
			if($catch > 0)
			{
				return true;
			}
			else return false;
		}
	}

	protected static function compareStrings($s1, $s2) {
		if (strlen($s1)==0 || strlen($s2)==0) {
			return 0;
		}
	   
		$s1clean = preg_replace("/[^A-Za-z0-9-]/", ' ', $s1);
		$s2clean = preg_replace("/[^A-Za-z0-9-]/", ' ', $s2);
	
		while (strpos($s1clean, "  ")!==false) {
			$s1clean = str_replace("  ", " ", $s1clean);
		}
		while (strpos($s2clean, "  ")!==false) {
			$s2clean = str_replace("  ", " ", $s2clean);
		}
	
	   
		$ar1 = explode(" ",$s1clean);
		$ar2 = explode(" ",$s2clean);
		$l1 = count($ar1);
		$l2 = count($ar2);
		
		if ($l2>$l1) {
			$t = $ar2;
			$ar2 = $ar1;
			$ar1 = $t;
		}
	
		$ar2 = array_flip($ar2);
	
		$maxwords = max($l1, $l2);
		$matches = 0;
	
		foreach($ar1 as $word) {
			if (array_key_exists($word, $ar2))
				$matches++;
		}
	
		return ($matches / $maxwords) * 100;    
	}

	public static function isSessionTimeout()
	{
		if(strtotime($_SESSION['fim'])<= strtotime(date('H:s')))
		{
			return true;
		}
		else return false;
	}

	public static function isSession()
	{
		if(!isset($_SESSION['ativa']))
		{
			return false;
		}
		elseif(isset($_SESSION['ativa']) && $_SESSION['ativa']=='false')
		{
			return false;
		}
		else return true;
	}
}

//var_dump(Validate::antiInjection("' or 1=1----"));