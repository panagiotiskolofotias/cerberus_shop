<?php
class ConnectionDB {
    private static $db = 'cerberus_shop';
    private static $host = 'localhost';
    private static $user = 'root';
    private static $pass = '';
    private static $port = 3306;
    public static function SelectQuery($SqlStr){
        try{
            $Connection = mysqli_connect(self::$host,self::$user ,self::$pass,self::$db,self::$port);
             if (!$Connection){
                 $error= die('Connect Error: ' . mysqli_connect_error());
               throw new Exception($error);
            }
           else{
            $result =  mysqli_query($Connection,$SqlStr) or die(mysqli_error($Connection)); 
            mysqli_close($Connection);
            return $result;
           }
        }
        catch (Exception $ex){
            throw new Exception($ex->getMessage());
        }
    }
    public static function MyConn(){
        try{
            $conn =new  mysqli(self::$host,self::$user ,self::$pass,self::$db,self::$port);
             if ($conn->connect_error){
                 $error=die("Connection failed: " . $conn->connect_error);
               throw new Exception($error);
            }
            return $conn;
        }
        catch (Exception $ex){
            throw new Exception($ex->getMessage());
        }
    }

    public static function ExcecuteQuery($SqlStr){
        try{
          //  $Connection = @mysqli_connect(self::$host,self::$user ,self::$pass,self::$db,self::$port);            
            $Connection = mysqli_connect(self::$host,self::$user ,self::$pass,self::$db,self::$port);            
            $result =  mysqli_query($Connection,$SqlStr);
            if (!$result ){         
                 $error= mysqli_error($Connection); 
                  mysqli_close($Connection);
                throw new Exception($error);
            }
            mysqli_close($Connection);
            if ($result ===false){throw new Exception("No rows Update or insert");}
            return $result;
        }
        catch (Exception $ex){
            throw new Exception($ex->getMessage());
        }
    }




}