<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    static public function  fileUploadBase64($fileConfigArray = array()){
    /**
     * storage base64 encoded string 
     * @param  $fileConfigArray['path']  is contain folder path
     * @return $fileConfigArray['name'] is contain file name
     * @return $fileConfigArray['base64EncodeString'] is  base 64 encoded string 
     */
        
       $decodedImage = base64_decode($fileConfigArray['base64EncodeString']); // arrival
       $response =  Storage::put($fileConfigArray['path'].$fileConfigArray['name'], $decodedImage);
       return $response;
    }
    
    static public function clientDetail(Request $request) {
        $user_agent = $request->header('User-Agent');
        $bname = 'Unknown';
        $platform = 'Unknown';
        $clientDetail = array();


        //First get the platform?
        if (preg_match('/linux/i', $user_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $user_agent)) {
            $platform = 'windows';
        }


        $clientDetail['platform'] = $platform;

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $user_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $user_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $user_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $user_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $user_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        $clientDetail['user_agent'][1] = $bname;
        $clientDetail['user_agent'][2] = $ub;
        return $clientDetail;
    }

}
