<?php
Class Mx {
    var $encrypted_key = '1234567890';
    
    function vgdShorten($url,$shorturl = null){
        //$url - The original URL you want shortened
        //$shorturl - Your desired short URL (optional)
    
        //This function returns an array giving the results of your shortening
        //If successful $result["shortURL"] will give your new shortened URL
        //If unsuccessful $result["errorMessage"] will give an explanation of why
        //and $result["errorCode"] will give a code indicating the type of error
    
        //See http://v.gd/apishorteningreference.php#errcodes for an explanation of what the
        //error codes mean. In addition to that list this function can return an
        //error code of -1 meaning there was an internal error e.g. if it failed
        //to fetch the API page.
    
        $url = urlencode($url);
        $basepath = "http://v.gd/create.php?format=simple";
        //if you want to use is.gd instead, just swap the above line for the commented out one below
        //$basepath = "http://is.gd/create.php?format=simple";
        $result = array();
        $result["errorCode"] = -1;
        $result["shortURL"] = null;
        $result["errorMessage"] = null;
    
        //We need to set a context with ignore_errors on otherwise PHP doesn't fetch
        //page content for failure HTTP status codes (v.gd needs this to return error
        //messages when using simple format)
        $opts = array("http" => array("ignore_errors" => true));
        $context = stream_context_create($opts);
    
        if($shorturl)
            $path = $basepath."&shorturl=$shorturl&url=$url";
        else
            $path = $basepath."&url=$url";
    
        $response = @file_get_contents($path,false,$context);
    
        if(!isset($http_response_header))
        {
            $result["errorMessage"] = "Local error: Failed to fetch API page";
            return($result);
        }
    
        //Hacky way of getting the HTTP status code from the response headers
        if (!preg_match("{[0-9]{3}}",$http_response_header[0],$httpStatus))
        {
            $result["errorMessage"] = "Local error: Failed to extract HTTP status from result request";
            return($result);
        }
    
        $errorCode = -1;
        switch($httpStatus[0])
        {
            case 200:
                $errorCode = 0;
                break;
            case 400:
                $errorCode = 1;
                break;
            case 406:
                $errorCode = 2;
                break;
            case 502:
                $errorCode = 3;
                break;
            case 503:
                $errorCode = 4;
                break;
        }
    
        if($errorCode==-1)
        {
            $result["errorMessage"] = "Local error: Unexpected response code received from server";
            return($result);
        }
    
        $result["errorCode"] = $errorCode;
        if($errorCode==0)
            $result["shortURL"] = $response;
        else
            $result["errorMessage"] = $response;
    
        return($result);
    }
    
    function timestamp_to_date($timestamp, $format = 'Y-m-d'){
        return date($format, $timestamp);
    }
    
    function truncate($text, $chars = 25) {
        $text = $text." ";
        $text = substr($text,0,$chars);
        $text = substr($text,0,strrpos($text,' '));
        $text = $text."...";
        return $text;
    }
    
    function getSubdomain($domain) {
        $expl = explode(".", $domain, -2);
        $sub = "";
        if(count($expl) > 0) {
            foreach($expl as $key => $value) {
                $sub = $sub.".".$value;
    
            }
            $sub = substr($sub, 1);
        }
        return $sub;
    }
    
    function encrypt_decrypt($action, $string) {
        $output = false;
    
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';
    
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
    
        return $output;
    }

    
    function encrypt($pure_string) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $this->encrypted_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }
    
    /**
     * Returns decrypted original string
     */
    function decrypt($encrypted_string) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $this->encrypted_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }
}
$Mx = new Mx;
?>