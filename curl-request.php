<?php 
/***
*         *** Author: Basavaraj Burge ***
*         Add this file to your file wherever you requires REST API cals
*         include('/resources/curl-request.php');
*         Arguments
*               arg1 ($method)      :   Method to make HTTP Request like POST,GET,PUT
*               arg2 ($data)        :   Data which you want to send with the request 
*                                        (Array of keys and values like  
*                                          Ex:                              Array( 
*                                                                                $key1 => $value1,
*                                                                                $key2 => $value2,
*                                                                                .....
*                                                                            );
*               arg3 ($url)         :   Url for which you want to make REST API call
*               arg4 ($headers)     :   Headers you want set along with the HTTP Request
*                                       (Array of keys and values like  
*                                          Ex:                              Array( 
*                                                                                $key1 => $value1,
*                                                                                $key2 => $value2,
*                                                                                .....
*                                                                            );                 
*               arg5 ($username)    :   Username of the server in case of server required Authontication
*               arg5 ($password)    :   Password of the server in case of server required Authontication
***/


function CurlRequest($method,$data,$url,$headers=array(),$username="",$password=""){
	    $curl = curl_init();
        //In case of authontication needed
        if($username!="")
            curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
        
	    switch ($method)
	    {
            case "GET":
			        $url = sprintf("%s?%s", $url, http_build_query($data));
               break;
	        case "POST":
	            if ($data)
					curl_setopt($curl,CURLOPT_POST, count($data));
	                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	            break;
	        case "PUT":
			        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			        curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query($data));
	            break;
	        default:
	            if ($data)
	                $url = sprintf("%s?%s", $url, http_build_query($data));
	    }
	
	    // Optional Authentication:
		curl_setopt($curl,CURLOPT_COOKIESESSION,true);
        curl_setopt($curl,CURLAUTH_NTLM); 
	    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	    curl_setopt($curl, CURLOPT_USERPWD, "username:password");
	
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $result = curl_exec($curl);
	
	    curl_close($curl);
	
	    return $result;
}

?>
