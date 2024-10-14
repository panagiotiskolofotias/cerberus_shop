<?php
if (!isset($_SESSION)) { session_start();}
require_once("Enumerations.php");
require_once("ConnectionDB.php");

class Users {
    public $id;
    public $name;
    public $email;
    public $password;
    public $user_type;
    public $image;

    public function Users($Id, $Name, $Password, $Email, $User_Type, $Image) {
        $this->id = $Id;
        $this->name = $Name;
        $this->password = $Password;
        $this->email = $Email;
        $this->user_type = $User_Type;
        $this->image = $Image;
    }

    public static function Login($Name,$Password) {
        try {
            $result =ConnectionDB::SelectQuery("Select * from users where name ='$Name'");
            if ($result->num_rows == 0) {
                throw new Exception("the User not found  try again!");
            }
            $user_type = UserRole::ANONYMOUS;
            $usr = AppSession::ClearCurentUser();            
            while ($row = mysqli_fetch_array($result)) {
                $usr->id=$row['id'];
                $usr->name=$row['name'];
                $usr->password=$row['password'];
                $usr->user_type=$row['user_type'];
                $usr->email=$row['email'];
                $usr->image=$row['image'];
            }
            
            if ($Name === $usr->name && $Password === $usr->password) {
                AppSession::SetMessage("");
                AppSession::Set_IsLogin(1);
                $_SESSION['UserRole'] =$usr->user_type;
                
            } else {
                throw new Exception("You have entered wrong password, try again!");
            }
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public static function Register_user($Name, $Password, $Email, $Image ) {
        try {

            $result =ConnectionDB::SelectQuery("select * from users where name ='".$Name."'");
            if ($result->num_rows != 0) {
                throw new Exception("the UserName is found !");
            }
            $Id=null;
            $InsertSql="insert into users(name,password,email,user_type,image )"
                    ."  VALUES ('".$Name."','".$Password."','".$Email."','".UserRole::ANONYMOUS."','".$Image."')";
            ConnectionDB::ExcecuteQuery($InsertSql);
            self::Login($Name, $Password);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function Updatre_user($Id, $Name, $Password, $Email, $User_Type, $Image) {
        try {

            $result =ConnectionDB::SelectQuery("select * from app_users WHERE name ='".$Name."'");
            if ($result->num_rows != 0) {
                throw new Exception("the UserName is found !");
            }
            $UpdatetSql="update users set name = '".$Name."',password ='".$Password."',email ='".$Email."',user_type ='".$User_Type."',image = '".$Image."'"
                        ."where id = ".$Id;
            ConnectionDB::ExcecuteQuery($UpdatetSql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
