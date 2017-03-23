<?php

function getData($method, $url, $data = false) {
    $curl = curl_init();

    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
			echo"method POST<br/>";
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
		case "DELETE":
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

   // Optional Authentication:
   $login = "ministryfm";
   $passwd = "mfm2016";
   
	 curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
     curl_setopt($curl, CURLOPT_USERPWD, $login.":".$passwd);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_COOKIESESSION, 1);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function stringValueChamp($value, $champ){
	return ((isset($value -> $champ))? $value -> $champ : '' );
}

?>