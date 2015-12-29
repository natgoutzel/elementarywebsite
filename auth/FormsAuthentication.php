<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormsAuthentication
 *
 * @author Rin0a
 */
require 'vendor/autoload.php';


class FormsAuthentication {
   
    private static $iv = "ivopa198266";
    //private static $key = "abcdefghijklmnopqrstuvwxyz123456";
    private static $key =   "natasiagkoutzeloudienaduotriates";
    private static $authCookieName = "ac";
    private static $saltSize = 20;
    private static $cookieDurationInSeconds = 7200;//2 hours;
    
    public static function setAuthCookie($value,$rememberMe=false){
        
        $cipher = new \phpseclib\Crypt\Aes(\phpseclib\Crypt\Aes::MODE_CBC);
        $cipher->setKey(FormsAuthentication::$key);
        $cipher->setIV(FormsAuthentication::$iv);

        $valueWithSalt = FormsAuthentication::saltIt($value);
        echo $valueWithSalt;
        $encval = $cipher->encrypt(FormsAuthentication::addNoiseToString($valueWithSalt));
      
       echo "Enc: " .base64_encode($encval)."</br>";

        $time = 0;
        if ($rememberMe){
            $time = time()+FormsAuthentication::$cookieDurationInSeconds;
        }
        setcookie(FormsAuthentication::$authCookieName, base64_encode($encval), $time,"",  "", false,   true);
        unset($cipher);
        unset($val);
    }
    
    public static function GetAuthCookieValue(){
        
        $cipher = new \phpseclib\Crypt\Aes();
        $cipher->setKey(FormsAuthentication::$key);
        $cipher->setIV(FormsAuthentication::$iv);
        
        if(!isset($_COOKIE[FormsAuthentication::$authCookieName])) {
            return "";
        }else{
            $d = $_COOKIE[FormsAuthentication::$authCookieName];
            $decryptedValue = $cipher->decrypt(base64_decode($d));
            return explode("~",  FormsAuthentication::removeNoiseFromString($decryptedValue))[0]; 
        }
        
    }
    
    private static  function saltIt($value){
       
      $salt = FormsAuthentication::generateSalt();
      //TODO: For more secure you can save it to database. In the GetAuthCookie you can check the database. This is also for unique logins
      return $value."~".$salt;
    }
    
    private static function generateSalt(){
        //TODO: Crate more random salt -> meaning better salt
        $salt = array_fill(0, FormsAuthentication::$saltSize, "");
        
        for ($i=1;$i<FormsAuthentication::$saltSize;$i++){
            $salt[$i] = strval(rand(0, 9));
        }
        return join("", $salt);
    }


    private static function addNoiseToString($value){
        
        //dimitris
        //d1i6m5
        $var = str_split($value);
        $newArr = array_fill(0, 2*count($var), "");
  
        for ($i=0;$i<2*count($var);$i++){
            if ($i%2==0){
                $newArr[$i] = $var[$i/2]; 
            }else{
                $newArr[$i] = strval(rand(0,9));
            }
        }
        return join("", $newArr);
    }
    
    private static function removeNoiseFromString($value){
         $var = str_split($value);
         $newArr = array_fill(0, count($var)/2, "");
          
         for ($i=0;$i<count($var);$i++){
                if ($i%2==0){
                    $newArr[$i/2] = $var[$i];
                }else{
                    
                }
         }
         return join("", $newArr);
         
    }
}
