<?php

namespace App\Helpers;

use Request;

class MiscHelper
{

    /**
     * Generate short url from given code.
     *
     * @param  string  $short_code
     * @return string  $url
     */
    public static function getShortUrl($short_code)
    {
        $url = config('app.url').'/'.$short_code;
        return $url;
    }
    public static function is_blacklisted_url($str)
    {   
        $blacklisted_domains= 'youtube.com|gmail.com|google.com';


        $r = "(?P<host>(?:(?P<subdomain>[\w\.]+)\.)?" . "(?P<domain>\w+\.(?P<extension>\w+)))";
        $r = "!$r!";// Delimiters
        preg_match($r, $str, $out);
        
        if(isset($out['domain']) && $out['domain']!="")
        {
            $domain_name = $out['domain'];              
            $re = '/^(?!('.$blacklisted_domains.')$).*$/';
            $domain_name = strtolower($domain_name);
            preg_match($re, $domain_name, $matches, PREG_OFFSET_CAPTURE, 0);
            
            if(count($matches) > 0)
            {
                return true;
            }
        }
        return false;
        
    }
    
}
