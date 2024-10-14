<?php
session_start();
require_once("Enumerations.php");
class AppSession {
    public static function CurentUser() {
        if (!isset($_SESSION['CurentUser']))
        {
            $usr=new stdClass;
            $usr->id='';
            $usr->name='';
            $usr->user_type= UserRole::ANONYMOUS;
            $_SESSION['CurentUser']=$usr;
        }        
        return $_SESSION['CurentUser'];
    }

    public static function ClearCurentUser() {
        $usr=new stdClass;
        $usr->id='';
        $usr->name='';
        $usr->user_type= UserRole::ANONYMOUS;
        $_SESSION['UserRole'] =$usr->user_type;
        $_SESSION['CurentUser']=$usr;
        return $_SESSION['CurentUser'];
    }  
    public static function SetMessage($Message) {
        $_SESSION['message'] = $Message;
    } 
    public static function Set_IsLogin($islogin){
        $_SESSION['IsLogin'] =$islogin; 
    } 
     public static function SetUserRole($UserRole){
        $_SESSION['UserRole'] =$islogin; 
    }  
     public static function GetUserRole() {
         return(string)$_SESSION['UserRole']; 
    }      
    
    
    public static function Redirect($url)
    {
         if (!headers_sent()) {
             header('Location: '.$url);
             exit;
         }
         else {
             echo '<script type="text/javascript">';
             echo 'window.location.href="'.$url.'";';
             echo '</script>';
             echo '<noscript>';
             echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
             echo '</noscript>'; 
             exit;
         }
     } 

}