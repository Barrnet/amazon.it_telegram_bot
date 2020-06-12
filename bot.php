<?php 
// Turn off all error reporting
error_reporting(0);
include_once("config.php");
	
//funzione invio messaggio
function sendMessage($chatID,$text){
	$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$text;
	file_get_contents($sendto);
}	

//funzione invio immagine via URL
function sendPhoto($chatID,$text){
	$sendto =API_URL."sendPhoto?chat_id=".$chatID."&photo=".$text;
	file_get_contents($sendto);
}	

//controlla se l'url esiste
function url_check($url) {
	$file_headers = @get_headers($url);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
		return false;
	}else {
		return true;
	}
}

// read incoming info and grab the chatID
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (!$update) {
  // receive wrong update, must not happen
  exit;
}

$id_chat = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
switch (true) {
	case stripos($message,'/start') !== false:	
		sendMessage($id_chat,"Ciao! /n Inviami un link di Amazon.it  con il comando /ref per ottenerne uno equivalente ma con un ref-link :D");
		break;
	case stripos($message,'/ref') !== false:
		$message = str_replace("/ref", "", $message);
		$message = str_replace(BOT_ID, "", $message);
			preg_match_all("/(?<=\/)B[A-Z0-9]{9}/",$message,$matches);
		$url_affiliate = "https://www.amazon.it/gp/product/". $matches[0][0]. REF_AMZ;
	
		if (url_check($url_affiliate) and !empty($matches[0])) {
			sendMessage($id_chat,$url_affiliate);
		}else{
			sendMessage($id_chat,"Non sono riuscito a generare il link affiliato. Prova con un'altra variante del link :(");
		}
		break;
    default:
		break;
}
?>
